<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\API\UserApiController;
use App\Http\Controllers\API\VendorApiController;

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


Route::post('register', [UserApiController::class, 'register']);
Route::post('login_with_email', [UserApiController::class, 'login_with_email']);
Route::post('login_with_otp', [UserApiController::class, 'login_with_otp_api']);
Route::post('verify_otp', [UserApiController::class, 'verify_otp_api']);

Route::get('relation_groups',[UserApiController::class,'relation_groups']);
Route::get('categories',[UserApiController::class,'all_categories']);
Route::get('category/{id}',[UserApiController::class,'category']);
Route::get('cities',[UserApiController::class,'all_cities']);
Route::get('city/{id}',[UserApiController::class,'city']);
Route::post('vendor_list',[UserApiController::class,'vendor_list']);
Route::get('vendor_list/{id}',[UserApiController::class,'vendor_details']);
Route::get('vendor_list_by_category/{category}',[UserApiController::class,'vendor_list_by_category']);




// vendor routes 
Route::post('vendor_register', [VendorApiController::class, 'vendor_register']);
Route::post('vendor_login_with_email', [VendorApiController::class, 'vendor_login_with_email']);
Route::post('vendor_login_with_otp', [VendorApiController::class, 'vendor_login_with_otp_api']);
Route::post('vendor_verify_otp', [VendorApiController::class, 'vendor_verify_otp_api']);


// procted route with ap token.
Route::group(['middleware' => ['auth:sanctum']], function () {
    
    Route::post('logout', [UserApiController::class, 'logout']);

    Route::get('/user_data',[UserApiController::class, 'user_data']);

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


    Route::get('logout', [UserApiController::class, 'logout']);

    Route::get('dashboard', [UserApiController::class, 'dashboard']);

    Route::get('wishlist',[UserApiController::class, 'wishlist']);
    Route::post('add_wishlist',[UserApiController::class, 'add_wishlist']);
    Route::post('remove_wishlist',[UserApiController::class, 'remove_wishlist']);

});