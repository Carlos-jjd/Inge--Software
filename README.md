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
