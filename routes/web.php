<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\login;
use App\Http\Controllers\front\UserController;
use App\Http\Controllers\front\Dashboard;

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

Route::get('/', function () {
    
    return view('front.index');
});


Route::view('/listing','front.listing');
Route::view('/contact','front.contact');
Route::view('/test','front.test');
Route::view('/login','front.login_with_mobile');
Route::view('/register','front.register');

Route::get('/otp/{from}/{id}',[UserController::class,'otp']);
Route::post('/verify-otp',[UserController::class,'verify_otp']);
Route::get('/login/{from}',[Login::class,'show_login']);
Route::post('/login',[login::class,'user_login']);
Route::post('/register',[UserController::class,'register']);


Route::get('/dashboard',[Dashboard::class, 'dashboard']);

Route::get('/home',function(){
    echo '<pre>';
    print_r( session()->all() );
    // return view('front.layouts.main_layout1');
});
