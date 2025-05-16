<!DOCTYPE html>
<html lang="es" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Bella Italia - MenuHub</title>
    <link rel="icon" type="image/svg" href="images/logo.svg">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                        },
                        accent: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<style>
    body {
            font-family: 'Montserrat', sans-serif;
        }
        .hero-gradient {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        }
        .nav-link {
            position: relative;
            font-weight: 500;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: #2563eb;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
</style>
<body class="bg-gray-50 dark:bg-gray-900">
    <!-- Navbar -->
    <nav class="bg-white dark:bg-gray-800 shadow-md fixed w-full z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="index.html" class="flex items-center space-x-3">
                        <span class="text-2xl font-bold text-primary-800 dark:text-white">Menu<span class="text-accent-600">Hub</span></span>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.html" class="nav-link text-primary-600 hover:text-primary-800 dark:text-white">Inicio</a>
                    <a href="restaurants.php" class="nav-link text-primary-600 hover:text-primary-800 dark:text-white">Restaurantes</a>
                    <a href="reseñas.php" class="nav-link text-primary-600 hover:text-primary-800 dark:text-white">Reseñas</a>
                    <a href="#contact" class="nav-link text-primary-600 hover:text-primary-800 dark:text-white">Contacto</a>
                    <a href="cart.php" class="nav-link text-primary-600 hover:text-primary-800 dark:text-white">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="ml-2">Carrito</span>
                    </a>
                    <a href="login.php" class="px-6 py-3 rounded-full bg-accent-600 text-white hover:bg-accent-700 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                        Iniciar Sesión
                    </a>
                </div>
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="text-primary-600 hover:text-primary-800 focus:outline-none dark:text-white">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
            <div class="px-4 py-2 space-y-3">
                <a href="index.html" class="block py-2 text-primary-600 hover:text-primary-800 dark:text-white">Inicio</a>
                <a href="restaurants.php" class="block py-2 text-primary-600 hover:text-primary-800 dark:text-white">Restaurantes</a>
                <a href="reseñas.php" class="block py-2 text-primary-600 hover:text-primary-800 dark:text-white">Reseñas</a>
                <a href="#contact" class="block py-2 text-primary-600 hover:text-primary-800 dark:text-white">Contacto</a>
                <a href="cart.php" class="block py-2 text-primary-600 hover:text-primary-800 dark:text-white">
                    Carrito (3)
                </a>
                <div class="space-y-2 pt-2">
                    <a href="login.php" class="block w-full text-center px-4 py-2 bg-accent-600 text-white rounded-full hover:bg-accent-700">
                        Iniciar Sesión
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-24 pb-20">
        <!-- Restaurant Header -->
        <div class="relative h-96">
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4" 
                     alt="La Bella Italia"
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/75 to-transparent"></div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 p-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-end">
                        <div>
                            <h1 class="text-4xl font-bold text-white mb-2">La Bella Italia</h1>
                            <div class="flex items-center space-x-4 text-white">
                                <span class="flex items-center">
                                    <i class="fas fa-utensils mr-2"></i>
                                    Italiana
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-dollar-sign mr-2"></i>
                                    $$
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-star text-yellow-400 mr-2"></i>
                                    4.8
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Restaurant Info -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                    <h3 class="text-lg font-semibold text-primary-800 dark:text-white mb-4">
                        <i class="fas fa-clock mr-2 text-accent-600"></i>
                        Horario
                    </h3>
                    <p class="text-primary-600 dark:text-gray-300">
                        12:00 - 23:00
                    </p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                    <h3 class="text-lg font-semibold text-primary-800 dark:text-white mb-4">
                        <i class="fas fa-map-marker-alt mr-2 text-accent-600"></i>
                        Ubicación
                    </h3>
                    <p class="text-primary-600 dark:text-gray-300">
                        Calle Principal 123, Centro
                    </p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                    <h3 class="text-lg font-semibold text-primary-800 dark:text-white mb-4">
                        <i class="fas fa-info-circle mr-2 text-accent-600"></i>
                        Información
                    </h3>
                    <p class="text-primary-600 dark:text-gray-300">
                        Auténtica cocina italiana con pasta fresca hecha a mano y pizzas horneadas en horno de leña.
                    </p>
                </div>
            </div>

            <!-- Menu -->
            <div class="space-y-12">
                <!-- Entradas -->
                <div>
                    <h2 class="text-2xl font-bold text-primary-800 dark:text-white mb-6">Entradas</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Menu Item -->
                        <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <img src="https://images.unsplash.com/photo-1572695157366-5e585ab2b69f" 
                                 alt="Bruschetta"
                                 class="w-full h-48 object-cover">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-lg font-semibold text-primary-800 dark:text-white">
                                        Bruschetta
                                    </h3>
                                    <span class="text-accent-600 font-semibold">
                                        $8.99
                                    </span>
                                </div>
                                <p class="text-primary-600 dark:text-gray-300 mb-4">
                                    Pan tostado con tomates, ajo, albahaca y aceite de oliva
                                </p>
                                <button class="w-full px-4 py-2 bg-accent-600 text-white rounded-lg hover:bg-accent-700 transition duration-300 transform hover:scale-105">
                                    <i class="fas fa-plus mr-2"></i>
                                    <span class="add-to-cart-text">Agregar al Carrito</span>
                                    <span class="adding-to-cart-text hidden">Agregando...</span>
                                </button>
                            </div>
                        </div>

                        <!-- Menu Item -->
                        <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <img src="https://images.unsplash.com/photo-1559410545-0bdcd187e0a6" 
                                 alt="Carpaccio"
                                 class="w-full h-48 object-cover">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-lg font-semibold text-primary-800 dark:text-white">
                                        Carpaccio
                                    </h3>
                                    <span class="text-accent-600 font-semibold">
                                        $12.99
                                    </span>
                                </div>
                                <p class="text-primary-600 dark:text-gray-300 mb-4">
                                    Finas láminas de res con rúcula y parmesano
                                </p>
                                <button class="w-full px-4 py-2 bg-accent-600 text-white rounded-lg hover:bg-accent-700 transition duration-300 transform hover:scale-105">
                                    <i class="fas fa-plus mr-2"></i>
                                    <span class="add-to-cart-text">Agregar al Carrito</span>
                                    <span class="adding-to-cart-text hidden">Agregando...</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pastas -->
                <div>
                    <h2 class="text-2xl font-bold text-primary-800 dark:text-white mb-6">Pastas</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Menu Item -->
                        <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <img src="https://images.unsplash.com/photo-1612874742237-6526221588e3" 
                                 alt="Spaghetti Carbonara"
                                 class="w-full h-48 object-cover">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-lg font-semibold text-primary-800 dark:text-white">
                                        Spaghetti Carbonara
                                    </h3>
                                    <span class="text-accent-600 font-semibold">
                                        $16.99
                                    </span>
                                </div>
                                <p class="text-primary-600 dark:text-gray-300 mb-4">
                                    Pasta con huevo, queso pecorino, panceta y pimienta negra
                                </p>
                                <button class="w-full px-4 py-2 bg-accent-600 text-white rounded-lg hover:bg-accent-700 transition duration-300 transform hover:scale-105">
                                    <i class="fas fa-plus mr-2"></i>
                                    <span class="add-to-cart-text">Agregar al Carrito</span>
                                    <span class="adding-to-cart-text hidden">Agregando...</span>
                                </button>
                            </div>
                        </div>

                        <!-- Menu Item -->
                        <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <img src="https://images.unsplash.com/photo-1645112411341-6c4fd023402d" 
                                 alt="Fettuccine Alfredo"
                                 class="w-full h-48 object-cover">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-lg font-semibold text-primary-800 dark:text-white">
                                        Fettuccine Alfredo
                                    </h3>
                                    <span class="text-accent-600 font-semibold">
                                        $15.99
                                    </span>
                                </div>
                                <p class="text-primary-600 dark:text-gray-300 mb-4">
                                    Pasta en salsa cremosa de queso parmesano
                                </p>
                                <button class="w-full px-4 py-2 bg-accent-600 text-white rounded-lg hover:bg-accent-700 transition duration-300 transform hover:scale-105">
                                    <i class="fas fa-plus mr-2"></i>
                                    <span class="add-to-cart-text">Agregar al Carrito</span>
                                    <span class="adding-to-cart-text hidden">Agregando...</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pizzas -->
                <div>
                    <h2 class="text-2xl font-bold text-primary-800 dark:text-white mb-6">Pizzas</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Menu Item -->
                        <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <img src="https://images.unsplash.com/photo-1604068549290-dea0e4a305ca" 
                                 alt="Margherita"
                                 class="w-full h-48 object-cover">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-lg font-semibold text-primary-800 dark:text-white">
                                        Margherita
                                    </h3>
                                    <span class="text-accent-600 font-semibold">
                                        $14.99
                                    </span>
                                </div>
                                <p class="text-primary-600 dark:text-gray-300 mb-4">
                                    Salsa de tomate, mozzarella fresca y albahaca
                                </p>
                                <button class="w-full px-4 py-2 bg-accent-600 text-white rounded-lg hover:bg-accent-700 transition duration-300 transform hover:scale-105">
                                    <i class="fas fa-plus mr-2"></i>
                                    <span class="add-to-cart-text">Agregar al Carrito</span>
                                    <span class="adding-to-cart-text hidden">Agregando...</span>
                                </button>
                            </div>
                        </div>

                        <!-- Menu Item -->
                        <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591" 
                                 alt="Quattro Formaggi"
                                 class="w-full h-48 object-cover">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-lg font-semibold text-primary-800 dark:text-white">
                                        Quattro Formaggi
                                    </h3>
                                    <span class="text-accent-600 font-semibold">
                                        $17.99
                                    </span>
                                </div>
                                <p class="text-primary-600 dark:text-gray-300 mb-4">
                                    Mozzarella, gorgonzola, parmesano y fontina
                                </p>
                                <button class="w-full px-4 py-2 bg-accent-600 text-white rounded-lg hover:bg-accent-700 transition duration-300 transform hover:scale-105">
                                    <i class="fas fa-plus mr-2"></i>
                                    <span class="add-to-cart-text">Agregar al Carrito</span>
                                    <span class="adding-to-cart-text hidden">Agregando...</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Enhanced Footer -->
    <footer class="bg-primary-900 text-white pt-20 pb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <div class="space-y-6">
                    <div class="flex items-center space-x-3">
                        <span class="text-2xl font-bold">Menu<span class="text-accent-400">Hub</span></span>
                    </div>
                    <p class="text-gray-400">
                        Tu plataforma de confianza para ordenar comida de los mejores restaurantes locales.
                    </p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-6">Informacion</h4>
                    <ul class="space-y-4">
                        <li><a href="#about" class="text-gray-400 hover:text-accent-400 transition duration-300">Sobre Nosotros</a></li>
                        <li><a href="#team" class="text-gray-400 hover:text-accent-400 transition duration-300">Nuestro Equipo</a></li>
                        <li><a href="instructivo.php" class="text-gray-400 hover:text-accent-400 transition duration-300">¿Como pedir?</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-accent-400 transition duration-300">Contacto</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-6">Servicios</h4>
                    <ul class="space-y-4">
                        <li><a href="restaurant.php" class="text-gray-400 hover:text-accent-400 transition duration-300">Pedidos Online</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-accent-400 transition duration-300">Vista de menus</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-accent-400 transition duration-300">Contacto directo</a></li>
                        <li><a href="testimonios.html" class="text-gray-400 hover:text-accent-400 transition duration-300">Testimonios</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-6">Juegos</h4>
                    <ul class="space-y-4">
                        <li><a href="juegos/1.html" class="text-gray-400 hover:text-accent-400 transition duration-300">Memoria</a></li>
                        <li><a href="juegos/2.html" class="text-gray-400 hover:text-accent-400 transition duration-300">Serpiente</a></li>
                        <li><a href="juegos/3.html" class="text-gray-400 hover:text-accent-400 transition duration-300">El topo</a></li>
                        <li><a href="juegos/4.html" class="text-gray-400 hover:text-accent-400 transition duration-300">Adivina el numero</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-primary-800 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm">
                        &copy; 2025 MenuHub. Todos los derechos reservados.
                    </p>
                </div>
            </div>
        </div>
    </footer>


    <!-- Back to Top Button -->
    <button id="backToTop" class="fixed bottom-8 right-8 bg-accent-600 text-white p-4 rounded-full shadow-lg hidden hover:bg-accent-700 transition duration-300 transform hover:scale-110">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        // Theme toggle functionality
        const html = document.documentElement;
        const themeToggle = document.getElementById('theme-toggle');

        if (themeToggle) {
            // Check for saved theme preference or use system preference
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                html.classList.add('dark');
            } else {
                html.classList.remove('dark');
            }

            // Toggle theme
            themeToggle.addEventListener('click', () => {
                html.classList.toggle('dark');
                localStorage.theme = html.classList.contains('dark') ? 'dark' : 'light';
            });
        }

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Back to top button
        const backToTop = document.getElementById('backToTop');
        
        if (backToTop) {
            window.addEventListener('scroll', () => {
                if (window.pageYOffset > 300) {
                    backToTop.classList.remove('hidden');
                } else {
                    backToTop.classList.add('hidden');
                }
            });

            backToTop.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }

        // Cart functionality
        const addToCartButtons = document.querySelectorAll('button');
        addToCartButtons.forEach(button => {
            button.addEventListener('click', async () => {
                const addText = button.querySelector('.add-to-cart-text');
                const loadingText = button.querySelector('.adding-to-cart-text');
                
                if (addText && loadingText) {
                    // Disable button and show loading state
                    button.disabled = true;
                    addText.classList.add('hidden');
                    loadingText.classList.remove('hidden');

                    // Simulate API call
                    setTimeout(() => {
                        // Show success message
                        const toast = document.createElement('div');
                        toast.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform transition-transform duration-300';
                        toast.textContent = 'Producto agregado al carrito';
                        document.body.appendChild(toast);

                        // Remove toast after 3 seconds
                        setTimeout(() => {
                            toast.style.transform = 'translateX(150%)';
                            setTimeout(() => toast.remove(), 300);
                        }, 3000);

                        // Reset button state
                        button.disabled = false;
                        addText.classList.remove('hidden');
                        loadingText.classList.add('hidden');
                    }, 1000);
                }
            });
        });
    </script>
</body>
</html>
