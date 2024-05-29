<?php

namespace App\Modules\Auth\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Modules\Auth\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    protected $unsets = [];

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
            'is_admin' => fake()->randomElement([0, 1]),
            'username' => fake()->userName(),
            'password' => fake()->bothify('$a###???A$')
        ];
    }

    protected function getRawAttributes(?Model $parent)
    {
        return $this->unset(parent::getRawAttributes($parent), $this->unsets);
    }

    /**
     * Uset multiple keys from array
     * 
     * @return array
     */
    protected function unset($array, $keys)
    {
        foreach ($keys as $key) {
            unset($array[$key]);
        }
        return $array;
    }

    public function activo()
    {
        return $this->state([
            'estado' => 1,
        ]);
    }

    public function inactivo()
    {
        return $this->state([
            'estado' => 2,
        ]);
    }

    public function admin()
    {
        return $this->state([
            'is_admin' => 1,
        ]);
    }

    public function regular()
    {
        return $this->state([
            'is_admin' => 0,
        ]);
    }

    public function prepareForRequest()
    {
        $this->unsets += ['created_at', 'updated_at'];
        return $this->state(function ($currentState) {
            if($currentState['is_admin'] == 0) $this->unsets[] = 'is_admin';
            return [
                'password_confirmation' => $currentState['password']
            ];
        });
    }

    public function newInstance(array $arguments = [])
    {
        $instance = parent::newInstance($arguments);
        $instance->unsets = $this->unsets;
        return $instance;
    }
}
