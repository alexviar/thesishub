@extends('layouts.app')

@section('template_title')
{{ $usuario->name ?? __('Show') . " " . __('Usuario') }}
@endsection

@section('content')
<section class="container bg-white my-4 p-4 shadow-sm rounded" style="min-height:80vh">
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('usuarios.index')}}">Usuarios</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$usuario->id}}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <span class="card-title">Información del usuario</span>
                    </div>
                    
                    <div>
                        <a class="btn btn-primary btn-sm" href="{{ route('usuarios.edit', [
                            'usuario' => $usuario->id
                        ]) }}"> {{ __('Editar') }}</a>
                    </div>
                </div>

                <div class="card-body bg-white">

                    <div class="form-group mb-2 mb20">
                        <strong>Username:</strong>
                        {{ $usuario->username }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Nombre Completo:</strong>
                        {{ $usuario->nombre_completo }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Correo electronico:</strong>
                        {{ $usuario->email }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Estado:</strong>
                        {{ $usuario->printable_estado }}
                    </div>
                    <div class="form-group mb-2 mb20">
                        <strong>Administrador:</strong>
                        {{ $usuario->is_admin ? 'Sí' : 'No' }}
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
@endsection