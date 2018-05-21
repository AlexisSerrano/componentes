<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\EmpresaModel;
use App\Http\Models\VariablesPersona;
use DB;

class EmpresaController extends Controller{
	public function index(){
		return view("empresa");
	}
 
	public function addEmpresa(Request $request){
		// DB::beginTransaction();
		// try{
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
			$variablesEmpresa->save();
		// 	DB::commit();
		// }
		// catch (\PDOException $e){
		// 	DB::rollBack();
		// 	throw $e;
        //     return back()->withInput();
		// }
	}
}