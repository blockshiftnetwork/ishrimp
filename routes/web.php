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

//statistic pools
Route::resource('/pools', 'PoolController');
Route::get('/pools/bio/{pool_id}','PoolController@statisticBiomasa');
Route::get('/pools/balancedused/{pool_id}','PoolController@staticBalanced');
Route::get('/pools/summary/{pool_id}','PoolController@getPoolSummary');
Route::get('/pools/parameters/{pool_id}','PoolController@staticParameter');
Route::get('/pools/resourcesused/{pool_id}','PoolController@statisticResourceUsed');

//sowing controller
Route::resource('/pools_sowing', 'PoolSowingController');

//cultivation
Route::resource('/cultivation', 'CultivationController');
Route::post('/cultivation/daylyParam', 'CultivationController@storeDaylyParam')->name('storeDaylyParam');
Route::patch('/cultivation/daylyParam/{param_id}', 'CultivationController@updateDaylyParam')->name('updateDaylyParam');
Route::delete('/cultivation/daylyParam/{param_id}', 'CultivationController@destroyDaylyParam')->name('destroyDaylyParam');

Route::post('/cultivation/daylyabw', 'CultivationController@storeDaylyABW')->name('storeDaylyABW');
Route::patch('/cultivation/daylyabw/{abw_id}', 'CultivationController@updateDaylyABW')->name('updateDaylyABW');
Route::delete('/cultivation/daylyabw/{abw_id}', 'CultivationController@destroyDaylyABW')->name('destroyDaylyABW');

Route::patch('cultivation/used/{used_id}','CultivationController@update')->name('updateUsed');
Route::delete('cultivation/used/{used_id}','CultivationController@destroy')->name('destroyUsed');

//check existence
Route::get('presentation/{resource_id}','CultivationController@getPresentationResource');
Route::get('existence/{resource_id}/{presentation_id}','CultivationController@verifyExistence');

//resources controller
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
//resources inventory
Route::post('/resource/inventorty', 'ResourceController@storeInventory')->name('storeInventory');
Route::get('/resource/inventorty', 'ResourceController@showInventory')->name('showInventory');
Route::patch('/resource/inventorty/{inventorty_id}', 'ResourceController@updateInventory')->name('updateInventory');
Route::delete('/resource/inventorty/{inventorty_id}', 'ResourceController@destroyInventory')->name('destroyInventory');




