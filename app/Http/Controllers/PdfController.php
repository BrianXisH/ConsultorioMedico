<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;

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
        return view('receta', $data);
    }
}
