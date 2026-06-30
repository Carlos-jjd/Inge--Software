<?php
// Incluir db para heredar configuraciones de inicio de sesión
include 'db.php';

// Vaciar todas las variables globales de sesión
$_SESSION = array();

// Borrar físicamente la cookie del identificador de sesión en el navegador
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destruir la sesión en el servidor
session_destroy();

// Redireccionar al inicio de sesión con un mensaje informativo limpio
header("Location: index.php");
exit();
?>
