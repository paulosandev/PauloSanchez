<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function create()
    {
        return inertia('Auth/Register');
    }

    public function store(Request $request)
    {
        // Definir las reglas de validación
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|digits:10',
            'email' => 'required|email|unique:users,email',
            'rfc' => ['required', 'regex:/^[A-ZÑ&]{3,4}[0-9]{6}[A-Z0-9]{3}$/', 'unique:users,rfc'],
            'password' => 'required|string|min:8|confirmed',
            'notes' => 'nullable|string',
        ]);

        // Validar la solicitud
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Crear el usuario si la validación pasa
        User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'rfc' => $request->rfc,
            'password' => Hash::make($request->password),
            'notes' => $request->notes,
        ]);

        return redirect()->route('login')->with('success', 'Usuario registrado con éxito');
    }
}
