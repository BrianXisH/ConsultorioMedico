<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apnp;
use Illuminate\Support\Facades\DB;

class NoPatologicoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
{
    // Mostrar el formulario de antecedentes patológicos hereditarios
    return view('components.AntecedentespersonalesNoPatologicos');
}
public function store(Request $request)
    {
        // Mostrar todos los datos recibidos del formulario
         // Preparar los datos recibidos del formulario
         $data = $request->all();

         // Definir valores por defecto para campos de radio que representan booleanos
         $radioFieldsDefaults = [
             'habitos_higienicos_utiliza_auxiliares_higiene_bucal' => false,
             'habitos_higienicos_consume_golosinas_otros_alimentos_comidas' => false,
             'cuenta_cartilla_vacunacion' => false,
             'esquema_completo' => false,
             'hospitalizado' => false
         ];
 
         // Establecer valores por defecto si los campos de radio no están presentes
         foreach ($radioFieldsDefaults as $field => $defaultValue) {
             if (!$request->has($field)) {
                 $data[$field] = $defaultValue;
             } else {
                 // Convertir valores 'true'/'false' a booleanos
                 $data[$field] = $request->input($field) === 'true';
             }
         }
 
         // Asegurar que los valores de los checkboxes sean booleanos
         $checkboxFields = [
             'adicciones_tabaco',
             'adicciones_alcohol'
         ];
 
         foreach ($checkboxFields as $field) {
             $data[$field] = $request->has($field);
         }

         $validatedData = $request->validate([
            'habitos_higienicos_vestuario' => 'nullable|string|max:255',
            'habitos_higienicos_lavado_dientes_frecuencia' => 'nullable|string|max:50',
            'habitos_higienicos_utiliza_auxiliares_higiene_bucal' => 'nullable|boolean',
            'habitos_higienicos_auxiliares_higiene_bucal_cuales' => 'nullable|string|max:255',
            'habitos_higienicos_consume_golosinas_otros_alimentos_comidas' => 'nullable|boolean',
            'grupo_sanguineo' => 'nullable|string|max:10',
            'factor_rh' => 'nullable|string|max:10',
            'cuenta_cartilla_vacunacion' => 'nullable|boolean',
            'esquema_completo' => 'nullable|boolean',
            'esquema_falta' => 'nullable|string|max:255',
            'adicciones_tabaco' => 'nullable|boolean',
            'adicciones_alcohol' => 'nullable|boolean',
            'antecedentes_alergicos' => 'nullable|string|max:255',
            'antecedentes_alergicos_antibioticos' => 'nullable|string|max:255',
            'antecedentes_alergicos_analgesicos' => 'nullable|string|max:255',
            'antecedentes_alergicos_anestesicos' => 'nullable|string|max:255',
            'antecedentes_alergicos_alimentos' => 'nullable|string|max:255',
            'antecedentes_alergicos_especifique' => 'nullable|string|max:255',
            'hospitalizado' => 'nullable|boolean',
            'hospitalizado_fecha' => 'nullable|date',
            'hospitalizado_motivo' => 'nullable|string|max:255',
            'padecimiento_actual' => 'nullable|string|max:255',
        ]);
        
        $ultimaFichaId = session('selectedPacienteId');
         DB::beginTransaction();
    try {
        // Combinar los datos validados con el ID de la última ficha
        $eprsonalHereditario = array_merge($validatedData, ['fic_ident_idfi' => $ultimaFichaId]);
        $personalHereditario = new Apnp($eprsonalHereditario);
        $personalHereditario->save(); // Guardar en la base de datos

        DB::commit();
        return redirect()->route('exploracion.index')->with('success', 'Antecedentes personales patológicos guardados con éxito.');
    } catch (\Exception $e) {
        DB::rollback();
        return back()->withErrors('Error al guardar los antecedentes personales patológicos: ' . $e->getMessage());
    }}
     }

