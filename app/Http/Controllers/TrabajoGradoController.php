<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TrabajoGrado;
use App\Models\Tutor;
use App\Models\Estudiante;
use App\Models\CarreraEstudianteTrabajoGrado;

class TrabajoGradoController extends Controller
{
    /**
     * Muestra la vista principal de trabajos de grado.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('trabajogrado.index');
    }

    /**
     * Realiza una búsqueda de trabajos de grado según los parámetros especificados.
     *
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function buscar(Request $request)
    {      
        // Obtener parámetros de búsqueda del request
        $params = $request->only(['keyword', 'theme', 'author', 'tutor', 'start_date', 'end_date']);

        // Crear una consulta base para TrabajoGrado
        $query = TrabajoGrado::query();

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
            $tutorIds = Tutor::where('nombre_completo', 'like', '%' . $params['tutor'] . '%')->pluck('id');
            $query->whereIn('tutor_id', $tutorIds);
        }

        // Aplicar filtro por autor si se especifica
        if (!empty($params['author'])) {
            $estudianteIds = Estudiante::where('nombre_completo', 'like', '%' . $params['author'] . '%')->pluck('id');
            $trabajosGradoIds = CarreraEstudianteTrabajoGrado::whereIn('estudiante_id', $estudianteIds)->pluck('trabajo_grado_id');
            $query->whereIn('id', $trabajosGradoIds);
        }

        // Ejecutar la consulta y obtener resultados
        $resultados = $query->get();

        // Devolver los resultados como JSON en la respuesta
        return response()->json($resultados);
    }
}
}
