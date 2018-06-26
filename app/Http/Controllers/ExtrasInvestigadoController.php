<?php

namespace App\Http\Controllers;

use App\Http\Models\CatPuesto;
use Illuminate\Http\Request;
use App\Http\Models\ExtraDenunciadoFisico;
use App\Http\Models\ExtraDenunciadoMoral;


class ExtrasInvestigadoController extends Controller
{
    public function indexFisico(){
        return view("extrasInvestigadoFisico");
    }

    public function indexMoral(){
        return view("extrasInvestigadoMoral");
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
    public function storeFisico(Request $request)
    {        
        $extraDenunciado = new ExtraDenunciadoFisico();
        $extraDenunciado->idVariablesPersona = $request->idVariablesPersona;
        $extraDenunciado->idPuesto = $request->idPuesto;
        $extraDenunciado->alias = $request->alias;
        $extraDenunciado->senasPartic = $request->senasPartic;
        $extraDenunciado->ingreso = $request->ingreso;
        $extraDenunciado->periodoIngreso = $request->periodoIngreso;
        $extraDenunciado->residenciaAnterior = $request->residenciaAnterior;
        $extraDenunciado->personasBajoSuGuarda = $request->personasBajoSuGuarda;
        $extraDenunciado->perseguidoPenalmente = $request->perseguidoPenalmente;
        $extraDenunciado->vestimenta = $request->vestimenta;
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
    public function updateFisico(Request $request)
    {        
        $extraDenunciado = ExtraDenunciadoFisico::find($request->id);
        $extraDenunciado->idPuesto = $request->idPuesto;
        $extraDenunciado->alias = $request->alias;
        $extraDenunciado->senasPartic = $request->senasPartic;
        $extraDenunciado->ingreso = $request->ingreso;
        $extraDenunciado->periodoIngreso = $request->periodoIngreso;
        $extraDenunciado->residenciaAnterior = $request->residenciaAnterior;
        $extraDenunciado->personasBajoSuGuarda = $request->personasBajoSuGuarda;
        $extraDenunciado->perseguidoPenalmente = $request->perseguidoPenalmente;
        $extraDenunciado->vestimenta = $request->vestimenta;
        $extraDenunciado->save();  
        $id = $extraDenunciado->id;                
        return response()->json($id);
    }

    public function storeMoral(Request $request)
    {        
        $extraDenunciado = new ExtraDenunciadoMoral();
        $extraDenunciado->idVariablesPersona = $request->idVariablesPersona;
        $extraDenunciado->idPuesto = $request->idPuesto;
        $extraDenunciado->alias = $request->alias;
        $extraDenunciado->senasPartic = $request->senasPartic;
        $extraDenunciado->ingreso = $request->ingreso;
        $extraDenunciado->periodoIngreso = $request->periodoIngreso;
        $extraDenunciado->residenciaAnterior = $request->residenciaAnterior;
        $extraDenunciado->personasBajoSuGuarda = $request->personasBajoSuGuarda;
        $extraDenunciado->perseguidoPenalmente = $request->perseguidoPenalmente;
        $extraDenunciado->vestimenta = $request->vestimenta;
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
    public function updateMoral(Request $request)
    {        
        $extraDenunciado = ExtraDenunciadoMoral::find($request->id);
        $extraDenunciado->idPuesto = $request->idPuesto;
        $extraDenunciado->alias = $request->alias;
        $extraDenunciado->senasPartic = $request->senasPartic;
        $extraDenunciado->ingreso = $request->ingreso;
        $extraDenunciado->periodoIngreso = $request->periodoIngreso;
        $extraDenunciado->residenciaAnterior = $request->residenciaAnterior;
        $extraDenunciado->personasBajoSuGuarda = $request->personasBajoSuGuarda;
        $extraDenunciado->perseguidoPenalmente = $request->perseguidoPenalmente;
        $extraDenunciado->vestimenta = $request->vestimenta;
        $extraDenunciado->save();  
        $id = $extraDenunciado->id;                
        return response()->json($id);
    }
}
