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
            'motivo_consulta' => 'required|max:45',
        ], [
            'tipo_consulta.required' => 'El tipo de consulta es obligatorio',
            'fecha_consulta.required' => 'La fecha de consulta es obligatoria.',
            'fecha_consulta.date' => 'La fecha de consulta no tiene un formato válido.',
            'motivo_consulta.required' => 'El motivo de la última consulta es obligatorio.',
            'motivo_consulta.max' => 'El motivo de la última consulta no debe exceder los 45 caracteres.',
        ]);

        // Recuperar el id del paciente guardado en la sesión
        $pacienteId = session('selectedPacienteId');
        if (!$pacienteId) {
            return back()->withErrors('No se ha seleccionado ningún paciente.');
        }
        
        // Agregar log para verificar el pacienteId
        error_log("ID del paciente guardado en la sesión: " . $pacienteId);

        DB::beginTransaction();
        try {
            $ficha = new FicIdent([
                'pacientes_idpacientes' => $pacienteId,
                'fecha_consulta' => $request->input('fecha_consulta'),
                'motivo_consulta' => $request->input('motivo_consulta'),
                'tipo_consulta' => $request->input('tipo_consulta'),
            ]);
            $ficha->save();

            DB::commit();

            // Almacenar el ID de la ficha en la sesión para uso futuro
            session(['selectedFichaId' => $ficha->idfi]);

            // Agregar log para verificar el ID de la ficha guardada
            error_log("ID de la ficha guardada: " . $ficha->idfi);

            toastr()->success('Ficha de identificación guardada con éxito.');
            return redirect()->route('receta.pdf'); // Asegúrate de que esta ruta esté definida
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors('Error al guardar la ficha de identificación: ' . $e->getMessage());
        }
    }
}

