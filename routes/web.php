<?php
use Illuminate\Http\Request;

/*URLS PARA PERSONAS */
Route::get('/','PersonaController@index');

/*URLS PARA DOMICILIOS*/
Route::get('/domicilio','DomicilioController@index');
Route::post('addDomicilio','DomicilioController@addDomicilio')->name('addDomicilio');

/*URLS PARA EMPRESAS*/
Route::get('/personaMoral','PersonaMoralController@index');

/*URLS COMPONENTES EXTRA*/
Route::get('/extrasInvestigadoFisico','ExtrasInvestigadoController@indexFisico');
Route::get('/extrasInvestigadoMoral','ExtrasInvestigadoController@indexMoral');
Route::get('/extrasAbogado','ExtrasAbogadoController@index');
Route::get('/extrasDenunciante','ExtrasDenuncianteController@index');
Route::get('/extrasAutoridad','ExtrasAutoridadController@index');

Route::get('registroDenunciante', function(){
    return view('registroDenunciante');
});

Route::get('registroDenunciado', function(){
    return view('registroDenunciado');
});

Route::get('registroAbogado', function(){
    return view('registroAbogado');
});

Route::get('registroAutoridad', function(){
    return view('registroAutoridad');
});

Route::get('carpetasLigadas', function(){
    return view('carpetasLigadas');
});

Route::get('familiar', function(){
    return view('familiar');
});

Route::get('registroActasHechos', function(){
    return view('registroActasHechos');
});
