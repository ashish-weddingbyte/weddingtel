<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LeadsImport;
use App\Models\Leads;
use App\Models\User;
use App\Models\Category;
use App\Models\LeadViewStatus;
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


    public function add_lead(Request $request){
        $data['categories'] = Category::where('status','1')->get();
        return view('back.add_lead',$data);
    }


    public function save_lead(Request $request){
        $request->validate([
            'name'  =>'required',
            'mobile'  =>'required|max:10|min:10',
            'budget'=>'required|not_in:0',
            'category'  =>'required|not_in:0',
            'event_date'  =>'required|date|after:today',
            'city'=>'required'
        ]);

        $lead = new Leads();

        $lead->name = $request->name;
        $lead->mobile = $request->mobile;
        $lead->budget = $request->budget;
        $lead->details = $request->details;
        $lead->category_id = $request->category;
        $lead->event_date = $request->event_date;
        $lead->city = $request->city;
        $lead->type = 'new';
        $lead->status = '1';
        $lead->approved_status = '1';
        $lead->view_count = '0';
        $lead->apply_tags = '0';
        
        
        if($lead->save()){
            Session::flash('message', 'Lead Added Successfully!');
            Session::flash('class', 'alert-success');
            return redirect("/byte/leads/add_lead");
        }else{
            Session::flash('message', 'Somthing Went Wrong!');
            Session::flash('class', 'alert-danger');
            return redirect('/byte/leads/add_lead');
        }
    }

    public function upload_leads(Request $request){
        $request->validate([
            'excel' => 'required'
        ]);

        if( Excel::import(new LeadsImport,$request->file('excel'))){
            Session::flash('message', 'Lead Uploaded Successfully!');
            Session::flash('class', 'alert-success');
            return redirect("/byte/leads/add_lead");
        }else{
            Session::flash('message', 'Somthing Went Wrong!');
            Session::flash('class', 'alert-danger');
            return redirect('/byte/leads/add_lead');
        }
    }


    public function edit_leads(Request $request){
        $lead_id =  $request->id;
        $data['lead'] = Leads::find($lead_id);
        $data['categories'] = Category::where('status','1')->get();
        return view('back.edit_lead',$data);
    }

    public function update_leads(Request $request){
        $request->validate([
            'name'  =>'required',
            'mobile'  =>'required|max:10|min:10',
            'budget'=>'required',
            'category'  =>'required|not_in:0',
            'event_date'  =>'required|date|after:today',
            'city'=>'required'
        ]);
        $lead_id = $request->lead_id;
        $lead = Leads::find($lead_id);

        if($lead){
            $lead->name = $request->name;
            $lead->mobile = $request->mobile;
            $lead->budget = $request->budget;
            $lead->details = $request->details;
            $lead->category_id = $request->category;
            $lead->event_date = $request->event_date;
            $lead->city = $request->city;
            $lead->save();
            Session::flash('message', 'Lead Update Successfully!');
            Session::flash('class', 'alert-success');
            return back();
        }else{
            Session::flash('message', 'Somthing Went Wrong!');
            Session::flash('class', 'alert-danger');
            return back();
        }
    }

    public function open_lead_vendors(Request $request){

        $lead_id = $request->id;
        
        $data['lead'] = Leads::find($lead_id);

        $data['vendors'] = LeadViewStatus::join('users','users.id','=','lead_view_status.user_id')
                                            ->where('lead_view_status.lead_id',$lead_id)
                                            ->orderBy('lead_view_status.id','desc')
                                            ->select(['lead_view_status.*','users.id','users.name','users.email','users.mobile',])
                                            ->get();
        return view('back.open_lead_vendors',$data);
    }
    
}
