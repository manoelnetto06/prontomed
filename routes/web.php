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
    return view('index');
});

Route::get('/pacientes', 'PacientesController@indexView');
Route::get('/agendamentos', 'AgendamentosController@indexView');
Route::get('/consultas/{id}', 'ConsultasController@view');
//Route::get('/consultas', 'ConsultasController@view');

Route::get('/consultas/teste2/{id}', 'ConsultasController@teste');
