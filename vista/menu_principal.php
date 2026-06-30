<?php
include 'db.php';

// Validar protección de acceso (RS-AM-02): Solo adultos mayores entran aquí
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'adulto_mayor') {
    header("Location: index.php?error=Acceso no autorizado.");
    exit();
}

$nombre_usuario = htmlspecialchars($_SESSION['usuario_nombre'], ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal • Estimula</title>
    <style>
        :root {
            --bg-app: #f4f6f9;
            --text-dark: #1e293b;
            --blue-btn: #2563eb;
            --green-btn: #16a34a;
            --accent: #f59e0b;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background-color: var(--bg-app);
            color: var(--text-dark);
            padding-bottom: 40px;
        }

        /* Barra de navegación superior accesible */
        .navbar {
            background-color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            border-bottom: 2px solid #e2e8f0;
        }

        .navbar h2 {
            font-size: 1.8rem;
            font-weight: 700;
        }

        .nav-links a {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--blue-btn);
            text-decoration: none;
            margin-left: 25px;
            padding: 10px 18px;
            border-radius: 12px;
            transition: 0.2s;
        }
        .nav-links a:hover {
            background-color: #eff6ff;
        }
        .nav-links a.logout {
            color: #dc2626;
        }
        .nav-links a.logout:hover {
            background-color: #fef2f2;
        }

        /* Contenedor de bienvenida */
        .welcome-container {
            max-width: 1000px;
            margin: 40px auto 20px auto;
            padding: 0 20px;
            text-align: center;
        }

        .welcome-container h1 {
            font-size: 2.6rem;
            margin-bottom: 10px;
        }

        .welcome-container p {
            font-size: 1.4rem;
            color: #475569;
        }

        /* Parrilla de Ejercicios - Botones Grandes (RU-AM-01, RU-AM-04) */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
            gap: 30px;
            max-width: 1000px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .menu-card {
            background: white;
            border: 3px solid #cbd5e1;
            border-radius: 24px;
            padding: 40px 30px;
            text-align: center;
            text-decoration: none;
            color: var(--text-dark);
            box-shadow: 0 8px 20px rgba(0,0,0,0.02);
            transition: transform 0.2s, border-color 0.2s, box-shadow 0.2s;
            cursor: pointer;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.08);
        }

        /* Colores e Identificadores de Alto Contraste */
        .card-memorama { border-color: var(--blue-btn); }
        .card-memorama:hover { background-color: #f0fdf4; background: #eff6ff; }
        .card-memorama .icon { color: var(--blue-btn); }

        .card-secuencia { border-color: var(--green-btn); }
        .card-secuencia:hover { background-color: #f0fdf4; }
        .card-secuencia .icon { color: var(--green-btn); }

        .menu-card .icon {
            font-size: 5rem;
            display: block;
            margin-bottom: 15px;
        }

        .menu-card h3 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .menu-card p {
            font-size: 1.2rem;
            color: #475569;
            line-height: 1.5;
        }

        @media (max-width: 768px) {
            .navbar { flex-direction: column; gap: 15px; padding: 15px; text-align: center; }
            .nav-links a { margin: 5px; display: inline-block; font-size: 1.1rem; }
            .welcome-container h1 { font-size: 2rem; }
            .menu-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <h2>🧠 Estimula</h2>
        <div class="nav-links">
            <a href="menu_principal.php">Inicio</a>
            <a href="historial_usuario.php">📊 Mi Progreso</a>
            <a href="logout.php" class="logout">🚪 Salir</a>
        </div>
    </nav>

    <div class="welcome-container">
        <h1>¡Hola, <?php echo $nombre_usuario; ?>! 👋</h1>
        <p>Selecciona una actividad presionando uno de los botones grandes de abajo:</p>
    </div>

    <div class="menu-grid">
        
        <a href="juego_memorama.php" class="menu-card card-memorama">
            <span class="icon">🃏</span>
            <h3>Juego de Memorama</h3>
            <p>Entrena tu memoria encontrando las parejas de figuras ocultas.</p>
        </a>

        <a href="juego_secuencia.php" class="menu-card card-secuencia">
            <span class="icon">🎨</span>
            <h3>Secuencia de Colores</h3>
            <p>Pon a prueba tu atención repitiendo el orden de los colores que aparecen.</p>
        </a>

    </div>

</body>
</html>
