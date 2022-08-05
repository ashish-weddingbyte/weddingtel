<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\front\UserController;
use App\Http\Controllers\front\ChecklistController;
use App\Http\Controllers\login;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register',[UserController::class,'register_api']);
Route::post('/verify_otp',[UserController::class,'verify_otp_api']);

Route::post('/login_with_email',[login::class,'login_with_email_api']);
Route::post('/login_with_otp',[login::class,'login_with_otp_api']);


//  protected route for logined user.
// Route::middleware('auth:sanctum')->group( function () {
//     Route::get('/all_checklists',[ChecklistController::class,'all_checklist_api']);
// });