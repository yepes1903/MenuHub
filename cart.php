<?php
session_start();
include("connection.php");

// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle cart updates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'update':
                if (isset($_POST['item_id']) && isset($_POST['quantity'])) {
                    foreach ($_SESSION['cart'] as &$item) {
                        if ($item['id'] == $_POST['item_id']) {
                            $item['quantity'] = max(0, (int)$_POST['quantity']);
                            break;
                        }
                    }
                    // Remove items with quantity 0
                    $_SESSION['cart'] = array_filter($_SESSION['cart'], function($item) {
                        return $item['quantity'] > 0;
                    });
                }
                break;
            case 'clear':
                $_SESSION['cart'] = [];
                break;
        }
        header('Location: cart.php');
        exit;
    }
}

// Calculate cart totals
$total_items = 0;
$subtotal = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_items += $item['quantity'];
    $subtotal += $item['price'] * $item['quantity'];
}

$tax = $subtotal * 0.16; // 16% tax
$total = $subtotal + $tax;
?>

<!DOCTYPE html>
<html lang="es" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito - MenuHub</title>
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
<body class="bg-gray-50 dark:bg-gray-900">
    <!-- Theme Toggle Button -->
    <button id="theme-toggle" class="fixed top-6 right-6 z-50 p-3 rounded-full bg-white dark:bg-gray-800 shadow-lg" title="Toggle theme">
        <i class="fas fa-sun text-xl text-yellow-500 dark:hidden"></i>
        <i class="fas fa-moon text-xl text-gray-400 hidden dark:block"></i>
    </button>

    <!-- Navbar -->
    <nav class="bg-white dark:bg-gray-800 shadow-md fixed w-full z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="index.html" class="flex items-center space-x-3">
                        <img src="images/logo.svg" alt="MenuHub Logo" class="h-10 w-auto">
                        <span class="text-2xl font-bold text-primary-800 dark:text-white">Menu<span class="text-accent-600">Hub</span></span>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.php" class="nav-link text-primary-600 hover:text-primary-800 dark:text-white">Inicio</a>
                    <a href="restaurants.php" class="nav-link text-primary-600 hover:text-primary-800 dark:text-white">Restaurantes</a>
                    <a href="reseñas.php" class="nav-link text-primary-600 hover:text-primary-800 dark:text-white">Reseñas</a>
                    <a href="#contact" class="nav-link text-primary-600 hover:text-primary-800 dark:text-white">Contacto</a>
                    <a href="login.php" class="px-6 py-3 rounded-full bg-accent-600 text-white hover:bg-accent-700 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                        Iniciar Sesión
                    </a>
                    <a href="register.php" class="px-6 py-3 rounded-full border-2 border-accent-600 text-accent-600 hover:bg-accent-50 transition-all duration-300 transform hover:scale-105 hover:shadow-xl dark:text-white dark:hover:bg-accent-600">
                        Registrarse
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
                <a href="index.php" class="block py-2 text-primary-600 hover:text-primary-800 dark:text-white">Inicio</a>
                <a href="restaurants.php" class="block py-2 text-primary-600 hover:text-primary-800 dark:text-white">Restaurantes</a>
                <a href="reseñas.php" class="block py-2 text-primary-600 hover:text-primary-800 dark:text-white">Reseñas</a>
                <a href="#contact" class="block py-2 text-primary-600 hover:text-primary-800 dark:text-white">Contacto</a>
                <div class="space-y-2 pt-2">
                    <a href="login.php" class="block w-full text-center px-4 py-2 bg-accent-600 text-white rounded-full hover:bg-accent-700">
                        Iniciar Sesión
                    </a>
                    <a href="register.php" class="block w-full text-center px-4 py-2 border-2 border-accent-600 text-accent-600 rounded-full hover:bg-accent-50 dark:text-white dark:hover:bg-accent-600">
                        Registrarse
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-24 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-primary-800 dark:text-white mb-8">Tu Carrito</h1>

            <?php if (empty($_SESSION['cart'])): ?>
                <div class="bg-white dark:bg-gray-800 rounded-xl p-8 text-center shadow-lg">
                    <i class="fas fa-shopping-cart text-6xl text-gray-300 dark:text-gray-600 mb-4"></i>
                    <h2 class="text-xl font-semibold text-primary-800 dark:text-white mb-4">Tu carrito está vacío</h2>
                    <p class="text-primary-600 dark:text-gray-300 mb-6">¿Qué tal si exploras nuestros deliciosos platillos?</p>
                    <a href="restaurants.php" class="inline-block px-6 py-3 bg-accent-600 text-white rounded-full hover:bg-accent-700 transition duration-300 transform hover:scale-105">
                        Ver Restaurantes
                    </a>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Cart Items -->
                    <div class="lg:col-span-2 space-y-4">
                        <?php foreach ($_SESSION['cart'] as $item): ?>
                            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-primary-800 dark:text-white">
                                            <?php echo htmlspecialchars($item['name']); ?>
                                        </h3>
                                        <p class="text-accent-600 font-semibold">
                                            $<?php echo number_format($item['price'], 2); ?>
                                        </p>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <form method="POST" class="flex items-center space-x-2">
                                            <input type="hidden" name="action" value="update">
                                            <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                                            <button type="submit" name="quantity" value="<?php echo max(0, $item['quantity'] - 1); ?>" 
                                                class="w-8 h-8 flex items-center justify-center rounded-full border-2 border-accent-600 text-accent-600 hover:bg-accent-50">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <span class="text-primary-800 dark:text-white font-semibold">
                                                <?php echo $item['quantity']; ?>
                                            </span>
                                            <button type="submit" name="quantity" value="<?php echo $item['quantity'] + 1; ?>"
                                                class="w-8 h-8 flex items-center justify-center rounded-full border-2 border-accent-600 text-accent-600 hover:bg-accent-50">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </form>
                                        <p class="text-primary-800 dark:text-white font-semibold">
                                            $<?php echo number_format($item['price'] * $item['quantity'], 2); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg sticky top-24">
                            <h2 class="text-xl font-semibold text-primary-800 dark:text-white mb-6">Resumen del Pedido</h2>
                            <div class="space-y-4">
                                <div class="flex justify-between text-primary-600 dark:text-gray-300">
                                    <span>Subtotal</span>
                                    <span>$<?php echo number_format($subtotal, 2); ?></span>
                                </div>
                                <div class="flex justify-between text-primary-600 dark:text-gray-300">
                                    <span>IVA (16%)</span>
                                    <span>$<?php echo number_format($tax, 2); ?></span>
                                </div>
                                <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                    <div class="flex justify-between text-lg font-semibold text-primary-800 dark:text-white">
                                        <span>Total</span>
                                        <span>$<?php echo number_format($total, 2); ?></span>
                                    </div>
                                </div>
                                <button class="w-full px-6 py-3 bg-accent-600 text-white rounded-xl hover:bg-accent-700 transition duration-300 transform hover:scale-105">
                                    Proceder al Pago
                                </button>
                                <form method="POST" class="mt-4">
                                    <input type="hidden" name="action" value="clear">
                                    <button type="submit" class="w-full px-6 py-3 border-2 border-red-500 text-red-500 rounded-xl hover:bg-red-50 transition duration-300">
                                        Vaciar Carrito
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <!-- Footer -->
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
                    <h4 class="text-lg font-semibold mb-6">Enlaces</h4>
                    <ul class="space-y-4">
                        <li><a href="index.php" class="text-gray-400 hover:text-accent-400 transition duration-300">Inicio</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-accent-400 transition duration-300">Servicios</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-accent-400 transition duration-300">Proyectos</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-accent-400 transition duration-300">Contacto</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-6">Legal</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-400 hover:text-accent-400 transition duration-300">Términos</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-accent-400 transition duration-300">Privacidad</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-accent-400 transition duration-300">Cookies</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-6">Redes Sociales</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-accent-400 transition duration-300">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-accent-400 transition duration-300">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-accent-400 transition duration-300">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-accent-400 transition duration-300">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-primary-800 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm">
                        &copy; 2024 MenuHub. Todos los derechos reservados.
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
    </script>
</body>
</html>
