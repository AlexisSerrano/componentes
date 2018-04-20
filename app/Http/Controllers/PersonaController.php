<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\SexoModel;
use App\Http\Models\PersonaModel;
use App\Http\Models\NacionalidadesModel;
use App\Http\Models\EtniaModel;
use App\Http\Models\LenguasModel;
use App\Http\Models\CatMunicipio;
use App\Http\Models\OcupacionModel;
use App\Http\Models\EstadoCivilModel;
use App\Http\Models\EscolaridadModel;
use App\Http\Models\ReligionModel;

class PersonaController extends Controller
{
 
	public function guardarPersona(Request $request){

		$persona=new PersonaModel();		
		$persona->nombres=$request->input('nombres');		
		$persona->primerAp=$request->input('primerAp');
		$persona->segundoAp=$request->input('segundoAp');
		$persona->fechaNacimiento=$request->input('fechaNacimiento');
		$persona->rfc=$request->input('rfc');
		$persona->curp=$request->input('curp');
		$persona->sexo=$request->input('sexos');
		$persona->idNacionalidad=$request->input('idNacionalidad');
		$persona->idEtnia=$request->input('idEtnia');
		$persona->idLengua=$request->input('idLengua');
		$persona->idMunicipioOrigen=$request->input('idMunicipioOrigen');
		$persona->esEmpresa=$request->input('esEmpresa');
		$persona->save();
		return $persona;
	}

	public function sexos(Request $request){
		$nombre=$request->input('q');
		$formatted['results']=[];
		foreach(SexoModel::where('nombre','LIKE','%'.$nombre.'%')->get() as $sexo){
			$formatted['results'][] = ['id' => $sexo->id, 'text' => $sexo->nombre];
		} 
		return \Response::json($formatted);
	}

	public function nacionalidad(Request $request){


		$nombre=$request->input('q');
		$formatted['results']=[];
		foreach (NacionalidadesModel::where('nombre','LIKE','%'.$nombre.'%')->get() as  $nacion){
			$formatted['results'][]=['id'=> $nacion->id,'text'=>$nacion->nombre];  
		}

		return \Response::json($formatted);
	}

	public function etnias(Request $request){

		$nombre=$request->input('q');
		$formatted['results']=[];
		foreach(EtniaModel::where('nombre','LIKE','%'.$nombre.'%')->get() as $etnia){

			$formatted['results'][]=['id'=>$etnia->id,'text'=>$etnia->nombre];
		}

		return \Response::json($formatted);
	}

	public function lenguas(Request $request){		
		$nombre=$request->input('q');
		$formatted['results']=[];
		foreach(LenguasModel::where('nombre','LIKE','%'.$nombre.'%')->get()as $lengua){
			$formatted['results'][]=['id'=>$lengua->id,'text'=>$lengua->nombre];
		}

		return \Response::json($formatted);
	}

	public function municipios(Request $request){		
		$nombre=$request->input('q');
		$formatted['results']=[];
		foreach(CatMunicipio::where('nombre','LIKE','%'.$nombre.'%')->get()as $lengua){
			$formatted['results'][]=['id'=>$lengua->id,'text'=>$lengua->nombre];
		}

		return \Response::json($formatted);		
	}

	public function _guardar(Request $request){
		$persona=new PersonaModel();
		$persona->nombre=$request->input('nombre');
		$persona->apellidoPaterno=$request->input('apellidoPaterno');
		$persona->apellidoMaterno=$request->input('apellidoMaterno');
		$persona->sexo=$request->input('sexo');
		Models::CleanSave($persona,$request->input('requires'));
		return $persona;
   }

   public function ocupacion(Request $request){
   		$nombre=$request->input('q');
		$formatted['results']=[];
		foreach(OcupacionModel::where('nombre','LIKE','%'.$nombre.'%')->get()as $ocupacion){
			$formatted['results'][]=['id'=>$ocupacion->id,'text'=>$ocupacion->nombre];
		}

		return \Response::json($formatted);		

   }


    public function estadoCivil(Request $request){
   		$nombre=$request->input('q');
		$formatted['results']=[];
		foreach(EstadoCivilModel::where('nombre','LIKE','%'.$nombre.'%')->get()as $edoCivil){
			$formatted['results'][]=['id'=>$edoCivil->id,'text'=>$edoCivil->nombre];
		}

		return \Response::json($formatted);		

   }

    public function escolaridad(Request $request){
   		$nombre=$request->input('q');
		$formatted['results']=[];
		foreach(EscolaridadModel::where('nombre','LIKE','%'.$nombre.'%')->get()as $escolaridad){
			$formatted['results'][]=['id'=>$escolaridad->id,'text'=>$escolaridad->nombre];
		}

		return \Response::json($formatted);		

   }

    public function religiones(Request $request){
   		$nombre=$request->input('q');
		$formatted['results']=[];
		foreach(ReligionModel::where('nombre','LIKE','%'.$nombre.'%')->get()as $religion){
			$formatted['results'][]=['id'=>$religion->id,'text'=>$religion->nombre];
		}

		return \Response::json($formatted);

   }

}