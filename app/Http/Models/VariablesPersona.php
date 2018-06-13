<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class VariablesPersona extends Model
{
    public $table = 'variables_persona_fisica';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    public $fillable = [
        'id',
        'idPersona',
        'edad',
        'motivoEstancia',
        'idOcupacion',
        'idEstadoCivil',
        'idEscolaridad',
        'idReligion',
        'idDomicilio',
        'docIdentificacion',
        'idInterprete',
        'numDocIdentificacion',
        'idDomicilioTrabajo',
        'alias'
    ];

    public function carpeta()
    {
        return $this->belongsTo('App\Models\Carpeta');
    }

    public function persona()
    {
        return $this->belongsTo('app/Models/Persona');
    }

    public function extraDenunciado()
    {
        return $this->hasOne('app/Models/ExtraDenunciado');
    }

    public function extraDenuncianate()
    {
        return $this->hasOne('app/Models/ExtraDenunciante');
    }

    public function extraAutoridad()
    {
        return $this->hasOne('app/Models/ExtraAutoridad');
    }

    public function extraAbogado()
    {
        return $this->hasOne('app/Models/ExtraAbogado');
    }

    public function ocupacion()
    {
        return $this->belongsTo('app/Models/CatOcupacion');
    }

    public function escolaridad()
    {
        return $this->belongsTo('app/Models/CatOcupacion');
    }

    public function estadoCivil()
    {
        return $this->belongsTo('app/Models/CatEstadoCivil');
    }

    public function religion()
    {
        return $this->belongsTo('app/Models/CatReligion');
    }

    public function domicilio()
    {
        return $this->belongsTo('app/Models/Domicilio');
    }
    public function identificacion()
    {
        return $this->belongsTo('app/Models/catIdentificacion');
    }
    
}
