<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('projects', 'ProjectsController');
    Route::resource('tickets', 'TicketsController');
    Route::resource('invoices', 'InvoicesController');
    Route::get('/tickets/status/{status}', ['as' => 'tickets.by.status', 'uses' => 'TicketsController@filterByStatus']);
    Route::get('/projects/status/{status}', ['as' => 'projects.by.status', 'uses' => 'ProjectsController@filterByStatus']);
    Route::post('tickets/{id}/reply', 'TicketsController@reply');
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
    # Override Sentinel's Default user routes with our own filter requirement
    Route::get('/users/{id}', ['as' => 'sl_user.show', 'uses' => 'SimpleLance\UserController@show'])->where('id', '[0-9]+');
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
    # Manual routes to allow for invoice creation
    Route::get('/invoices/{id}/items', 'InvoicesController@items');
    Route::post('/invoices/{id}/items', 'InvoicesController@storeItem');
    Route::get('/invoices{id}/send', 'InvoicesController@send');

    //Route::group(['before' => 'Sentinel\inGroup:Admins'], function () {
    Route::resource('priorities', 'PrioritiesController', ['except' => ['show']]);
    Route::resource('statuses', 'StatusesController', ['except' => ['show']]);
    //});

});

Route::get('/home', function () {
    return redirect('/dashboard');
});
