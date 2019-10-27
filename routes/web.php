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

// Route::get('/', function () {
//     return view('welcome');
// });


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
Route::get('/customer/all/transactions', 'CustomerTransactionController@allCustomerTransaction')->name('customer.all.transactions');
Route::get('/customer/add/transactions', 'CustomerTransactionController@addCustomerTransaction')->name('customer.add.transactions');
Route::get('/detail/transaction/{transaction_id}/customer/{customer_id?}', 'CustomerTransactionController@detailCustomerTransaction')->name('customer.detail.transactions');



//
//Supplier routes
//
Route::get('/supplier/add', 'SupplierController@addsupplier')->name('supplier.add');
Route::post('/supplier/add/action', 'SupplierController@addSupplierAction')->name('supplier.add.action');
Route::get('/supplier/show/all', 'SupplierController@showAllSuppliers')->name('supplier.show.all');
Route::get('/supplier/update/{id}', 'SupplierController@updateSupplier')->name('supplier.update');
Route::Post('/supplier/update/{id}/Action/', 'SupplierController@updateSupplierAction')->name('supplier.update.action');
Route::get('/supplier/add/transactions', 'SupplierTransactionController@addSupplierTransaction')->name('supplier.add.transactions');
Route::post('/api/transaction/addSupplier', 'SupplierTransactionController@addTransaction')->name('api.transaction_supplier.add');
Route::get('/supplier/all/transactions', 'SupplierTransactionController@allSupplierTransaction')->name('supplier.all.transactions');
Route::get('/detail/transaction/{transaction_id}/supplier/{supplier_id?}', 'SupplierTransactionController@detailSupplierTransaction')->name('supplier.detail.transactions');



// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');



Auth::routes();
Route::get('/dashboard', 'DashboardController@index')->name('page-dashboard');
Route::get('/', 'Auth\LoginController@showLoginForm')->name('page-login');
Route::post('/', 'Auth\LoginController@login')->name('page-login-post');
Route::get('/home', 'HomeController@index')->name('home');
