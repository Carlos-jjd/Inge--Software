<?php
include 'db.php';
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
    <title>Juego de Memorama • Estimula</title>
    <style>
        :root {
            --bg-app: #f1f5f9;
            --primary: #2563eb;
            --dark: #0f172a;
            --success: #16a34a;
            --danger: #dc2626;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: system-ui, sans-serif; background: var(--bg-app); color: var(--dark); text-align: center; padding: 20px; }
        
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 24px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
        h1 { font-size: 2.4rem; margin-bottom: 15px; }
        
        /* Instrucciones previas (RU-AM-02) */
        .modal-instrucciones { background: #eff6ff; border: 3px solid var(--primary); padding: 30px; border-radius: 20px; margin-bottom: 20px; }
        .modal-instrucciones p { font-size: 1.4rem; margin-bottom: 20px; line-height: 1.5; }
        
        .btn-grande { background: var(--primary); color: white; border: none; padding: 18px 40px; font-size: 1.5rem; font-weight: bold; border-radius: 50px; cursor: pointer; box-shadow: 0 6px 15px rgba(37, 99, 235, 0.3); }
        .btn-grande:hover { opacity: 0.95; }
        
        /* Marcador en vivo */
        .hud { display: flex; justify-content: space-around; background: #f8fafc; padding: 15px; border-radius: 15px; margin: 20px 0; font-size: 1.3rem; font-weight: bold; border: 2px solid #e2e8f0; display: none; }
        
        /* Tablero de Cartas Grandes (RU-AM-01) */
        .tablero { display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; margin-top: 20px; display: none; }
        .carta { background: var(--primary); color: white; height: 120px; border-radius: 16px; font-size: 3.5rem; display: flex; align-items: center; justify-content: center; cursor: pointer; user-select: none; transition: background 0.2s, transform 0.2s; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .carta.volteada { background: #e2e8f0; color: var(--dark); cursor: default; }
        .carta.acierto { background: var(--success); color: white; cursor: default; }
        .carta.error { background: var(--danger); color: white; }

        /* Pantalla de Fin de Actividad (RF-AM-04) */
        .resultados { display: none; background: #f0fdf4; border: 3px solid var(--success); padding: 30px; border-radius: 20px; margin-top: 20px; }
        .resultados h2 { font-size: 2.2rem; color: var(--success); margin-bottom: 15px; }
        .resultados p { font-size: 1.4rem; margin: 10px 0; }
    </style>
</head>
<body>

    <div class="container">
        <h1>🃏 Juego de Memorama</h1>
        
        <div id="pantalla-inicio" class="modal-instrucciones">
            <p><strong>Instrucciones:</strong> Presiona las cartas azules para voltearlas y encuentra los pares de figuras iguales en el menor tiempo posible.</p>
            <button class="btn-grande" onclick="iniciarJuego()">¡Empezar a Jugar!</button>
        </div>

        <div id="hud" class="hud">
            <div>⏱️ Tiempo: <span id="txt-tiempo">00:00</span></div>
            <div>✅ Aciertos: <span id="txt-aciertos">0</span></div>
        </div>

        <div id="tablero" class="tablero"></div>

        <div id="pantalla-final" class="resultados">
            <h2>¡Excelente Trabajo! 🎉</h2>
            <p id="res-tiempo"></p>
            <p id="res-aciertos"></p>
            <p id="res-errores"></p>
            <p id="res-puntaje" style="font-weight: bold;"></p>
            <br>
            <button class="btn-grande" onclick="window.location.href='menu_principal.php'">Regresar al Menú</button>
        </div>
    </div>

    <script>
        // Arreglo de emojis para formar parejas (8 pares = 16 cartas)
        const iconos = ['🍎', '🍏', '🐶', '🐱', '🚗', '🎈', '🌟', '🔮', '🍎', '🍏', '🐶', '🐱', '🚗', '🎈', '🌟', '🔮'];
        let cartasSeleccionadas = [];
        let aciertos = 0;
        let errores = 0;
        let segundos = 0;
        let minutos = 0;
        let intervaloTiempo;

        // Mezclar las cartas de manera aleatoria al iniciar
        function mezclar(array) {
            return array.sort(() => Math.random() - 0.5);
        }

        function iniciarJuego() {
            document.getElementById('pantalla-inicio').style.display = 'none';
            document.getElementById('hud').style.display = 'flex';
            const tablero = document.getElementById('tablero');
            tablero.style.display = 'grid';
            
            mezclar(iconos);
            
            // Generar las cartas en el HTML dinámicamente
            iconos.forEach((icono, indice) => {
                const carta = document.createElement('div');
                carta.classList.add('carta');
                carta.dataset.valor = icono;
                carta.dataset.id = indice;
                carta.textContent = '❓'; // Cara oculta inicial
                carta.addEventListener('click', voltearCarta);
                tablero.appendChild(carta);
            });

            // Disparar cronómetro en tiempo real
            intervaloTiempo = setInterval(() => {
                segundos++;
                if(segundos === 60) { minutos++; segundos = 0; }
                document.getElementById('txt-tiempo').textContent = 
                    (minutos < 10 ? '0' + minutos : minutos) + ':' + (segundos < 10 ? '0' + segundos : segundos);
            }, 1000);
        }

        function voltearCarta() {
            // Validaciones de control de clics repetidos
            if (cartasSeleccionadas.length >= 2 || this.classList.contains('volteada') || this.classList.contains('acierto')) return;

            this.textContent = this.dataset.valor;
            this.classList.add('volteada');
            cartasSeleccionadas.push(this);

            if (cartasSeleccionadas.length === 2) {
                verificarPareja();
            }
        }

        function verificarPareja() {
            const c1 = cartasSeleccionadas[0];
            const c2 = cartasSeleccionadas[1];

            if (c1.dataset.valor === c2.dataset.valor) {
                // Retroalimentación inmediata de Acierto (RU-AM-03)
                c1.classList.add('acierto');
                c2.classList.add('acierto');
                aciertos++;
                document.getElementById('txt-aciertos').textContent = aciertos;
                cartasSeleccionadas = [];
                
                // Evaluar si se encontraron todas las parejas
                if (aciertos === 8) {
                    finalizarJuego();
                }
            } else {
                // Retroalimentación inmediata de Error (RU-AM-03)
                c1.classList.add('error');
                c2.classList.add('error');
                errores++;
                
                setTimeout(() => {
                    c1.textContent = '❓';
                    c2.textContent = '❓';
                    c1.classList.remove('volteada', 'error');
                    c2.classList.remove('volteada', 'error');
                    cartasSeleccionadas = [];
                }, 1000); // Dar 1 segundo al usuario para memorizar la posición antes de ocultar
            }
        }

        function finalizarJuego() {
            clearInterval(intervaloTiempo); // Detener reloj
            document.getElementById('tablero').style.display = 'none';
            document.getElementById('hud').style.display = 'none';
            
            // Envío asíncrono exacto de datos hacia el servidor (Igual a tu lógica de carrito)
            const datosFormulario = new FormData();
            datosFormulario.append('ejercicio_id', 1); // 1 = ID de Memorama
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
                    // Pintar los resultados procesados en pantalla (RF-AM-04)
                    document.getElementById('res-tiempo').textContent = `⏱️ Tiempo Total: ${respuesta.datos.tiempo} minutos`;
                    document.getElementById('res-aciertos').textContent = `✅ Parejas Encontradas: ${respuesta.datos.aciertos}`;
                    document.getElementById('res-errores').textContent = `❌ Fallos Cometidos: ${respuesta.datos.errores}`;
                    document.getElementById('res-puntaje').textContent = `🎯 Rendimiento Cognitivo: ${respuesta.datos.puntaje}%`;
                    document.getElementById('pantalla-final').style.display = 'block';
                } else {
                    alert("Error interno al procesar: " + respuesta.message);
                }
            })
            .catch(err => console.error("Error en conexión Fetch: ", err));
        }
    </script>
</body>
</html>
