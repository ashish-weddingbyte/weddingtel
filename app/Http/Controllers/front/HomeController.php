<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\User;
use App\Models\VendorDetail;
use App\Models\UserDetail;
use App\Models\SocialLink;
use App\Models\MediaGallery;
use App\Models\Blog;
use App\Models\City;
use App\Models\Leads;
use vendor_helper;
use File;


class HomeController extends Controller
{
    public function  home(){
        
        $data['categories'] = Category::where('status','1')->get();
        $data['top_vendors'] =  User::join('vendor_details','vendor_details.user_id','=','users.id')
                                ->join('categories','categories.id','=','vendor_details.category_id')
                                ->join('cities','cities.id','=','vendor_details.city_id')
                                ->where('users.user_type','vendor')
                                ->where('users.status','1')
                                ->where('vendor_details.is_top','1')
                                ->where('vendor_details.featured_image','!=', NULL)
                                ->select(['users.id','users.name','users.email','users.mobile','vendor_details.brandname','vendor_details.featured_image','categories.category_name','categories.icon','cities.name as city_name'])
                                ->limit(8)
                                ->orderBy('users.id','asc')
                                ->get();

        $data['featured_vendors'] =  User::join('vendor_details','vendor_details.user_id','=','users.id')
                                ->join('categories','categories.id','=','vendor_details.category_id')
                                ->join('cities','cities.id','=','vendor_details.city_id')
                                ->where('users.user_type','vendor')
                                ->where('users.status','1')
                                ->where('vendor_details.is_featured','1')
                                ->where('vendor_details.featured_image','!=', NULL)
                                ->select(['users.id','users.name','users.email','users.mobile','vendor_details.brandname','cities.name as city_name','vendor_details.featured_image','categories.category_name','categories.icon'])
                                ->orderBy('users.id','desc')
                                ->get();
        $data['cities']     =   City::orderBy('name','asc')->get();
        $data['blogs']      =   Blog::limit(3)
                                ->join('categories','categories.id','=','blogs.category_id')
                                ->select(['blogs.*','categories.category_name'])
                                ->orderBy('id','desc')
                                ->get();
        return view('front.index',$data);
    }

    public function profile(Request $request){
        $profile_url = $request->name;
        
        $vendor_data = vendor_helper::check_verified_vendor_by_profile_url($profile_url);

        $conditions = [
            ['users.user_type','vendor'],
            ['users.status','1'],
            ['users.id',$vendor_data['id']],
            ['vendor_details.brandname',$vendor_data['brandname']],
            ['vendor_details.featured_image','!=', NULL],
        ];

        $data['vendor'] =  User::join('vendor_details','vendor_details.user_id','=','users.id')
                                    ->join('categories','categories.id','=','vendor_details.category_id')
                                    ->join('cities','cities.id','=','vendor_details.city_id')
                                    ->where($conditions)
                                    ->select(['users.id','users.name','users.email','users.mobile','vendor_details.brandname','vendor_details.featured_image','categories.category_name','categories.icon','vendor_details.profile_image','vendor_details.description','vendor_details.is_travelable','vendor_details.cancel_policy','vendor_details.advance_payment','vendor_details.youtube','vendor_details.service_offered','vendor_details.is_featured','vendor_details.is_top','cities.name as city_name' ])
                                    // ->orderBy('users.id','desc')
                                    ->first();
        $data['social_media'] = SocialLink::where('user_id',$vendor_data['id'])->first();
        $data['gallery']    =   MediaGallery::where('user_id',$vendor_data['id'])->where('user_type','vendor')->get();

        $data['featured_vendors'] =  User::join('vendor_details','vendor_details.user_id','=','users.id')
                                ->join('categories','categories.id','=','vendor_details.category_id')
                                ->join('cities','cities.id','=','vendor_details.city_id')
                                ->where('users.user_type','vendor')
                                ->where('users.status','1')
                                ->where('vendor_details.is_featured','1')
                                ->where('vendor_details.featured_image','!=', NULL)
                                ->select(['users.id','users.name','users.email','users.mobile','vendor_details.brandname','cities.name as city_name','vendor_details.featured_image','categories.category_name','categories.icon'])
                                ->orderBy('users.id','desc')
                                ->limit(3)
                                ->get();
        if(!empty($data['vendor'])){

            return view('front.vendor_details',$data);

        }else{
            return redirect('/');
        }
    }


    public function vendor_list(Request $request){
        $city = $request->city;
        $category_url = $request->category;
        $data['city']   = $city;
        $data['category'] = "";


        if($city == 'all' && $category_url == 'all'){
            $data['category'] = "All";
            $conditions = [
                ['users.user_type','vendor'],
                ['users.status','1'],
                ['vendor_details.featured_image','!=', NULL],
            ];
        }elseif($city == 'all' || $category_url == 'all'){
            
            if($category_url == 'all' &&  $city !== 'all'){
                $data['category'] = 'All';
                $city_data = City::where('name',$city)->first();
                $conditions = [
                    ['users.user_type','vendor'],
                    ['users.status','1'],
                    ['vendor_details.featured_image','!=', NULL],
                    ['vendor_details.city_id',$city_data->id],
                ];
            }
            
            if($category_url !== 'all' &&  $city == 'all'){

                $category = Category::where('category_url',$category_url)->first();
                if(!empty($category)){
                    $data['category'] = $category->category_name;
                    $conditions = [
                        ['users.user_type','vendor'],
                        ['users.status','1'],    
                        ['vendor_details.category_id',$category->id],
                        ['vendor_details.featured_image','!=', NULL],
                    ];
                }else{
                    $conditions = [
                        ['users.user_type','vendor'],
                        ['users.status','1'],
                        ['vendor_details.featured_image','!=', NULL],
                    ];
                }
            }    
            

        }else{
            $category = Category::where('category_url',$category_url)->first();
            $city_data = City::where('name',$city)->first();
            if(!empty($category)){
                $data['category'] = $category->category_name;
                $conditions = [
                    ['users.user_type','vendor'],
                    ['users.status','1'],    
                    ['vendor_details.category_id',$category->id],
                    ['vendor_details.featured_image','!=', NULL],
                    ['vendor_details.city_id',$city_data->id],
                ];
            }else{
                $conditions = [
                    ['users.user_type','vendor'],
                    ['users.status','1'],
                    ['vendor_details.featured_image','!=', NULL],
                    ['vendor_details.city_id',$city_data->id],
                ];
            }
        }
        
        $data['position_vendors'] =  User::join('vendor_details','vendor_details.user_id','=','users.id')
                                    ->join('categories','categories.id','=','vendor_details.category_id')
                                    ->join('cities','cities.id','=','vendor_details.city_id')
                                    ->where('vendor_details.listing_order','!=',NULL)
                                    ->where($conditions)
                                    ->select(['users.id','users.name','users.email','users.mobile','vendor_details.brandname','vendor_details.featured_image','categories.category_name','categories.icon','cities.name as city_name'])
                                    ->limit(100)
                                    ->orderBy('vendor_details.listing_order','asc')
                                    ->get();
                                    
        $data['all_vendors'] =  User::join('vendor_details','vendor_details.user_id','=','users.id')
                                    ->join('categories','categories.id','=','vendor_details.category_id')
                                    ->join('cities','cities.id','=','vendor_details.city_id')
                                    ->where('vendor_details.listing_order', '=', NULL)
                                    ->where($conditions)
                                    ->select(['users.id','users.name','users.email','users.mobile','vendor_details.brandname','cities.name as city_name','vendor_details.featured_image','categories.category_name','categories.icon','vendor_details.is_featured','vendor_details.is_top',])
                                    // ->orderBy('users.id','desc')
                                    ->orderBy('vendor_details.listing_order','asc')
                                    ->orderBy('vendor_details.is_top','desc')
                                    ->orderBy('vendor_details.is_featured','desc')
                                    ->paginate(51);
        return view('front.listing',$data);
    }


    public function search(Request $request){
        $request->validate([
            'category'  =>  'not_in:0',
            'city'  =>  'not_in:0',
        ]);

        $city = $request->city;
        $category = $request->category;


        return redirect("vendors/$city/$category");
    }


    public function all_blogs(){
        $data['blogs'] = Blog::join('categories','categories.id','=','blogs.category_id')
                        ->select(['blogs.*','categories.category_name','categories.category_url'])
                        ->orderBy('id','desc')
                        ->paginate(20);
        $data['popular_blogs'] = Blog::orderBy('id','asc')
                                ->limit(3)
                                ->get();
        $data['categories'] =   Category::all();
        return view('front.blogs',$data);
    }

    public function blog_details(Request $request){
        $title = str_replace('-',' ',$request->title);
        
        $data['blog'] = Blog::join('categories','categories.id','=','blogs.category_id')
                            ->select(['blogs.*','categories.category_name','categories.category_url'])
                            ->where('title', 'like', "%$title%")
                            ->first();
        $id =  $data['blog']->id; 
        $previous_id = $id-1;
        $next_id = $id+1;

        $data['previous'] = Blog::where('id',"$previous_id")->first();
        $data['next'] = Blog::where('id',"$next_id")->first();

        $data['popular_blogs'] = Blog::orderBy('id','asc')
                                ->limit(3)
                                ->get();
        $data['categories'] =   Category::all();

        return view('front.blog_details',$data);

    }

    public function blogs_by_category(Request $request){
        $category_url = $request->category;

        $category_data = Category::where('category_url',$category_url)->first();

        if($category_data){
            $data['blogs'] = Blog::join('categories','categories.id','=','blogs.category_id')
                        ->where('categories.category_url',$category_url)
                        ->select(['blogs.*','categories.category_name','categories.category_url'])
                        ->orderBy('id','desc')
                        ->paginate(20);
            $data['popular_blogs'] = Blog::orderBy('id','asc')
                                    ->limit(3)
                                    ->get();
            $data['categories'] =   Category::all();
            $data['category'] = $category_data->category_name;
            return view('front.blogs',$data);
            
        }else{
            return redirect('/');
        }
    }


    // public function add_leads(){
        
    //     $old_leads = DB::table('request_lead')->get();

    //     foreach($old_leads as $lead){
    //         $l = new Leads;
    //         $l->name = $lead->name;
    //         $l->mobile = $lead->phone;
    //         $l->budget = $lead->budget;
    //         $l->details = $lead->message;

    //         switch (ucwords($lead->category)) {
    //             case 'Makeup Artist':
    //                 $l->category_id = '1';
    //                 break;

    //                 case 'Wedding Photographers':
    //                     $l->category_id = '3';
    //                     break;

    //                     case 'Wedding Venues':
    //                         $l->category_id = '2';
    //                         break;

    //                         case 'Choreographers':
    //                             $l->category_id = '5';
    //                             break;

    //                             case 'Bridal Designers':
    //                                 $l->category_id = '4';
    //                                 break;

    //                                 case 'Wedding Planner':
    //                                     $l->category_id = '7';
    //                                     break;

    //                                     case 'Wedding Invitation':
    //                                         $l->category_id = '8';
    //                                         break;

    //                                         case 'Mehndi Artist':
    //                                             $l->category_id = '6';
    //                                             break;
                                            
    //             default:
    //                 $l->category_id = 1;
    //                 break;
    //         }

    //         $l->event_date = $lead->event_date;
    //         $l->city = $lead->city;
    //         $l->view_count  = $lead->view_lead_count;
    //         $l->status  = $lead->status;
    //         $l->apply_tags = '0';
    //         $l->save();
    //     }

    // }


    // public function  move_profile(){
    //     $vendor = VendorDetail::all();

    //     foreach($vendor as $v){
    //         if(!empty($v->featured_image)){

                

    //             $to = storage_path('app/public/upload/vendor/featured/'.$v->featured_image);
    //             $form = public_path('uploads/'.$v->featured_image);

    //             if(File::exists($form)){
    //                 File::move($form, $to);
    //                 echo 'exist and done';
    //             }else{
    //                 echo 'not exist';
    //             }

    //         }else{
    //             echo 'empty column';
    //         }
    //         echo '<br>';
    //     }

    // }


    // public function move_gallery(){
    //     $user = User::all();

    //     foreach($user as $u){
    //         $images  = DB::table('images')->where('email',$u->email)->get();

    //         if(!empty($images)){
    //             foreach($images as $img){
    //                 $gallery = new MediaGallery;
    //                 $gallery->user_id = $u->id;
    //                 $gallery->media_type = 'image';
    //                 $gallery->name = $img->file_name;
    //                 $gallery->status = '1';
    //                 $gallery->user_type = 'vendor';
    //                 $gallery->save();

    //                 $to = storage_path('app/public/upload/vendor/gallery/'.$img->file_name);
    //                 $form = public_path('uploads/'.$img->file_name);

    //                 if(File::exists($form)){
    //                     File::move($form, $to);
    //                     echo 'exist and done';
    //                 }else{
    //                     echo 'not exist';
    //                 }
    //             }
    //             echo '<br>';
    //         }else{
    //             echo 'empty';
    //         }
    //     }
    //     echo '<br>';
    // }

}
