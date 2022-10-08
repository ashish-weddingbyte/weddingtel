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
use admin_helper;
use Carbon\Carbon;

class Users extends Controller
{
    public function __construct(){
        $this->middleware('is_session');
    }
    
    public function active_vendors(){

        $data['all_vendors'] =  User::join('vendor_details','vendor_details.user_id','=','users.id')
                                    ->join('categories','categories.id','=','vendor_details.category_id')
                                    ->join('cities','cities.id','=','vendor_details.city_id')
                                    ->where('users.user_type','vendor')
                                    ->where('users.status','1')
                                    ->select(['users.id','users.name','users.email','users.mobile','users.status','vendor_details.brandname','vendor_details.is_email_verified','vendor_details.is_mobile_verified','cities.name as city_name','vendor_details.featured_image','categories.category_name','vendor_details.is_featured','vendor_details.is_top',])
                                    ->orderBy('users.id','desc')
                                    ->get();
        return view('back.active_vendors',$data);
    }

    public function inactive_vendors(){
        $data['all_vendors'] =  User::join('vendor_details','vendor_details.user_id','=','users.id')
                                    ->join('categories','categories.id','=','vendor_details.category_id')
                                    ->join('cities','cities.id','=','vendor_details.city_id')
                                    ->where('users.user_type','vendor')
                                    ->where('users.status','0')
                                    ->select(['users.id','users.name','users.email','users.mobile','users.status','vendor_details.brandname','vendor_details.is_email_verified','vendor_details.is_mobile_verified','cities.name as city_name','vendor_details.featured_image','categories.category_name','vendor_details.is_featured','vendor_details.is_top',])
                                    ->orderBy('users.id','desc')
                                    ->get();
        return view('back.inactive_vendors',$data);
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
                Session::flash('message', 'Vendors Deactivate Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Vendors Deactivate Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'activate'){
            $data = User::whereIn('id', $ids)->update(['status'=>'1']);
            if($data){
                Session::flash('message', 'Vendors Activate Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Vendors Activate Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'delete'){
            $data = User::whereIn('id', $ids)->delete();
            if($data){
                Session::flash('message', 'Vendors Added in Trash Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Vendors Added in Trash Successfully!']);
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
                Session::flash('message', 'Vendor Restore Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Vendor Restore Successfully!']);
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
        $data['all_users'] =  User::whereDate('created_at', date('Y-m-d'))->get();
        return view('back.new_request',$data);
    }

}
