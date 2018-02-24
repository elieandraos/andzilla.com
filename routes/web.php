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
    Route::get('transactions', 'TransactionsController@index')->name('transactions');
    Route::get('transactions/create', 'TransactionsController@create')->name('transactions.create');
    Route::post('transactions/store', 'TransactionsController@store')->name('transactions.store');
    Route::get('transactions/{id}/edit', 'TransactionsController@edit')->name('transactions.edit');
    Route::post('transactions/{id}/update', 'TransactionsController@update')->name('transactions.update');
});

Route::get('/home', 'HomeController@index')->name('home');
