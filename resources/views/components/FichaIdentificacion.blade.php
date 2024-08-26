@extends('layouts.app')

@section('content')
<div class="container-fluid my-1" style="background-color: #ffffff; border-radius: 10px;"> 

    <!-- Grid Layout -->
    <div class="grid-container mb-4">
        <div class="grid-item div1">
            <h2 class="text-orange">Información del Paciente</h2>
            <form method="POST" action="{{ route('ficha.store') }}" class="form-container">
                @csrf

                <div class="form-group">
                    <label class="text-orange">CURP</label>
                    <div class="input-group">
                        <input type="text" name="curp" placeholder="CURP" class="form-control @error('curp') is-invalid @enderror" value="{{ old('curp') }}">
                        @error('curp')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="text-orange">Nombre</label>
                    <div class="input-group">
                        <input type="text" name="nombre_apellido_paterno" placeholder="Apellido paterno" class="form-control @error('nombre_apellido_paterno') is-invalid @enderror" value="{{ old('nombre_apellido_paterno') }}">
                        @error('nombre_apellido_paterno')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                        <input type="text" name="nombre_apellido_materno" placeholder="Apellido materno" class="form-control @error('nombre_apellido_materno') is-invalid @enderror" value="{{ old('nombre_apellido_materno') }}">
                        @error('nombre_apellido_materno')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                        <input type="text" name="nombre_nombres" placeholder="Nombre(s)" class="form-control @error('nombre_nombres') is-invalid @enderror" value="{{ old('nombre_nombres') }}">
                        @error('nombre_nombres')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="text-orange">Género</label>
                    <div>
                        <label><input type="radio" value="masculino" name="genero" {{ old('genero') == 'masculino' ? 'checked' : '' }}> Masculino</label>
                        <label><input type="radio" value="femenino" name="genero" {{ old('genero') == 'femenino' ? 'checked' : '' }}> Femenino</label>
                    </div>
                    @error('genero')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="text-orange">Lugar y fecha de nacimiento</label>
                    <div class="input-group">
                        <select name="lugar_nacimiento_estado" id="nacimiento_estado" class="form-control @error('lugar_nacimiento_estado') is-invalid @enderror">
                            <option value="">Seleccione Estado</option>
                            @foreach($estados as $estado)
                                <option value="{{ $estado->id }}" {{ old('lugar_nacimiento_estado') == $estado->id ? 'selected' : '' }}>{{ $estado->nombre }}</option>
                            @endforeach
                        </select>
                        @error('lugar_nacimiento_estado')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                        <select name="lugar_nacimiento_ciudad" id="nacimiento_municipio" class="form-control @error('lugar_nacimiento_ciudad') is-invalid @enderror">
                            <option value="">Seleccione Municipio</option>
                        </select>
                        @error('lugar_nacimiento_ciudad')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                        <input type="date" name="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid @enderror" value="{{ old('fecha_nacimiento') }}" id="fecha_nacimiento" min="1900-01-01" max="{{ date('Y-m-d') }}">
                        @error('fecha_nacimiento')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="text-orange">Edad</label>
                    <input type="text" name="edad_anios" id="edad_anios" class="form-control @error('edad_anios') is-invalid @enderror" value="{{ old('edad_anios') }}" readonly>
                    @error('edad_anios')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="text-orange">Estado civil</label>
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
                    <label class="text-orange">Ocupación</label>
                    <input type="text" name="ocupacion" class="form-control @error('ocupacion') is-invalid @enderror" value="{{ old('ocupacion') }}">
                    @error('ocupacion')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="text-orange">Tipo de Paciente</label>
                    <select name="tipo_usuario" class="form-control @error('tipo_usuario') is-invalid @enderror">
                        <option value="">Seleccione</option>
                        <option value="Alumno" {{ old('tipo_usuario') == 'Alumno' ? 'selected' : '' }}>Alumno</option>
                        <option value="Profesor" {{ old('tipo_usuario') == 'Profesor' ? 'selected' : '' }}>Profesor</option>
                        <option value="Administrativo" {{ old('tipo_usuario') == 'Administrativo' ? 'selected' : '' }}>Administrativo</option>
                        <option value="Visitante" {{ old('tipo_usuario') == 'Visitante' ? 'selected' : '' }}>Visitante</option>
                    </select>
                    @error('tipo_usuario')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </form>
        </div>

        <div class="grid-item div2">
            <h2 class="text-orange">Información de Contacto</h2>

            <form method="POST" action="{{ route('ficha.store') }}" class="form-container">
                @csrf

                <div class="form-group">
                    <label class="text-orange">Estado</label>
                    <select name="domicilio_estado" id="estado" class="form-control @error('domicilio_estado') is-invalid @enderror">
                        <option value="">Seleccione</option>
                        @foreach($estados as $estado)
                            <option value="{{ $estado->id }}" {{ old('domicilio_estado') == $estado->id ? 'selected' : '' }}>{{ $estado->nombre }}</option>
                        @endforeach
                    </select>
                    @error('domicilio_estado')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="text-orange">Municipio / Delegación</label>
                    <select name="domicilio_mpio" id="municipio" class="form-control @error('domicilio_mpio') is-invalid @enderror">
                        <option value="">Seleccione</option>
                        <!-- Aquí se cargarán los municipios según el estado seleccionado -->
                    </select>
                    @error('domicilio_mpio')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="text-orange">Colonia</label>
                    <input type="text" name="domicilio_colonia" class="form-control @error('domicilio_colonia') is-invalid @enderror" value="{{ old('domicilio_colonia') }}">
                    @error('domicilio_colonia')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="text-orange">Calle</label>
                    <input type="text" name="domicilio_calle" class="form-control @error('domicilio_calle') is-invalid @enderror" value="{{ old('domicilio_calle') }}">
                    @error('domicilio_calle')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="text-orange">Número Exterior / Interior</label>
                    <div class="input-group">
                        <input type="text" name="domicilio_num_exterior" placeholder="Núm. exterior" class="form-control @error('domicilio_num_exterior') is-invalid @enderror" value="{{ old('domicilio_num_exterior') }}">
                        @error('domicilio_num_exterior')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                        <input type="text" name="domicilio_num_interior" placeholder="Núm. interior" class="form-control @error('domicilio_num_interior') is-invalid @enderror" value="{{ old('domicilio_num_interior') }}">
                        @error('domicilio_num_interior')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="text-orange">Teléfono</label>
                    <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}">
                    @error('telefono')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="text-orange">Teléfono de oficina</label>
                    <input type="text" name="telefono_oficina" class="form-control @error('telefono_oficina') is-invalid @enderror" value="{{ old('telefono_oficina') }}">
                    @error('telefono_oficina')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="submit" value="Enviar" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
    
    <!-- Original Content -->
    <div class="column">
        <div class="col-lg-12 col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div id="pieChartContainer" style="width: 100%; height: 360px;"></div>
                </div>
            </div>
            <div class="card shadow-sm mt-4">
                <div class="card-body">
                    <div id="columnChartContainer" style="width: 100%; height: 360px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS del Grid -->
<style>
.grid-container {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-template-rows: repeat(3, 1fr);
    gap: 5px;
    padding: 10px;
    margin-bottom: 20px;
}

.grid-item {
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: flex-start;
    color: white;
    font-size: 1.2em;
    padding: 15px;
    border-radius: 5px;
    border: 2px solid white;
}

.div1 {
    grid-column: span 2; /* Ocupa 2 columnas */
    grid-row: span 2; /* Ocupa 2 filas */
    
}

.div2 {
    grid-column: span 2; /* Ocupa 2 columnas */
    grid-row: span 2; /* Ocupa 2 filas */
}

.text-orange {
    color: #555555; /* Utilizando un tono naranja similar */
}

.form-group {
    margin-bottom: 10px;
}

.form-control {
    margin-bottom: 5px;
}

.btn-primary {
    background-color: #4CAF50;
    border-color: #4CAF50;
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var fechaNacimientoInput = document.getElementById('fecha_nacimiento');
        
        fechaNacimientoInput.addEventListener('change', function() {
            var fechaNacimiento = new Date(this.value);
            var fechaActual = new Date();
            var edadMinima = 0; // Edad mínima permitida, puedes ajustarla según tus necesidades.
            var edadMaxima = 150; // Edad máxima permitida, puedes ajustarla según tus necesidades.
            
            var diferenciaEnMilisegundos = fechaActual - fechaNacimiento;
            var edadEnAnios = diferenciaEnMilisegundos / (1000 * 60 * 60 * 24 * 365.25);
            
            if (edadEnAnios < edadMinima || edadEnAnios > edadMaxima) {
                this.setCustomValidity('La fecha de nacimiento no es válida. La edad debe estar entre ' + edadMinima + ' y ' + edadMaxima + ' años.');
            } else {
                this.setCustomValidity('');
            }
        });
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fechaNacimientoInput = document.getElementById('fecha_nacimiento');
    const edadInput = document.getElementById('edad_anios');
    const estadoSelect = document.getElementById('estado');
    const municipioSelect = document.getElementById('municipio');
    const nacimientoEstadoSelect = document.getElementById('nacimiento_estado');
    const nacimientoMunicipioSelect = document.getElementById('nacimiento_municipio');

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

    nacimientoEstadoSelect.addEventListener('change', function() {
        const estadoId = nacimientoEstadoSelect.value;
        // Fetch municipios based on selected estado
        fetch(`/api/municipios/${estadoId}`)
            .then(response => response.json())
            .then(data => {
                nacimientoMunicipioSelect.innerHTML = '<option value="">Seleccione</option>';
                data.forEach(municipio => {
                    nacimientoMunicipioSelect.innerHTML += `<option value="${municipio.id}">${municipio.nombre}</option>`;
                });
            })
            .catch(error => console.error('Error fetching municipios:', error));
    });

    estadoSelect.addEventListener('change', function() {
        const estadoId = estadoSelect.value;
        // Fetch municipios based on selected estado
        fetch(`/api/municipios/${estadoId}`)
            .then(response => response.json())
            .then(data => {
                municipioSelect.innerHTML = '<option value="">Seleccione</option>';
                data.forEach(municipio => {
                    municipioSelect.innerHTML += `<option value="${municipio.id}">${municipio.nombre}</option>`;
                });
            })
            .catch(error => console.error('Error fetching municipios:', error));
    });
});
</script>
@endsection
