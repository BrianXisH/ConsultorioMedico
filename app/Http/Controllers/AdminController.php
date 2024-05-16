<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    // Mostrar todos los médicos
    public function index()
    {
        $medicos = User::where('role', 'admin')->get();
        return view('admin.medicos.index', compact('admin'));
    }

    // Mostrar el formulario para crear un nuevo médico
    public function create()
    {
        return view('admin.medicos.create');
    }

    // Almacenar un nuevo médico
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'medico',
        ]);

        return redirect()->route('admin.medicos.index')->with('success', 'Médico creado exitosamente');
    }

    // Mostrar el formulario para editar un médico
    public function edit($id)
    {
        $medico = User::findOrFail($id);
        return view('admin.medicos.edit', compact('medico'));
    }

    // Actualizar un médico
    public function update(Request $request, $id)
    {
        $medico = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $medico->id,
        ]);

        $medico->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.medicos.index')->with('success', 'Médico actualizado exitosamente');
    }

    // Eliminar un médico
    public function destroy($id)
    {
        $medico = User::findOrFail($id);
        $medico->delete();

        return redirect()->route('admin.medicos.index')->with('success', 'Médico eliminado exitosamente');
    }
}
