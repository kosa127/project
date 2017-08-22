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


Route::group(
    [
    'middleware' => 'roles',
        'roles' => 'Administrator'
    ], function()
{
    Route::get('/users', 'UsersController@index')->name('users.index');
    Route::get('/users/create', 'UsersController@create')->name('users.create');
    Route::post('/users', 'UsersController@store')->name('users.store');
    Route::get('/users/{id}/edit', 'UsersController@edit')->name('users.edit');
    Route::put('/users/{id}', 'UsersController@update')->name('users.update');
    Route::delete('/users/{id}', 'UsersController@destroy')->name('users.destroy');

    Route::get('/expenses', 'ExpensesController@index')->name('expenses.index');
    Route::get('/expenses/create', 'ExpensesController@create')->name('expenses.create');
    Route::post('/expenses', 'ExpensesController@store')->name('expenses.store');
    Route::get('/expenses/{id}/edit', 'ExpensesController@edit')->name('expenses.edit');
    Route::put('/expenses/{id}', 'ExpensesController@update')->name('expenses.update');
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
