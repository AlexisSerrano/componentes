<?php
namespace App\Http\Controllers;
use  Illuminate\Support\Facades\DB;
class HelpController{
	public static function JSONDBValidation($model,$id1,$id2,$id3){
		//GET JSON FROM DB
		$jsons=HelpModels::GetJSONDB($id1,$id2,$id3);					
		if($jsons==null){
			return \Response::json("error get from JSON in the database (combination id incorrect)");
		}
		//DECODE JSON OBJECT FROM DB TO PHP
		$objs=json_decode($jsons->config,true);
		if($objs==null){
			return \Response::json("error get from JSON to object");
		}		
		//EXECUTE VAKIDATION FROM JSON DB VS MODEL
		return HelpController	::JSONValidation($model,$objs);
	}
	public static function JSONValidation($model,$json){
		//EXECUTE VAKIDATION JSON VS MODEL
		return HelpModels::ModelvsJSON($model,$json);
	}
    public static function GetJSONDBValidation($id1,$id2,$id3){
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
	public static function SearchFilter($tablename,$filters,$limit,$skip){
		try{
			$obj=[];
			if(count($filters)>0){
				foreach($filters as $key=>$filter){
					$obj[]=[$key,'like','%'.$filter.'%'];
				} 
			}
			//$limit=$request->input('limit');
			//$skip=$request->input('skip');			
			$limited=$limit??-1;
			$skiped=$skip??0;
			$formatted=array(
				'count'=>DB::table($tablename)::where($obj)->count(), 
				'src'=>DB::table($tablename)::where($obj)->skip($skiped)->take($limited==-1?$formatted->count:$limited)->get()
			); 
		}catch(Exception $e){
			return \Response::json($e);
		}
		return \Response::json($formatted);
	}
}