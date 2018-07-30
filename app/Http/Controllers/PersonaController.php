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
		$rfcCurp = $request->rfcCurp;
		$tipoBusqueda = $request->tipoBusqueda;

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
		->where($tipoBusqueda,$rfcCurp)
		->select('persona_fisica.id as id','persona_fisica.nombres','persona_fisica.primerAp','persona_fisica.segundoAp',
		'persona_fisica.fechaNacimiento','persona_fisica.rfc','persona_fisica.curp','persona_fisica.sexo',
		'variables_persona_fisica.edad','variables_persona_fisica.telefono','variables_persona_fisica.motivoEstancia',
		'variables_persona_fisica.numDocIdentificacion',/*'variables_persona_fisica.alias',*/'variables_persona_fisica.id as idVar',
		'variables_persona_fisica.idDomicilio','variables_persona_fisica.idTrabajo','variables_persona_fisica.idNotificacion',
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
		'cat_estado.id as idEstado','cat_estado.nombre as nombreEstado')
		->orderBy('variables_persona_fisica.id','desc')
		->first();
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
				'idDomicilioNotificacion'=>$personaExisteP->idNotificacion,
				'idPersona'=>$personaExisteP->id,
				'idVarPersona'=>$personaExisteP->idVar,
				'telefono'=>$personaExisteP->telefono
			);
		}
		else{
			$data = array(
			);
		}
		return response()->json($data);
	}

	public function searchConocido(Request $request){

		$subQuery = "(SELECT MAX(varPer.id ) as idVariables,
				varPer.idPersona from variables_persona_fisica varPer        
				join persona_fisica per on per.id = varPer.idPersona               
				WHERE ( (per.nombres ='$request->nombres') and (per.primerAp = '$request->primerAp') and (per.segundoAp = '$request->segundoAp') )
				GROUP by varPer.idPersona) sub ";

		$res = DB::table('variables_persona_fisica as varPer2')
		->join('persona_fisica','persona_fisica.id','=','varPer2.idPersona')
		->join('domicilio','domicilio.id','=','varPer2.idDomicilio')
		->join('cat_estado','cat_estado.id','=','domicilio.idEstado')
		->join('cat_municipio','cat_municipio.id','=','persona_fisica.idMunicipioOrigen')
		->join('cat_nacionalidad','cat_nacionalidad.id','=','persona_fisica.idNacionalidad')
		->join('sexos','sexos.id','=','persona_fisica.sexo')
		->where('persona_fisica.nombres','=',$request->nombres)->where('persona_fisica.primerAp','=',$request->primerAp)->where('persona_fisica.segundoAp','=',$request->segundoAp)
		->select('persona_fisica.nombres','persona_fisica.primerAp',
		'persona_fisica.segundoAp','varPer2.edad','sexos.nombre','persona_fisica.rfc',
		'persona_fisica.curp','varPer2.idDomicilio','varPer2.idTrabajo',
		'varPer2.idNotificacion','varPer2.id','varPer2.idPersona',
		'cat_estado.nombre','cat_municipio.nombre','cat_nacionalidad.nombre')

		->join(DB::raw($subQuery), function($join) {
			$join->on('sub.idVariables', '=', 'varPer2.id'); })->get();
			
			if($res){
				return response()->json($res);
			}else{
				return response()->json(false);
			}

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
		'municipios' => PersonaController::getMunicipios(30),
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

	/*se lanza cuando se da en guardar persona fisica, busca carpetas involucradas en uat y uipj*/
	/*falta agregar un where con los tipos de determinaciones validos*/
	public function fisicaBuscarCarpetas(Request $request){		
		$carpetas = DB::select("select nombres,primerAp,segundoAp,
				rfc, curp,apar.idCarpeta,apar.carpeta,apar.sistema,
				apar.tipoInvolucrado,apar.nuc,catDet.nombre as determinacion,
				apar.esEmpresa from variables_persona_fisica varPer
			join persona_fisica per on per.id = varPer.idPersona
			join apariciones apar on apar.idVarPersona = varPer.id
			join cat_tipo_determinacion catDet on catDet.id = apar.idTipoDeterminacion
			WHERE esEmpresa = 0 and (rfc = '$request->rfc' or curp = '$request->curp')");
		if($carpetas){
			return response()->json($carpetas);
		}else{
			return response()->json(false);
		}		
	}

	/*se lanza cuando se da en guardar persona moral, busca carpetas involucradas en uat y uipj*/
	/*falta agregar un where con los tipos de determinaciones validos*/
	public function moralBuscarCarpetas(Request $request){
		$carpetas = DB::select("select per.nombre,varPer.nombreRep,varPer.primerApRep,varPer.segundoApRep,rfc,apar.idCarpeta,apar.carpeta,apar.sistema,
				apar.tipoInvolucrado,apar.nuc,catDet.nombre as determinacion,
				apar.esEmpresa from variables_persona_moral varPer
			join persona_moral per on per.id = varPer.idPersona
			join apariciones apar on apar.idVarPersona = varPer.id
			join cat_tipo_determinacion catDet on catDet.id = apar.idTipoDeterminacion
			WHERE esEmpresa = 1 and (rfc = '$request->rfc')");
		if($carpetas){
			return response()->json($carpetas);
		}else{
			return response()->json(false);
		}	
	}

	public static function trabajos($id,$tabla){
		$trabajo = DB::table("$tabla")
		->join('trabajo as tra', 'tra.id',"$tabla.idTrabajo")
		->join('domicilio as dom', 'dom.id','tra.idDomicilio')	
		->join('cat_estado as edo', 'edo.id','=','dom.idEstado')
		->join('cat_municipio as mun', 'mun.id','=','dom.idMunicipio')
		->join('cat_localidad as loc', 'loc.id','=','dom.idLocalidad')
		->join('cat_colonia as col', 'col.id','=','dom.idColonia')	
		->where("$tabla.id",$id)
		->select(
			'tra.id as idTrabajo','lugar','tra.telefono','tra.idDomicilio','dom.idEstado','dom.idMunicipio','dom.idLocalidad','calle','numExterno','numInterno','dom.idColonia','col.nombre as descColonia',
			'edo.nombre as descEstado','mun.nombre as descMunicipio','loc.nombre as descLocalidad','col.codigoPostal'
		)->first();
		$dom = array(
			'idTrabajo'=>$trabajo->idTrabajo,
			'lugar'=>$trabajo->lugar,
			'telefono'=>$trabajo->telefono,
			'idDomicilio'=>$trabajo->idDomicilio,
			'idEstado'=>array("nombre"=>$trabajo->descEstado, "id"=>$trabajo->idEstado),
			'idMunicipio'=>array("nombre"=>$trabajo->descMunicipio, "id"=>$trabajo->idMunicipio),
			'idLocalidad'=>array("nombre"=>$trabajo->descLocalidad, "id"=>$trabajo->idLocalidad),
			'idColonia'=>array("nombre"=>$trabajo->descColonia, "id"=>$trabajo->idColonia),
			'codigoPostal'=>array("codigoPostal"=>(string)$trabajo->codigoPostal, "id"=>$trabajo->codigoPostal),
			'calle'=>$trabajo->calle,
			'numExterno'=>$trabajo->numExterno,
			'numInterno'=>$trabajo->numInterno
		);
		return $dom;
	}

	public static function domicilios($id,$tabla){
		$domicilio = DB::table("$tabla")
		->join('domicilio as dom', 'dom.id','=',"$tabla.idDomicilio")
		->join('cat_estado as edo', 'edo.id','=','dom.idEstado')
		->join('cat_municipio as mun', 'mun.id','=','dom.idMunicipio')
		->join('cat_localidad as loc', 'loc.id','=','dom.idLocalidad')
		->join('cat_colonia as col', 'col.id','=','dom.idColonia')
		->where("$tabla.id",$id)
		->select(
			'dom.id as id','dom.idEstado','dom.idMunicipio','dom.idLocalidad','calle','numExterno','numInterno','dom.idColonia',
			'col.nombre as descColonia','edo.nombre as descEstado','mun.nombre as descMunicipio','loc.nombre as descLocalidad',
			'col.codigoPostal'
		)->first();
		$dom = array(
			'id'=>$domicilio->id,
			'idEstado'=>array("nombre"=>$domicilio->descEstado, "id"=>$domicilio->idEstado),
			'idMunicipio'=>array("nombre"=>$domicilio->descMunicipio, "id"=>$domicilio->idMunicipio),
			'idLocalidad'=>array("nombre"=>$domicilio->descLocalidad, "id"=>$domicilio->idLocalidad),
			'idColonia'=>array("nombre"=>$domicilio->descColonia, "id"=>$domicilio->idColonia),
			'codigoPostal'=>array("codigoPostal"=>(string)$domicilio->codigoPostal, "id"=>$domicilio->codigoPostal),
			'calle'=>$domicilio->calle,
			'numExterno'=>$domicilio->numExterno,
			'numInterno'=>$domicilio->numInterno
		);
		return $dom;
	}

	public static function notificaciones($id,$tabla){
		$notificacion = DB::table("$tabla")
		->join('notificacion as noti', 'noti.id','=',"$tabla.idNotificacion")
		->join('domicilio as dom', 'dom.id','=','noti.idDomicilio')		
		->join('cat_estado as edo', 'edo.id','=','dom.idEstado')
		->join('cat_municipio as mun', 'mun.id','=','dom.idMunicipio')
		->join('cat_localidad as loc', 'loc.id','=','dom.idLocalidad')
		->join('cat_colonia as col', 'col.id','=','dom.idColonia')
		->where("$tabla.id",$id)
		->select(
			'noti.id as idNotificacion','correo','noti.telefono','noti.idDomicilio','dom.idEstado','dom.idMunicipio','dom.idLocalidad','calle','numExterno','numInterno','dom.idColonia','col.nombre as descColonia',
			'edo.nombre as descEstado','mun.nombre as descMunicipio','loc.nombre as descLocalidad','col.codigoPostal'
		)->first();
		$dom = array(
			'idNotificacion'=>$notificacion->idNotificacion,
			'correo'=>$notificacion->correo,
			'telefono'=>$notificacion->telefono,
			'idDomicilio'=>$notificacion->idDomicilio,
			'idEstado'=>array("nombre"=>$notificacion->descEstado, "id"=>$notificacion->idEstado),
			'idMunicipio'=>array("nombre"=>$notificacion->descMunicipio, "id"=>$notificacion->idMunicipio),
			'idLocalidad'=>array("nombre"=>$notificacion->descLocalidad, "id"=>$notificacion->idLocalidad),
			'idColonia'=>array("nombre"=>$notificacion->descColonia, "id"=>$notificacion->idColonia),
			'codigoPostal'=>array("codigoPostal"=>(string)$notificacion->codigoPostal, "id"=>$notificacion->codigoPostal),
			'calle'=>$notificacion->calle,
			'calle'=>$notificacion->calle,
			'numExterno'=>$notificacion->numExterno,
			'numInterno'=>$notificacion->numInterno
		);
		return $dom;
	}

	public static function getDomiciliosPersona(Request $request){
		$varPersona = $request->idVarPersona;
		$esEmpresa = $request->esEmpresa;
		if($esEmpresa){
			$data['domicilio'] = PersonaController::domicilios($varPersona,'variables_persona_moral');
			$data['notificacion'] = PersonaController::notificaciones($varPersona,'variables_persona_moral');
		}
		else{
			$data['domicilio'] = PersonaController::domicilios($varPersona,'variables_persona_fisica');
			$data['notificacion'] = PersonaController::notificaciones($varPersona,'variables_persona_fisica');
			$data['trabajo'] = PersonaController::trabajos($varPersona,'variables_persona_fisica');
		}
		return response()->json($data);
	}

	public function cambiarEstadoCarpeta(Request $request){						
		$respuesta=aparicionesModel::where('idCarpeta','=',$request->idCarpeta)->where('sistema','=',$request->sistema)->first();		
		if($respuesta){
        	try{
	            DB::beginTransaction();
				$update = DB::table('apariciones')->
            	where('idCarpeta','=',$request->idCarpeta)->where('sistema','=',$request->sistema)
				->update(['idTipoDeterminacion' => $request->idTipoDeterminacion]);
				saveInLog($request->sistema,$request->usuario,'apariciones','UPDATE',$respuesta->id,['idTipoDeterminacion' => $respuesta->idTipoDeterminacion],['idTipoDeterminacion' => $request->idTipoDeterminacion]);
				DB::commit();
			}catch (Exception $e){
				DB::rollback();
				return response()->json(["ERROR"->$e->getMessage()]);
			}
				return ["Valor antiguo"=>$respuesta->idTipoDeterminacion,"Valor actual"=>$request->idTipoDeterminacion];
		}else{
			return ["Response"=>" Sin datos"];
		}				
	}

}