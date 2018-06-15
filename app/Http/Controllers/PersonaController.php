<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
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
use App\Http\Models\InterpretesModel;
use App\Http\Models\VariablesPersona;
use App\Http\Models\DatosContacto;
use App\Http\Models\Validaciones;
use App\Http\Models\aparicionesModel;
use RFC\RfcBuilder;

class PersonaController extends Controller{
	public function index(){
		return view("persona");
	}

	public function searchPersona(Request $request){
		$persona = $request->rfc;
		// $personaExiste = DB::table('persona_fisica')
		// ->join('variables_persona_fisica', 'variables_persona_fisica.idPersona', '=', 'persona_fisica.id')
		// ->where('rfc',$persona)
		// ->orwhere('curp',$persona)
		// ->select('persona_fisica.nombres','persona_fisica.primerAp','persona_fisica.segundoAp','persona_fisica.id',
		// 'persona_fisica.fechaNacimiento','persona_fisica.rfc','persona_fisica.curp','persona_fisica.sexo',
		// 'variables_persona_fisica.edad','variables_persona_fisica.telefono','variables_persona_fisica.motivoEstancia',
		// 'variables_persona_fisica.numDocIdentificacion','variables_persona_fisica.alias')->first();

        $personaExiste=PersonaModel::orderBy('rfc', 'ASC')
		->where('rfc',$persona)
		->orwhere('curp',$persona)
		->select('nombres','primerAp','segundoAp','id','fechaNacimiento','rfc','curp','sexo','idNacionalidad','idEtnia','idLengua','idMunicipioOrigen')->first();
		if($personaExiste){
			$personaExiste2=VariablesPersona::orderBy('id','DESC')
			->where('idPersona',$personaExiste->id)
			->select('id','telefono','edad','motivoEstancia','idOcupacion','idEstadoCivil','idEscolaridad','idReligion','idDomicilio','docIdentificacion','idInterprete','numDocIdentificacion','idDomicilioTrabajo','alias')->first();
			$nacionalidad=NacionalidadesModel::orderBy('id','Asc')
			->where('id',$personaExiste->idNacionalidad)
			->select('nombre','id')->first();
			$municipio=CatMunicipio::orderBy('id','Asc')
			->where('id',$personaExiste->idMunicipioOrigen)
			->select('nombre','id')->first();
			$etnia=EtniaModel::orderBy('id','Asc')
			->where('id',$personaExiste->idEtnia)
			->select('nombre','id')->first();
			$lengua=LenguasModel::orderBy('id','Asc')
			->where('id',$personaExiste->idLengua)
			->select('nombre','id')->first();
			$estadoCivil=CatEstadoCivil::orderBy('id','Asc')
			->where('id',$personaExiste2->idEstadoCivil)
			->select('nombre','id')->first();
			$escolaridad=CatEscolaridad::orderBy('id','Asc')
			->where('id',$personaExiste2->idEscolaridad)
			->select('nombre','id')->first();
			$religion=CatReligion::orderBy('id','Asc')
			->where('id',$personaExiste2->idReligion)
			->select('nombre','id')->first();
			$ocupacion=CatOcupacion::orderBy('id','Asc')
			->where('id',$personaExiste2->idOcupacion)
			->select('nombre','id')->first();
			$identificacion=CatIdentificacion::orderBy('id','Asc')
			->where('id',$personaExiste2->docIdentificacion)
			->select('documento','id')->first();
			$interprete=InterpretesModel::orderBy('id','Asc')
			->where('id',$personaExiste2->idInterprete)
			->select('nombre','id')->first();
			$sexo=SexoModel::orderBy('id','Asc')
			->where('id',$personaExiste->sexo)
			->select('nombre','id')->first();
			$idEstado=CatMunicipio::orderBy('id','Asc')
			->where('id',$personaExiste->idMunicipioOrigen)
			->select('idEstado')->first();
			$estado=CatEstado::orderBy('id','Asc')
			->where('id',$idEstado->idEstado)
			->select('nombre','id')->first();
			$data = array(
				'nombres'=>$personaExiste->nombres,
				'primerAp'=>$personaExiste->primerAp,
				'segundoAp'=>$personaExiste->segundoAp,
				'id'=>$personaExiste->id,
				'fechaNacimiento'=>$personaExiste->fechaNacimiento,
				'rfc'=>$personaExiste->rfc,
				'curp'=>$personaExiste->curp,
				'sexo'=>$sexo,
				'idNacionalidad'=>$nacionalidad,
				'idEtnia'=>$etnia,
				'idLengua'=>$lengua,
				'idMunicipioOrigen'=>$municipio,
				'idEstado'=>$estado,
				'edad'=>$personaExiste2->edad,
				'motivoEstancia'=>$personaExiste2->motivoEstancia,
				'idOcupacion'=>$ocupacion,
				'idEstadoCivil'=>$estadoCivil,
				'idEscolaridad'=>$escolaridad,
				'idReligion'=>$religion,
				'idDomicilio'=>$personaExiste2->idDomicilio,
				'docIdentificacion'=>$identificacion,
				'idInterprete'=>$interprete,
				'numDocIdentificacion'=>$personaExiste2->numDocIdentificacion,
				'idDomicilioTrabajo'=>$personaExiste2->idDomicilioTrabajo,
				'alias'=>$personaExiste2->alias,
				'idPersona'=>$personaExiste2->id,
				'telefono'=>$personaExiste2->telefono
			);
		}
		else{
			$data = array(
			);
		}
		return response()->json($data);
	}

	public function getCatalogos(Request $request){
		$sistema = $request->sistema;
        $tipo = $request->tipo;
		$data = array(
		'nacionalidades' => PersonaController::getNacionalidades(),
		'estados' => PersonaController::getEstados(),
		'etnias' => PersonaController::getEtnias(),
		'lenguas' => PersonaController::getLenguas(),
		'sexos' => PersonaController::getSexos(),
		'ocupaciones' => PersonaController::getOcupaciones(),
		'estadosciviles' => PersonaController::getEstadosCiviles(),
		'escolaridades' => PersonaController::getEscolaridades(),
		'religiones' => PersonaController::getReligiones(),
		'identificaciones' => PersonaController::getIdentificaciones(),
		'interpretes' => PersonaController::getInterpretes(),
		'validaciones' => PersonaController::getValidaciones($sistema,$tipo)
		);
		return response()->json($data);
	}
	
	public function getValidaciones($sistema,$tipo){
        $validaciones = Validaciones::where('sistema',$sistema)->where('tipo',$tipo)->first();
        $val = json_decode($validaciones->validaciones);
        return response()->json($val);
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
	public function getInterpretes(){
        $interpretes=InterpretesModel::orderBy('nombre', 'ASC')
	    ->select('nombre','id')->get();
        return response()->json($interpretes);
	}
	
	public function rfcFisico(Request $request){
		$fecha = $request->fechaNacimiento;
		$partes = explode("-",$fecha);
		$builder = new RfcBuilder();
		$rfc = $builder->name($request->nombres)
			->firstLastName($request->primerAp)
			->secondLastName($request->segundoAp)
			->birthday($partes[2], $partes[1], $partes[0])
			// ->birthday(3, 9, 1984)
			->build()
			->toString();
		return ['res' => $rfc];
	}

	private function getInvolucradosPorTipo(String $sistema,String $idCarpeta,String $tipoInvolucrado){
		$result=[];
		$data=DB::table('apariciones')->select('id','idVarPersona','nuc','esEmpresa')->where('sistema',$sistema)->where('idCarpeta',$idCarpeta)->where('tipoInvolucrado',$tipoInvolucrado)->get();							
		foreach($data as $involucrado){
			if($involucrado->esEmpresa==0){
				$data2=DB::table('persona_fisica')->select('variables_persona_fisica.id','nombres','primerAp','segundoAp','rfc','sexo','edad','telefono','docIdentificacion','numDocIdentificacion',DB::raw('0 AS esEmpresa'))->join('variables_persona_fisica','variables_persona_fisica.idPersona','=','persona_fisica.id')->where('variables_persona_fisica.id',$involucrado->idVarPersona)->get();
			}else{
				$data2=DB::table('persona_moral')->select('variables_persona_moral.id','nombre','rfc','telefono',DB::raw('1 AS esEmpresa'))->join('variables_persona_moral','variables_persona_moral.idPersona','=','persona_moral.id')->where('variables_persona_moral.id',$involucrado->idVarPersona)->get();
			}
			array_push($result,$data2);
		}
		//return response()->json($result);
		return $result;
	}

	public function getDenunciantesCarpeta(Request $request){						
		if( ($request->sistema ==null) || ($request->idCarpeta == null)){
			return ["Status"=>"Error","Mensaje"=>"Faltan datos de entrada"];
		}
		else{
			$response=self::getInvolucradosPorTipo($request->sistema,$request->idCarpeta,"denunciante");
			if($response){
				return  response()->json($response); 
			}else{
				return ["Status"=>"Accepted ","Mensaje"=>"Respuesta sin ningún contenido"];
			}
		}
	}

	public function getInvestigadosCarpeta(Request $request){
		if( ($request->sistema ==null) || ($request->idCarpeta == null)){
			return ["Status"=>"Error","Mensaje"=>"Faltan datos de entrada"];
		}else{
			$response=self::getInvolucradosPorTipo($request->sistema,$request->idCarpeta,"investigado");
			if($response){
				return response()->json($response);
			}else{
				return ["Status"=>"Accepted ","Mensaje"=>"Respuesta sin ningún contenido"];
			}	
		}
	}

	public function getTestigosCarpeta(Request $request){
		if( ($request->sistema ==null) || ($request->idCarpeta == null)){
			return ["Status"=>"Error","Mensaje"=>"Faltan datos de entrada"];
		}else{
			$response=self::getInvolucradosPorTipo($request->sistema,$request->idCarpeta,"testigo");
			if($response){
				return response()->json($response);
			}else{
				return ["Status"=>"Accepted ","Mensaje"=>"Respuesta sin ningún contenido"];
			}			
		}		
	}

	public function getAutoridadesCarpeta(Request $request){
		if( ($request->sistema ==null) || ($request->idCarpeta == null)){
			return ["Status"=>"Error","Mensaje"=>"Faltan datos de entrada"];
		}else{
			$response=self::getInvolucradosPorTipo($request->sistema,$request->idCarpeta,"autoridad");
			if($response){
				return response()->json($response);
			}else{
				return ["Status"=>"Accepted ","Mensaje"=>"Respuesta sin ningún contenido"];
			}			
		}		
	}

	public function getAbogadosCarpeta(Request $request){
		if( ($request->sistema ==null) || ($request->idCarpeta == null)){
			return ["Status"=>"Error","Mensaje"=>"Faltan datos de entrada"];
		}else{
			$response=self::getInvolucradosPorTipo($request->sistema,$request->idCarpeta,"abogado");
			if($response){
				return response()->json($response);
			}else{
				return ["Status"=>"Accepted ","Mensaje"=>"Respuesta sin ningún contenido"];
			}			
		}		
	}


	
}