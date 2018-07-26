<?php

namespace App\Http\Controllers;
use App\Http\Models\PersonaModel;
use App\Http\Models\PersonaMoralModel;
use App\Http\Models\VariablesPersona;
use App\Http\Models\VariablesPersonaMoral;
use App\Http\Models\aparicionesModel;
use App\Http\Models\ExtraDenunciadoFisico;
use App\Http\Models\ExtraDenunciadoMoral;
use App\Http\Controllers\PersonaController;
use DB;

use Illuminate\Http\Request;

class ValidacionEditController extends Controller
{
    public function getPersonaEdit(Request $request){
        switch ($request->tipo) {
            case 'autoridad':
                $datos = ValidacionEditController::getAutoridad($request);
				break;
			case 'abogado':
				$datos = ValidacionEditController::getAbogado($request);
				break;
			case 'denunciante':
				$datos = ValidacionEditController::getDenuncianteFisico($request);
				break;
			case 'denunciantemoral':
				$datos = ValidacionEditController::getDenuncianteMoral($request);
				break;
			case 'denunciado':
				$datos = ValidacionEditController::getDenunciadoFisico($request);
				break;
			case 'denunciadomoral':
				$datos = ValidacionEditController::getDenunciadoMoral($request);
				break;
			case 'conocido':
				$datos = ValidacionEditController::getConocidoFisico($request);
				break;
			case 'conocidomoral':
				$datos = ValidacionEditController::getConocidoMoral($request);
				break;
    
        }
        return $datos;
    }

    public function getAutoridad(Request $request){
        $data['persona'] = ValidacionEditController::getPersonaCompleta($request);
        $data['domicilios'] = PersonaController::getDomiciliosPersona($request);
		return response()->json($data);
    }

    public function getAbogado(Request $request){
        $data['persona'] = ValidacionEditController::getPersonaCompleta($request);
        $data['domicilios'] = PersonaController::getDomiciliosPersona($request);
		return response()->json($data);
    }

    public function getDenuncianteFisico(Request $request){
        $data['persona'] = ValidacionEditController::getPersonaCompleta($request);
        $data['domicilios'] = PersonaController::getDomiciliosPersona($request);
		return response()->json($data);
    }

    public function getDenuncianteMoral(Request $request){
        $data['persona'] = ValidacionEditController::getPersonaMoralCompleta($request);
        $data['domicilios'] = PersonaController::getDomiciliosPersona($request);
		return response()->json($data);
    }

    public function getDenunciadoFisico(Request $request){
        $data['persona'] = ValidacionEditController::getPersonaCompleta($request);
        $data['domicilios'] = PersonaController::getDomiciliosPersona($request);
		return response()->json($data);
    }

    public function getDenunciadoMoral(Request $request){
        $data['persona'] = ValidacionEditController::getPersonaMoralCompleta($request);
        $data['domicilios'] = PersonaController::getDomiciliosPersona($request);
		return response()->json($data);
    }

    public function getConocidoFisico(Request $request){
		
    }

    public function getConocidoMoral(Request $request){
		$data['persona'] = ValidacionEditController::getPersonaMoralConocido($request);
        $data['domicilios'] = PersonaController::getDomiciliosPersona($request);
		return response()->json($data);
    }

    public function getPersonaCompleta($request){
        $idVarPersona = $request->idVarPersona;
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
		->where('variables_persona_fisica.id',$idVarPersona)
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

    public function getPersonaMoralCompleta(Request $request){
		$idVarPersona = $request->idVarPersona;
		$personaExiste = DB::table('persona_moral')
		->join('variables_persona_moral', 'variables_persona_moral.idPersona', '=', 'persona_moral.id')
		->join('cat_identificacion','variables_persona_moral.docIdentificacion', '=', 'cat_identificacion.id')
		->where('variables_persona_moral.id',$idVarPersona)
		->select('persona_moral.id as id','persona_moral.nombre','persona_moral.fechaCreacion','persona_moral.rfc',
		'variables_persona_moral.telefono',
		'variables_persona_moral.nombreRep',
		'variables_persona_moral.primerApRep',
		'variables_persona_moral.segundoApRep',
		'variables_persona_moral.docIdentificacion',
		'variables_persona_moral.numDocIdentificacion',
		'variables_persona_moral.id as idVar',
		'variables_persona_moral.idDomicilio','variables_persona_moral.idNotificacion',
		'cat_identificacion.id as idDoc','cat_identificacion.documento as nombreDoc')
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
				'docIdentificacion'=>array("documento"=>$personaExiste->nombreDoc, "id"=>$personaExiste->idDoc),
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
    
    public function getPersonaMoralConocido(Request $request){
		$idVarPersona = $request->idVarPersona;
		$personaExiste = DB::table('persona_moral')
		->join('variables_persona_moral', 'variables_persona_moral.idPersona', '=', 'persona_moral.id')
		->where('variables_persona_moral.id',$idVarPersona)
        ->select('persona_moral.id as id',
        'persona_moral.nombre',
		'variables_persona_moral.id as idVar',
		'variables_persona_moral.idDomicilio',
		'variables_persona_moral.idNotificacion')
		->orderBy('variables_persona_moral.id','desc')
		->first();
		if($personaExiste){
			$data = array(
				'nombre'=>$personaExiste->nombre,
				'idMoral'=>$personaExiste->id,
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

	public function getPersonaFisicaConocido($request){
        $idVarPersona = $request->idVarPersona;
		$personaExisteP = DB::table('persona_fisica')
		->join('variables_persona_fisica', 'variables_persona_fisica.idPersona', '=', 'persona_fisica.id')
		->where('variables_persona_fisica.id',$idVarPersona)
		->select('persona_fisica.id as id','persona_fisica.nombres','persona_fisica.primerAp','persona_fisica.segundoAp',
		'variables_persona_fisica.id as idVar','variables_persona_fisica.idDomicilio','variables_persona_fisica.idTrabajo',
		'variables_persona_fisica.idNotificacion')
		->orderBy('variables_persona_fisica.id','desc')
		->first();
		$alias = DB::table('extra_denunciado_fisico')
		->select('alias')
		->where('idVariablesPersona',$personaExisteP->idVar)
		->first();
        if($personaExisteP){
			$data = array(
				'nombres'=>$personaExisteP->nombres,
				'primerAp'=>$personaExisteP->primerAp,
				'segundoAp'=>$personaExisteP->segundoAp,
				'idDomicilio'=>$personaExisteP->idDomicilio,
				'idDomicilioTrabajo'=>$personaExisteP->idTrabajo,
				'idDomicilioNotificacion'=>$personaExisteP->idNotificacion,
				'idPersona'=>$personaExisteP->id,
				'idVarPersona'=>$personaExisteP->idVar,
				'alias'=>$alias->alias
			);
		}
		else{
			$data = array(
			);
		}
		return response()->json($data);
    }
}
