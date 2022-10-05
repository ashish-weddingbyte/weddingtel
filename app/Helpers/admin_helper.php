<?php
namespace App\Helpers;

use Illuminate\Http\Request;

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

}
?>