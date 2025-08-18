// Estado de la aplicación
        let currentFilter = 'all';
        let searchTerm = '';

        // Referencias DOM
        const filterBtns = document.querySelectorAll('.filter-btn');
        const productCards = document.querySelectorAll('.product-card-gallery');
        const searchInput = document.getElementById('searchInput');

        // Función para filtrar productos
        function filterProducts() {
            productCards.forEach(card => {
                const category = card.getAttribute('data-category');
                const title = card.querySelector('.product-title-gallery').textContent.toLowerCase();
                const description = card.querySelector('.product-description-gallery').textContent.toLowerCase();
                
                const matchesFilter = currentFilter === 'all' || category === currentFilter;
                const matchesSearch = searchTerm === '' || 
                    title.includes(searchTerm.toLowerCase()) || 
                    description.includes(searchTerm.toLowerCase());
                
                if (matchesFilter && matchesSearch) {
                    card.style.display = 'block';
                    card.classList.add('fade-in');
                } else {
                    card.style.display = 'none';
                    card.classList.remove('fade-in');
                }
            });
        }

        // Event listeners para filtros
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Actualizar estado activo
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                
                // Actualizar filtro actual
                currentFilter = btn.getAttribute('data-category');
                
                // Filtrar productos
                filterProducts();
            });
        });

        // Event listener para búsqueda
        searchInput.addEventListener('input', (e) => {
            searchTerm = e.target.value;
            filterProducts();
        });

        // Animación inicial
        document.addEventListener('DOMContentLoaded', () => {
            productCards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });

        // Efectos de hover para las tarjetas
        productCards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-10px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0) scale(1)';
            });
        });