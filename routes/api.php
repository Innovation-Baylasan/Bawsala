<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api')->group(function () {

    Route::get('/categories', 'CategoriesController@index');

    Route::get('/categories/{category}', 'CategoriesController@show');

    Route::get('/categories/{category}/entities', 'CategoryEntitiesController@index');

    Route::get('/entities', 'EntitiesController@index');

    Route::get('/entities/{entity}', 'EntitiesController@show');

    Route::post('/entities/find', 'EntitiesController@find');

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
