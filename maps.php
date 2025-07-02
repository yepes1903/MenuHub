<?php
// Definición de los lugares (tiendas y restaurantes)
$lugares = [
    [
        "nombre" => "New Mahalo Envigado",
        "tipo" => "Restaurante",
        "lat" => 6.1528366,
        "lng" => -75.5624264,497,
        "productos" => ["comida", "musica", "paintball"]
    ],
    [
        "nombre" => "Muska Rooftop",
        "tipo" => "Restaurante",
        "lat" => 6.3238972,
        "lng" => -75.557973,339,
        "productos" => ["Musica", "cumpleaños", "comida"]
    ],
    [
        "nombre" => "Heladeria Lupita",
        "tipo" => "Heladeria",
        "lat" => 6.3418812,
        "lng" => -75.5659245,
        "productos" => ["Waffles", "Brownies", "platos infantiles"]
    ],
    [
        "nombre" => "SENA Pedregal",
        "tipo" => "SENA",
        "lat" => 6.3018355,
        "lng" => -75.568094,
        "productos" => ["Educar", "Aprender", "Paro"]
    ]
];
?>
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
    <!-- Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgwIZiubF1Ugb2ExuKlczuOPP6M1D-R_Y&callback=initMap" async defer></script>
    <style>
        body { font-family: 'Montserrat', sans-serif; }
        .hero-gradient { background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); }
        .nav-link { position: relative; font-weight: 500; }
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
        .nav-link:hover::after { width: 100%; }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .team-member-img { transition: all 0.3s ease; }
        .team-member:hover .team-member-img { transform: scale(1.05); }
        .social-icon { transition: all 0.3s ease; }
        .social-icon:hover { transform: translateY(-5px); color: #2563eb; }
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
        .music-content h2 { font-size: 32px; font-weight: bold; margin-bottom: 10px; }
        .music-content p { font-size: 16px; margin-bottom: 30px; }
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
        .games-section h2 { font-size: 26px; font-weight: 600; color: rgb(255, 255, 255); margin-bottom: 30px; }
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
        /* Estilos para el mapa */
        #map {
            height: 300px;
            width: 100%;
            max-width: 800px;
            border-radius: 16px;
            margin: 2rem auto;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .map-card {
            border: 1px solid #e2e8f0;
            padding: 1.5rem;
            border-radius: 12px;
            cursor: pointer;
            width: 300px;
            transition: all 0.3s ease;
            background-color: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .map-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .map-details {
            display: none;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #edf2f7;
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900">
    <!-- Navbar -->
    <nav class="bg-white dark:bg-gray-800 shadow-md fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="" class="flex items-center space-x-3">
                        <span class="text-2xl font-bold text-primary-800 dark:text-white">Menu<span class="text-accent-600">Hub</span></span>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.php" class="nav-link text-primary-600 hover:text-primary-800 dark:text-white">Inicio</a>
                    <a href="#about" class="nav-link text-primary-600 hover:text-primary-800 dark:text-white">Nosotros</a>
                    <a href="#team" class="nav-link text-primary-600 hover:text-primary-800 dark:text-white">Equipo</a>
                    <a href="#maps-section" class="nav-link text-primary-600 hover:text-primary-800 dark:text-white">Maps</a>
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
                <a href="maps.php" class="block py-2 text-primary-600 hover:text-primary-800 dark:text-white">Maps</a>
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

    <!-- Contenido principal -->
    <main class="pt-24 px-4">
        <h1 class="text-3xl font-bold text-center mb-8">Tiendas y Restaurantes</h1>
        <div class="card-container">
            <?php foreach ($lugares as $index => $lugar): ?>
                <div class="map-card" onclick="toggleDetails(<?= $index ?>)">
                    <h2 class="text-xl font-semibold mb-2">
                        <?= htmlspecialchars($lugar['nombre']) ?>
                        <small class="text-gray-500"> (<?= htmlspecialchars($lugar['tipo']) ?>)</small>
                    </h2>
                    <div class="map-details" id="details-<?= $index ?>">
                        <strong>Productos:</strong>
                        <ul class="list-disc list-inside">
                            <?php foreach ($lugar['productos'] as $producto): ?>
                                <li><?= htmlspecialchars($producto) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <button class="mt-2 px-4 py-2 bg-accent-600 text-white rounded hover:bg-accent-700"
                            onclick="panToLocation(event, <?= $lugar['lat'] ?>, <?= $lugar['lng'] ?>)">
                            Ver en el mapa
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div id="map"></div>
    </main>

    <!-- Scripts -->
    <script>
        // Mostrar/ocultar detalles de la tarjeta
        function toggleDetails(index) {
            const detailDiv = document.getElementById('details-' + index);
            detailDiv.style.display = detailDiv.style.display === 'none' || detailDiv.style.display === '' ? 'block' : 'none';
        }

        let map;
        let userMarker;

        // Inicialización del mapa
        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 14,
                center: { lat: -12.0464, lng: -77.0428 },
                mapTypeControl: true,
                streetViewControl: false,
                styles: [
                    { featureType: "poi", stylers: [{ visibility: "on" }] }
                ]
            });

            // Geolocalización del usuario
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(position => {
                    const pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    map.setCenter(pos);
                    userMarker = new google.maps.Marker({
                        position: pos,
                        map: map,
                        title: "Tu ubicación",
                        icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
                    });
                }, () => {
                    handleLocationError(true, map.getCenter());
                });
            } else {
                handleLocationError(false, map.getCenter());
            }

            // Añadir marcadores de los lugares
            <?php foreach ($lugares as $lugar): 
                $iconColor = ($lugar['tipo'] == 'Tienda') ? "green" : "red"; ?>
                new google.maps.Marker({
                    position: { lat: <?= $lugar['lat'] ?>, lng: <?= $lugar['lng'] ?> },
                    map: map,
                    title: '<?= addslashes($lugar['nombre']) ?>',
                    icon: 'http://maps.google.com/mapfiles/ms/icons/<?= $iconColor ?>-dot.png'
                });
            <?php endforeach; ?>
        }

        function handleLocationError(browserHasGeolocation, pos) {
            console.log(browserHasGeolocation ?
                "Error: El servicio de geolocalización falló." :
                "Error: Tu navegador no soporta geolocalización.");
        }

        // Centrar el mapa en la ubicación seleccionada
        function panToLocation(event, lat, lng) {
            event.stopPropagation();
            const location = { lat: lat, lng: lng };
            map.panTo(location);
            map.setZoom(16);
        }
    </script>
</body>
</html>