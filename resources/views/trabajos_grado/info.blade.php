
@extends("layouts.app")
@section('content')
<div  class="container bg-white my-4 p-4 shadow-sm rounded" style="min-height:80vh">
    <div class="row">
        <div class="col-lg-8 col-md-7">
            <div class="fs-4 mb-2" style="font-weight: 500;">Trabajo de grado {{$trabajoDeGrado->codigo}}</div>
            <h1 class="fs-3 mb-3" style="font-weight: 500;">{{$trabajoDeGrado->tema}}</h1>
            <div class="mb-3">
                @foreach($trabajoDeGrado->estudiantes as $estudiante)
                <div><em>{{$estudiante->nombre_completo}}</em></div>
                @endforeach
            </div>
            <h2 class="fs-5">Resumen</h2>
            <p>
                {{$trabajoDeGrado->resumen}}
            </p>
            <!-- ... -->
        </div>
        <div class="col-lg-4 col-md-5">
            <h2 class="fs-5 mb-3">Metadatos</h2>
            <h3 class="fs-6 mb-0">Formato disponible</h3>
            <div class="ps-4 py-3">
                <a target="_blank" href="{{$trabajoDeGrado->urlDescarga}}" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-file-pdf"></i>
                    PDF
                </a>
            </div>
            <h3 class="fs-6 mb-0">Carrera(s)</h3>
            <div class="ps-4 py-3 mb-n2">
                @foreach ($trabajoDeGrado->carreras->unique('nombre') as $carrera)
                <div class="mb-2">
                    <div>{{ $carrera->nombre }}</div>
                    <div class="text-muted">Facultad de {{ $carrera->facultad->nombre }}</div>
                </div>
                @endforeach
            </div>

            <h3 class="fs-6 mb-0">Tutor</h3>
            <div class="ps-4 py-3">
                <div>{{ $trabajoDeGrado->tutor->nombre_completo }}</div>
            </div>
            <h3 class="fs-6 mb-0">Fecha de defensa</h3>
            <div class="ps-4 py-3">
                <div>{{$trabajoDeGrado->fecha_defensa}}</div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <style>
        .mb-n2 {
            margin-bottom: -0.75rem;
        }
    </style>
@endpush