<?php

use Illuminate\Support\Facades\Route;

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
Route::get('storage-link', function(){
	return Artisan::call('storage:link');
});



Route::get('/', 'EventsController@index')->middleware('auth');

Auth::routes();

Route::get('/paciente', 'PacienteController@index')->name('paciente.index');

Route::get('/admin', 'ServicioController@index')->name('admin.index');

Route::get('/panel', 'ServicioController@show')->name('admin.lte');

Route::get('/panel/agenda', 'ServicioController@showCal')->name('admin.lteCal');

Route::get('/admin/users', 'ServicioController@showUser')->name('admin.showUser');

Route::get('/paciente/create', 'PacienteController@create')->name('paciente.create');

Route::get('/paciente/models', 'PacienteController@model')->name('paciente.model');

Route::post('/paciente', 'PacienteController@store')->name('paciente.store');

Route::post('/user', 'PacienteController@registroNuevo')->name('user.store');

Route::post('/paciente/{paciente}/historia_clinica', 'HistoriaClinicaController@store')->name('hc.store');

Route::post('/paciente/{paciente}/historia_clinica/create', 'HistoriaClinicaController@create')->name('hc.create');

Route::get('/paciente/{paciente}/expediente/show', 'HistoriaClinicaController@show')->name('hc.show');

Route::get('/paciente/{paciente}/dolor/create', 'DolorController@index')->name('dolor.show');

Route::get('/paciente/{paciente}', 'PacienteController@show')->name('paciente.show');

Route::get('/buscar', 'PacienteController@search')->name('buscar.show');

Route::get('/admin/buscar', 'ServicioController@search')->name('buscar.admin');

Route::get('/admin/buscar2', 'ServicioController@search2')->name('buscar.admin2');

Route::get('/paciente/{paciente}/nota/create', 'NotaController@create');

Route::get('/paciente/{paciente}/sv/create', 'SignosVitalController@create');

Route::get('/paciente/{paciente}/historia_clinica/create', 'HistoriaClinicaController@create');

Route::post('/paciente/{paciente}/nota', 'NotaController@store');

Route::post('/servicio/update/{servicio}', 'ServicioController@update');

Route::post('/paciente/update/{paciente}', 'PacienteController@update');

Route::post('/admin/update/{user}', 'PacienteController@updateUser');

Route::delete('/paciente/delete/{paciente}', 'PacienteController@destroy');

Route::post('/admin/servicio', 'ServicioController@store');

Route::post('/admin/hcn', 'ServicioController@storeP');

Route::get('/admin/ingresos', 'ServicioController@ingresos')->name('admin.ingreso');

Route::get('/admin/graficos', 'ServicioController@graficos')->name('admin.graficas');

Route::delete('/admin/servicio/{servicio}', 'ServicioController@destroy')->name('admin.destroy');

Route::delete('/admin/user/{user}', 'PacienteController@destroyUser')->name('admin.destroyUser');

Route::post('/paciente/{paciente}/dolor', 'DolorController@store');

Route::post('/paciente/{paciente}/estudio', 'EstudioController@store');

Route::post('/paciente/{paciente}/sv', 'SignosVitalController@store');

Route::post('/events2', 'EventsController@show');

Route::resource('events', 'EventsController')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');
