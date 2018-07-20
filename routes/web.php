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

Route::get('/', 'PostController@index');
// Route::get('/posts/{id}', 'PostController@show');
Route::get('/posts/{post}', 'PostController@show')->where('post', '[0-9]+');
Route::get('/posts/create', 'PostController@create');
Route::post('/post/confirm', 'PostController@confirm');
// Route::post('/post/complete', 'PostController@complete');
Route::post('/post/complete', 'PostController@store');
Route::get('/posts/{post}/edit', 'PostController@edit');
Route::patch('/posts/{post}', 'PostController@update');
Route::delete('/posts/{post}', 'PostController@destroy');
Route::post('/posts/{post}/comments', 'CommentsController@store');
Route::delete('/posts/{post}/comments/{comment}', 'CommentsController@destroy');
Route::get('/users/{user}', 'UsersController@show');

Route::get('/contact', 'ContactController@index');
// Route::post('/contact', 'ContactController@store');
Route::post('/contact/confirm', 'ContactController@confirm');
Route::post('/contact/complete', 'ContactController@complete');

Route::post('register/pre_check', 'Auth\RegisterController@pre_check')->name('register.pre_check');
Auth::routes();
Route::get('register/verify/{token}', 'Auth\RegisterController@showForm');
Route::post('register/main_check', 'Auth\RegisterController@mainCheck')->name('register.main.check');
Route::post('register/main_register', 'Auth\RegisterController@mainRegister')->name('register.main.registered');

// Route::get('/home', 'HomeController@index')->name('home');
