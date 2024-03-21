<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSalaRequest;
use App\Models\Sala;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SalaController extends Controller
{
    //
    function index()
    {
        return Inertia::render('Vista/Salas', [
            'user' => auth()->user(), // Aquí estás pasando la información de sesión del usuario como una propiedad llamada 'user'
        ]);
    }

    function crearSalaIndex()
    {
        return Inertia::render('Auth/NewSala');
    }
    function updateSalaIndex()
    {
        return Inertia::render('Auth/UpdateSala');
    }
    function mapaAsientos()
    {
        return Inertia::render('Vista/Asientos', [
            'user' => auth()->user()
        ]);
    }
    function obtenerSalas()
    {
        $salas = Sala::all();

        return response()->json(['salas' => $salas]);
    }
    function obtenerSalaById($id)
    {
        $salas = Sala::find($id);

        return response()->json(['salas' => $salas]);
    }

    public function store(StoreSalaRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        // dd($validatedData);
        // exit;

        $sala = Sala::create([
            'numero' => $validatedData['numero'], // Acceder a 'numero' usando corchetes
            'tipo' => $validatedData['tipo'], // Acceder a 'tipo' usando corchetes
            'aforo' => $validatedData['aforo'], // Acceder a 'aforo' usando corchetes
            'desde' => $validatedData['desde'], // Acceder a 'desde' usando corchetes
            'hasta' => $validatedData['hasta'], // Acceder a 'hasta' usando corchetes
            'id_pelicula' => $validatedData['id_pelicula'] // Acceder a 'id_pelicula' usando corchetes
        ]);

        $sala->save();

        return redirect('dashboard');
    }

    function adminSalas()
    {
        return Inertia::render("Admin/AdminSalas", [
            'user' => auth()->user(), // Aquí estás pasando la información de sesión del usuario como una propiedad llamada 'user'
        ]);
    }
}
