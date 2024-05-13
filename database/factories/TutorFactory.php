<?php

namespace Database\Factories;

use App\Models\Tutor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tutor>
 */
class TutorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Tutor::class;

    public function definition()
    {
        return [
            'codigo' => $this->faker->unique()->numerify('TUT#####'),
            'nombre_completo' => $this->faker->name,
        ];
    }
}
