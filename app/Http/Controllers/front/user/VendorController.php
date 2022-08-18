<?php

namespace App\Http\Controllers\front\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Category;

class VendorController extends Controller
{

    public function __construct(){
        $this->middleware('is_session');
    }

    public function vendors(){

        $data['categories'] = Category::where('status','1')->get();

        return view('front.user.vendors',$data);
    }


    public function all_vendors_of_category(){
        return view('front.user.listing');
    }
    
}
