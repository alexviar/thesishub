<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Estudiante;
use App\Models\TrabajoGrado;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class TrabajoGradoController extends Controller
{
    public function index(){
        return view('trabajos_grado.index');
    }

    function prepareCarrerasForDropdown(){
        $carreras = Carrera::with('facultad')->get();
        return $carreras->map(fn($carrera) => [
            "id" => $carrera->id,
            "label" => $carrera->nombre,
            "subtext" => $carrera->facultad->nombre
        ])->toJson();
    }

    function create(){
        $carreras = $this->prepareCarrerasForDropdown();
        return view('trabajos_grado.publicar', [
            "carreras" => $carreras,
            "ui" => [
                "title" => "Registro de trabajos de grado",
                "show_confirmation_message" => false
            ]
        ]);
    }

    function store(Request $request){
        $payload = $request->except("_token");

        $documento = $request->file("documento");
        $payload["filename"] = $documento->store("trabajos de grado");
        $payload["codigo"] = Carbon::today()->year . '/' . (TrabajoGrado::count() + 1);

        $tutor = Tutor::create($payload["tutor"]);
        $trabajo = TrabajoGrado::create($payload + ["tutor_id" => $tutor->id]);
        if($trabajo){
            foreach($payload["estudiantes"] as $estudianteData){
                $estudiante = Estudiante::create($estudianteData);
                $trabajo->estudiantes()->attach($estudiante->id, Arr::only($estudianteData, "carrera_id"));
            }
            return view('trabajos_grado.publicar', [
                "carreras" => $this->prepareCarrerasForDropdown(),
                "ui" => [
                    "title" => "Registro de trabajos de grado",
                    "show_confirmation_message" => true
                ]
            ]);
        }

    }
}
