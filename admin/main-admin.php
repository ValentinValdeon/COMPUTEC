<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Diseño 1</title>
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

        

        .sidebar-item {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .sidebar-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.6s;
        }

        .sidebar-item:hover::before {
            left: 100%;
        }

        .sidebar-item:hover {
            transform: translateX(8px);
            background: linear-gradient(135deg, var(--color-verde-claro), var(--color-amarillo));
        }

        .sidebar-item.active {
            background: linear-gradient(135deg, var(--color-amarillo), var(--color-verde-claro));
            transform: translateX(8px);
            box-shadow: 0 8px 32px rgba(244, 208, 63, 0.3);
        }
    </style>
</head>
<body class="min-h-screen">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-80 bg-gradient-to-b from-military-green via-olive to-military-green shadow-2xl relative">
            <!-- Logo/Header -->
            <div class="p-6 border-b border-white/20">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-bright-yellow rounded-xl flex items-center justify-center shadow-lg">
                        <span class="text-2xl font-bold text-military-green">📦</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-white">ProductManager</h1>
                        <p class="text-green-200 text-sm">Panel de Control</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="p-6 space-y-3">
                <a href="#" class="sidebar-item active flex items-center space-x-4 p-4 rounded-xl text-white font-medium">
                    <span class="text-xl">➕</span>
                    <span>Nuevo Producto</span>
                </a>
                
                <a href="#" class="sidebar-item flex items-center space-x-4 p-4 rounded-xl text-white font-medium">
                    <span class="text-xl">🏷️</span>
                    <span>Nueva Categoría</span>
                </a>
                
                <a href="#" class="sidebar-item flex items-center space-x-4 p-4 rounded-xl text-white font-medium">
                    <span class="text-xl">📊</span>
                    <span>Tabla Productos</span>
                </a>
                
                <a href="#" class="sidebar-item flex items-center space-x-4 p-4 rounded-xl text-white font-medium">
                    <span class="text-xl">🎯</span>
                    <span>Nuevo Descuento</span>
                </a>
                
                <!-- Separador -->
                <div class="h-px bg-white/20 my-6"></div>
                
                <a href="#" class="sidebar-item flex items-center space-x-4 p-4 rounded-xl text-white font-medium hover:bg-red-600/20">
                    <span class="text-xl">🚪</span>
                    <span>Cerrar Sesión</span>
                </a>
            </nav>

            <!-- User Info -->
            <div class="absolute bottom-6 left-6 right-6">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-bright-yellow rounded-full flex items-center justify-center">
                            <span class="text-military-green font-bold">👤</span>
                        </div>
                        <div>
                            <p class="text-white font-medium text-sm">Admin Usuario</p>
                            <p class="text-green-200 text-xs">En línea</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Area (Empty) -->
        <div class="flex-1 gradient-mesh-bg">
            <!-- Área vacía para contenido futuro -->
        </div>
    </div>

    <script>
        // Navegación interactiva
        document.querySelectorAll('.sidebar-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remover active de todos los items
                document.querySelectorAll('.sidebar-item').forEach(i => i.classList.remove('active'));
                
                // Agregar active al item clickeado (excepto cerrar sesión)
                if (!this.textContent.includes('Cerrar Sesión')) {
                    this.classList.add('active');
                }
                
                // Efecto especial para cerrar sesión
                if (this.textContent.includes('Cerrar Sesión')) {
                    if (confirm('¿Estás seguro de que quieres cerrar sesión?')) {
                        alert('Cerrando sesión...');
                    }
                }
            });
        });
    </script>
</body>
</html>