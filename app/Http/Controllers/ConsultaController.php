<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Handle the creation of a new consultation.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function crearNueva()
    {
        // Aquí deberías incluir la lógica para inicializar una nueva consulta.
        // Por ejemplo, mostrar un formulario para ingresar datos de la consulta o directamente crear un registro en la base de datos.

        return redirect()->route('pacientes.index'); // Retorna la vista donde se crea una nueva consulta.
    }
    public function registrar()
    {
        // Aquí deberías incluir la lógica para inicializar una nueva consulta.
        // Por ejemplo, mostrar un formulario para ingresar datos de la consulta o directamente crear un registro en la base de datos.

        return redirect()->route('identification'); // Retorna la vista donde se crea una nueva consulta.
    }

    /**
     * Handle the creation of a consultation from existing data.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function crearExistente()
    {
        // Aquí deberías incluir la lógica para manejar la creación de consultas desde datos existentes.
        // Podría ser un formulario que liste consultas anteriores para seleccionar y editar.

        return redirect()->route('pacientes.buscarConFicha'); // Retorna la vista donde se gestionan las consultas existentes.
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();

        return redirect('/login'); // Redirige al usuario a la página de inicio de sesión tras cerrar sesión.
    }
}

