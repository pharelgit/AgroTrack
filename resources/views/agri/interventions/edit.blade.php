@extends('layouts.sidebar')

@section('content')
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-3xl font-bold text-green-700 mb-6">Modifier l'intervention</h1>

        <form action="{{ route('interventions.update', $intervention->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Sélection de la parcelle -->
            <div class="form-group">
                <label for="parcelle_id" class="text-gray-700 font-medium">Parcelle</label>
                <select name="parcelle_id" id="parcelle_id" class="w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3">
                    @foreach ($parcelles as $parcelle)
                        <option value="{{ $parcelle->id }}" {{ $parcelle->id == $intervention->parcelle_id ? 'selected' : '' }}>
                            {{ $parcelle->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Sélection du type d'intervention -->
            <div class="form-group">
                <label for="type_intervention_id" class="text-gray-700 font-medium">Type d'intervention</label>
                <select name="type_intervention_id" id="type_intervention_id"
                        class="w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3"
                        onchange="updateFields()">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" data-nom="{{ $type->nom }}"
                            {{ $type->id == $intervention->type_intervention_id ? 'selected' : '' }}>
                            {{ $type->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Dates de l'intervention -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                <div class="form-group">
                    <label for="date_debut" class="text-gray-700 font-medium">Date de début</label>
                    <input type="date" name="date_debut" id="date_debut" class="w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3"
                           value="{{ $intervention->date_debut }}" required>
                </div>
                <div class="form-group">
                    <label for="date_fin" class="text-gray-700 font-medium">Date de fin</label>
                    <input type="date" name="date_fin" id="date_fin" class="w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3"
                           value="{{ $intervention->date_fin }}" required>
                </div>
            </div>

            <!-- Description -->
            <div class="form-group mt-4">
                <label for="description" class="text-gray-700 font-medium">Description</label>
                <textarea name="description" id="description" class="w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3 h-24">{{ trim($intervention->description) }}</textarea>
            </div>

            <!-- Quantités utilisées (affichage dynamique) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                <div class="form-group">
                    <label for="quantite_eau_utilisee" class="text-gray-700 font-medium">Quantité d'eau utilisée (L)</label>
                    <input type="number" name="quantite_eau_utilisee" id="quantite_eau"
                           class="w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3"
                           value="{{ $intervention->quantite_eau_utilisee }}">
                </div>

                <!-- Autres champs masqués par défaut -->
                <div class="form-group hidden" id="quantite_engrais">
                    <label for="quantite_engrais_input" class="text-gray-700 font-medium">Quantité d'engrais (Kg)</label>
                    <input type="number" name="quantite_engrais" id="quantite_engrais_input" class="w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3"
                           value="{{ $intervention->quantite_engrais }}">
                </div>

                <div class="form-group hidden" id="quantite_pesticide">
                    <label for="quantite_pesticide_input" class="text-gray-700 font-medium">Quantité de pesticides (L)</label>
                    <input type="number" name="quantite_pesticide" id="quantite_pesticide_input" class="w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3"
                           value="{{ $intervention->quantite_pesticide }}">
                </div>
            </div>

            <!-- Bouton Mettre à jour -->
            <div class="flex justify-end mt-6">
                <button type="submit" class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition duration-200">
                    <i class="fas fa-save"></i> Mettre à jour
                </button>
            </div>
        </form>
    </div>

    <script>
        function updateFields() {
            const select = document.getElementById("type_intervention_id");
            const selectedOption = select.options[select.selectedIndex];
            const selectedName = selectedOption.getAttribute("data-nom");

            document.getElementById("quantite_engrais").classList.add("hidden");
            document.getElementById("quantite_pesticide").classList.add("hidden");

            if (selectedName === "Fertilisation") {
                document.getElementById("quantite_engrais").classList.remove("hidden");
            } else if (selectedName === "Traitement") {
                document.getElementById("quantite_pesticide").classList.remove("hidden");
            }
        }

        document.addEventListener("DOMContentLoaded", updateFields);
    </script>
@endsection
