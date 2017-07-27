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
    return response()->json(["hello" => "world!"], 200);
});

Route::get('hazardous', 'NeoController@hazardous');
Route::get('fastest', 'NeoController@fastest');
Route::get('best-year', 'NeoController@bestYear');
Route::get('best-month', 'NeoController@bestMonth');