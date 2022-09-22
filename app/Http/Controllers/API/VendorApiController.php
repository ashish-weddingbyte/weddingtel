<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Otp;


use otp_helper;
use Validator;

class VendorApiController extends Controller
{
    public function vendor_register(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password'  =>'required|min:6',
            'mobile' => 'required|max:10|min:10|unique:users,mobile',
            'category'  =>  'required|not_in:0',
            'city'  =>  'required|not_in:0',
        ]);

        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'   =>  "Failed",
                'errors'   =>  $validator->errors()->first()
            ];
            return response()->json($respose,401);
        }
    
        
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->mobile = $request->input('mobile');
        $user->status = '1';
        $user->user_type = 'vendor';
        $user->save();

        $token =  $user->createToken('WeddingByte')->plainTextToken;
        
        
        $lastId = $user->id;

        // add vendor details
        $vendor_details = new VendorDetail;
        $vendor_details->user_id = $lastId;
        $vendor_details->category_id = $request->category;
        $vendor_details->city_id  = $request->city;
        $vendor_details->city = "c";
        $vendor_details->cancel_policy = "Booking Amount Non Refundable.";
        
        switch($request->category){
            case('1'):
                $vendor_details->service_offered = 'The bouquet of services offered by the makeup artist  , makes them  the one stop solution . they  provide the following beauty services Bridal Makeup , Wedding Makeup AIRBRUSH BRIDAL MAKEUP , GUEST/FAMILY MAKEUP Indian bridal makeup  Engagement Makeup  Party Makeup HD Makeup Hair Styling ';
                
            break;

            case('2'):
                $vendor_details->service_offered = 'The bouquet of services offered by the Banquet Hall , makes them the one stop solution for your wedding . they provide the following beauty services BANQUET HALL CATERING SERVICES VENUE DECORATION';
                
            break;
            case('3'):
                $vendor_details->service_offered = 'They offers a plethora of wedding photography services like: Wedding videography  Save the Date Videos Wedding Films Teaser Videos Still Photography Pre-wedding shoots  CANDID PHOTOGRAPHY  TRADITIONAL PHOTOGRAPHY  CINEMATIC VIDEOGRAPHY';
                
            break;
            case('4'):
                $vendor_details->service_offered = 'They have a wide range of outfit options available for every bride.  You will find the most beautiful and eye-catching attire, with a touch of class and elegance. For the biggest event of your life you need something that truly is an extension of your lifestyle and personality Bridal lehengas Anarkalis Sarees Indo Western Outfits  Suits';
                
            break;
            case('5'):
                $vendor_details->service_offered = 'BollyHop,  Folk  Hip-Hop,   Tollywood,  Garba,  Poping';
                
            break;
            case('6'):
                $vendor_details->service_offered = 'Traditional Mehendi  Bridal Mehendi Arabic Mehendi Fusion Mehendi  Pakistani Mehendi';
                
            break;
            case('7'):
                $vendor_details->service_offered = 'With us , arranging an event is totally stress-free as our package usually includes - Wedding Planning Services  Wedding Decoration Entertainment Planning   Venue Booking Catering In-House Decorations Travel and Accommodations Logistics  Wedding day coordination  Invitations Guest management  Music and entertainment and lots more. Everything  can be customized as per your needs and budget.';
                
            break;
            case('8'):
                $vendor_details->service_offered = 'Boxed Invitations, Funky & Offbeat Invitations,   Modern Invites,  Traditional Invitations ';
                
            break;

            default:
            break;
        }
        $vendor_details->save();
        
        // Add Social Links
        $social = new SocialLink;
        $social->user_id= $lastId;
        $social->facebook=Null;
        $social->youtube=NULL;
        $social->instagram=Null;
        $social->twitter=Null;
        $social->save();

        return response()->json([
            'status'    =>  true,
            'message' => "Vendor registered successfully",
            'token_type' => 'Bearer',
            'access_token' => $token
        ]);
    }

    public function vendor_login(Request $request){
        $login_type = $request->input('login-type');

        // login with otp
        if($login_type  === 'o'){
            $validator = $request->validate([
                'mobile' => 'required|max:10|min:10',
            ]);

            $user = User::where('mobile',$request->mobile)->first();

            if(isset($user->id)){
                $user_id = $user->id;

                $otp = rand(111111,999999);
                $message = "Your One Time Password for WeddingByte.com Vendor Account is $otp. Plase do not share this OTP with anyone.\nThanks";
                $otp_send_status = otp_helper::send_otp($user->mobile,$message);

                $otp_model = Otp::where('user_id',$user_id)->first();

                if(isset($otp_model->id)){
                    $otp_model->otp = $otp;
                    $otp_model->status = '1';   
                    $otp_model->save();
                }else{
                    $otp_model = new Otp;
                    $otp_model->user_id = $user_id;
                    $otp_model->otp = $otp;
                    $otp_model->status = '1';
                    $otp_model->save();
                }

                if($otp_send_status){
                    Session::flash('message', 'OTP Send Successful to Your Mobile Number!');
                    Session::flash('class', 'alert-success');
                    return redirect('vendor-otp/l/'.$user_id);
                }else{
                    Session::flash('message', 'OTP Send Fail! Somthing Went Wrong!');
                    Session::flash('class', 'alert-danger');
                    return redirect('vendor-otp/l/'.$user_id);
                }

            }else{
                Session::flash('message', 'Vendor Not Register Yet, Please Register First!');
                Session::flash('class', 'alert-danger');
                return redirect('vendor-register');
            }

        }
        
        // login with email
        if($login_type === 'e'){
            $validator = Validator::make($request->all(),[
                'email' => 'required|email',
                'password'  =>  'required:min:6'
            ]);

            if($validator->fails()){
                $respose = [
                    'status'    =>  false,
                    'message'   =>  'Failed',
                    'errors'    =>  $validator->errors()->first()
                ];
                return response()->json($respose,401);
            }

            if (!Auth::attempt($request->only('email', 'password'))) {
                $respose = [
                    'status'    =>  false,
                    'message'   =>  'Failed',
                    'errors'   =>   'Invalid login details!'
                ];
                return response()->json($respose,401);
            }

            $email = $request->email;
            $password = $request->password;

            $user = User::where('email',$email)->where('user_type','vendor')->first();

            if(isset($user->id)){

                if(Hash::check($password, $user->password)){
                    Session::put('name', $user->name);
                    Session::put('email', $user->email);
                    Session::put('user_id', $user->id);
                    Session::put('user_type', $user->user_type);
                    Session::put('category_id', $user->category_id);

                    Session::flash('message', 'Login to Dashboard Successful!');
                    Session::flash('class', 'alert-danger');
                    return redirect("/vendor/dashboard");
                }else{
                    Session::flash('message', 'Incorrect Password!');
                    Session::flash('class', 'alert-danger');
                    return redirect('/vendor-login/e');
                }

            }else{
                Session::flash('message', 'Email ID is not Registred with US!');
                Session::flash('class', 'alert-danger');
                return redirect('/vendor-login/e');
            }

        }
    }
}
