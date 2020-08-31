<?php

namespace Tests\Unit\Http\Resources;

use Tests\TestCase;
use App\Models\Categoria;
use App\Http\Resources\CategoriaResource;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoriasRosourceTest extends TestCase
{
    use RefreshDatabase;

    /**  @test */
    public function una_categoria_resource_debe_tener_los_campos_necesarios()
    {
        $this->withoutExceptionHandling();
        $categoria = factory(Categoria::class)->create();

        $categoriaResource = CategoriaResource::make($categoria)->resolve();

        $this->assertEquals($categoria->nombre, $categoriaResource['nombre']);
        $this->assertEquals($categoria->id, $categoriaResource['id']);
        $this->assertEquals($categoria->user->name, $categoriaResource['autor']);
    }
}
