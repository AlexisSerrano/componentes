<?php
namespace fge\apis\controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use fge\apis\models\PersonaModel;
class GenericController extends Controller
{
	public function ValidacionJSONDB(Request $request){
		//GET JSON FROM DB
		$jsons=\fge\apis\help\Models::GetJSONDB($request->input('id1'),$request->input('id2'),$request->input('id3'));					
		if($jsons==null){
			return \Response::json("error get from JSON in the database (combination id incorrect)");
		}
		//DECODE JSON OBJECT FROM DB TO PHP
		$objs=json_decode($jsons->config,true);
		if($objs==null){
			return \Response::json("error get from JSON to object");
		}
		//BUILD MODEL ANY
		$PM=new PersonaModel();
		$PM->nombres=$request->input('nombres');
		$PM->primerAp=$request->input('primerAp');
		$PM->segundoAp=$request->input('segundoAp');
		$PM->fechaNacimiento=$request->input('fechaNacimiento');
		$PM->curp=$request->input('curp');
		$PM->rfc=$request->input('rfc');
		//EXECUTE VAKIDATION JSON DB VS MODEL
		return \fge\apis\help\Models::ModelvsJSON($PM,$objs);
	}
}