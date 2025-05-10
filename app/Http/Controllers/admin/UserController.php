<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::when($search, function ($query) use ($search) {
            $query->where('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        })->get();

        return view('admin.user.index', [
            'currentPage' => 'users',
            'users' => $users,
            'search' => $search,
        ]);
    }

    public function create()
    {
        $roles = Role::all(); // Important si tu veux afficher les rôles dans la création
        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'exists:roles,id'],
        ]);

        // Création de l'utilisateur
        User::create([
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role_id' => $validatedData['role_id'],
        ]);

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all(); // Récupérer tous les rôles disponibles
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $validatedData = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'exists:roles,id'],
            'statut' => ['required', 'in:actif,inactif'],
        ]);

        // Mise à jour de l'utilisateur
        $user = User::findOrFail($id);
        $user->nom = $validatedData['nom'];
        $user->prenom = $validatedData['prenom'];
        $user->email = $validatedData['email'];
        $user->role_id = $validatedData['role_id'];
        $user->statut = $validatedData['statut'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
