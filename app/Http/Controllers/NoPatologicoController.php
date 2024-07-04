<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apnp;
use App\Models\FichaNueva;
use Illuminate\Support\Facades\DB;

class NoPatologicoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Obtener la última ficha nueva de la sesión
        $ultimaFichaId = session('selectedPacienteId');
        $apnp = Apnp::where('ficha_nueva_id', $ultimaFichaId)->first();

        // Pasar $apnp a la vista
        return view('components.AntecedentespersonalesNoPatologicos', compact('apnp'));
    }

    public function store(Request $request)
    {
        $ultimaFichaId = session('selectedPacienteId');

        if (!$ultimaFichaId) {
            toastr()->error('No se ha seleccionado un paciente.');
            return redirect()->back();
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

        // Manejar los valores booleanos
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

        DB::beginTransaction();
        try {
            $personalNoPatologico = new Apnp(array_merge($validatedData, ['ficha_nueva_id' => $ultimaFichaId]));
            $personalNoPatologico->save();

            DB::commit();
            toastr()->success('Antecedentes personales no patológicos guardados con éxito');
            return redirect()->route('nonPathological.create');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Error al guardar los antecedentes personales no patológicos: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($ficha_nueva_id)
    {
        $ficha = FichaNueva::findOrFail($ficha_nueva_id);
        $apnp = Apnp::where('ficha_nueva_id', $ficha_nueva_id)->first();
        return view('edit_antecedentes.apnp_edit', compact('apnp', 'ficha'));
    }

    public function update(Request $request, $ficha_nueva_id)
    {
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

        DB::beginTransaction();
        try {
            $apnp = Apnp::where('ficha_nueva_id', $ficha_nueva_id)->first();

            if ($apnp) {
                $apnp->update($validatedData);
            } else {
                $validatedData['ficha_nueva_id'] = $ficha_nueva_id;
                Apnp::create($validatedData);
            }

            DB::commit();
            toastr()->success('Antecedentes personales no patológicos actualizados con éxito');
            return redirect()->route('nonPathological.edit', ['ficha_nueva_id' => $ficha_nueva_id]);
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Error al actualizar los antecedentes personales no patológicos: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
