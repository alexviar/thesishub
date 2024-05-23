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

            "username" => "admin",
            "nombre_completo" => "admin",
            "estado" => 'activo',
            "email" => "admin@gmail.com",
            "password" => '12345678',
            //"password-confirm" => Hash::make('1234567'),
            "rol" => 1,

        ]);
    }
}
