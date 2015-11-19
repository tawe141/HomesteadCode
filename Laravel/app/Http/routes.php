<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return "hello there!";
});

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('/contact', 'StaticController@contact');

Route::get('/store', 'InfoController@store');
Route::post('/postinfo', 'InfoController@postinfo');
Route::get('/whatdata', 'InfoController@whatdata');
Route::get('/whatdata/{id}', 'InfoController@whatdata');
Route::get('/whatdata/author/{name}', 'InfoController@whatdata_author');
Route::get('/whatdata/tags/{name}', 'InfoController@whatdata_tags');
// Route::get('/whatdata/{id}', 'InfoController@whatdata');
Route::get('/editinfo/{id}', 'InfoController@editinfo');
Route::post('/updateinfo/{id}', 'InfoController@updateinfo');
Route::get('/deleteinfo/{id}/confirm', 'InfoController@deleteConfirmation');
Route::get('/deleteinfo/{id}', 'InfoController@deleteinfo');
Route::get('/restoreinfo/{id}', 'InfoController@restoreinfo');

Route::post('/search', 'SearchController@searchParent');
Route::get('/searchResult', 'SearchController@searchResult');
