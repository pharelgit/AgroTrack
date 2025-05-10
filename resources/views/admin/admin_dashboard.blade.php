@extends('layouts.sidebar')

@section('title', 'Dashboard')

@section('content')
<div class="p-6">
    <!-- En-tête du Dashboard -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Tableau de bord</h1>
            <p class="text-gray-600 mt-1">Vue d'ensemble de votre exploitation agricole</p>
        </div>
        <div class="flex items-center space-x-4">
            <div class="bg-green-50 rounded-lg p-2">
                <span class="text-sm text-green-700">Dernière mise à jour:</span>
                <span class="text-sm font-semibold text-green-700">{{ now()->format('d M Y, H:i') }}</span>
            </div>
        </div>
    </div>

    <!-- Cartes de statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @if(auth()->check() && auth()->user()->role_id === 1)
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 shadow-lg transform hover:scale-105 transition-transform duration-200">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-blue-100">Administrateurs</p>
                    <h3 class="text-3xl font-bold text-white mt-2">{{ $nb_admin }}</h3>
                </div>
                <div class="bg-blue-400 rounded-lg p-2">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>

        </div>

        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl p-6 shadow-lg transform hover:scale-105 transition-transform duration-200">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-orange-100">Agriculteurs</p>
                    <h3 class="text-3xl font-bold text-white mt-2">{{ $nb_agriculteurs }}</h3>
                </div>
                <div class="bg-orange-400 rounded-lg p-2">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-orange-100">
                
            </div>
        </div>
        @endif

        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 shadow-lg transform hover:scale-105 transition-transform duration-200">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-green-100">Parcelles</p>
                    <h3 class="text-3xl font-bold text-white mt-2">{{ $nb_parcelle }}</h3>
                </div>
                <div class="bg-green-400 rounded-lg p-2">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-green-100">
            
            </div>
        </div>

        <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl p-6 shadow-lg transform hover:scale-105 transition-transform duration-200">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-yellow-100">Interventions</p>
                    <h3 class="text-3xl font-bold text-white mt-2">{{ $nb_intervention }}</h3>
                </div>
                <div class="bg-yellow-400 rounded-lg p-2">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-yellow-100">
                @if($last_intervention)
                    <span class="text-sm">Dernière : {{ $last_intervention->created_at->format('d/m/Y à H:i') }}</span>
                @else
                    <span class="text-sm">Aucune intervention</span>
                @endif
            </div>
        </div>
        
    </div>

    <!-- Graphiques et Cartes -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Graphique des cultures -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Répartition des cultures</h2>
                <div class="bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-full">
                    {{ count($parcelles) }} parcelles
                </div>
            </div>
            <canvas id="cultureChart" class="w-full" height="300"></canvas>
        </div>

        <!-- Graphique des statuts -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Statuts des parcelles</h2>
                
            </div>
            <canvas id="statutChart" class="w-full" height="300"></canvas>
        </div>
    </div>

    <!-- Nouvelles sections -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Rendement mensuel -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Rendement mensuel</h2>
            <canvas id="rendementChart" height="200"></canvas>
        </div>

        <!-- Prévisions météo améliorées -->
        <div class="bg-gradient-to-br from-blue-50 via-white to-yellow-50 rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Prévisions météo</h2>
                    <div class="flex items-center mt-2">
                        <span class="text-5xl font-extrabold text-yellow-400 mr-2">
                            <!-- Température du jour dynamique -->
                            {{ $todayTemp ?? 31}}°C
                        </span>
                        <span class="text-lg text-gray-500">Aujourd'hui</span>
                        <svg class="w-10 h-10 ml-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="5" stroke-width="2" />
                            <path stroke-linecap="round" stroke-width="2"
                                d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M17.36 17.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M17.36 6.64l1.42-1.42" />
                        </svg>
                    </div>
                </div>
                
            </div>
            <canvas id="meteoChart" height="200"></canvas>
        </div>


        <!-- État des ressources -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">État des ressources</h2>
            <canvas id="ressourcesChart" height="200"></canvas>
        </div>
    </div>

    <!-- Carte interactive -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-800">Localisation des parcelles</h2>
            <div class="flex space-x-2">
                <button class="bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-lg hover:bg-green-200">
                    Vue satellite
                </button>
                
            </div>
        </div>
        <div id="map" class="w-full h-[500px] rounded-xl"></div>
    </div>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Configuration des couleurs
    const colors = {
        primary: ['#34D399', '#FBBF24', '#60A5FA', '#F87171', '#A78BFA'],
        secondary: ['#065F46', '#92400E', '#1E40AF', '#991B1B', '#5B21B6']
    };

    // Fonction pour créer un dégradé
    function createGradient(ctx, colors) {
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, colors[0]);
        gradient.addColorStop(1, colors[1]);
        return gradient;
    }

    // Configuration de la carte
    const map = L.map('map').setView([8.6, 2], 7);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
    }).addTo(map);

    // Ajout des marqueurs personnalisés
    const parcelles = @json($parcelles);
    parcelles.forEach(parcelle => {
        if (parcelle.localisation) {
            const marker = L.marker([parcelle.localisation.latitude, parcelle.localisation.longitude])
                .addTo(map)
                .bindPopup(`
                    <div class="p-3">
                        <h3 class="text-lg font-bold text-green-600 mb-2">${parcelle.nom}</h3>
                        <div class="space-y-1">
                            <p class="flex items-center text-gray-600">
                                <span class="font-medium">Culture:</span>
                                <span class="ml-2">${parcelle.type_de_culture}</span>
                            </p>
                            <p class="flex items-center text-gray-600">
                                <span class="font-medium">Superficie:</span>
                                <span class="ml-2">${parcelle.superficie} lots</span>
                            </p>
                            <p class="flex items-center text-gray-600">
                                <span class="font-medium">Statut:</span>
                                <span class="ml-2">${parcelle.statut?.nom || 'Non défini'}</span>
                            </p>
                        </div>
                    </div>
                `);
        }
    });

    // Graphique des cultures
    const typeCounts = {};
    parcelles.forEach(p => {
        if (p.type_de_culture) {
            typeCounts[p.type_de_culture] = (typeCounts[p.type_de_culture] || 0) + 1;
        }
    });

    new Chart(document.getElementById('cultureChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: Object.keys(typeCounts),
            datasets: [{
                data: Object.values(typeCounts),
                backgroundColor: colors.primary,
                borderColor: colors.secondary,
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        padding: 20,
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });

    // Graphique des statuts
    const statutCounts = {};
    parcelles.forEach(p => {
        const statut = p.statut?.nom || 'Non défini';
        statutCounts[statut] = (statutCounts[statut] || 0) + 1;
    });

    new Chart(document.getElementById('statutChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: Object.keys(statutCounts),
            datasets: [{
                label: 'Nombre de parcelles',
                data: Object.values(statutCounts),
                backgroundColor: createGradient(document.getElementById('statutChart').getContext('2d'), 
                    ['#34D399', '#065F46']),
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Graphique de rendement
    new Chart(document.getElementById('rendementChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
            datasets: [{
                label: 'Rendement (tonnes/ha)',
                data: [4.2, 3.8, 5.1, 4.9, 5.3, 5.8],
                borderColor: '#34D399',
                tension: 0.4,
                fill: true,
                backgroundColor: 'rgba(52, 211, 153, 0.1)'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Graphique météo amélioré
    new Chart(document.getElementById('meteoChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
            datasets: [{
                label: 'Température (°C)',
                data: [29, 30, 28, 28, 27, 32, 31],
                backgroundColor: 'rgba(251,191,36,0.7)', // Jaune doux
                borderRadius: 8,
                borderSkipped: false
            }, {
                label: 'Précipitations (mm)',
                data: [0, 5, 15, 8, 2, 0, 4],
                backgroundColor: 'rgba(96,165,250,0.7)', // Bleu doux
                borderRadius: 8,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: { size: 14, weight: 'bold' }
                    }
                },
                tooltip: {
                    backgroundColor: '#fff',
                    titleColor: '#159957',
                    bodyColor: '#333',
                    borderColor: '#eee',
                    borderWidth: 1
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { color: '#888', font: { size: 13 } }
                },
                y: {
                    beginAtZero: true,
                    grid: { color: '#f3f4f6' },
                    ticks: { color: '#888', font: { size: 13 } }
                }
            }
        }
    });


    // Graphique des ressources
    new Chart(document.getElementById('ressourcesChart').getContext('2d'), {
        type: 'radar',
        data: {
            labels: ['Eau', 'Engrais', 'Pesticides', 'Main d\'œuvre', 'Matériel'],
            datasets: [{
                label: 'Niveau actuel',
                data: [80, 65, 90, 75, 85],
                backgroundColor: 'rgba(52, 211, 153, 0.2)',
                borderColor: '#34D399',
                pointBackgroundColor: '#34D399'
            }]
        },
        options: {
            responsive: true,
            scales: {
                r: {
                    beginAtZero: true,
                    max: 100
                }
            }
        }
    });
});
</script>
@endsection