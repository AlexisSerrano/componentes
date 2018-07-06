<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\VariablesPersona;
use App\Http\Models\VariablesPersonaMoral;
use App\Http\Models\CatEstado;
use App\Http\Models\CatMunicipio;
use App\Http\Models\CatLocalidad;
use App\Http\Models\CatColonia;
use App\Http\Models\Domicilio;
use App\Http\Models\Notificacion;
use App\Http\Models\Trabajo;
use App\Http\Requests\DomicilioRequest;
use DB;

class DomicilioController extends Controller
{

	public function index(){
        return view("domicilio");
	}

    public function addDomicilio(Request $request){
        if($request->empresa){
            if($request->tipo=='domicilio'){
                if($request->claveDomicilio==""){
                    $idDomicilio = DomicilioController::domicilios($request,false);
                    $varPersona = VariablesPersonaMoral::find($request->idPersona);
                    $varPersona->idDomicilio = $idDomicilio;
                    $varPersona->save();
                    return $idDomicilio;
                }
                else{
                    $idDomicilio = DomicilioController::domicilios($request,$request->claveDomicilio);
                    return $idDomicilio;
                }        
            }
            else if($request->tipo=='contacto'){
                //$request->domNotificacion; 1=domcasa 2=otro 3=ultimo domicilio
                if($request->domNotificacion==1){
                    if($request->claveDomicilio==""){
                        $notificacion = DomicilioController::notificaciones($request,false,$request->idDomicilio);
                        $varPersona = VariablesPersonaMoral::find($request->idPersona);
                        $varPersona->idNotificacion = $notificacion->id;
                        $varPersona->save();
                        return $notificacion->id;
                    }
                    else{
                        $notificacion = DomicilioController::notificaciones($request,$request->claveDomicilio,$request->idDomicilio);
                        return $notificacion->id;
                    }
                }
                else if($request->domNotificacion==2){
                    if($request->claveDomicilio==""){
                        $idDomicilio = DomicilioController::domicilios($request,false);
                        $notificacion = DomicilioController::notificaciones($request,false,$idDomicilio);
                        $varPersona = VariablesPersonaMoral::find($request->idPersona);
                        $varPersona->idNotificacion = $notificacion->id;
                        $varPersona->save();
                        return $notificacion->id;
                    }
                    else{
                        if($request->guardadoContacto==2){
                            $notificacion = DomicilioController::notificaciones($request,$request->claveDomicilio,false);
                            $idDomicilio = DomicilioController::domicilios($request,$notificacion->idDomicilio);
                        }
                        else{
                            $idDomicilio = DomicilioController::domicilios($request,false);
                            $notificacion = DomicilioController::notificaciones($request,$request->claveDomicilio,$idDomicilio);
                        }
                        return $notificacion->id;
                    }
                }
                else if($request->domNotificacion==3){
                    if($request->claveDomicilio==""){
                        $noti=Notificacion::where('id',$request->idOldNotificacion)->first();
                        $notificacion = DomicilioController::notificaciones($request,false,$noti->idDomicilio);
                        $varPersona = VariablesPersonaMoral::find($request->idPersona);
                        $varPersona->idNotificacion = $notificacion->id;
                        $varPersona->save();
                        return $notificacion->id;
                    }
                    else{
                        $notificacion = DomicilioController::notificaciones($request,$request->claveDomicilio,false);
                        return $notificacion->id;
                    }
                }
            }
        }
        else{
            if($request->tipo=='domicilio'){
                if($request->claveDomicilio==""){
                    $idDomicilio = DomicilioController::domicilios($request,false);
                    $varPersona = VariablesPersona::find($request->idPersona);
                    $varPersona->idDomicilio = $idDomicilio;
                    $varPersona->save();
                    return $idDomicilio;
                }
                else{
                    $idDomicilio = DomicilioController::domicilios($request,$request->claveDomicilio);
                    return $idDomicilio;
                }
            }
            else if($request->tipo=='trabajo'){
                if($request->claveDomicilio==""){
                    $idDomicilio = DomicilioController::domicilios($request,false);
                    $trabajo = DomicilioController::trabajos($request,false,$idDomicilio);
                    $varPersona = VariablesPersona::find($request->idPersona);
                    $varPersona->idTrabajo = $trabajo->id;
                    $varPersona->save();
                    return $trabajo->id;
                }
                else{
                    $trabajo = DomicilioController::trabajos($request,$request->claveDomicilio,false);
                    $idDomicilio = DomicilioController::domicilios($request,$trabajo->idDomicilio);
                    return $trabajo->id;
                }  
            }
            else if($request->tipo=='contacto'){
                //$request->domNotificacion; 1=domcasa 2=otro 3=ultimo domicilio
                if($request->domNotificacion==1){
                    if($request->claveDomicilio==""){
                        $notificacion = DomicilioController::notificaciones($request,false,$request->idDomicilio);
                        $varPersona = VariablesPersona::find($request->idPersona);
                        $varPersona->idNotificacion = $notificacion->id;
                        $varPersona->save();
                        return $notificacion->id;
                    }
                    else{
                        $notificacion = DomicilioController::notificaciones($request,$request->claveDomicilio,$request->idDomicilio);
                        return $notificacion->id;
                    }
                }
                else if($request->domNotificacion==2){
                    if($request->claveDomicilio==""){
                        $idDomicilio = DomicilioController::domicilios($request,false);
                        $notificacion = DomicilioController::notificaciones($request,false,$idDomicilio);
                        $varPersona = VariablesPersona::find($request->idPersona);
                        $varPersona->idNotificacion = $notificacion->id;
                        $varPersona->save();
                        return $notificacion->id;
                    }
                    else{
                        if($request->guardadoContacto==2){
                            $notificacion = DomicilioController::notificaciones($request,$request->claveDomicilio,false);
                            $idDomicilio = DomicilioController::domicilios($request,$notificacion->idDomicilio);
                        }
                        else{
                            $idDomicilio = DomicilioController::domicilios($request,false);
                            $notificacion = DomicilioController::notificaciones($request,$request->claveDomicilio,$idDomicilio);
                        }
                        return $notificacion->id;
                    }
                }
                else if($request->domNotificacion==3){
                    if($request->claveDomicilio==""){
                        $noti=Notificacion::where('id',$request->idOldNotificacion)->first();
                        $notificacion = DomicilioController::notificaciones($request,false,$noti->idDomicilio);
                        $varPersona = VariablesPersona::find($request->idPersona);
                        $varPersona->idNotificacion = $notificacion->id;
                        $varPersona->save();
                        return $notificacion->id;
                    }
                    else{
                        $notificacion = DomicilioController::notificaciones($request,$request->claveDomicilio,false);
                        return $notificacion->id;
                    }
                }
            }
        }
    }

    public function domicilios(Request $request,$idDomicilio){
        try{
            DB::beginTransaction();
            if($idDomicilio!==FALSE){
                $domicilio=Domicilio::find($idDomicilio);
                $oper="UPDATE";
                $antes= clone $domicilio;
            }else{
                $domicilio=new Domicilio();
                $oper="INSERT";
                $antes=null;
            }
            $domicilio->idEstado=$request->input('estado');
            $domicilio->idMunicipio=$request->input('municipio');
            $domicilio->idLocalidad=$request->input('localidad');
            $domicilio->idColonia=$request->input('colonia');
            $domicilio->calle=$request->input('calle');
            $domicilio->numExterno=$request->input('numExterno');
            if($request->input('numInterno')!=null){
                $domicilio->numInterno=$request->input('numInterno');
            }
            $domicilio->save();
            saveInLog($request->sistema,$request->usuario,'domicilio',$oper,$domicilio->id,$antes,$domicilio);
            DB::commit();
        }catch (Exception $e){
            DB::rollback();
            return response()->json(["ERROR"->$e->getMessage()]);
        }    
        return $domicilio->id;
    }

    public function notificaciones(Request $request,$idNotificacion,$idDomicilio){
        try{
            DB::beginTransaction();
            if($idNotificacion!==FALSE){
                $notificacion=Notificacion::find($idNotificacion);
                $oper="UPDATE";
                $antes= clone $notificacion;
            }else{
                $notificacion=new Notificacion();
                $oper="INSERT";
                $antes=null;
            }
            $notificacion->correo = $request->correoContacto;
            $notificacion->telefono = $request->telefonoContacto;
            if($idDomicilio!==FALSE){
                $notificacion->idDomicilio = $idDomicilio;
            } 
            $notificacion->save();
            saveInLog($request->sistema,$request->usuario,'notificacion',$oper,$notificacion->id,$antes,$notificacion);
            DB::commit();
        }catch (Exception $e){
            DB::rollback();
            return response()->json(["ERROR"->$e->getMessage()]);
        }    
        return $notificacion;
    }

    public function trabajos(Request $request,$idTrabajo,$idDomicilio){
        try{
            DB::beginTransaction();
            if($idTrabajo!==FALSE){
                $trabajo=Trabajo::find($idTrabajo);
                $oper="UPDATE";
                $antes= clone $trabajo;
            }else{
                $trabajo=new Trabajo();
                $oper="INSERT";
                $antes=null;
            }
            $trabajo->lugar = $request->lugarTrabajo;
            $trabajo->telefono = $request->telefonoTrabajo;
            if($idDomicilio!==FALSE){
                $trabajo->idDomicilio = $idDomicilio;
            } 
            $trabajo->save();
            saveInLog($request->sistema,$request->usuario,'trabajo',$oper,$trabajo->id,$antes,$trabajo);
            DB::commit();
        }catch (Exception $e){
            DB::rollback();
            return response()->json(["ERROR"->$e->getMessage()]);
        }   
        return $trabajo;
    }

    public function getEstados(){
        $estados=CatEstado::orderBy('nombre', 'ASC')
	    ->select('nombre','id')->get();
        return response()->json($estados);
    }
    public function getMunicipios($id){
        if($id==null){
            return array();
        }
        else{
            $municipios=CatMunicipio::orderBy('nombre', 'ASC')
            ->where('idEstado',$id)
            ->select('nombre','id')->get();
            return response()->json($municipios);
        }
    }
    public function getLocalidades($id){
        if($id==null){
            return array();
        }
        else{
            $localidades=CatLocalidad::orderBy('nombre', 'ASC')
            ->where('idMunicipio',$id)
            ->select('nombre','id')->get();
            return response()->json($localidades);
        }
    }
    public function getCodigosPostales($id){
        if($id==null){
            return array();
        }
        else{
            $codigosPostales=CatColonia::orderBy('codigoPostal', 'ASC')
            ->where('idMunicipio',$id)
            ->where('codigoPostal', '!=', 0)
            ->select('codigoPostal','codigoPostal as id')
            ->groupBy('codigoPostal')
            ->get();
            return response()->json($codigosPostales);
        }
    }
    public function getColonias($id){
        if($id==null){
            return array();
        }
        else{
            $colonias=CatColonia::orderBy('nombre', 'ASC')
            ->where('codigoPostal',$id)
            ->select('nombre','id')->get();
            return response()->json($colonias);
        }
    }
}
