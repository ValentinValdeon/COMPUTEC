<?php
include "../config/db_conect.php";

if (isset($_GET['id'])) {
    try {
        $id_producto = intval($_GET['id']);
        
        $sql = "SELECT imagen_1, imagen_2, imagen_3 FROM productos WHERE id_producto = $id_producto";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $images = $result->fetch_assoc();
            
            // Ruta absoluta con dominio
            $baseURL = "http://localhost/COMPUTEC/uploads/products/"; // Cambiar si tu dominio es otro
            foreach ($images as $key => $value) {
                if ($value && trim($value) !== '') {
                    $images[$key] = $baseURL . $value;
                } else {
                    $images[$key] = ''; // si no hay imagen
                }
            }

            echo json_encode(['success' => true, 'images' => $images]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Producto no encontrado']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID requerido']);
}

$conn->close();
?>
