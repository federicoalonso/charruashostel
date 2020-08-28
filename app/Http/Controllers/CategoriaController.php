<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoriaRequest;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->search;
        $categorias = DB::table('categorias')
                    ->orderBy($request->column, $request->dir)
                    ->where('nombre', 'LIKE', '%' . $busqueda . '%')
                    ->orWhere(function ($query) use ($busqueda) {
                        if (intval($busqueda) > 0) {
                            $query->where('id', 'LIKE', '%' . $busqueda . '%');
                        }
                    })
                    ->paginate($request->length);
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
            'user_id' => $categoria->user_id
        ]);
    }
}
