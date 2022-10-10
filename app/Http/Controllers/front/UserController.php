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
use App\Models\Budget;
use otp_helper;
use user_helper;
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
            'city'  =>  'required|not_in:0',
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
            $user_details->city_id  = $request->city;
            $user_details->save();


            // add default checklist
            user_helper::add_default_checklist($lastId);


            // add budget of user
            $budget = new Budget;
            $budget->user_id = $lastId;
            $budget->status = '0';
            $budget->save();


            $otp = rand(111111,999999);
            $message = "Your One Time Password for WeddingByte.com account is $otp. Plase do not share this OTP with anyone.Thanks";
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
            'city'  =>  'required|not_in:0',
        ]);
    
        
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->mobile = $request->input('mobile');
        $user->status = '1';
        $user->user_type = 'vendor';

        
        if ($user->save()) {
            $lastId = $user->id;

            // add vendor details
            $vendor_details = new VendorDetail;
            $vendor_details->user_id = $lastId;
            $vendor_details->category_id = $request->category;
            $vendor_details->city_id  = $request->city;
            $vendor_details->cancel_policy = "Booking Amount Non Refundable.";
            
            switch($request->category){
                case('1'):
                    $vendor_details->service_offered = 'The bouquet of services offered by the makeup artist  , makes them  the one stop solution . they  provide the following beauty services Bridal Makeup , Wedding Makeup AIRBRUSH BRIDAL MAKEUP , GUEST/FAMILY MAKEUP Indian bridal makeup  Engagement Makeup  Party Makeup HD Makeup Hair Styling ';
                    $vendor_details->description = 'We  are professional makeup artists. Bridal look  is crafted by understanding the Bride’s skin type, texture and preference and we creates a look that is seamless and best suited for the occasion.  When you look beautiful , you feel beautiful.
                    Keeping in mind that all eyes are on the bride  to be on her big day. We are known for the personal attention and the focus on the detailing for the perfect look of the bride. It will be our absolute pleasure to assist you in  the best days of your life. 
                    Give  us the privilege to for your Big day and we promise to make every moment special for you! 
                    # Bridal Makeup Artist , # bridal makeup , # wedding makeup, # Engagement Makeup , # wedding makeup artist , # bridal hair and makeup , # best bridal makeup';
                    
                break;

                case('2'):
                    $vendor_details->service_offered = 'The bouquet of services offered by the Banquet Hall , makes them the one stop solution for your wedding . they provide the following beauty services BANQUET HALL CATERING SERVICES VENUE DECORATION';
                    $vendor_details->description = 'The venue provides sizable luxury of space. Our team of highly skilled and professional crew  members allow us to serve all our guests with impeccable level of hospitality. This venue is the Best place for your functions.
                    It will be our absolute pleasure to assist you in the best days of your life.
                    Give us the privilege for your Big day and we promise to make every moment special for you!
                    # wedding venue , # banquet hall , # outdoor wedding venues , # wedding reception venues , #wedding hall';
                    
                break;
                case('3'):
                    $vendor_details->service_offered = 'They offers a plethora of wedding photography services like: Wedding videography  Save the Date Videos Wedding Films Teaser Videos Still Photography Pre-wedding shoots  CANDID PHOTOGRAPHY  TRADITIONAL PHOTOGRAPHY  CINEMATIC VIDEOGRAPHY';
                    $vendor_details->description = 'We are among the best photographers and videographers in the city. Your wedding pictures will be a treasure that you will carry forward in life and will talk about it in your once-upon-a-time stories as the beginning of your beautiful fairytale life.
                    We make photography fun and offbeat memories for the Wedding Couple.
                    We have a team of passionate, comforting and well-behaved people. Our dedicated and hardworking team works on your poses and expressions as well , to guide you through the photo shoot.
                    We are giving you the best services best coverage quality, the best album designed to your specifications
                    It will be our absolute pleasure to assist you in the best days of your life.
                    Give us the privilege to for your Big day and we promise to make every moment special for you!
                    # wedding photographer, # wedding photos, # wedding photo shoot,# pre wedding photography , #pre wedding photos, # marriage photography';
                break;
                case('4'):
                    $vendor_details->service_offered = 'They have a wide range of outfit options available for every bride.  You will find the most beautiful and eye-catching attire, with a touch of class and elegance. For the biggest event of your life you need something that truly is an extension of your lifestyle and personality Bridal lehengas Anarkalis Sarees Indo Western Outfits  Suits';
                    $vendor_details->description = 'They specialise in designing wedding and ethnic wear outfits in the most budget-friendly way. Besides stitching the outfits from scratch, they also have a range of ready to purchase outfits to choose from. From heavily embroidered to simple yet classy outfits, they can make anything for you based on your style.
                    We are professional artists. When you look beautiful,
                    you feel beautiful. Keeping in mind that all eyes are on the bride to be on her big day. We are known for the personal attention and the focus on the detailing for the perfect look of the bride. It will be our absolute pleasure to assist you in the best days of your life.
                    Give us the privilege for your Big day and we promise to make every moment special for you! 
                    # bridal designer, # bridal gowns , # bridal saree , # designer wedding dresses , # wedding gown';
                break;
                case('5'):
                    $vendor_details->service_offered = 'BollyHop,  Folk  Hip-Hop,   Tollywood,  Garba,  Poping';
                    $vendor_details->description = 'We are  professional choreographer , among the very best who has been doing wedding choreography for very long time now.
                    We specialise in various dance forms and are willing to choreograph your all wedding and pre-wedding functions and shoots.
                    We are known for the personal attention and the focus on the detailing.
                    It will be our absolute pleasure to assist you in  the best days of your life.
                    Give  us the privilege to for your Big day and we promise to make every moment special for you!
                    # choreographer , # wedding choreographer, # wedding dance choreography , # sangeet choreography, # surprise wedding dance choreography';
                break;
                case('6'):
                    $vendor_details->service_offered = 'Traditional Mehendi  Bridal Mehendi Arabic Mehendi Fusion Mehendi  Pakistani Mehendi';
                    $vendor_details->description = 'Mehandi Artist is among best mehandi service provider in the city. We only high-quality henna so that you get the deepest red impression that you have always dreamt of. We have great artists to provide you with friendly services, and affordable packages to meet all your demands and requirements.
                    We  are professional  artists. Bridal look  is crafted by understanding the Bride’s preference and we creates a look that is seamless and best suited for the occasion.  When you look beautiful , you feel beautiful.
                    Keeping in mind that all eyes are on the bride  to be on her big day. We are known for the personal attention and the focus on the detailing for the perfect look of the bride. It will be our absolute pleasure to assist you in  the best days of your life.
                    Give  us the privilege to for your Big day and we promise to make every moment special for you!
                    # bridal mehandi , # bridal mehndi, # bridal mehndi design, # dulhan mehndi design , # bridal mehendi design  , # bridal mehandi design ';
                break;
                case('7'):
                    $vendor_details->service_offered = 'With us , arranging an event is totally stress-free as our package usually includes - Wedding Planning Services  Wedding Decoration Entertainment Planning   Venue Booking Catering In-House Decorations Travel and Accommodations Logistics  Wedding day coordination  Invitations Guest management  Music and entertainment and lots more. Everything  can be customized as per your needs and budget.';
                    $vendor_details->description = 'We are boutique wedding planner and decor designers known for fabulous weddings. We take care of the tiniest details and make sure the family is stress free on the day.
                    We offer a personal and flexible wedding planning services.
                    The recommend, hire and manage the right people, products, services and spaces that will bring your dream day to reality.
                    From small intimate gatherings to large and lavish affairs, wedding is unique.
                    We will be there to help you out on your wedding day so you can relax and enjoy an outstanding celebration managed and designed to perfection.
                    It will be our absolute pleasure to assist you in the best days of your life.
                    Give us the privilege to for your Big day and we promise to make every moment special for you!
                    # wedding planning , # wedding coordinator , # the wedding planners , # destination wedding planner, # wedding event planner , # wedding event management , # wedding organiser';
                break;
                case('8'):
                    $vendor_details->service_offered = 'Boxed Invitations, Funky & Offbeat Invitations,   Modern Invites,  Traditional Invitations ';
                    $vendor_details->description = 'We provide customised single page invitation to multi-invite cards with jackets or envelopes. 
                    We provide creative customised  invitations to weddings. 
                    It will be our absolute pleasure to assist you in  the best days of your life. 
                    Give  us the privilege to for your Big day and we promise to make every moment special for you!
                    # wedding invitations , # wedding card , # invitation card , # wedding invitation card , # marriage invitation card, # marriage invitation, # marriage card';
                break;

                default:
                break;
            }
            $vendor_details->save();

            $otp = rand(111111,999999);
            $message = "Your One Time Password for WeddingByte.com Vendor Account is $otp. Plase do not share this OTP with anyone.Thanks";
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
