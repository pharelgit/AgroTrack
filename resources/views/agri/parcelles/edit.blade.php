@extends('layouts.sidebar')

@section('title', 'Parcelle')

@section('content')
    <div>
        <h1 class="text-2xl font-bold mb-4 text-[#159957]">Modifier la parcelle</h1>

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

        <form action="{{ route('parcelles.update', $parcelle->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nom" class="block font-medium text-gray-700">Nom de la parcelle</label>
                <input type="text" name="nom" id="nom" required
                    value="{{ old('nom', $parcelle->nom) }}"
                    class="mt-1 p-1 block w-full border-2 border-b-[#1a7f7a] rounded-md focus:outline-none">
                @error('nom')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="size" class="block font-medium text-gray-700">Superficie (en lots)</label>
                <input type="number" name="size" id="size" required
                    value="{{ old('size', $parcelle->superficie) }}"
                    class="mt-1 p-1 block w-full border-2 border-b-[#1a7f7a] rounded-md focus:outline-none">
                @error('size')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="culture" class="block font-medium text-gray-700">Type de culture</label>
                <input type="text" name="culture" id="culture" required
                    value="{{ old('culture', $parcelle->type_de_culture) }}"
                    class="mt-1 p-1 block w-full border-2 border-b-[#1a7f7a] rounded-md focus:outline-none">
                @error('culture')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="plantation_date" class="block font-medium text-gray-700">Date de plantation</label>
                <input type="date" name="plantation_date" id="plantation_date" required
                    value="{{ old('plantation_date', $parcelle->date_de_plantation) }}"
                    class="mt-1 p-1 block w-full border-2 border-b-[#1a7f7a] rounded-md focus:outline-none">
                @error('plantation_date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="status" class="block font-medium text-gray-700">Statut</label>
                <select name="status" id="status" required
                    class="mt-1 p-1 block w-full border-2 border-b-[#1a7f7a] rounded-md focus:outline-none">
                    <option value="">-- Sélectionner un statut --</option>
                    @foreach ($statuts as $statut)
                        <option value="{{ $statut->id }}" {{ $parcelle->statut_id == $statut->id ? 'selected' : '' }}>
                            {{ $statut->nom }}
                        </option>
                    @endforeach
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="latitude" class="block font-medium text-gray-700">Latitude</label>
                <input type="text" name="latitude" id="latitude" required
                    value="{{ old('latitude', $parcelle->localisation->latitude ?? '') }}"
                    class="mt-1 p-1 block w-full border-2 border-b-[#1a7f7a] rounded-md focus:outline-none">
            </div>

            <div class="mb-4">
                <label for="longitude" class="block font-medium text-gray-700">Longitude</label>
                <input type="text" name="longitude" id="longitude" required
                    value="{{ old('longitude', $parcelle->localisation->longitude ?? '') }}"
                    class="mt-1 p-1 block w-full border-2 border-b-[#1a7f7a] rounded-md focus:outline-none">
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700 mb-1">Position sur la carte</label>
                <div id="map" class="h-80 rounded-md border border-gray-300"></div>
            </div>

            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-[#159957] text-white font-semibold rounded-md shadow-sm hover:bg-[#1a7f7a] focus:outline-none">
                Enregistrer les modifications
            </button>
        </form>
    </div>
@endsection

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

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const latInput = document.getElementById('latitude');
            const lngInput = document.getElementById('longitude');

            let lat = parseFloat(latInput.value) || 7.54;
            let lng = parseFloat(lngInput.value) || -5.55;

            const map = L.map('map').setView([lat, lng], latInput.value && lngInput.value ? 15 : 6);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            let marker = L.marker([lat, lng]).addTo(map);

            function setMarker(lat, lng) {
                marker.setLatLng([lat, lng]);
                latInput.value = lat;
                lngInput.value = lng;
            }

            map.on('click', function (e) {
                const lat = e.latlng.lat.toFixed(6);
                const lng = e.latlng.lng.toFixed(6);
                setMarker(lat, lng);
            });

            // Si pas de localisation, utiliser géolocalisation du navigateur
            if (!latInput.value || !lngInput.value) {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        const lat = position.coords.latitude.toFixed(6);
                        const lng = position.coords.longitude.toFixed(6);
                        map.setView([lat, lng], 15);
                        setMarker(lat, lng);
                    }, function (error) {
                        console.warn("Géolocalisation refusée ou échouée.");
                    });
                }
            }
        });
    </script>
@endpush
