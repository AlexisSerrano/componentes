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
		'variables_persona_moral.telefono',
		'variables_persona_moral.nombreRep',
		'variables_persona_moral.primerApRep',
		'variables_persona_moral.segundoApRep',
		'variables_persona_moral.docIdentificacion',
		'variables_persona_moral.numDocIdentificacion',
		'variables_persona_moral.id as idVar',
		'variables_persona_moral.idDomicilio','variables_persona_moral.idNotificacion')
		->orderBy('variables_persona_moral.id','desc')
		->first();
		if($personaExiste){
			$data = array(
				'nombre'=>$personaExiste->nombre,
				'fechaCreacion'=>$personaExiste->fechaCreacion,
				'rfc'=>$personaExiste->rfc,
				'idMoral'=>$personaExiste->id,
				'telefono'=>$personaExiste->telefono,
				'nombreRep'=>$personaExiste->nombreRep,
				'primerApRep'=>$personaExiste->primerApRep,
				'segundoApRep'=>$personaExiste->segundoApRep,
				'docIdentificacion'=>$personaExiste->docIdentificacion,
				'numDocIdentificacion'=>$personaExiste->numDocIdentificacion,
				'idPersona'=>$personaExiste->id,
				'idVarPersona'=>$personaExiste->idVar,
				'idDomicilio'=>$personaExiste->idDomicilio,
				'idDomicilioNotificacion'=>$personaExiste->idNotificacion
			);
		}else{
			$data = array(
			);
		}
		return response()->json($data);
	}
}