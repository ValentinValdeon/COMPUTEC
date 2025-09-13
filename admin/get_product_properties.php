<?php
include "../config/db_conect.php";
if (isset($_GET['id'])) {
    try {
        $id_producto = intval($_GET['id']);
        $sql = "SELECT prop_1, prop_2, prop_3 FROM productos WHERE id_producto = $id_producto";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $properties = $result->fetch_assoc();
            echo json_encode(['success' => true, 'properties' => $properties]);
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