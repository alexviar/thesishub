<?php

use App\Modules\Biblioteca\Models\TrabajoGrado;
use App\Modules\Auth\Models\Usuario;
use Illuminate\Support\Arr;
use Tests\TestCase;

test('crea un trabajo de grado con autores y tutor no registrados', function () {
    /** @var TestCase $this */

    $data = TrabajoGrado::factory()
        ->prepareForRequest()
        ->raw();
    $this->travelTo("2024-05-07");

    $response = $this->actingAs(Usuario::factory()->create())
        ->post('trabajos-grado/publicar', $data);

    $response->assertOk();
    $response->assertSee('El trabajo de grado ha sido guardado.');
    $registro = TrabajoGrado::with("tutor", "estudiantes")->latest()->first();
    $this->assertNotNull($registro);
    expect($registro->toArray())->toMatchArray(Arr::except($data, ["documento", "tutor", "estudiantes"]) + ["codigo" => "2024/1"]);
    expect($registro->tutor->toArray())->toMatchArray($data["tutor"]);
    $actualEstudiantes = $registro->estudiantes->map(fn ($estudiante) => Arr::only(Arr::dot($estudiante->toArray()), ["nro_registro", "nombre_completo", "pivot.carrera_id"]))->toArray();

    foreach($data["estudiantes"] as $expectedEstudiante){
        expect( [
            "nro_registro" => $expectedEstudiante["nro_registro"],
            "nombre_completo" => $expectedEstudiante["nombre_completo"],
            "pivot.carrera_id" =>  $expectedEstudiante["carrera_id"]
        ])->toBeIn($actualEstudiantes);
    }
});

test('crea un trabajo de grado con autores y tutor ya registrados', function () {
    /** @var TestCase $this */

    $data = TrabajoGrado::factory()
        ->prepareForRequest(true, 2)
        ->raw();
    $this->travelTo("2024-05-07");

    $response = $this->actingAs(Usuario::factory()->create())
        ->post('/trabajos-grado/publicar', $data);

    $response->assertOk();
    $response->assertSee('El trabajo de grado ha sido guardado.');
    $registro = TrabajoGrado::with("estudiantes")->latest()->first();
    $this->assertNotNull($registro);
    expect($registro->toArray())->toMatchArray(Arr::except($data, ["documento", "tutor", "estudiantes"]) + ["codigo" => "2024/1"]);
    expect($registro->tutor_id)->toBe($data["tutor"]["id"]);

    $actualEstudiantes = $registro->estudiantes->map(fn ($estudiante) => Arr::only(Arr::dot($estudiante->toArray()), ["id", "pivot.carrera_id"]))->toArray();

    foreach($data["estudiantes"] as $expectedEstudiante){
        expect( [
            "id" => $expectedEstudiante["id"],
            "pivot.carrera_id" =>  $expectedEstudiante["carrera_id"]
        ])->toBeIn($actualEstudiantes);
    }
});
