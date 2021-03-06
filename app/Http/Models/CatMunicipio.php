<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class CatMunicipio extends Model
{
    public $table = 'cat_municipio';
    
    public $fillable = [
        'id',
        'idMunicipio',
        'idEstado',
        'nombre'
    ];


    public function estado(){
        return $this->belongsTo('App\Models\CatEstado');
    }

    public function domicilios(){
        return $this->hasMany('App\Models\Domicilio');
    }

    public function localidades(){
        return $this->hasMany('App\Models\CatLocalidad');
    }

    public static function municipios($id){
        return CatMunicipio::select('id', 'nombre')->where('idEstado', '=', $id)->orderBy('nombre', 'ASC')->get();
    }
     
       //SELECT * FROM `cat_municipio` ORDER BY `cat_municipio`.`nombre` ASC
    
    
}
