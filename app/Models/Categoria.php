<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $guarded = [];

    public function setNombreAttribute($nombre)
    {
        $this->attributes['nombre'] = ucfirst(mb_strtolower($nombre, 'UTF-8'));
    }
}
