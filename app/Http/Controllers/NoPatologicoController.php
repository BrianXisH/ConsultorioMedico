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
        // Mostrar el formulario de antecedentes personales no patológicos
        return view('components.AntecedentespersonalesNoPatologicos');
    }

    public function store(Request $request)
    {
        $ultimaFichaId = session('selectedPacienteId');

        // Validar los datos recibidos del formulario
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
        ], [
            'habitos_higienicos_utiliza_auxiliares_higiene_bucal.boolean' => 'El campo "Utiliza auxiliares de higiene bucal" debe ser un valor booleano.',
            'habitos_higienicos_consume_golosinas_otros_alimentos_comidas.boolean' => 'El campo "Consume golosinas u otros alimentos entre comidas" debe ser un valor booleano.',
            'cuenta_cartilla_vacunacion.boolean' => 'El campo "Cuenta con cartilla de vacunación" debe ser un valor booleano.',
            'esquema_completo.boolean' => 'El campo "Esquema de vacunación completo" debe ser un valor booleano.',
            'adicciones_tabaco.boolean' => 'El campo "Tabaco" debe ser un valor booleano.',
            'adicciones_alcohol.boolean' => 'El campo "Alcohol" debe ser un valor booleano.',
            'hospitalizado.boolean' => 'El campo "Hospitalizado" debe ser un valor booleano.',
            'hospitalizado_fecha.date' => 'El campo "Fecha de hospitalización" no tiene un formato válido.',
        ]);

        // Manejar los valores booleanos para campos de radio y checkbox
        $booleanFields = [
            'habitos_higienicos_utiliza_auxiliares_higiene_bucal',
            'habitos_higienicos_consume_golosinas_otros_alimentos_comidas',
            'cuenta_cartilla_vacunacion',
            'esquema_completo',
            'adicciones_tabaco',
            'adicciones_alcohol',
            'hospitalizado'
        ];

        foreach ($booleanFields as $field) {
            $validatedData[$field] = $request->has($field) ? 1 : 0;
        }

        // Iniciar una transacción para asegurar la integridad de los datos
        DB::beginTransaction();
        try {
            // Crear una nueva instancia de Apnp con los datos validados
            $personalNoPatologico = new Apnp(array_merge($validatedData, ['fic_ident_idfi' => $ultimaFichaId]));

            // Guardar en la base de datos
            $personalNoPatologico->save();

            // Confirmar la transacción
            DB::commit();

            // Mostrar mensaje de éxito
            toastr()->success('Antecedentes personales no patológicos guardados con éxito');

            return redirect()->route('nonPathological.create');
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollback();

            // Mostrar mensaje de error
            toastr()->error('Error al guardar los antecedentes personales no patológicos: ' . $e->getMessage());

            return redirect()->back();
        }
    }
}
