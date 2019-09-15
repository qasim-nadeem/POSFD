<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', 'LoginController@index')->name('page-login');
Route::get('/dashboard', 'DashboardController@index')->name('page-dashboard');

//
// Product routers
//
Route::get('/product/add', 'ProductController@addProduct')->name('product.add');
Route::post('/product/add/action', 'ProductController@addProductAction')->name('product.add.action');

