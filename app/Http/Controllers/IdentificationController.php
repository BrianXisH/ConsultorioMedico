<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;  // Asegúrate de importar el modelo Paciente
use App\Models\FicIdent;  // Asegúrate de importar el modelo FicIdent
use Illuminate\Support\Facades\DB;  // Importar para manejar transacciones

class IdentificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('components.FichaIdentificacion');  // Vista del formulario
    }

    public function procesarFormulario(Request $request)
    {
        $validatedData = $request->validate([
            'nombre_apellido_paterno' => 'required|max:45',
            'nombre_apellido_materno' => 'required|max:45',
            'nombre_nombres' => 'required|max:45',
            'edad_anios' => 'required|integer',
            'genero' => 'required|in:masculino,femenino',
            'ugar_nacimiento_estado' => 'required|max:45',
            'lugar_nacimiento_ciudad' => 'required|max:45',
            'fecha_nacimiento' => 'required|date',
            'ocupacion' => 'nullable|max:45',
            'escolaridad' => 'nullable|max:45',
            'estado_civil' => 'nullable|max:45',
            'domicilio_calle' => 'nullable|max:45',
            'domicilio_num_exterior' => 'nullable|integer',
            'domicilio_num_interior' => 'nullable|integer',
            'domicilio_colonia' => 'nullable|max:45',
            'domicilio_estado' => 'nullable|max:45',
            'domicilio_mpio' => 'nullable|max:45',
            'domicilio_delegacion' => 'nullable|max:45',
            'telefono' => 'nullable|max:45',
            'telefono_oficina' => 'nullable|max:45',
        
        ]);

        // Transacción para asegurar la integridad de los datos
        DB::beginTransaction();
        try {
            $pacienteData = $validatedData;
            $pacienteData['genero_masculino'] = $validatedData['genero'] === 'masculino' ? true : false;
            $pacienteData['genero_femenino'] = $validatedData['genero'] === 'femenino' ? true : false;
            unset($pacienteData['genero']); 

            



            $paciente = new Paciente($pacienteData);
            $paciente->save();  // Guardar primero el paciente
              // Guardar el ID del paciente en la sesión

              session(['selectedPacienteId' => $paciente->id]);

              error_log("El ID del paciente guardado es: {$paciente->id}");
            DB::commit();  // Confirmar transacción
            

            return redirect()->route('welcome');  // Redirigir a la vista de identificación existente
        } catch (\Exception $e) {
            DB::rollback();  // Revertir transacción en caso de error
            return back()->withErrors('Error al guardar los datos: ' . $e->getMessage());
        }
    }
}
