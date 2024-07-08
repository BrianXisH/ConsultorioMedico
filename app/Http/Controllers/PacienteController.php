<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;

class PacienteController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'curp' => 'required|string|max:18',
            'nombre_apellido_paterno' => 'required|string|max:50',
            'nombre_apellido_materno' => 'required|string|max:50',
            'nombre_nombres' => 'required|string|max:50',
            'edad_anios' => 'required|integer',
            'genero' => 'required|string',
            'lugar_nacimiento_estado' => 'required|string|max:50',
            'lugar_nacimiento_ciudad' => 'required|string|max:50',
            'fecha_nacimiento' => 'required|date',
            'ocupacion' => 'nullable|string|max:50',
            'escolaridad' => 'nullable|string|max:50',
            'estado_civil' => 'nullable|string|max:20',
            'domicilio_calle' => 'nullable|string|max:100',
            'domicilio_num_exterior' => 'nullable|integer',
            'domicilio_num_interior' => 'nullable|integer',
            'domicilio_colonia' => 'nullable|string|max:50',
            'domicilio_estado' => 'nullable|string|max:50',
            'domicilio_mpio' => 'nullable|string|max:50',
            'domicilio_delegacion' => 'nullable|string|max:50',
            'telefono' => 'nullable|string|max:20',
            'telefono_oficina' => 'nullable|string|max:20',
            'tipo_usuario' => 'required|string|max:45',  // Añadir esta línea
        ]);

        $paciente = new Paciente($data);
        $paciente->save();

        //return redirect()->route('welcome')->with('success', 'Paciente creado con éxito');
    }
}
