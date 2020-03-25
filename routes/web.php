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
    Route::get('/initialized/{invoice}', 'CheckoutController@index')->name('index');
    Route::post('/execute/{invoice}', 'CheckoutController@execute')->name('execute');
    Route::get('/process/{payment}', 'CheckoutController@process')->name('process');
    Route::get('/checkouts/{payment}/finalized', 'CheckoutController@finalized')->name('finalized');
});

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('import-export', 'HomeController@importExport')->name('import-export');

    Route::resource('items', 'ItemController');
    Route::resource('invoices', 'InvoiceController');
    Route::resource('users', 'UserController');
    Route::resource('payments', 'PaymentController');

    Route::prefix('export')->name('export.')->group(function () {
        Route::get('users', 'ExportController@users')->name('users');
        Route::get('userscsv', 'ExportController@userscsv')->name('userscsv');
        Route::get('invoices', 'ExportController@invoices')->name('invoices');
        Route::get('invoicescsv', 'ExportController@invoicescsv')->name('invoicescsv');
    });

    Route::prefix('import')->name('import.')->group(function () {
        Route::post('invoices', 'ImportController@invoices')->name('invoices');
        Route::post('users', 'ImportController@users')->name('users');
    });
});
