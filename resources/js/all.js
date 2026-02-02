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