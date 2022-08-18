<?php

namespace App\Http\Controllers\front\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Vendors extends Controller
{
    public function dashboard(){
        return view('front.vendor.dashboard');
    }
    public function profile(){
        return view('front.vendor.profile');
    }

    public function plans(){
        return view('front.vendor.plans');
    }

    public function review(){
        return view('front.vendor.review');
    }
    public function leads(){
        return view('front.vendor.dashboard');
    }

    public function request_quote(){
        return view('front.vendor.request_quote');
    }
}
