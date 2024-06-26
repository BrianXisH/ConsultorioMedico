<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;  // Asegúrate de importar el modelo Paciente
use App\Models\Estado;  // Asegúrate de importar el modelo Estado
use App\Models\Municipio;  // Asegúrate de importar el modelo Municipio
use Illuminate\Support\Facades\DB;  // Importar para manejar transacciones

class IdentificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $estados = Estado::all();  // Obtener todos los estados para cargar en el formulario
        return view('components.FichaIdentificacion', compact('estados'));  // Vista del formulario
    }

    public function procesarFormulario(Request $request)
    {
        $validatedData = $request->validate([
            
            'curp' => 'required|size:18',
            'nombre_apellido_paterno' => 'required|max:45',
            'nombre_apellido_materno' => 'required|max:45',
            'nombre_nombres' => 'required|max:45',
            'edad_anios' => 'required|integer',
            'genero' => 'required|in:masculino,femenino',
            'lugar_nacimiento_estado' => 'required|max:45',
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
            'telefono' => 'nullable|max:45',
            'telefono_oficina' => 'nullable|max:45',
        ], [
            'curp.required' => 'La CURP es obligatoria.',
            'nombre_apellido_paterno.required' => 'El apellido paterno es obligatorio.',
            'nombre_apellido_materno.required' => 'El apellido materno es obligatorio.',
            'nombre_nombres.required' => 'El nombre es obligatorio.',
            'edad_anios.required' => 'La edad es obligatoria.',
            'edad_anios.integer' => 'La edad debe ser un número entero.',
            'genero.required' => 'El género es obligatorio.',
            'lugar_nacimiento_estado.required' => 'El estado de nacimiento es obligatorio.',
            'lugar_nacimiento_ciudad.required' => 'La ciudad de nacimiento es obligatoria.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.date' => 'La fecha de nacimiento no tiene un formato válido.',
            'ocupacion.max' => 'La ocupación no debe superar los 45 caracteres.',
            'escolaridad.max' => 'La escolaridad no debe superar los 45 caracteres.',
            'estado_civil.max' => 'El estado civil no debe superar los 45 caracteres.',
            'domicilio_calle.max' => 'La calle no debe superar los 45 caracteres.',
            'domicilio_num_exterior.integer' => 'El número exterior debe ser un número entero.',
            'domicilio_num_interior.integer' => 'El número interior debe ser un número entero.',
            'domicilio_colonia.max' => 'La colonia no debe superar los 45 caracteres.',
            'domicilio_estado.max' => 'El estado no debe superar los 45 caracteres.',
            'domicilio_mpio.max' => 'El municipio no debe superar los 45 caracteres.',
            'telefono.max' => 'El teléfono no debe superar los 45 caracteres.',
            'telefono_oficina.max' => 'El teléfono de oficina no debe superar los 45 caracteres.',
        ]);
        $pacienteExistente = Paciente::where('curp', $validatedData['curp'])->first();
        if ($pacienteExistente) {
            return back()->withErrors(['curp' => 'Ya existe un paciente registrado con esta CURP.']);
        }

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
            
            toastr()->success('Usuario registrado con exito');
            toastr()->forget('success');
            return redirect()->route('identification');
        } catch (\Exception $e) {
            DB::rollback();  // Revertir transacción en caso de error
            return back()->withErrors(['error' => 'Error al registrar paciente: ' . $e->getMessage()]);
        }
    }

    public function getMunicipios($estado_id)
    {
        $municipios = Municipio::where('estado_id', $estado_id)->get();
        return response()->json($municipios);
    }
}
