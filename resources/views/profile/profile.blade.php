@extends('layouts.sidebar')

@section('content')
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8 space-y-8">
        <h1 class="text-3xl font-bold text-green-700 border-b pb-4">Mon Profil</h1>

        {{-- Messages flash --}}
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        {{-- Informations personnelles --}}
        <div class="bg-gray-50 rounded-lg p-6 shadow-sm">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Informations personnelles</h2>

            <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div>
                        <label for="nom" class="block text-gray-700 font-medium mb-1">Nom</label>
                        <input type="text" name="nom" id="nom" value="{{ auth()->user()->nom }}"
                               class="w-full bg-white border border-gray-300 rounded-lg py-2 px-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        @error('nom')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="prenom" class="block text-gray-700 font-medium mb-1">Prénom</label>
                        <input type="text" name="prenom" id="prenom" value="{{ auth()->user()->prenom }}"
                               class="w-full bg-white border border-gray-300 rounded-lg py-2 px-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        @error('prenom')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                        <input type="email" name="email" id="email" value="{{ auth()->user()->email }}"
                               class="w-full bg-white border border-gray-300 rounded-lg py-2 px-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-200">
                        <i class="fas fa-save mr-2"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>

        {{-- Modifier le mot de passe (directement affiché) --}}
        <div class="bg-gray-50 rounded-lg p-6 shadow-sm">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Modifier mon mot de passe</h2>

            <form action="{{ route('profile.password.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="current_password" class="block text-gray-700 font-medium mb-1">Mot de passe actuel</label>
                    <input type="password" name="current_password" id="current_password"
                           class="w-full bg-white border border-gray-300 rounded-lg py-2 px-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('current_password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-gray-700 font-medium mb-1">Nouveau mot de passe</label>
                    <input type="password" name="password" id="password"
                           class="w-full bg-white border border-gray-300 rounded-lg py-2 px-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-gray-700 font-medium mb-1">Confirmation</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="w-full bg-white border border-gray-300 rounded-lg py-2 px-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-200">
                        <i class="fas fa-lock mr-2"></i> Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
