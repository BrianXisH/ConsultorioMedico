<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\User;
use App\Models\Paciente;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::with('user', 'paciente')->get();
        return view('citas.index', compact('citas'));
    }

    public function create()
    {
        $pacientes = Paciente::all();
        return view('citas.create', compact('pacientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,idpacientes',
            'fecha_hora' => 'required|date',
            'descripcion' => 'nullable|string',
        ]);

        Cita::create([
            'user_id' => auth()->id(),
            'paciente_id' => $request->paciente_id,
            'fecha_hora' => $request->fecha_hora,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('citas.index')->with('success', 'Cita creada exitosamente.');
    }
}
