@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agendar Nueva Cita</h1>
    <form action="{{ route('citas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="paciente_id" class="form-label">Paciente</label>
            <select class="form-control" id="paciente_id" name="paciente_id" required>
                <option value="">Seleccione un paciente</option>
                @foreach($pacientes as $paciente)
                    <option value="{{ $paciente->idpacientes }}">{{ $paciente->nombre_nombres }} {{ $paciente->nombre_apellido_paterno }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha_hora" class="form-label">Fecha y Hora</label>
            <input type="datetime-local" class="form-control" id="fecha_hora" name="fecha_hora" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Agendar Cita</button>
    </form>
</div>
@endsection
