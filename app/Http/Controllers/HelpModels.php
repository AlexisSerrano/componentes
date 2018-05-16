<?php
namespace App\Http\Controllers;
use  Illuminate\Support\Facades\DB;
class HelpModels
{
    public static function GetJSONDB($id1,$id2,$id3){
        $jsons=DB::table('ligados')
        ->where('idsistema',$id1) 
        ->where('idinvolucrado',$id2)
        ->where('idcomponente',$id3)
        ->first();        
        return $jsons;
    }
    public static function ModelvsJSON($model,$rules)
    {
        //MODEL TO ARRAY (ENLY THE ELEMENTS INNER MODEL, NOT update_at OR insert_at)
        $elements=$model->toArray();
        /*### OLD CODE
        //COUNT FROM ENTITIES (NAME,BIRTHDAY,ETC.)
        $fields=count($elements);
        ### OLD CODE*/
        //ERROR LOG
        $errors="";
        $fields=0;
        //GET ELEMENT BY ELEMENT FROM MODEL FOR CHECK WHIT JSON
         foreach($elements as $name=>$element){
             //CHECK IF EXITS
             if(!isset($rules[$name])){
                $errors=$errors."<li>".$name." no se encuentra registrado correctamente.</li>";
                $fields=100;
                break;
             }
             /*### FAST VALIDATION, ONLY DETECT 1 ERROR
             if($fields>0){
                 break;
             }*/
             //COUNT RULES FOR THE FIELD
             $fields+=count($rules[$name]["rules"]);
             foreach($rules[$name]["rules"] as $rul=>$val){
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
                                $errors=$errors."<li>".$name." es un campo requerido.</li>";
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
                                    $errors=$errors."<li>".$name." deve de ser un numero.</li>";
                                }
                            }else{
                                if(!is_numeric($element)){
                                    $fields--;
                                }else{
                                    $errors=$errors."<li>".$name." no deve de ser un numero.</li>";
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
                                    $errors=$errors."<li>".$name." debe ser tipo fecha.</li>";
                                }
                            }else{
                                if(!(HelpModels::validateDate($element, 'Y-m-d'))){
                                    $fields--;
                                }else{
                                    $errors=$errors."<li>".$name." no debe ser tipo fecha.</li>";
                                }
                            }
                        }else{
                            $fields--;
                        }
                    break;
                    case "CURP":
                        if(isset($element)){
                            if($val){
                                if(preg_match("/^[A-Z][A,E,I,O,U,X][A-Z]{2}[0-9]{2}[0-1][0-9][0-3][0-9][M,H][AZ]{2}[B,C,D,F,G,H,J,K,L,M,N,Ñ,P,Q,R,S,T,V,W,X,Y,Z]{3}[0-9,AZ][0-9]?$/",trim($element))>0){
                                    $fields--;
                                }else{
                                    $errors=$errors."<li>".$name." debe ser tipo fecha.</li>";
                                }
                            }else{
                                if(preg_match("/^[A-Z][A,E,I,O,U,X][A-Z]{2}[0-9]{2}[0-1][0-9][0-3][0-9][M,H][AZ]{2}[B,C,D,F,G,H,J,K,L,M,N,Ñ,P,Q,R,S,T,V,W,X,Y,Z]{3}[0-9,AZ][0-9]?$/",trim($element))>0){
                                    $fields--;
                                }else{
                                    $errors=$errors."<li>".$name." no debe ser tipo fecha.</li>";
                                }
                            }
                        }else{
                            $fields--;
                        }
                    break;
                    case "RFC":
                        if(isset($element)){
                            if($val){
                                if(preg_match("/^[A-Z]{4}([0-9]{2})(1[0-2]|0[1-9])([0-3][0-9])([ -]?)([A-Z0-9]{3,4})$/",trim($element))){
                                    $fields--;
                                }else{
                                    $errors=$errors."<li>".$name." no debe ser tipo fecha.</li>";;
                                }
                            }else{
                                if(preg_match("/^[A-Z]{4}([0-9]{2})(1[0-2]|0[1-9])([0-3][0-9])([ -]?)([A-Z0-9]{3,4})$/",trim($element))){
                                    $fields--;
                                }else{
                                    $errors=$errors."<li>".$name." no debe ser tipo fecha.</li>";
                                }
                            }
                        }else{
                            $fields--;
                        }
                    break;
                     default:
                     //RULE NAME ERROR, CHECK JSON
                        $fields++;
                     break;
                 }
             }
        }
        //INSERT IF VALIDATED
        if($fields==0){
            //$model->save();
            return \Response::json($model);
        }else{
            return \Response::json("<ul>".$errors."</ul>");
        }
    }
    static function validateDate($date, $format = 'Y-m-d H:i:s'){
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }  
    static function validarRFC($rfc){
	    $regex = '/^[A-Z]{4}([0-9]{2})(1[0-2]|0[1-9])([0-3][0-9])([ -]?)([A-Z0-9]{3,4})$/';
	    return preg_match($regex, $rfc);
    }  
}
