<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ProductManager</title>
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
    <link rel="stylesheet" href="css/main-admin.css">
    
</head>
<body class="min-h-screen">
    <?php
    // Determinar qué página mostrar
    $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
    
    // Array de páginas válidas
    $valid_pages = [
        'dashboard' => 'Dashboard',
        'create_product' => 'create_product.php',
        'table_product' => 'table_product.php',
        'create_categorie' => 'create_categorie.php',
        'create_discount' => 'create_discount.php'
    ];
    
    // Verificar si la página existe
    if (!array_key_exists($page, $valid_pages)) {
        $page = 'dashboard';
    }
    ?>
    
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
                <a href="?page=create_product" 
                   class="sidebar-item <?php echo ($page == 'create_product') ? 'active' : ''; ?> flex items-center space-x-4 p-4 rounded-xl text-white font-medium"
                   data-page="create_product">
                    <span class="text-xl">➕</span>
                    <span>Nuevo Producto</span>
                </a>
                
                <a href="?page=create_categorie" 
                   class="sidebar-item <?php echo ($page == 'create_categorie') ? 'active' : ''; ?> flex items-center space-x-4 p-4 rounded-xl text-white font-medium"
                   data-page="create_categorie">
                    <span class="text-xl">🏷️</span>
                    <span>Nueva Categoría</span>
                </a>
                
                <a href="?page=table_product" 
                   class="sidebar-item <?php echo ($page == 'table_product') ? 'active' : ''; ?> flex items-center space-x-4 p-4 rounded-xl text-white font-medium"
                   data-page="table_product">
                    <span class="text-xl">📊</span>
                    <span>Tabla Productos</span>
                </a>
                
                <a href="?page=create_discount" class="sidebar-item <?php echo ($page == 'create_discount') ? 'active' : ''; ?> flex items-center space-x-4 p-4 rounded-xl text-white font-medium">
                    <span class="text-xl">💸</span>
                    <span>Nuevo Descuento</span>
                </a>
                
                <!-- Separador -->
                <div class="h-px bg-white/20 my-6"></div>
                
                <a href="#" class="sidebar-item flex items-center space-x-4 p-4 rounded-xl text-white font-medium hover:bg-red-600/20" onclick="logout()">
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

        <!-- Main Content Area -->
        <div class="flex-1 gradient-mesh-bg content-container">
            <div class="page-transition show" id="main-content">
                <?php
                if ($page == 'dashboard') {
                    // Contenido del dashboard por defecto
                    echo '<div class="p-8">';
                    echo '<div class="bg-white/90 backdrop-blur-sm rounded-3xl p-8">';
                    echo '<div class="text-center">';
                    echo '<h1 class="text-4xl font-bold text-gray-800 mb-4">Bienvenido al Dashboard</h1>';
                    echo '<p class="text-gray-600 text-lg">Selecciona una opción del menú lateral para comenzar</p>';
                    echo '<div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">';
                    
                    // Cards de acceso rápido
                    echo '<a href="?page=create_product" class="bg-military-green/10 p-6 rounded-xl hover:bg-military-green/20 transition-colors">';
                    echo '<div class="text-4xl mb-4">➕</div>';
                    echo '<h3 class="text-lg font-semibold text-gray-800">Nuevo Producto</h3>';
                    echo '<p class="text-gray-600">Agregar productos al inventario</p>';
                    echo '</a>';
                    
                    echo '<a href="?page=create_categorie" class="bg-bright-yellow/10 p-6 rounded-xl hover:bg-bright-yellow/20 transition-colors">';
                    echo '<div class="text-4xl mb-4">🏷️</div>';
                    echo '<h3 class="text-lg font-semibold text-gray-800">Nueva Categoría</h3>';
                    echo '<p class="text-gray-600">Gestionar categorías</p>';
                    echo '</a>';
                    
                    echo '<a href="?page=table_product" class="bg-olive/10 p-6 rounded-xl hover:bg-olive/20 transition-colors">';
                    echo '<div class="text-4xl mb-4">📊</div>';
                    echo '<h3 class="text-lg font-semibold text-gray-800">Ver Productos</h3>';
                    echo '<p class="text-gray-600">Administrar inventario</p>';
                    echo '</a>';

                    echo '<a href="?page=create_discount" class="bg-olive/10 p-6 rounded-xl hover:bg-olive/20 transition-colors">';
                    echo '<div class="text-4xl mb-4">💸</div>';
                    echo '<h3 class="text-lg font-semibold text-gray-800">Nuevo Descuento</h3>';
                    echo '<p class="text-gray-600">Crear nuevos descuentos</p>';
                    echo '</a>';

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                } else {
                    // Incluir la página correspondiente
                    $file_path = $valid_pages[$page];
                    if (file_exists($file_path)) {
                        include $file_path;
                    } else {
                        echo '<div class="p-8">';
                        echo '<div class="bg-white/90 backdrop-blur-sm rounded-3xl p-8 text-center">';
                        echo '<div class="text-6xl text-gray-400 mb-4">⚠️</div>';
                        echo '<h2 class="text-2xl font-bold text-gray-800 mb-2">Página no encontrada</h2>';
                        echo '<p class="text-gray-600">El archivo <code>' . htmlspecialchars($file_path) . '</code> no existe.</p>';
                        echo '<a href="?" class="mt-4 inline-block px-4 py-2 bg-military-green text-white rounded-lg hover:bg-olive transition-colors">Volver al Dashboard</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
<script src="js/main-admin.js"></script>
</body>
</html>