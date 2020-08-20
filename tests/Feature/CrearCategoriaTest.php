<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CrearCategoriaTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUnUsuarioAutenticadoPuedeCrearCategorias()
    {
        $this->withoutExceptionHandling();

        $user =factory(User::class)->create();
        $this->actingAs($user);

        $respuesta = $this->postJson(route('categorias.store'), ['nombre' => 'categoría 1']);

        $respuesta -> assertJson([
            'nombre' => 'Categoría 1',
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('categorias', [
            'nombre' => 'Categoría 1',
            'user_id' => $user->id,
            ]);
    }

    public function testUnUsuarioNoAutenticadoNoPuedeCrearCategorias()
    {
        $respuesta = $this->post(route('categorias.store'), ['nombre' => 'categoria 1']);

        $respuesta->assertRedirect('login');
    }

    public function testUnaCategriaNoPuedeEstaVacia()
    {

        $user =factory(User::class)->create();
        $this->actingAs($user);

        $respuesta = $this->postJson(route('categorias.store'), ['nombre' => '']);

        $respuesta->assertJsonStructure([
            'message', 'errors' => ['nombre'],
        ]);

        $this->assertDatabaseMissing('categorias', [
            'nombre' => '',
            'user_id' => $user->id,
            ]);
    }

    /**
     * @test
     */
    public function una_categria_no_puede_tener_menos_de_cinco_caracteres()
    {

        $user =factory(User::class)->create();
        $this->actingAs($user);

        $respuesta = $this->postJson(route('categorias.store'), ['nombre' => 'asda']);

        $respuesta->assertJsonStructure([
            'message', 'errors' => ['nombre'],
        ]);

        $this->assertDatabaseMissing('categorias', [
            'nombre' => 'Asda',
            'user_id' => $user->id,
            ]);
    }

    /**
     * @test
     */
    public function dos_categrias_no_pueden_tener_mismo_nombre()
    {

        $user =factory(User::class)->create();
        $this->actingAs($user);

        $respuesta = $this->postJson(route('categorias.store'), ['nombre' => 'asdas']);

        $respuesta2 = $this->postJson(route('categorias.store'), ['nombre' => 'asdas']);

        $respuesta2->assertJsonStructure([
            'message', 'errors' => ['nombre'],
        ]);

        $this->assertDatabaseCount('categorias', 1);
    }
}
