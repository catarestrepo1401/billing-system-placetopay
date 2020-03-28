<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*Route::group(['prefix' => 'api'], function () {
    Route::apiResource('users', 'Api\v1\UserController');
});*/

/**Route::namespace('Api')->group(function () {
    Route::namespace('v1')->prefix('v1')->group(function () {
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        //Route::get('checkout/{sale}', 'CheckoutController@initialize');
        //Route::post('checkout/process', 'CheckoutController@process');

        Route::middleware(['auth:sanctum'])->group(function () {
            Route::get('profile', 'AuthController@profile');
            Route::post('logout', 'AuthController@logout');

            Route::apiResource('payments', 'PaymentController');
            Route::apiResource('invoices', 'InvoiceController');
            Route::apiResource('users', 'UserController');
        });
    });
    Route::fallback(function(){
        return response()->json([
            'message' => 'Page Not Found.'], 404);
    });
});**/
