<?php
use Illuminate\Http\Request;

/*URLS PARA PERSONAS */
Route::get('/','PersonaController@index');
//Route::post('addPersona','PersonaController@addPersona')->name('addPersona');

/*URLS PARA DOMICILIOS*/
Route::get('/domicilio','DomicilioController@index');
Route::post('addDomicilio','DomicilioController@addDomicilio')->name('addDomicilio');

/*URLS PARA DATOS LABORALES*/
Route::get('/datosLaborales','DatosLaboralesController@index');
Route::post('addDatosLaborales','DatosLaboralesController@addDatosLaborales')->name('addDatosLaborales');


/*URLS PARA EMPRESAS*/
Route::get('/personaMoral','PersonaMoralController@index');

/*URLS PARA SELECTS PERSONAS */
Route::get('getDatosPersonaTelefono','DatosContacto@getdctt');
Route::get('getDatosPersonaRed','DatosContacto@getdctr');
Route::get('getDatosPersonaCorreo','DatosContacto@getdctc');
Route::get('getDatosContactoTel/{idPersona}','DatosContacto@getdct');
Route::get('getDatosContactoCor/{idPersona}','DatosContacto@getdcc');
Route::get('getDatosContactoRed/{idPersona}','DatosContacto@getdcr');

Route::get('getNacionalidades','PersonaController@getNacionalidades');

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
Route::post('getValidaciones','PersonaController@getValidaciones');


/*URLS PARA SELECTS DOMICILIO */
Route::get('getEstados','DomicilioController@getEstados');
Route::get('getMunicipios/{id}','DomicilioController@getMunicipios');
Route::get('getLocalidades/{id}','DomicilioController@getLocalidades');
Route::get('getColonias/{id}','DomicilioController@getColonias');
Route::get('getCodigosPostales/{id}','DomicilioController@getCodigosPostales');


Route::get('dt', function () {
    return view('DT');
});

Route::get('datoscontactos', function(){
    return view('DatosContactos');
});

Route::get('resumen', function(){
    return view('resumen');
});

Route::get('registro', function(){
    return view('registro');
});

/*PRUEBAS */
Route::get('prueba', function(){
    return view('pruebas');
});


