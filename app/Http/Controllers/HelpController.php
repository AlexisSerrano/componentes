<?php
namespace App\Http\Controllers;
class HelpController{
    public static function GetJSONValidation($id1,$id2,$id3){
        //$jsons=HelpModels::GetJSONDB($request->input('id1'),$request->input('id2'),$request->input('id3'));
        $jsons=HelpModels::GetJSONDB($id1,$id2,$id3);
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