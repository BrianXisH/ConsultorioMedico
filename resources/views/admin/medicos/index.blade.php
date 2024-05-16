@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de Médicos</h1>
    <a href="{{ route('medicos.create') }}" class="btn btn-primary">Agregar Médico</a>
    <table class="table mt-4">
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
                    <a href="{{ route('medicos.edit', $medico->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('medicos.destroy', $medico->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
