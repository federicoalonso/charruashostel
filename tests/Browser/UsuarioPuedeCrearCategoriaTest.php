<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UsuarioPuedeCrearCategoriaTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @test
     */
    public function un_usuario_puede_crear_categorias()
    {
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/')
                    ->press('#productos')
                    ->waitForText('Configuración')
                    ->press('#productos-categoria')
                    ->type('nombre', 'categoria 1')
                    ->press('#btn-guardar')
                    ->waitForText('Categoria 1')
                    ->assertSee('Categoria 1')
                ;
        });
    }
}
