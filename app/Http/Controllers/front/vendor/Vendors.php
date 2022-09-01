<?php

namespace App\Http\Controllers\front\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Vendors extends Controller
{

    public function __construct(){
        $this->middleware('is_session');
    }


    public function dashboard(){
        return view('front.vendor.dashboard');
    }
    
    public function plans(){
        return view('front.vendor.plans');
    }

    public function review(){
        return view('front.vendor.review');
    }
    public function leads(){
        return view('front.vendor.leads');
    }

    public function query(){
        return view('front.vendor.query');
    }

    public function invoice(){
        return view('front.vendor.invoice');
    }

    public function template(){
        return view('front.vendor.template');
    }

    public function wishlist(){
        return view('front.vendor.wishlist');
    }
}
