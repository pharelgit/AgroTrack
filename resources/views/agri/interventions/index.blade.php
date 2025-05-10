@extends('layouts.sidebar')

@section('title', 'Interventions')

@section('content')
<div class="p-6 space-y-8">
    <!-- En-tête -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-[#159957] mb-2">Gestion des Interventions</h1>
            <p class="text-gray-600">Suivez et gérez toutes vos interventions agricoles</p>
        </div>
        
        <!-- Statistiques rapides -->
        <div class="flex space-x-4">
            <div class="bg-green-50 rounded-lg p-4 text-center">
                <span class="block text-2xl font-bold text-[#159957]">{{ count($interventions['en_cours'] ?? []) }}</span>
                <span class="text-sm text-gray-600">En cours</span>
            </div>
            <div class="bg-green-50 rounded-lg p-4 text-center">
                <span class="block text-2xl font-bold text-[#159957]">{{ count($interventions['terminees'] ?? []) }}</span>
                <span class="text-sm text-gray-600">Terminées</span>
            </div>
        </div>
    </div>

    <!-- Messages de notification -->
    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-[#159957] p-4 rounded-lg">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-[#159957]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-[#159957]">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Barre d'actions -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex justify-between items-center">
            <form action="{{ route('interventions.index') }}" method="GET" class="flex-1 mr-4">
                <div class="relative">
                    <input type="text" 
                           name="search" 
                           placeholder="Rechercher une intervention..." 
                           class="w-full pl-10 pr-4 py-2 border-2 border-b-[#1a7f7a] rounded-lg focus:outline-none focus:border-[#159957] transition-colors"
                           value="{{ request('search') }}">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
            </form>

            <div class="flex space-x-4">
                <a href="{{ route('interventions.filtered') }}" 
                   class="flex items-center px-4 py-2 bg-[#159957] text-white rounded-lg hover:bg-[#1a7f7a] transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filtrer
                </a>
                 @if(auth()->check() && auth()->user()->role_id === 2)
                <a href="{{ route('interventions.create') }}" 
                   class="flex items-center px-4 py-2 bg-[#159957] text-white rounded-lg hover:bg-[#1a7f7a] transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Nouvelle intervention
                </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Interventions en cours -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">Interventions en cours</h2>
            <p class="text-gray-600 mt-1">Liste des interventions actuellement en cours</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Parcelle</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Début</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ressources utilisées</th>
                        @if(auth()->check() && auth()->user()->role_id === 2)
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($interventions['en_cours'] ?? [] as $intervention)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $intervention->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-medium text-gray-900">{{ $intervention->parcelle->nom }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {{ $intervention->typeIntervention->nom }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($intervention->date_debut)->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex space-x-4 text-sm text-gray-500">
                                <span title="Eau">💧 {{ $intervention->quantite_eau_utilisee }}L</span>
                                <span title="Engrais">🌱 {{ $intervention->quantite_engrais }}Kg</span>
                                <span title="Pesticides">🧪 {{ $intervention->quantite_pesticide }}L</span>
                                <span title="Semences">🌾 {{ $intervention->quantite_semences }}Kg</span>
                            </div>
                        </td>
                        @if(auth()->check() && auth()->user()->role_id === 2)
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-3">
                                <a href="{{ route('interventions.edit', $intervention->id) }}" 
                                   class="text-[#159957] hover:text-[#1a7f7a]">Modifier</a>
                                <form action="{{ route('interventions.destroy', $intervention->id) }}" 
                                      method="POST" 
                                      class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette intervention ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Interventions terminées -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">Interventions terminées</h2>
            <p class="text-gray-600 mt-1">Historique des interventions complétées</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Parcelle</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Période</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ressources utilisées</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Récolte</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($interventions['terminees'] ?? [] as $intervention)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $intervention->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-medium text-gray-900">{{ $intervention->parcelle->nom }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                {{ $intervention->typeIntervention->nom }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($intervention->date_debut)->format('d/m/Y') }} - 
                            {{ \Carbon\Carbon::parse($intervention->date_fin)->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex space-x-4 text-sm text-gray-500">
                                <span title="Eau">💧 {{ $intervention->quantite_eau_utilisee }}L</span>
                                <span title="Engrais">🌱 {{ $intervention->quantite_engrais }}Kg</span>
                                <span title="Pesticides">🧪 {{ $intervention->quantite_pesticide }}L</span>
                                <span title="Semences">🌾 {{ $intervention->quantite_semences }}Kg</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <span class="font-medium">{{ $intervention->quantite_recolte }} Kg</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection