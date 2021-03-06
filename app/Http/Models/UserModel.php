<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class UserModel extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'api_token',
        'activo'
    ];
}
