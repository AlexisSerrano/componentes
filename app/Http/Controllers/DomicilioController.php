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
		// $estados=catEstado::orderBy('nombre', 'ASC')
		// ->select('nombre','id')->get();
		// $municipios=catMunicipio::orderBy('nombre','ASC')
		// ->select('nombre','id')->get();
		// $localidades=catLocalidad::orderBy('nombre','ASC')
		// ->select('nombre','id')->get();
		// $colonias=catColonia::orderBy('nombre','ASC')
        // ->select('nombre','id')->get();
        // $codigosPostales=catColonia::orderBy('nombre','ASC')
		// ->select('codigoPostal','id')->get();
		// return view("domicilio",compact("estados","municipios","localidades","colonias","codigosPostales"));
		return view("domicilio");
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

    public function getEstados()
    {
        $estados = CatEstado::all();
        $data = [];
        $data[0] = [
            'id'   => 0,
            'text' =>'Seleccione un estado',
        ];
        foreach ($estados as $key => $value) {
            $data[$key+1] =[
                'id'   => $value->id,
                'text' => $value->nombre,
            ];
            # code...
        }
        return response()->json($data);
    }
    public function getMunicipios($id)
    {
        $municipios = CatMunicipio::where('idEstado',$id)->get();
        $data = [];
        $data[0] = [
            'id'   => 0,
            'text' =>'Seleccione un municipio',
        ];
        foreach ($municipios as $key => $value) {
           $data[$key+1] =[
                'id'   => $value->id,
                'text' => $value->nombre,
            ];
        }
        return response()->json($data);
    }
    public function getLocalidades($id)
    {
        $localidades = CatLocalidad::where('idMunicipio',$id)->get();
        $data = [];
        $data[0] = [
            'id'   => 0,
            'text' =>'Seleccione una localidad',
        ];
        foreach ($localidades as $key => $value) {
           $data[$key+1] =[
                'id'   => $value->id,
                'text' => $value->nombre,
            ];
        }
        return response()->json($data);
    }
    public function getCodigosPostales($id)
    {
        $codigosPostales = CatColonia::where('idMunicipio',$id)
        ->where('codigoPostal','!=',0)
        // ->orderBy('codigoPostal','asc')
        // ->groupBy('codigoPostal')
        ->get();
        $data = [];
        $data[0] = [
            'id'   => 0,
            'text' =>'Seleccione un codigo postal',
        ];
        foreach ($codigosPostales as $key => $value) {
           $data[$key+1] =[
                'id'   => $value->codigoPostal,
                'text' => $value->codigoPostal,
            ];
        }
        return response()->json($data);
    }
    public function getColonias($id)
    {
        $colonias = CatColonia::where('codigoPostal',$id)->get();
        $data = [];
        $data[0] = [
            'id'   => 0,
            'text' =>'Seleccione una colonia',
        ];
        foreach ($colonias as $key => $value) {
           $data[$key+1] =[
                'id'   => $value->id,
                'text' => $value->nombre,
            ];
        }
        return response()->json($data);
    }
    // public function getEstados(){
	// 	$estados=CatEstado::orderBy('nombre', 'ASC')
	// 	->select('nombre','id')->get();
	// 	return $estados;
	// }
	// public function getMunicipios(){
	// 	$municipios=CatMunicipio::orderBy('nombre','ASC')
	// 	->select('nombre','id')->get();
	// 	return $municipios;
	// }
	// public function getLocalidades(){
	// 	$localidades=CatLocalidad::orderBy('nombre','ASC')
	// 	->select('nombre','id')->get();
	// 	return $localidades;
	// }
	// public function getColonias(){
	// 	$colonias=CatColonia::orderBy('nombre','ASC')
	// 	->select('nombre','id')->get();
	// 	return $colonias;
    // }
    // public function getCodigosPostales(){
	// 	$codigosPostales=CatColonia::orderBy('nombre','ASC')
	// 	->select('codigoPostal','id')->get();
	// 	return $codigosPostales;
	// }
}
