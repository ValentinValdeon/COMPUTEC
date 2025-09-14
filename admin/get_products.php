<?php
include "../config/db_conect.php";

try {
    $sql = "SELECT 
                p.id_producto,
                p.codigo,
                p.nombre,
                p.precio_compra,
                p.precio_venta,
                p.stock,
                p.stock_min,
                p.prop_1,
                p.prop_2,
                p.prop_3,
                p.destacado,
                p.descripcion,
                p.imagen_1,
                p.imagen_2,
                p.imagen_3,
                p.id_descuento,
                p.estado,
                COALESCE(d.cantidad, 0) as descuento_cantidad
            FROM productos p
            LEFT JOIN descuento d ON p.id_descuento = d.id_descuento
            ORDER BY p.nombre";
    
    $result = $conn->query($sql);
    $products = array();
    
    if ($result->num_rows > 0) {
        while ($producto = $result->fetch_assoc()) {
            // Obtener categorías
            $sql_cat = "SELECT c.id_categoria, c.nombre_categoria 
                       FROM categorias c 
                       INNER JOIN producto_categoria pc ON c.id_categoria = pc.id_categoria 
                       WHERE pc.id_producto = {$producto['id_producto']}";
            $result_cat = $conn->query($sql_cat);
            
            $categorias = array();
            $categorias_ids = array();
            while ($cat = $result_cat->fetch_assoc()) {
                $categorias[] = $cat['nombre_categoria'];
                $categorias_ids[] = $cat['id_categoria'];
            }
            
            // Propiedades no vacías
            $propiedades = array_filter([
                $producto['prop_1'],
                $producto['prop_2'],
                $producto['prop_3']
            ]);
            
            $producto['categorias'] = $categorias;
            $producto['categorias_ids'] = $categorias_ids;
            $producto['propiedades'] = array_values($propiedades);
            
            $products[] = $producto;
        }
    }
    
    echo json_encode(['success' => true, 'products' => $products]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>