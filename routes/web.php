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
Route::get('/product/show/all', 'ProductController@showAllProducts')->name('product.show.all');
Route::get('/product/update/{id}', 'ProductController@updateProduct')->name('product.update');
Route::Post('/product/update/{id}/Action/', 'ProductController@updateProductAction')->name('product.update.action');

//
// Ajax/Json: product routes
//
Route::get('/api/product/{id}', 'ProductController@productDataByIdInJson')->name('api.product.data.json');

//
// Ajax/Json: Transaction routes
//
Route::post('/api/transaction/add', 'CustomerTransactionController@addTransaction')->name('api.transaction.add');

//
//customer Transaction routers
//

Route::get('/customer/add/transactions', 'CustomerTransactionController@addCustomerTransaction')->name('customer.add.transactions');


