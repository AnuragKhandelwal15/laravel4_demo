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

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('login', array('as' => 'login', 'uses' => 'UsersController@login'));

Route::post('/login', array('as' => 'loginData', 'uses' => 'UsersController@handleLogin'));

Route::get('/profile', array('as' => 'profile', 'uses' => 'UsersController@profile'));

Route::get('/logout', array('as' => 'logout', 'uses' => 'UsersController@logout'));

//Route::resource('user', 'UsersController'); 
Route::get('/create', array('as' => 'create', 'uses' => 'UsersController@create'));

Route::post('/store', array('as' => 'store', 'uses' => 'UsersController@store'));

Route::post('/uploadimage', array('as' => 'uploadimage', 'uses' => 'UsersController@uploadimage'));

Route::get('/myfiles', array('as' => 'myfiles', 'uses' => 'MyfilesController@myfiles'));

Route::post('/uploadfile', array('as' => 'uploadfile', 'uses' => 'MyfilesController@uploadfile'));