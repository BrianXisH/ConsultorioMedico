@extends('layouts.app')

@section('content')
<div class="container" style="text-align: center;">
    <h1 style="margin-bottom: 20px;">Búsqueda de Pacientes</h1>
    <form method="GET" action="{{ route('busqueda.index') }}" style="margin-bottom: 20px;">
        <input type="text" name="search" placeholder="Buscar pacientes..." value="{{ request('search') }}" style="margin-right: 10px; padding: 5px;">
        <button type="submit" style="padding: 5px 10px; background-color: #007bff; color: white; border: none; border-radius: 5px;">Buscar</button>
    </form>

    <ul style="list-style: none; padding: 0;">
        @foreach ($pacientes as $paciente)
            <li style="margin-bottom: 10px; background-color: #f8f9fa; padding: 10px; border-radius: 5px;">
                <span style="font-weight: bold;">{{ $paciente->nombre_nombres }} {{ $paciente->nombre_apellido_paterno }} {{ $paciente->nombre_apellido_materno }}</span>
                <a href="{{ route('busqueda.show', $paciente->idpacientes) }}" style="text-decoration: none; padding: 5px 10px; background-color: #007bff; color: white; border: none; border-radius: 5px; float: right;">Seleccionar</a>
            </li>
        @endforeach
    </ul>
    <nav>
        <ul class="pagination pagination-lg"> {{-- Agrega la clase pagination-lg para hacerlo más grande --}}
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
