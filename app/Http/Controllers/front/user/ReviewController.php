<?php

namespace App\Http\Controllers\front\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\Review;

class ReviewController extends Controller
{
    public function __construct(){
        $this->middleware('is_session');
    }

    public function reviews(){
        $user_id = Session::get('user_id');
        $data['all_ratings'] = Review::join('users','users.id','=','reviews.vendor_id')
                                ->where('reviews.user_id',$user_id)
                                ->select(['reviews.*','users.name'])
                                ->orderBy('reviews.id','desc')
                                ->get();
        $data['total_ratings'] = Review::where('user_id',$user_id)->count();
        return view('front.user.review',$data);
    }

    public function edit_review(Request $request){
        $request->validate([
            'review_id' =>  'required',
            'star'      =>  'required',
            'comment'   =>  'required',
        ]);

        $user_id = Session::get('user_id');
        $id = $request->review_id;
        $star = $request->star;
        $comment = $request->comment;
        $rating = Review::where('id',$id)->where('user_id',$user_id)->first();

        $rating->comment = $comment;
        $rating->rating   =   $star;
        $rating->save();

        Session::flash('message', 'Rating & Review Edit Successfully!');
        Session::flash('class', 'alert-success');
        
        return response()->json(['success' => 'Rating & Review Edit Successfully!']);
        
    }


    public function remove_review(Request $request){
        $request->validate([
            'review_id' =>  'required',
            
        ]);

        $user_id = Session::get('user_id');
        $id = $request->review_id;
        $rating = Review::where('id',$id)->where('user_id',$user_id)->delete();

        Session::flash('message', 'Rating & Review Delete Successfully!');
        Session::flash('class', 'alert-success');
        
        return response()->json(['success' => 'Rating & Review Delete Successfully!']);
        
    }

    
}
