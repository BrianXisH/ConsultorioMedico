<?php

namespace App\Http\Controllers;

use App\Models\Aph;
use App\Models\FichaNueva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FamilyHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $ultimaFichaId = session('selectedPacienteId');
        $aph = Aph::where('ficha_nueva_id', $ultimaFichaId)->first();

        return view('components.AntecedentespatHereditarios', compact('aph'));
    }

    public function store(Request $request)
    {
        $ultimaFichaId = session('selectedPacienteId');

        $validatedData = $request->validate([
            'madre' => 'nullable|string|max:255',
            'padre' => 'nullable|string|max:255',
            'hermanos' => 'nullable|string|max:255',
            'hijos' => 'nullable|string|max:255',
            'esposo_a' => 'nullable|string|max:255',
            'tios' => 'nullable|string|max:255',
            'abuelos' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $personalHereditario = new Aph(array_merge($validatedData, ['ficha_nueva_id' => $ultimaFichaId]));
            $personalHereditario->save();

            DB::commit();
            toastr()->success('Antecedentes patológicos hereditarios guardados con éxito');
            return redirect()->route('antecedenes_patologicos_hereditarios', ['ficha_nueva_id' => $ultimaFichaId]);
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Error al guardar los antecedentes patológicos hereditarios: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($ficha_nueva_id)
    {
        $ficha = FichaNueva::findOrFail($ficha_nueva_id);
        $aph = Aph::where('ficha_nueva_id', $ficha_nueva_id)->first();

        return view('edit_antecedentes.aph_edit', compact('aph', 'ficha'));
    }

    public function update(Request $request, $ficha_nueva_id)
    {
        $validatedData = $request->validate([
            'madre' => 'nullable|string|max:255',
            'padre' => 'nullable|string|max:255',
            'hermanos' => 'nullable|string|max:255',
            'hijos' => 'nullable|string|max:255',
            'esposo_a' => 'nullable|string|max:255',
            'tios' => 'nullable|string|max:255',
            'abuelos' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $aph = Aph::where('ficha_nueva_id', $ficha_nueva_id)->first();

            if ($aph) {
                $aph->update($validatedData);
            } else {
                $validatedData['ficha_nueva_id'] = $ficha_nueva_id;
                Aph::create($validatedData);
            }

            DB::commit();
            toastr()->success('Antecedentes patológicos hereditarios actualizados con éxito');

            return redirect()->route('familyHistory.edit', ['ficha_nueva_id' => $ficha_nueva_id]);
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Error al actualizar los antecedentes patológicos hereditarios: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
