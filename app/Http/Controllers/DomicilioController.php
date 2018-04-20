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
       public function mostrarEstados(Request $request){
        $nombre=$request->input('q');
        $formatted['results']=[];
        foreach(CatEstado::where('nombre','LIKE','%'.$nombre.'%')->get() as $estado){
            $formatted['results'][] = ['id' => $estado->id, 'text' => $estado->nombre];
        }
        return \Response::json($formatted);
    }
    public function mostrarMunicipios(Request $request){
        $id=$request->input('q');
        $nombre=$request->input('q2');
        $formatted['results']=[];
        foreach(CatMunicipio::where('idEstado',$id)->where('nombre','like','%'.$nombre.'%')->get() as $municipio){
            $formatted['results'][] = ['id' => $municipio->id, 'text' => $municipio->nombre];
        }
        return \Response::json($formatted);
    }
        public function mostrarLocalidades(Request $request){
        $id=$request->input('q');
        $nombre=$request->input('q2');
        $formatted['results']=[];
        foreach(CatLocalidad::where('idMunicipio',$id)->where('nombre','like','%'.$nombre.'%')->get() as $localidad){
            $formatted['results'][] = ['id' => $localidad->id, 'text' => $localidad->nombre];
        }
        return \Response::json($formatted);
    }
        public function mostrarCodigoPostal(Request $request){
            $id=$request->input('q');
            $nombre=$request->input('q2');
            $formatted['results']=[];
            foreach (CatColonia::where('idMunicipio',$id)->where('codigoPostal','like','%'.$nombre.'%')->get() as $cpostal){
                $formatted['results'][] = ['id' => $cpostal->codigoPostal, 'text' => $cpostal->codigoPostal];
            }
            return \Response::json($formatted);
        }
        
        public function mostrarColonias(Request $request){
        $id=$request->input('q');
        $nombre=$request->input('q2');
        $formatted['results']=[];
        foreach(CatColonia::where('codigoPostal',$id)->where('nombre','like','%'.$nombre.'%')->get() as $colonia){
            $formatted['results'][] = ['id' => $colonia->id, 'text' => $colonia->nombre];
        }
        return \Response::json($formatted);
    }
     public function guardarDomicilio(Request $request){
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
}
