<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Blog;
use App\Models\BlogCategory;
use Intervention\Image\ImageManagerStatic as Image;

class BlogController extends Controller
{
    public function all_blogs(){
        $data['blogs'] = Blog::whereNotIn('category_id',['9'])->orderBy('id','desc')->get();
        return view('back.all_blogs',$data);
    }

    public function add_blog(){
        $data['categories'] = BlogCategory::whereNotIn('id',['9'])->where('status','1')->get();
        return view('back.add_blog',$data);
    }

    public function save_blog(Request $request){
        $request->validate([
            'title'  =>'required|unique:blogs,title',
            'desc'  =>'required',
            'image'=>'required|image|mimes:jpg,png,jpeg|max:512',
            'category'  =>'required|not_in:0',
        ]);

        $blog_id = $request->id;
        $title = $request->title;
        $image = $request->image;
        $short_desc = $request->short_desc;
        $desc = $request->desc;
        $category_id = $request->category;

        if(isset($blog_id)){
            $blog = Blog::find($blog_id);

            $blog->title = $title;
            $blog->category_id = $category_id;
            $blog->short_desc = $short_desc;
            // $blog->desc = $desc;
            if($request->filled('desc')){
                libxml_use_internal_errors(true);
                $description = $desc;
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
                        $filepath = "/uploads/blog/$filename.$mimetype";
            
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
    
                $blog->desc = $description;
            }
            if($request->hasFile('image')) {
                // Storage::delete('public/upload/blog/'.$image);
                $image_name  =  $request->file('image')->hashName();
                $blog->featured_image = $image_name;
                $request->file('image')->storeAs('public/upload/blog',$image_name);
            }

            if($blog->save()){

                Session::flash('message', 'Blog Edit Successfully!');
                Session::flash('class', 'alert-success');
                return back();
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return back();
            }

        }else{
            $blog = new Blog;
            
            $blog->title = $title;
            $blog->category_id = $category_id;
            $blog->short_desc = $short_desc;
            // $blog->desc = $desc;
            if($request->filled('desc')){
                libxml_use_internal_errors(true);
                $description = $desc;
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
                        $filepath = "/uploads/blog/$filename.$mimetype";
            
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
    
                $blog->desc = $description;
            }
            if($request->hasFile('image')) {
                // Storage::delete('public/upload/blog/'.$image);
                $image_name  =  $request->file('image')->hashName();
                $blog->featured_image = $image_name;
                $request->file('image')->storeAs('public/upload/blog',$image_name);
            }

            $blog->tags = NULL;
            $blog->status = '1';
            $blog->added_by = 'admin';
            if($blog->save()){

                Session::flash('message', 'Blog Added Successfully!');
                Session::flash('class', 'alert-success');
                return back();
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return back();
            }
            
        } 
    }

    public function action(Request $request){
        $ids = explode(',', $request->ids);
        $action_type = $request->action;
        $url = $request->url;

        if($action_type == 'deactivate'){
            $data = Blog::whereIn('id', $ids)->update(['status'=>'0']);
            if($data){
                Session::flash('message', 'Blog Deactivate Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Blog Deactivate Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'activate'){
            $data = Blog::whereIn('id', $ids)->update(['status'=>'1']);
            if($data){
                Session::flash('message', 'Blog Activate Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Blog Activate Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'delete'){
            $data = Blog::whereIn('id', $ids)->get();
            if($data){

                foreach($data as $d){
                    Storage::delete('public/upload/blog/'.$d->featured_image);
                    $d->delete();
                }

                Session::flash('message', 'Blog Delete Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Blog Delete Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }
        
    }


    public function edit_blog(Request $request){
        $id = $request->id;
        $data['blog'] = Blog::find($id);
        $data['categories'] = BlogCategory::whereNotIn('id',['9'])->where('status','1')->get();
        return view('back.edit_blog',$data);
    }
}
