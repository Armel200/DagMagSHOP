@extends('Home.master')

@section('content')
<div class="max-w-5xl mx-auto mt-10 p-4">

    <!-- Container principal -->
    <div class="bg-white rounded-2xl shadow-lg p-6 md:flex md:space-x-6">

        <!-- Image du produit -->
        <div class="md:w-1/2">
            <img src="{{ asset('storage/' . $product->image) }}"
                 alt="{{ $product->name }}"
                 class="w-full h-72 object-cover rounded-xl shadow-md">
        </div>

        <!-- Informations produit -->
        <div class="md:w-1/2 mt-5 md:mt-0">

            <!-- Nom -->
            <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>

            <!-- Badge catégorie -->
            @if($product->category)
            <span class="inline-block bg-blue-100 text-blue-700 text-xs font-medium px-3 py-1 mt-2 rounded-full">
                {{ $product->category->name }}
            </span>
            @endif

            <!-- Description -->
            <p class="text-gray-600 leading-relaxed mt-4">
                {{ $product->description }}
            </p>

            <!-- Prix -->
            <p class="text-3xl font-bold text-blue-900 mt-6">
                {{ number_format($product->price, 0, ',', ' ') }} FCFA
            </p>

            <!-- Bouton ajout panier -->
            <button 
                class="mt-6 w-full md:w-auto bg-blue-600 hover:bg-blue-700 transition text-white font-semibold px-6 py-3 rounded-xl shadow-md flex items-center space-x-2">
                <ion-icon name="cart-outline" class="text-xl"></ion-icon>
                <span>Ajouter au panier</span>
            </button>

        </div>
    </div>

    <!-- Section produits similaires -->
    @if(isset($relatedProducts) && count($relatedProducts) > 0)
    <h2 class="text-xl font-semibold mt-10 mb-4">Produits similaires</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

        @foreach($relatedProducts as $similar)
        <a href="{{ route('product.show', $similar->id) }}"
           class="bg-white p-3 rounded-xl shadow hover:shadow-lg transition block">

            <img src="{{ asset('storage/' . $similar->image) }}"
                 class="w-full h-32 object-cover rounded-lg">

            <h3 class="text-sm font-medium mt-2">{{ $similar->name }}</h3>

            <p class="text-blue-900 font-semibold text-sm">
                {{ number_format($similar->price, 0, ',', ' ') }} FCFA
            </p>

        </a>
        @endforeach
    </div>
    @endif

</div>
@endsection
