<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;


class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('is_session');
    }

    public function all_categories(){
        $data['categories'] = Category::orderBy('id','desc')->get();
        return view('back.all_categories',$data);
    }

    public function action(Request $request){
        $ids = explode(',', $request->ids);
        $action_type = $request->action;
        $url = $request->url;

        if($action_type == 'deactivate'){
            $data = Category::whereIn('id', $ids)->update(['status'=>'0']);
            if($data){
                Session::flash('message', 'Category Deactivate Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Category Deactivate Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'activate'){
            $data = Category::whereIn('id', $ids)->update(['status'=>'1']);
            if($data){
                Session::flash('message', 'Category Activate Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Category Activate Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'delete'){
            $data = Category::whereIn('id', $ids)->delete();
            if($data){
                Session::flash('message', 'Category Add in Trash Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Category Add in Trash Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'restore'){
            $data = Category::whereIn('id', $ids)->withTrashed()->restore();
            if($data){
                Session::flash('message', 'Category Restore Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Category Restore Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }

        if($action_type == 'force_delete'){
            $data = Category::whereIn('id', $ids)->withTrashed()->get();
            if($data){
                foreach($data as $d){
                    Storage::delete('public/upload/category/'.$d->image);
                }
                Category::whereIn('id', $ids)->withTrashed()->forceDelete();
                Session::flash('message', 'Category Permanent Delete Successfully!');
                Session::flash('class', 'alert-success');
                return response()->json(['status' => 'Category Permanent Delete Successfully!']);
            }else{
                Session::flash('message', 'Somthing Went Wrong!');
                Session::flash('class', 'alert-danger');
                return response()->json(['status' => 'Somthing Went Wrong!']);
            }
        }
        
    }

    public function all_archive_categories(){
        $data['categories'] = Category::orderBy('id','desc')->onlyTrashed()->get();
        return view('back.archive_categories',$data);
    }

    public function add_category(){
        return view('back.add_category');
    }


    public function save_category(Request $request){
        $request->validate([
            'name'  =>'required',
            'category_image'  =>'required|image|mimes:jpg,png,jpeg|max:512',
        ]);

        $url = strtolower( str_replace(' ','-', trim($request->name) ) );
        $image_name  =  $request->file('category_image')->getClientOriginalName();

        $category = new Category();

        $category->category_name = $request->name;
        $category->category_url = $url;
        $category->icon = $request->icon;
        $category->status = '1';
        $category->image = $image_name;
        
        
        if($category->save()){

            $request->file('category_image')->storeAs('public/upload/category',$image_name);
            
            Session::flash('message', 'Category Added Successfully!');
            Session::flash('class', 'alert-success');
            return redirect("/byte/category/add");
        }else{
            Session::flash('message', 'Somthing Went Wrong!');
            Session::flash('class', 'alert-danger');
            return redirect('/byte/category/add');
        }
    }

    public function edit_category(Request $request){
        $id = $request->id;
        $data['category'] = Category::find($id);
        return view('back.edit_category',$data);
    }


    public function update_category(Request $request){
        $request->validate([
            'name'  =>'required',
            'category_image'  =>'image|mimes:jpg,png,jpeg|max:512',
        ]);
        $id = $request->id;
        $url = strtolower( str_replace(' ','-', trim($request->name) ) );
        
        $category = Category::find($id);

        if($category){
            $category->category_name = $request->name;
            $category->category_url = $url;
            $category->icon = $request->icon;
            $category->save();


            if ($request->hasFile('category_image')) {

                Storage::delete('public/upload/category/'.$category->image);
                $image_name  =  $request->file('category_image')->getClientOriginalName();
                $category->image = $image_name;
                $request->file('category_image')->storeAs('public/upload/category',$image_name);
                $category->save();
            }

            
            Session::flash('message', 'Category Update Successfully!');
            Session::flash('class', 'alert-success');
            return back();
        }else{
            Session::flash('message', 'Somthing Went Wrong!');
            Session::flash('class', 'alert-danger');
            return back();
        }
    }
}


