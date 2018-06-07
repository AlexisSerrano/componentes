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
			$vpm=new \App\Http\Models\VariablesPersona();
			if($request->input('idVariablesPersona')!=null){
				$vpm->id=$request->input('idVariablesPersona');
			}
			$pm=new \App\Http\Models\PersonaModel();
			if(HelpModels::IsExits($vpm)==1){
					$pm->id=$vpm->idPersona;
			}else{
					$pm->nombres=$model['nombres'];
					$pm->primerAp=$model['primerAp'];
					$pm->segundoAp=$model['segundoAp'];		
					$pm->rfc=$model['rfc'];
					$pm->curp=$model['curp'];
					$pm->fechaNacimiento=$model['fechaNacimiento'];
					$pm->idNacionalidad=$model['idNacionalidad'];
					$pm->idMunicipioOrigen=$model['idMunicipioOrigen'];
					$pm->sexo=$model['sexo'];
					$pm->idEtnia=$model['idEtnia'];
					$pm->idLengua=$model['idLengua'];					
					//nuevo registro para pm (probable pm)					
					$vpm->edad=$model['edad'];
					$vpm->motivoEstancia=$model['motivoEstancia'];
					$vpm->idOcupacion=$model['idOcupacion'];
					$vpm->idEstadoCivil=$model['idEstadoCivil'];
					$vpm->idReligion=$model['idReligion'];
					$vpm->idEscolaridad=$model['idEscolaridad'];
					$vpm->docIdentificacion=$model['docIdentificacion'];
					$vpm->numDocIdentificacion=$model['numDocIdentificacion'];
					$vpm->idInterprete=$model['idInterprete'];
					$vpm->alias=$model['alias'];
					HelpModels::IsExits($pm);
					HelpModels::IsExits($vpm);					
					$pm->save();
					$vpm->idPersona=$pm->id;
					$vpm->save();
			}
			$am=new \App\Http\Models\aparicionesModel();
			$am->idvar_persona=$vpm->id;
			$am->id_carpeta=$model['id_carpeta'];
			$am->id_sistema=$model['id1'];
			$am->id_involucrado=$model['id2'];
			$am->nuc=01234;
			$am->confirmado=false;
			$am->esEmpresa=false;
			HelpModels::IsExits($am,['id_sistema'=>0,'id_carpeta'=>0,'idvar_persona'=>0]);
			$am->save();
			return $am;
		}else{
			return $errors;
		}
	}	
}