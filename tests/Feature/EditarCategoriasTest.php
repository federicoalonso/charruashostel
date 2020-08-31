<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditarCategoriasTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUnUsuarioAutenticadoPuedeEditarCategorias()
    {
        $this->withoutExceptionHandling();

        $user =factory(User::class)->create();
        $this->actingAs($user);

        $categoria = factory(Categoria::class, ['nombre' => 'catrggoso'])->create();

        $categoria->nombre = "otro Nombre";

        $respuesta = $this->putJson('categorias/update/'.$categoria->id, $categoria->toArray());

        $respuesta -> assertJson([
            'nombre' => 'Otro nombre',
        ]);

        $this->assertDatabaseHas('categorias', [
            'nombre' => 'Otro nombre',
            ]);
    }
}
