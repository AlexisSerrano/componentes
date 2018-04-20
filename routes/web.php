<?php
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('prueba');
});

Route::post('persona','PersonaController@guardarPersona');

Route::post('personamini','PersonaController@_guardar');

Route::post('listasexos','ListasController@sexos');

Route::post('listanoche','ListasController@nocturnos');
//////////////////////////////////////////////////////
Route::post('estados','DomicilioController@mostrarEstados');

Route::post('municipios','DomicilioController@mostrarMunicipios');

Route::post('localidades','DomicilioController@mostrarLocalidades');

Route::post('cpostal','DomicilioController@mostrarCodigoPostal');

Route::post('colonias','DomicilioController@mostrarColonias');

Route::post('domicilio','DomicilioController@guardarDomicilio');

Route::post('sexos','PersonaController@sexos');

Route::post('nacionalidad','PersonaController@nacionalidad');

Route::post('etnias','PersonaController@etnias');

Route::post('lenguas','PersonaController@lenguas');

Route::post('listaMunicipios','PersonaController@municipios');

Route::post('ocupacion','PersonaController@ocupacion');

Route::post('estadoCivil','PersonaController@estadoCivil');

Route::post('escolaridad','PersonaController@escolaridad');

Route::post('religiones','PersonaController@religiones');