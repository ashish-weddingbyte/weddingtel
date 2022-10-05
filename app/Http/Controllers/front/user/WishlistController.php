<?php

namespace App\Http\Controllers\front\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Wishlist;
use App\Models\UserDetail;
use App\Models\User;

class WishlistController extends Controller
{
    public function __construct(){
        $this->middleware('is_session');
    }
    public function wishlist_vendors(){
        
        $user_id = Session::get('user_id');

        // $user = UserDetail::where('user_id',$user_id)->first();

        $conditions = [
            ['users.user_type','vendor'],
            ['users.status','1'],
            ['wishlists.from_id',$user_id]
        ];
        
        $data['all_vendors']  = Wishlist::join('vendor_details','vendor_details.user_id','=','wishlists.to_id')
                                ->join('users', 'users.id', '=', 'wishlists.to_id')
                                ->join('categories','categories.id','=','vendor_details.category_id')
                                ->join('cities','cities.id','=','vendor_details.city_id')
                                ->where($conditions)
                                ->select(['users.id','users.name','vendor_details.brandname','cities.name as city_name','vendor_details.featured_image','categories.category_name','categories.icon'])
                                ->orderBy('wishlists.id','desc')
                                ->paginate(6);

        return view('front.user.wishlist',$data);
    }

    public function change_status(Request $request){
        $status = $request->status;
        $vendor_id = $request->vendor_id;
        $user_id = Session::get('user_id');
        $sts = 0;

        if($status == 0){
            $wishlist = new Wishlist;
            $wishlist->from_id = $user_id;
            $wishlist->to_id = $vendor_id;
            $wishlist->save();
            $sts = 1;

            return response()->json(['status' => $sts]);
        }
        if($status == 1){
            $wishlist = Wishlist::where('from_id',$user_id)->where('to_id',$vendor_id)->first();
            $wishlist->delete();
            $sts = 0;
            return response()->json(['status' => $sts]);
        }
    }

    public function remove_vendor(Request $request){
        $vendor_id = $request->vendor_id;
        $user_id = Session::get('user_id');

        $wishlist = Wishlist::where('from_id',$user_id)->where('to_id',$vendor_id)->first();
        if($wishlist->delete()){
            Session::flash('message', 'Remove Vendor from wishlist Successfully!');
            Session::flash('class', 'alert-success');
            
            return response()->json(['success' => 'Remove Vendor from wishlist Successfully!']);
        }else{
            Session::flash('message', 'Somthing Went Wrong!');
            Session::flash('class', 'alert-danger');
            
            return response()->json(['success' => 'Somthing Went Wrong!']);
        }
    }
}
