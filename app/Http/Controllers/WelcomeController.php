<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        
        return view('welcome');
    }
   
    
    
    public function estadisticas()
    {
        // Obtener el total de consultas
        $totalConsultas = DB::table('consultas')->count();

        // Obtener el número de consultas por tipo de usuario
        $maestros = DB::table('consultas')
            ->join('fichas_nuevas', 'consultas.ficha_nueva_id', '=', 'fichas_nuevas.id')
            ->join('pacientes', 'fichas_nuevas.paciente_id', '=', 'pacientes.idpacientes')
            ->where('pacientes.tipo_usuario', 'maestro')
            ->count();

        $alumnos = DB::table('consultas')
            ->join('fichas_nuevas', 'consultas.ficha_nueva_id', '=', 'fichas_nuevas.id')
            ->join('pacientes', 'fichas_nuevas.paciente_id', '=', 'pacientes.idpacientes')
            ->where('pacientes.tipo_usuario', 'alumno')
            ->count();

        $administrativos = DB::table('consultas')
            ->join('fichas_nuevas', 'consultas.ficha_nueva_id', '=', 'fichas_nuevas.id')
            ->join('pacientes', 'fichas_nuevas.paciente_id', '=', 'pacientes.idpacientes')
            ->where('pacientes.tipo_usuario', 'administrativo')
            ->count();

        $visitantes = DB::table('consultas')
            ->join('fichas_nuevas', 'consultas.ficha_nueva_id', '=', 'fichas_nuevas.id')
            ->join('pacientes', 'fichas_nuevas.paciente_id', '=', 'pacientes.idpacientes')
            ->where('pacientes.tipo_usuario', 'visitante')
            ->count();

        // Calcular los porcentajes
        $maestrosPorcentaje = ($totalConsultas > 0) ? ($maestros / $totalConsultas) * 100 : 0;
        $alumnosPorcentaje = ($totalConsultas > 0) ? ($alumnos / $totalConsultas) * 100 : 0;
        $administrativosPorcentaje = ($totalConsultas > 0) ? ($administrativos / $totalConsultas) * 100 : 0;
        $visitantesPorcentaje = ($totalConsultas > 0) ? ($visitantes / $totalConsultas) * 100 : 0;

        // Obtener los totales por tipo de consulta de ambas tablas
        $tiposConsulta = ['Atencion Primaria', 'Especialista', 'Control y seguimiento', 'Prevención', 'Pediatrica'];

        $totalesPorTipoConsulta = [];
        foreach ($tiposConsulta as $tipo) {
            $totalFichasNuevas = DB::table('fichas_nuevas')
                ->where('tipo_consulta', $tipo)
                ->count();
            $totalFicIdent = DB::table('fic_ident')
                ->where('tipo_consulta', $tipo)
                ->count();
            $totalesPorTipoConsulta[$tipo] = $totalFichasNuevas + $totalFicIdent;
        }

        return view('welcome', compact('maestrosPorcentaje', 'alumnosPorcentaje', 'administrativosPorcentaje', 'visitantesPorcentaje', 'totalesPorTipoConsulta'));
    }
}
