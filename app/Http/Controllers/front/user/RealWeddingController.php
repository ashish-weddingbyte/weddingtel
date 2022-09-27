<?php

namespace App\Http\Controllers\front\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\RealWedding;
use App\Models\MediaGallery;

class RealWeddingController extends Controller
{
    public function __construct(){
        $this->middleware('is_session');
    }

    public function index(){
        
        $user_id = Session::get('user_id');

        $data['user']   =  User::find($user_id);
        $data['details']    =   UserDetail::where('user_id',$user_id)->first();
        $data['realwedd']   =   RealWedding::where('user_id',$user_id)->first();
        $data['gallery']    =   MediaGallery::where('user_id',$user_id)->where('user_type','user')->where('media_type','image')->where('tags','realwedding')->get();
        
        return view('front.user.real_wedding',$data);

    }

    // public function save(Request $request){
    //     $request->validate([
    //         'feature_image' =>'image|mimes:jpg,png,jpeg|max:512',
    //         'gallery.*'     => 'image|mimes:jpg,png,jpeg|max:512'
    //     ]);

    //     $realwedd_id = $request->realwedd_id;
    //     $user_id = Session::get('user_id');
        
    //     if(isset($realwedd_id)){
    //         $realwedd = RealWedding::find($realwedd_id);
    //     }else{
    //         $realwedd = new RealWedding;
    //     }

    //     $realwedd->user_id = $user_id;

    //     if($request->hasFile('feature_image')) {

    //         Storage::delete('public/upload/realwedding/profile/'.$realwedd->featured_image);
    //         $image_name  =  $request->file('feature_image')->hashName();
    //         $realwedd->featured_image = $image_name;
    //         $request->file('feature_image')->storeAs('public/upload/realwedding/profile',$image_name);
    //         $realwedd->save();
    //     }


    //     if($request->hasfile('gallery')){
    //         $images_count = count( $request->file('gallery') );
            
    //         if($images_count <= 6){

    //             foreach($request->file('gallery') as $key => $file)
    //             {
    //                 $image_name = $file->hashName();
    //                 $file->storeAs('public/upload/realwedding/gallery',$image_name);

    //                 $media = new MediaGallery;
    //                 $media->user_id = $user_id;
    //                 $media->media_type = 'image';
    //                 $media->name = $image_name;
    //                 $media->status = '1';
    //                 $media->user_type = 'user';
    //                 $media->tags = 'realwedding';
    //                 $media->save();
    //             }
                
    //             $realwedd->is_gallery = '1';
    //             $realwedd->save();

    //         }else{
    //             Session::flash('message', 'Can not upload more than 6 images at once.');
    //             Session::flash('class', 'alert-danger');
    //             return redirect("/tools/real-wedding");
    //         }
    //     }

    //     Session::flash('message', 'Submit Your Wedding Successfully!');
    //     Session::flash('class', 'alert-success');
    //     return redirect("/tools/real-wedding");
    // }

    public function save(Request $request){

    }

    public function delete_featured_image(Request $request){
        return $request->all();
    }
}
