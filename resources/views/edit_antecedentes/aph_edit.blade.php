@extends('layouts.app')

@section('content')
<div class="form-container" style="max-width: 800px; margin: 0 auto;">
    <h3>Antecedentes patológicos hereditarios</h3>
    <h4>Padecimientos de familiares en línea directa</h4>

    <form method="POST" action="{{ $aph ? route('familyHistory.update', $aph->fic_ident_idfi) : route('familyHistory.store') }}">
        @csrf
        @if ($aph)
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="mother">Madre</label>
            <textarea id="mother" name="madre" placeholder="Detalles de la madre" class="form-control" style="width: 100%; height: 100px; resize: none; overflow-wrap: break-word;">{{ $aph->madre ?? '' }}</textarea>
        </div>

        <div class="form-group">
            <label for="father">Padre</label>
            <textarea id="father" name="padre" placeholder="Detalles del padre" class="form-control" style="width: 100%; height: 100px; resize: none; overflow-wrap: break-word;">{{ $aph->padre ?? '' }}</textarea>
        </div>

        <div class="form-group">
            <label for="siblings">Hermanos</label>
            <textarea id="siblings" name="hermanos" placeholder="Detalles de los hermanos" class="form-control" style="width: 100%; height: 100px; resize: none; overflow-wrap: break-word;">{{ $aph->hermanos ?? '' }}</textarea>
        </div>

        <div class="form-group">
            <label for="children">Hijos</label>
            <textarea id="children" name="hijos" placeholder="Detalles de los hijos" class="form-control" style="width: 100%; height: 100px; resize: none; overflow-wrap: break-word;">{{ $aph->hijos ?? '' }}</textarea>
        </div>

        <div class="form-column">
            <div class="form-group">
                <label for="spouse">Esposo(a)</label>
                <textarea id="spouse" name="esposo_a" placeholder="Detalles del esposo(a)" class="form-control" style="width: 100%; height: 100px; resize: none; overflow-wrap: break-word;">{{ $aph->esposo_a ?? '' }}</textarea>
            </div>

            <div class="form-group">
                <label for="uncles">Tíos</label>
                <textarea id="uncles" name="tios" placeholder="Detalles de los tíos" class="form-control" style="width: 100%; height: 100px; resize: none; overflow-wrap: break-word;">{{ $aph->tios ?? '' }}</textarea>
            </div>

            <div class="form-group">
                <label for="grandparents">Abuelos</label>
                <textarea id="grandparents" name="abuelos" placeholder="Detalles de los abuelos" class="form-control" style="width: 100%; height: 100px; resize: none; overflow-wrap: break-word;">{{ $aph->abuelos ?? '' }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <input type="submit" value="Guardar Cambios" class="btn btn-primary">
            <a href="{{ route('nonPathological.create') }}" class="btn btn-orange">Siguiente</a>
        </div>
    </form>
</div>
@endsection
