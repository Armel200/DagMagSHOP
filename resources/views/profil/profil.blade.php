@extends('users.layout')

@section('title', 'Mon Profil - DacMagSHOP')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-2xl p-8 mt-10 mb-20">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3 flex items-center gap-2">
        <ion-icon name="person-circle-outline" class="text-3xl text-blue-600"></ion-icon>
        Mon profil
    </h1>

    <!-- Photo de profil -->
    <div class="flex flex-col items-center mb-8">
        <div class="relative">
            <img src="{{ Auth::user()->profile_photo 
                        ? asset('storage/' . Auth::user()->profile_photo) 
                        : asset('images/default-avatar.png') }}" 
                 alt="Photo de profil"
                 class="w-32 h-32 rounded-full object-cover border-4 border-blue-500 shadow-lg">

            {{-- <a href="{{ route('profile.edit') }}" 
               class="absolute bottom-0 right-0 bg-blue-600 hover:bg-blue-700 text-white rounded-full p-2 shadow transition">
                <ion-icon name="camera-outline"></ion-icon>
            </a> --}}
        </div>
        <h2 class="mt-4 text-xl font-semibold text-gray-800">{{ Auth::user()->name }}</h2>
        <p class="text-gray-500 text-sm">{{ Auth::user()->email }}</p>
    </div>

    <!-- Informations de l'utilisateur -->
    <div class="space-y-6">
        <div class="flex items-center justify-between border-b pb-3">
            <p class="text-gray-600 font-medium">Nom complet :</p>
            <p class="text-gray-900 font-semibold">{{ Auth::user()->name }}</p>
        </div>

        <div class="flex items-center justify-between border-b pb-3">
            <p class="text-gray-600 font-medium">Adresse e-mail :</p>
            <p class="text-gray-900 font-semibold">{{ Auth::user()->email }}</p>
        </div>

        <div class="flex items-center justify-between border-b pb-3">
            <p class="text-gray-600 font-medium">Numéro de téléphone :</p>
            <p class="text-gray-900 font-semibold">
                {{ Auth::user()->phone ?? 'Non renseigné' }}
            </p>
        </div>

        <div class="flex items-center justify-between border-b pb-3">
            <p class="text-gray-600 font-medium">Date d’inscription :</p>
            <p class="text-gray-900 font-semibold">
                {{ Auth::user()->created_at->format('d/m/Y') }}
            </p>
        </div>

        <div class="flex items-center justify-between border-b pb-3">
            <p class="text-gray-600 font-medium">Nombre de commandes :</p>
            <p class="text-gray-900 font-semibold">
                {{-- {{ Auth::user()->orders->count() ?? 0 }} --}}
            </p>
        </div>
    </div>

    <!-- Boutons d’action -->
    <div class="mt-8 flex flex-wrap gap-4 justify-center">
        <a href="{{ route('profile.edit') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition shadow">
            <ion-icon name="create-outline" class="align-middle mr-1"></ion-icon>
            Modifier mes infos
        </a>

        {{-- <a href="{{ route('orders.user') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg transition shadow">
            <ion-icon name="cart-outline" class="align-middle mr-1"></ion-icon>
            Voir mes commandes
        </a> --}}

        {{-- <a href="{{ route('logout') }}" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition shadow">
            <ion-icon name="log-out-outline" class="align-middle mr-1"></ion-icon>
            Déconnexion
        </a> --}}
    </div>
</div>
@endsection
