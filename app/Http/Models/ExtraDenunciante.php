<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App;


class ExtraDenunciante extends Model
{
    public $table = 'extra_denunciante';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    public $fillable = [ 
        'id',
        'idVariablesPersona',
        'idNotificacion',
        'idAbogado',
        'victima',
        'reguardarIdentidad',
        'narracion'
    ];
    
    public function variablesPersona()
    {
       return $this->belongsTo('app/Models/VariablesPersona');
    }

    public function abogado()
    {
       return $this->belongsTo('app/Models/ExtraAbogado');
    }

    public function notificacion()
    {
       return $this->hasOne('app/Models/DirNotificacion');
    }

    // public function acusacion()
    // {
    //    return $this->belongsTo('app/Models/Acusacion');
    // }
}
