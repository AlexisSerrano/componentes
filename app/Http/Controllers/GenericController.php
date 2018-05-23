<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
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
	// url:"/api/test/ValidacionJSONDBPF",method:"POST",id1:"idsistema",id2:"idinvolucrado",id3:"idcomponente",objSON
	public function ValidacionJSONDBPF(Request $request){
		//BUILD VARSMODEL ANY		
		$model=[
			'nombres'=>$request->input('nombres'),
			'primerAp'=>$request->input('primerAp'),
			'segundoAp'=>$request->input('segundoAp'),
			'rfc'=>$request->input('rfc'),
			'curp'=>$request->input('curp'),
			'fechaNacimiento'=>$request->input('fechaNacimiento'),
			'idNacionalidad'=>$request->input('idNacionalidad'),
			//'idEdoOrigen'=>$request->input('idEdoOrigen'),
			'idMunicipioOrigen'=>$request->input('idMunicipioOrigen'),
			'sexo'=>$request->input('sexo'),
			'idEtnia'=>$request->input('idEtnia'),
			'idLengua'=>$request->input('idLengua'),
			'edad'=>$request->input('edad'),
			'telefono'=>$request->input('telefono'),
			'motivoEstancia'=>$request->input('motivoEstancia'),
			'idOcupacion'=>$request->input('idOcupacion'),
			'idEstadoCivil'=>$request->input('idEstadoCivil'),
			'idReligion'=>$request->input('idReligion'),
			'idEscolaridad'=>$request->input('idEscolaridad'),
			'docIdentificacion'=>$request->input('docIdentificacion'),
			'numDocIdentificacion'=>$request->input('numDocIdentificacion'),
			'idInterprete'=>$request->input('idInterprete'),
			'alias'=>$request->input('alias'),
			'lugarTrabajo'=>$request->input('lugarTrabajo'),
			'telefonoTrabajo'=>$request->input('telefonoTrabajo')
		];				
		if(HelpController::JSONDBValidation($model,$request->input('id1'),$request->input('id2'),$request->input('id3'),$errors)){
			$PM=new \App\Http\Models\PersonaModel();
			if($request->input('idPersona')==null){
				$pm=$PM::where('rfc',$model['rfc'])->first();
				if($pm==null){
					$PM->nombres=$model['nombres'];
					$PM->primerAp=$model['primerAp'];
					$PM->segundoAp=$model['segundoAp'];		
					$PM->rfc=$model['rfc'];
					$PM->curp=$model['curp'];
					$PM->fechaNacimiento=$model['fechaNacimiento'];
					$PM->idNacionalidad=$model['idNacionalidad'];
					//$PM->idEdoOrigen=$model['idEdoOrigen'];
					$PM->idMunicipioOrigen=$model['idMunicipioOrigen'];
					$PM->sexo=$model['sexo'];
					$PM->idEtnia=$model['idEtnia'];
					$PM->idLengua=$model['idLengua'];					
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
					$VPM->edad=$model['edad'];
					$VPM->telefono=$model['telefono'];
					$VPM->motivoEstancia=$model['motivoEstancia'];
					$VPM->idOcupacion=$model['idOcupacion'];
					$VPM->idEstadoCivil=$model['idEstadoCivil'];
					$VPM->idReligion=$model['idReligion'];
					$VPM->idEscolaridad=$model['idEscolaridad'];
					$VPM->docIdentificacion=$model['docIdentificacion'];
					$VPM->numDocIdentificacion=$model['numDocIdentificacion'];
					$VPM->idInterprete=$model['idInterprete'];
					$VPM->alias=$model['alias'];
					$VPM->lugarTrabajo=$model['lugarTrabajo'];
					$VPM->telefonoTrabajo=$model['telefonoTrabajo'];		
					$VPM->esEmpresa=false;
					//##### need id to insert
					//$VPM->idDomicilio=2;
					//$VPM->idDomicilioTrabajo=2;
					//#####
					HelpModels::IsExitsSave($VPM);					
				}else{
					$VPM->id=$request->input('idVariablesPersona');
				}
				if(isset($VPM->id)){
					$am=new \App\Http\Models\aparicionesModel();
					$am->idvar_persona=$VPM->id;
					$am->id_carpeta=$request->input('idcarpeta');
					$am->id_sistema=$request->input('id1');
					$am->id_involucrado=$request->input('id2');
						//'fecha'=>Carbon::now()->timestamp,
					$am->nuc=01234;
					$am->confirmado=false;
					HelpModels::IsExitsSave($am);
					if(isset($am->id)){
						return $am;
					}else{
						return "error en el ultimo paso";						
					}					 					
				}else{
					return "error al insertar 'VariablesPersona'";	
				}
			}else{
				return "error al insertar 'persona'";
			}
			return $PM;
		}else{
			return $errors;
		}
	}
	// url:"/api/test/ValidacionJSONDBPM",method:"POST",id1:"idsistema",id2:"idinvolucrado",id3:"idcomponente",objSON
	public function ValidacionJSONDBPM(Request $request){
		//BUILD VARSMODEL ANY		
		$model=[
			'nombre'=>$request->input('nombres'),
			//'primerAp'=>$request->input('primerAp'),
			//'segundoAp'=>$request->input('segundoAp'),
			'rfc'=>$request->input('rfc'),
			//'curp'=>$request->input('curp'),
			'fechaConstitucion'=>$request->input('fechaConstitucion'),
			//'idNacionalidad'=>$request->input('idNacionalidad'),
			//'idEdoOrigen'=>$request->input('idEdoOrigen'),
			//'idMunicipioOrigen'=>$request->input('idMunicipioOrigen'),
			//'sexo'=>$request->input('sexo'),
			//'idEtnia'=>$request->input('idEtnia'),
			//'idLengua'=>$request->input('idLengua'),
			///'telefono'=>$request->input('telefono'),
			'representanteLegal'=>$request->input('representanteLegal'),


			'edad'=>$request->input('edad'),
			'telefono'=>$request->input('telefono'),
			'motivoEstancia'=>$request->input('motivoEstancia'),
			'idOcupacion'=>$request->input('idOcupacion'),
			'idEstadoCivil'=>$request->input('idEstadoCivil'),
			'idReligion'=>$request->input('idReligion'),
			'idEscolaridad'=>$request->input('idEscolaridad'),
			'docIdentificacion'=>$request->input('docIdentificacion'),
			'numDocIdentificacion'=>$request->input('numDocIdentificacion'),
			'idInterprete'=>$request->input('idInterprete'),
			'alias'=>$request->input('alias'),
			'lugarTrabajo'=>$request->input('lugarTrabajo'),
			'telefonoTrabajo'=>$request->input('telefonoTrabajo')
		];				
		if(HelpController::JSONDBValidation($model,$request->input('id1'),$request->input('id2'),$request->input('id3'),$errors)){
			$PM=new \App\Http\Models\EmpresaModel();
			if($request->input('idPersona')==null){
				$pm=$PM::where('rfc',$model['rfc'])->first();
				if($pm==null){
					$PM->nombres=$model['nombre'];
					//$PM->primerAp=$model['primerAp'];
					//$PM->segundoAp=$model['segundoAp'];		
					$PM->rfc=$model['rfc'];
					//$PM->curp=$model['curp'];
					$PM->fechaConstitucion=$model['fechaConstitucion'];
					//$PM->idNacionalidad=$model['idNacionalidad'];
					//$PM->idEdoOrigen=$model['idEdoOrigen'];
					//$PM->idMunicipioOrigen=$model['idMunicipioOrigen'];
					//$PM->sexo=$model['sexo'];
					//$PM->idEtnia=$model['idEtnia'];
					//$PM->idLengua=$model['idLengua'];					
					$PM->telefono=$model['telefono'];
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
					$VPM->edad=$model['edad'];
					$VPM->telefono=$model['telefono'];
					$VPM->motivoEstancia=$model['motivoEstancia'];
					$VPM->idOcupacion=$model['idOcupacion'];
					$VPM->idEstadoCivil=$model['idEstadoCivil'];
					$VPM->idReligion=$model['idReligion'];
					$VPM->idEscolaridad=$model['idEscolaridad'];
					$VPM->docIdentificacion=$model['docIdentificacion'];
					$VPM->numDocIdentificacion=$model['numDocIdentificacion'];
					$VPM->idInterprete=$model['idInterprete'];
					$VPM->alias=$model['alias'];
					$VPM->lugarTrabajo=$model['lugarTrabajo'];
					$VPM->telefonoTrabajo=$model['telefonoTrabajo'];		
					$VPM->esEmpresa=true;
					//##### need id to insert
					//$VPM->idDomicilio=2;
					//$VPM->idDomicilioTrabajo=2;
					//#####
					HelpModels::IsExitsSave($VPM);					
				}else{
					$VPM->id=$request->input('idVariablesPersona');
				}
				if(isset($VPM->id)){
					$am=new \App\Http\Models\aparicionesModel();
					$am->idvar_persona=$VPM->id;
					$am->id_carpeta=$request->input('idcarpeta');
					$am->id_sistema=$request->input('id1');
					$am->id_involucrado=$request->input('id2');
						//'fecha'=>Carbon::now()->timestamp,
					$am->nuc=01234;
					$am->confirmado=false;
					HelpModels::IsExitsSave($am);
					if(isset($am->id)){
						return $am;
					}else{
						return "error en el ultimo paso";						
					}					 					
				}else{
					return "error al insertar 'VariablesPersona'";	
				}
			}else{
				return "error al insertar 'persona'";
			}
			return $PM;
		}else{
			return $errors;
		}
	}
}