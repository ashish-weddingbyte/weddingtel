<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
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
                Session::flash('message', 'Position Plan Restore Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Position Plan Restore Successfully!']);
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

                Session::flash('message', 'Position Plan Delete Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Position Plan Delete Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }
  
    }

    public function add_plan(){
        $data['categories'] = Category::where('status','1')->get();
        return view('back.add_plan',$data);
    }


    public function save_lead_plan(Request $request){
        $request->validate([
            'name'  =>'required',
            'type'  =>'required|not_in:0',
            'price'  =>'required',
            'leads'  =>'required',
            'days'  =>'required',
            'category'  =>'required|not_in:0',
            'plan_image'  =>'required|image|mimes:jpg,png,jpeg|max:512',
            'support'=>'required'
        ]);

        $image_name  =  $request->file('plan_image')->getClientOriginalName();

        $plan = new LeadPlan();
        $plan->category_id = $request->category;
        $plan->name = $request->name;
        $plan->plan_type = $request->type;
        $plan->price = $request->price;
        $plan->days = $request->days;
        $plan->leads = $request->leads;
        $plan->desc = $request->details;
        $plan->support = $request->support;
        $plan->status = '1';
        $plan->image = $image_name;
        
        if($plan->save()){

            $request->file('plan_image')->storeAs('public/upload/plans',$image_name);
            
            Session::flash('message', 'Plan Added Successfully!');
            Session::flash('class', 'alert-success');
            return back();
        }else{
            Session::flash('message', 'Somthing Went Wrong!');
            Session::flash('class', 'alert-danger');
            return back();
        }

    }

    public function archive_plan(){
        $data['leads'] = LeadPlan::join('categories','categories.id','lead_plans.category_id')
                            ->select(['lead_plans.*','categories.category_name'])
                            ->orderBy('id','desc')
                            ->onlyTrashed()->get();
        $data['positions'] = PositionPlan::onlyTrashed()->get();
        return view('back.archive_plans',$data);
    }


    public function save_position_plan(Request $request){
        $request->validate([
            'plan_name'  =>'required',
            'from'  =>'required',
            'to'  =>'required',
            'plan_price'  =>'required',
            'plan_days'  =>'required',
            'position_plan_image'  =>'required|image|mimes:jpg,png,jpeg|max:512',
        ]);

        $range = $request->from.'-'.$request->to;
        $image_name  =  $request->file('position_plan_image')->getClientOriginalName();

        $position = new PositionPlan();
        $position->name = $request->plan_name;
        $position->position = $range;
        $position->price    = $request->plan_price;
        $position->days     =   $request->plan_days;
        $position->desc     =   $request->details;
        $position->image    =   $image_name;
        $position->status   =   '1';

        if($position->save()){

            $request->file('position_plan_image')->storeAs('public/upload/plans',$image_name);
            
            Session::flash('message', 'Plan Added Successfully!');
            Session::flash('class', 'alert-success');
            return back();
        }else{
            Session::flash('message', 'Somthing Went Wrong!');
            Session::flash('class', 'alert-danger');
            return back();
        }

    }


    public function edit_plan(Request $request){
        $id = $request->id;
        $type = request()->segment(4);
        $data['type'] = $type;
        if($type == 'edit_lead_plan'){
            $data['plan'] = LeadPlan::find($id);
        }
        if($type == 'edit_position_plan'){
            $data['plan'] =  PositionPlan::find($id);
        }
        $data['categories'] = Category::where('status','1')->get();
        return view('back.edit_plan',$data);
    }

    public function update_plan(Request $request){
        $plan_type = $request->plan_type;
        $id =   $request->id;
        if($plan_type == 'lead_plan'){
            $request->validate([
            'name'  =>'required',
            'type'  =>'required|not_in:0',
            'price'  =>'required',
            'leads'  =>'required',
            'days'  =>'required',
            'category'  =>'required|not_in:0',
            'plan_image'  =>'image|mimes:jpg,png,jpeg|max:512',
            'support'=>'required'
            ]);
            
            $plan =LeadPlan::find($id);
            if($plan){
                $plan->category_id = $request->category;
                $plan->name = $request->name;
                $plan->plan_type = $request->type;
                $plan->price = $request->price;
                $plan->days = $request->days;
                $plan->leads = $request->leads;
                $plan->desc = $request->details;
                $plan->support = $request->support;
                $plan->save();

                if ($request->hasFile('plan_image')) {

                    Storage::delete('public/upload/plans/'.$plan->image);
                    $image_name  =  $request->file('plan_image')->getClientOriginalName();
                    $plan->image = $image_name;
                    $request->file('plan_image')->storeAs('public/upload/plans',$image_name);
                    $plan->save();
                }
                Session::flash('message', 'Plan Update Successfully!');
                Session::flash('class', 'alert-success');
                return back();
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return back();
            }
        }

        if($plan_type = 'position_plan'){
            $request->validate([
                'plan_name'  =>'required',
                'from'  =>'required',
                'to'  =>'required',
                'plan_price'  =>'required',
                'plan_days'  =>'required',
                'position_plan_image'  =>'image|mimes:jpg,png,jpeg|max:512',
            ]);

            $range = $request->from.'-'.$request->to;
            $position = PositionPlan::find($id);
            if($position){
                $position->name = $request->plan_name;
                $position->position = $range;
                $position->price    = $request->plan_price;
                $position->days     =   $request->plan_days;
                $position->desc     =   $request->details;
                $position->save();

                if ($request->hasFile('position_plan_image')) {

                    Storage::delete('public/upload/plans/'.$position->image);
                    $image_name  =  $request->file('position_plan_image')->getClientOriginalName();
                    $position->image = $image_name;
                    $request->file('position_plan_image')->storeAs('public/upload/plans',$image_name);
                    $position->save();
                }

                Session::flash('message', 'Plan Update Successfully!');
                Session::flash('class', 'alert-success');
                return back();

            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return back();
            }
        }
    }

    public function check_positions($id){

    }
}
