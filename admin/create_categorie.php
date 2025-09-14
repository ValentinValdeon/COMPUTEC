<?php
include "../config/db_conect.php";

// Procesar formulario de nueva categoría
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'add_category') {
        $nombre_categoria = mysqli_real_escape_string($conn, trim($_POST['nombre_categoria']));
        
        if (!empty($nombre_categoria)) {
            $sql = "INSERT INTO categorias (nombre_categoria) VALUES ('$nombre_categoria')";
            
            if ($conn->query($sql) === TRUE) {
                $success_message = "Categoría agregada correctamente";
            } else {
                $error_message = "Error al agregar categoría: " . $conn->error;
            }
        } else {
            $error_message = "El nombre de la categoría es obligatorio";
        }
    }
    
    if ($_POST['action'] == 'delete_category') {
        $id_categoria = intval($_POST['id_categoria']);
        
        // Iniciar transacción
        $conn->autocommit(FALSE);
        
        try {
            // Eliminar relaciones en producto_categoria
            $sql1 = "DELETE FROM producto_categoria WHERE id_categoria = $id_categoria";
            $conn->query($sql1);
            
            // Eliminar categoría
            $sql2 = "DELETE FROM categorias WHERE id_categoria = $id_categoria";
            $conn->query($sql2);
            
            // Confirmar transacción
            $conn->commit();
            $success_message = "Categoría eliminada correctamente";
            
        } catch (Exception $e) {
            // Revertir transacción en caso de error
            $conn->rollback();
            $error_message = "Error al eliminar categoría: " . $e->getMessage();
        }
        
        $conn->autocommit(TRUE);
    }
}

// Obtener todas las categorías
$sql = "SELECT id_categoria, nombre_categoria FROM categorias ORDER BY nombre_categoria";
$result = $conn->query($sql);
?>

<div class="p-8">
    <div class="bg-white/90 backdrop-blur-sm rounded-3xl p-8 shadow-2xl">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Gestión de Categorías</h1>
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
            <!-- Formulario para nueva categoría -->
            <div class="bg-military-green/5 rounded-2xl p-6">
                <h2 class="text-xl font-bold text-military-green mb-4">Agregar Nueva Categoría</h2>
                
                <form method="POST" class="space-y-4">
                    <input type="hidden" name="action" value="add_category">
                    
                    <div>
                        <label for="nombre_categoria" class="block text-sm font-medium text-gray-700 mb-2">
                            Nombre de la Categoría
                        </label>
                        <input type="text" 
                               id="nombre_categoria" 
                               name="nombre_categoria" 
                               required
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-military-green focus:outline-none transition-colors"
                               placeholder="Ej: Electrónicos, Juegos, Hogar...">
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-military-green hover:bg-olive text-white font-semibold py-3 px-4 rounded-xl transition-colors duration-200">
                        Agregar Categoría
                    </button>
                </form>
            </div>

            <!-- Lista de categorías existentes -->
            <div class="bg-bright-yellow/5 rounded-2xl p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Categorías Existentes</h2>
                
                <div class="max-h-96 overflow-y-auto space-y-2">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($categoria = $result->fetch_assoc()): ?>
                            <div class="flex items-center justify-between p-3 bg-white rounded-lg shadow-sm border">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-military-green rounded-full flex items-center justify-center">
                                        <span class="text-white text-sm">🏷️</span>
                                    </div>
                                    <span class="font-medium text-gray-800">
                                        <?php echo htmlspecialchars($categoria['nombre_categoria']); ?>
                                    </span>
                                </div>
                                
                                <form method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar esta categoría? Se eliminará de todos los productos asociados.')">
                                    <input type="hidden" name="action" value="delete_category">
                                    <input type="hidden" name="id_categoria" value="<?php echo $categoria['id_categoria']; ?>">
                                    <button type="submit" 
                                            class="text-red-500 hover:text-red-700 hover:bg-gray-200 p-2 rounded-lg transition-colors">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="text-center py-8 text-gray-500">
                            <div class="text-4xl mb-2">📋</div>
                            <p>No hay categorías registradas</p>
                            <p class="text-sm">Agrega tu primera categoría usando el formulario</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-military-green/10 rounded-xl p-4 text-center">
                <div class="text-2xl font-bold text-military-green">
                    <?php echo $result->num_rows; ?>
                </div>
                <div class="text-sm text-gray-600">Total Categorías</div>
            </div>
            
            <div class="bg-bright-yellow/10 rounded-xl p-4 text-center">
                <div class="text-2xl font-bold text-bright-yellow">
                    <?php
                    $sql_productos = "SELECT COUNT(DISTINCT id_producto) as total FROM producto_categoria";
                    $result_productos = $conn->query($sql_productos);
                    $productos_con_categoria = $result_productos->fetch_assoc()['total'];
                    echo $productos_con_categoria;
                    ?>
                </div>
                <div class="text-sm text-gray-600">Productos Categorizados</div>
            </div>
            
            <div class="bg-olive/10 rounded-xl p-4 text-center">
                <div class="text-2xl font-bold text-olive">
                    <?php
                    $sql_sin_categoria = "SELECT COUNT(*) as total FROM productos p 
                                         WHERE NOT EXISTS (SELECT 1 FROM producto_categoria pc WHERE pc.id_producto = p.id_producto)";
                    $result_sin_categoria = $conn->query($sql_sin_categoria);
                    $productos_sin_categoria = $result_sin_categoria->fetch_assoc()['total'];
                    echo $productos_sin_categoria;
                    ?>
                </div>
                <div class="text-sm text-gray-600">Sin Categoría</div>
            </div>
        </div>
    </div>
</div>