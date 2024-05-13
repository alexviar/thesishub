<?php

namespace Database\Factories;

use App\Models\TrabajoGrado;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    protected $model = TrabajoGrado::class;

    public function definition()
    {
        return [
            'codigo' => $this->faker->unique()->numerify('TG#####'),
            'tema' => $this->faker->sentence,
            'resumen' => $this->faker->paragraph,
            'fecha_defensa' => $this->faker->date,
            'filename' => $this->faker->word . '.pdf',
        ];
    }
}
