<?php
include 'db.php';
// Protección de acceso: Solo adultos mayores
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'adulto_mayor') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secuencia de Colores • Estimula</title>
    <style>
        :root {
            --bg-app: #f1f5f9;
            --dark: #0f172a;
            --primary: #2563eb;
            --success: #16a34a;
            --danger: #dc2626;
            
            /* Colores Base de los Botones (Alto Contraste) */
            --rojo: #ef4444;
            --azul: #3b82f6;
            --verde: #22c55e;
            --amarillo: #eab308;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: system-ui, sans-serif; background: var(--bg-app); color: var(--dark); text-align: center; padding: 20px; }
        
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 24px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
        h1 { font-size: 2.4rem; margin-bottom: 15px; }
        
        /* Instrucciones previas (RU-AM-02) */
        .modal-instrucciones { background: #f0fdf4; border: 3px solid var(--success); padding: 30px; border-radius: 20px; margin-bottom: 20px; }
        .modal-instrucciones p { font-size: 1.4rem; margin-bottom: 20px; line-height: 1.5; }
        
        .btn-grande { background: var(--primary); color: white; border: none; padding: 18px 40px; font-size: 1.5rem; font-weight: bold; border-radius: 50px; cursor: pointer; box-shadow: 0 6px 15px rgba(37, 99, 235, 0.3); }
        .btn-grande:hover { opacity: 0.95; }
        
        /* Marcador e indicador de turno */
        .hud { display: flex; justify-content: space-around; background: #f8fafc; padding: 15px; border-radius: 15px; margin: 20px 0; font-size: 1.3rem; font-weight: bold; border: 2px solid #e2e8f0; display: none; }
        #indicador-turno { font-size: 1.6rem; margin: 15px 0; font-weight: bold; color: var(--primary); display: none; }

        /* Panel de Botones de Colores Gigantes (RU-AM-01) */
        .cuadrante { display: grid; grid-template-columns: repeat(2, 1fr); gap: 25px; max-width: 450px; margin: 20px auto; display: none; }
        .color-btn { height: 180px; border-radius: 24px; border: 6px solid #cbd5e1; cursor: pointer; transition: opacity 0.1s, transform 0.1s; outline: none; }
        .color-btn:active { transform: scale(0.96); }
        
        /* Clases de iluminación para el destello */
        #btn-0 { background-color: var(--rojo); opacity: 0.6; }
        #btn-1 { background-color: var(--azul); opacity: 0.6; }
        #btn-2 { background-color: var(--verde); opacity: 0.6; }
        #btn-3 { background-color: var(--amarillo); opacity: 0.6; }
        
        .color-btn.activo { opacity: 1.0 !important; border-color: white; box-shadow: 0 0 30px rgba(255,255,255,1); transform: scale(1.04); }

        /* Pantalla Final (RF-AM-04) */
        .resultados { display: none; background: #fef2f2; border: 3px solid var(--danger); padding: 30px; border-radius: 20px; margin-top: 20px; }
        .resultados.exito { background: #f0fdf4; border-color: var(--success); }
        .resultados h2 { font-size: 2.2rem; margin-bottom: 15px; }
        .resultados p { font-size: 1.4rem; margin: 10px 0; }
    </style>
</head>
<body>

    <div class="container">
        <h1>🎨 Secuencia de Colores</h1>
        
        <div id="pantalla-inicio" class="modal-instrucciones">
            <p><strong>Instrucciones:</strong> Presta mucha atención a la pantalla. El sistema encenderá una secuencia de botones de colores. Cuando termine, deberás presionarlos exactamente en el mismo orden.</p>
            <button class="btn-grande" onclick="iniciarJuego()">¡Empezar Actividad!</button>
        </div>

        <div id="hud" class="hud">
            <div>⏱️ Tiempo: <span id="txt-tiempo">00:00</span></div>
            <div>🎯 Nivel Actual: <span id="txt-nivel">1</span></div>
        </div>

        <div id="indicador-turno">Mira la secuencia... 👀</div>

        <div id="cuadrante" class="cuadrante">
            <button class="color-btn" id="btn-0" onclick="presionarBoton(0)"></button>
            <button class="color-btn" id="btn-1" onclick="presionarBoton(1)"></button>
            <button class="color-btn" id="btn-2" onclick="presionarBoton(2)"></button>
            <button class="color-btn" id="btn-3" onclick="presionarBoton(3)"></button>
        </div>

        <div id="pantalla-final" class="resultados">
            <h2 id="final-titulo">Fin de la actividad</h2>
            <p id="res-tiempo"></p>
            <p id="res-aciertos"></p>
            <p id="res-errores"></p>
            <p id="res-puntaje" style="font-weight: bold;"></p>
            <br>
            <button class="btn-grande" onclick="window.location.href='menu_principal.php'">Regresar al Menú</button>
        </div>
    </div>

    <script>
        let secuenciaSistema = [];
        let secuenciaUsuario = [];
        let nivel = 1;
        let aciertos = 0;
        let errores = 0;
        let segundos = 0;
        let minutos = 0;
        let intervaloTiempo;
        let interactuable = false;

        function iniciarJuego() {
            document.getElementById('pantalla-inicio').style.display = 'none';
            document.getElementById('hud').style.display = 'flex';
            document.getElementById('indicador-turno').style.display = 'block';
            document.getElementById('cuadrante').style.display = 'grid';
            
            // Iniciar Cronómetro
            intervaloTiempo = setInterval(() => {
                segundos++;
                if(segundos === 60) { minutos++; segundos = 0; }
                document.getElementById('txt-tiempo').textContent = 
                    (minutos < 10 ? '0' + minutes : minutos) + ':' + (segundos < 10 ? '0' + segundos : segundos);
            }, 1000);

            siguienteRonda();
        }

        function siguienteRonda() {
            secuenciaUsuario = [];
            interactuable = false;
            document.getElementById('indicador-turno').textContent = "Mira la secuencia... 👀";
            document.getElementById('indicador-turno').style.color = "#2563eb";
            document.getElementById('txt-nivel').textContent = nivel;

            // Añadir un nuevo color aleatorio a la secuencia (0 a 3)
            secuenciaSistema.push(Math.floor(Math.random() * 4));
            
            // Reproducir la secuencia completa visualmente
            let i = 0;
            const intervaloBrillo = setInterval(() => {
                if (i >= secuenciaSistema.length) {
                    clearInterval(intervaloBrillo);
                    interactuable = true;
                    document.getElementById('indicador-turno').textContent = "¡Tu turno! Repite los colores 👇";
                    document.getElementById('indicador-turno').style.color = "#16a34a";
                    return;
                }
                destellarBoton(secuenciaSistema[i]);
                i++;
            }, 1000); // 1 segundo por destello para dar tiempo de lectura cómoda al adulto mayor
        }

        function destellarBoton(id) {
            const btn = document.getElementById('btn-' + id);
            btn.classList.add('activo');
            setTimeout(() => {
                btn.classList.remove('activo');
            }, 500);
        }

        function presionarBoton(id) {
            if (!interactuable) return;

            destellarBoton(id);
            secuenciaUsuario.push(id);
            
            const indiceActual = secuenciaUsuario.length - 1;

            // Verificar en tiempo real (RU-AM-03 Retroalimentación inmediata)
            if (secuenciaUsuario[indiceActual] !== secuenciaSistema[indiceActual]) {
                // Se equivocó de color
                errores++;
                finalizarJuego(false);
                return;
            }

            aciertos++; // Cada color presionado correctamente cuenta como un acierto cognitivo

            // Si ya terminó de repetir toda la secuencia actual de forma correcta
            if (secuenciaUsuario.length === secuenciaSistema.length) {
                nivel++;
                interactuable = false;
                setTimeout(siguienteRonda, 1200);
            }
        }

        function finalizarJuego(completo) {
            clearInterval(intervaloTiempo);
            document.getElementById('cuadrante').style.display = 'none';
            document.getElementById('hud').style.display = 'none';
            document.getElementById('indicador-turno').style.display = 'none';

            const contenedorFinal = document.getElementById('pantalla-final');
            const tituloFinal = document.getElementById('final-titulo');

            if (!completo) {
                contenedorFinal.classList.remove('exito');
                tituloFinal.textContent = "¡Actividad Concluida! 🧠";
                tituloFinal.style.color = "var(--danger)";
            }

            // Envío asíncrono de las estadísticas a guardar_resultado.php (Mismo estándar de Fetch)
            const datosFormulario = new FormData();
            datosFormulario.append('ejercicio_id', 2); // 2 = ID de Secuencia de Colores
            datosFormulario.append('minutos', minutos);
            datosFormulario.append('segundos', segundos);
            datosFormulario.append('aciertos', aciertos);
            datosFormulario.append('errores', errores);

            fetch('guardar_resultado.php', {
                method: 'POST',
                body: datosFormulario
            })
            .then(res => res.json())
            .then(respuesta => {
                if(respuesta.status === 'success') {
                    document.getElementById('res-tiempo').textContent = `⏱️ Tiempo Jugado: ${respuesta.datos.tiempo} minutos`;
                    document.getElementById('res-aciertos').textContent = `✅ Secuencias correctas completadas: ${nivel - 1}`;
                    document.getElementById('res-errores').textContent = `❌ Errores cometidos: ${respuesta.datos.errores}`;
                    document.getElementById('res-puntaje').textContent = `🎯 Precisión de Memoria: ${respuesta.datos.puntaje}%`;
                    contenedorFinal.style.display = 'block';
                } else {
                    alert("Error en el servidor: " + respuesta.message);
                }
            })
            .catch(err => console.error("Error Fetch: ", err));
        }
    </script>
</body>
</html>
