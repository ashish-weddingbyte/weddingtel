<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\DB;


//  common controllers
use App\Http\Controllers\login;
use App\Http\Controllers\front\UserController;
use App\Http\Controllers\front\HomeController;

// user controllers
use App\Http\Controllers\front\user\Planning_tool;
use App\Http\Controllers\front\user\ChecklistController;
use App\Http\Controllers\front\user\GuestContoller;
use App\Http\Controllers\front\user\BudgetController;
use App\Http\Controllers\front\user\VendorController;
use App\Http\Controllers\front\user\ProfileController;
use App\Http\Controllers\front\user\RealWeddingController;


// vendor contollers
use App\Http\Controllers\front\vendor\Vendors;
use App\Http\Controllers\front\vendor\VendorProfileController;
use App\Http\Controllers\front\vendor\VendorPlanController;
use App\Http\Controllers\front\vendor\VendorLeadController;

/**====================================================================================== */

Route::get('/',[HomeController::class, 'home']);
Route::view('/listing','front.listing');
Route::view('/contact','front.contact');
Route::post('/query/send-message',[HomeController::class,'send_message']);
Route::post('/query/view-contact',[HomeController::class,'view_contact']);
Route::post('/query/otp/',[HomeController::class,'verify_otp']);

// vendor pages
// Route::get('vendors_data', [UserController::class,'test']);
Route::get('profile/{name}',[HomeController::class,'profile']);
Route::get('vendors/{city}/{category}',[HomeController::class,'vendor_list']);
Route::get('vendors/{city}',[HomeController::class,'vendor_list']);
Route::post('vendors/',[HomeController::class,'search']);


Route::get('blogs',[HomeController::class,'all_blogs']);
Route::get('blogs/{category}',[HomeController::class,'blogs_by_category']);
Route::get('blog/{title}',[HomeController::class,'blog_details']);

// Protected Route by Middleware for user(bride/groom).
Route::group(["middleware" => ["AuthUser"] , "prefix" => '/tools', '' ], function(){

    Route::get('/',[Planning_tool::class, 'dashboard']);
    Route::get('/dashboard',[Planning_tool::class, 'dashboard']);
    
    // real wedding pages
    Route::get('/real-wedding',[RealWeddingController::class, 'index']);
    Route::post('/real-wedding/update',[RealWeddingController::class, 'update']);

    // profile pages 
    Route::get('/profile',[ProfileController::class, 'profile']);
    Route::post('/profile/change-password',[ProfileController::class,'change_password']);
    Route::post('/profile/update',[ProfileController::class,'update_details']);
    Route::post('/profile/wedding-info',[ProfileController::class,'wedding_info']);
    

    // checklist pages
    Route::get('/checklist',[ChecklistController::class, 'checklist']);
    Route::post('/checklist/add', [ChecklistController::class,'add_checklist']);
    Route::post('/checklist/edit/{id}', [ChecklistController::class,'edit_checklist']);
    Route::post('/checklist/delete/{id}', [ChecklistController::class,'delete_checklist']);
    Route::post('/checklist/status/{id}', [ChecklistController::class,'status_of_checklist']);

    // guest pages
    Route::get('/guestlist',[GuestContoller::class, 'guestlist']);
    Route::post('/guestlist/add', [GuestContoller::class,'add_guestlist']);
    Route::post('/guestlist/edit/{id}', [GuestContoller::class,'edit_guestlist']);
    Route::post('/guestlist/delete/{id}', [GuestContoller::class,'delete_guestlist']);

    // budget pages
    Route::get('/budget',[BudgetController::class, 'budget']);
    Route::post('/budget/budget-category/add',[BudgetController::class, 'add_budget_category']);
    Route::post('/budget/budget-category/edit/{id}',[BudgetController::class, 'edit_budget_category']);
    Route::post('/budget/budget-category/delete/{id}',[BudgetController::class, 'delete_budget_category']);
    Route::post('/budget/estimated-cost',[BudgetController::class,'edit_estimated_cost']);
    Route::post('/budget/budget-expense/add',[BudgetController::class, 'add_budget_expense']);
    Route::post('/budget/budget-expense/edit/{id}',[BudgetController::class, 'edit_budget_expense']);
    Route::post('/budget/budget-expense/delete/{id}',[BudgetController::class, 'delete_budget_expense']);


    // vendor manager pages
    Route::get('/vendors',[VendorController::class, 'vendors']);
    
});


// Restrict Login/Register/otp/forgetpassword pages for Logged in user.
Route::middleware(['CheckUser'])->group(function () {

    // Bride/Groom login/register/otp route.
    Route::view('/login','front.user.login_with_mobile');
    Route::view('/register','front.user.register');
    Route::view('/forget-password','front.user.forget_password');
    Route::post('/forget-password',[login::class,'forget_password']);
    Route::get('/otp/{from}/{id}',[UserController::class,'otp']);
    Route::post('/verify-otp',[UserController::class,'verify_otp']);
    Route::get('/reset-password/{from}/{id}',[UserController::class,'reset_passord']);
    Route::post('/reset-password',[UserController::class,'change_password']);
    Route::get('/login/{from}',[Login::class,'show_login']);
    Route::post('/login',[login::class,'user_login']);
    Route::post('/register',[UserController::class,'register']);

    // vendor login/register/otp routes
    Route::view('/vendor-login','front.vendor.login_with_mobile');
    Route::view('/vendor-register','front.vendor.register');
    Route::get('/vendor-login/{from}',[Login::class,'show_vendor_login']);
    Route::post('/vendor-login',[login::class,'vendor_login']);
    Route::post('/vendor-register',[UserController::class,'vendor_register']);
    Route::get('/vendor-otp/{from}/{id}',[UserController::class,'vendor_otp']);
    Route::post('/vendor-verify-otp',[UserController::class,'vendor_verify_otp']);
    Route::view('/vendor-forget-password','front.vendor.forget_password');
    Route::post('/vendor-forget-password',[login::class,'vendor_forget_password']);
    Route::get('/vendor-reset-password/{from}/{id}',[UserController::class,'vendor_reset_passord']);
    Route::post('/vendor-reset-password',[UserController::class,'vendor_change_password']);
});


// protected route by middleware for vendors
Route::group(["middleware" => ["AuthVendor"] , "prefix" => '/vendor', '' ], function(){

    Route::get('/dashboard',[Vendors::class, 'dashboard']);
    
    
    Route::get('/review',[Vendors::class, 'review']);
    Route::get('/leads',[Vendors::class, 'leads']);
    Route::get('/invoice',[Vendors::class, 'invoice']);
    Route::get('/template',[Vendors::class, 'template']);
    Route::get('/wishlist',[Vendors::class, 'wishlist']);


    // profile routes
    Route::get('/profile',[VendorProfileController::class, 'profile']);
    Route::post('/profile/update',[VendorProfileController::class, 'update_details']);
    Route::post('/profile/change-password',[VendorProfileController::class,'change_password']);
    Route::post('/profile/social',[VendorProfileController::class,'update_social']);
    Route::post('/profile/business',[VendorProfileController::class,'update_business_profie']);
    Route::post('/profile/gallery',[VendorProfileController::class,'gallery']);
    Route::post('/profile/gallery/{id}',[VendorProfileController::class,'delete_image']);


    // vendor plans 
    Route::get('/plans',[VendorPlanController::class, 'plans']);

    // Vendor Leads
    Route::get('/leads',[VendorLeadController::class, 'leads']);
    Route::post('/leads/view/{id}',[VendorLeadController::class,'view_lead']);
    Route::get('/leads/view/details/{id}',[VendorLeadController::class,'view_lead_details']);
    Route::get('/leads/unlock-leads',[VendorLeadController::class,'unlock_leads']);

    Route::get('/query',[VendorLeadController::class, 'all_query']);
});



// logout route
Route::get('/logout', function(){
    Session::flush();
    return Redirect::to('/');
 });


 Route::get('/test', function(){
    echo  vendor_helper::vendor_profile_url(4586);
 });


Route::get('/add_city',[VendorProfileController::class,'add_city']);
Route::get('/add_leads',[HomeController::class,'add_leads']);
Route::get('/move_profile',[HomeController::class,'move_profile']);
Route::get('/move_gallery',[HomeController::class,'move_gallery']);
