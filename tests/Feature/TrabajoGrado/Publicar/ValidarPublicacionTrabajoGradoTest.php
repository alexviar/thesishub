<?php

use App\Models\Estudiante;
use App\Models\Tutor;
use App\Models\Usuario;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;


it('valida los campos requeridos', function () {
    /** @var TestCase $this */

    $response = $this->actingAs(Usuario::factory()->create())
        ->post('trabajos-grado/publicar', []);

    $response->assertRedirect();
    $response->assertSessionHasErrors([
        'tema' => 'El campo tema es requerido.',
        'resumen' => 'El campo resumen es requerido.',
        'fecha_defensa' => 'El campo fecha de defensa es requerido.',
        'documento' => 'El campo documento es requerido.',
        'tutor.codigo' => 'El campo código del tutor es requerido.',
        'tutor.nombre_completo' => 'El campo nombre del tutor es requerido.',
        'estudiantes' => 'Debe introducir al menos un estudiante.',
    ]);
});

it('valida los campos requeridos de los estudiantes', function () {
    /** @var TestCase $this */

    $response = $this->actingAs(Usuario::factory()->create())
        ->post('trabajos-grado/publicar', [
            "estudiantes" => [
                []
            ]
        ]);

    $response->assertRedirect();
    $response->assertSessionHasErrors([
        'estudiantes.0.nro_registro' => 'El campo número de registro del estudiante 1 es requerido.',
        'estudiantes.0.nombre_completo' => 'El campo nombre del estudiante 1 es requerido.',
        'estudiantes.0.carrera_id' => 'El campo carrera del estudiante 1 es requerido.',
    ]);
});

it('valida que la fecha de defensa sea anterior a la fecha actual', function () {
    /** @var TestCase $this */
    $this->travelTo("2024-05-10");

    $response = $this->actingAs(Usuario::factory()->create())
        ->post('trabajos-grado/publicar', [
            "fecha_defensa" => "2024-05-11"
        ]);

    $response->assertRedirect();
    $response->assertSessionHasErrors([
        "fecha_defensa" => "La fecha de defensa debe ser anterior a la fecha actual."
    ]);
});

it('valida que el tipo de documento sea PDF', function () {
    /** @var TestCase $this */
    $this->travelTo("2024-05-10");

    $response = $this->actingAs(Usuario::factory()->create())
        ->post('trabajos-grado/publicar', [
            "documento" => UploadedFile::fake()->create('avatar.docx')
        ]);

    $response->assertRedirect();
    $response->assertSessionHasErrors([
        "documento" => "El documento debe estar en formato PDF."
    ]);
});

it('valida que si se pasa el id del tutor, entonces su nombre y codigo no son necesarios', function () {
    /** @var TestCase $this */
    $this->travelTo("2024-05-10");

    $response = $this->actingAs(Usuario::factory()->create())
        ->post('trabajos-grado/publicar', [
            "tutor" => [
                "id" => Tutor::factory()->create()->id
            ]
        ]);

    $response->assertRedirect();
    $response->assertSessionDoesntHaveErrors([
        'tutor.codigo',
        'tutor.nombre_completo',
    ]);
});


it('valida que si se pasa el id del estudiante, entonces su nombre y registro no son necesarios', function () {
    /** @var TestCase $this */
    $this->travelTo("2024-05-10");

    $response = $this->actingAs(Usuario::factory()->create())
        ->post('trabajos-grado/publicar', [
            "estudiantes" => [
                [
                    "id" => Estudiante::factory()->create()->id
                ]
            ]
        ]);

    $response->assertRedirect();
    $response->assertSessionDoesntHaveErrors([
        'estudiantes.0.codigo',
        'estudiantes.0.nombre_completo',
    ]);
});
