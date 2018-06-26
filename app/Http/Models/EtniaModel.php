<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class EtniaModel extends Model
{
    protected $table = 'cat_etnia';
    protected $fillable = [
        'id', 
        'nombre'
    ];
}
