<?php
namespace App\Http\Controllers;

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
		return HelpController::SearchFilter($tablename,$request->input('filters'),$request->input('skip'),$request->input('limit'));
	}
	// url:"/api/test/ValidacionJSONDB",method:"POST",id1:"idsistema",id2:"idinvolucrado",id3:"idcomponente",objSON
	public function ValidacionJSONDB(Request $request){
		//BUILD MODEL ANY
		$PM=new \App\Http\Models\PersonaModel();
		$PM->nombres=$request->input('nombres');
		$PM->primerAp=$request->input('primerAp');
		$PM->segundoAp=$request->input('segundoAp');
		$PM->fechaNacimiento=$request->input('fechaNacimiento');
		$PM->curp=$request->input('curp');
		$PM->rfc=$request->input('rfc');
		if(HelpController::JSONDBValidation($PM,$request->input('id1'),$request->input('id2'),$request->input('id3'),$errors)){
			return $PM;
		}else{
			return $errors;
		}
	}
}