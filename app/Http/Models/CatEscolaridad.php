<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CatEscolaridad extends Model
{
    public $table = 'cat_escolaridad';
    
    public $fillable = [
        'id',
        'nombre'
    ];

    public function variablesPersonas()
    {
       return $this->hasMany('app/Models/VariablesPersona');
    }
}
