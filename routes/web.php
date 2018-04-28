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
Route::get('getEstados','PersonaController@getEstados');
/*URLS PARA SELECTS DOMICILIO */
Route::get('getEstados2','DomicilioController@getEstados');
Route::get('getMunicipios2/{id}','DomicilioController@getMunicipios');
Route::get('getLocalidades2/{id}','DomicilioController@getLocalidades');
Route::get('getColonias2/{id}','DomicilioController@getColonias');
Route::get('getCodigosPostales2/{id}','DomicilioController@getCodigosPostales');
