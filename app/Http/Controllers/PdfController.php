<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Consulta;
use App\Models\User;
use App\Models\Paciente;
use Illuminate\Support\Facades\Auth;

class PdfController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $data = [
            'title' => 'Consultorio Médico UPGCH',
            'date' => date('d-m-Y'),
            'user' => $user,
            'cedula_profesional' => $user->cedula_profesional,
            'escuela_de_procedencia' => $user->escuela_de_procedencia,
        ];

        $paciente = session('selectedPacienteId');
        $selectedPaciente = Paciente::find($paciente);

        return view('receta', array_merge($data, ['selectedPaciente' => $selectedPaciente]));
    }

    public function recetanueva()
    {
        $user = auth()->user();
        $data = [
            'title' => 'Consultorio Médico UPGCH',
            'date' => date('d-m-Y'),
            'user' => $user,
            'cedula_profesional' => $user->cedula_profesional,
            'escuela_de_procedencia' => $user->escuela_de_procedencia,
        ];

        $paciente = session('selectedPacienteId');
        $selectedPaciente = Paciente::find($paciente);

        return view('receta', array_merge($data, ['selectedPaciente' => $selectedPaciente]));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'medicamento' => 'required|array',
            'instrucciones' => 'required|string',
            'diagnostico' => 'required|string',
        ]);

        $medicamentos = implode(', ', $validatedData['medicamento']);
        $receta = "Medicamentos: $medicamentos\nInstrucciones: " . $validatedData['instrucciones'];

        $fichaId = session('ultimaFichaId');
        $userId = Auth::id();

        Consulta::create([
            'receta' => $receta,
            'diagnostico' => $validatedData['diagnostico'],
            'user_id' => $userId,
            'ficha_nueva_id' => $fichaId,
        ]);

        $pdf = Pdf::loadView('receta', $validatedData);

        return $pdf->download('receta.pdf');
    }

    public function showPdf($id)
    {
        $consulta = Consulta::findOrFail($id);
        $user = Auth::user();

        $data = [
            'title' => 'Consultorio Médico UPGCH',
            'date' => $consulta->created_at ? $consulta->created_at->format('d-m-Y') : 'N/A',
            'user' => $user,
            'cedula_profesional' => $user->cedula_profesional,
            'escuela_de_procedencia' => $user->escuela_de_procedencia,
            'receta' => $consulta->receta,
            'diagnostico' => $consulta->diagnostico,
        ];

        $pdf = Pdf::loadView('receta', $data);

        return $pdf->stream('receta.pdf');
    }
}
