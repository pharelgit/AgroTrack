@extends('layouts.sidebar')

@section('title', 'Créer un utilisateur')

@section('content')
    <div>
        <h1 class="text-2xl font-bold mb-4 text-[#159957]">Créer un nouvel utilisateur</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong>Il y a des erreurs!</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
            @csrf


            <!-- Nom -->
            <div class="mb-4">
                <label for="nom" class="block font-medium text-gray-700">Nom</label>
                <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required
                    class="mt-1 p-1 block w-full border-2 border-b-[#1a7f7a] rounded-md focus:border-blue-500 focus:ring-opacity-50 focus:outline-none">
                @error('nom')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Prénom -->
            <div class="mb-4">
                <label for="prenom" class="block font-medium text-gray-700">Prénom</label>
                <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" required
                    class="mt-1 p-1 block w-full border-2 border-b-[#1a7f7a] rounded-md focus:border-blue-500 focus:ring-opacity-50 focus:outline-none">
                @error('prenom')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="mt-1 p-1 block w-full border-2 border-b-[#1a7f7a] rounded-md focus:border-blue-500 focus:ring-opacity-50 focus:outline-none">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mot de passe -->
            <div class="mb-4">
                <label for="password" class="block font-medium text-gray-700">Mot de passe</label>
                <input type="password" name="password" id="password" required
                    class="mt-1 p-1 block w-full border-2 border-b-[#1a7f7a] rounded-md focus:border-blue-500 focus:ring-opacity-50 focus:outline-none">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirmation du mot de passe -->
            <div class="mb-4">
                <label for="password_confirmation" class="block font-medium text-gray-700">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="mt-1 p-1 block w-full border-2 border-b-[#1a7f7a] rounded-md focus:border-blue-500 focus:ring-opacity-50 focus:outline-none">
                @error('password_confirmation')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-[#159957] text-white font-semibold rounded-md shadow-sm hover:bg-[#1a7f7a] focus:outline-none">
                Créer l'utilisateur
            </button>
        </form>
    </div>
@endsection
