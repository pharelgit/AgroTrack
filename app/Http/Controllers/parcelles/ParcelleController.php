<?php

namespace App\Http\Controllers\parcelles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parcelle;
use App\Models\Statuts;
use App\Models\Localisation;

class ParcelleController extends Controller
{
   
    public function index()
    {
        if (auth()->user()->role_id == 1) {
            $parcelles = Parcelle::all();
        } else {
            $parcelles = Parcelle::where('user_id', auth()->user()->id)->get();
        }
        return view('agri.parcelles.index' , compact('parcelles'));
    }

    
    public function create()
    {
        $statuts = Statuts::all();
        return view('agri.parcelles.create', compact('statuts'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'size' => 'required|numeric|min:1',
            'culture' => 'required|string|max:255',
            'plantation_date' => 'required|date|before_or_equal:today',
            'status' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ], [
            'latitude.required' => 'La latitude est requise.',
            'longitude.required' => 'La longitude est requise.',
            'latitude.numeric' => 'La latitude doit être un nombre.',
            'longitude.numeric' => 'La longitude doit être un nombre.',
            // Les autres messages d’erreur sont déjà bons.
        ]);

        // Créer la parcelle
        $parcelle = new Parcelle();
        $parcelle->nom = $request->input('nom');
        $parcelle->superficie = $request->input('size');
        $parcelle->type_de_culture = $request->input('culture');
        $parcelle->date_de_plantation = $request->input('plantation_date');
        $parcelle->statut_id = $request->input('status');
        $parcelle->user_id = auth()->user()->id;
        $parcelle->save();

        // Créer la localisation associée
        $localisation = new Localisation();
        $localisation->latitude = $request->input('latitude');
        $localisation->longitude = $request->input('longitude');
        $localisation->parcelle_id = $parcelle->id;
        $localisation->save();

        return redirect()->route('parcelles.index')->with('success', 'Parcelle créée avec succès.');
    }


    
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $parcelle = Parcelle::findOrFail($id);
        $statuts = Statuts::all();
        return view('agri.parcelles.edit', compact('parcelle', 'statuts'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'size' => 'required|numeric|min:1',
            'culture' => 'required|string|max:255',
            'plantation_date' => 'required|date|before_or_equal:today',
            'status' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ],[
            'nom.required' => 'Le nom de la parcelle est requis.',
            'size.required' => 'La taille de la parcelle est requise.',
            'culture.required' => 'Le type de culture est requis.',
            'plantation_date.required' => 'La date de plantation est requise.',
            'status.required' => 'Le statut de la parcelle est requis.',
            'status.in' => 'Le statut doit être soit actif soit inactif.',
            'size.numeric' => 'La taille doit être un nombre.',
            'size.min' => 'La taille doit être supérieure ou égale à 1.',
            'plantation_date.date' => 'La date de plantation doit être une date valide.',
            'plantation_date.before_or_equal' => 'La date de plantation doit être aujourd\'hui ou une date antérieure.',
            'nom.string' => 'Le nom de la parcelle doit être une chaîne de caractères.',
            'nom.max' => 'Le nom de la parcelle ne doit pas dépasser 255 caractères.',
            'culture.string' => 'Le type de culture doit être une chaîne de caractères.',
            'culture.max' => 'Le type de culture ne doit pas dépasser 255 caractères.',
            'latitude.required' => 'La latitude est requise.',
            'longitude.required' => 'La longitude est requise.',
            'latitude.numeric' => 'La latitude doit être un nombre.',
            'longitude.numeric' => 'La longitude doit être un nombre.',
        ]);
        
        $parcelle = Parcelle::findOrFail($id);
        $parcelle->nom = $request->input('nom');
        $parcelle->superficie = $request->input('size');
        $parcelle->type_de_culture = $request->input('culture');
        $parcelle->date_de_plantation = $request->input('plantation_date');
        $parcelle->statut_id = $request->input('status');
        $parcelle->user_id = auth()->user()->id; 
        $parcelle->save();
        // Mettre à jour la localisation associée
        $localisation = $parcelle->localisation ?? new Localisation();
        $localisation->latitude = $request->input('latitude');
        $localisation->longitude = $request->input('longitude');
        $localisation->parcelle_id = $parcelle->id;
        $localisation->save();

        return redirect()->route('parcelles.index')->with('success', 'Parcelle created successfully.');
    }

    public function destroy(string $id)
    {
        $parcelle = Parcelle::findOrFail($id);
        $parcelle->delete();
        return redirect()->route('parcelles.index')->with('success', 'Parcelle supprimé avec succès.');
    }
}
