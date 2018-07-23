<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Models\PersonaModel;
use App\Http\Models\VariablesPersona;
use App\Http\Models\aparicionesModel;


class ApiControllerUAT extends Controller
{

    private function getInvolucradosPorTipo(String $carpeta,String $tipoInvolucrado){
		$result=[];
		$data=DB::table('apariciones')->select('id','idVarPersona','nuc','esEmpresa')->where('sistema','uat')->where('carpeta',$carpeta)->where('tipoInvolucrado',$tipoInvolucrado)->get();							
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

	private function isTokenValido(String $token){
		$data=DB::table('users')->select('id')->where('api_token',$token)->where('activo',1)->first();
		if($data) return true;
		else return false;
	}

	public function getDenunciantesCarpeta(Request $request){
		if( (!isset($request->api_token)||empty($request->api_token)) || ($request->carpeta == null)){
			return ["Status"=>"Error","Mensaje"=>"Faltan datos de entrada"];
		}
		else{
			if(self::isTokenValido($request->api_token)){
				$response=self::getInvolucradosPorTipo($request->carpeta,"denunciante");
				if($response){
					return  response()->json($response); 
				}else{
					return ["Status"=>"Accepted ","Mensaje"=>"Respuesta sin ningún contenido"];
				}
			}else{
				return ["Status"=>"Error","Mensaje"=>"Permisos denegados"];
			}
		}
	}

	public function getInvestigadosCarpeta(Request $request){
		if( (!isset($request->api_token)||empty($request->api_token)) || ($request->carpeta == null)){
			return ["Status"=>"Error","Mensaje"=>"Faltan datos de entrada"];
		}else{
			if(self::isTokenValido($request->api_token)){
				$response=self::getInvolucradosPorTipo($request->carpeta,"investigado");
				if($response){
					return response()->json($response);
				}else{
					return ["Status"=>"Accepted ","Mensaje"=>"Respuesta sin ningún contenido"];
				}	
			}else{
				return ["Status"=>"Error","Mensaje"=>"Permisos denegados"];
			}
		}
	}

	public function getTestigosCarpeta(Request $request){
		if( (!isset($request->api_token)||empty($request->api_token)) || ($request->carpeta == null)){
			return ["Status"=>"Error","Mensaje"=>"Faltan datos de entrada"];
		}else{
			if(self::isTokenValido($request->api_token)){
				$response=self::getInvolucradosPorTipo($request->carpeta,"testigo");
				if($response){
					return response()->json($response);
				}else{
					return ["Status"=>"Accepted ","Mensaje"=>"Respuesta sin ningún contenido"];
				}	
			}else{
				return ["Status"=>"Error","Mensaje"=>"Permisos denegados"];
			}		
		}		
	}

	public function getAutoridadesCarpeta(Request $request){
		if( (!isset($request->api_token)||empty($request->api_token)) || ($request->carpeta == null)){
			return ["Status"=>"Error","Mensaje"=>"Faltan datos de entrada"];
		}else{
			if(self::isTokenValido($request->api_token)){
				$response=self::getInvolucradosPorTipo($request->carpeta,"autoridad");
				if($response){
					return response()->json($response);
				}else{
					return ["Status"=>"Accepted ","Mensaje"=>"Respuesta sin ningún contenido"];
				}	
			}else{
				return ["Status"=>"Error","Mensaje"=>"Permisos denegados"];
			}		
		}		
	}

	public function getAbogadosCarpeta(Request $request){
		if( (!isset($request->api_token)||empty($request->api_token)) || ($request->carpeta == null)){
			return ["Status"=>"Error","Mensaje"=>"Faltan datos de entrada"];
		}else{
			if(self::isTokenValido($request->api_token)){
				$response=self::getInvolucradosPorTipo($request->carpeta,"abogado");
				if($response){
					return response()->json($response);
				}else{
					return ["Status"=>"Accepted ","Mensaje"=>"Respuesta sin ningún contenido"];
				}	
			}else{
				return ["Status"=>"Error","Mensaje"=>"Permisos denegados"];
			}		
		}		
	}


}
