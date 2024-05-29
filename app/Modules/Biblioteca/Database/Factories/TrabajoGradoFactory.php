<?php

namespace App\Modules\Biblioteca\Database\Factories;

use App\Modules\Biblioteca\Models\Carrera;
use App\Modules\Biblioteca\Models\Estudiante;
use App\Modules\Biblioteca\Models\Facultad;
use App\Modules\Biblioteca\Models\Tutor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Modules\Biblioteca\Models\TrabajoGrado>
 */
class TrabajoGradoFactory extends Factory
{
    protected $unsets = [];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return $this->unset([
            // "codigo" => $this->faker->numerify("####/##"),
            "tema" => $this->faker->realText(200),
            "resumen" => $this->faker->realTextBetween(400, 800),
            "fecha_defensa" => $this->faker->date(),
            "tutor_id" => Tutor::factory(),
            "filename" => $this->faker->filePath()
        ], $this->unsets);
    }

    /**
     * Uset multiple keys from array
     * 
     * @return array
     */
    protected function unset($array, $keys){
        foreach ($keys as $key ) {
            unset($array[$key]);
        }
        return $array;
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
        $this->unsets += ["filename", "tutor_id"];

        return $this->state([
            "documento" => UploadedFile::fake()->create('avatar.pdf', "1500", "application/pdf"),
            "tutor" => is_array($tutor) ? $tutor : $tutor->toArray(),
            "estudiantes" => $estudiantes
        ]);
    }

    public function newInstance(array $arguments = []){
        $instance = parent::newInstance($arguments);
        $instance->unsets = $this->unsets;
        return $instance;
    }
}
