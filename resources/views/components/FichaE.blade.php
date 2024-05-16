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
            <input type="date" name="fecha_ultima_consulta" class="form-control @error('fecha_ultima_consulta') is-invalid @enderror" value="{{ old('fecha_ultima_consulta') }}">
            @error('fecha_ultima_consulta')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        
        <div class="form-group">
            <label>Motivo de la última consulta médica</label>
            <input type="text" name="motivo_ultima_consulta" class="form-control @error('motivo_ultima_consulta') is-invalid @enderror" value="{{ old('motivo_ultima_consulta') }}">
            @error('motivo_ultima_consulta')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <input type="submit" value="Guardar ficha" class="btn btn-primary">
            <a href="{{ route('pathological.index') }}" class="btn btn-orange">Siguiente</a>
        </div>

        
    </form>
</div>
@endsection

