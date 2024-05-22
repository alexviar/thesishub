<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usuario::create([

            "username" => "paola",
            "nombre_completo" => "paola",
            "estado" => 'activo',
            "email" => "paola@gmail.com",
            "password" => Hash::make('1234567'),
            "password-confirm" => Hash::make('1234567'),
            "rol" => 1,

        ]);
    }
}
