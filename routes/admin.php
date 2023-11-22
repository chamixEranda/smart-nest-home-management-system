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

        Route::resource('meal-item', 'MealController');

        Route::resource('recipe', 'RecipeController');
        
        Route::resource('ingredient', 'IngredientController');
        
        Route::get('expense-category', 'ExpenseController@expense_categories')->name('expense.expense-category');
        Route::resource('expense', 'ExpenseController');

        Route::get('income-category', 'IncomeController@income_categories')->name('income.income-category');
        Route::resource('income', 'IncomeController');

        Route::get('relationship-management/family-plans', 'FamilyController@familyPlans')->name('relationship-management.family-plans');
        Route::resource('relationship-management', 'FamilyController');

        Route::resource('users', 'UserController');


    });
});

