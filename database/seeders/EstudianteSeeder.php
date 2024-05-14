<?php

namespace Database\Seeders;

use App\Models\Estudiante;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class EstudianteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //No usar en produccion
        Estudiante::factory(5)->state(new Sequence(
            ['nro_registro' => '1111'],
            ['nro_registro' => '2222'],
            ['nro_registro' => '3333'],
            ['nro_registro' => '4444'],
            ['nro_registro' => '5555']
        ))->create();
    }
}
