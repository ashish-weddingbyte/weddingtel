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
use admin_helper;
use Carbon\Carbon;

class Plans extends Controller
{
    public function __construct(){
        $this->middleware('is_session');
    }


    public function all_plans(){
        $data['leads'] = [];
        $data['positions'] = [];
        return view('back.all_plans',$data);
    }
}
