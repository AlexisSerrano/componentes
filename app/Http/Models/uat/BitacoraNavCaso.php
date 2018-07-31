<?php

namespace App\Http\Models\uat;

use Illuminate\Database\Eloquent\Model;

class BitacoraNavCaso extends Model
{
    protected $connection = 'uat';
    public $table = 'bitacora_navcaso';

    public $fillable = [
        'id',
        'denunciante',
        'denunciado',
        'abogado',
        'autoridad',
        'delitos',
        'acusaciones',
        'defensa',
        'hechos',
        'medidas',
        'idCaso',
        'created_at',
        'updated_at'
    ];
}
