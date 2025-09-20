<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProductManager - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'military-green': '#5a6b3b',
                        'olive': '#6b7c32',
                        'warm-yellow': '#f4d03f',
                        'bright-yellow': '#f1c40f'
                    }
                }
            }
        }
    </script>
    <style>
        :root {
            --color-verde-claro: #27ae60;
            --color-bg-oscuro: #1a4a47;
            --color-amarillo: #f4d03f;
            --color-gris-oscuro: #2d5a5a;
        }

        .gradient-mesh-bg {
            background: 
                radial-gradient(circle at 80% 20%, var(--color-verde-claro) 0%, transparent 30%),
                radial-gradient(circle at 20% 80%, var(--color-amarillo) 0%, transparent 25%),
                radial-gradient(circle at 70% 70%, var(--color-gris-oscuro) 0%, transparent 35%),
                linear-gradient(135deg, var(--color-bg-oscuro) 0%, var(--color-gris-oscuro) 100%);
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .input-field {
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
            border: 2px solid transparent;
        }

        .input-field:focus {
            background: white;
            border-color: #5a6b3b;
            box-shadow: 0 0 0 4px rgba(90, 107, 59, 0.1);
            transform: translateY(-2px);
        }

        .login-btn {
            background: linear-gradient(135deg, #5a6b3b, #6b7c32);
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(90, 107, 59, 0.3);
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(90, 107, 59, 0.4);
            background: linear-gradient(135deg, #6b7c32, #5a6b3b);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .logo-container {
            background: linear-gradient(135deg, #f1c40f, #f4d03f);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .shape {
            position: absolute;
            background: rgba(241, 196, 15, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 100px;
            height: 100px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
    </style>
</head>
<body class="gradient-mesh-bg min-h-screen flex items-center justify-center p-4">
    <!-- Formas flotantes decorativas -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="login-card rounded-3xl p-8 w-full max-w-md relative z-10">
        <!-- Logo y Header -->
        <div class="text-center mb-8">
            <div class="logo-container w-16 h-16 mx-auto rounded-2xl flex items-center justify-center mb-4">
                <span class="text-2xl font-bold text-military-green">📦</span>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">ProductManager</h1>
            <p class="text-gray-600">Iniciar Sesión</p>
            <div class="w-16 h-1 bg-bright-yellow mx-auto mt-3 rounded-full"></div>
        </div>

        <!-- Mensajes de error/éxito -->
        <?php
        // session_start();
        if (isset($_SESSION['error_message'])) {
            echo '<div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg text-center">';
            echo $_SESSION['error_message'];
            echo '</div>';
            unset($_SESSION['error_message']);
        }
        
        if (isset($_SESSION['success_message'])) {
            echo '<div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg text-center">';
            echo $_SESSION['success_message'];
            echo '</div>';
            unset($_SESSION['success_message']);
        }
        ?>

        <!-- Formulario de Login -->
        <form action="login_validate.php" method="POST" class="space-y-6">
            <!-- Campo Usuario -->
            <div>
                <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">
                    Usuario
                </label>
                <div class="relative">
                    <input type="text" 
                           id="username" 
                           name="username" 
                           required
                           class="input-field w-full px-4 py-3 pl-12 rounded-xl focus:outline-none"
                           placeholder="Ingresa tu usuario">
                    <div class="absolute left-4 top-3.5 text-gray-400">
                        👤
                    </div>
                </div>
            </div>

            <!-- Campo Contraseña -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                    Contraseña
                </label>
                <div class="relative">
                    <input type="password" 
                           id="password" 
                           name="password" 
                           required
                           class="input-field w-full px-4 py-3 pl-12 rounded-xl focus:outline-none"
                           placeholder="Ingresa tu contraseña">
                    <div class="absolute left-4 top-3.5 text-gray-400">
                        🔒
                    </div>
                    <button type="button" 
                            onclick="togglePassword()" 
                            class="absolute right-4 top-3.5 text-gray-400 hover:text-gray-600 transition-colors">
                        <span id="toggleIcon">👁️</span>
                    </button>
                </div>
            </div>

            <!-- Recordar sesión -->
            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" 
                           name="remember" 
                           class="w-4 h-4 text-military-green border-gray-300 rounded focus:ring-military-green focus:ring-2">
                    <span class="ml-2 text-sm text-gray-600">Recordar sesión</span>
                </label>
                <a href="#" class="text-sm text-military-green hover:text-olive transition-colors">
                    ¿Olvidaste tu contraseña?
                </a>
            </div>

            <!-- Botón de Login -->
            <button type="submit" 
                    class="login-btn w-full py-3 px-4 text-white font-semibold rounded-xl focus:outline-none focus:ring-4 focus:ring-military-green/30">
                Iniciar Sesión
            </button>
        </form>

        <!-- Footer -->
        <div class="mt-8 text-center">
            <p class="text-xs text-gray-500">
                © 2024 ProductManager. Todos los derechos reservados.
            </p>
        </div>
    </div>

    <script>
        // Toggle para mostrar/ocultar contraseña
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.textContent = '🙈';
            } else {
                passwordField.type = 'password';
                toggleIcon.textContent = '👁️';
            }
        }

        // Efecto de enfoque en los campos
        document.querySelectorAll('.input-field').forEach(field => {
            field.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            field.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Prevenir envío si los campos están vacíos
        document.querySelector('form').addEventListener('submit', function(e) {
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();
            
            if (!username || !password) {
                e.preventDefault();
                alert('Por favor, completa todos los campos.');
            }
        });
    </script>
</body>
</html>