<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MedicoController extends Controller
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
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'medico',
        ]);

        return redirect()->route('medicos.index')->with('success', 'Médico creado exitosamente');
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
        ]);

        $medico->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('medicos.index')->with('success', 'Médico actualizado exitosamente');
    }

    public function destroy($id)
    {
        $medico = User::findOrFail($id);
        $medico->delete();

        return redirect()->route('medicos.index')->with('success', 'Médico eliminado exitosamente');
    }
}
