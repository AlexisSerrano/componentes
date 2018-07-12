<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Models\ExtraDenuncianteFisico;
use App\Http\Models\ExtraDenuncianteMoral;
use App\Http\Controllers\Controller;
use DB;
class ExtrasDenuncianteController extends Controller
{

    // resguardar 1=si 0=no  victima=1 ofendido=0
    public function addExtrasDenunciante(Request $request){
        try{
            DB::beginTransaction();
            if($request->idExtrasDenunciante!=""){
                $extraDenunciante=($request->empresa)?ExtraDenuncianteMoral::find($request->idExtrasDenunciante):ExtraDenuncianteFisico::find($request->idExtrasDenunciante);
                $oper="UPDATE";
                $antes= clone $extraDenunciante;
                $tipo=($request->empresa)?"extra_denunciante_moral":"extra_denunciante_fisico";
            }else{
                $extraDenunciante=($request->empresa)?new ExtraDenuncianteMoral():new ExtraDenuncianteFisico();
                $oper="INSERT";
                $antes=null;
                $extraDenunciante->idVariablesPersona = $request->idPersona;
                $tipo=($request->empresa)?"extra_denunciante_moral":"extra_denunciante_fisico"; 
            }     
            $extraDenunciante->resguardarIdentidad = $request->reguardarIdentidad;        
            $extraDenunciante->victima = $request->victima;      
            $extraDenunciante->save();

            $apariciones = saveInApariciones($request->sistema,$request->idCarpeta,$request->idPersona,$request->tipo,'xxxxx',$request->empresa);

            saveInLog($request->sistema,$request->usuario,'apariciones','INSERT',$apariciones->id,null,$apariciones);
            saveInLog($request->sistema,$request->usuario,$tipo,$oper,$extraDenunciante->id,$antes,$extraDenunciante);
            DB::commit();
            return $extraDenunciante->id;
        }
        catch(Exception $e){
            DB::rollback();
            return false;
        }
    }
}
