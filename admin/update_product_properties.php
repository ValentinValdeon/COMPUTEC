<?php
include "../config/db_conect.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $id_producto = intval($_POST['id_producto']);
        $prop_1 = mysqli_real_escape_string($conn, $_POST['prop_1']);
        $prop_2 = mysqli_real_escape_string($conn, $_POST['prop_2']);
        $prop_3 = mysqli_real_escape_string($conn, $_POST['prop_3']);
        
        $sql = "UPDATE productos SET 
                    prop_1 = '$prop_1',
                    prop_2 = '$prop_2',
                    prop_3 = '$prop_3'
                WHERE id_producto = $id_producto";
        
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['success' => true, 'message' => 'Propiedades actualizadas']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
$conn->close();
?>