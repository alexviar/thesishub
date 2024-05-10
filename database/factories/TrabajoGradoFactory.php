<?php

namespace Database\Factories;

use App\Models\Carrera;
use App\Models\Estudiante;
use App\Models\Facultad;
use App\Models\Tutor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TrabajoGrado>
 */
class TrabajoGradoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // "codigo" => $this->faker->numerify("####/##"),
            "tema" => $this->faker->realText(200),
            "resumen" => $this->faker->realTextBetween(400, 800),
            "fecha_defensa" => $this->faker->date()
        ];
    }

    public function prepareForRequest($persistTutor=false, $persistEstudiantes=0, $totalEstudiantes=2)
    {
        $tutorFactoryMethod = $persistTutor ? "create" : "raw";
        $tutor = Tutor::factory()->$tutorFactoryMethod();
        $estudiantes = Arr::shuffle(
            Estudiante::factory($persistEstudiantes)->create()->toArray() +
            Estudiante::factory($totalEstudiantes - $persistEstudiantes)->raw()
        );
        
        foreach($estudiantes as &$estudiante){
            $estudiante["carrera_id"] = Carrera::factory()->for(Facultad::factory())->create()->id;
        }

        return $this->state([
            "documento" => UploadedFile::fake()->create('avatar.pdf', "1500", "application/pdf"),
            "tutor" => is_array($tutor) ? $tutor : $tutor->toArray(),
            "estudiantes" => $estudiantes
        ]);
    }
}
