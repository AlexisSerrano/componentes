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
		$personaExisteP = DB::table('persona_fisica')
		->join('variables_persona_fisica', 'variables_persona_fisica.idPersona', '=', 'persona_fisica.id')
		->join('cat_nacionalidad','cat_nacionalidad.id','=','persona_fisica.idNacionalidad')
		->join('cat_etnia','cat_etnia.id','=','persona_fisica.idEtnia')
		->join('cat_lengua','cat_lengua.id','=','persona_fisica.idLengua')
		->join('cat_municipio','cat_municipio.id','=','persona_fisica.idMunicipioOrigen')
		->join('cat_ocupacion', 'variables_persona_fisica.idOcupacion', '=', 'cat_ocupacion.id')
		->join('cat_estado_civil', 'variables_persona_fisica.idEstadoCivil', '=', 'cat_estado_civil.id')
		->join('cat_escolaridad', 'variables_persona_fisica.idEscolaridad', '=', 'cat_escolaridad.id')
		->join('cat_religion', 'variables_persona_fisica.idReligion', '=', 'cat_religion.id')
		->join('cat_identificacion', 'variables_persona_fisica.docIdentificacion', '=', 'cat_identificacion.id')
		->join('sexos', 'persona_fisica.sexo', '=', 'sexos.id')
		->join('cat_interprete', 'variables_persona_fisica.idInterprete', '=', 'cat_interprete.id')
		->join('cat_estado', 'cat_municipio.idEstado', '=', 'cat_estado.id')
		->where('rfc',$persona)
		->orwhere('curp',$persona)
		->select('persona_fisica.nombres','persona_fisica.primerAp','persona_fisica.segundoAp',
		'persona_fisica.fechaNacimiento','persona_fisica.rfc','persona_fisica.curp','persona_fisica.sexo',
		'variables_persona_fisica.edad','variables_persona_fisica.telefono','variables_persona_fisica.motivoEstancia',
		'variables_persona_fisica.numDocIdentificacion',/*'variables_persona_fisica.alias',*/'variables_persona_fisica.id',
		'variables_persona_fisica.idDomicilio','variables_persona_fisica.idTrabajo',
		'cat_nacionalidad.id as idNacionalidad','cat_nacionalidad.nombre as nombreNacionalidad',
		'cat_etnia.id as idEtnia','cat_etnia.nombre as nombreEtnia',
		'cat_lengua.id as idLengua','cat_lengua.nombre as nombreLengua',
		'cat_municipio.id as idMunOrigen','cat_municipio.nombre as nombreMunOrigen','cat_municipio.idEstado as idEstado',
		'cat_ocupacion.id as idOcupacion','cat_ocupacion.nombre as nombreOcupacion',
		'cat_estado_civil.id as idEstadoCivil','cat_estado_civil.nombre as nombreEstadoCivil',
		'cat_escolaridad.id as idEscolaridad','cat_escolaridad.nombre as nombreEscolaridad',
		'cat_religion.id as idReligion','cat_religion.nombre as nombreReligion',
		'cat_identificacion.id as idIdentificacion','cat_identificacion.documento as documentoIdentificacion',
		'sexos.id as idSexo','sexos.nombre as nombreSexo',
		'cat_interprete.id as idInterprete','cat_interprete.nombre as nombreInterprete',
		'cat_estado.id as idEstado','cat_estado.nombre as nombreEstado')->first();
        if($personaExisteP){
			$data = array(
				'nombres'=>$personaExisteP->nombres,
				'primerAp'=>$personaExisteP->primerAp,
				'segundoAp'=>$personaExisteP->segundoAp,
				'fechaNacimiento'=>$personaExisteP->fechaNacimiento,
				'rfc'=>$personaExisteP->rfc,
				'curp'=>$personaExisteP->curp,
				'sexo'=>array("nombre"=>$personaExisteP->nombreSexo, "id"=>$personaExisteP->idSexo),
				'idNacionalidad' => array("nombre"=>$personaExisteP->nombreNacionalidad, "id"=>$personaExisteP->idNacionalidad),
				'idEtnia'=>array("nombre"=>$personaExisteP->nombreEtnia, "id"=>$personaExisteP->idEtnia),
				'idLengua'=>array("nombre"=>$personaExisteP->nombreLengua, "id"=>$personaExisteP->idLengua),
				'idMunicipioOrigen'=>array("nombre"=>$personaExisteP->nombreMunOrigen, "id"=>$personaExisteP->idMunOrigen),
				'idEstado'=>array("nombre"=>$personaExisteP->nombreEstado, "id"=>$personaExisteP->idEstado),
				'edad'=>$personaExisteP->edad,
				'motivoEstancia'=>$personaExisteP->motivoEstancia,
				'idOcupacion'=>array("nombre"=>$personaExisteP->nombreOcupacion, "id"=>$personaExisteP->idOcupacion),
				'idEstadoCivil'=>array("nombre"=>$personaExisteP->nombreEstadoCivil, "id"=>$personaExisteP->idEstadoCivil),
				'idEscolaridad'=>array("nombre"=>$personaExisteP->nombreEscolaridad, "id"=>$personaExisteP->idEscolaridad),
				'idReligion'=>array("nombre"=>$personaExisteP->nombreReligion, "id"=>$personaExisteP->idReligion),
				'idDomicilio'=>$personaExisteP->idDomicilio,
				'docIdentificacion'=>array("documento"=>$personaExisteP->documentoIdentificacion, "id"=>$personaExisteP->idIdentificacion),
				'idInterprete'=>array("nombre"=>$personaExisteP->nombreInterprete, "id"=>$personaExisteP->idInterprete),
				'numDocIdentificacion'=>$personaExisteP->numDocIdentificacion,
				'idDomicilioTrabajo'=>$personaExisteP->idTrabajo,
				//'alias'=>$personaExisteP->alias,
				'idPersona'=>$personaExisteP->id,
				'telefono'=>$personaExisteP->telefono
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

	public function buscarCarpetas(Request $request){

		$resp = DB::table('persona_fisica')->join('variables_persona_fisica','variables_persona_fisica.idPersona','=','persona_fisica.id')
		->join('apariciones','apariciones.idVarPersona','=','variables_persona_fisica.idPersona')
		->join('cat_tipo_determinacion','cat_tipo_determinacion.id','=','apariciones.idTipoDeterminacion')
		->select('persona_fisica.nombres','persona_fisica.primerAp','persona_fisica.segundoAp','persona_fisica.rfc','persona_fisica.curp','variables_persona_fisica.idPersona as variablePersona','apariciones.idCarpeta','apariciones.sistema','apariciones.tipoInvolucrado','apariciones.nuc','cat_tipo_determinacion.nombre as tipoDeterminacion')
		->where('rfc','=',$request->rfc)->get();			
		if(!$resp->isEmpty()){
			return response()->json($resp);
		}else{
			return ["Respuesta"=>"Sin información"]; 
		}
		
	}

	public function getDomiciliosPersona(Request $request){
		$data=array();
		$rfc = $request->rfc;

		$data['rfc'] = $rfc;

		$domicilio = DB::table('variables_persona_fisica as var')
		->join('persona_fisica as per', 'per.id','=','var.idPersona')
		->join('domicilio as dom', 'dom.id','=','var.idDomicilio')
		->where('rfc',$rfc)
		->select(
			'dom.id as id','idEstado','idMunicipio','idLocalidad','calle','numExterno','numInterno'
		)->first();

        if($domicilio){
			$dom = array(
				'id'=>$domicilio->id,
				'idEstado'=>$domicilio->idEstado,
				'idMunicipio'=>$domicilio->idMunicipio,
				'idLocalidad'=>$domicilio->idLocalidad,
				'calle'=>$domicilio->calle,
				'numExterno'=>$domicilio->numExterno,
				'numInterno'=>$domicilio->numInterno
			);
			$data['domicilio'] = $dom;
		}

		$trabajo = DB::table('variables_persona_fisica as var')
		->join('persona_fisica as per', 'per.id','var.idPersona')
		->join('trabajo as tra', 'tra.id','var.idTrabajo')
		->join('domicilio as dom', 'dom.id','tra.idDomicilio')		
		->where('rfc',$rfc)
		->select(
			'tra.id as idTrabajo','lugar','tra.telefono','tra.idDomicilio','idEstado','idMunicipio','idLocalidad','calle','numExterno','numInterno'
		)->first();

        if($trabajo){
			$dom = array(
				'idTrabajo'=>$trabajo->idTrabajo,
				'lugar'=>$trabajo->lugar,
				'telefono'=>$trabajo->telefono,
				'idDomicilio'=>$trabajo->idDomicilio,
				'idEstado'=>$trabajo->idEstado,
				'idMunicipio'=>$trabajo->idMunicipio,
				'idLocalidad'=>$trabajo->idLocalidad,
				'calle'=>$trabajo->calle,
				'numExterno'=>$trabajo->numExterno,
				'numInterno'=>$trabajo->numInterno
			);
			$data['trabajo'] = $dom;
		}

		$notificacion = DB::table('variables_persona_fisica as var')
		->join('persona_fisica as per', 'per.id','=','var.idPersona')
		->join('notificacion as noti', 'noti.id','=','var.idNotificacion')
		->join('domicilio as dom', 'dom.id','=','noti.idDomicilio')		
		->where('rfc',$rfc)
		->select(
			'noti.id as idNotificacion','correo','noti.telefono','noti.idDomicilio','idEstado','idMunicipio','idLocalidad','calle','numExterno','numInterno'
		)->first();

		if($notificacion){
			$dom = array(
				'idNotificacion'=>$notificacion->idNotificacion,
				'correo'=>$notificacion->correo,
				'telefono'=>$notificacion->telefono,
				'idDomicilio'=>$notificacion->idDomicilio,
				'idEstado'=>$notificacion->idEstado,
				'idMunicipio'=>$notificacion->idMunicipio,
				'idLocalidad'=>$notificacion->idLocalidad,
				'calle'=>$notificacion->calle,
				'numExterno'=>$notificacion->numExterno,
				'numInterno'=>$notificacion->numInterno
			);
			$data['notificacion'] = $dom;
		}
		
		return response()->json($data);
	}

	public function cambiarEstadoCarpeta(Request $request){		
		$resp = DB::table('apariciones')
			->where('idCarpeta', $request->idCarpeta)
			->update(['idTipoDeterminacion'=>$request->idTipoDeterminacion]);

		/*if($resp!=0){
			return response()->json($data);
		}else{
			return ["Status"=>"No hay coincidencias"];
		}*/
		return $resp;
		
		
	}

}