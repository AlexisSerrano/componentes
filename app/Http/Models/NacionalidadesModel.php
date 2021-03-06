<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class NacionalidadesModel extends Model
{
    public $table = 'cat_nacionalidad';
    
    public $fillable = [
        'id',
        'nombre'
    ];

    public function variablesPersonas()
    {
       return $this->hasMany('app/Models/VariablesPersona');
    }
    public function persona()
    {
       return $this->belongsTo('App\Http\Models\PersonaModel','idNacionalidad','id');
    }
}