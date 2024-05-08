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
      
        $TG = TrabajoGrado::query();
       
        if (!empty($theme)){
            $TG = $TG->where('tema', 'like', "%$theme%");
        }       
        if (!empty($keyword)){
            $TG = $TG->where('resumen', 'like', "%$keyword%");
        }             
        if ($startDate){
            $TG = $TG->whereDate('fecha_defensa', '>=', $startDate);
        }  
        if ($endDate){
            $TG = $TG->whereDate('fecha_defensa', '<=', $endDate);
        }
        ///////////filtro tutor////////////////////////////   
        if (!empty($tutor)){   
            $idTutores = Tutor::where('nombre_completo','like',"%". $tutor ."%")->pluck('id');          
            $TG = $TG->whereIn('tutor_id', $idTutores);
        }       
        //////////////////////////////////////////////////// 
        ///////////filtro author////////////////////////////
        if (!empty($author)){
            $idsEstudiantes = Estudiante::where('nombre_completo', 'like', '%' . $author . '%')->pluck('id');
            $idsTrabajosGrado = CarreraEstudianteTrabajoGrado::whereIn('estudiante_id', $idsEstudiantes)->pluck('trabajo_grado_id');
            $TG = $TG->whereIn('id', $idsTrabajosGrado);          
        }       
        ///////////////////////////////////////////////////
        $resultados=$TG->get();

        return response()->json($resultados);
    }
}
