<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use App\Models\FichaNueva;
use App\Models\Consulta;
use Illuminate\Support\Facades\Auth;

class PdfController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $data = [
            'title' => 'Consultorio Médico UPGCH',
            'date' => date('m/d/Y'),
            'user' => $user,
            'cedula_profesional' => $user->cedula_profesional,
            'escuela_de_procedencia' => $user->escuela_de_procedencia,
        ];

        $paciente = session('selectedPacienteId');

        $ultimaFichaId = FichaNueva::where('paciente_id', $paciente)
                          ->latest('id')
                          ->first()
                          ->id;

        session(['ultimaFichaId' => $ultimaFichaId]);

        error_log("El ID de la ultima ficha: {$ultimaFichaId}");
        error_log("El ID del paciente guardado es: {$paciente}");

        return view('receta', $data);
    }

    public function recetanueva()
    {
        $user = auth()->user();
        $data = [
            'title' => 'Consultorio Médico UPGCH',
            'date' => date('m/d/Y'),
            'user' => $user,
            'cedula_profesional' => $user->cedula_profesional,
            'escuela_de_procedencia' => $user->escuela_de_procedencia,
        ];

        $paciente = session('selectedPacienteId');

        $ultimaFichaId = FichaNueva::where('paciente_id', $paciente)
                          ->latest('id')
                          ->first()
                          ->id;

        session(['ultimaFichaId' => $ultimaFichaId]);

        error_log("El ID de la ultima ficha: {$ultimaFichaId}");
        error_log("El ID del paciente guardado es: {$paciente}");

        return view('receta', $data);
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
}
