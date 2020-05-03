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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/usuarios', 'UserController@index')->name('usuarios');

Route::get('/usuario/{id}', 'UserController@show');
Route::post('/usuario/{id}', 'UserController@destroy');




Route::resource('usuarios','UserController');
Route::post('recovery', 'RecoveryController@recovery')->name('recovery');
