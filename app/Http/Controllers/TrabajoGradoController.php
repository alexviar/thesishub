<?php

namespace App\Http\Controllers;

use App\Models\TrabajoGrado;
use Illuminate\Http\Request;

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
    public function descargar($filename)
    {
        
        $rutaArchivo = storage_path('app/trabajos_de_grado/' . $filename);
        return response()->stream(function () use ($rutaArchivo) {
            readfile($rutaArchivo);
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $rutaArchivo . '"',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trabajoDeGrado = TrabajoGrado::with('estudiantes', 'carreras', 'tutor')->find($id);
        $ui = [
            "title" => "Informacion",
            
            // otras claves y valores que necesites
        ];
        
        return view('trabajogrado.info', compact('ui','id','trabajoDeGrado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
