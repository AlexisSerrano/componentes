<?php
use Illuminate\Http\Request;

Route::get('/','PersonaController@index');
Route::post('addPersona','PersonaController@addPersona')->name('addPersona');

/*URLS PARA SELECTS PERSONAS */
Route::get('getNacionalidades','PersonaController@getNacionalidades');
Route::get('getMunicipios','PersonaController@getMunicipios');
Route::get('getEtnias','PersonaController@getEtnias');
Route::get('getLenguas','PersonaController@getLenguas');

Route::get('/prueba2', function () {
    return view('prueba2');
});