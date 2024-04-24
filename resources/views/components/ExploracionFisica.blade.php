@extends('layouts.app')

@section('content')
<div class="contact-form" style="margin: 0 auto; width: 800px;">
    <h3>Exploración de cabeza y cuello</h3>
    <form method="POST" action="{{ route('exploracion.store') }}">
        @csrf
        <div class="form-group">
            <label>Cabeza:</label>
            <div class="checkbox-row">
                <label><input type="checkbox" name="cabeza_exostosis" {{ old('cabeza_exostosis') ? 'checked' : '' }}> Exostosis</label>
                <label style="margin: 20px"><input type="checkbox" name="cabeza_endostosis" {{ old('cabeza_endostosis') ? 'checked' : '' }}> Endostosis</label>
            </div>
        </div>

        <div class="form-group">
            <label>Cráneo:</label>
            <div class="checkbox-row">
                <label><input type="checkbox" name="craneo_dolicocefalico" {{ old('craneo_dolicocefalico') ? 'checked' : '' }}> Dolicocefálico</label>
                <label style="margin: 20px"><input type="checkbox" name="craneo_mesocefalico" {{ old('craneo_mesocefalico') ? 'checked' : '' }}> Mesocefálico</label>
                <label style="margin: 20px"><input type="checkbox" name="craneo_braquicefalico" {{ old('craneo_braquicefalico') ? 'checked' : '' }}> Braquicefálico</label>
            </div>
        </div>

        <div class="form-group">
            <label>Cara:</label>
            <div class="checkbox-row">
                <label><input type="checkbox" name="cara_asimetrias_transversales" {{ old('cara_asimetrias_transversales') ? 'checked' : '' }}> Asimetrías Transversales</label>
                <label style="margin: 20px"><input type="checkbox" name="cara_asimetrias_longitudinales" {{ old('cara_asimetrias_longitudinales') ? 'checked' : '' }}> Asimetrías Longitudinales</label>
            </div>
        </div>

        <div class="form-group">
            <label>Perfil:</label>
            <div class="checkbox-row">
                <label><input type="checkbox" name="perfil_concavo" {{ old('perfil_concavo') ? 'checked' : '' }}> Cóncavo</label>
                <label style="margin: 20px"><input type="checkbox" name="perfil_convexo" {{ old('perfil_convexo') ? 'checked' : '' }}> Convexo</label>
                <label style="margin: 20px"><input type="checkbox" name="perfil_recto" {{ old('perfil_recto') ? 'checked' : '' }}> Recto</label>
            </div>
        </div>

        <div class="form-group">
            <label>Piel:</label>
            <div class="checkbox-row">
                <label><input type="checkbox" name="piel_normal" {{ old('piel_normal') ? 'checked' : '' }}> Normal</label>
                <label style="margin: 20px"><input type="checkbox" name="piel_palida" {{ old('piel_palida') ? 'checked' : '' }}> Pálida</label>
                <label style="margin: 20px"><input type="checkbox" name="piel_cianotica" {{ old('piel_cianotica') ? 'checked' : '' }}> Cianótica</label>
                <label style="margin: 20px"><input type="checkbox" name="piel_enrojecida" {{ old('piel_enrojecida') ? 'checked' : '' }}> Enrojecida</label>
            </div>
        </div>

        <div class="form-group">
            <label>Músculos:</label>
            <div class="checkbox-row">
                <label><input type="checkbox" name="musculos_hipotonicos" {{ old('musculos_hipotonicos') ? 'checked' : '' }}> Hipotónicos</label>
                <label style="margin: 20px"><input type="checkbox" name="musculos_hipertonicos" {{ old('musculos_hipertonicos') ? 'checked' : '' }}> Hipertónicos</label>
                <label style="margin: 20px"><input type="checkbox" name="musculos_espasticos" {{ old('musculos_espasticos') ? 'checked' : '' }}> Espásticos</label>
            </div>
        </div>

        <div class="form-group">
            <label>Cuello:</label>
            <div>
                <label>Se palpa la cadena ganglionar</label>
                <label style="margin: 20px"><input type="radio" name="cuello_palpa_cadena_ganglionar" value="true" {{ old('cuello_palpa_cadena_ganglionar') == 'true' ? 'checked' : '' }}> Sí</label>
                <label style="margin: 20px"><input type="radio" name="cuello_palpa_cadena_ganglionar" value="false" {{ old('cuello_palpa_cadena_ganglionar') == 'false' ? 'checked' : '' }}> No</label>
            </div>
        </div>

        <div class="form-group">
            <label for="otros">Otros</label>
            <textarea style="width: 100%; height: 100px; resize: none; overflow-wrap: break-word;" id="otros" name="otros" placeholder="Ingrese otros datos relevantes">{{ old('otros') }}</textarea>
        </div>



        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
@endsection
