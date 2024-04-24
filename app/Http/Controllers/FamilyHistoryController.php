<?php

namespace App\Http\Controllers;
use App\Models\Aph;
use Illuminate\Http\Request;


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
    $validatedAphData = $request->validate([
        'madre' => 'nullable|string|max:255',
        'padre' => 'nullable|string|max:255',
        'hermanos' => 'nullable|string|max:255',
        'hijos' => 'nullable|string|max:255',
        'esposo_a' => 'nullable|string|max:255',
        'tios' => 'nullable|string|max:255',
        'abuelos' => 'nullable|string|max:255',
    ]);

    // Crear un nuevo registro de antecedentes personales patológicos
    $aph = new Aph($validatedAphData);
    $aph->save(); // Guardar en la base de datos
// Procesar los datos validados (almacenar en la base de datos, etc.)

// Redireccionar o enviar respuesta
return view('components.AntecedentespersonalesNoPatologicos', ['success' => 'Antecedentes personales patológicos guardados con éxito.']);
}
}
