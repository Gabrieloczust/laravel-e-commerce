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

// Site
Route::get('/', 'Site\HomeController@index')->name('site');

// Carrinho
Route::prefix('cart')->namespace('Site')->name('cart.')->group(function () {
    Route::post('store/{product}', 'CartController@store')->name('store');
    Route::get('plus/{product}', 'CartController@plus')->name('plus');
    Route::get('less/{product}', 'CartController@less')->name('less');
    Route::post('clear', 'CartController@clear')->name('clear');
    Route::post('save', 'CartController@save')->name('save');
});

// Admin
Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::get('/', 'DashboardController@index')->name('admin');
    Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
    Route::resource('products', 'ProductController');
    Route::resource('categories', 'CategoryController');
    Route::get('sales', 'SaleController@index')->name('admin.sales');
});
