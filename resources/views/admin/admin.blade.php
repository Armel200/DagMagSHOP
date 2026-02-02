<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - DacMagSHOP</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <style>
        /* Transition douce pour le repli */
        .transition-all {
            transition: all 0.3s ease;
        }

        /* largeur normale */
        #sidebar {
            width: 16rem;
        }

        /* w-64 ~ 256px */

        /* état "collapsed" pour grand écran */
        #sidebar.collapsed {
            width: 5.5rem;
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
            width: 36px;
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
        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-white shadow-md transition-all duration-300 flex flex-col h-screen">
            <!-- Logo et titre -->
            <div class="p-4 flex items-center justify-between border-b border-gray-200">
                <div
                    class="logo-wrapper border-2 border-amber-200 rounded-full w-14 h-14 flex items-center justify-center overflow-hidden">
                    <img src="{{ asset('images/logg.jpg') }}" alt="Logo" class="w-full h-full object-cover">
                </div>
                <h2 id="sidebar-title" class="text-lg lg:text-xl font-bold text-gray-800 ml-2">
                    DacMagSHOP
                </h2>
                <ion-icon id="toggleSidebar" name="swap-horizontal-outline" class="cursor-pointer text-2xl"></ion-icon>
            </div>

            <!-- Navigation principale -->
            <nav class="flex-1 px-4 py-6 flex flex-col justify-between">
                <div>
                    <!-- Section Marketing -->
                    <h3 class="text-gray-600 font-semibold mb-2 text-sm">MARKETING</h3>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('admin.dashboard') }}"
                                class="flex items-center gap-2 p-2 rounded transition-colors
                        {{ request()->routeIs('admin.dashboard') ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-blue-500 hover:text-white' }}">
                                <ion-icon name="grid-outline" class="text-xl"></ion-icon>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('list.product') }}"
                                class="flex items-center gap-2 p-2 rounded transition-colors
                        {{ request()->routeIs('list.product') ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-blue-500 hover:text-white' }}">
                                <ion-icon name="cart-outline" class="text-xl"></ion-icon>
                                <span>Products</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('orders.list') }}"
                                class="flex items-center gap-2 p-2 rounded transition-colors
                        {{ request()->routeIs('orders.list') ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-blue-500 hover:text-white' }}">
                                <ion-icon name="cart-outline" class="text-xl"></ion-icon>
                                <span>Orders</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('list.category') }}"
                                class="flex items-center gap-2 p-2 rounded transition-colors
                        {{ request()->routeIs('list.category') ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-blue-500 hover:text-white' }}">
                                <ion-icon name="layers-outline" class="text-xl"></ion-icon>
                                <span>Categories</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users') }}"
                                class="flex items-center gap-2 p-2 rounded transition-colors
                        {{ request()->routeIs('admin.users') ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-blue-500 hover:text-white' }}">
                                <ion-icon name="people-outline" class="text-xl"></ion-icon>
                                <span>Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center gap-2 p-2 rounded text-gray-700 hover:bg-blue-500 hover:text-white transition-colors">
                                <ion-icon name="mail-unread-outline" class="text-xl"></ion-icon>
                                <span>Inbox</span>
                            </a>
                        </li>
                         <li>
                            <a href="{{ route('admin.reviews') }}"
                                class="flex items-center gap-2 p-2 rounded transition-colors
                        {{ request()->routeIs('admin.reviews') ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-blue-500 hover:text-white' }}">
                                <ion-icon name="people-outline" class="text-xl"></ion-icon>
                                <span>Comment</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Section Système -->
                    <h3 class="text-gray-600 font-semibold mt-6 mb-2 text-sm">SYSTEME</h3>
                    <ul class="space-y-1">
                        <li>
                            <a href="#"
                                class="flex items-center gap-2 p-2 rounded text-gray-700 hover:bg-blue-500 hover:text-white transition-colors">
                                <ion-icon name="settings-outline" class="text-xl"></ion-icon>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li>
                            <label class="flex items-center gap-2 p-2 text-gray-700">
                                <input type="checkbox" id="dark-mode-toggle" class="mr-2">
                                Dark Mode
                            </label>
                        </li>
                    </ul>
                </div>

                <!-- Logout -->
                <ul class="mt-4">
                    <li>
                        <a href="{{ route('logout') }}"
                            class="flex items-center gap-2 p-2 rounded text-gray-700 hover:bg-blue-500 hover:text-white transition-colors">
                            <ion-icon name="log-out-outline" class="text-xl"></ion-icon>
                            <span>Log out</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>


        <!-- Main Content -->
        <main class="flex-1 p-6 overflow-y-auto transition-all">
            <header class="flex justify-between items-center mb-6 bg-gray-100  sticky">
                <h1 class="text-2xl font-semibold text-gray-800">Dashboard <span class="text-sm text-gray-500">Good
                        Morning, Admin</span></h1>
                <div class="flex items-center space-x-4">
                    <input type="text" placeholder=" Search..."
                        class="py-1 px-3 border rounded-full focus:outline-none ">
                    <div class="relative flex space-x-2">
                        <button><span class="flex"><ion-icon name="chatbubble-outline"
                                    class="text-[20px]"></ion-icon><sup
                                    class="bg-green-500 w-[13px] text-[10px] h-[13px] -ml-[6px] flex justify-center items-center rounded-full">4</sup></span></button>
                        <button><span class="flex"><ion-icon name="notifications-outline"
                                    class="text-[20px]"></ion-icon><sup
                                    class="bg-red-500 w-[13px] text-[10px] h-[13px] -ml-[6px] flex justify-center items-center rounded-full">3</sup></span></button>
                    </div>
                    <div class="relative">
                        <!-- Avatar et nom de l'utilisateur -->
                        <button id="dropdownButton" class="flex items-center space-x-2">
                            <img src="{{ auth()->user()->profile_photo ? asset('storage/' . auth()->user()->profile_photo) : asset('images/no.jpg') }}"
                                alt="Avatar" class="w-10 h-10 rounded-full">
                            <div class="flex flex-col text-left">
                                <span class="text-blue-500 font-semibold">{{ auth()->user()->name }}</span>
                                <span class="text-gray-600 text-sm">Admin Manager</span>
                            </div>
                            <ion-icon name="caret-down-outline" class="text-[20px] ml-2"></ion-icon>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="dropdownMenu"
                            class="absolute right-0 mt-3 w-64 bg-white rounded-2xl shadow-xl border border-gray-100 hidden z-50 animate-fadeIn">

                            <!-- Section photo -->
                            <div class="p-4 border-b border-gray-100 text-center">
                                <img src="{{ auth()->user()->profile_photo ? asset('storage/' . auth()->user()->profile_photo) : asset('images/no.jpg') }}"
                                    alt="Avatar" class="w-10 h-10 rounded-full">
                                <div class="flex flex-col text-left">
                                    <span class="text-blue-500 font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="text-gray-600 text-sm">Admin Manager</span>
                                </div>
                            </div>

                            <!-- Formulaire pour changer la photo -->
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

                            <!-- Formulaire pour supprimer la photo -->
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

                            <!-- Lien vers profil -->
                            <a href="{{ route('profile.edit') }}"
                                class="block text-center text-gray-700 font-medium py-3 border-t border-gray-100 hover:bg-gray-50 rounded-b-2xl transition">
                                <ion-icon name="person-circle-outline" class="text-blue-500 text-lg mr-1"></ion-icon>
                                Modifier le profil
                            </a>
                        </div>

                        <!-- Animation d’apparition -->
                        <style>
                            @keyframes fadeIn {
                                from {
                                    opacity: 0;
                                    transform: translateY(-10px);
                                }

                                to {
                                    opacity: 1;
                                    transform: translateY(0);
                                }
                            }

                            .animate-fadeIn {
                                animation: fadeIn 0.3s ease-out;
                            }
                        </style>

                    </div>

                </div>
            </header>

            @yield('content')
        </main>
    </div>

    <script>
        // éléments principaux
        const sidebar = document.getElementById('sidebar');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const dropdownButton = document.getElementById('dropdownButton');
        const toggleSidebar = document.getElementById('toggleSidebar');
        const sidebarTitle = document.getElementById('sidebar-title');
        const textSpans = sidebar ? sidebar.querySelectorAll('nav span, nav h1, nav label') : [];

        // mobile burger / overlay logic (si tu as overlay and burger)
        const overlay = document.getElementById('overlay');
        const burgerBtn = document.getElementById('burgerBtn');
         //profile dropdown
        dropdownButton.addEventListener("click", () => {
            dropdownMenu.classList.toggle("show");
            dropdownMenu.classList.toggle("hidden");
        });
        // document.addEventListener('click', () => {
        //     dropdownMenu.classList.add('hidden');
        // });

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
        });
    </script>


    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
