<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\ExtraAbogado;

class ExtrasAbogadoController extends Controller
{
    public function index(){
        return view("extrasAbogado");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $extraAbogado = new ExtraAbogado();
        $extraAbogado->idVariablesPersona = $request->idVariablesPersona;
        $extraAbogado->cedulaProf = $request->cedulaProf;        
        $extraAbogado->sector = $request->sector;
        $extraAbogado->correo = $request->correo;
        $extraAbogado->tipo = $request->tipo;
        $extraAbogado->save();  
        $id = $extraAbogado->id;                
        return response()->json($id);
        
    }
}
