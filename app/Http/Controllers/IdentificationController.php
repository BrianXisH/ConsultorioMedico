<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IdentificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('components.FichaIdentificacion');  // Asumiendo que la vista se llama 'index.blade.php' dentro de una carpeta 'identification'
    }

     // Procesa el formulario después de que el usuario lo envía
     public function procesarFormulario(Request $request)
     {
         // Aquí procesarías el formulario. Por ejemplo:
         // Validar datos, guardar en la base de datos, etc.
 
         // Después redirigir al usuario a otra página o devolver una vista
         return redirect()->route('pathological.index')->with('success', 'Formulario enviado con éxito.');
     }
}
