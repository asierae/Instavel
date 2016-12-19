<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('web.home');
});
Route::get('/perfil', function () {
    return view('profile.perfil');
});

Auth::routes();//login,register,logout etc

Route::get('/home', 'HomeController@index');

/*Route::get('/perfil','ProfileController@index');
Route::get('/perfil/{id}','ProfileController@getId');*/

