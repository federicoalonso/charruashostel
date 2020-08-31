<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListaDeCategoriasTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @test
     */
    public function un_usuario_autenticado_puede_ver_las_categorias()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $categoria1 = factory(Categoria::class)->create(['created_at' => now()->subDays(4)]);
        $categoria2 = factory(Categoria::class)->create(['created_at' => now()->subDays(3)]);
        $categoria3 = factory(Categoria::class)->create(['created_at' => now()->subDays(2)]);
        $categoria4 = factory(Categoria::class)->create(['created_at' => now()->subDays(1)]);

        $response = $this->getJson(route('categorias.index'));

        $response->assertSuccessful();

        $response->assertJson([
            'total' => 4
        ]);

        $response->assertJsonStructure([
            'data', 'total', 'first_page_url'
        ]);

        $this->assertEquals(
            $categoria4->id,
            $response->json('data.0.id')
        );
    }

    /**
     * @test
     */
    public function un_usuario_autenticado_puede_ver_el_autor_de_la_categoria()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $categoria = factory(Categoria::class)->create(['user_id'=>$user->id]);

        $response = $this->getJson(route('categorias.index'));

        $response->assertSuccessful();

        $response->assertJsonStructure([
            'data', 'total', 'first_page_url'
        ]);
        
        $this->assertEquals(
            $user->name,
            $response->json('data.0.autor')
        );
    }
    /**
     * @test
     */
    /* public function un_guest_no_puede_ver_las_categorias()
    {
        $this->withoutExceptionHandling();

        $categoria1 = factory(Categoria::class)->create(['created_at' => now()->subDays(4)]);
        $categoria2 = factory(Categoria::class)->create(['created_at' => now()->subDays(3)]);
        $categoria3 = factory(Categoria::class)->create(['created_at' => now()->subDays(2)]);
        $categoria4 = factory(Categoria::class)->create(['created_at' => now()->subDays(1)]);

        $this->getJson(route('categorias.index'))->assertRedirect('/login');

    } */
}
