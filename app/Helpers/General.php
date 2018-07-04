<?php
use App\Http\Models\Bitacora;
use App\Http\Models\AparicionesModel;

function saveInLog(String $sistema,$usuario,$tabla,$operacion,$idAfectado,$antes,$despues){
	try{
		$bitacora = new Bitacora();
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
	return $bitacora;
}

function saveInApariciones(String $sistema,$idCarpeta,$idPersona,$tipo,$nuc,$empresa){
	try{
		$apariciones = new aparicionesModel();
		$apariciones->idVarPersona = $idPersona;
		$apariciones->idCarpeta = $idCarpeta;
		$apariciones->sistema = $sistema;
		$apariciones->tipoInvolucrado = $tipo;
		$apariciones->nuc = $nuc;
		$apariciones->esEmpresa = $empresa;
		$apariciones->save(); 
	}
	catch (Exception $e){
		throw new Exception($e);
	}
	return $apariciones;
}