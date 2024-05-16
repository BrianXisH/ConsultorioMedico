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
    ],[
        'enfermedades_inflamatorias_infecciosas_no_trasmisibles.required' => 'El campo enfermedades inflamatorias infecciosas no trasmisibles es obligatorio.',
        'enfermedades_trasmision_sexual.required' => 'El campo enfermedades trasmision sexual es obligatorio.',
        'enfermedades_degenerativas.required' => 'El campo enfermedades degenerativas es obligatorio.',
        'enfermedades_neoplasicas.required' => 'El campo enfermedades neoplasicas es obligatorio.',
        'enfermedades_congenitas.required' => 'El campo enfermedades congenitas es obligatorio.',
        'otras.required' => 'El campo otras es obligatorio.',
    	]);

    DB::beginTransaction();
    try {
        // Combinar los datos validados con el ID de la última ficha
        $personalPatologicoData = array_merge($validatedData, ['fic_ident_idfi' => $ultimaFichaId]);
        $personalPatologico = new App($personalPatologicoData);
        $personalPatologico->save(); // Guardar en la base de datos

        DB::commit();

        toastr()->success('Antecedentes personales patológicos guardados con éxito');
        toastr()->forget('success');
        return redirect()->route('pathological.index');
        //nos vamos a antecedentes patologicos hereditarios
    } catch (\Exception $e) {
        DB::rollback();
        return back()->withErrors('Error al guardar los antecedentes personales patológicos: ' . $e->getMessage());
    }}
}
