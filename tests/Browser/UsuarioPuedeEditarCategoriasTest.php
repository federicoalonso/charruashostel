<?php

namespace Tests\Browser;

use App\Models\Categoria;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UsuarioPuedeEditarCategoriasTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @test
     */
    public function un_usuario_puede_editar_categorias()
    {
        $categorias = factory(Categoria::class, 5)->create();
        $user = factory(User::class)->create();
        $categorias = factory(Categoria::class)->create();

        $this->browse(function (Browser $browser) use ($user, $categorias) {
            $browser->loginAs($user)
                    ->visit('/')
                    ->press('#productos')
                    ->waitForText('Configuración')
                    ->press('#productos-categoria')
                    ->waitForText($categorias->first()->nombre)
                    ->press('@categoria-1')
                    ->waitForText("Editar Categoría")
                    ->type('#nombre', 'otroNombre')
                    ->press('#guardar')
                    ->waitForText("Otronombre")
                    ->assertSee("Otronombre")
                    ;
        });
    }
}
