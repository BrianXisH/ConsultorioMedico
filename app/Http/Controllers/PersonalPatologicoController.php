<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Models\FichaNueva;
use Illuminate\Support\Facades\DB;

class PersonalPatologicoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('components.AntecedentespersonalesPatologicos');
    }

    public function store(Request $request)
    {
        $ultimaFichaId = session('selectedPacienteId');

        $validatedData = $request->validate([
            'enfermedades_inflamatorias_infecciosas_no_trasmisibles' => 'required|string|max:255',
            'enfermedades_trasmision_sexual' => 'nullable|string|max:255',
            'enfermedades_degenerativas' => 'nullable|string|max:255',
            'enfermedades_neoplasicas' => 'nullable|string|max:255',
            'enfermedades_congenitas' => 'nullable|string|max:255',
            'otras' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $personalPatologicoData = array_merge($validatedData, ['ficha_nueva_id' => $ultimaFichaId]);
            $personalPatologico = new App($personalPatologicoData);
            $personalPatologico->save();

            DB::commit();
            toastr()->success('Antecedentes personales patológicos guardados con éxito');
            return redirect()->route('pathological.index');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors('Error al guardar los antecedentes personales patológicos: ' . $e->getMessage());
        }
    }

    public function edit($ficha_nueva_id)
    {
        $ficha = FichaNueva::findOrFail($ficha_nueva_id);
        $paciente = Paciente::findOrFail($ficha->paciente_id);
        $app = App::where('ficha_nueva_id', $ficha_nueva_id)->first();
        return view('edit_antecedentes.app_edit', compact('paciente', 'app', 'ficha'));
    }

    public function update(Request $request, $ficha_nueva_id)
    {
        $validatedData = $request->validate([
            'enfermedades_inflamatorias_infecciosas_no_trasmisibles' => 'required|string|max:255',
            'enfermedades_trasmision_sexual' => 'nullable|string|max:255',
            'enfermedades_degenerativas' => 'nullable|string|max:255',
            'enfermedades_neoplasicas' => 'nullable|string|max:255',
            'enfermedades_congenitas' => 'nullable|string|max:255',
            'otras' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $app = App::where('ficha_nueva_id', $ficha_nueva_id)->first();

            if ($app) {
                $app->update($validatedData);
            } else {
                $validatedData['ficha_nueva_id'] = $ficha_nueva_id;
                App::create($validatedData);
            }

            DB::commit();
            toastr()->success('Antecedentes personales patológicos actualizados con éxito');
            return redirect()->route('pathological.edit', ['ficha_nueva_id' => $ficha_nueva_id]);
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Error al actualizar los antecedentes personales patológicos: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
