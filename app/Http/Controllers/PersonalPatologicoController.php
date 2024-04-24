<?php

namespace App\Http\Controllers;

use App\Models\App;
use Illuminate\Http\Request;

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
    // Validar los datos del formulario
    $validatedData = $request->validate([
        'enfermedades_inflamatorias_infecciosas_no_trasmisibles' => 'required|string|max:255',
        'enfermedades_trasmision_sexual' => 'nullable|string|max:255',
        'enfermedades_degenerativas' => 'nullable|string|max:255',
        'enfermedades_neoplasicas' => 'nullable|string|max:255',
        'enfermedades_congenitas' => 'nullable|string|max:255',
        'otras' => 'nullable|string|max:255',
    ]);

    // Crear un nuevo registro de antecedentes personales patológicos
    $personalPatologico = new App($validatedData);
    $personalPatologico->save(); // Guardar en la base de datos

    // Redireccionar con un mensaje de éxito
    return redirect()->route('antecedenes_patologicos_hereditarios')->with('success', 'message');

}
}
