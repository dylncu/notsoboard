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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/', 'GameController@home');
Route::get('/games', 'GameController@index');
Route::get('/games/add', 'GameController@create')->middleware('auth');
Route::get('/games/{gameslug}/edit', 'GameController@edit')->middleware('auth');
Route::post('/games/{gameslug}/update', 'GameController@update')->middleware('auth');
Route::get('/games/{gameslug}', 'GameController@show');
Route::get('/games/{gameslug}/delete', 'GameController@destroy')->middleware('auth');
Route::get('/games/{gameslug}/photos', 'GameController@addphotos')->middleware('auth');
Route::post('/games', 'GameController@store');
Route::post('/games/addphotos', 'GameController@storephotos')->middleware('auth');
Route::get('photo/{photoid}', 'GameController@deletephoto')->middleware('auth');
Route::get('/games/{gameslug}/review/add', 'ReviewController@create')->middleware('auth');
Route::get('/games/{gameslug}/{user_id}/review/edit', 'ReviewController@edit')->middleware('auth');
Route::get('/games/{gameslug}/{user_id}/review/delete', 'ReviewController@delete')->middleware('auth');
Route::post('/reviews/{review}', 'ReviewController@update')->middleware('auth');

Route::get('/reviews', 'ReviewController@index');
Route::post('/review', 'ReviewController@store');

Route::get('/home', 'HomeController@home')->name('home');
//for deployment
Auth::routes(['register' => false]);
