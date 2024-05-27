<?php

namespace App\Modules\Biblioteca\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Modules\Biblioteca\Models\Tutor>
 */
class TutorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "codigo" => $this->faker->lexify("?????????"),
            "nombre_completo" => $this->faker->firstName() . " " . $this->faker->lastName() . " " . $this->faker->lastName(),
        ];
    }
}
