<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\EmpresaModel;
// use App\Http\Models\VariablesPersona;

class EmpresaController extends Controller{
	public function index(){
		return view("empresa");
	}
 
	public function addEmpresa(Request $request){
		$empresa=new EmpresaModel();
		$empresa->nombre=$request->input('nombre');		
		$empresa->fechaCreacion=$request->input('fechaConstitucion');
		$empresa->rfc=$request->input('rfc');
		$empresa->save();
		$variablesEmpresa=new VariablesPersona();
		$variablesEmpresa->telefono=$request->input('telefono');
		$variablesEmpresa->representanteLegal=$request->input('representanteLegal');
		$variablesEmpresa->save();
		return $empresa;
	}
}