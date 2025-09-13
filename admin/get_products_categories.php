<?php
include "../config/db_conect.php";
if (isset($_GET['id'])) {
    try {
        $id_producto = intval($_GET['id']);
        $sql = "SELECT id_categoria FROM producto_categoria WHERE id_producto = $id_producto";
        $result = $conn->query($sql);
        $categories = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = intval($row['id_categoria']);
            }
        }
        echo json_encode(['success' => true, 'categories' => $categories]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID requerido']);
}
$conn->close();
?>