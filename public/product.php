<style>
  .glass-card {
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    background: rgba(15, 23, 42, 0.6);
    border: 1px solid rgba(148, 163, 184, 0.2);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
  }

  .glass-light {
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    background: rgba(30, 41, 59, 0.4);
    border: 1px solid rgba(148, 163, 184, 0.3);
  }

  .glass-dark {
    backdrop-filter: blur(25px);
    -webkit-backdrop-filter: blur(25px);
    background: rgba(8, 47, 73, 0.7);
    border: 1px solid rgba(56, 189, 248, 0.3);
  }

  .thumbnail {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
  }

  .thumbnail:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(56, 189, 248, 0.3);
  }

  .thumbnail.active {
    border-color: #38bdf8;
    box-shadow: 0 0 20px rgba(56, 189, 248, 0.5);
  }

  .main-image {
    transition: all 0.5s ease-in-out;
  }

  .fade-in {
    opacity: 0;
    animation: fadeIn 0.5s ease-in-out forwards;
  }

  @keyframes fadeIn {
    to {
      opacity: 1;
    }
  }

  .price-glow {
    text-shadow: 0 0 10px rgba(56, 189, 248, 0.5);
  }

  .gradient-text {
    background: linear-gradient(135deg, #38bdf8, #0ea5e9);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }
</style>

<div class="max-w-7xl mx-auto space-y-12">
  <h1 class="text-4xl font-bold text-center text-white mb-12"> Modelos de Product Cards</h1>
  <!-- MODELO 1: Minimalista Elegante -->
  <div class="mb-16">
    <div class="glass-card rounded-2xl p-8 max-w-4xl mx-auto">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Sección de Imágenes -->
        <div class="space-y-4">
          <div class="aspect-square bg-slate-800/50 rounded-xl overflow-hidden border border-slate-600/30">
            <img id="mainImage1" src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500&h=500&fit=crop"
              alt="Producto principal" class="w-full h-full object-cover main-image">
          </div>
          <div class="flex gap-3">
            <div
              class="thumbnail active w-20 h-20 bg-slate-800/50 rounded-lg overflow-hidden border-2 border-slate-600/30"
              onclick="changeImage(1, 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500&h=500&fit=crop', this)">
              <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=80&h=80&fit=crop" alt="Vista A"
                class="w-full h-full object-cover">
            </div>
            <div class="thumbnail w-20 h-20 bg-slate-800/50 rounded-lg overflow-hidden border-2 border-slate-600/30"
              onclick="changeImage(1, 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=500&h=500&fit=crop', this)">
              <img src="https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=80&h=80&fit=crop" alt="Vista B"
                class="w-full h-full object-cover">
            </div>
            <div class="thumbnail w-20 h-20 bg-slate-800/50 rounded-lg overflow-hidden border-2 border-slate-600/30"
              onclick="changeImage(1, 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=500&h=500&fit=crop', this)">
              <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=80&h=80&fit=crop" alt="Vista C"
                class="w-full h-full object-cover">
            </div>
          </div>
        </div>

        <!-- Información del Producto -->
        <div class="space-y-6">
          <h3 class="text-3xl font-bold gradient-text">Auriculares Premium</h3>
          <div class="text-4xl font-bold text-white price-glow">$299.99</div>

          <div class="space-y-3">
            <h4 class="text-lg font-semibold text-slate-300 mb-3">Características:</h4>
            <div class="space-y-2">
              <div class="flex items-center text-slate-300">
                <div class="w-2 h-2 bg-sky-400 rounded-full mr-3"></div>
                <span>Cancelación activa de ruido</span>
              </div>
              <div class="flex items-center text-slate-300">
                <div class="w-2 h-2 bg-sky-400 rounded-full mr-3"></div>
                <span>Batería de 30 horas</span>
              </div>
              <div class="flex items-center text-slate-300">
                <div class="w-2 h-2 bg-sky-400 rounded-full mr-3"></div>
                <span>Conectividad Bluetooth 5.0</span>
              </div>
              <div class="flex items-center text-slate-300">
                <div class="w-2 h-2 bg-sky-400 rounded-full mr-3"></div>
                <span>Diseño ergonómico</span>
              </div>
              <div class="flex items-center text-slate-300">
                <div class="w-2 h-2 bg-sky-400 rounded-full mr-3"></div>
                <span>Resistente al agua IPX4</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function changeImage(cardNumber, newSrc, clickedThumbnail) {
    // Obtener la imagen principal del card correspondiente
    const mainImage = document.getElementById(`mainImage${cardNumber}`);

    // Remover clase active de todos los thumbnails del card
    const card = clickedThumbnail.closest('.grid').parentNode;
    const thumbnails = card.querySelectorAll('.thumbnail');
    thumbnails.forEach(thumb => thumb.classList.remove('active'));

    // Agregar clase active al thumbnail clickeado
    clickedThumbnail.classList.add('active');

    // Cambiar la imagen con efecto de fade
    mainImage.style.opacity = '0';

    setTimeout(() => {
      mainImage.src = newSrc;
      mainImage.style.opacity = '1';
    }, 200);
  }

  // Agregar efecto de hover a las imágenes principales
  document.addEventListener('DOMContentLoaded', function () {
    const mainImages = document.querySelectorAll('[id^="mainImage"]');

    mainImages.forEach(img => {
      img.addEventListener('mouseenter', function () {
        this.style.transform = 'scale(1.02)';
      });

      img.addEventListener('mouseleave', function () {
        this.style.transform = 'scale(1)';
      });
    });
  });

  // Animación de entrada para los elementos
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };

  const observer = new IntersectionObserver(function (entries) {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
      }
    });
  }, observerOptions);

  // Observar todos los cards
  document.querySelectorAll('.glass-card, .glass-light, .glass-dark').forEach(card => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(30px)';
    card.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
    observer.observe(card);
  });
</script>