@extends('layouts.app')
@section('content')
<div class="container bg-white my-4 p-4 shadow-sm rounded" style="min-height:80vh">
    <div class="row align-items-stretch">
        <div class="col-md-4">
            <!-- Formulario de búsqueda -->
            <div class="position-sticky" style="top:1.25rem">
                <!-- <h2>Buscar Registros</h2> -->
                <div class="card">
                    <div class="card-header">Formulario de búsqueda</div>
                    <div class="card-body">
                        @include('trabajos_grado.partials.search_form')
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <!-- Listado de registros -->
            <div>
                @if($resultados->total() == 0)
                <div class="mb-3"> No se encontraron resultados<div>
                @else
                <div class="mb-3"> Se encontraron {{ $resultados->total() }} resultados<div>
                @endif
                <div id="results-container">
                    @foreach ($resultados as $resultado)
                        @include('trabajos_grado.partials.result_item', [
                            'trabajo' => $resultado
                        ])
                    @endforeach
                </div>
                {!! $resultados->withQueryString()->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
