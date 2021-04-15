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

Route::get('/', 'PagesController@index');
Route::get('/contact', 'PagesController@contact');
Route::get('/benefits', 'PagesController@benefits');

/* Creates all routes needed by the PostsController functions */
/* You can run php artisan route:list and check it out */
Route::resource('posts', 'PostsController');

Route::post('/contact', 'ContactMsgController@store');

Route::post('', 'CommentsController@store');

/* Automatically created after running artisan auth command */
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
