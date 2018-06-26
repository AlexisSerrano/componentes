<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDeterminacion extends Model
{
    public $table = 'cat_tipo_determinacion';
    
    public $fillable = [
        'id',
        'nombre'
    ];
}
