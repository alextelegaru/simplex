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
Route::get('/eliminarUsuario/{id}','UserController@destroy');
Route::post('recovery', 'RecoveryController@recovery')->name('recovery');





Route::get('/search','MenuController@search');
Route::resource('menu', 'MenuController');


Route::put('/menu/{id}', 'MenuController@update')->name('update');





Route::get('productos','ProductoController@index');


Route::post('productos','ProductoController@store');


Route::resource('pedidos', 'PedidoController');
Route::resource('productos', 'ProductoController');
Route::post('/productos/{id}', 'ProductoController@destroy');

Route::get('crearmenu/{id}','MenuController@create');


Route::get('contactanos','RecoveryController@index');



Route::get('/precio','PedidoController@precio');
Route::get('/getPedidos','PedidoController@getPedidos');


Route::post('/confirmar/{id}','PedidoController@confirmar');



Route::get('/modificar/{id}','PedidoController@modificar');

Route::post('/actualizarPedido/{id}','PedidoController@actualizar');
Route::get('/imprimir', 'PedidoController@imprimir')->name('imprimir');


Route::get('/cobrar/{id}', 'PedidoController@cobrar');

Route::get('/imprimir/{id}/{pago}/{cambio}/{nombre}', 'PedidoController@imprimir');


Route::get('/getName', 'UserController@getName');
Route::get('/precio/{id}','ProductoController@getPrecio');
Route::get('/nombre/{id}','ProductoController@getNombre');

Route::post('/actualizar/{id}','ProductoController@actualizar');


Route::get('/getCoste/{id}','PedidoController@getCoste');
Route::post('/soporte', 'RecoveryController@soporte');


Route::get('/crearPedido','PedidoController@create');

Route::get('/crearMenu','MenuController@create');


Route::get('/crearUsuario','UserController@create');


