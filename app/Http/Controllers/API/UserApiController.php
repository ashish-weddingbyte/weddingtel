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
use App\Models\Planning_tool;
use App\Models\Checklist;
use App\Models\Guest;
use App\Models\Budget;
use App\Models\BudgetCategory;
use App\Models\BudgetExpense;
use App\Models\BudgetCategoryExpense;
use App\Models\Category;
use App\Models\RelationGroup;
use otp_helper;
use tools_helper;
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
            'user_id'   =>  'required'
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

        $user_id =  $request->user_id;
    
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

                    $user = User::find($user_id);
                    $token =  $user->createToken('WeddingByte')->plainTextToken;

                    // mark mobile verified
                    $user_details = UserDetail::where('user_id',$user_id)->first();
                    $user_details->is_mobile_verified = '1';
                    $user_details->save();

                    Session::flash('message', 'Login to Dashboard Successful!');
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
                        'message'   =>  'Failed',
                        'errors'    =>  'OTP is Invalid!'
                    ];
                    return response()->json($respose,401);
                }
            }
        }else{
            $respose = [
                'status'    =>  false,
                'message'   =>  'Failed',
                'errors'    =>  'Somthing Went Wrong in OTP.'
            ];
            return response()->json($respose,401);
        }

    }


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
                'message'   =>  $data,
            ];
            return response()->json($respose,200);
        }else{
            $respose = [
                'status'    =>  false,
                'message'   =>  'Unauthorized',
                'errors'    =>  'Token Expired or unauthorized User.'
            ];
            return response()->json($respose,401);
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
                'message'   =>  'Failed',
                'errors'    =>  $validator->errors()
            ];
            return response()->json($respose,401);
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
                'message'   =>  'Unauthorized',
                'errors'    =>  'Token Expired or unauthorized User!'
            ];
            return response()->json($respose,401);
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
                'message'   =>  'Failed',
                'errors'    =>  $validator->errors()
            ];
            return response()->json($respose,401);
        }

            if($request->task_id){
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
                'message'   =>  'Unauthorized',
                'errors'    =>  'Token Expired or unauthorized User!'
            ];
            return response()->json($respose,401);
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
                'errors'    =>  $validator->errors()
            ];
            return response()->json($respose,401);
        }
        if($request->task_id){

            Checklist::find($request->task_id)->delete();

            $respose = [
                'status'    =>  true,
                'message'   =>  "Checklist Delete Successfully!",
            ];
            return response()->json($respose,200);
        }else{
            $respose = [
                'status'    =>  false,
                'message'   =>  'Unauthorized',
                'errors'    =>  'Token Expired or unauthorized User!'
            ];
            return response()->json($respose,401);
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
                'errors'    =>  $validator->errors()
            ];
            return response()->json($respose,401);
        }

        $id = $request->id;
        $status = $request->status;

        $checklist = Checklist::find($id);
        $checklist->status = ($status == '1')? '0' : '1' ;
        $checklist->save();

        $respose = [
            'status'    =>  true,
            'message'   =>  "Checklist Status Change Successfully!",
        ];
        return response()->json($respose,200);
        
    }


    // guestlist api
    public function guestlist_api(){

        $user_id = Auth::id();
        if($user_id){

            $data['guestlist'] = Guest::where('user_id',$user_id)->paginate(50);;

            $data['total_guest'] = Guest::where('user_id',$user_id)->count();
            $data['confirm_guest'] = Guest::where('user_id',$user_id)->where('status','confirm')->count();
            $data['pending_guest'] = Guest::where('user_id',$user_id)->where('status','pending')->count();
            $data['cancel_guest'] = Guest::where('user_id',$user_id)->where('status','cancel')->count();
        
            $respose = [
                'status'    =>  true,
                'message'   =>  "Success",
                'data'      =>  $data
            ];
            return response()->json($respose,200);
            
        }else{
            $respose = [
                'status'    =>  false,
                'message'   =>  'Unauthorized',
                'errors'    =>  'Token Expired or unauthorized User!'
            ];
            return response()->json($respose,401);
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
                'message'   =>  'Failed',
                'errors'    =>  $validator->errors()
            ];
            return response()->json($respose,401);
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
                'message'   =>  'Unauthorized',
                'errors'    =>  'Token Expired or unauthorized User!'
            ];
            return response()->json($respose,401);
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
                'message'   =>  'Failed',
                'errors'    =>  $validator->errors()
            ];
            return response()->json($respose,401);
        }
        if($request->guest_id){
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
                'message'   =>  'Unauthorized',
                'errors'    =>  'Token Expired or unauthorized User!'
            ];
            return response()->json($respose,401);
        }
    }

    public function delete_guestlist_api(Request $request){
        $validator = Validator::make($request->all(),[
            'guest_id'=>  'required'
        ]);
        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'   =>  'Failed',
                'errors'    =>  $validator->errors()
            ];
            return response()->json($respose,401);
        }

        if($request->guest_id){
            Guest::find($request->guest_id)->delete();
            $respose = [
                'status'    =>  true,
                'message'   =>  "Guest Delete Successfully!",
            ];
            return response()->json($respose,200);
        }else{
            $respose = [
                'status'    =>  false,
                'message'   =>  'Unauthorized',
                'errors'    =>  'Token Expired or unauthorized User!'
            ];
            return response()->json($respose,401);
        }
    }


    
    // budget api
    public function budget_api(){
        $user_id = Auth::id();

        if($user_id){

            $data['budget'] = Budget::find($user_id);

            // $data['budget_categories'] = BudgetCategory::where('type','default')->orWhere('user_id',$user_id)->orderBy('id','desc')->get();

            $data['budget_categories'] = BudgetCategory::leftJoin('budget_category_expenses','budget_categories.id', '=', 'budget_category_expenses.budget_category_id')
                                        ->select(['budget_categories.*','budget_category_expenses.estimated_cost','budget_category_expenses.final_cost','budget_category_expenses.pending'])
                                        ->orderBy('budget_categories.id','desc')
                                        ->get();

            $data['buget_expense'] = BudgetExpense::where('user_id', $user_id)->get();
            $respose = [
                'status'    =>  true,
                'message'   =>  "Success",
                'data'      =>  $data
            ];
            return response()->json($respose,200);
        }else{
            $respose = [
                'status'    =>  false,
                'message'   =>  'Unauthorized',
                'errors'    =>  'Token Expired or unauthorized User!'
            ];
            return response()->json($respose,401);
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
                'errors'    =>  $validator->errors()
            ];
            return response()->json($respose,401);
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
                'message'   =>  'Unauthorized',
                'errors'    =>  'Token Expired or unauthorized User!'
            ];
            return response()->json($respose,401);
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
                'message'   =>  'Failed',
                'errors'    =>  $validator->errors()
            ];
            return response()->json($respose,401);
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
                'message'   =>  'Unauthorized',
                'errors'    =>  'Token Expired or unauthorized User!'
            ];
            return response()->json($respose,401);
        }
    }

    public function delete_budget_category_api(Request $request){
        $validator = Validator::make($request->all(),[
            'category_id' => 'required',
        ]);

        if($validator->fails()){
            $respose = [
                'status'    =>  false,
                'message'   =>  'Failed',
                'errors'    =>  $validator->errors()
            ];
            return response()->json($respose,401);
        }
        
        $category_id = $request->category_id;
        
        $user_id = Auth::id();

        if($user_id){

            $budget_category = BudgetCategory::find($category_id);

            
            if($budget_category->type == 'added'){

                $budget_category->delete();
                BudgetCategoryExpense::where('budget_category_id',$category_id)->delete();
                BudgetExpense::where('budget_category_id',$category_id)->where('user_id',$user_id)->delete();
            }else{
                BudgetCategoryExpense::where('budget_category_id',$category_id)->delete();
                BudgetExpense::where('budget_category_id',$category_id)->where('user_id',$user_id)->delete();
            }
            
            $respose = [
                'status'    =>  true,
                'message'   =>  "Budget Category Delete Successfully!",
            ];
            return response()->json($respose,200);
        }else{
            $respose = [
                'status'    =>  false,
                'message'   =>  'Unauthorized',
                'errors'    =>  'Token Expired or unauthorized User!'
            ];
            return response()->json($respose,401);
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
                'message'   =>  'Failed',
                'errors'    =>  $validator->errors()
            ];
            return response()->json($respose,401);
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
            $respose = [
                'status'    =>  true,
                'message'   =>  "Budget Estimanted Cost Edit Successfully!",
            ];
            return response()->json($respose,200);
        }else{
            $respose = [
                'status'    =>  false,
                'message'   =>  'Unauthorized',
                'errors'    =>  'Token Expired or unauthorized User!'
            ];
            return response()->json($respose,401);
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
                'message'   =>  'Failed',
                'errors'    =>  $validator->errors()
            ];
            return response()->json($respose,401);
        }
        $pending_amount = $request->estimated_cost - $request->amount_paid;
        $user_id = Auth::id();
        
        if($user_id){
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

            // calculate total cost for category expense.
            $total_estimated_cost_of_category =  BudgetExpense::where('user_id',$user_id)->where('budget_category_id',$request->category_id)->sum('estimated_cost');
            $total_paid_of_category =  BudgetExpense::where('user_id',$user_id)->where('budget_category_id',$request->category_id)->sum('paid');
            $total_pending_of_category =  BudgetExpense::where('user_id',$user_id)->where('budget_category_id',$request->category_id)->sum('pending');

            // category expense code.
            $category_expense = BudgetCategoryExpense::where('user_id',$user_id)->where('budget_category_id',$request->category_id)->first();

            if( $category_expense ){
                // $category_expense->estimated_cost = $total_estimated_cost_of_category;
                $category_expense->final_cost = $total_paid_of_category;
                $category_expense->pending = $total_pending_of_category;
                $category_expense->save();
            }else{
                $category_expense = new BudgetCategoryExpense;
                $category_expense->user_id = $user_id;
                $category_expense->budget_category_id = $request->category_id;
                $category_expense->estimated_cost = 0 ;
                $category_expense->final_cost = $total_paid_of_category;
                $category_expense->pending = $total_pending_of_category;
                $category_expense->status = '1';
                $category_expense->save();
                
            }
            $respose = [
                'status'    =>  true,
                'message'   =>  "Budget Expense Added Successfully!",
            ];
            return response()->json($respose,200);
        }else{
            $respose = [
                'status'    =>  false,
                'message'   =>  'Unauthorized',
                'errors'    =>  'Token Expired or unauthorized User!'
            ];
            return response()->json($respose,401);
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
                'message'   =>  'Failed',
                'errors'    =>  $validator->errors()
            ];
            return response()->json($respose,401);
        }

        $user_id = Auth::id();
        
        if($user_id){
        
            $category_id = $request->category_id;
            $expense_id = $request->expense_id;
            $expense_name = $request->expense_name;
            $estimated_cost = $request->estimated_cost;
            $amount_paid = $request->amount_paid;
            $pending_amount = $estimated_cost - $amount_paid;
            
            // indiviual expense 
            $budget_expense = BudgetExpense::find($expense_id);        
            $budget_expense->expense_name = $expense_name;
            $budget_expense->estimated_cost = $estimated_cost;
            $budget_expense->paid = $amount_paid; 
            $budget_expense->pending = $pending_amount;
            $budget_expense->save();

            // calculate total cost for category expense.
            $total_estimated_cost_of_category =  BudgetExpense::where('user_id',$user_id)->where('budget_category_id',$category_id)->sum('estimated_cost');
            $total_paid_of_category =  BudgetExpense::where('user_id',$user_id)->where('budget_category_id',$category_id)->sum('paid');
            $total_pending_of_category =  BudgetExpense::where('user_id',$user_id)->where('budget_category_id',$request->category_id)->sum('pending');

            // category expense code.
            $category_expense = BudgetCategoryExpense::where('user_id',$user_id)->where('budget_category_id',$category_id)->first();


            // $category_expense->estimated_cost = $total_estimated_cost_of_category;
            $category_expense->final_cost = $total_paid_of_category;
            $category_expense->pending = $total_pending_of_category;
            $category_expense->save();
        

            $respose = [
                'status'    =>  true,
                'message'   =>  "Budget Expense Edit Successfully!",
            ];
            return response()->json($respose,200);
        }else{
            $respose = [
                'status'    =>  false,
                'message'   =>  'Unauthorized',
                'errors'    =>  'Token Expired or unauthorized User!'
            ];
            return response()->json($respose,401);
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
                'message'   =>  'Failed',
                'errors'    =>  $validator->errors()
            ];
            return response()->json($respose,401);
        }

        $user_id = Auth::id();

        if($user_id){
            $category_id = $request->category_id;
            $expense_id = $request->expense_id;
            
            
            // indiviual expense 
            $budget_expense = BudgetExpense::find($expense_id)->delete();        
            
            if($budget_expense){

                // calculate total cost for category expense.
                $total_estimated_cost_of_category =  BudgetExpense::where('user_id',$user_id)->where('budget_category_id',$category_id)->sum('estimated_cost');
                $total_paid_of_category =  BudgetExpense::where('user_id',$user_id)->where('budget_category_id',$category_id)->sum('paid');

                // category expense code.
                $category_expence = BudgetCategoryExpense::where('user_id',$user_id)->where('budget_category_id',$category_id)->first();


                // $category_expence->estimated_cost = $total_estimated_cost_of_category;
                $category_expence->final_cost = $total_paid_of_category;
                $category_expence->save();

            }
            $respose = [
                'status'    =>  true,
                'message'   =>  "Budget Expense Delete Successfully!",
            ];
            return response()->json($respose,200);
        }else{
            $respose = [
                'status'    =>  false,
                'message'   =>  'Unauthorized',
                'errors'    =>  'Token Expired or unauthorized User!'
            ];
            return response()->json($respose,401);
        }
    }
    


    public function profile_api(){

        $user_id = Auth::id();
        
        if($user_id){
            $data['user'] = User::find($user_id);
            $data['details'] = UserDetail::where('user_id',$user_id)->first();
        
            $respose = [
                'status'    =>  true,
                'message'   =>  "Success",
                'data'      =>  $data
            ];
            return response()->json($respose,200);
        }else{
            $respose = [
                'status'    =>  false,
                'message'   =>  'Unauthorized',
                'errors'    =>  'Token Expired or unauthorized User!'
            ];
            return response()->json($respose,401);
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
                'message'   =>  'Failed',
                'errors'    =>  $validator->errors()
            ];
            return response()->json($respose,401);
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
                        'message'   =>  'Failed',
                        'errors'    =>  'Old Password is Incorrect!'
                    ];
                    return response()->json($respose,401);
                }
            }else{
                $respose = [
                    'status'    =>  false,
                    'message'   =>  'Unauthorized',
                    'errors'    =>  'Token Expired or unauthorized User!'
                ];
                return response()->json($respose,401);
            }

        }else{
            $respose = [
                'status'    =>  false,
                'message'   =>  'Failed',
                'errors'    =>  'Password Not Matched!'
            ];
            return response()->json($respose,401);
            
        }
    }


    public function update_details_api(Request $request){
        $validator = Validator::make($request->all(),[
            'profile'  =>'image|mimes:jpg,png,jpeg|max:1024',
        ]);

        $user_id = Auth::id();

        if($user_id){
            if($request->filled('name')){
                $user = User::find($user_id);
                $user->name = $request->name;
                $user->save();
            }

            $detals = UserDetail::where('user_id',$user_id)->first();

            if($request->filled('city')){
                $detals->city = $request->city;
                $detals->save();
            }

            if ($request->hasFile('profile')) {

                // Storage::delete($detals->profile);
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
                'message'   =>  'Unauthorized',
                'errors'    =>  'Token Expired or unauthorized User!'
            ];
            return response()->json($respose,401);
        }
        
    }

    public function wedding_info_api(Request $request){
        $validator = Validator::make($request->all(),[
            'profile'  =>'image|mimes:jpg,png,jpeg|max:1024',
            'partner_profile'  =>'image|mimes:jpg,png,jpeg|max:1024',
        ]);

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
                'message'   =>  'Unauthorized',
                'errors'    =>  'Token Expired or unauthorized User!'
            ];
            return response()->json($respose,401);
        }

    }

    public function dashboard(){
        
        $user_id = Auth::id();

        if($user_id){

        

            $data['user']   =  User::find($user_id);
            $data['details']    =   UserDetail::where('user_id',$user_id)->first();

            $data['all_checklist_count'] = checklist::where('user_id', $user_id)->count();
            $data['all_done_checklist_count'] = checklist::where('user_id', $user_id)->where('status','0')->count();

            $data['checklist_done_perentage'] = round(  ($data['all_done_checklist_count'] / $data['all_checklist_count']) * 100  );

            $data['total_guest'] = Guest::where('user_id',$user_id)->count();
            $data['confirm_guest'] = Guest::where('user_id',$user_id)->where('status','confirm')->count();

            $data['total_category'] = Category::all()->count();
            $data['categories'] = Category::all();

            $data['checklist'] = Checklist::where('user_id',$user_id)->orderBy('added_date', 'ASC')->limit(2)->get();

            $data['budget'] = Budget::where('user_id',$user_id)->first();

            $respose = [
                'status'    =>  true,
                'message'   =>  "Success",
                'data'      =>  $data,
            ];
            return response()->json($respose,200);
        }else{
            $respose = [
                'status'    =>  false,
                'message'   =>  'Unauthorized',
                'errors'    =>  'Token Expired or unauthorized User!'
            ];
            return response()->json($respose,401);
        }
    }

    public function logout(){
        $user_id = Auth::id();

        if($user_id){
            Auth::user()->tokens()->delete();
            $respose = [
                'status'    =>  true,
                'message'   =>  "Success",
                'data'      =>  "User Logout Successful!",
            ];
            return response()->json($respose,200);
        }else{
            $respose = [
                'status'    =>  false,
                'message'   =>  'Unauthorized',
                'errors'    =>  'Token Expired or unauthorized User!'
            ];
            return response()->json($respose,401);
        }
    }

    Public function relation_groups(){
        $data['groups'] = RelationGroup::where('status','1')->get();
        
        if($data['groups']){
            $respose = [
                'status'    =>  true,
                'message'   =>  "Success",
                'data'      =>  $data,
            ];
            return response()->json($respose,200);
        }else{
            $respose = [
                'status'    =>  false,
                'message'   =>  'Failed',
                'errors'    =>  'Somthing Went Wrong!'
            ];
            return response()->json($respose,401);
        }
    }

    Public function all_categories(){
        $data['categories'] = Category::where('status','1')->get();
        
        if($data['categories']){
            $respose = [
                'status'    =>  true,
                'message'   =>  "Success",
                'data'      =>  $data,
            ];
            return response()->json($respose,200);
        }else{
            $respose = [
                'status'    =>  false,
                'message'   =>  'Failed',
                'errors'    =>  'Somthing Went Wrong!'
            ];
            return response()->json($respose,401);
        }
    }

}
