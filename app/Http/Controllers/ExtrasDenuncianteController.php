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

    public function addExtrasDenunciante(Request $request){
        // resguardar 1=si 0=no  victima=1 ofendido=0
        if($request->empresa){
            if($request->idExtraDenunciante==""){
                try{
                    DB::beginTransaction(); 
                    $ExtraDenunciante = new ExtraDenuncianteMoral();
                    $ExtraDenunciante->idVariablesPersona = $request->idPersona;        
                    $ExtraDenunciante->resguardarIdentidad = $request->reguardarIdentidad;        
                    $ExtraDenunciante->victima = $request->victima;      
                    $ExtraDenunciante->save();
                    $idLog=$this->log->saveInLog($request->sistema,$request->usuario,'extra_denunciante_moral','INSERT',$ExtraDenunciante->id,null,$ExtraDenunciante);
                    return $ExtraDenunciante->id;
                    DB::commit();
                }
                catch(Exception $e){
                    DB::rollback();
                    return false;
                }  
            }
            else{
                try{
                    DB::beginTransaction(); 
                    $ExtraDenunciante = ExtraDenuncianteMoral::find($request->idExtraDenunciante);
                    $antes=clone $ExtraDenunciante;            
                    $ExtraDenunciante->resguardarIdentidad = $request->reguardarIdentidad;
                    $ExtraDenunciante->victima = $request->victima;                
                    $ExtraDenunciante->save();
                    $idLog=$this->log->saveInLog($request->sistema,$request->usuario,'extra_denunciante_moral','UPDATE',$ExtraDenunciante->id,$antes,$ExtraDenunciante);
                    return $ExtraDenunciante->id;
                    DB::commit();
                }
                catch(Exception $e){
                    DB::rollback();
                    return false;
                } 
            }
        }
        else{
            if($request->idExtraDenunciante==""){
                try{
                    DB::beginTransaction(); 
                    $ExtraDenunciante = new ExtraDenuncianteFisico();
                    $ExtraDenunciante->idVariablesPersona = $request->idPersona;
                    $ExtraDenunciante->resguardarIdentidad = $request->reguardarIdentidad;        
                    $ExtraDenunciante->victima = $request->victima;        
                    $ExtraDenunciante->save();
                    $idLog=$this->log->saveInLog($request->sistema,$request->usuario,'extra_denunciante_fisico','INSERT',$ExtraDenunciante->id,null,$ExtraDenunciante);
                    return $ExtraDenunciante->id;
                    DB::commit(); 
                }
                catch(Exception $e){
                    DB::rollback();
                    return false;
                }
            }
            else{
                try{
                    DB::beginTransaction(); 
                    $ExtraDenunciante = ExtraDenuncianteFisico::find($request->idExtraDenunciante);
                    $antes=clone $ExtraDenunciante;           
                    $ExtraDenunciante->resguardarIdentidad = $request->reguardarIdentidad;
                    $ExtraDenunciante->victima = $request->victima;                
                    $ExtraDenunciante->save();
                    $idLog=$this->log->saveInLog($request->sistema,$request->usuario,'extra_denunciante_fisico','UPDATE',$ExtraDenunciante->id,$antes,$ExtraDenunciante);
                    return $ExtraDenunciante->id;
                    DB::commit();  
                }
                catch(Exception $e){
                    DB::rollback();
                    return false;
                }
            }
        }
    }

    public function storeExtraDenuncianteFisico(Request $request)
    {    
        $id=[];       
        try{
            DB::beginTransaction();    
            $ExtraDenunciante = new ExtraDenuncianteFisico();
            $ExtraDenunciante->idPersona = $request->idPersona;
            $ExtraDenunciante->resguardarIdentidad = $request->reguardarIdentidad;        
            $ExtraDenunciante->victima = $request->victima;        
            $ExtraDenunciante->save();  
            $id = $ExtraDenunciante->id;  
            $idLog=$this->log->saveInLog($request->sistema,$request->usuario,'extra_denunciante_fisico','INSERT',$id,null,$ExtraDenunciante);
            DB::commit();
        }catch (Exception $e){
            DB::rollback();
            return response()->json(["ERROR"->$e->getMessage()]);
        }                  
        return response()->json($id);
        
    }

    public function storeExtraDenuncianteMoral(Request $request)
    {       
        $id=[];       
        try{
            DB::beginTransaction(); 
            $ExtraDenunciante = new ExtraDenuncianteMoral();
            $ExtraDenunciante->idPersona = $request->idPersona;        
            $ExtraDenunciante->idAbogado = $request->idAbogado;
            $ExtraDenunciante->resguardarIdentidad = $request->reguardarIdentidad;        
            $ExtraDenunciante->victima = $request->victima;      
            $ExtraDenunciante->save();  
            $id = $ExtraDenunciante->id;
            $idLog=$this->log->saveInLog($request->sistema,$request->usuario,'extra_denunciante_moral','INSERT',$id,null,$ExtraDenunciante);
            DB::commit();
        }catch (Exception $e){
            DB::rollback();
            return response()->json(["ERROR"->$e->getMessage()]);
        }                         
        return response()->json($id);
        
    }

    public function updateExtrasDenuncianteFisico(Request $request)
    {      
        $id=[];       
        try{
            DB::beginTransaction();         
            $ExtraDenunciante = ExtraDenuncianteFisico::find($request->idPersona);  
            $antes=clone $ExtraDenunciante;          
            $ExtraDenunciante->idAbogado= $request->idAbogado;
            $ExtraDenunciante->resguardarIdentidad = $request->reguardarIdentidad;
            $ExtraDenunciante->victima = $request->victima;                
            $ExtraDenunciante->save();     
            $id = $ExtraDenunciante->id;                
            $idLog=$this->log->saveInLog($request->sistema,$request->usuario,'extra_denunciante_fisico','UPDATE',$id,$antes,$ExtraDenunciante);
            DB::commit();
        }catch (Exception $e){
            DB::rollback();
            return response()->json(["ERROR"->$e->getMessage()]);
        }                     
        return response()->json($id); 

    }

    public function updateExtrasDenuncianteMoral(Request $request)
    {   
        $id=[];       
        try{
            DB::beginTransaction();       
            $ExtraDenunciante = ExtraDenuncianteMoral::find($request->idPersona);  
            $antes=clone $ExtraDenunciante;            
            $ExtraDenunciante->idAbogado= $request->idAbogado;
            $ExtraDenunciante->resguardarIdentidad = $request->reguardarIdentidad;
            $ExtraDenunciante->victima = $request->victima;                
            $ExtraDenunciante->save();     
            $id = $ExtraDenunciante->id; 
            $idLog=$this->log->saveInLog($request->sistema,$request->usuario,'extra_denunciante_moral','UPDATE',$id,$antes,$ExtraDenunciante);
            DB::commit();
        }catch (Exception $e){
            DB::rollback();
            return response()->json(["ERROR"->$e->getMessage()]);
        }                                   
        return response()->json($id); 

    }
}
