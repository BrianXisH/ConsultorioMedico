<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ipsa;    

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
        'interrogatorio_sistema_tegumentario' => 'nullable|string|max:255'
    ]);

    // Crear y guardar el registro en la base de datos usando el modelo Ipsa
    $ipsa = new Ipsa($validatedData);
    if ($ipsa->save()) {
        // Si se guarda correctamente, redirigir con un mensaje de éxito
        return redirect()->route('exploracion.index')->with('success', 'Antecedentes personales no patológicos guardados con éxito.');
    } else {
        // Si no se guarda, redirigir con un mensaje de error
        return redirect()->back()->with('error', 'Error al guardar el interrogatorio');
    }
}
}
