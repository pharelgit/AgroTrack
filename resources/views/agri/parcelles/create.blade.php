@extends('layouts.sidebar')

@section('title', 'Créer une parcelle')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #map {
            height: 70vh;
            width: 100%;
            transition: height 0.3s;
        }
    </style>
@endpush

@section('content')
<div>
    <h1 class="text-2xl font-bold mb-4 text-[#159957]">Créer une nouvelle parcelle</h1>

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

    <form action="{{ route('parcelles.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="nom" class="block font-medium text-gray-700">Nom de la parcelle</label>
            <input type="text" name="nom" id="nom" required
                class="mt-1 p-2 block w-full border-2 border-b-[#1a7f7a] rounded-md focus:outline-none">
        </div>

        <div>
            <label for="size" class="block font-medium text-gray-700">Superficie (en lots)</label>
            <input type="number" name="size" id="size" required min="1"
                class="mt-1 p-2 block w-full border-2 border-b-[#1a7f7a] rounded-md focus:outline-none">
        </div>

        <div>
            <label for="culture" class="block font-medium text-gray-700">Type de culture</label>
            <input type="text" name="culture" id="culture" required
                class="mt-1 p-2 block w-full border-2 border-b-[#1a7f7a] rounded-md focus:outline-none">
        </div>

        <div>
            <label for="plantation_date" class="block font-medium text-gray-700">Date de plantation</label>
            <input type="date" name="plantation_date" id="plantation_date" required
                class="mt-1 p-2 block w-full border-2 border-b-[#1a7f7a] rounded-md focus:outline-none">
        </div>

        <div>
            <label for="status" class="block font-medium text-gray-700">Statut</label>
            <select name="status" id="status" required
                class="mt-1 p-2 block w-full border-2 border-b-[#1a7f7a] rounded-md focus:outline-none">
                <option value="">-- Sélectionner un statut --</option>
                @foreach ($statuts as $statut)
                    <option value="{{ $statut->id }}">{{ $statut->nom }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-medium text-gray-700 mb-1">Localisation de la parcelle</label>
            <div id="map" class="w-full h-80 rounded border border-gray-300"></div>
            <p class="text-sm text-gray-600 mt-2">Cliquez sur la carte pour définir la position de la parcelle.</p>

            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
        </div>

        <button type="submit"
            class="inline-flex items-center px-4 py-2 bg-[#159957] text-white font-semibold rounded-md shadow-sm hover:bg-[#1a7f7a] focus:outline-none">
            Créer la parcelle
        </button>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const map = L.map('map');
    let marker, accuracyCircle;

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Configuration de la géolocalisation
    map.locate({
        setView: true,
        maxZoom: 16,
        enableHighAccuracy: true,
        timeout: 10000
    });

    // Gestion de la localisation réussie
    map.on('locationfound', function(e) {
        const radius = e.accuracy / 2;
        const lat = e.latlng.lat.toFixed(6);
        const lng = e.latlng.lng.toFixed(6);

        if (marker) {
            marker.setLatLng(e.latlng);
        } else {
            marker = L.marker(e.latlng).addTo(map)
                .bindPopup(`Votre position actuelle<br>Lat: ${lat}<br>Lng: ${lng}`).openPopup();
        }

        if (accuracyCircle) {
            accuracyCircle.setLatLng(e.latlng).setRadius(radius);
        } else {
            accuracyCircle = L.circle(e.latlng, {
                color: '#159957',
                fillColor: '#1a5f7a',
                fillOpacity: 0.2,
                radius: radius
            }).addTo(map);
        }

        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
    });

    // Gestion des erreurs de géolocalisation
    map.on('locationerror', function(e) {
        alert("Géolocalisation impossible. Carte centrée sur la Côte d'Ivoire.");
        map.setView([8.6, 2], 6); // Position de repli
    });

    // Clic sur la carte pour déplacer le marqueur
    map.on('click', function(e) {
        const lat = e.latlng.lat.toFixed(6);
        const lng = e.latlng.lng.toFixed(6);
        
        if (marker) {
            marker.setLatLng(e.latlng)
                .setPopupContent(`Position sélectionnée<br>Lat: ${lat}<br>Lng: ${lng}`);
        } else {
            marker = L.marker(e.latlng).addTo(map)
                .bindPopup(`Position sélectionnée<br>Lat: ${lat}<br>Lng: ${lng}`).openPopup();
        }
        
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
    });
});
</script>


@endpush

