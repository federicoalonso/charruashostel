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

        $this->browse(function (Browser $browser) use ($user, $categorias) {
            $browser->loginAs($user)
                    ->visit('/')
                    ->press('#productos')
                    ->waitForText($categorias->first()->nombre)
                    ->assertSee($categorias->first()->nombre)
                    ;
        });
    }
}
