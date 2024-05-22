<?php

namespace App\Modules\Auth\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use App\Modules\Auth\Models\Usuario;

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
            "estado" => 1,
            "email" => "admin@gmail.com",
            "password" => '12345678',
            "is_admin" => 1,

        ]);
    }
}
