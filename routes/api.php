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

/*Persona fisica*/
Route::post('rfcFisico','PersonaController@rfcFisico');
Route::post('searchPersonaFisica','PersonaController@searchPersona');
Route::get('getMunicipios/{id}','PersonaController@getMunicipios');
Route::post('getCatalogos','PersonaController@getCatalogos');

/*Persona moral*/
Route::post('addPersonaMoral','PersonaMoralController@addPersonaMoral')->name('addPersonaMoral');
Route::post('searchPersonaMoral','PersonaMoralController@searchPersona');
Route::post('rfcMoral','PersonaMoralController@rfcMoral');

/* Validaciones back personas en uat*/
Route::post('abogadouat','ValidacionController@valAbogadoUAT');
Route::post('autoridaduat','ValidacionController@valAutoridadUAT');
Route::post('conocidouat','ValidacionController@valConocidoUAT');
Route::post('denunciadouat','ValidacionController@valDenunciadoFUAT');
Route::post('denunciadomoraluat','ValidacionController@valDenunciadoMUAT');
Route::post('denuncianteuat','ValidacionController@valDenuncianteFUAT');
Route::post('denunciantemoraluat','ValidacionController@valDenuncianteMUAT');

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


/* Guardado de extras */
Route::post('/guardarExtrasDenunciante','ExtrasDenuncianteController@store');
Route::post('/guardarExtrasInvestigado','ExtrasInvestigadoController@store');
Route::post('/guardarExtrasAbogado','ExtrasAbogadoController@store');
Route::post('/guardarExtrasAutoridad','ExtrasAutoridadController@store');
/* Update de extras */
Route::post('/updateExtrasDenunciante','ExtrasDenuncianteController@update');
