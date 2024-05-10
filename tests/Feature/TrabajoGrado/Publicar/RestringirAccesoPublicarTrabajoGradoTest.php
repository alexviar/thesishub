<?php

use App\Models\Usuario;
use Illuminate\Http\Request;
use Tests\TestCase;

test('usuario no autenticado', function () {
    /** @var TestCase $this */

    $response = $this->post('trabajos-grado/publicar', []);

    $response->assertRedirectToRoute("login");
});


test('usuario  autenticado', function () {
    /** @var TestCase $this */

    $response = $this->actingAs(Usuario::factory()->create())->post('trabajos-grado/publicar', []);

    expect(Request::create($response->headers->get('Location'))->fullUrl())->not->toEndWith(route("login"));
});