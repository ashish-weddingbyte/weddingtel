<?php

namespace App\Http\Controllers\front\user;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Checklist;

use user_helper;

class ChecklistController extends Controller
{
    
    public function __construct(){
        $this->middleware('is_session');
    }

    public function checklist(){

        $user_id = Session::get('user_id');

        $default = checklist::where('user_id',$user_id)->orderBy('added_date', 'ASC')->get()->toArray();
        // $added = checklist::where('user_id',$user_id)->where('type','added')->get()->toArray();
        
        $data['all_checklist_count'] = checklist::where('user_id', $user_id)->count();

        $data['all_done_checklist_count'] = checklist::where('user_id', $user_id)->where('status','0')->count();

        $data['checklist_done_perentage'] = round(  ($data['all_done_checklist_count'] / $data['all_checklist_count']) * 100  );

        $data['default'] = user_helper::group_checklist_by_month($default);
        // $data['added'] = user_helper::group_checklist_by_month($added);

        return view('front.user.checklist',$data);
    }

    public function add_checklist(Request $request){
        $request->validate([
            'title' => 'required',
            'date'  =>  'required'
        ]);

        $user_id = Session::get('user_id');
        
        $checklist = new Checklist;
        $checklist->user_id = ($user_id)?$user_id:NULL;
        $checklist->type = 'added';
        $checklist->task = $request->title;
        $checklist->added_date = date('Y-m-d',strtotime($request->date));
        $checklist->save();

        Session::flash('message', 'Checklist Added Successfully!');
        Session::flash('class', 'alert-success');
        
        return response()->json(['success' => 'Checklist Added Successfully!']);
    }


    public function edit_checklist(Request $request){
        $request->validate([
            'title' => 'required',
            'date'  =>  'required',
            'task_id'=>  'required'
        ]);

        $checklist = Checklist::find($request->task_id);
        $checklist->type = 'edited';
        $checklist->task = $request->title;
        $checklist->added_date = date('Y-m-d',strtotime($request->date));
        $checklist->save();

        Session::flash('message', 'Checklist Edit Successfully!');
        Session::flash('class', 'alert-success');
        
        return response()->json(['success' => 'Checklist Edit Successfully!']);
        
    }

    public function delete_checklist(Request $request){
        $request->validate([
            'task_id'=>  'required'
        ]);

        Checklist::find($request->task_id)->delete();

        Session::flash('message', 'Checklist Delete Successfully!');
        Session::flash('class', 'alert-success');
        
        return response()->json(['success' => 'Checklist Delete Successfully!']);
        
    }

    public function status_of_checklist(Request $request){
        $request->validate([
            'id'   =>  'required',
            'status'    =>  'required'
        ]);

        $id = $request->id;
        $status = $request->status;

        $checklist = Checklist::find($id);
        $checklist->status = ($status == '1')? '0' : '1' ;
        $checklist->save();
        
        return response()->json(['status' => $checklist->status]);
    }



}
