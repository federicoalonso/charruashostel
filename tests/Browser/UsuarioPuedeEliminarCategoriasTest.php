<?php

namespace Tests\Browser;

use App\Models\Categoria;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UsuarioPuedeEliminarCategoriasTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @test
     */
    public function un_usuario_puede_eliminar_categorias()
    {
        $categorias = factory(Categoria::class, 5)->create();
        $user = factory(User::class)->create();
        $categorias = factory(Categoria::class)->create();
        $cat = $categorias->first();

        $this->browse(function (Browser $browser) use ($user, $cat) {
            $browser->loginAs($user)
                    ->visit('/')
                    ->press('#productos')
                    ->waitForText('Configuración')
                    ->press('#productos-categoria')
                    ->waitForText($cat->nombre)
                    ->press('@categoria-del-'.$cat->id)
                    ->waitForText("Categoría Eliminada")
                    ->assertDontSee($cat->nombre)
                    ;
        });
    }
}
