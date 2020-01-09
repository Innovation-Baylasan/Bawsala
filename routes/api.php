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

    // Authentication Routes
//    Route::post('/login', 'UserController@authenticate');
//    Route::post('/register', 'UserController@register');

    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/refresh', 'AuthController@refresh');
    Route::get('/me', 'AuthController@me');


    Route::get('/categories', 'CategoriesController@index');

    Route::get('/categories/{category}', 'CategoriesController@show');

    Route::get('/categories/{category}/entities', 'CategoryEntitiesController@index');

    Route::get('/entities', 'EntitiesController@index');

    Route::get('/entities/{entity}', 'EntitiesController@show');

    Route::get('/entities/{entity}/rate', 'EntityRate@store');

    Route::get('/entities/{entity}/review', 'EntityReview@store');

    Route::post('/entities/find', 'EntitiesController@find');

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
