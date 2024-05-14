@extends('layout.main')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <!-- Formulario de búsqueda -->
            <div class="card">
                <div class="card-header">Buscar Registros</div>
                <div class="card-body">
                    <form id="form-busquedatrabajo" method="GET">
                        <div class="form-group">
                            <label for="keyword">Palabra Clave:</label>
                            <input type="text" class="form-control" id="keyword" name="keyword">
                        </div>
                        <div class="form-group">
                            <label for="theme">Tema:</label>
                            <input type="text" class="form-control" id="theme" name="theme">
                        </div>
                        <div class="form-group">
                            <label for="author">Autor:</label>
                            <input type="text" class="form-control" id="author" name="author">
                        </div>
                        <div class="form-group">
                            <label for="tutor">Tutor:</label>
                            <input type="text" class="form-control" id="tutor" name="tutor">
                        </div>
                        <div class="form-group">
                            <div class="row"> 
                            <div class=col-md-6>
                                <label for="start_date">Fecha Inicio:</label>
                                <input type="date" class="form-control" id="start_date" name="start_date">
                            </div>
                            <div class=col-md-6>
                                <label for="end_date">Fecha Fin:</label>
                                <input type="date" class="form-control" id="end_date" name="end_date">
                            </div>
                            </div>
                           
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <!-- Listado de registros -->
            <div class="card">
                <div class="card-header">Resultados de Búsqueda</div>
                <div class="card-body">                 
                        <table id="table-trabajogrado" class="table">                           
                            <tbody>                                      
                            </tbody>
                        </table>     
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
    const tableBody = document.querySelector('#table-trabajogrado tbody');
    tableBody.innerHTML = ''; // Limpiar el contenido anterior

    trabajos.forEach(trabajo => {
        const html = createTrabajoHTML(trabajo);
        tableBody.insertAdjacentHTML('beforeend', html);
    });
}

function createTrabajoHTML(trabajo) {
    return `
        <tr>
            <td>
                <div class="card mb-3">
                    <div class="card-body">
                        <p class="card-text"><span class="text-muted">${trabajo.fecha_defensa.substring(0, 4)}/#${trabajo.codigo}</span></p>
                        <h5 class="card-title">${trabajo.tema}</h5>
                        <p class="card-text">${trabajo.resumen}</p>                                            
                    </div>
                </div>
            </td>
        </tr>
    `;
}
</script>
@endpush

