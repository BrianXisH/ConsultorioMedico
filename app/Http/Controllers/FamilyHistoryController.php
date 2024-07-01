<?php

namespace App\Http\Controllers;

use App\Models\Aph;
use App\Models\FicIdent;
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
        // Mostrar el formulario de antecedentes patológicos hereditarios
        return view('components.AntecedentespatHereditarios');
    }

    public function store(Request $request)
    {
        $ultimaFichaId = session('selectedPacienteId');

        // Validar los datos recibidos del formulario
        $validatedData = $request->validate([
            'madre' => 'nullable|string|max:255',
            'padre' => 'nullable|string|max:255',
            'hermanos' => 'nullable|string|max:255',
            'hijos' => 'nullable|string|max:255',
            'esposo_a' => 'nullable|string|max:255',
            'tios' => 'nullable|string|max:255',
            'abuelos' => 'nullable|string|max:255',
        ]);

        // Iniciar una transacción para asegurar la integridad de los datos
        DB::beginTransaction();
        try {
            // Crear una nueva instancia de Aph con los datos validados
            $personalHereditario = new Aph(array_merge($validatedData, ['fic_ident_idfi' => $ultimaFichaId]));

            // Guardar en la base de datos
            $personalHereditario->save();

            // Confirmar la transacción
            DB::commit();

            // Mostrar mensaje de éxito
            toastr()->success('Antecedentes patológicos hereditarios guardados con éxito');
            
            return redirect()->route('familyHistory.edit', ['fic_ident_idfi' => $ultimaFichaId]);
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollback();

            // Mostrar mensaje de error
            toastr()->error('Error al guardar los antecedentes patológicos hereditarios: ' . $e->getMessage());

            return redirect()->back();
        }
    }

    public function edit($fic_ident_idfi)
    {
        $ficha = FicIdent::findOrFail($fic_ident_idfi);
        $aph = Aph::where('fic_ident_idfi', $fic_ident_idfi)->first();

        return view('edit_antecedentes.aph_edit', compact('aph', 'ficha'));
    }

    public function update(Request $request, $fic_ident_idfi)
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
            $aph = Aph::where('fic_ident_idfi', $fic_ident_idfi)->first();

            if ($aph) {
                $aph->update($validatedData);
            } else {
                $validatedData['fic_ident_idfi'] = $fic_ident_idfi;
                Aph::create($validatedData);
            }

            DB::commit();
            toastr()->success('Antecedentes patológicos hereditarios actualizados con éxito');

            return redirect()->route('familyHistory.edit', ['fic_ident_idfi' => $fic_ident_idfi]);
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Error al actualizar los antecedentes patológicos hereditarios: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
