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
 
Route::get('/', 'WelcomeController@show');
Route::get('/home', 'HomeController@show');
Route::resource('/pools', 'PoolController');
Route::resource('/pools_sowing', 'PoolSowingController');
Route::resource('/cultivation', 'CultivationController');
Route::get('presentation/{resource_id}','CultivationController@getPresentationResource');
Route::resource('/sowing', 'SowingController');
Route::resource('/resource', 'ResourceController');
Route::resource('/provider', 'ProviderController');

