@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Interrogatorio por aparatos y sistemas</h3>
    <form method="POST" action="{{ route('interrogatorio.store') }}" style="margin: 0 auto; width: 800px;">
        @csrf
        <!-- Aparato Digestivo -->
        <div class="form-group">
            <label for="interrogatorio_aparato_digestivo">Aparato Digestivo</label>
            <textarea id="interrogatorio_aparato_digestivo" name="interrogatorio_aparato_digestivo" class="form-control" placeholder="Descripción breve de problemas digestivos..." style="width: 100%; height: 100px; resize: none; overflow-wrap: break-word;">{{ old('interrogatorio_aparato_digestivo') }}</textarea>
        </div>

        <!-- Aparato Respiratorio -->
        <div class="form-group">
            <label for="interrogatorio_aparato_respiratorio">Aparato Respiratorio</label>
            <textarea id="interrogatorio_aparato_respiratorio" name="interrogatorio_aparato_respiratorio" class="form-control" placeholder="Descripción breve de problemas respiratorios..." style="width: 100%; height: 100px; resize: none; overflow-wrap: break-word;">{{ old('interrogatorio_aparato_respiratorio') }}</textarea>
        </div>

        <!-- Cardiovascular -->
        <div class="form-group">
            <label for="interrogatorio_cardiovascular">Cardiovascular</label>
            <textarea id="interrogatorio_cardiovascular" name="interrogatorio_cardiovascular" class="form-control" placeholder="Descripción breve de problemas cardiovasculares..." style="width: 100%; height: 100px; resize: none; overflow-wrap: break-word;">{{ old('interrogatorio_cardiovascular') }}</textarea>
        </div>

        <!-- Aparato Genitourinario -->
        <div class="form-group">
            <label for="interrogatorio_aparato_genitourinario">Aparato Genitourinario</label>
            <textarea id="interrogatorio_aparato_genitourinario" name="interrogatorio_aparato_genitourinario" class="form-control" placeholder="Descripción breve de problemas genitourinarios..." style="width: 100%; height: 100px; resize: none; overflow-wrap: break-word;">{{ old('interrogatorio_aparato_genitourinario') }}</textarea>
        </div>

        <!-- Sistema Endocrino -->
        <div class="form-group">
            <label for="interrogatorio_sistema_endocrino">Sistema Endocrino</label>
            <textarea id="interrogatorio_sistema_endocrino" name="interrogatorio_sistema_endocrino" class="form-control" placeholder="Descripción breve de problemas endocrinos..." style="width: 100%; height: 100px; resize: none; overflow-wrap: break-word;">{{ old('interrogatorio_sistema_endocrino') }}</textarea>
        </div>

        <!-- Sistema Hemopoyético -->
        <div class="form-group">
            <label for="interrogatorio_sistema_hemepoyetico">Sistema Hemopoyético</label>
            <textarea id="interrogatorio_sistema_hemepoyetico" name="interrogatorio_sistema_hemepoyetico" class="form-control" placeholder="Descripción breve de problemas hemopoyéticos..." style="width: 100%; height: 100px; resize: none; overflow-wrap: break-word;">{{ old('interrogatorio_sistema_hemepoyetico') }}</textarea>
        </div>

        <!-- Sistema Nervioso -->
        <div class="form-group">
            <label for="interrogatorio_sistema_nervioso">Sistema Nervioso</label>
            <textarea id="interrogatorio_sistema_nervioso" name="interrogatorio_sistema_nervioso" class="form-control" placeholder="Descripción breve de problemas nerviosos..." style="width: 100%; height: 100px; resize: none; overflow-wrap: break-word;">{{ old('interrogatorio_sistema_nervioso') }}</textarea>
        </div>

        <!-- Sistema Musculoesquelético -->
        <div class="form-group">
            <label for="interrogatorio_sistema_musculoesqueletico">Sistema Musculoesquelético</label>
            <textarea id="interrogatorio_sistema_musculoesqueletico" name="interrogatorio_sistema_musculoesqueletico" class="form-control" placeholder="Descripción breve de problemas musculoesqueléticos..." style="width: 100%; height: 100px; resize: none; overflow-wrap: break-word;">{{ old('interrogatorio_sistema_musculoesqueletico') }}</textarea>
        </div>

        <!-- Sistema Tegumentario -->
        <div class="form-group">
            <label for="interrogatorio_sistema_tegumentario">Sistema Tegumentario</label>
            <textarea id="interrogatorio_sistema_tegumentario" name="interrogatorio_sistema_tegumentario" class="form-control" placeholder="Descripción breve de problemas tegumentarios..." style="width: 100%; height: 100px; resize: none; overflow-wrap: break-word;">{{ old('interrogatorio_sistema_tegumentario') }}</textarea>
        </div>

         <!-- Habitus exterior y Signos Vitales -->
         <h3>Habitus exterior y Signos Vitales</h3>
         <div class="form-group">
             <label for="habitus_exterior">Habitus exterior</label>
             <input type="text" id="habitus_exterior" name="habitus_exterior" class="form-control" placeholder="Ingrese detalles del habitus exterior" value="{{ old('habitus_exterior') }}" style="width: 100%;">
         </div>
 
         <div class="form-group">
             <label for="peso">Peso (kg)</label>
             <input type="text" id="peso" name="peso" class="form-control" placeholder="Ingrese el peso" value="{{ old('peso') }}" style="width: 100%;">
         </div>
 
         <div class="form-group">
             <label for="talla">Talla (cm)</label>
             <input type="text" id="talla" name="talla" class="form-control" placeholder="Ingrese la talla" value="{{ old('talla') }}" style="width: 100%;">
         </div>
 
         <div class="form-group">
             <label for="complexion">Complexión</label>
             <input type="text" id="complexion" name="complexion" class="form-control" placeholder="Describa la complexión" value="{{ old('complexion') }}" style="width: 100%;">
         </div>
 
         <div class="form-group">
             <label for="frecuencia_cardiaca">Frecuencia Cardíaca (latidos por minuto)</label>
             <input type="text" id="frecuencia_cardiaca" name="frecuencia_cardiaca" class="form-control" placeholder="Ingrese la frecuencia cardíaca" value="{{ old('frecuencia_cardiaca') }}" style="width: 100%;">
         </div>
 
         <div class="form-group">
             <label for="sistolica">Tensión Arterial Sistólica (mmHg)</label>
             <input type="text" id="sistolica" name="sistolica" class="form-control" placeholder="Ingrese la tensión sistólica" value="{{ old('sistolica') }}" style="width: 100%;">
         </div>
 
         <div class="form-group">
             <label for="diastolica">Tensión Arterial Diastólica (mmHg)</label>
             <input type="text" id="diastolica" name="diastolica" class="form-control" placeholder="Ingrese la tensión diastólica" value="{{ old('diastolica') }}" style="width: 100%;">
         </div>
 
         <div class="form-group">
             <label for="frecuencia_respiratoria">Frecuencia Respiratoria (respiraciones por minuto)</label>
             <input type="text" id="frecuencia_respiratoria" name="frecuencia_respiratoria" class="form-control" placeholder="Ingrese la frecuencia respiratoria" value="{{ old('frecuencia_respiratoria') }}" style="width: 100%;">
         </div>
 
         <div class="form-group">
             <label for="temperatura">Temperatura (°C)</label>
             <input type="text" id="temperatura" name="temperatura" class="form-control" placeholder="Ingrese la temperatura corporal" value="{{ old('temperatura') }}" style="width: 100%;">
         </div>
 
         <button type="submit" class="btn btn-primary" style="margin: 20px;">Enviar</button>
     </form>
 </div>
 @endsection
