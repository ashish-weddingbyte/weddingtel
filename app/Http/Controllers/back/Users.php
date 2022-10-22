<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\User;
use App\Models\VendorDetail;
use App\Models\UserDetail;
use App\Models\SocialLink;
use App\Models\MediaGallery;
use App\Models\City;
use App\Models\PositionPaidVendor;
use App\Models\LeadPaidVendor;
use App\Models\LeadViewStatus;
use App\Models\LeadPlan;
use App\Models\PositionPlan;
use App\Models\PaymentHistory;


use App\Models\Wishlist;
use App\Models\Budget;
use App\Models\Review;
use App\Models\Checklist;
use App\Models\RealWedding;
use App\Models\Guest;

use App\Models\BudgetCategory;
use App\Models\BudgetExpense;
use App\Models\BudgetCategoryExpense;

use admin_helper;
use Carbon\Carbon;

class Users extends Controller
{
    public function __construct(){
        $this->middleware('is_session');
    }
    
    public function all_vendors(){

        $data['all_vendors'] =  User::join('vendor_details','vendor_details.user_id','=','users.id')
                                    ->join('categories','categories.id','=','vendor_details.category_id')
                                    ->join('cities','cities.id','=','vendor_details.city_id')
                                    ->where('users.user_type','vendor')
                                    ->select(['users.id','users.name','users.email','users.mobile','users.status','vendor_details.brandname','vendor_details.is_email_verified','vendor_details.is_mobile_verified','cities.name as city_name','vendor_details.featured_image','categories.category_name','vendor_details.is_featured','vendor_details.is_top',])
                                    ->orderBy('users.id','desc')
                                    ->get();
        return view('back.all_vendors',$data);
    }

    public function unpaid_vendors(){
        
        $paid_lead_vendor =  LeadPaidVendor::select('user_id')
                                            ->distinct()
                                            ->get()
                                            ->pluck('user_id')
                                            ->toArray();

        $paid_position_vendor = PositionPaidVendor::select('user_id')
                                                    ->distinct()
                                                    ->get()
                                                    ->pluck('user_id')
                                                    ->toArray();    
        
        $data = array_unique( array_merge($paid_lead_vendor,$paid_position_vendor) );
        
        $data['all_vendors'] =  User::join('vendor_details','vendor_details.user_id','=','users.id')
                                    ->join('categories','categories.id','=','vendor_details.category_id')
                                    ->join('cities','cities.id','=','vendor_details.city_id')
                                    ->where('users.user_type','vendor')
                                    ->whereNotIn('users.id',$data)
                                    ->select(['users.id','users.name','users.email','users.mobile','users.status','vendor_details.brandname','vendor_details.is_email_verified','vendor_details.is_mobile_verified','cities.name as city_name','vendor_details.featured_image','categories.category_name','vendor_details.is_featured','vendor_details.is_top',])
                                    ->orderBy('users.id','desc')
                                    ->get();
        return view('back.unpaid_vendors',$data);
    }

    public function archive_vendors(){
        $data['all_vendors'] =  User::join('vendor_details','vendor_details.user_id','=','users.id')
                                    ->join('categories','categories.id','=','vendor_details.category_id')
                                    ->join('cities','cities.id','=','vendor_details.city_id')
                                    ->where('users.user_type','vendor')
                                    ->where('users.status','0')
                                    ->select(['users.id','users.name','users.email','users.mobile','users.status','vendor_details.brandname','vendor_details.is_email_verified','vendor_details.is_mobile_verified','cities.name as city_name','vendor_details.featured_image','categories.category_name','vendor_details.is_featured','vendor_details.is_top',])
                                    ->orderBy('users.id','desc')
                                    ->onlyTrashed()->get();
        return view('back.archive_vendors',$data);
    }

    public function paid_vendors(){

        $data['leads_paid_vendor'] =  LeadPaidVendor::join('users','users.id','lead_paid_vendors.user_id')
                                    ->join('vendor_details','vendor_details.user_id','=','users.id')
                                    ->join('categories','categories.id','=','vendor_details.category_id')
                                    ->join('cities','cities.id','=','vendor_details.city_id')
                                    ->where('users.user_type','vendor')
                                    ->where('lead_paid_vendors.is_active','1')
                                    ->select(['users.id','users.name','users.email','users.mobile','users.status','vendor_details.brandname','vendor_details.is_email_verified','vendor_details.is_mobile_verified','cities.name as city_name','vendor_details.featured_image','categories.category_name','vendor_details.is_featured','vendor_details.is_top','lead_paid_vendors.plan_name','lead_paid_vendors.lead','lead_paid_vendors.available_leads','lead_paid_vendors.start_at','lead_paid_vendors.end_at','lead_paid_vendors.is_addon'])
                                    ->orderBy('users.id','desc')
                                    ->get();

        $data['position_paid_vendor'] =  PositionPaidVendor::join('users','users.id','position_paid_vendors.user_id')
                                    ->join('vendor_details','vendor_details.user_id','=','users.id')
                                    ->join('categories','categories.id','=','vendor_details.category_id')
                                    ->join('cities','cities.id','=','position_paid_vendors.city_id')
                                    ->where('users.user_type','vendor')
                                    ->where('position_paid_vendors.is_active','1')
                                    ->select(['users.id','users.name','users.email','users.mobile','users.status','vendor_details.brandname','vendor_details.is_email_verified','vendor_details.listing_order','vendor_details.is_mobile_verified','cities.name as city_name','vendor_details.featured_image','categories.category_name','vendor_details.is_featured','vendor_details.is_top','position_paid_vendors.plan_name','position_paid_vendors.start_at','position_paid_vendors.end_at'])
                                    ->orderBy('users.id','desc')
                                    ->get();
        return view('back.paid_vendors',$data);
    }


    public function expire_vendors(){

        $data['leads_paid_vendor'] =  LeadPaidVendor::join('users','users.id','lead_paid_vendors.user_id')
                                    ->join('vendor_details','vendor_details.user_id','=','users.id')
                                    ->join('categories','categories.id','=','vendor_details.category_id')
                                    ->join('cities','cities.id','=','vendor_details.city_id')
                                    ->where('users.user_type','vendor')
                                    ->where('lead_paid_vendors.is_active','0')
                                    ->select(['users.id','users.name','users.email','users.mobile','users.status','vendor_details.brandname','vendor_details.is_email_verified','vendor_details.is_mobile_verified','cities.name as city_name','vendor_details.featured_image','categories.category_name','vendor_details.is_featured','vendor_details.is_top','lead_paid_vendors.plan_name','lead_paid_vendors.lead','lead_paid_vendors.available_leads','lead_paid_vendors.start_at','lead_paid_vendors.end_at','lead_paid_vendors.is_addon'])
                                    ->orderBy('users.id','desc')
                                    ->get();

        $data['position_paid_vendor'] =  PositionPaidVendor::join('users','users.id','position_paid_vendors.user_id')
                                    ->join('vendor_details','vendor_details.user_id','=','users.id')
                                    ->join('categories','categories.id','=','vendor_details.category_id')
                                    ->join('cities','cities.id','=','vendor_details.city_id')
                                    ->where('users.user_type','vendor')
                                    ->where('position_paid_vendors.is_active','0')
                                    ->select(['users.id','users.name','users.email','users.mobile','users.status','vendor_details.brandname','vendor_details.is_email_verified','vendor_details.is_mobile_verified','cities.name as city_name','vendor_details.featured_image','categories.category_name','vendor_details.is_featured','vendor_details.is_top','position_paid_vendors.plan_name','position_paid_vendors.start_at','position_paid_vendors.end_at'])
                                    ->orderBy('users.id','desc')
                                    ->get();
        return view('back.expire_vendors',$data);
    }

    public function action(Request $request){
        $ids = explode(',', $request->ids);
        $action_type = $request->action;
        $url = $request->url;

        if($action_type == 'deactivate'){
            $data = User::whereIn('id', $ids)->update(['status'=>'0']);
            if($data){
                Session::flash('message', 'Deactivate Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Deactivate Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'deactivate_review'){
            $data = Review::whereIn('id', $ids)->update(['status'=>'0']);
            if($data){
                Session::flash('message', 'Deactivate Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Deactivate Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'activate'){
            $data = User::whereIn('id', $ids)->update(['status'=>'1']);
            if($data){
                Session::flash('message', 'Activate Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Activate Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'activate_review'){
            $data = Review::whereIn('id', $ids)->update(['status'=>'1']);
            if($data){
                Session::flash('message', 'Activate Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Activate Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'delete'){
            $data = User::whereIn('id', $ids)->delete();
            if($data){
                Session::flash('message', 'Added in Trash Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Added in Trash Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'delete_review'){
            $data = Review::whereIn('id', $ids)->delete();
            if($data){
                Session::flash('message', 'Review Delete Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Review Delete Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'add_top'){
            $data = VendorDetail::whereIn('user_id', $ids)->update(['is_top'=>'1']);
            if($data){
                Session::flash('message', 'Vendors Added in Top Vendors Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Vendors Added in Top Vendors Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'remove_top'){
            $data = VendorDetail::whereIn('user_id', $ids)->update(['is_top'=>'0']);
            if($data){
                Session::flash('message', 'Vendors Removed From Top Vendors Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Vendors Removed From Top Vendors Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'add_featured'){
            $data = VendorDetail::whereIn('user_id', $ids)->update(['is_featured'=>'1']);
            if($data){
                Session::flash('message', 'Vendors Added in Top Vendors List Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Vendors Added in Top Vendors List Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'remove_featured'){
            $data = VendorDetail::whereIn('user_id', $ids)->update(['is_featured'=>'0']);
            if($data){
                Session::flash('message', 'Vendors Remove From Featured Vendors List Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Vendors Remove From Featured Vendors List Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'expired_lead_plan'){
            $data = LeadPaidVendor::whereIn('user_id', $ids)->update(['is_active'=>'0']);
            if($data){
                Session::flash('message', 'Vendors Lead Plan Expired Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Vendors Lead Plan Expired Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'active_lead_plan'){
            $data = LeadPaidVendor::whereIn('user_id', $ids)->update(['is_active'=>'1']);
            if($data){
                Session::flash('message', 'Vendors Lead Plan Active Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Vendors Lead Plan Active Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'expired_position_plan'){
            $data = PositionPaidVendor::whereIn('user_id', $ids)->update(['is_active'=>'0']);
            if($data){
                Session::flash('message', 'Vendors Lead Plan Expired Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Vendors Lead Plan Expired Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }
        
        if($action_type == 'active_position_plan'){
            $data = PositionPaidVendor::whereIn('user_id', $ids)->update(['is_active'=>'1']);
            if($data){
                Session::flash('message', 'Vendors Lead Plan Active Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Vendors Lead Plan Active Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'restore'){
            $data = User::whereIn('id', $ids)->withTrashed()->restore();
            if($data){
                Session::flash('message', 'Restore Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Restore Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'force_delete'){
            $data = User::whereIn('id', $ids)->withTrashed()->forceDelete();
            if($data){
                VendorDetail::whereIn('user_id',$ids)->delete();
                MediaGallery::whereIn('user_id',$ids)->delete();

                Session::flash('message', 'Vendor Permanent Delete Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Vendor Permanent Delete Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'force_delete_user'){
            $data = User::whereIn('id', $ids)->withTrashed()->withTrashed()->get();
            if($data){
                UserDetail::whereIn('user_id',$ids)->delete();
                Wishlist::whereIn('from_id',$ids)->delete();
                Checklist::whereIn('user_id',$ids)->delete();
                Guest::whereIn('user_id',$ids)->delete();
                Budget::whereIn('user_id',$ids)->delete();
                RealWedding::whereIn('user_id',$ids)->delete();
                Review::whereIn('user_id',$ids)->delete();
                BudgetCategory::whereIn('user_id',$ids)->delete();
                BudgetExpense::whereIn('user_id',$ids)->delete();
                BudgetCategoryExpense::whereIn('user_id',$ids)->delete();

                User::whereIn('id', $ids)->withTrashed()->forceDelete();

                Session::flash('message', 'User Permanent Delete Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'User Permanent Delete Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }
  
    }

    public function top_vendors(){
        $data['all_vendors'] =  User::join('vendor_details','vendor_details.user_id','=','users.id')
                                    ->join('categories','categories.id','=','vendor_details.category_id')
                                    ->join('cities','cities.id','=','vendor_details.city_id')
                                    ->where('users.user_type','vendor')
                                    ->where('vendor_details.is_top','1')
                                    ->select(['users.id','users.name','users.email','users.mobile','users.status','vendor_details.brandname','vendor_details.is_email_verified','vendor_details.is_mobile_verified','cities.name as city_name','vendor_details.featured_image','categories.category_name','vendor_details.is_featured','vendor_details.is_top',])
                                    ->orderBy('users.id','desc')
                                    ->get();
        return view('back.top_vendors',$data);
    }

    public function featured_vendors(){
        $data['all_vendors'] =  User::join('vendor_details','vendor_details.user_id','=','users.id')
                                    ->join('categories','categories.id','=','vendor_details.category_id')
                                    ->join('cities','cities.id','=','vendor_details.city_id')
                                    ->where('users.user_type','vendor')
                                    ->where('vendor_details.is_featured','1')
                                    ->select(['users.id','users.name','users.email','users.mobile','users.status','vendor_details.brandname','vendor_details.is_email_verified','vendor_details.is_mobile_verified','cities.name as city_name','vendor_details.featured_image','categories.category_name','vendor_details.is_featured','vendor_details.is_top',])
                                    ->orderBy('users.id','desc')
                                    ->get();
        return view('back.featured_vendors',$data);
    }



    public function new_request(){
        $date = Carbon::today()->subDays(30);
        $data['all_users'] =  User::where('created_at', '>=' ,$date)->orderBy('id','desc')->get();
        return view('back.new_request',$data);
    }


    public function all_bride_groom(){
        $data['all_users'] =  User::join('user_details','user_details.user_id','=','users.id')
                                    ->join('cities','cities.id','=','user_details.city_id')
                                    ->where('users.user_type','user')
                                    ->select(['users.id','users.name','users.email','users.mobile','users.status','user_details.event','user_details.is_email_verified','user_details.is_mobile_verified','cities.name as city_name','user_details.profile','user_details.type','user_details.partner_name','user_details.partner_profile','user_details.wedding_address','user_details.partner_profile'])
                                    ->orderBy('users.id','desc')
                                    ->get();

        return view('back.all_users',$data);
    }


    public function all_archive_user(){
        $data['all_users'] =  User::join('user_details','user_details.user_id','=','users.id')
                                    ->join('cities','cities.id','=','user_details.city_id')
                                    ->where('users.user_type','user')
                                    ->select(['users.id','users.name','users.email','users.mobile','users.status','user_details.event','user_details.is_email_verified','user_details.is_mobile_verified','cities.name as city_name','user_details.profile','user_details.type','user_details.partner_name','user_details.partner_profile','user_details.wedding_address','user_details.partner_profile'])
                                    ->orderBy('users.id','desc')
                                    ->onlyTrashed()->get();

        return view('back.archive_users',$data);
    }


    public function all_reviews(){
        $data['all_review'] = Review::orderBy('id','desc')->get();
        return view('back.all_reviews',$data);
    }


    public function vendors_open_leads(Request $request){
        $id = $request->id;
        $data['vendor'] = admin_helper::vendor_details($id);
        $data['leads'] = LeadViewStatus::join('leads','leads.id','=','lead_view_status.lead_id')
                                        ->where('lead_view_status.user_id',$id)
                                        ->select(['lead_view_status.created_at','leads.*'])
                                        ->orderBy('lead_view_status.created_at','desc')
                                        ->orderBy('lead_view_status.id','desc')
                                        ->get();
        return view('back.open_vendor_leads',$data);
    }
    


    public function buy_lead_plan(Request $request){
        $vendor_id = $request->id;
        $data['vendor'] = admin_helper::vendor_details($vendor_id);
        $category_id = $data['vendor']->category_id;
        $data['plans'] = LeadPlan::where('category_id',$category_id)->where('status','1')->get();
        return view('back.buy_lead_plan',$data);

    }

    public function buy_position_plan(Request $request){
        $vendor_id = $request->id;
        $data['vendor'] = admin_helper::vendor_details($vendor_id);
        $data['cities'] = City::orderBy('id','desc')->get();
        $data['plans'] = PositionPlan::where('status','1')->get();
        return view('back.buy_position_plan',$data);
    }

    public function save_lead_plan(Request $request){
        $request->validate([
            'plan'  =>'required|not_in:0',
        ]);

        $vendor_id = $request->vendor_id;
        $plan = $request->plan; 
        $remark  = $request->remark;
        $paid_lead_vendor = LeadPaidVendor::where('user_id',$vendor_id)
                                            ->where('is_active','1')
                                            ->where('available_leads','>','0')
                                            ->orderBy('id','desc')
                                            ->first();
        if(!empty($paid_lead_vendor)){
            Session::flash('message', 'Vendor has another Activated Plan!');
            Session::flash('class', 'alert-warning');
            return back();
        }else{

            $plan_details = LeadPlan::find($plan);

            $start = Carbon::now()->format('Y-m-d');
            $end = Carbon::now()->addDays($plan_details->days)->format("Y-m-d");

            
            $paid_vendor = new LeadPaidVendor();
            $paid_vendor->user_id = $vendor_id;
            $paid_vendor->plan_id = $plan_details->id;
            $paid_vendor->plan_name = $plan_details->name;
            $paid_vendor->lead = $plan_details->leads;
            $paid_vendor->total_lead = $plan_details->leads;
            $paid_vendor->available_leads = $plan_details->leads;
            $paid_vendor->start_at = $start;
            $paid_vendor->end_at = $end;
            $paid_vendor->is_active = '1';
            $paid_vendor->is_addon = "no";
            $paid_vendor->save();

            $history = new PaymentHistory();
            $history->user_id = $vendor_id;
            $history->plan_id = $plan_details->id;
            $history->plan_type = 'lead';
            $history->payment_mode = 'offline';
            $history->remark = $remark;
            $history->price = $plan_details->price;
            $history->save();


            Session::flash('message', 'Vendor Plan Activated Successfull!');
            Session::flash('class', 'alert-success');
            return back();
        }                               
    }

}
