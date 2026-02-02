@extends('Home.master')

@section('content')

<div class="max-w-5xl mx-auto mt-8 mb-10">

    <!-- Titre -->
    <div class="bg-white shadow-md rounded-lg p-4 mb-4">
        <h1 class="text-2xl font-bold text-gray-800 mb-1 flex items-center space-x-2">
            <ion-icon name="grid-outline" class="text-blue-600 text-2xl"></ion-icon>
            <span>{{ $category->name }}</span>
        </h1>

        <p class="text-gray-600 text-sm">
            {{ $category->description ?? 'Aucune description disponible pour cette catégorie.' }}
        </p>
    </div>

    <!-- Section Produits -->
    <h2 class="text-xl font-semibold text-gray-600 mb-3 italic">Produits dans cette catégorie</h2>

    @if($category->products->count() > 0)

        <!-- Grille plus petite -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">

            @foreach ($category->products as $product)

                <!-- Carte plus petite -->
                <div class="bg-white shadow-md rounded-lg p-2 hover:shadow-lg transition">

                    <img src="{{ asset('storage/' . $product->image) }}"
                         class="w-full h-28 object-cover rounded-md"
                         alt="{{ $product->name }}">

                    <div class="p-2">
                        <h3 class="font-semibold text-sm text-gray-800 line-clamp-1">
                            {{ $product->name }}
                        </h3>

                        <p class="text-gray-600 text-xs mt-1 line-clamp-2">
                            {{ $product->description }}
                        </p>

                        <div class="mt-2 flex justify-between items-center">
                            <span class="font-bold text-blue-900 text-sm">
                                {{ number_format($product->price, 0, ',', ' ') }} FCFA
                            </span>

                            <a href="{{ route('product.show', $product->id) }}"
                                class="px-2 py-1 bg-blue-600 text-white rounded-md text-xs hover:bg-blue-700 transition">
                                Voir
                            </a>
                        </div>
                    </div>

                </div>
            @endforeach

        </div>

    @else
        <div class="text-center mt-8">
            <p class="text-gray-500">Aucun produit disponible dans cette catégorie pour le moment.</p>
        </div>
    @endif

</div>

@endsection
