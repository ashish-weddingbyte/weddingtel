<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\LeadPlan;
use App\Models\PositionPlan;
use App\Models\City;
use App\Models\PositionPaidVendor;
use App\Models\LeadPaidVendor;
use admin_helper;

class Plans extends Controller
{
    public function __construct(){
        $this->middleware('is_session');
    }


    public function all_plans(){
        $data['leads'] = LeadPlan::join('categories','categories.id','lead_plans.category_id')
                            ->select(['lead_plans.*','categories.category_name'])
                            ->orderBy('id','desc')
                            ->get();
        $data['positions'] = PositionPlan::all();
        return view('back.plans',$data);
    }

    public function action(Request $request){
        $ids = explode(',', $request->ids);
        $action_type = $request->action;
        $url = $request->url;

        if($action_type == 'deactivate_lead_plan'){
            $data = LeadPlan::whereIn('id', $ids)->update(['status'=>'0']);
            if($data){
                Session::flash('message', 'Plan Deactivate Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Plan Deactivate Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'activate_lead_plan'){
            $data = LeadPlan::whereIn('id', $ids)->update(['status'=>'1']);
            if($data){
                Session::flash('message', 'Plan Activate Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Plan Activate Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'delete_lead_plan'){
            $data = LeadPlan::whereIn('id', $ids)->delete();
            if($data){
                Session::flash('message', 'Plan Added in Trash Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Plan Added in Trash Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'restore_lead_paln'){
            $data = LeadPlan::whereIn('id', $ids)->withTrashed()->restore();
            if($data){
                Session::flash('message', 'Lead Plan Restore Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Lead Plan Restore Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'force_delete_lead_plan'){
            $data = LeadPlan::whereIn('id', $ids)->withTrashed()->forceDelete();
            if($data){
                VendorDetail::whereIn('user_id',$ids)->delete();
                MediaGallery::whereIn('user_id',$ids)->delete();

                Session::flash('message', 'Lead Plan Delete Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Lead Plan Delete Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }


        if($action_type == 'deactivate_position_plan'){
            $data = PositionPlan::whereIn('id', $ids)->update(['status'=>'0']);
            if($data){
                Session::flash('message', 'Plan Deactivate Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Plan Deactivate Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'activate_position_plan'){
            $data = PositionPlan::whereIn('id', $ids)->update(['status'=>'1']);
            if($data){
                Session::flash('message', 'Plan Activate Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Plan Activate Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'delete_position_plan'){
            $data = PositionPlan::whereIn('id', $ids)->delete();
            if($data){
                Session::flash('message', 'Plan Added in Trash Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Plan Added in Trash Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'restore_position_paln'){
            $data = PositionPlan::whereIn('id', $ids)->withTrashed()->restore();
            if($data){
                Session::flash('message', 'Lead Plan Restore Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Lead Plan Restore Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'force_delete_position_plan'){
            $data = PositionPlan::whereIn('id', $ids)->withTrashed()->forceDelete();
            if($data){
                VendorDetail::whereIn('user_id',$ids)->delete();
                MediaGallery::whereIn('user_id',$ids)->delete();

                Session::flash('message', 'Lead Plan Delete Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Lead Plan Delete Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }
  
    }
}
