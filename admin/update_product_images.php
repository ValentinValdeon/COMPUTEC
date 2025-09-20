<?php
include "../config/db_conect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $id_producto = intval($_POST['id_producto']);
        $upload_dir = '../uploads/products/'; // carpeta absoluta relativa a este script

        // Crear directorio si no existe
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $images = ['', '', ''];

        for ($i = 1; $i <= 3; $i++) {
            $currentInput = $_POST["current_imagen_$i"] ?? '';

            // Si se subió nueva imagen
            if (isset($_FILES["imagen_$i"]) && $_FILES["imagen_$i"]['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES["imagen_$i"];
                $allowed_types = ['image/jpeg', 'image/png', 'image/jfif', 'image/webp'];
                $max_size = 5 * 1024 * 1024; // 5MB

                if (!in_array($file['type'], $allowed_types)) {
                    throw new Exception("Tipo de archivo no permitido para imagen $i");
                }

                if ($file['size'] > $max_size) {
                    throw new Exception("El archivo de imagen $i es demasiado grande");
                }

                $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $filename = "producto_{$id_producto}_img{$i}_" . time() . ".$extension";
                $filepath = $upload_dir . $filename;

                // Eliminar imagen anterior si existía
                if (!empty($currentInput)) {
                    $prevFile = $upload_dir . basename($currentInput); 
                    if (file_exists($prevFile)) unlink($prevFile);
                }

                if (move_uploaded_file($file['tmp_name'], $filepath)) {
                    $images[$i - 1] = $filename; // SOLO nombre del archivo
                } else {
                    throw new Exception("Error al subir imagen $i");
                }
            }
            // Si no hay nueva imagen, mantener la actual
            else if (!empty($currentInput)) {
                $images[$i - 1] = basename($currentInput); // SOLO nombre
            }
        }

        $sql = "UPDATE productos SET 
                    imagen_1 = ?,
                    imagen_2 = ?,
                    imagen_3 = ?
                WHERE id_producto = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $images[0], $images[1], $images[2], $id_producto);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Imágenes actualizadas correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar en base de datos']);
        }

    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}

$conn->close();
?>
