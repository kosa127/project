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
    Route::post('//users', 'UsersController@store')->name('users.store');
    Route::get('/users/{id}/edit', 'UsersController@edit')->name('users.edit');
    Route::put('/users/{id}', 'UsersController@update')->name('users.update');
    Route::delete('/users/{id}', 'UsersController@destroy')->name('users.destroy');

    Route::get('/expenses', 'ExpensesController@index')->name('expenses.index');
    Route::get('/expenses/create', 'ExpensesController@create')->name('expenses.create');
    Route::post('/expenses', 'ExpensesController@store')->name('expenses.store');
    Route::get('/expenses/{id}/edit', 'ExpensesController@edit')->name('expenses.edit');
    Route::put('/expenses/{id}', 'ExpensesController@update')->name('expenses.update');
    Route::delete('/expenses/{id}', 'ExpensesController@destroy')->name('expenses.destroy');

    Route::get('/payments', 'PaymentsController@index')->name('payments.index');
    Route::get('/payments/{id}/edit', 'PaymentsController@edit')->name('payments.edit');
    Route::put('/payments/{id}', 'PaymentsController@update')->name('payments.update');
    Route::delete('/payments/{id}', 'PaymentsController@destroy')->name('payments.destroy');
});

Route::group(
    [
        'middleware' => 'roles',
        'roles' => 'User'
    ], function()
{
    Route::get('/users/{id}', 'UsersController@show')->name('users.show');

    Route::get('/expenses', 'ExpensesController@index')->name('expenses.index');
    Route::get('/expenses/{id}', 'ExpensesController@show')->name('expenses.show');
    Route::put('/expenses/{id}', 'ExpensesController@update')->name('expenses.update');
    Route::put('/expenses/{id}', 'ExpensesController@attachUser')->name('expenses.attachUser');
    Route::get('/expenses/create', 'ExpensesController@create')->name('expenses.create');
    Route::post('/expenses', 'ExpensesController@store')->name('expenses.store');
    Route::get('/expenses/{id}/edit', 'ExpensesController@edit')->name('expenses.edit');

});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
