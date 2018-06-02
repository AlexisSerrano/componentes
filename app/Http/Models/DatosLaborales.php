<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class DatosLaborales extends Model
{
    protected $table = 'datos_laborales';

    protected $fillable = [
        'id','idvar_persona','idMunicipio', 'idLocalidad', 'idColonia',  'calle', 'numExterno',  'numInterno','telefono','telefonoTrabajo','LugarTrabajo'
    ];
}
