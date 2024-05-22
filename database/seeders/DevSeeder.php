<?php

namespace Database\Seeders;

use App\Modules\Biblioteca\Database\Seeders\EstudianteSeeder;
use App\Modules\Biblioteca\Database\Seeders\TrabajosGradoSeeder;
use App\Modules\Biblioteca\Database\Seeders\TutorSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * Seeder para usuar solo en entornos de desarrollo
 */
class DevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EstudianteSeeder::class);
        $this->call(TutorSeeder::class);
        $this->call(TrabajosGradoSeeder::class);
    }
}
