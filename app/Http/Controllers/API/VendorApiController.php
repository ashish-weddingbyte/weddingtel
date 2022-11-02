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
use App\Models\VendorDetail;
use App\Models\Otp;
use App\Models\PaymentHistory;
use App\Models\LeadPaidVendor;
use App\Models\PositionPaidVendor;
use App\Models\Wishlist;
use App\Models\Review;
use App\Models\Leads;
use App\Models\LeadViewStatus;
use App\Models\Query;
use App\Models\LeadPlan;
use App\Models\SocialLink;
use App\Models\MediaGallery;
use Carbon\Carbon;
use otp_helper;
use vendor_helper;
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
                'message'   =>  $validator->errors()->first()
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
        

        return response()->json([
            'status'    =>  true,
            'message' => "Vendor registered successfully",
            'token_type' => 'Bearer',
            'access_token' => $token
        ],200);
    }

    // api for login with otp
    public function vendor_login_with_otp_api(Request $request){
       
        $validator = Validator::make($request->all(),[
            'mobile' => 'required|max:10|min:10',
        ]);

        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'   =>  $validator->errors()->first()
            ];
            return response()->json($respose,422);
        }

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
                $respose = [
                    'status'    =>  true,
                    'message'   =>  "OTP Send Successful to Your Mobile Number!",
                    'mobile'    =>  $request->mobile,
                    'user_id'   =>  $user_id
                ];
                return response()->json($respose,200);
            }else{
                $respose = [
                    'status'    =>  false,
                    'message'    =>  'OTP Send Fail! Somthing Went Wrong!'
                ];
                return response()->json($respose,422);
            }

        }else{
            $respose = [
                'status'    =>  false,
                'message'    =>  'Vendor Not Register Yet, Please Register First!'
            ];
            return response()->json($respose,422);
        }
        
    }

    public function vendor_verify_otp_api(Request $request){

        $validator = Validator::make($request->all(),[
            'otp' => 'required|max:6|min:6',
            'user_id'   =>  'required'
        ]);


        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'   =>  $validator->errors()->first()
            ];
            return response()->json($respose,422);
        }
        $otp = $request->otp;

        $user_id =  $request->user_id;
    
        $otp_details = Otp::where('user_id',$user_id)->first();
        

        if($otp_details){

            if($otp_details->status == '0'){
                
                $respose = [
                    'status'    =>  false,
                    'message'    =>  'OTP is Expired!'
                ];
                return response()->json($respose,422);

            }else{
                // otp verified succesfully
                if($otp == $otp_details->otp){

                    $user = User::find($user_id);
                    $token =  $user->createToken('WeddingByte')->plainTextToken;

                    // mark mobile verified
                    // $user_details = UserDetail::where('user_id',$user_id)->first();
                    // $user_details->is_mobile_verified = '1';
                    // $user_details->save();

                    // Session::flash('message', 'Login to Dashboard Successful!');
                    $respose = [
                        'status'    =>  true,
                        'message'   =>  "Login to Dashboard Successful!",
                        'token_type'=> 'Bearer',
                        'token'     =>  $token
                    ];
                    return response()->json($respose,200);
                    
                }else{
                    $respose = [
                        'status'    =>  false,
                        'message'    =>  'OTP is Invalid!'
                    ];
                    return response()->json($respose,422);
                }
            }
        }else{
            $respose = [
                'status'    =>  false,
                'message'    =>  'Somthing Went Wrong in OTP.'
            ];
            return response()->json($respose,422);
        }

    }

    public function vendor_login_with_email(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password'  =>  'required|min:6'
        ]);
        
        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'    =>  $validator->errors()->first()
            ];
            return response()->json($respose,422);
        }

        $attempt = Auth::attempt([
            'email' =>  $request->email,
            'password'  =>  $request->password,
            'user_type' =>  'vendor',
            // 'status'    =>  '1'
        ]);

        if (!$attempt) {
            $respose = [
                'status'    =>  false,
                'message'   =>   'Invalid login details!'
            ];
            return response()->json($respose,422);
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

    public function vendor_dashboard(){
        $user_id = Auth::id();

        if($user_id){

            $data['details'] = VendorDetail::where('user_id',$user_id)->first();
            $data['leads'] = $paid = LeadPaidVendor::where('user_id',$user_id)
                                            ->where('is_active','1')
                                            ->orderBy('id','desc')
                                            ->first();

            $data['position'] = PositionPaidVendor::where('user_id',$user_id)
                                            ->where('is_active','1')
                                            ->first();
            
            if(!empty($paid)){                                
                $end_date = new Carbon($paid->end_at);
                $now = new Carbon( date('Y-m-d') );
                $data['plan_expire_days'] = $end_date->diffInDays($now);
            }

            $respose = [
                'status'    =>  true,
                'message'   =>  "Get Data Successfully!",
                'data'      =>  $data,
            ];
            return response()->json($respose,200);
            
        }else{
            $respose = [
                'status'    =>  false,
                'message'    =>  'Token Expired or Unauthorized User!'
            ];
            return response()->json($respose,422);
        }
    }

    public function plans(){
        $user_id = Auth::id();

        if($user_id){

            $data['vendor_plan'] = $paid = LeadPaidVendor::where('user_id',$user_id)
                                            ->where('is_active','1')
                                            ->orderBy('id','desc')
                                            ->first();

            $vendor = VendorDetail::where('user_id',$user_id)->first();

            $data['plans']  = LeadPlan::where('category_id',$vendor->category_id)->get();

            // $data['cities'] = City::orderBy('name','asc')->get();

            $respose = [
                'status'    =>  true,
                'message'   =>  "Get Data Successfully!",
                'data'      =>  $data,
            ];
            return response()->json($respose,200);
            
        }else{
            $respose = [
                'status'    =>  false,
                'message'    =>  'Token Expired or Unauthorized User!'
            ];
            return response()->json($respose,422);
        }
    }


    public function wishlist(){
        $user_id = Auth::id();

        if($user_id){

            $conditions = [
                ['users.user_type','user'],
                ['users.status','1'],
                ['wishlists.to_id',$user_id]
            ];
            
            $data['all_vendors']  = Wishlist::join('user_details','user_details.user_id','=','wishlists.from_id')
                                    ->join('users', 'users.id', '=', 'wishlists.from_id')
                                    ->join('cities','cities.id','=','user_details.city_id')
                                    ->where($conditions)
                                    ->select(['users.id','users.name','cities.name as city_name','wishlists.created_at','users.mobile'])
                                    ->orderBy('wishlists.id','desc')
                                    ->get();

            $respose = [
                'status'    =>  true,
                'message'   =>  "Get Data Successfully!",
                'data'      =>  $data,
            ];
            return response()->json($respose,200);
            
        }else{
            $respose = [
                'status'    =>  false,
                'message'    =>  'Token Expired or Unauthorized User!'
            ];
            return response()->json($respose,422);
        }
    }




    public function queries(){
        $user_id = Auth::id();

        if($user_id){

            $vendor_details = User::where('id',$user_id)->first();

            $data['query'] = Query::where('vendor_id',$user_id)->orderBy('id','desc')->get();

            $respose = [
                'status'    =>  true,
                'message'   =>  "Get Data Successfully!",
                'data'      =>  $data,
            ];
            return response()->json($respose,200);
            
        }else{
            $respose = [
                'status'    =>  false,
                'message'    =>  'Token Expired or Unauthorized User!'
            ];
            return response()->json($respose,422);
        }
    }


    public function payments(){
        $user_id = Auth::id();

        if($user_id){

            $data['payments'] = PaymentHistory::where('user_id',$user_id)->orderBy('id','desc')->get();

            $respose = [
                'status'    =>  true,
                'message'   =>  "Get Data Successfully!",
                'data'      =>  $data,
            ];
            return response()->json($respose,200);
            
        }else{
            $respose = [
                'status'    =>  false,
                'message'    =>  'Token Expired or Unauthorized User!'
            ];
            return response()->json($respose,422);
        }
    }

    public function review(){
        $user_id = Auth::id();

        if($user_id){

            $data['avg_count'] = Review::where('vendor_id',$user_id)->avg('rating');
            $data['total'] =   Review::where('vendor_id',$user_id)->count();
            $data['all_ratings'] = Review::where('vendor_id',$user_id)->where('status','1')->orderBy('id','desc')->get();

            $respose = [
                'status'    =>  true,
                'message'   =>  "Get Data Successfully!",
                'data'      =>  $data,
            ];
            return response()->json($respose,200);
            
        }else{
            $respose = [
                'status'    =>  false,
                'message'    =>  'Token Expired or Unauthorized User!'
            ];
            return response()->json($respose,422);
        }
    }

    public function leads(){
        $user_id = Auth::id();

        if($user_id){

            $vendor_details = VendorDetail::where('user_id',$user_id)->first();

            $data['leads'] = Leads::where('approved_status','1')
                                    ->where('category_id',$vendor_details->category_id)
                                    ->where('event_date','>', date('Y-m-d') )
                                    ->orderBy('id','desc')
                                    ->orderBy('updated_at','desc')
                                    ->get();

            $respose = [
                'status'    =>  true,
                'message'   =>  "Get Data Successfully!",
                'data'      =>  $data,
            ];
            return response()->json($respose,200);
            
        }else{
            $respose = [
                'status'    =>  false,
                'message'    =>  'Token Expired or Unauthorized User!'
            ];
            return response()->json($respose,422);
        }
    }

    public function unlock_leads(){
        $user_id = Auth::id();

        if($user_id){

            $vendor_details = VendorDetail::where('user_id',$user_id)->first();

            $data['leads'] = Leads::join('lead_view_status','lead_view_status.lead_id','leads.id')
                                    ->where('lead_view_status.user_id',$user_id)
                                    ->select(['leads.*','lead_view_status.created_at'])
                                    ->orderBy('leads.id','desc')
                                    ->get();

            $respose = [
                'status'    =>  true,
                'message'   =>  "Get Data Successfully!",
                'data'      =>  $data,
            ];
            return response()->json($respose,200);
            
        }else{
            $respose = [
                'status'    =>  false,
                'message'    =>  'Token Expired or Unauthorized User!'
            ];
            return response()->json($respose,422);
        }
    }


    public function view_lead(Request $request){

        $validator = Validator::make($request->all(),[
            'lead_id' => 'required',
        ]);

        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'    =>  $validator->errors()->first()
            ];
            return response()->json($respose,422);
        }


        $user_id = Auth::id();

        if($user_id){

            $lead_id = $request->lead_id;
            $paid_status = vendor_helper::is_lead_paid_vendor($user_id);

            $paid = LeadPaidVendor::where('user_id',$user_id)
                                    ->where('is_active','1')
                                    ->orderBy('id','desc')
                                    ->first();

            if($paid_status == '1'){
            
                if($paid->available_leads > 0){

                    $leads = Leads::where('id',$lead_id)->where('status','1')->first();
                    
                    if($leads->view_count < 8){

                        $leads->view_count = $leads->view_count + 1;
                        $leads->save();

                        

                        $paid->available_leads = $paid->available_leads - 1;
                        $paid->save();

                        $lead_view_status = new LeadViewStatus;
                        $lead_view_status->lead_id = $lead_id;
                        $lead_view_status->user_id = $user_id;
                        $lead_view_status->save();

                        $respose = [
                            'status'    =>  true,
                            'message'   =>  'Lead is Open,You Can View in the unlock Lead Tab.',
                            'lead_id'   =>  $lead_id
                        ];
                        return response()->json($respose,200);

                    }else{
                        $leads->status = '0';
                        $leads->save();

                        $respose = [
                            'status'    =>  false,
                            'message'   =>  'Lead is Deactive, You Can not open this Lead.'
                        ];
                        return response()->json($respose,422);
                    }



                }else{
                    $respose = [
                        'status'    =>  false,
                        'message'   =>  'All Leads are used, Please Purchase other plan to open lead.'
                    ];
                    return response()->json($respose,422);
                }

            }else{
                $respose = [
                    'status'    =>  false,
                    'message'   =>  'Please Purchase Lead Plan For View this Lead'
                ];
                return response()->json($respose,422);
            }

        }else{
            $respose = [
                'status'    =>  false,
                'message'    =>  'Token Expired or Unauthorized User!'
            ];
            return response()->json($respose,422);
        }
    }

    public function lead_details(Request $request){
        $validator = Validator::make($request->all(),[
            'lead_id' => 'required',
        ]);

        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'    =>  $validator->errors()->first()
            ];
            return response()->json($respose,422);
        }

        $user_id = Auth::id();

        if($user_id){
            $lead_id = $request->lead_id;
            $check_view_lead = LeadViewStatus::where('user_id',$user_id)->where('lead_id',$lead_id)->first();

            if(!empty($check_view_lead)){

                $data['leads'] = Leads::where('id',$lead_id)->first();
                // $data['view_status'] = LeadViewStatus::where('user_id',$user_id)->where('lead_id',$lead_id)->first();

               $respose = [
                    'status'    =>  true,
                    'message'   =>  "Get Data Successfully!",
                    'data'      =>  $data,
                ];
                return response()->json($respose,200);

            }else{
                $respose = [
                    'status'    =>  false,
                    'message'    =>  'Somthing Went Wrong!'
                ];
                return response()->json($respose,422);
            }

        }else{
            $respose = [
                'status'    =>  false,
                'message'    =>  'Token Expired or Unauthorized User!'
            ];
            return response()->json($respose,422);
        }
    }

    public function vendor_profile(){
        $user_id = Auth::id();

        if($user_id){

            $data['user']       =   User::find($user_id);
            $data['details']    =   VendorDetail::where('user_id',$user_id)->first();
            $data['social']     =   SocialLink::where('user_id',$user_id)->first();
            $data['gallery']    =   MediaGallery::where('user_id',$user_id)->where('user_type','vendor')->get();

            $respose = [
                'status'    =>  true,
                'message'   =>  "Get Data Successfully!",
                'data'      =>  $data,
            ];
            return response()->json($respose,200);
            
        }else{
            $respose = [
                'status'    =>  false,
                'message'    =>  'Token Expired or Unauthorized User!'
            ];
            return response()->json($respose,422);
        }
    }


    public function vendor_change_password(Request $request){
        $validator = Validator::make($request->all(),[
            'old_password'  =>'required|min:6',
            'new_password'  =>'required|min:6',
            'confirm_pasword'=>'required|min:6'
        ]);

        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'    =>  $validator->errors()->first()
            ];
            return response()->json($respose,422);
        }

        $user_id = Auth::id();

        if($user_id){

            $old_password = $request->old_password;
            $new_password = $request->new_password;
            $confirm_pasword = $request->confirm_pasword;

            if($new_password === $confirm_pasword){

                
                $user = User::find($user_id);

                if(Hash::check($old_password, $user->password)){

                    $user->password = Hash::make($new_password);
                    $user->save();

                    $respose = [
                        'status'    =>  true,
                        'message'   =>  "Password Reset Successfully!",
                    ];
                    return response()->json($respose,200);
                    
                }else{
                    $respose = [
                        'status'    =>  false,
                        'message'    =>  'Old Password is Incorrect!'
                    ];
                    return response()->json($respose,422);
                }

            }else{
                    $respose = [
                    'status'    =>  false,
                    'message'    =>  'Password Not Matched!'
                ];
                return response()->json($respose,422);
            }

        }else{
            $respose = [
                'status'    =>  false,
                'message'    =>  'Token Expired or Unauthorized User!'
            ];
            return response()->json($respose,422);
        }
    }


    public function social_media(Request $request){
        $user_id = Auth::id();

        if($user_id){

            $social_links = SocialLink::where('user_id',$user_id)->first();

            if(empty($social_links)){
                $social_links = new SocialLink;
                $social_links->user_id = $user_id;
                $social_links->save();
            }

            if($social_links){
                if($request->filled('facebook')){
                    $validator = Validator::make($request->all(),[
                        'facebook'  =>  'url'
                    ]);
                    if($validator->fails()){
                        $respose = [
                            'status'    =>  false,
                            'message'    =>  $validator->errors()->first()
                        ];
                        return response()->json($respose,422);
                    }
                    $social_links->facebook = $request->facebook;
                    $social_links->save();
                }
                if($request->filled('twitter')){
                    $validator = Validator::make($request->all(),[
                        'twitter'  =>  'url'
                    ]);
                    if($validator->fails()){
                        $respose = [
                            'status'    =>  false,
                            'message'    =>  $validator->errors()->first()
                        ];
                        return response()->json($respose,422);
                    }
                    $social_links->twitter = $request->twitter;
                    $social_links->save();
                }
                if($request->filled('instagram')){
                    $validator = Validator::make($request->all(),[
                        'instagram'  =>  'url'
                    ]);
                    if($validator->fails()){
                        $respose = [
                            'status'    =>  false,
                            'message'    =>  $validator->errors()->first()
                        ];
                        return response()->json($respose,422);
                    }
                    $social_links->instagram = $request->instagram;
                    $social_links->save();
                }
                if($request->filled('youtube')){
                    $validator = Validator::make($request->all(),[
                        'youtube'  =>  'url'
                    ]);
                    if($validator->fails()){
                        $respose = [
                            'status'    =>  false,
                            'message'    =>  $validator->errors()->first()
                        ];
                        return response()->json($respose,422);
                    }
                    $social_links->youtube = $request->youtube;
                    $social_links->save();
                }

                if($request->filled('website')){
                    $validator = Validator::make($request->all(),[
                        'website'  =>  'url'
                    ]);
                    if($validator->fails()){
                        $respose = [
                            'status'    =>  false,
                            'message'    =>  $validator->errors()->first()
                        ];
                        return response()->json($respose,422);
                    }
                    $social_links->website = $request->website;
                    $social_links->save();
                }

                $respose = [
                    'status'    =>  true,
                    'message'   =>  "Social Media Links Saved.",
                ];
                return response()->json($respose,200);
            }else{
                $respose = [
                    'status'    =>  false,
                    'message'    =>  'Somthing Went Wrong!'
                ];
                return response()->json($respose,422);
            }

            
            
        }else{
            $respose = [
                'status'    =>  false,
                'message'    =>  'Token Expired or Unauthorized User!'
            ];
            return response()->json($respose,422);
        }
    }



    public function update_details(Request $request){

        $validator = Validator::make($request->all(),[
            'profile'  =>'image|mimes:jpg,png,jpeg|max:512',
        ]);

        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'    =>  $validator->errors()->first()
            ];
            return response()->json($respose,422);
        }        

        $user_id = Auth::id();

        if($user_id){

            if($request->filled('name')){
                $user = User::find($user_id);
                $user->name = $request->name;
                $user->save();
            }

            $detals = VendorDetail::where('user_id',$user_id)->first();

            if($request->filled('city')){
                $detals->city_id = $request->city;
                $detals->save();
            }

            if ($request->hasFile('profile')) {

                Storage::delete('public/upload/vendor/profile/'.$detals->profile_image);
                $image_name  =  $request->file('profile')->hashName();
                $detals->profile_image = $image_name;
                $request->file('profile')->storeAs('public/upload/vendor/profile',$image_name);
                $detals->save();
            }

            if($request->filled('gender')){
                $detals->gender = $request->gender;
                $detals->save();
            }

            if($request->filled('address')){
                $detals->address = $request->address;
                $detals->save();
            }

            $respose = [
                'status'    =>  true,
                'message'   =>  "Details Updated Successfully.",
            ];
            return response()->json($respose,200);
            
            
        }else{
            $respose = [
                'status'    =>  false,
                'message'    =>  'Token Expired or Unauthorized User!'
            ];
            return response()->json($respose,422);
        }
    }

    public function update_business_details(Request $request){    

        $user_id = Auth::id();

        if($user_id){

            $detals = VendorDetail::where('user_id',$user_id)->first();

            if($detals){

                if($request->filled('brandname')){
                    $detals->brandname = $request->brandname;
                    $detals->save();
                }

                if ($request->hasFile('featured_image')) {
                    $validator = Validator::make($request->all(),[
                        'featured_image'  =>'image|mimes:jpg,png,jpeg|max:512',
                    ]);
                    if($validator->fails()){
                        $respose = [
                            'status'    =>  false,
                            'message'    =>  $validator->errors()->first()
                        ];
                        return response()->json($respose,422);
                    } 
                    Storage::delete('public/upload/vendor/featured'.$detals->featured_image);
                    $image_name  =  $request->file('featured_image')->hashName();
                    $detals->featured_image = $image_name;
                    $request->file('featured_image')->storeAs('public/upload/vendor/featured',$image_name);
                    $detals->save();
                }


                if($request->filled('description')){
                    $detals->description = $request->description;
                    $detals->save();
                }

                if($request->filled('service_offered')){
                    $detals->service_offered = $request->service_offered;
                    $detals->save();
                }
                if($request->filled('business_details')){
                    $detals->business_offered = $request->business_details;
                    $detals->save();
                }
                if($request->filled('travelable')){
                    $validator = Validator::make($request->all(),[
                        'travelable'    =>  'not_in:NA'
                    ]);
                    if($validator->fails()){
                        $respose = [
                            'status'    =>  false,
                            'message'    =>  $validator->errors()->first()
                        ];
                        return response()->json($respose,422);
                    } 
                    $detals->is_travelable = $request->travelable;
                    $detals->save();
                }
                if($request->filled('cancel_policy')){
                    $detals->cancel_policy = $request->cancel_policy;
                    $detals->save();
                }

                
                if($request->filled('youtube')){
                    $validator = Validator::make($request->all(),[
                        'youtube'    =>  'url'
                    ]);
                    if($validator->fails()){
                        $respose = [
                            'status'    =>  false,
                            'message'    =>  $validator->errors()->first()
                        ];
                        return response()->json($respose,422);
                    } 
                    $detals->youtube = $request->youtube;
                    $detals->save();
                }
                if($request->filled('advance_payment')){
                    $validator = Validator::make($request->all(),[
                        'advance_payment'    =>  'not_in:0'
                    ]);
                    if($validator->fails()){
                        $respose = [
                            'status'    =>  false,
                            'message'    =>  $validator->errors()->first()
                        ];
                        return response()->json($respose,422);
                    } 
                    $detals->advance_payment = $request->advance_payment;
                    $detals->save();
                }
                

                $respose = [
                    'status'    =>  true,
                    'message'   =>  "Business Details Updated Successfully.",
                ];
                return response()->json($respose,200);

            }else{
                $respose = [
                    'status'    =>  false,
                    'message'   =>  "Somthing Went Wrong!",
                ];
                return response()->json($respose,422);
            }
            
            
        }else{
            $respose = [
                'status'    =>  false,
                'message'    =>  'Token Expired or Unauthorized User!'
            ];
            return response()->json($respose,422);
        }
    }


    public function gallery(Request $request){    

        $validator = Validator::make($request->all(),[
            'gallery' => 'required|max:512',
            'gallery.*' => 'image|mimes:jpg,png,jpeg|max:512'
        ]);

        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'    =>  $validator->errors()->first()
            ];
            return response()->json($respose,422);
        }

        $user_id = Auth::id();

        if($user_id){

            if($request->hasfile('gallery')){
                $images_count = count( $request->file('gallery') );
                
                if($images_count <= 6){
                    foreach($request->file('gallery') as $key => $file)
                    {
                        $image_name = $file->hashName();
                        $file->storeAs('public/upload/vendor/gallery',$image_name);

                        $media = new MediaGallery;
                        $media->user_id = Session::get('user_id');
                        $media->media_type = 'image';
                        $media->name = $image_name;
                        $media->status = '1';
                        $media->user_type = 'vendor';
                        $media->save();
                    }

                    $respose = [
                        'status'    =>  true,
                        'message'   =>  "Profile Gallery Update Successfully!",
                    ];
                    return response()->json($respose,200);
                }else{
                    $respose = [
                        'status'    =>  false,
                        'message'   =>  "Can not upload more than 6 images at once!",
                    ];
                    return response()->json($respose,422);
                }
            }else{
                $respose = [
                    'status'    =>  false,
                    'message'   =>  "Somthing Went Wrong!",
                ];
                return response()->json($respose,422);
            }
            
            
        }else{
            $respose = [
                'status'    =>  false,
                'message'    =>  'Token Expired or Unauthorized User!'
            ];
            return response()->json($respose,422);
        }
    }


    public function delete_gallery_image(Request $request){    

        $validator = Validator::make($request->all(),[
            'gallery_id'    =>  'required'
        ]);

        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'    =>  $validator->errors()->first()
            ];
            return response()->json($respose,422);
        }

        $user_id = Auth::id();

        if($user_id){

            $gallery_id = $request->gallery_id;

            $image = MediaGallery::find($gallery_id);

            if($image->delete()){
                Storage::delete('public/upload/vendor/gallery/'.$image->name);
                $respose = [
                    'status'    =>  true,
                    'message'   =>  "Gallery Image Delete Successfully!",
                ];
                return response()->json($respose,200);
            }else{
                $respose = [
                    'status'    =>  false,
                    'message'   =>  "Somthing Went Wrong!",
                ];
                return response()->json($respose,422);
            }
            
            
        }else{
            $respose = [
                'status'    =>  false,
                'message'    =>  'Token Expired or Unauthorized User!'
            ];
            return response()->json($respose,422);
        }
    }

}
