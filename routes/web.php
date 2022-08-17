<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\login;
use App\Http\Controllers\front\UserController;
use App\Http\Controllers\front\Planning_tool;
use App\Http\Controllers\front\ChecklistController;
use App\Http\Controllers\front\GuestContoller;
use App\Http\Controllers\front\BudgetController;
use App\Http\Controllers\front\VendorController;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\front\ProfileController;
use App\Http\Controllers\front\RealWeddingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[HomeController::class, 'home']);


Route::view('/listing','front.user.listing');
Route::view('/contact','front.user.contact');
Route::view('/test','front.user.test');
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

// vendor pages
Route::get('vendors/{city}/{category}',[VendorController::class,'all_vendors_of_category']);
Route::get('vendors/{city}',[VendorController::class,'all_vendors_of_category']);


Route::view('/vendor-login','front.vendor.login_with_mobile');
Route::view('/vendor-register','front.vendor.register');
Route::get('/vendor-login/{from}',[Login::class,'show_vendor_login']);
Route::post('/vendor-login',[login::class,'vendor_login']);
Route::post('/vendor-register',[UserController::class,'vendor_register']);


Route::get('/vendor/dashboard',[Planning_tool::class, 'vendor_dashboard']);

// Protected by group middleware 
// Middleware for user.
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




Route::get('/logout', function(){
    Session::flush();
    return Redirect::to('/');
 });
 

Route::get('/home',function(){
   
    // return view('front.layouts.main_layout1');
});
