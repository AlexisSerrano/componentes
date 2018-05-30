<?php
namespace App\Http\Controllers;
use  Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\SexoModel;
use App\Http\Models\PersonaModel;
use App\Http\Models\NacionalidadesModel;
use App\Http\Models\EtniaModel;
use App\Http\Models\LenguasModel;
use App\Http\Models\CatMunicipio;
use App\Http\Models\CatEstado;
use App\Http\Models\CatOcupacion;
use App\Http\Models\CatEstadoCivil;
use App\Http\Models\CatEscolaridad;
use App\Http\Models\CatReligion;
use App\Http\Models\CatIdentificacion;
use App\Http\Models\InterpretesModel;
use App\Http\Models\VariablesPersona;
use RFC\RfcBuilder;

class PersonaController extends Controller{
	public function index(){
		$nacionalidades=NacionalidadesModel::orderBy('nombre', 'ASC')
		->select('nombre','id')->get();
		$municipios=catMunicipio::orderBy('nombre','ASC')
		->select('nombre','id')->get();
		$etnias=EtniaModel::orderBy('nombre','ASC')
		->select('nombre','id')->get();
		$lenguas=LenguasModel::orderBy('nombre','ASC')
		->select('nombre','id')->get();
		$estados=CatEstado::orderBy('nombre','ASC')
		->select('nombre','id')->get();
		return view("persona",compact("nacionalidades","municipios","etnias","lenguas","estados"));
	}

	public function searchPersona(Request $request){
		$persona = $request->rfc;
        $personaExiste=PersonaModel::orderBy('rfc', 'ASC')
		->where('rfc',$persona)
		->orwhere('curp',$persona)
		->select('nombres','primerAp','segundoAp','id','fechaNacimiento','rfc','curp','sexo','idNacionalidad','idEtnia','idLengua','idMunicipioOrigen')->first();
		if($personaExiste){
			$personaExiste2=VariablesPersona::orderBy('id','DESC')
			->where('idPersona',$personaExiste->id)
			->select('edad','telefono','motivoEstancia','idOcupacion','idEstadoCivil','idEscolaridad','idReligion','idDomicilio','docIdentificacion','idInterprete','numDocIdentificacion','lugarTrabajo','idDomicilioTrabajo','telefonoTrabajo','representanteLegal','alias','esEmpresa')->first();
			$nacionalidad=NacionalidadesModel::orderBy('id','Asc')
			->where('id',$personaExiste->idNacionalidad)
			->select('nombre','id')->first();
			$municipio=CatMunicipio::orderBy('id','Asc')
			->where('id',$personaExiste->idMunicipioOrigen)
			->select('nombre','id')->first();
			$etnia=EtniaModel::orderBy('id','Asc')
			->where('id',$personaExiste->idEtnia)
			->select('nombre','id')->first();
			$lengua=LenguasModel::orderBy('id','Asc')
			->where('id',$personaExiste->idLengua)
			->select('nombre','id')->first();
			$estadoCivil=CatEstadoCivil::orderBy('id','Asc')
			->where('id',$personaExiste2->idEstadoCivil)
			->select('nombre','id')->first();
			$escolaridad=CatEscolaridad::orderBy('id','Asc')
			->where('id',$personaExiste2->idEscolaridad)
			->select('nombre','id')->first();
			$religion=CatReligion::orderBy('id','Asc')
			->where('id',$personaExiste2->idReligion)
			->select('nombre','id')->first();
			$ocupacion=CatOcupacion::orderBy('id','Asc')
			->where('id',$personaExiste2->idOcupacion)
			->select('nombre','id')->first();
			$identificacion=CatIdentificacion::orderBy('id','Asc')
			->where('id',$personaExiste2->docIdentificacion)
			->select('documento','id')->first();
			$interprete=InterpretesModel::orderBy('id','Asc')
			->where('id',$personaExiste2->idInterprete)
			->select('nombre','id')->first();
			$sexo=SexoModel::orderBy('id','Asc')
			->where('id',$personaExiste->sexo)
			->select('nombre','id')->first();
			$idEstado=CatMunicipio::orderBy('id','Asc')
			->where('id',$personaExiste->idMunicipioOrigen)
			->select('idEstado')->first();
			$estado=CatEstado::orderBy('id','Asc')
			->where('id',$idEstado->idEstado)
			->select('nombre','id')->first();
			$data = array(
				'nombres'=>$personaExiste->nombres,
				'primerAp'=>$personaExiste->primerAp,
				'segundoAp'=>$personaExiste->segundoAp,
				'id'=>$personaExiste->id,
				'fechaNacimiento'=>$personaExiste->fechaNacimiento,
				'rfc'=>$personaExiste->rfc,
				'curp'=>$personaExiste->curp,
				'sexo'=>$sexo,
				'idNacionalidad'=>$nacionalidad,
				'idEtnia'=>$etnia,
				'idLengua'=>$lengua,
				'idMunicipioOrigen'=>$municipio,
				'idEstado'=>$estado,
				'edad'=>$personaExiste2->edad,
				'telefono'=>$personaExiste2->telefono,
				'motivoEstancia'=>$personaExiste2->motivoEstancia,
				'idOcupacion'=>$ocupacion,
				'idEstadoCivil'=>$estadoCivil,
				'idEscolaridad'=>$escolaridad,
				'idReligion'=>$religion,
				'idDomicilio'=>$personaExiste2->idDomicilio,
				'docIdentificacion'=>$identificacion,
				'idInterprete'=>$interprete,
				'numDocIdentificacion'=>$personaExiste2->numDocIdentificacion,
				'lugarTrabajo'=>$personaExiste2->lugarTrabajo,
				'idDomicilioTrabajo'=>$personaExiste2->idDomicilioTrabajo,
				'telefonoTrabajo'=>$personaExiste2->telefonoTrabajo,
				'alias'=>$personaExiste2->alias,
				'esEmpresa'=>$personaExiste2->esEmpresa
			);
		}
		else{
			$data = array(
			);
		}
		return response()->json($data);
	}

    public function getNacionalidades(){
        $nacionalidades=NacionalidadesModel::orderBy('nombre', 'ASC')
	    ->select('nombre','id')->get();
        return response()->json($nacionalidades);
	}
	public function getEstados(){
        $estados=CatEstado::orderBy('nombre', 'ASC')
	    ->select('nombre','id')->get();
        return response()->json($estados);
    }
	public function getMunicipios($id){
		$municipios=CatMunicipio::orderBy('nombre','ASC')
		->where('idEstado',$id)
		->select('nombre','id')->get();
		return response()->json($municipios);
	}
    public function getEtnias(){
        $etnias=EtniaModel::orderBy('nombre', 'ASC')
	    ->select('nombre','id')->get();
        return response()->json($etnias);
    }
    public function getLenguas(){
        $lenguas=LenguasModel::orderBy('nombre', 'ASC')
	    ->select('nombre','id')->get();
        return response()->json($lenguas);
	}
	public function getPersonas(){
        $personas=PersonaModel::orderBy('nombres', 'ASC')
	    ->select('nombres','id','primerAp','segundoAp','fechaNacimiento','rfc','curp','sexo','idNacionalidad','idEtnia','idLengua','idMunicipioOrigen','esEmpresa')->get();
        return response()->json($personas);
	}
    public function getSexos(){
        $sexos=SexoModel::orderBy('nombre', 'ASC')
	    ->select('nombre','id')->get();
        return response()->json($sexos);
	}
    public function getOcupaciones(){
        $ocupaciones=CatOcupacion::orderBy('nombre', 'ASC')
	    ->select('nombre','id')->get();
        return response()->json($ocupaciones);
	}
    public function getEstadosCiviles(){
        $estadosCiviles=CatEstadoCivil::orderBy('nombre', 'ASC')
	    ->select('nombre','id')->get();
        return response()->json($estadosCiviles);
	}
    public function getEscolaridades(){
        $escolaridades=CatEscolaridad::orderBy('nombre', 'ASC')
	    ->select('nombre','id')->get();
        return response()->json($escolaridades);
	}
    public function getReligiones(){
        $religiones=CatReligion::orderBy('nombre', 'ASC')
	    ->select('nombre','id')->get();
        return response()->json($religiones);
	}
	public function getIdentificaciones(){
        $identificaciones=CatIdentificacion::orderBy('documento', 'ASC')
	    ->select('documento','id')->get();
        return response()->json($identificaciones);
	}
	public function getInterpretes(){
        $interpretes=InterpretesModel::orderBy('nombre', 'ASC')
	    ->select('nombre','id')->get();
        return response()->json($interpretes);
	}
	public function getdctt(){
        DB::table('datos_contacto_tipos_telefono')->orderBy('tipo', 'ASC')
	    ->select('tipo','id')->get();
        return response()->json($interpretes);
	}
	public function getdctr(){
        DB::table('datos_contacto_tipos_red')->orderBy('tipo', 'ASC')
	    ->select('tipo','id')->get();
        return response()->json($interpretes);
	}
	public function getdctc(){
        DB::table('datos_contacto_tipos_correo')->orderBy('tipo', 'ASC')
	    ->select('tipo','id')->get();
        return response()->json($interpretes);
	}
	/* GET METHOD
	public function getValidaciones($id1,$id2,$id3){
		return HelpController::GetJSONDBValidation($id1,$id2,$id3);
	}*/
	public function rfcFisico(Request $request){
		$fecha = $request->fechaNacimiento;
		$partes = explode("-",$fecha);
		$builder = new RfcBuilder();
		$rfc = $builder->name($request->nombres)
			->firstLastName($request->primerAp)
			->secondLastName($request->segundoAp)
			->birthday($partes[2], $partes[1], $partes[0])
			// ->birthday(3, 9, 1984)
			->build()
			->toString();
		return ['res' => $rfc];
	}
}