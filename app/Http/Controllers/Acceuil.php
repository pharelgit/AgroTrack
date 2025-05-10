<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Parcelle;
use Illuminate\Http\Request;

class Acceuil extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role_id != 1) {
            $nb_parcelle = Parcelle::where('user_id', $user->id)->count();
            $last_parcelle = Parcelle::where('user_id', $user->id)->orderBy('created_at', 'desc')->first();
            $proprietaire = $user;
        } else {
            $nb_admin = User::where('role_id', 1)->count();
            $nb_agriculteurs = User::where('role_id', 2)->count();
            $nb_parcelle = Parcelle::count();
            $last_user = User::orderBy('created_at', 'desc')->first();
            $last_parcelle = Parcelle::orderBy('created_at', 'desc')->first();

            $proprietaire = User::find($last_parcelle->user_id);
            $last_parcelle->proprietaire = $proprietaire ? $proprietaire->nom : 'Inconnu';

            return view('admin.admin_dashboard', compact(
                'nb_admin',
                'nb_agriculteurs',
                'nb_parcelle',
                'last_user',
                'last_parcelle',
                'proprietaire'
            ));
        }
        return view('admin.admin_dashboard', compact('nb_parcelle', 'last_parcelle', 'proprietaire'));
    }
}
