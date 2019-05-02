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
Route::resource('expert','PersonController')->except([
	'create'
]);

/*--- REPORTES-PDF ---*/
Route::get('/report/comprobante/{aticulo}','OtherController@reportar');
Route::get('/report/reportarPDF/{aticulo}','OtherController@pdf');

/*--- CRUD-REPORTES ---*/
Route::resource('report', 'ReportController');

/*--- CODIGOS QR ---*/
Route::get('/cod/{aticulo}','OtherController@dataQr')->name('cod.dataQr');


Route::get('/qrcode', function () {
	
  	$qr = \QrCode::size(500)->generate('hola');
	
	return $qr;

});
