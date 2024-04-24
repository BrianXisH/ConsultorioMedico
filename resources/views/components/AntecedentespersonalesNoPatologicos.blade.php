@extends('layouts.app')

@section('content')
<div class="contact-form" style="margin: 0 auto; width: 800px;">
    <h3>Antecedentes personales no patológicos</h3>
    <form method="POST" action="{{ route('nonPathological.store') }}">
        @csrf
        <div class="form-group">
            <label for="hygiene">Hábitos higiénicos: En el vestuario</label>
            <input type="text" id="hygiene" name="habitos_higienicos_vestuario" placeholder="Detalles de los hábitos higiénicos" class="form-control @error('habitos_higienicos_vestuario') is-invalid @enderror" value="{{ old('habitos_higienicos_vestuario') }}">
            @error('habitos_higienicos_vestuario')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="toothBrushing">Con qué frecuencia se lava los dientes</label>
            <input type="text" id="toothBrushing" name="habitos_higienicos_lavado_dientes_frecuencia" placeholder="Frecuencia de lavado de dientes" class="form-control @error('habitos_higienicos_lavado_dientes_frecuencia') is-invalid @enderror" value="{{ old('habitos_higienicos_lavado_dientes_frecuencia') }}">
            @error('habitos_higienicos_lavado_dientes_frecuencia')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label>Utiliza auxiliares de higiene bucal:</label>
            <div>
                <label>
                    <input type="radio" name="habitos_higienicos_utiliza_auxiliares_higiene_bucal" value="true" {{ old('habitos_higienicos_utiliza_auxiliares_higiene_bucal') == 'true' ? 'checked' : '' }}> Sí
                </label>
                <label style="margin: 15px">
                    <input type="radio" name="habitos_higienicos_utiliza_auxiliares_higiene_bucal" value="false" {{ old('habitos_higienicos_utiliza_auxiliares_higiene_bucal') == 'false' ? 'checked' : '' }}> No
                </label>
            </div>
            <input type="text" name="habitos_higienicos_auxiliares_higiene_bucal_cuales" placeholder="¿Cuáles?" class="form-control @error('habitos_higienicos_auxiliares_higiene_bucal_cuales') is-invalid @enderror" value="{{ old('habitos_higienicos_auxiliares_higiene_bucal_cuales') }}">
            @error('habitos_higienicos_auxiliares_higiene_bucal_cuales')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label>Consume golosinas u otro tipo de alimentos entre las comidas:</label>
            <div>
                <label>
                    <input type="radio" name="habitos_higienicos_consume_golosinas_otros_alimentos_comidas" value="true" {{ old('consume_golosinas_otros_alimentos_comidas') == 'true' ? 'checked' : '' }}> Sí
                </label>
                <label style="margin: 15px">
                    <input type="radio" name="habitos_higienicos_consume_golosinas_otros_alimentos_comidas" value="false" {{ old('consume_golosinas_otros_alimentos_comidas') == 'false' ? 'checked' : '' }}> No
                </label>
            </div>
        </div>

        <div class="form-group">
            <label for="grupo_sanguineo">Grupo Sanguíneo</label>
            <select id="grupo_sanguineo" name="grupo_sanguineo" class="form-control @error('grupo_sanguineo') is-invalid @enderror">
                <option value="">Seleccione su grupo sanguíneo</option>
                <option value="A+" {{ old('grupo_sanguineo') == 'A+' ? 'selected' : '' }}>A+</option>
                <option value="A-" {{ old('grupo_sanguineo') == 'A-' ? 'selected' : '' }}>A-</option>
                <option value="B+" {{ old('grupo_sanguineo') == 'B+' ? 'selected' : '' }}>B+</option>
                <option value="B-" {{ old('grupo_sanguineo') == 'B-' ? 'selected' : '' }}>B-</option>
                <option value="AB+" {{ old('grupo_sanguineo') == 'AB+' ? 'selected' : '' }}>AB+</option>
                <option value="AB-" {{ old('grupo_sanguineo') == 'AB-' ? 'selected' : '' }}>AB-</option>
                <option value="O+" {{ old('grupo_sanguineo') == 'O+' ? 'selected' : '' }}>O+</option>
                <option value="O-" {{ old('grupo_sanguineo') == 'O-' ? 'selected' : '' }}>O-</option>
            </select>
            @error('grupo_sanguineo')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        

        <div class="form-group">
            <label>Factor Rh</label>
            <input type="text" name="factor_rh" class="form-control @error('factor_rh') is-invalid @enderror" value="{{ old('factor_rh') }}">
            @error('factor_rh')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label>Cuenta con Cartilla de vacunación:</label>
            <div>
                <label>
                    <input type="radio" name="cuenta_cartilla_vacunacion" value="true" {{ old('cuenta_cartilla_vacunacion') == 'true' ? 'checked' : '' }}> Sí
                </label>
                <label style="margin: 15px">
                    <input type="radio" name="cuenta_cartilla_vacunacion" value="false" {{ old('cuenta_cartilla_vacunacion') == 'false' ? 'checked' : '' }}> No
                </label>
            </div>
        </div>

        <div class="form-group">
            <label>Tiene el esquema completo:</label>
            <div>
                <label>
                    <input type="radio" name="esquema_completo" value="true" {{ old('esquema_completo') == 'true' ? 'checked' : '' }}> Sí
                </label>
                <label style="margin: 15px">
                    <input type="radio" name="esquema_completo" value="false" {{ old('esquema_completo') == 'false' ? 'checked' : '' }}> No
                </label>
            </div>
        </div>

        <div class="form-group">
            <label for="missingVaccinations">Especifique cuál falta</label>
            <input type="text" id="missingVaccinations" name="esquema_falta" placeholder="Especifique cuál falta" class="form-control @error('esquema_falta') is-invalid @enderror" value="{{ old('esquema_falta') }}">
            @error('esquema_falta')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label>Adicciones:</label>
            <div>
                <label>
                    <input type="checkbox" name="adicciones_tabaco" value="true" {{ old('adicciones_tabaco') == 'true' ? 'checked' : '' }}> Tabaco
                </label>
                <label style="margin: 15px">
                    <input type="checkbox" name="adicciones_alcohol" value="true" {{ old('adicciones_alcohol') == 'true' ? 'checked' : '' }}> Alcohol
                </label>
            </div>
        </div>

        <div class="form-group">
            <label>Antecedentes alérgicos:</label>
            <input type="text" name="antecedentes_alergicos" class="form-control @error('antecedentes_alergicos') is-invalid @enderror" value="{{ old('antecedentes_alergicos') }}">
            @error('antecedentes_alergicos')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
            <div>
                <label>Antibióticos:</label>
                <input type="text" name="antecedentes_alergicos_antibioticos" class="form-control @error('antecedentes_alergicos_antibioticos') is-invalid @enderror" value="{{ old('antecedentes_alergicos_antibioticos') }}">
                @error('antecedentes_alergicos_antibioticos')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div>
                <label>Analgésicos:</label>
                <input type="text" name="antecedentes_alergicos_analgesicos" class="form-control @error('antecedentes_alergicos_analgesicos') is-invalid @enderror" value="{{ old('antecedentes_alergicos_analgesicos') }}">
                @error('antecedentes_alergicos_analgesicos')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div>
                <label>Anestésicos:</label>
                <input type="text" name="antecedentes_alergicos_anestesicos" class="form-control @error('antecedentes_alergicos_anestesicos') is-invalid @enderror" value="{{ old('antecedentes_alergicos_anestesicos') }}">
                @error('antecedentes_alergicos_anestesicos')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div>
                <label>Alimentos:</label>
                <input type="text" name="antecedentes_alergicos_alimentos" class="form-control @error('antecedentes_alergicos_alimentos') is-invalid @enderror" value="{{ old('antecedentes_alergicos_alimentos') }}">
                @error('antecedentes_alergicos_alimentos')
                    <span class="invalid-feedback" role="alert"><strong>{{ message }}</strong></span>
                @enderror
            </div>
            <div>
                <label>Especifique:</label>
                <input type="text" name="antecedentes_alergicos_especifique" class="form-control @error('antecedentes_alergicos_especifique') is-invalid @enderror" value="{{ old('antecedentes_alergicos_especifique') }}">
                @error('antecedentes_alergicos_especifique')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Ha sido hospitalizado:</label>
            <div>
                <label>
                    <input type="radio" name="hospitalizado" value="true" {{ old('hospitalizado') == 'true' ? 'checked' : '' }}> Sí
                </label>
                <label style="margin: 15px">
                    <input type="radio" name="hospitalizado" value="false" {{ old('hospitalizado') == 'false' ? 'checked' : '' }}> No
                </label>
            </div>
            <label for="hospitalizationDate">Fecha</label>
            <input type="date" id="hospitalizationDate" name="hospitalizado_fecha" class="form-control @error('hospitalizado_fecha') is-invalid @enderror" value="{{ old('hospitalizado_fecha') }}">
            @error('hospitalizado_fecha')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
            <label for="hospitalizationReason">Motivo</label>
            <input type="text" id="hospitalizationReason" name="hospitalizado_motivo" placeholder="Motivo de la hospitalización" class="form-control @error('hospitalizado_motivo') is-invalid @enderror" value="{{ old('hospitalizado_motivo') }}">
            @error('hospitalizado_motivo')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label for="currentCondition">Padecimiento actual</label>
            <input type="text" id="currentCondition" name="padecimiento_actual" placeholder="Padecimiento actual" class="form-control @error('padecimiento_actual') is-invalid @enderror" value="{{ old('padecimiento_actual') }}">
            @error('padecimiento_actual')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
@endsection
