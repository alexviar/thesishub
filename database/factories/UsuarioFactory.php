<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombre_completo' => fake()->name(),
            'email' => fake()->email(),
            'rol' => fake()->randomElement(['0','1']),
            'username' => fake()->userName(),
            'password' => '123123', // password
        ];
    }

    public function inactivo()
    {
        return $this->state([
            'estado' => 'inactivo',
        ]);
    }
    public function admin()
    {
        return $this->state([
            'rol' => '1',
        ]);
    }
}
