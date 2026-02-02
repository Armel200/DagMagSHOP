<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Acceuil-DacMagSHOP')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> --}}

    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Scrollbar personnalisée */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-thumb {
            background-color: rgba(107, 114, 128, 0.4);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: rgba(107, 114, 128, 0.6);
        }

        /* Transition douce pour tout */
        * {
            transition: all 0.3s ease;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-50 text-gray-800">
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10 py-3 flex items-center justify-between">

            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-10">
                <h1 class="text-lg sm:text-xl font-bold text-gray-700">
                    DacMag<span class="text-blue-500">SHOP</span>
                </h1>
            </div>

            <!-- Bouton menu mobile -->
            <button id="menuToggle" class="md:hidden text-gray-700 text-3xl focus:outline-none z-50">
                <ion-icon name="menu-outline"></ion-icon>
            </button>

            <!-- Menu principal -->
            <div id="mainMenu"
                class="max-h-0  transition-all duration-500 ease-in-out
                   md:max-h-none md:flex flex-col md:flex-row md:items-center md:space-x-6 
                   fixed md:static top-[50px] left-0 w-full md:w-auto bg-white md:bg-transparent
                   border-t md:border-0 shadow-lg md:shadow-none p-0 md:p-0 z-40 ">

                <div class="flex flex-col md:flex-row md:items-center md:space-x-6 p-4 md:p-0">

                    <!-- Catégories -->
                    <div class="relative">
                        <button id="categoryBtn"
                            class="bg-blue-100 hover:bg-blue-200 text-blue-600 font-medium px-3 py-2 rounded-lg flex items-center space-x-1 w-full md:w-auto">
                            <ion-icon name="grid-outline"></ion-icon>
                            <span>Catégories</span>
                        </button>

                        <!-- Menu déroulant catégories -->
                        @php
                            use App\Models\Category;
                            $categories = Category::orderBy('name')->get();
                        @endphp
                        <div id="categoryMenu"
                            class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg border p-2 hidden z-50">
                            @foreach ($categories as $cat)
                                <a href="{{ route('category.show', $cat->id) }}"
                                    class="block px-3 py-2 rounded hover:bg-blue-100 text-sm text-gray-700">
                                    {{ $cat->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Barre de recherche -->
                    <div class="relative">
                        <input type="text" id="searchInput" name="search" placeholder="Rechercher..."
                            class="border rounded-lg px-3 py-2 w-full md:w-56 text-sm focus:ring-2 focus:ring-blue-300 focus:outline-none focus:border-none">
                        <ion-icon name="search-outline" class="absolute right-3 top-2.5 text-gray-500"></ion-icon>

                        <!-- Suggestions -->
                        <div id="searchSuggestions"
                            class="absolute w-full mt-2 bg-white border rounded-lg shadow hidden z-50">
                            <!-- Suggestions dynamiques -->
                        </div>
                    </div>

                    <!-- Icônes -->
                    <div
                        class="flex items-center justify-between md:justify-start mt-4 md:mt-0 space-x-4 w-full md:w-auto">
                        <ion-icon name="heart-outline" class="text-2xl text-gray-700 cursor-pointer"></ion-icon>

                        <div class="relative">
                            <a href="{{ route('cart.show') }}" class="relative">
                                <ion-icon name="cart-outline" class="text-2xl text-gray-700 cursor-pointer"></ion-icon>
                                <span id="cart-count"
                                    class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-1.5">
                                    0
                                </span>
                            </a>
                        </div>

                        <!-- Profil -->
                        <div class="relative z-[50]"> <!-- z-index élevé -->
                            <button id="profileDropdownBtn" class="flex items-center space-x-2 focus:outline-none">
                                @if (auth()->check())
                                    <img src="{{ auth()->user()->profile_photo ? asset('storage/' . auth()->user()->profile_photo) : asset('images/no.jpg') }}"
                                        alt="Profil" class="w-8 h-8 rounded-full object-cover">
                                @else
                                    <img src="{{ asset('images/no.jpg') }}" alt="Default" class="w-8 h-8 rounded-full">
                                @endif
                                <span class="hidden md:block font-semibold text-gray-700 text-sm">Profil</span>
                                <ion-icon name="caret-down-outline"></ion-icon>
                            </button>

                            <!-- Menu dropdown -->
                            <div id="profileDropdownMenu"
                                class=" absolute right-0 mt-3 bg-white border rounded-xl shadow-md w-40 hidden z-[]">
                                <a href="{{ route('login') }}"
                                    class="block px-4 py-2 text-gray-700 hover:bg-blue-50">Login</a>
                                <a href="{{ route('user.dashboard') }}"
                                    class="block px-4 py-2 text-gray-700 hover:bg-blue-50">Dashboard</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 text-gray-700 hover:bg-blue-50">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>



    <!-- Contenu dynamique -->
    <main class="">
        @yield('content')
    </main>



    <footer class="bg-[#1a1616] text-gray-300 py-10 px-6 lg:px-20 scroll-fade">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

            <!-- Newsletter -->
            <div>
                <h3 class="text-sm font-semibold mb-4 uppercase tracking-wide">Newsletter</h3>
                <div class="flex items-center border border-gray-600 rounded overflow-hidden">
                    <input type="email" placeholder="Enter Your Email Address"
                        class="flex-1 px-3 py-2 bg-transparent outline-none text-sm">
                    <button class="bg-gray-700 hover:bg-gray-600 px-3 py-2">
                        <ion-icon name="arrow-forward-outline" class="text-xl"></ion-icon>
                    </button>
                </div>
                <p class="text-sm text-gray-400 mt-4 leading-relaxed">
                    Our community informed, inspired, and engaged. Our newsletter is your
                    exclusive gateway to a world of insights, updates, and exciting offers.
                </p>
            </div>

            <!-- Office -->
            <div>
                <h3 class="text-sm font-semibold mb-4 uppercase tracking-wide">Office</h3>
                <p class="text-base font-medium text-white">
                    455 N. DacMagSHOP DRIVE <br>
                    YAOUNDE CITY AND DOUALA IN <br>
                    CAMEROON COUNTRY
                </p>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-sm font-semibold mb-4 uppercase tracking-wide">Contact</h3>
                <p class="text-base font-medium text-white">+237 657 80 95 70</p>
                <p class="text-base font-medium text-white">+237 670 30 34 56</p>
            </div>
        </div>

        <!-- Ligne de séparation -->
        <div
            class="border-t border-gray-700 mt-10 pt-4 flex flex-col md:flex-row justify-between items-center text-sm text-gray-400">
            <p class="mb-3 md:mb-0">
                All Rights Reserved © <span class="text-white font-semibold">DacMagSHOP 2025</span>
            </p>
            <div class="flex space-x-4 ">
                <a href="#" class="hover:text-white transition">Facebook</a>
                <a href="#" class="hover:text-white transition">Instagram</a>
                <a href="https://wa.me/237652423743" target="_blank" class="hover:text-white transition">Whatsapp</a>
                <a href="#" class="hover:text-white transition">Tiktok</a>
            </div>
        </div>
    </footer>

    <!-- Ionicons CDN -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- #region -->
   


    
    @stack('scripts')

    <script>
        //header 
        // === Menu burger (responsive) ===
        const menuToggle = document.getElementById('menuToggle');
        const mainMenu = document.getElementById('mainMenu');

        menuToggle.addEventListener('click', () => {
            // Si le menu est fermé, on ouvre (slide down)
            if (mainMenu.classList.contains('max-h-0')) {
                mainMenu.classList.remove('max-h-0', 'p-0');
                mainMenu.classList.add('max-h-[500px]', 'p-4', 'overflow-hidden');
                // Optionnel : changer l’icône 
                menuToggle.innerHTML = '<ion-icon name="close-outline"></ion-icon>';
            } else {
                // Sinon, on referme (slide up)
                mainMenu.classList.remove('max-h-[500px]', 'p-4');
                mainMenu.classList.add('max-h-0', 'p-0');
                // Revenir à l’icône menu
                menuToggle.innerHTML = '<ion-icon name="menu-outline"></ion-icon>';
            }
        });

        // === Dropdown Profil ===
        const profileBtn = document.getElementById('profileDropdownBtn');
        const profileMenu = document.getElementById('profileDropdownMenu');

        // Ouvrir/Fermer le menu au clic
        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            profileMenu.classList.toggle('hidden');
        });

        // profileBtn.addEventListener("click", () => {
        //     profileMenu.classList.toggle("show");
        //     profileMenu.classList.toggle("hidden");
        // });

        // Fermer si on clique ailleurs

         document.addEventListener('click', (e) => {
            if (!document.getElementById('profileDropdownBtn').contains(e.target)) {
                document.getElementById('profileDropdownMenu').classList.add('hidden');
            }
        });
        
        // Slider auto + navigation
        const slides = document.querySelectorAll('.slide');
        let currentSlide = 0;
        const totalSlides = slides.length;
        const nextBtn = document.getElementById('nextSlide');
        const prevBtn = document.getElementById('prevSlide');

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.opacity = (i === index) ? '1' : '0';
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }

        function prevSlideFn() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            showSlide(currentSlide);
        }

        nextBtn.addEventListener('click', nextSlide);
        prevBtn.addEventListener('click', prevSlideFn);

        showSlide(currentSlide);
        setInterval(nextSlide, 6000); // 6s

        // add card 
        //  document.addEventListener("DOMContentLoaded", function() {
        const cartCount = document.getElementById('cart-count');

        // Charger le nombre d'éléments du panier au chargement
        fetch("{{ route('cart.count') }}")
            .then(res => res.json())
            .then(data => cartCount.textContent = data.count);

        //  Ajouter un produit au panier
        document.querySelectorAll('.add-to-cart').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const productId = this.dataset.id;

                fetch(`/cart/add/${productId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        cartCount.textContent = data.count;
                    });
            });
        });
        // });

        //product 
        document.addEventListener('DOMContentLoaded', function() {
            const addCartButtons = document.querySelectorAll('.addCartBtn');

            const likeButtons = document.querySelectorAll('.likeBtn');

            likeButtons.forEach(btn => {
                btn.addEventListener('click', async (e) => {
                    e.preventDefault();
                    const id = btn.dataset.id;
                    const token = document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content');

                    try {
                        const res = await fetch(`/products/${id}/like`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({})
                        });

                        if (res.status === 401) {
                            window.location = "{{ route('login') }}";
                            return;
                        }

                        const data = await res.json();
                        const card = btn.closest('div.bg-white');
                        const likesCountEl = card.querySelector('.likesCount');
                        likesCountEl.textContent = data.count;

                        // toggle heart color
                        const icon = btn.querySelector('.likeIcon');
                        if (data.liked) {
                            icon.classList.remove('text-gray-400');
                            icon.classList.add('text-red-500');
                        } else {
                            icon.classList.remove('text-red-500');
                            icon.classList.add('text-gray-400');
                        }

                    } catch (err) {
                        console.error(err);
                    }
                });
            });

            addCartButtons.forEach(btn => {
                btn.addEventListener('click', async (e) => {
                    e.preventDefault();
                    const id = btn.dataset.id;
                    const token = document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content');

                    try {
                        const res = await fetch(`/products/${id}/cart`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({})
                        });

                        if (res.status === 401) {
                            window.location = "{{ route('login') }}";
                            return;
                        }

                        const json = await res.json();

                        // Optionally display a small toast or update cart count in header
                        alert('Produit ajouté au panier');

                    } catch (err) {
                        console.error(err);
                    }
                });
            });
        });

        //commentaire

        document.addEventListener("DOMContentLoaded", function() {
            const slider = document.getElementById('reviewSlider');
            const slides = slider.children.length;
            let index = 0;

            setInterval(() => {
                index = (index + 1) % slides;
                slider.style.transform = `translateX(-${index * 100}%)`;
            }, 4000); // défilement toutes les 4 secondes
        });



        //  Toggle Catégories
        document.getElementById('categoryBtn').addEventListener('click', () => {
            document.getElementById('categoryMenu').classList.toggle('hidden');
        });

        // Fermer si clic ailleurs
        document.addEventListener('click', (e) => {
            if (!document.getElementById('categoryBtn').contains(e.target)) {
                document.getElementById('categoryMenu').classList.add('hidden');
            }
        });


        //  Recherche avec suggestions stylées
        const searchInput = document.getElementById('searchInput');
        const searchBox = document.getElementById('searchSuggestions');

        searchInput.addEventListener('input', async function() {
            let query = this.value.trim();

            if (query.length < 2) {
                searchBox.classList.add('hidden');
                return;
            }

            // Appel AJAX vers la recherche
            let res = await fetch(`/search-suggestions?q=${query}`);
            let data = await res.json();

            searchBox.innerHTML = "";

            if (data.length === 0) {
                searchBox.innerHTML = `<p class="px-3 py-2 text-gray-500 text-sm">Aucun résultat</p>`;
            } else {
                data.forEach(item => {
                    searchBox.innerHTML += `
                <a href="/product/${item.id}" class="block px-3 py-2 hover:bg-blue-100 rounded text-sm">
                    ${item.name}
                </a>
            `;
                });
            }

            searchBox.classList.remove('hidden');
        });

        // Cacher suggestions au clic extérieur
        document.addEventListener('click', (e) => {
            if (!searchInput.contains(e.target)) {
                searchBox.classList.add('hidden');
            }
        });


        //srool

        document.addEventListener("DOMContentLoaded", () => {
            const elements = document.querySelectorAll(".scroll-fade");

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.remove("opacity-0", "translate-y-10");
                        entry.target.classList.add("opacity-100", "translate-y-0");
                    }
                });
            }, {
                threshold: 0.2
            });

            elements.forEach((el) => observer.observe(el));
        });
    </script>
</body>

</html>
