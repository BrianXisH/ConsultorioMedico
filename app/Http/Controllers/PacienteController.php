<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;

class PacienteController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'usuario_id' => 'required|integer',
            'nombre_apellido_paterno' => 'required|string|max:50',
            'nombre_apellido_materno' => 'required|string|max:50',
            'nombre_nombres' => 'required|string|max:50',
            'edad_anios' => 'required|integer',
            'edad_meses' => 'required|integer',
            'genero_masculino' => 'required|boolean',
            'genero_femenino' => 'required|boolean',
            'lugar_nacimiento_estado' => 'required|string|max:50',
            'lugar_nacimiento_ciudad' => 'required|string|max:50',
            'fecha_nacimiento' => 'required|date',
            'ocupacion' => 'required|string|max:50',
            'escolaridad' => 'required|string|max:50',
            'estado_civil' => 'required|string|max:20',
            'domicilio_calle' => 'required|string|max:100',
            'domicilio_num_exterior' => 'required|string|max:10',
            'domicilio_num_interior' => 'required|string|max:10',
            'domicilio_colonia' => 'required|string|max:50',
            'domicilio_estado' => 'required|string|max:50',
            'domicilio_mpio' => 'required|string|max:50',
            'domicilio_delegacion' => 'required|string|max:50',
            'telefono' => 'required|string|max:20',
            'telefono_oficina' => 'required|string|max:20',
        ]);

        $paciente = new Paciente($data);
        $paciente->save();

        //return response()->json(['message' => 'Paciente creado con éxito'], 201);
    }
}