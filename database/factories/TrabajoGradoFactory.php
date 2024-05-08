<?php

namespace Database\Factories;

use App\Models\Estudiante;
use App\Models\Tutor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

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

    public function prepareForRequest($tutor = null, $estudiantes = 2)
    {
        if(is_integer($estudiantes)){
            $estudiantes = Estudiante::factory($estudiantes)->raw();
            foreach($estudiantes as &$estudiante){
                $estudiante["carrera_id"] = $this->faker->numberBetween(1,17);
            }
        }
        return $this->state([
            "documento" => UploadedFile::fake()->create('avatar.pdf', "1500", "application/pdf"),
            "tutor" => $tutor ?? Tutor::factory()->raw(),
            "estudiantes" => $estudiantes
        ]);
    }
}
