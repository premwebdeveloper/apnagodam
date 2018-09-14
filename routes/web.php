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

Auth::routes();

Route::get('/', 'HomeController@index')->name('/');

Route::get('/home', 'HomeController@index')->name('home');

// User profile view route
Route::get('/profile', 'UsersController@profile')->name('profile');



/* ********************** Admin routes start here *************************** */
/* ************************************************************************** */

// Admin dashboard view route
Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');

// Warehouses Routes
Route::get('/warehouses', 'AdminController@warehouses')->name('warehouses');
Route::get('/add_warehouse_view', 'AdminController@add_warehouse_view')->name('add_warehouse_view');
Route::post('/add_warehouse', 'AdminController@add_warehouse')->name('add_warehouse');
Route::get('/warehouse_edit_view/{id}', 'AdminController@warehouse_edit_view')->name('warehouse_edit_view');
Route::post('/warehouse_edit', 'AdminController@warehouse_edit')->name('warehouse_edit');
Route::get('/warehouse_view/{id}', 'AdminController@warehouse_view')->name('warehouse_view');
Route::get('/warehouse_delete/{id}', 'AdminController@warehouse_delete')->name('warehouse_delete');


// Enquiries Routes
Route::get('/enquiries', 'AdminController@enquiries')->name('enquiries');
Route::get('/approve/{user_id}', 'AdminController@approve')->name('approve');
Route::get('/unapprove/{user_id}', 'AdminController@unapprove')->name('unapprove');


// User routes
Route::get('/users', 'AdminController@users')->name('users');
Route::get('/add_user_view', 'AdminController@add_user_view')->name('add_user_view');
Route::post('/add_user', 'AdminController@add_user')->name('add_user');
Route::get('/user_view/{user_id}', 'AdminController@user_view')->name('user_view');
Route::get('/user_edit_view/{user_id}', 'AdminController@user_edit_view')->name('user_edit_view');
Route::post('/user_edit', 'AdminController@user_edit')->name('user_edit');
Route::get('/user_delete/{user_id}', 'AdminController@user_delete')->name('user_delete');


// Finance routes
Route::get('/finance', 'AdminController@finance')->name('finance');
Route::get('/create_finance_view', 'AdminController@create_finance_view')->name('create_finance_view');
Route::post('/create_finance', 'AdminController@create_finance')->name('create_finance');


