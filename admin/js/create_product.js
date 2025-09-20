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
        const form = document.getElementById('form-producto');
const dropZone = document.getElementById('drop-zone');
const imagenInput = document.getElementById('imagen-input');
const imagenesPreview = document.getElementById('imagenes-preview');

dropZone.addEventListener('click', () => imagenInput.click());

dropZone.addEventListener('dragover', e => {
    e.preventDefault();
    dropZone.classList.add('drag-over');
});
dropZone.addEventListener('dragleave', () => dropZone.classList.remove('drag-over'));
dropZone.addEventListener('drop', e => {
    e.preventDefault();
    dropZone.classList.remove('drag-over');
    manejarArchivos(Array.from(e.dataTransfer.files));
});
imagenInput.addEventListener('change', e => manejarArchivos(Array.from(e.target.files)));

function manejarArchivos(archivos) {
    archivos.filter(f => f.type.startsWith('image/')).forEach(archivo => {
        if (imagenesSubidas.length < MAX_IMAGENES) {
            const reader = new FileReader();
            reader.onload = e => {
                imagenesSubidas.push({ archivo, url: e.target.result, id: Date.now() + Math.random() });
                actualizarVistaPrevia();
            };
            reader.readAsDataURL(archivo);
        }
    });
}

function actualizarVistaPrevia() {
    imagenesPreview.innerHTML = '';
    imagenesSubidas.forEach(imagen => {
        const cont = document.createElement('div');
        cont.className = 'image-preview relative bg-gray-100 aspect-square';
        cont.innerHTML = `
            <img src="${imagen.url}" alt="Preview">
            <button type="button" class="remove-image absolute top-1 right-1" onclick="removerImagen(${imagen.id})">×</button>
        `;
        imagenesPreview.appendChild(cont);
    });
}

function removerImagen(id) {
    imagenesSubidas = imagenesSubidas.filter(img => img.id !== id);
    actualizarVistaPrevia();
}


    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        // Agregar las imágenes del array JS
        imagenesSubidas.forEach(img => formData.append('imagenes[]', img.archivo));

        // Agregar categorías
        categoriasSeleccionadas.forEach(cat => formData.append('categorias_seleccionadas[]', cat));

        fetch(this.action, { method: 'POST', body: formData })
            .then(res => res.text())
            .then(data => {
                alert('Producto creado correctamente');
                form.reset();
                imagenesSubidas = [];
                categoriasSeleccionadas = [];
                actualizarVistaPrevia();
                actualizarCategoriasVisuales();
            })
            .catch(err => console.error(err));
    });

        // Calculadora de precios en tiempo real
        function updatePriceCalculations() {
            
            const precioCompraInput = document.getElementById('precio-compra');
            const precioVentaInput = document.getElementById('precio-venta');
            const selectedOption = descuentoSelect.options[descuentoSelect.selectedIndex];

            if (!precioCompraInput || !precioVentaInput || !descuentoSelect) return;

            const precioCompra = parseFloat(precioCompraInput.value) || 0;
            const precioVenta = parseFloat(precioVentaInput.value) || 0;
            const descuentoPorcentaje = parseFloat(selectedOption.dataset.cantidad) || 0;

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