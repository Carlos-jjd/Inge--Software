# Motricidad en Adultos mayores 
Proyecto

1. Definición del Problema y Objetivos
De acuerdo a la OMS hasta un 35% de los adultos de 70 años experimenta restricciones directas en su movilidad y coordinación psicomotriz fina. Las alternativas analógicas de estimulación actuales carecen de un sistema centralizado de medición, provocando que los cuidadores no puedan identificar con exactitud el nivel de progreso o afectación real del usuario.  Para resolver este problema este proyecto desarrolla una herramienta tecnológica de estimulación psicomotriz que automatiza y cuantifica la ejercitación diaria a través de dos módulos de interacción principales:Reconocimiento de Gestos: Implementación de visión computacional mediante sensores ópticos para capturar y validar movimientos cinemáticos cotidianos (como saludar, señalar o seguir trayectorias guiadas). El sistema reduce el error de captura manual, garantizando una precisión en la detección de landmarks corporales 95%.Reconocimiento Espacial: Módulo interactivo diseñado para evaluar y ejercitar la ubicación, estimación de distancias y manipulación de formas en entornos digitales controlados.

2.  Indicadores y Analítica (Métricas Cuantitativas)A diferencia de alternativas recreativas genéricas, esta herramienta elimina las evaluaciones cualitativas ambiguas. El software recopila y procesa variables cuantitativas de rendimiento en una base de datos local para estructurar un tablero de control sin pantallas confusas, basándose en los siguientes indicadores clave de rendimiento (KPIs):Tasa de Latencia Cinética: Medición exacta en milisegundos del tiempo de reacción del adulto mayor desde la aparición del estímulo visual hasta la ejecución del movimiento.Índice de Precisión Vectorial: Registro analítico de los aciertos y desviaciones en los retos de ubicación espacial.Curva Temporal de Progreso: Mapeo histórico que refleja tendencias específicas, permitiendo a los familiares y asistentes médicos identificar de un vistazo en qué movimientos específicos disminuye el rendimiento o si se necesita asistencia personalizada.

3.  Justificación de la Metodología de Trabajo (El Tablero de Control Ágil)Para la planeación y desarrollo del software, se opta estrictamente por el marco de trabajo Scrum. Esta elección es fundamental y se justifica por los siguientes factores de ingeniería:Uso de Sprints Fijos (Duración de 2 semanas): Debido a la alta incertidumbre técnica vinculada a la calibración de las librerías de visión artificial y a la necesidad de realizar pruebas de usabilidad tempranas con adultos mayores, trabajar en ciclos cortos asegura la entrega de incrementos funcionales de software de manera constante.Asignación de Roles Claros: Se definen los roles esenciales (Product Owner para la gestión de los requisitos de la antología, Scrum Master para mitigar bloqueos técnicos y Equipo de Desarrollo) para asegurar la cohesión del diseño arquitectónico y mantener la trazabilidad de los artefactos de software.

4. Viabilidad Económica y Operativa (El Business Case)La viabilidad financiera y el Retorno de Inversión (ROI) de la plataforma se sustentan en un modelo B2B2C enfocado en clínicas de día, asilos y uso residencial guiado:Reducción de Costos Operativos: La automatización del registro de estadísticas disminuye en un 30% el tiempo que el personal de asistencia o cuidadores dedica a la recopilación manual de datos clínicos del estado motriz del paciente.Optimización de Recursos Clínicos: Al proveer reportes automatizados de teleasistencia, se reduce la necesidad de evaluaciones físicas presenciales rutinarias de bajo nivel, permitiendo amortizar el costo del desarrollo del software en un periodo estimado de 12 meses tras su despliegue inicial.

_______________________________________________

SPRINT 1: Base del Sistema y Reconocimiento de Gestos
Duración: 16 de junio al 29 de junio (Semana 1)
Planificación: Definición de tareas para el menú inicial y el sensor de la cámara.
Desarrollo: * Creación de la interfaz de bienvenida y menú principal.
Integración de visión artificial (OpenCV/MediaPipe) para detectar la mano y registrar los gestos.
Programación del backend para medir la Tasa de Latencia Cinética (tiempo de reacción).
Pruebas: Pruebas de Caja Blanca en el algoritmo de reconocimiento de extremidades.
Entrega: Incremento funcional que abre la cámara y valida si el usuario levanta la mano.

SPRINT 2: Módulo Espacial, Analítica y Cierre
Duración: 30 de junio al 15 de julio (Semanas 2 y 3)
Planificación: Definición de tareas para el módulo de ubicación y la interfaz médica.
Desarrollo:
Interfaz del ejercicio espacial (arrastre de vectores y correspondencia cromática).
Cálculo del Índice de Precisión Vectorial (desviación del movimiento en píxeles).
Creación del módulo de reportes automatizados para el asistente médico con filtros por fecha.
Pruebas: Pruebas de Caja Negra para controlar errores en fechas inválidas o falta de datos.
Entrega: Producto de software completamente integrado, libre de ambigüedades y listo para producción.

-----------------
Frontend (Android Studio)
El teléfono o tableta Android funcionará exclusivamente como la interfaz visual y el capturador de datos.
Lenguaje: Kotlin (es el lenguaje moderno, oficial y recomendado por Google para Android Studio) o Java.
MediaPipe SDK para Android: Google ofrece la versión nativa de MediaPipe para Android Studio. La cámara del celular detectará los landmarks de la mano localmente con excelente rendimiento.  
Retrofit / Volley: Son las librerías que usarás dentro de Android Studio para conectarte y enviar las métricas hacia las APIs del Backend a través de internet.
Interface: Pantallas táctiles diseñadas para el adulto mayor donde se procesa el reconocimiento espacial (arrastrar elementos en la pantalla).

Backend (Servidor y APIs)
En lugar de procesar las matemáticas pesadas en el celular, creas un servidor web independiente que reciba los datos.
El Framework de la API: Puedes usar FastAPI o Flask (en Python). Este servidor estará escuchando las peticiones que le mande el celular.
Lógica Analítica: Cuando el adulto mayor termina una sesión en la app de Android, la aplicación empaqueta las variables (milisegundos, píxeles de error, estabilidad) y las envía mediante una petición HTTP POST a tu API. El backend recibe los datos en Python y ejecuta el Análisis de Componentes Principales (ACP) usando NumPy y SciPy en el servidor.  
Base de Datos Central: El backend almacena todo en una base de datos como PostgreSQL o MySQL.

Canales de comunicación del equipo:
Se utilizará discord un servicio de mensajeria que facilita el uso de canales para hacer llamadas de voz lo cual agiliza las reuniones.
________
Proyecto: Plataforma Web de Estimulación Psicomotriz para Adultos Mayores

Resumen Ejecutivo

El proyecto consiste en desarrollar una plataforma web para estimular y evaluar las habilidades psicomotrices de adultos mayores mediante ejercicios interactivos. La página registrará automáticamente el desempeño del usuario y permitirá consultar su progreso de forma sencilla.

---

Definición del Problema

El envejecimiento de la población provoca una disminución en la movilidad y coordinación de muchas personas adultas mayores. Sin embargo, la mayoría de los ejercicios tradicionales no permiten medir objetivamente el avance del usuario ni generar reportes para familiares o cuidadores.

Por ello, se propone una plataforma web que facilite la realización de ejercicios y almacene automáticamente los resultados obtenidos.

---

Objetivo General

Desarrollar una página web que permita evaluar y estimular las capacidades psicomotrices de los adultos mayores mediante ejercicios interactivos y el registro automático de su desempeño.

---

Funcionalidades Principales

1. Reconocimiento de Gestos

Utilizando la cámara web y la librería MediaPipe, el sistema detectará movimientos simples como levantar la mano o señalar.

2. Registro de Resultados

Después de cada ejercicio, la plataforma guardará automáticamente:

- Tiempo de reacción.
- Número de aciertos.
- Número de errores.
- Historial de sesiones.

---

Métricas Principales

- Tiempo de reacción: medido en milisegundos.
- Porcentaje de aciertos: cantidad de movimientos correctos realizados.
- Historial de progreso: comparación de resultados entre sesiones.

---

Metodología

Se utilizará la metodología Scrum para organizar el desarrollo en ciclos cortos y entregar avances funcionales cada semana.

---

Planeación del Proyecto (3 semanas)

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

Tecnologías Utilizadas

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

Beneficios

- Permite evaluar objetivamente el desempeño del usuario.
- Automatiza el almacenamiento de resultados.
- Facilita el seguimiento del progreso.
- Puede utilizarse desde cualquier computadora con acceso a internet y cámara web.

---

Riesgos

Riesgo| Solución
Mala iluminación| Solicitar mejor iluminación al usuario
Cámara no disponible| Mostrar mensaje de error
Fallos de conexión| Guardar datos localmente y sincronizar después
Errores del reconocimiento| Ajustar la calibración y realizar pruebas

---

Conclusión

La plataforma web ofrece una solución sencilla y accesible para apoyar la estimulación psicomotriz de adultos mayores. Al utilizar tecnologías de reconocimiento de gestos y almacenamiento automático de resultados, permite realizar un seguimiento claro del desempeño del usuario sin necesidad de equipos especializados, siendo un proyecto viable para desarrollarse en un periodo aproximado de tres semanas.