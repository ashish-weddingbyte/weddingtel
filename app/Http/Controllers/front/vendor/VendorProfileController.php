<?php

namespace App\Http\Controllers\front\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\VendorDetail;

class VendorProfileController extends Controller
{
    public function __construct(){
        $this->middleware('is_session');
    }

    public function profile(){

        $user_id = Session::get('user_id');
        
        $data['user'] = User::find($user_id);
        $data['details'] = VendorDetail::where('user_id',$user_id)->first();

        return view('front.vendor.profile',$data);
    }


    public function change_password(Request $request){
        $request->validate([
            'old_password'  =>'required|min:6',
            'new_password'  =>'required|min:6',
            'confirm_pasword'=>'required|min:6'
        ]);

        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $confirm_pasword = $request->confirm_pasword;

        if($new_password === $confirm_pasword){

            $user_id = Session::get('user_id');
            $user = User::find($user_id);

            if(Hash::check($old_password, $user->password)){

                $user->password = Hash::make($new_password);
                $user->save();

                Session::flash('message', 'Password Reset Successfully!');
                Session::flash('class', 'alert-success');
                return redirect("/vendor/profile");
                
            }else{
                Session::flash('message', 'Password is Incorrect!');
                Session::flash('class', 'alert-danger');
                return redirect('/vendor/profile');
            }

        }else{
            Session::flash('message', 'Password Not Matched!');
            Session::flash('class', 'alert-danger');
            return redirect('/vendor/profile');
        }
    }


    public function update_details(Request $request){
        $request->validate([
            'profile'  =>'image|mimes:jpg,png,jpeg|max:512',
        ]);


        $user_id = Session::get('user_id');

        if($request->filled('name')){
            $user = User::find($user_id);
            $user->name = $request->name;
            $user->save();
        }

        $detals = VendorDetail::where('user_id',$user_id)->first();

        if($request->filled('city')){
            $detals->city = $request->city;
            $detals->save();
        }

        if ($request->hasFile('profile')) {

            Storage::delete('public/upload/vendor/profile/'.$detals->profile_image);
            $image_name  =  $request->file('profile')->hashName();
            $detals->profile_image = $image_name;
            $request->file('profile')->storeAs('public/upload/vendor/profile',$image_name);
            $detals->save();
        }

        if($request->filled('gender')){
            $detals->gender = $request->gender;
            $detals->save();
        }

        Session::flash('message', 'Profile Update Successfully!');
        Session::flash('class', 'alert-success');
        return redirect("/vendor/profile");
        
    }

    // public function wedding_info(Request $request){
    //     $request->validate([
    //         'profile'  =>'image|mimes:jpg,png,jpeg|max:1024',
    //         'partner_profile'  =>'image|mimes:jpg,png,jpeg|max:1024',
    //     ]);

    //     $user_id = Session::get('user_id');


    //     $detals = UserDetail::where('user_id',$user_id)->first();

    //     if($request->filled('event')){
    //         $detals->event = date('Y-m-d',strtotime($request->event));
    //         $detals->save();
    //     }

    //     if ($request->hasFile('profile')) {

    //         $image_name  =  $request->file('profile')->getClientOriginalName();
    //         $detals->profile = $image_name;
    //         $request->file('profile')->storeAs('public/upload/user/profile',$image_name);
    //         $detals->save();
    //     }

    //     if ($request->hasFile('partner_profile')) {

    //         $image_name  =  $request->file('partner_profile')->getClientOriginalName();
    //         $detals->partner_profile = $image_name;
    //         $request->file('partner_profile')->storeAs('public/upload/user/profile',$image_name);
    //         $detals->save();
    //     }


    //     if($request->filled('wedding_address')){
    //         $detals->wedding_address = $request->wedding_address;
    //         $detals->save();
    //     }

        

    //     Session::flash('message', 'Profile Update Successfully!');
    //     Session::flash('class', 'alert-success');
    //     return redirect("/tools/profile");
    // }

    
}
