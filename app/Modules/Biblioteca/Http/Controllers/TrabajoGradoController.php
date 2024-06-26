<?php

namespace App\Modules\Biblioteca\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Biblioteca\Models\Carrera;
use App\Modules\Biblioteca\Models\Estudiante;
use App\Modules\Biblioteca\Models\TrabajoGrado;
use App\Modules\Biblioteca\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class TrabajoGradoController extends Controller
{
    const SAVE_DIRECTORIO = 'trabajos_grado';

    private function applyFilters($request, $query)
    {
        // Obtener parámetros de búsqueda del request
        $params = $request->only(['keyword', 'theme', 'author', 'tutor', 'start_date', 'end_date']);


        // Aplicar filtros según los parámetros recibidos
        if (!empty($params['theme'])) {
            // Filtrar por tema del trabajo de grado
            $query->where('tema', 'like', '%' . $params['theme'] . '%');
        }

        if (!empty($params['keyword'])) {
            // Filtrar por palabra clave en el resumen
            $query->where('resumen', 'like', '%' . $params['keyword'] . '%');
        }

        if (!empty($params['start_date'])) {
            // Filtrar por fecha de defensa mínima
            $query->whereDate('fecha_defensa', '>=', $params['start_date']);
        }

        if (!empty($params['end_date'])) {
            // Filtrar por fecha de defensa máxima
            $query->whereDate('fecha_defensa', '<=', $params['end_date']);
        }

        // Aplicar filtro por tutor si se especifica
        if (!empty($params['tutor'])) {
            $query->whereHas('tutor', function ($query) use ($params) {
                $query->where('nombre_completo', 'like', '%' . $params['tutor'] . '%');
            });
        }

        // Aplicar filtro por autor si se especifica
        if (!empty($params['author'])) {
            $query->whereHas('estudiantes', function ($query) use ($params) {
                $query->where('nombre_completo', 'like', '%' . $params['author'] . '%');
            });
        }
    }

    /**
     * Muestra la vista principal de trabajos de grado.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        // Crear una consulta base para TrabajoGrado
        $query = TrabajoGrado::with("estudiantes");
        $this->applyFilters($request, $query);
        $resultados = $query->latest()->paginate();
        
        $request->flash();
        
        return view('biblioteca::trabajos_grado.index', compact('resultados'));
    }

    function prepareCarrerasForDropdown()
    {
        $carreras = Carrera::with('facultad')->get();
        return $carreras->map(fn ($carrera) => [
            "id" => $carrera->id,
            "label" => $carrera->nombre,
            "subtext" => $carrera->facultad->nombre
        ])->toJson();
    }

    function create()
    {
        $carreras = $this->prepareCarrerasForDropdown();
        return view('biblioteca::trabajos_grado.publicar', [
            "carreras" => $carreras,
            "ui" => [
                "title" => "Registro de trabajos de grado",
                "show_confirmation_message" => false
            ]
        ]);
    }

    function validateStoreRequest(Request $request)
    {
        return $request->validate([
            "tema" => "required|string",
            "resumen" => "required|string",
            "fecha_defensa" => "required|date|before_or_equal:" . Date::now()->toDateString(),
            "documento" => "required|file|mimetypes:application/pdf",

            "tutor.id" => "nullable|exists:tutores,id",
            "tutor.codigo" => "required_without:tutor.id|string",
            "tutor.nombre_completo" => "required_without:tutor.id|string",

            "estudiantes" => "required|array|min:1",
            "estudiantes.*.id" => "nullable|exists:estudiantes,id",
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
            "estudiantes.*.carrera_id" => "carrera del estudiante :position",
        ]);
    }

    function store(Request $request)
    {
        $payload = $this->validateStoreRequest($request);

        $documento = $request->file("documento");
        $payload["filename"] = $documento->store(self::SAVE_DIRECTORIO);

        $tutor_id = $payload["tutor"]["id"] ?? Tutor::create($payload["tutor"])->id;
        $trabajo = TrabajoGrado::create($payload + ["tutor_id" => $tutor_id]);
        if ($trabajo) {
            foreach ($payload["estudiantes"] as $estudianteData) {
                [$estudiante_id, $carrera_id] = isset($estudianteData["id"]) ?
                    [$estudianteData["id"], $estudianteData["carrera_id"]] :
                    [Estudiante::create($estudianteData)->id, $estudianteData["carrera_id"]];
                $trabajo->estudiantes()->attach($estudiante_id, ["carrera_id" => $carrera_id]);
            }
            return view('biblioteca::trabajos_grado.publicar', [
                "carreras" => $this->prepareCarrerasForDropdown(),
                "ui" => [
                    "title" => "Registro de trabajos de grado",
                    "show_confirmation_message" => true
                ]
            ]);
        }
    }

    public function descargar($filename)
    {
        $directorio = self::SAVE_DIRECTORIO;
        $rutaArchivo = storage_path("app/{$directorio}/$filename");
        return response()->stream(function () use ($rutaArchivo) {
            readfile($rutaArchivo);
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $rutaArchivo . '"',
        ]);
    }

    public function show($id)
    {
        $trabajoDeGrado = TrabajoGrado::with('estudiantes', 'carreras', 'tutor')->find($id);
        $ui = [
            "title" => "Informacion",

            // otras claves y valores que necesites
        ];

        return view('biblioteca::trabajos_grado.info', compact('ui', 'id', 'trabajoDeGrado'));
    }
}
