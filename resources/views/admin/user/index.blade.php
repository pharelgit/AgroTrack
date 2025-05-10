@extends('layouts.sidebar')

@section('title', 'Utilisateurs')

@section('content')
    @php $currentPage = 'users'; @endphp

    <div>
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Gestion des utilisateurs</h1>
            {{-- <a href="{{ route('users.create') }}"
               class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-all duration-200">
                Ajouter un utilisateur
            </a> --}}
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
                            <th class="py-3 px-4">Prénom</th>
                            <th class="py-3 px-4">Email</th>
                            <th class="py-3 px-4">Rôle</th>
                            <th class="py-3 px-4">Statut</th>
                            <th class="py-3 px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600">
                        @forelse ($users as $user)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-4">{{ $user->nom }}</td>
                                <td class="py-3 px-4">{{ $user->prenom }}</td>
                                <td class="py-3 px-4">{{ $user->email }}</td>
                                <td class="py-3 px-4">{{ ucfirst($user->role->nom ?? 'N/A') }}</td>
                                <td class="py-3 px-4">
                                    @if ($user->statut == 'actif')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Actif
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Inactif
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-4">
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="text-blue-600 hover:text-blue-800 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 4h2a2 2 0 012 2v2h2a2 2 0 012 2v2h-2v2a2 2 0 01-2 2h-2v2a2 2 0 01-2 2h-2v-2H7a2 2 0 01-2-2v-2H3a2 2 0 01-2-2v-2a2 2 0 012-2h2V6a2 2 0 012-2h2V2a2 2 0 012-2z" />
                                            </svg>
                                            Modifier
                                        </a>

                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')"
                                                class="text-red-600 hover:text-red-800 flex items-center">
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
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-4 text-center text-gray-500">Aucun utilisateur trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
 