<?php

namespace App\Http\Controllers;

use App\Models\Aph;
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
            toastr()->forget('success');


            return redirect()->route('antecedenes_patologicos_hereditarios');
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollback();

            // Mostrar mensaje de error
            toastr()->error('Error al guardar los antecedentes patológicos hereditarios: ' . $e->getMessage());

            return redirect()->back();
        }
    }
}
