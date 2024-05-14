<?php

namespace Database\Seeders;

use App\Models\Tutor;
use App\Models\TrabajoGrado;
use App\Models\Estudiante;
use App\Models\Carrera;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrabajosGradoSeeder extends Seeder
{
    public function run()
    {
        // Crear tutores
        $tutores = Tutor::factory()->count(50)->create();

        // Crear estudiantes
        $estudiantes = Estudiante::factory()->count(200)->create();

        // Obtener todas las carreras
        $carreras = Carrera::all();

        // Crear trabajos de grado
        $trabajosGrado = TrabajoGrado::factory()->count(100)->make()->each(function ($trabajo) use ($tutores, $estudiantes, $carreras) {
            // Asignar un tutor aleatorio
            $trabajo->tutor_id = $tutores->random()->id;
            $trabajo->save();

            // Asignar estudiantes aleatorios
            $estudiantesAleatorios = $estudiantes->random(rand(1, min(3, $estudiantes->count())))->pluck('id');

            // Enlazar estudiantes, trabajos de grado y carreras en la tabla carrera_estudiante_trabajo_grado
            foreach ($estudiantesAleatorios as $estudianteId) {
                // Asignar una carrera aleatoria
                $carreraAleatoria = $carreras->random()->id;

                info("Insertando los siguientes IDs: carrera_id = $carreraAleatoria, estudiante_id = $estudianteId, trabajo_grado_id = {$trabajo->id}");
                DB::table('carrera_estudiante_trabajo_grado')->insert([
                    'carrera_id' => $carreraAleatoria,
                    'estudiante_id' => $estudianteId,
                    'trabajo_grado_id' => $trabajo->id,
                ]);
            }
        });
    }
}

