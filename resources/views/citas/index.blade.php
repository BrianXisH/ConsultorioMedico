@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Citas</h1>
    <a href="{{ route('citas.create') }}" class="btn btn-primary mb-3">Agendar Nueva Cita</a>

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
