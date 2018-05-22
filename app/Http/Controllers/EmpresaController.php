<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\EmpresaModel;
use App\Http\Models\VariablesPersona;
use DB;
use RFC\RfcBuilder;

class EmpresaController extends Controller{
	public function index(){
		return view("empresa");
	}
 
	public function addEmpresa(Request $request){
		DB::beginTransaction();
		try{
			$empresa=new EmpresaModel();
			$empresa->nombre=$request->input('nombre');		
			$empresa->fechaCreacion=$request->input('fechaConstitucion');
			$empresa->rfc=$request->input('rfc');
			$empresa->save();
			$idEmpresa = $empresa->id;
			$variablesEmpresa=new VariablesPersona();
			$variablesEmpresa->idPersona = $idEmpresa;
			$variablesEmpresa->telefono=$request->input('telefono');
			$variablesEmpresa->representanteLegal=$request->input('representanteLegal');
			$variablesEmpresa->esEmpresa=$request->input('esEmpresa');
			$variablesEmpresa->save();
			DB::commit();
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
        $personaExiste=EmpresaModel::orderBy('rfc', 'ASC')
		->where('rfc',$persona)
		->select('nombre','fechaCreacion','rfc','id')->first();
		$personaExiste2=VariablesPersona::orderBy('id','DESC')
		->where('idPersona',$personaExiste->id)
		->select('telefono','representanteLegal','esEmpresa')->first();
		$data = array(
			'nombre'=>$personaExiste->nombre,
			'fechaCreacion'=>$personaExiste->fechaCreacion,
			'rfc'=>$personaExiste->rfc,
			'id'=>$personaExiste->id,
			'telefono'=>$personaExiste2->telefono,
			'representanteLegal'=>$personaExiste2->representanteLegal,
			'esEmpresa'=>$personaExiste2->esEmpresa);
		return response()->json($data);
	}
}