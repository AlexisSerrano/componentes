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

/*Domicilios*/
Route::post('addDomicilio','DomicilioController@addDomicilio')->name('addDomicilio');

/*Persona fisica*/
Route::post('rfcFisico','PersonaController@rfcFisico');
Route::post('searchPersonaFisica','PersonaController@searchPersona');
Route::post('searchConocido','PersonaController@searchConocido');
Route::get('getMunicipios/{id}','PersonaController@getMunicipios');
Route::post('getCatalogos','PersonaController@getCatalogos');
Route::post('getDomiciliosPersona','PersonaController@getDomiciliosPersona');

/*Persona moral*/
Route::post('addPersonaMoral','PersonaMoralController@addPersonaMoral')->name('addPersonaMoral');
Route::post('searchPersonaMoral','PersonaMoralController@searchPersona');
Route::post('rfcMoral','PersonaMoralController@rfcMoral');
Route::post('getDomiciliosPersona','PersonaController@getDomiciliosPersona');

/* Validaciones back personas en uat*/
Route::post('abogadouat','ValidacionController@valAbogadoUAT');
Route::post('autoridaduat','ValidacionController@valAutoridadUAT');
Route::post('conocidouat','ValidacionController@valConocidoFUAT');
Route::post('conocidomoraluat','ValidacionController@valConocidoMUAT');
Route::post('denunciadouat','ValidacionController@valDenunciadoFUAT');
Route::post('denunciadomoraluat','ValidacionController@valDenunciadoMUAT');
Route::post('denuncianteuat','ValidacionController@valDenuncianteFUAT');
Route::post('denunciantemoraluat','ValidacionController@valDenuncianteMUAT');
Route::post('qrruat','ValidacionController@valQrrUAT');
Route::post('actashechosuat','ValidacionController@valActasHechosFUAT');
Route::post('actashechosmoraluat','ValidacionController@valActasHechosMUAT');

/*API UAT*/
Route::post('getDenunciantesCarpetaUAT','ApiControllerUAT@getDenunciantesCarpeta');
Route::post('getInvestigadosCarpetaUAT','ApiControllerUAT@getInvestigadosCarpeta'); 
Route::post('getTestigosCarpetaUAT','ApiControllerUAT@getTestigosCarpeta');
Route::post('getAutoridadesCarpetaUAT','ApiControllerUAT@getAutoridadesCarpeta');
Route::post('getAbogadosCarpetaUAT','ApiControllerUAT@getAbogadosCarpeta');
/*ejemplo de peticion
{
  "api_token": "w37JtBFJQLbu4ADSsoMHphddWAPneAcwZyZmXpauaAHGHNMvPTvluyQOWnBl",
  "idCarpeta": 1
}
*/

Route::post('getPuestos','ExtrasInvestigadoController@getPuestos');

/*Buscar en carpetas en la que está involucrada una persona*/
Route::post('/fisicaCarpetasRfc','PersonaController@fisicaBuscarCarpetas');
//Route::post('/fisicaCarpetasCurp','PersonaController@personaFisicaBuscarCarpetasCURP');
Route::post('/moralCarpetasRfc','PersonaController@moralBuscarCarpetas');
Route::post('/cambiarEstadoCarpeta','PersonaController@cambiarEstadoCarpeta');


/*rutas de extras*/
Route::post('addExtrasDenunciante','ExtrasDenuncianteController@addExtrasDenunciante');
Route::post('addExtrasDenunciado','ExtrasInvestigadoController@addExtrasDenunciado');
Route::post('addExtrasAbogado','ExtrasAbogadoController@addExtrasAbogado');
Route::post('addExtrasAutoridad','ExtrasAutoridadController@addExtrasAutoridad');
Route::post('addExtrasActasHechos','ExtrasActasHechosController@addExtrasActasHechos');
Route::post('addExtrasConocido','ExtrasInvestigadoController@addExtrasConocido');
/*Rutas para el componente  familiar*/
Route::post('getInvolucrados','FamiliarController@getInvolucrados');
Route::post('saveFamiliar','FamiliarController@saveFamiliar');

/*URLS PARA SELECTS DOMICILIO */
Route::get('getEstados','DomicilioController@getEstados');
Route::get('getMunicipios/{id}','DomicilioController@getMunicipios');
Route::get('getLocalidades/{id}','DomicilioController@getLocalidades');
Route::get('getColonias/{id}','DomicilioController@getColonias');
Route::get('getCodigosPostales/{id}','DomicilioController@getCodigosPostales');
Route::get('getIdentificaciones','PersonaController@getIdentificaciones');