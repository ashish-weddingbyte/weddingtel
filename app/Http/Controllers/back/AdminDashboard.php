<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboard extends Controller
{
    public function __construct(){
        $this->middleware('is_session');
    }


    public function dashboard(){
        return view('back.dashboard');
    }
}
