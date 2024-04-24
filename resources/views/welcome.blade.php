@extends('layouts.app')

@section('content')
<div class="estadisticas" style="display: flex; justify-content: space-between; align-items: center; padding: 20px;">
    <div class="grafica-container" style="position: relative; top: 40px; left: 73px; width: 719px; height: 400px; background: #FFFFFF; border-radius: 6px; box-shadow: 0px 0px 1px #171a1f, 0px 0px 2px #171a1f;">
        <canvas id="pieChart"></canvas>
    </div>

    <div class="botones-container" style="position: absolute; top: 200px; left: 880px; width: 454px; height: 261px; background: #FFFFFF; border-radius: 4px; box-shadow: 0px 0px 1px #171a1f, 0px 0px 2px #171a1f; display: flex; flex-direction: column; justify-content: center; align-items: center;">
        <div class="boton" style="margin-bottom: 20px; text-align: center;">
            <span style="display: block; margin-bottom: 10px;">Nueva Consulta</span>
            <button onclick="window.location.href='{{ route('consultas.nueva') }}'" style="padding: 10px 20px; background-color: #007bff; color: #FFFFFF; border: none; border-radius: 4px; cursor: pointer;">Crear nueva consulta</button>
        </div>
        <div class="boton" style="margin-bottom: 20px; text-align: center;">
            <span style="display: block; margin-bottom: 10px;">Consulta existente</span>
            <button onclick="window.location.href='{{ route('consultas.existente') }}'" style="padding: 10px 20px; background-color: #007bff; color: #FFFFFF; border: none; border-radius: 4px; cursor: pointer;">Crear consulta existente</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Aquí puedes hacer una solicitud AJAX para obtener los datos de la base de datos
        // Supongamos que tienes los datos en el siguiente formato:
        const data = {
            labels: ['Maestros', 'Alumnos', 'Administrativos'],
            datasets: [{
                data: [{{ $maestrosPorcentaje }}, {{ $alumnosPorcentaje }}, {{ $administrativosPorcentaje }}],
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
            }]
        };

        const ctx = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(ctx, {
            type: 'pie',
            data: data
        });
    });
</script>
@endpush
