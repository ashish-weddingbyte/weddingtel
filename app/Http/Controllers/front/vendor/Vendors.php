<?php

namespace App\Http\Controllers\front\vendor;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PaymentHistory;
use App\Models\LeadPaidVendor;
use App\Models\PositionPaidVendor;
use App\Models\VendorDetail;
use App\Models\Wishlist;
use App\Models\Review;
use App\Models\Query;
use App\Models\AddonLead;
use vendor_helper;
use Carbon\Carbon;

class Vendors extends Controller
{

    public function __construct(){
        $this->middleware('is_session');
    }

    public function dashboard(){
        vendor_helper::expiry_vendor();

        $user_id = Session::get('user_id');
        $data['details'] = VendorDetail::where('user_id',$user_id)->first();
        $data['leads'] = $paid = LeadPaidVendor::where('user_id',$user_id)
                                        ->where('is_active','1')
                                        ->orderBy('id','desc')
                                        ->first();

        $data['position'] = PositionPaidVendor::where('user_id',$user_id)
                                        ->where('is_active','1')
                                        ->first();

        $data['all_query_count'] = Query::where('vendor_id',$user_id)->count();
        $data['new_query_count'] = Query::where('vendor_id',$user_id)->where('view_status','0')->count();
        $data['viewed_query_count'] = Query::where('vendor_id',$user_id)->where('view_status','1')->count();

        if(!empty($paid)){                                
            $end_date = new Carbon($paid->end_at);
            $now = new Carbon( date('Y-m-d') );
            $data['plan_expire_days'] = $end_date->diffInDays($now);
        } 
        return view('front.vendor.dashboard',$data);
    }
    
    

    public function review(){
        $user_id = Session::get('user_id');

        $data['avg_count'] = Review::where('vendor_id',$user_id)->avg('rating');
        $data['total'] =   Review::where('vendor_id',$user_id)->count();
        $data['all_ratings'] = Review::where('vendor_id',$user_id)->where('status','1')->orderBy('id','desc')->get();
        return view('front.vendor.review',$data);
    }
    

    public function query(){
        return view('front.vendor.query');
    }

    public function invoice(){
        $user_id = Session::get('user_id');
        $data['payments'] = PaymentHistory::where('user_id',$user_id)->orderBy('id','desc')->get();
        return view('front.vendor.invoice',$data);
    }

    public function template(){
        return view('front.vendor.template');
    }

    public function wishlist(){

        $user_id = Session::get('user_id');

        $conditions = [
            ['users.user_type','user'],
            ['users.status','1'],
            ['wishlists.to_id',$user_id]
        ];
        
        $data['all_vendors']  = Wishlist::join('user_details','user_details.user_id','=','wishlists.from_id')
                                ->join('users', 'users.id', '=', 'wishlists.from_id')
                                ->join('cities','cities.id','=','user_details.city_id')
                                ->where($conditions)
                                ->select(['users.id','users.name','cities.name as city_name','wishlists.created_at','users.mobile'])
                                ->orderBy('wishlists.id','desc')
                                ->get();
        return view('front.vendor.wishlist',$data);
    }


    public function addons(){
        $user_id = Session::get('user_id');

        $paid = LeadPaidVendor::where('user_id',$user_id)
                                        ->where('is_active','1')
                                        ->orderBy('id','desc')
                                        ->first();

        if( !empty( $paid) ){
            $from_date = $paid->start_at;
            $data['addons'] = AddonLead::where('user_id',$user_id)->whereDate('created_at','>=', $from_date)->get();
            return view('front.vendor.addons',$data);

        }else{
            return back();
        }

    }
}
