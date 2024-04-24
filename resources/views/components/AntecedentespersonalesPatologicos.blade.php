@extends('layouts.app')

@section('content')
<div class="contact-form" style="margin: 0 auto; width: 800px;">
    <h3>Antecedentes personales patológicos</h3>
    <form method="POST" action="{{ route('pathological.store') }}">
        @csrf
        <div class="form-group">
            <label for="inflammatoryDiseases">Enfermedades inflamatorias e infecciosas no transmisibles</label>
            <input type="text" id="inflammatoryDiseases" name="enfermedades_inflamatorias_infecciosas_no_trasmisibles" placeholder="Detalles de las enfermedades" class="form-control @error('enfermedades_inflamatorias_infecciosas_no_trasmisibles') is-invalid @enderror" value="{{ old('enfermedades_inflamatorias_infecciosas_no_trasmisibles') }}">
            @error('enfermedades_inflamatorias_infecciosas_no_trasmisibles')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="sexualDiseases">Enfermedades de transmisión sexual</label>
            <input type="text" id="sexualDiseases" name="enfermedades_trasmision_sexual" placeholder="Detalles de las enfermedades" class="form-control @error('enfermedades_trasmision_sexual') is-invalid @enderror" value="{{ old('enfermedades_trasmision_sexual') }}">
            @error('enfermedades_trasmision_sexual')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="degenerativeDiseases">Enfermedades degenerativas</label>
            <input type="text" id="degenerativeDiseases" name="enfermedades_degenerativas" placeholder="Detalles de las enfermedades" class="form-control @error('enfermedades_degenerativas') is-invalid @enderror" value="{{ old('enfermedades_degenerativas') }}">
            @error('enfermedades_degenerativas')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="neoplasticDiseases">Enfermedades neoplásicas</label>
            <input type="text" id="neoplasticDiseases" name="enfermedades_neoplasicas" placeholder="Detalles de las enfermedades" class="form-control @error('enfermedades_neoplasicas') is-invalid @enderror" value="{{ old('enfermedades_neoplasicas') }}">
            @error('enfermedades_neoplasicas')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="congenitalDiseases">Enfermedades congénitas</label>
            <input type="text" id="congenitalDiseases" name="enfermedades_congenitas" placeholder="Detalles de las enfermedades" class="form-control @error('enfermedades_congenitas') is-invalid @enderror" value="{{ old('enfermedades_congenitas') }}">
            @error('enfermedades_congenitas')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="otherDiseases">Otras</label>
            <input type="text" id="otherDiseases" name="otras" placeholder="Detalles de otras enfermedades" class="form-control @error('otras') is-invalid @enderror" value="{{ old('otras') }}">
            @error('otras')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <button style="margin: 20px" type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
@endsection
