<?php
namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use App\Models\FichaNueva;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function index()
    {
        $user = auth()->user();  // Asegúrate de que el usuario esté autenticado
        $data = [
            'title' => 'Consultorio Médico UPGCH',
            'date' => date('m/d/Y'),
            'user' => $user,
            'cedula_profesional' => $user->cedula_profesional,
            'escuela_de_procedencia' => $user->escuela_de_procedencia,
        ];

        // Devuelve la vista con los datos necesarios
        $paciente = session('selectedPacienteId');

        $ultimaFichaId = FichaNueva::where('paciente_id', $paciente )
                          ->latest('id')
                          ->first()
                          ->id;
        // Asegúrate de que 'id' sea la columna de la clave primaria en la tabla fichas_nuevas

        // Ahora puedes almacenar este ID en la sesión si así lo deseas
        session(['ultimaFichaId' => $ultimaFichaId]);

        error_log("El ID de la ultima ficha: {$ultimaFichaId}");
        error_log("El ID del paciente guardado es: {$paciente}");

        return view('receta', $data);
    }

    public function recetanueva()
    {
        $user = auth()->user();  // Asegúrate de que el usuario esté autenticado
        $data = [
            'title' => 'Consultorio Médico UPGCH',
            'date' => date('m/d/Y'),
            'user' => $user,
            'cedula_profesional' => $user->cedula_profesional,
            'escuela_de_procedencia' => $user->escuela_de_procedencia,
        ];

        // Devuelve la vista con los datos necesarios
        $paciente = session('selectedPacienteId');

        $ultimaFichaId = FichaNueva::where('paciente_id', $paciente )
                          ->latest('id')
                          ->first()
                          ->id;
        // Asegúrate de que 'id' sea la columna de la clave primaria en la tabla fichas_nuevas

        // Ahora puedes almacenar este ID en la sesión si así lo deseas
        session(['ultimaFichaId' => $ultimaFichaId]);

        error_log("El ID de la ultima ficha: {$ultimaFichaId}");
        error_log("El ID del paciente guardado es: {$paciente}");

        return view('receta', $data);
    }
}
