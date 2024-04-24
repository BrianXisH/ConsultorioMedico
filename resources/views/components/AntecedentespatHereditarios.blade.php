@extends('layouts.app')

@section('content')
<div class="form-container" style="max-width: 800px; margin: 0 auto;">
    <h3>Antecedentes patológicos hereditarios</h3>
    <h4>Padecimientos de familiares en línea directa</h4>

    <form method="POST" action="{{ route('familyHistory.store') }}">
        @csrf
        <div class="form-group">
            <label for="mother">Madre</label>
            <textarea id="mother" name="madre" placeholder="Detalles de la madre" class="form-control @error('mother') is-invalid @enderror" style="width: 100%; height: 100px; resize: none; overflow-wrap: break-word;">{{ old('mother') }}</textarea>
            @error('mother')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="father">Padre</label>
            <textarea id="father" name="padre" placeholder="Detalles del padre" class="form-control @error('father') is-invalid @enderror" style="width: 100%; height: 100px; resize: none; overflow-wrap: break-word;">{{ old('father') }}</textarea>
            @error('father')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="siblings">Hermanos</label>
            <textarea id="siblings" name="hermanos" placeholder="Detalles de los hermanos" class="form-control @error('siblings') is-invalid @enderror" style="width: 100%; height: 100px; resize: none; overflow-wrap: break-word;">{{ old('siblings') }}</textarea>
            @error('siblings')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="children">Hijos</label>
            <textarea id="children" name="hijos" placeholder="Detalles de los hijos" class="form-control @error('children') is-invalid @enderror" style="width: 100%; height: 100px; resize: none; overflow-wrap: break-word;">{{ old('children') }}</textarea>
            @error('children')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-column">
            <div class="form-group">
                <label for="spouse">Esposo(a)</label>
                <textarea id="spouse" name="esposo_a" placeholder="Detalles del esposo(a)" class="form-control @error('spouse') is-invalid @enderror" style="width: 100%; height: 100px; resize: none; overflow-wrap: break-word;">{{ old('spouse') }}</textarea>
                @error('spouse')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="form-group">
                <label for="uncles">Tíos</label>
                <textarea id="uncles" name="tios" placeholder="Detalles de los tíos" class="form-control @error('uncles') is-invalid @enderror" style="width: 100%; height: 100px; resize: none; overflow-wrap: break-word;">{{ old('uncles') }}</textarea>
                @error('uncles')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="form-group">
                <label for="grandparents">Abuelos</label>
                <textarea id="grandparents" name="abuelos" placeholder="Detalles de los abuelos" class="form-control @error('grandparents') is-invalid @enderror" style="width: 100%; height: 100px; resize: none; overflow-wrap: break-word;">{{ old('grandparents') }}</textarea>
                @error('grandparents')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
@endsection