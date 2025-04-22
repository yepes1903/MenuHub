<?php
include 'connection.php';

$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_review'])) {
    $product_name = $conn->real_escape_string($_POST['product_name']);
    $reviewer_name = $conn->real_escape_string($_POST['reviewer_name']);
    $rating = (int)$_POST['rating'];
    $comment = $conn->real_escape_string($_POST['comment']);

    // Handle file upload
    $image_path = null;
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $tmp_name = $_FILES['product_image']['tmp_name'];
        $filename = basename($_FILES['product_image']['name']);
        $target_file = $upload_dir . uniqid() . '_' . $filename;
        if (move_uploaded_file($tmp_name, $target_file)) {
            $image_path = $conn->real_escape_string($target_file);
        }
    }

    if ($product_name && $reviewer_name && $rating >= 1 && $rating <= 5 && $comment) {
        $sql = "INSERT INTO product_reviews (product_name, reviewer_name, rating, comment, image) VALUES ('$product_name', '$reviewer_name', $rating, '$comment', " . ($image_path ? "'$image_path'" : "NULL") . ")";
        if ($conn->query($sql) === TRUE) {
            $message = '<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">Reseña enviada con éxito.</div>';
        } else {
            $message = '<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">Error al enviar la reseña: ' . $conn->error . '</div>';
        }
    } else {
        $message = '<div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6" role="alert">Por favor, complete todos los campos correctamente.</div>';
    }
}

// Fetch existing reviews
$reviews = [];
$result = $conn->query("SELECT product_name, reviewer_name, rating, comment, image, created_at FROM product_reviews ORDER BY created_at DESC");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="es" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reseñas - MenuHub</title>
    <link rel="icon" type="image/png" href="images/logo.png">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 dark:bg-gray-900">
 <!-- Navbar -->
 <nav class="bg-white dark:bg-gray-800 shadow-md fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="#" class="flex items-center space-x-3">
                        <span class="text-2xl font-bold text-primary-800 dark:text-white">Menu<span class="text-accent-600">Hub</span></span>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.php" class="nav-link text-primary-600 hover:text-primary-800 dark:text-white">Inicio</a>
                    <a href="index.php" class="nav-link text-primary-600 hover:text-primary-800 dark:text-white">Nosotros</a>
                    <a href="index.php" class="nav-link text-primary-600 hover:text-primary-800 dark:text-white">Equipo</a>
                    <a href="reseñas.php" class="nav-link text-primary-600 hover:text-primary-800 dark:text-white">Reseñas</a>
                    <a href="login.php" class="px-6 py-3 rounded-full bg-accent-600 text-white hover:bg-accent-700 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                        Iniciar Sesión
                    </a>
                    <a href="signup.php" class="px-6 py-3 rounded-full border-2 border-accent-600 text-accent-600 hover:bg-accent-50 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                        Registrarse
                    </a>
                </div>
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="text-primary-600 hover:text-primary-800 focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
            <div class="px-4 py-2 space-y-3">
                <a href="index.php" class="block py-2 text-primary-600 hover:text-primary-800 dark:text-white">Inicio</a>
                <a href="reseñas.php" class="block py-2 text-primary-600 hover:text-primary-800 dark:text-white">Reseñas</a>
                <a href="productos.php" class="block py-2 text-primary-600 hover:text-primary-800 dark:text-white">Productos</a>
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
            <!-- Review Form Section -->
            <section class="mb-16">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8">
                    <h2 class="text-3xl font-bold text-primary-800 dark:text-white mb-8 text-center">Formulario de Reseñas</h2>
                    <?php echo $message; ?>
                    <form method="POST" action="reseñas.php" enctype="multipart/form-data" class="space-y-6">
                        <div>
                            <label for="product_name" class="block text-sm font-medium text-primary-600 dark:text-gray-300 mb-2">
                                Nombre del Producto
                            </label>
                            <input type="text" id="product_name" name="product_name" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-accent-500">
                        </div>

                        <div>
                            <label for="reviewer_name" class="block text-sm font-medium text-primary-600 dark:text-gray-300 mb-2">
                                Tu Nombre
                            </label>
                            <input type="text" id="reviewer_name" name="reviewer_name" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-accent-500">
                        </div>

                        <div>
                            <label for="rating" class="block text-sm font-medium text-primary-600 dark:text-gray-300 mb-2">
                                Calificación
                            </label>
                            <select id="rating" name="rating" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-accent-500">
                                <option value="" selected disabled>Selecciona una calificación</option>
                                <option value="1">1 - Muy malo</option>
                                <option value="2">2 - Malo</option>
                                <option value="3">3 - Regular</option>
                                <option value="4">4 - Bueno</option>
                                <option value="5">5 - Excelente</option>
                            </select>
                        </div>

                        <div>
                            <label for="comment" class="block text-sm font-medium text-primary-600 dark:text-gray-300 mb-2">
                                Comentario
                            </label>
                            <textarea id="comment" name="comment" rows="4" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-accent-500"></textarea>
                        </div>

                        <div>
                            <label for="product_image" class="block text-sm font-medium text-primary-600 dark:text-gray-300 mb-2">
                                Imagen del Producto
                            </label>
                            <input type="file" id="product_image" name="product_image" accept="image/*"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-accent-500">
                        </div>

                        <button type="submit" name="submit_review"
                            class="w-full px-6 py-3 bg-accent-600 text-white rounded-xl hover:bg-accent-700 transition duration-300 transform hover:scale-105">
                            Enviar Reseña
                        </button>
                    </form>
                </div>
            </section>

            <!-- Reviews Section -->
            <section>
                <h3 class="text-2xl font-bold text-primary-800 dark:text-white mb-8 text-center">Reseñas Anteriores</h3>
                <?php if (count($reviews) > 0): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <?php foreach ($reviews as $review): ?>
                            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="flex items-center mb-4">
                                    <div>
                                        <h4 class="text-lg font-semibold text-primary-800 dark:text-white">
                                            <?php echo htmlspecialchars($review['product_name']); ?>
                                        </h4>
                                        <p class="text-primary-600 dark:text-gray-400">
                                            Por <?php echo htmlspecialchars($review['reviewer_name']); ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="flex text-yellow-400">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <?php if ($i <= $review['rating']): ?>
                                                <i class="fas fa-star"></i>
                                            <?php else: ?>
                                                <i class="far fa-star"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                                <?php if (!empty($review['image'])): ?>
                                    <img src="<?php echo htmlspecialchars($review['image']); ?>" 
                                         alt="Imagen del producto" 
                                         class="w-full h-48 object-cover rounded-xl mb-4">
                                <?php endif; ?>
                                <p class="text-primary-600 dark:text-gray-300 mb-4">
                                    <?php echo nl2br(htmlspecialchars($review['comment'])); ?>
                                </p>
                                <div class="text-sm text-primary-500 dark:text-gray-400">
                                    <?php echo date('d/m/Y H:i', strtotime($review['created_at'])); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-center text-primary-600 dark:text-gray-300">No hay reseñas aún.</p>
                <?php endif; ?>
            </section>
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
                        <li><a href="#" class="text-gray-400 hover:text-accent-400 transition duration-300">Pedidos Online</a></li>
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
    </script>
</body>
</html>
