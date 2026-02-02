@extends('users.layout')

@section('title', 'Mon Tableau de bord')

@section('content')
<div class="space-y-8 p-6">
    
    <!-- Section bienvenue -->
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white p-6 rounded-2xl shadow-md flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold mb-2">Bienvenue, {{ ucfirst($user->name) }} </h2>
            <p class="text-sm opacity-90">Heureux de vous revoir sur votre espace personnel.</p>
        </div>
        {{-- <img src="{{ $user->profile_photo ? asset('storage/'.$user->profile_photo) : 'https://via.placeholder.com/60' }}" 
             alt="Photo de profil" 
             class="w-16 h-16 object-cover rounded-full border-2 border-white shadow"> --}}
    </div>

    <!-- Section résumé -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Commandes -->
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="text-gray-700 text-lg font-semibold mb-2">Commandes</h3>
            <p class="text-gray-500 mb-4">Vous avez <span class="font-bold text-blue-600">{{ $ordersCount }}</span> commandes en cours.</p>
            <a href="#" class="text-blue-600 hover:underline">Voir les détails →</a>
        </div>

        <!-- Offres -->
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="text-gray-700 text-lg font-semibold mb-2">Offres</h3>
            <p class="text-gray-500 mb-4">Vous avez <span class="font-bold text-blue-600">{{ $offersCount }}</span> offres en attente.</p>
            <a href="#" class="text-blue-600 hover:underline">Voir les offres →</a>
        </div>

        <!-- Messages -->
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h3 class="text-gray-700 text-lg font-semibold mb-2">Messages</h3>
            <p class="text-gray-500 mb-4">Vous avez <span class="font-bold text-blue-600">{{ $messagesCount }}</span> nouveaux messages.</p>
            <a href="#" class="text-blue-600 hover:underline">Ouvrir la boîte →</a>
        </div>
    </div>

</div>
@endsection
