<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::prefix('checkouts')->name('checkouts.')->group(function () {
    Route::get('/index/{invoice}', 'CheckoutController@index')->name('index')
        ->middleware('permission:dashboard.checkout');
    Route::post('/execute/{invoice}', 'CheckoutController@execute')->name('execute')
        ->middleware('permission:dashboard.checkout.execute');
    Route::get('/process/{payment}', 'CheckoutController@process')->name('process')
        ->middleware('permission:dashboard.checkout.process');
    Route::get('/{payment}/finalized', 'CheckoutController@finalized')->name('finalized')
        ->middleware('permission:dashboard.checkout.finalized');
});

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('import-export', 'HomeController@importExport')->name('import-export');
    Route::resource('users', 'UserController');
    Route::resource('items', 'ItemController');
    Route::resource('invoices', 'InvoiceController');
    Route::resource('payments', 'PaymentController');
    Route::resource('roles', 'RoleController');

    //estas rutas las necesito cuando quiero ver el resultado de la api en el navegador
   /** Route::group(['prefix' => 'api'], function () {
        Route::apiResource('users', 'Api\v1\UserController');
        Route::apiResource('invoices', 'Api\v1\InvoiceController');
        Route::apiResource('items', 'Api\v1\ItemController');
        Route::apiResource('payments', 'Api\v1\PaymentController');
        Route::apiResource('checkouts', 'Api\v1\CheckoutController');
    });**/

    Route::prefix('export')->name('export.')->group(function () {
        Route::get('users', 'ExportController@users')->name('users');
        Route::get('invoices', 'ExportController@invoices')->name('invoices');
    });

    Route::prefix('import')->name('import.')->group(function () {
        Route::post('invoices', 'ImportController@invoices')->name('invoices');
        Route::post('users', 'ImportController@users')->name('users');
    });
});
