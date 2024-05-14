
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
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 144-208 0c-35.3 0-64 28.7-64 64l0 144-48 0c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128zM176 352l32 0c30.9 0 56 25.1 56 56s-25.1 56-56 56l-16 0 0 32c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-48 0-80c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24l-16 0 0 48 16 0zm96-80l32 0c26.5 0 48 21.5 48 48l0 64c0 26.5-21.5 48-48 48l-32 0c-8.8 0-16-7.2-16-16l0-128c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-16 0 0 96 16 0zm80-112c0-8.8 7.2-16 16-16l48 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 32 32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 48c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64 0-64z" />
                    </svg>
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