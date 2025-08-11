<style>
    /* Banner glassmorphism */
    .glass-banner {
        background: rgba(15, 23, 42, 0.9);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(59, 130, 246, 0.2);
        height: 20vh;
        min-height: 140px;
        position: relative;
        overflow: hidden;
    }

    /* Texto con gradiente */
    .banner-title {
        background: linear-gradient(135deg, #f8fafc, #cbd5e1);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 700;
    }

    .banner-subtitle {
        color: #94a3b8;
    }

    /* Input y botón */
    .glass-input {
        background: rgba(15, 23, 42, 0.5);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(59, 130, 246, 0.3);
        color: #f8fafc;
        transition: all 0.2s ease;
    }

    .glass-input:focus {
        outline: none;
        border-color: rgba(59, 130, 246, 0.6);
        background: rgba(15, 23, 42, 0.7);
    }

    .glass-input::placeholder {
        color: #64748b;
    }

    .glass-button {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.4), rgba(29, 78, 216, 0.5));
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(59, 130, 246, 0.4);
        transition: all 0.2s ease;
        color: white;
        font-weight: 600;
    }

    .glass-button:hover {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.5), rgba(29, 78, 216, 0.6));
        border-color: rgba(59, 130, 246, 0.6);
        transform: translateY(-1px);
    }

    /* Iconos de servicios */
    .service-icon {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(29, 78, 216, 0.3));
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(59, 130, 246, 0.3);
        color: #3b82f6;
        transition: all 0.2s ease;
    }

    .service-icon:hover {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.3), rgba(29, 78, 216, 0.4));
        border-color: rgba(59, 130, 246, 0.5);
        transform: scale(1.05);
    }

    .service-text {
        color: #cbd5e1;
        font-weight: 500;
    }

    /* Glassmorphism card */
    .product-card {
        background: rgba(15, 23, 42, 0.8);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(59, 130, 246, 0.2);
        transition: transform 0.15s ease, border-color 0.15s ease;
        position: relative;
        z-index: 10;
    }

    .product-card:hover {
        transform: scale(1.02);
        border-color: rgba(59, 130, 246, 0.4);
    }

    /* Imagen con efectos */
    .product-image {
        transition: transform 0.15s ease;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
    }

    .product-image::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(29, 78, 216, 0.1));
        opacity: 0;
        transition: opacity 0.15s ease;
        z-index: 1;
    }

    .product-card:hover .product-image::before {
        opacity: 1;
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    /* Texto con efectos de brillo */
    .product-title {
        background: linear-gradient(135deg, #f8fafc, #cbd5e1);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 600;
        transition: all 0.15s ease;
    }

    .product-card:hover .product-title {
        background: linear-gradient(135deg, #ffffff, #3b82f6);
        -webkit-background-clip: text;
        background-clip: text;
    }

    .product-price {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 700;
        font-size: 1.5rem;
    }

    /* Efectos de partículas en hover */
    .particle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: #3b82f6;
        border-radius: 50%;
        pointer-events: none;
        animation: particle-float 2s ease-out forwards;
    }

    @keyframes particle-float {
        0% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        100% {
            opacity: 0;
            transform: translateY(-100px) scale(0);
        }
    }

    /* Carousel Styles */
    .carousel-container {
        background: rgba(15, 23, 42, 0.5);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(59, 130, 246, 0.1);
    }

    .carousel-track {
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .carousel-arrow {
        background: rgba(15, 23, 42, 1);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(59, 130, 246, 0.3);
        transition: all 0.3s ease;
    }

    .carousel-arrow:hover {
        background: rgba(59, 130, 246, 0.2);
        border-color: rgba(59, 130, 246, 0.5);
    }

    .carousel-arrow:active {
        transform: scale(0.95);
    }

    .carousel-arrow svg {
        color: #e2e8f0;
        transition: color 0.3s ease;
    }

    .carousel-arrow:hover svg {
        color: #3b82f6;
    }

    /* Responsive grid */
    .carousel-grid {
        display: grid;
        grid-auto-flow: column;
        grid-auto-columns: 300px;
        gap: 1.5rem;
    }

    @media (max-width: 640px) {
        .carousel-grid {
            grid-auto-columns: 280px;
            gap: 1rem;
        }
    }


    /*DESCUENTOS*/

    /* Glassmorphism card */
    .product-card-descuento {
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(59, 130, 246, 0.2);
        transition: transform 0.2s ease, border-color 0.2s ease;
        position: relative;
        overflow: hidden;
    }

    .product-card-descuento:hover {
        transform: scale(1.02);
        border-color: rgba(59, 130, 246, 0.4);
    }

    .product-card-large-descuento {
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(59, 130, 246, 0.3);
        transition: transform 0.2s ease, border-color 0.2s ease;
        position: relative;
        overflow: hidden;
    }

    .product-card-large-descuento:hover {
        transform: scale(1.01);
        border-color: rgba(20, 73, 158, 0.5);
    }

    /* Imagen placeholder */
    .image-placeholder-descuento {
        background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
        position: relative;
    }

    /* Texto con gradiente */
    .product-title-descuento {
        background: linear-gradient(135deg, #f8fafc, #cbd5e1);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 600;
    }

    .product-price-descuento {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 700;
    }

    /* Botón con efecto glassmorphism */
    .glass-button-descuento {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(29, 78, 216, 0.3));
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(59, 130, 246, 0.3);
        transition: all 0.2s ease;
        position: relative;
        overflow: hidden;
    }

    .glass-button-descuento:hover {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.3), rgba(29, 78, 216, 0.4));
        border-color: rgba(59, 130, 246, 0.5);
        transform: translateY(-1px);
    }

    .glass-button-descuento:active {
        transform: translateY(0);
    }

    /* Container principal */
    .showcase-container-descuento {
        background: rgba(15, 23, 42, 0.49);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(59, 130, 246, 0.1);
    }

    /* Responsive grid (CSS fallback / extra control) */
    .product-grid-descuento {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-template-rows: repeat(3, 1fr);
        gap: 1rem;
    }

    @media (max-width: 768px) {
        .showcase-grid-descuento {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .product-grid-descuento {
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(3, 1fr);
        }
    }

    @media (max-width: 640px) {
        .product-grid-descuento {
            grid-template-columns: 1fr;
            grid-template-rows: repeat(6, 1fr);
        }
    }
</style>
<header class="w-full h-screen mb-20 backdrop-blur-md bg-black/30">
    <!-- <div id="hero-carousel" class="relative w-full h-full overflow-hidden">
            <div class="absolute inset-0 opacity-100 transition-opacity duration-1000 ease-in-out" data-carousel-item>
                <img src="../assets/img/20250804_1318_Instalación de Cámaras_simple_compose_01k1txz3yye2er126npqcc434f.png" class="object-cover w-full h-full"
                    alt="">
            </div>
            <div class="absolute inset-0 opacity-100 transition-opacity duration-1000 ease-in-out" data-carousel-item>
                <img src="../assets/img/emily-wade-ndrCszFJvMo-unsplash.jpg" class="object-cover w-full h-full"
                    alt="">
            </div>
            <div class="absolute inset-0 opacity-100 transition-opacity duration-1000 ease-in-out" data-carousel-item>
                <img src="../assets/img/brock-wegner-Kz0_kuLB0Zk-unsplash.jpg" class="object-cover w-full h-full"
                    alt="">
            </div>
            <div class="absolute inset-0 opacity-100 transition-opacity duration-1000 ease-in-out" data-carousel-item>
                <img src="../assets/img/fredrick-tendong-m1g4-dczgcc-unsplash.jpg" class="object-cover w-full h-full"
                    alt="">
            </div>
            <div class="absolute inset-0 opacity-100 transition-opacity duration-1000 ease-in-out" data-carousel-item>
                <img src="../assets/img/rebekah-yip-FwfyVSfUFWs-unsplash.jpg" class="object-cover w-full h-full"
                    alt="">
            </div>
            <div class="absolute inset-0 opacity-100 transition-opacity duration-1000 ease-in-out" data-carousel-item>
                <img src="../assets/img/charlesdeluvio-Lks7vei-eAg-unsplash.jpg" class="object-cover w-full h-full"
                    alt="">
            </div>
            <div class="absolute inset-0 opacity-100 transition-opacity duration-1000 ease-in-out" data-carousel-item>
                <img src="../assets/img/jakub-zerdzicki-KZ83Shi7VZE-unsplash.jpg" class="object-cover w-full h-full"
                    alt="">
            </div>
            <div class="absolute inset-0 opacity-100 transition-opacity duration-1000 ease-in-out" data-carousel-item>
                <img src="../assets/img/vadim-bogulov-goEyMwu0QFs-unsplash.jpg" class="object-cover w-full h-full"
                    alt="">
            </div>
            <div class="absolute inset-0 opacity-100 transition-opacity duration-1000 ease-in-out" data-carousel-item>
                <img src="../assets/img/raychan-LdiTW9nzMcg-unsplash.jpg" class="object-cover w-full h-full" alt="">
            </div>
            <div class="absolute inset-0 opacity-100 transition-opacity duration-1000 ease-in-out" data-carousel-item>
                <img src="../assets/img/marta-filipczyk-ZXNquSCcBSc-unsplash.jpg" class="object-cover w-full h-full"
                    alt="">
            </div>
            <div class="absolute inset-0 opacity-100 transition-opacity duration-1000 ease-in-out" data-carousel-item>
                <img src="../assets/img/desola-lanre-ologun-IgUR1iX0mqM-unsplash.jpg" class="object-cover w-full h-full"
                    alt="">
            </div>
            <div class="absolute inset-0 opacity-100 transition-opacity duration-1000 ease-in-out" data-carousel-item>
                <img src="../assets/img/roy-muz-RGmcMWsd8LU-unsplash.jpg" class="object-cover w-full h-full" alt="">
            </div>
        </div> -->
</header>

<div class="space-y-[150px]">
    <section
        class="w-full h-[20vh] mb-10 opacity-0 translate-y-32 transition-all duration-1000 ease-in-out will-change-transform delay-200"
        data-animate>
        <!-- Banner Servicios Técnicos -->
        <div class="glass-banner rounded-2xl p-6">
            <div class="flex items-center justify-between h-full">

                <div class="flex-1">
                    <h2 class="banner-title text-3xl md:text-4xl mb-2">Servicios Técnicos</h2>
                    <p class="banner-subtitle text-sm md:text-base max-w-md">
                        Soluciones profesionales para tu hogar y oficina. Instalación, reparación y mantenimiento
                        especializado.
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 ml-6">

                    <!-- Cámaras de Seguridad -->
                    <div class="flex flex-col items-center space-y-2 group cursor-pointer">
                        <div class="service-icon w-12 h-12 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <span class="service-text text-xs text-center">Cámaras de Seguridad</span>
                    </div>

                    <!-- Reparación PC -->
                    <div class="flex flex-col items-center space-y-2 group cursor-pointer">
                        <div class="service-icon w-12 h-12 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <span class="service-text text-xs text-center">Reparación de PC</span>
                    </div>

                    <!-- Antenas WiFi -->
                    <div class="flex flex-col items-center space-y-2 group cursor-pointer">
                        <div class="service-icon w-12 h-12 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0">
                                </path>
                            </svg>
                        </div>
                        <span class="service-text text-xs text-center">Antenas WiFi</span>
                    </div>

                    <!-- Soporte Técnico -->
                    <div class="flex flex-col items-center space-y-2 group cursor-pointer">
                        <div class="service-icon w-12 h-12 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <span class="service-text text-xs text-center">Soporte Técnico</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Carousel Container -->
    <section
        class="carousel-container rounded-3xl p-8 relative mb-10 opacity-0 translate-y-32 transition-all duration-1000 ease-in-out will-change-transform delay-200"
        data-animate>
        <!-- Navigation Arrows -->
        <button
            class="carousel-arrow absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full flex items-center justify-center z-20"
            id="prevBtn">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        <button
            class="carousel-arrow absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full flex items-center justify-center z-20"
            id="nextBtn">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        <!-- Carousel Track -->
        <div class="overflow-hidden mx-16">
            <div class="carousel-track carousel-grid m-2" id="carouselTrack">
                <!-- Product 2 -->
                <div class="text-center bg-transparent">
                    <div class="product-card rounded-2xl p-6 w-full max-w-sm mx-auto cursor-pointer">
                        <div class="product-image mb-6">
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
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-xs">En stock</span>
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
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-xs">Pocas unidades</span>
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
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-xs">En stock</span>
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
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-xs">En stock</span>
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
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-xs">En stock</span>
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
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-xs">Nuevo</span>
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
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-xs">En stock</span>
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
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-xs">Pocas unidades</span>
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
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-xs">En stock</span>
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
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-xs">En stock</span>
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
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-xs">Limitado</span>
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
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-xs">En stock</span>
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
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-xs">Nuevo</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section
        class="w-full h-[20vh] mb-10 opacity-0 translate-y-32 transition-all duration-1000 ease-in-out will-change-transform delay-200"
        data-animate>
        <!-- Banner Newsletter -->
        <div class="glass-banner rounded-2xl p-6 flex items-center justify-between">
            <div class="flex-1">
                <h2 class="banner-title text-3xl md:text-4xl mb-2">Newsletter</h2>
                <p class="banner-subtitle text-sm md:text-base max-w-md">
                    Mantente al día con nuestros productos y ofertas exclusivas. Recibe las últimas novedades
                    directamente
                    en tu email.
                </p>
            </div>

            <div class="flex items-center space-x-3 ml-6">
                <input type="email" placeholder="tu@email.com" class="glass-input px-4 py-3 rounded-lg w-64 text-sm">
                <button class="glass-button px-6 py-3 rounded-lg text-sm whitespace-nowrap">
                    Suscribirse
                </button>
            </div>
        </div>
    </section>

    <section
        class="px-8 py-12 max-w-screen-xl mx-auto text-gray-100 bg-transparent mb-10 opacity-0 translate-y-32 transition-all duration-1000 ease-in-out will-change-transform delay-200"
        data-animate>

        <!-- Productos en Descuento -->
        <div id="showcase-container-descuento" class="showcase-container-descuento rounded-3xl p-8 w-full max-w-6xl">

            <!-- Grid principal -->
            <div id="showcase-grid-descuento"
                class="showcase-grid-descuento grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">

                <!-- Card grande (lado izquierdo) -->
                <div id="product-card-large-descuento-1"
                    class="product-card-large-descuento rounded-2xl p-6 cursor-pointer">
                    <div
                        class="image-placeholder-descuento w-full h-80 rounded-xl mb-6 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>

                    <div class="space-y-3">
                        <h3 class="product-title-descuento text-2xl">PRODUCT NAME</h3>
                        <div class="product-price-descuento text-3xl">$300</div>
                    </div>
                </div>

                <!-- Cards pequeñas (lado derecho) -->
                <div id="product-grid-descuento" class="product-grid-descuento">

                    <!-- Card 1 -->
                    <div id="product-card-descuento-1" class="product-card-descuento rounded-xl p-4 cursor-pointer">
                        <div
                            class="image-placeholder-descuento w-full h-24 rounded-lg mb-4 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h4 class="product-title-descuento text-sm mb-2">PRODUCT NAME</h4>
                        <div class="product-price-descuento text-lg">$300</div>
                    </div>

                    <!-- Card 2 -->
                    <div id="product-card-descuento-2" class="product-card-descuento rounded-xl p-4 cursor-pointer">
                        <div
                            class="image-placeholder-descuento w-full h-24 rounded-lg mb-4 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h4 class="product-title-descuento text-sm mb-2">PRODUCT NAME</h4>
                        <div class="product-price-descuento text-lg">$300</div>
                    </div>

                    <!-- Card 3 -->
                    <div id="product-card-descuento-3" class="product-card-descuento rounded-xl p-4 cursor-pointer">
                        <div
                            class="image-placeholder-descuento w-full h-24 rounded-lg mb-4 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h4 class="product-title-descuento text-sm mb-2">PRODUCT NAME</h4>
                        <div class="product-price-descuento text-lg">$300</div>
                    </div>

                    <!-- Card 4 -->
                    <div id="product-card-descuento-4" class="product-card-descuento rounded-xl p-4 cursor-pointer">
                        <div
                            class="image-placeholder-descuento w-full h-24 rounded-lg mb-4 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h4 class="product-title-descuento text-sm mb-2">PRODUCT NAME</h4>
                        <div class="product-price-descuento text-lg">$300</div>
                    </div>

                    <!-- Card 5 -->
                    <div id="product-card-descuento-5" class="product-card-descuento rounded-xl p-4 cursor-pointer">
                        <div
                            class="image-placeholder-descuento w-full h-24 rounded-lg mb-4 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h4 class="product-title-descuento text-sm mb-2">PRODUCT NAME</h4>
                        <div class="product-price-descuento text-lg">$300</div>
                    </div>

                    <!-- Card 6 -->
                    <div id="product-card-descuento-6" class="product-card-descuento rounded-xl p-4 cursor-pointer">
                        <div
                            class="image-placeholder-descuento w-full h-24 rounded-lg mb-4 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h4 class="product-title-descuento text-sm mb-2">PRODUCT NAME</h4>
                        <div class="product-price-descuento text-lg">$300</div>
                    </div>

                </div>
            </div>

            <!-- Botón separado en la parte inferior -->
            <div class="flex justify-center">
                <button id="btn-ir-shop-descuento"
                    class="glass-button-descuento px-8 py-3 rounded-full text-white font-semibold text-lg hover:text-blue-100 transition-colors">
                    IR AL SHOP
                </button>
            </div>
        </div>
    </section>


</div>







<script>
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
            if (width >= 1280) return 4; // xl screens
            if (width >= 1024) return 3; // lg screens
            if (width >= 768) return 2;  // md screens
            return 1; // sm screens
        }

        init() {
            // Set initial position
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
                this.currentIndex = Math.max(0, this.currentIndex - 2);
                this.updateCarousel();
                this.updateButtons();
            }
        }

        next() {
            if (this.currentIndex < this.maxIndex) {
                this.currentIndex = Math.min(this.maxIndex, this.currentIndex + 2);
                this.updateCarousel();
                this.updateButtons();
            }
        }

        updateCarousel() {
            const itemWidth = 300 + 24; // card width + gap
            const translateX = -this.currentIndex * itemWidth;
            this.track.style.transform = `translateX(${translateX}px)`;
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
        new ModernCarousel();

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
</script>

<script>
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
</script>

<script>
    // Efectos de partículas en hover
    const productCards = document.querySelectorAll('.product-card');

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
</script>

<script>
    // Efectos sutiles para las cards (se actualizaron las clases a "-descuento")
    const productCards = document.querySelectorAll('.product-card-descuento, .product-card-large-descuento');

    productCards.forEach(card => {
        // Animación de entrada
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    });

    // Animación escalonada de entrada
    window.addEventListener('load', function () {
        productCards.forEach((card, index) => {
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
</script>

<script>
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
</script>