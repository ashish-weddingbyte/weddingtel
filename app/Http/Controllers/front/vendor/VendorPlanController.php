<?php

namespace App\Http\Controllers\front\vendor;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\VendorDetail;
use App\Models\LeadPlan;
use App\Models\PositionPlan;
use App\Models\City;
use App\Models\LeadPaidVendor;
use App\Models\PositionPaidVendor;

class VendorPlanController extends Controller
{
    public function __construct(){
        $this->middleware('is_session');
    }
    
    public function plans(){
        $user_id = Session::get('user_id');

        $data['vendor_plan'] = $paid = LeadPaidVendor::where('user_id',$user_id)
                                        ->where('is_active','1')
                                        ->orderBy('id','desc')
                                        ->first();

        $category = VendorDetail::where('user_id',$user_id)->first();

        $data['plans']  = LeadPlan::where('category_id',$category->category_id)->where('status','1')->orderBy('price','asc')->get();

        $data['position_plans'] = PositionPlan::all();

        $data['cities'] = City::orderBy('name','asc')->get();

        return view('front.vendor.plans',$data);
    }
}
