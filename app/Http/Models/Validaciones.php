<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Validaciones extends Model
{
    public $table = 'validaciones';
    public $fillable = [
        'id',
        'sistema',
        'tipo',
        'validaciones'
    ];
}
