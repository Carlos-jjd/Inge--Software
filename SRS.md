# Persona 1: Adulto Mayor.

## Requerimientos Funcionales (Logos)

- **RF-AM-01:** El sistema deberá permitir al adulto mayor iniciar sesión con su cuenta personal.
- **RF-AM-02:** El sistema deberá permitir realizar ejercicios de estimulación cognitiva y psicomotriz como memorama, secuencia de colores, rompecabezas y arrastrar figuras.
- **RF-AM-03:** El sistema deberá registrar automáticamente el tiempo, aciertos y errores obtenidos en cada ejercicio.
- **RF-AM-04:** El sistema deberá mostrar los resultados al finalizar cada actividad.
- **RF-AM-05:** El sistema deberá permitir consultar el historial de ejercicios realizados.
- **RF-AM-06:** Los reportes tendrán que generarse respecto a cada usuario con una frecuencia semanal mensual y anual con su respectiva grafica de barras.
-----

Para que este documento sea **100% congruente** con el nuevo enfoque universitario, el alcance de 2 semanas y la eliminación definitiva de la cámara, debemos actualizar la nomenclatura de las claves (cambiando AM de Adulto Mayor por UN de Universitario), redefinir la experiencia de usuario (adiós a los botones gigantes para problemas visuales, hola al diseño ágil y competitivo) y ajustar la priorización MoSCoW para asegurar que termines a tiempo.
Aquí tienes el archivo completamente adaptado para copiar y pegar directamente:
# Especificación de Requerimientos y Priorización MoSCoW (Enfoque Universitario)
## Persona 1: Estudiante / Docente Universitario
Este perfil corresponde a usuarios con alta competencia digital que sufren de fatiga cognitiva, estrés académico o pérdida de enfoque. Buscan una herramienta rápida (pausa activa de 2 minutos) que ponga a prueba su agilidad mental.
### Requerimientos Funcionales (Logos)
 * **RF-UN-01:** El sistema deberá permitir al usuario universitario iniciar sesión con su cuenta personal.
 * **RF-UN-02:** El sistema deberá permitir realizar tres ejercicios de entrenamiento cerebral: memorama de retención rápida, secuencia de colores y selección del objeto correcto (agilidad visual).
 * **RF-UN-03:** El sistema deberá registrar automáticamente mediante eventos del DOM el tiempo de reacción en milisegundos, los aciertos y los errores obtenidos en cada sesión.
 * **RF-UN-04:** El sistema deberá mostrar un desglose de los KPIs de rendimiento inmediatamente al finalizar cada actividad.
 * **RF-UN-05:** El sistema deberá permitir consultar un historial o Dashboard con los resultados de las pausas activas realizadas.
 * **RF-UN-06:** Los reportes de rendimiento se consolidarán en el Dashboard de forma cronológica para mostrar curvas de fatiga o mejora en la velocidad de respuesta.
### Requerimientos de Experiencia de Usuario (Pathos)
 * **RU-UN-01:** La interfaz deberá presentar una estética moderna, limpia y minimalista (estilo *Dashboard* o *Dark-Mode*) optimizada para pantallas estándar.
 * **RU-UN-02:** Los ejercicios deberán ser intuitivos, autoeplicativos y de ejecución ágil (retos que no superen los 2 minutos de duración).
 * **RU-UN-03:** El sistema deberá proporcionar retroalimentación visual inmediata (cambios de color o alertas rápidas) ante aciertos o fallos para mantener el ritmo del juego.
 * **RU-UN-04:** La navegación en la plataforma deberá ser directa, requiriendo un máximo de dos clics desde el menú principal para iniciar cualquier reto cognitivo.
 * **RU-UN-05:** Los textos, fuentes e íconos deberán alinearse a una visualización técnica, utilizando tipografías claras y legibles para programadores y estudiantes.
 * **RU-UN-06:** Se implementará un sistema de competencia personal basado en récords de puntuación alta (*High-Scores*) para incentivar la mejora en la agilidad mental.
### Requerimientos de Seguridad y Confianza (Ethos)
 * **RS-UN-01:** El sistema deberá proteger mediante autenticación básica los datos de acceso y el historial de puntuaciones de cada usuario.
 * **RS-UN-02:** La información de rendimiento almacenada en la base de datos MySQL solo podrá ser visualizada por el dueño de la cuenta.
 * **RS-UN-03:** La plataforma no solicitará ni activará permisos que pongan en riesgo la privacidad del usuario, operando exclusivamente con periféricos estándar.
 * **RS-UN-04:** El sistema estará 100% libre de publicidad o ventanas emergentes que interrumpan el flujo de la pausa activa.
 * **RS-UN-05:** La arquitectura de la base de datos utilizará métodos asíncronos (Fetch API) para garantizar que las puntuaciones se guarden inmediatamente al finalizar el juego, evitando pérdidas por desconexión.
## Priorización del Backlog (Matriz MoSCoW a 2 Semanas)
### DEBE TENER (Must Have)
*Características críticas indispensables para cumplir con el Sprint 1 y validar el proyecto básico.*
 * Inicio de sesión y autenticación con cuenta personal en Flask/MySQL (RF-UN-01).
 * Mecánica interactiva base del primer juego: *Selección del Objeto Correcto* (Agilidad visual) escrito en JavaScript nativo (RF-UN-02).
 * Captura exacta en milisegundos del tiempo de reacción, aciertos y errores empleando los listeners de eventos (click, keydown) (RF-UN-03).
 * Pantalla de resultados inmediatos al terminar la partida (RF-UN-04).
 * Protección del acceso a las puntuaciones únicamente por el usuario autenticado (RS-UN-01, RS-UN-02).
### DEBERÍA TENER (Should Have)
*Requerimientos de alto impacto agendados para consolidarse durante el Sprint 2.*
 * Mecánicas de los dos retos lógicos restantes: *Memorama de Retención Rápida* y *Secuencia de Colores* (RF-UN-02).
 * Panel o Dashboard de historial para consultar las puntuaciones acumuladas históricas (RF-UN-05).
 * Retroalimentación interactiva inmediata ante aciertos o fallos en el frontend (RU-UN-03).
 * Persistencia asíncrona robusta mediante Fetch API para evitar la pérdida de métricas en la base de datos (RS-UN-05).
### PODRÍA TENER (Could Have)
*Elementos estéticos o de motivación que se implementarán únicamente si sobra tiempo al cierre del Sprint 2.*
 * Diseño visual responsivo adaptado a dispositivos móviles además de ordenadores.
 * Mecanismo visual de *High-Score* (puntuación máxima alcanzada por el usuario) en el menú principal (RU-UN-06).
 * Animaciones ligeras con CSS3 al seleccionar o fallar respuestas para enriquecer el dinamismo visual.
### NO TENDRÁ (Won't Have por ahora)
*Restricciones explícitas que quedan fuera del alcance para garantizar la viabilidad temporal del proyecto.*
 * **Uso de periféricos de video:** El sistema no utilizará servicios de cámara web, flujos de streaming ni algoritmos de visión artificial / realidad virtual.
 * Publicidad comercial de cualquier índole dentro de la plataforma (RS-UN-04).
 * Generación y exportación de reportes semanales, mensuales o anuales en formato PDF o gráficos de barras complejos (se limita a tablas en el Dashboard web).
 * Integración con comandos de voz, micrófonos o personalización avanzada de temas de color a nivel de perfil de usuario.

## Requerimientos de Experiencia de Usuario (Pathos)

- **RU-AM-01:** La interfaz deberá utilizar botones grandes y fáciles de identificar para personas con dificultades visuales.
- **RU-AM-02:** Los ejercicios deberán incluir instrucciones claras y sencillas antes de comenzar.
- **RU-AM-03:** El sistema deberá proporcionar retroalimentación inmediata cuando una respuesta sea correcta o incorrecta.
- **RU-AM-04:** La plataforma deberá minimizar la cantidad de clics necesarios para acceder a los ejercicios.
- **RU-AM-05:** Los colores y textos deberán presentar alto contraste para facilitar la lectura.
- **RU-AM-06:** Debe implementarse un sistema de logros o cualquier estrategia para motivar a los adultos mayores.

## Requerimientos de Seguridad y Confianza (Ethos)

- **RS-AM-01:** El sistema deberá proteger los datos personales y resultados de cada usuario.
- **RS-AM-02:** La información del usuario solo podrá ser visualizada por personas autorizadas.
- **RS-AM-03:** El sistema deberá informar al usuario sobre el almacenamiento de sus datos.
- **RS-AM-04:** El sistema no tendrá publicidad ni información engañosa.
- **RS-AM-05:** La plataforma deberá realizar respaldos periódicos para evitar la pérdida de información.

-----

DEBE TENER (Must Have)

Características indispensables para que el sistema funcione correctamente.

Inicio de sesión con cuenta personal (RF-AM-01).

Ejercicios de estimulación cognitiva y psicomotriz: memorama, secuencia de colores, rompecabezas y arrastrar figuras (RF-AM-02).

Registro automático del tiempo, aciertos y errores de cada ejercicio (RF-AM-03).

Mostrar resultados al finalizar cada actividad (RF-AM-04).

Protección de los datos personales y resultados de los usuarios (RS-AM-01).

Acceso a la información únicamente por personas autorizadas (RS-AM-02).


DEBERÍA TENER (Should Have)

Funciones importantes que mejoran la experiencia, aunque el sistema puede operar sin ellas al inicio.

Consultar el historial de ejercicios realizados (RF-AM-05).

Instrucciones claras y sencillas antes de comenzar cada ejercicio (RU-AM-02).

Retroalimentación inmediata cuando una respuesta sea correcta o incorrecta (RU-AM-03).

Informar al usuario sobre el almacenamiento de sus datos (RS-AM-03).

Realizar respaldos periódicos para evitar la pérdida de información (RS-AM-05).


PODRÍA TENER (Could Have)

Funciones opcionales que agregan valor, pero no son esenciales para el lanzamiento.

Botones grandes y fáciles de identificar para personas con dificultades visuales (RU-AM-01).

Minimizar la cantidad de clics necesarios para acceder a los ejercicios (RU-AM-04).

Colores y textos con alto contraste para facilitar la lectura (RU-AM-05).


NO TENDRÁ (Won't Have por ahora)

Funciones que no se implementarán en esta primera versión.

Publicidad dentro de la plataforma (RS-AM-04).

Juegos adicionales fuera de los ejercicios de estimulación cognitiva y psicomotriz.

Personalización avanzada de temas o apariencia.

No utilizara servicios de camara por lo tanto tampoco realidad virtual.

Integración con comandos de voz.

Funciones de entretenimiento o gamificación no relacionadas con la terapia.

