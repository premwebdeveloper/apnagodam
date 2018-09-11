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

Route::get('/users', 'AdminController@users')->name('users');

Route::any('/add_user_view', 'AdminController@add_user_view')->name('add_user_view');

Route::any('/add_user', 'AdminController@add_user')->name('add_user');


