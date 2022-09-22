<?php

namespace App\Http\Controllers\front\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


use App\Models\Checklist;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Guest;
use App\Models\Category;
use App\Models\Budget;
use App\Models\City;

class UserDashboard extends Controller
{
    public function __construct(){
        $this->middleware('is_session');
    }

    public function dashboard(){
        
        $user_id = Session::get('user_id');

        $data['user']   =  User::find($user_id);
        $data['details']    =   UserDetail::join('cities','cities.id','user_details.city_id')
                                        ->where('user_details.user_id',$user_id)
                                        ->select(['user_details.*','cities.name as city'])
                                        ->first();

        $data['all_checklist_count'] = checklist::where('user_id', $user_id)->count();
        $data['all_done_checklist_count'] = checklist::where('user_id', $user_id)->where('status','0')->count();

        $data['checklist_done_perentage'] = round(  ($data['all_done_checklist_count'] / $data['all_checklist_count']) * 100  );

        $data['total_guest'] = Guest::where('user_id',$user_id)->count();
        $data['confirm_guest'] = Guest::where('user_id',$user_id)->where('status','confirm')->count();

        $data['total_category'] = Category::all()->count();
        $data['categories'] = Category::all();

        $data['checklist'] = Checklist::where('user_id',$user_id)->orderBy('added_date', 'ASC')->limit(2)->get();

        $data['budget'] = Budget::where('user_id',$user_id)->first();
        
        return view('front.user.dashboard',$data);
    }
}
