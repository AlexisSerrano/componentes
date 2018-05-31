<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\DB;

class DatosContacto extends Controller
{
    //
    public function adddc(Request $request){
        return DB::table('datos_contacto')->insert([
            ['idPersona'=>$request->input('idPersona'),
            'iddatostipo'=>$request->input('tipo'),
            'valor'=>$request->input('valor'),
            'habilitado'=>true]
        ]);
    }
    public function getdctt(){
        $telefonos=DB::table('datos_contacto_tipos_telefono')->orderBy('id', 'ASC')
	    ->select('tipo','id')->get();
        return response()->json($telefonos);
	}
	public function getdctr(){
        $redes=DB::table('datos_contacto_tipos_red')->orderBy('id', 'ASC')
	    ->select('tipo','id')->get();
        return response()->json($redes);
	}
	public function getdctc(){
        $correos=DB::table('datos_contacto_tipos_correo')->orderBy('id', 'ASC')
	    ->select('tipo','id')->get();
        return response()->json($correos);
    }
    public function getdc(){
        $vdc=DB::table('datos_contacto')->orderBy('iddatostipo','ASC')
        ->select('iddatostipo','valor')->get();
        return response()->json($vdc);
    }
    
}
