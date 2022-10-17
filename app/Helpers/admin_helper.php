<?php
namespace App\Helpers;

use Illuminate\Http\Request;
use App\Models\MediaGallery;
use App\Models\PositionPaidVendor;
use App\Models\LeadPaidVendor;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\VendorDetail;
use Carbon\Carbon;

class admin_helper {
    
    public static function active_menu($url = ''){
        $active = '';
        if( request()->segment(2) == $url ){
            $active = 'active';
        }
        return $active;
    }

    public static function active_sub_menu($url = ''){
        $active = '';
        if( request()->segment(3) == $url ){
            $active = 'active';
        }
        return $active;
    }

    public static function is_open_menu($url){
        $menu_open = '';
        $submenu = request()->segment(3);
        if(!empty($submenu)){
            if( request()->segment(2) == $url ){
            $menu_open = 'menu-open';
        }
        }
        return $menu_open;
    }



    public static function is_gallery($id){
        $data = MediaGallery::where('user_id',$id)->where('status','1')->first();
        if(!empty($data)){
            return true;
        }else{
            return false;
        }
    }

    public static function is_lead_plan_active($id){
        $data = LeadPaidVendor::where('user_id',$id)->where('is_active','1')->first();
        if(!empty($data)){
            return true;
        }else{
            return false;
        }
    }

    public static function is_position_plan_active($id){
        $data = PositionPaidVendor::where('user_id',$id)->where('is_active','1')->first();
        if(!empty($data)){
            return true;
        }else{
            return false;
        }
    }


    public static function used_leads($id){
        $data = LeadPaidVendor::where('user_id',$id)->where('is_active','1')->first();
        if(!empty($data)){
           return  ($data->lead - $data->available_leads);
        }else{
            return 0;
        }
    }

    public static function expiry_days($id){
        $data = LeadPaidVendor::where('user_id',$id)->where('is_active','1')->first();
        if(!empty( $data) ){
            $toDate = Carbon::parse($data->start_at);
            $fromDate = Carbon::parse($data->end_at);
            $days = $toDate->diffInDays($fromDate);
            return $days;
        }else{
            return 0 ;
        }

    }

    public static function expiry_days_position($id){
        $data = PositionPaidVendor::where('user_id',$id)->where('is_active','1')->first();
        if(!empty( $data) ){
            $toDate = Carbon::parse($data->start_at);
            $fromDate = Carbon::parse($data->end_at);
            $days = $toDate->diffInDays($fromDate);
            return $days;
        }else{
            return 0 ;
        }

    }

    public static function  vendor_details($id){
        $details = VendorDetail::join('categories','categories.id','=','vendor_details.category_id')
                                    ->join('cities','cities.id','=','vendor_details.city_id')
                                    ->where('vendor_details.user_id',$id)
                                    ->select(['vendor_details.brandname','vendor_details.is_email_verified','vendor_details.is_mobile_verified','cities.name as city_name','vendor_details.featured_image','categories.category_name'])
                                    ->first();
        return $details;
    }

    
}
?>