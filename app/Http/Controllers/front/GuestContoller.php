<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use App\Models\Guest;
use Validator;

class GuestContoller extends Controller
{
    public function __construct(){
        $this->middleware('is_session');
    }

    public function guestlist(){

        $user_id = Session::get('user_id');

        $data['guestlist'] = Guest::where('user_id',$user_id)->paginate(50);;

        $data['total_guest'] = Guest::where('user_id',$user_id)->count();
        $data['confirm_guest'] = Guest::where('user_id',$user_id)->where('status','confirm')->count();
        $data['pending_guest'] = Guest::where('user_id',$user_id)->where('status','pending')->count();
        $data['cancel_guest'] = Guest::where('user_id',$user_id)->where('status','cancel')->count();

        return view('front.user.guestlist',$data);
    }

    public function add_guestlist(Request $request){
        $request->validate([
            'name' => 'required',
            'group'=>  'required'
        ]);

        $user_id = Session::get('user_id');
        
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

        Session::flash('message', 'Guest Added Successfully!');
        Session::flash('class', 'alert-success');
        
        return response()->json(['success' => 'Guest Added Successfully!']);
    }

    public function edit_guestlist(Request $request){
        $request->validate([
            'name' => 'required',
            'group'=>  'required'
        ]);

        
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

        Session::flash('message', 'Guest Edit Successfully!');
        Session::flash('class', 'alert-success');
        
        return response()->json(['success' => 'Guest Edit Successfully!']);
    }

    public function delete_guestlist(Request $request){
        $request->validate([
            'guest_id'=>  'required'
        ]);

        Guest::find($request->guest_id)->delete();

        Session::flash('message', 'Guest Delete Successfully!');
        Session::flash('class', 'alert-success');
        
        return response()->json(['success' => 'Guest Delete Successfully!']);
    }
}
