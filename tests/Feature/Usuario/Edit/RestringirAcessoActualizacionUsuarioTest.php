<?php

use App\Models\Usuario;

it('Usuarios inactivos no pueden acceder al formulario para la actualización de usuarios', function () {
/** @var \Tests\TestCase $this */
    $login = Usuario::factory()->inactivo()->create();
    $usuario = Usuario::factory()->create();
    
    $response = $this->actingAs($login)->get("/usuarios/{$usuario->id}/editar");

    $response->assertForbidden();
});

it('Solo los administradores pueden acceder al formulario para la actualización de usuarios', function () {
    /** @var \Tests\TestCase $this */
    $login = Usuario::factory()->regular()->create();
    $usuario = Usuario::factory()->create();
    
    $response = $this->actingAs($login)->get("/usuarios/{$usuario->id}/editar");

    $response->assertForbidden();
    
    $login = Usuario::factory()->admin()->create();
    
    $response = $this->actingAs($login)->get("/usuarios/{$usuario->id}/editar");

    $response->assertOk();
    
 } );
