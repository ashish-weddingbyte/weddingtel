<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\VendorDetail;
use App\Models\SocialLink;
use App\Models\Otp;
use App\Models\Planning_tool;
use App\Models\Budget;
use otp_helper;
use tools_helper;
use Validator;

class UserController extends Controller
{


    // public function test(){
    //     $data = DB::table('entry')->get();
    //     echo '<pre>';
    //     foreach($data as $d){
            
    //         $phone = str_replace('+91','',$d->phone);

    //         $user = new User;
    //         $user->name = $d->name;
    //         $user->email = $d->email;
    //         $user->password = Hash::make($d->password);
    //         $user->mobile = str_replace(' ','',$phone);
    //         $user->user_type = 'vendor';
    //         $user->save();
             

    //         $lastId = $user->id;

    //         switch ($d->category) {
    //             case 'Makeup Artist':
    //                 $cat_id = '1';
    //                 break;
                
    //                 case 'Wedding Photographers':
    //                     $cat_id = '3';
    //                     break;

    //                     case 'Wedding Venues':
    //                         $cat_id = '2';
    //                         break;

    //                         case 'Bridal Designers':
    //                             $cat_id = '4';
    //                             break;

    //                             case 'Wedding Planner':
    //                                 $cat_id = '7';
    //                                 break;

    //                                 case 'Mehndi Artist':
    //                                     $cat_id = '6';
    //                                     break;
    //                                     case 'Choreographers':
    //                                         $cat_id = '5';
    //                                         break;

    //                                         case 'Wedding Invitation':
    //                                             $cat_id = '8';
    //                                             break;
    //                 default:
    //                 $cat_id = NULL;
    //                 break;
    //         }

    //         $vendor_details = new VendorDetail;
    //         $vendor_details->user_id = $lastId;
    //         $vendor_details->category_id = $cat_id;
    //         $vendor_details->city  = $d->city;
    //         $vendor_details->brandname  =   $d->brandname;
    //         $vendor_details->featured_image  =   str_replace('uploads/','', $d->mphoto);
    //         $vendor_details->address  =   $d->address;
    //         $vendor_details->description  =   $d->business;
    //         $vendor_details->cancel_policy  =   $d->cancel;
    //         $vendor_details->is_travelable  =   '1';
    //         $vendor_details->advance_payment  =   '30';
    //         $vendor_details->youtube  =   '';
    //         $vendor_details->service_offered  =   $d->services;
            
    //         $vendor_details->save();

    //         $social = new SocialLink;
    //         $social->user_id= $lastId;
    //         $social->facebook=Null;
    //         $social->youtube=NULL;
    //         $social->instagram=Null;
    //         $social->twitter=Null;
    //         $social->save();
            
    //         // exit();
    //     }

    // }


    /**================================== Bride/Groom Code Start Here====================== */
    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password'  =>'required|min:6',
            'mobile' => 'required|max:10|min:10|unique:users,mobile',
            'city'  =>  'required',
            'event' =>  'required|date|after:today',
        ]);
        
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->mobile = $request->input('mobile');
        $user->status = '0';
        $user->user_type = 'user';

        
        if ($user->save()) {
            $lastId = $user->id;

            $user_details = new UserDetail;
            $user_details->user_id = $lastId;
            $user_details->event = date('Y-m-d',strtotime($request->event));
            $user_details->city  = $request->city;
            $user_details->save();


            // add default checklist
            tools_helper::add_default_checklist($lastId);


            // planning tool info
            $planning_tool = new Planning_tool;
            $planning_tool ->user_id= $lastId;
            $planning_tool->save();

            // add budget of user
            $budget = new Budget;
            $budget->user_id = $lastId;
            $budget->status = '0';
            $budget->save();


            $otp = rand(111111,999999);
            $message = "Your One Time Password for WeddingByte.com account is $otp. Plase do not share this OTP with anyone.\nThanks";
            $otp_send_status = otp_helper::send_otp($user->mobile,$message);
            // $otp_send_status ="";

            if($otp_send_status){

                // send_otp($otp,$message);
                $otp_model = new Otp;
                $otp_model->user_id = $lastId;
                $otp_model->otp = $otp;
                $otp_model->status = '1';
                
                $otp_model->save();

                Session::flash('message', 'User Register Successfully! Enter OTP to verify Mobile Number.');
                Session::flash('class', 'alert-success');
            }else{
                Session::flash('message', 'User Register Successfully! Somthing Went Wrong in OTP Please Use Email ID/Password to Login');
                Session::flash('class', 'alert-danger');
            }

            return redirect('otp/r/'.$lastId);

        }else{
            Session::flash('message', 'Somthing Went Wrong!');
            Session::flash('class', 'alert-danger');
            return redirect('register');
        }
    }


    public function otp(){
        return view('front.user.verify_otp');
    }


    public function verify_otp(Request $request){
        $request->validate([
            'otp' => 'required|max:6|min:6'
        ]);
        $from = $request->from;
        $otp = $request->otp;
        $user_id = $request->user_id;
    
        $otp_details = Otp::where('user_id',$user_id)->first();


        if($otp_details->status == '0'){
            Session::flash('message', 'OTP is Expired!');
            Session::flash('class', 'alert-danger');
            return redirect("otp/$from/$user_id");
        }else{
            // otp verified succesfully
            if($otp == $otp_details->otp){

                if($from == 'f'){
                    Session::flash('message', 'OTP Matched Successful!, Now You Reset Your Password.');
                    Session::flash('class', 'alert-success');
                    return redirect("reset-password/f/".$user_id);
                }

                if($from  == 'l' || $from == 'r'){
                    $user = User::find($user_id);
                    Session::put('name', $user->name);
                    Session::put('email', $user->email);
                    Session::put('user_id', $user_id);
                    Session::put('user_type', $user->user_type);

                    
                    //expire otp after register successfully
                    $otp_details->status = '0';
                    $otp_details->save();


                    //mark user is active
                    // $user->status = '1';
                    // $user->save();

                    //mark mobile no is verified
                    $user_details = UserDetail::where('user_id',$user_id)->first();
                    if($user_details->is_mobile_verified == '0'){
                        $user_details->is_mobile_verified = '1';
                        $user_details->save();
                    }

                    Session::flash('message', 'Login to Dashboard Successful!');
                    Session::flash('class', 'alert-danger');
                    return redirect("/tools/dashboard");
                }

            }else{
                Session::flash('message', 'OTP is Invalid!');
                Session::flash('class', 'alert-danger');
                return redirect("otp/$from/$user_id");
            }
        }

    }


    public function reset_passord(Request $request){
        if($request->from != 'f' ){
            return redirect('/login');
        }
        return view('front.user.reset_password');

    }


    public function change_password(Request $request){
        $request->validate([
            'password'  =>'required|min:6',
            'confirm_password'  =>'required|min:6',
        ]);

        $id = $request->user_id;
        $form= $request->from;
        $password = $request->password;
        $confirm_password = $request->confirm_password;

        if($password === $confirm_password){

            $user = User::find($id);
            $user->password = Hash::make($password);
            $user->save();

            Session::flash('message', 'Password Reset Successfully!');
            Session::flash('class', 'alert-success');
            return redirect("login/e");

        }else{
            Session::flash('message', 'Password Not Matched!');
            Session::flash('class', 'alert-danger');
            return redirect("reset-password/f/".$id);
        }
    }


    /**================================== Bride/Groom Code End Here====================== */


    /**=======================Vendor Code Start Here =================================== */

    public function vendor_register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password'  =>'required|min:6',
            'mobile' => 'required|max:10|min:10|unique:users,mobile',
            'category'  =>  'required|not_in:0',
            'city'  =>  'required',
        ]);
    
        
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->mobile = $request->input('mobile');
        $user->status = '0';
        $user->user_type = 'vendor';

        
        if ($user->save()) {
            $lastId = $user->id;

            // add vendor details
            $vendor_details = new VendorDetail;
            $vendor_details->user_id = $lastId;
            $vendor_details->category_id = $request->category_id;
            $vendor_details->city  = $request->city;
            $vendor_details->save();


           
            // Add Social Links
            $social = new SocialLink;
            $social->user_id= $lastId;
            $social->facebook=Null;
            $social->youtube=NULL;
            $social->instagram=Null;
            $social->twitter=Null;
            $social->save();



            $otp = rand(111111,999999);
            $message = "Your One Time Password for WeddingByte.com Vendor Account is $otp. Plase do not share this OTP with anyone.\nThanks";
            $otp_send_status = otp_helper::send_otp($user->mobile,$message);
            // $otp_send_status ="";

            if($otp_send_status){

                // send_otp($otp,$message);
                $otp_model = new Otp;
                $otp_model->user_id = $lastId;
                $otp_model->otp = $otp;
                $otp_model->status = '1';
                
                $otp_model->save();

                Session::flash('message', 'Vendor Register Successfully! Enter OTP to verify Mobile Number.');
                Session::flash('class', 'alert-success');
            }else{
                Session::flash('message', 'Vendor Register Successfully! Somthing Went Wrong in OTP Please Use Email ID/Password to Login');
                Session::flash('class', 'alert-danger');
            }

            return redirect('vendor-otp/r/'.$lastId);

        }else{
            Session::flash('message', 'Somthing Went Wrong!');
            Session::flash('class', 'alert-danger');
            return redirect('register');
        }
    }

    public function vendor_otp(){
        return view('front.vendor.verify_otp');
    }


    public function vendor_verify_otp(Request $request){
        $request->validate([
            'otp' => 'required|max:6|min:6'
        ]);
        $from = $request->from;
        $otp = $request->otp;
        $user_id = $request->user_id;
    
        $otp_details = Otp::where('user_id',$user_id)->first();


        if($otp_details->status == '0'){
            Session::flash('message', 'OTP is Expired!');
            Session::flash('class', 'alert-danger');
            return redirect("otp/$from/$user_id");
        }else{
            // otp verified succesfully
            if($otp == $otp_details->otp){

                if($from == 'f'){
                    Session::flash('message', 'OTP Matched Successful!, Now You Reset Your Password.');
                    Session::flash('class', 'alert-success');
                    return redirect("vendor-reset-password/f/".$user_id);
                }

                if($from  == 'l' || $from == 'r'){
                    $user = User::find($user_id);
                    Session::put('name', $user->name);
                    Session::put('email', $user->email);
                    Session::put('user_id', $user_id);
                    Session::put('user_type', $user->user_type);

                    
                    //expire otp after register successfully
                    $otp_details->status = '0';
                    $otp_details->save();


                    //mark user is active
                    // $user->status = '1';
                    // $user->save();

                    //mark mobile no is verified
                    $user_details = VendorDetail::where('user_id',$user_id)->first();
                    if($user_details->is_mobile_verified == '0'){
                        $user_details->is_mobile_verified = '1';
                        $user_details->save();
                    }

                    Session::flash('message', 'Login to Dashboard Successful!');
                    Session::flash('class', 'alert-danger');
                    return redirect("/vendor/dashboard");
                }

            }else{
                Session::flash('message', 'OTP is Invalid!');
                Session::flash('class', 'alert-danger');
                return redirect("vendor-otp/$from/$user_id");
            }
        }

    }

    public function vendor_reset_passord(Request $request){
        if($request->from != 'f' ){
            return redirect('/vendor-login');
        }
        return view('front.vendor.reset_password');

    }

    public function vendor_change_password(Request $request){
        $request->validate([
            'password'  =>'required|min:6',
            'confirm_password'  =>'required|min:6',
        ]);

        $id = $request->user_id;
        $form= $request->from;
        $password = $request->password;
        $confirm_password = $request->confirm_password;

        if($password === $confirm_password){

            $user = User::find($id);
            $user->password = Hash::make($password);
            $user->save();

            Session::flash('message', 'Password Reset Successfully!');
            Session::flash('class', 'alert-success');
            return redirect("vendor-login/e");

        }else{
            Session::flash('message', 'Password Not Matched!');
            Session::flash('class', 'alert-danger');
            return redirect("vendor-reset-password/f/".$id);
        }
    }

    /**=======================Vendor Code Start Here =================================== */

}
