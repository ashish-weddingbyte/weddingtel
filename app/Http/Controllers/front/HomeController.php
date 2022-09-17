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
use App\Models\Query;
use App\Models\Otp;
use vendor_helper;
use otp_helper;
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


    public function send_message(Request $request){
        $request->validate([
            'name' => 'required',
            'number' => 'required|max:10|min:10',
            'budget'  =>  'required|not_in:0',
            'event' =>  'required|date|after:today',
        ]);

        $is_logged_in = $request->is_logged_in;
        $name = $request->name;
        $mobile = $request->number;
        $budget = $request->budget;
        $event = date('Y-m-d',strtotime($request->event));
        $details = $request->details;
        $type = 'send_message';
        $vendor_id = $request->vendor_id;
        
        $conditions = [
            ['query_type',$type],
            ['mobile',$mobile],
            ['event_date',$event],
            ['vendor_id',$vendor_id]
        ];

        if($is_logged_in == 1){
            // for loggedin user.
            $user_id = $request->user_id;
            $query = Query::where($conditions)->where('vendor_id',$vendor_id)->first();

            if(!empty($query)){

                $array = [
                    'query_type' =>  $type,
                    'status'    =>  '1',
                    'message'   =>  '<div class="alert alert-danger">You Already Send Message!</div>'
                ];

                return response()->json($array);

            }else{

                $query = new Query;
                $query->user_id = $user_id;
                $query->vendor_id = $vendor_id;
                $query->user_type = 'user';
                $query->query_type = $type;
                $query->name = $name;
                $query->mobile = $mobile;
                $query->budget = $budget;
                $query->event_date = $event;
                $query->details = $details;
                $query->is_mobile_verified = '1';
                $query->save();

                $array = [
                    'query_type' =>  $type,
                    'status'    =>  '1',
                    'message'   =>  '<div class="alert alert-success">Message Send Successfully!</div>'
                ];
                return response()->json($array);
            }

        }else{

            // for new guest user.
            $query = Query::where($conditions)->first();

            $otp_code = rand(111111,999999);
            $message = "Your One Time Password for WeddingByte.com Verification is $otp_code. Plase do not share this OTP with anyone.Thanks";

            $otp_model = Otp::where('mobile',$mobile)->where('otp_from','query')->first();

            if(!empty($otp_model)){
                //  available recode 
            }else{
                $otp_model = new Otp;
                $otp_model->mobile = $mobile;
                
            }

            $otp_model->name   = $name;
            $otp_model->otp_from   = 'query';
            $otp_model->otp = $otp_code;
            $otp_model->status = '1';
            
            $otp_model->save();

            $otp_id = $otp_model->id;

            

            if(!empty($query)){

                if($query->is_mobile_verified == '0'){

                    $otp_send_status = otp_helper::send_otp($mobile,$message);

                    $array = [
                        'type'      =>  'otp',
                        'otp_id'    =>  $otp_id,
                        'query_id'   =>  $query->id,
                        'mobile'    =>  $mobile,
                        'query_type'      =>  $type,
                    ];
    
                    return response()->json($array);

                }else{
                    $array = [
                        'query_type' =>  $type,
                        'status'    =>  '1',
                        'message'   =>  '<div class="alert alert-success">You Already Send Message!</div>'
                    ];
                    return response()->json($array);
                }

            }else{

                $otp_send_status = otp_helper::send_otp($mobile,$message);

                $query = new Query;
                $query->vendor_id = $vendor_id;
                $query->user_type = 'guest';
                $query->query_type = $type;
                $query->name = $name;
                $query->mobile = $mobile;
                $query->budget = $budget;
                $query->event_date = $event;
                $query->details = $details;
                $query->is_mobile_verified = '0';
                $query->save();

                $query_id = $query->id;


                $array = [
                    'type'      =>  'otp',
                    'otp_id'    =>  $otp_id,
                    'query_id'   =>  $query_id,
                    'mobile'    =>  $mobile,
                    'query_type'      =>  $type,
                ];

                return response()->json($array);
            }

        }


    }

    public function view_contact(Request $request){
        $request->validate([
            'full_name' => 'required',
            'mobile' => 'required|max:10|min:10',
        ]);

        $is_logged_in = $request->is_logged_in;
        $name = $request->full_name;
        $mobile = $request->mobile;
        $type = 'view_contact';
        $vendor_id = $request->vendor_id;
        $today = date('Y-m-d');

        $vendor_data = User::where('id',$vendor_id)->first();

        $conditions = [
            ['query_type',$type],
            ['mobile',$mobile],
            ['vendor_id',$vendor_id]
        ];

        if($is_logged_in == 1){
            // for loggedn user.
            $user_id = $request->user_id;
            
            $query = Query::where($conditions)->whereDate('created_at', $today)->first();

            if(!empty($query)){
                $array = [
                    'query_type'    =>  $type,
                    'status'    =>  '1',
                    'verify'    =>  'yes',
                    'data'   =>  '<div class="text-center text-success"><p>Here are the contact details of vendor</p><p><i class="fa fa-mobile"></i></p><h3><a href="tel:'.$vendor_data->mobile.'">'.$vendor_data->mobile.'</a></h3></div>'
                ];
                return response()->json($array);
            }else{

                $query = new Query;
                $query->user_id = $user_id;
                $query->vendor_id = $vendor_id;
                $query->user_type = 'user';
                $query->query_type = $type;
                $query->name = $name;
                $query->mobile = $mobile;

                $query->is_mobile_verified = '1';
                $query->save();

                $array = [
                    'query_type'    =>  $type,
                    'status'    =>  '1',
                    'verify'    =>  'yes',
                    'data'   =>  '<div class="text-center text-success"><p>Here are the contact details of vendor</p><p><i class="fa fa-mobile"></i></p><h3><a href="tel:'.$vendor_data->mobile.'">'.$vendor_data->mobile.'</a></h3></div>'
                ];
                return response()->json($array);
            }
            
        }else{

            // for new guest user.
            $query = Query::where($conditions)->whereDate('created_at', $today)->first();

            $otp_code = rand(111111,999999);
            $message = "Your One Time Password for WeddingByte.com Verification is $otp_code. Plase do not share this OTP with anyone.Thanks";

            $otp_model = Otp::where('mobile',$mobile)->where('otp_from','query')->first();

            if(!empty($otp_model)){
                //  available recode 
            }else{
                $otp_model = new Otp;
                $otp_model->mobile = $mobile;
                
            }

            $otp_model->name   = $name;
            $otp_model->otp_from   = 'query';
            $otp_model->otp = $otp_code;
            $otp_model->status = '1';
            
            $otp_model->save();

            $otp_id = $otp_model->id;

            

            if(!empty($query)){

                if($query->is_mobile_verified == '0'){

                    $otp_send_status = otp_helper::send_otp($mobile,$message);

                    $array = [
                        'type'      =>  'otp',
                        'otp_id'    =>  $otp_id,
                        'query_id'   =>  $query->id,
                        'mobile'    =>  $mobile,
                        'query_type'      =>  $type,
                    ];
    
                    return response()->json($array);

                }else{
                    $array = [
                        'query_type'    =>  $type,
                        'status'    =>  '1',
                        'verify'    =>  'yes',
                        'data'   =>  '<div class="text-center text-success"><p>Here are the contact details of vendor</p><p><i class="fa fa-mobile"></i></p><h3><a href="tel:'.$vendor_data->mobile.'">'.$vendor_data->mobile.'</a></h3></div>'
                    ];
                    return response()->json($array);
                }

            }else{

                $otp_send_status = otp_helper::send_otp($mobile,$message);

                $query = new Query;
                $query->vendor_id = $vendor_id;
                $query->user_type = 'guest';
                $query->query_type = $type;
                $query->name = $name;
                $query->mobile = $mobile;
                
                $query->is_mobile_verified = '0';
                $query->save();

                $query_id = $query->id;


                $array = [
                    'type'      =>  'otp',
                    'otp_id'    =>  $otp_id,
                    'query_id'   =>  $query_id,
                    'mobile'    =>  $mobile,
                    'query_type'      =>  $type,
                ];

                return response()->json($array);
            }
            
        }


    }

    public function verify_otp(Request $request){

        $type = $request->type ;

        if($type == 'send_message'){
            $request->validate([
                'send_message_otp' => 'required|max:6|min:6'
            ]);
            $otp = $request->send_message_otp;
        }

        if($type == 'view_contact'){
            $request->validate([
                'view_contact_otp' => 'required|max:6|min:6'
            ]);
            $otp = $request->view_contact_otp;
        }

        
        $query_id = $request->query_id;
        $otp_id = $request->otp_id;
        $query_type = $request->type;
        $vendor_id = $request->vendor_id;

        $vendor_data = User::where('id',$vendor_id)->first();

        $otp_details = Otp::where('id',$otp_id)->first();
        $query = Query::where('id',$query_id)->first();

        if(!empty($otp_details)  && !empty($query)){

            if($query_type == 'send_message'){
                if($otp_details->otp == $otp){
                    $otp_details->status = '0';
                    $otp_details->save();

                    $query->is_mobile_verified = '1';
                    $query->save();

                    $array = [
                        'query_type'    =>  $query_type,
                        'status'    =>  '1',
                        'message'   =>  '<div class="alert alert-success">OTP is Verified, Message Send Successfull.</div>'
                    ];
                    return response()->json($array);

                }else{
                    $array = [
                        'query_type'      =>  $query_type,
                        'status'    =>  '1',
                        'message'   =>  '<div class="alert alert-danger">OTP is Incorrect!</div>'
                    ];
                    
                    return response()->json($array);
                }
            }

            if($query_type == 'view_contact'){

                if($otp_details->otp == $otp){
                    $otp_details->status = '0';
                    $otp_details->save();

                    $query->is_mobile_verified = '1';
                    $query->save();

                    $array = [
                        'query_type'    =>  $query_type,
                        'status'    =>  '1',
                        'verify'    =>  'yes',
                        'mobile'    =>  $query->mobile,
                        'data'   =>  '<div class="text-center text-success"><h4>Here are the contact details of vendor</h4><p><i class="fa fa-mobile"></i></p><h3><a href="tel:'.$vendor_data->mobile.'">'.$vendor_data->mobile.'</a></h3></div>'
                    ];
                    return response()->json($array);

                }else{
                    $array = [
                        'query_type'      =>  $query_type,
                        'status'    =>  '1',
                        'verify'    =>  'no',
                        'message'   =>  '<div class="alert alert-danger">OTP is Incorrect!</div>'
                    ];
                    
                    return response()->json($array);
                }
            }


        }else{
            $array = [
                'status'    =>  '0',
                'message'   =>  '<div class="alert alert-danger">Somthing Went Wrong!</div>'
            ];

            return response()->json($array);
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
