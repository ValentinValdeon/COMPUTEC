<?php
include "../config/db_conect.php";

$codigo = $_POST['codigo'];
$nombre = $_POST['nombre'];
$precio_compra = $_POST['precio_compra'];
$precio_venta = $_POST['precio_venta'];
$stock = $_POST['stock_actual'];
$stock_min = $_POST['stock_minimo'];
$prop_1 = $_POST['propiedad1'];
$prop_2 = $_POST['propiedad2'];
$prop_3 = $_POST['propiedad3'];
$checkbox = isset($_POST['producto_destacado']) ? 1 : 0;
$descripcion = $_POST['descripcion'] ?: null; // puede ser null
$imagen = $_POST['imagenes'] ?: null; // puede ser null
$id_descuento = $_POST['id_descuento'] ?: null; // puede ser null

$sql = "INSERT INTO productos 
(codigo, nombre, precio_compra, precio_venta, stock, stock_min, prop_1, prop_2, prop_3, destacado, descripcion, imagen, id_descuento)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";


$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssddiiiiiissi",
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

if ($stmt->execute()) {
    echo "<script>alert('✅ Producto creado con éxito');</script>";
} else {
    $error = addslashes($conn->error);
    echo "<script>alert('❌ Error: $error');</script>";
}


?>