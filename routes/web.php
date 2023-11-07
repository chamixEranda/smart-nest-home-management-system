<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['middlware' => 'preventBackHistory'], function() {

    Route::get('/', 'Website\HomeController@index')->name('home');
    Route::get('about-us', 'Website\HomeController@about_us')->name('about-us');

    Route::get('login', 'Website\Auth\LoginController@getLogin')->name('login');
    Route::post('login-check', 'Website\Auth\LoginController@loginCheck')->name('login-check');

    Route::get('signup', 'Website\Auth\RegisterController@getSignup')->name('signup');
    Route::post('signup-create', 'Website\Auth\RegisterController@signupCreate')->name('login-create');
});

Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout','Website\Auth\LoginController@log_out')->name('logout');
});
Route::get('/pricing', function () {
    return view('pricing');
});
