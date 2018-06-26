<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App;


class ExtraDenuncianteMoral extends Model
{
    public $table = 'extra_denunciante_moral';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    public $fillable = [
        'id',
        'idVariablesPersona',
        'idAbogado',
        'reguardarIdentidad',        
        'victima'
    ];
}