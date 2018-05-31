<?php
use Illuminate\Http\Request;

/*URLS PARA PERSONAS */
Route::get('/','PersonaController@index');
//Route::post('addPersona','PersonaController@addPersona')->name('addPersona');

/*URLS PARA DOMICILIOS*/
Route::get('/domicilio','DomicilioController@index');
Route::post('addDomicilio','DomicilioController@addDomicilio')->name('addDomicilio');

/*URLS PARA EMPRESAS*/
Route::get('/personaMoral','PersonaMoralController@index');
Route::post('addPersonaMoral','PersonaMoralController@addPersonaMoral')->name('addPersonaMoral');

/*URLS PARA SELECTS PERSONAS */
Route::post('addDatosTelefono','PersonaController@addDatosTelefono')->name('addDatosTelefono');;

Route::get('getDatosPersonaTelefono','PersonaController@getdctt');
Route::get('getDatosPersonaRed','PersonaController@getdctr');
Route::get('getDatosPersonaCorreo','PersonaController@getdctc');
Route::get('getDatosContacto','PersonaController@getdc');

Route::get('getNacionalidades','PersonaController@getNacionalidades');
Route::get('getMunicipios/{id}','PersonaController@getMunicipios');
Route::get('getEtnias','PersonaController@getEtnias');
Route::get('getLenguas','PersonaController@getLenguas');
Route::get('getEstados','PersonaController@getEstados');
Route::get('getSexos','PersonaController@getSexos');
Route::get('getOcupaciones','PersonaController@getOcupaciones');
Route::get('getEstadosCiviles','PersonaController@getEstadosCiviles');
Route::get('getEscolaridades','PersonaController@getEscolaridades');
Route::get('getReligiones','PersonaController@getReligiones');
Route::get('getIdentificaciones','PersonaController@getIdentificaciones');
Route::get('getInterpretes','PersonaController@getInterpretes');
Route::post('searchPersonaFisica','PersonaController@searchPersona');
Route::post('searchPersonaMoral','PersonaMoralController@searchPersona');
Route::post('getValidaciones','PersonaController@getValidaciones');
Route::post('rfcFisico','PersonaController@rfcFisico');
Route::post('rfcMoral','PersonaMoralController@rfcMoral');

/*URLS PARA SELECTS DOMICILIO */
Route::get('getEstados2','DomicilioController@getEstados');
Route::get('getMunicipios2/{id}','DomicilioController@getMunicipios');
Route::get('getLocalidades2/{id}','DomicilioController@getLocalidades');
Route::get('getColonias2/{id}','DomicilioController@getColonias');
Route::get('getCodigosPostales2/{id}','DomicilioController@getCodigosPostales');


Route::get('dt', function () {
    return view('DT');
});

Route::get('datoscontactos', function(){
    return view('DatosContactos');
});