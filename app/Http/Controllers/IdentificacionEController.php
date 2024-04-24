<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FicIdent;
use Illuminate\Support\Facades\DB;

class IdentificacionEController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('components.FichaE'); // Asegúrate de que este sea el nombre correcto de la vista.
    }

    public function procesarFormulario(Request $request)
    {
        $request->validate([
            'fecha_consulta' => 'required|date',
            'fecha_ultima_consulta' => 'required|date',
            'motivo_ultima_consulta' => 'required|max:45',
        ]);

        // Recuperar el id del paciente guardado en la sesión
        $pacienteId = session('selectedPacienteId');
        if (!$pacienteId) {
            return back()->withErrors('No se ha seleccionado ningún paciente.');
        }
        $errorLog = "ID del paciente guardado en la sesión: " . $pacienteId;
        error_log($errorLog);

        DB::beginTransaction();
        try {
            $ficha = new FicIdent([
                'pacientes_idpacientes' => $pacienteId,
                'fecha_consulta' => $request->input('fecha_consulta'),
                'fecha_ultima_consulta' => $request->input('fecha_ultima_consulta'),
                'motivo_ultima_consulta' => $request->input('motivo_ultima_consulta'),
            ]);
            $ficha->save();

            DB::commit();
            return redirect()->route('pathological.index')->with('success', 'La ficha de identificación ha sido guardada correctamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors('Error al guardar la ficha de identificación: ' . $e->getMessage());
        }
    }
}
