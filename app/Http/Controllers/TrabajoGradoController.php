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

    function validateStoreRequest(Request $request){
        return $request->validate([
            "tema" => "required|string",
            "resumen" => "required|string",
            "fecha_defensa" => "required|date|before_or_equal:".date('Y-m-d'),
            "documento" => "required|file|mimetypes:application/pdf",

            "tutor.codigo" => "required_without:tutor.id|string",
            "tutor.nombre_completo" => "required_without:tutor.id|string",

            "estudiantes" => "required|array|min:1",
            "estudiantes.*.nro_registro" => "required_without:estudiantes.*.id|string",
            "estudiantes.*.nombre_completo" => "required_without:estudiantes.*.id|string",
            "estudiantes.*.carrera_id" => "required|exists:carreras,id",
        ], [

            "fecha_defensa.before_or_equal" => "La fecha de defensa debe ser anterior a la fecha actual.",
            "documento.mimetypes" => "El documento debe estar en formato PDF.",

            "tutor.codigo.required_without" => "El campo :attribute es requerido.",
            "tutor.nombre_completo.required_without" => "El campo :attribute es requerido.",
            
            "estudiantes.required" => "Debe introducir al menos un estudiante.",
            "estudiantes.*.nro_registro.required_without" => "El campo :attribute es requerido.",
            "estudiantes.*.nombre_completo.required_without" => "El campo :attribute es requerido.",
            "estudiantes.*.carrera_id.required_without" => "El campo :attribute es requerido.",
        ], [
            "fecha_defensa" => "fecha de defensa",

            "tutor.codigo" => "código del tutor",
            "tutor.nombre_completo" => "nombre del tutor",

            "estudiantes.*.nro_registro" => "número de registro del estudiante :position",
            "estudiantes.*.nombre_completo" => "nombre del estudiante :position",
            "estudiantes.*.carrera" => "carrera del estudiante :position",
        ]);
    }

    function store(Request $request){
        $payload = $this->validateStoreRequest($request);

        $documento = $request->file("documento");
        $payload["filename"] = $documento->store("trabajos de grado");
        $payload["codigo"] = Carbon::today()->year . '/' . (TrabajoGrado::count() + 1);

        $tutor_id = $payload["tutor"]["id"] ?? Tutor::create($payload["tutor"])->id;
        $trabajo = TrabajoGrado::create($payload + ["tutor_id" => $tutor_id]);
        if($trabajo){
            foreach($payload["estudiantes"] as $estudianteData){
                [$estudiante_id, $carrera_id] = isset($estudianteData["id"]) ? 
                    [$estudianteData["id"], $estudianteData["carrera_id"]] :
                    [Estudiante::create($estudianteData)->id, $estudianteData["carrera_id"]];
                $trabajo->estudiantes()->attach($estudiante_id, ["carrera_id" => $carrera_id]);
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
