<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Models\CatEstado;
use App\Http\Models\CatMunicipio;
use App\Http\Models\CatLocalidad;
use App\Http\Models\CatColonia;
use App\Http\Models\Domicilio;

class DomicilioController extends Controller
{
	public function index(){
		$estados=catEstado::orderBy('nombre', 'ASC')
		->select('nombre','id')->get();
		$municipios=catMunicipio::orderBy('nombre','ASC')
		->select('nombre','id')->get();
		$localidades=catLocalidad::orderBy('nombre','ASC')
		->select('nombre','id')->get();
		$colonias=catColonia::orderBy('nombre','ASC')
        ->select('nombre','id')->get();
        $codigosPostales=catColonia::orderBy('nombre','ASC')
		->select('codigoPostal','id')->get();
		return view("domicilio",compact("estados","municipios","localidades","colonias","codigosPostales"));
	}

     public function addDomicilio(Request $request){
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
        return $domicilio;
    }

    public function getEstados(){
		$estados=CatEstado::orderBy('nombre', 'ASC')
		->select('nombre','id')->get();
		return $estados;
	}
	public function getMunicipios(){
		$municipios=CatMunicipio::orderBy('nombre','ASC')
		->select('nombre','id')->get();
		return $municipios;
	}
	public function getLocalidades(){
		$localidades=CatLocalidad::orderBy('nombre','ASC')
		->select('nombre','id')->get();
		return $localidades;
	}
	public function getColonias(){
		$colonias=CatColonia::orderBy('nombre','ASC')
		->select('nombre','id')->get();
		return $colonias;
    }
    public function getCodigosPostales(){
		$codigosPostales=CatColonia::orderBy('nombre','ASC')
		->select('codigoPostal','id')->get();
		return $codigosPostales;
	}
}
