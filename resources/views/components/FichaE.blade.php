@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 800px;">
    <h1>Ficha de identificación</h1>
    <form method="POST" action="{{ route('submitForm') }}" class="form-container">
        @csrf
        <div class="form-group">
            <label>Fecha de la consulta médica</label>
            <input type="date" name="fecha_consulta" class="form-control @error('fecha_consulta') is-invalid @enderror" value="{{ old('fecha_consulta') }}">
            @error('fecha_consulta')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="form-group">
            <label>Fecha de la última consulta médica</label>
            <input type="date" name="fechaUltimaConsulta" class="form-control @error('fechaUltimaConsulta') is-invalid @enderror" value="{{ old('fechaUltimaConsulta') }}">
            @error('fechaUltimaConsulta')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        
        <div class="form-group">
            <label>Motivo de la última consulta médica</label>
            <input type="text" name="motivoUltimaConsulta" class="form-control @error('motivoUltimaConsulta') is-invalid @enderror" value="{{ old('motivoUltimaConsulta') }}">
            @error('motivoUltimaConsulta')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <input type="submit" value="Enviar" class="btn btn-primary">
        </div>
    </form>
</div>
@endsection

