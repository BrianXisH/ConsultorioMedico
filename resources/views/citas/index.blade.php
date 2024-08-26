@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Citas</h1>
    <a href="{{ route('citas.create') }}" class="btn btn-primary mb-3">Agendar Nueva Cita</a>

    <form method="GET" action="{{ route('citas.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <label for="fecha" class="form-label">Filtrar por Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" value="{{ request('fecha') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label">&nbsp;</label>
                <button type="submit" class="btn btn-secondary">Filtrar</button>
                <a href="{{ route('citas.index') }}" class="btn btn-light">Limpiar Filtro</a>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Médico</th>
                <th>Paciente</th>
                <th>Fecha y Hora</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($citas as $cita)
                <tr>
                    <td>{{ $cita->user ? $cita->user->name : 'Médico no encontrado' }}</td>
                    <td>{{ $cita->paciente ? $cita->paciente->nombre_nombres . ' ' . $cita->paciente->nombre_apellido_paterno : 'Paciente no encontrado' }}</td>
                    <td>{{ \Carbon\Carbon::parse($cita->fecha_hora)->format('d-m-Y H:i') }}</td>
                    <td>{{ $cita->descripcion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
