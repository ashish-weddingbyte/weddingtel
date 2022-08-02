<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

class HomeController extends Controller
{
    public function  home(){
        
        $data['categories'] = Category::where('status','1')->limit(8)->get();
        return view('front.user.index',$data);
    }
}
