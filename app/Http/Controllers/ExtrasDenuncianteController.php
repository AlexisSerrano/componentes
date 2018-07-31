<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Models\ExtraDenuncianteFisico;
use App\Http\Models\ExtraDenuncianteMoral;
use App\Http\Controllers\Controller;
use App\Http\Models\uat\BitacoraNavCaso;
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

            $extraDenunciante->resguardarIdentidad = ($request->reguardarIdentidad=='')?0:$request->reguardarIdentidad;
            
            //Generar Alias        
            if($request->reguardarIdentidad==1){
                $datosPersona = DB::table('variables_persona_fisica')
                ->join('persona_fisica','persona_fisica.id','=','variables_persona_fisica.idPersona')        
                ->select('persona_fisica.nombres','persona_fisica.primerAp','persona_fisica.segundoAp')
                ->where('variables_persona_fisica.id','=',$request->idPersona)->first();

                $alias= substr($datosPersona->nombres,0,1).substr($datosPersona->primerAp,-1,1).substr($datosPersona->nombres,-1,1).rand(1000,9999).substr($datosPersona->primerAp,0,1);
                $extraDenunciante->alias= $alias;
            }            

            $extraDenunciante->victima = $request->victima;      
            $extraDenunciante->save();

            $apariciones = saveInApariciones($request->sistema,$request->idCarpeta,$request->carpeta,$request->idPersona,$request->tipo,'xxxxx',$request->empresa);

            saveInLog($request->sistema,$request->usuario,'apariciones','INSERT',$apariciones->id,null,$apariciones);
            saveInLog($request->sistema,$request->usuario,$tipo,$oper,$extraDenunciante->id,$antes,$extraDenunciante);

            $bdbitacora = BitacoraNavCaso::where('idCaso',$request->idCarpeta)->first();
            $bdbitacora->denunciante = $bdbitacora->denunciante+1;
            $bdbitacora->save();
            DB::commit();
            return $extraDenunciante->id;
        }
        catch(Exception $e){
            DB::rollback();
            return false;
        }
    }
}
