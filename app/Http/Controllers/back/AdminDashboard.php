<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\User;
use App\Models\VendorDetail;
use App\Models\UserDetail;
use App\Models\SocialLink;
use App\Models\MediaGallery;
use App\Models\City;
use App\Models\PositionPaidVendor;
use App\Models\LeadPaidVendor;
use App\Models\LeadViewStatus;
use App\Models\LeadPlan;
use App\Models\PaymentHistory;

use admin_helper;
use Carbon\Carbon;

class AdminDashboard extends Controller
{
    public function __construct(){
        $this->middleware('is_session');
    }

    public function dashboard(){

        admin_helper::expiry_vendors();

        $data['lead_paid_vendor_count'] = LeadPaidVendor::where('is_active','1')->distinct('user_id')->count(); 
        $data['all_vendor_count'] = User::where('user_type','vendor')->count();
        $data['posotion_paid_vendor_count'] =  PositionPaidVendor::where('is_active','1')->distinct('user_id')->count();

        $data['all_user_count'] = User::where('user_type','user')->count();
        $data['category_count'] = Category::where('status','1')->count();
        $data['city_count'] = City::where('status','1')->count();
        return view('back.dashboard',$data);
    }
}
