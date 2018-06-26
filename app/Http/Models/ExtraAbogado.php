<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ExtraAbogado extends Model
{
    public $table = 'extra_abogado';
    
    public $fillable = [
        'id',
        'idVariablesPersona',
        'cedulaProf',
        'sector',
        'correo',
        'tipo'
    ];
}
