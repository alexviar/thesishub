@extends('layouts.app')

@section('template_title')
Usuarios
@endsection

@section('content')
<div class="container bg-white my-4 p-4 shadow-sm rounded" style="min-height:80vh">
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
        </ol>
    </nav>
    <h3>{{ __('Lista de usuarios') }}</h3>

    @if ($message = Session::get('success'))
    <div class="alert alert-success m-4">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div class="row">
        <div class="col-auto ms-auto">
            <a href="{{ route('usuarios.create') }}" class="btn btn-primary px-4">
                {{ __('Nuevo') }}
            </a>
        </div>
    </div>


    <div class="mb-3">
        <h8>{{ $usuarios->total() }} {{ __('registros encontrados') }}</h8>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th style="width:0">#</th>
                    <th>Username</th>
                    <th>Nombre Completo</th>
                    <th>Administrador</th>
                    <th>Estado</th>
                    <th style="width:0"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $offset++ }}</td>
                    <td>{{ $usuario->username }}</td>
                    <td>{{ $usuario->nombre_completo }}</td>
                    <td>{{ $usuario->is_admin ? 'Sí' : 'No' }}</td>
                    <td>{{ $usuario->printable_estado }}</td>
                    <td>
                        <div class="dropdown dropdown-hide-caret">
                            <button class="btn btn-link dropdown-toggle p-0" id="options-toggle-button" aria-label="Opciones" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                </svg>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end detached" aria-labelledby="options-toggle-button">
                                <li>
                                    <a class="dropdown-item" href="{{ route('usuarios.show', $usuario->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                        </svg>
                                        Ver
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('usuarios.edit', $usuario->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                        </svg>
                                        Editar
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {!! $usuarios->withQueryString()->links() !!}
</div>
@endsection
@push('scripts')
<script>
    window.addEventListener("load", function() {
        const dropdowns = [...document.querySelectorAll('.dropdown')];
        dropdowns.forEach((dropdown) => {
            const menu = dropdown.querySelector('.dropdown-menu.detached');
            if (menu) {
                dropdown.addEventListener('show.bs.dropdown', () => {
                    const [top, left] = [menu.offsetTop, menu.offsetLeft];
                    menu.style.position = 'absolute';
                    menu.style.top = top;
                    menu.style.left = left;
                    document.body.append(menu);
                    dropdown.addEventListener('hidden.bs.dropdown', () => {
                        dropdown.append(menu)
                    });
                });
            }
        });
    });
</script>
@endpush