<?php

use App\Models\TrabajoGrado;
use Illuminate\Support\Arr;
use Tests\TestCase;

test('crea un trabajo de grado con autores y tutor no registrados', function () {
    /** @var TestCase $this */

    $data = TrabajoGrado::factory()
        ->prepareForRequest()
        ->raw();
    $this->travelTo("2024-05-07");

    $response = $this->post('trabajos-grado/publicar', $data);

    $response->assertOk();
    $response->assertSee('El trabajo de grado ha sido guardado.');
    $registro = TrabajoGrado::with("tutor", "estudiantes")->latest()->first();
    $this->assertNotNull($registro);
    expect($registro->toArray())->toMatchArray(Arr::except($data, ["documento", "tutor", "estudiantes"]) + ["codigo" => "2024/1"]);
    expect($registro->tutor->toArray())->toMatchArray($data["tutor"]);
    expect(Arr::map($registro->estudiantes->toArray(), fn($estudiante) => Arr::only(Arr::dot($estudiante), ["nro_registro", "nombre_completo", "pivot.carrera_id"])))->toMatchArray(
        Arr::map($data["estudiantes"], fn($estudiante) => [
            "nro_registro" => $estudiante["nro_registro"],
            "nombre_completo" => $estudiante["nombre_completo"],
            "pivot.carrera_id" =>  $estudiante["carrera_id"]
        ])
    );
});
