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
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Consulta existente</h5>
                    <button onclick="window.location.href='{{ route('consultas.existente') }}'" class="btn btn-orange">
                        <img src="{{ asset('images/existente.png') }}" alt="Consulta Existente" height="40">
                    </button>
                </div>
            </div>
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Agendar Cita</h5>
                    <button onclick="window.location.href='{{ route('citas.create') }}'" class="btn btn-orange">
                        <img src="{{ asset('images/cita.png') }}" alt="Agendar Cita" height="40">
                    </button>
                </div>
            </div>
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Ver Citas</h5>
                    <button onclick="window.location.href='{{ route('citas.index') }}'" class="btn btn-orange">
                        <img src="{{ asset('images/ver_citas.png') }}" alt="Ver Citas" height="40">
                    </button>
                </div>
            </div>
            
        </div>

        <div class="col-lg-8 col-md-12">
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

    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endif
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Datos y colores ordenados
        const data = [
            { name: 'Visitantes', y: {{ $visitantesPorcentaje }} },
            { name: 'Administrativos', y: {{ $administrativosPorcentaje }} },
            { name: 'Alumnos', y: {{ $alumnosPorcentaje }} },
            { name: 'Maestros', y: {{ $maestrosPorcentaje }} }
        ].sort((a, b) => a.y - b.y);

        const colors = ['#fff7bc', '#fee78a', '#f8a348', '#e15244'];

        Highcharts.chart('pieChartContainer', {
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 45
                }
            },
            title: {
                text: 'Porcentajes de Consultas por Tipo de Usuario',
                align: 'left'
            },
            subtitle: {
                text: '3D donut en Highcharts',
                align: 'left'
            },
            plotOptions: {
                pie: {
                    innerSize: 100,
                    depth: 45,
                    colors: colors
                }
            },
            series: [{
                name: 'Porcentaje',
                data: data
            }]
        });

        // Datos para el gráfico de columnas
        const columnData = [
            ['Atencion Primaria', {{ $totalesPorTipoConsulta['Atencion Primaria'] }}],
            ['Especialista', {{ $totalesPorTipoConsulta['Especialista'] }}],
            ['Control y seguimiento', {{ $totalesPorTipoConsulta['Control y seguimiento'] }}],
            ['Prevención', {{ $totalesPorTipoConsulta['Prevención'] }}],
            ['Pediatrica', {{ $totalesPorTipoConsulta['Pediatrica'] }}]
        ];

        const columnColors = ['#D45E80', '#C6838C', '#CFBF9E', '#F7DEA8', '#F6BE5F'];

        Highcharts.chart('columnChartContainer', {
            chart: {
                type: 'column',
                options3d: {
                    enabled: true,
                    alpha: 15,
                    beta: 15,
                    depth: 50,
                    viewDistance: 25
                }
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    enabled: false
                }
            },
            tooltip: {
                headerFormat: '<b>{point.key}</b><br>',
                pointFormat: 'Consultas: {point.y}'
            },
            title: {
                text: 'Total de Consultas por Tipo',
                align: 'left'
            },
            subtitle: {
                text: 'Fuente: Sistema de Consultas',
                align: 'left'
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                column: {
                    depth: 25
                },
                series: {
                    colorByPoint: true,
                    colors: columnColors
                }
            },
            series: [{
                data: columnData,
                colorByPoint: true
            }]
        });
    });
</script>

@endsection
