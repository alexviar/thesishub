<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TrabajoGrado;

class TrabajoGradoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('trabajogrado.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function buscar(Request $request)
    {
        $keyword = $request->input('keyword');
        $theme = $request->input('theme');
        $author = $request->input('author');
        $tutor = $request->input('tutor');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
       
        // Lógica para filtrar los trabajos de grado según los criterios de búsqueda
        $resultados = TrabajoGrado::where('tema', 'like', "%$theme%")
                                    // ->where('autor', 'like', "%$author%")
                                    // ->where('tutor', 'like', "%$tutor%")
                                 //   ->whereDate('fecha_inicio', '>=', $startDate)
                                  //  ->whereDate('fecha_fin', '<=', $endDate)
                                    ->get();
        
        return response()->json($resultados);
    }
}
