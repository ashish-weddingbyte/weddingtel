<?php

namespace App\Http\Controllers\front\vendor;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\VendorDetail;
use App\Models\LeadPlan;

class VendorPlanController extends Controller
{
    public function __construct(){
        $this->middleware('is_session');
    }
    
    public function plans(){
        $user_id = Session::get('user_id');

        $category = VendorDetail::where('user_id',$user_id)->first();

        $data['plans']  = LeadPlan::where('category_id',$category->category_id)->get();

        return view('front.vendor.plans',$data);
    }
}
