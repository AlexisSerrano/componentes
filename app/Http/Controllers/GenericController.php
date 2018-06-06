<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class GenericController extends Controller{
	// url:"/api/ValidacionDBJSON",method:"POST",id1:"idsistema",id2:"idinvolucrado",id3:"idcomponente"
	public function ValidacionDBJSON(Request $request){
		return HelpController::GetJSONDBValidation($request->input('id1'),$request->input('id2'),$request->input('id3'));
	}
	// url:"/api/SearchUndefined",method:"POST",filters:[ _name:"bysearch"_ ],skip: [0-9]*,limit: [0-9]*
	public function SearchUndefined(Request $request){
		$responseJSON=json_decode($request->getContent(), true);
		if($responseJSON==null){
			$result=HelpController::SearchFilter($request->input('tablename'),$request->input('filters'),$request->input('limit'),$request->input('skip'),$request->input('nfilters'),$request->input('columns'));
		}else{
			$result=HelpController::SearchFilter($responseJSON['tablename']??"sistemas",$responseJSON['filters']??null,$responseJSON['limit']??0,$responseJSON['skip']??0,$responseJSON['nfilters']??null,$responseJSON['columns']??null);
		}
		return $result;
	}
	// url:"/api/SetConfirm",method:"POST",id1:"idsistema",id2:"idinvolucrado",id3:"idvar_persona",id_carpeta:"id_carpeta",nuc,"nuc"
	public function SetConfirm(Request $request){
		$errors;
		HelpController::SetConfirm(
			$request->input('id1'),
			$request->input('id2'),
			$request->input('id3'),
			$errors
		);
		return $errors;
	}
	// url:"/api/SetConfirmCarpetaMulti",method:"POST",ida:"idcarpeta_1",idb:"idcarpeta_2"
	public function SetConfirmCarpetaMulti(Request $request){
		$amc=\App\Http\Models\aparicionesModel::
			where('id_carpeta',$request->input('ida'))
			->get();			
		if($amc!=null){
			foreach($amc as $ap){
				DB::beginTransaction();
				try{
					$ma=\App\Http\Models\aparicionesModel::find($ap->id);
					$ma->id_carpeta=$request->input('idb');
				//$ma->nuc=$request->input('nuc');
					$ma->confirmado=true;
					$ma->save();
					DB::commit();
				}catch(Exception $e){
					DB::rollBack();
					return "error ".$e;
				}
			}
			return "guardado";
		}
		return "no existe";
	}
	// url:"/api/SetConfirmMulti",method:"POST",id1:"idsistema",id2:"idinvolucrado",id3:["idvar_persona"],id_carpeta:"id_carpeta",nuc,"nuc"
	public function SetConfirmMulti(Request $request){
		$ids=$request->input('id3');
		$errors;
		foreach($id3 as $ids){
			if(!HelpController::SetConfirm(
				$request->input('id1'),
				$request->input('id2'),
				$id3,
				$errors
			)){
				break;
			}
		}
		return $errors;
	}
	// url:"/api/ValidacionJSONDBPF",method:"POST",id1:"idsistema",id2:"idinvolucrado",id3:"idcomponente",objSON
	public function ValidacionJSONDBPF(Request $request){
		//BUILD VARSMODEL ANY		
		$model=$request->all();
		if(HelpController::JSONDBValidation($model,$request->input('id1'),$request->input('id2'),$request->input('id3'),$errors)){
			$vpm=\App\Http\Models\VariablesPersona::find($request->input('idVariablesPersona'));
			$idpersona=$request->input('id');
			if(isset($vpm->items)){
				$idpersona=$vpm->idPersona;
			}
			$PM=new \App\Http\Models\PersonaModel();
			$pm=$PM::where('id',$idpersona)->first();
			//->orWhere('curp',$request->input('curp'))
			//->first();
			if($pm!=null){
				$PM=\App\Http\Models\PersonaModel::find($pm->id);				
			}else{
				$PM=new \App\Http\Models\PersonaModel();
			}
			unset($pm);
			$PM->nombres=$model['nombres'];
			$PM->primerAp=$model['primerAp'];
			$PM->segundoAp=$model['segundoAp'];		
			$PM->rfc=$model['rfc'];
			$PM->curp=$model['curp'];
			$PM->fechaNacimiento=$model['fechaNacimiento'];
			$PM->idNacionalidad=$model['idNacionalidad'];
			$PM->idMunicipioOrigen=$model['idMunicipioOrigen'];
			$PM->sexo=$model['sexo'];
			$PM->idEtnia=$model['idEtnia'];
			$PM->idLengua=$model['idLengua'];					
			$PM->save();
			if(!isset($PM->id)){
				return "Error guardando o actualizando persona";
			}			
			if(isset($vpm->items)){
				$VPM=$vpm;
			}else{
				$VPM=new \App\Http\Models\VariablesPersona();
			}
			unset($vpm);
			$VPM->idPersona=$PM->id;
			$VPM->edad=$model['edad'];
			$VPM->motivoEstancia=$model['motivoEstancia'];
			$VPM->idOcupacion=$model['idOcupacion'];
			$VPM->idEstadoCivil=$model['idEstadoCivil'];
			$VPM->idReligion=$model['idReligion'];
			$VPM->idEscolaridad=$model['idEscolaridad'];
			$VPM->docIdentificacion=$model['docIdentificacion'];
			$VPM->numDocIdentificacion=$model['numDocIdentificacion'];
			$VPM->idInterprete=$model['idInterprete'];
			$VPM->alias=$model['alias'];
			$VPM->save();
			if(!isset($VPM->id)){
				return "Error guardando o actualizando variables persona";
			}
			unset($PM);
			$AM=new \App\Http\Models\aparicionesModel();
			$am=$AM::where('idvar_persona',$VPM->id)->first();
			if($am==null){
				$am=new \App\Http\Models\aparicionesModel();
				$am->idvar_persona=$VPM->id;
				$am->id_carpeta=$model['id_carpeta'];
				$am->id_sistema=$model['id1'];
				$am->id_involucrado=$model['id2'];
				$am->nuc=01234;
				$am->confirmado=false;
				$am->esEmpresa=false;
				$am->save();					
			}			
			if(!isset($am->id)){
				return "Error en el último paso";
			}
			return $am;
		}else{
			return $errors;
		}
	}	
}