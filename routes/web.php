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

Route::get('b/{slug}', 'BController@slug')->name('slug');

Route::resource('tags', 'TagController');
Route::resource('categories', 'CategoryController');