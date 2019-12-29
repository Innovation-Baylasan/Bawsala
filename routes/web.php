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


Route::get('/@{name}', function ($name) {
    return view('profile')->withName($name);
})->middleware('auth');

Route::namespace('Admin')
    ->prefix('admin')
    ->middleware(['admin'])
    ->group(function () {

        Route::get('', function () {
            return view('admin.all');
        });

        Route::resource('roles', 'RolesController');
        Route::resource('tags', 'TagsController');
        Route::resource('users', 'UsersController');
        Route::resource('entities', 'EntitiesController');
        Route::resource('categories', 'CategoriesController');
        Route::resource('profiles', 'ProfilesController');
        Route::resource('entity_tags', 'EntityTagsController');

    }, []);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
