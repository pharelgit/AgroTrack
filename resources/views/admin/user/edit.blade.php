@extends('layouts.sidebar')

@section('title', 'Modifier utilisateur')

@section('content')
    <div>
        <h1 class="text-2xl font-bold mb-4 text-[#159957]">Modifier l'utilisateur</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong>Il y a des erreurs !</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Nom -->
            <div class="mb-4">
                <label for="nom" class="block font-medium text-gray-700">Nom</label>
                <input type="text" name="nom" id="nom" value="{{ old('nom', $user->nom) }}" required
                    class="mt-1 p-1 block w-full border-2 border-b-[#1a7f7a] rounded-md focus:border-blue-500 focus:outline-none">
                @error('nom')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Prénom -->
            <div class="mb-4">
                <label for="prenom" class="block font-medium text-gray-700">Prénom</label>
                <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $user->prenom) }}" required
                    class="mt-1 p-1 block w-full border-2 border-b-[#1a7f7a] rounded-md focus:border-blue-500 focus:outline-none">
                @error('prenom')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                    class="mt-1 p-1 block w-full border-2 border-b-[#1a7f7a] rounded-md focus:border-blue-500 focus:outline-none">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Rôle -->
            <div class="mb-4">
                <label for="role_id" class="block font-medium text-gray-700">Rôle</label>
                <select name="role_id" id="role_id" required
                    class="mt-1 p-1 block w-full border-2 border-b-[#1a7f7a] rounded-md focus:border-blue-500 focus:outline-none">
                    <option value="">-- Sélectionner un rôle --</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                            {{ ucfirst($role->nom) }}
                        </option>
                    @endforeach
                </select>
                @error('role_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Statut -->
            <div class="mb-4">
                <label for="statut" class="block text-gray-700 font-bold mb-2">Statut</label>
                <select name="statut" id="statut"
                    class="border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:shadow-outline">
                    <option value="actif" {{ $user->statut == 'actif' ? 'selected' : '' }}>Actif</option>
                    <option value="inactif" {{ $user->statut == 'inactif' ? 'selected' : '' }}>Inactif</option>
                </select>
                @error('statut')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-[#159957] text-white font-semibold rounded-md shadow-sm hover:bg-[#1a7f7a] focus:outline-none">
                Mettre à jour
            </button>
        </form>
    </div>
@endsection
