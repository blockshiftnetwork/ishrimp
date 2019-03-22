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

Route::post('/resource/providers', 'ResourceController@storeProvider')->name('storeProvider');
Route::get('/resource/providers', 'ResourceController@showProvider')->name('showProvider');
Route::patch('/resource/providers/{provider_id}', 'ResourceController@updateProvider')->name('updateProvider');
Route::delete('/resource/providers/{provider_id}', 'ResourceController@destroyProvider')->name('destroyProvider');

Route::post('/resource/presentations', 'ResourceController@storePresentation')->name('storePresentation');
Route::get('/resource/presentations', 'ResourceController@showPresentation')->name('showPresentation');
Route::patch('/resource/presentations/{presentation_id}', 'ResourceController@updatePresentation')->name('updatePresentation');
Route::delete('/resource/presentations/{presentation_id}', 'ResourceController@destroyPresentation')->name('destroyPresentation');

Route::post('/resource/laboratories', 'ResourceController@storeLaboratory')->name('storeLaboratory');
Route::get('/resource/laboratories', 'ResourceController@showLaboratory')->name('showLaboratory');
Route::patch('/resource/laboratories/{lab_id}', 'ResourceController@updateLaboratory')->name('updateLaboratory');
Route::delete('/resource/laboratories/{lab_id}', 'ResourceController@destroyLaboratory')->name('destroyLaboratory');




