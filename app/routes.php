<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@homepage');

Route::get('/join', 'UsersController@showcreate');

Route::post('/join', 'UsersController@store');

Route::get('/verify', 'UsersController@showverify');

Route::post('/verify', 'UsersController@doverify');

Route::get('/login', 'UsersController@showlogin');

Route::post('/login', 'UsersController@dologin');

Route::get('/logout', 'UsersController@logout');

Route::get('/users/{id}', 'UsersController@profile');

Route::get('/users/{id}/edit', 'UsersController@showedit');

Route::post('/users/{id}/edit', 'UsersController@doedit');

Route::DELETE('/users/{id}/edit', 'UsersController@destroy');

Route::get('/users/{id}/images', 'UsersController@showimages');

Route::post('/users/{id}/images', 'UsersController@storeimage');

Route::get('/users/{id}/password', 'UsersController@editpassword');

Route::post('/users/{id}/password', 'UsersController@updatepassword');

Route::get('/details', 'UsersController@showdetails');

Route::post('/details', 'UsersController@dodetails');

Route::get('/browse', 'BrowseController@index');

Route::get('/browse/closest', 'BrowseController@closest');

Route::get('/vote', 'BrowseController@determinevote');

Route::get('/vote/{id}', 'BrowseController@showvote');

Route::post('/vote/{id}', 'BrowseController@storevote');

Route::get('/inbox', 'MessageController@inbox');

Route::get('/users/{id}/contact', 'MessageController@contactmember');

Route::post('/users/{id}/contact', 'MessageController@sendmessage');

Route::get('/inbox/{message_id}/{person_id}', 'MessageController@showmessage');

Route::post('/inbox/{message_id}/{person_id}', 'MessageController@reply');

Route::get('/users/{id}/icebreaker', 'MessageController@setupicebreaker');

Route::post('/users/{id}/icebreaker', 'MessageController@sendicebreaker');
\
Route::get('/icebreakers/{id}', 'MessageController@showicebreaker');

Route::post('/icebreakers/{id}', 'MessageController@replyicebreaker');






