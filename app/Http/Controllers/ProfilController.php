<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfilController extends Controller
{
    /**
     * Show the profile page.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('profile.profile');
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'prenom' => ['required', 'string', 'max:255'],
        ],
        [
            'nom.required' => 'Le nom est requis.',
            'email.required' => 'L\'adresse e-mail est requise.',
            'email.email' => 'L\'adresse e-mail doit être valide.',
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
            'prenom.required' => 'Le prénom est requis.',
            'prenom.string' => 'Le prénom doit être une chaîne de caractères.',
            'prenom.max' => 'Le prénom ne doit pas dépasser 255 caractères.',
        ]);

        $user->update($validated);

        return redirect()->route('profile.show')->with('success', 'Profil mis à jour avec succès!');
    }

    public function updatePassword(Request $request)
{
    try {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed', 'different:current_password', 'min:8'],
        ], [
            'current_password.required' => 'Le mot de passe actuel est requis.',
            'current_password.current_password' => 'Le mot de passe actuel est incorrect.',
            'password.required' => 'Le nouveau mot de passe est requis.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'password.different' => 'Le nouveau mot de passe doit être différent de l\'ancien.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
        ]);

        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile.show')->with('success', 'Mot de passe modifié avec succès!');
    } catch (\Illuminate\Validation\ValidationException $e) {
        return back()->withErrors($e->validator)->withInput();
    } catch (\Exception $e) {
        return back()->with('error', 'Une erreur est survenue lors de la modification du mot de passe.')->withInput();
    }
}
}