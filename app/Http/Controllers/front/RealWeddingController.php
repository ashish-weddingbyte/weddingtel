<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\UserDetail;

class RealWeddingController extends Controller
{
    public function __construct(){
        $this->middleware('is_session');
    }

    public function index(){
        
        $user_id = Session::get('user_id');

        $data['user']   =  User::find($user_id);
        $data['details']    =   UserDetail::where('user_id',$user_id)->first();

        return view('front.user.real_wedding',$data);
    }

    public function update(Request $request){
        return $request;
    }
}
