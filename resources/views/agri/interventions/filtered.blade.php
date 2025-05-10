@extends('layouts.sidebar')

@section('content')
    <div class="mb-8">
        <h2 class="text-xl font-semibold text-green-600 mb-2">Filtrer les interventions</h2>
        <form action="{{ route('interventions.filtered') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-4 gap-4">
            @csrf

            <div>
                <label for="parcelle_filter" class="block text-sm text-gray-600">Parcelle</label>
                <select name="parcelle" id="parcelle_filter" class="w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3">
                    <option value="">Toutes</option>
                    @foreach($parcelles as $parcelle)
                        <option value="{{ $parcelle->id }}">{{ $parcelle->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="type_filter" class="block text-sm text-gray-600">Type d'intervention</label>
                <select name="type" id="type_filter" class="w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3">
                    <option value="">Tous</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="date_debut_filter" class="block text-sm text-gray-600">Date de début</label>
                <input type="date" name="date_debut" id="date_debut_filter" class="w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3">
            </div>

            <div>
                <label for="date_fin_filter" class="block text-sm text-gray-600">Date de fin</label>
                <input type="date" name="date_fin" id="date_fin_filter" class="w-full bg-gray-100 border border-gray-300 rounded-md py-2 px-3">
            </div>

            <div class="col-span-full text-right">
                <button type="submit" class="mt-2 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                    <i class="fas fa-filter"></i> Appliquer les filtres
                </button>
            </div>
        </form>
    </div>
@endsection
