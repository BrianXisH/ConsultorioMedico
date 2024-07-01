<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apnp;
use App\Models\FicIdent;
use App\Models\Paciente;
use Illuminate\Support\Facades\DB;

class NoPatologicoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('components.AntecedentespersonalesNoPatologicos');
    }
    public function store(Request $request)
    {
        $ultimaFichaId = session('selectedPacienteId');

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
            $personalNoPatologico = new Apnp(array_merge($validatedData, ['fic_ident_idfi' => $ultimaFichaId]));
            $personalNoPatologico->save();

            DB::commit();
            toastr()->success('Antecedentes personales no patológicos guardados con éxito');
            return redirect()->route('nonPathological.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Error al guardar los antecedentes personales no patológicos: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($fic_ident_idfi)
    {
        $ficha = FicIdent::findOrFail($fic_ident_idfi);
        $paciente = Paciente::findOrFail($ficha->pacientes_idpacientes);
        $apnp = Apnp::where('fic_ident_idfi', $fic_ident_idfi)->first();
        return view('edit_antecedentes.apnp_edit', compact('paciente', 'apnp', 'ficha'));
    }

    public function update(Request $request, $fic_ident_idfi)
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
            $apnp = Apnp::where('fic_ident_idfi', $fic_ident_idfi)->first();

            if ($apnp) {
                $apnp->update($validatedData);
            } else {
                $validatedData['fic_ident_idfi'] = $fic_ident_idfi;
                Apnp::create($validatedData);
            }

            DB::commit();
            toastr()->success('Antecedentes personales no patológicos actualizados con éxito');
            return redirect()->route('nonPathological.edit', ['fic_ident_idfi' => $fic_ident_idfi]);
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Error al actualizar los antecedentes personales no patológicos: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
