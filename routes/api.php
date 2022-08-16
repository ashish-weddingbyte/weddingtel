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
Route::post('login_with_otp', [UserApiController::class, 'login_with_otp_api']);


// procted route with ap token.
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('verify_otp', [UserApiController::class, 'verify_otp_api']);

    Route::post('logout', [UserApiController::class, 'logout']);

    // checklist pages api
    Route::get('/checklist',[UserApiController::class, 'checklist_api']);
    Route::post('/checklist/add', [UserApiController::class,'add_checklist_api']);
    Route::post('/checklist/edit/{id}', [UserApiController::class,'edit_checklist_api']);
    Route::post('/checklist/delete/{id}', [UserApiController::class,'delete_checklist_api']);
    Route::post('/checklist/status/{id}', [UserApiController::class,'status_of_checklist_api']);


    // guest pages api
    Route::get('/guestlist',[UserApiController::class, 'guestlist_api']);
    Route::post('/guestlist/add', [UserApiController::class,'add_guestlist_api']);
    Route::post('/guestlist/edit/{id}', [UserApiController::class,'edit_guestlist_api']);
    Route::post('/guestlist/delete/{id}', [UserApiController::class,'delete_guestlist_api']);

    // budget pages
    Route::get('/budget',[UserApiController::class, 'budget_api']);

    Route::post('/budget/budget-category/add',[UserApiController::class, 'add_budget_category_api']);
    Route::post('/budget/budget-category/edit/{id}',[UserApiController::class, 'edit_budget_category_api']);
    Route::post('/budget/budget-category/delete/{id}',[UserApiController::class, 'delete_budget_category_api']);
    Route::post('/budget/estimated-cost',[UserApiController::class,'edit_estimated_cost_api']);

    Route::post('/budget/budget-expense/add',[UserApiController::class, 'add_budget_expense_api']);
    Route::post('/budget/budget-expense/edit/{id}',[UserApiController::class, 'edit_budget_expense_api']);
    Route::post('/budget/budget-expense/delete/{id}',[UserApiController::class, 'delete_budget_expense_api']);

    // vendors api
    Route::get('/vendors',[UserApiController::class, 'vendors_api']);

    // real wedding pages
    Route::get('/real-wedding',[UserApiController::class, 'index_api']);
    Route::post('/real-wedding/update',[UserApiController::class, 'update_api']);

    // profile pages 
    Route::get('/profile',[UserApiController::class, 'profile_api']);
    Route::post('/profile/change-password',[UserApiController::class,'change_password_api']);
    Route::post('/profile/update',[UserApiController::class,'update_details_api']);
    Route::post('/profile/wedding-info',[UserApiController::class,'wedding_info_api']);


    Route::post('logout', [UserApiController::class, 'logout']);
});