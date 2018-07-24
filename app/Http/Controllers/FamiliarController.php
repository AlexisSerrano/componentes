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
			->where('apariciones.carpeta', '=', $request->carpeta)
			->where('esEmpresa', '=', 0)
			->orderBy('persona_fisica.nombres', 'ASC');
					
		$involucrados = DB::table('extra_denunciante_fisico')
            ->join('variables_persona_fisica', 'variables_persona_fisica.id', '=', 'extra_denunciante_fisico.idVariablesPersona')
			->join('persona_fisica', 'persona_fisica.id', '=', 'variables_persona_fisica.idPersona')
			->join('apariciones', 'apariciones.idVarPersona', '=', 'variables_persona_fisica.id')
            ->select('persona_fisica.id', 'persona_fisica.nombres', 'persona_fisica.primerAp', 'persona_fisica.segundoAp')
			->where('apariciones.carpeta', '=', $request->carpeta)
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
    
    public function addExtrasDenunciante(Request $request){
        try{
            DB::beginTransaction();
            if($request->idExtrasDenunciante!=""){
                $extraDenunciante=($request->empresa)?ExtraDenuncianteMoral::find($request->idExtrasDenunciante):ExtraDenuncianteFisico::find($request->idExtrasDenunciante);
                $oper="UPDATE";
                $antes= clone $extraDenunciante;
                $tipo=($request->empresa)?"extra_denunciante_moral":"extra_denunciante_fisico";
            }else{
                $extraDenunciante=($request->empresa)?new ExtraDenuncianteMoral():new ExtraDenuncianteFisico();
                $oper="INSERT";
                $antes=null;
                $extraDenunciante->idVariablesPersona = $request->idPersona;
                $tipo=($request->empresa)?"extra_denunciante_moral":"extra_denunciante_fisico"; 
            }     
            $extraDenunciante->resguardarIdentidad = $request->reguardarIdentidad;        
            $extraDenunciante->victima = $request->victima;      
            $extraDenunciante->save();

            $apariciones = saveInApariciones($request->sistema,$request->idCarpeta,$request->carpeta,$request->idPersona,$request->tipo,'xxxxx',$request->empresa);

            saveInLog($request->sistema,$request->usuario,'apariciones','INSERT',$apariciones->id,null,$apariciones);
            saveInLog($request->sistema,$request->usuario,$tipo,$oper,$extraDenunciante->id,$antes,$extraDenunciante);
            DB::commit();
            return $extraDenunciante->id;
        }
        catch(Exception $e){
            DB::rollback();
            return false;
        }
    } 
}
