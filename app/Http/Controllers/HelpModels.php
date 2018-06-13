<?php
namespace App\Http\Controllers;
use  Illuminate\Support\Facades\DB;
class HelpModels
{
    public static function IsExits(&$model,$filters=[],$id="id"){                
        $ma=$model->toArray();
        if(isset($ma[$id])){
            $model=$model::find($ma[$id]);
            if(isset($model->items)){
                return 1;
            }
            //$model->save();
            return 2;
        }
        $wheres=[];        
            if(count($filters)>0){
                foreach($ma as $key=>$element){
                    if($element!=null){
                        if(isset($filters[$key])){
                            $wheres[]=[$key,$element];
                        }
                    }
                }
            }else{
                foreach($ma as $key=>$element){
                    if($element!=null){
                        $wheres[]=[$key,$element];
                    }
                }
            }
        $res=$model::where($wheres)->first();
        if($res==null){
            //$model=$res;            
            //$model->save();
            return 3;
        }else{
            $model=$model::find($res->id);
            return 4;
            //$model=$model::find($ma[$id]);
        }
    }
    public static function GetJSONDB($id1,$id2,$id3){
        $jsons=DB::table('validaciones')
        ->where('idsistema',$id1) 
        ->where('idinvolucrado',$id2)
        ->where('idcomponente',$id3)
        ->first();        
        return $jsons;
    }
    public static function MatchJSONModel($name,$jsonobj,$element,&$fields,&$errors,$index=0)
    {
        //COUNT RULES FOR THE FIELD
        $fields+=count($jsonobj[$name]["rules"]);
        foreach($jsonobj[$name]["rules"] as $rul=>$val){
            //WHAT RULE IS?
            switch($rul){
                //THE RULE REQUIRED IS SAME NO EMPTY
                case "required":
                   if($val){
                       //REQUIRED
                       if($element!=null){
                           //GOOD VALIDATION
                           $fields--;
                       }else{
                           //ERROR MESSAGE
                           $errors=$errors."<li>".$name."-".$index." es un campo requerido.</li>";
                       }
                   }else{
                       //NO REQUIRED
                       $fields--;
                   }
                break;
                //THE RULE NUMBER , BEFFORE FROM REQUIRED RULE
                case "number":
                   if(isset($element)){
                       if($val){
                           if(is_numeric($element)){
                               $fields--;
                           }else{
                               $errors=$errors."<li>".$name."-".$index." debe de ser un número.</li>";
                           }
                       }else{
                           if(!is_numeric($element)){
                               $fields--;
                           }else{
                               $errors=$errors."<li>".$name."-".$index." no debe de ser un número.</li>";
                           }
                       }
                   }else{
                       //not validate nulls
                       $fields--;
                   }
                break;
               case "date":
                   if(isset($element)){
                       if($val){
                           if(HelpModels::validateDate($element, 'Y-m-d')){
                               $fields--;
                           }else{
                               $errors=$errors."<li>".$name."-".$index." debe ser tipo fecha.</li>";
                           }
                       }else{
                           if(!(HelpModels::validateDate($element, 'Y-m-d'))){
                               $fields--;
                           }else{
                               $errors=$errors."<li>".$name."-".$index." no debe ser tipo fecha.</li>";
                           }
                       }
                   }else{
                       $fields--;
                   }
               break;
               case "curp":
                   if(isset($element)){
                       if($val){
                           if(HelpModels::validarCURP($element)){
                               $fields--;
                           }else{
                               $errors=$errors."<li>".$name."-".$index." debe ser formato CURP.</li>";
                           }
                       }else{
                           if(HelpModels::validarCURP($element)){
                               $fields--;
                           }else{
                               $errors=$errors."<li>".$name."-".$index." no debe ser formato CURP.</li>";
                           }
                       }
                   }else{
                       $fields--;
                   }
               break;
               case "rfc":
                   if(isset($element)){
                       if($val){
                           if(HelpModels::validarRFC($element)){
                               $fields--;
                           }else{
                               $errors=$errors."<li>".$name."-".$index." debe ser formato RFC.</li>";;
                           }
                       }else{
                           if(HelpModels::validarRFC($element)){
                               $fields--;
                           }else{
                               $errors=$errors."<li>".$name."-".$index." no debe ser tipo fecha.</li>";
                           }
                       }
                   }else{
                       $fields--;
                   }
               break;
               case "phone":
                   if(isset($element)){
                       if($val){
                           if(HelpModels::PhoneValidation($element)){
                               $fields--;
                           }else{
                               $errors=$errors."<li>".$name."-".$index." Teléfono no válido<br>EJEMPLOS:<br>(123) 456 7899<br>(123).456.7899<br>(123)-456-7899<br>123-456-7899<br>123 456 7899<br>1234567899</li>";;
                           }
                       }else{
                           if(HelpModels::PhoneValidation($element)){
                               $fields--;
                           }else{
                               $errors=$errors."<li>".$name."-".$index." no debe tener un formato de teléfono.</li>";
                           }
                       }
                   }else{
                       $fields--;
                   }
               break;
                default:
                   //RULE NAME ERROR, CHECK JSON
                   $errors=$errors."<li>".$name."-".$rul." declaración en JSON incorrecta.</li>";
                   $fields++;
                break;
            }
        }
    }
    public static function ModelvsJSON(&$model,$jsonobj,&$errors)
    {
        //MODEL TO ARRAY (ENLY THE ELEMENTS INNER MODEL, NOT update_at OR insert_at)
        $elements=$model;
        if(!is_array($model)){
            $elements=$model->toArray();
        }
        /*### OLD CODE
        //COUNT FROM ENTITIES (NAME,BIRTHDAY,ETC.)
        $fields=count($elements);
        ### OLD CODE*/
        $fields=0;
        //GET ELEMENT BY ELEMENT FROM MODEL FOR CHECK WHIT JSON
         foreach($elements as $name=>$element){
             //CHECK IF EXITS
             /*if(!isset($jsonobj[$name])){
                $errors=$errors."<li>".$name."-".$index." no se encuentra registrado correctamente.</li>";
                $fields=100;
                break;
             }*/
             if(isset($jsonobj[$name])){
                if($element==null&&isset($jsonobj[$name]['default'])){
                     $model[$name]=$jsonobj[$name]['default'];                                  
                }
                if(!isset($jsonobj[$name]['shape'])){
                    $jsonobj[$name]['shape']='line';                                  
                }
                if($jsonobj[$name]['shape']=='array'){
                    if($element==null){                        
                        HelpModels::MatchJSONModel($name,$jsonobj,null,$fields,$errors);
                        $jsonobj[$name]=null;
                    }
                    $pos=$jsonobj[$name]['pos'];
                    $index=0;
                    foreach($element as $el){
                        HelpModels::MatchJSONModel($name,$jsonobj,$el[$pos],$fields,$errors,$index);
                        $index++;
                    }
                }else{
                    if($element==null){                        
                        HelpModels::MatchJSONModel($name,$jsonobj,null,$fields,$errors);
                        //$model[$name]=null;
                        if(isset($jsonobj[$name]['default'])){
                            $model[$name]=$jsonobj[$name]['default'];                                  
                        }else{
                            $model[$name]=null;
                        }
                    }else{
                        HelpModels::MatchJSONModel($name,$jsonobj,$element,$fields,$errors);
                    }
                }
             /*### FAST VALIDATION, ONLY DETECT 1 ERROR
             if($fields>0){
                 break;
             }*/             
            }
        }
        //INSERT IF VALIDATED
        if($fields==0){
            //$model->save();
            return true;//\Response::json($model);
        }else{
            $errors="<ul>".$errors."</ul>";
            return false;//\Response::json("<ul>".$errors."</ul>");
        }
    }
    static function validateDate($date, $format = 'Y-m-d H:i:s'){
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }  
    static function validarRFC($rfc){
	    $regex = '/^[A-Z]{4}([0-9]{2})(1[0-2]|0[1-9])([0-3][0-9])([ -]?)([A-Z0-9]{3,4})$/';
	    return preg_match($regex, trim($rfc));
    }
    static function validarCURP($curp){
	    $regex = '/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/';
	    return preg_match($regex, trim($curp));
    }  
    static function PhoneValidation($phone){
	    $regex = '/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/';
	    return preg_match($regex, trim($phone));
    }  
}
