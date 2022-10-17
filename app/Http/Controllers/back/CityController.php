<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\City;


class CityController extends Controller
{
    public function __construct(){
        $this->middleware('is_session');
    }

    public function all_cities(){
        $data['cities'] = City::orderBy('id','desc')->get();
        return view('back.all_city',$data);
    }


    public function action(Request $request){
        $ids = explode(',', $request->ids);
        $action_type = $request->action;
        $url = $request->url;

        if($action_type == 'deactivate'){
            $data = City::whereIn('id', $ids)->update(['status'=>'0']);
            if($data){
                Session::flash('message', 'City Deactivate Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'City Deactivate Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'activate'){
            $data = City::whereIn('id', $ids)->update(['status'=>'1']);
            if($data){
                Session::flash('message', 'City Activate Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'City Activate Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'delete'){
            $data = City::whereIn('id', $ids)->delete();
            if($data){
                Session::flash('message', 'City Add in Trash Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'City Add in Trash Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'add_is_top'){
            $data = City::whereIn('id', $ids)->update(['is_top'=>'1']);
            if($data){
                Session::flash('message', 'City Added in Top Cities Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'City Added in Top Cities Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'remove_is_top'){
            $data = City::whereIn('id', $ids)->update(['is_top'=>'0']);
            if($data){
                Session::flash('message', 'City Removed From Top Cities Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'City Removed From Top Cities Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'restore'){
            $data = City::whereIn('id', $ids)->withTrashed()->restore();
            if($data){
                Session::flash('message', 'City Restore Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'City Restore Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'force_delete'){
            $data = City::whereIn('id', $ids)->withTrashed()->forceDelete();
            if($data){
                Session::flash('message', 'City Permanent Delete Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'City Permanent Delete Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }
        
    }

    public function all_archive_cities(){
        $data['cities'] = City::orderBy('id','desc')->onlyTrashed()->get();
        return view('back.archive_city',$data);
    }

    public function add_city(){
        return view('back.add_city');
    }


    public function save_city(Request $request){
        $request->validate([
            'city_name'  =>'required',
            'state_name'  =>'required',
        ]);

        $city = new City();

        $city->name = $request->city_name;
        $city->state = $request->state_name;
        $city->status = '1';
        $city->is_top = '0';
        
        
        if($city->save()){
            Session::flash('message', 'City Added Successfully!');
            Session::flash('class', 'alert-success');
            return redirect("/byte/city/add");
        }else{
            Session::flash('message', 'Somthing Went Wrong!');
            Session::flash('class', 'alert-danger');
            return redirect('/byte/city/add');
        }
    }


    public function edit_city(Request $request){
        $id = $request->id;
        $data['city'] = City::where('id',$id)->first();
        return view('back.edit_city',$data);
    }

    public function update_city(Request $request){
        $request->validate([
            'city_name'  =>'required',
            'state_name'  =>'required',
        ]);
        $city_id = $request->city_id;
        $city = City::find($city_id);

        if($city){
            $city->name = $request->city_name;
            $city->state = $request->state_name;
            
            $city->save();
            Session::flash('message', 'City Update Successfully!');
            Session::flash('class', 'alert-success');
            return back();
        }else{
            Session::flash('message', 'Somthing Went Wrong!');
            Session::flash('class', 'alert-danger');
            return back();
        }
    }

}
