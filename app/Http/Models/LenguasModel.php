<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class LenguasModel extends Model
{
    protected $table = 'cat_lengua';
    protected $fillable = [
        'id', 
        'nombre'
    ];
}
