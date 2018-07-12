<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    public $table = 'notificacion';
    
    public $fillable = [
        'id',
        'idDomicilio',
        'correo',
        'telefono'
    ];
}
