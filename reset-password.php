<!DOCTYPE html>
<html lang="es" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña - MenuHub</title>
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
<body class="bg-blue-600 dark:bg-gray-900">
    
<div class="background-animation"></div>
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-lg w-full bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 
                transform transition duration-300 hover:-translate-y-1 hover:shadow-2xl">
        <div class="text-center mb-8">

                <a href="" class="flex items-center justify-center space-x-3 mb-8">
                    <span class="text-3xl font-bold text-primary-800 dark:text-white">Menu<span class="text-accent-600">Hub</span></span>
                </a>
                <h2 class="text-2xl font-bold text-primary-800 dark:text-white">Restablecer Contraseña</h2>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    Ingresa tu nueva contraseña / Recuerda que mas de 8 caracteres
                </p>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <form class="space-y-6" action="process-reset.php" method="POST">
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token'] ?? ''); ?>">
                
                <div>
                    <label for="password" class="block text-m font-medium text-gray-700 dark:text-gray-300">
                        Nueva Contraseña
                    </label>
                    <div class="mt-1 relative">
                        <input id="password" name="password" type="password" required 
                               class="appearance-none block w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 shadow-sm placeholder-gray-400 
                                      focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                               placeholder="••••••••">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button type="button" onclick="togglePassword('password')" class="text-blue-400 hover:text-blue-500">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="confirm_password" class="block text-m font-medium text-gray-700 dark:text-gray-300">
                        Confirmar Contraseña
                    </label>
                    <div class="mt-1 relative">
                        <input id="confirm_password" name="confirm_password" type="password" required 
                               class="appearance-none block w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 shadow-sm placeholder-gray-400 
                                      focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-accent-500
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                               placeholder="••••••••">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        </div>
                    </div>
                </div>

                <div>
                <button type="submit" 
                    class="w-full flex justify-center items-center py-3 px-4 rounded-xl text-base font-bold text-white 
                        bg-accent-600 hover:bg-accent-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent-500 
                        transition-all duration-300 transform hover:-translate-y-1 hover:shadow-2xl">
                    Restablecer Contraseña
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
        // Toggle password visibility
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
    <?php
session_start();

// Suponiendo que ya hayas realizado el proceso de validación de la contraseña y el cambio de la misma

// Si el restablecimiento de la contraseña fue exitoso
if ($password_changed) { // Asume que esta variable se establece después de cambiar la contraseña
    // Establecer el mensaje de éxito en la sesión
    $_SESSION['success'] = "Tu contraseña ha sido restablecida correctamente. Ahora puedes iniciar sesión con tu nueva contraseña.";

    // Redirigir al login.php para que se muestre el mensaje
    header("Location: login.php");
    exit();
} else {
    // En caso de error, establecer un mensaje de error en la sesión
    $_SESSION['error'] = "Hubo un problema al restablecer tu contraseña. Intenta de nuevo.";

    // Redirigir nuevamente al formulario de restablecimiento
    header("Location: reset-password.php");
    exit();
}
?>

 
</body>
</html>
