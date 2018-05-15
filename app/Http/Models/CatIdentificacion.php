<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class CatIdentificacion extends Model
{
    protected $table = 'cat_identificacion';

    protected $fillable = [
        'id', 'documento',
    ];

    public function personas(){
        return $this->hasMany('App\Models\Persona');
    }
}
