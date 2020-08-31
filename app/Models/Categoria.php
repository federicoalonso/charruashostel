<?php

namespace App\Models;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categoria extends Model
{
    protected $guarded = [];

    protected $appends = ['autor'];

    public function setNombreAttribute($nombre)
    {
        $this->attributes['nombre'] = ucfirst(mb_strtolower($nombre, 'UTF-8'));
    }

    public function getAutorAttribute(){
        return $this->user->name;
    }
    /* **************************************************
                            RELACIONES
    ************************************************** */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /* **************************************************
                            SCOPES
    ************************************************** */

    public function scopeFiltrados($query, $request){
        $busqueda = $request->search;
        $query = DB::table('categorias')
                    ->orderBy($request->column, $request->dir)
                    ->where(function ($que) use ($busqueda) {
                        if ($busqueda) {
                            $que->where('nombre', 'LIKE', '%' . $busqueda . '%');
                        }
                    })
                    ->orWhere(function ($que) use ($busqueda) {
                        if (intval($busqueda) > 0) {
                            $que->where('id', 'LIKE', '%' . $busqueda . '%');
                        }
                    })
                    ->join('users', 'users.id', '=', 'categorias.user_id')
                    ->select('users.name as autor', 'categorias.*')
                    ->paginate($request->length);
                    
        return $query;
    }
}
