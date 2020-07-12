<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Customer
Route::get('user','UserController@index');
Route::post('user/verify','UserController@verify');

//Miskin
Route::get('miskin','MiskinController@index');
Route::get('miskin/rekap','MiskinController@rekap');
Route::get('miskin/konfirmasi/{id}','MiskinController@konfirmasi');
Route::post('miskin','MiskinController@tambah');
Route::post('miskin/{id}','MiskinController@edit');
Route::delete('miskin/{id}','MiskinController@hapus');

//PHK
Route::get('phk','PHKController@index');
Route::get('phk/rekap','PHKController@rekap');
Route::get('phk/konfirmasi/{id}','PHKController@konfirmasi');
Route::post('phk','PHKController@tambah');
Route::post('phk/{id}','PHKController@edit');
Route::delete('phk/{id}','PHKController@hapus');