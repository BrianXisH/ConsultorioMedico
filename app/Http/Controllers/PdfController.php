<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Consulta;
use App\Models\FichaNueva;
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
            'date' => date('m/d/Y'),
            'user' => $user,
            'cedula_profesional' => $user->cedula_profesional,
            'escuela_de_procedencia' => $user->escuela_de_procedencia,
        ];

        $paciente = session('selectedPacienteId');

        // Obtén la última ficha nueva del paciente
        $ultimaFicha = FichaNueva::where('paciente_id', $paciente)->latest('id')->first();

        // Verifica si se encontró la ficha
        if ($ultimaFicha) {
            $ultimaFichaId = $ultimaFicha->id;
            session(['ultimaFichaId' => $ultimaFichaId]);
            error_log("El ID de la ultima ficha: {$ultimaFichaId}");
        } else {
            error_log("No se encontró la ficha nueva para el paciente: {$paciente}");
        }

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

        // Obtén la última ficha nueva del paciente
        $ultimaFicha = FichaNueva::where('paciente_id', $paciente)->latest('id')->first();

        // Verifica si se encontró la ficha
        if ($ultimaFicha) {
            $ultimaFichaId = $ultimaFicha->id;
            session(['ultimaFichaId' => $ultimaFichaId]);
            error_log("El ID de la ultima ficha: {$ultimaFichaId}");
        } else {
            error_log("No se encontró la ficha nueva para el paciente: {$paciente}");
        }

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

        if (!$fichaId) {
            return back()->withErrors(['error' => 'No se pudo obtener el ID de la ficha.']);
        }

        Consulta::create([
            'receta' => $receta,
            'diagnostico' => $validatedData['diagnostico'],
            'user_id' => $userId,
            'ficha_nueva_id' => $fichaId,
        ]);

        $pdfData = array_merge($validatedData, ['user' => Auth::user()]);
        $pdf = Pdf::loadView('receta', $pdfData);

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
