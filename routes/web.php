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

require base_path('routes/link/admin.php');
require base_path('routes/link/user.php');

//Route::get('login','LoginController@showLogin')->name('login');
//
//Route::get('registration','LoginController@showRegistration')->name('registration');