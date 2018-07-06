<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Models\Familiar;

class FamiliarController extends Controller
{
    public function getInvolucrados(Request $request){		

		$involucrados1 = DB::table('extra_denunciado_fisico')
            ->join('variables_persona_fisica', 'variables_persona_fisica.id', '=', 'extra_denunciado_fisico.idVariablesPersona')
			->join('persona_fisica', 'persona_fisica.id', '=', 'variables_persona_fisica.idPersona')
			->join('apariciones', 'apariciones.idVarPersona', '=', 'variables_persona_fisica.id')
            ->select('persona_fisica.id', 'persona_fisica.nombres', 'persona_fisica.primerAp', 'persona_fisica.segundoAp')
			->where('apariciones.idCarpeta', '=', $request->idCarpeta)
			->where('esEmpresa', '=', 0)
			->orderBy('persona_fisica.nombres', 'ASC');
					
		$involucrados = DB::table('extra_denunciante_fisico')
            ->join('variables_persona_fisica', 'variables_persona_fisica.id', '=', 'extra_denunciante_fisico.idVariablesPersona')
			->join('persona_fisica', 'persona_fisica.id', '=', 'variables_persona_fisica.idPersona')
			->join('apariciones', 'apariciones.idVarPersona', '=', 'variables_persona_fisica.id')
            ->select('persona_fisica.id', 'persona_fisica.nombres', 'persona_fisica.primerAp', 'persona_fisica.segundoAp')
			->where('apariciones.idCarpeta', '=', $request->idCarpeta)
			->where('esEmpresa', '=', 0)
            ->orderBy('persona_fisica.nombres', 'ASC')
            ->union($involucrados1)
			->get(); 
				
		if($involucrados){
			return response()->json($involucrados);						
		}else{
			return false;
		}
		
			
    }
    
    public function saveFamiliar(Request $request){
        $familiar= new Familiar();
        $familiar->idPersona=$request->idPersona;
        $familiar->nombres=$request->nombres;
        $familiar->primerAp=$request->primerAp;
        $familiar->segundoAp=$request->segundoAp;
        $familiar->parentesco=$request->parentesco;
        $familiar->idOcupacion=$request->idOcupacion;      
        $familiar->save();
        return $familiar->id;
	}
}
