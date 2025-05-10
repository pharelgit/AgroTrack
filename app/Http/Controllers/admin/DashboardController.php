<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parcelle;
use App\Models\User;
use App\Models\Localisation;
use App\Models\Statuts;
use Illuminate\Support\Facades\Auth;
use App\Models\Intervention;
use App\Models\Role;



class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $user = auth()->user();

    // Si AGRICULTEUR
    if ($user->role_id != 1) {
        $parcelles = Parcelle::with('localisation', 'statut')
            ->where('user_id', $user->id)
            ->get();

        $nb_parcelle = $parcelles->count();
        $last_parcelle = $parcelles->sortByDesc('created_at')->first();
        $proprietaire = $user->nom;

        // Interventions liées à l'agriculteur
        $nb_intervention = Intervention::where('user_id', $user->id)->count();
        $last_intervention = Intervention::where('user_id', $user->id)->latest()->first();

        return view('admin.admin_dashboard', compact(
            'nb_parcelle',
            'last_parcelle',
            'proprietaire',
            'parcelles',
            'nb_intervention',
            'last_intervention'
        ));
    }

    // Si ADMIN
    $parcelles = Parcelle::with('localisation', 'statut')->get();

    $nb_admin = User::where('role_id', 1)->count();
    $nb_agriculteurs = User::where('role_id', 2)->count();
    $nb_parcelle = $parcelles->count();
    $last_user = User::orderBy('created_at', 'desc')->first();
    $last_parcelle = $parcelles->sortByDesc('created_at')->first();

    $proprietaire = null;
    if ($last_parcelle) {
        $owner = User::find($last_parcelle->user_id);
        $proprietaire = $owner ? $owner->nom : 'Inconnu';
        $last_parcelle->proprietaire = $proprietaire;
    }

    // Interventions globales
    $nb_intervention = Intervention::count();
    $last_intervention = Intervention::latest()->first();

    return view('admin.admin_dashboard', compact(
        'nb_admin',
        'nb_agriculteurs',
        'nb_parcelle',
        'last_user',
        'last_parcelle',
        'proprietaire',
        'parcelles',
        'nb_intervention',
        'last_intervention'
    ));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
