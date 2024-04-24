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
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ Auth::user()->name }}</td>
                <td>{{ Auth::user()->email }}</td>
                <td>{{ Auth::user()->created_at->format('d-m-Y') }}</td>
            </tr>
        </tbody>
    </table>

    @if($selectedPaciente)
    <h3>Paciente:</h3>
    <p>Nombre: {{ $selectedPaciente->nombre_nombres }}</p>
    <p>Email: {{ $selectedPaciente->email }}</p>
    @endif

    <div id="medicamentos" class="mb-3">
        <label for="medicamento1" class="form-label">Medicamento 1</label>
        <input type="text" class="form-control" id="medicamento1" name="medicamento[]">
    </div>
    
    <button type="button" onclick="addMedicamento()" class="btn btn-secondary">+</button>

    <div class="mb-3">
        <label for="instrucciones" class="form-label">Agregue las instrucciones aquí</label>
        <textarea class="form-control" id="instrucciones" rows="4" placeholder="Instrucciones..."></textarea>
    </div>

    <button onclick="window.print();" class="btn btn-primary">Imprimir</button>
    

    <script>
        let medicamentoCount = 1;
        function addMedicamento() {
            medicamentoCount++;
            const container = document.getElementById('medicamentos');
            const newField = document.createElement('div');
            newField.innerHTML = `
                <label for="medicamento${medicamentoCount}" class="form-label">Medicamento ${medicamentoCount}</label>
                <input type="text" class="form-control" id="medicamento${medicamentoCount}" name="medicamento[]">
            `;
            container.appendChild(newField);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-i5Y2D+YEHuMvQj8lBj+9ed56s3HH+twt7z0dZOx7ElEl9Bp6id3g5e/O5Q7Zwxkw" crossorigin="anonymous"></script>
</body>
</html>
