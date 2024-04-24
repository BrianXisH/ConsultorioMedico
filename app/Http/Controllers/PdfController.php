<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use App\Models\FicIdent;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Consultorio Médico UPGCH',
            'date' => date('m/d/Y'),
            'user' => auth()->user()  // Asegúrate de que el usuario esté autenticado
        ];

        // Devuelve la vista con los datos necesarios
        $paciente = session('selectedPacienteId');

        $ultimaFichaId = FicIdent::where('pacientes_idpacientes', $paciente )
                          ->latest('idfi')
                          ->first()
                          ->idfi;
 // Asegúrate de que 'idfi' sea la columna de la clave primaria en la tabla fic_ident

// Ahora puedes almacenar este ID en la sesión si así lo deseas
session(['ultimaFichaId' => $ultimaFichaId]);

error_log("El ID de la ultima ficha: {$ultimaFichaId}");
        error_log("El ID del paciente guardado es: {$paciente}");

        return view('receta', $data);
    }
    public function recetanueva()
    {
        $data = [
            'title' => 'Consultorio Médico UPGCH',
            'date' => date('m/d/Y'),
            'user' => auth()->user()  // Asegúrate de que el usuario esté autenticado
        ];

        // Devuelve la vista con los datos necesarios
        $paciente = session('selectedPacienteId');

        $ultimaFichaId = FicIdent::where('pacientes_idpacientes', $paciente )
                          ->latest('idfi')
                          ->first()
                          ->idfi;
 // Asegúrate de que 'idfi' sea la columna de la clave primaria en la tabla fic_ident

// Ahora puedes almacenar este ID en la sesión si así lo deseas
session(['ultimaFichaId' => $ultimaFichaId]);

error_log("El ID de la ultima ficha: {$ultimaFichaId}");
        error_log("El ID del paciente guardado es: {$paciente}");

        return view('receta', $data);
    }
}
