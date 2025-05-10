@extends('layouts.sidebar')

@section('title', 'Rapport de Parcelle')

@section('content')
<div class="p-6">
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <!-- En-tête du rapport -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-[#159957] mb-2">
                        Rapport détaillé - {{ $parcelle->nom }}
                    </h1>
                    <div class="flex items-center space-x-4 text-gray-600">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-[#159957] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                            </svg>
                            <span>Surface totale: <strong>{{ $parcelle->superficie }} ha</strong></span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-[#159957] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                            <span>Interventions: <strong>{{ $parcelle->interventions->count() }}</strong></span>
                        </div>
                    </div>
                </div>
                
                <a href="{{ route('parcelles.rapport.pdf', $parcelle->id) }}" class="btn btn-primary my-3 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M7 16a4 4 0 01-.88-7.906A5 5 0 0115.9 6.1a5.5 5.5 0 011.1 10.9H16m-4-4v6m0 0l-2-2m2 2l2-2"/>
                    </svg>
                    Exporter en PDF
                </a>
            </div>
        </div>

        <!-- Tableau des interventions -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Début</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Fin</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($parcelle->interventions as $intervention)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($intervention->date_debut)->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $intervention->date_fin ? \Carbon\Carbon::parse($intervention->date_fin)->format('d/m/Y') : 'En cours' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $intervention->typeIntervention->nom }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $intervention->description ?: 'Aucune description' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($intervention->date_fin < now())
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Terminée
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        En cours
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500 italic">
                                Aucune intervention enregistrée pour cette parcelle.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pied de page avec informations supplémentaires -->
        <div class="p-6 bg-gray-50 border-t border-gray-200">
            <div class="flex items-center justify-between text-sm text-gray-600">
                <div>
                    Rapport généré le : {{ now()->format('d/m/Y H:i') }}
                </div>
                <div>
                    Total des interventions : {{ $parcelle->interventions->count() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection