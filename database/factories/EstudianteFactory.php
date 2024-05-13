<?php

namespace Database\Factories;

use App\Models\Estudiante;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estudiante>
 */
class EstudianteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Estudiante::class;

    public function definition()
    {
        return [
            'nro_registro' => $this->faker->unique()->numerify('EST#####'),
            'nombre_completo' => $this->faker->name,
        ];
    }
}
