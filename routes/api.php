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

Route::middleware('apilogger')->namespace('Api')->group(function () {

    Route::post('/register', 'RegisterController@store');

    Route::post('/login', 'LoginController@store');

    Route::get('/categories', 'CategoriesController@index')->name('api.categories.index');

    Route::get('/categories/{category}', 'CategoriesController@show')->name('api.categories.show');

    Route::get('/categories/{category}/entities', 'CategoryEntitiesController@index')->name('api.categoryEntities.index');

    Route::get('/entities', 'EntitiesController@index')->name('api.entities.index');

    Route::get('/entities/{entity}', 'EntitiesController@show')->name('api.entities.show');

    Route::put('/entities/{entity}/rating', 'EntitiesRatingController@update')->name('api.entitiesRating.update');

    Route::get('/entities/{entity}/reviews', 'EntitiesReviewsController@index')->name('api.entitiesReviews.index');

    Route::post('/entities/{entity}/review', 'EntitiesReviewsController@store')->name('api.entitiesReviews.store');

    Route::delete('/entities/{entity}/review', 'EntitiesReviewsController@destory')->name('api.entitiesReviews.destroy');

    Route::post('/entities/{entity}/follow', 'EntitiesFollowingController@store')->name('api.entitiesFollowing.store');

    Route::delete('/entities/{entity}/follow', 'EntitiesFollowingController@destroy')->name('api.entitiesFollowing.destroy');

    Route::get('/tags', 'TagsController@index');

    Route::get('/events', 'EventsController@index');

    Route::middleware('auth:api')->post('/events/store', 'EventsController@store');

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
