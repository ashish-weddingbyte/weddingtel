<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Template;
use App\Models\ActivatedTemplate;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\MediaGallery;
use App\Models\TemplateField;

class WebsiteController extends Controller
{
    public function websites(){

        $user_id = Session::get('user_id');

        $data['templates'] = Template::where('user_type','user')->where('status','1')->get();

        $data['active'] = ActivatedTemplate::join('templates','templates.id','=','activated_templates.template_id')
                                            ->where('activated_templates.user_id',$user_id)
                                            ->select(['activated_templates.*','templates.name'])
                                            ->first();
        return view('front.user.website',$data);
    }


    public function website_preview(Request $request){
        $tmp_id = $request->id;
        $user_id = Session::get('user_id');

        $data['user'] = User::find($user_id);
        $data['details'] = UserDetail::where('user_id',$user_id)->first();
        $data['images'] =   MediaGallery::where('user_id',$user_id)->get();
        $data['fields'] = TemplateField::where('tmp_id',$tmp_id)->get();
        $tmp = Template::where('id',$tmp_id)->where('status','1')->first();
        if(!empty($tmp)){
            return view('front.website.'.$tmp->name, $data);
        }else{
            return back();
        }
    }
}
