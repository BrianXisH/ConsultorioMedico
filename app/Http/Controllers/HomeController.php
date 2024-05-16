<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            return view('admin.dashboard'); // Vista para el administrador
        } elseif ($user->role == 'medico') {
            return redirect()->route('welcome'); // Redirige a la ruta welcome para médicos
        }

       // return redirect()->route('welcome'); // Redirige por defecto
    }
}

