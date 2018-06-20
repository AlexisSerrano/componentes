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
Route::get('/extrasInvestigado','ExtrasInvestigadoController@index');
Route::get('/extrasAbogado','ExtrasAbogadoController@index');
Route::get('/extrasDenunciante','ExtrasDenuncianteController@index');
Route::get('/extrasAutoridad','ExtrasAutoridadController@index');

Route::get('dt', function () {
    return view('DT');
});

Route::get('datoscontactos', function(){
    return view('DatosContactos');
});

Route::get('resumen', function(){
    return view('resumen');
});

Route::get('registroDenunciante', function(){
    return view('registroDenunciante');
});

Route::get('registroAbogado', function(){
    return view('registroAbogado');
});

Route::get('registroAutoridad', function(){
    return view('registroAutoridad');
});

Route::get('registroDenunciado', function(){
    return view('registroDenunciado');
});

/*PRUEBAS */
Route::get('prueba', function(){
    return view('pruebas');
});


