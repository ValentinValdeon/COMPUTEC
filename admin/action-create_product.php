<?php
include "../config/db_conect.php";

// ===== Recibir valores del formulario =====
$codigo = $_POST['codigo'] ?? null;
$nombre = $_POST['nombre'] ?? null;
$precio_compra = $_POST['precio_compra'] ?? 0;
$precio_venta = $_POST['precio_venta'] ?? 0;
$stock = $_POST['stock_actual'] ?? 0;
$stock_min = $_POST['stock_minimo'] ?? 0;
$prop_1 = $_POST['propiedad1'] ?? null;
$prop_2 = $_POST['propiedad2'] ?? null;
$prop_3 = $_POST['propiedad3'] ?? null;
$checkbox = isset($_POST['producto_destacado']) ? 1 : 0;
$descripcion = !empty($_POST['descripcion']) ? $_POST['descripcion'] : null;
$id_descuento = !empty($_POST['id_descuento']) ? $_POST['id_descuento'] : null;
$imagenes = $_FILES['imagenes'] ?? null;

// Inicializamos campos de imagen vacíos
$imagen = ['', '', ''];

// ===== Insertar producto sin imágenes (temporal) =====
$sql = "INSERT INTO productos 
(codigo, nombre, precio_compra, precio_venta, stock, stock_min, prop_1, prop_2, prop_3, destacado, descripcion, imagen_1, imagen_2, imagen_3, id_descuento)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssddiisssissssi",
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
    $imagen[0],
    $imagen[1],
    $imagen[2],
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

// ===== Subir imágenes con nombre basado en ID del producto =====
$upload_dir = "../uploads/products/";
if (!is_dir($upload_dir))
    mkdir($upload_dir, 0777, true);

if ($imagenes && count($imagenes['name']) > 0) {
    for ($i = 0; $i < min(3, count($imagenes['name'])); $i++) {
        if ($imagenes['error'][$i] === 0) {
            $extension = pathinfo($imagenes['name'][$i], PATHINFO_EXTENSION);
            $nombreArchivo = "producto_{$id_producto}_img" . ($i + 1) . "_" . time() . ".$extension";
            $destino = $upload_dir . $nombreArchivo;

            if (move_uploaded_file($imagenes['tmp_name'][$i], $destino)) {
                $imagen[$i] = $nombreArchivo;
            }
        }
    }

    // ===== Actualizar producto con los nombres finales de las imágenes =====
    $sql_update = "UPDATE productos SET imagen_1=?, imagen_2=?, imagen_3=? WHERE id_producto=?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("sssi", $imagen[0], $imagen[1], $imagen[2], $id_producto);
    $stmt_update->execute();
    $stmt_update->close();
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
header("Location: main-admin.php?page=create_product");
exit;
?>