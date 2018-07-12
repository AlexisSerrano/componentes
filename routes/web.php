<?php
use Illuminate\Http\Request;

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

Route::get('registroActasHechos', function(){
    return view('registroActasHechos');
});
