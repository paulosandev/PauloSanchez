<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'authUser' => Auth::user(),
            'users' => User::all(),
        ]);
    }

    public function exportCsv()
    {
        $users = User::all();
        $csvData = '';

        $csvData .= "Nombre,Correo,Teléfono,RFC\n";

        foreach ($users as $user) {
            $csvData .= "{$user->name},{$user->email},{$user->phone},{$user->rfc}\n";
        }

        return Response::make($csvData, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="users.csv"',
        ]);
    }

    public function exportPdf()
    {
        $users = User::all();
        $pdf = PDF::loadView('pdf.users', ['users' => $users]);

        return $pdf->download('users.pdf');
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|digits:10',
            'rfc' => ['required', 'regex:/^[A-ZÑ&]{3,4}[0-9]{6}[A-Z0-9]{3}$/'],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->rfc = $request->rfc;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return response()->json(['message' => 'Usuario actualizado con éxito']);
    }
}
