
@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <title>Receta médica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .no-border {
            border: none !important;
            outline: none !important;
        }
    </style>
</head>
<body style="margin: 0 auto; width: 800px;">
    @php
        $selectedPacienteId = session('selectedPacienteId');
        $selectedPaciente = App\Models\Paciente::find($selectedPacienteId);
    @endphp

    <h1>{{ $title ?? 'Receta Médica' }}</h1>
    <p>Fecha: {{ $date ?? now()->format('d-m-Y') }}</p>

    <h3>Datos del Médico</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Fecha de Registro</th>
                <th>Cédula Profesional</th>
                <th>Escuela de Procedencia</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('d-m-Y') }}</td>
                <td>{{ $user->cedula_profesional }}</td>
                <td>{{ $user->escuela_de_procedencia }}</td>
            </tr>
        </tbody>
    </table>

    @if($selectedPaciente)
    <h3>Paciente:</h3>
    <p>Nombre: {{ $selectedPaciente->nombre_nombres }} {{ $selectedPaciente->nombre_apellido_paterno }} {{ $selectedPaciente->nombre_apellido_materno }}</p>
    <p style="display: inline;">Edad: {{ $selectedPaciente->edad_anios }} años</p>
    @endif

    <form id="recetaForm" action="{{ route('receta.store') }}" method="POST">
        @csrf
        <div id="medicamentos" class="mb-3">
            <label for="medicamento1" class="form-label">Medicamento 1</label>
            <input type="text" class="form-control" id="medicamento1" name="medicamento[]" placeholder="Ingrese el medicamento">
            <label for="instruccion1" class="form-label">Instrucción 1</label>
            <textarea class="form-control" id="instruccion1" name="instrucciones[]" rows="2" placeholder="Ingrese las instrucciones"></textarea>
        </div>

        <button type="button" onclick="addMedicamento()" class="btn btn-secondary">+</button>

        <div class="mb-3">
            <label for="diagnostico" class="form-label">Diagnóstico</label>
            <textarea class="form-control" id="diagnostico" name="diagnostico" rows="4" placeholder="Diagnóstico..."></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar e Imprimir</button>
    </form>

    <script>
        function addMedicamento() {
            const medicamentosDiv = document.getElementById('medicamentos');
            const index = medicamentosDiv.children.length / 4 + 1;

            const medicamentoLabel = document.createElement('label');
            medicamentoLabel.classList.add('form-label');
            medicamentoLabel.setAttribute('for', `medicamento${index}`);
            medicamentoLabel.textContent = `Medicamento ${index}`;

            const medicamentoInput = document.createElement('input');
            medicamentoInput.classList.add('form-control');
            medicamentoInput.setAttribute('type', 'text');
            medicamentoInput.setAttribute('id', `medicamento${index}`);
            medicamentoInput.setAttribute('name', 'medicamento[]');
            medicamentoInput.setAttribute('placeholder', 'Ingrese el medicamento');

            const instruccionLabel = document.createElement('label');
            instruccionLabel.classList.add('form-label');
            instruccionLabel.setAttribute('for', `instruccion${index}`);
            instruccionLabel.textContent = `Instrucción ${index}`;

            const instruccionTextarea = document.createElement('textarea');
            instruccionTextarea.classList.add('form-control');
            instruccionTextarea.setAttribute('id', `instruccion${index}`);
            instruccionTextarea.setAttribute('name', 'instrucciones[]');
            instruccionTextarea.setAttribute('rows', '2');
            instruccionTextarea.setAttribute('placeholder', 'Ingrese las instrucciones');

            medicamentosDiv.appendChild(medicamentoLabel);
            medicamentosDiv.appendChild(medicamentoInput);
            medicamentosDiv.appendChild(instruccionLabel);
            medicamentosDiv.appendChild(instruccionTextarea);
        }
    </script>
</body>
@endsection
