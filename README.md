# Motricidad en Adultos mayores 
Proyecto

1. Definición del Problema y Objetivos
El envejecimiento poblacional representa uno de los desafíos demográficos más críticos a nivel global. De acuerdo con datos de la Organización Mundial de la Salud (OMS), para el año 2030, 1 de cada 6 personas en el mundo tendrá 60 años o más, un sector que alcanzará los 1,400 millones de individuos y que se proyecta se duplicará hasta llegar a los 2,100 millones para el año 2050.  A la par de este crecimiento, el deterioro físico y cognitivo se manifiesta de manera acelerada. La OMS estima que aproximadamente el 20% de las personas mayores de 70 años y el 50% de los mayores de 85 años padecen alguna discapacidad o limitación severa del movimiento. Adicionalmente, estudios clínicos reportan que hasta un 35% de los adultos de 70 años experimenta restricciones directas en su movilidad y coordinación psicomotriz fina. Las alternativas analógicas de estimulación actuales carecen de un sistema centralizado de medición, provocando que los cuidadores o familiares no puedan identificar con exactitud el nivel de progreso o afectación real del usuario.  Para resolver este problema de forma medible, este proyecto desarrolla una herramienta tecnológica de estimulación psicomotriz que automatiza y cuantifica la ejercitación diaria a través de dos módulos de interacción principales:Reconocimiento de Gestos: Implementación de visión computacional mediante sensores ópticos para capturar y validar movimientos cinemáticos cotidianos (como saludar, señalar o seguir trayectorias guiadas). El sistema reduce el error de captura manual, garantizando una precisión en la detección de landmarks corporales 95%.Reconocimiento Espacial: Módulo interactivo diseñado para evaluar y ejercitar la ubicación, estimación de distancias y manipulación de formas en entornos digitales controlados.

2.  Indicadores y Analítica (Métricas Cuantitativas)A diferencia de alternativas recreativas genéricas, esta herramienta elimina las evaluaciones cualitativas ambiguas. El software recopila y procesa variables cuantitativas de rendimiento en una base de datos local para estructurar un tablero de control sin pantallas confusas, basándose en los siguientes indicadores clave de rendimiento (KPIs):Tasa de Latencia Cinética: Medición exacta en milisegundos del tiempo de reacción del adulto mayor desde la aparición del estímulo visual hasta la ejecución del movimiento.Índice de Precisión Vectorial: Registro analítico de los aciertos y desviaciones en los retos de ubicación espacial.Curva Temporal de Progreso: Mapeo histórico que refleja tendencias específicas, permitiendo a los familiares y asistentes médicos identificar de un vistazo en qué movimientos específicos disminuye el rendimiento o si se necesita asistencia personalizada.

3.  Justificación de la Metodología de Trabajo (El Tablero de Control Ágil)Para la planeación y desarrollo del software, se opta estrictamente por el marco de trabajo Scrum. Esta elección es fundamental y se justifica por los siguientes factores de ingeniería:Uso de Sprints Fijos (Duración de 2 semanas): Debido a la alta incertidumbre técnica vinculada a la calibración de las librerías de visión artificial y a la necesidad de realizar pruebas de usabilidad tempranas con adultos mayores, trabajar en ciclos cortos asegura la entrega de incrementos funcionales de software de manera constante.Asignación de Roles Claros: Se definen los roles esenciales (Product Owner para la gestión de los requisitos de la antología, Scrum Master para mitigar bloqueos técnicos y Equipo de Desarrollo) para asegurar la cohesión del diseño arquitectónico y mantener la trazabilidad de los artefactos de software.

4. Viabilidad Económica y Operativa (El Business Case)La viabilidad financiera y el Retorno de Inversión (ROI) de la plataforma se sustentan en un modelo B2B2C enfocado en clínicas de día, asilos y uso residencial guiado:Reducción de Costos Operativos: La automatización del registro de estadísticas disminuye en un 30% el tiempo que el personal de asistencia o cuidadores dedica a la recopilación manual de datos clínicos del estado motriz del paciente.Optimización de Recursos Clínicos: Al proveer reportes automatizados de teleasistencia, se reduce la necesidad de evaluaciones físicas presenciales rutinarias de bajo nivel, permitiendo amortizar el costo del desarrollo del software en un periodo estimado de 12 meses tras su despliegue inicial.

_______________________________________________

SPRINT 1: Base del Sistema y Reconocimiento de Gestos
Duración: 16 de junio al 29 de junio (Semanas 1 y 2)
Planificación: Definición de tareas para el menú inicial y el sensor de la cámara.
Desarrollo: * Creación de la interfaz de bienvenida y menú principal.
Integración de visión artificial (OpenCV/MediaPipe) para detectar la mano y registrar los gestos.
Programación del backend para medir la Tasa de Latencia Cinética (tiempo de reacción).
Pruebas: Pruebas de Caja Blanca en el algoritmo de reconocimiento de extremidades.
Entrega: Incremento funcional que abre la cámara y valida si el usuario levanta la mano.

SPRINT 2: Módulo Espacial, Analítica y Cierre
Duración: 30 de junio al 15 de julio (Semanas 3 y 4)
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
