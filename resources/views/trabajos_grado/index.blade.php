@extends('layouts.app')
@section('content')
<div class="container bg-white my-4 p-4 shadow-sm rounded" style="min-height:80vh">
    <div class="row align-items-stretch">
        <div class="col-md-4">
            <!-- Formulario de búsqueda -->
            <div class="position-sticky" style="top:1.25rem">
                <!-- <h2>Buscar Registros</h2> -->
                <div>
                    <form id="form-busquedatrabajo" method="GET">
                        <div class="form-group mb-3">
                            <label for="keyword">Palabra Clave:</label>
                            <input type="text" class="form-control" id="keyword" name="keyword">
                        </div>
                        <div class="form-group mb-3">
                            <label for="theme">Tema:</label>
                            <input type="text" class="form-control" id="theme" name="theme">
                        </div>
                        <div class="form-group mb-3">
                            <label for="author">Autor:</label>
                            <input type="text" class="form-control" id="author" name="author">
                        </div>
                        <div class="form-group mb-3">
                            <label for="tutor">Tutor:</label>
                            <input type="text" class="form-control" id="tutor" name="tutor">
                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-md-6">
                                <label for="start_date">Fecha Inicio:</label>
                                <input type="date" class="form-control" id="start_date" name="start_date">
                            </div>
                            <div class="form-group mb-3 col-md-6">
                                <label for="end_date">Fecha Fin:</label>
                                <input type="date" class="form-control" id="end_date" name="end_date">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <!-- Listado de registros -->
            <div>
                <div><!-- Se encontraron ### resultados --></div>
                <div id="results-container">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push("scripts")
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.querySelector('#form-busquedatrabajo');

        form.addEventListener('submit', handleFormSubmit);
    });

    async function handleFormSubmit(event) {
        event.preventDefault();

        try {
            const formData = new FormData(event.target);
            const queryParams = new URLSearchParams(formData).toString();
            const url = `{{ route("trabajos_grado.buscar") }}?${queryParams}`;

            const trabajos = await fetchData(url);

            renderTrabajos(trabajos);
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }

    async function fetchData(url) {
        const response = await fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        return await response.json();
    }

    function renderTrabajos(trabajos) {
        const resultsContainer = document.querySelector('#results-container');
        resultsContainer.innerHTML = ''; // Limpiar el contenido anterior

        trabajos.forEach(trabajo => {
            const html = createTrabajoHTML(trabajo);
            resultsContainer.insertAdjacentHTML('beforeend', html);
        });
    }

    function createTrabajoHTML(trabajo) {
        const showUrlTemplate = `{!!Str::replace('trabajo.id', '${trabajo.id}', route('trabajos_grado.show', ['id' => 'trabajo.id']))!!}`;
        return `
            <div class="mb-3">
                <div class="d-flex">
                    <a href="${showUrlTemplate}">
                        ${trabajo.codigo}
                    </a>
                    <a class="ms-2 me-auto" href="${trabajo.url_descarga}">
                        (PDF)
                    </a>
                </div>
                <div style="font-weight:500">${trabajo.tema}</div>
                <div class="my-1">
                    ${trabajo.estudiantes.map((estudiante) => {
                        return `<div><em>${estudiante.nombre_completo}</em></div>`
                    }).join('\n')}
                </div>
                <p>${trabajo.resumen}</p>                                            
            </div>
        `;
    }
</script>
@endpush
