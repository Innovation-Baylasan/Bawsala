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

Route::get('/', function () {
    return view('welcome');
});

Route::namespace('Admin')
    ->prefix('admin')
    ->group(function () {

        Route::get('/categories', 'CategoriesController@index');
        Route::get('/categories/create', 'CategoriesController@create');
        Route::get('/categories/{category}', 'CategoriesController@show');

        Route::resource('roles', 'RolesController');
        Route::resource('tags', 'TagsController');
        Route::resource('users', 'UsersController');
        Route::resource('entities', 'EntitiesController');
        Route::resource('categories', 'CategoriesController');

    });
