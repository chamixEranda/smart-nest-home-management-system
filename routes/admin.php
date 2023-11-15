<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Admin', 'as' => 'admin.'], function() {
    /*authentication*/
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('login', 'LoginController@login')->name('login');
        Route::post('submit', 'LoginController@submit')->name('submit');
        Route::get('logout', 'LoginController@logout')->name('logout');
    });
    /*authentication*/

    Route::group(['middleware' => ['admin']], function () {
        //dashboard
        Route::get('/', 'DashboardController@index')->name('dashboard');

        Route::resource('subscription', 'SubscriptionController');

        Route::resource('business-settings', 'BusinessSettingController');

        Route::resource('meal-category', 'MealCategoryController');

        Route::resource('meal-type', 'MealTypeController');

    });
});

