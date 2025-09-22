    const images = ['image1', 'image2', 'image3', 'image4'];
    const indicators = document.querySelectorAll('.indicator');
    let currentIndex = 0;

    function changeImage() {
      // Fade out current image
      document.getElementById(images[currentIndex]).classList.remove('fade-in');
      document.getElementById(images[currentIndex]).classList.add('fade-out');
      indicators[currentIndex].classList.remove('bg-white/50');
      indicators[currentIndex].classList.add('bg-white/30');

      // Move to next image
      currentIndex = (currentIndex + 1) % images.length;

      setTimeout(() => {
        // Fade in next image
        document.getElementById(images[currentIndex]).classList.remove('fade-out');
        document.getElementById(images[currentIndex]).classList.add('fade-in');
        indicators[currentIndex].classList.remove('bg-white/30');
        indicators[currentIndex].classList.add('bg-white/50');
      }, 100);
    }

    // Change image every 4 seconds
    setInterval(changeImage, 4000);

    // Add click functionality to indicators
    indicators.forEach((indicator, index) => {
      indicator.addEventListener('click', () => {
        if (index !== currentIndex) {
          document.getElementById(images[currentIndex]).classList.remove('fade-in');
          document.getElementById(images[currentIndex]).classList.add('fade-out');
          indicators[currentIndex].classList.remove('bg-white/50');
          indicators[currentIndex].classList.add('bg-white/30');

          currentIndex = index;

          setTimeout(() => {
            document.getElementById(images[currentIndex]).classList.remove('fade-out');
            document.getElementById(images[currentIndex]).classList.add('fade-in');
            indicators[currentIndex].classList.remove('bg-white/30');
            indicators[currentIndex].classList.add('bg-white/50');
          }, 100);
        }
      });
    });

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Carousel functionality
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
        const width = window.innerWidth;
        if (width >= 1280) return 4;
        if (width >= 1024) return 3;
        if (width >= 768) return 2;
        return 1;
    }

    init() {
        this.updateCarousel();
    }

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
            const step = this.itemsPerView;
            this.currentIndex = Math.max(0, this.currentIndex - step);
            this.updateCarousel();
            this.updateButtons();
        }
    }

    next() {
        if (this.currentIndex < this.maxIndex) {
            const step = this.itemsPerView;
            this.currentIndex = Math.min(this.maxIndex, this.currentIndex + step);
            this.updateCarousel();
            this.updateButtons();
        }
    }


    updateCarousel() {
        if (this.items.length === 0) return;

        const item = this.items[0];
        const style = window.getComputedStyle(item);
        const gap = parseInt(style.marginRight) || 0;
        const itemWidth = item.offsetWidth + gap;

        // Calcular máximo desplazamiento para que no se vea espacio vacío
        const maxTranslate = Math.max(0, (this.totalItems - this.itemsPerView) * itemWidth);

        let translateX = this.currentIndex * itemWidth;
        translateX = Math.min(translateX, maxTranslate); // no pasar el límite
        translateX = -translateX; // invertimos para el translateX

        this.track.style.transform = `translateX(${translateX}px)`;
        this.track.style.transition = 'transform 0.5s ease';
    }



    updateItems() {
        // Contar SOLO los elementos que tengan la clase product-card
        this.items = this.track.querySelectorAll('.product-card');
        this.totalItems = this.items.length;
        this.maxIndex = Math.max(0, this.totalItems - this.itemsPerView);
        this.currentIndex = Math.min(this.currentIndex, this.maxIndex);
        this.updateCarousel();
        this.updateButtons();

        console.log("[Carousel] updateItems - totalItems:", this.totalItems, "maxIndex:", this.maxIndex);
    }


    updateButtons() {
        this.prevBtn.style.opacity = this.currentIndex === 0 ? '0.5' : '1';
        this.prevBtn.style.pointerEvents = this.currentIndex === 0 ? 'none' : 'auto';

        this.nextBtn.style.opacity = this.currentIndex >= this.maxIndex ? '0.5' : '1';
        this.nextBtn.style.pointerEvents = this.currentIndex >= this.maxIndex ? 'none' : 'auto';
    }
}


    // Product card effects
    const productCards = document.querySelectorAll('.product-card');

    productCards.forEach(card => {
        card.addEventListener('mouseenter', function (e) {
            createParticles(e.currentTarget);
        });

        card.addEventListener('mousemove', function (e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

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

            setTimeout(() => {
                particle.remove();
            }, 5000);
        }
    }

    // Initialize carousel when DOM is loaded
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
    });
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-show', 'opacity-100', 'translate-y-0');
                entry.target.classList.remove('blur-sm');
            }
        });
    }, { threshold: 0.2 });

    document.querySelectorAll('[data-animate]').forEach(section => {
        observer.observe(section);
    });
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Efectos de partículas en hover
    productCards.forEach(card => {
        card.addEventListener('mouseenter', function (e) {
            createParticles(e.currentTarget);
        });

        // Efecto de seguimiento del mouse sutil
        card.addEventListener('mousemove', function (e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            this.style.transition = 'transform 0.5s ease-out'; // velocidad rápida
            this.style.transform = `scale(1.02) translateY(-4px)`;
        });


        card.addEventListener('mouseleave', function () {
            this.style.transition = 'transform 0.3s ease';
            this.style.transform = 'scale(1) translateY(0)';
        });
    });

    function createParticles(element) {
        const rect = element.getBoundingClientRect();
        const particles = 15;

        for (let i = 0; i < particles; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';

            // Posición aleatoria dentro del card
            const x = Math.random() * rect.width;
            const y = Math.random() * rect.height;

            particle.style.left = x + 'px';
            particle.style.top = y + 'px';

            element.appendChild(particle);

            // Remover la partícula después de la animación
            setTimeout(() => {
                particle.remove();
            }, 5000);
        }
    }

    // Animación de entrada
    window.addEventListener('load', function () {
        productCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(50px) scale(0.9)';
            card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';

            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0) scale(1)';
            }, 200 + (index * 100));
        });
    });
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // Efectos sutiles para las cards (se actualizaron las clases a "-descuento")
    const productCardsDesc = document.querySelectorAll('.product-card-descuento, .product-card-large-descuento');

    productCardsDesc.forEach(card => {
        // Animación de entrada
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    });

    // Animación escalonada de entrada
    window.addEventListener('load', function () {
        productCardsDesc.forEach((card, index) => {
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });

    // Efecto sutil en el botón
    const button = document.querySelector('.glass-button-descuento');
    if (button) {
        button.addEventListener('click', function () {
            this.style.transform = 'translateY(0) scale(0.98)';
            setTimeout(() => {
                this.style.transform = 'translateY(-1px) scale(1)';
            }, 150);
        });
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // Animación de entrada para los banners
    const banners = document.querySelectorAll('.glass-banner');

    banners.forEach((banner, index) => {
        banner.style.opacity = '0';
        banner.style.transform = 'translateY(30px)';
        banner.style.transition = 'opacity 0.8s ease, transform 0.8s ease';

        setTimeout(() => {
            banner.style.opacity = '1';
            banner.style.transform = 'translateY(0)';
        }, index * 200);
    });

    // Efecto hover sutil en iconos de servicios
    const serviceIcons = document.querySelectorAll('.service-icon');
    serviceIcons.forEach(icon => {
        icon.parentElement.addEventListener('mouseenter', function () {
            icon.style.transform = 'scale(1.05)';
        });

        icon.parentElement.addEventListener('mouseleave', function () {
            icon.style.transform = 'scale(1)';
        });
    });

    // Efecto en el input
    const input = document.querySelector('.glass-input');
    input.addEventListener('focus', function () {
        this.style.transform = 'scale(1.02)';
    });

    input.addEventListener('blur', function () {
        this.style.transform = 'scale(1)';
    });

    // Efecto en botón de newsletter
    const subscribeButton = document.querySelector('.glass-button');
    subscribeButton.addEventListener('click', function (e) {
        e.preventDefault();
        this.style.transform = 'translateY(0) scale(0.98)';
        setTimeout(() => {
            this.style.transform = 'translateY(-1px) scale(1)';
        }, 150);
    });
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
document.getElementById('btn-ir-shop-descuento').addEventListener('click', function() {
    window.location.href = 'index.php?page=shop';
});


function goToProduct(card) {
    const productId = card.getAttribute('data-id');
    // Redirige respetando la estructura de tu URL
    window.location.href = `index.php?page=product&id=${productId}`;
}