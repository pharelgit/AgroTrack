<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use App\Models\TypeIntervention;
use App\Models\Parcelle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PDF;

class InterventionsController extends Controller
{
    /**
     * Afficher la liste des interventions.
     */
    public function index(Request $request)
    {
        $query = Intervention::with('parcelle', 'typeIntervention');

        // Filtrer les interventions de l'utilisateur connecté si ce n'est pas un admin
        if (auth()->user()->role_id != 1) {
            $query->where('user_id', auth()->id());
        }

        // Recherche
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->whereHas('parcelle', fn($q2) => $q2->where('nom', 'LIKE', "%{$search}%"))
                  ->orWhereHas('typeIntervention', fn($q2) => $q2->where('nom', 'LIKE', "%{$search}%"))
                  ->orWhere('date_debut', 'LIKE', "%{$search}%");
            });
        }

        $interventions = $query->get()->groupBy(function ($item) {
            return $item->date_fin && $item->date_fin >= now() ? 'en_cours' : 'terminees';
        });

        return view('agri.interventions.index', compact('interventions'));
    }

    /**
     * Filtrage avancé.
     */
    public function filtered(Request $request)
    {
        $query = Intervention::with('parcelle', 'typeIntervention');

        // Filtrer par utilisateur connecté si non-admin
        if (auth()->user()->role_id != 1) {
            $query->where('user_id', auth()->id());
        }

        // Filtres supplémentaires
        if ($request->filled('parcelle')) {
            $query->where('parcelle_id', $request->parcelle);
        }

        if ($request->filled('type')) {
            $query->where('type_intervention_id', $request->type);
        }

        if ($request->filled('date_debut')) {
            $query->whereDate('date_debut', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->whereDate('date_fin', '<=', $request->date_fin);
        }

        $interventions = $query->get();
        $parcelles = Parcelle::where('user_id', auth()->id())->get();
        $types = TypeIntervention::all();

        return view('agri.interventions.filtered', compact('interventions', 'parcelles', 'types'));
    }

    /**
     * Afficher le formulaire de création.
     */
    public function create()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->withErrors(['error' => 'Veuillez vous connecter pour continuer.']);
        }

        $parcelles = Parcelle::where('user_id', auth()->id())->get();
        $types = TypeIntervention::all();

        return view('agri.interventions.create', compact('parcelles', 'types'));
    }

    /**
     * Enregistrer une nouvelle intervention.
     */
    public function store(Request $request)
    {
        $request->validate([
            'parcelle_id' => 'required|exists:parcelles,id',
            'type_intervention_id' => 'required|exists:type_interventions,id',
            'date_debut' => 'required|date|before_or_equal:today',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'description' => 'nullable|string|max:1000',
            'quantite_eau_utilisee' => 'nullable|numeric|min:0',
            'quantite_engrais' => 'nullable|numeric|min:0',
            'quantite_pesticide' => 'nullable|numeric|min:0',
            'quantite_semences' => 'nullable|numeric|min:0',
            'quantite_recolte' => 'nullable|numeric|min:0',
        ]);

        try {
            Intervention::create([
                'parcelle_id' => $request->parcelle_id,
                'type_intervention_id' => $request->type_intervention_id,
                'date_debut' => $request->date_debut,
                'date_fin' => $request->date_fin,
                'description' => $request->description,
                'quantite_eau_utilisee' => $request->quantite_eau_utilisee,
                'quantite_engrais' => $request->quantite_engrais,
                'quantite_pesticide' => $request->quantite_pesticide,
                'quantite_semences' => $request->quantite_semences,
                'quantite_recolte' => $request->quantite_recolte,
                'user_id' => auth()->id(), // Important
            ]);

            return redirect()->route('interventions.index')->with('success', 'Intervention ajoutée avec succès.');
        } catch (\Exception $e) {
            Log::error("Erreur lors de l'ajout d'une intervention : " . $e->getMessage());
            return back()->withErrors(['error' => 'Une erreur s’est produite lors de l’enregistrement.']);
        }
    }

    /**
     * Afficher le formulaire d'édition.
     */
    public function edit($id)
    {
        $intervention = Intervention::findOrFail($id);

        if (auth()->user()->role_id != 1 && $intervention->user_id != auth()->id()) {
            abort(403, 'Accès non autorisé');
        }

        $parcelles = Parcelle::where('user_id', auth()->id())->get();
        $types = TypeIntervention::all();

        return view('agri.interventions.edit', compact('intervention', 'parcelles', 'types'));
    }

    /**
     * Mettre à jour une intervention.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'parcelle_id' => 'required|exists:parcelles,id',
            'type_intervention_id' => 'required|exists:type_interventions,id',
            'date_debut' => 'required|date|before_or_equal:today',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'description' => 'nullable|string|max:1000',
            'quantite_eau_utilisee' => 'nullable|numeric|min:0',
            'quantite_engrais' => 'nullable|numeric|min:0',
            'quantite_pesticide' => 'nullable|numeric|min:0',
            'quantite_semences' => 'nullable|numeric|min:0',
            'quantite_recolte' => 'nullable|numeric|min:0',
        ]);

        try {
            $intervention = Intervention::findOrFail($id);

            if (auth()->user()->role_id != 1 && $intervention->user_id != auth()->id()) {
                abort(403, 'Accès non autorisé');
            }

            $intervention->update($request->except(['user_id'])); // On ne modifie pas l'auteur

            return redirect()->route('interventions.index')->with('success', 'Intervention mise à jour avec succès.');
        } catch (\Exception $e) {
            Log::error("Erreur lors de la mise à jour de l'intervention : " . $e->getMessage());
            return back()->withErrors(['error' => 'Une erreur s’est produite lors de la mise à jour.']);
        }
    }

    /**
     * Supprimer une intervention.
     */
    public function destroy($id)
    {
        try {
            $intervention = Intervention::findOrFail($id);

            if (auth()->user()->role_id != 1 && $intervention->user_id != auth()->id()) {
                abort(403, 'Accès non autorisé');
            }

            $intervention->delete();
            return redirect()->route('interventions.index')->with('success', 'Intervention supprimée avec succès.');
        } catch (\Exception $e) {
            Log::error("Erreur lors de la suppression de l'intervention : " . $e->getMessage());
            return back()->withErrors(['error' => 'Une erreur s’est produite lors de la suppression.']);
        }
    }

    /**
     * Afficher le rapport d'une parcelle.
     */
    public function rapportParcelle($id)
    {
        $parcelle = Parcelle::with(['interventions.typeIntervention'])
                    ->where('id', $id)
                    ->where('user_id', auth()->id())
                    ->firstOrFail();

        return view('agri.parcelles.rapport', compact('parcelle'));
    }

    /**
     * Générer le PDF du rapport d'une parcelle.
     */

    public function rapportParcellePdf($id)
    {
        $parcelle = Parcelle::with(['interventions.typeIntervention'])
                    ->where('id', $id)
                    ->where('user_id', auth()->id())
                    ->firstOrFail();

        $pdf = PDF::loadView('agri.parcelles.rapport_pdf', compact('parcelle'));
        return $pdf->download("rapport_parcelle_{$parcelle->id}.pdf");
    }

}
