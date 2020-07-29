<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GuardarFalloTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSeGuardaUnFallo()
    {
        $this->withoutExceptionHandling();
        $respuesta = $this->post(route('fallos.store'), ['texto' => 'Fallo de la prueba',
                                           'clase' => 'GuardarFalloTest', 
                                           'funcion' => 'testSeGuardaUnFallo']);
        $respuesta->assertSuccessful();
        $this->assertDatabaseHas('fallos', [
            'texto' => 'Fallo de la prueba',
            'clase' => 'GuardarFalloTest', 
            'funcion' => 'testSeGuardaUnFallo']);
    }

    public function testSeGuardaUnDeUnUsuarioFallo()
    {
        $user = factory(User::class)->create();
        $this->withoutExceptionHandling();
        $respuesta = $this->post(route('fallos.store'), ['texto' => 'Fallo de la prueba',
                                           'clase' => 'GuardarFalloTest', 
                                           'funcion' => 'testSeGuardaUnFallo',
                                           'user_id' => $user->id]);
        $respuesta->assertSuccessful();
        $this->assertDatabaseHas('fallos', [
            'texto' => 'Fallo de la prueba',
            'clase' => 'GuardarFalloTest', 
            'funcion' => 'testSeGuardaUnFallo',
            'user_id' => $user->id]);
    }
}
