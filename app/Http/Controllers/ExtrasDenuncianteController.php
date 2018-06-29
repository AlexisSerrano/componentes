<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Models\ExtraDenuncianteFisico;
use App\Http\Models\ExtraDenuncianteMoral;
use App\Http\Controllers\Controller;
use BitracoraController;
use DB;
class ExtrasDenuncianteController extends Controller
{
    protected $log;

    function __construct() {
        $this->log=new BitacoraController();
    }

    // resguardar 1=si 0=no  victima=1 ofendido=0
    public function addExtrasDenunciante(Request $request){
        try{
            DB::beginTransaction();
            if($request->idExtraDenunciante!=""){
                $extraDenunciante=($request->empresa)?ExtraDenuncianteMoral::find($request->idExtraDenunciante):ExtraDenuncianteFisico::find($request->idExtraDenunciante);
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
            $idLog=$this->log->saveInLog($request->sistema,$request->usuario,$tipo,$oper,$extraDenunciante->id,$antes,$extraDenunciante);
            DB::commit();
            return $extraDenunciante->id;
        }
        catch(Exception $e){
            DB::rollback();
            return false;
        }
    }
}
