<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ipsa;    
use Illuminate\Support\Facades\DB;

class InterrogatorioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
{
    // Mostrar el formulario de antecedentes patológicos hereditarios
    return view('components.InterrogatorioAparatosSistemas');
}

public function store(Request $request)
{
    $ultimaFichaId = session('selectedPacienteId');
    
    // Validar los datos recibidos del formulario
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
        'habitus_exterior' => 'nullable|string|max:255',
        'peso' => 'nullable|numeric',
        'talla' => 'nullable|numeric',
        'complexion' => 'nullable|string|max:255',
        'frecuencia_cardiaca' => 'nullable|numeric',
        'sistolica' => 'nullable|numeric',
        'diastolica' => 'nullable|numeric',
        'frecuencia_respiratoria' => 'nullable|numeric',
        'temperatura' => 'nullable|numeric',
    ]);

    DB::beginTransaction();
    try {
        // Combinar los datos validados con el ID de la última ficha
        $personalHereditarioData = array_merge($validatedData, ['fic_ident_idfi' => $ultimaFichaId]);
        $personalHereditario = new Ipsa($personalHereditarioData);
        $personalHereditario->save();

        DB::commit();
        toastr()->success('Interrogatorio guardado con éxito');
        return redirect()->route('interrogatorio.index');
    } catch (\Exception $e) {
        DB::rollback();
        toastr()->error('Error al guardar el interrogatorio: ' . $e->getMessage());
        return back();
    }
}

}
