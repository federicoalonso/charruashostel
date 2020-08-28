<?php

namespace App\Models;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $guarded = [];

    public function setNombreAttribute($nombre)
    {
        $this->attributes['nombre'] = ucfirst(mb_strtolower($nombre, 'UTF-8'));
    }

    /* **************************************************
                            RELACIONES
    ************************************************** */
    /* public function user()
    {
        return $this->belongsTo(User::class);
    } */

    /* **************************************************
                            SCOPES
    ************************************************** */
    public function scopeBuscadosPorNombre($query, $nombre)
    {
        if ($nombre) {
            return $query->where('nombre', 'LIKE', '%' . Str::slug($nombre, '%') . '%');
        }
    }
}
