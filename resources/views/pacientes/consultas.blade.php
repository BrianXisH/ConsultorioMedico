@extends('layouts.app')

@section('content')
<div class="container" style="text-align: center;">
    <h1 style="margin-bottom: 20px;">Consultas de {{ $paciente->nombre_nombres }} {{ $paciente->nombre_apellido_paterno }} {{ $paciente->nombre_apellido_materno }}</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Fecha de Consulta</th>
                <th>Fecha Última Consulta</th>
                <th>Motivo Última Consulta</th>
                <th>Tipo de Consulta</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($consultas as $consulta)
                <tr>
                    <td>{{ $consulta->fecha_consulta }}</td>
                    <td>{{ $consulta->fecha_ultima_consulta }}</td>
                    <td>{{ $consulta->motivo_ultima_consulta }}</td>
                    <td>{{ $consulta->tipo_consulta }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $consultas->links() }}
    </div>

    <!-- Botón de ver antecedentes -->
    <div class="mt-4">
        <a href="{{ route('pacientes.antecedentes', ['id' => $paciente->idpacientes]) }}" class="btn btn-primary">Ver Antecedentes</a>    </div>
</div>
@endsection
