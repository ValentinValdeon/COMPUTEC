// Estado de la aplicación
        let currentFilter = 'all';
let searchTerm = '';

// Referencias DOM
const filterBtns = document.querySelectorAll('.filter-btn');
const productCards = document.querySelectorAll('.product-card-gallery');
const searchInput = document.getElementById('searchInput-shop');
const gallery = document.getElementById('gallery'); // contenedor de las cards

// Función para filtrar productos
function filterProducts() {
    let visibleCards = [];

    productCards.forEach(card => {
        const categories = card.getAttribute('data-category')
            .toLowerCase()
            .split(',');
        const title = card.querySelector('.product-title-gallery').textContent.toLowerCase();
        const description = card.querySelector('.product-description-gallery').textContent.toLowerCase();

        const matchesFilter = currentFilter === 'all' || categories.includes(currentFilter);
        const matchesSearch =
            searchTerm === '' ||
            title.includes(searchTerm.toLowerCase()) ||
            description.includes(searchTerm.toLowerCase());

        if (matchesFilter && matchesSearch) {
            card.style.display = 'block';
            card.classList.add('fade-in');
            visibleCards.push(card);
        } else {
            card.style.display = 'none';
            card.classList.remove('fade-in');
        }
    });

    // 🔹 Randomizar el orden de las visibles
    shuffleArray(visibleCards);

    // 🔹 Reinsertarlas en el contenedor en orden random
    visibleCards.forEach(card => gallery.appendChild(card));
}

// Función para mezclar un array (Fisher-Yates shuffle)
function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
}

// Event listeners para filtros
filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        filterBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        currentFilter = btn.getAttribute('data-category').toLowerCase();

        filterProducts();
    });
});

// Event listener para búsqueda
searchInput.addEventListener('input', (e) => {
    searchTerm = e.target.value;
    filterProducts();
});

// 🔹 Inicialización al cargar
filterProducts();

function goToProduct(card) {
    const productId = card.getAttribute('data-id');
    // Redirige respetando la estructura de tu URL
    window.location.href = `index.php?page=product&id=${productId}`;
}


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