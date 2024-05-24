@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Usuario
@endsection

@section('content')
    <section class="container bg-white my-4 p-4 shadow-sm rounded" style="min-height:80vh">
        <nav class="mb-3" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('usuarios.index')}}">Usuarios</a></li>
                <li class="breadcrumb-item"><a href="{{route('usuarios.show', ['usuario' => $usuario->id])}}">{{$usuario->id}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Actualizacion</li>
            </ol>
        </nav>
        <h3>Actualización de usuarios</h3>
        <div>
            <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}">
                {{ method_field('PATCH') }}
                @csrf

                @include('usuarios.form')

            </form>
        </div>
    </section>
@endsection
