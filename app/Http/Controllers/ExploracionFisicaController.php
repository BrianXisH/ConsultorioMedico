<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExploracionFisica;
use Illuminate\Support\Facades\DB;

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
      // Valida y guarda los datos
      $validatedData = $request->validate([
        // Tus otros campos de validación
        'otros' => 'nullable|string|max:255',
        // Añade aquí las validaciones de otros campos si es necesario
    ]);

    // Asegurarse de que los valores booleanos sean procesados correctamente
    $booleanFields = [
        'cabeza_exostosis', 'cabeza_endostosis', 'craneo_dolicocefalico', 'craneo_mesocefalico', 
        'craneo_braquicefalico', 'cara_asimetrias_transversales', 'cara_asimetrias_longitudinales', 
        'perfil_concavo', 'perfil_convexo', 'perfil_recto', 'piel_normal', 'piel_palida', 
        'piel_cianotica', 'piel_enrojecida', 'musculos_hipotonicos', 'musculos_hipertonicos', 
        'musculos_espasticos', 'cuello_palpa_cadena_ganglionar'
    ];

    foreach ($booleanFields as $field) {
        $validatedData[$field] = $request->has($field) ? 1 : 0;
    }



    $ultimaFichaId = session('selectedPacienteId');

    DB::beginTransaction();
    try {
        // Combinar los datos validados con el ID de la última ficha
        $eprsonalHereditario = array_merge($validatedData, ['fic_ident_idfi' => $ultimaFichaId]);
        $personalHereditario = new ExploracionFisica($eprsonalHereditario);
        $personalHereditario->save(); // Guardar en la base de datos

        DB::commit();
        toastr()->success('Exploración física guardada con éxito');
        return redirect()->route('exploracion.index');
    } catch (\Exception $e) {
        DB::rollback();
        toastr()->error('Error al guardar los antecedentes patológicos hereditarios: ' . $e->getMessage());
        return back();
    }}
}
