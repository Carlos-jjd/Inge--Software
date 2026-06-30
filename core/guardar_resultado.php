<?php
include 'db.php';

// Cabecera de respuesta en formato JSON (Estructura limpia para comunicación asíncrona)
header('Content-Type: application/json');

// 1. Verificación estricta de seguridad (RS-AM-02)
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'adulto_mayor') {
    echo json_encode(['status' => 'error', 'message' => 'Sesión no válida o usuario no autorizado.']);
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// 2. Sanitización y validación de las métricas enviadas por el Frontend
$ejercicio_id = filter_var($_POST['ejercicio_id'] ?? 0, FILTER_SANITIZE_NUMBER_INT);
$minutos      = filter_var($_POST['minutos'] ?? 0, FILTER_SANITIZE_NUMBER_INT);
$segundos     = filter_var($_POST['segundos'] ?? 0, FILTER_SANITIZE_NUMBER_INT);
$aciertos     = filter_var($_POST['aciertos'] ?? 0, FILTER_SANITIZE_NUMBER_INT);
$errores      = filter_var($_POST['errores'] ?? 0, FILTER_SANITIZE_NUMBER_INT);

if (!$ejercicio_id || !filter_var($ejercicio_id, FILTER_VALIDATE_INT)) {
    echo json_encode(['status' => 'error', 'message' => 'Identificador de ejercicio inválido.']);
    exit();
}

// 3. Formatear las variables de tiempo al estándar de base de datos TIME (HH:MM:SS)
$minutos_pad  = str_pad($minutos, 2, "0", STR_PAD_LEFT);
$segundos_pad = str_pad($segundos, 2, "0", STR_PAD_LEFT);
$tiempo_total = "00:" . $minutos_pad . ":" . $segundos_pad;

// 4. Algoritmo de cálculo de Puntaje base (Logos)
// Previene división por cero en caso de que no haya intentos registrados
$total_intentos = $aciertos + $errores;
if ($total_intentos > 0) {
    $puntaje = round(($aciertos / $total_intentos) * 100);
} else {
    $puntaje = 0;
}

// 5. Inserción Blindada con Sentencia Preparada (Evita SQLi)
$sql = "INSERT INTO historial_resultados (usuario_id, ejercicio_id, tiempo_total, aciertos, errores, puntaje) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("iisiii", $usuario_id, $ejercicio_id, $tiempo_total, $aciertos, $errores, $puntaje);

if ($stmt->execute()) {
    echo json_encode([
        'status' => 'success',
        'message' => '¡Resultado guardado correctamente!',
        'datos' => [
            'tiempo' => $minutos_pad . ":" . $segundos_pad,
            'aciertos' => $aciertos,
            'errores' => $errores,
            'puntaje' => $puntaje
        ]
    ]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error al guardar en base de datos: ' . $conexion->error]);
}
?>
