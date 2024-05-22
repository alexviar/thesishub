@extends('layouts.app')

@section('template_title')
    {{ $usuario->name ?? __('Show') . " " . __('Usuario') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Usuario</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('usuarios.index') }}"> {{ __('Back') }}</a>
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
                                    {{ $usuario->estado }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Rol:</strong>
                                    {{ $usuario->rol }}
                                </div>
                                

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
