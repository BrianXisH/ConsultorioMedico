@extends('layouts.app')

@section('content')
<div class="contact-form" style="margin: 0 auto; width: 800px;">
    <h3>Exploración de cabeza y cuello</h3>
    <form method="POST" action="{{ $exploracion ? route('exploracion.update', $exploracion->fic_ident_idfi) : route('exploracion.store') }}">
        @csrf
        @if ($exploracion)
            @method('PUT')
        @endif

        <div class="form-group">
            <label>Cabeza:</label>
            <div class="checkbox-row">
                <label><input type="checkbox" name="cabeza_exostosis" {{ $exploracion->cabeza_exostosis ? 'checked' : '' }}> Exostosis</label>
                <label style="margin: 20px"><input type="checkbox" name="cabeza_endostosis" {{ $exploracion->cabeza_endostosis ? 'checked' : '' }}> Endostosis</label>
            </div>
        </div>

        <div class="form-group">
            <label>Cráneo:</label>
            <div class="checkbox-row">
                <label><input type="checkbox" name="craneo_dolicocefalico" {{ $exploracion->craneo_dolicocefalico ? 'checked' : '' }}> Dolicocefálico</label>
                <label style="margin: 20px"><input type="checkbox" name="craneo_mesocefalico" {{ $exploracion->craneo_mesocefalico ? 'checked' : '' }}> Mesocefálico</label>
                <label style="margin: 20px"><input type="checkbox" name="craneo_braquicefalico" {{ $exploracion->craneo_braquicefalico ? 'checked' : '' }}> Braquicefálico</label>
            </div>
        </div>

        <div class="form-group">
            <label>Cara:</label>
            <div class="checkbox-row">
                <label><input type="checkbox" name="cara_asimetrias_transversales" {{ $exploracion->cara_asimetrias_transversales ? 'checked' : '' }}> Asimetrías Transversales</label>
                <label style="margin: 20px"><input type="checkbox" name="cara_asimetrias_longitudinales" {{ $exploracion->cara_asimetrias_longitudinales ? 'checked' : '' }}> Asimetrías Longitudinales</label>
            </div>
        </div>

        <div class="form-group">
            <label>Perfil:</label>
            <div class="checkbox-row">
                <label><input type="checkbox" name="perfil_concavo" {{ $exploracion->perfil_concavo ? 'checked' : '' }}> Cóncavo</label>
                <label style="margin: 20px"><input type="checkbox" name="perfil_convexo" {{ $exploracion->perfil_convexo ? 'checked' : '' }}> Convexo</label>
                <label style="margin: 20px"><input type="checkbox" name="perfil_recto" {{ $exploracion->perfil_recto ? 'checked' : '' }}> Recto</label>
            </div>
        </div>

        <div class="form-group">
            <label>Piel:</label>
            <div class="checkbox-row">
                <label><input type="checkbox" name="piel_normal" {{ $exploracion->piel_normal ? 'checked' : '' }}> Normal</label>
                <label style="margin: 20px"><input type="checkbox" name="piel_palida" {{ $exploracion->piel_palida ? 'checked' : '' }}> Pálida</label>
                <label style="margin: 20px"><input type="checkbox" name="piel_cianotica" {{ $exploracion->piel_cianotica ? 'checked' : '' }}> Cianótica</label>
                <label style="margin: 20px"><input type="checkbox" name="piel_enrojecida" {{ $exploracion->piel_enrojecida ? 'checked' : '' }}> Enrojecida</label>
            </div>
        </div>

        <div class="form-group">
            <label>Músculos:</label>
            <div class="checkbox-row">
                <label><input type="checkbox" name="musculos_hipotonicos" {{ $exploracion->musculos_hipotonicos ? 'checked' : '' }}> Hipotónicos</label>
                <label style="margin: 20px"><input type="checkbox" name="musculos_hipertonicos" {{ $exploracion->musculos_hipertonicos ? 'checked' : '' }}> Hipertónicos</label>
                <label style="margin: 20px"><input type="checkbox" name="musculos_espasticos" {{ $exploracion->musculos_espasticos ? 'checked' : '' }}> Espásticos</label>
            </div>
        </div>

        <div class="form-group">
            <label>Cuello:</label>
            <div>
                <label>Se palpa la cadena ganglionar</label>
                <label style="margin: 20px"><input type="radio" name="cuello_palpa_cadena_ganglionar" value="true" {{ $exploracion->cuello_palpa_cadena_ganglionar == 'true' ? 'checked' : '' }}> Sí</label>
                <label style="margin: 20px"><input type="radio" name="cuello_palpa_cadena_ganglionar" value="false" {{ $exploracion->cuello_palpa_cadena_ganglionar == 'false' ? 'checked' : '' }}> No</label>
            </div>
        </div>

        <div class="form-group">
            <label for="otros">Otros</label>
            <textarea style="width: 100%; height: 100px; resize: none; overflow-wrap: break-word;" id="otros" name="otros" placeholder="Ingrese otros datos relevantes">{{ $exploracion->otros ?? old('otros') }}</textarea>
        </div>

        <div class="form-group">
            <input type="submit" value="Guardar exploración física" class="btn btn-primary">
            <a href="{{ route('interrogatorio.index') }}" class="btn btn-orange">Siguiente</a>
        </div>
    </form>
</div>
@endsection
