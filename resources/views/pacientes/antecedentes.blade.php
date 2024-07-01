@extends('layouts.app')

@section('content')
<div class="container" style="text-align: center;">
    <h1 style="margin-bottom: 20px;">Antecedentes de {{ $paciente->nombre_nombres }} {{ $paciente->nombre_apellido_paterno }} {{ $paciente->nombre_apellido_materno }}</h1>

    <div class="row">
        @if ($fichaReciente)
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Antecedentes Patológicos Hereditarios</h5>
                        <a href="{{ route('familyHistory.edit', ['fic_ident_idfi' => $fichaReciente->idfi]) }}" class="btn btn-primary">Ver Antecedentes</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Antecedentes Personales Patológicos</h5>
                        <a href="{{ route('pathological.edit', ['fic_ident_idfi' => $fichaReciente->idfi]) }}" class="btn btn-primary">Ver Antecedentes</a>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Antecedentes Personales no Patológicos</h5>
                    <a href="{{ route('nonPathological.edit', ['fic_ident_idfi' => $fichaReciente->idfi]) }}" class="btn btn-primary">Ver Antecedentes</a>                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Exploración Física</h5>
                    <a href="{{ route('exploracion.edit', ['fic_ident_idfi' => $fichaReciente->idfi]) }}" class="btn btn-primary">Ver Exploración Física</a>                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Interrogatorio por Aparatos y Sistemas</h5>
                    <a href="{{ route('interrogatorio.edit', ['fic_ident_idfi' => $fichaReciente->idfi]) }}" class="btn btn-primary">Ver Interrogatorio</a>                </div>
            </div>
        </div>
    </div>
</div>
@endsection
