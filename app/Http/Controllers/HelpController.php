<?php
namespace App\Http\Controllers;
use  Illuminate\Support\Facades\DB;
class HelpController{
	public static function JSONDBValidation(&$model,$id1,$id2,$id3,&$errors){
		//GET JSON FROM DB
		$jsons=HelpModels::GetJSONDB($id1,$id2,$id3);					
		if($jsons==null){
			$errors="error get from JSON in the database (combination id incorrect)";
			return false;
			//return \Response::json("error get from JSON in the database (combination id incorrect)");
		}
		//DECODE JSON OBJECT FROM DB TO PHP
		$objs=json_decode($jsons->config,true);
		if($objs==null){
			$errors="error get from JSON to object";
			return false;
			//return \Response::json("error get from JSON to object");
		}		
		//EXECUTE VAKIDATION FROM JSON DB VS MODEL
		return HelpController::JSONValidation($model,$objs,$errors);
	}
	public static function JSONValidation(&$model,$json,&$errors){
		//EXECUTE VAKIDATION JSON VS MODEL
		return HelpModels::ModelvsJSON($model,$json,$errors);
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
		$json="";
		try{
			foreach($objs as $name=>$obj){
				foreach($obj['rules'] as $rul=>$rules){
					if($rul=="required"){
						if($rules){
							$json=$json.'"'.$name.'":"1",';
						}else{
							$json=$json.'"'.$name.'":"0",';
						}
					}
				}
			}
		}catch(Exception $e){
			return \Response::json("error generic into JSON object");
		}
		return json_decode("{".substr($json,0,strlen($json)-1)."}",true);
	}
	public static function SearchFilter($tablename,$filters,$limit,$skip,$nfilters,$columns){
		try{
			$obj=[];
			if(isset($filters)&&$filters!=null&&count($filters)>0){
				foreach($filters as $key=>$filter){
					$obj[]=[$key,'like','%'.$filter.'%'];
				} 
			}
			if(isset($nfilters)&&$nfilters!=null&&count($nfilters)>0){
				foreach($nfilters as $nkey=>$nfilter){
					$obj[]=[$nkey,'not like','%'.$nfilter.'%'];
				} 
			}
			$cols=[];
			if(isset($columns)&&$columns!=null&&count($columns)>0){
				foreach($columns as $key=>$columns){
					$cols[]=$columns['name'];
				} 
			}
			//$limit=$request->input('limit');
			//$skip=$request->input('skip');			
			$limited=isset($limit)&&$limit>0?$limit:DB::table($tablename)->where($obj)->count();
			$skiped=$skip??0;
			$formatted=array(
				'count'=>DB::table($tablename)->where($obj)->count(), 
				'src'=>DB::table($tablename)->where($obj)->skip($skiped)->take($limited)->get(count($cols)>0?$cols:['*'])
			); 
		}catch(Exception $e){
			return \Response::json($e);
		}
		return \Response::json($formatted);
	}
}