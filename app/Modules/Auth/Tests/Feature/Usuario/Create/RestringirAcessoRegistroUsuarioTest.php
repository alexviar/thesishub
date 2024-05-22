<?php

use App\Modules\Auth\Models\Usuario;

it('Usuarios inactivos no pueden acceder al formulario para el registro de usuarios', function () {
/** @var \Tests\TestCase $this */
    $usuario = Usuario::factory()->inactivo()->create();
    
    $response = $this->actingAs($usuario)->get('/usuarios/crear');

    $response->assertForbidden();
});

it('Solo los administradores pueden acceder al formulario para el registro de usuarios', function () {
    /** @var \Tests\TestCase $this */
    $usuario = Usuario::factory()->regular()->create();
    
    $response = $this->actingAs($usuario)->get('/usuarios/crear');

    $response->assertForbidden();
    
    $usuario = Usuario::factory()->admin()->create();
    
    $response = $this->actingAs($usuario)->get('/usuarios/crear');

    $response->assertOk();
    
 } );
