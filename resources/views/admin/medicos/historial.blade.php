<!-- resources/views/admin/medicos/historial.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Historial de {{ $medico->name }}</h1>

    <a href="{{ route('admin.medicos.index') }}" class="btn btn-secondary mb-3">Regresar al Listado de Médicos</a>

    <h3>Consultas Realizadas</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Consulta</th>
                <th>Receta</th>
                <th>Diagnóstico</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($consultas as $consulta)
                <tr>
                    <td>{{ $consulta->idconsultas }}</td>
                    <td>{{ $consulta->receta }}</td>
                    <td>{{ $consulta->diagnostico }}</td>
                    <td>{{ $consulta->created_at ? $consulta->created_at->format('d-m-Y') : 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
