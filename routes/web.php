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
    Route::get('/admin/users', 'UsersController@index')->name('admin.users.index');
    Route::get('/admin/users/create', 'UsersController@create')->name('admin.users.create');
    Route::post('/admin/users', 'UsersController@store')->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', 'UsersController@edit')->name('admin.users.edit');
    Route::put('/admin/users/{id}', 'UsersController@update')->name('admin.users.update');
    Route::delete('/admin/users/{id}', 'UsersController@destroy')->name('admin.users.destroy');

    Route::get('/admin/expenses', 'ExpensesController@index')->name('admin.expenses.index');
    Route::get('/admin/expenses/create', 'ExpensesController@create')->name('admin.expenses.create');
    Route::post('/admin/expenses', 'ExpensesController@store')->name('admin.expenses.store');
    Route::get('/admin/expenses/{id}/edit', 'ExpensesController@edit')->name('admin.expenses.edit');
    Route::put('/admin/expenses/{id}', 'ExpensesController@update')->name('admin.expenses.update');
    Route::delete('/admin/expenses/{id}', 'ExpensesController@destroy')->name('admin.expenses.destroy');
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
