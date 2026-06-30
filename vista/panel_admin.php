<?php
include 'db.php';

// 1. Validación estricta de seguridad (RS-ADMIN-02)
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'admin') {
    header("Location: index.php?error=Acceso no autorizado.");
    exit();
}

$mensaje_form = "";
$tipo_mensaje = "";

// 2. Procesamiento del registro de Adultos Mayores (RF-ADMIN-03)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar_paciente'])) {
    $nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
    $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
    $edad   = filter_var($_POST['edad'], FILTER_SANITIZE_NUMBER_INT);
    $pass   = $_POST['password'] ?? '';

    // Validar formato del correo
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje_form = "El formato del correo electrónico es inválido.";
        $tipo_mensaje = "error";
    } else {
        // Verificar si el correo ya existe
        $stmt_check = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ?");
        $stmt_check->bind_param("s", $correo);
        $stmt_check->execute();
        
        if ($stmt_check->get_result()->num_rows > 0) {
            $mensaje_form = "Este correo electrónico ya está registrado.";
            $tipo_mensaje = "error";
        } else {
            // Encriptación segura con el estándar Bcrypt heredado de tu código base
            $pass_encriptada = password_hash($pass, PASSWORD_BCRYPT);
            $rol_paciente = 'adulto_mayor';

            $stmt_ins = $conexion->prepare("INSERT INTO usuarios (nombre, correo, password, rol, edad) VALUES (?, ?, ?, ?, ?)");
            $stmt_ins->bind_param("ssssi", $nombre, $correo, $pass_encriptada, $rol_paciente, $edad);
            
            if ($stmt_ins->execute()) {
                $mensaje_form = "¡Adulto mayor registrado con éxito en el sistema!";
                $tipo_mensaje = "success";
            } else {
                $mensaje_form = "Error al insertar en el sistema: " . $conexion->error;
                $tipo_mensaje = "error";
            }
        }
    }
}

// 3. Consulta de Métricas Individuales (RU-ADMIN-02)
$sql_pacientes = "SELECT id, nombre, correo, edad, creado_en FROM usuarios WHERE rol = 'adulto_mayor' ORDER BY nombre ASC";
$res_pacientes = mysqli_query($conexion, $sql_pacientes);

// 4. Consulta Agrupada para la Gráfica Mensual (RF-AM-06)
// Cuenta la cantidad de ejercicios resueltos agrupados por mes en el año actual
$sql_grafica = "SELECT MONTHNAME(fecha_registro) as mes, COUNT(id) as total 
                FROM historial_resultados 
                WHERE YEAR(fecha_registro) = YEAR(CURRENT_DATE())
                GROUP BY MONTH(fecha_registro)
                ORDER BY MONTH(fecha_registro) ASC";
$res_grafica = mysqli_query($conexion, $sql_grafica);

$meses_labels = [];
$totales_data = [];

while ($row = mysqli_fetch_assoc($res_grafica)) {
    $meses_labels[] = $row['mes'];
    $totales_data[] = $row['total'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración • Estimula</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --bg-admin: #f8fafc;
            --dark: #0f172a;
            --primary: #2563eb;
            --success: #16a34a;
            --danger: #dc2626;
            --border: #e2e8f0;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', system-ui, sans-serif; background: var(--bg-admin); color: var(--dark); }
        
        /* Navbar */
        .navbar { background: white; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border-bottom: 1px solid var(--border); }
        .navbar h2 { font-size: 1.6rem; color: var(--primary); }
        .btn-logout { color: var(--danger); font-weight: bold; text-decoration: none; padding: 10px 15px; border-radius: 8px; }
        .btn-logout:hover { background: #fef2f2; }

        .dashboard-container { max-width: 1200px; margin: 40px auto; padding: 0 20px; display: grid; grid-template-columns: 1fr 2fr; gap: 30px; }
        
        .card { background: white; padding: 25px; border-radius: 16px; border: 1px solid var(--border); box-shadow: 0 4px 6px rgba(0,0,0,0.02); }
        .card h3 { font-size: 1.4rem; margin-bottom: 20px; border-bottom: 2px solid var(--bg-admin); padding-bottom: 10px; }
        
        /* Formulario */
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: 600; margin-bottom: 5px; font-size: 0.95rem; }
        .form-group input { width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; font-size: 1rem; }
        .form-group input:focus { border-color: var(--primary); }
        
        .btn-submit { width: 100%; background: var(--primary); color: white; border: none; padding: 14px; font-size: 1.1rem; font-weight: bold; border-radius: 8px; cursor: pointer; margin-top: 10px; }
        .btn-submit:hover { opacity: 0.95; }
        
        .alert { padding: 12px; border-radius: 8px; font-weight: 600; margin-bottom: 15px; font-size: 0.95rem; }
        .alert.success { background: #f0fdf4; color: var(--success); border: 1px solid #bbf7d0; }
        .alert.error { background: #fef2f2; color: var(--danger); border: 1px solid #fca5a5; }

        /* Contenedor derecho */
        .right-column { display: flex; flex-direction: column; gap: 30px; }
        
        /* Tabla de Pacientes */
        .table-wrapper { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; text-align: left; font-size: 0.95rem; }
        th, td { padding: 12px 15px; border-bottom: 1px solid var(--border); }
        th { background: #f1f5f9; font-weight: 600; }
        tr:hover { background: #f8fafc; }
        
        .btn-view { color: var(--primary); font-weight: bold; text-decoration: none; }

        /* Gráfica */
        .chart-container { position: relative; height: 280px; width: 100%; }
    </style>
</head>
<body>

    <nav class="navbar">
        <h2>🛠️ Panel de Control Administrador</h2>
        <div>
            <span style="margin-right: 20px; font-weight: 600;">Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></span>
            <a href="logout.php" class="btn-logout">🚪 Cerrar Sesión</a>
        </div>
    </nav>

    <div class="dashboard-container">
        
        <div class="card">
            <h3>👤 Registrar Adulto Mayor</h3>
            
            <?php if (!empty($mensaje_form)): ?>
                <div class="alert <?php echo $tipo_mensaje; ?>"><?php echo $mensaje_form; ?></div>
            <?php endif; ?>

            <form action="panel_admin.php" method="POST">
                <div class="form-group">
                    <label>Nombre Completo del Paciente</label>
                    <input type="text" name="nombre" placeholder="Juan Pérez" required>
                </div>
                <div class="form-group">
                    <label>Edad (Años)</label>
                    <input type="number" name="edad" placeholder="72" min="50" max="120" required>
                </div>
                <div class="form-group">
                    <label>Correo Electrónico (Usuario)</label>
                    <input type="email" name="correo" placeholder="juan@correo.com" required>
                </div>
                <div class="form-group">
                    <label>Contraseña Temporal</label>
                    <input type="password" name="password" placeholder="Mínimo 6 caracteres" minlength="6" required>
                </div>
                <button type="submit" name="registrar_paciente" class="btn-submit">Añadir Paciente</button>
            </form>
        </div>

        <div class="right-column">
            
            <div class="card">
                <h3>📈 Frecuencia Mensual de Ejercicios Realizados (Año Actual)</h3>
                <div class="chart-container">
                    <canvas id="graficaMensual"></canvas>
                </div>
            </div>

            <div class="card">
                <h3>👥 Listado de Pacientes Registrados</h3>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Edad</th>
                                <th>Correo</th>
                                <th>Fecha Alta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($res_pacientes) > 0): ?>
                                <?php while($paciente = mysqli_fetch_assoc($res_pacientes)): ?>
                                    <tr>
                                        <td><strong><?php echo htmlspecialchars($paciente['nombre']); ?></strong></td>
                                        <td><?php echo $paciente['edad']; ?> años</td>
                                        <td><?php echo htmlspecialchars($paciente['correo']); ?></td>
                                        <td><?php echo date("d/m/Y", strtotime($paciente['creado_en'])); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" style="text-align: center; color: #64748b;">No hay adultos mayores dados de alta en el sistema.</td>
                                end;
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script>
        const ctx = document.getElementById('graficaMensual').getContext('2d');
        
        // Inyectar de manera segura los datos recolectados desde PHP MySQL
        const labelsMeses = <?php echo json_encode($meses_labels); ?>;
        const datosTotales = <?php echo json_encode($totales_data); ?>;

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labelsMeses.length > 0 ? labelsMeses : ["Sin datos aún"],
                datasets: [{
                    label: 'Cantidad de actividades completadas',
                    data: datosTotales.length > 0 ? datosTotales : [0],
                    backgroundColor: '#2563eb', // Azul institucional accesible
                    borderColor: '#1d4ed8',
                    borderWidth: 1,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1 // Forzar que solo muestre números enteros en la escala
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
