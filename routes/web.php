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

use App\Barcode;
use PDF;


Route::get('/', function () {
	$barcodes = Barcode::all();
	foreach ($barcodes as $barcode) {
		$bars = $barcode->barcode;
	}
	$pdf = PDF::loadView('welcome');

		return $pdf->download('invoice.pdf');
});
