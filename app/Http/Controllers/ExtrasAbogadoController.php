<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExtrasAbogadoController extends Controller
{
    public function index(){
        return view("extrasAbogado");
    }
}
