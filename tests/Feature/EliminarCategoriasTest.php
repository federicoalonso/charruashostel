<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EliminarCategoriasTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function un_usuario_autenticado_puede_eliminar_categorias()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $categoria = factory(Categoria::class)->create(['nombre' => 'catrggoso']);

        $this->assertDatabaseHas('categorias', [
            'nombre' => 'Catrggoso',
        ]);

        $respuesta = $this->deleteJson('categorias/' . $categoria->id, $categoria->toArray());

        $this->assertDatabaseMissing('categorias', [
            'nombre' => 'Catrggoso',
        ]);
    }
}
