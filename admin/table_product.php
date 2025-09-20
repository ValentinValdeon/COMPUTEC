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
    <link rel="stylesheet" href="css/table_product.css">
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
                                        class="w-full px-4 py-3 pl-12 bg-gray-50 border-2 rounded-xl focus:bg-white focus:border-military-green transition-all duration-300">
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
                                <!-- <label class="block text-sm font-bold text-gray-700 mb-2">Categoría</label> -->
                                <select id="category-filter"
                                    class="w-full px-3 py-2 bg-gray-50 border-2 rounded-lg focus:bg-white focus:border-military-green transition-all duration-300">
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
                        <div class="table-scroll overflow-x-auto max-h-[500px] overflow-y-auto">
                            <table class="w-full min-w-max border-collapse ">
                                <thead>
                                    <tr class="border-b-2 border-military-green/20">
                                        <th class="z-10 bg-military-green/100 sticky top-0 text-left p-4 font-bold text-white min-w-[60px]">Estado</th>
                                        <th class="z-10 bg-military-green/100 sticky top-0 text-left p-4 font-bold text-white min-w-[200px]">Producto
                                        </th>
                                        <th class="z-10 bg-military-green/100 sticky top-0 text-left p-4 font-bold text-white min-w-[120px]">Código
                                        </th>
                                        <th class="z-10 bg-military-green/100 sticky top-0 text-left p-4 font-bold text-white min-w-[150px]">Categorías
                                        </th>
                                        <th class="z-10 bg-military-green/100 sticky top-0 text-left p-4 font-bold text-white min-w-[120px]">P. Compra
                                        </th>
                                        <th class="z-10 bg-military-green/100 sticky top-0 text-left p-4 font-bold text-white min-w-[120px]">P. Venta
                                        </th>
                                        <th class="z-10 bg-military-green/100 sticky top-0 text-left p-4 font-bold text-white min-w-[100px]">Descuento
                                        </th>
                                        <th class="z-10 bg-military-green/100 sticky top-0 text-left p-4 font-bold text-white min-w-[100px]">P. Final
                                        </th>
                                        <th class="z-10 bg-military-green/100 sticky top-0 text-left p-4 font-bold text-white w-[150px]">Stock</th>
                                        <th class="z-10 bg-military-green/100 sticky top-0 text-left p-4 font-bold text-white w-[150px]">S. Min</th>
                                        <th class="z-10 bg-military-green/100 sticky top-0 text-left p-4 font-bold text-white min-w-[200px]">
                                            Propiedades</th>
                                        <th class="z-10 bg-military-green/100 sticky top-0 text-left p-4 font-bold text-white min-w-[100px]">Imágenes
                                        </th>
                                        <th class="z-10 bg-military-green/100 sticky top-0 text-left p-4 font-bold text-white min-w-[60px]">⭐ Destacado
                                        </th>
                                        <th class="z-10 bg-military-green/100 sticky top-0 text-left p-4 font-bold text-white min-w-[100px]">Acciones
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
                                                p.imagen_1,
                                                p.imagen_2,
                                                p.imagen_3,
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

                                            // Crear array de propiedades no vacías
                                            $propiedades = array_filter([
                                                $producto['prop_1'],
                                                $producto['prop_2'],
                                                $producto['prop_3']
                                            ]);

                                            // Obtener IDs de categorías del producto
                                            $sql_cat_ids = "SELECT id_categoria FROM producto_categoria WHERE id_producto = {$producto['id_producto']}";
                                            $result_cat_ids = $conn->query($sql_cat_ids);
                                            $categoria_ids = array();
                                            while ($cat_id = $result_cat_ids->fetch_assoc()) {
                                                $categoria_ids[] = $cat_id['id_categoria'];
                                            }

                                            echo "<tr class='border-b border-military-green/10 hover:bg-military-green/5 transition-colors' 
                                            data-id='{$producto['id_producto']}' 
                                            data-categories='" . implode(',', $categoria_ids) . "'>";

                                            // Estado
                                            echo "<td class='p-4'>";
                                            echo "<label class='relative inline-flex items-center cursor-pointer'>";
                                            echo "<input type='checkbox' " . ($producto['estado'] == 1 ? 'checked' : '') . " class='sr-only peer product-estado' data-id='{$producto['id_producto']}'>";
                                            echo "<div class='relative w-11 h-6 bg-gray-500 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-military-green/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[\"\"] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-military-green'></div>";
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
                                            echo "<select id='descuento' name='id_descuento' data-id='{$producto['id_producto']}'class='w-full px-4 py-2 bg-transparent border-2 border-gray-300 rounded-xl focus:bg-white focus:border-military-green transition-all duration-300 product-descuento'>";
                                            $selected = empty($producto['id_descuento']) ? "selected" : "";
                                            echo "<option value='' $selected>Sin descuento</option>";

                                            $sql_discount = "SELECT id_descuento, cantidad FROM descuento";
                                            $result_discount = $conn->query($sql_discount);
                                            while ($row = $result_discount->fetch_assoc()) {
                                                $selected = ($row['id_descuento'] == $producto['id_descuento']) ? "selected" : "";
                                                echo "<option value='" . $row['id_descuento'] . "' data-cantidad='" . $row['cantidad'] . "' $selected>" . $row['cantidad'] . "%</option>";
                                            }

                                            echo "</select>";
                                            echo "</td>";


                                            // Precio Final
                                            echo "<td class='p-4'>";
                                            echo "<span class='font-bold text-military-green'>$" . number_format($precio_final, 2) . "</span>";
                                            echo "</td>";

                                            // Stock
                                            echo "<td class='p-4'>";
                                            echo "<div class='flex space-x-2 items-center'>";
                                            $stock_class = $is_low_stock ? 'text-red-600 font-bold' : '';
                                            echo "<input type='number' value='{$producto['stock']}' min='0' class='input-cell w-full p-2 rounded-lg {$stock_class} product-stock' data-id='{$producto['id_producto']}'>";
                                            if ($is_low_stock) {
                                                echo "<div>⚠️</div>";
                                            } else {
                                                echo "<div>✅</div>";
                                            }
                                            echo "</div>";
                                            echo "</td>";

                                            // Stock Mínimo
                                            echo "<td class='p-4'>";
                                            echo "<input type='number' value='{$producto['stock_min']}' min='0' class='input-cell w-full p-2 rounded-lg text-gray-600 product-stock_min' data-id='{$producto['id_producto']}'>";
                                            echo "</td>";

                                            // Propiedades
                                            echo "<td class='p-4'>";
                                            echo "<div class='flex space-x-4 items-center'>";
                                            echo "<div class='space-y-1'>";
                                            foreach ($propiedades as $index => $propiedad) {
                                                echo "<div class='flex items-center space-x-1'>";
                                                echo "<div class='w-2 h-2 bg-bright-yellow rounded-full'></div>";
                                                echo "<span class='text-xs text-gray-600'>{$propiedad}</span>";
                                                echo "</div>";
                                            }
                                            echo "</div>";
                                            echo "<button class='add-btn add-btn-items' onclick='openPropertiesModal({$producto['id_producto']})' title='Gestionar propiedades'>✏</button>";
                                            echo "</div>";
                                            echo "</td>";

                                            // Imágenes
                                            echo "<td class='p-4'>";
                                            echo "<div class='flex flex-col items-center space-y-1'>";
                                            echo "<button class='add-btn add-btn-items' onclick='openImagesModal({$producto['id_producto']})' title='Gestionar imágenes'>🖼️</button>";
                                            echo "</div>";
                                            echo "</td>";

                                            // Destacado
                                            echo "<td class='p-4 text-center'>";
                                            echo "<label class='relative inline-flex items-center cursor-pointer'>";
                                            echo "<input type='checkbox' " . ($producto['destacado'] == 1 ? 'checked' : '') . " class='sr-only peer product-destacado' data-id='{$producto['id_producto']}'>";
                                            echo "<div class='relative w-11 h-6 bg-gray-500 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-bright-yellow/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[\"\"] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-bright-yellow'></div>";
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
                        <div class="stats-card rounded-xl p-4 text-center bg-military-green/15">
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
                        <div class="stats-card rounded-xl p-4 text-center bg-bright-yellow/20">
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
                        <div class="stats-card rounded-xl p-4 text-center bg-red-100">
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
                        <div class="stats-card rounded-xl p-4 text-center bg-military-green/15">
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
                    <input type="text" id="prop1Input" class="flex-1 input-cell-modal p-2 rounded-lg"
                        placeholder="Ej: 128GB">
                </div>
                <div class="flex items-center gap-2">
                    <label class="text-sm font-medium text-gray-700 w-20">Prop 2:</label>
                    <input type="text" id="prop2Input" class="flex-1 input-cell-modal p-2 rounded-lg "
                        placeholder="Ej: 5G">
                </div>
                <div class="flex items-center gap-2">
                    <label class="text-sm font-medium text-gray-700 w-20">Prop 3:</label>
                    <input type="text" id="prop3Input" class="flex-1 input-cell-modal p-2 rounded-lg"
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

    <!-- Modal para imágenes -->
    <div id="imagesModal" class="modal-overlay hidden">
        <div class="modal-content" style="max-width: 1500px;">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">Gestionar Imágenes</h3>
                <button onclick="closeImagesModal()" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
            </div>
            <div class="mb-4">
                <p class="text-sm text-gray-600 mb-2">Producto: <span id="imagesProductName"
                        class="font-semibold"></span></p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6" id="imagesContainer">
                <!-- Imagen 1 -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Imagen 1</label>
                    <div class="mb-2">
                        <img id="preview1" src="" alt="Preview 1"
                            class="w-full h-32 object-contain rounded border hidden">
                        <div id="placeholder1"
                            class="w-full h-32 bg-gray-200 rounded border flex items-center justify-center text-gray-400">
                            Sin imagen
                        </div>
                    </div>
                    <input type="file" id="image1Input" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-military-green file:text-white hover:file:bg-olive">
                    <input type="hidden" id="current1" value="">
                </div>

                <!-- Imagen 2 -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Imagen 2</label>
                    <div class="mb-2">
                        <img id="preview2" src="" alt="Preview 2"
                            class="w-full h-32 object-contain rounded border hidden">
                        <div id="placeholder2"
                            class="w-full h-32 bg-gray-200 rounded border flex items-center justify-center text-gray-400">
                            Sin imagen
                        </div>
                    </div>
                    <input type="file" id="image2Input" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-military-green file:text-white hover:file:bg-olive">
                    <input type="hidden" id="current2" value="">
                </div>

                <!-- Imagen 3 -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Imagen 3</label>
                    <div class="mb-2">
                        <img id="preview3" src="" alt="Preview 3"
                            class="w-full h-32 object-contain rounded border hidden">
                        <div id="placeholder3"
                            class="w-full h-32 bg-gray-200 rounded border flex items-center justify-center text-gray-400">
                            Sin imagen
                        </div>
                    </div>
                    <input type="file" id="image3Input" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-military-green file:text-white hover:file:bg-olive">
                    <input type="hidden" id="current3" value="">
                </div>
            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mb-4">
                <p class="text-sm text-yellow-800">
                    <strong>Nota:</strong> Las imágenes se subirán a la carpeta "uploads/productos/".
                    Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 5MB por imagen.
                </p>
            </div>

            <div class="flex gap-2">
                <button onclick="saveImageChanges()"
                    class="flex-1 btn-confirm px-4 py-2 text-white rounded-lg font-medium">
                    Guardar Imágenes
                </button>
                <button onclick="closeImagesModal()"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                    Cancelar
                </button>
            </div>
        </div>
    </div>

    <script src="js/table_product.js"></script>
</body>

</html>