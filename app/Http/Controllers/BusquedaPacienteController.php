<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use Illuminate\Support\Facades\DB;

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
        return redirect()->route('identification.index');
    }

    // Método para buscar pacientes con ficha en fic_ident
    public function buscarPacientesConFicha(Request $request)
    {
        $search = $request->get('search');

        // Obtener los pacientes que tienen ficha en fic_ident
        $pacientes = DB::table('pacientes')
            ->join('fic_ident', 'pacientes.idpacientes', '=', 'fic_ident.pacientes_idpacientes')
            ->select('pacientes.*')
            ->when($search, function($query) use ($search) {
                return $query->where('pacientes.nombre_nombres', 'like', '%' . $search . '%')
                             ->orWhere('pacientes.nombre_apellido_paterno', 'like', '%' . $search . '%')
                             ->orWhere('pacientes.nombre_apellido_materno', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        return view('components.consultaExistente.BusquedaPacientesConFicha', compact('pacientes'));
    }
}
