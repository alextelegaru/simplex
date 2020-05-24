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

Route::get('/usuarios', 'UserController@index');

Route::get('/usuario/{id}', 'UserController@show');
Route::post('/usuario/{id}', 'UserController@destroy');

Route::resource('usuarios','UserController');


Route::get('nuevo/usuario', 'UserController@create');
Route::post('recovery', 'RecoveryController@recovery')->name('recovery');


//Route::get('x', 'MenuController@index');


Route::get('/search','MenuController@search');
Route::resource('menu', 'MenuController');

//Route::get('/menu/{id}', 'MenuController@show');
Route::put('/menu/{id}', 'MenuController@update')->name('update');



//Route::get('myform','XController@myform');

//Route::post('myform','XController@myformPost');

Route::get('productos','ProductoController@index');


Route::post('productos','ProductoController@store');


Route::resource('pedidos', 'PedidoController');
Route::resource('productos', 'ProductoController');
Route::post('/productos/{id}', 'ProductoController@destroy');

Route::get('crearmenu/{id}','MenuController@create');

Route::get('contactanos',function(){
    return view('contactanos');
});

Route::get('/precio','PedidoController@precio');
Route::get('/getPedidos','PedidoController@getPedidos');
