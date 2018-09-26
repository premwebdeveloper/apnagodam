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

Route::get('/inventories', 'UsersController@inventories')->name('inventories');

Route::get('/user_dashboard', 'UsersController@user_dashboard')->name('user_dashboard');

Route::get('/change_password', 'UsersController@change_password')->name('change_password');

Route::get('/user_finance_view', 'UsersController@user_finance_view')->name('user_finance_view');

Route::get('/request_for_loan/{id}', 'UsersController@request_for_loan')->name('request_for_loan');
Route::get('/requested_for_loan/{finance_id}/{id}', 'UsersController@requested_for_loan')->name('requested_for_loan');
Route::post('/loan_request', 'UsersController@loan_request')->name('loan_request');
Route::get('/loan_approved/{id}', 'UsersController@loan_approved')->name('loan_approved');
Route::post('/user_agree_for_loan/', 'UsersController@user_agree_for_loan')->name('user_agree_for_loan');



/* ********************** Admin routes start here *************************** */
/* ************************************************************************** */

// Change password view
Route::get('/change_password_view', 'AdminController@change_password_view')->name('change_password_view');
Route::post('/change_password', 'AdminController@change_password')->name('change_password');


// Admin dashboard view route
Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');

// User routes
Route::get('/users', 'AdminController@users')->name('users');
Route::get('/add_user_view', 'AdminController@add_user_view')->name('add_user_view');
Route::post('/add_user', 'AdminController@add_user')->name('add_user');
Route::get('/user_view/{user_id}', 'AdminController@user_view')->name('user_view');
Route::get('/user_edit_view/{user_id}', 'AdminController@user_edit_view')->name('user_edit_view');
Route::post('/user_edit', 'AdminController@user_edit')->name('user_edit');
Route::get('/user_delete/{user_id}', 'AdminController@user_delete')->name('user_delete');

// Enquiries Routes
Route::get('/enquiries', 'AdminController@enquiries')->name('enquiries');
Route::get('/approve/{user_id}', 'AdminController@approve')->name('approve');
Route::get('/unapprove/{user_id}', 'AdminController@unapprove')->name('unapprove');


// Warehouses Routes
Route::get('/warehouses', 'WarehouseController@index')->name('warehouses');
Route::get('/add_warehouse_view', 'WarehouseController@add_warehouse_view')->name('add_warehouse_view');
Route::post('/add_warehouse', 'WarehouseController@add_warehouse')->name('add_warehouse');
Route::get('/warehouse_edit_view/{id}', 'WarehouseController@warehouse_edit_view')->name('warehouse_edit_view');
Route::post('/warehouse_edit', 'WarehouseController@warehouse_edit')->name('warehouse_edit');
Route::get('/warehouse_view/{id}', 'WarehouseController@warehouse_view')->name('warehouse_view');
Route::get('/warehouse_delete/{id}', 'WarehouseController@warehouse_delete')->name('warehouse_delete');


// Finance routes
Route::get('/finance', 'FinanceController@index')->name('finance');
Route::get('/request_view/{id}', 'FinanceController@request_view')->name('request_view');
Route::get('/request_response/{id}', 'FinanceController@request_response')->name('request_response');
Route::post('/request_responded', 'FinanceController@request_responded')->name('request_responded');



// Inventory routes
Route::get('/inventory', 'InventoryController@index')->name('inventory');
Route::get('/create_inventory', 'InventoryController@create')->name('create_inventory');
Route::post('/add_inventory', 'InventoryController@add_inventory')->name('add_inventory');
Route::get('/inventory_view/{user_id}/{id}', 'InventoryController@view')->name('inventory_view');

Route::get('/inventory_edit_view/{user_id}/{id}', 'InventoryController@inventory_edit_view')->name('inventory_edit_view');

Route::post('/inventory_edit', 'InventoryController@edit')->name('inventory_edit');

Route::get('/inventory_delete/{id}', 'InventoryController@delete')->name('inventory_delete');

// Items Routes
Route::get('/items', 'ItemsController@index')->name('items');
Route::get('/create_item', 'ItemsController@create_item')->name('create_item');
Route::post('/add_item', 'ItemsController@add_item')->name('add_item');
Route::get('/item_edit_view/{id}', 'ItemsController@view')->name('item_edit_view');
Route::post('/item_edit', 'ItemsController@edit')->name('item_edit');
Route::get('/item_delete/{id}', 'ItemsController@delete')->name('item_delete');

// facilities Routes
Route::get('/facility', 'FacilitiesController@index')->name('facility');
Route::get('/create_facility', 'FacilitiesController@create_facility')->name('create_facility');
Route::post('/add_facility', 'FacilitiesController@add_facility')->name('add_facility');
Route::get('/facility_edit_view/{id}', 'FacilitiesController@view')->name('facility_edit_view');
Route::post('/facility_edit', 'FacilitiesController@edit')->name('facility_edit');
Route::get('/facility_delete/{id}', 'FacilitiesController@delete')->name('facility_delete');


