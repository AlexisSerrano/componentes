<?php

namespace App\Http\Controllers;

use App\Http\Models\CatPuesto;
use Illuminate\Http\Request;
use App\Http\Models\ExtraDenunciado;


class ExtrasInvestigadoController extends Controller
{
    public function index(){
        return view("extrasInvestigado");
    }
    
    public function getPuestos(){
        $puestos=CatPuesto::orderBy('nombre', 'ASC')
	    ->select('nombre','id')->get();
        return response()->json($puestos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $extraDenunciado = new ExtraDenunciado();
        $extraDenunciado->idVariablesPersona = $request->idVariablesPersona;
        $extraDenunciado->idNotificacion = $request->idNotificacion;        
        $extraDenunciado->idPuesto = $request->idPuesto;
        $extraDenunciado->alias = $request->alias;
        $extraDenunciado->senasPartic = $request->senasPartic;
        $extraDenunciado->ingreso = $request->ingreso;
        $extraDenunciado->periodoIngreso = $request->periodoIngreso;
        $extraDenunciado->residenciaAnterior = $request->residenciaAnterior;
        $extraDenunciado->personasBajoSuGuarda = $request->personasBajoSuGuarda;
        $extraDenunciado->perseguidoPenalmente = $request->perseguidoPenalmente;
        $extraDenunciado->vestimenta = $request->vestimenta;
        $extraDenunciado->narracion = $request->narracion;
        $extraDenunciado->save();
        $id = $extraDenunciado->id;                
        return response()->json($id);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {        
        $extraDenunciado = ExtraDenunciado::find($request->id);
        $extraDenunciado->idNotificacion = $request->idNotificacion;        
        $extraDenunciado->idPuesto = $request->idPuesto;
        $extraDenunciado->alias = $request->alias;
        $extraDenunciado->senasPartic = $request->senasPartic;
        $extraDenunciado->ingreso = $request->ingreso;
        $extraDenunciado->periodoIngreso = $request->periodoIngreso;
        $extraDenunciado->residenciaAnterior = $request->residenciaAnterior;
        $extraDenunciado->personasBajoSuGuarda = $request->personasBajoSuGuarda;
        $extraDenunciado->perseguidoPenalmente = $request->perseguidoPenalmente;
        $extraDenunciado->vestimenta = $request->vestimenta;
        $extraDenunciado->narracion = $request->narracion;
        $extraDenunciado->save();  
        $id = $extraDenunciado->id;                
        return response()->json($id);
    }
}
