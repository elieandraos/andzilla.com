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
    return redirect(route('login'));
});

Auth::routes();

// Admin routes
Route::middleware(['auth'])->group(function () {
	// transactions
    Route::get('transactions', 'TransactionsController@index')->name('transactions');
    Route::get('transactions/create', 'TransactionsController@create')->name('transactions.create');
    Route::post('transactions/store', 'TransactionsController@store')->name('transactions.store');
    Route::get('transactions/{id}/edit', 'TransactionsController@edit')->name('transactions.edit');
    Route::post('transactions/{id}/update', 'TransactionsController@update')->name('transactions.update');

    // Reports
    Route::get('reports/current-month', 'ReportsController@index')->name('reports.current-month');
    Route::get('reports/monthly-total', 'ReportsController@monthly')->name('reports.monthly-total');
    Route::get('reports/monthly-total-by-category', 'ReportsController@monthlyTotalByCategory')->name('reports.monthly-total-by-category');
});

Route::get('/home', 'HomeController@index')->name('home');

/*
@todo:
- cache transactions per user, as it will be faster to fetch for reports
- delete transcations
- category module
- verify email address upon sign up
- mail configuration on server
- npm configuration on server (move back app/js css/ to gitgnore)