<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\PersonaMoralModel;
use App\Http\Models\VariablesPersona;
use App\Http\Models\VariablesPersonaMoral;
use App\Http\Models\aparicionesModel;
use DB;
use RFC\RfcBuilder;
use App\Http\Requests\PersonaMoralRequest;

class PersonaMoralController extends Controller{
	public function index(){
		return view("personaMoral");
	}
	
	public function rfcMoral(Request $request){
		$fecha = $request->fechaCreacion;
		$partes = explode("-",$fecha);
		$nombre = $request->nombre;
		$dia    = $partes[2];
		$mes    = $partes[1];
		$ano    = $request->ano;
		$builder = new RfcBuilder();
		$rfc = $builder->legalName($nombre)
			->creationDate($dia, $mes, $ano)
			->build()
			->toString();
		return ['res' => $rfc];
	}

	public function searchPersona(Request $request){
		$persona = $request->rfc;
		$personaExiste = DB::table('persona_moral')
		->join('variables_persona_moral', 'variables_persona_moral.idPersona', '=', 'persona_moral.id')
		->where('rfc',$persona)
		->select('persona_moral.id as id','persona_moral.nombre','persona_moral.fechaCreacion','persona_moral.rfc',
		'variables_persona_moral.telefono','variables_persona_moral.representanteLegal',
		'variables_persona_moral.id as idVar')
		->orderBy('variables_persona_moral.id','desc')
		->first();
		if($personaExiste){
			$data = array(
				'nombre'=>$personaExiste->nombre,
				'fechaCreacion'=>$personaExiste->fechaCreacion,
				'rfc'=>$personaExiste->rfc,
				'idMoral'=>$personaExiste->id,
				'telefono'=>$personaExiste->telefono,
				'representanteLegal'=>$personaExiste->representanteLegal,
				'idPersona'=>$personaExiste->id,
				'idVarPersona'=>$personaExiste->idVar,
			);
		}else{
			$data = array(
			);
		}
		return response()->json($data);
	}

	// public function getDomiciliosPersona(Request $request){
	// 	$data=array();
	// 	$rfc = $request->rfc;

	// 	$data['rfc'] = $rfc;

	// 	$domicilio = DB::table('variables_persona_moral as var')
	// 	->join('persona_moral as per', 'per.id','=','var.idPersona')
	// 	->join('domicilio as dom', 'dom.id','=','var.idDomicilio')
	// 	->where('rfc',$rfc)
	// 	->select(
	// 		'dom.id as id','idEstado','idMunicipio','idLocalidad','calle','numExterno','numInterno'
	// 	)->first();

    //     if($domicilio){
	// 		$dom = array(
	// 			'id'=>$domicilio->id,
	// 			'idEstado'=>$domicilio->idEstado,
	// 			'idMunicipio'=>$domicilio->idMunicipio,
	// 			'idLocalidad'=>$domicilio->idLocalidad,
	// 			'calle'=>$domicilio->calle,
	// 			'numExterno'=>$domicilio->numExterno,
	// 			'numInterno'=>$domicilio->numInterno
	// 		);
	// 		$data['domicilio'] = $dom;
	// 	}

	// 	$notificacion = DB::table('variables_persona_moral as var')
	// 	->join('persona_moral as per', 'per.id','=','var.idPersona')
	// 	->join('notificacion as noti', 'noti.id','=','var.idNotificacion')
	// 	->join('domicilio as dom', 'dom.id','=','noti.idDomicilio')		
	// 	->where('rfc',$rfc)
	// 	->select(
	// 		'noti.id as idNotificacion','correo','noti.telefono','noti.idDomicilio','idEstado','idMunicipio','idLocalidad','calle','numExterno','numInterno'
	// 	)->first();

	// 	if($notificacion){
	// 		$dom = array(
	// 			'idNotificacion'=>$notificacion->idNotificacion,
	// 			'correo'=>$notificacion->correo,
	// 			'telefono'=>$notificacion->telefono,
	// 			'idDomicilio'=>$notificacion->idDomicilio,
	// 			'idEstado'=>$notificacion->idEstado,
	// 			'idMunicipio'=>$notificacion->idMunicipio,
	// 			'idLocalidad'=>$notificacion->idLocalidad,
	// 			'calle'=>$notificacion->calle,
	// 			'numExterno'=>$notificacion->numExterno,
	// 			'numInterno'=>$notificacion->numInterno
	// 		);
	// 		$data['notificacion'] = $dom;
	// 	}
		
	// 	return response()->json($data);
	// }

}