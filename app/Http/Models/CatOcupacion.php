<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class CatOcupacion extends Model
{
    public $table = 'cat_ocupacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    public $fillable = [
        'id',
        'nombre'
    ];

    public function variablesPersonas()
    {
       return $this->hasMany('app/Models/VariablesPersona');
    }
}
