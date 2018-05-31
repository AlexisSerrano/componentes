<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        DB::table('datos_contacto_tipos_telefono')->orderBy('tipo', 'ASC')
	    ->select('tipo','id')->get();
        return response()->json($interpretes);
	}
	public function getdctr(){
        DB::table('datos_contacto_tipos_red')->orderBy('tipo', 'ASC')
	    ->select('tipo','id')->get();
        return response()->json($interpretes);
	}
	public function getdctc(){
        DB::table('datos_contacto_tipos_correo')->orderBy('tipo', 'ASC')
	    ->select('tipo','id')->get();
        return response()->json($interpretes);
    }
    
}
