<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ipsa;
use App\Models\FichaNueva;
use App\Models\Paciente;
use Illuminate\Support\Facades\DB;

class InterrogatorioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('components.InterrogatorioAparatosSistemas');
    }

    public function store(Request $request)
    {
        $ultimaFichaId = session('selectedPacienteId'); 

        $validatedData = $request->validate([
            'interrogatorio_aparato_digestivo' => 'nullable|string|max:255',
            'interrogatorio_aparato_respiratorio' => 'nullable|string|max:255',
            'interrogatorio_cardiovascular' => 'nullable|string|max:255',
            'interrogatorio_aparato_genitourinario' => 'nullable|string|max:255',
            'interrogatorio_sistema_endocrino' => 'nullable|string|max:255',
            'interrogatorio_sistema_hemepoyetico' => 'nullable|string|max:255',
            'interrogatorio_sistema_nervioso' => 'nullable|string|max:255',
            'interrogatorio_sistema_musculoesqueletico' => 'nullable|string|max:255',
            'interrogatorio_sistema_tegumentario' => 'nullable|string|max:255',
            'habitus_exterior' => 'nullable|string|max:255',
            'peso' => 'nullable|numeric',
            'talla' => 'nullable|numeric',
            'complexion' => 'nullable|string|max:255',
            'frecuencia_cardiaca' => 'nullable|numeric',
            'sistolica' => 'nullable|numeric',
            'diastolica' => 'nullable|numeric',
            'frecuencia_respiratoria' => 'nullable|numeric',
            'temperatura' => 'nullable|numeric',
        ]);

        DB::beginTransaction();
        try {
            $ipsaData = array_merge($validatedData, ['ficha_nueva_id' => $ultimaFichaId]);
            $ipsa = new Ipsa($ipsaData);
            $ipsa->save();

            DB::commit();
            toastr()->success('Interrogatorio guardado con éxito');
            return redirect()->route('interrogatorio.index');
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Error al guardar el interrogatorio: ' . $e->getMessage());
            return back();
        }
    }

    public function edit($ficha_nueva_id)
    {
        $ficha = FichaNueva::findOrFail($ficha_nueva_id);
        $paciente = Paciente::findOrFail($ficha->pacientes_idpacientes);
        $ipsa = Ipsa::where('ficha_nueva_id', $ficha_nueva_id)->first();
        return view('edit_antecedentes.ipsa_edit', compact('paciente', 'ipsa', 'ficha'));
    }

    public function update(Request $request, $ficha_nueva_id)
    {
        $validatedData = $request->validate([
            'interrogatorio_aparato_digestivo' => 'nullable|string|max:255',
            'interrogatorio_aparato_respiratorio' => 'nullable|string|max:255',
            'interrogatorio_cardiovascular' => 'nullable|string|max:255',
            'interrogatorio_aparato_genitourinario' => 'nullable|string|max:255',
            'interrogatorio_sistema_endocrino' => 'nullable|string|max:255',
            'interrogatorio_sistema_hemepoyetico' => 'nullable|string|max:255',
            'interrogatorio_sistema_nervioso' => 'nullable|string|max:255',
            'interrogatorio_sistema_musculoesqueletico' => 'nullable|string|max:255',
            'interrogatorio_sistema_tegumentario' => 'nullable|string|max:255',
            'habitus_exterior' => 'nullable|string|max:255',
            'peso' => 'nullable|numeric',
            'talla' => 'nullable|numeric',
            'complexion' => 'nullable|string|max:255',
            'frecuencia_cardiaca' => 'nullable|numeric',
            'sistolica' => 'nullable|numeric',
            'diastolica' => 'nullable|numeric',
            'frecuencia_respiratoria' => 'nullable|numeric',
            'temperatura' => 'nullable|numeric',
        ]);

        DB::beginTransaction();
        try {
            $ipsa = Ipsa::where('ficha_nueva_id', $ficha_nueva_id)->first();

            if ($ipsa) {
                $ipsa->update($validatedData);
            } else {
                $validatedData['ficha_nueva_id'] = $ficha_nueva_id;
                Ipsa::create($validatedData);
            }

            DB::commit();
            toastr()->success('Interrogatorio actualizado con éxito');
            return redirect()->route('interrogatorio.edit', ['ficha_nueva_id' => $ficha_nueva_id]);
        } catch (\Exception $e) {
            DB::rollback();
            toastr()->error('Error al actualizar el interrogatorio: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
