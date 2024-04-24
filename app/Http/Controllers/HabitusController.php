<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HabitusController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'habitusExterior' => 'required|string',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'complexion' => 'required|string',
            'heartRate' => 'required|numeric',
            'bloodPressure' => 'required|string',
            'respiratoryRate' => 'required|numeric',
            'temperature' => 'required|numeric',
        ]);

        // Aquí puedes guardar la información en la base de datos o realizar otras acciones

        return redirect()->back()->with('success', 'Datos de Habitus exterior y Signos Vitales guardados exitosamente');
    }
}
