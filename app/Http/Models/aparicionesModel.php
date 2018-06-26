<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class AparicionesModel extends Model
{
    //
    protected $table='apariciones';
    
    protected $fillable = [
        'id', 
        'idVarPersona', 
        'idCarpeta',
        'sistema',
        'tipoInvolucrado',
        'nuc',
        'esEmpresa', 
        'idTipoDeterminacion'
    ];
}
