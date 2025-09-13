<?php
include "../config/db_conect.php";
try {
    $sql = "SELECT id_categoria, nombre_categoria FROM categorias ORDER BY nombre_categoria";
    $result = $conn->query($sql);
    $categories = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }
    echo json_encode(['success' => true, 'categories' => $categories]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
$conn->close();
?>