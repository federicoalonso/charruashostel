<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoriaRequest;

class CategoriaController extends Controller
{
    public function index(){
        return Categoria::latest()->paginate();
    }

    public function store(StoreCategoriaRequest $request){

        $categoria = Categoria::create([
            'nombre' => request('nombre'),
            'user_id' => auth()->id()
        ]);

        return response()->json([
            'nombre' => $categoria->nombre,
            'user_id' => $categoria->user_id
        ]);
    }
}
