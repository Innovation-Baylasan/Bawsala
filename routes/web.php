<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::domain('{domain}.bawsala.app')->group(function () {
    Route::get('/', function ($domain) {
        return $domain;
    });
});

Route::get('/', 'HomeController@index');

Route::get('/entities', 'EntitiesController@index');

Route::middleware('auth')->group(function () {

    Route::get('/account', 'UsersProfilesController@index')->middleware('auth');

    Route::get('/account/{user}', 'UsersProfilesController@show')->middleware('auth');

    Route::get('/entities/create', 'EntitiesController@create')->middleware('auth');

    Route::post('/entities', 'EntitiesController@store')->middleware('auth');

    Route::put('/entities/{entity}', 'EntitiesController@update')->middleware('auth');

    Route::put('/entities/{entity}/follow', 'EntitiesFollowersController@update')->middleware('auth');

    Route::post('/entities/{entity}/rate', 'EntitiesRatingController@store')->middleware('auth');

    Route::post('/entities/{entity}/reviews', 'EntitiesReviewsController@store')->middleware('auth');

    Route::post('/events', 'EventsController@store')->middleware('auth')->middleware('auth');

});

Route::get('/@{entity}', 'EntitiesController@show');

Route::post('/issues', 'IssuesController@store');

Route::put('/user-info/update', 'UserInfoController@update');

Route::get('/faq', 'PagesController@faq');

Route::get('/terms', 'PagesController@terms');

Route::get('/policy', 'PagesController@policy');


Route::namespace('Admin')
    ->prefix('admin')
    ->middleware(['admin'])
    ->group(function () {
        Route::get('/', 'DashboardController@index');
        Route::resource('tags', 'TagsController');
        Route::resource('questions', 'QuestionsController');
        Route::resource('issues', 'IssuesController');
        Route::resource('users', 'UsersController');
        Route::resource('entities', 'EntitiesController');
        Route::resource('categories', 'CategoriesController');
        Route::resource('profiles', 'ProfilesController');
        Route::resource('events', 'EventsController');

        Route::get('/settings', 'SettingsController@index');

        Route::post('/settings', 'SettingsController@store');

        Route::post('/entities/{entity}/verify', 'EntityVerificationController@store');

        Route::delete('/entities/{entity}/verify', 'EntityVerificationController@destroy');
    });


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
