<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class transfer_data extends Controller
{
     // public function add_leads(){
        
    //     $old_leads = DB::table('request_lead')->get();

    //     foreach($old_leads as $lead){
    //         $l = new Leads;
    //         $l->name = $lead->name;
    //         $l->mobile = $lead->phone;
    //         $l->budget = $lead->budget;
    //         $l->details = $lead->message;

    //         switch (ucwords($lead->category)) {
    //             case 'Makeup Artist':
    //                 $l->category_id = '1';
    //                 break;

    //                 case 'Wedding Photographers':
    //                     $l->category_id = '3';
    //                     break;

    //                     case 'Wedding Venues':
    //                         $l->category_id = '2';
    //                         break;

    //                         case 'Choreographers':
    //                             $l->category_id = '5';
    //                             break;

    //                             case 'Bridal Designers':
    //                                 $l->category_id = '4';
    //                                 break;

    //                                 case 'Wedding Planner':
    //                                     $l->category_id = '7';
    //                                     break;

    //                                     case 'Wedding Invitation':
    //                                         $l->category_id = '8';
    //                                         break;

    //                                         case 'Mehndi Artist':
    //                                             $l->category_id = '6';
    //                                             break;
                                            
    //             default:
    //                 $l->category_id = 1;
    //                 break;
    //         }

    //         $l->event_date = $lead->event_date;
    //         $l->city = $lead->city;
    //         $l->view_count  = $lead->view_lead_count;
    //         $l->status  = $lead->status;
    //         $l->apply_tags = '0';
    //         $l->save();

    //         $view = DB::table('lead_view_status_2')->where('lead_id',$lead->id)->get();

    //         // dd($view);

    //         if(!empty($view)){
    //             foreach($view as $v){
    //                 $vendor = DB::table('entry')->where('id',$v->vendor_id)->first();

    //                 // dd($vendor);
    //                 if(!empty($vendor)){

    //                     $ved = User::where('mobile',$vendor->phone)->first();

    //                     if(!empty($ved)){
    //                         $d = new LeadViewStatus();
    //                         $d->lead_id = $lead->id;
    //                         $d->user_id = $ved->id;
    //                         $d->created_at =  date("Y-m-d H:i:s", strtotime($v->date));
    //                         $d->save();
    //                     }
    //                     // exit();
    //                 }
    //             }
    //         }

    //     }

    // }

    // public function add_pre(){
        
    //     $old_leads = DB::table('premium_leads_old')->get();

    //     foreach($old_leads as $lead){
    //         $l = new PremiumLead;
    //         $l->name = $lead->name;
    //         $l->mobile = $lead->phone;
    //         $l->budget = $lead->budget;
    //         $l->details = $lead->message;

    //         switch (ucwords($lead->category)) {
    //             case 'Makeup Artist':
    //                 $l->category_id = '1';
    //                 break;

    //                 case 'Wedding Photographers':
    //                     $l->category_id = '3';
    //                     break;

    //                     case 'Wedding Venues':
    //                         $l->category_id = '2';
    //                         break;

    //                         case 'Choreographers':
    //                             $l->category_id = '5';
    //                             break;

    //                             case 'Bridal Designers':
    //                                 $l->category_id = '4';
    //                                 break;

    //                                 case 'Wedding Planner':
    //                                     $l->category_id = '7';
    //                                     break;

    //                                     case 'Wedding Invitation':
    //                                         $l->category_id = '8';
    //                                         break;

    //                                         case 'Mehndi Artist':
    //                                             $l->category_id = '6';
    //                                             break;
                                            
    //             default:
    //                 $l->category_id = 1;
    //                 break;
    //         }

    //         $l->event_date = $lead->event_date;
    //         $l->city = $lead->city;
    //         $l->status  = $lead->status;
    //         $l->created_at = date('Y-m-d',strtotime($lead->request_date));
    //         $l->save();

    //         $pre_id = $l->id;

            
    //         $vendor = DB::table('entry')->where('id',$lead->vendor_id)->first();

    //         // dd($vendor);
    //         if(!empty($vendor)){

    //             $ved = User::where('mobile',$vendor->phone)->first();

    //             if(!empty($ved)){
    //                 $d = new PremiumLeadVendor();
    //                 $d->lead_id = $pre_id;
    //                 $d->user_id = $ved->id;
    //                 $d->created_at =  date("Y-m-d H:i:s", strtotime($lead->request_date));
    //                 $d->save();
    //             }
    //             // exit();
    //         }
                
    //     }

    // }
    
    // public function lead_view(){
    //     $view = DB::table('lead_view_status_2')->get();

    //     foreach($view as $v){
    //         $d = new LeadViewStatus();
    //         $d->lead_id = $v->lead_id;
    //         $d->user_id = $v->vendor_id;
    //         $d->created_at =  ( $v->date == NULL )? NULL : date("Y-m-d H:i:s", strtotime($v->date)) ;
    //         $d->save();
            
    //     }
    // }


    // public function paid_vendor(){
    //     $paid = DB::table('vendor_leads')->get();
        
    //     foreach($paid as $p ){
    //         $n = new LeadPaidVendor();
    //         $n->user_id = $p->vendor_id;
    //         $n->plan_id = $p->plane_id;
    //         $n->plan_name = $p->plane;
    //         $n->lead = $p->total_leads;
    //         $n->total_lead = $p->total_leads;
    //         $n->available_leads = $p->available_leads+2;
    //         $n->start_at = $p->purchase_time;
    //         $n->end_at = $p->expire_time;
    //         $n->is_active = "$p->is_subscribed"; 
    //         $n->is_addon = 'no';
    //         $n->save();
    //     }

    // }

    // public function blog_data(){
    //     $paid = DB::table('posts')->get();
        
    //     foreach($paid as $p ){
    //         $n = new Blog();
    //         $n->title = $p->title;
    //         $n->category_id = '1';
    //         $n->short_desc = "";
    //         $n->desc = $p->body;
    //         $n->featured_image = $p->image;
    //         $n->status = '1';
    //         $n->tags = "";
    //         $n->added_by = 'admin';
    //         $n->save();
    //     }

    // }


    // public function real(){
    //     $paid = DB::table('realwedding')->get();
        
    //     foreach($paid as $p ){
    //         $n = new RealWedding();
    //         $n->title = $p->title;
    //         $n->name = $p->bride_name;
    //         $n->partner_name = $p->groom_name;
    //         $n->description = $p->details;
    //         $n->featured_image = $p->image;
    //         $n->tag_vendors = $p->vendor_credit;
    //         $n->is_gallery = '0';
    //         $n->status  =   '1';
    //         $n->date    =   $p->date;
    //         $n->added_by = 'admin';
    //         $n->save();
    //     }
    // }


    // public function  move_profile(){
    //     $vendor = VendorDetail::all();

    //     foreach($vendor as $v){
    //         if(!empty($v->featured_image)){

    //             $to = storage_path('app/public/upload/vendor/featured/'.$v->featured_image);
    //             $form = public_path('old_uploads/'.$v->featured_image);

    //             if(File::exists($form)){
    //                 File::move($form, $to);
    //                 echo 'exist and done';
    //             }else{
    //                 echo 'not exist'."$v->user_id";
    //             }

    //         }else{
    //             echo 'empty column';
    //         }
    //         echo '<br>';
    //     }

    // }


    // public function move_gallery(){
    //     $user = User::all();

    //     foreach($user as $u){
    //         $images  = DB::table('images')->where('email',$u->email)->get();

    //         if(!empty($images)){
    //             foreach($images as $img){
    //                 $gallery = new MediaGallery;
    //                 $gallery->user_id = $u->id;
    //                 $gallery->media_type = 'image';
    //                 $gallery->name = $img->file_name;
    //                 $gallery->status = '1';
    //                 $gallery->user_type = 'vendor';
    //                 $gallery->save();

    //                 $to = storage_path('app/public/upload/vendor/gallery/'.$img->file_name);
    //                 $form = public_path('old_uploads/'.$img->file_name);

    //                 if(File::exists($form)){
    //                     File::move($form, $to);
    //                     echo 'exist and done';
    //                 }else{
    //                     echo 'not exist'."$u->id";
    //                 }
    //             }
    //             echo '<br>';
    //         }else{
    //             echo 'empty';
    //         }
    //     }
    //     echo '<br>';
    // }


    // public function add_plan(){
    //     $paid = DB::table('plane')->get();
        
    //     foreach($paid as $p ){

    //         switch ($p->category) {
    //             case 'Makeup Artist':
    //                 $cat_id = '1';
    //                 break;
                
    //                 case 'Wedding Photographers':
    //                     $cat_id = '3';
    //                     break;

    //                     case 'Wedding Venues':
    //                         $cat_id = '2';
    //                         break;

    //                         case 'Bridal Designers':
    //                             $cat_id = '4';
    //                             break;

    //                             case 'Wedding Planner':
    //                                 $cat_id = '7';
    //                                 break;

    //                                 case 'Mehndi Artist':
    //                                     $cat_id = '6';
    //                                     break;
    //                                     case 'Choreographers':
    //                                         $cat_id = '5';
    //                                         break;

    //                                         case 'Wedding Invitation':
    //                                             $cat_id = '8';
    //                                             break;
    //                 default:
    //                 $cat_id = NULL;
    //                 break;
    //         }
    //         $n = new LeadPlan();
    //         $n->name = $p->plane_name;
    //         $n->category_id = $cat_id;
    //         $n->plan_type = "normal";
    //         $n->price = $p->price;
    //         $n->leads = $p->leads;
    //         $n->days = $p->expire_time;
    //         $n->desc = $p->description;
    //         $n->image = $p->image;
    //         $n->support = 'NA';
    //         $n->status = '1';
    //         $n->save();
    //     }

    // }


    // public function add_vendors(){
    //     $data = DB::table('entry')->get();
    //     echo '<pre>';
    //     foreach($data as $d){
            
    //         $phone = str_replace('+91','',$d->phone);

    //         $user = new User;
    //         $user->name = $d->name;
    //         $user->email = $d->email;
    //         $user->password = Hash::make($d->password);
    //         $user->mobile = str_replace(' ','',$phone);
    //         $user->user_type = 'vendor';
    //         $user->status = $d->status;
    //         $user->created_at = date("Y-m-d H:i:s", strtotime($d->date));
    //         $user->save();
             

    //         $lastId = $user->id;

    //         switch ($d->category) {
    //             case 'Makeup Artist':
    //                 $cat_id = '1';
    //                 break;
                
    //                 case 'Wedding Photographers':
    //                     $cat_id = '3';
    //                     break;

    //                     case 'Wedding Venues':
    //                         $cat_id = '2';
    //                         break;

    //                         case 'Bridal Designers':
    //                             $cat_id = '4';
    //                             break;

    //                             case 'Wedding Planner':
    //                                 $cat_id = '7';
    //                                 break;

    //                                 case 'Mehndi Artist':
    //                                     $cat_id = '6';
    //                                     break;
    //                                     case 'Choreographers':
    //                                         $cat_id = '5';
    //                                         break;

    //                                         case 'Wedding Invitation':
    //                                             $cat_id = '8';
    //                                             break;
    //                 default:
    //                 $cat_id = NULL;
    //                 break;
    //         }

    //         $city =  City::where('name','like', "%$d->city%")->first();

    //         $vendor_details = new VendorDetail;
    //         $vendor_details->user_id = $lastId;
    //         $vendor_details->category_id = $cat_id;
    //         $vendor_details->city_id  = (!empty($city)? $city->id : 0 );
    //         $vendor_details->brandname  =   $d->brandname;
    //         $vendor_details->featured_image  =   str_replace('uploads/','', $d->mphoto);
    //         $vendor_details->address  =   $d->address;
    //         $vendor_details->description  =   $d->business;
    //         $vendor_details->cancel_policy  =   $d->cancel;
    //         $vendor_details->is_travelable  =   '1';
    //         $vendor_details->advance_payment  =   '30';
    //         $vendor_details->youtube  =   '';
    //         $vendor_details->service_offered  =   $d->services;
    //         $vendor_details->created_at = date("Y-m-d H:i:s", strtotime($d->date));
    //         $vendor_details->save();

    //         $social = new SocialLink;
    //         $social->user_id= $lastId;
    //         $social->facebook=Null;
    //         $social->youtube=NULL;
    //         $social->instagram=Null;
    //         $social->twitter=Null;
    //         $social->save();
            

    //         $paid = DB::table('vendor_leads')->where('vendor_id',$d->id)->first();

    //         if(!empty($paid)){
    //             $n = new LeadPaidVendor();
    //             $n->user_id = $lastId;
    //             $n->plan_id = $paid->plane_id;
    //             $n->plan_name = $paid->plane;
    //             $n->lead = $paid->total_leads;
    //             $n->total_lead = $paid->total_leads;
    //             $n->available_leads = $paid->available_leads+ $paid->today_count;
    //             $n->start_at = $paid->purchase_time;
    //             $n->end_at = $paid->expire_time;
    //             $n->is_active = "$paid->is_subscribed"; 
    //             $n->is_addon = 'no';
    //             $n->save();
    //         }

    //         $addon = DB::table('addon_leads_details')->where('vendor_id',$d->id)->first();

    //         if(!empty($addon)){
    //             $d = new AddonLead();
    //             $d->user_id = $lastId;
    //             $d->leads = $addon->count;
    //             $d->days = $addon->days;
    //             $d->created_at =  date("Y-m-d H:i:s", strtotime($addon->date)) ;
    //             $d->save();
    //         }

    //         // exit();
    //     }

    // }

    public function real_wedd_gallery(){
        $r = RealWedding::all();

        foreach($r as $v){
            $desc = $v->description;
            preg_match_all( '@src="([^"]+)"@' , $desc, $match );

            $src = array_pop($match);
            
            foreach($src as $a){
                $dt = explode('/',$a);
                echo end($dt);
                echo '<br>';
                $gallery = new MediaGallery;
                $gallery->real_wedding_id = $v->id;
                $gallery->media_type = 'image';
                $gallery->name = end($dt);
                $gallery->status = '1';
                $gallery->user_type = 'admin';
                $gallery->tags = 'realwedding';
                $gallery->save();
            }
        }
    }
}
