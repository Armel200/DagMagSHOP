<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - DacMagSHOP</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
     <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <style>
        .transition-all {
            transition: all 0.3s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-10px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .animate-slideIn {
            animation: slideIn 0.25s ease forwards;
        }

        /* Assure que le dropdown s'affiche au-dessus de la sidebar */
        #dropdownMenu {
            z-index: 9999;
        }

        /* Empêche que le menu soit coupé sur petit écran */
        .relative {
            position: relative;
            overflow: visible !important;
        }

        /* largeur normale */
        #sidebar {
            width: 16rem;
        }

        /* w-64 ~ 256px */

        /* état "collapsed" pour grand écran */
        #sidebar.collapsed {
            width: 115px;
            /* ~88px, équivalent à w-22 (custom) */
        }

        /* garde la sidebar cachée sur mobile, gérée par JS */
        @media (max-width: 767px) {
            #sidebar {
                transform: translateX(-100%);
            }

            #sidebar.open {
                transform: translateX(0);
            }
        }

        /* cache les textes quand collapsed */
        #sidebar.collapsed nav span,
        #sidebar.collapsed #sidebar-title {
            display: none;
        }

        /* ajuste l'icône/logo centré quand collapsed */
        #sidebar.collapsed .logo-wrapper img {
            width: 36+-px;
            height: 36px;
        }

        /* transition douce */
        #sidebar {
            transition: width 0.25s ease, transform 0.25s ease;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex h-screen transition-all">

        <!-- SIDEBAR -->
        <aside id="sidebar"
            class="w-64 md:w-[280px] bg-white shadow-md transition-all duration-300 fixed md:relative z-50 md:translate-x-0 -translate-x-full md:block  min-h-screen">
            <div class="p-4 flex items-center justify-between">
                <div
                    class="logo-wrapper border-2 flex justify-center items-center border-amber-200 rounded-full overflow-hidden w-12 h-12 md:w-14 md:h-14 lg:w-16 lg:h-16">
                    <img src="{{ asset('images/logg.jpg') }}" alt="" class="object-cover w-full h-full">
                </div>
                <h2 id="sidebar-title" class="text-[18px] lg:text-[20px] font-bold text-gray-800 transition-all">
                    DacMagSHOP
                </h2>
                <ion-icon id="toggleSidebar" name="swap-horizontal-outline"
                    class="cursor-pointer text-[20px]"></ion-icon>
            </div>


            <nav class="mt-4 px-[20px] flex flex-col justify-between transition-all h-[90%] overflow-y-auto">
                <div class="mb-[50px]">
                    <ul id="sidebar-menu" class="space-y-1">
                        <li>
                            <a href="{{ route('user.dashboard') }}"
                                class="flex items-center gap-2 py-2 px-4 rounded transition-all
       {{ request()->routeIs('user.dashboard') ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-blue-500 hover:text-white' }}">
                                <ion-icon name="grid-outline" class="text-xl"></ion-icon>
                                <span>Dashboard</span>
                            </a>
                        </li>

                      
                        <li>
                            <a href="{{ route('user.orders') }}"
                                class="flex items-center gap-2 py-2 px-4 rounded transition-all
       {{ request()->routeIs('user.orders') ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-blue-500 hover:text-white' }}">
                                 <ion-icon
                                    name="receipt-outline" class="text-xl"></ion-icon>
                                <span>Mes Commandes</span>
                            </a>
                        </li>
                         <li>
                            <a href="{{ route('user.profil') }}"
                                class="flex items-center gap-2 py-2 px-4 rounded transition-all
       {{ request()->routeIs('user.profil') ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-blue-500 hover:text-white' }}">
                                 <ion-icon
                                    name="receipt-outline" class="text-xl"></ion-icon>
                                <span>Mon Profil</span>
                            </a>
                        </li>
                        <li><a href="#"
                                class="flex items-center gap-2 py-2 px-4 text-gray-700 hover:bg-blue-500 hover:text-white rounded transition-all"><ion-icon
                                    name="layers-outline" class="text-xl"></ion-icon><span>Offres</span></a></li>
                        <li><a href="#"
                                class="flex items-center gap-2 py-2 px-4 text-gray-700 hover:bg-blue-500 hover:text-white rounded transition-all"><ion-icon
                                    name="person-outline" class="text-xl"></ion-icon><span>Inbox</span></a></li>
                       
                        <li><a href="#"
                                class="flex items-center gap-2 py-2 px-4 text-gray-700 hover:bg-blue-500 hover:text-white rounded transition-all"><ion-icon
                                    name="list-outline" class="text-xl"></ion-icon><span>Comment</span></a></li>
                    </ul>
                </div>

                <div class="mb-[90px]">
                    <h1 class="text-gray-600 font-semibold mb-[6px] text-[14px] transition-all">SYSTEME</h1>
                    <ul class="space-y-1">
                        <li><a href="#"
                                class="flex items-center gap-2 py-2 px-4 text-gray-700 hover:bg-blue-500 hover:text-white rounded transition-all"><ion-icon
                                    name="settings-outline" class="text-xl"></ion-icon><span>Parametres</span></a></li>
                        <li><label class="block py-2 px-4 text-gray-700 flex items-center"><input type="checkbox"
                                    class="mr-2" id="dark-mode-toggle"> Mode Sombre</label></li>
                        <li><a href="{{ route('home') }}"
                                class="flex items-center gap-2 py-2 px-4 text-gray-700 hover:bg-blue-500 hover:text-white rounded transition-all"><ion-icon
                                    name="home-outline" class="text-xl"></ion-icon><span>Acceuil</span></a></li>

                        <li><a href="{{ route('logout') }}"
                                class="flex items-center gap-2 py-2 px-4 text-gray-700 hover:bg-blue-500 hover:text-white rounded transition-all"><ion-icon
                                    name="log-out-outline" class="text-xl"></ion-icon><span>Log out</span></a></li>
                    </ul>
                </div>


            </nav>
        </aside>

        <!-- Overlay for mobile -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-40 hidden z-40 md:hidden"></div>

        <!-- MAIN CONTENT -->
        <main class="flex-1 pr-4 pb-4 pl-4 pt-0 md:p-6 overflow-y-auto transition-all w-full md:ml-0">
            <header
                class="flex flex-col sm:flex-row justify-between items-center mb-6 bg-gray-100 p-4 sticky top-0 z-30 shadow-sm gap-3">
                <!-- Menu burger visible sur mobile -->
                <div class="flex justify-between items-center w-full sm:w-auto">
                    <button id="burgerBtn" class="md:hidden text-2xl text-gray-700 focus:outline-none">
                        <ion-icon name="menu-outline"></ion-icon>
                    </button>
                    <h1 class="text-xl sm:text-2xl font-semibold text-gray-800 ml-2 sm:ml-0">Dashboard
                        <span class="text-sm text-gray-500 block sm:inline">Bonjour,
                            {{ ucfirst($user->name) }}</span>
                    </h1>
                </div>

                <!-- Barre de recherche -->
                <div class="w-full sm:w-auto mt-2 sm:mt-0">
                    <input type="text" placeholder=" Rechercher..."
                        class="w-full sm:w-64 py-2 px-4 lg:ml-[200px] border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>

                <!-- Boutons et profil -->
                <div class="flex items-center space-x-3 mt-3 sm:mt-0">
                    <div class="relative flex space-x-2">
                        <button><ion-icon name="chatbubble-outline" class="text-[22px]"></ion-icon></button>
                        <button><ion-icon name="notifications-outline" class="text-[22px]"></ion-icon></button>
                    </div>
                    <div class="relative z-50">
                        <button id="dropdownButton" class="flex items-center space-x-2 focus:outline-none">
                            <img src="{{ auth()->user()->profile_photo ? asset('storage/' . auth()->user()->profile_photo) : asset('images/no.jpg') }}"
                                alt="Avatar"
                                class="w-8 h-8 sm:w-10 sm:h-10 rounded-full object-cover border border-gray-300">
                            <div class="flex items-center space-x-1">
                                <p class="text-blue-500 font-semibold">{{ auth()->user()->name }}</p>
                                <ion-icon name="caret-down-outline" class="text-[20px]"></ion-icon>
                            </div>
                        </button>

                        <!-- MENU DÉROULANT -->
                        <div id="dropdownMenu"
                            class="absolute right-0 mt-3 w-52 sm:w-64 bg-white rounded-2xl shadow-xl border border-gray-100 hidden animate-slideIn">
                            <div class="p-4 border-b border-gray-100 text-center">
                                <img src="{{ auth()->user()->profile_photo ? asset('storage/' . auth()->user()->profile_photo) : asset('images/no.jpg') }}"
                                    alt="Avatar"
                                    class="w-10 h-10 rounded-full mx-auto object-cover border border-gray-200">
                                <p class="text-blue-500 font-semibold mt-2">{{ auth()->user()->name }}</p>
                            </div>

                            <!-- Formulaire : changer la photo -->
                            <form action="{{ route('profile.updatePhoto') }}" method="POST"
                                enctype="multipart/form-data"
                                class="p-4 flex flex-col space-y-3 hover:bg-gray-50 transition">
                                @csrf
                                <label
                                    class="text-xs uppercase font-semibold tracking-wide text-gray-500 flex items-center space-x-2 cursor-pointer">
                                    <ion-icon name="image-outline" class="text-blue-500 text-lg"></ion-icon>
                                    <span>Changer la photo</span>
                                </label>
                                <input type="file" name="profile_photo"
                                    class="file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100 cursor-pointer"
                                    required>
                                <button type="submit"
                                    class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg text-sm font-semibold transition">Mettre
                                    à jour</button>
                            </form>

                            <!-- Supprimer la photo -->
                            <form action="{{ route('profile.deletePhoto') }}" method="POST"
                                class="px-4 pb-4 flex flex-col items-center border-t border-gray-100">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full text-sm text-red-500 font-semibold py-2 rounded-lg hover:bg-red-50 transition flex items-center justify-center space-x-2">
                                    <ion-icon name="trash-outline" class="text-lg"></ion-icon>
                                    <span>Supprimer la photo</span>
                                </button>
                            </form>

                            <!-- Lien profil -->
                            <a href="{{ route('profile.edit') }}"
                                class="block text-center text-gray-700 font-medium py-3 border-t border-gray-100 hover:bg-gray-50 rounded-b-2xl transition">
                                <ion-icon name="person-circle-outline" class="text-blue-500 text-lg mr-1"></ion-icon>
                                Modifier le profil
                            </a>
                        </div>
                    </div>

                </div>
            </header>

            @yield('content')
        </main>
    </div>

    <!-- SCRIPTS -->
    <script>
        // éléments principaux
        const sidebar = document.getElementById('sidebar');
        const toggleSidebar = document.getElementById('toggleSidebar');
        const sidebarTitle = document.getElementById('sidebar-title');
        const textSpans = sidebar ? sidebar.querySelectorAll('nav span, nav h1, nav label') : [];

        // mobile burger / overlay logic (si tu as overlay and burger)
        const overlay = document.getElementById('overlay');
        const burgerBtn = document.getElementById('burgerBtn');

        // click sur icône (pour collapse/expand on large screens)
        toggleSidebar && toggleSidebar.addEventListener('click', (e) => {
            // Sur petit écran (mobile), ouvre/ferme la drawer plutôt que collapse
            if (window.innerWidth < 768) {
                sidebar.classList.toggle('open'); // controlled by CSS transform
                overlay && overlay.classList.toggle('hidden');
                return;
            }

            // Sur écran moyen/grand : toggle collapsed
            sidebar.classList.toggle('collapsed');

            // manage accessibility: hide title for collapsed, show when expanded
            if (sidebar.classList.contains('collapsed')) {
                sidebarTitle && (sidebarTitle.style.display = 'none');
                textSpans.forEach(el => el.style.display = 'none');
            } else {
                sidebarTitle && (sidebarTitle.style.display = '');
                textSpans.forEach(el => el.style.display = '');
            }

            // sidebar.classList.toggle("w-64");
            // sidebar.classList.toggle("w-25");
        });

        // burger button for mobile (if present)
        burgerBtn && burgerBtn.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            overlay && overlay.classList.toggle('hidden');
        });

        // close when clicking overlay
        overlay && overlay.addEventListener('click', () => {
            sidebar.classList.remove('open');
            overlay.classList.add('hidden');
        });

        // keep behavior on resize: if screen becomes large, ensure sidebar visible and not translated
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                // remove mobile transform classes
                sidebar && sidebar.classList.remove('open');
                overlay && overlay.classList.add('hidden');
            }
            // optionally: if very large and collapsed, keep collapsed
            // no action required here, user preference preserved
            // --- Dropdown utilisateur ---
            const dropdownButton = document.getElementById("dropdownButton");
            const dropdownMenu = document.getElementById("dropdownMenu");

            if (dropdownButton && dropdownMenu) {
                dropdownButton.addEventListener("click", (e) => {
                    e.stopPropagation(); // évite de fermer immédiatement le menu
                    dropdownMenu.classList.toggle("hidden");

                    // Ajoute animation quand il s'ouvre
                    if (!dropdownMenu.classList.contains("hidden")) {
                        dropdownMenu.classList.add("animate-slideIn");
                    }
                });

                // Ferme le menu quand on clique ailleurs
                document.addEventListener("click", (e) => {
                    if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                        dropdownMenu.classList.add("hidden");
                    }
                });
            }
        });
    </script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
