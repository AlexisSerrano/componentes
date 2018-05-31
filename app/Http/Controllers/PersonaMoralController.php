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
 
	public function addPersonaMoral(PersonaMoralRequest $request){
		DB::beginTransaction();
		try{
			$moral=new PersonaMoralModel();
			$moral->nombre=$request->input('nombre');		
			$moral->fechaCreacion=$request->input('fechaConstitucion');
			$moral->rfc=$request->input('rfc');
			$moral->save();
			$idMoral = $moral->id;
			$variablesMoral=new VariablesPersonaMoral();
			$variablesMoral->idPersona = $idMoral;
			$variablesMoral->telefono=$request->input('telefono');
			$variablesMoral->representanteLegal=$request->input('representanteLegal');
			$variablesMoral->save();
			$idVariablesMoral= $variablesMoral->id;
			$apariciones = new aparicionesModel();
			$apariciones ->idvar_persona = $idVariablesMoral;
			$apariciones ->id_carpeta=0;
			$apariciones ->id_sistema=$request->input('sistema');
			$apariciones ->esEmpresa=true;
			$apariciones ->nuc=0;
			$apariciones->save();
			DB::commit();
			$ids = array(
				'idPersonaMoral'=>$idMoral,
				'idVariablesPersonaMoral'=>$variablesMoral->id,
				'idAparicion'=>$apariciones->id
			);
			return response()->json($ids);
		}
		catch (\PDOException $e){
			DB::rollBack();
			throw $e;
            return back()->withInput();
		}
	}
	
	public function rfcMoral(Request $request){
		$fecha = $request->fechaConstitucion;
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
        $personaExiste=PersonaMoralModel::orderBy('rfc', 'ASC')
		->where('rfc',$persona)
		->select('nombre','fechaCreacion','rfc','id')->first();
		if($personaExiste){
			$personaExiste2=VariablesPersonaMoral::orderBy('id','DESC')
			->where('idPersona',$personaExiste->id)
			->select('telefono','representanteLegal','id')->first();
			$ids=array(
				'idEmpresa'=>$personaExiste->id,
				'idVariablesPersona'=>$personaExiste2->id
			);
			$data = array(
				'nombre'=>$personaExiste->nombre,
				'fechaCreacion'=>$personaExiste->fechaCreacion,
				'rfc'=>$personaExiste->rfc,
				'id'=>$personaExiste->id,
				'telefono'=>$personaExiste2->telefono,
				'representanteLegal'=>$personaExiste2->representanteLegal,
				'ids'=>$ids
			);
		}else{
			$data = array(
			);
		}
		return response()->json($data);
	}
}