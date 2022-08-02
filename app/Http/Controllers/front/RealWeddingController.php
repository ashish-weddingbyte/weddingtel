<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RealWeddingController extends Controller
{
    public function __construct(){
        $this->middleware('is_session');
    }

    public function index(){
        
        return view('front.user.real_wedding');
    }
}
