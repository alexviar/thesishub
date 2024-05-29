<?php

namespace App\Modules\Biblioteca\Database\Seeders;

use App\Modules\Biblioteca\Models\Facultad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacultadYCarrerasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Facultad::create([
            "nombre" => "Facultad Integral Chiquitana"
        ])->carreras()->createMany([
            ["nombre" => "Contaduría Pública"],
            ["nombre" => "Ingeniería Agropecuaria"],
            ["nombre" => "Zootecnia"]
        ]);

        Facultad::create([
            "nombre" => "Facultad Integral de Ichilo"
        ])->carreras()->createMany([
            ["nombre" => "Administración de Empresas"],
            ["nombre" => "Ciencias de la Educación"],
            ["nombre" => "Contaduría Pública"],
            ["nombre" => "Derecho"],
            ["nombre" => "Enfermería"],
            ["nombre" => "Ingeniería Agropecuaria"],
            ["nombre" => "Ingeniería Comercial"],
            ["nombre" => "Ingeniería Financiera"],
            ["nombre" => "Ingeniería Petrolera"],
            ["nombre" => "Ingeniería en Sistemas"],
            ["nombre" => "Medicina Veterinaria y Zootécnica"]
        ]);
        
        Facultad::create([
            "nombre" => "Facultad Integral de los Valles Cruceños"
        ])->carreras()->createMany([
            ["nombre" => "Contaduría Pública"],
            ["nombre" => "Ingeniería Agropecuaria"],
            ["nombre" => "Ingeniería en Sistemas"]
        ]);
        
        Facultad::create([
            "nombre" => "Facultad Integral del Chaco"
        ])->carreras()->createMany([
            ["nombre" => "Administración de Empresas"],
            ["nombre" => "Ciencias de la Educación"],
            ["nombre" => "Contaduría Pública"],
            ["nombre" => "Derecho"],
            ["nombre" => "Enfermería"],
            ["nombre" => "Ingeniería Industrial"],
            ["nombre" => "Ingeniería Informática"],
            ["nombre" => "Ingeniería del Petróleo y Gas Natural"],
            ["nombre" => "Ingeniería en Agropecuaria"],
            ["nombre" => "Ingeniería en Sistemas"],
            ["nombre" => "Monitoreo Socioambiental"],
            ["nombre" => "Odontología"]
        ]);
        
        Facultad::create([
            "nombre" => "Facultad Integral del Noreste"
        ])->carreras()->createMany([
            ["nombre" => "Ciencias de la Educación"],
            ["nombre" => "Contaduría Pública"],
            ["nombre" => "Enfermería"],
            ["nombre" => "Ingeniería Agropecuaria"]
        ]);
        
        Facultad::create([
            "nombre" => "Facultad Integral del Norte"
        ])->carreras()->createMany([
            ["nombre" => "Ciencias de la Educación"],
            ["nombre" => "Contaduría Pública"],
            ["nombre" => "Derecho"],
            ["nombre" => "Enfermería"],
            ["nombre" => "Ingeniería Comercial"],
            ["nombre" => "Ingeniería Industrial"],
            ["nombre" => "Ingeniería Petrolera"],
            ["nombre" => "Ingeniería en Sistemas"],
            ["nombre" => "Medicina"],
            ["nombre" => "Medicina Veterinaria y Zootecnia"]
        ]);
        
        Facultad::create([
            "nombre" => "Facultad Politécnica"
        ])->carreras()->createMany([
            ["nombre" => "Construcciones Civiles"],
            ["nombre" => "Electricidad Industrial"],
            ["nombre" => "Electrónica"],
            ["nombre" => "Ingeniería en Agrimensura"],
            ["nombre" => "Ingeniería en Materiales"],
            ["nombre" => "Ingeniería en Metalurgia"],
            ["nombre" => "Licenciatura en Ofimática"],
            ["nombre" => "Mecánica General"]
        ]);
        
        Facultad::create([
            "nombre" => "Facultad de Ciencias Agrícolas"
        ])->carreras()->createMany([
            ["nombre" => "Biología"],
            ["nombre" => "Ciencias Ambientales"],
            ["nombre" => "Ingeniería Agronómica"],
            ["nombre" => "Ingeniería Agrícola (Montero)"],
            ["nombre" => "Ingeniería Forestal"]
        ]);
        
        Facultad::create([
            "nombre" => "Facultad de Ciencias Contables, Auditoría, Sistemas de Control de Gestión y Finanzas"
        ])->carreras()->createMany([
            ["nombre" => "Contaduría Pública"],
            ["nombre" => "Información y Control de Gestión"]
        ]);
        
        Facultad::create([
            "nombre" => "Facultad de Ciencias Económicas y Empresariales"
        ])->carreras()->createMany([
            ["nombre" => "Administración de Empresas"],
            ["nombre" => "Comercio Internacional"],
            ["nombre" => "Economía"],
            ["nombre" => "Ingeniería Comercial"],
            ["nombre" => "Ingeniería Financiera"]
        ]);
        
        Facultad::create([
            "nombre" => "Facultad de Ciencias Exactas y Tecnología"
        ])->carreras()->createMany([
            ["nombre" => "Ingeniería Ambiental"],
            ["nombre" => "Ingeniería Civil"],
            ["nombre" => "Ingeniería Electromecánica"],
            ["nombre" => "Ingeniería Industrial"],
            ["nombre" => "Ingeniería Petrolera"],
            ["nombre" => "Ingeniería Química"],
            ["nombre" => "Ingeniería de Alimentos"],
            ["nombre" => "Ingeniería de Control de Procesos"]
        ]);
        
        Facultad::create([
            "nombre" => "Facultad de Ciencias Farmacéuticas y Bioquímicas"
        ])->carreras()->createMany([
            ["nombre" => "Bioquímica"],
            ["nombre" => "Farmacia"]
        ]);
        
        Facultad::create([
            "nombre" => "Facultad de Ciencias Jurídicas, Políticas, Sociales y Relaciones Internacionales"
        ])->carreras()->createMany([
            ["nombre" => "Ciencias Políticas y Administración Pública"],
            ["nombre" => "Derecho"],
            ["nombre" => "Relaciones Internacionales"],
            ["nombre" => "Trabajo Social"]
        ]);
        
        Facultad::create([
            "nombre" => "Facultad de Ciencias Veterinarias"
        ])->carreras()->createMany([
            ["nombre" => "Medicina Veterinaria y Zootecnia"]
        ]);
        
        Facultad::create([
            "nombre" => "Facultad de Ciencias de la Salud Humana"
        ])->carreras()->createMany([
            ["nombre" => "Enfermería"],
            ["nombre" => "Medicina"],
            ["nombre" => "Odontología"]
        ]);
        
        Facultad::create([
            "nombre" => "Facultad de Ciencias del Hábitat, Diseño y Arte"
        ])->carreras()->createMany([
            ["nombre" => "Arquitectura"],
            ["nombre" => "Arte"],
            ["nombre" => "Diseño Integral"],
            ["nombre" => "Planificación Territorial"]
        ]);
        
        Facultad::create([
            "nombre" => "Facultad de Humanidades"
        ])->carreras()->createMany([
            ["nombre" => "Actividad Física"],
            ["nombre" => "Ciencias de la Comunicación"],
            ["nombre" => "Ciencias de la Educación"],
            ["nombre" => "Gestión del Turismo"],
            ["nombre" => "Lenguas Modernas y Filología Hispánica"],
            ["nombre" => "Psicología"],
            ["nombre" => "Sociología"]
        ]);
        
        Facultad::create([
            "nombre" => "Facultad de Ingeniería en Ciencias de la Computación y Telecomunicaciones"
        ])->carreras()->createMany([
            ["nombre" => "Ingeniería Informática"],
            ["nombre" => "Ingeniería en Redes y Telecomunicaciones"],
            ["nombre" => "Ingeniería en Sistemas"]
        ]);
    }
}
