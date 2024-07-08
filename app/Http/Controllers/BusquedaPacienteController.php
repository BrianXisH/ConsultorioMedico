<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\FicIdent;
use App\Models\FichaNueva;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class BusquedaPacienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Paciente::leftJoin('fichas_nuevas', 'pacientes.idpacientes', '=', 'fichas_nuevas.paciente_id')
                         ->select('pacientes.*')
                         ->whereNull('fichas_nuevas.paciente_id');

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
    
        // Obtener los pacientes que tienen ficha en fichas_nuevas
        $pacientes = DB::table('pacientes')
            ->join('fichas_nuevas', 'pacientes.idpacientes', '=', 'fichas_nuevas.paciente_id')
            ->select('pacientes.*')
            ->when($search, function($query) use ($search) {
                return $query->where('pacientes.nombre_nombres', 'like', '%' . $search . '%')
                             ->orWhere('pacientes.nombre_apellido_paterno', 'like', '%' . $search . '%')
                             ->orWhere('pacientes.nombre_apellido_materno', 'like', '%' . $search . '%');
            })
            ->groupBy('pacientes.idpacientes')  // Agrupar por ID del paciente para evitar duplicados
            ->paginate(10);
    
        return view('components.consultaExistente.BusquedaPacientesConFicha', compact('pacientes'));
    }
    
    public function verConsultas($id)
    {
        $paciente = Paciente::findOrFail($id); // Obtener el paciente por su ID
    
        // Obtener las consultas del paciente de ambas tablas
        $consultasFicIdent = FicIdent::where('pacientes_idpacientes', $id)
                                      ->select('fecha_consulta', 'motivo_consulta', 'tipo_consulta')
                                      ->get();
    
        $consultasFichasNuevas = FichaNueva::where('paciente_id', $id)
                                            ->select('fecha_consulta', 'motivo_consulta', 'tipo_consulta')
                                            ->get();
    
        // Combinar ambas colecciones
        $consultas = $consultasFicIdent->merge($consultasFichasNuevas)->sortByDesc('fecha_consulta');
    
        // Paginación manual
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $consultas->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $paginatedConsultas = new LengthAwarePaginator($currentItems, $consultas->count(), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);
    
        return view('pacientes.consultas', compact('paciente', 'paginatedConsultas'));
    }
    
    public function verAntecedentes($id)
    {
        $paciente = Paciente::findOrFail($id); // Obtener el paciente por su ID
        $fichaReciente = FichaNueva::where('paciente_id', $id)->latest()->first(); // Obtener la ficha más reciente del paciente
    
        return view('pacientes.antecedentes', compact('paciente', 'fichaReciente'));
    }
    


}
