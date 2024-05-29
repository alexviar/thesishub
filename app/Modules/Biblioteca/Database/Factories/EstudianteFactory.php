<?php

namespace App\Modules\Biblioteca\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Modules\Biblioteca\Models\Estudiante>
 */
class EstudianteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "nro_registro" => $this->faker->numerify('############'),
            "nombre_completo" => $this->faker->name()
        ];
    }
}
