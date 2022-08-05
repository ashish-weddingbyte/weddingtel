<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\Otp;
use otp_helper;
use Validator;


class login extends Controller
{
    
    public function user_login(Request $request){
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
                $message = "Your One Time Password for WeddingByte.com account is $otp. Plase do not share this OTP with anyone.\nThanks";
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
                    return redirect('otp/l/'.$user_id);
                }else{
                    Session::flash('message', 'OTP Send Fail! Somthing Went Wrong!');
                    Session::flash('class', 'alert-danger');
                    return redirect('otp/l/'.$user_id);
                }

            }else{
                Session::flash('message', 'User Not Register Yet, Please Register First!');
                Session::flash('class', 'alert-danger');
                return redirect('register');
            }

        }
        
        // login with email
        if($login_type === 'e'){
            $validator = $request->validate([
                'email' => 'required|email',
                'password'  =>  'required:min:6'
            ]);

            $email = $request->email;
            $password = $request->password;

            $user = User::where('email',$email)->first();

            if(isset($user->id)){

                if(Hash::check($password, $user->password)){
                    Session::put('name', $user->name);
                    Session::put('email', $user->email);
                    Session::put('user_id', $user->id);
                    Session::put('user_type', $user->user_type);

                    Session::flash('message', 'Login to Dashboard Successful!');
                    Session::flash('class', 'alert-danger');
                    return redirect("/tools/dashboard");
                }else{
                    Session::flash('message', 'Incorrect Password!');
                    Session::flash('class', 'alert-danger');
                    return redirect('/login/e');
                }

            }else{
                Session::flash('message', 'Email ID is not Registred with US!');
                Session::flash('class', 'alert-danger');
                return redirect('/login/e');
            }

        }


        // return $request->input();

    }


    public function show_login($from){
        if($from == 'o'){
            return view('front.user.login_with_mobile');
        }
        if($from == 'e'){
            return view('front.user.login_with_email');
        }
    }


    public function forget_password(Request $request){
        $validator = $request->validate([
            'mobile' => 'required|max:10|min:10',
        ]);

        $user = User::where('mobile',$request->mobile)->first();

        if(isset($user->id)){
            $user_id = $user->id;

            $otp = rand(111111,999999);
            $message = "OTP is $otp";
            
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
                return redirect('otp/f/'.$user_id);
            }else{
                Session::flash('message', 'OTP Send Fail! Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return redirect('otp/f/'.$user_id);
            }

        }else{
            Session::flash('message', 'User Not Register Yet, Please Register First!');
            Session::flash('class', 'alert-danger');
            return redirect('forget-password');
        }
    }



    /**========================================================================================= */
    /**============================================= API Code ================================== */
    /**========================================================================================= */


    public function login_with_email_api(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password'  =>  'required:min:6'
        ]);
        
        if($validator->fails()){
            $respose = [
                'status'    =>  "Failed",
                'message'   =>  $validator->errors()
            ];
            return response()->json($respose,401);
        }

        $email = $request->email;
        $password = $request->password;

        $user = User::where('email',$email)->first();

        if(isset($user->id)){

            if(Hash::check($password, $user->password)){

                $token =  $user->createToken('WeddingByte')->plainTextToken;

                $respose = [
                    'status'    =>  "Success",
                    'message'   =>  "Login to Dashboard Successful!",
                    'token'     =>  $token
                ];
                return response()->json($respose,200);
            }else{
                $respose = [
                    'status'    =>  "Failed",
                    'message'   =>  "Incorrect Password!"
                ];
                return response()->json($respose,401);
            }

        }else{
            $respose = [
                'status'    =>  "Failed",
                'message'   =>  "Email ID is not Registred with US!"
            ];
            return response()->json($respose,401);
        }

    }

    public function login_with_otp_api(Request $request){
       
        $validator = Validator::make($request->all(),[
            'mobile' => 'required|max:10|min:10',
        ]);

        if($validator->fails()){
            $respose = [
                'status'    =>  "Failed",
                'message'   =>  $validator->errors()
            ];
            return response()->json($respose,401);
        }

        $user = User::where('mobile',$request->mobile)->first();

        if(isset($user->id)){
            // $token =  $user->createToken('WeddingByte')->plainTextToken;
            $user_id = $user->id;

            $otp = rand(111111,999999);
            $message = "Your One Time Password for WeddingByte.com account is $otp. Plase do not share this OTP with anyone.\nThanks";
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
                $respose = [
                    'status'    =>  "Success",
                    'message'   =>  "OTP Send Successful to Your Mobile Number!",
                    'otp'       =>  $otp,
                    'mobile'    =>  $request->mobile,
                    'user_id'   =>  $user_id
                ];
                return response()->json($respose,200);
            }else{
                $respose = [
                    'status'    =>  "Failed",
                    'message'   =>  "OTP Send Fail! Somthing Went Wrong!"
                ];
                return response()->json($respose,401);
            }

        }else{
            $respose = [
                'status'    =>  "Failed",
                'message'   =>  "User Not Register Yet, Please Register First!"
            ];
            return response()->json($respose,401);
        }
        

    }


}
