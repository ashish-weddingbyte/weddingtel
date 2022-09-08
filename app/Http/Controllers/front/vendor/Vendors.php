<?php

namespace App\Http\Controllers\front\vendor;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PaymentHistory;
use App\Models\LeadPaidVendor;
use App\Models\PositionPaidVendor;
use App\Models\VendorDetail;
use Carbon\Carbon;

class Vendors extends Controller
{

    public function __construct(){
        $this->middleware('is_session');
    }

    public function dashboard(){

        $user_id = Session::get('user_id');
        $data['details'] = VendorDetail::where('user_id',$user_id)->first();
        $data['leads'] = $paid = LeadPaidVendor::where('user_id',$user_id)
                                        ->where('is_active','1')
                                        ->orderBy('id','desc')
                                        ->first();

        $data['position'] = PositionPaidVendor::where('user_id',$user_id)
                                        ->where('is_active','1')
                                        ->first();

        $end_date = new Carbon($paid->end_at);
        $now = new Carbon( date('Y-m-d') );
        $data['plan_expire_days'] = $end_date->diffInDays($now);
         
        return view('front.vendor.dashboard',$data);
    }
    
    public function plans(){
        return view('front.vendor.plans');
    }

    public function review(){
        return view('front.vendor.review');
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
        return view('front.vendor.wishlist');
    }
}
