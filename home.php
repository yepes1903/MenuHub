<?php
session_start();

include("connection.php");

if (!isset($_SESSION['username'])) {
    header("location:login.php");
}
?>


<!DOCTYPE html>
<html lang="es" class="light scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - MenuHub</title>
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
                    },
                    animation: {
                        'bounce-slow': 'bounce 3s linear infinite',
                        'fade-in': 'fadeIn 0.5s ease-out',
                        'slide-up': 'slideUp 0.5s ease-out',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        }
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .gradient-text {
            background: linear-gradient(45deg, #2563eb, #1d4ed8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hover-card {
            transition: all 0.3s ease;
        }
        .hover-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .service-icon {
            transition: all 0.3s ease;
        }
        .hover-card:hover .service-icon {
            transform: scale(1.1);
        }
        .stats-number {
            background: linear-gradient(45deg, #2563eb, #1d4ed8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900">
    <!-- Navbar -->
    <nav class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-md shadow-md fixed w-full z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="#" class="flex items-center space-x-3 group">
                        <span class="text-2xl font-bold gradient-text group-hover:scale-105 transition-transform duration-300">Menu<span class="text-accent-600">Hub</span></span>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="nav-link text-primary-600 hover:text-accent-600 dark:text-white transition-colors duration-300">Inicio</a>
                    <a href="#services" class="nav-link text-primary-600 hover:text-accent-600 dark:text-white transition-colors duration-300">Servicios</a>
                    <a href="#about" class="nav-link text-primary-600 hover:text-accent-600 dark:text-white transition-colors duration-300">Sobre Nosotros</a>
                    <a href="#testimonials" class="nav-link text-primary-600 hover:text-accent-600 dark:text-white transition-colors duration-300">Testimonios</a>
                    <a href="#contact" class="nav-link text-primary-600 hover:text-accent-600 dark:text-white transition-colors duration-300">Contacto</a>
                    
                    <!-- User Dropdown -->
                    <div class="relative">
                        <button id="userDropdown" class="flex items-center space-x-2 text-primary-600 hover:text-accent-600 dark:text-white focus:outline-none transition-colors duration-300">
                            <i class="fas fa-user"></i>
                            <span><?php echo $_SESSION['username']; ?></span>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-300"></i>
                        </button>
                        <div id="userMenu" class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-xl shadow-lg py-1 transform origin-top scale-95 transition-all duration-300">
                            <?php
                            $id = $_SESSION['id'];
                            $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE id = ?");
                            mysqli_stmt_bind_param($stmt, "i", $id);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $res_id = $row['id'];
                                echo "<a href='edit.php?id=$res_id' class='block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-accent-50 dark:hover:bg-gray-700 transition-colors duration-300'>Actualizar Perfil</a>";
                            }
                            mysqli_stmt_close($stmt);
                            ?>
                            <a href="logout.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-accent-50 dark:hover:bg-gray-700 transition-colors duration-300">Cerrar Sesión</a>
                        </div>
                    </div>
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button id="mobileMenuBtn" class="text-primary-600 hover:text-accent-600 focus:outline-none dark:text-white transition-colors duration-300">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile menu -->
        <div id="mobileMenu" class="hidden md:hidden bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
            <div class="px-4 py-2 space-y-3">
                <a href="#home" class="block py-2 text-primary-600 hover:text-accent-600 dark:text-white transition-colors duration-300">Inicio</a>
                <a href="#services" class="block py-2 text-primary-600 hover:text-accent-600 dark:text-white transition-colors duration-300">Servicios</a>
                <a href="#about" class="block py-2 text-primary-600 hover:text-accent-600 dark:text-white transition-colors duration-300">Sobre Nosotros</a>
                <a href="#testimonials" class="block py-2 text-primary-600 hover:text-accent-600 dark:text-white transition-colors duration-300">Testimonios</a>
                <a href="#contact" class="block py-2 text-primary-600 hover:text-accent-600 dark:text-white transition-colors duration-300">Contacto</a>
                <?php
                $id = $_SESSION['id'];
                $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE id = ?");
                mysqli_stmt_bind_param($stmt, "i", $id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while ($row = mysqli_fetch_assoc($result)) {
                    $res_id = $row['id'];
                    echo "<a href='edit.php?id=$res_id' class='block py-2 text-primary-600 hover:text-accent-600 dark:text-white transition-colors duration-300'>Actualizar Perfil</a>";
                }
                mysqli_stmt_close($stmt);
                ?>
                <a href="logout.php" class="block py-2 text-primary-600 hover:text-accent-600 dark:text-white transition-colors duration-300">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <!-- Welcome Message -->
    <div class="pt-24 text-center animate-fade-in">
        <h2 class="text-2xl font-bold gradient-text mb-2">
            ¡Bienvenido <?php echo $_SESSION['username']; ?>!
        </h2>
        <p class="text-primary-600 dark:text-gray-300">Descubre nuestros servicios y productos excepcionales</p>
    </div>

    <!-- Hero Section -->
    <section id="home" class="pt-12 pb-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-12 md:space-y-0">
                <div class="md:w-1/2 text-center md:text-left animate-slide-up">
                    <h1 class="text-4xl md:text-6xl font-bold gradient-text leading-tight mb-6">
                        Innovación Digital para Tu Negocio
                    </h1>
                    <p class="text-lg text-primary-600 dark:text-gray-300 mb-8">
                        Transformamos ideas en experiencias digitales excepcionales. 
                        Descubre cómo podemos llevar tu negocio al siguiente nivel.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                        <a href="#contact" class="inline-block px-8 py-4 bg-accent-600 text-white rounded-full hover:bg-accent-700 transition duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            Comenzar Ahora
                        </a>
                        <a href="#about" class="inline-block px-8 py-4 bg-white dark:bg-gray-800 text-accent-600 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            Saber Más
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2 relative animate-fade-in">
                    <div class="absolute inset-0 bg-gradient-to-r from-accent-600/20 to-primary-600/20 rounded-3xl transform rotate-6"></div>
                    <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=800&q=80" alt="Hero Image" class="relative rounded-3xl shadow-2xl transform hover:scale-105 transition duration-500">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center hover-card p-6 rounded-xl">
                    <div class="stats-number text-4xl mb-2" data-target="500">0</div>
                    <p class="text-primary-600 dark:text-gray-300">Clientes Satisfechos</p>
                </div>
                <div class="text-center hover-card p-6 rounded-xl">
                    <div class="stats-number text-4xl mb-2" data-target="150">0</div>
                    <p class="text-primary-600 dark:text-gray-300">Proyectos Completados</p>
                </div>
                <div class="text-center hover-card p-6 rounded-xl">
                    <div class="stats-number text-4xl mb-2" data-target="15">0</div>
                    <p class="text-primary-600 dark:text-gray-300">Años de Experiencia</p>
                </div>
                <div class="text-center hover-card p-6 rounded-xl">
                    <div class="stats-number text-4xl mb-2" data-target="50">0</div>
                    <p class="text-primary-600 dark:text-gray-300">Premios Ganados</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-slide-up">
                <h2 class="text-3xl font-bold gradient-text mb-4">Nuestros Servicios</h2>
                <p class="text-lg text-primary-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Soluciones innovadoras diseñadas para impulsar tu éxito digital.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Service Cards -->
                <div class="hover-card bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
                    <div class="service-icon text-accent-600 text-4xl mb-6">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-primary-800 dark:text-white mb-4">Análisis de Datos</h3>
                    <p class="text-primary-600 dark:text-gray-300">
                        Transformamos datos en insights accionables para tu negocio.
                    </p>
                </div>
                <div class="hover-card bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
                    <div class="service-icon text-accent-600 text-4xl mb-6">
                        <i class="fas fa-paint-brush"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-primary-800 dark:text-white mb-4">Diseño UI/UX</h3>
                    <p class="text-primary-600 dark:text-gray-300">
                        Creamos experiencias digitales intuitivas y atractivas.
                    </p>
                </div>
                <div class="hover-card bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
                    <div class="service-icon text-accent-600 text-4xl mb-6">
                        <i class="fas fa-code"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-primary-800 dark:text-white mb-4">Desarrollo Web</h3>
                    <p class="text-primary-600 dark:text-gray-300">
                        Construimos soluciones web robustas y escalables.
                    </p>
                </div>
                <div class="hover-card bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
                    <div class="service-icon text-accent-600 text-4xl mb-6">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-primary-800 dark:text-white mb-4">Marketing Digital</h3>
                    <p class="text-primary-600 dark:text-gray-300">
                        Estrategias efectivas para aumentar tu presencia online.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-white dark:bg-gray-800 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <div class="md:w-1/2 relative animate-fade-in">
                    <div class="absolute inset-0 bg-gradient-to-r from-accent-600/20 to-primary-600/20 rounded-3xl transform -rotate-6"></div>
                    <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?auto=format&fit=crop&w=800&q=80" alt="About Us" class="relative rounded-3xl shadow-2xl transform hover:scale-105 transition duration-500">
                </div>
                <div class="md:w-1/2 animate-slide-up">
                    <h3 class="text-accent-600 font-semibold mb-4">Nuestra Historia</h3>
                    <h2 class="text-3xl font-bold gradient-text mb-6">
                        Transformando Negocios a Través de la Innovación Digital
                    </h2>
                    <p class="text-primary-600 dark:text-gray-300 mb-8">
                        Con años de experiencia en el sector digital, nos especializamos en crear 
                        soluciones innovadoras que impulsan el crecimiento de nuestros clientes. 
                        Nuestro enfoque se centra en la excelencia y la satisfacción del cliente.
                    </p>
                    <div class="grid grid-cols-2 gap-6 mb-8">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-accent-600 text-xl"></i>
                            <span class="text-primary-600 dark:text-gray-300">Innovación Constante</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-accent-600 text-xl"></i>
                            <span class="text-primary-600 dark:text-gray-300">Calidad Garantizada</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-accent-600 text-xl"></i>
                            <span class="text-primary-600 dark:text-gray-300">Soporte 24/7</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-accent-600 text-xl"></i>
                            <span class="text-primary-600 dark:text-gray-300">Equipo Experto</span>
                        </div>
                    </div>
                    <a href="#contact" class="inline-block px-8 py-4 bg-accent-600 text-white rounded-full hover:bg-accent-700 transition duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        Contáctanos
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-20 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-slide-up">
                <h2 class="text-3xl font-bold gradient-text mb-4">Lo Que Dicen Nuestros Clientes</h2>
                <p class="text-lg text-primary-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Testimonios de clientes satisfechos que han confiado en nuestros servicios.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="hover-card bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg">
                    <div class="flex items-center mb-6">
                        <img src="https://randomuser.me/api/portraits/women/1.jpg" alt="Client" class="w-16 h-16 rounded-full">
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-primary-800 dark:text-white">María García</h4>
                            <p class="text-primary-600 dark:text-gray-300">CEO, TechStart</p>
                        </div>
                    </div>
                    <p class="text-primary-600 dark:text-gray-300">
                        "Increíble experiencia trabajando con MenuHub. Su equipo demostró un alto nivel de profesionalismo y 
                        entrega en cada etapa del proyecto."
                    </p>
                    <div class="mt-4 text-accent-600">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="hover-card bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg">
                    <div class="flex items-center mb-6">
                        <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="Client" class="w-16 h-16 rounded-full">
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-primary-800 dark:text-white">Carlos Rodríguez</h4>
                            <p class="text-primary-600 dark:text-gray-300">Director, InnovateCo</p>
                        </div>
                    </div>
                    <p class="text-primary-600 dark:text-gray-300">
                        "Los resultados superaron nuestras expectativas. Su enfoque en la calidad y atención al detalle 
                        es excepcional."
                    </p>
                    <div class="mt-4 text-accent-600">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="hover-card bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg">
                    <div class="flex items-center mb-6">
                        <img src="https://randomuser.me/api/portraits/women/2.jpg" alt="Client" class="w-16 h-16 rounded-full">
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-primary-800 dark:text-white">Ana Martínez</h4>
                            <p class="text-primary-600 dark:text-gray-300">Fundadora, DigitalPlus</p>
                        </div>
                    </div>
                    <p class="text-primary-600 dark:text-gray-300">
                        "Un equipo altamente profesional y comprometido. Su capacidad para entender nuestras necesidades 
                        fue clave para el éxito del proyecto."
                    </p>
                    <div class="mt-4 text-accent-600">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-slide-up">
                <h2 class="text-3xl font-bold gradient-text mb-4">Contáctanos</h2>
                <p class="text-lg text-primary-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Estamos aquí para ayudarte. Contáctanos y descubre cómo podemos impulsar tu negocio.
                </p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="hover-card bg-white dark:bg-gray-700 rounded-xl p-8">
                        <div class="service-icon text-accent-600 text-3xl mb-4">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-primary-800 dark:text-white mb-2">Dirección</h3>
                        <p class="text-primary-600 dark:text-gray-300">A108 Adam Street,<br>New Delhi, 535022</p>
                    </div>
                    <div class="hover-card bg-white dark:bg-gray-700 rounded-xl p-8">
                        <div class="service-icon text-accent-600 text-3xl mb-4">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-primary-800 dark:text-white mb-2">Teléfono</h3>
                        <p class="text-primary-600 dark:text-gray-300">+91 9876545672<br>+91 8763456243</p>
                    </div>
                    <div class="hover-card bg-white dark:bg-gray-700 rounded-xl p-8">
                        <div class="service-icon text-accent-600 text-3xl mb-4">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-primary-800 dark:text-white mb-2">Email</h3>
                        <p class="text-primary-600 dark:text-gray-300">info@menuhub.com<br>contact@menuhub.com</p>
                    </div>
                    <div class="hover-card bg-white dark:bg-gray-700 rounded-xl p-8">
                        <div class="service-icon text-accent-600 text-3xl mb-4">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-primary-800 dark:text-white mb-2">Horario</h3>
                        <p class="text-primary-600 dark:text-gray-300">Lunes - Viernes<br>9:00AM - 05:00PM</p>
                    </div>
                </div>
                <!-- Contact Form -->
                <form action="contact.php" method="post" class="bg-white dark:bg-gray-700 rounded-xl p-8 shadow-lg hover-card">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-primary-600 dark:text-gray-300 mb-2">Nombre</label>
                            <input type="text" name="name" required 
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white 
                                focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-transparent transition-all duration-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-primary-600 dark:text-gray-300 mb-2">Email</label>
                            <input type="email" name="email" required 
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white 
                                focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-transparent transition-all duration-300">
                        </div>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-primary-600 dark:text-gray-300 mb-2">Asunto</label>
                        <input type="text" name="subject" required 
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white 
                            focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-transparent transition-all duration-300">
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-primary-600 dark:text-gray-300 mb-2">Mensaje</label>
                        <textarea name="message" rows="5" required 
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white 
                            focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-transparent transition-all duration-300"></textarea>
                    </div>
                    <button type="submit" 
                        class="w-full px-6 py-3 bg-accent-600 text-white rounded-xl hover:bg-accent-700 
                        transition duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        Enviar Mensaje
                    </button>
                </form>
            </div>
        </div>
    </section>

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
                <div>
                    <h4 class="text-lg font-semibold mb-6">Enlaces Rápidos</h4>
                    <ul class="space-y-4">
                        <li><a href="#home" class="text-gray-400 hover:text-accent-400 transition duration-300">Inicio</a></li>
                        <li><a href="#services" class="text-gray-400 hover:text-accent-400 transition duration-300">Servicios</a></li>
                        <li><a href="#about" class="text-gray-400 hover:text-accent-400 transition duration-300">Sobre Nosotros</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-accent-400 transition duration-300">Contacto</a></li>
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
                    <h4 class="text-lg font-semibold mb-6">Newsletter</h4>
                    <p class="text-gray-400 mb-4">Suscríbete para recibir las últimas noticias y ofertas.</p>
                    <form class="space-y-4">
                        <input type="email" placeholder="Tu email" 
                            class="w-full px-4 py-3 rounded-xl bg-primary-800 border border-primary-700 text-white 
                            placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-accent-500 transition-all duration-300">
                        <button type="submit" 
                            class="w-full px-6 py-3 bg-accent-600 text-white rounded-xl hover:bg-accent-700 
                            transition duration-300 transform hover:scale-105">
                            Suscribirse
                        </button>
                    </form>
                </div>
            </div>
            <div class="border-t border-primary-800 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm">
                        &copy; 2024 MenuHub. Todos los derechos reservados.
                    </p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="#" class="text-gray-400 hover:text-accent-400 transition duration-300">Términos</a>
                        <a href="#" class="text-gray-400 hover:text-accent-400 transition duration-300">Privacidad</a>
                        <a href="#" class="text-gray-400 hover:text-accent-400 transition duration-300">Cookies</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="backToTop" 
        class="fixed bottom-8 right-8 bg-accent-600 text-white p-4 rounded-full shadow-lg hidden 
        hover:bg-accent-700 transition duration-300 transform hover:scale-110">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        // Stats counter animation
        function animateValue(obj, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                obj.innerHTML = Math.floor(progress * (end - start) + start);
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }

        // Intersection Observer for stats animation
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const statsNumbers = document.querySelectorAll('.stats-number');
                    statsNumbers.forEach(number => {
                        const target = parseInt(number.getAttribute('data-target'));
                        animateValue(number, 0, target, 2000);
                    });
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        const statsSection = document.querySelector('.stats-number');
        if (statsSection) {
            observer.observe(statsSection);
        }

        // User dropdown toggle
        const userDropdown = document.getElementById('userDropdown');
        const userMenu = document.getElementById('userMenu');
        
        if (userDropdown && userMenu) {
            userDropdown.addEventListener('click', () => {
                userMenu.classList.toggle('hidden');
                userDropdown.querySelector('.fa-chevron-down').classList.toggle('rotate-180');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (!userDropdown.contains(e.target)) {
                    userMenu.classList.add('hidden');
                    userDropdown.querySelector('.fa-chevron-down').classList.remove('rotate-180');
                }
            });
        }

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                mobileMenuBtn.querySelector('i').classList.toggle('fa-bars');
                mobileMenuBtn.querySelector('i').classList.toggle('fa-times');
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
                    if (mobileMenu) {
                        mobileMenu.classList.add('hidden');
                        mobileMenuBtn.querySelector('i').classList.add('fa-bars');
                        mobileMenuBtn.querySelector('i').classList.remove('fa-times');
                    }
                }
            });
        });

        // Form submission handling with animation
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', (e) => {
                const button = form.querySelector('button[type="submit"]');
                if (button) {
                    const originalText = button.innerHTML;
                    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enviando...';
                    
                    setTimeout(() => {
                        button.innerHTML = '<i class="fas fa-check"></i> ¡Enviado!';
                        setTimeout(() => {
                            button.innerHTML = originalText;
                        }, 2000);
                    }, 1500);
                }
            });
        });

        // Navbar scroll effect
        const navbar = document.querySelector('nav');
        let lastScroll = 0;

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll <= 0) {
                navbar.classList.remove('shadow-lg');
                navbar.classList.add('shadow-md');
            } else {
                navbar.classList.add('shadow-lg');
                navbar.classList.remove('shadow-md');
            }

            lastScroll = currentScroll;
        });
    </script>
</body>
</html>
