<?php
include "../config/db_conect.php";

// ===== Recibir valores del formulario =====
$codigo        = $_POST['codigo'] ?? null;
$nombre        = $_POST['nombre'] ?? null;
$precio_compra = $_POST['precio_compra'] ?? 0;
$precio_venta  = $_POST['precio_venta'] ?? 0;
$stock         = $_POST['stock_actual'] ?? 0;
$stock_min     = $_POST['stock_minimo'] ?? 0;
$prop_1        = $_POST['propiedad1'] ?? null;
$prop_2        = $_POST['propiedad2'] ?? null;
$prop_3        = $_POST['propiedad3'] ?? null;
$checkbox      = isset($_POST['producto_destacado']) ? 1 : 0;
$descripcion   = !empty($_POST['descripcion']) ? $_POST['descripcion'] : null;
$imagen        = !empty($_POST['imagenes']) ? $_POST['imagenes'] : null;
$id_descuento  = !empty($_POST['id_descuento']) ? $_POST['id_descuento'] : null;

// ===== Insertar producto =====
$sql = "INSERT INTO productos 
(codigo, nombre, precio_compra, precio_venta, stock, stock_min, prop_1, prop_2, prop_3, destacado, descripcion, imagen, id_descuento)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssddiisssissi",
    $codigo,
    $nombre,
    $precio_compra,
    $precio_venta,
    $stock,
    $stock_min,
    $prop_1,
    $prop_2,
    $prop_3,
    $checkbox,
    $descripcion,
    $imagen,
    $id_descuento
);

if (!$stmt->execute()) {
    die("❌ Error insertando producto: " . $stmt->error);
}

// ===== Capturar ID del producto insertado =====
$id_producto = $conn->insert_id;

if ($id_producto <= 0) {
    die("❌ ID de producto no válido");
}

// ===== Insertar categorías seleccionadas =====
if (!empty($_POST['categorias_seleccionadas'])) {
    $sql_categoria = "INSERT INTO producto_categoria (id_producto, id_categoria) VALUES (?, ?)";
    $stmt_categoria = $conn->prepare($sql_categoria);

    foreach ($_POST['categorias_seleccionadas'] as $id_categoria) {
        $stmt_categoria->bind_param("ii", $id_producto, $id_categoria);
        if (!$stmt_categoria->execute()) {
            die("❌ Error insertando categoría: " . $stmt_categoria->error);
        }
    }
}

echo "<script>alert('✅ Producto y categorías insertadas correctamente');</script>";

$stmt->close();
$conn->close();

// Redirigir a la página de productos
header("Location: create_product.php"); // <- Cambia al nombre de tu página
exit;
?>
