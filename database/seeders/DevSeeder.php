<?php

namespace Database\Seeders;

use App\Models\Usuario;
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
        Usuario::factory(100)->create();
        $this->call(EstudianteSeeder::class);
        $this->call(TutorSeeder::class);
        $this->call(TrabajosGradoSeeder::class);
    }
}
