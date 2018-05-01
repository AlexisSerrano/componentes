<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\SexoModel;
use App\Http\Models\PersonaModel;
use App\Http\Models\NacionalidadesModel;
use App\Http\Models\EtniaModel;
use App\Http\Models\LenguasModel;
use App\Http\Models\CatMunicipio;
use App\Http\Models\CatEstado;

class PersonaController extends Controller{
	public function index(){
		$nacionalidades=NacionalidadesModel::orderBy('nombre', 'ASC')
		->select('nombre','id')->get();
		$municipios=catMunicipio::orderBy('nombre','ASC')
		->select('nombre','id')->get();
		$etnias=EtniaModel::orderBy('nombre','ASC')
		->select('nombre','id')->get();
		$lenguas=LenguasModel::orderBy('nombre','ASC')
		->select('nombre','id')->get();
		$estados=CatEstado::orderBy('nombre','ASC')
		->select('nombre','id')->get();
		return view("persona",compact("nacionalidades","municipios","etnias","lenguas","estados"));
	}
 
	public function addPersona(Request $request){
		$persona=new PersonaModel();		
		$persona->nombres=$request->input('nombres');		
		$persona->primerAp=$request->input('primerAp');
		$persona->segundoAp=$request->input('segundoAp');
		$persona->fechaNacimiento=$request->input('fechaNacimiento');
		$persona->rfc=$request->input('rfc');
		$persona->curp=$request->input('curp');
		$persona->sexo=$request->input('sexo');
		$persona->idNacionalidad=$request->input('nacionalidad');
		$persona->idEtnia=$request->input('etnia');
		$persona->idLengua=$request->input('lengua');
		$persona->idMunicipioOrigen=$request->input('municipio');
		$persona->esEmpresa=$request->input('esEmpresa');
		$persona->save();
		return $persona;
	}

    public function getNacionalidades(){
        $nacionalidades=NacionalidadesModel::orderBy('nombre', 'ASC')
	    ->select('nombre','id')->get();
        return response()->json($nacionalidades);
	}
	public function getEstados(){
        $estados=CatEstado::orderBy('nombre', 'ASC')
	    ->select('nombre','id')->get();
        return response()->json($estados);
    }
	public function getMunicipios($id){
		$municipios=CatMunicipio::orderBy('nombre','ASC')
		->where('idEstado',$id)
		->select('nombre','id')->get();
		return response()->json($municipios);
	}
    public function getEtnias(){
        $etnias=EtniaModel::orderBy('nombre', 'ASC')
	    ->select('nombre','id')->get();
        return response()->json($etnias);
    }
    public function getLenguas(){
        $lenguas=LenguasModel::orderBy('nombre', 'ASC')
	    ->select('nombre','id')->get();
        return response()->json($lenguas);
	}
	public function getPersonas(){
        $personas=PersonaModel::orderBy('nombres', 'ASC')
	    ->select('nombres','id','primerAp','segundoAp','fechaNacimiento','rfc','curp','sexo','idNacionalidad','idEtnia','idLengua','idMunicipioOrigen','esEmpresa')->get();
        return response()->json($personas);
    }
}