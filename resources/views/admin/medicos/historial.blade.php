@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Historial de {{ $medico->name }}</h1>

    <a href="{{ route('admin.medicos.index') }}" class="btn btn-secondary mb-3">Regresar al Listado de Médicos</a>

    <form method="GET" action="{{ route('admin.medicos.historial', $medico->id) }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <label for="fecha" class="form-label">Filtrar por Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" value="{{ request('fecha') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label">&nbsp;</label>
                <button type="submit" class="btn btn-secondary">Filtrar</button>
                <a href="{{ route('admin.medicos.historial', $medico->id) }}" class="btn btn-light">Limpiar Filtro</a>
            </div>
        </div>
    </form>

    <h3>Consultas Realizadas</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Consulta</th>
                <th>Receta</th>
                <th>Diagnóstico</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($consultas as $consulta)
                <tr>
                    <td>{{ $consulta->idconsultas }}</td>
                    <td>{{ $consulta->receta }}</td>
                    <td>{{ $consulta->diagnostico }}</td>
                    <td>{{ $consulta->created_at ? $consulta->created_at->format('d-m-Y') : 'N/A' }}</td>
                    <td>
                        <a href="{{ route('receta.pdf', $consulta->idconsultas) }}" class="btn btn-primary">Ver Receta</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
