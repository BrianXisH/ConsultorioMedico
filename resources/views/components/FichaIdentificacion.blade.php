@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 800px;">
    <h1>Ficha de identificación</h1>
    <form method="POST" action="{{ route('ficha.store') }}" class="form-container">
        @csrf

        <div class="form-group">
            <label>Nombre</label>
            <div class="input-group">
                <input type="text" name="nombre_apellido_paterno" placeholder="Apellido paterno" class="form-control @error('nombre_apellido_paterno') is-invalid @enderror" value="{{ old('nombre_apellido_paterno') }}">
                <input type="text" name="nombre_apellido_materno" placeholder="Apellido materno" class="form-control @error('nombre_apellido_materno') is-invalid @enderror" value="{{ old('nombre_apellido_materno') }}">
                <input type="text" name="nombre_nombres" placeholder="Nombre(s)" class="form-control @error('nombre_nombres') is-invalid @enderror" value="{{ old('nombre_nombres') }}">
            </div>
            @error('nombre_apellido_paterno', 'nombre_apellido_materno', 'nombre_nombres')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
    <label>Género</label>
    <div>
        <label><input type="radio" value="masculino" name="genero" {{ old('genero') == 'masculino' ? 'checked' : '' }}> Masculino</label>
        <label><input type="radio" value="femenino" name="genero" {{ old('genero') == 'femenino' ? 'checked' : '' }}> Femenino</label>
    </div>
    @error('genero')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
</div>

        <div class="form-group">
            <label>Lugar y fecha de nacimiento</label>
            <div class="input-group">
                <input type="text" name="ugar_nacimiento_estado" placeholder="Estado" class="form-control @error('ugar_nacimiento_estado') is-invalid @enderror" value="{{ old('ugar_nacimiento_estado') }}">
                <input type="text" name="lugar_nacimiento_ciudad" placeholder="Ciudad" class="form-control @error('lugar_nacimiento_ciudad') is-invalid @enderror" value="{{ old('lugar_nacimiento_ciudad') }}">
                <input type="date" name="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid @enderror" value="{{ old('fecha_nacimiento') }}">
            </div>
            @error('ugar_nacimiento_estado', 'lugar_nacimiento_ciudad', 'fecha_nacimiento')
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
        <div class="form-group">
            <label>Edad</label>
            <input type="text" name="edad_anios" class="form-control @error('edad_anios') is-invalid @enderror" value="{{ old('edad_anios') }}">
            @error('edad_anios')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label>Estado civil</label>
            <input type="text" name="estado_civil" class="form-control @error('estado_civil') is-invalid @enderror" value="{{ old('estado_civil') }}">
            @error('estado_civil')
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
            <input type="text" name="domicilio_calle" class="form-control @error('domicilio_calle') is-invalid @enderror" value="{{ old('domicilio_calle') }}">
            @error('domicilio_calle')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
            <div class="input-group">
                <input type="text" name="domicilio_num_exterior" placeholder="Núm. exterior" class="form-control @error('domicilio_num_exterior') is-invalid @enderror" value="{{ old('domicilio_num_exterior') }}">
                <input type="text" name="domicilio_num_interior" placeholder="Núm. interior" class="form-control @error('domicilio_num_interior') is-invalid @enderror" value="{{ old('domicilio_num_interior') }}">
            </div>
            @error('domicilio_num_exterior', 'domicilio_num_interior')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label>Colonia</label>
            <input type="text" name="domicilio_colonia" class="form-control @error('domicilio_colonia') is-invalid @enderror" value="{{ old('domicilio_colonia') }}">
            @error('domicilio_colonia')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label>Estado</label>
            <input type="text" name="domicilio_estado" class="form-control @error('domicilio_estado') is-invalid @enderror" value="{{ old('domicilio_estado') }}">
            @error('domicilio_estado')
                <span the="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label>Municipio / Delegación</label>
            <input type="text" name="domicilio_mpio" placeholder="Municipio" class="form-control @error('domicilio_mpio') is-invalid @enderror" value="{{ old('domicilio_mpio') }}">
            <input type="text" name="domicilio_delegacion" placeholder="Delegación" class="form-control @error('domicilio_delegacion') is-invalid @enderror" value="{{ old('domicilio_delegacion') }}">
            @error('domicilio_mpio', 'domicilio_delegacion')
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
            <input type="text" name="telefono_oficina" class="form-control @error('telefono_oficina') is-invalid @enderror" value="{{ old('telefono_oficina') }}">
            @error('telefono_oficina')
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
