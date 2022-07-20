<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\Otp;
use otp_helper;


class UserController extends Controller
{

    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password'  =>'required:min:6',
            'mobile' => 'required|max:10|min:10|unique:users,mobile',
            'city'  =>  'required|not_in:0',
            'event' =>  'required|date',
        ]);
        
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make(request('password'));
        $user->mobile = $request->input('mobile');
        $user->status = '0';
        $user->user_type = 'user';

        if ($user->save()) {
            $lastId = $user->id;

            $user_details = new UserDetail;
            $user_details->user_id = $lastId;
            $user_details->event = date('Y-m-d',strtotime($request->input('event')));
            $user_details->city = $request = $request->input('city');
            $user_details->save();


            $otp = rand(111111,999999);
            $message = "OTP is $otp";


            otp_helper::send_otp($user->mobile,$message);

            // send_otp($otp,$message);

            $otp_model = new Otp;
            $otp_model->user_id = $lastId;
            $otp_model->otp = $otp;
            $otp_model->status = '1';
            
            $otp_model->save();

            Session::flash('message', 'User Register Successfully! Enter OTP to verify Mobile Number.');
	        Session::flash('class', 'alert-success');

            return redirect('otp/r/'.$lastId);

        }else{
            Session::flash('message', 'Somthing Went Wrong!');
            Session::flash('class', 'alert-danger');
            return redirect('register');
        }
    }


    public function otp(){
        return view('front.verify_otp');
    }


    public function verify_otp(Request $request){
        $request->validate([
            'otp' => 'required|max:6|min:6'
        ]);
        $from = $request->input('from');
        $otp = $request->input('otp');
        $user_id = $request->input('user_id');
    
        $otp_details = Otp::where('user_id',$user_id)->first();


        if($otp_details->status == '0'){
            Session::flash('message', 'OTP is Expired!');
            Session::flash('class', 'alert-danger');
            return redirect("otp/$from/$user_id");
        }else{
            // otp verified succesfully
            if($otp == $otp_details->otp){

                $user_details = User::find($user_id);

                Session::put('name', $user_details->name);
                Session::put('email', $user_details->email);
                Session::put('user_id', $user_id);

                
                //expire otp after register successfully
                $otp_details->status = '0';
                $otp_details->save();

                Session::flash('message', 'Login to Dashboard Successful!');
                Session::flash('class', 'alert-danger');
                return redirect("/dashboard");

            }else{
                Session::flash('message', 'OTP is Invalid!');
                Session::flash('class', 'alert-danger');
                return redirect("otp/$from/$user_id");
            }
        }

    }


    
}
