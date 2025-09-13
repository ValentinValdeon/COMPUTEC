<?php include "../config/db_conect.php"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
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

        .table-scroll {
            scrollbar-width: thin;
            scrollbar-color: #5a6b3b #f3f4f6;
        }

        .table-scroll::-webkit-scrollbar {
            height: 8px;
        }

        .table-scroll::-webkit-scrollbar-track {
            background: #f3f4f6;
            border-radius: 4px;
        }

        .table-scroll::-webkit-scrollbar-thumb {
            background: #5a6b3b;
            border-radius: 4px;
        }

        .input-cell {
            transition: all 0.2s ease;
            background: transparent;
            border: 1px solid transparent;
        }

        .input-cell:focus {
            background: white;
            border-color: #5a6b3b;
            box-shadow: 0 0 0 2px rgba(90, 107, 59, 0.1);
        }

        .row-disabled {
            opacity: 0.5;
            background-color: #f9fafb !important;
        }

        .row-modified {
            background-color: #fef3c7 !important;
            border-left: 4px solid #f1c40f;
        }

        .filter-badge {
            animation: pulse 0.3s ease-in-out;
        }

        .stats-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.6));
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .btn-confirm {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            transition: all 0.2s ease;
        }

        .btn-confirm:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(39, 174, 96, 0.3);
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            backdrop-filter: blur(4px);
        }

        .modal-content {
            background: white;
            border-radius: 16px;
            padding: 24px;
            max-width: 500px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .category-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 12px;
            margin: 4px 0;
            background: #f3f4f6;
            border-radius: 8px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .category-item.selected {
            background: #5a6b3b;
            color: white;
        }

        .category-item:hover {
            background: #e5e7eb;
        }

        .category-item.selected:hover {
            background: #6b7c32;
        }

        .add-btn {
            background: #5a6b3b;
            font-weight: bold;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 14px;
            margin-left: 8px;
        }

        .add-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 2px 8px rgba(241, 196, 15, 0.3);
        }

        .hidden {
            display: none !important;
        }
    </style>
</head>

<body class="gradient-mesh-bg min-h-screen">
    <div class="min-h-screen py-8">
        <div class="max-w-full mx-auto px-4">
            <div class="bg-white/10 backdrop-blur-sm rounded-3xl p-1 shadow-2xl">
                <div class="bg-white/90 backdrop-blur-sm rounded-3xl p-8">
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <h1 class="text-3xl font-bold text-gray-800">Gestión de Productos</h1>
                        <div class="w-24 h-1 bg-bright-yellow mx-auto mt-3 rounded-full"></div>
                    </div>

                    <!-- Filtros y Búsqueda -->
                    <div class="mb-6 space-y-4">
                        <!-- Barra de búsqueda -->
                        <div class="flex flex-col lg:flex-row gap-4 items-center">
                            <div class="flex-1">
                                <div class="relative">
                                    <input type="text" id="search-input"
                                        placeholder="Buscar productos por nombre, código o descripción..."
                                        class="w-full px-4 py-3 pl-12 bg-gray-50 border-2 border-transparent rounded-xl focus:bg-white focus:border-military-green transition-all duration-300">
                                    <div class="absolute left-4 top-3.5 text-gray-400">
                                        🔍
                                    </div>
                                </div>
                            </div>
                            <button onclick="clearAllFilters()"
                                class="px-6 py-3 bg-military-green/10 text-military-green rounded-xl hover:bg-military-green hover:text-white transition-colors duration-200 font-medium">
                                Limpiar Filtros
                            </button>
                        </div>

                        <!-- Filtros -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                            <!-- Filtro de categoría -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Categoría</label>
                                <select id="category-filter"
                                    class="w-full px-3 py-2 bg-gray-50 border-2 border-transparent rounded-lg focus:bg-white focus:border-military-green transition-all duration-300">
                                    <option value="">Todas las categorías</option>
                                    <?php
                                    $sql = "SELECT id_categoria, nombre_categoria FROM categorias";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['id_categoria'] . "'>" . $row['nombre_categoria'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Checkbox Filtros -->
                            <div class="space-y-2">
                                <label
                                    class="flex items-center space-x-2 cursor-pointer p-2 rounded-lg hover:bg-yellow-50 transition-colors">
                                    <input type="checkbox" id="stock-minimo-filter"
                                        class="w-4 h-4 text-military-green border-gray-300 rounded focus:ring-military-green">
                                    <span class="text-sm font-medium text-gray-700">⚠️ Stock Mínimo</span>
                                </label>
                            </div>

                            <div class="space-y-2">
                                <label
                                    class="flex items-center space-x-2 cursor-pointer p-2 rounded-lg hover:bg-yellow-50 transition-colors">
                                    <input type="checkbox" id="destacados-filter"
                                        class="w-4 h-4 text-military-green border-gray-300 rounded focus:ring-military-green">
                                    <span class="text-sm font-medium text-gray-700">⭐ Destacados</span>
                                </label>
                            </div>

                            <div class="space-y-2">
                                <label
                                    class="flex items-center space-x-2 cursor-pointer p-2 rounded-lg hover:bg-yellow-50 transition-colors">
                                    <input type="checkbox" id="descuentos-filter"
                                        class="w-4 h-4 text-military-green border-gray-300 rounded focus:ring-military-green">
                                    <span class="text-sm font-medium text-gray-700">💸 Con Descuento</span>
                                </label>
                            </div>

                            <div class="space-y-2">
                                <label
                                    class="flex items-center space-x-2 cursor-pointer p-2 rounded-lg hover:bg-red-50 transition-colors">
                                    <input type="checkbox" id="inactivos-filter"
                                        class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                    <span class="text-sm font-medium text-gray-700">🚫 Inactivos</span>
                                </label>
                            </div>
                        </div>

                        <!-- Badges de filtros activos -->
                        <div id="active-filters" class="flex flex-wrap gap-2"></div>
                    </div>

                    <!-- Tabla -->
                    <div class="bg-military-green/5 rounded-2xl p-4">
                        <div class="table-scroll overflow-x-auto">
                            <table class="w-full min-w-max">
                                <thead>
                                    <tr class="border-b-2 border-military-green/20">
                                        <th class="text-left p-4 font-bold text-military-green min-w-[60px]">Estado</th>
                                        <th class="text-left p-4 font-bold text-military-green min-w-[200px]">Producto
                                        </th>
                                        <th class="text-left p-4 font-bold text-military-green min-w-[120px]">Código
                                        </th>
                                        <th class="text-left p-4 font-bold text-military-green min-w-[150px]">Categorías
                                        </th>
                                        <th class="text-left p-4 font-bold text-military-green min-w-[120px]">P. Compra
                                        </th>
                                        <th class="text-left p-4 font-bold text-military-green min-w-[120px]">P. Venta
                                        </th>
                                        <th class="text-left p-4 font-bold text-military-green min-w-[100px]">Descuento
                                        </th>
                                        <th class="text-left p-4 font-bold text-military-green min-w-[100px]">P. Final
                                        </th>
                                        <th class="text-left p-4 font-bold text-military-green min-w-[80px]">Stock</th>
                                        <th class="text-left p-4 font-bold text-military-green min-w-[80px]">S. Min</th>
                                        <th class="text-left p-4 font-bold text-military-green min-w-[200px]">
                                            Propiedades</th>
                                        <th class="text-left p-4 font-bold text-military-green min-w-[60px]">⭐ Destacado
                                        </th>
                                        <th class="text-left p-4 font-bold text-military-green min-w-[100px]">Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="products-table-body">
                                    <?php
                                    $sql = "SELECT 
                                                p.id_producto,
                                                p.codigo,
                                                p.nombre,
                                                p.precio_compra,
                                                p.precio_venta,
                                                p.stock,
                                                p.stock_min,
                                                p.prop_1,
                                                p.prop_2,
                                                p.prop_3,
                                                p.destacado,
                                                p.descripcion,
                                                p.imagen,
                                                p.id_descuento,
                                                p.estado,
                                                COALESCE(d.cantidad, 0) as descuento_cantidad
                                            FROM productos p
                                            LEFT JOIN descuento d ON p.id_descuento = d.id_descuento
                                            ORDER BY p.nombre";

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($producto = $result->fetch_assoc()) {
                                            // Obtener categorías del producto
                                            $sql_categorias = "SELECT c.nombre_categoria 
                                                             FROM categorias c 
                                                             INNER JOIN producto_categoria pc ON c.id_categoria = pc.id_categoria 
                                                             WHERE pc.id_producto = {$producto['id_producto']}";
                                            $result_categorias = $conn->query($sql_categorias);

                                            $categorias = array();
                                            if ($result_categorias->num_rows > 0) {
                                                while ($categoria = $result_categorias->fetch_assoc()) {
                                                    $categorias[] = $categoria['nombre_categoria'];
                                                }
                                            }

                                            $precio_final = $producto['precio_venta'] * (1 - $producto['descuento_cantidad'] / 100);
                                            $is_low_stock = $producto['stock'] <= $producto['stock_min'];
                                            $row_class = $producto['estado'] == 1 ? '' : 'row-disabled';

                                            // Crear array de propiedades no vacías
                                            $propiedades = array_filter([
                                                $producto['prop_1'],
                                                $producto['prop_2'],
                                                $producto['prop_3']
                                            ]);

                                            echo "<tr class='border-b border-military-green/10 hover:bg-military-green/5 transition-colors {$row_class}' data-id='{$producto['id_producto']}'>";

                                            // Estado
                                            echo "<td class='p-4'>";
                                            echo "<label class='relative inline-flex items-center cursor-pointer'>";
                                            echo "<input type='checkbox' " . ($producto['estado'] == 1 ? 'checked' : '') . " class='sr-only peer product-estado' data-id='{$producto['id_producto']}'>";
                                            echo "<div class='relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-military-green/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[\"\"] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-military-green'></div>";
                                            echo "</label>";
                                            echo "</td>";

                                            // Producto
                                            echo "<td class='p-4'>";
                                            echo "<input type='text' value='{$producto['nombre']}' class='input-cell w-full p-2 rounded-lg font-semibold product-nombre' data-id='{$producto['id_producto']}'>";
                                            echo "</td>";

                                            // Código
                                            echo "<td class='p-4'>";
                                            echo "<input type='text' value='{$producto['codigo']}' class='input-cell w-full p-2 rounded-lg font-mono text-sm product-codigo' data-id='{$producto['id_producto']}'>";
                                            echo "</td>";

                                            // Categorías
                                            echo "<td class='p-4'>";
                                            echo "<div class='flex flex-wrap gap-1'>";
                                            foreach ($categorias as $categoria) {
                                                echo "<span class='px-2 py-1 bg-military-green text-white text-xs rounded-full'>📦 {$categoria}</span>";
                                            }
                                            echo "<button class='add-btn text-white' onclick='openCategoryModal({$producto['id_producto']})' title='Gestionar categorías'>+</button>";
                                            echo "</div>";
                                            echo "</td>";

                                            // Precio Compra
                                            echo "<td class='p-4'>";
                                            echo "<div class='relative'>";
                                            echo "<span class='absolute left-2 top-2 text-gray-500'>$</span>";
                                            echo "<input type='number' value='{$producto['precio_compra']}' step='0.01' min='0' class='input-cell w-full pl-6 pr-2 py-2 rounded-lg product-precio_compra' data-id='{$producto['id_producto']}'>";
                                            echo "</div>";
                                            echo "</td>";

                                            // Precio Venta
                                            echo "<td class='p-4'>";
                                            echo "<div class='relative'>";
                                            echo "<span class='absolute left-2 top-2 text-gray-500'>$</span>";
                                            echo "<input type='number' value='{$producto['precio_venta']}' step='0.01' min='0' class='input-cell w-full pl-6 pr-2 py-2 rounded-lg product-precio_venta' data-id='{$producto['id_producto']}'>";
                                            echo "</div>";
                                            echo "</td>";

                                            // Descuento
                                            echo "<td class='p-4'>";
                                            $descuento_class = $producto['descuento_cantidad'] > 0 ? 'text-red-600 font-semibold' : '';
                                            echo "<span class='font-bold {$descuento_class}'>{$producto['descuento_cantidad']}%</span>";
                                            echo "</td>";

                                            // Precio Final
                                            echo "<td class='p-4'>";
                                            echo "<span class='font-bold text-military-green'>$" . number_format($precio_final, 2) . "</span>";
                                            echo "</td>";

                                            // Stock
                                            echo "<td class='p-4'>";
                                            $stock_class = $is_low_stock ? 'text-red-600 font-bold bg-red-50' : '';
                                            echo "<input type='number' value='{$producto['stock']}' min='0' class='input-cell w-full p-2 rounded-lg {$stock_class} product-stock' data-id='{$producto['id_producto']}'>";
                                            if ($is_low_stock) {
                                                echo "<div class='text-xs text-red-600 mt-1'>⚠️ Bajo</div>";
                                            }
                                            echo "</td>";

                                            // Stock Mínimo
                                            echo "<td class='p-4'>";
                                            echo "<input type='number' value='{$producto['stock_min']}' min='0' class='input-cell w-full p-2 rounded-lg text-gray-600 product-stock_min' data-id='{$producto['id_producto']}'>";
                                            echo "</td>";

                                            // Propiedades
                                            echo "<td class='p-4'>";
                                            echo "<div class='space-y-1'>";
                                            foreach ($propiedades as $index => $propiedad) {
                                                echo "<div class='flex items-center space-x-1'>";
                                                echo "<div class='w-2 h-2 bg-bright-yellow rounded-full'></div>";
                                                echo "<span class='text-xs text-gray-600'>{$propiedad}</span>";
                                                echo "</div>";
                                            }
                                            echo "<button class='add-btn text-white' onclick='openPropertiesModal({$producto['id_producto']})' title='Gestionar propiedades'>+</button>";
                                            echo "</div>";
                                            echo "</td>";

                                            // Destacado
                                            echo "<td class='p-4 text-center'>";
                                            echo "<label class='relative inline-flex items-center cursor-pointer'>";
                                            echo "<input type='checkbox' " . ($producto['destacado'] == 1 ? 'checked' : '') . " class='sr-only peer product-destacado' data-id='{$producto['id_producto']}'>";
                                            echo "<div class='relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-bright-yellow/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[\"\"] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-bright-yellow'></div>";
                                            echo "</label>";
                                            echo "</td>";

                                            // Acciones
                                            echo "<td class='p-4'>";
                                            echo "<button onclick=\"saveProduct({$producto['id_producto']})\" class='btn-confirm px-4 py-2 text-white rounded-lg text-sm font-medium'>Guardar</button>";
                                            echo "</td>";

                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Mensaje cuando no hay productos -->
                        <div id="no-products-message" class="text-center py-12 hidden">
                            <div class="text-gray-400 text-6xl mb-4">📦</div>
                            <h3 class="text-xl font-semibold text-gray-600 mb-2">No se encontraron productos</h3>
                            <p class="text-gray-500">Prueba ajustando los filtros o términos de búsqueda</p>
                        </div>
                    </div>

                    <!-- Footer con estadísticas -->
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="stats-card rounded-xl p-4 text-center">
                            <div class="text-2xl font-bold text-military-green" id="total-products">
                                <?php
                                $sql_total = "SELECT COUNT(*) as total FROM productos";
                                $result_total = $conn->query($sql_total);
                                $total = $result_total->fetch_assoc()['total'];
                                echo $total;
                                ?>
                            </div>
                            <div class="text-sm text-gray-600">Total Productos</div>
                        </div>
                        <div class="stats-card rounded-xl p-4 text-center">
                            <div class="text-2xl font-bold text-bright-yellow" id="featured-products">
                                <?php
                                $sql_destacados = "SELECT COUNT(*) as total FROM productos WHERE destacado = 1";
                                $result_destacados = $conn->query($sql_destacados);
                                $destacados = $result_destacados->fetch_assoc()['total'];
                                echo $destacados;
                                ?>
                            </div>
                            <div class="text-sm text-gray-600">Destacados</div>
                        </div>
                        <div class="stats-card rounded-xl p-4 text-center">
                            <div class="text-2xl font-bold text-red-600" id="low-stock-products">
                                <?php
                                $sql_bajo_stock = "SELECT COUNT(*) as total FROM productos WHERE stock <= stock_min";
                                $result_bajo_stock = $conn->query($sql_bajo_stock);
                                $bajo_stock = $result_bajo_stock->fetch_assoc()['total'];
                                echo $bajo_stock;
                                ?>
                            </div>
                            <div class="text-sm text-gray-600">Stock Bajo</div>
                        </div>
                        <div class="stats-card rounded-xl p-4 text-center">
                            <div class="text-2xl font-bold text-green-600" id="active-products">
                                <?php
                                $sql_activos = "SELECT COUNT(*) as total FROM productos WHERE estado = 1";
                                $result_activos = $conn->query($sql_activos);
                                $activos = $result_activos->fetch_assoc()['total'];
                                echo $activos;
                                ?>
                            </div>
                            <div class="text-sm text-gray-600">Activos</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal para categorías -->
    <div id="categoryModal" class="modal-overlay hidden">
        <div class="modal-content">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">Gestionar Categorías</h3>
                <button onclick="closeCategoryModal()"
                    class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
            </div>
            <div class="mb-4">
                <p class="text-sm text-gray-600 mb-2">Producto: <span id="categoryProductName"
                        class="font-semibold"></span></p>
            </div>
            <div class="space-y-2 max-h-60 overflow-y-auto" id="categoriesList">
                <!-- Las categorías se cargarán aquí -->
            </div>
            <div class="flex gap-2 mt-6">
                <button onclick="saveCategoryChanges()"
                    class="flex-1 btn-confirm px-4 py-2 text-white rounded-lg font-medium">
                    Guardar Cambios
                </button>
                <button onclick="closeCategoryModal()"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                    Cancelar
                </button>
            </div>
        </div>
    </div>

    <!-- Modal para propiedades -->
    <div id="propertiesModal" class="modal-overlay hidden">
        <div class="modal-content">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">Gestionar Propiedades</h3>
                <button onclick="closePropertiesModal()"
                    class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
            </div>
            <div class="mb-4">
                <p class="text-sm text-gray-600 mb-2">Producto: <span id="propertiesProductName"
                        class="font-semibold"></span></p>
            </div>
            <div class="space-y-3">
                <div class="flex items-center gap-2">
                    <label class="text-sm font-medium text-gray-700 w-20">Prop 1:</label>
                    <input type="text" id="prop1Input" class="flex-1 input-cell p-2 rounded-lg border"
                        placeholder="Ej: 128GB">
                </div>
                <div class="flex items-center gap-2">
                    <label class="text-sm font-medium text-gray-700 w-20">Prop 2:</label>
                    <input type="text" id="prop2Input" class="flex-1 input-cell p-2 rounded-lg border"
                        placeholder="Ej: 5G">
                </div>
                <div class="flex items-center gap-2">
                    <label class="text-sm font-medium text-gray-700 w-20">Prop 3:</label>
                    <input type="text" id="prop3Input" class="flex-1 input-cell p-2 rounded-lg border"
                        placeholder="Ej: 6.1 pulgadas">
                </div>
            </div>
            <div class="flex gap-2 mt-6">
                <button onclick="savePropertyChanges()"
                    class="flex-1 btn-confirm px-4 py-2 text-white rounded-lg font-medium">
                    Guardar Cambios
                </button>
                <button onclick="closePropertiesModal()"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                    Cancelar
                </button>
            </div>
        </div>
    </div>

    <script>
        let modifiedProducts = new Set();
        let currentProductId = null;
        let allCategories = [];
        let productCategories = [];

        // Cargar categorías al iniciar
        document.addEventListener('DOMContentLoaded', function () {
            loadAllCategories();

            // Event listeners para cerrar modales
            document.getElementById('categoryModal').addEventListener('click', function (e) {
                if (e.target === this) closeCategoryModal();
            });

            document.getElementById('propertiesModal').addEventListener('click', function (e) {
                if (e.target === this) closePropertiesModal();
            });
        });

        // FUNCIONES DE CATEGORÍAS
        function loadAllCategories() {
            fetch('get_categories.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        allCategories = data.categories;
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function openCategoryModal(productId) {
            currentProductId = productId;
            const productName = document.querySelector(`.product-nombre[data-id="${productId}"]`).value;
            document.getElementById('categoryProductName').textContent = productName;

            loadProductCategories(productId);
            document.getElementById('categoryModal').classList.remove('hidden');
        }

        function closeCategoryModal() {
            document.getElementById('categoryModal').classList.add('hidden');
            currentProductId = null;
            productCategories = [];
        }

        function loadProductCategories(productId) {
            fetch(`get_products_categories.php?id=${productId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        productCategories = data.categories;
                        renderCategoriesList();
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function renderCategoriesList() {
            const categoriesList = document.getElementById('categoriesList');

            categoriesList.innerHTML = allCategories.map(category => {
                const isSelected = productCategories.includes(category.id_categoria);
                return `
            <div class="category-item ${isSelected ? 'selected' : ''}" 
                 onclick="toggleCategory(${category.id_categoria})">
                <span>📦 ${category.nombre_categoria}</span>
                <span>${isSelected ? 'x' : '✓'}</span>
            </div>
        `;
            }).join('');
        }

        function toggleCategory(categoryId) {
            const index = productCategories.indexOf(categoryId);
            if (index > -1) {
                productCategories.splice(index, 1);
            } else {
                productCategories.push(categoryId);
            }
            renderCategoriesList();
        }

        function saveCategoryChanges() {
            if (!currentProductId) return;

            const formData = new FormData();
            formData.append('id_producto', currentProductId);
            formData.append('categorias', JSON.stringify(productCategories));

            fetch('update_product_categories.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Categorías actualizadas correctamente');
                        location.reload();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error de conexión');
                })
                .finally(() => {
                    closeCategoryModal();
                });
        }

        // FUNCIONES DE PROPIEDADES
        function openPropertiesModal(productId) {
            currentProductId = productId;
            const productName = document.querySelector(`.product-nombre[data-id="${productId}"]`).value;
            document.getElementById('propertiesProductName').textContent = productName;

            loadProductProperties(productId);
            document.getElementById('propertiesModal').classList.remove('hidden');
        }

        function closePropertiesModal() {
            document.getElementById('propertiesModal').classList.add('hidden');
            currentProductId = null;
        }

        function loadProductProperties(productId) {
            fetch(`get_product_properties.php?id=${productId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('prop1Input').value = data.properties.prop_1 || '';
                        document.getElementById('prop2Input').value = data.properties.prop_2 || '';
                        document.getElementById('prop3Input').value = data.properties.prop_3 || '';
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function savePropertyChanges() {
            if (!currentProductId) return;

            const formData = new FormData();
            formData.append('id_producto', currentProductId);
            formData.append('prop_1', document.getElementById('prop1Input').value);
            formData.append('prop_2', document.getElementById('prop2Input').value);
            formData.append('prop_3', document.getElementById('prop3Input').value);

            fetch('update_product_properties.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Propiedades actualizadas correctamente');
                        location.reload();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error de conexión');
                })
                .finally(() => {
                    closePropertiesModal();
                });
        }
    </script>

</body>

</html>