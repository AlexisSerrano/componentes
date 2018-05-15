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
	public function ValidacionDBJSON(Request $request)
	{
		$jsons=\fge\apis\help\Models::GetJSONDB($request->input('id1'),$request->input('id2'),$request->input('id3'));
		if($jsons==null){
			return \Response::json("error get from JSON in the database (combination id incorrect)");
        }
		$objs=json_decode($jsons->config,true);
		if($objs==null){
			return \Response::json("error get from JSON to object");
		}
		$json=[];
		try{
			foreach($objs as $name=>$obj){
				foreach($obj['rules'] as $rul=>$rules){
					if($rul=="required"){
						if($rules){
							$json[]=[$name=>1];
						}else{
							$json[]=[$name=>0];
						}
					}
				}
			}
		}catch(Exception $e){
			return \Response::json("error generic into JSON object");
		}
		return \Response::json($json);
	}
}