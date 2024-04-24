@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 800px;">
    <h1>Ficha de identificación</h1>
    <form method="POST" action="{{ route('ficha.store') }}" class="form-container">
        @csrf

        <div class="form-group">
            <label>Nombre</label>
            <div class="input-group">
                <input type="text" name="apellidoPaterno" placeholder="Apellido paterno" class="form-control @error('apellidoPaterno') is-invalid @enderror" value="{{ old('apellidoPaterno') }}">
                <input type="text" name="apellidoMaterno" placeholder="Apellido materno" class="form-control @error('apellidoMaterno') is-invalid @enderror" value="{{ old('apellidoMaterno') }}">
                <input type="text" name="nombres" placeholder="Nombre(s)" class="form-control @error('nombres') is-invalid @enderror" value="{{ old('nombres') }}">
            </div>
            @error('apellidoPaterno')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
            @error('apellidoMaterno')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
            @error('nombres')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label>Género</label>
            <div>
                <label><input type="radio" value="Masculino" name="genero" {{ old('genero') == 'Masculino' ? 'checked' : '' }}> Masculino</label>
                <label><input type="radio" value="Femenino" name="genero" {{ old('genero') == 'Femenino' ? 'checked' : '' }}> Femenino</label>
            </div>
            @error('genero')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label>Lugar y fecha de nacimiento</label>
            <div class="input-group">
                <input type="text" name="lugarNacimiento" placeholder="(Estado)" class="form-control @error('lugarNacimiento') is-invalid @enderror" value="{{ old('lugarNacimiento') }}">
                <input type="date" name="fechaNacimiento" class="form-control @error('fechaNacimiento') is-invalid @enderror" value="{{ old('fechaNacimiento') }}">
            </div>
            @error('lugarNacimiento')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
            @error('fechaNacimiento')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label>Ocupación</label>
            <input type="text" name="ocupacion" class="form-control @error('ocupacion') is-invalid @enderror" value="{{ old('ocupacion') }}">
            @error('ocupacion')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <!-- Agregar campos restantes... -->
        <div class="form-group">
            <label>Estado civil</label>
            <input type="text" name="estadoCivil" class="form-control @error('estadoCivil') is-invalid @enderror" value="{{ old('estadoCivil') }}">
            @error('estadoCivil')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label>Escolaridad</label>
            <input type="text" name="escolaridad" class="form-control @error('escolaridad') is-invalid @enderror" value="{{ old('escolaridad') }}">
            @error('escolaridad')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label>Domicilio: Calle</label>
            <input type="text" name="domicilioCalle" class="form-control @error('domicilioCalle') is-invalid @enderror" value="{{ old('domicilioCalle') }}">
            @error('domicilioCalle')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
            <div class="input-group">
                <input type="text" name="numeroExterior" placeholder="Núm. exterior" class="form-control @error('numeroExterior') is-invalid @enderror" value="{{ old('numeroExterior') }}">
                <input type="text" name="numeroInterior" placeholder="Núm. interior" class="form-control @error('numeroInterior') is-invalid @enderror" value="{{ old('numeroInterior') }}">
            </div>
            @error('numeroExterior')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
            @error('numeroInterior')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label>Colonia</label>
            <input type="text" name="colonia" class="form-control @error('colonia') is-invalid @enderror" value="{{ old('colonia') }}">
            @error('colonia')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label>Estado</label>
            <input type="text" name="estado" class="form-control @error('estado') is-invalid @enderror" value="{{ old('estado') }}">
            @error('estado')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label>Municipio / Delegación</label>
            <div class="input-group">
                <input type="text" name="municipio" placeholder="Municipio" class="form-control @error('municipio') is-invalid @enderror" value="{{ old('municipio') }}">
                <input type="text" name="delegacion" placeholder="Delegación" class="form-control @error('delegacion') is-invalid @enderror" value="{{ old('delegacion') }}">
            </div>
            @error('municipio')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
            @error('delegacion')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}">
            @error('telefono')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label>Teléfono de oficina</label>
            <input type="text" name="telefonoOficina" class="form-control @error('telefonoOficina') is-invalid @enderror" value="{{ old('telefonoOficina') }}">
            @error('telefonoOficina')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label>Nombre del médico familiar</label>
            <input type="text" name="medicoFamiliar" class="form-control @error('medicoFamiliar') is-invalid @enderror" value="{{ old('medicoFamiliar') }}">
            @error('medicoFamiliar')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

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

        @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    </form>
</div>
@endsection

