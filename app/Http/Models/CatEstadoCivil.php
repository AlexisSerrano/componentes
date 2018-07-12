<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CatEstadoCivil extends Model
{
    protected $table = 'cat_estado_civil';

    protected $fillable = [
        'id', 
        'nombre'
    ];

    public function variablesPersonas()
    {
        return $this->hasMany('App\Models\VariablesPersona');
    }
}
