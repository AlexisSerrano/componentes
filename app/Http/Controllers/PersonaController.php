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
use App\Http\Models\CatOcupacion;
use App\Http\Models\CatEstadoCivil;
use App\Http\Models\CatEscolaridad;
use App\Http\Models\CatReligion;
use App\Http\Models\CatIdentificacion;
use RFC\RfcBuilder;

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

	public function searchPersona(Request $request){
		$persona = $request->rfc;
        $personaExiste=PersonaModel::orderBy('rfc', 'ASC')
		->where('rfc',$persona)
		->orwhere('curp',$persona)
		->select('nombres','primerAp','segundoAp','id')->get();
		return response()->json($personaExiste);
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
    public function getSexos(){
        $sexos=SexoModel::orderBy('nombre', 'ASC')
	    ->select('nombre','id')->get();
        return response()->json($sexos);
	}
    public function getOcupaciones(){
        $ocupaciones=CatOcupacion::orderBy('nombre', 'ASC')
	    ->select('nombre','id')->get();
        return response()->json($ocupaciones);
	}
    public function getEstadosCiviles(){
        $estadosCiviles=CatEstadoCivil::orderBy('nombre', 'ASC')
	    ->select('nombre','id')->get();
        return response()->json($estadosCiviles);
	}
    public function getEscolaridades(){
        $escolaridades=CatEscolaridad::orderBy('nombre', 'ASC')
	    ->select('nombre','id')->get();
        return response()->json($escolaridades);
	}
    public function getReligiones(){
        $religiones=CatReligion::orderBy('nombre', 'ASC')
	    ->select('nombre','id')->get();
        return response()->json($religiones);
	}
	public function getIdentificaciones(){
        $identificaciones=CatIdentificacion::orderBy('documento', 'ASC')
	    ->select('documento','id')->get();
        return response()->json($identificaciones);
	}
	// url:"/api/getValidaciones",method:"POST",id1:"idsistema",id2:"idinvolucrado",id3:"idcomponente"
	public function getValidaciones(Request $request){
		return HelpController::GetJSONDBValidation($request->input('id1'),$request->input('id2'),$request->input('id3'));
	}
	/* GET METHOD
	public function getValidaciones($id1,$id2,$id3){
		return HelpController::GetJSONDBValidation($id1,$id2,$id3);
	}*/
	public function rfcMoral(Request $request){
		$nombre = $request->nombre;
		$dia    = $request->dia;
		$mes    = $request->mes;
		$ano    = $request->ano;
		$builder = new RfcBuilder();
		$rfc = $builder->legalName($nombre)
			->creationDate($dia, $mes, $ano)
			->build()
			->toString();
		return ['res' => $rfc];
	}
	public function rfcFisico(Request $request){
		$fecha = $request->fechaNacimiento;
		$partes = explode("-",$fecha);
		$builder = new RfcBuilder();
		$rfc     = $builder->name($request->nombres)
			->firstLastName($request->primerAp)
			->secondLastName($request->segundoAp)
			->birthday($partes[2], $partes[1], $partes[0])
			// ->birthday(3, 9, 1984)
			->build()
			->toString();
		return ['res' => $rfc];
	}
}