<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apnp;

class NoPatologicoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
{
    // Mostrar el formulario de antecedentes patológicos hereditarios
    return view('components.AntecedentespersonalesNoPatologicos');
}
public function store(Request $request)
    {
        // Mostrar todos los datos recibidos del formulario
         // Preparar los datos recibidos del formulario
         $data = $request->all();

         // Definir valores por defecto para campos de radio que representan booleanos
         $radioFieldsDefaults = [
             'habitos_higienicos_utiliza_auxiliares_higiene_bucal' => false,
             'habitos_higienicos_consume_golosinas_otros_alimentos_comidas' => false,
             'cuenta_cartilla_vacunacion' => false,
             'esquema_completo' => false,
             'hospitalizado' => false
         ];
 
         // Establecer valores por defecto si los campos de radio no están presentes
         foreach ($radioFieldsDefaults as $field => $defaultValue) {
             if (!$request->has($field)) {
                 $data[$field] = $defaultValue;
             } else {
                 // Convertir valores 'true'/'false' a booleanos
                 $data[$field] = $request->input($field) === 'true';
             }
         }
 
         // Asegurar que los valores de los checkboxes sean booleanos
         $checkboxFields = [
             'adicciones_tabaco',
             'adicciones_alcohol'
         ];
 
         foreach ($checkboxFields as $field) {
             $data[$field] = $request->has($field);
         }
 
         // Validar los datos del formulario
         $validatedData = $request->validate([
             // Tus reglas de validación aquí
             // Ejemplo: 'habitos_higienicos_vestuario' => 'required|string|max:255',
         ]);
 
         // Crear y guardar el registro en la base de datos
         $apnp = new Apnp($data);
         $result = $apnp->save();
 
         // Comprobar si la operación de guardado fue exitosa y redireccionar
         if ($result) {
             return redirect()->route('exploracion.index')->with('success', 'Antecedentes personales no patológicos guardados con éxito.');
         } else {
             return redirect()->back()->with('error', 'Error al guardar');
         }
     }
}
