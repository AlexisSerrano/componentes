<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class PersonaMoralModel extends Model
{
    protected $table='persona_moral';

    protected $fillable=[
        'id',
        'nombre',
        'fechaCreacion',
        'rfc'
    ];   
}
