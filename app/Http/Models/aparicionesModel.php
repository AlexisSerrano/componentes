<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class aparicionesModel extends Model
{
    //
    protected $table='apariciones';
    protected $fillable = [
        'id', 'idvar_persona', 'id_carpeta','id_sistema','id_involucrado','fecha_creacion','nuc','confirmado','esEmpresa'
    ];
}
