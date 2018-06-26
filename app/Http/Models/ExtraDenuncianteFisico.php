<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App;


class ExtraDenuncianteFisico extends Model
{
    public $table = 'extra_denunciante_fisico';
    
    public $fillable = [
        'id',
        'idVariablesPersona',
        'idAbogado',
        'reguardarIdentidad',
        'victima'
    ];
}
