<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    public $table = 'trabajo';
    
    public $fillable = [
        'id',
        'idDomicilio',
        'lugar',
        'telefono'
    ];
}
