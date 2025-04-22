<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - MenuHub</title>
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
    <style>
          :root {
            --primary-color: #1e40af;
            --accent-color: #3b82f6;
            --text-color: #1e293b;
            --light-text: #64748b;
            --white: #ffffff;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-400: #94a3b8;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
        }

        body {
            font-family: 'Montserrat', sans-serif;
        }
        .background-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            overflow: hidden;
            z-index: -1;
        }

        .background-animation::before,
        .background-animation::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.5;
        }

        .background-animation::before {
            background: radial-gradient(circle at 20% 70%, rgba(255,255,255,0.3) 0%, transparent 50%);
            animation: moveGradient 15s ease infinite;
        }

        .background-animation::after {
            background: radial-gradient(circle at 80% 30%, rgba(255,255,255,0.2) 0%, transparent 60%);
            animation: moveGradient 20s ease-in-out infinite alternate;
        }

        @keyframes moveGradient {
            0% { transform: scale(1) rotate(0deg); }
            50% { transform: scale(1.2) rotate(180deg); }
            100% { transform: scale(1) rotate(360deg); }
        }

    </style>
</head>
<body class="bg-blue-500 dark:bg-gray-900">
<div class="background-animation"></div>
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 transform transition duration-300 hover:-translate-y-1 hover:shadow-2xl">
            <div class="text-center mb-8">
                <a href="" class="flex items-center justify-center space-x-3 mb-8">
                    <span class="text-3xl font-bold text-primary-800 dark:text-white">Menu<span class="text-accent-600">Hub</span></span>
                </a>
                <h2 class="text-2xl font-bold text-primary-800 dark:text-white">Recuperar Contraseña</h2>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    Ingresa tu correo electrónico para recuperar tu contraseña
                </p>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    <?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    <?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
                    <?php if (isset($_SESSION['reset_link'])): ?>
                        <div class="mt-2">
                            <a href="<?php echo htmlspecialchars($_SESSION['reset_link']); ?>" class="text-accent-600 hover:text-accent-700">
                                Haz clic aquí para restablecer tu contraseña
                            </a>
                        </div>
                        <?php unset($_SESSION['reset_link']); ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <form id="recoveryForm" class="space-y-6" action="process-recovery.php" method="POST" novalidate>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Correo Electrónico
                    </label>
                    <div class="mt-1 relative">
                        <input id="email" name="email" type="email" required 
                               class="appearance-none block w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 shadow-sm placeholder-gray-400 
                                      focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                               placeholder="tu@email.com">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-envelope text-blue-400"></i>
                        </div>
                    </div>
                    <p id="emailError" class="mt-2 text-sm text-red-600 dark:text-red-500 hidden">
                        Por favor, ingresa un correo electrónico válido
                    </p>
                </div>

                <div>
                <button type="submit"
                    class="w-full flex justify-center items-center py-3 px-4 rounded-lg text-base font-bold text-white bg-accent-600 
                        transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl hover:bg-accent-700 focus:outline-none 
                        focus:ring-2 focus:ring-offset-2 focus:ring-accent-500">
                    
                    <span class="normal-state">Verificar</span>
                    
                    <span class="loading-state hidden flex items-center">
                        <i class="fas fa-spinner fa-spin mr-2"></i>
                        Enviando...
                    </span>
                </button>

                </div>

                <div class="text-center">
                    <a href="login.php" class="text-sm text-accent-600 hover:text-accent-500 dark:text-accent-400 font-bold">
                        Volver al inicio de sesión
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
 
        // Form validation
        const form = document.getElementById('recoveryForm');
        const emailInput = document.getElementById('email');
        const emailError = document.getElementById('emailError');
        const submitButton = form.querySelector('button[type="submit"]');
        const normalState = submitButton.querySelector('.normal-state');
        const loadingState = submitButton.querySelector('.loading-state');

        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email.toLowerCase());
        }

        emailInput.addEventListener('input', () => {
            if (validateEmail(emailInput.value)) {
                emailError.classList.add('hidden');
                emailInput.classList.remove('border-red-500');
            } else {
                emailError.classList.remove('hidden');
                emailInput.classList.add('border-red-500');
            }
        });

        form.addEventListener('submit', (e) => {
            e.preventDefault();

            if (!validateEmail(emailInput.value)) {
                emailError.classList.remove('hidden');
                emailInput.classList.add('border-red-500');
                return;
            }

            // Show loading state
            submitButton.disabled = true;
            normalState.classList.add('hidden');
            loadingState.classList.remove('hidden');

            // Submit the form
            form.submit();
        });
    </script>
</body>
</html>
