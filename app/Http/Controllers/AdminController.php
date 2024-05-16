<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $medicos = User::where('role', 'medico')->get();
        return view('admin.medicos.index', compact('medicos'));
    }

    public function create()
    {
        return view('admin.medicos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'cedula_profesional' => 'required|string|max:255',
            'escuela_de_procedencia' => 'required|string|max:255',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'medico',
            'cedula_profesional' => $request->cedula_profesional,
            'escuela_de_procedencia' => $request->escuela_de_procedencia,
        ]);
        
        return redirect()->route('admin.medicos.index')->with('success', 'Médico creado exitosamente');
    }

    public function edit($id)
    {
        $medico = User::findOrFail($id);
        return view('admin.medicos.edit', compact('medico'));
    }

    public function update(Request $request, $id)
    {
        $medico = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $medico->id,
            'cedula_profesional' => 'required|string|max:255',
            'escuela_de_procedencia' => 'required|string|max:255',
        ]);

        $medico->update([
            'name' => $request->name,
            'email' => $request->email,
            'cedula_profesional' => $request->cedula_profesional,
            'escuela_de_procedencia' => $request->escuela_de_procedencia,
        ]);
        
        return redirect()->route('admin.medicos.index')->with('success', 'Médico actualizado exitosamente');
    }

    public function destroy($id)
    {
        $medico = User::findOrFail($id);
        $medico->delete();
        
        return redirect()->route('admin.medicos.index')->with('success', 'Médico eliminado exitosamente');
    }
}
