<style>
  :root {
    /* Colores sólidos */
    --color-bg-oscuro: #1a4a47;
    --color-amarillo: #f4d03f;
    --color-gris-oscuro: #2d5a5a;
    --color-blanco: #ffffff;
    --color-blanco-hueso: #f8fafc;
    --color-gris-texto: #e2e8f0;
    --color-amarillo-claro: #ffd700;
    --color-gris-placeholder: #64748b;
    --color-gris-medio: #cbd5e1;
    --color-gris-oscuro2: #374151;
    --color-gris-oscuro3: #4b5563;
    --color-gris-icono: #9ca3af;
    --color-verde-claro: #27ae60;

    /* Colores RGBA */
    --color-amarillo-rgba-04: rgba(244, 208, 63, 0.4);
    --color-amarillo-rgba-03: rgba(244, 208, 63, 0.3);
    --color-amarillo-rgba-02: rgba(244, 208, 63, 0.2);
    --color-amarillo-rgba-06: rgba(244, 208, 63, 0.6);
    --color-bg-oscuro-rgba-06: rgba(26, 74, 71, 0.6);
    --color-bg-oscuro-rgba-08: rgba(26, 74, 71, 0.8);
    --color-bg-oscuro-rgba-09: rgba(26, 74, 71, 0.9);
  }

  body {
    background: linear-gradient(135deg, var(--color-bg-oscuro), var(--color-gris-oscuro));
    min-height: 100vh;
  }

  .glass-card-v1 {
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    background: var(--color-bg-oscuro-rgba-09);
    border: 1px solid var(--color-amarillo-rgba-03);
    box-shadow: 0 25px 50px -12px rgba(26, 74, 71, 0.5);
  }

  .thumbnail-v1 {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    background: var(--color-gris-oscuro);
    border: 2px solid var(--color-amarillo-rgba-02);
  }

  .thumbnail-v1:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px var(--color-amarillo-rgba-04);
    border-color: var(--color-amarillo);
  }

  .thumbnail-v1.active {
    border-color: var(--color-amarillo);
    box-shadow: 0 0 20px var(--color-amarillo-rgba-06);
  }

  .price-glow-v1 {
    text-shadow: 0 0 15px var(--color-amarillo-rgba-06);
    color: var(--color-amarillo-claro);
  }

  .gradient-text-v1 {
    background: linear-gradient(135deg, var(--color-verde-claro), var(--color-amarillo));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .bullet-v1 {
    background: var(--color-amarillo);
  }

  .main-image {
    transition: all 0.5s ease-in-out;
  }

  .image-container {
    background: rgba(45, 90, 90, 0.3);
    border: 1px solid rgba(244, 208, 63, 0.1);
  }

  .navbar {
    position: static;
    transform: translateY(0);
  }
</style>
<link rel="stylesheet" href="css/product.css">

<div class="max-w-7xl mx-auto space-y-16 p-6">
  <div class="mb-20">
    <div class="glass-card-v1 rounded-2xl p-8 max-w-4xl mx-auto">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="space-y-4">
          <div class="aspect-square image-container rounded-xl overflow-hidden">
            <img id="mainImage1" src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500&h=500&fit=crop"
              alt="Producto principal" class="w-full h-full object-cover main-image">
          </div>
          <div class="flex gap-3">
            <div class="thumbnail-v1 active w-20 h-20 rounded-lg overflow-hidden"
              onclick="changeImage(1, 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500&h=500&fit=crop', this)">
              <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=80&h=80&fit=crop" alt="Vista A"
                class="w-full h-full object-cover">
            </div>
            <div class="thumbnail-v1 w-20 h-20 rounded-lg overflow-hidden"
              onclick="changeImage(1, 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=500&h=500&fit=crop', this)">
              <img src="https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=80&h=80&fit=crop" alt="Vista B"
                class="w-full h-full object-cover">
            </div>
            <div class="thumbnail-v1 w-20 h-20 rounded-lg overflow-hidden"
              onclick="changeImage(1, 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=500&h=500&fit=crop', this)">
              <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=80&h=80&fit=crop" alt="Vista C"
                class="w-full h-full object-cover">
            </div>
          </div>
        </div>

        <!-- Información del Producto -->
        <div class="space-y-6">
          <h3 class="text-3xl font-bold gradient-text-v1">Auriculares Premium</h3>
          <div class="text-4xl font-bold price-glow-v1">$299.99</div>

          <div class="space-y-3">
            <h4 class="text-lg font-semibold mb-3" style="color: var(--color-gris-texto);">Características:</h4>
            <div class="space-y-2">
              <div class="flex items-center" style="color: var(--color-gris-texto);">
                <div class="bullet-v1 w-2 h-2 rounded-full mr-3"></div>
                <span>Cancelación activa de ruido</span>
              </div>
              <div class="flex items-center" style="color: var(--color-gris-texto);">
                <div class="bullet-v1 w-2 h-2 rounded-full mr-3"></div>
                <span>Batería de 30 horas</span>
              </div>
              <div class="flex items-center" style="color: var(--color-gris-texto);">
                <div class="bullet-v1 w-2 h-2 rounded-full mr-3"></div>
                <span>Conectividad Bluetooth 5.0</span>
              </div>
              <div class="flex items-center" style="color: var(--color-gris-texto);">
                <div class="bullet-v1 w-2 h-2 rounded-full mr-3"></div>
                <span>Diseño ergonómico</span>
              </div>
              <div class="flex items-center" style="color: var(--color-gris-texto);">
                <div class="bullet-v1 w-2 h-2 rounded-full mr-3"></div>
                <span>Resistente al agua IPX4</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Carousel Container -->
  <section class="carousel-container rounded-3xl p-8 relative mb-10" data-animate>
    <!-- Navigation Arrows -->
    <button
      class="carousel-arrow absolute left-0 sm:left-2 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-12 sm:h-12 rounded-full hidden sm:flex sm:items-center sm:justify-center z-20"
      id="prevBtn">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
      </svg>
    </button>

    <button
      class="carousel-arrow absolute right-0 sm:right-2 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-12 sm:h-12 rounded-full hidden sm:flex sm:items-center sm:justify-center z-20"
      id="nextBtn">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
      </svg>
    </button>

    <!-- Carousel Track -->
    <div class="w-full flex justify-center items-center">
      <h2 class="banner-title text-2xl sm:text-3xl md:text-4xl mb-4">PRODUCTOS SIMILARES</h2>
    </div>
    <div class="overflow-y-hidden sm:overflow-hidden mx-1 sm:mx-8">
      <div class="carousel-track carousel-grid m-2" id="carouselTrack">
        <!-- Product 2 -->
        <div class="text-center bg-transparent">
          <div class="product-card rounded-2xl p-6 w-full max-w-sm mx-auto cursor-pointer">
            <div class="product-image mb-6 ">
              <img src="https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=400&h=300&fit=crop&crop=center"
                alt="Smart Watch" class="w-full h-48 object-cover rounded-xl">
            </div>
            <div class="space-y-3">
              <h3 class="product-title text-xl leading-tight">
                Smart Watch Pro
              </h3>
              <div class="flex items-center justify-between pt-2">
                <span class="product-price">$449.99</span>
                <div class="flex items-center space-x-1 text-slate-500">
                  <svg class="w-4 h-4" fill="none" stroke="white" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <span class="text-xs text-white">En stock</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Product 3 -->
        <div class="text-center bg-transparent">
          <div class="product-card rounded-2xl p-6 w-full max-w-sm mx-auto cursor-pointer">
            <div class="product-image mb-6">
              <img src="https://images.unsplash.com/photo-1588423771073-b8903fbb85b5?w=400&h=300&fit=crop&crop=center"
                alt="Wireless Speaker" class="w-full h-48 object-cover rounded-xl">
            </div>
            <div class="space-y-3">
              <h3 class="product-title text-xl leading-tight">
                Wireless Speaker Ultra
              </h3>
              <div class="flex items-center justify-between pt-2">
                <span class="product-price">$199.99</span>
                <div class="flex items-center space-x-1 text-slate-500">
                  <svg class="w-4 h-4" fill="none" stroke="white" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <span class="text-xs text-white">Pocas unidades</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Product 4 -->
        <div class="text-center bg-transparent">
          <div class="product-card rounded-2xl p-6 w-full max-w-sm mx-auto cursor-pointer">
            <div class="product-image mb-6">
              <img src="https://images.unsplash.com/photo-1546868871-7041f2a55e12?w=400&h=300&fit=crop&crop=center"
                alt="Gaming Mouse" class="w-full h-48 object-cover rounded-xl">
            </div>
            <div class="space-y-3">
              <h3 class="product-title text-xl leading-tight">
                Gaming Mouse Elite
              </h3>
              <div class="flex items-center justify-between pt-2">
                <span class="product-price">$89.99</span>
                <div class="flex items-center space-x-1 text-slate-500">
                  <svg class="w-4 h-4" fill="none" stroke="white" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <span class="text-xs text-white">En stock</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Product 5 -->
        <div class="text-center bg-transparent">
          <div class="product-card rounded-2xl p-6 w-full max-w-sm mx-auto cursor-pointer">
            <div class="product-image mb-6">
              <img src="https://images.unsplash.com/photo-1593642632823-8f785ba67e45?w=400&h=300&fit=crop&crop=center"
                alt="Laptop Pro" class="w-full h-48 object-cover rounded-xl">
            </div>
            <div class="space-y-3">
              <h3 class="product-title text-xl leading-tight">
                Laptop Pro 15"
              </h3>
              <div class="flex items-center justify-between pt-2">
                <span class="product-price">$1,299.99</span>
                <div class="flex items-center space-x-1 text-slate-500">
                  <svg class="w-4 h-4" fill="none" stroke="white" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <span class="text-xs text-white">En stock</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Product 6 -->
        <div class="text-center bg-transparent">
          <div class="product-card rounded-2xl p-6 w-full max-w-sm mx-auto cursor-pointer">
            <div class="product-image mb-6">
              <img src="https://images.unsplash.com/photo-1583394838336-acd977736f90?w=400&h=300&fit=crop&crop=center"
                alt="Smartphone" class="w-full h-48 object-cover rounded-xl">
            </div>
            <div class="space-y-3">
              <h3 class="product-title text-xl leading-tight">
                Smartphone X1
              </h3>
              <div class="flex items-center justify-between pt-2">
                <span class="product-price">$899.99</span>
                <div class="flex items-center space-x-1 text-slate-500">
                  <svg class="w-4 h-4" fill="none" stroke="white" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <span class="text-xs text-white">En stock</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Product 7 -->
        <div class="text-center bg-transparent">
          <div class="product-card rounded-2xl p-6 w-full max-w-sm mx-auto cursor-pointer">
            <div class="product-image mb-6">
              <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=400&h=300&fit=crop&crop=center"
                alt="VR Headset" class="w-full h-48 object-cover rounded-xl">
            </div>
            <div class="space-y-3">
              <h3 class="product-title text-xl leading-tight">
                VR Headset Reality
              </h3>
              <div class="flex items-center justify-between pt-2">
                <span class="product-price">$699.99</span>
                <div class="flex items-center space-x-1 text-slate-500">
                  <svg class="w-4 h-4" fill="none" stroke="white" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <span class="text-xs text-white">Nuevo</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Product 8 -->
        <div class="text-center bg-transparent">
          <div class="product-card rounded-2xl p-6 w-full max-w-sm mx-auto cursor-pointer">
            <div class="product-image mb-6">
              <img src="https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=400&h=300&fit=crop&crop=center"
                alt="Mechanical Keyboard" class="w-full h-48 object-cover rounded-xl">
            </div>
            <div class="space-y-3">
              <h3 class="product-title text-xl leading-tight">
                Mechanical Keyboard RGB
              </h3>
              <div class="flex items-center justify-between pt-2">
                <span class="product-price">$149.99</span>
                <div class="flex items-center space-x-1 text-slate-500">
                  <svg class="w-4 h-4" fill="none" stroke="white" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <span class="text-xs text-white">En stock</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Product 9 -->
        <div class="text-center bg-transparent">
          <div class="product-card rounded-2xl p-6 w-full max-w-sm mx-auto cursor-pointer">
            <div class="product-image mb-6">
              <img src="https://images.unsplash.com/photo-1609081219090-a6d81d3085bf?w=400&h=300&fit=crop&crop=center"
                alt="Webcam 4K" class="w-full h-48 object-cover rounded-xl">
            </div>
            <div class="space-y-3">
              <h3 class="product-title text-xl leading-tight">
                Webcam 4K Pro
              </h3>
              <div class="flex items-center justify-between pt-2">
                <span class="product-price">$179.99</span>
                <div class="flex items-center space-x-1 text-slate-500">
                  <svg class="w-4 h-4" fill="none" stroke="white" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <span class="text-xs text-white">Pocas unidades</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Product 10 -->
        <div class="text-center bg-transparent">
          <div class="product-card rounded-2xl p-6 w-full max-w-sm mx-auto cursor-pointer">
            <div class="product-image mb-6">
              <img src="https://images.unsplash.com/photo-1484704849700-f032a568e944?w=400&h=300&fit=crop&crop=center"
                alt="Tablet Pro" class="w-full h-48 object-cover rounded-xl">
            </div>
            <div class="space-y-3">
              <h3 class="product-title text-xl leading-tight">
                Tablet Pro 12.9"
              </h3>
              <div class="flex items-center justify-between pt-2">
                <span class="product-price">$1,099.99</span>
                <div class="flex items-center space-x-1 text-slate-500">
                  <svg class="w-4 h-4" fill="none" stroke="white" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <span class="text-xs text-white">En stock</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Product 11 -->
        <div class="text-center bg-transparent">
          <div class="product-card rounded-2xl p-6 w-full max-w-sm mx-auto cursor-pointer">
            <div class="product-image mb-6">
              <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400&h=300&fit=crop&crop=center"
                alt="Sneakers" class="w-full h-48 object-cover rounded-xl">
            </div>
            <div class="space-y-3">
              <h3 class="product-title text-xl leading-tight">
                Premium Sneakers
              </h3>
              <div class="flex items-center justify-between pt-2">
                <span class="product-price">$159.99</span>
                <div class="flex items-center space-x-1 text-slate-500">
                  <svg class="w-4 h-4" fill="none" stroke="white" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <span class="text-xs text-white">En stock</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Product 12 -->
        <div class="text-center bg-transparent">
          <div class="product-card rounded-2xl p-6 w-full max-w-sm mx-auto cursor-pointer">
            <div class="product-image mb-6">
              <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400&h=300&fit=crop&crop=center"
                alt="Sunglasses" class="w-full h-48 object-cover rounded-xl">
            </div>
            <div class="space-y-3">
              <h3 class="product-title text-xl leading-tight">
                Designer Sunglasses
              </h3>
              <div class="flex items-center justify-between pt-2">
                <span class="product-price">$249.99</span>
                <div class="flex items-center space-x-1 text-slate-500">
                  <svg class="w-4 h-4" fill="none" stroke="white" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <span class="text-xs text-white">Limitado</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Product 13 -->
        <div class="text-center bg-transparent">
          <div class="product-card rounded-2xl p-6 w-full max-w-sm mx-auto cursor-pointer">
            <div class="product-image mb-6">
              <img src="https://images.unsplash.com/photo-1434056886845-dac89ffe9b56?w=400&h=300&fit=crop&crop=center"
                alt="Coffee Maker" class="w-full h-48 object-cover rounded-xl">
            </div>
            <div class="space-y-3">
              <h3 class="product-title text-xl leading-tight">
                Smart Coffee Maker
              </h3>
              <div class="flex items-center justify-between pt-2">
                <span class="product-price">$329.99</span>
                <div class="flex items-center space-x-1 text-slate-500">
                  <svg class="w-4 h-4" fill="none" stroke="white" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <span class="text-xs text-white">En stock</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Product 14 -->
        <div class="text-center bg-transparent">
          <div class="product-card rounded-2xl p-6 w-full max-w-sm mx-auto cursor-pointer">
            <div class="product-image mb-6">
              <img src="https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=400&h=300&fit=crop&crop=center"
                alt="Drone" class="w-full h-48 object-cover rounded-xl">
            </div>
            <div class="space-y-3">
              <h3 class="product-title text-xl leading-tight">
                Professional Drone
              </h3>
              <div class="flex items-center justify-between pt-2">
                <span class="product-price">$799.99</span>
                <div class="flex items-center space-x-1 text-slate-500">
                  <svg class="w-4 h-4" fill="none" stroke="white" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <span class="text-xs text-white">Nuevo</span>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
</div>
<script src="js/product.js"></script>