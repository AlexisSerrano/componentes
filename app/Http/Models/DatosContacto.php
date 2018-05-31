<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class DatosContacto extends Model
{
    protected $table = 'datos_contacto';
    
    protected $filliable = [
        'idPersona','iddatostipo','valor','habilitado'
    ];
}
