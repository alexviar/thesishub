<?php

use App\Modules\Auth\Models\Usuario;
use Illuminate\Support\Arr;

it('registra un nuevo usuario', function(){
    /** @var \Tests\TestCase $this */
    $login = Usuario::factory()->admin()->create();
    $data = Usuario::factory()->prepareForRequest()->raw();

    $response = $this->actingAs($login)->post('usuarios', $data);

    $response->assertRedirect('usuarios');
    $usuario = Usuario::latest('id')->first();

    $expectedData = Arr::except($data, ['password', 'password_confirmation']);
    $actualData = $usuario->toArray();
    expect($actualData)->toMatchArray($expectedData);
});