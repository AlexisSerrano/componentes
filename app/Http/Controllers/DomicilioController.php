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
use App\Http\Requests\DomicilioRequest;

class DomicilioController extends Controller
{
	public function index(){
        return view("domicilio");
	}

    public function addDomicilio(Request $request){
        // $request->tipo; //domicilio, trabajo o contacto
        // $request->empresa; //true o false, fisica o moral
        // $request->idPersona; // a quien se le asigna este domicilio

        // $request->telefonoTrabajo; //datos de domicilio trabajo
        // $request->lugarTrabajo; //datos de domicilio trabajo

        // $request->telefonoContacto; //datos de domicilio contacto
        // $request->correoContacto; //datos de domicilio contacto
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
            }
            else if($request->tipo=='contacto'){
                $varPersona = VariablesPersonaMoral::find($request->idPersona);
                $varPersona->idNotificacion = $domicilio->id;
                $varPersona->save();
                //echo "empresa contacto";
            }
        }
        else{
            if($request->tipo=='domicilio'){
                $varPersona = VariablesPersona::find($request->idPersona);
                $varPersona->idDomicilio = $domicilio->id;
                $varPersona->save();
            }
            else if($request->tipo=='trabajo'){
                echo "persona trabajo";
            }
            else if($request->tipo=='contacto'){
                echo "persona contacto";
            }
        }
        //return $domicilio->id;
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
