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

Auth::routes();

Route::get('/', 'PostController@index');
Route::resource('posts', 'PostController');
Route::get('posts/show/{id}', 'PostController@show')->name('posts.show');

Route::get('b/{slug}', 'BController@slug')->name('slug');

Route::resource('tags', 'TagController');
Route::resource('categories', 'CategoryController');

Route::resource('teams', 'TeamController');
Route::resource('players', 'PlayerController');

Route::get('profile/{id}', 'ProfileController@profile')->name('profile')->middleware('auth');
Route::get('profile/{id}/favorites', 'ProfileController@favorites')->name('favorites')->middleware('auth');
Route::post('profile/{id}/favorites', 'ProfileController@store')->name('favorites.store');
Route::delete('profile/{user_id}/favorites/{post_id}', 'ProfileController@destroy')->name('favorites.destroy');

Route::get('register/verify/{token}', 'Auth\RegisterController@verify');