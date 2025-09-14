<?php
include "../config/db_conect.php";

// Procesar formulario de nuevo descuento
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'add_discount') {
        $cantidad = floatval($_POST['cantidad']);
        
        if ($cantidad > 0 && $cantidad <= 100) {
            $sql = "INSERT INTO descuento (cantidad) VALUES ($cantidad)";
            
            if ($conn->query($sql) === TRUE) {
                $success_message = "Descuento agregado correctamente";
            } else {
                $error_message = "Error al agregar descuento: " . $conn->error;
            }
        } else {
            $error_message = "El descuento debe ser mayor a 0 y menor o igual a 100";
        }
    }
    
    if ($_POST['action'] == 'delete_discount') {
        $id_descuento = intval($_POST['id_descuento']);
        
        // Iniciar transacción
        $conn->autocommit(FALSE);
        
        try {
            // Remover descuentos de productos (establecer a NULL)
            $sql1 = "UPDATE productos SET id_descuento = NULL WHERE id_descuento = $id_descuento";
            $conn->query($sql1);
            
            // Eliminar descuento
            $sql2 = "DELETE FROM descuento WHERE id_descuento = $id_descuento";
            $conn->query($sql2);
            
            // Confirmar transacción
            $conn->commit();
            $success_message = "Descuento eliminado correctamente";
            
        } catch (Exception $e) {
            // Revertir transacción en caso de error
            $conn->rollback();
            $error_message = "Error al eliminar descuento: " . $e->getMessage();
        }
        
        $conn->autocommit(TRUE);
    }
}

// Obtener todos los descuentos
$sql = "SELECT id_descuento, cantidad FROM descuento ORDER BY cantidad DESC";
$result = $conn->query($sql);
?>

<div class="p-8">
    <div class="bg-white/90 backdrop-blur-sm rounded-3xl p-8 shadow-2xl">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Gestión de Descuentos</h1>
            <div class="w-24 h-1 bg-bright-yellow mx-auto mt-3 rounded-full"></div>
        </div>

        <!-- Mensajes -->
        <?php if (isset($success_message)): ?>
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Formulario para nuevo descuento -->
            <div class="bg-military-green/5 rounded-2xl p-6">
                <h2 class="text-xl font-bold text-military-green mb-4">Agregar Nuevo Descuento</h2>
                
                <form method="POST" class="space-y-4">
                    <input type="hidden" name="action" value="add_discount">
                    
                    <div>
                        <label for="cantidad" class="block text-sm font-medium text-gray-700 mb-2">
                            Porcentaje de Descuento
                        </label>
                        <div class="relative">
                            <input type="number" 
                                   id="cantidad" 
                                   name="cantidad" 
                                   min="0.01" 
                                   max="100" 
                                   step="0.01" 
                                   required
                                   class="w-full px-4 py-3 pr-12 border-2 border-gray-200 rounded-xl focus:border-military-green focus:outline-none transition-colors"
                                   placeholder="Ej: 10, 15, 25...">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                <span class="text-gray-500 font-medium">%</span>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Ingresa un valor entre 0.01 y 100</p>
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-military-green hover:bg-olive text-white font-semibold py-3 px-4 rounded-xl transition-colors duration-200">
                        Agregar Descuento
                    </button>
                </form>
            </div>

            <!-- Lista de descuentos existentes -->
            <div class="bg-bright-yellow/5 rounded-2xl p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Descuentos Existentes</h2>
                
                <div class="max-h-96 overflow-y-auto space-y-2">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($descuento = $result->fetch_assoc()): ?>
                            <?php
                            // Contar productos con este descuento
                            $sql_count = "SELECT COUNT(*) as total FROM productos WHERE id_descuento = {$descuento['id_descuento']}";
                            $result_count = $conn->query($sql_count);
                            $productos_con_descuento = $result_count->fetch_assoc()['total'];
                            ?>
                            <div class="flex items-center justify-between p-3 bg-white rounded-lg shadow-sm border">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                        <span class="text-white text-sm">💸</span>
                                    </div>
                                    <div>
                                        <span class="font-bold text-green-600 text-lg">
                                            <?php echo number_format($descuento['cantidad'], 2); ?>%
                                        </span>
                                        <div class="text-xs text-gray-500">
                                            <?php echo $productos_con_descuento; ?> productos
                                        </div>
                                    </div>
                                </div>
                                
                                <form method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar este descuento? Se quitará de todos los productos que lo tienen asignado.')">
                                    <input type="hidden" name="action" value="delete_discount">
                                    <input type="hidden" name="id_descuento" value="<?php echo $descuento['id_descuento']; ?>">
                                    <button type="submit" 
                                            class="text-green-500 hover:text-green-700 hover:bg-gray-200 p-2 rounded-lg transition-colors">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="text-center py-8 text-gray-500">
                            <div class="text-4xl mb-2">💸</div>
                            <p>No hay descuentos registrados</p>
                            <p class="text-sm">Agrega tu primer descuento usando el formulario</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-military-green/10 rounded-xl p-4 text-center">
                <div class="text-2xl font-bold text-military-green">
                    <?php echo $result->num_rows; ?>
                </div>
                <div class="text-sm text-gray-600">Total Descuentos</div>
            </div>
            
            <div class="bg-red-50 rounded-xl p-4 text-center">
                <div class="text-2xl font-bold text-red-600">
                    <?php
                    $sql_productos_descuento = "SELECT COUNT(*) as total FROM productos WHERE id_descuento IS NOT NULL";
                    $result_productos_descuento = $conn->query($sql_productos_descuento);
                    $productos_con_descuento_total = $result_productos_descuento->fetch_assoc()['total'];
                    echo $productos_con_descuento_total;
                    ?>
                </div>
                <div class="text-sm text-gray-600">Productos con Descuento</div>
            </div>
            
            <div class="bg-bright-yellow/10 rounded-xl p-4 text-center">
                <div class="text-2xl font-bold text-bright-yellow">
                    <?php
                    if ($result->num_rows > 0) {
                        $result->data_seek(0); // Reiniciar el puntero del resultado
                        $sql_max = "SELECT MAX(cantidad) as max_descuento FROM descuento";
                        $result_max = $conn->query($sql_max);
                        $max_descuento = $result_max->fetch_assoc()['max_descuento'];
                        echo number_format($max_descuento, 1) . '%';
                    } else {
                        echo '0%';
                    }
                    ?>
                </div>
                <div class="text-sm text-gray-600">Descuento Máximo</div>
            </div>
            
            <div class="bg-olive/10 rounded-xl p-4 text-center">
                <div class="text-2xl font-bold text-olive">
                    <?php
                    $sql_sin_descuento = "SELECT COUNT(*) as total FROM productos WHERE id_descuento IS NULL";
                    $result_sin_descuento = $conn->query($sql_sin_descuento);
                    $productos_sin_descuento = $result_sin_descuento->fetch_assoc()['total'];
                    echo $productos_sin_descuento;
                    ?>
                </div>
                <div class="text-sm text-gray-600">Sin Descuento</div>
            </div>
        </div>

        <!-- Descuentos más utilizados -->
        <?php
        $sql_populares = "SELECT d.cantidad, COUNT(p.id_producto) as total_productos 
                         FROM descuento d 
                         LEFT JOIN productos p ON d.id_descuento = p.id_descuento 
                         GROUP BY d.id_descuento 
                         HAVING total_productos > 0 
                         ORDER BY total_productos DESC 
                         LIMIT 5";
        $result_populares = $conn->query($sql_populares);
        ?>
        
        <?php if ($result_populares->num_rows > 0): ?>
            <div class="mt-8 bg-gray-50 rounded-2xl p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Descuentos Más Utilizados</h3>
                <div class="space-y-2">
                    <?php while ($popular = $result_populares->fetch_assoc()): ?>
                        <div class="flex justify-between items-center p-3 bg-white rounded-lg">
                            <span class="font-semibold text-green-800"><?php echo number_format($popular['cantidad'], 1); ?>%</span>
                            <span class="text-gray-600"><?php echo $popular['total_productos']; ?> productos</span>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>