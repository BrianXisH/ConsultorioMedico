<!-- resources/views/admin/medicos/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Nuevo Médico</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.medicos.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Nombre</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input id="password" type="password" class="form-control" name="password" required>
        </div>

        <div class="form-group">
            <label for="password-confirm">Confirmar Contraseña</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>

        <div class="form-group">
            <label for="cedula_profesional">Cédula Profesional</label>
            <input id="cedula_profesional" type="text" class="form-control" name="cedula_profesional" value="{{ old('cedula_profesional') }}" required>
        </div>

        <div class="form-group">
            <label for="escuela_de_procedencia">Escuela de Procedencia</label>
            <input id="escuela_de_procedencia" type="text" class="form-control" name="escuela_de_procedencia" value="{{ old('escuela_de_procedencia') }}" required>
        </div>

        <div class="form-group mb-0">
            <button type="submit" class="btn btn-primary">
                Crear
            </button>
            <a href="{{ route('admin.medicos.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
