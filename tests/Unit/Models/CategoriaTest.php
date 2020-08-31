<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Categoria;
use App\Http\Resources\CategoriaResource;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoriaTest extends TestCase
{
    use RefreshDatabase;

    /**  @test */
    public function una_categoria_pertece_a_un_usuario()
    {
        $this->withoutExceptionHandling();
        $categoria = factory(Categoria::class)->create();

        $this->assertInstanceOf(User::class, $categoria->user);
    }
}
