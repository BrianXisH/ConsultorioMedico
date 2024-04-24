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
     // Validar los datos recibidos del formularios
     $validatedData = $request->validate([
        'interrogatorio_aparato_digestivo' => 'nullable|string|max:255',
        'interrogatorio_aparato_respiratorio' => 'nullable|string|max:255',
        'interrogatorio_cardiovascular' => 'nullable|string|max:255',
        'interrogatorio_aparato_genitourinario' => 'nullable|string|max:255',
        'interrogatorio_sistema_endocrino' => 'nullable|string|max:255',
        'interrogatorio_sistema_hemepoyetico' => 'nullable|string|max:255',
        'interrogatorio_sistema_nervioso' => 'nullable|string|max:255',
        'interrogatorio_sistema_musculoesqueletico' => 'nullable|string|max:255',
        'interrogatorio_sistema_tegumentario' => 'nullable|string|max:255'
    ]);

    
    DB::beginTransaction();
    try {
        // Combinar los datos validados con el ID de la última ficha
        $eprsonalHereditario = array_merge($validatedData, ['fic_ident_idfi' => $ultimaFichaId]);
        $personalHereditario = new Ipsa($eprsonalHereditario);
        $personalHereditario->save(); // Guardar en la base de datos

        DB::commit();
        return redirect()->route('receta.show')->with('success', 'Antecedentes personales patológicos guardados con éxito.');
    } catch (\Exception $e) {
        DB::rollback();
        return back()->withErrors('Error al guardar los antecedentes personales patológicos: ' . $e->getMessage());
    }
}
}
