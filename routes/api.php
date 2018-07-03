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
Route::post('getDomiciliosPersona','PersonaController@getDomiciliosPersona');

/*Persona moral*/
Route::post('addPersonaMoral','PersonaMoralController@addPersonaMoral')->name('addPersonaMoral');
Route::post('searchPersonaMoral','PersonaMoralController@searchPersona');
Route::post('rfcMoral','PersonaMoralController@rfcMoral');
Route::post('getDomiciliosPersona','PersonaController@getDomiciliosPersona');

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
// Route::post('/guardarExtrasInvestigadoFisico','ExtrasInvestigadoController@storeFisico');
// Route::post('/guardarExtrasInvestigadoMoral','ExtrasInvestigadoController@storeMoral');
// Route::post('/guardarExtrasAbogado','ExtrasAbogadoController@store');
// Route::post('/guardarExtrasAutoridad','ExtrasAutoridadController@store');
// Route::post('/guardarExtrasDenuncianteFisico','ExtrasDenuncianteController@storeExtraDenuncianteFisico');
// Route::post('/guardarExtrasDenuncianteMoral','ExtrasDenuncianteController@storeExtraDenuncianteMoral');
/* Update de extras */
// Route::post('/updateExtrasDenuncianteFisico','ExtrasDenuncianteController@updateExtrasDenuncianteFisico');
// Route::post('/updateExtrasDenuncianteMoral','ExtrasDenuncianteController@updateExtrasDenuncianteMoral');
// Route::post('/actualizarExtrasInvestigadoFisico','ExtrasInvestigadoController@updateFisico');
// Route::post('/actualizarExtrasInvestigadoMoral','ExtrasInvestigadoController@updateMoral');
// Route::post('/actualizarExtrasAbogado','ExtrasAbogadoController@update');
// Route::post('/updateExtrasAutoridad','ExtrasAutoridadController@update');



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