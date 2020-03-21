<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('import-export', 'HomeController@importExport')->name('import-export');

    Route::resource('items', 'ItemController');
    Route::resource('invoices', 'InvoiceController');
    Route::resource('users', 'UserController');

    Route::prefix('export')->name('export.')->group(function () {
        Route::get('users', 'ExportController@users')->name('users');
        Route::get('invoices', 'ExportController@invoices')->name('invoices');
    });

    Route::prefix('import')->as('import.')->group(function () {
        Route::post('users', 'ImportController@users')->name('users');
        Route::post('invoices', 'ImportController@invoices')->name('invoices');
    });
});
