<?php

namespace App\Http\Controllers\front\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\VendorDetail;
use App\Models\SocialLink;
use App\Models\MediaGallery;

use Image;

class VendorProfileController extends Controller
{
    public function __construct(){
        $this->middleware('is_session');
    }

    public function profile(){

        $user_id = Session::get('user_id');
        
        $data['user'] = User::find($user_id);
        $data['details'] = VendorDetail::where('user_id',$user_id)->first();
        $data['social'] =   SocialLink::where('user_id',$user_id)->first();
        $data['gallery'] =  MediaGallery::where('user_id',$user_id)->where('user_type','vendor')->get();
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

        if($request->filled('address')){
            $detals->address = $request->address;
            $detals->save();
        }

        Session::flash('message', 'Profile Update Successfully!');
        Session::flash('class', 'alert-success');
        return redirect("/vendor/profile");
        
    }

    public function update_social(Request $request){

        


        $user_id = Session::get('user_id');

        $social_links = SocialLink::where('user_id',$user_id)->first();

        if($social_links){
            if($request->filled('facebook')){
                $request->validate([
                    'facebook'  =>  'url'
                ]);
                $social_links->facebook = $request->facebook;
                $social_links->save();
            }
            if($request->filled('twitter')){
                $request->validate([
                    'twitter'  =>  'url'
                ]);
                $social_links->twitter = $request->twitter;
                $social_links->save();
            }
            if($request->filled('instagram')){
                $request->validate([
                    'instagram'  =>  'url'
                ]);
                $social_links->instagram = $request->instagram;
                $social_links->save();
            }
            if($request->filled('youtube')){
                $request->validate([
                    'youtube'  =>  'url'
                ]);
                $social_links->youtube = $request->youtube;
                $social_links->save();
            }

            if($request->filled('website')){
                $request->validate([
                    'website'  =>  'url'
                ]);
                $social_links->website = $request->website;
                $social_links->save();
            }
            Session::flash('message', 'Social Links Update Successfully!');
            Session::flash('class', 'alert-success');
            return redirect("/vendor/profile");

        }else{
            Session::flash('message', 'Somthing Went Wrong!');
            Session::flash('class', 'alert-danger');
            return redirect("/vendor/profile");
        }
    }


    public function update_business_profie(Request $request){
        
        $user_id = Session::get('user_id');


        $detals = VendorDetail::where('user_id',$user_id)->first();

        if($detals){

            if($request->filled('brandname')){
                $detals->brandname = $request->brandname;
                $detals->save();
            }

            if ($request->hasFile('featured_image')) {
                $request->validate([
                    'featured_image'  =>'image|mimes:jpg,png,jpeg|max:1024',
                ]);
                Storage::delete('public/upload/vendor/business'.$detals->featured_image);
                $image_name  =  $request->file('featured_image')->hashName();
                $detals->featured_image = $image_name;
                $request->file('featured_image')->storeAs('public/upload/vendor/business',$image_name);
                $detals->save();
            }



            if($request->filled('description')){
                $detals->description = $request->description;
                $detals->save();
            }

            if($request->filled('service_offered')){
                $detals->service_offered = $request->service_offered;
                $detals->save();
            }
            if($request->filled('business_details')){
                $detals->business_offered = $request->business_details;
                $detals->save();
            }
            if($request->filled('travelable')){
                $request->validate([
                    'travelable'    =>  'not_in:NA'
                ]);
                $detals->is_travelable = $request->travelable;
                $detals->save();
            }
            if($request->filled('cancel_policy')){
                $detals->cancel_policy = $request->cancel_policy;
                $detals->save();
            }

            
            if($request->filled('youtube')){
                $request->validate([
                    'youtube'    =>  'url'
                ]);
                $detals->youtube = $request->youtube;
                $detals->save();
            }
            if($request->filled('advance_payment')){
                $request->validate([
                    'advance_payment'    =>  'not_in:0'
                ]);
                $detals->advance_payment = $request->advance_payment;
                $detals->save();
            }
            

            Session::flash('message', 'Profile Update Successfully!');
            Session::flash('class', 'alert-success');
            return redirect("/vendor/profile");

        }else{
            Session::flash('message', 'Somthing Went Wrong!');
            Session::flash('class', 'alert-danger');
            return redirect("/vendor/profile");
        }
    }

    public function gallery(Request $request){
        $validateImageData = $request->validate([
            'gallery' => 'required|max:512',
            'gallery.*' => 'image|mimes:jpg,png,jpeg|max:512'
        ]);

        
        if($request->hasfile('gallery')){
            $images_count = count( $request->file('gallery') );
            
            if($images_count <= 6){
                foreach($request->file('gallery') as $key => $file)
                {
                    $image_name = $file->hashName();
                    $file->storeAs('public/upload/vendor/gallery',$image_name);

                    $media = new MediaGallery;
                    $media->user_id = Session::get('user_id');
                    $media->media_type = 'image';
                    $media->name = $image_name;
                    $media->status = '1';
                    $media->user_type = 'vendor';
                    $media->save();
                }
                Session::flash('message', 'Profile Gallery Update Successfully!');
                Session::flash('class', 'alert-success');
                return redirect("/vendor/profile");
            }else{
                Session::flash('message', 'Can not upload more than 6 images at once.');
                Session::flash('class', 'alert-danger');
                return redirect("/vendor/profile");
            }
        }else{
            Session::flash('message', 'Somthing Went Wrong!');
            Session::flash('class', 'alert-danger');
            return redirect("/vendor/profile");
        }
    }


    public function delete_image(Request $request){
        $request->validate([
            'gallery_id'    =>  'required'
        ]);

        $gallery_id = $request->gallery_id;

        $image = MediaGallery::find($gallery_id);

        Storage::delete('public/upload/vendor/gallery/'.$image->name);
        $image->delete();

        Session::flash('message', 'Gallery Image Delete Successfully!');
        Session::flash('class', 'alert-success');
        
        return response()->json(['success' => 'Gallery Image Delete Successfully!']);


    }

    
}
