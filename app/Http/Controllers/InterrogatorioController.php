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
    ], [
        'interrogatorio_aparato_digestivo.string' => 'El campo "Aparato digestivo" debe ser una cadena de texto.',
        'interrogatorio_aparato_respiratorio.string' => 'El campo "Aparato respiratorio" debe ser una cadena de texto.',
        'interrogatorio_cardiovascular.string' => 'El campo "Cardiovascular" debe ser una cadena de texto.',
        'interrogatorio_aparato_genitourinario.string' => 'El campo "Aparato genitourinario" debe ser una cadena de texto.',
        'interrogatorio_sistema_endocrino.string' => 'El campo "Sistema endocrino" debe ser una cadena de texto.',
        'interrogatorio_sistema_hemepoyetico.string' => 'El campo "Sistema hemepoyético" debe ser una cadena de texto.',
        'interrogatorio_sistema_nervioso.string' => 'El campo "Sistema nervioso" debe ser una cadena de texto.',
        'interrogatorio_sistema_musculoesqueletico.string' => 'El campo "Sistema musculoesquelético" debe ser una cadena de texto.',
        'interrogatorio_sistema_tegumentario.string' => 'El campo "Sistema tegumentario" debe ser una cadena de texto.'
    ]);

    
    DB::beginTransaction();
    try {
        // Combinar los datos validados con el ID de la última ficha
        $eprsonalHereditario = array_merge($validatedData, ['fic_ident_idfi' => $ultimaFichaId]);
        $personalHereditario = new Ipsa($eprsonalHereditario);
        $personalHereditario->save(); // Guardar en la base de datos

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
