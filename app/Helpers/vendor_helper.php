<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\VendorDetail;
use App\Models\LeadPaidVendor;
use App\Models\PositionPaidVendor;
use App\Models\MediaGallery;
use App\Models\Review;
use App\Models\Category;
use App\Models\City;
use App\Models\LeadPlan;
use App\Models\LeadViewStatus;
use App\Models\QueryViewStatus;
use Carbon\Carbon;

class vendor_helper {
    public static function vendor_profile_url($id){
        $data = VendorDetail::where('user_id', $id)->first();
        if(!empty($data)){
            $brandname = str_replace(' ','-', trim($data->brandname) );
            $id = $data->user_id; 
            $url =  url('/').'/'.'profile/'.$brandname.'-'.$id;
            return $url;
        }else{
            return url('/');
        }
    }

    public static function check_verified_vendor($id){
        $data = VendorDetail::where('user_id', $id)->first();

        if($data->is_mobile_verified == '1' || $data->is_email_verified == '1'){
            return true;
        }else{
            return false;
        }
    }

    public static function check_verified_vendor_by_profile_url($url){
        $id  = str_replace( '-', '', strrchr($url,'-') );
        $name = str_replace('-',' ',$url);
        $brandname = trim( str_replace($id,'',$name) );
        return ['id'=>$id,'brandname'=>$brandname];
    }
    
    
    public static function is_lead_paid_vendor($user_id){
        $data = LeadPaidVendor::where('user_id',$user_id)
                            ->where('is_active','1')
                            ->orderBy('id','desc')
                            ->first();
        if(!empty($data)){
            return true;
        }else{
            return false;
        }        
    }


    public static function is_position_paid_vendor($user_id){
        $data = PositionPaidVendor::where('user_id',$user_id)
                            ->where('is_active','1')
                            ->orderBy('id','desc')
                            ->first();
        if(!empty($data)){
            return true;
        }else{
            return false;
        }        
    }


    public static function vendor_image_path($user_id){
        $data = VendorDetail::where('user_id', $user_id)->first();
        if(!empty($data)){

            if(!empty($data->featured_image) ){

                if(file_exists( public_path("storage/upload/vendor/featured/$data->featured_image") ) ){
                    
                    return asset("storage/upload/vendor/featured/$data->featured_image");

                }else{
                    return asset('front/default_image/default_featured_image.png');
                }

            }else{
                return asset('front/default_image/default_featured_image.png');
            }
        }else{
            return asset('front/default_image/default_featured_image.png');
        }
    }


    public static function gallery_image_path($user_id, $image){
        $data = MediaGallery::where('user_id', $user_id)->where('name',$image)->where('user_type','vendor')->first();
        if(!empty($data)){

            if(!empty($data->name) ){

                if(file_exists( public_path("storage/upload/vendor/gallery/$data->name") ) ){
                    
                    return asset("storage/upload/vendor/gallery/$data->name");

                }else{
                    return asset('front/default_image/default_featured_image.png');
                }

            }else{
                return asset('front/default_image/default_featured_image.png');
            }
        }else{
            return asset('front/default_image/default_featured_image.png');
        }
    }


    public static function youtube_url($url){
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
        if(isset($match[1])){
            $youtube_url = 'https://www.youtube.com/watch?v='.$match[1];
        }else{
            $youtube_url = "";
        }
        return $youtube_url;
    }

    public static function youtube_thumbnail($url){
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
        if(isset($match[1])){
            $youtube_id = $match[1];
            $image_url = "https://img.youtube.com/vi/$youtube_id/sddefault.jpg";
        }else{
            $image_url = asset('front/images/vendors/vendor_video.jpg');
        }
        return $image_url;
    }

    public static function get_rating($rating){
        $user_id = Session::get('user_id');

        $data['avg'] = Review::where('vendor_id',$user_id)->where('rating',$rating)->where('status','1')->avg('rating');
        $data['count'] = Review::where('vendor_id',$user_id)->where('rating',$rating)->where('status','1')->count();
        $data['all_count'] = Review::where('vendor_id',$user_id)->count();
        if($data['all_count']>0){
            $data['percentage'] = round(($data['count']/$data['all_count'])*100);    
        }else{
            $data['percentage'] = 0;
        }
        return $data;
    }

    public static function get_avg_rating_of_vendor($user_id){
        return Review::where('vendor_id',$user_id)->where('status','1')->avg('rating');
    }


    public static function get_rating_of_vendor($user_id){
        $data['avg'] = Review::where('vendor_id',$user_id)->where('status','1')->avg('rating');
        $data['count'] = Review::where('vendor_id',$user_id)->where('status','1')->count();
        return $data;
    }


    public static function footer_data($category_id){
        $vendor = VendorDetail::join('cities','cities.id','=','vendor_details.city_id')
                            ->where('category_id',$category_id)->select('cities.name')->distinct()->get();
        return $vendor;
    }

    public static function check_exclusive($user_id){
        $palns  =  LeadPlan::where('plan_type','exclusive')->pluck('id')->toArray();

        $data = LeadPaidVendor::where('user_id',$user_id)
                            ->where('is_active','1')
                            ->whereIn('plan_id',$palns)
                            ->orderBy('id','desc')
                            ->first();
        if(!empty($data)){
            return true;
        }else{
            return false;
        }        
    }

    public static function view_lead_status($lead_id){
        $user_id = Session::get('user_id');
        $data = LeadViewStatus::where('user_id',$user_id)->where('lead_id',$lead_id)->first();
        if(!empty($data)){
            return true;
        }else{
            return false;
        }
        return $data;
    }
    
    public static function lead_time_counter($lead_id){
        $user_id = Session::get('user_id');
        $data = LeadViewStatus::where('lead_id',$lead_id)->orderBy('time','asc')->get();

        // dd($data);
        $array = [];
        $currnt_time = strtotime( date('Y-m-d H:i:s') );
        $time = [];
        foreach($data as $d){
            $open_time = strtotime( $d->time);
            $diff = abs($currnt_time - $open_time);
            $array[ $d->user_id]  = $diff;
            $time[] = $diff;
        }

        if($time[0] > 7200){
            return [1,0];
        }else{
            $j = 1;
            foreach($array as $key=>$value){
                
                if($key == $user_id){
                    $time = $value;
                    break;
                }
                $j++;
            }
            return [$j,$time];    
        }
    }

    // public static function view_query_status($query_id){
    //     $user_id = Session::get('user_id');
    //     $data = QueryViewStatus::where('user_id',$user_id)->where('query_id',$query_id)->first();
    //     if(!empty($data)){
    //         return true;
    //     }else{
    //         return false;
    //     }
    //     return $data;
    // }


    public static function expiry_vendor(){
        $user_id = Session::get('user_id');
        $today = date('Y-m-d');
        $vendors = LeadPaidVendor::where('is_active','1')
                                    ->whereDate('end_at','<',$today)
                                    ->where('user_id',$user_id)
                                    ->get();
        if(!empty($vendors)){
            foreach($vendors as $vendor){
                LeadPaidVendor::where('id',$vendor->id)->update(['is_active' => '0']);
            }
        }
    }
}
?>