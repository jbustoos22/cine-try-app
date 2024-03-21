<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'user' => auth()->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        // dd($validatedData);
        // exit;
        // Obtiene el usuario actual
        $user = $request->user();
        
        // dd($user);
        // exit;
        // Actualiza la información del perfil
        $user->fill([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'cedula' => $validatedData['cedula'],
            'telefono' => $validatedData['telefono'],
            'pais' => $validatedData['pais'],
            'ciudad' => $validatedData['ciudad'],
            'estado' => $validatedData['estado']
        ]);

        // dump($request->hasFile('foto'));
        // exit;
        // Verifica si se ha subido una nueva imagen

        // Guarda los cambios en el perfil
        $user->save();

        // Redirecciona a la página de edición del perfil
        return redirect()->route('profile.edit')->with('success', 'Perfil actualizado correctamente');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
