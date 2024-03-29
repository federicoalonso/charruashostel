<?php

namespace Tests\Browser;

use App\Models\Categoria;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UsuariosPuedenVerLasCategoriasTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @test
     */
    public function usuarios_pueden_ver_lista_de_categorias()
    {
        $categorias = factory(Categoria::class, 5)->create();
        $user = factory(User::class)->create();
        $categorias = factory(Categoria::class)->create(['user_id' => $user->id]);

        $this->browse(function (Browser $browser) use ($user, $categorias) {
            $browser->loginAs($user)
                    ->visit('/')
                    ->press('#productos')
                    ->waitForText('Configuración')
                    ->press('#productos-categoria')
                    ->waitForText($categorias->first()->nombre)
                    ->assertSee($categorias->first()->nombre)
                    ->assertSee($user->name)
                    ;
        });
    }
}
