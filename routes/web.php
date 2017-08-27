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
    return redirect('login');
});

Route::group(                                    //ADMINISTRATOR
    ['middleware' => 'roles',
        'roles' => 'Administrator'
    ], function()
{
    Route::get('/users', 'UsersController@index')->name('users.index');
    Route::get('/users/create', 'UsersController@create')->name('users.create');
    Route::post('//users', 'UsersController@store')->name('users.store');
    Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
    Route::put('/users/{user}', 'UsersController@update')->name('users.update');
    Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');

    Route::get('/payments', 'PaymentsController@index')->name('payments.index');
});


Route::group(                                    //USER
    ['middleware' => 'roles',
        'roles' => 'User'
    ], function()
{
    Route::put('/expenses/{expense}/attach-user', 'ExpensesController@attachUser')->name('expenses.attachUser');

    Route::get('/users/{id}', 'UsersController@show')->name('users.show');
});

Route::group(                                     //ADMINISTRATOR & USER
    ['middleware' => 'roles',
        'roles' => ['Administrator', 'User']
    ], function()
{
    Route::get('/expenses', 'ExpensesController@index')->name('expenses.index');
    Route::get('/expenses/create', 'ExpensesController@create')->name('expenses.create');
    Route::post('/expenses', 'ExpensesController@store')->name('expenses.store');
    Route::get('/expenses/{expense}/edit', 'ExpensesController@edit')->name('expenses.edit');
    Route::put('/expenses/{expense}', 'ExpensesController@update')->name('expenses.update');
    Route::get('/expenses/{expense}', 'ExpensesController@show')->name('expenses.show');
    Route::delete('/expenses/{expense}', 'ExpensesController@destroy')->name('expenses.destroy');

    Route::get('/payments/{payment}/edit', 'PaymentsController@edit')->name('payments.edit');
    Route::put('/payments/{payment}', 'PaymentsController@update')->name('payments.update');
    Route::delete('/payments/{payment}', 'PaymentsController@destroy')->name('payments.destroy');
    Route::get('/payments/create/{payment}', 'PaymentsController@create')->name('payments.create');
    Route::post('/payments', 'PaymentsController@store')->name('payments.store');
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
