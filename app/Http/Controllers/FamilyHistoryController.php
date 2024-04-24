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
    
    $validatedData = $request->validate([
        'interrogatorio_aparato_digestivo' => 'nullable|string|max:255',
        'interrogatorio_aparato_respiratorio' => 'nullable|string|max:255',
        'interrogatorio_cardiovascular' => 'nullable|string|max:255',
        'interrogatorio_aparato_genitourinario' => 'nullable|string|max:255',
        'interrogatorio_sistema_endocrino' => 'nullable|string|max:255',
        'interrogatorio_sistema_hemepoyetico' => 'nullable|string|max:255',
        'interrogatorio_sistema_nervioso' => 'nullable|string|max:255',
        'interrogatorio_sistema_musculoesqueletico' => 'nullable|string|max:255',
        'interrogatorio_sistema_tegumentario' => 'nullable|string|max:255',
        'interrogatorio_aparato_tegumentario' => 'nullable|string|max:255', // Verifica si este campo es correcto y está presente en la solicitud
        'habitus_exterior' => 'nullable|string|max:255',
        'peso' => 'nullable|numeric|between:0,999.99',
        'talla' => 'nullable|numeric|between:0,999.99',
        'complexion' => 'nullable|string|max:45',
        'frecuencia_cardiaca' => 'nullable|integer|min:0',
        'sistolica' => 'nullable|integer|min:0',
        'diastolica' => 'nullable|integer|min:0',
        'frecuencia_respiratoria' => 'nullable|integer|min:0',
        'temperatura' => 'nullable|numeric|between:0,9999.99',
    ]);
    

    DB::beginTransaction();
    try {
        // Combinar los datos validados con el ID de la última ficha
        $eprsonalHereditario = array_merge($validatedData, ['fic_ident_idfi' => $ultimaFichaId]);
        $personalHereditario = new Aph($eprsonalHereditario);
        $personalHereditario->save(); // Guardar en la base de datos

        DB::commit();
        return redirect()->route('nonPathological.create')->with('success', 'Antecedentes personales patológicos guardados con éxito.');
    } catch (\Exception $e) {
        DB::rollback();
        return back()->withErrors('Error al guardar los antecedentes personales patológicos: ' . $e->getMessage());
    }}
}
