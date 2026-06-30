# QA_BITACORA

## Bitácora de Pruebas de Integración

| ID de Prueba | Nombre de la Integración | Módulo de Origen (Pantalla inicial) | Módulo Destino (Pantalla final) | Resultado Esperado | Estado Actual |
|---------------|--------------------------|-------------------------------------|---------------------------------|--------------------|----------------|
| QA-001 | Menú Principal → Juego de Memorama | Menú Principal | Juego de Memorama | Al seleccionar la opción **Juego de Memorama**, el sistema debe abrir correctamente el juego mostrando el tablero, cronómetro y contador de aciertos. | ✅ PASA |
| QA-002 | Inicio del Juego Memorama | Juego de Memorama | Tablero de Juego | El tablero debe cargar todas las cartas ocultas listas para que el usuario pueda comenzar la partida. | ✅ PASA |
| QA-003 | Validación de Parejas | Tablero de Juego | Tablero Actualizado | Al seleccionar dos cartas, el sistema debe revelar ambas y comprobar si forman una pareja. | ✅ PASA |
| QA-004 | Finalización de Memorama | Juego de Memorama | Pantalla de Resultados | Al completar todas las parejas, el sistema debe mostrar tiempo empleado, parejas encontradas, errores y rendimiento cognitivo. | ✅ PASA |
| QA-005 | Registro de Resultados Memorama | Pantalla de Resultados | Mi Progreso | Al regresar al menú y acceder a **Mi Progreso**, el resultado del Memorama debe aparecer almacenado correctamente. | ✅ PASA |
| QA-006 | Menú Principal → Secuencia de Colores | Menú Principal | Pantalla de Instrucciones | Al seleccionar **Secuencia de Colores**, el sistema debe abrir la pantalla de instrucciones de la actividad. | ✅ PASA |
| QA-007 | Inicio de Secuencia de Colores | Pantalla de Instrucciones | Juego Secuencia de Colores | Al presionar **¡Empezar Actividad!**, el juego debe iniciar correctamente mostrando la secuencia correspondiente. | ✅ PASA |
| QA-008 | Finalización de Secuencia de Colores | Juego Secuencia de Colores | Pantalla de Resultados | Al concluir la actividad, el sistema debe mostrar tiempo, secuencias correctas, errores y precisión obtenida. | ✅ PASA |
| QA-009 | Registro de Resultados Secuencia de Colores | Pantalla de Resultados | Mi Progreso | El historial debe registrar automáticamente el resultado obtenido en la actividad con su porcentaje de desempeño. | ✅ PASA |
| QA-010 | Consulta del Historial | Menú Principal | Mi Progreso | El historial debe mostrar correctamente las actividades completadas (Memorama y Secuencia de Colores) con sus resultados correspondientes. | ✅ PASA |

---

## Resumen

| Total de Pruebas | PASA | FALLA |
|------------------|:----:|:------:|
| 10 | 10 | 0 |

---

### Observaciones

- Se verificó correctamente la navegación entre módulos.
- Los resultados de cada actividad se almacenan en el historial del usuario.
- Se muestran correctamente el tiempo, aciertos, errores y porcentaje de desempeño.
- No se detectaron errores durante las pruebas realizadas.
