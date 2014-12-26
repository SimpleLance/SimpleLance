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

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::group(['before' => 'auth'], function()
{
	Route::resource('projects', 'ProjectsController');
	Route::resource('tickets', 'TicketsController');
	Route::resource('priorities', 'PrioritiesController', ['except' => ['show']]);
	Route::resource('statuses', 'StatusesController');
});