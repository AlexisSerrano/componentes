<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class VariablesPersonaMoral extends Model
{
    public $table = 'variables_persona_moral';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    public $fillable = [
        'id',
        'idPersona',
        'telefono',
        'idDomicilio',
        'representanteLegal'
    ];    
}
