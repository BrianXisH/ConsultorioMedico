<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExploracionFisica;

class ExploracionFisicaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
{
    // Mostrar el formulario de antecedentes patológicos hereditarios
    return view('components.ExploracionFisica');
}
public function store(Request $request)
    {
        $data = $request->all();

    // Asegurar que los valores de los checkboxes sean booleanos
    $checkboxFields = [
        'cabeza_exostosis', 'cabeza_endostosis', 'craneo_dolicocefalico', 'craneo_mesocefalico', 'craneo_braquicefalico',
        'cara_asimetrias_transversales', 'cara_asimetrias_longitudinales', 'perfil_concavo', 'perfil_convexo', 'perfil_recto',
        'piel_normal', 'piel_palida', 'piel_cianotica', 'piel_enrojecida', 'musculos_hipotonicos', 'musculos_hipertonicos',
        'musculos_espasticos', 'cuello_palpa_cadena_ganglionar'
    ];

    foreach ($checkboxFields as $field) {
        $data[$field] = $request->has($field);
    }

    // Valida y guarda los datos
    
    $exploracion = new ExploracionFisica($data);
    $exploracion->save();

        // Redireccionar con un mensaje de éxito
        return redirect()->route('receta.show')->with('success', 'message');
    }
}
