<?php
include 'db.php';

// Inicializar el control de intentos si no existe en la sesión
if (!isset($_SESSION['intentos'])) {
    $_SESSION['intentos'] = 0;
    $_SESSION['bloqueo_hasta'] = 0;
}

$ahora = time();

// Verificar si el cliente IP/Sesión se encuentra bloqueado transitoriamente
if ($_SESSION['intentos'] >= 5 && $ahora < $_SESSION['bloqueo_hasta']) {
    $espera = $_SESSION['bloqueo_hasta'] - $ahora;
    header("Location: index.php?error=Demasiados intentos. Bloqueado por $espera seg.");
    exit();
}

// Sanitizar entradas
$correo = filter_var($_POST['correo'] ?? '', FILTER_SANITIZE_EMAIL);
$pass = $_POST['password'] ?? '';

// Preparar consulta para evitar Inyecciones SQL (SQLi)
$stmt = $conexion->prepare("SELECT id, nombre, correo, password, rol FROM usuarios WHERE correo = ?");
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();

// Validar credenciales usando la verificación nativa de Bcrypt
if ($usuario && password_verify($pass, $usuario['password'])) {
    
    // Éxito: Reiniciar el contador de fallos y regenerar el ID de sesión (Previene Session Fixation)
    $_SESSION['intentos'] = 0;
    session_regenerate_id(true);
    
    // Cargar variables globales de sesión
    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['usuario_nombre'] = $usuario['nombre'];
    $_SESSION['usuario_rol'] = $usuario['rol'];
    
    // Enrutamiento inteligente basado en el Rol del usuario
    if ($usuario['rol'] === 'admin') {
        header("Location: panel_admin.php");
    } else {
        header("Location: menu_principal.php");
    }
    exit();
    
} else {
    // Manejo de fallos en la autenticación
    $_SESSION['intentos']++;
    if ($_SESSION['intentos'] >= 5) {
        $_SESSION['bloqueo_hasta'] = $ahora + 30; // Penalización de 30 segundos
        $msg = "Acceso bloqueado por 30 segundos debido a múltiples fallos.";
    } else {
        $faltan = 5 - $_SESSION['intentos'];
        $msg = "Datos incorrectos. Le quedan $faltan intentos permitidos.";
    }
    header("Location: index.php?error=" . urlencode($msg));
    exit();
}
?>
