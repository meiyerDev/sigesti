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
	return view('auth.login');
});

// Route::get('/example/{articulo}', 'ExampleReportController@examplePdf');

/*--- LOGIN-REGISTER ---*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*--- DEPARTAMENTOS ---*/
Route::resource('department','DepartmentController')->except([
	'create'
]);

/*--- EXPERTOS ---*/
Route::get('/expert/assignments','OtherController@assignment');
Route::get('/expert/busExpert/{id}', 'PersonController@busExpert');
Route::resource('expert','PersonController')->except([
	'create'
]);

/*--- REPORTES-PDF ---*/
Route::put('/reporte/{aticulo}','OtherController@crearReporte');
Route::get('/report/comprobante/{aticulo}','OtherController@reportar');
Route::get('/report/reportarPDF/{aticulo}','OtherController@pdf');
Route::get('/report/reportInvent/{type}','OtherController@reportInventory')->name('reporte.inventory');
Route::get('/report/reportRequested','OtherController@reportRequested')->name('reporte.solicitud');
Route::get('/report/reportTecnico/{id}','OtherController@reportTecnico')->name('reporte.repar');

/*--- CRUD-REPORTES ---*/
Route::resource('report', 'ReportController');

/*--- CODIGOS QR ---*/
Route::get('/cod/{aticulo}','OtherController@dataQr')->name('cod.dataQr');

Route::group(['prefix' => 'inventory'], function() {
	Route::get('list', 'InventoryController@index')->name('inventory.index');
	Route::post('list', 'InventoryController@store')->name('inventory.store');
	Route::delete('{id}', 'InventoryController@destroy')->name('inventory.destroy');
	Route::get('{id}', 'InventoryController@show')->name('inventory.show');
	Route::put('asigDepart/{id}', 'InventoryController@asignarDepart')->name('inventory.asigDepart');
	Route::put('{id}', 'InventoryController@update')->name('inventory.update');
});

Route::group(['prefix' => 'requested'], function() {
	Route::post('new', 'RequestsController@store')->name('requested.store');
	Route::get('{id}', 'RequestsController@show')->name('requested.show');
	Route::delete('{id}', 'RequestsController@destroy')->name('requested.delete');
});

/*--- EDITAR PERFIL ---*/
Route::get('/perfil/{id}', 'PersonController@editUser')->name('userPerfil.show');
Route::put('/perfil', 'PersonController@updateUser')->name('userPerfil.update');
