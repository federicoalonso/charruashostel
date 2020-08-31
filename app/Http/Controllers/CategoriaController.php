<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Resources\CategoriaResource;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        ($request->search) ? : $request->search = '';
        ($request->dir) ? : $request->dir = 'desc';
        ($request->column) ? : $request->column = 'id';
        ($request->length) ? : $request->length = '10';

        $categorias = Categoria::filtrados($request);

        return $categorias;
    }

    public function store(StoreCategoriaRequest $request)
    {

        $categoria = Categoria::create([
            'nombre' => request('nombre'),
            'user_id' => auth()->id()
        ]);

        return response()->json([
            'nombre' => $categoria->nombre,
            'user_id' => $categoria->user_id,/* 
            'autor_cat' => $categoria->autor_cat, */
        ]);
    }

    public function update(StoreCategoriaRequest $request, Categoria $categoria){
        $categoria->nombre = $request->nombre;
        $categoria->save();

        return response()->json([
            'nombre' => $categoria->nombre,
        ]);
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return;
    }
}
