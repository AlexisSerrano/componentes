<?php
use Illuminate\Http\Request;

/*URLS PARA PERSONAS */
Route::get('/','PersonaController@index');

/*URLS PARA DOMICILIOS*/
Route::get('/domicilio','DomicilioController@index');
Route::post('addDomicilio','DomicilioController@addDomicilio')->name('addDomicilio');

/*URLS PARA EMPRESAS*/
Route::get('/personaMoral','PersonaMoralController@index');

/*URLS PARA SELECTS DOMICILIO */
Route::get('getEstados','DomicilioController@getEstados');
Route::get('getMunicipios/{id}','DomicilioController@getMunicipios');
Route::get('getLocalidades/{id}','DomicilioController@getLocalidades');
Route::get('getColonias/{id}','DomicilioController@getColonias');
Route::get('getCodigosPostales/{id}','DomicilioController@getCodigosPostales');

/*URLS COMPONENTES EXTRA*/
Route::get('/extrasInvestigadoFisico','ExtrasInvestigadoController@indexFisico');
Route::get('/extrasInvestigadoMoral','ExtrasInvestigadoController@indexMoral');
Route::get('/extrasAbogado','ExtrasAbogadoController@index');
Route::get('/extrasDenunciante','ExtrasDenuncianteController@index');
Route::get('/extrasAutoridad','ExtrasAutoridadController@index');

Route::get('registro', function(){
    return view('registro');
});


