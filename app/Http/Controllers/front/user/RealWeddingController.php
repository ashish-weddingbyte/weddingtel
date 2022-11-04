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
use App\Models\City;
use Intervention\Image\ImageManagerStatic as Image;

class RealWeddingController extends Controller
{
    public function __construct(){
        $this->middleware('is_session');
    }

    public function index(){
        
        $user_id = Session::get('user_id');

        $data['user']       =  User::find($user_id);
        $data['details']    =   UserDetail::where('user_id',$user_id)->first();
        $data['realwedd']   =   RealWedding::where('user_id',$user_id)->first();
        $data['gallery']    =   MediaGallery::where('user_id',$user_id)->where('user_type','user')->where('media_type','image')->where('tags','realwedding')->get();
        
        return view('front.user.real_wedding',$data);

    }

    public function save(Request $request){
        $request->validate([
            'feature_image' =>'image|mimes:jpg,png,jpeg|max:512',
            'gallery.*'     => 'image|mimes:jpg,png,jpeg|max:512'
        ]);

        $realwedd_id = $request->realwedd_id;
        $user_id = Session::get('user_id');

        $details = UserDetail::where('user_id',$user_id);
        $city = City::find($request->city_id);
        
        if(isset($realwedd_id)){
            $realwedd = RealWedding::find($realwedd_id);
        }else{
            $realwedd = new RealWedding;
        }

        $realwedd->user_id = $user_id;
        $realwedd->city = $city->name;

        if($request->hasFile('feature_image')) {

            Storage::delete('public/upload/realwedding/profile/'.$realwedd->featured_image);
            $image_name  =  $request->file('feature_image')->hashName();
            $realwedd->featured_image = $image_name;
            $request->file('feature_image')->storeAs('public/upload/realwedding/profile',$image_name);
            $realwedd->save();
        }


        if($request->hasfile('gallery')){
            $images_count = count( $request->file('gallery') );
            
            if($images_count <= 6){

                foreach($request->file('gallery') as $key => $file)
                {
                    $image_name = $file->hashName();
                    $file->storeAs('public/upload/realwedding/gallery',$image_name);

                    $media = new MediaGallery;
                    $media->user_id = $user_id;
                    $media->media_type = 'image';
                    $media->name = $image_name;
                    $media->status = '1';
                    $media->user_type = 'user';
                    $media->tags = 'realwedding';
                    $media->save();
                }
                
                $realwedd->is_gallery = '1';
                $realwedd->save();

            }else{
                Session::flash('message', 'Can not upload more than 6 images at once.');
                Session::flash('class', 'alert-danger');
                return redirect("/tools/real-wedding");
            }
        }

        if($request->filled('my_name')){
            $realwedd->name = $request->my_name;
            $realwedd->save();
        }

        if($request->filled('partner_name')){
            $realwedd->partner_name = $request->partner_name;
            $realwedd->save();

            $user_data = UserDetail::where('user_id',$user_id)->first();
            $user_data->partner_name = $request->partner_name;
            $user_data->save();
        }

        if($request->filled('description')){
            libxml_use_internal_errors(true);
            $description = $request->description;
            $dom = new \DomDocument();
            $dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        
            $images = $dom->getElementsByTagName('img');
            
            foreach($images as $img){
                $src = $img->getAttribute('src');
                
                // if the img source is 'data-url'
                if(preg_match('/data:image/', $src)){
                    
                    // get the mimetype
                    preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                    $mimetype = $groups['mime'];
                    
                    // Generating a random filename
                    $filename = uniqid();
                    $filepath = "/uploads/realwedding/$filename.$mimetype";
        
                    // @see http://image.intervention.io/api/
                    $image = Image::make($src)
                    // resize if required
                    /* ->resize(300, 200) */
                    ->encode($mimetype, 100)
                    ->save(public_path($filepath));
                    
                    $new_src = asset($filepath);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $new_src);
                }
            } 
            
            $description = $dom->saveHTML();

            $realwedd->description = $description;
            $realwedd->save();
        }

        Session::flash('message', 'Submit Your Wedding Successfully!');
        Session::flash('class', 'alert-success');
        return redirect("/tools/real-wedding");
    }


    public function delete_image(Request $request){

        $user_id = Session::get('user_id');

        if($request->type == 'profile_image'){
            $realwedd_id = $request->id;
            $realwedd = RealWedding::find($realwedd_id);

            if($user_id  == $realwedd->user_id){
                Storage::delete('public/upload/realwedding/profile/'.$realwedd->featured_image);
                $realwedd->featured_image = "";
                $realwedd->save();

                Session::flash('message', 'Featured Image Delete Successfully!');
                Session::flash('class', 'alert-success');

            }else{
                Session::flash('message', 'Invalid Real-Wedding Details!');
                Session::flash('class', 'alert-danger');
            }

        }

        if($request->type == 'gallery'){
            $gallery_id = $request->gallery_id;

            $gallery = MediaGallery::where('id',$gallery_id)->where('user_id',$user_id)->first();

            if($gallery){
                Storage::delete('public/upload/realwedding/gallery/'.$gallery->name);
                $gallery->delete();

                Session::flash('message', 'Gallery Image Delete Successfully!');
                Session::flash('class', 'alert-success');
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
            }
        }
    }
}
