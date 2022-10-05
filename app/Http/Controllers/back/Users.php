<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\User;
use App\Models\VendorDetail;
use App\Models\UserDetail;
use App\Models\SocialLink;
use App\Models\MediaGallery;
use App\Models\City;
use admin_helper;

class Users extends Controller
{
    public function __construct(){
        $this->middleware('is_session');
    }
    
    public function all_vendors(){

        $data['all_vendors'] =  User::join('vendor_details','vendor_details.user_id','=','users.id')
                                    ->join('categories','categories.id','=','vendor_details.category_id')
                                    ->join('cities','cities.id','=','vendor_details.city_id')
                                    ->select(['users.id','users.name','users.email','users.mobile','vendor_details.brandname','cities.name as city_name','vendor_details.featured_image','categories.category_name','vendor_details.is_featured','vendor_details.is_top',])
                                    ->orderBy('users.id','desc')
                                    ->get();
        return view('back.all_vendors',$data);
    }

    public function action(Request $request){
        print_r($request);
    }
}
