<?php
require_once __DIR__ . '/../config/db_conect.php';
$ruta_imagenes = "../uploads/products/";

if (isset($_GET['id'])) {
  $productId = intval($_GET['id']);
  $sql = "SELECT 
    p.nombre, 
    p.precio_venta, 
    p.imagen_1,
    p.imagen_2,
    p.imagen_3,
    p.prop_1,
    p.prop_2,
    p.prop_3,
    p.descripcion, 
    COALESCE(d.cantidad, 0) AS cantidad,
    COALESCE(p.id_descuento, 0) AS id_descuento
FROM productos p
LEFT JOIN descuento d ON p.id_descuento = d.id_descuento
WHERE p.id_producto = $productId
  AND p.estado = 1";

  $result = $conn->query($sql);
  $product = $result->fetch_assoc();

  $sql_similar = "SELECT 
    p.id_producto,
    p.nombre,
    p.precio_venta,
    p.imagen_1,
    GROUP_CONCAT(c.nombre_categoria SEPARATOR ', ') AS categorias
FROM productos p
INNER JOIN producto_categoria pc ON p.id_producto = pc.id_producto
INNER JOIN categorias c ON pc.id_categoria = c.id_categoria
WHERE p.estado = 1
  AND pc.id_categoria IN (
      SELECT id_categoria
      FROM producto_categoria
      WHERE id_producto = $productId
  )
  AND p.id_producto <> $productId -- opcional: excluir el mismo producto
GROUP BY p.id_producto
ORDER BY RAND();
";

  $resultado = $conn->query($sql_similar);
  $similar_products = $resultado->fetch_assoc();
}
?>
<link rel="stylesheet" href="css/product.css">

<div class="max-w-8xl mx-auto space-y-16 p-6">
  <div class="mb-20">
    <div class="glass-card-v1 rounded-2xl p-8 max-w-4xl mx-auto">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="space-y-4">
          <div class="aspect-square image-container rounded-xl overflow-hidden">
            <img id="mainImage1" src="<?php echo $ruta_imagenes . $product['imagen_1']; ?>"
              class="w-full h-full object-contain bg-white main-image border-2">
          </div>
          <div class="flex gap-3">
            <div class="thumbnail-v1 w-20 h-20 rounded-lg overflow-hidden"
              onclick="changeImage(1, '<?php echo $ruta_imagenes . $product['imagen_1']; ?>', this)">
              <img src="<?php echo $ruta_imagenes . $product['imagen_1']; ?>" alt="Vista A"
                class="w-full h-full object-contain bg-white">
            </div>
            <div class="thumbnail-v1 w-20 h-20 rounded-lg overflow-hidden"
              onclick="changeImage(1, '<?php echo $ruta_imagenes . $product['imagen_2']; ?>', this)">
              <img src="<?php echo $ruta_imagenes . $product['imagen_2']; ?>" alt="Vista B"
                class="w-full h-full object-contain bg-white">
            </div>
            <div class="thumbnail-v1 w-20 h-20 rounded-lg overflow-hidden"
              onclick="changeImage(1, '<?php echo $ruta_imagenes . $product['imagen_3']; ?>', this)">
              <img src="<?php echo $ruta_imagenes . $product['imagen_3']; ?>" alt="Vista C"
                class="w-full h-full object-contain bg-white">
            </div>
          </div>
        </div>

        <!-- Información del Producto -->
        <div class="space-y-6">
          <h3 class="text-4xl  gradient-text-v1 h-[50px]"><?php echo $product['nombre']; ?></h3>
          <div class="text-4xl font-bold price-glow-v1">$<?php echo number_format($product['precio_venta'], 2); ?></div>

          <div class="space-y-3">
            <h4 class="text-lg font-semibold mb-3" style="color: var(--color-gris-texto);">Características:</h4>
            <div class="space-y-2">
              <div class="flex items-center" style="color: var(--color-gris-texto);">
                <div class="bullet-v1 w-2 h-2 rounded-full mr-3"></div>
                <span><?php echo $product['prop_1']; ?></span>
              </div>
              <div class="flex items-center" style="color: var(--color-gris-texto);">
                <div class="bullet-v1 w-2 h-2 rounded-full mr-3"></div>
                <span><?php echo $product['prop_2']; ?></span>
              </div>
              <div class="flex items-center" style="color: var(--color-gris-texto);">
                <div class="bullet-v1 w-2 h-2 rounded-full mr-3"></div>
                <span><?php echo $product['prop_3']; ?></span>
              </div>
              <div class="text-white border-t border-white pt-4">
                <span><?php echo $product['descripcion']; ?></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Carousel Container -->
  <section
    class="carousel-container rounded-3xl p-8 relative mb-10">
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
      <h2 class="banner-title text-2xl sm:text-3xl md:text-4xl mb-4 text-white">PRODUCTOS SIMILARES</h2>
    </div>
    <div class="overflow-y-hidden sm:overflow-hidden mx-1 sm:mx-8">
      <div class="carousel-track carousel-grid m-2" id="carouselTrack">
        <?php if ($resultado && $resultado->num_rows > 0): ?>
          <?php while ($p = $resultado->fetch_assoc()): ?>
            <div class="text-center bg-transparent" data-id="<?= $p['id_producto'] ?>"
              onclick="goToProduct(this)">
              <div class="product-card rounded-2xl p-6 w-[275px] lg:w-[400px] max-sm:w-[200px] mx-auto cursor-pointer">
                <div class="product-image mb-6">
                  <img src="<?= $ruta_imagenes . $p['imagen_1'] ?>" alt="<?= htmlspecialchars($p['nombre']) ?>"
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
  </section>
</div>
<script src="js/product.js"></script>