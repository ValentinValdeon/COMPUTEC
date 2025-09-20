<?php
session_start();
include "../config/db_conect.php";

// Verificar que el método sea POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['error_message'] = 'Método de acceso no permitido';
    header('Location: login.php');
    exit();
}

// Obtener y sanitizar datos del formulario
$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');
$remember = isset($_POST['remember']);

// Validar que los campos no estén vacíos
if (empty($username) || empty($password)) {
    $_SESSION['error_message'] = 'Por favor, completa todos los campos';
    header('Location: login.php');
    exit();
}

try {
    // Preparar la consulta para buscar el usuario
    $sql = "SELECT id_usuario, username, password_hash, nombre, email, estado, ultimo_acceso 
            FROM usuarios 
            WHERE username = ? AND estado = 1";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verificar la contraseña
        if (password_verify($password, $user['password_hash'])) {
            // Login exitoso - Crear sesión
            $_SESSION['user_id'] = $user['id_usuario'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['nombre'] = $user['nombre'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['login_time'] = time();
            $_SESSION['logged_in'] = true;
            
            // Actualizar último acceso
            $update_sql = "UPDATE usuarios SET ultimo_acceso = NOW() WHERE id_usuario = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("i", $user['id_usuario']);
            $update_stmt->execute();
            
            // Configurar cookie de "recordar sesión" si se seleccionó
            if ($remember) {
                $token = bin2hex(random_bytes(32));
                $expires = time() + (30 * 24 * 60 * 60); // 30 días
                
                // Guardar token en base de datos
                $token_sql = "UPDATE usuarios SET remember_token = ? WHERE id_usuario = ?";
                $token_stmt = $conn->prepare($token_sql);
                $token_stmt->bind_param("si", $token, $user['id_usuario']);
                $token_stmt->execute();
                
                // Establecer cookie
                setcookie('remember_token', $token, $expires, '/', '', false, true);
            }
            
            // Registro de audit log (opcional)
            $log_sql = "INSERT INTO login_logs (id_usuario, ip_address, user_agent, login_time) VALUES (?, ?, ?, NOW())";
            if ($conn->query("SHOW TABLES LIKE 'login_logs'")->num_rows > 0) {
                $log_stmt = $conn->prepare($log_sql);
                $ip = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
                $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';
                $log_stmt->bind_param("iss", $user['id_usuario'], $ip, $user_agent);
                $log_stmt->execute();
            }
            
            // Redirigir al dashboard
            header('Location: main-admin.php');
            exit();
            
        } else {
            // Contraseña incorrecta
            $_SESSION['error_message'] = 'Usuario o contraseña incorrectos';
            
            // Registro de intento fallido (opcional)
            $fail_sql = "INSERT INTO failed_logins (username, ip_address, attempt_time) VALUES (?, ?, NOW())";
            if ($conn->query("SHOW TABLES LIKE 'failed_logins'")->num_rows > 0) {
                $fail_stmt = $conn->prepare($fail_sql);
                $ip = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
                $fail_stmt->bind_param("ss", $username, $ip);
                $fail_stmt->execute();
            }
        }
    } else {
        // Usuario no encontrado
        $_SESSION['error_message'] = 'Usuario o contraseña incorrectos';
    }
    
} catch (Exception $e) {
    // Error en la base de datos
    error_log("Error en login: " . $e->getMessage());
    $_SESSION['error_message'] = 'Error interno del sistema. Intenta nuevamente.';
}

// Si llegamos aquí, el login falló
header('Location: login.php');
exit();
?>