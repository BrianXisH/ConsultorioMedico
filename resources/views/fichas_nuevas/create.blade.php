@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 800px;">
    <h1>Consulta Medica</h1>
    <form method="POST" action="{{ route('fichas_nuevas.store') }}" class="form-container">
        @csrf
        <div class="form-group">
            <label>Fecha de la consulta médica</label>
            <input type="date" name="fecha_consulta" class="form-control @error('fecha_consulta') is-invalid @enderror" value="{{ old('fecha_consulta') }}" id="fecha_consulta" readonly>
            @error('fecha_consulta')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="form-group">
            <label>Tipo de consulta</label>
            <select name="tipo_consulta" class="form-control @error('tipo_consulta') is-invalid @enderror">
                <option value="">Seleccione</option>
                <option value="Atencion Primaria" {{ old('tipo_consulta') == 'Atencion Primaria' ? 'selected' : '' }}>Atencion Primaria</option>
                <option value="Especialista" {{ old('tipo_consulta') == 'Especialista' ? 'selected' : '' }}>Especialista</option>
                <option value="Control y seguimiento" {{ old('tipo_consulta') == 'Control y seguimiento' ? 'selected' : '' }}>Control y seguimiento</option>
                <option value="Prevención" {{ old('tipo_consulta') == 'Prevencion' ? 'selected' : '' }}>Prevencion</option>
                <option value="Pediatrica" {{ old('tipo_consulta') == 'Pediatrica' ? 'selected' : '' }}>Pediatrica</option>
            </select>
            @error('tipo_consulta')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="form-group">
            <label>Motivo de la consulta médica</label>
            <input type="text" name="motivo_consulta" class="form-control @error('motivo_consulta') is-invalid @enderror" value="{{ old('motivo_consulta') }}">
            @error('motivo_consulta')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <input type="submit" value="Guardar" class="btn btn-primary">
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Establecer la fecha de la consulta médica con la fecha actual
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('fecha_consulta').value = today;
    });
</script>
@endsection
