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
            'tipo_consulta' => 'required',
            'fecha_consulta' => 'required|date',
            'fecha_ultima_consulta' => 'required|date',
            'motivo_ultima_consulta' => 'required|max:45',
        ], [
            'tipo_consulta.required' => 'El tipo de consulta es obligatorio',
            'fecha_consulta.required' => 'La fecha de consulta es obligatoria.',
            'fecha_consulta.date' => 'La fecha de consulta no tiene un formato válido.',
            'fecha_ultima_consulta.required' => 'La fecha de la última consulta es obligatoria.',
            'fecha_ultima_consulta.date' => 'La fecha de la última consulta no tiene un formato válido.',
            'motivo_ultima_consulta.required' => 'El motivo de la última consulta es obligatorio.',
            'motivo_ultima_consulta.max' => 'El motivo de la última consulta no debe exceder los 45 caracteres.',
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
                'tipo_consulta' => $request->input('tipo_consulta'),
            ]);
            $ficha->save();

            DB::commit();

            toastr()->success('Ficha de identificación guardada con éxito.');
            toastr()->forget('success');
            return redirect()->route('identification.index');
        } catch (\Exception $e) {

            DB::rollback();
            return back()->withErrors('Error al guardar la ficha de identificación: ' . $e->getMessage());
        }
    }
}
