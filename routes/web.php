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

Route::get('/test', function () {
    dd(\App\Maize::latest_maize_report());
})->name('test');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/loans', 'LoansController@index')->name('loans');
Route::post('/loans/store', 'LoansController@store')->name('loans.store');

Route::get('/maize/{action}', 'MaizeController@index')->name('maize.report');
Route::post('/maize/store', 'MaizeController@store')->name('maize.store');