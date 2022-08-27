<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\User;
use App\Models\VendorDetail;
use App\Models\UserDetail;
use App\Models\SocialLink;

use vendor_helper;

class HomeController extends Controller
{
    public function  home(){
        
        $data['categories'] = Category::where('status','1')->get();
        $data['top_vendors'] =  User::join('vendor_details','vendor_details.user_id','=','users.id')
                                ->join('categories','categories.id','=','vendor_details.category_id')
                                ->where('users.user_type','vendor')
                                ->where('users.status','1')
                                ->where('vendor_details.is_top','1')
                                ->where('vendor_details.featured_image','!=', NULL)
                                ->select(['users.id','users.name','users.email','users.mobile','vendor_details.brandname','vendor_details.city','vendor_details.featured_image','categories.category_name','categories.icon'])
                                ->limit(9)
                                ->orderBy('users.id','desc')
                                ->get();

        $data['featured_vendors'] =  User::join('vendor_details','vendor_details.user_id','=','users.id')
                                ->join('categories','categories.id','=','vendor_details.category_id')
                                ->where('users.user_type','vendor')
                                ->where('users.status','1')
                                ->where('vendor_details.is_featured','1')
                                ->where('vendor_details.featured_image','!=', NULL)
                                ->select(['users.id','users.name','users.email','users.mobile','vendor_details.brandname','vendor_details.city','vendor_details.featured_image','categories.category_name','categories.icon'])
                                ->orderBy('users.id','desc')
                                ->get();
        $data['cities']     =   VendorDetail::select('city')->groupBy('city')->orderBy('city','asc')->get();
       
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
                                    ->where($conditions)
                                    ->select(['users.id','users.name','users.email','users.mobile','vendor_details.brandname','vendor_details.city','vendor_details.featured_image','categories.category_name','categories.icon','vendor_details.profile_image','vendor_details.description','vendor_details.is_travelable','vendor_details.cancel_policy','vendor_details.advance_payment','vendor_details.youtube','vendor_details.service_offered','vendor_details.is_featured','vendor_details.is_top'])
                                    // ->orderBy('users.id','desc')
                                    ->first();
        $data['social_media'] = SocialLink::where('user_id',$vendor_data['id'])->first();

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
                $conditions = [
                    ['users.user_type','vendor'],
                    ['users.status','1'],
                    ['vendor_details.featured_image','!=', NULL],
                    ['vendor_details.city',$city],
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

            if(!empty($category)){
                $data['category'] = $category->category_name;
                $conditions = [
                    ['users.user_type','vendor'],
                    ['users.status','1'],    
                    ['vendor_details.category_id',$category->id],
                    ['vendor_details.featured_image','!=', NULL],
                    ['vendor_details.city',$city],
                ];
            }else{
                $conditions = [
                    ['users.user_type','vendor'],
                    ['users.status','1'],
                    ['vendor_details.featured_image','!=', NULL],
                    ['vendor_details.city',$city],
                ];
            }
        }
        

        $data['all_vendors'] =  User::join('vendor_details','vendor_details.user_id','=','users.id')
                                    ->join('categories','categories.id','=','vendor_details.category_id')
                                    ->where($conditions)
                                    ->select(['users.id','users.name','users.email','users.mobile','vendor_details.brandname','vendor_details.city','vendor_details.featured_image','categories.category_name','categories.icon','vendor_details.is_featured','vendor_details.is_top',])
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



}
