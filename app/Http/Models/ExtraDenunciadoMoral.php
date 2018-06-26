<?php

<<<<<<< HEAD
namespace App\Http\Models;
=======
namespace App;
>>>>>>> 480252111644392ad97a9ed0c7646e9d22fcc556

use Illuminate\Database\Eloquent\Model;

class ExtraDenunciadoMoral extends Model
{
    protected $table = 'extra_denunciado_moral';

    protected $fillable = [
        'id', 
        'idVariablesPersona', 
        'idPuesto', 
        'alias', 
        'senasPartic', 
        'ingreso', 
        'periodoIngreso', 
        'residenciaAnterior', 
        'idAbogado', 
        'personasBajoSuGuarda', 
        'perseguidoPenalmente', 
        'vestimenta'
    ];
}
