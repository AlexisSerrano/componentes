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
                if($request->claveDomicilio==""){
                    $idDomicilio = DomicilioController::domicilios($request,false);
                    $notificacion = DomicilioController::notificaciones($request,false,$idDomicilio);   
                    $varPersona = VariablesPersonaMoral::find($request->idPersona);
                    $varPersona->idNotificacion = $notificacion->id;
                    $varPersona->save();
                    return $notificacion->id;
                }
                else{
                    $notificacion = DomicilioController::notificaciones($request,$request->claveDomicilio,false);
                    $idDomicilio = DomicilioController::domicilios($request,$notificacion->idDomicilio);
                    return $notificacion->id;
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
                    return $idDomicilio;
                }  
            }
            else if($request->tipo=='contacto'){
                if($request->claveDomicilio==""){
                    $idDomicilio = DomicilioController::domicilios($request,false);
                    $notificacion = DomicilioController::notificaciones($request,false,$idDomicilio);
                    $varPersona = VariablesPersona::find($request->idPersona);
                    $varPersona->idNotificacion = $notificacion->id;
                    $varPersona->save();
                    return $notificacion->id;
                }
                else{
                    $notificacion = DomicilioController::notificaciones($request,$request->claveDomicilio,false);
                    $idDomicilio = DomicilioController::domicilios($request,$notificacion->idDomicilio);
                    return $idDomicilio;
                }
            }
        }
    }

    public function domicilios(Request $request,$idDomicilio){
        $domicilio = ($idDomicilio!==FALSE)?Domicilio::find($idDomicilio):new Domicilio();
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
        return $domicilio->id;
    }

    public function notificaciones(Request $request,$idNotificacion,$idDomicilio){
        $notificacion = ($idNotificacion!==FALSE)?Notificacion::find($idNotificacion):new Notificacion();
        $notificacion->correo = $request->correoContacto;
        $notificacion->telefono = $request->telefonoContacto;
        if($idDomicilio!==FALSE){
            $notificacion->idDomicilio = $idDomicilio;
        } 
        $notificacion->save();
        return $notificacion;
    }

    public function trabajos(Request $request,$idTrabajo,$idDomicilio){
        $trabajo = ($idTrabajo!==FALSE)?Trabajo::find($idTrabajo):new Trabajo();
        $trabajo->lugar = $request->lugarTrabajo;
        $trabajo->telefono = $request->telefonoTrabajo;
        if($idDomicilio!==FALSE){
            $trabajo->idDomicilio = $idDomicilio;
        } 
        $trabajo->save();
        return $trabajo;
    }

    public function getEstados(){
        $estados=CatEstado::orderBy('nombre', 'ASC')
	    ->select('nombre','id')->get();
        return response()->json($estados);
    }
    public function getMunicipios($id){
        $municipios=CatMunicipio::orderBy('nombre', 'ASC')
        ->where('idEstado',$id)
	    ->select('nombre','id')->get();
        return response()->json($municipios);
    }
    public function getLocalidades($id){
        $localidades=CatLocalidad::orderBy('nombre', 'ASC')
        ->where('idMunicipio',$id)
	    ->select('nombre','id')->get();
        return response()->json($localidades);
    }
    public function getCodigosPostales($id){
        $codigosPostales=CatColonia::orderBy('codigoPostal', 'ASC')
        ->where('idMunicipio',$id)
        ->where('codigoPostal', '!=', 0)
        ->select('codigoPostal','codigoPostal as id')
        ->groupBy('codigoPostal')
        ->get();
        return response()->json($codigosPostales);
    }
    public function getColonias($id){
        $colonias=CatColonia::orderBy('nombre', 'ASC')
        ->where('codigoPostal',$id)
	    ->select('nombre','id')->get();
        return response()->json($colonias);
    }
}
