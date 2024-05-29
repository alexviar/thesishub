<?php

use App\Modules\Auth\Models\Usuario;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

it('bloquea un nuevo usuario', function(){
    /** @var \Tests\TestCase $this */
    $login = Usuario::factory()->admin()->create();
    $usuario = Usuario::factory()->activo()->create();
    $data = Usuario::factory($usuario->toArray())
        ->inactivo()
        ->prepareForRequest()
        ->raw();
    expect(Hash::check($data['password'], $usuario->password))->not->toBeTrue();

    $response = $this->actingAs($login)->patch("usuarios/{$usuario->id}", $data);

    $response->assertRedirect('usuarios');
    $usuario = $usuario->fresh();

    $expectedData = Arr::except($data, ['password', 'password_confirmation']);
    $actualData = $usuario->toArray();
    expect($actualData)->toMatchArray($expectedData);
    expect(Hash::check($data['password'], $usuario->password))->toBeTrue();
});

it('desbloquea un nuevo usuario', function(){
    /** @var \Tests\TestCase $this */
    $login = Usuario::factory()->admin()->create();
    $usuario = Usuario::factory()->inactivo()->create();
    $data = Usuario::factory($usuario->toArray())
        ->activo()
        ->prepareForRequest()
        ->raw();
    expect(Hash::check($data['password'], $usuario->password))->not->toBeTrue();

    $response = $this->actingAs($login)->patch("usuarios/{$usuario->id}", $data);

    $response->assertRedirect('usuarios');
    $usuario = $usuario->fresh();

    $expectedData = Arr::except($data, ['password', 'password_confirmation']);
    $actualData = $usuario->toArray();
    expect($actualData)->toMatchArray($expectedData);
    expect(Hash::check($data['password'], $usuario->password))->toBeTrue();
});


it('no cambia la contraseña original', function(){
    /** @var \Tests\TestCase $this */
    $login = Usuario::factory()->admin()->create();
    $usuario = Usuario::factory([
        'password' => '1234'
    ])->inactivo()->create();
    $data = Usuario::factory($usuario->toArray())
        ->state([
            'password' => '',
        ])
        ->activo()
        ->prepareForRequest()
        ->raw();

    $response = $this->actingAs($login)->patch("usuarios/{$usuario->id}", $data);

    $response->assertRedirect('usuarios');
    $usuario = $usuario->fresh();

    expect(Hash::check('1234', $usuario->password))->toBeTrue();
});