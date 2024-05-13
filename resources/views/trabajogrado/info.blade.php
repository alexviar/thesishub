<!-- @extends('layout.main') -->

@section('content')
<div class="container-fluid d-flex align-items-start" style="height: calc(100vh-73px); width:75%;  padding-top: 5%; ">
    <div class="row p-5 bg-white border shadow-lg" style="width:100%; border-radius:20px;">
        <div class="col-md-8 p-5">
            <h2>Trabajo de grado {{$trabajoDeGrado->codigo}}</h2>
            <h1>{{$trabajoDeGrado->tema}}</h1>
            @foreach($trabajoDeGrado->estudiantes as $estudiante)
            <div class="text-muted"><em>{{$estudiante->nombre_completo}}</em></div>
            @endforeach
            <h2>Resumen</h2>
            <p>
                {{$trabajoDeGrado->resumen}}
            </p>
            <!-- ... -->
        </div>
        <div class="col-md-4 p-5">
            <h2>Metadatos</h2>
            <h3>Formato disponible</h3>
            <div class="ps-4">
                <a target="_blank" href="{{route('trabajo_grado.descargar',['filename'=> $trabajoDeGrado->filename])}}" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-file-pdf"></i>
                    PDF
                </a>
            </div>
            <h3>Carrera(s)</h3>
            <div class="ps-4">
                <!-- <div class="mb-3">
                    <div>Ingenieria en Sed rhoncus</div>
                    <div class="text-muted">Facultad de Sed rhoncus neq</div>
                </div> -->
                @foreach ($trabajoDeGrado->carreras->unique('nombre') as $carrera)
                <div class="mb-3">
                    <div>{{ $carrera->nombre }}</div>
                    <div class="text-muted">Facultad de {{ $carrera->facultad->nombre }}</div>
                </div>
                @endforeach
            </div>

            <h3>Tutor</h3>
            <div class="ps-4">
                <p>{{ $trabajoDeGrado->tutor->nombre_completo }}</p>
            </div>
            <h3>Fecha de defensa</h3>
            <p class="ps-4">{{$trabajoDeGrado->fecha_defensa}}</p>
        </div>
    </div>
</div>
@endsection