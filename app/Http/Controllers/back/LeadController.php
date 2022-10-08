<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Leads;
use admin_helper;
use Carbon\Carbon;

class LeadController extends Controller
{   
    public function __construct(){
        $this->middleware('is_session');
    }
    

    public function all_approved_leads(){
        $data['all_leads'] = Leads::join('categories','categories.id','=','leads.category_id')      
                            ->where('leads.approved_status','1')
                            ->orderBy('id','desc')
                            ->orderBy('event_date','desc')
                            ->orderBy('event_date','desc')
                            ->select(['leads.*','categories.category_name'])
                            ->get();
        return view('back.approved_leads',$data);
    }

    public function all_unapproved_leads(){
        $data['all_leads'] = Leads::join('categories','categories.id','=','leads.category_id')      
                            ->where('leads.approved_status','0')
                            ->orderBy('id','desc')
                            ->orderBy('event_date','desc')
                            ->orderBy('event_date','desc')
                            ->select(['leads.*','categories.category_name'])
                            ->get();
        return view('back.unapproved_leads',$data);
    }


    public function all_archive_leads(){
        $data['all_leads'] = Leads::join('categories','categories.id','=','leads.category_id')      
                            ->orderBy('id','desc')
                            ->orderBy('event_date','desc')
                            ->orderBy('event_date','desc')
                            ->select(['leads.*','categories.category_name'])
                            ->onlyTrashed()->get();
        return view('back.archive_leads',$data);
    }




    public function action(Request $request){
        $ids = explode(',', $request->ids);
        $action_type = $request->action;
        $url = $request->url;

        if($action_type == 'deactivate'){
            $data = Leads::whereIn('id', $ids)->update(['status'=>'0']);
            if($data){
                Session::flash('message', 'Leads Deactivate Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Leads Deactivate Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'activate'){
            $data = Leads::whereIn('id', $ids)->update(['status'=>'1']);
            if($data){
                Session::flash('message', 'Leads Activate Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Leads Activate Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'delete'){
            $data = Leads::whereIn('id', $ids)->delete();
            if($data){
                Session::flash('message', 'Leads Add in Trash Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Leads Add in Trash Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'unapproved'){
            $data = Leads::whereIn('id', $ids)->update(['approved_status'=>'0']);
            if($data){
                Session::flash('message', 'Leads Un-Approved Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Leads Un-Approved Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'approved'){
            $data = Leads::whereIn('id', $ids)->update(['approved_status'=>'1']);
            if($data){
                Session::flash('message', 'Leads Approved Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Leads Approved Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'restore'){
            $data = Leads::whereIn('id', $ids)->withTrashed()->restore();
            if($data){
                Session::flash('message', 'Leads Restore Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Leads Restore Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'force_delete'){
            $data = Leads::whereIn('id', $ids)->withTrashed()->forceDelete();
            if($data){
                Session::flash('message', 'Leads Permanent Delete Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Leads Permanent Delete Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }
        
    }
}
