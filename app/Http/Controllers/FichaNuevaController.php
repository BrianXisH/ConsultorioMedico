<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FichaNueva; // Asegúrate de tener el modelo correspondiente
use App\Models\Paciente;
use Illuminate\Support\Facades\DB;

class FichaNuevaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $pacientes = Paciente::all(); // Obtén todos los pacientes
        return view('fichas_nuevas.create', compact('pacientes')); // Asegúrate de tener esta vista
    }
    

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fecha_consulta' => 'required|date',
            'tipo_consulta' => 'required|string|max:255',
        ]);

        $pacienteId = session('selectedPacienteId');
        if (!$pacienteId) {
            return back()->with('error', 'No se ha seleccionado ningún paciente.');
        }

        DB::beginTransaction();
        try {
            $fichaNueva = new FichaNueva([
                'paciente_id' => $pacienteId,
                'fecha_consulta' => $validatedData['fecha_consulta'],
                'tipo_consulta' => $validatedData['tipo_consulta'],
            ]);
            $fichaNueva->save();

            DB::commit();
            toastr()->success('Ficha de identificación guardada con éxito.');
            return redirect()->route('pathological.index'); // Redirige a los antecedentes
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error al guardar la ficha de identificación: ' . $e->getMessage());
        }
    }
}
