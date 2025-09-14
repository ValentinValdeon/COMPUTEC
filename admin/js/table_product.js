let modifiedProducts = new Set();
        let currentProductId = null;
        let allCategories = [];
        let productCategories = [];

        // Cargar categorías al iniciar
        document.addEventListener('DOMContentLoaded', function () {
            loadAllCategories();
            setupEventListeners();
            filterTable();

            // Event listeners para cerrar modales
            document.getElementById('categoryModal').addEventListener('click', function (e) {
                if (e.target === this) closeCategoryModal();
            });

            document.getElementById('propertiesModal').addEventListener('click', function (e) {
                if (e.target === this) closePropertiesModal();
            });

            document.getElementById('imagesModal').addEventListener('click', function (e) {
                if (e.target === this) closeImagesModal();
            });

            // Event listeners para inputs de imágenes

            for (let i = 1; i <= 3; i++) {
                document.getElementById(`image${i}Input`).addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const preview = document.getElementById(`preview${i}`);
                            const placeholder = document.getElementById(`placeholder${i}`);
                            preview.src = e.target.result;
                            preview.classList.remove('hidden');
                            placeholder.classList.add('hidden');
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
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
                        // Asegurarnos que sean números
                        productCategories = data.categories.map(id => Number(id));
                        renderCategoriesList();
                    }
                })
                .catch(error => console.error('Error:', error));
        }


        function renderCategoriesList() {
            const categoriesList = document.getElementById('categoriesList');

            categoriesList.innerHTML = '';

            allCategories.forEach(category => {
                const isSelected = productCategories.includes(Number(category.id_categoria));

                const div = document.createElement('div');
                div.className = 'category-item' + (isSelected ? ' selected' : '');
                div.innerHTML = `<span>📦 ${category.nombre_categoria}</span>
                 <span>${isSelected ? '✗' : '▢'}</span>`;

                // Evento click
                div.addEventListener('click', () => {
                    toggleCategory(category.id_categoria);
                });

                categoriesList.appendChild(div);
            });
        }


        function toggleCategory(categoryId) {
            categoryId = Number(categoryId);
            const index = productCategories.indexOf(categoryId);
            if (index > -1) {
                productCategories.splice(index, 1);
            } else {
                productCategories.push(categoryId);
            }
            renderCategoriesList(); // vuelve a renderizar con los cambios
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

        // FUNCIÓN PARA GUARDAR PRODUCTO
        function saveProduct(id) {
            const nombre = document.querySelector(`.product-nombre[data-id="${id}"]`).value;
            const codigo = document.querySelector(`.product-codigo[data-id="${id}"]`).value;
            const precio_compra = document.querySelector(`.product-precio_compra[data-id="${id}"]`).value;
            const precio_venta = document.querySelector(`.product-precio_venta[data-id="${id}"]`).value;
            const stock = document.querySelector(`.product-stock[data-id="${id}"]`).value;
            const stock_min = document.querySelector(`.product-stock_min[data-id="${id}"]`).value;
            const estado = document.querySelector(`.product-estado[data-id="${id}"]`).checked ? 1 : 0;
            const destacado = document.querySelector(`.product-destacado[data-id="${id}"]`).checked ? 1 : 0;

            const formData = new FormData();
            formData.append('id_producto', id);
            formData.append('nombre', nombre);
            formData.append('codigo', codigo);
            formData.append('precio_compra', precio_compra);
            formData.append('precio_venta', precio_venta);
            formData.append('stock', stock);
            formData.append('stock_min', stock_min);
            formData.append('estado', estado);
            formData.append('destacado', destacado);

            fetch('update_product.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Producto actualizado correctamente');
                        location.reload();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error de conexión');
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

        // FUNCIONES DE FILTRADO

        function setupEventListeners() {
            // Event listeners para filtros
            document.getElementById('search-input').addEventListener('input', filterTable);
            document.getElementById('category-filter').addEventListener('change', filterTable);
            document.getElementById('stock-minimo-filter').addEventListener('change', filterTable);
            document.getElementById('destacados-filter').addEventListener('change', filterTable);
            document.getElementById('descuentos-filter').addEventListener('change', filterTable);
            document.getElementById('inactivos-filter').addEventListener('change', filterTable);

            // Cerrar modales al hacer click fuera
            document.getElementById('categoryModal').addEventListener('click', function (e) {
                if (e.target === this) closeCategoryModal();
            });

            document.getElementById('propertiesModal').addEventListener('click', function (e) {
                if (e.target === this) closePropertiesModal();
            });
        }

        function filterTable() {
            const searchTerm = document.getElementById('search-input').value.toLowerCase();
            const categoryFilter = document.getElementById('category-filter').value;
            const stockMinimoFilter = document.getElementById('stock-minimo-filter').checked;
            const destacadosFilter = document.getElementById('destacados-filter').checked;
            const descuentosFilter = document.getElementById('descuentos-filter').checked;
            const inactivosFilter = document.getElementById('inactivos-filter').checked;

            const rows = document.querySelectorAll('#products-table-body tr');
            let visibleCount = 0;

            rows.forEach(row => {
                const nombre = row.querySelector('.product-nombre').value.toLowerCase();
                const codigo = row.querySelector('.product-codigo').value.toLowerCase();
                const estado = row.querySelector('.product-estado').checked;
                const destacado = row.querySelector('.product-destacado').checked;
                const stock = parseInt(row.querySelector('.product-stock').value);
                const stockMin = parseInt(row.querySelector('.product-stock_min').value);

                const productCategories = row.getAttribute('data-categories').split(',');

                const descuentoCell = row.cells[6];
                const descuentoText = descuentoCell.textContent.trim();
                const descuentoValue = parseInt(descuentoText.replace('%', '')) || 0;

                let visible = true;

                // Filtro de búsqueda
                if (searchTerm && !nombre.includes(searchTerm) && !codigo.includes(searchTerm)) {
                    visible = false;
                }

                // Filtro de categoría
                if (categoryFilter && !productCategories.includes(categoryFilter)) {
                    visible = false;
                }

                // LÓGICA MODIFICADA PARA ESTADO:
                if (!inactivosFilter && !estado) {
                    visible = false; // Ocultar inactivos por defecto
                } else if (inactivosFilter && estado) {
                    visible = false; // Si filtro inactivos está marcado, ocultar activos
                }

                // Filtro destacados
                if (destacadosFilter && !destacado) visible = false;

                // Filtro stock mínimo
                if (stockMinimoFilter && stock > stockMin) visible = false;

                // Filtro de descuentos
                if (descuentosFilter && descuentoValue === 0) {
                    visible = false;
                }

                if (visible) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            const noProductsMsg = document.getElementById('no-products-message');
            if (visibleCount === 0) {
                noProductsMsg.classList.remove('hidden');
            } else {
                noProductsMsg.classList.add('hidden');
            }
        }

        // LIMPIAR FILTROS
        function clearAllFilters() {
            document.getElementById('search-input').value = '';
            document.getElementById('category-filter').value = '';
            document.getElementById('stock-minimo-filter').checked = false;
            document.getElementById('destacados-filter').checked = false;
            document.getElementById('descuentos-filter').checked = false;
            document.getElementById('inactivos-filter').checked = false;
            filterTable();
        }

        // FUNCIONES DE IMÁGENES
        function openImagesModal(productId) {
            currentProductId = productId;
            const productName = document.querySelector(`.product-nombre[data-id="${productId}"]`).value;
            document.getElementById('imagesProductName').textContent = productName;
            
            loadProductImages(productId);
            document.getElementById('imagesModal').classList.remove('hidden');
            console.log("Abriendo modal de imágenes para el producto ID:", productId);
            
        }

        function closeImagesModal() {
            document.getElementById('imagesModal').classList.add('hidden');
            currentProductId = null;
            // Limpiar previews
            for (let i = 1; i <= 3; i++) {
                document.getElementById(`preview${i}`).classList.add('hidden');
                document.getElementById(`placeholder${i}`).classList.remove('hidden');
                document.getElementById(`image${i}Input`).value = '';
                document.getElementById(`current${i}`).value = '';
            }
        }

        function loadProductImages(productId) {
            fetch(`get_product_images.php?id=${productId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const images = data.images;
                        for (let i = 1; i <= 3; i++) {
                            const imageUrl = images[`imagen_${i}`];
                            const preview = document.getElementById(`preview${i}`);
                            const placeholder = document.getElementById(`placeholder${i}`);
                            const current = document.getElementById(`current${i}`);
                            
                            if (imageUrl && imageUrl.trim() !== '') {
                                preview.src = imageUrl;
                                preview.classList.remove('hidden');
                                placeholder.classList.add('hidden');
                                current.value = imageUrl;
                            } else {
                                preview.classList.add('hidden');
                                placeholder.classList.remove('hidden');
                                current.value = '';
                            }
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function saveImageChanges() {
            if (!currentProductId) return;

            const formData = new FormData();
            formData.append('id_producto', currentProductId);
            
            // Agregar archivos e imágenes actuales
            for (let i = 1; i <= 3; i++) {
                const fileInput = document.getElementById(`image${i}Input`);
                const currentImage = document.getElementById(`current${i}`).value;
                
                if (fileInput.files[0]) {
                    formData.append(`imagen_${i}`, fileInput.files[0]);
                } else if (currentImage) {
                    formData.append(`current_imagen_${i}`, currentImage);
                }
            }

            fetch('update_product_images.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Imágenes actualizadas correctamente');
                    location.reload();
                } else {
                    alert('Error al actualizar imágenes: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error de conexión');
            })
            .finally(() => {
                closeImagesModal();
            });
        }