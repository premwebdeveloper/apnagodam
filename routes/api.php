<?php

use Illuminate\Http\Request;

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

// Send otp api
Route::post('/apna_send_otp', 'ApiController@apna_send_otp')->name('apna_send_otp');

// ReSend otp api
Route::post('/apna_resend_otp', 'ApiController@apna_resend_otp')->name('apna_resend_otp');

// Verify otp api
Route::post('/apna_verify_otp', 'ApiController@apna_verify_otp')->name('apna_verify_otp');

// Send otp api
Route::get('/apna_delete_my_number', 'ApiController@apna_delete_my_number')->name('apna_delete_my_number');

// Register api
Route::post('/apna_registeration', 'ApiController@apna_registeration')->name('apna_registeration');

// sms hash key update
Route::post('/apna_sms_hash_key', 'ApiController@apna_sms_hash_key')->name('apna_sms_hash_key');