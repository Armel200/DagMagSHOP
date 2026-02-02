@extends('Home.master')

@section('content')
    <div class="min-h-screen bg-gray-50">


        <!-- Hero Section with Slider -->
        <section class="relative overflow-hidden mt-4 lg:px-[50px] -xl">
            <div class="slider relative w-full h-[400px] md:h-[500px]">

                <!-- Slide 1 -->
                <div class="slide absolute inset-0 opacity-0 transition-opacity duration-700">
                    <img src="{{ asset('images/Armel.jpg') }}" class="w-full h-full object-cover -xl">
                    <div
                        class="absolute inset-0 bg-black/40 flex flex-col justify-center items-center text-center text-white px-6">
                        <h2 class="text-3xl md:text-5xl font-bold mb-4">Discover Exclusive Offers</h2>
                        <p class="text-lg md:text-xl mb-6">Get the best deals on our top products!</p>
                        <a href="#"
                            class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-6 py-3 rounded-full shadow-lg transition">
                            Get Deal Now
                        </a>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="slide absolute inset-0 opacity-0 transition-opacity duration-700">
                    <img src="{{ asset('images/home.png') }}" class="w-full h-full object-cover -xl">
                    <div class="absolute inset-0  flex flex-col justify-center items-center text-center text-white px-6">
                        <h2 class="text-3xl md:text-5xl font-bold mb-4">New Arrivals Are Here</h2>
                        <p class="text-lg md:text-xl mb-6">Shop the latest collections before they're gone!</p>
                        <a href="#"
                            class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-6 py-3 rounded-full shadow-lg transition">
                            Get Deal Now
                        </a>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="slide absolute inset-0 opacity-0 transition-opacity duration-700">

                    <video src="{{ asset('videos/slide3.mp4') }}" autoplay muted loop playsinline
                        class="w-full h-full object-cover">
                    </video>

                    <div
                        class="absolute inset-0 bg-black/40 flex flex-col justify-center items-center text-center text-white px-6">
                        <h2 class="text-3xl md:text-5xl font-bold mb-4">Up to 50% Off</h2>
                        <p class="text-lg md:text-xl mb-6">Don’t miss our limited-time discounts!</p>

                        <a href="#"
                            class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-6 py-3 rounded-full shadow-lg transition">
                            Get Deal Now
                        </a>
                    </div>

                </div>


                <!-- Slide 4 -->
                <div class="slide absolute inset-0 opacity-0 transition-opacity duration-700">
                    <img src="{{ asset('images/slide4.jpg') }}" class="w-full h-full object-cover -xl">
                    <div
                        class="absolute inset-0 bg-black/40 flex flex-col justify-center items-center text-center text-white px-6">
                        <h2 class="text-3xl md:text-5xl font-bold mb-4">Shop Smart, Shop Easy</h2>
                        <p class="text-lg md:text-xl mb-6">Experience a smooth and secure shopping journey.</p>
                        <a href="#"
                            class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-6 py-3 rounded-full shadow-lg transition">
                            Get Deal Now
                        </a>
                    </div>
                </div>
            </div>

            <!-- Navigation buttons -->
            <button id="prevSlide"
                class="absolute top-1/2 left-4 -translate-y-1/2 bg-white/70 hover:bg-white p-2 rounded-full shadow">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </button>
            <button id="nextSlide"
                class="absolute top-1/2 right-4 -translate-y-1/2 bg-white/70 hover:bg-white p-2 rounded-full shadow">
                <ion-icon name="chevron-forward-outline"></ion-icon>
            </button>
        </section>

        <!-- Products Section -->
        <section class="pr-6 lg:pl-[100px] pl-6 py-10" id="cate">
            {{-- <h2 class="text-2xl font-semibold text-gray-800 mb-6">Hot Categories</h2> --}}

            <div class="flex space-x-4 overflow-x-auto pb-4 scroll-fade">
                @forelse($categories as $category)
                    <div
                        class="bg-white rounded-2xl shadow hover:shadow-md  min-w-[180px] flex-shrink-0 p-2 cursor-pointer">
                        <!-- Nom -->
                        <div class="p-3  font-medium text-gray-700 flex justify-start flex-col text-start">
                            <h2 class="text-[16px] text-gray-800">Hot Categories</h2>
                            <h2 class="text-[14px]"> {{ $category->name }}</h2>
                        </div>
                        <!-- Image -->
                        <img src="{{ $category->products->first() ? asset('storage/' . $category->products->first()->image) : asset('images/default-category.jpg') }}"
                            alt="{{ $category->name }}" class="rounded-t-2xl h-40 w-full object-cover">



                    </div>
                @empty
                    <p class="text-gray-500">Aucune catégorie disponible pour le moment.</p>
                @endforelse
            </div>
        </section>

        {{-- product --}}
        <section>
            <div class="max-w-7xl mx-auto px-4 py-8">

                <h2 class="text-2xl font-semibold mb-4">Recommended items</h2>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                    @foreach ($products as $product)
                        <div class="bg-white rounded-xl shadow-sm p-3 relative scroll-fade">
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

            </div>
        </section>

        <div class="b flex items-center justify-center scroll-fade">
            <a href="{{ route('all.product') }}"
                class="text-black lg:text-[17px] text-[13px] bg-gray-100 p-4 rounded-lg ">Show more items <ion-icon
                    name="arrow-redo-outline"></ion-icon></a>

        </div>

        <section
            class="cosmetique grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 gap-[20px] lg:px-[100px] md:px-[60px] px-[20px] py-[50px]">

            <div class=" scroll-fade first bg-gradient-to-r from-blue-800 to-blue-500 flex justify-between lg:p-6 md:p-3 p-2 rounded-md">

                <span class="gap-[10px] flex flex-col">
                    <h1 class="text-white lg:text-[20px] md:text-[17px] text-[15px] ">Personal <br> Hygiene items</h1>

                    <a href="#"
                        class="bg-gray-100 lg:p-2 p-1 rounded-lg lg:text-[16px] md:text-[15px] text-[13px]">Get deal now</a>
                </span>
                <div class="flex flex-col">
                    <img src="{{ asset('images/hygi.png') }}" alt="" srcset=""
                        class="lg:h-[150px] h-[100px]">
                    {{-- <span class="h-[100px] translate-y-7 w-[100px] rounded-full bg-gray-300"></span> --}}
                </div>

            </div>

            <div
                class="scroll-fade bg-gradient-to-r from-blue-800 to-blue-500 flex justify-between lg:p-6 md:p-3 p-2 rounded-md">

                <span class="gap-[10px] flex flex-col">
                    <h1 class="text-white lg:text-[20px] md:text-[17px] text-[15px] ">Personal <br> Hygiene items</h1>

                    <a href="#"
                        class="bg-gray-100 lg:p-2 p-1 rounded-lg lg:text-[16px] md:text-[15px] text-[13px]">Get deal
                        now</a>
                </span>
                <div class="flex flex-col">
                    <img src="{{ asset('images/hygi.png') }}" alt="" srcset=""
                        class="lg:h-[150px] h-[100px]">
                    {{-- <span class="h-[100px] translate-y-7 w-[100px] rounded-full bg-gray-300"></span> --}}
                </div>

            </div>


    </div>

    </section>
    <section class="relative bg-black text-white lg:h-[80vh]  ">
        <img src="{{ asset('images/image.png') }}" alt="Blue beads bag"
            class="absolute inset-0 w-full h-full object-cover opacity-80">

        <div
            class=" scroll-fade relative z-10 max-w-7xl mx-auto px-6 py-20 flex flex-col md:flex-row items-center md:items-start gap-8">
            <div class=" w-full items-center ">
                <div class="grid lg:grid-cols-2 grid-cols-1 scroll-fade ">
                    <h2 class="text-3xl md:text-4xl font-bold leading-tight mb-4">
                        FIND YOUR FAVORITES,<br>
                        AND TAKE THE FIRST STEP<br>
                        TOWARDS SNEAKER
                    </h2>
                    <p class="text-gray-200 mb-6 scroll-fade">
                        Discover the perfect article that complements your unique style
                    </p>
                </div>
                <style>
                    @keyframes pulseScale {

                        0%,
                        100% {
                            transform: scale(1);
                        }

                        50% {
                            transform: scale(1.1);
                        }
                    }

                    .animate-scale {
                        animation: pulseScale 2s ease-in-out infinite;
                    }
                </style>

                <a href="{{ route('register') }}"
                    class=" scroll-fade animate-scale lg:mt-[150px] underline flex items-center justify-center bg-white text-black text-[16px] font-semibold  h-[100px] w-[100px] rounded-full shadow-lg hover:bg-gray-100 transition">
                    Register <br> Now!
                </a>

            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto mt-16 px-6 py-[20px]">
        <div class="flex justify-between items-center mb-6 scroll-fade">
            <h2 class="text-2xl font-bold text-gray-800 relative">
                <span class="border-l-4 border-blue-500 pl-2">VOS AVIS</span>
            </h2>
            <a href="{{ route('reviews.create') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-4 py-2 rounded transition">
                Envoyer vos avis
            </a>
        </div>

        <div class="relative overflow-hidden bg-blue-50 rounded-2xl shadow-inner p-6 h-[300px]">
            <div id="reviewSlider" class="flex transition-transform duration-700 ease-in-out">
                @forelse ($reviews as $review)
                    <div class="min-w-full px-8 text-center flex flex-col justify-center">
                        <div
                            class="relative bg-white shadow-lg hover:shadow-xl transition-shadow duration-300 p-6 rounded-2xl mx-auto max-w-2xl border border-gray-100">
                            <!-- Guillemets décoratifs -->
                            <div class="absolute top-2 left-4 text-blue-400 text-5xl opacity-20 select-none">“</div>
                            <div class="absolute bottom-2 right-4 text-blue-400 text-5xl opacity-20 select-none">”</div>

                            <!-- Commentaire -->
                            <p class="text-gray-700 italic text-lg leading-relaxed mb-5">
                                “{{ $review->comment }}”
                            </p>

                            <!-- Ligne de séparation -->
                            <div class="w-16 h-1 bg-blue-500 mx-auto mb-4 rounded-full"></div>

                            <!-- Informations utilisateur -->
                            <div class="text-sm text-gray-600">
                                <p class="font-semibold text-gray-800">{{ $review->user->name ?? 'Utilisateur' }}</p>
                                <p class="text-gray-500">{{ $review->created_at->format('d M Y à H:i') }}</p>
                            </div>
                        </div>
                    </div>

                @empty
                    <div class="min-w-full flex items-center justify-center text-gray-500">
                        Aucun avis pour le moment — soyez le premier à laisser un avis !
                    </div>
                @endforelse
            </div>
        </div>
    </section>



    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/237657957180" target="_blank"
        class="fixed bottom-6 right-6 bg-green-500 text-white h-[50px] w-[50px] flex justify-center items-center rounded-full shadow-lg hover:bg-green-600 transition">
        <ion-icon name="logo-whatsapp" class="text-3xl"></ion-icon>
    </a>
    </div>

    <!-- JS Slider + Dropdown -->
@endsection
