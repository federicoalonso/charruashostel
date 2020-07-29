<?php

namespace App\Http\Controllers;

use App\Models\Fallo;
use Illuminate\Http\Request;

class FallosController extends Controller
{
    public function store(){
        Fallo::create([
            'texto' => request('texto'),
            'clase' => request('clase'), 
            'funcion' => request('funcion'),
            'user_id' => request('user_id')
        ]);
    }
}
