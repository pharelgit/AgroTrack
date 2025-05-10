@extends('layouts.sidebar')

@section('title', 'Utilisateurs')

@section('content')
    @php $currentPage = 'users'; @endphp

    <div>
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Gestion des parcelles</h1>
             @if(auth()->check() && auth()->user()->role_id === 2)
            <a href="{{ route('parcelles.create') }}"
                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-all duration-200">
                Ajouter une parcelle
            </a>
            @endif
        </div>

        {{-- Message de succès --}}
        @if (session('success'))
            <div id="success-message"
                class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 shadow-sm"
                role="alert">
                <svg class="w-5 h-5 me-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414L9 13.414l4.707-4.707z"
                        clip-rule="evenodd" />
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>

            <script>
                setTimeout(function () {
                    const alert = document.getElementById('success-message');
                    if (alert) {
                        alert.style.transition = 'opacity 0.5s ease';
                        alert.style.opacity = '0';
                        setTimeout(() => alert.remove(), 500);
                    }
                }, 3000);
            </script>
        @endif

        <div class="bg-white rounded-lg shadow p-6">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b text-gray-700">
                            <th class="py-3 px-4">Nom</th>
                            <th class="py-3 px-4">Superficie (en lots)</th>
                            <th class="py-3 px-4">Type de culture</th>
                            <th class="py-3 px-4">Date de plantation</th>
                            <th class="py-3 px-4">Statut</th>
                            @if(auth()->check() && auth()->user()->role_id === 2)
                            <th class="py-3 px-4">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="text-gray-600">
                        @foreach ($parcelles as $parcelle)
                            <tr onclick="window.location='{{ route('parcelles.rapport', $parcelle->id) }}';" class="cursor-pointer hover:bg-gray-100">
                                <td class="py-3 px-4">{{ $parcelle->nom }}</td>
                                <td class="py-3 px-4">{{ $parcelle->superficie }}</td>
                                <td class="py-3 px-4">{{ $parcelle->type_de_culture }}</td>
                                <td class="py-3 px-4">{{ $parcelle->date_de_plantation }}</td>
                                <td class="py-3 px-4">{{ optional($parcelle->statut)->nom ?? 'non défini' }}</td>
                                @if(auth()->check() && auth()->user()->role_id === 2)
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-4">
                                        <a href="{{ route('parcelles.edit', $parcelle->id) }}"
                                            class="text-blue-600 hover:text-blue-800 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536M9 11l3-3m0 0l6 6M3 21h18" />
                                            </svg>
                                            Modifier
                                        </a>

                                        <form action="{{ route('parcelles.destroy', $parcelle->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 flex items-center"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette parcelle ?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3" />
                                                </svg>
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
    </div>
@endsection
