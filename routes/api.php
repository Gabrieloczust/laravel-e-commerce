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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->name('api.')->group(function () {

    Route::prefix('products')->group(function () {

        Route::get('/', 'ProductController@index')->name('products');
        Route::get('/{id}', 'ProductController@show')->name('product');

        Route::post('/', 'ProductController@store')->name('product.store');
        Route::put('/{id}', 'ProductController@update')->name('product.update');
        Route::delete('/{id}', 'ProductController@destroy')->name('product.destroy');
    });

    Route::prefix('categories')->group(function () {

        Route::get('/', 'CategoryController@index')->name('categories');
        Route::get('/{id}', 'CategoryController@show')->name('category');

        Route::post('/', 'CategoryController@store')->name('category.store');
        Route::put('/{id}', 'CategoryController@update')->name('category.update');
        Route::delete('/{id}', 'CategoryController@destroy')->name('category.destroy');
    });
});

Route::fallback(function () {
    return response()->json(['msg' => 'Página não encontrada!']);
});
