<?php $trabajo->truncarResumen(500) ?>
<div class="mb-3">
    <div class="d-flex">
        <a href="{{route('trabajos_grado.show', ['id' => $trabajo->id])}}">
            {{$trabajo->codigo}}
        </a>
        <a class="ms-2 me-auto" href="{{$trabajo->url_descarga}}">
            (PDF)
        </a>
    </div>
    <div style="font-weight:500">{{$trabajo->tema}}</div>
    <div class="my-1">
        @foreach ($trabajo->estudiantes as $estudiante)
        <div><em>{{$estudiante->nombre_completo}}</em></div>
        @endforeach
    </div>
    <p>{{$trabajo->resumen}}</p>
</div>