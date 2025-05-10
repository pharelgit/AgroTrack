<!-- resources/views/layouts/sidebar.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - AgroTrack')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        [x-cloak] { display: none !important; }
        .bg-gradient-custom {
            background: linear-gradient(135deg, #1a5f7a 0%, #159957 100%);
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50">
    @php $currentPage = $currentPage ?? ''; @endphp

    <div x-data="{ sidebarOpen: true }" class="min-h-screen flex">

        <!-- Sidebar -->
        <div x-cloak
             :class="{'w-64': sidebarOpen, 'w-20': !sidebarOpen}"
             class="bg-gradient-custom fixed h-full transition-all duration-300 z-50">
            <div class="flex items-center justify-between h-16 px-4">
                <div class="flex items-center" :class="{'justify-center': !sidebarOpen}">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    <span x-show="sidebarOpen" class="text-white font-bold text-xl ml-2">AgroTrack</span>
                </div>
                <button @click="sidebarOpen = !sidebarOpen" class="text-white focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <nav class="mt-8 px-2">
                @php
                    $menuItems = [];
                    $menuItems[] = [
                                'id' => 'dashboard',
                                'text' => 'Tableau de bord',
                                'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
                                'route' => 'admin.dashboard'
                            ];

                    if (auth()->check()) {
                        // Si l'utilisateur est connecté et est admin
                        if (auth()->user()->role_id === 1) {

                            $menuItems[] = [
                                'id' => 'users',
                                'text' => 'Utilisateurs',
                                'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                                'route' => 'users.index'
                            ];
                        }
                    }

                    $menuItems[] = [
                        'id' => 'parcelles',
                        'text' => 'Parcelles',
                        'icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                        'route' => 'parcelles.index'
                    ];

                    $menuItems[] = [
                        'id' => 'interventions',
                        'text' => 'Interventions',
                        'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
                        'route' => 'interventions.index'
                    ];

                    $menuItems[] = [
                        'id' => 'profile',
                        'text' => 'Mon Profil',
                        'icon' => 'M12 4a4 4 0 00-4 4v1a4 4 0 008 0V8a4 4 0 00-4-4zm0 14a8 8 0 100-16 8 8 0 000 16z',
                        'route' => 'profile.show'
                    ];


                @endphp

                <div class="space-y-2">
                    @foreach ($menuItems as $item)
                        <a href="{{ route($item['route']) }}"
                           class="flex items-center w-full p-2 rounded-lg transition-colors duration-200
                                  {{ Route::is($item['route']) ? 'bg-white/10 text-white' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}" />
                            </svg>
                            <span x-show="sidebarOpen" class="ml-3">{{ $item['text'] }}</span>
                        </a>
                    @endforeach
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <!-- Main Content -->
        <div :class="{'ml-64': sidebarOpen, 'ml-20': !sidebarOpen}"
             class="flex-1 transition-all duration-300">
            <!-- Top Bar -->
            <div class="bg-white h-16 fixed right-0 left-0 shadow-sm z-40"
                 :class="{'ml-64': sidebarOpen, 'ml-20': !sidebarOpen}">
                <div class="flex items-center justify-between h-full px-6">
                    <div class="flex items-center space-x-4">
                        <h1 class="text-xl font-semibold text-gray-800">Tableau de bord</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                    class="flex items-center space-x-2">
                                <img src="https://ui-avatars.com/api/?name=John+Doe"
                                     alt="Profile"
                                     class="h-8 w-8 rounded-full">
                                <span class="text-gray-700">{{ Auth::user()->nom }}</span>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2">
                                <ul class="list-none">
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" x-data>
                                            @csrf
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">
                                                Déconnexion
                                            </button>
                                        </form>
                                    </li>
                                    <li>
                                        <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                            Mon Profil
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Content -->
            <div class="pt-24 px-6 pb-8">
                @yield('content')
            </div>
        </div>
    </div>

    @stack('scripts')
    @yield('scripts')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
