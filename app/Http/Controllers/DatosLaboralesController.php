<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\CatEstado;
use App\Http\Models\CatMunicipio;
use App\Http\Models\CatLocalidad;
use App\Http\Models\CatColonia;
use App\Http\Models\DatosLaborales;
use App\Http\Requests\DatosLaboralesRequest;

class DatosLaboralesController extends Controller
{
	public function index(){
        return view("datosLaborales");
	}

     public function addDatosLaborales(DatosLaboralesRequest $request){
        $datosLaborales=new DatosLaborales();
        $datosLaborales->idMunicipio=$request->input('municipio');
        $datosLaborales->idLocalidad=$request->input('localidad');
        $datosLaborales->idColonia=$request->input('colonia');
        $datosLaborales->calle=$request->input('calle');
        $datosLaborales->numExterno=$request->input('numExterno');
        if($request->input('numInterno')!=null){
        $datosLaborales->numInterno=$request->input('numInterno');
        }
        $datosLaborales->telefono=$request->input('telefono');
        $datosLaborales->telefonoTrabajo=$request->input('telefonoTrabajo');
        $datosLaborales->lugarTrabajo=$request->input('lugarTrabajo');
        $datosLaborales->save();
        return $datosLaborales->id;
    }
}
