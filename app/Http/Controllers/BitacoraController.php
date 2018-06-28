<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Bitacora;

class BitacoraController extends Controller
{
    public function saveInLog(String $sistema,$usuario,$tabla,$operacion,$idAfectado,$antes,$despues){
        $bitacora = new Bitacora();
        try{
            $bitacora->sistema = $sistema;
            $bitacora->usuario = $usuario;
            $bitacora->tabla = $tabla;
            $bitacora->operacion = $operacion;
            $bitacora->id_afectado = $idAfectado;
            $bitacora->antes = $antes;
            $bitacora->despues = $despues;
            $bitacora->save();
        }catch (Exception $e){
            throw new Exception($e);
        }
        return $bitacora->id;
    }
}
