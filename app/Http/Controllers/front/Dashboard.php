<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function dashboard(){
        return view('front.dashboard');
    }
}
