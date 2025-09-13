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
                                            echo "<input type='checkbox' " . ($producto['estado'] == 1 ? 'checked' : '') . " onchange=\"toggleProductStatus({$producto['id_producto']})\" class='sr-only peer'>";
                                            echo "<div class='relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-military-green/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[\"\"] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-military-green'></div>";
                                            echo "</label>";
                                            echo "</td>";

                                            // Producto
                                            echo "<td class='p-4'>";
                                            echo "<input type='text' value='{$producto['nombre']}' onchange=\"updateProduct({$producto['id_producto']}, 'nombre', this.value)\" class='input-cell w-full p-2 rounded-lg font-semibold'>";
                                            echo "</td>";

                                            // Código
                                            echo "<td class='p-4'>";
                                            echo "<input type='text' value='{$producto['codigo']}' onchange=\"updateProduct({$producto['id_producto']}, 'codigo', this.value)\" class='input-cell w-full p-2 rounded-lg font-mono text-sm'>";
                                            echo "</td>";

                                            // Categorías
                                            echo "<td class='p-4'>";
                                            echo "<div class='flex flex-wrap gap-1'>";
                                            foreach ($categorias as $categoria) {
                                                echo "<span class='px-2 py-1 bg-military-green text-white text-xs rounded-full'>📦 {$categoria}</span>";
                                            }
                                            echo "</div>";
                                            echo "</td>";

                                            // Precio Compra
                                            echo "<td class='p-4'>";
                                            echo "<div class='relative'>";
                                            echo "<span class='absolute left-2 top-2 text-gray-500'>$</span>";
                                            echo "<input type='number' value='{$producto['precio_compra']}' step='0.01' min='0' onchange=\"updateProduct({$producto['id_producto']}, 'precio_compra', parseFloat(this.value))\" class='input-cell w-full pl-6 pr-2 py-2 rounded-lg'>";
                                            echo "</div>";
                                            echo "</td>";

                                            // Precio Venta
                                            echo "<td class='p-4'>";
                                            echo "<div class='relative'>";
                                            echo "<span class='absolute left-2 top-2 text-gray-500'>$</span>";
                                            echo "<input type='number' value='{$producto['precio_venta']}' step='0.01' min='0' onchange=\"updateProduct({$producto['id_producto']}, 'precio_venta', parseFloat(this.value))\" class='input-cell w-full pl-6 pr-2 py-2 rounded-lg'>";
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
                                            echo "<input type='number' value='{$producto['stock']}' min='0' onchange=\"updateProduct({$producto['id_producto']}, 'stock', parseInt(this.value))\" class='input-cell w-full p-2 rounded-lg {$stock_class}'>";
                                            if ($is_low_stock) {
                                                echo "<div class='text-xs text-red-600 mt-1'>⚠️ Bajo</div>";
                                            }
                                            echo "</td>";

                                            // Stock Mínimo
                                            echo "<td class='p-4'>";
                                            echo "<input type='number' value='{$producto['stock_min']}' min='0' onchange=\"updateProduct({$producto['id_producto']}, 'stock_min', parseInt(this.value))\" class='input-cell w-full p-2 rounded-lg text-gray-600'>";
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
                                            echo "</div>";
                                            echo "</td>";

                                            // Destacado
                                            echo "<td class='p-4 text-center'>";
                                            echo "<label class='relative inline-flex items-center cursor-pointer'>";
                                            echo "<input type='checkbox' " . ($producto['destacado'] == 1 ? 'checked' : '') . " onchange=\"toggleFeatured({$producto['id_producto']})\" class='sr-only peer'>";
                                            echo "<div class='relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-bright-yellow/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[\"\"] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-bright-yellow'></div>";
                                            echo "</label>";
                                            echo "</td>";

                                            // Acciones
                                            echo "<td class='p-4'>";
                                            echo "<button onclick=\"deleteProduct({$producto['id_producto']})\" class='px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors text-sm'>";
                                            echo "🗑️";
                                            echo "</button>";
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
                                $sql_total = "SELECT COUNT(*) as total FROM productos WHERE estado = 1";
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
                                $sql_destacados = "SELECT COUNT(*) as total FROM productos WHERE estado = 1 AND destacado = 1";
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
                                $sql_bajo_stock = "SELECT COUNT(*) as total FROM productos WHERE estado = 1 AND stock <= stock_min";
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

    <script>
        // Funciones para actualizar productos (necesitarás implementar las llamadas AJAX)
        function updateProduct(id, field, value) {
            // Implementar llamada AJAX para actualizar producto
            console.log(`Actualizando producto ${id}: ${field} = ${value}`);
            // Ejemplo de llamada AJAX:
            // fetch('update_product.php', {
            //     method: 'POST',
            //     headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            //     body: `id=${id}&field=${field}&value=${encodeURIComponent(value)}`
            // }).then(response => response.json()).then(data => {
            //     if (data.success) {
            //         // Actualización exitosa
            //     }
            // });
        }

        function toggleProductStatus(id) {
            // Implementar llamada AJAX para cambiar estado
            console.log(`Cambiando estado del producto ${id}`);
        }

        function toggleFeatured(id) {
            // Implementar llamada AJAX para cambiar destacado
            console.log(`Cambiando destacado del producto ${id}`);
        }

        function deleteProduct(id) {
            if (confirm('¿Estás seguro de que quieres eliminar este producto?')) {
                // Implementar llamada AJAX para eliminar producto
                console.log(`Eliminando producto ${id}`);
            }
        }

        // Filtros (implementar lógica de filtrado)
        function applyFilters() {
            console.log('Aplicando filtros...');
            // Implementar lógica de filtrado con AJAX o JavaScript
        }

        function clearAllFilters() {
            document.getElementById('search-input').value = '';
            document.getElementById('category-filter').value = '';
            document.getElementById('stock-minimo-filter').checked = false;
            document.getElementById('destacados-filter').checked = false;
            document.getElementById('descuentos-filter').checked = false;
            document.getElementById('inactivos-filter').checked = false;
            applyFilters();
        }

        // Event listeners
        document.getElementById('search-input').addEventListener('input', applyFilters);
        document.getElementById('category-filter').addEventListener('change', applyFilters);
        document.getElementById('stock-minimo-filter').addEventListener('change', applyFilters);
        document.getElementById('destacados-filter').addEventListener('change', applyFilters);
        document.getElementById('descuentos-filter').addEventListener('change', applyFilters);
        document.getElementById('inactivos-filter').addEventListener('change', applyFilters);
    </script>
</body>

</html>