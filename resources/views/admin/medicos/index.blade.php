<!-- resources/views/admin/medicos/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de Médicos</h1>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('home') }}" class="btn btn-secondary mb-3">Regresar a Home</a>
    <a href="{{ route('admin.medicos.create') }}" class="btn btn-primary mb-3">Agregar Médico</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($medicos as $medico)
                <tr>
                    <td>{{ $medico->name }}</td>
                    <td>{{ $medico->email }}</td>
                    <td>
                        <a href="{{ route('admin.medicos.edit', $medico->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('admin.medicos.destroy', $medico->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este médico?')">Eliminar</button>
                        </form>
                        <a href="{{ route('admin.medicos.historial', $medico->id) }}" class="btn btn-info">Ver Historial</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
