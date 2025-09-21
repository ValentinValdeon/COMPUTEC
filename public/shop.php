<?php
require_once __DIR__ . '/../config/db_conect.php';
$ruta_imagenes = "../uploads/products/";

// Consulta: productos destacados y activos
$sql = "SELECT 
    p.id_producto,
    p.nombre,
    p.precio_venta,
    p.imagen_1,
    p.descripcion,
    p.prop_1,
    p.prop_2,
    p.prop_3,
    GROUP_CONCAT(c.nombre_categoria SEPARATOR ', ') AS categorias
FROM productos p
INNER JOIN producto_categoria pc ON p.id_producto = pc.id_producto
INNER JOIN categorias c ON pc.id_categoria = c.id_categoria
WHERE p.estado = 1
GROUP BY p.id_producto
ORDER BY RAND()";
$resultado = $conn->query($sql);

$sql_categorias = "SELECT nombre_categoria FROM categorias";
$resultado_categorias = $conn->query($sql_categorias);

?>
<link rel="stylesheet" href="css/shop.css">
<div class="bg-overlay"></div>

<div class="container-gallery">
    <div class="header">
        <h1>SHOP</h1>
        <p>Descubre lo último en tecnología disponible en nuestra sucursal</p>
    </div>

    <div class="search-container-shop">
        <input type="text" class="search-input-shop" placeholder="Buscar productos..." id="searchInput-shop">
        <div class="search-icon-shop">🔍</div>
    </div>

    <div class="filters">
        <button class="filter-btn active" data-category="all">🏷Todos</button>
        <?php
        while ($fila = $resultado_categorias->fetch_assoc()) {
            $categoria = $fila['nombre_categoria'];
            echo "<button class='filter-btn' data-category='" . strtolower($categoria) . "'>🏷 " . ucfirst($categoria) . "</button>";
        }
        ?>
    </div>

    <div class="gallery" id="gallery">
        <?php while ($p = $resultado->fetch_assoc()): ?>
            <div class="product-card-gallery fade-in"
                data-category="<?= htmlspecialchars(str_replace(', ', ',', $p['categorias'])) ?>">
                <div class="product-image-gallery">
                    <img src="<?= $ruta_imagenes . $p['imagen_1'] ?>" alt="<?= $p['nombre'] ?>"
                        class="w-full h-full object-contain rounded-xl bg-white">
                </div>

                <div class="product-title-gallery">
                    <?= $p['nombre'] ?>
                </div>

                <div class="product-specs-gallery">
                    <?php if (!empty($p['prop_1'])): ?>
                        <span class="spec-tag"><?= $p['prop_1'] ?></span>
                    <?php endif; ?>
                    <?php if (!empty($p['prop_2'])): ?>
                        <span class="spec-tag"><?= $p['prop_2'] ?></span>
                    <?php endif; ?>
                    <?php if (!empty($p['prop_3'])): ?>
                        <span class="spec-tag"><?= $p['prop_3'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="product-description-gallery">
                    <?= $p['descripcion'] ?>
                </div>

                <div class="product-price-gallery">
                    $<?= number_format($p['precio_venta'], 2) ?>
                    <span style="font-size: 0.8rem; color: var(--c-gris-medio-main);">ARS</span>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<script src="js/shop.js"></script>