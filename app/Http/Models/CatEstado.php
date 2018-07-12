<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class CatEstado extends Model
{
    protected $table = 'cat_estado';

    protected $fillable = [
        'id', 
        'nombre', 
        'abreviatura'
    ];

    public function municipios(){
    	return $this->hasMany('App\Models\CatMunicipio');
	}
}
