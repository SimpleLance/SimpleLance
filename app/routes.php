<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['before' => 'Sentinel\auth'], function()
{
	Route::resource('projects', 'ProjectsController');
	Route::resource('tickets', 'TicketsController');
	Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
});

Route::group(['before' => 'Sentinel\inGroup:Admins'], function()
{
	Route::resource('priorities', 'PrioritiesController', ['except' => ['show']]);
	Route::resource('statuses', 'StatusesController', ['except' => ['show']]);
});