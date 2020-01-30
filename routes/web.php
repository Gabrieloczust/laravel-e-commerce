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
Route::post('/', 'Site\CartController@update')->name('cart.update');

// Admin
Route::prefix('admin')->group(function () {
    Route::get('/', 'Admin\DashboardController@index')->name('admin');
    Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
    Route::resource('products', 'Admin\ProductController');
    Route::resource('categories', 'Admin\CategoryController');
    Route::get('sales', 'Admin\SaleController@index')->name('admin.sales');
});