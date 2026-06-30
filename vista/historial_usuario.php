<?php
include 'db.php';

// Protección de acceso (RS-AM-02)
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'adulto_mayor') {
    header("Location: index.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Consulta SQL combinada (JOIN) para obtener los resultados y el nombre del ejercicio
$sql = "SELECT h.tiempo_total, h.aciertos, h.errores, h.puntaje, h.fecha_registro, e.nombre AS juego 
        FROM historial_resultados h
        JOIN ejercicios e ON h.ejercicio_id = e.id
        WHERE h.usuario_id = ?
        ORDER BY h.fecha_registro DESC";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Historial • Estimula</title>
    <style>
        :root {
            --bg-app: #f4f6f9;
            --text-dark: #1e293b;
            --primary: #2563eb;
            --success: #16a34a;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background-color: var(--bg-app);
            color: var(--text-dark);
            padding-bottom: 40px;
        }

        /* Navbar */
        .navbar {
            background-color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            border-bottom: 2px solid #e2e8f0;
        }

        .navbar h2 { font-size: 1.8rem; }

        .nav-links a {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--primary);
            text-decoration: none;
            margin-left: 25px;
            padding: 10px 18px;
            border-radius: 12px;
            transition: 0.2s;
        }
        .nav-links a:hover { background-color: #eff6ff; }

        /* Contenedor Principal */
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }

        h1 {
            font-size: 2.4rem;
            margin-bottom: 10px;
            text-align: center;
        }

        .subtitle {
            font-size: 1.3rem;
            color: #64748b;
            text-align: center;
            margin-bottom: 30px;
        }

        /* Tarjetas de Historial Grandes (RU-AM-01, RU-AM-05) */
        .historial-lista {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .tarjeta-registro {
            background: white;
            border: 3px solid #cbd5e1;
            border-radius: 20px;
            padding: 25px 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.02);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .info-juego h3 {
            font-size: 1.8rem;
            color: var(--primary);
            margin-bottom: 8px;
        }

        .info-juego p {
            font-size: 1.2rem;
            color: #475569;
            margin: 4px 0;
        }

        .info-juego .fecha {
            font-size: 1.1rem;
            color: #94a3b8;
            margin-top: 8px;
        }

        /* Insignia de rendimiento circular grande */
        .porcentaje-circulo {
            background: #f0fdf4;
            color: var(--success);
            border: 4px solid var(--success);
            width: 90px;
            height: 90px;
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            font-size: 1.4rem;
            box-shadow: 0 4px 10px rgba(22, 163, 74, 0.1);
        }
        .porcentaje-circulo span {
            font-size: 0.8rem;
            text-transform: uppercase;
            font-weight: 600;
        }

        .sin-datos {
            background: white;
            padding: 40px;
            text-align: center;
            border-radius: 20px;
            border: 3px dashed #cbd5e1;
            font-size: 1.4rem;
            color: #64748b;
        }

        @media (max-width: 600px) {
            .tarjeta-registro { flex-direction: column; text-align: center; gap: 20px; }
            .navbar { flex-direction: column; gap: 15px; }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <h2>🧠 Estimula</h2>
        <div class="nav-links">
            <a href="menu_principal.php">⬅️ Volver al Menú</a>
            <a href="logout.php" style="color: #dc2626;">Cerrar Sesión</a>
        </div>
    </nav>

    <div class="container">
        <h1>📊 Mi Progreso Reciente</h1>
        <p class="subtitle">Aquí puedes ver los resultados de tus ejercicios completados:</p>

        <div class="historial-lista">
            <?php if ($resultado->num_rows > 0): ?>
                <?php while($fila = $resultado->fetch_assoc()): ?>
                    <div class="tarjeta-registro">
                        <div class="info-juego">
                            <h3>
                                <?php echo ($fila['juego'] === 'Memorama') ? '🃏' : '🎨'; ?> 
                                <?php echo htmlspecialchars($fila['juego']); ?>
                            </h3>
                            <p>⏱️ <strong>Tiempo empleado:</strong> <?php echo substr($fila['tiempo_total'], 3); ?> minutos</p>
                            <p>✅ <strong>Aciertos:</strong> <?php echo $fila['aciertos']; ?></p>
                            <p>❌ <strong>Errores:</strong> <?php echo $fila['errores']; ?></p>
                            <p class="fecha">📅 Realizado el: <?php echo date("d/m/Y a las h:i A", strtotime($fila['fecha_registro'])); ?></p>
                        </div>
                        <div class="porcentaje-circulo">
                            <?php echo $fila['puntaje']; ?>%
                            <span>Nota</span>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="sin-datos">
                    <p>Aún no has realizado ninguna actividad. ¡Ve al menú e inicia tu primer juego! 🌟</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
