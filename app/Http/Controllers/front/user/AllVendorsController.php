<?php

namespace App\Http\Controllers\front\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Category;
use App\Models\UserDetail;
use App\Models\User;

class AllVendorsController extends Controller
{
    public function __construct(){
        $this->middleware('is_session');
    }

    public function vendors(){

        $user_id = Session::get('user_id');

        $user = UserDetail::where('user_id',$user_id)->first();

        $conditions = [
            ['users.user_type','vendor'],
            ['users.status','1'],
            ['vendor_details.featured_image','!=', NULL],
            ['vendor_details.city_id',$user->city_id],
        ];
        $data['categories'] = $categories = Category::where('status','1')->get();

        
        

        $data['makeup_artist'] = User::join('vendor_details','vendor_details.user_id','=','users.id')
                                        ->join('categories','categories.id','=','vendor_details.category_id')
                                        ->join('cities','cities.id','=','vendor_details.city_id')
                                        ->where('vendor_details.listing_order', '=', NULL)
                                        ->where('vendor_details.category_id', 1)
                                        ->where($conditions)
                                        ->select(['users.id','users.name','users.email','users.mobile','vendor_details.brandname','cities.name as city_name','vendor_details.featured_image','categories.category_name','categories.icon','vendor_details.is_featured','vendor_details.is_top',])
                                        // ->orderBy('users.id','desc')
                                        ->orderBy('vendor_details.listing_order','asc')
                                        ->orderBy('vendor_details.is_top','desc')
                                        ->orderBy('vendor_details.is_featured','desc')
                                        ->limit(4)
                                        ->get();

        $data['wedding_venue'] = User::join('vendor_details','vendor_details.user_id','=','users.id')
                                        ->join('categories','categories.id','=','vendor_details.category_id')
                                        ->join('cities','cities.id','=','vendor_details.city_id')
                                        ->where('vendor_details.listing_order', '=', NULL)
                                        ->where('vendor_details.category_id', 2)
                                        ->where($conditions)
                                        ->select(['users.id','users.name','users.email','users.mobile','vendor_details.brandname','cities.name as city_name','vendor_details.featured_image','categories.category_name','categories.icon','vendor_details.is_featured','vendor_details.is_top',])
                                        // ->orderBy('users.id','desc')
                                        ->orderBy('vendor_details.listing_order','asc')
                                        ->orderBy('vendor_details.is_top','desc')
                                        ->orderBy('vendor_details.is_featured','desc')
                                        ->limit(4)
                                        ->get();
        $data['wedding_photographer'] = User::join('vendor_details','vendor_details.user_id','=','users.id')
                                        ->join('categories','categories.id','=','vendor_details.category_id')
                                        ->join('cities','cities.id','=','vendor_details.city_id')
                                        ->where('vendor_details.listing_order', '=', NULL)
                                        ->where('vendor_details.category_id', 3)
                                        ->where($conditions)
                                        ->select(['users.id','users.name','users.email','users.mobile','vendor_details.brandname','cities.name as city_name','vendor_details.featured_image','categories.category_name','categories.icon','vendor_details.is_featured','vendor_details.is_top',])
                                        // ->orderBy('users.id','desc')
                                        ->orderBy('vendor_details.listing_order','asc')
                                        ->orderBy('vendor_details.is_top','desc')
                                        ->orderBy('vendor_details.is_featured','desc')
                                        ->limit(4)
                                        ->get();

        $data['bridal_designer'] = User::join('vendor_details','vendor_details.user_id','=','users.id')
                                        ->join('categories','categories.id','=','vendor_details.category_id')
                                        ->join('cities','cities.id','=','vendor_details.city_id')
                                        ->where('vendor_details.listing_order', '=', NULL)
                                        ->where('vendor_details.category_id', 4)
                                        ->where($conditions)
                                        ->select(['users.id','users.name','users.email','users.mobile','vendor_details.brandname','cities.name as city_name','vendor_details.featured_image','categories.category_name','categories.icon','vendor_details.is_featured','vendor_details.is_top',])
                                        // ->orderBy('users.id','desc')
                                        ->orderBy('vendor_details.listing_order','asc')
                                        ->orderBy('vendor_details.is_top','desc')
                                        ->orderBy('vendor_details.is_featured','desc')
                                        ->limit(4)
                                        ->get();
        $data['choreographer'] = User::join('vendor_details','vendor_details.user_id','=','users.id')
                                        ->join('categories','categories.id','=','vendor_details.category_id')
                                        ->join('cities','cities.id','=','vendor_details.city_id')
                                        ->where('vendor_details.listing_order', '=', NULL)
                                        ->where('vendor_details.category_id', 5)
                                        ->where($conditions)
                                        ->select(['users.id','users.name','users.email','users.mobile','vendor_details.brandname','cities.name as city_name','vendor_details.featured_image','categories.category_name','categories.icon','vendor_details.is_featured','vendor_details.is_top',])
                                        // ->orderBy('users.id','desc')
                                        ->orderBy('vendor_details.listing_order','asc')
                                        ->orderBy('vendor_details.is_top','desc')
                                        ->orderBy('vendor_details.is_featured','desc')
                                        ->limit(4)
                                        ->get();

        $data['mehndi_artist'] = User::join('vendor_details','vendor_details.user_id','=','users.id')
                                        ->join('categories','categories.id','=','vendor_details.category_id')
                                        ->join('cities','cities.id','=','vendor_details.city_id')
                                        ->where('vendor_details.listing_order', '=', NULL)
                                        ->where('vendor_details.category_id', 6)
                                        ->where($conditions)
                                        ->select(['users.id','users.name','users.email','users.mobile','vendor_details.brandname','cities.name as city_name','vendor_details.featured_image','categories.category_name','categories.icon','vendor_details.is_featured','vendor_details.is_top',])
                                        // ->orderBy('users.id','desc')
                                        ->orderBy('vendor_details.listing_order','asc')
                                        ->orderBy('vendor_details.is_top','desc')
                                        ->orderBy('vendor_details.is_featured','desc')
                                        ->limit(4)
                                        ->get();
        $data['wedding_planner'] = User::join('vendor_details','vendor_details.user_id','=','users.id')
                                        ->join('categories','categories.id','=','vendor_details.category_id')
                                        ->join('cities','cities.id','=','vendor_details.city_id')
                                        ->where('vendor_details.listing_order', '=', NULL)
                                        ->where('vendor_details.category_id', 7)
                                        ->where($conditions)
                                        ->select(['users.id','users.name','users.email','users.mobile','vendor_details.brandname','cities.name as city_name','vendor_details.featured_image','categories.category_name','categories.icon','vendor_details.is_featured','vendor_details.is_top',])
                                        // ->orderBy('users.id','desc')
                                        ->orderBy('vendor_details.listing_order','asc')
                                        ->orderBy('vendor_details.is_top','desc')
                                        ->orderBy('vendor_details.is_featured','desc')
                                        ->limit(4)
                                        ->get();

        
        $data['wedding_invitation'] = User::join('vendor_details','vendor_details.user_id','=','users.id')
                                        ->join('categories','categories.id','=','vendor_details.category_id')
                                        ->join('cities','cities.id','=','vendor_details.city_id')
                                        ->where('vendor_details.listing_order', '=', NULL)
                                        ->where('vendor_details.category_id', 8)
                                        ->where($conditions)
                                        ->select(['users.id','users.name','users.email','users.mobile','vendor_details.brandname','cities.name as city_name','vendor_details.featured_image','categories.category_name','categories.icon','vendor_details.is_featured','vendor_details.is_top',])
                                        // ->orderBy('users.id','desc')
                                        ->orderBy('vendor_details.listing_order','asc')
                                        ->orderBy('vendor_details.is_top','desc')
                                        ->orderBy('vendor_details.is_featured','desc')
                                        ->limit(4)
                                        ->get();

        return view('front.user.vendors',$data);
    }
}
