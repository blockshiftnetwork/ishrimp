<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register the API routes for your application as
| the routes are automatically authenticated using the API guard and
| loaded automatically by this application's RouteServiceProvider.
|
*/

Route::group([
    'middleware' => 'auth:api'
], function () {
    Route::get('users', function() {
        return['username' => 'tao'];
    });
});


Route::get('create-test-token', function() {
    $user = \App\User::find(1);
    // Creating a token without scopes...
    $token = $user->createToken('Test Token Name')->accessToken;
    return ['token' => $token];
});