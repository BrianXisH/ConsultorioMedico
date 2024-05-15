@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 800px;">
    <h1>Informacion del Paciente</h1>
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
                <input type="text" name="lugar_nacimiento_estado" placeholder="Estado" class="form-control @error('lugar_nacimiento_estado') is-invalid @enderror" value="{{ old('lugar_nacimiento_estado') }}">
                <input type="text" name="lugar_nacimiento_ciudad" placeholder="Ciudad" class="form-control @error('lugar_nacimiento_ciudad') is-invalid @enderror" value="{{ old('lugar_nacimiento_ciudad') }}">
                <input type="date" name="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid @enderror" value="{{ old('fecha_nacimiento') }}" id="fecha_nacimiento">
            </div>
            @error('lugar_nacimiento_estado', 'lugar_nacimiento_ciudad', 'fecha_nacimiento')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label>Edad</label>
            <input type="text" name="edad_anios" id="edad_anios" class="form-control @error('edad_anios') is-invalid @enderror" value="{{ old('edad_anios') }}" readonly>
            @error('edad_anios')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label>Estado civil</label>
            <select name="estado_civil" class="form-control @error('estado_civil') is-invalid @enderror">
                <option value="">Seleccione</option>
                <option value="Soltero/a" {{ old('estado_civil') == 'Soltero/a' ? 'selected' : '' }}>Soltero/a</option>
                <option value="Casado/a" {{ old('estado_civil') == 'Casado/a' ? 'selected' : '' }}>Casado/a</option>
                <option value="Divorciado/a" {{ old('estado_civil') == 'Divorciado/a' ? 'selected' : '' }}>Divorciado/a</option>
                <option value="Separado/a en proceso judicial" {{ old('estado_civil') == 'Separado/a en proceso judicial' ? 'selected' : '' }}>Separado/a en proceso judicial</option>
                <option value="Viudo/a" {{ old('estado_civil') == 'Viudo/a' ? 'selected' : '' }}>Viudo/a</option>
                <option value="Concubinato" {{ old('estado_civil') == 'Concubinato' ? 'selected' : '' }}>Concubinato</option>
            </select>
            @error('estado_civil')
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
            <label>Estado</label>
            <select name="domicilio_estado" id="estado" class="form-control @error('domicilio_estado') is-invalid @enderror">
                <option value="">Seleccione</option>
                <!-- Lista de estados de México -->
                <option value="Aguascalientes" {{ old('domicilio_estado') == 'Aguascalientes' ? 'selected' : '' }}>Aguascalientes</option>
                <option value="Baja California" {{ old('domicilio_estado') == 'Baja California' ? 'selected' : '' }}>Baja California</option>
                <option value="Baja California Sur" {{ old('domicilio_estado') == 'Baja California Sur' ? 'selected' : '' }}>Baja California Sur</option>
                <option value="Campeche" {{ old('domicilio_estado') == 'Campeche' ? 'selected' : '' }}>Campeche</option>
                <option value="Chiapas" {{ old('domicilio_estado') == 'Chiapas' ? 'selected' : '' }}>Chiapas</option>
                <option value="Chihuahua" {{ old('domicilio_estado') == 'Chihuahua' ? 'selected' : '' }}>Chihuahua</option>
                <option value="Ciudad de México" {{ old('domicilio_estado') == 'Ciudad de México' ? 'selected' : '' }}>Ciudad de México</option>
                <option value="Coahuila" {{ old('domicilio_estado') == 'Coahuila' ? 'selected' : '' }}>Coahuila</option>
                <option value="Colima" {{ old('domicilio_estado') == 'Colima' ? 'selected' : '' }}>Colima</option>
                <option value="Durango" {{ old('domicilio_estado') == 'Durango' ? 'selected' : '' }}>Durango</option>
                <option value="Estado de México" {{ old('domicilio_estado') == 'Estado de México' ? 'selected' : '' }}>Estado de México</option>
                <option value="Guanajuato" {{ old('domicilio_estado') == 'Guanajuato' ? 'selected' : '' }}>Guanajuato</option>
                <option value="Guerrero" {{ old('domicilio_estado') == 'Guerrero' ? 'selected' : '' }}>Guerrero</option>
                <option value="Hidalgo" {{ old('domicilio_estado') == 'Hidalgo' ? 'selected' : '' }}>Hidalgo</option>
                <option value="Jalisco" {{ old('domicilio_estado') == 'Jalisco' ? 'selected' : '' }}>Jalisco</option>
                <option value="Michoacán" {{ old('domicilio_estado') == 'Michoacán' ? 'selected' : '' }}>Michoacán</option>
                <option value="Morelos" {{ old('domicilio_estado') == 'Morelos' ? 'selected' : '' }}>Morelos</option>
                <option value="Nayarit" {{ old('domicilio_estado') == 'Nayarit' ? 'selected' : '' }}>Nayarit</option>
                <option value="Nuevo León" {{ old('domicilio_estado') == 'Nuevo León' ? 'selected' : '' }}>Nuevo León</option>
                <option value="Oaxaca" {{ old('domicilio_estado') == 'Oaxaca' ? 'selected' : '' }}>Oaxaca</option>
                <option value="Puebla" {{ old('domicilio_estado') == 'Puebla' ? 'selected' : '' }}>Puebla</option>
                <option value="Querétaro" {{ old('domicilio_estado') == 'Querétaro' ? 'selected' : '' }}>Querétaro</option>
                <option value="Quintana Roo" {{ old('domicilio_estado') == 'Quintana Roo' ? 'selected' : '' }}>Quintana Roo</option>
                <option value="San Luis Potosí" {{ old('domicilio_estado') == 'San Luis Potosí' ? 'selected' : '' }}>San Luis Potosí</option>
                <option value="Sinaloa" {{ old('domicilio_estado') == 'Sinaloa' ? 'selected' : '' }}>Sinaloa</option>
                <option value="Sonora" {{ old('domicilio_estado') == 'Sonora' ? 'selected' : '' }}>Sonora</option>
                <option value="Tabasco" {{ old('domicilio_estado') == 'Tabasco' ? 'selected' : '' }}>Tabasco</option>
                <option value="Tamaulipas" {{ old('domicilio_estado') == 'Tamaulipas' ? 'selected' : '' }}>Tamaulipas</option>
                <option value="Tlaxcala" {{ old('domicilio_estado') == 'Tlaxcala' ? 'selected' : '' }}>Tlaxcala</option>
                <option value="Veracruz" {{ old('domicilio_estado') == 'Veracruz' ? 'selected' : '' }}>Veracruz</option>
                <option value="Yucatán" {{ old('domicilio_estado') == 'Yucatán' ? 'selected' : '' }}>Yucatán</option>
                <option value="Zacatecas" {{ old('domicilio_estado') == 'Zacatecas' ? 'selected' : '' }}>Zacatecas</option>
            </select>
            @error('domicilio_estado')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label>Municipio / Delegación</label>
            <select name="domicilio_mpio" id="municipio" class="form-control @error('domicilio_mpio') is-invalid @enderror">
                <option value="">Seleccione</option>
                <!-- Aquí se cargarán los municipios según el estado seleccionado -->
            </select>
            @error('domicilio_mpio')
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
            <label>Calle</label>
            <input type="text" name="domicilio_calle" class="form-control @error('domicilio_calle') is-invalid @enderror" value="{{ old('domicilio_calle') }}">
            @error('domicilio_calle')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label>Número Exterior / Interior</label>
            <div class="input-group">
                <input type="text" name="domicilio_num_exterior" placeholder="Núm. exterior" class="form-control @error('domicilio_num_exterior') is-invalid @enderror" value="{{ old('domicilio_num_exterior') }}">
                <input type="text" name="domicilio_num_interior" placeholder="Núm. interior" class="form-control @error('domicilio_num_interior') is-invalid @enderror" value="{{ old('domicilio_num_interior') }}">
            </div>
            @error('domicilio_num_exterior', 'domicilio_num_interior')
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fechaNacimientoInput = document.getElementById('fecha_nacimiento');
    const edadInput = document.getElementById('edad_anios');
    const estadoSelect = document.getElementById('estado');
    const municipioSelect = document.getElementById('municipio');

    fechaNacimientoInput.addEventListener('change', function() {
        const today = new Date();
        const birthDate = new Date(fechaNacimientoInput.value);
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        edadInput.value = age;
    });

    estadoSelect.addEventListener('change', function() {
        const estado = estadoSelect.value;
        // Fetch municipios based on selected estado
        fetch(`/api/municipios/${estado}`)
            .then(response => response.json())
            .then(data => {
                municipioSelect.innerHTML = '<option value="">Seleccione</option>';
                data.forEach(municipio => {
                    municipioSelect.innerHTML += `<option value="${municipio}">${municipio}</option>`;
                });
            });
    });
});
</script>
@endsection
