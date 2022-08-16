<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Otp;
use App\Models\UserDetails;
use otp_helper;
use Validator;

class UserApiController extends Controller
{
    // api for register.
    public function register(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|unique:users,email',
            'password'  =>'required|min:6',
            'mobile' => 'required|max:10|min:10|unique:users,mobile',
            'city'  =>  'required',
            'event' =>  'required|date',
        ]);

        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'   =>  "Failed",
                'errors'   =>  $validator->errors()
            ];
            return response()->json($respose,401);
        }
        
        $user = User::create([
            'name'  =>  $request->name,
            'email' =>  $request->email,
            'password'  =>  Hash::make($request->password),
            'mobile'    =>  $request->mobile,
            'user'  =>  '0',
            'user_type' =>  'user'
        ]);
        
        $token =  $user->createToken('WeddingByte')->plainTextToken;

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

        return response()->json([
            'status'    =>  true,
            'message' => "User registered successfully",
            'token_type' => 'Bearer',
            'access_token' => $token
        ]);
    }

    //  api for login with email
    public function login_with_email(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password'  =>  'required:min:6'
        ]);
        
        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'   =>  'Failed',
                'errors'    =>  $validator->errors()
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

        $user = User::where('email',$email)->first();

        $token = $user->createToken('WeddingByte')->plainTextToken;
        $respose = [
            'status'    =>  true,
            'message'   =>  "Login Successfully!",
            'token_type' => 'Bearer',
            'token'     =>  $token
        ];
        return response()->json($respose,200);
    }

    // api for login with otp
    public function login_with_otp_api(Request $request){
       
        $validator = Validator::make($request->all(),[
            'mobile' => 'required|max:10|min:10',
        ]);

        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'   =>  'Failed',
                'errors'    =>  $validator->errors()
            ];
            return response()->json($respose,401);
        }

        $user = User::where('mobile',$request->mobile)->first();

        if(isset($user->id)){

            $token =  $user->createToken('WeddingByte')->plainTextToken;

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
                    'status'    =>  true,
                    'message'   =>  "OTP Send Successful to Your Mobile Number!",
                    'mobile'    =>  $request->mobile,
                    'token_type'=> 'Bearer',
                    'token'     =>  $token
                ];
                return response()->json($respose,200);
            }else{
                $respose = [
                    'status'    =>  false,
                    'message'   =>  "Failed",
                    'errors'    =>  'OTP Send Fail! Somthing Went Wrong!'
                ];
                return response()->json($respose,401);
            }

        }else{
            $respose = [
                'status'    =>  false,
                'message'   =>  "Failed",
                'errors'    =>  'User Not Register Yet, Please Register First!'
            ];
            return response()->json($respose,401);
        }
        
    }

    // Api with token
    // api for verify otp
    public function verify_otp_api(Request $request){

        $validator = Validator::make($request->all(),[
            'otp' => 'required|max:6|min:6',
        ]);


        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'   =>  'Failed',
                'errors'    =>  $validator->errors()
            ];
            return response()->json($respose,401);
        }
        $otp = $request->otp;

        $user_id =  Auth::id();
    
        $otp_details = Otp::where('user_id',$user_id)->first();

        if($otp_details){

            if($otp_details->status == '0'){
                
                $respose = [
                    'status'    =>  false,
                    'message'   =>  "Failed",
                    'errors'    =>  'OTP is Expired!'
                ];
                return response()->json($respose,401);

            }else{
                // otp verified succesfully
                if($otp == $otp_details->otp){

                    // mark mobile verified
                    $user_details = UserDetail::where('user_id',$user_id)->first();
                    $user_details->is_mobile_verified = '1';
                    $user_details->save();

                    Session::flash('message', 'Login to Dashboard Successful!');
                    $respose = [
                        'status'    =>  true,
                        'message'   =>  "Login to Dashboard Successful!",
                    ];
                    return response()->json($respose,200);
                    
                }else{
                    $respose = [
                        'status'    =>  true,
                        'message'   =>  'Failed',
                        'errors'    =>  'OTP is Invalid!'
                    ];
                    return response()->json($respose,401);
                }
            }
        }

    }

    public function profile(){
        return Auth::user();
    }
    
    

}
