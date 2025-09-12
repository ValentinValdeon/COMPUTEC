<?php include "../config/db_conect.php"; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Creación de Productos</title>
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
            position: relative;
        }

        .gradient-mesh-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 49%, rgba(39, 174, 96, 0.1) 50%, transparent 51%);
            background-size: 60px 60px;
            pointer-events: none;
            z-index: -1;
        }

        .property-input {
            transition: all 0.2s ease;
        }

        .property-input:focus {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(90, 107, 59, 0.15);
        }

        input {
            border-color: lightgray;
        }

        .image-preview {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .image-preview:hover img {
            transform: scale(1.05);
        }

        .remove-image {
            position: absolute;
            top: 8px;
            right: 8px;
            background: rgba(255, 0, 0, 0.8);
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .remove-image:hover {
            background: rgba(255, 0, 0, 1);
            transform: scale(1.1);
        }

        .drag-over {
            border-color: var(--color-verde-claro) !important;
            background-color: rgba(39, 174, 96, 0.1) !important;
        }

        .category-tag {
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="gradient-mesh-bg">
    <!-- Layout Horizontal -->
    <div class="min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-gradient-to-r from-military-green to-olive rounded-3xl p-1">
                <div class="bg-white rounded-3xl p-8">
                    <div class="text-center mb-8">
                        <h1 class="text-3xl font-bold text-gray-800">Nuevo Producto</h1>
                        <div class="w-24 h-1 bg-bright-yellow mx-auto mt-3 rounded-full"></div>
                    </div>

                    <form action="action-create_product.php" method="POST"
                        class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Columna izquierda: Información básica -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-gray-700 border-b-2 border-bright-yellow pb-2 mb-4">📝
                                Información Básica</h3>

                            <div class="group">
                                <label
                                    class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-military-green transition-colors">Nombre
                                    del Producto</label>
                                <div class="relative">
                                    <input type="text" name="nombre" required
                                        class="w-full px-4 py-4 bg-gray-50 border-2 rounded-xl focus:bg-white focus:border-military-green transition-all duration-300"
                                        placeholder="Ingresa el nombre del producto">
                                </div>
                            </div>

                            <div class="group">
                                <label
                                    class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-military-green transition-colors">Código</label>
                                <input type="text" name="codigo" required
                                    class="w-full px-4 py-4 bg-gray-50 border-2 rounded-xl focus:bg-white focus:border-military-green transition-all duration-300"
                                    placeholder="Código de barras o interno">
                            </div>

                            <!-- Nueva sección de categorías mejorada -->
                            <div class="group">
                                <label
                                    class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-military-green transition-colors">Categorías</label>
                                <div class="space-y-3">
                                    <div class="flex space-x-2">
                                        <select id="categoria-select" name="id_categoria" required
                                            class="flex-1 px-4 py-3 bg-gray-50 border-2 rounded-xl focus:bg-white focus:border-military-green transition-all duration-300">
                                            <option value="" disabled selected>Selecciona una categoría</option>
                                            <?php
                                            $sql = "SELECT id_categoria, nombre_categoria FROM categorias";
                                            $result = $conn->query($sql);
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['id_categoria'] . "'>" . $row['nombre_categoria'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                        <button type="button" id="agregar-categoria"
                                            class="px-4 py-3 bg-bright-yellow hover:bg-warm-yellow text-gray-800 font-semibold rounded-xl transition-all duration-200">
                                            ➕ Agregar
                                        </button>
                                    </div>

                                    <!-- Lista de categorías seleccionadas -->
                                    <div id="categorias-seleccionadas"
                                        class="min-h-[60px] p-3 bg-gray-50 border-2 border-dashed border-gray-300 rounded-xl">
                                        <p class="text-gray-500 text-sm" id="categorias-placeholder">Las categorías
                                            seleccionadas aparecerán aquí</p>
                                        <div id="categorias-lista" class="flex flex-wrap gap-2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="group">
                                <label
                                    class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-military-green transition-colors">Descripción</label>
                                <textarea name="descripcion"
                                    class="w-full px-4 py-4 bg-gray-50 border-2 rounded-xl focus:bg-white focus:border-military-green h-28 transition-all duration-300"
                                    placeholder="Describe las características y beneficios del producto..."></textarea>
                            </div>
                        </div>

                        <!-- Columna central: Precios, Stock e Imágenes -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-gray-700 border-b-2 border-bright-yellow pb-2 mb-4">💰
                                Precios y Stock</h3>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="group">
                                    <label
                                        class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-military-green transition-colors">Precio
                                        de Compra</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-4 text-gray-500">$</span>
                                        <input type="number" step="0.01" min="0" id="precio-compra" name="precio_compra"
                                            required
                                            class="w-full pl-8 pr-4 py-4 bg-gray-50 border-2 rounded-xl focus:bg-white focus:border-military-green transition-all duration-300"
                                            placeholder="0.00">
                                    </div>
                                </div>

                                <div class="group">
                                    <label
                                        class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-military-green transition-colors">Precio
                                        de Venta</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-4 text-gray-500">$</span>
                                        <input type="number" step="0.01" min="0" id="precio-venta" name="precio_venta"
                                            required
                                            class="w-full pl-8 pr-4 py-4 bg-gray-50 border-2 rounded-xl focus:bg-white focus:border-military-green transition-all duration-300"
                                            placeholder="0.00">
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="group">
                                    <label
                                        class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-military-green transition-colors">Stock
                                        Actual</label>
                                    <input type="number" min="0" name="stock_actual" required
                                        class="w-full px-4 py-4 bg-gray-50 border-2 rounded-xl focus:bg-white focus:border-military-green transition-all duration-300"
                                        placeholder="Ej: 100">
                                </div>

                                <div class="group">
                                    <label
                                        class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-military-green transition-colors">Stock
                                        Mínimo</label>
                                    <input type="number" min="0" name="stock_minimo" required
                                        class="w-full px-4 py-4 bg-gray-50 border-2 rounded-xl focus:bg-white focus:border-military-green transition-all duration-300"
                                        placeholder="Ej: 10">
                                </div>
                            </div>

                            <div class="group">
                                <label
                                    class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-military-green transition-colors">Descuento</label>
                                <select id="descuento" name="id_descuento"
                                    class="w-full px-4 py-4 bg-gray-50 border-2 rounded-xl focus:bg-white focus:border-military-green transition-all duration-300">
                                    <option value="">Sin descuento</option>
                                    <?php
                                    $sql = "SELECT id_descuento, cantidad FROM descuento";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['id_descuento'] . "'>" . $row['cantidad'] . "%</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Nueva sección de imágenes -->
                            <div class="group">
                                <label class="block text-sm font-bold text-gray-700 mb-2">📸 Imágenes del
                                    Producto</label>

                                <!-- Zona de subida de archivos -->
                                <div id="drop-zone"
                                    class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center cursor-pointer hover:border-military-green hover:bg-gray-50 transition-all duration-300">
                                    <input type="file" id="imagen-input" accept="image/*" multiple class="hidden"
                                        name="imagenes">
                                    <div class="space-y-2">
                                        <div class="text-4xl">📷</div>
                                        <p class="text-gray-600 font-medium">Arrastra imágenes aquí o haz clic para
                                            seleccionar</p>
                                        <p class="text-gray-400 text-sm">Soporta: JPG, PNG (máx. 3 imágenes)</p>
                                    </div>
                                </div>

                                <!-- Vista previa de imágenes -->
                                <div id="imagenes-preview" class="grid grid-cols-3 gap-3 mt-4"></div>
                            </div>

                            <!-- Producto Destacado -->
                            <div class="bg-gradient-to-r from-bright-yellow to-warm-yellow rounded-xl p-4">
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" id="producto-destacado" name="producto_destacado" value="1"
                                        class="w-5 h-5 text-military-green bg-white border-2 border-gray-300 rounded focus:ring-military-green focus:ring-2">
                                    <div class="flex-1">
                                        <span class="text-sm font-bold text-gray-800">⭐ Producto Destacado</span>
                                        <p class="text-xs text-gray-600 mt-1">Marcar para mostrar en la sección
                                            destacados</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Columna derecha: Propiedades técnicas -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold text-gray-700 border-b-2 border-bright-yellow pb-2 mb-4">🔧
                                Propiedades Técnicas</h3>

                            <div class="space-y-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-bright-yellow rounded-full"></div>
                                    <input type="text" name="propiedad1"
                                        class="flex-1 px-4 py-3 bg-gray-50 border-2 rounded-xl focus:bg-white focus:border-bright-yellow transition-all duration-300"
                                        placeholder="Ej: 16GB RAM">
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-bright-yellow rounded-full"></div>
                                    <input type="text" name="propiedad2"
                                        class="flex-1 px-4 py-3 bg-gray-50 border-2 rounded-xl focus:bg-white focus:border-bright-yellow transition-all duration-300"
                                        placeholder="Ej: 5G Compatible">
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-bright-yellow rounded-full"></div>
                                    <input type="text" name="propiedad3"
                                        class="flex-1 px-4 py-3 bg-gray-50 border-2 rounded-xl focus:bg-white focus:border-bright-yellow transition-all duration-300"
                                        placeholder="Ej: 6.1 pulgadas">
                                </div>
                            </div>

                            <!-- Resumen de precios -->
                            <div class="bg-gray-50 rounded-xl p-4 mt-6">
                                <h4 class="text-sm font-bold text-gray-700 mb-3">📊 Resumen Financiero</h4>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Precio de Compra:</span>
                                        <span class="font-semibold" id="precio-compra-display">$0.00</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Precio de Venta:</span>
                                        <span class="font-semibold" id="precio-venta-display">$0.00</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Descuento:</span>
                                        <span class="font-semibold text-red-600" id="descuento-display">0%</span>
                                    </div>
                                    <hr class="my-2">
                                    <div class="flex justify-between text-base">
                                        <span class="text-gray-800 font-bold">Precio Final:</span>
                                        <span class="font-bold text-military-green"
                                            id="precio-final-display">$0.00</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Margen de Ganancia:</span>
                                        <span class="font-semibold text-green-600" id="margen-display">$0.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botones en toda la fila -->
                        <div class="lg:col-span-3 flex justify-center space-x-6 pt-6">
                            <button type="button"
                                class="px-8 py-4 border-2 border-gray-300 text-gray-600 rounded-xl font-semibold hover:border-gray-400 hover:bg-gray-50 transition-all duration-200">Descartar</button>
                            <button type="submit"
                                class="px-8 py-4 bg-gradient-to-r from-military-green to-olive text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">✨
                                Crear Producto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let imagenesSubidas = [];
        const MAX_IMAGENES = 3;
        // Array para almacenar categorías seleccionadas
        let categoriasSeleccionadas = [];

        // Funcionalidad para agregar categorías
        document.getElementById('agregar-categoria').addEventListener('click', function () {
            const select = document.getElementById('categoria-select');
            const valorSeleccionado = select.value;
            const textoSeleccionado = select.options[select.selectedIndex].text;

            if (valorSeleccionado && !categoriasSeleccionadas.includes(valorSeleccionado)) {
                categoriasSeleccionadas.push(valorSeleccionado);
                actualizarCategoriasVisuales();
                select.value = ''; // reset
            }
        });

        function actualizarCategoriasVisuales() {
            const lista = document.getElementById('categorias-lista');
            const placeholder = document.getElementById('categorias-placeholder');

            lista.innerHTML = '';

            if (categoriasSeleccionadas.length === 0) {
                placeholder.style.display = 'block';
            } else {
                placeholder.style.display = 'none';

                categoriasSeleccionadas.forEach(categoriaId => {
                    const option = document.querySelector(`#categoria-select option[value="${categoriaId}"]`);
                    const nombre = option ? option.text : categoriaId;

                    const tag = document.createElement('span');
                    tag.className = 'inline-flex items-center px-3 py-1 bg-military-green text-white text-sm rounded-full';

                    tag.innerHTML = `
                ${nombre}
                <input type="hidden" name="categorias_seleccionadas[]" value="${categoriaId}">
                <button type="button" class="ml-2 font-bold" onclick="removerCategoria('${categoriaId}')">×</button>
            `;

                    lista.appendChild(tag);
                });
            }
        }


        function removerCategoria(categoriaId) {
            categoriasSeleccionadas = categoriasSeleccionadas.filter(c => c !== categoriaId);
            actualizarCategoriasVisuales();
        }

        // Funcionalidad de subida de imágenes
        const dropZone = document.getElementById('drop-zone');
        const imagenInput = document.getElementById('imagen-input');
        const imagenesPreview = document.getElementById('imagenes-preview');

        // Click en zona de drop para abrir selector
        dropZone.addEventListener('click', () => {
            imagenInput.click();
        });

        // Drag and drop
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('drag-over');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('drag-over');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('drag-over');
            const archivos = Array.from(e.dataTransfer.files);
            manejarArchivos(archivos);
        });

        // Selección de archivos
        imagenInput.addEventListener('change', (e) => {
            const archivos = Array.from(e.target.files);
            manejarArchivos(archivos);
        });

        function manejarArchivos(archivos) {
            const archivosImagen = archivos.filter(archivo => archivo.type.startsWith('image/'));

            archivosImagen.forEach(archivo => {
                if (imagenesSubidas.length < MAX_IMAGENES) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        imagenesSubidas.push({
                            archivo: archivo,
                            url: e.target.result,
                            id: Date.now() + Math.random()
                        });
                        actualizarVistaPrevia();
                    };
                    reader.readAsDataURL(archivo);
                }
            });
        }

        function actualizarVistaPrevia() {
            imagenesPreview.innerHTML = '';

            imagenesSubidas.forEach((imagen, index) => {
                const contenedor = document.createElement('div');
                contenedor.className = 'image-preview relative bg-gray-100 aspect-square';
                contenedor.innerHTML = `
                    <img src="${imagen.url}" alt="Preview ${index + 1}">
                    <button type="button" class="remove-image" onclick="removerImagen(${imagen.id})">×</button>
                `;
                imagenesPreview.appendChild(contenedor);
            });
        }

        function removerImagen(id) {
            imagenesSubidas = imagenesSubidas.filter(img => img.id !== id);
            actualizarVistaPrevia();
        }

        // Manejar envío del formulario
        document.querySelector('form').addEventListener('submit', function (e) {
            e.preventDefault(); // detener envío por un momento

            // Aquí procesás categorías, imágenes, etc.
            console.log('Categorías seleccionadas:', categoriasSeleccionadas);
            console.log('Imágenes subidas:', imagenesSubidas.length);

            // Opcional: mostrar alert
            alert(`Formulario enviado!\nCategorías: ${categoriasSeleccionadas.length}\nImágenes: ${imagenesSubidas.length}`);

            // Finalmente enviamos el formulario al servidor
            this.submit(); // ahora sí va al PHP
        });


        // Calculadora de precios en tiempo real
        function updatePriceCalculations() {
            const precioCompraInput = document.getElementById('precio-compra');
            const precioVentaInput = document.getElementById('precio-venta');
            const descuentoSelect = document.getElementById('descuento');

            if (!precioCompraInput || !precioVentaInput || !descuentoSelect) return;

            const precioCompra = parseFloat(precioCompraInput.value) || 0;
            const precioVenta = parseFloat(precioVentaInput.value) || 0;
            const descuentoPorcentaje = parseFloat(descuentoSelect.value) || 0;

            // Calcular precio final con descuento
            const descuentoMonto = (precioVenta * descuentoPorcentaje) / 100;
            const precioFinal = precioVenta - descuentoMonto;
            const margenGanancia = precioFinal - precioCompra;

            // Actualizar displays
            document.getElementById('precio-compra-display').textContent = `$${precioCompra.toFixed(2)}`;
            document.getElementById('precio-venta-display').textContent = `$${precioVenta.toFixed(2)}`;
            document.getElementById('descuento-display').textContent = `${descuentoPorcentaje}%`;
            document.getElementById('precio-final-display').textContent = `$${precioFinal.toFixed(2)}`;
            document.getElementById('margen-display').textContent = `$${margenGanancia.toFixed(2)}`;

            // Cambiar color del margen según si es positivo o negativo
            const margenElement = document.getElementById('margen-display');
            if (margenGanancia >= 0) {
                margenElement.className = 'font-semibold text-green-600';
            } else {
                margenElement.className = 'font-semibold text-red-600';
            }
        }

        // Agregar event listeners para la calculadora de precios
        const precioCompra = document.getElementById('precio-compra');
        const precioVenta = document.getElementById('precio-venta');
        const descuentoSelect = document.getElementById('descuento');

        if (precioCompra) precioCompra.addEventListener('input', updatePriceCalculations);
        if (precioVenta) precioVenta.addEventListener('input', updatePriceCalculations);
        if (descuentoSelect) descuentoSelect.addEventListener('change', updatePriceCalculations);

        // Inicializar cálculos
        updatePriceCalculations();

        // Hacer funciones disponibles globalmente para los onclick
        window.removerCategoria = removerCategoria;
        window.removerImagen = removerImagen;
    </script>
</body>

</html>