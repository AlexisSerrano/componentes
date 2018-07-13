<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class VariablesPersonaMoral extends Model
{
    public $table = 'variables_persona_moral';
    
    public $fillable = [
        'id',
        'idPersona',
        'telefono',
        'nombreRep',
        'primerApRep',
        'segundoApRep',
        'docIdentificacion',
        'numDocIdentificacion',
        'idDomicilio',
        'idNotificacion'
    ];    
}
