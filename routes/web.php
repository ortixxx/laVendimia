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

Route::get('/', 'indexController@index');

Route::get('/ventas', 'indexController@ventas');
Route::get('/clientes', 'indexController@clientes');
Route::get('/articulos', 'indexController@articulos');
Route::get('/configuracion', 'indexController@configuracion');
Route::get('/404', 'indexController@error');

//--------------------------------------------------------------------//

Route::post('/guardarConfiguracion', 'configuracionController@guardar');

//--------------------------------------------------------------------//

Route::get('/nuevoCliente', 'clientesController@nuevoCliente');
Route::post('/guardarCliente', 'clientesController@guardar');
Route::get('/editarCliente/{id}', 'clientesController@editar');
Route::post('/guardarEdicion/{id}', 'clientesController@guardarEdicion');

//--------------------------------------------------------------------//

Route::get('/nuevoArticulo', 'articulosController@nuevoArticulo');
Route::post('guardarArticulo', 'articulosController@guardar');
Route::get('/editarArticulo/{id}', 'articulosController@editar');
Route::post('/guardarEdicionArticulo/{id}', 'articulosController@guardarEdicion');

//--------------------------------------------------------------------//

Route::get('/nuevaVenta', 'ventasController@nuevaVenta');
Route::post('/continuarVenta', 'ventasController@continuar');
Route::post('/guardarVenta', 'ventasController@guardar');