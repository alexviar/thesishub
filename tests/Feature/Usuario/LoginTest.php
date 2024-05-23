<?php

use App\Models\Usuario;
use Illuminate\Support\Arr;
use Tests\TestCase;

it('Se pudo iniciar sesion con el usuario', function () {
    //generar mi usuario
    $usuario = Usuario::factory()->create();
    //envio al login el username y password
    $response = $this->post('/login', [
        'username' => $usuario->username,
        'password' => "123123"
    ]);
    //validar si fue autenticado
    $this->assertAuthenticatedAs($usuario);
    //se pudo redirigir a dicha ruta?
    $response->assertRedirect('/trabajos-grado');
});

it('No se puede iniciar sesion', function () {
    //generar mi usuario
    $usuario = Usuario::factory()->create();
    //envio al login el username y password
    $response = $this->post('/login', [
        'username' => $usuario->username,
        'password' => "ErrorPassword"
    ]);
    // Verificar que la respuesta sea una redirección
    $response->assertStatus(302); 
    // Verificar que hay errores en la sesión para 'username' y 'password'
    $response->assertSessionHasErrors(['username', 'password']);
    // Verificar que el usuario no fue autenticado
    $this->assertGuest();
});
