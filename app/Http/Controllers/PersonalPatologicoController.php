<?php

namespace App\Http\Controllers;

use App\Models\App;
use Illuminate\Http\Request;
use App\Models\FicIdent;
use Illuminate\Support\Facades\DB;

class PersonalPatologicoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
{
    // Mostrar el formulario de antecedentes patológicos hereditarios
    return view('components.AntecedentespersonalesPatologicos');
}
public function store(Request $request)
{
    // Recuperar el id de la última ficha de identificación guardada en la sesión
    $ultimaFichaId = session('selectedPacienteId');

    // Validar los datos del formulario
    $validatedData = $request->validate([
        'enfermedades_inflamatorias_infecciosas_no_trasmisibles' => 'required|string|max:255',
        'enfermedades_trasmision_sexual' => 'nullable|string|max:255',
        'enfermedades_degenerativas' => 'nullable|string|max:255',
        'enfermedades_neoplasicas' => 'nullable|string|max:255',
        'enfermedades_congenitas' => 'nullable|string|max:255',
        'otras' => 'nullable|string|max:255',
    ]);

    DB::beginTransaction();
    try {
        // Combinar los datos validados con el ID de la última ficha
        $personalPatologicoData = array_merge($validatedData, ['fic_ident_idfi' => $ultimaFichaId]);
        $personalPatologico = new App($personalPatologicoData);
        $personalPatologico->save(); // Guardar en la base de datos

        DB::commit();
        return redirect()->route('antecedenes_patologicos_hereditarios')->with('success', 'Antecedentes personales patológicos guardados con éxito.');
    } catch (\Exception $e) {
        DB::rollback();
        return back()->withErrors('Error al guardar los antecedentes personales patológicos: ' . $e->getMessage());
    }}
}
