//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Variables globales
let allProducts = [];
let destacadosProducts = [];
let descuentosProducts = [];

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Función para obtener todos los productos
async function loadProducts() {
    try {
        const response = await fetch('../admin/get_products.php');
        const data = await response.json();
        
        if (data.success) {
            allProducts = data.products;
            
            // Filtrar productos activos
            const activeProducts = allProducts.filter(product => product.estado == 1);
            
            // Filtrar productos destacados
            destacadosProducts = activeProducts.filter(product => product.destacado == 1);
            
            // Filtrar productos con descuentos
            descuentosProducts = activeProducts.filter(product => 
                product.descuento_cantidad > 0 && product.id_descuento
            );
            
            // Cargar las secciones
            loadDestacados();
            loadDescuentos();
        } else {
            showError('destacados');
            showError('descuentos');
            console.error('Error al obtener productos:', data.message);
        }
    } catch (error) {
        showError('destacados');
        showError('descuentos');
        console.error('Error al cargar productos:', error);
    }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Función para mostrar errores
function showError(section) {
    document.getElementById(`${section}-loading`).style.display = 'none';
    document.getElementById(`${section}-error`).style.display = 'block';
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Crear card de producto
function createProductCard(product, isLarge = false, isSmall = false) {
    const imageSrc = `../uploads/products/${product.imagen_1}` || 
        'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=400&h=300&fit=crop&crop=center';
    
    const precio = parseFloat(product.precio_venta);
    const descuento = parseFloat(product.descuento_cantidad) || 0;
    const precioConDescuento = precio * (1 - descuento / 100);

    // Stock
    let stockStatus = 'En stock';
    let stockColor = 'text-green-400';
    if (product.stock <= 0) {
        stockStatus = 'Sin stock';
        stockColor = 'text-red-400';
    } else if (product.stock <= product.stock_min) {
        stockStatus = 'Pocas unidades';
        stockColor = 'text-yellow-400';
    }

    if (isLarge) {
        return `
            <div class="image-placeholder-descuento w-full h-80 rounded-xl mb-6 flex items-center justify-center">
                <img src="${imageSrc}" alt="${product.nombre}" class="w-full h-full object-cover rounded-xl">
            </div>
            ${descuento > 0 ? `<div class="discount-badge-floating">-${descuento}%</div>` : ''}
            <div class="space-y-3">
                <h3 class="product-title-descuento text-2xl">${product.nombre}</h3>
                <div class="price-container-horizontal">
                    ${descuento > 0 ? `<div class="product-price-original text-lg">$${precio.toFixed(2)}</div>` : ''}
                    <div class="product-price-descuento text-3xl">$${(descuento > 0 ? precioConDescuento : precio).toFixed(2)}</div>
                </div>
            </div>
        `;
    } else if (isSmall) {
        return `
            <div class="image-placeholder-descuento w-full h-fit rounded-lg mb-4 flex items-center justify-center">
                <img src="${imageSrc}" alt="${product.nombre}" class="w-full h-full object-cover rounded-xl">
            </div>
            <h4 class="product-title-descuento text-sm mb-2">${product.nombre}</h4>
            ${descuento > 0 ? `<div class="discount-badge-floating product-sm">-${descuento}%</div>` : ''}
            <div class="price-container-horizontal">
                ${descuento > 0 ? `<div class="product-price-original text-sm">$${precio.toFixed(2)}</div>` : ''}
                <div class="product-price-descuento text-lg">$${(descuento > 0 ? precioConDescuento : precio).toFixed(2)}</div>
            </div>
        `;
    } else {
        return `
            <div class="text-center bg-transparent">
                <div class="product-card rounded-2xl p-6 w-full max-w-sm mx-auto cursor-pointer" onclick="goToProduct(${product.id_producto})">
                    <div class="product-image mb-6">
                        <img src="${imageSrc}" alt="${product.nombre}" class="w-full h-48 object-cover rounded-xl">
                    </div>
                    <div class="space-y-3">
                        <h3 class="product-title text-xl leading-tight">${product.nombre}</h3>
                        <div class="flex items-center justify-between pt-2">
                            <span class="product-price">$${precio.toFixed(2)}</span>
                            <div class="flex items-center space-x-1 text-slate-500">
                                <svg class="w-4 h-4" fill="none" stroke="white" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-xs ${stockColor}">${stockStatus}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Cargar destacados
function loadDestacados() {
    const carouselTrack = document.getElementById('carouselTrack');
    const loadingEl = document.getElementById('destacados-loading');
    
    if (destacadosProducts.length === 0) {
        loadingEl.innerHTML = '<p>No hay productos destacados disponibles.</p>';
        return;
    }
    
    carouselTrack.innerHTML = '';
    destacadosProducts.forEach(product => {
        carouselTrack.innerHTML += createProductCard(product);
    });
    
    loadingEl.style.display = 'none';
    if (typeof initCarousel === 'function') initCarousel();
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Cargar descuentos
function loadDescuentos() {
    const loadingEl = document.getElementById('descuentos-loading');
    const gridEl = document.getElementById('showcase-grid-descuento');
    const buttonEl = document.getElementById('descuentos-button');
    
    if (descuentosProducts.length === 0) {
        loadingEl.innerHTML = '<p>No hay productos con descuentos disponibles.</p>';
        return;
    }
    
    const shuffledProducts = [...descuentosProducts].sort(() => 0.5 - Math.random());
    const selectedProducts = shuffledProducts.slice(0, 8);
    
    if (selectedProducts[0]) {
        const largeCard1 = document.getElementById('product-card-large-descuento-1');
        largeCard1.innerHTML = createProductCard(selectedProducts[0], true);
        largeCard1.onclick = () => goToProduct(selectedProducts[0].id_producto);
    }
    if (selectedProducts[1]) {
        const largeCard2 = document.getElementById('product-card-large-descuento-2');
        largeCard2.innerHTML = createProductCard(selectedProducts[1], true);
        largeCard2.onclick = () => goToProduct(selectedProducts[1].id_producto);
    }
    
    for (let i = 2; i < Math.min(8, selectedProducts.length); i++) {
        const smallCard = document.getElementById(`product-card-descuento-${i-1}`);
        if (smallCard) {
            smallCard.innerHTML = createProductCard(selectedProducts[i], false, true);
            smallCard.onclick = () => goToProduct(selectedProducts[i].id_producto);
        }
    }
    
    loadingEl.style.display = 'none';
    gridEl.style.display = 'grid';
    buttonEl.style.display = 'flex';
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Navegación
function goToProduct(productId) {
    window.location.href = `product.php?id=${productId}`;
}
function getProductById(id) {
    return allProducts.find(product => product.id_producto == id);
}
document.addEventListener('DOMContentLoaded', () => loadProducts());
window.getProductById = getProductById;

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Carrusel de imágenes
const images = ['image1', 'image2', 'image3', 'image4'];
const indicators = document.querySelectorAll('.indicator');
let currentIndex = 0;

function changeImage() {
    document.getElementById(images[currentIndex]).classList.replace('fade-in','fade-out');
    indicators[currentIndex].classList.replace('bg-white/50','bg-white/30');
    currentIndex = (currentIndex + 1) % images.length;
    setTimeout(() => {
        document.getElementById(images[currentIndex]).classList.replace('fade-out','fade-in');
        indicators[currentIndex].classList.replace('bg-white/30','bg-white/50');
    }, 100);
}
setInterval(changeImage, 4000);
indicators.forEach((ind, i) => ind.addEventListener('click', () => {
    if (i !== currentIndex) {
        document.getElementById(images[currentIndex]).classList.replace('fade-in','fade-out');
        indicators[currentIndex].classList.replace('bg-white/50','bg-white/30');
        currentIndex = i;
        setTimeout(() => {
            document.getElementById(images[currentIndex]).classList.replace('fade-out','fade-in');
            indicators[currentIndex].classList.replace('bg-white/30','bg-white/50');
        }, 100);
    }
}));

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ModernCarousel
class ModernCarousel {
    constructor() {
        this.track = document.getElementById('carouselTrack');
        this.prevBtn = document.getElementById('prevBtn');
        this.nextBtn = document.getElementById('nextBtn');
        this.items = this.track.children;
        this.currentIndex = 0;
        this.itemsPerView = this.getItemsPerView();
        this.totalItems = this.items.length;
        this.maxIndex = Math.max(0, this.totalItems - this.itemsPerView);

        this.init();
        this.setupEventListeners();
        this.updateButtons();
    }
    getItemsPerView() {
        const w = window.innerWidth;
        if (w >= 1280) return 4;
        if (w >= 1024) return 3;
        if (w >= 768) return 2;
        return 1;
    }
    init() { this.updateCarousel(); }
    setupEventListeners() {
        this.prevBtn.addEventListener('click', () => this.prev());
        this.nextBtn.addEventListener('click', () => this.next());
        window.addEventListener('resize', () => {
            this.itemsPerView = this.getItemsPerView();
            this.maxIndex = Math.max(0, this.totalItems - this.itemsPerView);
            this.currentIndex = Math.min(this.currentIndex, this.maxIndex);
            this.updateCarousel();
            this.updateButtons();
        });
    }
    prev() {
        if (this.currentIndex > 0) {
            const step = Math.max(1, Math.floor(this.itemsPerView / 2));
            this.currentIndex = Math.max(0, this.currentIndex - step);
            this.updateCarousel();
            this.updateButtons();
        }
    }
    next() {
        if (this.currentIndex < this.maxIndex) {
            const step = Math.max(1, Math.floor(this.itemsPerView / 2));
            this.currentIndex = Math.min(this.maxIndex, this.currentIndex + step);
            this.updateCarousel();
            this.updateButtons();
        }
    }
    updateCarousel() {
        const itemWidth = 324; // 300 + 24 gap
        this.track.style.transform = `translateX(${-this.currentIndex * itemWidth}px)`;
    }
    updateButtons() {
        this.prevBtn.style.opacity = this.currentIndex === 0 ? '0.5' : '1';
        this.prevBtn.style.pointerEvents = this.currentIndex === 0 ? 'none' : 'auto';
        this.nextBtn.style.opacity = this.currentIndex >= this.maxIndex ? '0.5' : '1';
        this.nextBtn.style.pointerEvents = this.currentIndex >= this.maxIndex ? 'none' : 'auto';
    }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Animaciones y partículas (fusionadas sin duplicados)
const productCards = document.querySelectorAll('.product-card');
function createParticles(element) {
    const rect = element.getBoundingClientRect();
    for (let i = 0; i < 15; i++) {
        const p = document.createElement('div');
        p.className = 'particle';
        p.style.left = Math.random() * rect.width + 'px';
        p.style.top = Math.random() * rect.height + 'px';
        element.appendChild(p);
        setTimeout(() => p.remove(), 5000);
    }
}
productCards.forEach((card, index) => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(50px) scale(0.9)';
    card.style.transition = 'all 0.6s cubic-bezier(0.4,0,0.2,1)';
    card.addEventListener('mouseenter', e => createParticles(e.currentTarget));
    card.addEventListener('mousemove', function () {
        this.style.transition = 'transform 0.5s ease-out';
        this.style.transform = 'scale(1.02) translateY(-4px)';
    });
    card.addEventListener('mouseleave', function () {
        this.style.transition = 'transform 0.3s ease';
        this.style.transform = 'scale(1) translateY(0)';
    });
    setTimeout(() => {
        card.style.opacity = '1';
        card.style.transform = 'translateY(0) scale(1)';
    }, 200 + (index * 100));
});
document.addEventListener('DOMContentLoaded', () => new ModernCarousel());

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Intersection Observer
const observer = new IntersectionObserver(entries => {
    entries.forEach(e => {
        if (e.isIntersecting) {
            e.target.classList.add('animate-show','opacity-100','translate-y-0');
            e.target.classList.remove('blur-sm');
        }
    });
}, { threshold: 0.2 });
document.querySelectorAll('[data-animate]').forEach(sec => observer.observe(sec));

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Cards de descuentos
const productCardsDesc = document.querySelectorAll('.product-card-descuento, .product-card-large-descuento');
productCardsDesc.forEach((card, i) => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(20px)';
    card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    setTimeout(() => {
        card.style.opacity = '1';
        card.style.transform = 'translateY(0)';
    }, i * 100);
});
const button = document.querySelector('.glass-button-descuento');
if (button) {
    button.addEventListener('click', function () {
        this.style.transform = 'translateY(0) scale(0.98)';
        setTimeout(() => this.style.transform = 'translateY(-1px) scale(1)', 150);
    });
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Banners, servicios, inputs y newsletter
const banners = document.querySelectorAll('.glass-banner');
banners.forEach((b, i) => {
    b.style.opacity = '0';
    b.style.transform = 'translateY(30px)';
    b.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
    setTimeout(() => {
        b.style.opacity = '1';
        b.style.transform = 'translateY(0)';
    }, i * 200);
});
document.querySelectorAll('.service-icon').forEach(icon => {
    icon.parentElement.addEventListener('mouseenter', () => icon.style.transform = 'scale(1.05)');
    icon.parentElement.addEventListener('mouseleave', () => icon.style.transform = 'scale(1)');
});
const input = document.querySelector('.glass-input');
if (input) {
    input.addEventListener('focus', function () { this.style.transform = 'scale(1.02)'; });
    input.addEventListener('blur', function () { this.style.transform = 'scale(1)'; });
}
const subscribeButton = document.querySelector('.glass-button');
if (subscribeButton) {
    subscribeButton.addEventListener('click', function (e) {
        e.preventDefault();
        this.style.transform = 'translateY(0) scale(0.98)';
        setTimeout(() => this.style.transform = 'translateY(-1px) scale(1)', 150);
    });
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Botón ir a shop
document.getElementById('btn-ir-shop-descuento').addEventListener('click', () => {
    window.location.href = 'index.php?page=shop';
});
