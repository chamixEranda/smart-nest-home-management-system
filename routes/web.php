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

    Route::get('pricing', 'Website\SubscriptionController@index')->name('pricing');

    Route::get('contact-us', 'Website\HomeController@contact_us')->name('contact-us');

    Route::view('reviews', 'reviews');

    // meal planning
    Route::prefix('meal-planning')->name('meal-planning.')->group(function () {
        Route::get('/', 'Website\MealplanController@index')->name('index');
        Route::get('/meal', 'Website\MealplanController@mealPage')->name('meal');
    });

    // finance management
    Route::prefix('finance')->name('finance.')->group(function () {
        Route::get('/', 'Website\FinanceController@index')->name('index');
    });

    // relationship management
    Route::prefix('relationship-management')->name('relationship-management.')->group(function () {
        Route::get('/', 'Website\RelationshipManagementController@index')->name('index');
    });
});

Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout','Website\Auth\LoginController@log_out')->name('logout');
    Route::get('/pricing-checkout','Website\SubscriptionController@checkout')->name('pricing-checkout');
    
    Route::post('/pricing-checkout/store','Website\SubscriptionController@checkoutStore')->name('pricing-checkout.store');

    // meal planning
    Route::prefix('meal-planning')->name('meal-planning.')->group(function () {
        Route::resource('recipes', 'Website\RecipeController');

        Route::get('/create-meal-plan', 'Website\MealplanController@createMealPlan')->name('create-meal-plan');
        Route::post('/meal-plan', 'Website\MealplanController@generateMealPlan')->name('meal-plan');

        Route::get('grocery/add-ingredients','Website\GroceryController@addIngredients')->name('grocery.add-ingredients');
        Route::post('grocery/update-stock/{id}/{action}', 'Website\GroceryController@updateStock')->name('grocery.update-stock');
        Route::resource('grocery', 'Website\GroceryController');
    });

    // finance management
    Route::prefix('finance')->name('finance.')->group(function () {
        Route::get('budgeting', 'Website\FinanceController@budgetingIndex')->name('budgeting');
        Route::get('budgeting/json_expense_by_category', 'Website\FinanceController@json_expense_by_category')->name('budgeting.json_expense_by_category');
        Route::get('budgeting/json_income_by_category', 'Website\FinanceController@json_income_by_category')->name('budgeting.json_income_by_category');


        Route::get('savings', 'Website\FinanceController@savingIndex')->name('savings');

        Route::get('income-category', 'Website\FinanceController@incomeCategoryIndex')->name('income-category');
        Route::post('income-category/store', 'Website\FinanceController@incomeCategoryStore')->name('income-category.store');
        Route::post('income-category/update', 'Website\FinanceController@incomeCategoryUpdate')->name('income-category.update');
        Route::delete('income-category/{id}', 'Website\FinanceController@incomeCategoryDelete')->name('income-category.destroy');

        Route::resource('income', 'Website\IncomeController');

        Route::resource('expense-category', 'Website\ExpenseCategoryController');

        Route::resource('expense', 'Website\ExpenseController');

        Route::get('transactions', 'Website\FinanceController@transactionsIndex')->name('transactions');

    });

    // relationship management
    Route::prefix('relationship-management')->name('relationship-management.')->group(function () {
        Route::get('family-member/birthdays/{year}/{month}', 'Website\FamilyMemberController@user_calender')->name('family-member.calendar');
        Route::resource('family-member', 'Website\FamilyMemberController');

        Route::resource('family-projects', 'Website\FamilyProjectController');

    });

});
