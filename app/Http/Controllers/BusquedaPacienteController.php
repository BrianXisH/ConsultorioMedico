<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;  // Importamos el modelo Paciente

class BusquedaPacienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Paciente::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('nombre_apellido_paterno', 'LIKE', "%{$search}%")
                  ->orWhere('nombre_apellido_materno', 'LIKE', "%{$search}%")
                  ->orWhere('nombre_nombres', 'LIKE', "%{$search}%");
            });
        }

        $pacientes = $query->paginate(10);  // Paginación de resultados

        return view('components.BusquedaPacientes', ['pacientes' => $pacientes]);
    }

    public function show($id)
    {
        session(['selectedPacienteId' => $id]);  // Almacenar ID en sesión
        return redirect()->route('receta.show');
    }
}
