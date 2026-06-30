<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "estimula_db";

$conexion = mysqli_connect($host, $user, $pass, $db);

if (!$conexion) {
    die("Error de conexión crítica a la base de datos: " . mysqli_connect_error());
}

// Configuraciones de seguridad estrictas para las sesiones (Mitiga ataques de sesión/XSS)
ini_set('session.cookie_httponly', 1); 
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_samesite', 'Strict');

// Iniciar sesión de forma segura si no ha sido inicializada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
