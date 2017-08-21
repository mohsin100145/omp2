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

Route::get('/result', 'ResultController@index');
Route::get('/result/create', 'ResultController@create');
Route::get('/result/student-info-show', 'ResultController@studentInfoShow');
Route::post('/result', 'ResultController@store');
Route::get('/result/{id}', 'ResultController@show');
Route::get('/result/{id}/edit', 'ResultController@edit');
Route::put('/result/{id}', 'ResultController@update');

Route::get('/import-export', 'ExcelController@importExport');
Route::get('/download-excel/{type}', 'ExcelController@downloadExcel');
Route::post('/import-excel', 'ExcelController@importExcel');

Route::get('/six-to-eight-result', 'SixToEightResultController@index');
Route::get('/six-to-eight-result/create', 'SixToEightResultController@create');
Route::get('/six-to-eight-result/student-info-show', 'SixToEightResultController@studentInfoShow');
Route::post('/six-to-eight-result', 'SixToEightResultController@store');
Route::get('/six-to-eight-result/{id}', 'SixToEightResultController@show');
Route::get('/six-to-eight-result/{id}/edit', 'SixToEightResultController@edit');
Route::put('/six-to-eight-result/{id}', 'SixToEightResultController@update');
