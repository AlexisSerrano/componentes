<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

     public function addDomicilio(DomicilioRequest $request){
        $domicilio=new Domicilio();
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
