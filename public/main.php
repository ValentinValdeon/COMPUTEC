<link rel="stylesheet" href="css/main.css">

<div class="overflow-x-hidden w-full mb-20">
    <section class="relative h-screen flex items-center">
        <!-- Contenedor de imágenes de fondo -->
        <div class="absolute inset-0">
            <div id="image1" class="image-container absolute inset-0 fade-in"
                style="background-image: url('../assets/img/20250804_1318_Instalación\ de\ Cámaras_simple_compose_01k1txz3yye2er126npqcc434f.png');">
            </div>
            <div id="image2" class="image-container absolute inset-0 fade-out"
                style="background-image: url('../assets/img/samsung-memory-IO6lB6zHo7M-unsplash.jpg');"></div>
            <div id="image3" class="image-container absolute inset-0 fade-out"
                style="background-image: url('../assets/img/listening-to-music.jpg');"></div>
            <div id="image4" class="image-container absolute inset-0 fade-out"
                style="background-image: url('../assets/img/raychan-LdiTW9nzMcg-unsplash.jpg');"></div>
        </div>

        <!-- Overlay principal -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/95 via-slate-800/70 to-transparent"></div>



        <!-- Contenido principal -->
        <div class="relative z-10 container mx-auto px-6 lg:px-8">
            <div class="max-w-2xl">
                <!-- Texto principal -->
                <div class="animate-slide-in-left">
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight text-glow">
                        Tecnología que
                        <span class="bg-gradient-to-r from-yellow-400 to-green-500 bg-clip-text text-transparent">
                            conecta y protege
                        </span>
                        tu hogar
                    </h1>

                    <p class="text-xl md:text-2xl text-gray-300 mb-8 font-light">
                        Innovación inteligente para un futuro más seguro
                    </p>

                    <!-- Botón CTA -->
                    <button
                        class="bg-gradient-to-r from-yellow-500 to-green-600 text-white px-8 py-4 rounded-full text-lg font-semibold hover:from-yellow-600 hover:to-green-700 transform hover:scale-105 transition-all duration-300 shadow-2xl hover:shadow-yellow-500/25">
                        Descubre más
                        <svg class="inline-block ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Indicadores de imagen -->
        <div class="absolute bottom-20 left-1/2 transform -translate-x-1/2 flex space-x-2 z-20">
            <div class="w-3 h-3 rounded-full bg-white/50 indicator active"></div>
            <div class="w-3 h-3 rounded-full bg-white/30 indicator"></div>
            <div class="w-3 h-3 rounded-full bg-white/30 indicator"></div>
            <div class="w-3 h-3 rounded-full bg-white/30 indicator"></div>
        </div>
    </section>
</div>


<div class="space-y-[100px]">
    <section id="destacado"
        class="w-full h-auto mb-10 opacity-0 translate-y-32 transition-all duration-1000 ease-in-out will-change-transform delay-200"
        data-animate>
        <!-- Banner Servicios Técnicos -->
        <div class="glass-banner rounded-2xl p-6 min-h-[140px]">
            <div class="flex flex-col md:flex-row items-center md:items-start justify-between h-full gap-6 md:gap-0">

                <div class="flex-1 text-center md:text-left">
                    <h2 class="banner-title text-2xl sm:text-3xl md:text-4xl mb-2">Servicios Técnicos</h2>
                    <p class="banner-subtitle text-xs text-white sm:text-sm md:text-base max-w-md mx-auto md:mx-0">
                        Soluciones profesionales para tu hogar y oficina. Instalación, reparación y mantenimiento
                        especializado.
                    </p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 ml-0 md:ml-6 w-full max-w-md">
                    <!-- Cámaras de Seguridad -->
                    <div class="flex flex-col items-center space-y-2 group cursor-pointer">
                        <div class="service-icon w-12 h-12 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <span class="service-text text-xs text-white text-center">Cámaras de Seguridad</span>
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
                        <span class="service-text text-xs text-white text-center">Reparación de PC</span>
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
                        <span class="service-text text-xs text-white text-center">Antenas WiFi</span>
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
                        <span class="service-text text-xs text-white text-center">Soporte Técnico</span>
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
            <h2 class="banner-title text-2xl sm:text-3xl md:text-4xl mb-4">PRODUCTOS DESTACADOS</h2>
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


    <section
        class="w-full h-[20vh] mb-10 opacity-0 translate-y-32 transition-all duration-1000 ease-in-out will-change-transform delay-200"
        data-animate>
        <!-- Banner Newsletter -->
        <div class="glass-banner rounded-2xl p-6 flex items-center justify-between">
            <div class="flex-1">
                <h2 class="banner-title text-3xl md:text-4xl mb-2">Subscribete!</h2>
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

    <section id="descuento"
        class="px-8 py-12 max-w-screen-xl mx-auto text-gray-100 bg-transparent mb-10 opacity-0 translate-y-32 transition-all duration-1000 ease-in-out will-change-transform delay-200"
        data-animate>
        <!-- Productos en Descuento -->
        <div id="showcase-container-descuento" class="showcase-container-descuento rounded-3xl p-8 w-full max-w-6xl">

            <div class="w-full flex justify-center items-center">
                <h2 class="banner-title text-2xl sm:text-3xl md:text-4xl mb-4">DESCUENTOS</h2>
            </div>

            <!-- Grid principal -->
            <div id="showcase-grid-descuento"
                class="showcase-grid-descuento grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">

                <!-- Card grande (lado izquierdo) -->
                 <div class="space-y-4">
                    <div id="product-card-large-descuento-1"
                    class="product-card-large-descuento rounded-2xl p-6 cursor-pointer ">
                    <div
                        class="image-placeholder-descuento w-full h-80 rounded-xl mb-6 flex items-center justify-center">
                        <img src="https://images.unsplash.com/photo-1484704849700-f032a568e944?w=400&h=300&fit=crop&crop=center"
                                alt="Tablet Pro" class="w-full h-full object-cover rounded-xl">
                    </div>

                    <div class="space-y-3">
                        <h3 class="product-title-descuento text-2xl">PRODUCT NAME</h3>
                        <div class="product-price-descuento text-3xl">$300</div>
                    </div>
                </div>

                <div id="product-card-large-descuento-1"
                    class="product-card-large-descuento rounded-2xl p-6 cursor-pointer ">
                    <div
                        class="image-placeholder-descuento w-full h-80 rounded-xl mb-6 flex items-center justify-center">
                        <img src="https://images.unsplash.com/photo-1434056886845-dac89ffe9b56?w=400&h=300&fit=crop&crop=center"
                            alt="Coffee Maker" class="w-full h-full object-cover rounded-xl">
                    </div>

                    <div class="space-y-3">
                        <h3 class="product-title-descuento text-2xl">PRODUCT NAME</h3>
                        <div class="product-price-descuento text-3xl">$300</div>
                    </div>
                </div>
                 </div>
                

                <!-- Cards pequeñas (lado derecho) -->
                <div id="product-grid-descuento" class="product-grid-descuento">

                    <!-- Card 1 -->
                    <div id="product-card-descuento-1" class="product-card-descuento rounded-xl p-4 cursor-pointer">
                        <div
                            class="image-placeholder-descuento w-full h-fit rounded-lg mb-4 flex items-center justify-center">
                            <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400&h=300&fit=crop&crop=center"
                                alt="Sunglasses" class="w-full h-full object-cover rounded-xl">
                        </div>
                        <h4 class="product-title-descuento text-sm mb-2">PRODUCT NAME</h4>
                        <div class="product-price-descuento text-lg">$300</div>
                    </div>

                    

                    <!-- Card 2 -->
                    <div id="product-card-descuento-2" class="product-card-descuento rounded-xl p-4 cursor-pointer">
                        <div
                            class="image-placeholder-descuento w-full h-fit rounded-lg mb-4 flex items-center justify-center">
                            <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400&h=300&fit=crop&crop=center"
                                alt="Sneakers" class="w-full h-full object-cover rounded-xl">
                        </div>
                        <h4 class="product-title-descuento text-sm mb-2">PRODUCT NAME</h4>
                        <div class="product-price-descuento text-lg">$300</div>
                    </div>

                    <!-- Card 3 -->
                    <div id="product-card-descuento-3" class="product-card-descuento rounded-xl p-4 cursor-pointer">
                        <div
                            class="image-placeholder-descuento w-full h-fit rounded-lg mb-4 flex items-center justify-center">
                            <img src="https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=400&h=300&fit=crop&crop=center"
                                alt="Mechanical Keyboard" class="w-full h-full object-cover rounded-xl">
                        </div>
                        <h4 class="product-title-descuento text-sm mb-2">PRODUCT NAME</h4>
                        <div class="product-price-descuento text-lg">$300</div>
                    </div>

                    <!-- Card 4 -->
                    <div id="product-card-descuento-4" class="product-card-descuento rounded-xl p-4 cursor-pointer">
                        <div
                            class="image-placeholder-descuento w-full h-fit rounded-lg mb-4 flex items-center justify-center">
                            <img src="https://images.unsplash.com/photo-1546868871-7041f2a55e12?w=400&h=300&fit=crop&crop=center"
                                alt="Gaming Mouse" class="w-full h-full object-cover rounded-xl">
                        </div>
                        <h4 class="product-title-descuento text-sm mb-2">PRODUCT NAME</h4>
                        <div class="product-price-descuento text-lg">$300</div>
                    </div>

                    <!-- Card 5 -->
                    <div id="product-card-descuento-5" class="product-card-descuento rounded-xl p-4 cursor-pointer">
                        <div
                            class="image-placeholder-descuento w-full h-fit rounded-lg mb-4 flex items-center justify-center">
                            <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=400&h=300&fit=crop&crop=center"
                                alt="VR Headset" class="w-full h-full object-cover rounded-xl">
                        </div>
                        <h4 class="product-title-descuento text-sm mb-2">PRODUCT NAME</h4>
                        <div class="product-price-descuento text-lg">$300</div>
                    </div>

                    <!-- Card 6 -->
                    <div id="product-card-descuento-6" class="product-card-descuento rounded-xl p-4 cursor-pointer">
                        <div
                            class="image-placeholder-descuento w-full h-fit rounded-lg mb-4 flex items-center justify-center">
                            <img src="https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=400&h=300&fit=crop&crop=center"
                                alt="Smart Watch" class="w-full h-full object-cover rounded-xl">
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

<script src="js/main.js"></script>