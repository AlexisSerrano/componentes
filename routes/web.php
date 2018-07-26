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

Route::get('registroAutoridadEdit', function(){
    return view('registroAutoridadEdit');
});

Route::get('registroActasHechos', function(){
    return view('registroActasHechos');
});

Route::get('registroActasCircunstanciadas', function(){
    return view('registroActasCircunstanciadas');
});


// ::::::::::::::::::REDIRECCIONES::::::::::::::.:::
Route::get('denunciante', function(){
    return redirect('http://localhost/componentes/public/registroDenunciante');
});

Route::get('denunciado', function(){
    return redirect('http://localhost/componentes/public/registroDenunciado');
});

Route::get('abogado', function(){
    return redirect('http://localhost/componentes/public/registroAbogado');
});

Route::get('autoridad', function(){
    return redirect('http://localhost/componentes/public/registroAutoridad');
});

Route::get('actasHechos', function(){
    return redirect('http://localhost/componentes/public/registroActasHechos');
});

Route::get('actasCircunstanciadas', function(){
    return redirect('http://localhost/componentes/public/registroActasCircunstanciadas');
});

Route::get('autoridadEdit', function(){
    return redirect('http://localhost/componentes/public/registroAutoridadEdit');
});
// ::::::::::::::::::REDIRECCIONES::::::::::::::.:::
