<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; 

use App\Models\User;
use App\Models\VendorDetail;
use App\Models\Query;

class QueryController extends Controller
{
    public function __construct(){
        $this->middleware('is_session');
    }

    public function view_contact(){

        $data['queries'] = Query::where('query_type','view_contact')->orderBy('id','desc')->get();
        return view('back.view_query',$data);
    }

    public function send_message(){
        $data['queries'] = Query::where('query_type','send_message')->orderBy('id','desc')->get();
        return view('back.send_query',$data);
    }

    public function action(Request $request){
        $ids = explode(',', $request->ids);
        $action_type = $request->action;
        $url = $request->url;

        if($action_type == 'deactivate'){
            $data = Query::whereIn('id', $ids)->update(['status'=>'0']);
            if($data){
                Session::flash('message', 'Query Deactivate Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Query Deactivate Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'activate'){
            $data = Query::whereIn('id', $ids)->update(['status'=>'1']);
            if($data){
                Session::flash('message', 'Query Activate Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Query Activate Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        
        
    }
}
