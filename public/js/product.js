//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 🔹 Función: cambiar imagen principal desde thumbnails
function changeImage(cardNumber, newSrc, clickedThumbnail) {
    const mainImage = document.getElementById(`mainImage${cardNumber}`);

    // Remover clase active de todos los thumbnails del card
    const card = clickedThumbnail.closest('.grid').parentNode;
    const thumbnails = card.querySelectorAll('[class*="thumbnail-"]');
    thumbnails.forEach(thumb => thumb.classList.remove('active'));

    // Activar el thumbnail clickeado
    clickedThumbnail.classList.add('active');

    // Cambiar la imagen con efecto fade
    mainImage.style.opacity = '0';
    setTimeout(() => {
        mainImage.src = newSrc;
        mainImage.style.opacity = '1';
    }, 200);
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 🔹 Clase: Carousel moderno
class ModernCarousel {
    constructor() {
        this.track = document.getElementById('carouselTrack');
        this.prevBtn = document.getElementById('prevBtn');
        this.nextBtn = document.getElementById('nextBtn');
        this.items = this.track.children;
        this.currentOffset = 0; // desplazamiento en píxeles
        this.step = this.getStep(); // cuántos px mover por click
        this.totalItems = this.items.length;

        this.init();
        this.setupEventListeners();
        this.updateButtons();
    }

    getStep() {
        const width = window.innerWidth;
        if (width >= 1280) return 3 * 425;   // 3 cards de 300px
        if (width >= 1024) return 2 * 425;   // 3 cards de 400px
        if (width >= 768) return 2 * 350;    // 2 cards de 275px
        return 1 * 200;                      // 1 card de 200px
    }

    init() {
        this.updateCarousel();
    }

    setupEventListeners() {
        this.prevBtn.addEventListener('click', () => this.prev());
        this.nextBtn.addEventListener('click', () => this.next());

        window.addEventListener('resize', () => {
            this.step = this.getStep();
            this.currentOffset = 0;
            this.updateCarousel();
            this.updateButtons();
        });
    }

    prev() {
        if (this.currentOffset < 0) {
            this.currentOffset = Math.min(this.currentOffset + this.step, 0);
            this.updateCarousel();
            this.updateButtons();
        }
    }

    next() {
        const maxOffset = -(this.track.scrollWidth - this.track.clientWidth);
        if (this.currentOffset > maxOffset) {
            this.currentOffset = Math.max(this.currentOffset - this.step, maxOffset);
            this.updateCarousel();
            this.updateButtons();
        }
    }

    updateCarousel() {
        this.track.style.transform = `translateX(${this.currentOffset}px)`;
        this.track.style.transition = 'transform 0.5s ease';
    }

    updateButtons() {
        const maxOffset = -(this.track.scrollWidth - this.track.clientWidth);

        this.prevBtn.style.opacity = this.currentOffset === 0 ? '0.5' : '1';
        this.prevBtn.style.pointerEvents = this.currentOffset === 0 ? 'none' : 'auto';

        this.nextBtn.style.opacity = this.currentOffset <= maxOffset ? '0.5' : '1';
        this.nextBtn.style.pointerEvents = this.currentOffset <= maxOffset ? 'none' : 'auto';
    }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 🔹 Product card effects (hover + partículas)
const productCards = document.querySelectorAll('.product-card');

productCards.forEach(card => {
    card.addEventListener('mouseenter', e => createParticles(e.currentTarget));

    card.addEventListener('mousemove', function () {
        this.style.transition = 'transform 0.5s ease-out';
        this.style.transform = 'scale(1.02)';
    });

    card.addEventListener('mouseleave', function () {
        this.style.transition = 'transform 0.3s ease';
        this.style.transform = 'scale(1)';
    });
});

function createParticles(element) {
    const rect = element.getBoundingClientRect();
    const particles = 15;

    for (let i = 0; i < particles; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';

        const x = Math.random() * rect.width;
        const y = Math.random() * rect.height;

        particle.style.left = x + 'px';
        particle.style.top = y + 'px';

        element.appendChild(particle);

        setTimeout(() => particle.remove(), 5000);
    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 🔹 Animaciones de entrada + inicialización
document.addEventListener('DOMContentLoaded', function () {
    const carousel = new ModernCarousel();
    carousel.updateItems();

    // Entrada animada de las cards
    productCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(50px) scale(0.9)';
        card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';

        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0) scale(1)';
        }, 200 + (index * 100));
    });

    // Hover imágenes principales
    const mainImages = document.querySelectorAll('[id^="mainImage"]');
    mainImages.forEach(img => {
        img.addEventListener('mouseenter', () => img.style.transform = 'scale(1.02)');
        img.addEventListener('mouseleave', () => img.style.transform = 'scale(1)');
    });
});
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 🔹 Función: redirigir a producto
function goToProduct(card) {
    const productId = card.getAttribute('data-id');
    window.location.href = `index.php?page=product&id=${productId}`;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
