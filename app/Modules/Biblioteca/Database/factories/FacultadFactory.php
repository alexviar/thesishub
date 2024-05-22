<?php

namespace App\Modules\Biblioteca\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Modules\Biblioteca\Models\Facultad>
 */
class FacultadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "nombre" => 'Facultad de '.$this->faker->words(4, true)
        ];
    }
}
