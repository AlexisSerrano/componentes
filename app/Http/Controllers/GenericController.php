<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GenericController extends Controller
{
	// url:"/api/test/ValidacionDBJSON",method:"POST",id1:"idsistema",id2:"idinvolucrado",id3:"idcomponente"
	public function ValidacionDBJSON(Request $request){
		return HelpController::GetJSONDBValidation($request->input('id1'),$request->input('id2'),$request->input('id3'));
	}
	// url:"/api/test/SearchUndefined",method:"POST",filters:[ _name:"bysearch"_ ],skip: [0-9]*,limit: [0-9]*
	public function SearchUndefined(Request $request){
		$tablename="cat_estado";
		if($request->input('tablename')!==null){
			$tablename=$request->input('tablename');
		}
		return HelpController::SearchFilter($tablename,$request->input('filters'),$request->input('limit'),$request->input('skip'),$request->input('nfilters'),$request->input('columns'));
	}
	// url:"/api/test/SetConfirm",method:"POST",id1:"idsistema",id2:"idinvolucrado",id3:"idvar_persona",id_carpeta:"id_carpeta",nuc,"nuc"
	public function SetConfirm(Request $request){
		DB::beginTransaction();
		try{
			$amc=\App\Http\Models\aparicionesModel::where('id_involucrado',$request->input('id2'))
				->where('id_sistema',$request->input('id1'))
				->where('idvar_persona',$request->input('id3'))
				->first();			
			if($amc!=null){
			//BUG LARAVEL
				$ma=\App\Http\Models\aparicionesModel::find($amc->id);
				$ma->id_carpeta=$request->input('id_carpeta');
				$ma->nuc=$request->input('nuc');
				$ma->confirmado=true;
				$ma->save();
				DB::commit();
				return $ma;
			}else{
				DB::rollBack();
				return "error no exits";
			}			
		}catch(Exception $e){
			DB::rollBack();
			return "error ".$e;
		}
	}
	// url:"/api/test/ValidacionJSONDBPF",method:"POST",id1:"idsistema",id2:"idinvolucrado",id3:"idcomponente",objSON
	public function ValidacionJSONDBPF(Request $request){
		//BUILD VARSMODEL ANY		
		$model=$request->all();
		if(HelpController::JSONDBValidation($model,$request->input('id1'),$request->input('id2'),$request->input('id3'),$errors)){
			$PM=new \App\Http\Models\PersonaModel();
			$pm=$PM::where('rfc',$request->input('rfc'))
			->orWhere('curp',$request->input('curp'))
			->first();
			if($pm!=null){
				$PM=\App\Http\Models\PersonaModel::find($pm->id);				
			}else{
				$PM=new \App\Http\Models\PersonaModel();
			}
			unset($pm);
			$PM->nombres=$request->input('nombres');
			$PM->primerAp=$request->input('primerAp');
			$PM->segundoAp=$request->input('segundoAp');		
			$PM->rfc=$request->input('rfc');
			$PM->curp=$request->input('curp');
			$PM->fechaNacimiento=$request->input('fechaNacimiento');
			$PM->idNacionalidad=$request->input('idNacionalidad');
			$PM->idMunicipioOrigen=$request->input('idMunicipioOrigen');
			$PM->sexo=$request->input('sexo');
			$PM->idEtnia=$request->input('idEtnia');
			$PM->idLengua=$request->input('idLengua');					
			$PM->save();
			if(!isset($PM->id)){
				return "Error guardando o actualizando persona";
			}
			$vpm=\App\Http\Models\VariablesPersona::find($request->input('idVariablesPersona'));
			if($vpm!=null){
				$VPM=$vpm;
			}else{
				$VPM=new \App\Http\Models\VariablesPersona();
			}
			unset($vpm);
			$VPM->idPersona=$PM->id;
			$VPM->edad=$request->input('edad');
			$VPM->telefono=$request->input('telefono');
			$VPM->motivoEstancia=$request->input('motivoEstancia');
			$VPM->idOcupacion=$request->input('idOcupacion');
			$VPM->idEstadoCivil=$request->input('idEstadoCivil');
			$VPM->idReligion=$request->input('idReligion');
			$VPM->idEscolaridad=$request->input('idEscolaridad');
			$VPM->docIdentificacion=$request->input('docIdentificacion');
			$VPM->numDocIdentificacion=$request->input('numDocIdentificacion');
			$VPM->idInterprete=$request->input('idInterprete');
			$VPM->alias=$request->input('alias');
			$VPM->lugarTrabajo=$request->input('lugarTrabajo');
			$VPM->telefonoTrabajo=$request->input('telefonoTrabajo');		
			$VPM->esEmpresa=false;
			$VPM->save();
			if(!isset($VPM->id)){
				return "Error guardando o actualizando variables persona";
			}
			unset($PM);
			$am=new \App\Http\Models\aparicionesModel();
			$am->idvar_persona=$VPM->id;
			$am->id_carpeta=$request->input('id_carpeta');
			$am->id_sistema=$request->input('id2');
			$am->id_involucrado=$request->input('id1');
			$am->nuc=01234;
			$am->confirmado=false;
			$am->save();
			if(!isset($am->id)){
				return "Error en el último paso";
			}
			return $am;
		}else{
			return $errors;
		}
	}
	// url:"/api/test/ValidacionJSONDBPM",method:"POST",id1:"idsistema",id2:"idinvolucrado",id3:"idcomponente",objSON
	public function ValidacionJSONDBPM(Request $request){
		//BUILD VARSMODEL ANY		
		$model=$request->all();
		if(HelpController::JSONDBValidation($model,$request->input('id1'),$request->input('id2'),$request->input('id3'),$errors)){
			$PM=new \App\Http\Models\EmpresaModel();
			if($request->input('idPersona')==null){
				$pm=$PM::where('rfc',$model['rfc'])->first();
				if($pm==null){
					$PM->nombres=$request->input('nombre');
					$PM->rfc=$request->input('rfc');
					$PM->fechaConstitucion=$request->input('fechaConstitucion');
					$PM->telefono=$request->input('telefono');
					$PM->save();
				}else{
					$PM->id=$pm->id;
				}
			}else{
				$PM->id=$request->input('idPersona');
			}
			if(isset($PM->id)){
				$VPM=new \App\Http\Models\VariablesPersona();
				if($request->input('idVariablesPersona')==null){
					$VPM->idPersona=$PM->id;
					$VPM->edad=$request->input('edad');
					$VPM->telefono=$request->input('telefono');
					$VPM->motivoEstancia=$request->input('motivoEstancia');
					$VPM->idOcupacion=$request->input('idOcupacion');
					$VPM->idEstadoCivil=$request->input('idEstadoCivil');
					$VPM->idReligion=$request->input('idReligion');
					$VPM->idEscolaridad=$request->input('idEscolaridad');
					$VPM->docIdentificacion=$request->input('docIdentificacion');
					$VPM->numDocIdentificacion=$request->input('numDocIdentificacion');
					$VPM->idInterprete=$request->input('idInterprete');
					$VPM->alias=$request->input('alias');
					$VPM->lugarTrabajo=$request->input('lugarTrabajo');
					$VPM->telefonoTrabajo=$request->input('telefonoTrabajo');		
					$VPM->esEmpresa=true;
					HelpModels::IsExitsSave($VPM);					
				}else{
					$VPM->id=$request->input('idVariablesPersona');
				}
				if(isset($VPM->id)){
					$am=new \App\Http\Models\aparicionesModel();
					$am->idvar_persona=$VPM->id;
					$am->id_carpeta=$request->input('id_carpeta');
					$am->id_sistema=$request->input('id2');
					$am->id_involucrado=$request->input('id1');
					$am->nuc=01234;
					$am->confirmado=false;
					HelpModels::IsExitsSave($am);
					if(isset($am->id)){
						return $am;
					}else{
						return "Error en el último paso";						
					}					 					
				}else{
					return "Error al insertar 'VariablesPersona'";	
				}
			}else{
				return "Error al insertar 'persona'";
			}
			return $PM;
		}else{
			return $errors;
		}
	}
}