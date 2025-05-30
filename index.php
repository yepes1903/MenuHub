<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index - MenuHub</title>
    <link rel="icon" type="image/png" href="images/logo.png">
    <!-- Tailwind CSS -->
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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
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
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .team-member-img {
            transition: all 0.3s ease;
        }
        .team-member:hover .team-member-img {
            transform: scale(1.05);
        }
        .social-icon {
            transition: all 0.3s ease;
        }
        .social-icon:hover {
            transform: translateY(-5px);
            color: #2563eb;
        }
        .music-section {
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            color: white;
            padding: 60px 20px;
            border-radius: 20px;
            margin: 50px auto;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            max-width: 700px;
        }

        .music-content h2 {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .music-content p {
            font-size: 16px;
            margin-bottom: 30px;
        }

        .music-player {
            width: 100%;
            max-width: 500px;
            outline: none;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(255, 255, 255, 0.2);
        }
        .games-section {
            max-width: 1000px;
            margin: 80px auto;
            padding: 40px 20px;
            border-radius: 20px;
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .games-section h2 {
            font-size: 26px;
            font-weight: 600;
            color: rgb(255, 255, 255);
            margin-bottom: 30px;
        }

        .games-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
        }

        .game-card {
            display: block;
            padding: 20px;
            background: #fff;
            border-radius: 16px;
            text-decoration: none;
            color: #3b82f6;
            font-weight: bold;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .game-card:hover {
            background: #3b82f6;
            color: #fff;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.86);
        }
    </style>
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
                    <a href="#about" class="nav-link text-primary-600 hover:text-primary-800 dark:text-white">Nosotros</a>
                    <a href="#team" class="nav-link text-primary-600 hover:text-primary-800 dark:text-white">Equipo</a>
                    <a href="maps.php" class="nav-link text-primary-600 hover:text-primary-800 dark:text-white">Maps</a>
                    <a href="#contact" class="nav-link text-primary-600 hover:text-primary-800 dark:text-white">Contacto</a>
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
        <div id="mobile-menu" class="hidden md:hidden bg-white dark:bg-gray-800 border-t border-gray-200">
            <div class="px-4 py-2 space-y-3">
                <a href="index.php" class="block py-2 text-primary-600 hover:text-primary-800 dark:text-white">Inicio</a>
                <a href="#about" class="block py-2 text-primary-600 hover:text-primary-800 dark:text-white">Nosotros</a>
                <a href="#team" class="block py-2 text-primary-600 hover:text-primary-800 dark:text-white">Equipo</a>
                <a href="#maps-section" class="block py-2 text-primary-600 hover:text-primary-800 dark:text-white">Maps</a>
                <a href="#contact" class="block py-2 text-primary-600 hover:text-primary-800 dark:text-white">Contacto</a>
                <a href="reseñas.php" class="block py-2 text-primary-600 hover:text-primary-800 dark:text-white">Reseñas</a>
                <div class="space-y-2 pt-2">
                    <a href="login.php" class="block w-full text-center px-4 py-2 bg-accent-600 text-white rounded-full hover:bg-accent-700">
                        Iniciar Sesión
                    </a>
                    <a href="signup.php" class="block w-full text-center px-4 py-2 border-2 border-accent-600 text-accent-600 rounded-full hover:bg-accent-50">
                        Registrarse
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-gradient pt-32 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="md:w-1/2 text-white" data-aos="fade-right">
                    <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6">
                        La mejor forma de ordenar comida en Medallo
                    </h1>
                    <p class="text-lg mb-8 opacity-90">
                        Conectamos los mejores restaurantes locales contigo. Ordena fácilmente y disfruta de la mejor comida.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#restaurants" class="px-8 py-4 rounded-full bg-white text-accent-600 hover:bg-gray-100 transition duration-300 transform hover:scale-105 shadow-lg">
                            Explorar Restaurantes y locales
                        </a>
                        <a href="#about" class="px-8 py-4 rounded-full border-2 border-white text-white hover:bg-white hover:text-accent-600 transition duration-300 transform hover:scale-105">
                            Conoce más
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2 mt-12 md:mt-0" data-aos="fade-left">
                    <img src="images/Astor.jpeg" alt="Hero Image" class="rounded-2xl shadow-2xl transform hover:scale-105 transition duration-500">
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-primary-800 mb-4" data-aos="fade-up">Nuestra Historia</h2>
                <p class="text-lg text-primary-600 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Desde 2024, hemos estado conectando personas con sus restaurantes y locales favoritos a la hora de comprar, haciendo que ordenar comida o productos sea una experiencia simple pero llena de diversion.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="bg-accent-100 rounded-full p-6 w-20 h-20 mx-auto mb-6 flex items-center justify-center">
                        <i class="fas fa-rocket text-3xl text-accent-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-primary-800 mb-4">Nuestra Misión</h3>
                    <p class="text-primary-600">
                        Facilitar el acceso a la compra local, conectando personas con sus restaurantes y locales favoritos de manera eficiente.
                    </p>
                </div>
                <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="bg-accent-100 rounded-full p-6 w-20 h-20 mx-auto mb-6 flex items-center justify-center">
                        <i class="fas fa-eye text-3xl text-accent-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-primary-800 mb-4">Nuestra Visión</h3>
                    <p class="text-primary-600">
                        Ser la plataforma líder en pedidos de comida, reconocida por nuestra calidad, creatividad y servicio excepcional.
                    </p>
                </div>
                <div class="text-center" data-aos="fade-up" data-aos-delay="400">
                    <div class="bg-accent-100 rounded-full p-6 w-20 h-20 mx-auto mb-6 flex items-center justify-center">
                        <i class="fas fa-heart text-3xl text-accent-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-primary-800 mb-4">Nuestros Valores</h3>
                    <p class="text-primary-600">
                        Calidad, innovación, compromiso con el cliente y pasión por la excelencia en todo lo que hacemos.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="music-section" id="musica">
        <div class="music-content" data-aos="fade-up" data-aos-delay="100" >
            <h2 data-aos="fade-up" data-aos-delay="100">¿Te gusta la música?</h2>
            <p data-aos="fade-up" data-aos-delay="100" >Aquí también puedes escuchar música si deseas relajarte mientras exploras MenuHub 🎧</p>
            <a data-aos="fade-up" data-aos-delay="100" href="player/index.html" class="px-8 py-4 rounded-full border-2 border-white text-white hover:bg-white hover:text-accent-600 transition duration-300 transform hover:scale-105">
                Ir al player
            </a>
        </div>
    </section>

    <!-- Team Section -->
    <section id="team" class="py-20 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-primary-800 mb-4" data-aos="fade-up">Nuestro Equipo</h2>
                <p class="text-lg text-primary-600 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Conoce al equipo apasionado detrás de MenuHub
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="team-member text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative mb-6 overflow-hidden rounded-2xl">
                        <img src="images/mateo.jpg" alt="Team Member" class="w-full team-member-img">
                    </div>
                    <h3 class="text-xl font-semibold text-primary-800 mb-2">Mateo Yepes Rojas</h3>
                    <p class="text-accent-600 mb-4">Fundador y desarrollador front end y backend de lo que se lleva de la app</p>
                    <p class="text-primary-600 mb-4">
                        Experto en idiomas y en diseño.
                    </p>
                    <div class="flex justify-center space-x-4">
                        <a href="#" class="social-icon text-primary-600 hover:text-accent-600">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="social-icon text-primary-600 hover:text-accent-600">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                    </div>
                </div>
                <div class="team-member text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative mb-6 overflow-hidden rounded-2xl">
                        <img src="images/chimbi.jpg" alt="Team Member" class="w-full team-member-img">
                    </div>
                    <h3 class="text-xl font-semibold text-primary-800 mb-2">Juan Felipe Jimenez</h3>
                    <p class="text-accent-600 mb-4">Desarrollador backend y documentacion</p>
                    <p class="text-primary-600 mb-4">
                        Especialista en bases de datos y estructuracion de paginas.
                    </p>
                    <div class="flex justify-center space-x-4">
                        <a href="#" class="social-icon text-primary-600 hover:text-accent-600">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="social-icon text-primary-600 hover:text-accent-600">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                    </div>
                </div>
                <div class="team-member text-center" data-aos="fade-up" data-aos-delay="400">
                    <div class="relative mb-6 overflow-hidden rounded-2xl">
                        <img src="images/sebas.jpg" alt="Team Member" class="w-full team-member-img">
                    </div>
                    <h3 class="text-xl font-semibold text-primary-800 mb-2">Sebastian Galeano</h3>
                    <p class="text-accent-600 mb-4">Director de documentos y actualizaciones</p>
                    <p class="text-primary-600 mb-4">
                        Desarrollador front-end y especialista en la documentacion.
                    </p>
                    <div class="flex justify-center space-x-4">
                        <a href="#" class="social-icon text-primary-600 hover:text-accent-600">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="social-icon text-primary-600 hover:text-accent-600">
                            <i class="fab fa-github text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="games-section" id="juegos" data-aos="fade-up" data-aos-delay="100" >
        <h2 data-aos="fade-up" data-aos-delay="100" >¿Te gustan los juegos? ¡Aquí puedes divertirte un rato!</h2>
        <div class="games-grid" data-aos="fade-up" data-aos-delay="100" >
            <a data-aos="fade-up" data-aos-delay="100" href="juegos/1.html" class="px-8 py-4 rounded-full border-2 border-white text-white hover:bg-white hover:text-accent-600 transition duration-300 transform hover:scale-105">
                Juego 1
            </a>
            <a data-aos="fade-up" data-aos-delay="100" href="juegos/2.html" class="px-8 py-4 rounded-full border-2 border-white text-white hover:bg-white hover:text-accent-600 transition duration-300 transform hover:scale-105">
                Juego 2
            </a>
            <a data-aos="fade-up" data-aos-delay="100" href="juegos/3.html" class="px-8 py-4 rounded-full border-2 border-white text-white hover:bg-white hover:text-accent-600 transition duration-300 transform hover:scale-105">
                Juego 3
            </a>
            <a data-aos="fade-up" data-aos-delay="100" href="juegos/4.html" class="px-8 py-4 rounded-full border-2 border-white text-white hover:bg-white hover:text-accent-600 transition duration-300 transform hover:scale-105">
                Juego 4
            </a>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-primary-800 mb-4" data-aos="fade-up">Contáctanos</h2>
                <p class="text-lg text-primary-600 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    ¿Tienes alguna pregunta? Estamos aquí para ayudarte
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="space-y-8" data-aos="fade-right">
                    <div class="flex items-start space-x-4">
                        <div class="bg-accent-100 rounded-full p-4">
                            <i class="fas fa-map-marker-alt text-2xl text-accent-600"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-primary-800 mb-2">Ubicación</h3>
                            <p class="text-primary-600">SENA CTGI, Colombia</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="bg-accent-100 rounded-full p-4">
                            <i class="fas fa-phone text-2xl text-accent-600"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-primary-800 mb-2">Teléfono</h3>
                            <p class="text-primary-600">+57 3006518829</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="bg-accent-100 rounded-full p-4">
                            <i class="fas fa-envelope text-2xl text-accent-600"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-primary-800 mb-2">Email</h3>
                            <p class="text-primary-600">sebasgf@gmail.com</p>
                            <p class="text-primary-600">bmateo@gmail.com</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="bg-accent-100 rounded-full p-4">
                            <i class="fas fa-clock text-2xl text-accent-600"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-primary-800 mb-2">Horario de Atención</h3>
                            <p class="text-primary-600">Lunes a Viernes: 9:00 AM - 6:00 PM</p>
                            <p class="text-primary-600">Sábados: 10:00 AM - 2:00 PM</p>
                        </div>
                    </div>
                </div>
                <form class="space-y-6 bg-white rounded-2xl p-8 shadow-lg" data-aos="fade-left">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-primary-600 mb-2">Nombre</label>
                            <input type="text" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-accent-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-primary-600 mb-2">Email</label>
                            <input type="email" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-accent-500">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-primary-600 mb-2">Asunto</label>
                        <input type="text" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-accent-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-primary-600 mb-2">Mensaje</label>
                        <textarea rows="5" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-accent-500"></textarea>
                    </div>
                    <button type="submit" class="w-full px-6 py-3 bg-accent-600 text-white rounded-2xl hover:bg-accent-700 transition duration-300 transform hover:scale-105">
                        Enviar mensaje
                    </button>
                </form>
            </div>
        </div>
    </section>

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
                        <li><a href="login.php?aviso=requiere_login" class="text-gray-400 hover:text-accent-400 transition duration-300">Memoria</a></li>
                        <li><a href="login.php?aviso=requiere_login" class="text-gray-400 hover:text-accent-400 transition duration-300">Serpiente</a></li>
                        <li><a href="login.php?aviso=requiere_login" class="text-gray-400 hover:text-accent-400 transition duration-300">El topo</a></li>
                        <li><a href="login.php?aviso=requiere_login" class="text-gray-400 hover:text-accent-400 transition duration-300">Adivina el numero</a></li>
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
    <button id="back-to-top" class="fixed bottom-8 right-8 bg-accent-600 text-white p-4 rounded-full shadow-lg hidden hover:bg-accent-700 transition duration-300 transform hover:scale-110">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true
        });

        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Back to top button
        const backToTopButton = document.getElementById('back-to-top');

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('hidden');
            } else {
                backToTopButton.classList.add('hidden');
            }
        });

        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Smooth scroll for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                    // Close mobile menu if open
                    mobileMenu.classList.add('hidden');
                }
            });
        });

        // Form submission handling with animation
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const button = form.querySelector('button[type="submit"]');
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enviando...';
                
                // Simulate form submission
                setTimeout(() => {
                    button.innerHTML = '<i class="fas fa-check"></i> ¡Enviado!';
                    form.reset();
                    setTimeout(() => {
                        button.innerHTML = originalText;
                    }, 2000);
                }, 1500);
            });
        });
    </script>
</body>
</html>
