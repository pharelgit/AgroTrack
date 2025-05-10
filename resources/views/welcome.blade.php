<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroTrack - Gestion Agricole Intelligente</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    
    <style>
        [x-cloak] { display: none !important; }
        
        .gradient-text {
            background: linear-gradient(90deg, #059669, #34d399);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hover-scale {
            transition: transform 0.2s;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div x-data="{ mobileMenuOpen: false }" class="min-h-screen bg-gradient-to-b from-green-50 to-white">
        <!-- Navigation -->
        <nav class="bg-white/80 backdrop-blur-md fixed w-full z-50 shadow-sm">
            <div class="container mx-auto px-4 py-4">
                <div class="flex items-center justify-between">
                    <div data-aos="fade-right" class="flex items-center space-x-2">
                        <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        <span class="text-2xl font-bold gradient-text">AgroTrack</span>
                    </div>

                    <!-- Desktop Navigation -->
                    <div class="hidden md:flex space-x-4">
                        <button onclick="scrollToSection('features')" 
                                class="px-6 py-2 text-gray-600 font-medium hover:text-green-600 transition-colors">
                            Fonctionnalités
                        </button>
                        {{-- <button onclick="scrollToSection('about')" 
                                class="px-6 py-2 text-gray-600 font-medium hover:text-green-600 transition-colors">
                            À propos
                        </button>
                        <button onclick="scrollToSection('contact')" 
                                class="px-6 py-2 text-gray-600 font-medium hover:text-green-600 transition-colors">
                            Contact
                        </button> --}}
                        <a href="/login" 
                           class="px-6 py-2 text-green-600 font-medium hover:text-green-700 transition-colors">
                            Se connecter
                        </a>
                        <a href="/register" 
                           class="px-6 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors">
                            S'inscrire
                        </a>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="md:hidden">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" 
                                class="text-gray-500 hover:text-gray-600 focus:outline-none">
                            <svg class="h-6 w-6" x-show="!mobileMenuOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                            <svg class="h-6 w-6" x-show="mobileMenuOpen" x-cloak fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile menu -->
                <div x-show="mobileMenuOpen" x-cloak 
                     class="md:hidden mt-4 pb-4 space-y-4">
                    <a href="#features" class="block text-gray-600 hover:text-green-600">Fonctionnalités</a>
                    <a href="#about" class="block text-gray-600 hover:text-green-600">À propos</a>
                    <a href="#contact" class="block text-gray-600 hover:text-green-600">Contact</a>
                    <a href="/login" class="block text-green-600 font-medium">Se connecter</a>
                    <a href="/register" class="block text-green-600 font-medium">S'inscrire</a>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="pt-32 pb-20 px-4">
            <div class="container mx-auto">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div data-aos="fade-up" data-aos-delay="200">
                        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6 leading-tight">
                            <span class="gradient-text">Révolutionnez</span> la gestion de vos parcelles agricoles
                        </h1>
                        <p class="text-xl text-gray-600 mb-8">
                            Optimisez votre rendement et simplifiez vos opérations grâce à notre solution intelligente de gestion agricole.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <a href="/register" 
                               class="px-8 py-3 bg-green-600 text-white rounded-lg font-medium text-lg hover:bg-green-700 transition-colors hover-scale inline-flex items-center">
                                Démarrer gratuitement
                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                            
                        </div>
                    </div>
                    <div data-aos="fade-left" data-aos-delay="400" class="relative">
                        <div class="absolute inset-0 bg-green-200 rounded-2xl transform rotate-3"></div>
                        <img src="https://images.unsplash.com/photo-1625246333195-78d9c38ad449?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                             alt="Agriculture intelligente" 
                             class="relative rounded-2xl shadow-xl transform hover:scale-105 transition-transform duration-300">
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div data-aos="fade-up" class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">
                        Solutions complètes pour votre exploitation
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Des outils intelligents conçus pour optimiser chaque aspect de votre activité agricole
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    @php
                    $features = [
                        [
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>',
                            'title' => 'Sécurité avancée',
                            'description' => 'Protection complète de vos données avec cryptage de bout en bout'
                        ],
                        [
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>',
                            'title' => 'Analyses détaillées',
                            'description' => 'Visualisez vos performances et prenez des décisions éclairées'
                        ],
                        [
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                            'title' => 'Automatisation',
                            'description' => 'Gagnez du temps avec nos processus automatisés intelligents'
                        ]
                    ];
                    @endphp

                    @foreach($features as $index => $feature)
                        <div data-aos="fade-up" 
                             data-aos-delay="{{ $index * 200 }}" 
                             class="bg-white p-6 rounded-xl shadow-lg card-hover">
                            <div class="bg-green-50 w-16 h-16 rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    {!! $feature['icon'] !!}
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">
                                {{ $feature['title'] }}
                            </h3>
                            <p class="text-gray-600">
                                {{ $feature['description'] }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 bg-green-50">
            <div class="container mx-auto px-4">
                <div data-aos="fade-up" class="max-w-3xl mx-auto text-center">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">
                        Prêt à transformer votre exploitation ?
                    </h2>
                    <p class="text-xl text-gray-600 mb-8">
                        Rejoignez plus de 10 000 agriculteurs qui font confiance à AgroTrack pour gérer leur exploitation.
                    </p>
                    <a href="/register" 
                       class="inline-flex items-center px-8 py-3 bg-green-600 text-white rounded-lg font-medium text-lg hover:bg-green-700 transition-colors hover-scale">
                        Commencer maintenant
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12">
            <div class="container mx-auto px-4">
                <div class="grid md:grid-cols-4 gap-8">
                    <div>
                        <div class="flex items-center space-x-2 mb-4">
                            <svg class="h-8 w-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                            <span class="text-2xl font-bold">AgroTrack</span>
                        </div>
                        <p class="text-gray-400">
                            Solutions innovantes pour l'agriculture moderne
                        </p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Produit</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white">Fonctionnalités</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Tarifs</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">FAQ</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Entreprise</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white">À propos</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Blog</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Carrières</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Support</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Documentation</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Status</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                    <p>&copy; {{ date('Y') }} AgroTrack. Tous droits réservés.</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        // Initialisation des animations AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });

        // Fonction de défilement fluide
        function scrollToSection(sectionId) {
            const element = document.getElementById(sectionId);
            if (element) {
                element.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }
    </script>
</body>
</html>