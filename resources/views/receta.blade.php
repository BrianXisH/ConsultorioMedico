<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receta médica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <p>Nombre: {{ $selectedPaciente->nombre_nombres }}</p>
    <p>Email: {{ $selectedPaciente->email }}</p>
    @endif

    <form id="recetaForm" action="{{ route('receta.store') }}" method="POST">
        @csrf
        <div id="medicamentos" class="mb-3">
            <label for="medicamento1" class="form-label">Medicamento 1</label>
            <input type="text" class="form-control" id="medicamento1" name="medicamento[]">
        </div>

        <button type="button" onclick="addMedicamento()" class="btn btn-secondary">+</button>

        <div class="mb-3">
            <label for="instrucciones" class="form-label">Agregue las instrucciones aquí</label>
            <textarea class="form-control" id="instrucciones" name="instrucciones" rows="4" placeholder="Instrucciones..."></textarea>
        </div>

        <div class="mb-3">
            <label for="diagnostico" class="form-label">Diagnóstico</label>
            <textarea class="form-control" id="diagnostico" name="diagnostico" rows="4" placeholder="Diagnóstico..."></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar e Imprimir</button>
    </form>

    <script>
