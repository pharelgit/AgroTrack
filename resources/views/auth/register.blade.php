<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - AgroTrack</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-agriculture {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1625246333195-78d9c38ad449?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80');
            background-size: cover;
            background-position: center;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
    </style>
</head>

<body class="bg-agriculture min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo et Titre -->
        <div class="text-center mb-8">
            <div class="flex items-center justify-center mb-4">
                <svg class="h-12 w-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Créer un compte AgroTrack</h1>
            <p class="text-gray-200">Rejoignez-nous pour mieux gérer votre activité agricole</p>
        </div>

        <!-- Formulaire d'inscription -->
        <div class="glass-effect rounded-2xl shadow-xl p-8">
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
            
                <!-- Nom -->
                <div>
                    <label for="nom" class="block text-gray-700 font-medium mb-2">Nom</label>
                    <input id="nom" name="nom" type="text" value="{{ old('nom') }}" required
                           class="w-full p-3 border-2 border-b-[#1a7f7a] rounded-lg focus:outline-none focus:border-[#159957] transition-colors"
                           placeholder="Votre nom">
                    @error('nom')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Prénom -->
                <div>
                    <label for="prenom" class="block text-gray-700 font-medium mb-2">Prénom</label>
                    <input id="prenom" name="prenom" type="text" value="{{ old('prenom') }}" required autofocus
                           class="w-full p-3 border-2 border-b-[#1a7f7a] rounded-lg focus:outline-none focus:border-[#159957] transition-colors"
                           placeholder="Votre prénom">
                    @error('prenom')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            
                <!-- Email -->
                <div>
                    <label for="email" class="block text-gray-700 font-medium mb-2">Adresse email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required
                        class="w-full p-3 border-2 border-b-[#1a7f7a] rounded-lg focus:outline-none focus:border-[#159957] transition-colors"
                        placeholder="votreemail@exemple.com">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            
                <!-- Mot de passe -->
                <div>
                    <label for="password" class="block text-gray-700 font-medium mb-2">Mot de passe</label>
                    <input id="password" name="password" type="password" required
                        class="w-full p-3 border-2 border-b-[#1a7f7a] rounded-lg focus:outline-none focus:border-[#159957] transition-colors"
                        placeholder="••••••••">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            
                <!-- Confirmation mot de passe -->
                <div>
                    <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Confirmer le mot de
                        passe</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        class="w-full p-3 border-2 border-b-[#1a7f7a] rounded-lg focus:outline-none focus:border-[#159957] transition-colors"
                        placeholder="••••••••">
                </div>
            
                <!-- Bouton -->
                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-[#159957] hover:bg-[#1a7f7a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#159957] transition-colors">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 21v-2a4 4 0 00-8 0v2M12 11a4 4 0 100-8 4 4 0 000 8zm0 0v1m0 0v1m0 4h.01" />
                        </svg>
                        Créer un compte
                    </button>
                </div>
            
                <!-- Lien vers connexion -->
                <div class="text-center mt-6">
                    <p class="text-sm text-gray-600">
                        Vous avez déjà un compte ?
                        <a href="{{ route('login') }}" class="font-medium text-[#159957] hover:text-[#1a7f7a]">
                            Se connecter
                        </a>
                    </p>
                      
                </div>
            </form>
            
        </div>
    </div>
</body>

</html>