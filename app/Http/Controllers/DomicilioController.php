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

    // $request->tipo; //domicilio, trabajo o contacto
    // $request->empresa; //true o false, fisica o moral
    // $request->idPersona; // a quien se le asigna este domicilio
    // $request->telefonoTrabajo; //datos de domicilio trabajo
    // $request->lugarTrabajo; //datos de domicilio trabajo
    // $request->telefonoContacto; //datos de domicilio contacto
    // $request->correoContacto; //datos de domicilio contacto
    public function addDomicilio(Request $request){
        $domicilio = new Domicilio();
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
        if($request->empresa){
            if($request->tipo=='domicilio'){
                $varPersona = VariablesPersonaMoral::find($request->idPersona);
                $varPersona->idDomicilio = $domicilio->id;
                $varPersona->save();
                return $domicilio->id;
            }
            else if($request->tipo=='contacto'){
                $notificacion = new Notificacion();
                $notificacion->correo = $request->correoContacto;
                $notificacion->telefono = $request->telefonoContacto;
                $notificacion->idDomicilio = $domicilio->id;
                $notificacion->save();
                
                $varPersona = VariablesPersonaMoral::find($request->idPersona);
                $varPersona->idNotificacion = $notificacion->id;
                $varPersona->save();
                return $notificacion->id;
            }
        }
        else{
            if($request->tipo=='domicilio'){
                $varPersona = VariablesPersona::find($request->idPersona);
                $varPersona->idDomicilio = $domicilio->id;
                $varPersona->save();
                return $domicilio->id;
            }
            else if($request->tipo=='trabajo'){
                $trabajo = new Trabajo();
                $trabajo->lugar = $request->lugarTrabajo;
                $trabajo->telefono = $request->telefonoTrabajo;
                $trabajo->idDomicilio = $domicilio->id;
                $trabajo->save();
                
                $varPersona = VariablesPersona::find($request->idPersona);
                $varPersona->idTrabajo = $trabajo->id;
                $varPersona->save();
                return $trabajo->id;
            }
            else if($request->tipo=='contacto'){
                $notificacion = new Notificacion();
                $notificacion->correo = $request->correoContacto;
                $notificacion->telefono = $request->telefonoContacto;
                $notificacion->idDomicilio = $domicilio->id;
                $notificacion->save();
                
                $varPersona = VariablesPersona::find($request->idPersona);
                $varPersona->idNotificacion = $notificacion->id;
                $varPersona->save();
                return $notificacion->id;
            }
        }
    }

    public function updateDomicilio(Request $request){
        if($request->empresa){
            if($request->tipo=='domicilio'){
                if($request->claveDomicilio!=""){
                    $domicilio = Domicilio::find($request->claveDomicilio);
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
                else{
                    $domicilio = new Domicilio();
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

                    $varPersona = VariablesPersonaMoral::find($request->idPersona);
                    $varPersona->idDomicilio = $domicilio->id;
                    $varPersona->save();
                    return $domicilio->id;
                }
            }
            else if($request->tipo=='contacto'){
                $domicilio = new Domicilio();
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

                $notificacion = new Notificacion();
                $notificacion->correo = $request->correoContacto;
                $notificacion->telefono = $request->telefonoContacto;
                $notificacion->idDomicilio = $domicilio->id;
                $notificacion->save();
                
                $varPersona = VariablesPersonaMoral::find($request->idPersona);
                $varPersona->idNotificacion = $notificacion->id;
                $varPersona->save();
                return $notificacion->id;
            }
        }
        else{
            if($request->tipo=='domicilio'){
                $domicilio = new Domicilio();
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

                $varPersona = VariablesPersona::find($request->idPersona);
                $varPersona->idDomicilio = $domicilio->id;
                $varPersona->save();
                return $domicilio->id;
            }
            else if($request->tipo=='trabajo'){
                $domicilio = new Domicilio();
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

                $trabajo = new Trabajo();
                $trabajo->lugar = $request->lugarTrabajo;
                $trabajo->telefono = $request->telefonoTrabajo;
                $trabajo->idDomicilio = $domicilio->id;
                $trabajo->save();
                
                $varPersona = VariablesPersona::find($request->idPersona);
                $varPersona->idTrabajo = $trabajo->id;
                $varPersona->save();
                return $trabajo->id;
            }
            else if($request->tipo=='contacto'){
                $domicilio = new Domicilio();
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

                $notificacion = new Notificacion();
                $notificacion->correo = $request->correoContacto;
                $notificacion->telefono = $request->telefonoContacto;
                $notificacion->idDomicilio = $domicilio->id;
                $notificacion->save();
                
                $varPersona = VariablesPersona::find($request->idPersona);
                $varPersona->idNotificacion = $notificacion->id;
                $varPersona->save();
                return $notificacion->id;
            }
        }
    }

    public function getEstados()
    {
        $estados=CatEstado::orderBy('nombre', 'ASC')
	    ->select('nombre','id')->get();
        return response()->json($estados);
    }
    public function getMunicipios($id)
    {
        $municipios=CatMunicipio::orderBy('nombre', 'ASC')
        ->where('idEstado',$id)
	    ->select('nombre','id')->get();
        return response()->json($municipios);
    }
    public function getLocalidades($id)
    {
        $localidades=CatLocalidad::orderBy('nombre', 'ASC')
        ->where('idMunicipio',$id)
	    ->select('nombre','id')->get();
        return response()->json($localidades);
    }
    public function getCodigosPostales($id)
    {
        $codigosPostales=CatColonia::orderBy('codigoPostal', 'ASC')
        ->where('idMunicipio',$id)
        ->where('codigoPostal', '!=', 0)
        ->select('codigoPostal','codigoPostal as id')
        ->groupBy('codigoPostal')
        ->get();
        return response()->json($codigosPostales);
    }
    public function getColonias($id)
    {
        $colonias=CatColonia::orderBy('nombre', 'ASC')
        ->where('codigoPostal',$id)
	    ->select('nombre','id')->get();
        return response()->json($colonias);
    }
}
