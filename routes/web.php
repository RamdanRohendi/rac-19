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

Route::get('/', 'HomeController@index');

Auth::routes();

//Route Dibawah Ini Bisa Diakses Apabila Telah Melakukan Log-In
Route::group(['middleware' => 'auth'], function(){

	/**
	 * Data Daerah
	 */
	//index
	Route::get('/daerah', 'DaerahController@index');
	Route::get('/daerah/cari', 'DaerahController@cari');
	Route::get('/daerah/sort', 'DaerahController@urutkan');

	//tambah
	Route::get('/daerah/create', 'DaerahController@create');
	Route::post('/daerah', 'DaerahController@store');

	//edit
	Route::get('/daerah/{id}/edit', 'DaerahController@edit');
	Route::patch('/daerah/{id}', 'DaerahController@update');

	//hapus
	Route::delete('/daerah/{id}', 'DaerahController@destroy');



	/**
	 * Data Rumah Sakit
	 */
	//index
	Route::get('/rs', 'RsController@index');
	Route::get('/rs/cari', 'RsController@cari');
	Route::get('/rs/sort', 'RsController@urutkan');

	//tambah
	Route::get('/rs/create', 'RsController@create');
	Route::post('/rs', 'RsController@store');

	//edit
	Route::get('/rs/{id}/edit', 'RsController@edit');
	Route::patch('/rs/{id}', 'RsController@update');

	//hapus
	Route::delete('/rs/{id}', 'RsController@destroy');



	/**
	 * Data Pasien
	 */
	//index
	Route::get('/pasien', 'PasienController@index');
	Route::get('/pasien/cari', 'PasienController@cari');
	Route::get('/pasien/sort', 'PasienController@urutkan');

	//tambah
	Route::get('/pasien/create', 'PasienController@create');
	Route::post('/pasien', 'PasienController@store');

	//edit
	Route::get('/pasien/{id}/edit', 'PasienController@edit');
	Route::patch('/pasien/{id}', 'PasienController@update');

	//hapus
	Route::delete('/pasien/{id}', 'PasienController@destroy');
});