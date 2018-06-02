<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\DB;

class DatosContacto extends Controller
{
    //
    public function adddc(Request $request){
        return response()->json(DB::table('datos_contacto')->insertGetId(
            ['idPersona'=>$request->input('idPersona'),
            'iddatostipo'=>$request->input('tipo'),
            'valor'=>$request->input('valor'),
            'habilitado'=>true]
        ));
    }
    public function getdct(){
        $vdct=DB::table('datos_contacto')->orderBy('valor','ASC')
        ->whereIn('iddatostipo',[4,5,6,7])
        ->select('iddatostipo','valor')->get();
        return response()->json($vdct);
    }
    public function getdcc(){
        $vdcc=DB::table('datos_contacto')->orderBy('valor','ASC')
        ->whereIn('iddatostipo',[8,9])
        ->select('iddatostipo','valor')->get();
        return response()->json($vdcc);
    }
    public function getdcr(){
        $vdcr=DB::table('datos_contacto')->orderBy('valor','ASC')
        ->whereIn('iddatostipo',[1,2,3])
        ->select('iddatostipo','valor')->get();
        return response()->json($vdcr);
    }
    public function getdctt(){
        $telefonos=DB::table('datos_contacto_tipos_telefono')->orderBy('tipo', 'ASC')
	    ->select('tipo','id')->get();
        return response()->json($telefonos);
	}
	public function getdctr(){
        $redes=DB::table('datos_contacto_tipos_red')->orderBy('tipo', 'ASC')
	    ->select('tipo','id')->get();
        return response()->json($redes);
	}
	public function getdctc(){
        $correos=DB::table('datos_contacto_tipos_correo')->orderBy('tipo', 'ASC')
	    ->select('tipo','id')->get();
        return response()->json($correos);
    }
}
