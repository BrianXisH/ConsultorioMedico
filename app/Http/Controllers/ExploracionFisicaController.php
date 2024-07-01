<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExploracionFisica;
use App\Models\FicIdent;
use App\Models\Paciente;
use Illuminate\Support\Facades\DB;

class ExploracionFisicaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('components.ExploracionFisica');
    }

    public function store(Request $request)
    {
        $ultimaFichaId = session('selectedPacienteId');

        $validatedData = $request->validate([
            // Tus otros campos de validación
            'otros' => 'nullable|string|max:255',
            // Añade aquí las validaciones de otros campos si es necesario
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
            $exploracionFisicaData = array_merge($validatedData, ['fic_ident_idfi' => $ultimaFichaId]);
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

    public function edit($fic_ident_idfi)
    {
        $ficha = FicIdent::findOrFail($fic_ident_idfi);
        $paciente = Paciente::findOrFail($ficha->pacientes_idpacientes);
        $exploracion = ExploracionFisica::where('fic_ident_idfi', $fic_ident_idfi)->first();
        return view('edit_antecedentes.exploracion_edit', compact('paciente', 'exploracion', 'ficha'));
    }

    public function update(Request $request, $fic_ident_idfi)
    {
        $validatedData = $request->validate([
            'otros' => 'nullable|string|max:255',
            // Añade aquí las validaciones de otros campos si es necesario
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
            $exploracion = ExploracionFisica::where('fic_ident_idfi', $fic_ident_idfi)->first();

            if ($exploracion) {
                $exploracion->update($validatedData);
            } else {
                $validatedData['fic_ident_idfi'] = $fic_ident_idfi;
                ExploracionFisica::create($validatedData);
            }

            DB::commit();
            toastr()->success('Exploración física actualizada con éxito');
            return redirect()->route('exploracion.edit', ['fic_ident_idfi' => $fic_ident_idfi]);
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Error al actualizar la exploración física: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
