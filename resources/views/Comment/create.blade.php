@extends('Home.master')

@section('title', 'Laisser un avis')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center px-4 py-10">
    <div class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Laissez votre avis</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('reviews.store') }}" class="space-y-6">
            @csrf

            <!-- Évaluation étoiles -->
            <div class="flex justify-center space-x-1 text-yellow-400 text-2xl">
                <label>
                    <input type="radio" name="rating" value="1" class="hidden peer">
                    <span class="cursor-pointer peer-checked:text-yellow-500">★</span>
                </label>
                <label>
                    <input type="radio" name="rating" value="2" class="hidden peer">
                    <span class="cursor-pointer peer-checked:text-yellow-500">★</span>
                </label>
                <label>
                    <input type="radio" name="rating" value="3" class="hidden peer">
                    <span class="cursor-pointer peer-checked:text-yellow-500">★</span>
                </label>
                <label>
                    <input type="radio" name="rating" value="4" class="hidden peer">
                    <span class="cursor-pointer peer-checked:text-yellow-500">★</span>
                </label>
                <label>
                    <input type="radio" name="rating" value="5" class="hidden peer" checked>
                    <span class="cursor-pointer peer-checked:text-yellow-500">★</span>
                </label>
            </div>

            <!-- Champ de commentaire -->
            <div>
                <textarea name="comment" rows="4"
                    class="w-full border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-xl p-3 resize-none"
                    placeholder="Partagez votre expérience ici..." required></textarea>
                @error('comment')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bouton -->
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-xl shadow transition transform hover:scale-[1.02]">
                Envoyer mon avis
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="text-blue-600 hover:underline">← Retour à l'accueil</a>
        </div>
    </div>
</div>
@endsection
