<?php
require_once __DIR__ . '/../config/db_conect.php';
$ruta_imagenes = "../uploads/products/";

// Consulta: productos destacados y activos
$sql_destacado = "SELECT id_producto, nombre, precio_venta, imagen_1 
        FROM productos 
        WHERE destacado = 1 AND estado = 1
        ORDER BY RAND()";

$resultado = $conn->query($sql_destacado);

$sql_descuento = "SELECT 
    p.id_producto,
    p.nombre, 
    p.precio_venta, 
    p.imagen_1, 
    d.cantidad
FROM productos p
INNER JOIN descuento d ON p.id_descuento = d.id_descuento
WHERE p.id_descuento IS NOT NULL 
  AND p.estado = 1
ORDER BY RAND()
LIMIT 11;
";
$resultado_descuento = $conn->query($sql_descuento);
$productos_descuento = [];
while ($fila = $resultado_descuento->fetch_assoc()) {
    $productos_descuento[] = $fila;
}
?>
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
                    <a href="?page=main#destacado ">
                        <button
                            class="flex items-center bg-gradient-to-r from-yellow-500 to-green-600 text-white px-8 py-4 rounded-full text-lg font-semibold hover:from-yellow-600 hover:to-green-700 transform hover:scale-105 transition-all duration-300 shadow-2xl hover:shadow-yellow-500/25 ">
                            Descubre más
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-move-down-icon lucide-move-down">
                                <path d="M8 18L12 22L16 18" />
                                <path d="M12 2V22" />
                            </svg>
                        </button>
                    </a>

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
    <div id="destacado" style="position: relative; top: -100px;"></div>
    <section
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
                <div class="carousel-track carousel-grid m-2" id="carouselTrack">
                    <?php if ($resultado && $resultado->num_rows > 0): ?>
                        <?php while ($p = $resultado->fetch_assoc()): ?>
                            <div class="text-center bg-transparent w-[300px]" data-id="<?= $p['id_producto'] ?>" onclick="goToProduct(this)">
                                <div class="product-card rounded-2xl p-6 w-full max-w-sm mx-auto cursor-pointer">
                                    <div class="product-image mb-6">
                                        <img src="<?=$ruta_imagenes . $p['imagen_1'] ?>"
                                            alt="<?= htmlspecialchars($p['nombre']) ?>"
                                            class="w-full h-48 object-contain rounded-xl bg-white">
                                    </div>
                                    <h3 class="product-title text-xl leading-tight h-20">
                                        <?= htmlspecialchars($p['nombre']) ?>
                                    </h3>
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between ">
                                            <span class="product-price">$<?= number_format($p['precio_venta'], 2) ?></span>
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
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p class="text-white">No hay productos disponibles con descuento.</p>
                    <?php endif; ?>
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

            <div class="w-full flex justify-center items-center mb-10">
                <h2 class="banner-title text-2xl sm:text-3xl md:text-4xl mb-4">DESCUENTOS</h2>
            </div>

            <!-- Grid principal -->
            <div id="showcase-grid-descuento"
                class="showcase-grid-descuento grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">

                <!-- Card grande (lado izquierdo) -->
                <div class="space-y-4">
                    <div id="product-card-large-descuento-1" data-id="<?= $productos_descuento[0]['id_producto'] ?>"
              onclick="goToProduct(this)"
                        class="product-card-large-descuento rounded-2xl p-6 cursor-pointer ">
                        <div
                            class="image-placeholder-descuento rounded-xl mb-6 flex items-center justify-center">
                            <img src="<?=$ruta_imagenes . $productos_descuento[0]['imagen_1'] ?>"
                                alt="<?= $productos_descuento[0]['nombre'] ?>"
                                class="w-full h-full object-contain rounded-xl">
                        </div>
                        <div class="discount-badge-floating">
                            <?= $productos_descuento[0]['cantidad'] ?>%
                        </div>
                        <div class="space-y-3">
                            <h3 class="product-title-descuento text-3xl"><?= $productos_descuento[0]['nombre'] ?></h3>
                            <div class="price-container-vertical">
                                <div class="product-price-original text-lg">
                                    $<?= $productos_descuento[0]['precio_venta'] ?>
                                </div>
                                <div class="product-price-descuento text-3xl">
                                    $<?= number_format($productos_descuento[0]['precio_venta'] / (1 + ( $productos_descuento[0]['cantidad'] / 100)), 2) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="product-card-large-descuento-1" data-id="<?= $productos_descuento[1]['id_producto'] ?>"
              onclick="goToProduct(this)"
                        class="product-card-large-descuento rounded-2xl p-6 cursor-pointer ">
                        <div
                            class="image-placeholder-descuento rounded-xl mb-6 flex items-center justify-center">
                            <img src="<?=$ruta_imagenes . $productos_descuento[1]['imagen_1'] ?>"
                                alt="<?= $productos_descuento[1]['nombre'] ?>"
                                class="w-full h-full object-contain rounded-xl">
                        </div>

                        <div class="discount-badge-floating">
                            <?= $productos_descuento[1]['cantidad']?>%
                        </div>
                        <div class="space-y-3">
                            <h3 class="product-title-descuento text-3xl"><?= $productos_descuento[1]['nombre'] ?></h3>
                            <div class="price-container-vertical">
                                <div class="product-price-original text-lg">
                                    $<?= $productos_descuento[1]['precio_venta'] ?>
                                </div>
                                <div class="product-price-descuento text-3xl">
                                    $<?= number_format($productos_descuento[1]['precio_venta'] / (1 + ( $productos_descuento[1]['cantidad'] / 100)), 2) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="product-card-large-descuento-1" data-id="<?= $productos_descuento[2]['id_producto'] ?>"
              onclick="goToProduct(this)"
                        class="product-card-large-descuento rounded-2xl p-6 cursor-pointer ">
                        <div
                            class="image-placeholder-descuento rounded-xl mb-6 flex items-center justify-center">
                            <img src="<?=$ruta_imagenes . $productos_descuento[2]['imagen_1'] ?>"
                                alt="<?= $productos_descuento[2]['nombre'] ?>"
                                class="w-full h-full object-contain rounded-xl">
                        </div>

                        <div class="discount-badge-floating">
                            <?= $productos_descuento[2]['cantidad']?>%
                        </div>
                        <div class="space-y-3">
                            <h3 class="product-title-descuento text-2xl"><?= $productos_descuento[2]['nombre'] ?></h3>
                            <div class="price-container-vertical">
                                <div class="product-price-original text-lg">
                                    $<?= $productos_descuento[2]['precio_venta'] ?>
                                </div>
                                <div class="product-price-descuento text-3xl">
                                    $<?= number_format($productos_descuento[2]['precio_venta'] / (1 + ( $productos_descuento[2]['cantidad'] / 100)), 2) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Cards pequeñas (lado derecho) -->
                <div id="product-grid-descuento" class="product-grid-descuento">

                    <!-- Card 1 -->
                    <div id="product-card-descuento-1" class="product-card-descuento rounded-xl p-4 cursor-pointer" data-id="<?= $productos_descuento[3]['id_producto'] ?>"
              onclick="goToProduct(this)">
                        <div
                            class="image-placeholder-descuento rounded-lg mb-4 flex items-center justify-center">
                            <img src="<?=$ruta_imagenes . $productos_descuento[3]['imagen_1'] ?>"
                                alt="<?= $productos_descuento[3]['nombre'] ?>"
                                class="rounded-xl bg-white">
                        </div>
                        <div class="discount-badge-floating product-sm">
                            <?= $productos_descuento[3]['cantidad']?>%
                        </div>
                        <div class="space-y-3">
                            <h3 class="product-title-descuento text-2xl"><?= $productos_descuento[3]['nombre'] ?></h3>
                            <div class="price-container-vertical">
                                <div class="product-price-original text-lg">
                                    $<?= $productos_descuento[3]['precio_venta'] ?>
                                </div>
                                <div class="product-price-descuento text-3xl">
                                    $<?= number_format($productos_descuento[3]['precio_venta'] / (1 + ( $productos_descuento[3]['cantidad'] / 100)), 2) ?>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Card 2 -->
                    <div id="product-card-descuento-2" class="product-card-descuento rounded-xl p-4 cursor-pointer" data-id="<?= $productos_descuento[4]['id_producto'] ?>"
              onclick="goToProduct(this)">
                        <div
                            class="image-placeholder-descuento w-full h-fit rounded-lg mb-4 flex items-center justify-center">
                            <img src="<?=$ruta_imagenes . $productos_descuento[4]['imagen_1'] ?>"
                                alt="<?= $productos_descuento[4]['nombre'] ?>"
                                class="rounded-xl">
                        </div>
                        <div class="discount-badge-floating product-sm">
                            <?= $productos_descuento[4]['cantidad']?>%
                        </div>
                        <div class="space-y-3">
                            <h3 class="product-title-descuento text-2xl"><?= $productos_descuento[4]['nombre'] ?></h3>
                            <div class="price-container-vertical">
                                <div class="product-price-original text-lg">
                                    $<?= $productos_descuento[4]['precio_venta'] ?>
                                </div>
                                <div class="product-price-descuento text-3xl">
                                    $<?= number_format($productos_descuento[4]['precio_venta'] / (1 + ( $productos_descuento[4]['cantidad'] / 100)), 2) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div id="product-card-descuento-3" class="product-card-descuento rounded-xl p-4 cursor-pointer" data-id="<?= $productos_descuento[5]['id_producto'] ?>"
              onclick="goToProduct(this)">
                        <div
                            class="image-placeholder-descuento w-full h-fit rounded-lg mb-4 flex items-center justify-center">
                            <img src="<?=$ruta_imagenes . $productos_descuento[5]['imagen_1'] ?>"
                                alt="<?= $productos_descuento[5]['nombre'] ?>"
                                class="rounded-xl">
                        </div>
                        <div class="discount-badge-floating product-sm">
                            <?= $productos_descuento[5]['cantidad']?>%
                        </div>
                        <div class="space-y-3">
                            <h3 class="product-title-descuento text-2xl"><?= $productos_descuento[5]['nombre'] ?></h3>
                            <div class="price-container-vertical">
                                <div class="product-price-original text-lg">
                                    $<?= $productos_descuento[5]['precio_venta'] ?>
                                </div>
                                <div class="product-price-descuento text-3xl">
                                    $<?= number_format($productos_descuento[5]['precio_venta'] / (1 + ( $productos_descuento[5]['cantidad'] / 100)), 2) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div id="product-card-descuento-4" class="product-card-descuento rounded-xl p-4 cursor-pointer" data-id="<?= $productos_descuento[6]['id_producto'] ?>"
              onclick="goToProduct(this)">
                        <div
                            class="image-placeholder-descuento w-full h-fit rounded-lg mb-4 flex items-center justify-center">
                            <img src="<?=$ruta_imagenes . $productos_descuento[6]['imagen_1'] ?>"
                                alt="<?= $productos_descuento[6]['nombre'] ?>"
                                class="rounded-xl">
                        </div>
                        <div class="discount-badge-floating product-sm">
                            <?= $productos_descuento[6]['cantidad']?>%
                        </div>
                        <div class="space-y-3">
                            <h3 class="product-title-descuento text-2xl"><?= $productos_descuento[6]['nombre'] ?></h3>
                            <div class="price-container-vertical">
                                <div class="product-price-original text-lg">
                                    $<?= $productos_descuento[6]['precio_venta'] ?>
                                </div>
                                <div class="product-price-descuento text-3xl">
                                    $<?= number_format($productos_descuento[6]['precio_venta'] / (1 + ( $productos_descuento[6]['cantidad'] / 100)), 2) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 5 -->
                    <div id="product-card-descuento-5" class="product-card-descuento rounded-xl p-4 cursor-pointer" data-id="<?= $productos_descuento[7]['id_producto'] ?>"
              onclick="goToProduct(this)">
                        <div
                            class="image-placeholder-descuento w-full h-fit rounded-lg mb-4 flex items-center justify-center">
                            <img src="<?=$ruta_imagenes . $productos_descuento[7]['imagen_1'] ?>"
                                alt="<?= $productos_descuento[7]['nombre'] ?>"
                                class="rounded-xl">
                        </div>
                        <div class="discount-badge-floating product-sm">
                            <?= $productos_descuento[7]['cantidad']?>%
                        </div>
                        <div class="space-y-3">
                            <h3 class="product-title-descuento text-2xl"><?= $productos_descuento[7]['nombre'] ?></h3>
                            <div class="price-container-vertical">
                                <div class="product-price-original text-lg">
                                    $<?= $productos_descuento[7]['precio_venta'] ?>
                                </div>
                                <div class="product-price-descuento text-3xl">
                                    $<?= number_format($productos_descuento[7]['precio_venta'] / (1 + ( $productos_descuento[7]['cantidad'] / 100)), 2) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 6 -->
                    <div id="product-card-descuento-6" class="product-card-descuento rounded-xl p-4 cursor-pointer" data-id="<?= $productos_descuento[8]['id_producto'] ?>"
              onclick="goToProduct(this)">
                        <div
                            class="image-placeholder-descuento w-full h-fit rounded-lg mb-4 flex items-center justify-center">
                            <img src="<?=$ruta_imagenes . $productos_descuento[8]['imagen_1'] ?>"
                                alt="<?= $productos_descuento[8]['nombre'] ?>"
                                class="rounded-xl">
                        </div>
                        <div class="discount-badge-floating product-sm">
                            <?= $productos_descuento[8]['cantidad']?>%
                        </div>
                        <div class="space-y-3">
                            <h3 class="product-title-descuento text-2xl"><?= $productos_descuento[8]['nombre'] ?></h3>
                            <div class="price-container-vertical">
                                <div class="product-price-original text-lg">
                                    $<?= $productos_descuento[8]['precio_venta'] ?>
                                </div>
                                <div class="product-price-descuento text-3xl">
                                    $<?= number_format($productos_descuento[8]['precio_venta'] / (1 + ( $productos_descuento[8]['cantidad'] / 100)), 2) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 6 -->
                    <div id="product-card-descuento-6" class="product-card-descuento rounded-xl p-4 cursor-pointer" data-id="<?= $productos_descuento[9]['id_producto'] ?>"
              onclick="goToProduct(this)">
                        <div
                            class="image-placeholder-descuento w-full h-fit rounded-lg mb-4 flex items-center justify-center">
                            <img src="<?=$ruta_imagenes . $productos_descuento[9]['imagen_1'] ?>"
                                alt="<?= $productos_descuento[9]['nombre'] ?>"
                                class="rounded-xl">
                        </div>
                        <div class="discount-badge-floating product-sm">
                            <?= $productos_descuento[9]['cantidad']?>%
                        </div>
                        <div class="space-y-3">
                            <h3 class="product-title-descuento text-2xl"><?= $productos_descuento[9]['nombre'] ?></h3>
                            <div class="price-container-vertical">
                                <div class="product-price-original text-lg">
                                    $<?= $productos_descuento[9]['precio_venta'] ?>
                                </div>
                                <div class="product-price-descuento text-3xl">
                                    $<?= number_format($productos_descuento[9]['precio_venta'] / (1 + ( $productos_descuento[9]['cantidad'] / 100)), 2) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 6 -->
                    <div id="product-card-descuento-6" class="product-card-descuento rounded-xl p-4 cursor-pointer" data-id="<?= $productos_descuento[10]['id_producto'] ?>"
              onclick="goToProduct(this)">
                        <div
                            class="image-placeholder-descuento w-full h-fit rounded-lg mb-4 flex items-center justify-center">
                            <img src="<?=$ruta_imagenes . $productos_descuento[10]['imagen_1'] ?>"
                                alt="<?= $productos_descuento[10]['nombre'] ?>"
                                class="rounded-xl">
                        </div>
                        <div class="discount-badge-floating product-sm">
                            <?= $productos_descuento[10]['cantidad']?>%
                        </div>
                        <div class="space-y-3">
                            <h3 class="product-title-descuento text-2xl"><?= $productos_descuento[10]['nombre'] ?></h3>
                            <div class="price-container-vertical">
                                <div class="product-price-original text-lg">
                                    $<?= $productos_descuento[10]['precio_venta'] ?>
                                </div>
                                <div class="product-price-descuento text-3xl">
                                    $<?= number_format($productos_descuento[10]['precio_venta'] / (1 + ( $productos_descuento[10]['cantidad'] / 100)), 2) ?>
                                </div>
                            </div>
                        </div>
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