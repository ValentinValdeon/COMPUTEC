<?php
include "../config/db_conect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $id_producto = intval($_POST['id_producto']);
        $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
        $codigo = mysqli_real_escape_string($conn, $_POST['codigo']);
        $precio_compra = floatval($_POST['precio_compra']);
        $precio_venta = floatval($_POST['precio_venta']);
        $stock = intval($_POST['stock']);
        $stock_min = intval($_POST['stock_min']);
        $estado = intval($_POST['estado']);
        $destacado = intval($_POST['destacado']);
        $id_descuento = isset($_POST['id_descuento']) && $_POST['id_descuento'] !== '' ? intval($_POST['id_descuento']) : 'NULL';
        
        $sql = "UPDATE productos SET 
                    nombre = '$nombre',
                    codigo = '$codigo',
                    precio_compra = $precio_compra,
                    precio_venta = $precio_venta,
                    stock = $stock,
                    stock_min = $stock_min,
                    estado = $estado,
                    id_descuento = $id_descuento,
                    destacado = $destacado
                WHERE id_producto = $id_producto";
        
        if ($conn->query($sql) === TRUE) {
            echo json_encode([
                'success' => true, 
                'message' => 'Producto actualizado correctamente'
            ]);
        } else {
            echo json_encode([
                'success' => false, 
                'message' => 'Error al actualizar: ' . $conn->error
            ]);
        }
        
    } catch (Exception $e) {
        echo json_encode([
            'success' => false, 
            'message' => 'Error: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'success' => false, 
        'message' => 'Método no permitido'
    ]);
}

$conn->close();
?>