<?php
use Illuminate\Http\Request;

/*URLS PARA PERSONAS */
Route::get('/','PersonaController@index');
Route::post('addPersona','PersonaController@addPersona')->name('addPersona');

/*URLS PARA DOMICILIOS*/
Route::get('/domicilio','DomicilioController@index');
Route::post('addDomicilio','DomicilioController@addDomicilio')->name('addDomicilio');

/*URLS PARA SELECTS PERSONAS */
Route::get('getNacionalidades','PersonaController@getNacionalidades');
Route::get('getMunicipios','PersonaController@getMunicipios');
Route::get('getEtnias','PersonaController@getEtnias');
Route::get('getLenguas','PersonaController@getLenguas');

/*URLS PARA SELECTS DOMICILIO */
Route::get('getEstados','DomicilioController@getEstados');
Route::get('getMunicipios','DomicilioController@getMunicipios');
Route::get('getLocalidades','DomicilioController@getLocalidades');
Route::get('getColonias','DomicilioController@getColonias');
Route::get('getCodigosPostales','DomicilioController@getCodigosPostales');
