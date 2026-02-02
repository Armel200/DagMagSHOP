@extends('Home.master')

@section('content')

<section class="relative w-full h-[60vh] md:h-[75vh] overflow-hidden  shadow-lg">

    <div class="heroSlide absolute inset-0 w-full h-full opacity-0 transition-opacity duration-700">
        <img src="{{ asset('images/Armel.jpg') }}"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/40 flex flex-col justify-center items-center text-center text-white px-6">
            <h2 class="text-3xl md:text-5xl font-bold mb-4">Découvrez nos meilleures offres</h2>
            <p class="text-lg md:text-xl mb-6">Des produits de qualité, au meilleur prix.</p>
            <a href="{{ route('list.product') }}"
               class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-6 py-3 rounded-full shadow-lg transition">
                Voir les produits
            </a>
        </div>
    </div>

    <div class="heroSlide absolute inset-0 w-full h-full opacity-0 transition-opacity duration-700">
        <img src="{{ asset('images/slide2.jpg') }}"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/40 flex flex-col justify-center items-center text-center text-white px-6">
            <h2 class="text-3xl md:text-5xl font-bold mb-4">Livraison rapide & fiable</h2>
            <p class="text-lg md:text-xl mb-6">Commandez aujourd'hui, recevez à temps.</p>
            <a href="{{ route('orders.list') }}"
               class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-6 py-3 rounded-full shadow-lg transition">
                Suivre ma commande
            </a>
        </div>
    </div>

    <div class="heroSlide absolute inset-0 w-full h-full opacity-0 transition-opacity duration-700">
        <img src="{{ asset('images/slide3.jpg') }}"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/40 flex flex-col justify-center items-center text-center text-white px-6">
            <h2 class="text-3xl md:text-5xl font-bold mb-4">Promotions exceptionnelles</h2>
            <p class="text-lg md:text-xl mb-6">Profitez de réductions limitées.</p>
            <a href="#"
               class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-6 py-3 rounded-full shadow-lg transition">
                Voir les promos
            </a>
        </div>
    </div>

</section>

<script>
    let slides = document.querySelectorAll('.heroSlide');
    let index = 0;

    function showSlide() {
        slides.forEach(s => s.style.opacity = "0");
        slides[index].style.opacity = "1";
        index = (index + 1) % slides.length;
    }

    showSlide();
    setInterval(showSlide, 5000); // change toutes les 5 secondes
</script>


<section class="p-6">
    <div class="p-6">
         <h2 class="text-2xl font-bold text-gray-800 relative">
                <span class="border-l-4 border-blue-500 pl-2">TOUS NOS PRODUITS</span>
            </h2>
    </div>

     <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                    @foreach ($products as $product)
                        <div class="bg-white rounded-xl shadow-sm p-3 relative">
                            <!-- heart (like) -->
                            <button
                                class="likeBtn absolute top-3 right-3 bg-white/80 p-1 rounded-full shadow hover:scale-105"
                                data-id="{{ $product->id }}" aria-label="like">

                                @if (Auth::check() && $product->isLikedBy(Auth::user()))
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 likeIcon text-red-500"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 likeIcon text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
                                    </svg>
                                @endif
                            </button>

                            <!-- image -->
                            <div class="h-40 flex items-center justify-center overflow-hidden rounded-lg bg-gray-50">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/product-placeholder.png') }}"
                                    alt="{{ $product->name }}" class="object-contain h-full w-full">
                            </div>

                            <div class="mt-3">
                                <h3 class="text-sm font-medium text-gray-800 line-clamp-2">{{ $product->name }}</h3>
                                <p class="text-xs text-gray-500 mt-1">{{ $product->price }} FCFA</p>
                            </div>

                            <div class="mt-4 flex items-center justify-between">
                                <button
                                    class="addCartBtn bg-white border px-2 py-1 rounded-lg text-sm flex items-center gap-2"
                                    data-id="{{ $product->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m13-9l2 9M10 21a1 1 0 100-2 1 1 0 000 2zm6 0a1 1 0 100-2 1 1 0 000 2z" />
                                    </svg>
                                    <span class="add-to-cart " data-id="{{ $product->id }}">
                                        Add
                                    </span>
                                </button>

                                <div class="text-xs text-gray-500">
                                    <span class="likesCount">{{ $product->likes()->count() }}</span> likes
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                 <a href="https://wa.me/237657957180" target="_blank"
        class="fixed bottom-6 right-6 bg-green-500 text-white h-[50px] w-[50px] flex justify-center items-center rounded-full shadow-lg hover:bg-green-600 transition">
        <ion-icon name="logo-whatsapp" class="text-3xl"></ion-icon>
    </a>

</section>



    
@endsection