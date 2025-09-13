<?php
include "../config/db_conect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $id = $_POST['id_producto'];
        
        $sql = "UPDATE productos SET estado = 0 WHERE id_producto = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Producto deshabilitado']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al deshabilitar']);
        }
        
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
?>