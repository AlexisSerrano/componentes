<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::post('getValidaciones','GenericController@ValidacionDBJSON');
Route::post('PersonaFisica','GenericController@ValidacionJSONDBPF');
Route::post('PersonaMoral','GenericController@ValidacionJSONDBPM');
Route::post('SearchUndefined','GenericController@SearchUndefined');

Route::group(['prefix' => 'test'], function () {
    Route::post('SetConfirm','GenericController@SetConfirm');
    Route::post('getValidaciones','GenericController@ValidacionDBJSON');
    Route::post('SearchUndefined','GenericController@SearchUndefined');
    Route::post('ValidacionJSONDBPF','GenericController@ValidacionJSONDBPF');
    Route::post('ValidacionJSONDBPM','GenericController@ValidacionJSONDBPM');
});
