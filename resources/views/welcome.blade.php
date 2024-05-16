@extends('layouts.app')

@section('content')

<style>
    .btn-orange {
        background-color: rgba(255, 166, 0, 0.834);
        color: white; /* Cambia el color del texto a blanco para que sea legible en el fondo naranja */
    }
</style>

<div class="container my-4">
    <div class="row">
        <div class="col-lg-4 col-md-12 mb-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Registrar usuario</h5>
                    <button onclick="window.location.href='{{ route('paciente.registrar') }}'" class="btn btn-orange">
                        <img src="{{ asset('images/paciente.png') }}" alt="Registrar Paciente" height="40">
                    </button>
                </div>
            </div>
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Nueva Consulta</h5>
                    <button onclick="window.location.href='{{ route('consultas.nueva') }}'" class="btn btn-orange">
                        <img src="{{ asset('images/consulta.png') }}" alt="Nueva Consulta" height="40">
                    </button>
                </div>
            </div>
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Consulta existente</h5>
                    <button onclick="window.location.href='{{ route('consultas.existente') }}'" class="btn btn-orange">
                        <img src="{{ asset('images/existente.png') }}" alt="Consulta Existente" height="40">
                    </button>
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endif
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
