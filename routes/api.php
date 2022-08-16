<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\API\UserApiController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::post('register', [AuthController::class, 'register']);
// Route::post('login', [AuthController::class, 'login']);

// Route::group(['middleware' => ['auth:sanctum']], function () {
//     Route::post('profile', [AuthController::class, 'profile']);
//     Route::post('logout', [AuthController::class, 'logout']);
//     Route::get('me', function(){
//         return Auth::id();
//     });
// });


Route::post('register', [UserApiController::class, 'register']);
Route::post('login_with_email', [UserApiController::class, 'login_with_email']);
Route::post('login_with_otp_api', [UserApiController::class, 'login_with_otp_api']);


// procted route with ap token.
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('verify_otp_api', [UserApiController::class, 'verify_otp_api']);

    Route::post('logout', [UserApiController::class, 'logout']);

    Route::get('profile',[UserApiController::class, 'profile']);
});