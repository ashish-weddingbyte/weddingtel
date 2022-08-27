<?php
namespace App\Helpers;

use App\Models\User;
use App\Models\VendorDetail;

class vendor_helper {
    public static function vendor_profile_url($id){
        $data = VendorDetail::where('user_id', $id)->first();
        if(!empty($data)){
            $brandname = str_replace(' ','-', trim($data->brandname) );
            $id = $data->id; 
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
}
?>