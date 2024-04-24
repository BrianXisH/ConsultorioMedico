<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        // Suponiendo que tienes la lógica para obtener los porcentajes de la base de datos
        $maestrosPorcentaje = 40; // Porcentaje de maestros obtenido de la base de datos
        $alumnosPorcentaje = 30; // Porcentaje de alumnos obtenido de la base de datos
        $administrativosPorcentaje = 30; // Porcentaje de administrativos obtenido de la base de datos

        return view('welcome', compact('maestrosPorcentaje', 'alumnosPorcentaje', 'administrativosPorcentaje'));
    }
}
