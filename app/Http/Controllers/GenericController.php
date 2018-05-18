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
		return HelpController::SearchFilter($tablename,$request->input('filters'),$request->input('skip'),$request->input('limit'));
	}
	// url:"/api/test/ValidacionJSONDB",method:"POST",id1:"idsistema",id2:"idinvolucrado",id3:"idcomponente",objSON
	public function ValidacionJSONDB(Request $request){
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
					//##### need id to insert
					$VPM->idDomicilio=2;
					$VPM->idDomicilioTrabajo=2;
					//#####
					$VPM->save();
				}else{
					$VPM->id=$request->input('idVariablesPersona');
				}
				if(isset($VPM->id)){
					$insert=DB::table('apariciones')->insert([
						'idvar_persona'=>$VPM->id,
						'id_carpeta'=>$request->input('idcarpeta'),
						'id_sistema'=>$request->input('id1'),
						'id_involucrado'=>$request->input('id2'),
						//'fecha'=>Carbon::now()->timestamp,
						'nuc'=>01234,
						'confirmado'=>false
					]);
					if($insert){
						return $VPM;
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