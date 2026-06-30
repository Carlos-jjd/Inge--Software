<?php 
include 'db.php'; 
// Si ya hay una sesión activa, redirigir según el rol automáticamente
if (isset($_SESSION['usuario_id'])) { 
    if ($_SESSION['usuario_rol'] === 'admin') {
        header("Location: panel_admin.php");
    } else {
        header("Location: menu_principal.php");
    }
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión • Estimula</title>
    <style>
        :root { 
            --primary: #2563eb;       /* Azul llamativo y accesible para botones */
            --bg-pastel: #f0f4f8;     /* Fondo suave para descansar la vista */
            --dark-text: #1e293b;     /* Texto oscuro de alta legibilidad */
            --border-color: #cbd5e1;
        }
        
        * { box-sizing: border-box; margin: 0; padding: 0; }
        
        body { 
            font-family: 'Segoe UI', system-ui, sans-serif; 
            background-color: var(--bg-pastel); 
            height: 100vh; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            color: var(--dark-text); 
            padding: 20px;
        }
        
        .login-container { 
            background: white; 
            padding: 40px 30px; 
            border-radius: 24px; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.05); 
            width: 100%; 
            max-width: 450px; 
            text-align: center;
            border: 1px solid #e2e8f0;
        }
        
        /* Encabezado del Boceto */
        .brand { margin-bottom: 30px; }
        .brain-icon { font-size: 4.5rem; display: block; margin-bottom: 5px; }
        .brand h1 { font-size: 2.2rem; font-weight: 700; color: var(--dark-text); }
        .brand p { font-size: 1.1rem; color: #64748b; margin-top: 5px; line-height: 1.4; }
        
        /* Formulario con Botones Grandes (RU-AM-01) */
        .form-group { position: relative; margin-bottom: 20px; text-align: left; }
        .form-group label { display: block; font-size: 1.1rem; font-weight: 600; margin-bottom: 8px; }
        
        input { 
            width: 100%; 
            padding: 16px 20px; 
            font-size: 1.2rem; /* Fuente grande para adultos mayores (RU-AM-05) */
            border: 2.5px solid var(--border-color); 
            border-radius: 14px; 
            outline: none; 
            transition: 0.2s; 
            color: var(--dark-text);
        }
        input:focus { border-color: var(--primary); background-color: #f8fafc; }
        
        .btn { 
            width: 100%; 
            padding: 18px; 
            font-size: 1.3rem; 
            font-weight: bold; 
            border: none; 
            border-radius: 50px; 
            cursor: pointer; 
            transition: 0.2s; 
            margin-top: 10px;
            letter-spacing: 0.5px;
        }
        .btn-login { background: var(--primary); color: white; box-shadow: 0 6px 20px rgba(37, 99, 235, 0.3); }
        .btn-login:hover { transform: translateY(-2px); opacity: 0.95; }
        
        /* Mensajes de error */
        .error-msg { 
            background: #fef2f2; 
            color: #dc2626; 
            padding: 15px; 
            border-radius: 12px; 
            margin-bottom: 25px; 
            font-size: 1.1rem; 
            border: 2px solid #fca5a5;
            font-weight: 600;
        }
        
        .footer-text { margin-top: 25px; font-size: 1.1rem; }
        .footer-text a { color: var(--primary); font-weight: bold; text-decoration: none; }
        .footer-text a:hover { text-decoration: underline; }

        @media (max-width: 480px) {
            .login-container { padding: 25px 20px; }
            .brand h1 { font-size: 1.8rem; }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="brand">
            <span class="brain-icon">🧠</span>
            <h1>Estimula</h1>
            <p>Plataforma de estimulación cognitiva para adultos mayores</p>
        </div>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="error-msg"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>

        <form action="auth.php" method="POST">
            <div class="form-group">
                <label for="correo">👤 Correo electrónico u Usuario</label>
                <input type="email" id="correo" name="correo" placeholder="ejemplo@correo.com" required>
            </div>
            
            <div class="form-group">
                <label for="password">🔒 Contraseña</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>
            
            <button type="submit" class="btn btn-login">Iniciar sesión</button>
        </form>
        
        <p class="footer-text">
            ¿No tienes cuenta? <a href="mailto:admin@estimula.com?subject=Solicitud de Cuenta de Paciente">Regístrate aquí</a>
        </p>
    </div>
</body>
</html>
