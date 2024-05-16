@extends('layouts.app')

@section('content')
<div class="container" style="text-align: center;">
    <h1 style="margin-bottom: 20px;">Búsqueda de Pacientes</h1>
    <form method="GET" action="{{ route('pacientes.index') }}" style="margin-bottom: 20px;">
        <input type="text" name="search" placeholder="Buscar pacientes..." value="{{ request('search') }}" style="margin-right: 10px; padding: 5px;">
        <button type="submit" style="padding: 5px 10px; background-color: #007bff; color: white; border: none; border-radius: 5px;">Buscar</button>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>NOMBRE</th>
                <th>EDAD</th>
                <th>SEXO</th>
                <th>TELÉFONO</th>
                <th>CURP</th>
                <th>TIPO DE CONSULTA</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pacientes as $paciente)
                <tr>
                    <td>{{ $paciente->nombre_nombres }} {{ $paciente->nombre_apellido_paterno }} {{ $paciente->nombre_apellido_materno }}</td>
                    <td>{{ $paciente->edad_anios }}</td>
                    <td>{{ $paciente->genero_masculino ? 'Masculino' : ($paciente->genero_femenino ? 'Femenino' : 'No especificado') }}</td>
                    <td>{{ $paciente->telefono }}</td>
                    <td>{{ $paciente->curp }}</td>
                    <td>{{ $paciente->tipo_consulta }}</td>
                    <td>
                        <a href="{{ route('pacientes.show', $paciente->idpacientes) }}" style="text-decoration: none; padding: 5px 10px; background-color: #007bff; color: white; border: none; border-radius: 5px;">Seleccionar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <nav>
        <ul class="pagination pagination-lg">
            {{-- Previous Page Link --}}
            @if ($pacientes->onFirstPage())
                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $pacientes->previousPageUrl() }}" rel="prev">&laquo;</a></li>
            @endif
      
            {{-- Pagination Elements --}}
            @foreach ($pacientes->links() as $page => $url)
                <li class="page-item {{ $pacientes->currentPage() == $page ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach
      
            {{-- Next Page Link --}}
            @if ($pacientes->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $pacientes->nextPageUrl() }}" rel="next">&raquo;</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
            @endif
        </ul>
    </nav>
</div>
@endsection
