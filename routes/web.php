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

Route::get('/', 'PagesController@root')->name('root');

Auth::routes(['verify' => true]);

Route::resource('users', 'UsersController', ['only' => ['show', 'edit', 'update']]);

Route::get('/topics', 'TopicsController@index')->name('topics.index');

Route::get('/topics/create', 'TopicsController@create')->name('topics.create');
Route::get('/topics/{topic}', 'TopicsController@show')->name('topics.show');
Route::post('/topics', 'TopicsController@store')->name('topics.store');
Route::put('/topics/{topic}', 'TopicsController@update')->name('topics.update');
Route::get('/topics/{topic}/edit', 'TopicsController@edit')->name('topics.edit');
Route::delete('/topics/{topic}', 'TopicsController@destroy')->name('topics.destroy');


Route::get('/categories/{category}', 'CategoriesController@show')->name('categories.show');

Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');

Route::post('/replies', 'RepliesController@store')->name('replies.store');
Route::delete('/replies/{reply}', 'RepliesController@destroy')->name('replies.destroy');
