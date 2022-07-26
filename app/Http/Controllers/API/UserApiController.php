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
use App\Models\Checklist;
use App\Models\Guest;
use App\Models\Budget;
use App\Models\BudgetCategory;
use App\Models\BudgetExpense;
use App\Models\BudgetCategoryExpense;
use App\Models\Category;
use App\Models\City;
use App\Models\SocialLink;
use App\Models\RelationGroup;
use App\Models\MediaGallery;
use App\Models\Wishlist;
use App\Models\Review;
use App\Models\RealWedding;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Query;
use App\Models\Contact;
use otp_helper;
use user_helper;
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
            'event' =>  'required|date|after:today',
        ]);

        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'   =>  $validator->errors()->first()
            ];
            return response()->json($respose,422);
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
        $user_details->city_id  = $request->city;
        $user_details->save();


        // add default checklist
        user_helper::add_default_checklist($lastId);

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
        ],200);
    }

    //  api for login with email
    public function login_with_email(Request $request)
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
            'user_type' =>  'user',
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

    // api for login with otp
    public function login_with_otp_api(Request $request){
       
        $validator = Validator::make($request->all(),[
            'mobile' => 'required|max:10|min:10',
        ]);

        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'    =>  $validator->errors()->first()
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
                'message'    =>  'User Not Register Yet, Please Register First!'
            ];
            return response()->json($respose,422);
        }
        
    }

    public function verify_otp_api(Request $request){

        $validator = Validator::make($request->all(),[
            'otp' => 'required|max:6|min:6',
            'user_id'   =>  'required'
        ]);


        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'    =>  $validator->errors()->first()
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

    // Api with token

    public function user_data(){
        return Auth::user();
    }


    // Checklist API functions

    public function checklist_api(){

        $user_id = Auth::id();

        if($user_id){

            $default = checklist::where('user_id',$user_id)->orderBy('added_date', 'ASC')->get();
            // $added = checklist::where('user_id',$user_id)->where('type','added')->get()->toArray();
            
            $data['all_checklist_count'] = checklist::where('user_id', $user_id)->count();

            $data['all_done_checklist_count'] = checklist::where('user_id', $user_id)->where('status','0')->count();

            $data['checklist_done_perentage'] = round(  ($data['all_done_checklist_count'] / $data['all_checklist_count']) * 100  );

            $data['all_checklists'] = $default;
            
            $respose = [
                'status'    =>  true,
                'message'   =>  'Get Data Successfully!',
                'data'      =>  $data,
            ];
            return response()->json($respose,200);
        }else{
            $respose = [
                'status'    =>  false,
                'message'    =>  'Token Expired or Unauthorized User.'
            ];
            return response()->json($respose,422);
        }
        
    }

    public function add_checklist_api(Request $request){
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'date'  =>  'required'
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
            $checklist = new Checklist;
            $checklist->user_id = ($user_id)?$user_id:NULL;
            $checklist->type = 'added';
            $checklist->task = $request->title;
            $checklist->added_date = date('Y-m-d',strtotime($request->date));
            $checklist->save();

            $respose = [
                'status'    =>  true,
                'message'   =>  "Add Checklist Successfull!",
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


    public function edit_checklist_api(Request $request){
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'date'  =>  'required',
            'task_id'=>  'required'
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
            $checklist = Checklist::find($request->task_id);
            $checklist->type = 'edited';
            $checklist->task = $request->title;
            $checklist->added_date = date('Y-m-d',strtotime($request->date));
            $checklist->save();

            $respose = [
                'status'    =>  true,
                'message'   =>  "Edit Checklist Successfull!",
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

    public function delete_checklist_api(Request $request){
        $validator = Validator::make($request->all(),[
            'task_id'=>  'required'
        ]);

        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'   =>  'Failed',
                'errors'    =>  $validator->errors()->first()
            ];
            return response()->json($respose,422);
        }

        $user_id = Auth::id();
        if($user_id){

            Checklist::find($request->task_id)->delete();
            $respose = [
                'status'    =>  true,
                'message'   =>  "Checklist Delete Successfully!",
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

    public function status_of_checklist_api(Request $request){
        $validator = Validator::make($request->all(),[
            'id'   =>  'required',
            'status'    =>  'required'
        ]);
        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'   =>  'Failed',
                'errors'    =>  $validator->errors()->first()
            ];
            return response()->json($respose,422);
        }

        $id = $request->id;
        $status = $request->status;

        $user_id = Auth::id();
        if($user_id){

            $checklist = Checklist::find($id);
            if(!empty($checklist)){
                $checklist->status = ($status == '1')? '0' : '1' ;
                $checklist->save();

                $respose = [
                    'status'    =>  true,
                    'data'      =>  $checklist->status,
                    'message'   =>  "Checklist Status Change Successfully!",
                ];
                return response()->json($respose,200);
            }else{
                $respose = [
                    'status'    =>  false,
                    'message'    =>  'Checklist not Found!'
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


    // guestlist api
    public function guestlist_api(){

        $user_id = Auth::id();
        if($user_id){

            $data['guestlist'] = Guest::where('user_id',$user_id)->get();

            $data['total_guest'] = Guest::where('user_id',$user_id)->count();
            $data['confirm_guest'] = Guest::where('user_id',$user_id)->where('status','confirm')->count();
            $data['pending_guest'] = Guest::where('user_id',$user_id)->where('status','pending')->count();
            $data['cancel_guest'] = Guest::where('user_id',$user_id)->where('status','cancel')->count();
        
            $respose = [
                'status'    =>  true,
                'message'   =>  "Get Data Successfully!",
                'data'      =>  $data
            ];
            return response()->json($respose,200);
            
        }else{
            $respose = [
                'status'    =>  false,
                'message'   =>  'Unauthorized',
                'errors'    =>  'Token Expired or unauthorized User!'
            ];
            return response()->json($respose,422);
        }
    }

    public function add_guestlist_api(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'group'=>  'required'
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
            $name = $request->name;
            $group = $request->group;
            $mobile = $request->mobile;
            $no_of_guest = $request->no_of_guest;
            $comment = $request->comment;
            $address = $request->address;
            $status = $request->status;

            $guest = new Guest;
            $guest->name = $name;
            $guest->group_id = ($group)?$group:NULL;
            $guest->user_id = ($user_id)?$user_id:NULL;
            $guest->mobile = $mobile;
            $guest->no_of_guest = ($no_of_guest)?$no_of_guest:1;
            $guest->comment = $comment;
            $guest->address = $address;
            $guest->status = ($status)?$status:'pending';
            $guest->save();
            $respose = [
                'status'    =>  true,
                'message'   =>  "Guest Added Successfully!",
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

    public function edit_guestlist_api(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'group'=>  'required',
            'guest_id'  => 'required'
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
            $name = $request->name;
            $group = $request->group;
            $mobile = $request->mobile;
            $no_of_guest = $request->no_of_guest;
            $comment = $request->comment;
            $address = $request->address;
            $status = $request->status;
            $id = $request->guest_id;

            $guest = Guest::find($id);
            $guest->name = $name;
            $guest->group_id = $group;
            $guest->mobile = $mobile;
            $guest->no_of_guest = $no_of_guest;
            $guest->comment = $comment;
            $guest->address = $address;
            $guest->status = $status;
            $guest->save();

            $respose = [
                'status'    =>  true,
                'message'   =>  "Guest Edit Successfully!",
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

    public function delete_guestlist_api(Request $request){
        $validator = Validator::make($request->all(),[
            'guest_id'=>  'required'
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
            Guest::find($request->guest_id)->delete();
            $respose = [
                'status'    =>  true,
                'message'   =>  "Guest Delete Successfully!",
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


    
    // budget api
    public function budget_api(){
        $user_id = Auth::id();

        if($user_id){

            $data['budget'] = Budget::where('user_id', $user_id)->first();

            // $data['budget_categories'] = BudgetCategory::where('type','default')->orWhere('user_id',$user_id)->orderBy('id','desc')->get();

            $data['budget_categories'] = BudgetCategory::leftJoin('budget_category_expenses','budget_categories.id', '=', 'budget_category_expenses.budget_category_id')
                                        ->select(['budget_categories.*','budget_category_expenses.estimated_cost','budget_category_expenses.final_cost','budget_category_expenses.pending'])
                                        ->orderBy('budget_categories.id','desc')
                                        ->get();

            $data['buget_expense'] = BudgetExpense::where('user_id', $user_id)->get();
            $respose = [
                'status'    =>  true,
                'message'   =>  "Get Data Successfully!",
                'data'      =>  $data
            ];
            return response()->json($respose,200);
        }else{
            $respose = [
                'status'    =>  false,
                'message'   =>  'Unauthorized',
                'errors'    =>  'Token Expired or unauthorized User!'
            ];
            return response()->json($respose,422);
        }
    }



    public function add_budget_category_api(Request $request){
        $validator = Validator::make($request->all(),[
            'category_name' => 'required',
        ]);

        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'   =>  'Failed',
                'errors'    =>  $validator->errors()->first()
            ];
            return response()->json($respose,422);
        }

        $user_id = Auth::id();

        if($user_id){
            $budget_category = new BudgetCategory;
            $budget_category->user_id = $user_id;
            $budget_category->name = $request->category_name;
            $budget_category->type = 'added';
            $budget_category->icon = '<i class="fa fa-life-ring"></i>';
            $budget_category->status = '1';
            $budget_category->save();

            $lastCategoryId = $budget_category->id;
            $category_expense = new BudgetCategoryExpense;
            $category_expense->user_id = $user_id;
            $category_expense->budget_category_id = $lastCategoryId;
            $category_expense->estimated_cost = $request->estimated_cost?$request->estimated_cost:0;
            $category_expense->pending = 0;
            $category_expense->final_cost = 0;
            $category_expense->status = '1';
            $category_expense->save();
            
            $respose = [
                'status'    =>  true,
                'message'   =>  "Budget Category Added Successfully!",
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


    public function edit_budget_category_api(Request $request){
        $validator = Validator::make($request->all(),[
            'estimated_cost' => 'required',
            'category_id' => 'required',
        ]);

        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'    =>  $validator->errors()->first()
            ];
            return response()->json($respose,422);
        }

        $type = $request->type;
        $estimated_cost = $request->estimated_cost;
        $category_id = $request->category_id;
        $category_name = $request->category_name;

        $user_id = Auth::id();

        if($user_id){

            $budget_category = BudgetCategory::find($category_id);

            
            if($budget_category->type == 'added'){
                $budget_category->name = $category_name;
                $budget_category->save();
            }
            
            $category_expense = BudgetCategoryExpense::where('budget_category_id',$category_id)->first();

            if($category_expense){
                $category_expense->estimated_cost = $estimated_cost;
                $category_expense->save();
            }else{
                $category_expense =new BudgetCategoryExpense;
                $category_expense->user_id = $user_id;
                $category_expense->budget_category_id = $category_id;
                $category_expense->estimated_cost = $estimated_cost;
                $category_expense->final_cost = 0;
                $category_expense->pending = 0;
                $category_expense->status = '1';
                $category_expense->save();
            }
            
            $respose = [
                'status'    =>  true,
                'message'   =>  "Budget Category Edit Successfully!",
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

    public function delete_budget_category_api(Request $request){
        $validator = Validator::make($request->all(),[
            'category_id' => 'required',
        ]);

        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'    =>  $validator->errors()->first()
            ];
            return response()->json($respose,422);
        }
        
        $category_id = $request->category_id;
        
        $user_id = Auth::id();
        $budget_category = BudgetCategory::find($category_id);


        if($user_id){

            if($budget_category){
            
                if($budget_category->type == 'added'){

                    $budget_category->delete();
                    BudgetCategoryExpense::where('budget_category_id',$category_id)->delete();
                    BudgetExpense::where('budget_category_id',$category_id)->where('user_id',$user_id)->delete();
                }else{
                    BudgetCategoryExpense::where('budget_category_id',$category_id)->delete();
                    BudgetExpense::where('budget_category_id',$category_id)->where('user_id',$user_id)->delete();
                }
                user_helper::total_expense_of_user($user_id);
                $respose = [
                    'status'    =>  true,
                    'message'   =>  "Budget Category Delete Successfully!",
                ];
                return response()->json($respose,200);
            }else{
                $respose = [
                    'status'    =>  false,
                    'message'    =>  'Invalid Budget Category!'
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



    public function edit_estimated_cost_api(Request $request){
        $validator = Validator::make($request->all(),[
            'estimated_cost' => 'required',
            'budget_id'      => 'required'
        ]);

        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'    =>  $validator->errors()->first()
            ];
            return response()->json($respose,422);
        }
        $budget_id = $request->budget_id;
        $estimated_cost = $request->estimated_cost;

        $user_id = Auth::id();

        if($user_id){
            $final_cost_of_all_category = BudgetCategoryExpense::where('user_id',$user_id)->sum('final_cost');
            $total_pending_of_category =  BudgetCategoryExpense::where('user_id',$user_id)->sum('pending');

            $budget = Budget::find($budget_id);
            $budget->estimated_cost = $estimated_cost;
            $budget->final_cost = $final_cost_of_all_category;
            $budget->pending = $total_pending_of_category;
            $budget->status = '1';
            $budget->save();
            user_helper::total_expense_of_user($user_id);

            $respose = [
                'status'    =>  true,
                'message'   =>  "Budget Estimanted Cost Edit Successfully!",
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


    public function add_budget_expense_api(Request $request){
        $validator = Validator::make($request->all(),[
            'expense_name' => 'required',
            'estimated_cost' => 'required',
            'amount_paid' => 'required',
            'category_id'   =>  'required'
        ]);

        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'    =>  $validator->errors()->first()
            ];
            return response()->json($respose,422);
        }
        $pending_amount = $request->estimated_cost - $request->amount_paid;
        $user_id = Auth::id();
        
        $category_id = BudgetCategory::find($request->category_id);
        
        if($user_id){
            if($category_id){
                // indiviual expense 
                $budget_expense = new BudgetExpense;
                $budget_expense->user_id = $user_id;
                $budget_expense->budget_category_id = $request->category_id;
                $budget_expense->expense_name = $request->expense_name;
                $budget_expense->estimated_cost = $request->estimated_cost;
                $budget_expense->paid = $request->amount_paid;
                $budget_expense->pending = $pending_amount;
                $budget_expense->status = '1';
                $budget_expense->save();

                user_helper::total_expense_of_category($user_id,$request->category_id);
                user_helper::total_expense_of_user($user_id);

                $respose = [
                    'status'    =>  true,
                    'message'   =>  "Budget Expense Added Successfully!",
                ];
                return response()->json($respose,200);
            }else{
                $respose = [
                    'status'    =>  false,
                    'message'    =>  'Invalid Category'
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



    public function edit_budget_expense_api(Request $request){
        $validator = Validator::make($request->all(),[
            'expense_name' => 'required',
            'estimated_cost' => 'required',
            'amount_paid' => 'required',
            'expense_id'    =>  'required',
            'category_id'    =>  'required'
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
        
            $category_id = $request->category_id;
            $expense_id = $request->expense_id;
            $expense_name = $request->expense_name;
            $estimated_cost = $request->estimated_cost;
            $amount_paid = $request->amount_paid;
            $pending_amount = $estimated_cost - $amount_paid;
            
            $category_id = BudgetCategory::find($request->category_id);

            $budget_expense = BudgetExpense::find($expense_id);        
            
            if($budget_expense && $category_id){

                $budget_expense->expense_name = $expense_name;
                $budget_expense->estimated_cost = $estimated_cost;
                $budget_expense->paid = $amount_paid; 
                $budget_expense->pending = $pending_amount;
                $budget_expense->save();

                user_helper::total_expense_of_category($user_id,$request->category_id);
                user_helper::total_expense_of_user($user_id);
            

                $respose = [
                    'status'    =>  true,
                    'message'   =>  "Budget Expense Edit Successfully!",
                ];
                return response()->json($respose,200);

            }else{
                $respose = [
                    'status'    =>  false,
                    'message'    =>  'Category ID / Expence ID Invalid!'
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


    public function delete_budget_expense_api(Request $request){
        $validator = Validator::make($request->all(),[
            'expense_id' => 'required',
            'category_id' => 'required',
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
            $category_id = $request->category_id;
            $expense_id = $request->expense_id;
            
            $category_id = BudgetCategory::find($request->category_id);
            // indiviual expense 
            $budget_expense = BudgetExpense::find($expense_id);        
            
            if($budget_expense && $category_id){

                $budget_expense->delete();
                user_helper::total_expense_of_category($user_id,$request->category_id);
                user_helper::total_expense_of_user($user_id);

                $respose = [
                    'status'    =>  true,
                    'message'   =>  "Budget Expense Delete Successfully!",
                ];
                return response()->json($respose,200);
            }else{
                $respose = [
                    'status'    =>  false,
                    'message'    =>  'Category ID or Expence ID Invalid!'
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
    


    public function profile_api(){

        $user_id = Auth::id();
        
        if($user_id){
            $data['user'] = User::find($user_id);
            $data['details'] = UserDetail::where('user_id',$user_id)->first();
        
            $respose = [
                'status'    =>  true,
                'message'   =>  "Get Data Successfully!",
                'data'      =>  $data
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


    public function change_password_api(Request $request){
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
        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $confirm_pasword = $request->confirm_pasword;

        if($new_password === $confirm_pasword){

            $user_id = Auth::id();
            if($user_id){
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
                    'message'    =>  'Token Expired or Unauthorized User!'
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
    }


    public function update_details_api(Request $request){
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

            $detals = UserDetail::where('user_id',$user_id)->first();

            if($request->filled('city')){
                $detals->city_id = $request->city;
                $detals->save();
            }

            if ($request->hasFile('profile')) {

                Storage::delete('public/upload/user/profile/'.$detals->profile);
                $image_name  =  $request->file('profile')->getClientOriginalName();
                $detals->profile = $image_name;
                $request->file('profile')->storeAs('public/upload/user/profile',$image_name);
                $detals->save();
            }

            if($request->filled('type')){
                $detals->type = $request->type;
                $detals->save();
            }


            if($request->filled('partner_name')){
                $detals->partner_name = $request->partner_name;
                $detals->save();
            }

            $respose = [
                'status'    =>  true,
                'message'   =>  "Profile Update Successfully!",
            ];
            return response()->json($respose,200);
        }else{
            $respose = [
                'status'    =>  false,
                'message'    =>  'Token Expired or unauthorized User!'
            ];
            return response()->json($respose,422);
        }
        
    }

    public function wedding_info_api(Request $request){
        $validator = Validator::make($request->all(),[
            'profile'  =>'image|mimes:jpg,png,jpeg|max:1024',
            'partner_profile'  =>'image|mimes:jpg,png,jpeg|max:1024',
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

            $detals = UserDetail::where('user_id',$user_id)->first();

            if($request->filled('event')){
                $detals->event = date('Y-m-d',strtotime($request->event));
                $detals->save();
            }

            if ($request->hasFile('profile')) {

                $image_name  =  $request->file('profile')->getClientOriginalName();
                $detals->profile = $image_name;
                $request->file('profile')->storeAs('public/upload/user/profile',$image_name);
                $detals->save();
            }

            if ($request->hasFile('partner_profile')) {

                $image_name  =  $request->file('partner_profile')->getClientOriginalName();
                $detals->partner_profile = $image_name;
                $request->file('partner_profile')->storeAs('public/upload/user/profile',$image_name);
                $detals->save();
            }


            if($request->filled('wedding_address')){
                $detals->wedding_address = $request->wedding_address;
                $detals->save();
            }

            $respose = [
                'status'    =>  true,
                'message'   =>  "Profile Update Successfully!",
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

    public function dashboard(){
        
        $user_id = Auth::id();

        if($user_id){

            $data['user']   =  User::find($user_id);
            $data['details']    =   UserDetail::join('cities','cities.id','user_details.city_id')
                                        ->where('user_details.user_id',$user_id)
                                        ->select(['user_details.*','cities.name as city'])
                                        ->first();

            $data['all_checklist_count'] = checklist::where('user_id', $user_id)->count();
            $data['all_done_checklist_count'] = checklist::where('user_id', $user_id)->where('status','0')->count();

            $data['checklist_done_perentage'] = round(  ($data['all_done_checklist_count'] / $data['all_checklist_count']) * 100  );

            $data['total_guest'] = Guest::where('user_id',$user_id)->count();
            $data['confirm_guest'] = Guest::where('user_id',$user_id)->where('status','confirm')->count();
            $data['guestlist'] = Guest::where('user_id',$user_id)->limit(5);
            $data['total_category'] = Category::all()->count();
            $data['categories'] = Category::all();

            $data['checklist'] = Checklist::where('user_id',$user_id)->orderBy('added_date', 'ASC')->limit(2)->get();

            $data['budget'] = Budget::where('user_id',$user_id)->first();

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

    public function delete_account(){
        $user_id = Auth::id();

        if($user_id){
            $details = UserDetail::where('user_id',$user_id)->first();
            if($details){
                if(!empty($details->profile)){
                    Storage::delete('public/upload/user/profile/'.$details->profile);
                }
                $details->delete();
            }
            
            Budget::where('user_id',$user_id)->delete();
            BudgetCategory::where('user_id',$user_id)->delete();
            BudgetCategoryExpense::where('user_id',$user_id)->delete();
            BudgetExpense::where('user_id',$user_id)->delete();
            Checklist::where('user_id',$user_id)->delete();
            Guest::where('user_id',$user_id)->delete();
            $realwedd =  RealWedding::where('user_id',$user_id)->first();
            if($realwedd){
                if($realwedd->featured_image !== NULL ){
                    Storage::delete('public/upload/realwedding/profile/'.$realwedd->featured_image);
                }
                $realwedd->delete();
            }
            Review::where('user_id',$user_id)->delete();
            Wishlist::where('from_id',$user_id)->delete();
            MediaGallery::where('user_id',$user_id)->delete();
            User::find($user_id)->delete();
            Auth::user()->tokens()->delete();
            $respose = [
                'status'    =>  true,
                'message'      =>  "Your Account Delete Successful!",
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


    public function logout(){
        $user_id = Auth::id();

        if($user_id){
            Auth::user()->tokens()->delete();
            $respose = [
                'status'    =>  true,
                'message'      =>  "User Logout Successful!",
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

    Public function relation_groups(){
        $data['groups'] = RelationGroup::where('status','1')->get();
        
        if($data['groups']){
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
    }

    Public function all_categories(){
        $data['categories'] = Category::where('status','1')->get();
        
        if($data['categories']){
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
    }

    Public function all_cities(){
        $data['cities'] = City::where('status','1')->orderBy('name','asc')->get();
        
        if($data['cities']){
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
    }

    public function vendor_list(Request $request){
        $city = $request->city;
        $category_url = $request->category;
        $id = $request->vendor_id;

        $conditions = [
            ['users.user_type','vendor'],
            ['users.status','1'],
            ['vendor_details.featured_image','!=', NULL],
        ];
        if($category_url !== NULL){
            $category = Category::where('category_url',$category_url)->first();
            array_push($conditions,['vendor_details.category_id',$category->id]);
        }
        if($city !== NULL){
            $city_data = City::where('name',$city)->first();
            array_push($conditions,['vendor_details.city_id',$city_data->id]);
        }

        if($id !== NULL){
            array_push($conditions,['users.id',$id]);
        }

        $data['all_vendors'] =  User::join('vendor_details','vendor_details.user_id','=','users.id')
                                    ->join('categories','categories.id','=','vendor_details.category_id')
                                    ->join('cities','cities.id','=','vendor_details.city_id')
                                    ->where('vendor_details.listing_order', '=', NULL)
                                    ->where($conditions)
                                    ->select(['users.id','users.name','users.email','users.mobile','vendor_details.brandname','cities.name as city_name','vendor_details.featured_image','categories.category_name','vendor_details.is_featured','vendor_details.is_top',])
                                    ->orderBy('users.id','desc')
                                    ->orderBy('vendor_details.listing_order','asc')
                                    ->orderBy('vendor_details.is_top','desc')
                                    ->orderBy('vendor_details.is_featured','desc')
                                    ->get();

        if($data['all_vendors']){
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
        
    }

    public function blog_list(Request $request){
        $blog_id = $request->id;
        $category_url = $request->category_url;

        $conditions = [
            ['blogs.status','1'],
            ['blogs.featured_image','!=', NULL],
        ];
        if($category_url !== NULL){
            $category = BlogCategory::where('category_url',$category_url)->first();
            array_push($conditions,['blogs.category_id',$category->id]);
        }
        if($blog_id !== NULL){
            array_push($conditions,['blogs.id',$blog_id]);
        }


        $data['blogs'] = Blog::join('blog_categories','blog_categories.id','=','blogs.category_id')
                        ->select(['blogs.*','blog_categories.category_name','blog_categories.category_url'])
                        ->where($conditions)
                        ->orderBy('id','desc')
                        ->get();
        $data['popular_blogs'] = Blog::orderBy('id','asc')
                                ->limit(3)
                                ->get();
        $data['categories'] =   BlogCategory::all();
        
        if($data){
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
    }


    public function vendor_details(Request $request){
        $vendor_id = $request->id;
        $conditions = [
            ['users.user_type','vendor'],
            ['users.status','1'],
            ['users.id',$vendor_id],
        ];

        $data['vendor'] =  User::join('vendor_details','vendor_details.user_id','=','users.id')
                                    ->join('categories','categories.id','=','vendor_details.category_id')
                                    ->join('cities','cities.id','=','vendor_details.city_id')
                                    ->where($conditions)
                                    ->select(['users.id','users.name','users.email','users.mobile','vendor_details.brandname','vendor_details.featured_image','categories.category_name','vendor_details.profile_image','vendor_details.description','vendor_details.is_travelable','vendor_details.cancel_policy','vendor_details.advance_payment','vendor_details.youtube','vendor_details.service_offered','vendor_details.is_featured','vendor_details.is_top','cities.name as city_name' ])
                                    // ->orderBy('users.id','desc')
                                    ->first();
        $data['social_media'] = SocialLink::where('user_id',$vendor_id)->first();
        $data['gallery']    =   MediaGallery::where('user_id',$vendor_id)->where('user_type','vendor')->get();
        $data['ratings']    =   Review::where('vendor_id', $vendor_id)->orderBy('id','desc')->get();
        if($data){
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

    }


    public function top_vendors(){
        $data['top_vendors'] =  User::join('vendor_details','vendor_details.user_id','=','users.id')
                                ->join('categories','categories.id','=','vendor_details.category_id')
                                ->join('cities','cities.id','=','vendor_details.city_id')
                                ->where('users.user_type','vendor')
                                ->where('users.status','1')
                                ->where('vendor_details.is_top','1')
                                ->where('vendor_details.featured_image','!=', NULL)
                                ->select(['users.id','users.name','users.email','users.mobile','vendor_details.brandname','vendor_details.featured_image','categories.category_name','categories.icon','cities.name as city_name'])
                                ->limit(8)
                                ->orderBy('users.id','asc')
                                ->get();

        if($data){
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
    }


    public function featured_vendors(){
        $data['featured_vendors'] =  User::join('vendor_details','vendor_details.user_id','=','users.id')
                                ->join('categories','categories.id','=','vendor_details.category_id')
                                ->join('cities','cities.id','=','vendor_details.city_id')
                                ->where('users.user_type','vendor')
                                ->where('users.status','1')
                                ->where('vendor_details.is_featured','1')
                                ->where('vendor_details.featured_image','!=', NULL)
                                ->select(['users.id','users.name','users.email','users.mobile','vendor_details.brandname','cities.name as city_name','vendor_details.featured_image','categories.category_name','categories.icon'])
                                ->orderBy('users.id','desc')
                                ->get();

        if($data){
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
    }

    public function city(Request $request){
        $city_id = $request->id;
        $data['city'] = City::where('status','1')->where('id',$city_id)->first();
        if($data['city']){
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
    }

    public function category(Request $request){
        $category_id = $request->id;
        
        $data['category'] = Category::where('status','1')->where('id',$category_id)->first();
        if($data['category']){
            
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
    }

    public function add_wishlist(Request $request){
        $validator = Validator::make($request->all(),[
            'vendor_id'  =>'required',
        ]);

        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'    =>  $validator->errors()->first()
            ];
            return response()->json($respose,422);
        }

        $vendor_id = $request->vendor_id;
        $user_id = Auth::id();

        if($user_id){

            $wishlist = new Wishlist;
            $wishlist->from_id = $user_id;
            $wishlist->to_id = $vendor_id;
            $wishlist->save();

            $respose = [
                'status'    =>  true,
                'message'   =>  "Vendor Added To wishlist Successfully!",
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

    public function remove_wishlist(Request $request){
        $validator = Validator::make($request->all(),[
            'vendor_id'  =>'required',
        ]);

        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'    =>  $validator->errors()->first()
            ];
            return response()->json($respose,422);
        }

        $vendor_id = $request->vendor_id;
        $wishlist_id = $request->wishist_id;
        $user_id = Auth::id();

        if($user_id){

            $wishlist = Wishlist::where('from_id',$user_id)->where('to_id',$vendor_id)->first();
            if($wishlist->delete()){

                $respose = [
                    'status'    =>  true,
                    'message'   =>  "Vendor Removed From Wishlist Successfully!",
                ];
                return response()->json($respose,200);
            }
            $respose = [
                'status'    =>  false,
                'message'    =>  'Somthing Went Wrong!'
            ];
            return response()->json($respose,422);

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
                ['users.user_type','vendor'],
                ['users.status','1'],
                ['wishlists.from_id',$user_id]
            ];
            
            $data['all_vendors']  = Wishlist::join('vendor_details','vendor_details.user_id','=','wishlists.to_id')
                                    ->join('users', 'users.id', '=', 'wishlists.to_id')
                                    ->join('categories','categories.id','=','vendor_details.category_id')
                                    ->join('cities','cities.id','=','vendor_details.city_id')
                                    ->where($conditions)
                                    ->select(['users.id','users.name','vendor_details.brandname','cities.name as city_name','vendor_details.featured_image','categories.category_name','categories.icon'])
                                    ->orderBy('wishlists.id','desc')
                                    ->get();

            $respose = [
                'status'    =>  true,
                'message'   =>  "Get Data Successfully!",
                'data'      =>  $data
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



    public function reviews(){
        $user_id = Auth::id();

        if($user_id){

            $data['all_ratings'] = Review::join('users','users.id','=','reviews.vendor_id')
                                    ->where('reviews.user_id',$user_id)
                                    ->select(['reviews.*','users.name'])
                                    ->orderBy('reviews.id','desc')
                                    ->get();
            $data['total_ratings'] = Review::where('user_id',$user_id)->count();

            $respose = [
                'status'    =>  true,
                'message'   =>  "Get Data Successfully!.",
                'data'      =>  $data
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

    public function add_review(Request $request){
        $validator = Validator::make($request->all(),[
            'rating'  =>  'required',
            'vendor_id' => 'required',
            'comment' => 'required',
        ]);

        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'    =>  $validator->errors()->first()
            ];
            return response()->json($respose,422);
        }

        $user_id = Auth::id();
        $rating = $request->rating;
        $comment = $request->comment;
        $vendor_id = $request->vendor_id;
        
        $user = User::find($user_id);


        if($user_id){
            $review = Review::where('user_id',$user_id)->where('vendor_id',$vendor_id)->first();
            if(!empty($review)){
                $review->comment = $comment;
                $review->rating = $rating;
            }else{
                $review = new Review;
                $review->vendor_id = $vendor_id;
                $review->user_id = $user_id;
                $review->name = $user->name;
                $review->email = $user->email;
                $review->comment = $comment;
                $review->rating = $rating;
                $review->user_type = 'user';
                $review->status = '0';
            }
            $review->save();

            $respose = [
                'status'    =>  true,
                'message'   =>  "Review & Rating Added Successfully!",
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

    public function edit_review(Request $request){
        $validator = Validator::make($request->all(),[
            'review_id' =>  'required',
            'rating'      =>  'required',
            'comment'   =>  'required',
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

            $id = $request->review_id;
            $rating = $request->rating;
            $comment = $request->comment;
            $review = Review::where('id',$id)->where('user_id',$user_id)->first();

            $review->comment = $comment;
            $review->rating   =   $rating;
            $review->save();

            $respose = [
                'status'    =>  true,
                'message'   =>  "Review & Rating Edit Successfully!",
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

    public function remove_review(Request $request){
        $validator = Validator::make($request->all(),[
            'review_id' =>  'required',
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

            $user_id = Session::get('user_id');
            $id = $request->review_id;
            $rating = Review::where('id',$id)->where('user_id',$user_id)->delete();


            $respose = [
                'status'    =>  true,
                'message'   =>  "Rating & Review Delete Successfully!",
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


    public function real_wedding_list(Request $request){
        $realwedd_id = $request->id;

        $conditions = [];

        if($realwedd_id !== NULL){
            array_push($conditions,['real_weddings.id',$realwedd_id]);
        }

        $data['real_wedding']   =  RealWedding::where('status','1')
                                    ->where('is_gallery','1')
                                    ->where($conditions)
                                    ->whereNotNull('featured_image')
                                    ->whereNotNull('partner_name')
                                    ->orderBy('id','desc')
                                    ->limit(3)
                                    ->get();
        if($data){
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
    }

    public function gallery(Request $request){
        $validator = Validator::make($request->all(),[
            'realwedd_id' =>  'required',
        ]);

        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'    =>  $validator->errors()->first()
            ];
            return response()->json($respose,422);
        }
        $id = $request->realwedd_id;
        $realwedd = RealWedding::find($id);
        $vendor_id = $realwedd->user_id;

        $data['gallery'] =  MediaGallery::where('user_id',$vendor_id)->where('tags','realwedding')->get();

        if($data){
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
    }

    public function send_message(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'number' => 'required|max:10|min:10',
            'budget'  =>  'required',
            'event' =>  'required|date|after:today',
            'vendor_id' =>  'required'
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
            
            $name = $request->name;
            $mobile = $request->number;
            $budget = $request->budget;
            $event = date('Y-m-d',strtotime($request->event));
            $details = $request->details;
            $type = 'send_message';
            $vendor_id = $request->vendor_id;
            
            $conditions = [
                ['query_type',$type],
                ['mobile',$mobile],
                ['event_date',$event],
                ['vendor_id',$vendor_id]
            ];

            $query = Query::where($conditions)->where('vendor_id',$vendor_id)->first();

            if(!empty($query)){

                $respose = [
                    'status'    =>  false,
                    'message'   =>  'You Already Send Message!',
                    'query_type'    =>  $type,
                ];
                return response()->json($respose,422);

            }else{

                $query = new Query;
                $query->user_id = $user_id;
                $query->vendor_id = $vendor_id;
                $query->user_type = 'user';
                $query->query_type = $type;
                $query->name = $name;
                $query->mobile = $mobile;
                $query->budget = $budget;
                $query->details = $details;
                $query->event_date = $event;
                $query->is_mobile_verified = '1';
                $query->save();

                $respose = [
                    'status'    =>  true,
                    'message'   =>  "Message Send Successfully!",
                    'query_type'    =>  $type,
                ];
                return response()->json($respose,200);
            }

        }else{
            $respose = [
                'status'    =>  false,
                'message'    =>  'Token Expired or Unauthorized User!'
            ];
            return response()->json($respose,422);
        }
    }

    public function view_contact(Request $request){
        $validator = Validator::make($request->all(),[
            'vendor_id' =>  'required',
            'full_name' => 'required',
            'mobile' => 'required|max:10|min:10',
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

            $name = $request->full_name;
            $mobile = $request->mobile;
            $type = 'view_contact';
            $vendor_id = $request->vendor_id;
            $today = date('Y-m-d');

            $vendor_data = User::where('id',$vendor_id)->first();

            $conditions = [
                ['query_type',$type],
                ['mobile',$mobile],
                ['vendor_id',$vendor_id]
            ];
            
            $query = Query::where($conditions)->whereDate('created_at', $today)->first();

            if(!empty($query)){
                $respose = [
                    'status'    =>  true,
                    'verify'    =>  'yes',
                    'message'   =>  "Here are the contact details of vendor:- $vendor_data->mobile",
                    'data'      =>  $vendor_data->mobile,
                    'query_type'    =>  $type,
                ];
                return response()->json($respose,200);
            }else{

                $query = new Query;
                $query->user_id = $user_id;
                $query->vendor_id = $vendor_id;
                $query->user_type = 'user';
                $query->query_type = $type;
                $query->name = $name;
                $query->mobile = $mobile;

                $query->is_mobile_verified = '1';
                $query->save();

                $respose = [
                    'status'    =>  true,
                    'verify'    =>  'yes',
                    'message'   =>  "Here are the contact details of vendor:- $vendor_data->mobile",
                    'data'      =>  $vendor_data->mobile,
                    'query_type'    =>  $type,
                ];
                return response()->json($respose,200);
            }

            

        }else{
            $respose = [
                'status'    =>  false,
                'message'    =>  'Token Expired or Unauthorized User!'
            ];
            return response()->json($respose,422);
        }
    }



    public function contact(Request $request){
        $validator = Validator::make($request->all(),[
            'message' =>  'required',
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

            $type = "contact";
            $details = User::find($user_id);
            
            $contact = new Contact();
            $contact->mobile = $details->mobile;
            $contact->name = $details->name;
            $contact->type = $type;
            $contact->message = $request->message;
            if($contact->save()){
                $respose = [
                    'status'    =>  true,
                    'message'    =>  'Thanks for Contact US, We Will Contact You Soon!'
                ];
                return response()->json($respose,422);
    
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


}
