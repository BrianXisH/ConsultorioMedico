<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExploracionFisica;
use App\Models\FichaNueva;
use Illuminate\Support\Facades\DB;

class ExploracionFisicaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $ultimaFichaId = session('selectedPacienteId');
        $exploracion = ExploracionFisica::where('ficha_nueva_id', $ultimaFichaId)->first();

        return view('components.ExploracionFisica', compact('exploracion'));
    }

    public function store(Request $request)
    {
        $ultimaFichaId = session('selectedPacienteId');

        $validatedData = $request->validate([
            'otros' => 'nullable|string|max:255',
        ]);

        $booleanFields = [
            'cabeza_exostosis', 'cabeza_endostosis', 'craneo_dolicocefalico', 'craneo_mesocefalico', 
            'craneo_braquicefalico', 'cara_asimetrias_transversales', 'cara_asimetrias_longitudinales', 
            'perfil_concavo', 'perfil_convexo', 'perfil_recto', 'piel_normal', 'piel_palida', 
            'piel_cianotica', 'piel_enrojecida', 'musculos_hipotonicos', 'musculos_hipertonicos', 
            'musculos_espasticos', 'cuello_palpa_cadena_ganglionar'
        ];

        foreach ($booleanFields as $field) {
            $validatedData[$field] = $request->has($field) ? 1 : 0;
        }

        DB::beginTransaction();
        try {
            $exploracionFisicaData = array_merge($validatedData, ['ficha_nueva_id' => $ultimaFichaId]);
            $exploracionFisica = new ExploracionFisica($exploracionFisicaData);
            $exploracionFisica->save();

            DB::commit();
            toastr()->success('Exploración física guardada con éxito');
            return redirect()->route('exploracion.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Error al guardar la exploración física: ' . $e->getMessage());
            return back();
        }
    }

    public function edit($ficha_nueva_id)
    {
        $ficha = FichaNueva::findOrFail($ficha_nueva_id);
        $exploracion = ExploracionFisica::where('ficha_nueva_id', $ficha_nueva_id)->first();

        return view('edit_antecedentes.exploracion_edit', compact('exploracion', 'ficha'));
    }

    public function update(Request $request, $ficha_nueva_id)
    {
        $validatedData = $request->validate([
            'otros' => 'nullable|string|max:255',
        ]);

        $booleanFields = [
            'cabeza_exostosis', 'cabeza_endostosis', 'craneo_dolicocefalico', 'craneo_mesocefalico', 
            'craneo_braquicefalico', 'cara_asimetrias_transversales', 'cara_asimetrias_longitudinales', 
            'perfil_concavo', 'perfil_convexo', 'perfil_recto', 'piel_normal', 'piel_palida', 
            'piel_cianotica', 'piel_enrojecida', 'musculos_hipotonicos', 'musculos_hipertonicos', 
            'musculos_espasticos', 'cuello_palpa_cadena_ganglionar'
        ];

        foreach ($booleanFields as $field) {
            $validatedData[$field] = $request->has($field) ? 1 : 0;
        }

        DB::beginTransaction();
        try {
            $exploracion = ExploracionFisica::where('ficha_nueva_id', $ficha_nueva_id)->first();

            if ($exploracion) {
                $exploracion->update($validatedData);
            } else {
                $validatedData['ficha_nueva_id'] = $ficha_nueva_id;
                ExploracionFisica::create($validatedData);
            }

            DB::commit();
            toastr()->success('Exploración física actualizada con éxito');
            return redirect()->route('exploracion.edit', ['ficha_nueva_id' => $ficha_nueva_id]);
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Error al actualizar la exploración física: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
