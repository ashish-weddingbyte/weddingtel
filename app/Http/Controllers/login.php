<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\Otp;
use otp_helper;


class login extends Controller
{
    
    public function user_login(Request $request){
        $login_type = $request->input('login-type');

        // login with otp
        if($login_type  === 'o'){
            $validator = $request->validate([
                'mobile' => 'required|max:10|min:10',
            ]);

            $user = User::where('mobile',$request->input('mobile'))->first();

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
                    return redirect('otp/l/'.$user_id);
                }else{
                    Session::flash('message', 'OPT Send Fail! Somthing Went Wrong!');
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
                'email' => 'required|email:rfc,dns',
                'password'  =>  'required:min:6'
            ]);

            $email = $request->input('email');
            $password = Hash::make(request('password'));

            $user = User::where('email',$email)->first();

            if(isset($user->id)){

                if($password === $user->password){
                    Session::put('name', $user->name);
                    Session::put('email', $user->email);
                    Session::put('user_id', $user->id);


                    Session::flash('message', 'Login to Dashboard Successful!');
                    Session::flash('class', 'alert-danger');
                    return redirect("/dashboard");
                }else{
                    Session::flash('message', 'Incorrect Password!');
                    Session::flash('class', 'alert-danger');
                    return redirect('/login/e');
                }

            }else{
                Session::flash('message', 'Email ID is not Registred with US!');
                Session::flash('class', 'alert-danger');
                return redirect('register');
            }

        }


        // return $request->input();

    }


    public function show_login($from){
        if($from == 'o'){
            return view('front.login_with_mobile');
        }
        if($from == 'e'){
            return view('front.login_with_email');
        }
    }

}
