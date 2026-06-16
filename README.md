# Motricidad en Adultos mayores 
Proyecto: Plataforma Web de Estimulación Psicomotriz para Adultos Mayores

# Resumen Ejecutivo

El proyecto consiste en desarrollar una plataforma web para estimular y evaluar las habilidades psicomotrices de adultos mayores mediante ejercicios interactivos. La página registrará automáticamente el desempeño del usuario y permitirá consultar su progreso de forma sencilla.

---

# Definición del Problema

El envejecimiento de la población provoca una disminución en la movilidad y coordinación de muchas personas adultas mayores. Sin embargo, la mayoría de los ejercicios tradicionales no permiten medir objetivamente el avance del usuario ni generar reportes para familiares o cuidadores.

Por ello, se propone una plataforma web que facilite la realización de ejercicios y almacene automáticamente los resultados obtenidos.

---

# Objetivo General

Desarrollar una página web que permita evaluar y estimular las capacidades psicomotrices de los adultos mayores mediante ejercicios interactivos y el registro automático de su desempeño.

---

# Funcionalidades Principales

1. Reconocimiento de Gestos

Utilizando la cámara web y la librería MediaPipe, el sistema detectará movimientos simples como levantar la mano o señalar.

2. Registro de Resultados

Después de cada ejercicio, la plataforma guardará automáticamente:

- Tiempo de reacción.
- Número de aciertos.
- Número de errores.
- Historial de sesiones.

---

# Métricas Principales

- Tiempo de reacción: medido en milisegundos.
- Porcentaje de aciertos: cantidad de movimientos correctos realizados.
- Historial de progreso: comparación de resultados entre sesiones.

---

# Metodología

Se utilizará la metodología Scrum para organizar el desarrollo en ciclos cortos y entregar avances funcionales cada semana.

---

# Planeación del Proyecto (3 semanas)

Semana 1

- Diseño de la página principal.
- Creación del menú de inicio.
- Integración de la cámara web.
- Implementación del reconocimiento básico de la mano con MediaPipe.

Entrega: Página funcionando con detección de la mano.

---

Semana 2

- Desarrollo del ejercicio de levantar la mano.
- Medición del tiempo de reacción.
- Almacenamiento de resultados en la base de datos.

Entrega: Sistema capaz de registrar una sesión y guardar resultados.

---

Semana 3

- Desarrollo del panel de historial.
- Visualización de estadísticas básicas.
- Corrección de errores y pruebas finales.

Entrega: Plataforma completamente funcional.

---

# Tecnologías Utilizadas

Frontend

- HTML
- CSS
- JavaScript

Reconocimiento de Gestos

- MediaPipe
- OpenCV.js

Backend

- Python con Flask

Base de Datos

- MySQL

---

# Beneficios

- Permite evaluar objetivamente el desempeño del usuario.
- Automatiza el almacenamiento de resultados.
- Facilita el seguimiento del progreso.
- Puede utilizarse desde cualquier computadora con acceso a internet y cámara web.

---

# Riesgos

Riesgo| Solución
Mala iluminación| Solicitar mejor iluminación al usuario
Cámara no disponible| Mostrar mensaje de error
Fallos de conexión| Guardar datos localmente y sincronizar después
Errores del reconocimiento| Ajustar la calibración y realizar pruebas

La plataforma web ofrece una solución sencilla y accesible para apoyar la estimulación psicomotriz de adultos mayores. Al utilizar tecnologías de reconocimiento de gestos y almacenamiento automático de resultados, permite realizar un seguimiento claro del desempeño del usuario sin necesidad de equipos especializados, siendo un proyecto viable para desarrollarse en un periodo aproximado de tres semanas.
_____

Proyecto: Plataforma Web para la Estimulación Cognitiva y Psicomotriz en Adultos Mayores

1. Resumen Ejecutivo

Este proyecto propone el desarrollo de una plataforma web diseñada para ayudar a fortalecer las habilidades cognitivas y psicomotrices de los adultos mayores mediante ejercicios interactivos. Además de estimular la memoria, la atención y la coordinación, el sistema almacenará los resultados de cada sesión para que familiares o cuidadores puedan consultar el progreso del usuario.

La plataforma está pensada para desarrollarse en un periodo de tres semanas, utilizando tecnologías web sencillas y de fácil implementación.

---

2. Definición del Problema

Con el paso de los años, muchas personas adultas mayores presentan disminución en la memoria, atención, coordinación y velocidad de reacción.

Actualmente existen pocas herramientas accesibles que permitan ejercitar estas capacidades y registrar automáticamente el desempeño del usuario.

Por ello se propone una página web que ofrezca ejercicios interactivos y almacene los resultados para dar seguimiento a la evolución de cada persona.

---

3. Objetivo General

Desarrollar una plataforma web que permita estimular y evaluar habilidades cognitivas y psicomotrices mediante ejercicios interactivos, registrando automáticamente los resultados obtenidos.

---

4. Objetivos Específicos

- Diseñar una interfaz sencilla y accesible para adultos mayores.
- Implementar ejercicios que fortalezcan memoria, coordinación y atención.
- Registrar automáticamente el desempeño del usuario.
- Mostrar un historial con los resultados obtenidos.

---

5. Usuarios y Clientes

Usuarios

- Adultos mayores.
- Cuidadores.
- Familiares.

Clientes

- Casas de retiro.
- Centros de rehabilitación.
- Clínicas geriátricas.
- Familiares interesados en adquirir la plataforma.

---

6. Funcionalidades Principales

Registro de usuarios

Cada adulto mayor tendrá un perfil donde se almacenará su historial de actividades.

Ejercicios interactivos

La plataforma contará con diferentes actividades para estimular habilidades cognitivas y psicomotrices.

Historial

Se podrán consultar los resultados obtenidos en sesiones anteriores.

---

7. Ejercicios de Estimulación

Ejercicio 1: Memorama

El usuario deberá encontrar pares de cartas iguales.

Se medirán:

- Tiempo empleado.
- Número de intentos.
- Cantidad de parejas encontradas.

---

Ejercicio 2: Arrastrar figuras

El usuario deberá arrastrar diferentes figuras hasta su lugar correspondiente.

Se medirán:

- Tiempo de realización.
- Aciertos.
- Errores.

---

Ejercicio 3: Selecciona el objeto correcto

El sistema mostrará varios objetos y dará una instrucción como:

"Haz clic sobre el círculo azul".

Se medirán:

- Tiempo de respuesta.
- Precisión.
- Número de errores.

---

Ejercicio 4: Secuencia de colores

La plataforma mostrará una secuencia de colores que el usuario deberá repetir.

Se evaluará:

- Nivel alcanzado.
- Errores.
- Tiempo empleado.

---

Ejercicio 5: Rompecabezas sencillo

El usuario deberá acomodar piezas para formar una imagen.

Se registrará:

- Tiempo total.
- Número de movimientos.
- Porcentaje completado.

---

8. Indicadores (KPIs)

La plataforma registrará automáticamente:

- Tiempo promedio por ejercicio.
- Número de aciertos.
- Número de errores.
- Porcentaje de avance.
- Historial de sesiones realizadas.

---

9. Metodología Scrum

Para el desarrollo se utilizará Scrum, permitiendo organizar el trabajo en ciclos cortos y realizar entregas funcionales.

Roles

Product Owner

Define los requisitos del sistema.

Scrum Master

Coordina el proyecto y elimina obstáculos.

Equipo de Desarrollo

Diseña, programa y prueba la plataforma.

---

10. Planeación (3 semanas)

Sprint 1 (Semana 1)

- Diseño de la interfaz principal.
- Registro e inicio de sesión.
- Base de datos.
- Menú principal.

Entrega

Sistema con acceso y navegación funcionando.

---

Sprint 2 (Semana 2)

- Desarrollo del memorama.
- Desarrollo del ejercicio de arrastrar figuras.
- Registro automático de resultados.

Entrega

Primeros ejercicios completamente funcionales.

---

Sprint 3 (Semana 3)

- Desarrollo de secuencia de colores.
- Desarrollo del rompecabezas.
- Historial de resultados.
- Corrección de errores.
- Pruebas finales.

Entrega

Sistema completamente funcional.

---

11. Tecnologías

Frontend

- HTML5
- CSS3
- JavaScript

Backend

- Python (Flask)

Base de Datos

- MySQL

---

12. Beneficios

- Mejora la memoria y la atención.
- Favorece la coordinación motriz.
- Permite monitorear el progreso del usuario.
- Facilita el seguimiento por parte de familiares o cuidadores.
- Puede utilizarse desde cualquier computadora con acceso a internet.

---

13. Riesgos

Riesgo| Mitigación
Usuarios con poca experiencia tecnológica| Diseño simple y botones grandes
Problemas de conexión| Guardado automático de información
Pérdida de datos| Respaldos periódicos
Errores en los ejercicios| Pruebas antes de publicar nuevas versiones

---

14. Viabilidad

El proyecto es viable debido a que utiliza tecnologías gratuitas y ampliamente conocidas, lo que reduce costos de desarrollo y mantenimiento.

Además, puede implementarse en escuelas, centros de rehabilitación o de forma doméstica sin necesidad de hardware especializado.

---

15. Conclusión

La plataforma web permitirá ofrecer ejercicios sencillos y entretenidos para fortalecer las capacidades cognitivas y psicomotrices de los adultos mayores. Gracias al almacenamiento automático de resultados y al historial de progreso, familiares y cuidadores podrán conocer la evolución del usuario de manera rápida y objetiva. Al utilizar únicamente tecnologías web, el proyecto es factible de desarrollar en un periodo aproximado de tres semanas y cumple con los principios de una metodología ágil como Scrum.
