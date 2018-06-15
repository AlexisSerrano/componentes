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
// */
// Route::post('getValidaciones','GenericController@ValidacionDBJSON');
// Route::post('PersonaFisica','GenericController@ValidacionJSONDBPF');
// Route::post('SearchUndefined','GenericController@SearchUndefined');
// Route::post('SetConfirm','GenericController@SetConfirm');
// Route::post('SetConfirmMulti','GenericController@SetConfirmMulti');
// Route::post('SetConfirmCarpetaMulti','GenericController@SetConfirmCarpetaMulti');
// Route::post('adddc','DatosContacto@adddc');
// Route::post('deldc','DatosContacto@deldc');



/*Persona fisica*/
Route::post('getCatalogos','PersonaController@getCatalogos');
Route::post('rfcFisico','PersonaController@rfcFisico');
Route::post('searchPersonaFisica','PersonaController@searchPersona');
Route::get('getMunicipios/{id}','PersonaController@getMunicipios');

/*Persona fisica*/
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
//Route::post('getValidaciones','ValidacionController@getValidaciones');


/*API UAT*/
Route::post('getDenunciantesCarpeta','ApiControllerUAT@getDenunciantesCarpeta');
Route::post('getInvestigadosCarpeta','ApiControllerUAT@getInvestigadosCarpeta'); 
Route::post('getTestigosCarpeta','ApiControllerUAT@getTestigosCarpeta');
Route::post('getAutoridadesCarpeta','ApiControllerUAT@getAutoridadesCarpeta');
Route::post('getAbogadosCarpeta','ApiControllerUAT@getAbogadosCarpeta');
/*ejemplo de peticion
{
  "api_token": "w37JtBFJQLbu4ADSsoMHphddWAPneAcwZyZmXpauaAHGHNMvPTvluyQOWnBl",
  "idCarpeta": 1
}
*/
