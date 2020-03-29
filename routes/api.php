<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

    Route::namespace('Api')->group(function () {
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
});

/**Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});**/

/**Route::post('/login', function(Request $request) {
        $data = $request->validate([
            'email' => 'required',
            'password' => 'required',
    ]);
        $user = User::whereEmail($request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)
    ) {
        return response([
            'email' => ['The provided credentials are incorrect.'],
        ], 404);
    }
    return $user->createToken('my-token')->plainTextToken;
});**/



