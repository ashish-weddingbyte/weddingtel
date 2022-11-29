<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Otp;
use otp_helper;
use Validator;


class login extends Controller
{
    /**====================== Bride/Groom code start here ============================ */
    public function user_login(Request $request){
        $login_type = $request->input('login-type');

        // login with otp
        if($login_type  === 'o'){
            $validator = $request->validate([
                'mobile' => 'required|max:10|min:10',
            ]);

            $user = User::where('mobile',$request->mobile)->first();

            if(isset($user->id)){

                if($user->user_type == 'user'){
                    $user_id = $user->id;

                    $otp = rand(111111,999999);
                    $message = "Your One Time Password for WeddingByte.com account is $otp. Please do not share this OTP with anyone.\nThanks";
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
                    Session::flash('message', 'Mobile Number Register as a Vendor, Please login as a Vendor!');
                    Session::flash('class', 'alert-danger');
                    return redirect('vendor-login');
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
                'password'  =>  'required|min:6'
            ]);

            $email = $request->email;
            $password = $request->password;

            $user = User::where('email',$email)->where('user_type','user')->first();

            if(isset($user->id)){
  
                if(Hash::check($password, $user->password)){

                    if($user->status == "1"){
                        Session::put('name', $user->name);
                        Session::put('email', $user->email);
                        Session::put('user_id', $user->id);
                        Session::put('user_type', $user->user_type);

                        Session::flash('message', 'Login to Dashboard Successful!');
                        Session::flash('class', 'alert-success');
                        return redirect("/tools/dashboard");
                    }else{
                        Session::flash('message', 'Your Account Is Not Active!');
                        Session::flash('class', 'alert-danger');
                        return redirect('/login/e');
                    }

                    
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

        $user = User::where('mobile',$request->mobile)->where('user_type','user')->first();

        if(isset($user->id)){
            $user_id = $user->id;

            $otp = rand(111111,999999);
            $message = "Your One Time Password for WeddingByte.com Account is $otp. Please do not share this OTP with anyone.\nThanks";
            
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

/**============================ Bride/Groom code ends here ============================== */


/**============================== Vendor code start here =============================== */

    public function show_vendor_login($from){
        if($from == 'o'){
            return view('front.vendor.login_with_mobile');
        }
        if($from == 'e'){
            return view('front.vendor.login_with_email');
        }
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

                if($user->user_type == 'vendor'){

                    $user_id = $user->id;

                    $otp = rand(111111,999999);
                    $message = "Your One Time Password for WeddingByte.com Vendor Account is $otp";
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
                    Session::flash('message', 'Mobile Number Register as a Bride/Groom, Please login as a Bride/Groom.');
                    Session::flash('class', 'alert-danger');
                    return redirect('login');
                }

            }else{
                Session::flash('message', 'Vendor Not Register Yet, Please Register First!');
                Session::flash('class', 'alert-danger');
                return redirect('vendor-register');
            }

        }
        
        // login with email
        if($login_type === 'e'){
            $validator = $request->validate([
                'email' => 'required|email',
                'password'  =>  'required|min:6'
            ]);

            
            $email = $request->email;
            $password = $request->password;

            $user = User::where('email',$email)->where('user_type','vendor')->first();

            if(isset($user->id)){

                if(Hash::check($password, $user->password)){

                    if($user->status == '1'){
                        Session::put('name', $user->name);
                        Session::put('email', $user->email);
                        Session::put('user_id', $user->id);
                        Session::put('user_type', $user->user_type);
                        Session::put('category_id', $user->category_id);

                        Session::flash('message', 'Login to Dashboard Successful!');
                        Session::flash('class', 'alert-success');
                        return redirect("/vendor/dashboard");
                    }else{
                        Session::flash('message', 'Your Account Is Not Active!');
                        Session::flash('class', 'alert-danger');
                        return redirect('/vendor-login/e');
                    }
                    
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

    public function vendor_forget_password(Request $request){
        $validator = $request->validate([
            'mobile' => 'required|max:10|min:10',
        ]);

        $user = User::where('mobile',$request->mobile)->where('user_type','vendor')->first();

        if(isset($user->id)){
            $user_id = $user->id;

            $otp = rand(111111,999999);
            $message = "Your One Time Password for WeddingByte.com Vendor Account is $otp. Please do not share this OTP with anyone.\nThanks";
            
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
                return redirect('vendor-otp/f/'.$user_id);
            }else{
                Session::flash('message', 'OTP Send Fail! Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return redirect('vendor-otp/f/'.$user_id);
            }

        }else{
            Session::flash('message', 'User Not Register Yet, Please Register First!');
            Session::flash('class', 'alert-danger');
            return redirect('vendor-forget-password');
        }
    }

/**============================== Vendor code Ends here =================================== */



/**============================== Admin Code Start here =================================== */

    public function admin_login(Request $request){

        $validator = $request->validate([
            'email' => 'required|email',
            'password'  =>  'required|min:6'
        ]);

        
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email',$email)->where('user_type','admin')->first();

        if(isset($user->id)){

            if(Hash::check($password, $user->password)){
                Session::put('name', $user->name);
                Session::put('email', $user->email);
                Session::put('user_id', $user->id);
                Session::put('user_type', $user->user_type);

                Session::flash('message', 'Login to Dashboard Successful!');
                Session::flash('class', 'alert-danger');
                return redirect("/byte/dashboard");
            }else{
                Session::flash('message', 'Incorrect Password!');
                Session::flash('class', 'alert-danger');
                return redirect('/byte');
            }

        }else{
            Session::flash('message', 'Email ID is not Registred with US!');
            Session::flash('class', 'alert-danger');
            return redirect('/byte');
        }

    }



/**============================== Admin Code Ends here =================================== */

}
