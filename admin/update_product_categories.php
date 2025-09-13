<?php
include "../config/db_conect.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $id_producto = intval($_POST['id_producto']);
        $categorias = json_decode($_POST['categorias'], true);
        
        $conn->query("DELETE FROM producto_categoria WHERE id_producto = $id_producto");
        
        if (!empty($categorias)) {
            $values = array();
            foreach ($categorias as $id_categoria) {
                $values[] = "($id_producto, " . intval($id_categoria) . ")";
            }
            $sql = "INSERT INTO producto_categoria (id_producto, id_categoria) VALUES " . implode(',', $values);
            $conn->query($sql);
        }
        
        echo json_encode(['success' => true, 'message' => 'Actualizado correctamente']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
$conn->close();
?>