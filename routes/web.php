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

Route::get('/', 'HomeController@index');

Route::get('sekolah/SMA', 'SekolahController@showJenjang');
Route::get('sekolah/SMK', 'SekolahController@showJenjang');
Route::get('sekolah/SLB', 'SekolahController@showJenjang');
Route::resource('sekolah', 'SekolahController');

Route::get('guru/SMA', 'GuruController@showJenjang');
Route::get('guru/SMK', 'GuruController@showJenjang');
Route::get('guru/SLB', 'GuruController@showJenjang');
Route::post('guru/search', 'GuruController@search');
Route::resource('guru', 'GuruController');

