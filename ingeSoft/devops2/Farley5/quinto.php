<?php
/* ==========================================================================
   IngeSoft5 / DevOps2 / Farley cap. 5 — bloque 05: Implementar un pipeline, evolucionarlo, métricas y resumen.
   Fuente: Continuous Delivery (Humble & Farley) — Chapter 5
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    1 => ['incremental'],
    2 => ['value stream', 'flujo de valor', 'cadena de valor'],
    3 => ['walking skeleton', 'esqueleto andante', 'esqueleto ambulante'],
    4 => ['build y despliegue', 'build y el despliegue', 'proceso de build y despliegue', 'build y deployment'],
    5 => ['pruebas unitarias', 'unit tests'],
    6 => ['analisis de codigo', 'analisis del codigo', 'analisis estatico'],
    7 => ['aceptacion'],
    8 => ['releases', 'lanzamientos', 'liberaciones'],
    9 => ['check-in', 'commit'],
    10 => ['release', 'lanzamiento'],
    11 => ['30 minutos', 'treinta minutos', 'media hora'],
    12 => ['lapiz y papel', 'papel y lapiz'],
    13 => ['todos los involucrados', 'todos los implicados', 'todos'],
    14 => ['transcurrido', 'total'],
    15 => ['valor agregado', 'valor anadido', 'agregacion de valor'],
    16 => ['commit'],
    17 => ['aceptacion'],
    18 => ['despliegue', 'deploy', 'deployment'],
    19 => ['production-like', 'similar a produccion', 'parecido a produccion'],
    20 => ['demos', 'una demo', 'demostraciones', 'demo'],
    21 => ['dependencias'],
    22 => ['placeholders', 'marcadores de posicion', 'marcadores'],
    23 => ['en cada check-in', 'en cada commit', 'cada vez que alguien hace check-in'],
    24 => ['automaticamente'],
    25 => ['binario'],
    26 => ['pulsar un boton', 'presionar un boton', 'apretar un boton', 'un boton'],
    27 => ['autorizacion'],
    28 => ['minima cantidad de trabajo posible', 'menor cantidad de trabajo posible', 'cantidad minima de trabajo'],
    29 => ['commit stage'],
    30 => ['hello world'],
    31 => ['afirme true', 'haga assert true', 'asserte true', 'sea assert true', 'verifique true'],
    32 => ['despliegue', 'deploy', 'deployment'],
    33 => ['iis'],
    34 => ['aceptacion'],
    35 => ['desplegada'],
    36 => ['webdriver'],
    37 => ['sahi'],
    38 => ['iteracion cero', 'iteracion 0'],
    39 => ['operaciones'],
    40 => ['codigo fuente'],
    41 => ['binarios'],
    42 => ['cadena de herramientas de desarrollo', 'toolchain de desarrollo', 'toolchain'],
    43 => ['cada check-in', 'cada commit'],
    44 => ['integracion continua', 'ci'],
    45 => ['checkout', 'check out', 'actualiza'],
    46 => ['sistema de archivos', 'filesystem'],
    47 => ['interfaz de usuario', 'ui', 'interfaz'],
    48 => ['maquina', 'servidor'],
    49 => ['staging'],
    50 => ['uat', 'user acceptance testing', 'pruebas de aceptacion de usuario'],
    51 => ['completamente automatizado', 'totalmente automatizado', 'automatizado'],
    52 => ['10'],
    53 => ['11'],
    54 => ['empaquetar', 'empaquetar la aplicacion'],
    55 => ['instalar y configurar', 'instalacion y configuracion'],
    56 => ['despliegue', 'deployment', 'deploy'],
    57 => ['aceptacion'],
    58 => ['build'],
    59 => ['binarios'],
    60 => ['despliegue', 'deploy'],
    61 => ['test de despliegue', 'deployment test', 'deployment smoke test', 'smoke test'],
    62 => ['una sola vez', 'solo una vez'],
    63 => ['configuracion'],
    64 => ['mismo'],
    65 => ['configuracion del entorno', 'configuracion'],
    66 => ['analisis de codigo', 'analisis del codigo', 'analisis estatico'],
    67 => ['aceptacion'],
    68 => ['integracion'],
    69 => ['corriendo', 'en ejecucion', 'ejecutandose'],
    70 => ['xunit'],
    71 => ['sistema de archivos', 'filesystem'],
    72 => ['base de datos'],
    73 => ['componente', 'componentes'],
    74 => ['rapidos', 'rapidas'],
    75 => ['construir la aplicacion', 'el build', 'compilar', 'el build de la aplicacion'],
    76 => ['cobertura'],
    77 => ['ciclomatica'],
    78 => ['acoplamiento'],
    79 => ['componente', 'componentes'],
    80 => ['cinco minutos', '5 minutos', '5'],
    81 => ['paralelo'],
    82 => ['ram'],
    83 => ['cpu', 'cpus'],
    84 => ['smoke tests', 'smoke'],
    85 => ['reportes', 'informes'],
    86 => ['logs'],
    87 => ['vnc2swf'],
    88 => ['pantalla', 'screen recording', 'grabacion de pantalla'],
    89 => ['funcionales'],
    90 => ['no funcionales'],
    91 => ['capacidad'],
    92 => ['escalado', 'escalabilidad', 'scaling'],
    93 => ['seguidas', 'una tras otra', 'back-to-back'],
    94 => ['condiciones de carrera', 'race conditions'],
    95 => ['deadlocks', 'interbloqueos', 'bloqueos mutuos'],
    96 => ['contencion de recursos', 'contencion'],
    97 => ['4'],
    98 => ['pronto', 'temprano', 'al inicio'],
    99 => ['agregar pruebas', 'anadir pruebas'],
    100 => ['componentes'],
    101 => ['ramas', 'branches'],
    102 => ['mini pipeline', 'mini-pipeline', 'pipeline pequeno'],
    103 => ['ensamble', 'junte', 'reuna'],
    104 => ['13'],
    105 => ['14'],
    106 => ['cambio', 'commit'],
    107 => ['independiente'],
    108 => ['automatizada'],
    109 => ['de una vez', 'a la vez'],
    110 => ['incremental'],
    111 => ['placeholder', 'marcador'],
    112 => ['empieza'],
    113 => ['termina', 'acaba', 'finaliza'],
    114 => ['cuello de botella', 'bottleneck'],
    115 => ['datos'],
    116 => ['cycle time', 'tiempo de ciclo'],
    117 => ['por orden de prioridad', 'en orden de prioridad', 'por prioridad'],
    118 => ['vivo'],
    119 => ['mejorar y refactorizar', 'refactorizar y mejorar', 'refactorizar'],
    120 => ['feedback', 'retroalimentacion', 'retroaccion'],
    121 => ['cortos'],
    122 => ['visibles'],
    123 => ['information radiators', 'radiadores de informacion'],
    124 => ['hawthorne'],
    125 => ['cortas'],
    126 => ['breve conversacion', 'conversacion rapida', 'charla rapida', 'conversacion'],
    127 => ['lean'],
    128 => ['global'],
    129 => ['local'],
    130 => ['no habra diferencia', 'no cambia nada', 'no se mejora nada', 'no hace diferencia'],
    131 => ['global'],
    132 => ['cycle time', 'tiempo de ciclo'],
    133 => ['decidir que una funcionalidad debe implementarse', 'decidir que hay que implementar una funcionalidad', 'decidir implementar una funcionalidad', 'decidir que una feature debe implementarse'],
    134 => ['liberada a los usuarios', 'liberada', 'en produccion', 'desplegada a usuarios', 'release a usuarios'],
    135 => ['poppendieck'],
    136 => ['repetible'],
    137 => ['fiable', 'confiable'],
    138 => ['analisis'],
    139 => ['defectos'],
    140 => ['secundaria'],
    141 => ['seis meses', '6 meses'],
    142 => ['calidad'],
    143 => ['completa'],
    144 => ['check-in', 'commit'],
    145 => ['release', 'lanzamiento'],
    146 => ['lead time', 'tiempo de entrega'],
    147 => ['cuellos de botella', 'bottlenecks'],
    148 => ['identificar'],
    149 => ['manuales'],
    150 => ['explotar', 'exploit', 'aprovechar'],
    151 => ['throughput', 'rendimiento', 'capacidad de procesamiento'],
    152 => ['buffer', 'colchon'],
    153 => ['otra cosa', 'nada mas', 'otras tareas'],
    154 => ['subordinar', 'subordinate'],
    155 => ['100 %', '100%', '100', 'cien por ciento'],
    156 => ['backlog'],
    157 => ['automatizadas', 'automaticas'],
    158 => ['elevar', 'elevate'],
    159 => ['testers'],
    160 => ['repetir', 'rinse and repeat', 'enjuagar y repetir', 'lavar y repetir'],
    161 => ['1', 'uno'],
    162 => ['cobertura de pruebas automatizadas', 'cobertura de tests automatizados', 'cobertura de pruebas'],
    163 => ['ciclomatica'],
    164 => ['eferente'],
    165 => ['aferente'],
    166 => ['estilo'],
    167 => ['defectos'],
    168 => ['velocity', 'velocidad'],
    169 => ['commits'],
    170 => ['builds'],
    171 => ['fallos de build', 'builds fallidos', 'build failures'],
    172 => ['duracion del build', 'duracion'],
    173 => ['semaforo'],
    174 => ['rojo'],
    175 => ['ambar', 'amarillo', 'naranja'],
    176 => ['verde'],
    177 => ['panopticode'],
    178 => ['java'],
    179 => ['reconocimiento de patrones', 'pattern matching', 'deteccion de patrones', 'reconocer patrones'],
    180 => ['check-in', 'commit'],
    181 => ['repositorio de artefactos', 'artifact repository'],
    182 => ['recopilan', 'reunen', 'cotejan'],
    183 => ['base de datos'],
    184 => ['interno'],
    185 => ['proyecto'],
    186 => ['visibilidad'],
    187 => ['rompieron', 'han roto'],
    188 => ['un boton', 'un clic', 'un solo boton'],
    189 => ['production-like', 'similar a produccion'],
    190 => ['ineficiencias', 'ineficiencias del proceso de release'],
    191 => ['promedio'],
    192 => ['defectos'],
    193 => ['sistema de registro', 'system of record'],
    194 => ['lo antes posible', 'tan pronto como sea posible', 'lo mas temprano posible', 'cuanto antes'],
    195 => ['paralelizacion', 'paralelizadas', 'paralelas'],
    196 => ['configuracion'],
    197 => ['configuracion'],
    198 => ['build y despliegue', 'build y deploy', 'construccion y despliegue'],
    199 => ['automatizadas'],
    200 => ['disciplina'],
    201 => ['15'],
    202 => ['modelo de madurez', 'maturity model'],
];

$TEXTO = [];
for ($i = 1; $i <= 202; $i++) $TEXTO[] = $i;

$MULTIPLE = [
    'm1' => [
        'texto'    => '¿Cuál es el orden correcto de los 5 pasos para implementar un pipeline?',
        'opciones' => [
            'a' => 'Automatizar releases → tests → aceptación → build → value stream',
            'b' => 'Modelar value stream y walking skeleton → automatizar build y despliegue → unit tests y análisis de código → pruebas de aceptación → releases',
            'c' => 'Aceptación → unit tests → build → value stream → releases',
            'd' => 'Releases → despliegue → tests → build → value stream'
        ],
        'correcta' => 'b',
        'porque'   => 'Siempre de forma incremental: no hace falta implementarlo todo a la vez.'
    ],
    'm2' => [
        'texto'    => '¿Cómo se levanta el value stream de un proyecto que ya está en marcha?',
        'opciones' => [
            'a' => 'Con una herramienta de pago durante un mes',
            'b' => 'Con un consultor externo',
            'c' => 'En unos 30 minutos con lápiz y papel, hablando con todos los involucrados y anotando pasos y estimaciones de tiempo transcurrido y tiempo de valor agregado',
            'd' => 'Copiando el pipeline de Internet'
        ],
        'correcta' => 'c',
        'porque'   => 'Si es un proyecto nuevo, se copia el de otro proyecto parecido de la organización o se parte del mínimo.'
    ],
    'm3' => [
        'texto'    => 'El value stream mínimo para un proyecto nuevo es…',
        'opciones' => [
            'a' => 'Solo el commit stage',
            'b' => 'Un commit stage (build, métricas básicas y unit tests), una etapa de pruebas de aceptación y una tercera etapa que despliega a un entorno production-like para hacer demos',
            'c' => 'Commit, aceptación, capacidad, UAT y producción',
            'd' => 'Solo el despliegue'
        ],
        'correcta' => 'b',
        'porque'   => 'Ese es el punto de partida del “bare minimum”.'
    ],
    'm4' => [
        'texto'    => '¿Qué son los <i>placeholders</i> al modelar el pipeline en la herramienta de CI?',
        'opciones' => [
            'a' => 'Proyectos que al principio no hacen nada, solo se disparan en orden simulando el value stream mediante dependencias; luego se rellenan con scripts reales',
            'b' => 'Errores de configuración',
            'c' => 'Plugins de seguridad',
            'd' => 'Servidores de respaldo'
        ],
        'correcta' => 'a',
        'porque'   => 'Si la herramienta no permite modelar el value stream directamente, se simula con dependencias entre proyectos.'
    ],
    'm5' => [
        'texto'    => 'En el ejemplo del pipeline mínimo, ¿qué dispara cada etapa?',
        'opciones' => [
            'a' => 'Todas se disparan a mano',
            'b' => 'Commit: cada check-in; aceptación: automáticamente cuando pasa el commit, con el mismo binario; deploy production-like: botón para elegir la versión (normalmente con autorización)',
            'c' => 'Todas se disparan de noche',
            'd' => 'La aceptación corre antes del commit'
        ],
        'correcta' => 'b',
        'porque'   => 'La aceptación reutiliza el binario del commit (Build Once).'
    ],
    'm6' => [
        'texto'    => '¿En qué orden se construye el <i>walking skeleton</i>?',
        'opciones' => [
            'a' => 'Aceptación → despliegue → commit',
            'b' => 'Despliegue → commit → aceptación',
            'c' => 'Commit stage → despliegue → prueba de aceptación (que necesita la app ya desplegada)',
            'd' => 'Todo a la vez sin orden'
        ],
        'correcta' => 'c',
        'porque'   => 'Ejemplo: Hello world/una página HTML con un unit test que asserta true; directorio virtual en IIS; aceptación con WebDriver o Sahi que verifica el texto “Hello world”. En un proyecto nuevo, todo esto antes de empezar el desarrollo (iteración cero).'
    ],
    'm7' => [
        'texto'    => '¿Qué característica clave deben tener los <b>binarios</b> que produce el build?',
        'opciones' => [
            'a' => 'Ser lo más pequeños posibles',
            'b' => 'Poder copiarse a una máquina nueva y, con el entorno y configuración adecuados, arrancar la aplicación sin depender de ninguna parte de la cadena de herramientas de desarrollo instalada',
            'c' => 'Estar cifrados',
            'd' => 'Estar escritos en Java'
        ],
        'correcta' => 'b',
        'porque'   => '“Binarios” es deliberadamente vago: depende de la tecnología.'
    ],
    'm8' => [
        'texto'    => '¿Qué debe hacer el servidor de CI en el paso 2?',
        'opciones' => [
            'a' => 'Solo compilar cuando un humano lo pida',
            'b' => 'Vigilar el control de versiones, hacer checkout/actualizar el código en cada cambio, correr el build automatizado y guardar los binarios accesibles a todo el equipo desde su interfaz',
            'c' => 'Desplegar directamente a producción',
            'd' => 'Escribir el código'
        ],
        'correcta' => 'b',
        'porque'   => 'Se usa alguna de las herramientas de la sección “Implementing Continuous Integration”.'
    ],
    'm9' => [
        'texto'    => '¿Cómo se llama el entorno donde se despliega automáticamente y qué se le exige?',
        'opciones' => [
            'a' => 'Producción; ningún requisito',
            'b' => 'Staging o UAT; debe ser algo production-like y su aprovisionamiento y mantenimiento debe ser totalmente automatizado',
            'c' => 'Desarrollo; solo un portátil',
            'd' => 'Sandbox; sin automatización'
        ],
        'correcta' => 'b',
        'porque'   => 'Ver capítulos 10 y 11.'
    ],
    'm10' => [
        'texto'    => '¿Qué automatiza el paso de despliegue?',
        'opciones' => [
            'a' => 'Empaquetar (a veces en varios paquetes), instalar y configurar, y una prueba automatizada de despliegue que verifique que se desplegó con éxito',
            'b' => 'Solo copiar el binario',
            'c' => 'Solo reiniciar el servidor',
            'd' => 'Solo la documentación'
        ],
        'correcta' => 'a',
        'porque'   => 'Debe ser fiable porque es prerrequisito de las pruebas de aceptación.'
    ],
    'm11' => [
        'texto'    => '¿Qué principios deben respetarse al montar el despliegue de un botón?',
        'opciones' => [
            'a' => 'Reconstruir el binario en cada entorno',
            'b' => 'Mezclar la configuración con el binario',
            'c' => 'Usar un proceso de release diferente al del entorno de pruebas',
            'd' => 'Construir los binarios solo una vez y separar la configuración de los binarios, para usar los mismos en cualquier entorno'
        ],
        'correcta' => 'd',
        'porque'   => 'Salvo software instalado por usuarios, el release debe ser el mismo proceso que el despliegue a pruebas; solo cambia la configuración del entorno.'
    ],
    'm12' => [
        'texto'    => '¿Por qué los unit tests se ejecutan justo después de compilar y son rápidos?',
        'opciones' => [
            'a' => 'Porque no dependen de que la aplicación esté corriendo y no tocan sistema de archivos ni base de datos (si no, serían pruebas de componente)',
            'b' => 'Porque los ejecuta QA',
            'c' => 'Porque son pocos',
            'd' => 'Porque se ejecutan en producción'
        ],
        'correcta' => 'a',
        'porque'   => 'Se lanzan con frameworks tipo xUnit sobre los binarios.'
    ],
    'm13' => [
        'texto'    => 'Cuando el commit stage supera los cinco minutos…',
        'opciones' => [
            'a' => 'Se elimina la mitad de los tests',
            'b' => 'Se divide en suites que corren en paralelo (varias máquinas o una con mucha RAM y varias CPU) con un servidor de CI que soporte dividir el trabajo',
            'c' => 'Se ejecuta solo de noche',
            'd' => 'Se pasa a manual'
        ],
        'correcta' => 'b',
        'porque'   => 'Además, al crecer la app, los unit tests y las pruebas de componente van al commit stage.'
    ],
    'm14' => [
        'texto'    => 'En la fase de aceptación automatizada, ¿qué conviene hacer además de correr las pruebas?',
        'opciones' => [
            'a' => 'Nada más',
            'b' => 'Borrar los logs',
            'c' => 'Recoger los reportes del framework, guardar los logs de la aplicación y (con GUI) grabar la pantalla, p. ej. con Vnc2swf',
            'd' => 'Enviar un correo al cliente'
        ],
        'correcta' => 'c',
        'porque'   => 'Reutiliza el script de despliegue al entorno de pruebas; tras los smoke tests arranca el framework de aceptación.'
    ],
    'm15' => [
        'texto'    => '¿Cuándo empezar a probar parámetros no funcionales (capacidad, escalado)?',
        'opciones' => [
            'a' => 'Al final del proyecto',
            'b' => 'Solo si el cliente se queja',
            'c' => 'Desde el principio, para saber si se cumplirán los requisitos; al comienzo pueden correr junto con aceptación en una sola etapa y separarse después para saber cuál falló',
            'd' => 'Nunca'
        ],
        'correcta' => 'c',
        'porque'   => 'Un buen conjunto de pruebas de aceptación ayuda a encontrar condiciones de carrera, deadlocks y contención de recursos.'
    ],
    'm16' => [
        'texto'    => '¿Cuáles son las <b>dos extensiones comunes</b> a la evolución del pipeline citadas en el capítulo?',
        'opciones' => [
            'a' => 'Servidores y bases de datos',
            'b' => 'Componentes y ramas (branches)',
            'c' => 'Equipos y horarios',
            'd' => 'Lenguajes y frameworks'
        ],
        'correcta' => 'b',
        'porque'   => 'Componentes: capítulo 13 (mini pipeline por componente y uno de ensamblado). Ramas: capítulo 14.'
    ],
    'm17' => [
        'texto'    => 'Si una parte del proceso es manual, ¿qué recomienda el capítulo?',
        'opciones' => [
            'a' => 'Ignorarla',
            'b' => 'Crear un placeholder en el flujo y registrar cuándo empieza y cuándo termina para saber cuánto tiempo consume y si es un cuello de botella',
            'c' => 'Automatizarla antes de empezar',
            'd' => 'Eliminarla'
        ],
        'correcta' => 'b',
        'porque'   => 'Regla 1: el pipeline se implementa de forma incremental, no todo a la vez.'
    ],
    'm18' => [
        'texto'    => 'El pipeline como <b>fuente de datos</b> permite medir…',
        'opciones' => [
            'a' => 'El número de líneas escritas',
            'b' => 'El cycle time del commit al despliegue en producción y el tiempo en cada etapa, para atacar los cuellos de botella por prioridad',
            'c' => 'La satisfacción del equipo',
            'd' => 'El coste de las licencias'
        ],
        'correcta' => 'b',
        'porque'   => 'Regla 2: registrar cada inicio y fin de proceso y qué cambios exactos pasaron por cada etapa.'
    ],
    'm19' => [
        'texto'    => '¿Qué significa que el pipeline es un “sistema vivo”?',
        'opciones' => [
            'a' => 'Que se reinicia solo',
            'b' => 'Que hay que mejorarlo y refactorizarlo como las aplicaciones que entrega',
            'c' => 'Que no necesita mantenimiento',
            'd' => 'Que lo mantiene un solo experto'
        ],
        'correcta' => 'b',
        'porque'   => 'Regla 3.'
    ],
    'm20' => [
        'texto'    => '¿Qué son los <i>information radiators</i>?',
        'opciones' => [
            'a' => 'Un tipo de servidor',
            'b' => 'Un plugin de Jenkins',
            'c' => 'Una herramienta de refrigeración',
            'd' => 'Pósters o pantallas muy visibles que difunden de forma difícil de evitar los resultados de las mediciones'
        ],
        'correcta' => 'd',
        'porque'   => 'Mejorar el feedback = ciclos cortos y resultados visibles.'
    ],
    'm21' => [
        'texto'    => 'El <b>efecto Hawthorne</b> aplicado a métricas significa que…',
        'opciones' => [
            'a' => 'Las métricas no importan',
            'b' => 'Lo que eliges medir influye enormemente en el comportamiento del equipo (p. ej. medir líneas de código genera muchas líneas cortas; medir defectos corregidos genera bugs triviales)',
            'c' => 'Solo se debe medir de noche',
            'd' => 'Los equipos ignoran las métricas'
        ],
        'correcta' => 'b',
        'porque'   => 'Por eso hay que elegir con cuidado qué medir.'
    ],
    'm22' => [
        'texto'    => 'Según la filosofía lean, hay que optimizar…',
        'opciones' => [
            'a' => 'Localmente cada etapa',
            'b' => 'Solo el desarrollo',
            'c' => 'Solo las pruebas',
            'd' => 'De forma global, no local; si se elimina un cuello de botella que no es el que limita la entrega, no se mejora nada'
        ],
        'correcta' => 'd',
        'porque'   => 'Se necesita una métrica global para saber si el proceso completo tiene un problema.'
    ],
    'm23' => [
        'texto'    => '¿Cuál es la métrica global más importante en la entrega de software y qué mide?',
        'opciones' => [
            'a' => 'Velocity: puntos por sprint',
            'b' => 'Cycle time: tiempo entre decidir que una funcionalidad debe implementarse y tenerla liberada a los usuarios',
            'c' => 'Número de defectos: bugs abiertos',
            'd' => 'Cobertura: porcentaje de líneas probadas'
        ],
        'correcta' => 'b',
        'porque'   => 'Es difícil de medir porque abarca análisis, desarrollo y release, pero dice más del proceso que cualquier otra métrica.'
    ],
    'm24' => [
        'texto'    => '¿Qué pregunta plantea Mary Poppendieck?',
        'opciones' => [
            'a' => '¿Cuántos devs tiene el equipo?',
            'b' => '¿Cuánto tardaría tu organización en desplegar un cambio de una única línea de código, de forma repetible y fiable?',
            'c' => '¿Cuál es tu cobertura?',
            'd' => '¿Cuántos servidores tienes?'
        ],
        'correcta' => 'b',
        'porque'   => 'Ilustra el concepto de cycle time.'
    ],
    'm25' => [
        'texto'    => '¿Por qué el número de defectos es una medida <b>secundaria</b>?',
        'opciones' => [
            'a' => 'Porque no se puede medir',
            'b' => 'Porque no importa la calidad',
            'c' => 'Porque si se descubre un defecto pero se tarda seis meses en liberar el arreglo, saberlo no sirve de mucho; reducir el cycle time fomenta prácticas que elevan la calidad',
            'd' => 'Porque los testers no lo reportan'
        ],
        'correcta' => 'c',
        'porque'   => 'Reducir el cycle time fomenta, por ejemplo, la suite automatizada tras cada check-in.'
    ],
    'm26' => [
        'texto'    => 'Cinco pasos de la Teoría de las Restricciones, en orden:',
        'opciones' => [
            'a' => 'Identificar → Explotar → Subordinar → Elevar → Repetir',
            'b' => 'Explotar → Identificar → Elevar → Subordinar → Repetir',
            'c' => 'Identificar → Elevar → Explotar → Subordinar → Repetir',
            'd' => 'Subordinar → Identificar → Explotar → Repetir → Elevar'
        ],
        'correcta' => 'a',
        'porque'   => 'Ejemplo del libro: la restricción son las pruebas manuales; se garantiza un buffer de historias, los devs trabajan lo justo para mantener el backlog y dedican el resto a pruebas automatizadas; si no basta, más testers o más automatización.'
    ],
    'm27' => [
        'texto'    => '¿Cuál de estos <b>NO</b> figura entre los otros diagnósticos citados?',
        'opciones' => [
            'a' => 'Cobertura de pruebas automatizadas',
            'b' => 'Número de commits por día',
            'c' => 'Duración del build, incluidas las pruebas',
            'd' => 'Número de líneas de comentarios por desarrollador'
        ],
        'correcta' => 'd',
        'porque'   => 'Sí figuran: velocity, número de builds y de fallos de build por día, propiedades del código (duplicación, complejidad ciclomática, acoplamiento eferente/aferente, estilo) y número de defectos.'
    ],
    'm28' => [
        'texto'    => '¿Qué es <i>Panopticode</i>?',
        'opciones' => [
            'a' => 'Un servidor de CI',
            'b' => 'Un proyecto de Julias Shaw que ejecuta reportes sobre código Java y produce visualizaciones densas (p. ej. tree map de complejidad ciclomática) para ver de un vistazo si hay un problema y dónde',
            'c' => 'Un framework de pruebas de aceptación',
            'd' => 'Un sistema de tickets'
        ],
        'correcta' => 'b',
        'porque'   => 'La clave es usar visualizaciones que aprovechen la capacidad de reconocimiento de patrones del cerebro.'
    ],
    'm29' => [
        'texto'    => '¿Cómo deben tratarse los reportes de cada check-in a nivel organizacional?',
        'opciones' => [
            'a' => 'Se descartan',
            'b' => 'Se envían por correo',
            'c' => 'Cada CI los genera y guarda en el repositorio de artefactos; se reúnen en una base de datos, se publican en un sitio interno (página por proyecto) y se agregan para monitorizar todos los proyectos o la organización',
            'd' => 'Solo los ve el jefe técnico'
        ],
        'correcta' => 'c',
        'porque'   => 'Los program managers suelen querer una única métrica de salud en forma de semáforo (rojo/ámbar/verde).'
    ],
    'm30' => [
        'texto'    => '¿Cuál es el propósito del pipeline según el resumen del capítulo?',
        'opciones' => [
            'a' => 'Reemplazar al control de versiones',
            'b' => 'Dar a todos los involucrados visibilidad del progreso de los builds del check-in al release',
            'c' => 'Sustituir a los testers',
            'd' => 'Reducir el número de entornos'
        ],
        'correcta' => 'b',
        'porque'   => 'Debe verse qué cambios rompieron la app y cuáles dieron candidatos aptos para pruebas manuales o release; con despliegues de un botón.'
    ],
    'm31' => [
        'texto'    => 'El pipeline depende de tres cimientos:',
        'opciones' => [
            'a' => 'Buena gestión de configuración, scripts automatizados de build y despliegue, y pruebas automatizadas que demuestren que la app aporta valor (más disciplina)',
            'b' => 'Muchos servidores, mucha memoria y mucho tiempo',
            'c' => 'Cloud, contenedores y microservicios',
            'd' => 'Documentación, reuniones y aprobaciones'
        ],
        'correcta' => 'a',
        'porque'   => 'La disciplina: solo se liberan cambios que han pasado por el sistema automatizado. Se ve en el capítulo 15 con un modelo de madurez.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Farley cap. 5 · 5 — Implementar el pipeline y métricas', 'Continuous Delivery, cap. 5: value stream y walking skeleton, automatización paso a paso, evolución, cycle time, Theory of Constraints, radiadores y resumen');
?>


<div class="card">
  <h2>1. Implementar un pipeline de despliegue: visión general</h2>
  <ul>
    <li>Tanto en un proyecto nuevo como en uno existente, se recomienda un enfoque <?php hueco(1, 15); ?> para implementar el pipeline.</li>
    <li>Los cinco pasos, en orden: (1) modelar el <?php hueco(2, 16); ?> y crear un <?php hueco(3, 20); ?>; (2) automatizar el <?php hueco(4, 22); ?>; (3) automatizar las <?php hueco(5, 21); ?> y el <?php hueco(6, 22); ?>; (4) automatizar las pruebas de <?php hueco(7, 14); ?>; (5) automatizar los <?php hueco(8, 12); ?>.</li>
  </ul>
  <h3>Paso 1: value stream y walking skeleton</h3>
  <ul>
    <li>El primer paso es mapear la parte del value stream que va del <?php hueco(9, 12); ?> al <?php hueco(10, 11); ?>. Si el proyecto ya funciona, se hace en unos <?php hueco(11, 14); ?> con <?php hueco(12, 17); ?>, hablando con <?php hueco(13, 26); ?> y anotando los pasos, con estimaciones del tiempo <?php hueco(14, 16); ?> (<i>elapsed time</i>) y del tiempo de <?php hueco(15, 18); ?> (<i>value-added time</i>).</li>
    <li>En un proyecto nuevo: mirar otro proyecto de la organización con características similares o empezar con lo <b>mínimo</b>: una etapa de <?php hueco(16, 10); ?> (compila, métricas básicas y unit tests), una etapa de pruebas de <?php hueco(17, 14); ?> y una tercera de <?php hueco(18, 14); ?> en un entorno <?php hueco(19, 19); ?> para hacer <?php hueco(20, 9); ?>.</li>
    <li>Con el mapa, se modela el proceso en la herramienta de CI / gestión de releases. Si no permite modelar el value stream directamente, se simula con <?php hueco(21, 16); ?> entre proyectos; al principio cada proyecto no hace nada: son <?php hueco(22, 16); ?> que se disparan en orden.</li>
    <li>En el ejemplo mínimo: el commit stage corre <?php hueco(23, 20); ?>; la etapa de aceptación se dispara <?php hueco(24, 19); ?> cuando pasa el commit, con el mismo <?php hueco(25, 11); ?> creado en el commit; las etapas que despliegan a un entorno production-like exigen <?php hueco(26, 19); ?> para elegir la versión, y esto suele requerir <?php hueco(27, 16); ?>.</li>
    <li>Luego los placeholders hacen algo real. En un proyecto avanzado, se conectan los scripts de build, test y deploy existentes. Si no, el objetivo es un <i>walking skeleton</i>: hacer la <?php hueco(28, 38); ?> para poner todos los elementos clave.</li>
    <li>Orden: primero el <?php hueco(29, 16); ?> (si no hay código: un “<?php hueco(30, 15); ?>” o una página HTML y un único unit test que <?php hueco(31, 15); ?>); luego el <?php hueco(32, 14); ?> (p. ej. un directorio virtual en <?php hueco(33, 7); ?>); por último la prueba de <?php hueco(34, 14); ?>, porque necesita la aplicación <?php hueco(35, 14); ?>. Se puede usar <?php hueco(36, 13); ?> o <?php hueco(37, 8); ?> para verificar que la página contiene “Hello world”.</li>
    <li>En un proyecto nuevo todo esto se hace <b>antes</b> de empezar el desarrollo: en la <?php hueco(38, 18); ?> si se usa un proceso iterativo. Administradores de sistemas u <?php hueco(39, 15); ?> deben participar montando el entorno production-like para las demos y desarrollando los scripts de despliegue.</li>
  </ul>
    <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php mc('m3'); ?>
  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
    <?php enviar(); ?>
</div>

<div class="card">
  <h2>2. Pasos 2, 3 y 4: build/despliegue, tests y aceptación</h2>
  <h3>Automatizar el build y el despliegue</h3>
  <ul>
    <li>El proceso de build toma <?php hueco(40, 17); ?> como entrada y produce <?php hueco(41, 12); ?> como salida (palabra deliberadamente vaga). Característica clave: poder copiarlos a una máquina nueva y, con el entorno y la configuración correctos, arrancar la aplicación sin depender de que haya instalada ninguna parte de la <?php hueco(42, 40); ?>.</li>
    <li>El build se ejecuta en <?php hueco(43, 17); ?> mediante el servidor de <?php hueco(44, 24); ?>: vigila el control de versiones, hace <?php hueco(45, 12); ?> del código en cada cambio, corre el build automatizado y almacena los binarios en el <?php hueco(46, 23); ?>, accesibles a todo el equipo desde la <?php hueco(47, 23); ?> del servidor de CI.</li>
    <li>Luego se automatiza el despliegue: primero una <?php hueco(48, 11); ?> donde desplegar (en un proyecto nuevo puede ser la del propio servidor de CI). Este entorno se llama <?php hueco(49, 11); ?> o <?php hueco(50, 7); ?>; debe ser algo production-like y su aprovisionamiento y mantenimiento <?php hueco(51, 30); ?> (capítulos <?php hueco(52, 6); ?> y <?php hueco(53, 6); ?>).</li>
    <li>El despliegue puede implicar primero <?php hueco(54, 14); ?> la aplicación (quizá en varios paquetes si se instala en máquinas distintas); después <?php hueco(55, 25); ?> automáticamente; y finalmente una prueba automatizada de <?php hueco(56, 14); ?> (<i>deployment test</i>) que verifique que se desplegó con éxito. Debe ser fiable porque es prerrequisito de las pruebas de <?php hueco(57, 14); ?>.</li>
    <li>Después, despliegues de <b>un botón</b> a UAT: elegir cualquier <?php hueco(58, 9); ?>, y el clic dispara el proceso que toma sus <?php hueco(59, 12); ?>, corre el script de <?php hueco(60, 14); ?> y corre el <?php hueco(61, 22); ?>.</li>
    <li>Principios a respetar: construir los binarios <?php hueco(62, 16); ?> y separar la <?php hueco(63, 17); ?> de los binarios, para usar los mismos en todos los entornos. Salvo software instalado por usuarios, el proceso de release debe ser el <?php hueco(64, 9); ?> que el de despliegue a un entorno de pruebas; la única diferencia técnica es la <?php hueco(65, 29); ?>.</li>
  </ul>
  <h3>Automatizar unit tests y análisis de código</h3>
  <ul>
    <li>Implica un commit stage completo: unit tests, <?php hueco(66, 22); ?> y finalmente una selección de pruebas de <?php hueco(67, 14); ?> e <?php hueco(68, 15); ?> en cada check-in.</li>
    <li>Los unit tests no necesitan configuración compleja porque por definición no dependen de que la aplicación esté <?php hueco(69, 13); ?>: los ejecutan frameworks tipo <?php hueco(70, 9); ?> sobre los binarios. Al no tocar el <?php hueco(71, 23); ?> ni la <?php hueco(72, 17); ?> (si no, serían pruebas de <?php hueco(73, 14); ?>) son <?php hueco(74, 11); ?>, y por eso se ejecutan justo tras <?php hueco(75, 27); ?>.</li>
    <li>Análisis estático: estilo de código, <?php hueco(76, 13); ?> de código, complejidad <?php hueco(77, 15); ?>, <?php hueco(78, 16); ?>, etc. Al crecer la aplicación, los unit tests y las pruebas de <?php hueco(79, 14); ?> van al commit stage; al superar los <?php hueco(80, 17); ?>, se divide en suites que corren en <?php hueco(81, 12); ?> (varias máquinas o una con mucha <?php hueco(82, 7); ?> y varias <?php hueco(83, 7); ?>, y un servidor de CI que soporte dividir el trabajo).</li>
  </ul>
  <h3>Automatizar las pruebas de aceptación</h3>
  <ul>
    <li>Esta fase reutiliza el script con el que se despliega al entorno de pruebas; la diferencia es que tras los <?php hueco(84, 15); ?> se arranca el framework de pruebas de aceptación, y los <?php hueco(85, 12); ?> generados se recogen al final. Conviene guardar también los <?php hueco(86, 8); ?> de la aplicación. Con GUI, se puede usar <?php hueco(87, 11); ?> para grabar la <?php hueco(88, 12); ?> durante las pruebas y ayudar a depurar.</li>
    <li>Las pruebas de aceptación son de dos tipos: <?php hueco(89, 15); ?> y <?php hueco(90, 18); ?>. Hay que probar parámetros no funcionales como <?php hueco(91, 13); ?> y características de <?php hueco(92, 12); ?> <b>desde el principio</b>. Al empezar, se pueden correr aceptación y rendimiento <?php hueco(93, 12); ?> en una única etapa, y luego separarlas para saber cuál falló.</li>
    <li>Un buen conjunto ayuda a encontrar problemas intermitentes y difíciles de reproducir: <?php hueco(94, 26); ?>, <?php hueco(95, 13); ?> y <?php hueco(96, 26); ?>, mucho más difíciles de descubrir tras el release.</li>
    <li>Las variedades de pruebas dependen de la estrategia de pruebas (capítulo <?php hueco(97, 6); ?>); conviene tener <b>una o dos de cada tipo</b> <?php hueco(98, 10); ?> en el pipeline, así hay un framework que facilita <?php hueco(99, 19); ?> a medida que el proyecto crece.</li>
  </ul>
    <?php mc('m7'); ?>
  <?php mc('m8'); ?>
  <?php mc('m9'); ?>
  <?php mc('m10'); ?>
  <?php mc('m11'); ?>
  <?php mc('m12'); ?>
  <?php mc('m13'); ?>
  <?php mc('m14'); ?>
    <?php enviar(); ?>
</div>

<div class="card">
  <h2>3. Evolucionar el pipeline</h2>
  <ul>
    <li>Los pasos anteriores están en casi todo value stream; son los primeros candidatos a automatizar. Al complicarse el proyecto, el value stream evoluciona; dos extensiones comunes: <?php hueco(100, 15); ?> y <?php hueco(101, 9); ?>.</li>
    <li>Las aplicaciones grandes se construyen mejor como un conjunto de componentes: puede tener sentido un <?php hueco(102, 17); ?> por componente y luego un pipeline que <?php hueco(103, 12); ?> todos y pase la aplicación completa por aceptación, pruebas no funcionales y despliegue a testing, staging y producción (capítulo <?php hueco(104, 6); ?>). Las ramas se tratan en el capítulo <?php hueco(105, 6); ?>.</li>
    <li>El pipeline modela el proceso de construir, desplegar, probar y liberar; y asegura que cada <?php hueco(106, 10); ?> pueda pasar por él de forma <?php hueco(107, 17); ?> y lo más <?php hueco(108, 16); ?> posible.</li>
    <li>Hay tres cosas que recordar: <b>(1)</b> no hace falta implementarlo todo <?php hueco(109, 14); ?>: se implementa de forma <?php hueco(110, 15); ?>; para una parte manual se crea un <?php hueco(111, 15); ?> y se registra cuándo <?php hueco(112, 11); ?> y cuándo <?php hueco(113, 11); ?> el proceso manual, para ver cuánto tiempo consume y estimar si es un <?php hueco(114, 21); ?>.</li>
    <li><b>(2)</b> El pipeline es una rica fuente de <?php hueco(115, 9); ?> sobre la eficiencia del proceso: registra cada inicio y fin de proceso y qué cambios exactos pasaron por cada etapa; así se mide el <?php hueco(116, 14); ?> desde el commit hasta el despliegue en producción, y el tiempo en cada etapa, para atacar los cuellos de botella <?php hueco(117, 26); ?>.</li>
    <li><b>(3)</b> El pipeline es un sistema <?php hueco(118, 8); ?>: se debe <?php hueco(119, 26); ?> igual que las aplicaciones que entrega.</li>
  </ul>
    <?php mc('m15'); ?>
  <?php mc('m16'); ?>
  <?php mc('m17'); ?>
  <?php mc('m18'); ?>
    <?php enviar(); ?>
</div>

<div class="card">
  <h2>4. Métricas</h2>
  <ul>
    <li>El <?php hueco(120, 12); ?> está en el corazón de cualquier proceso de entrega. La mejor forma de mejorarlo es hacer los ciclos de feedback <?php hueco(121, 10); ?> y los resultados <?php hueco(122, 12); ?>. Se debe medir continuamente y difundir los resultados de forma difícil de evitar (un póster o una pantalla dedicada): son los <i><?php hueco(123, 25); ?></i>.</li>
    <li>Lo que se mide influye enormemente en el comportamiento del equipo (<b>efecto <?php hueco(124, 13); ?></b>). Ejemplos: si se mide las líneas de código, los devs escribirán muchas líneas <?php hueco(125, 10); ?>; si se mide el número de defectos corregidos, los testers registrarán bugs que se resolverían con una <?php hueco(126, 22); ?> con un desarrollador.</li>
    <li>Según la filosofía <?php hueco(127, 8); ?>, hay que optimizar de forma <?php hueco(128, 10); ?>, no <?php hueco(129, 9); ?>. Si se gasta mucho en eliminar un cuello de botella que no es el que limita la entrega, <?php hueco(130, 23); ?>. Se necesita una métrica <?php hueco(131, 10); ?> para saber si el proceso completo tiene un problema.</li>
    <li>La métrica global más importante es el <b><?php hueco(132, 14); ?></b>: el tiempo entre <?php hueco(133, 40); ?> y tener esa funcionalidad <?php hueco(134, 27); ?>.</li>
    <li>Pregunta de Mary <?php hueco(135, 15); ?>: “¿Cuánto tardaría su organización en desplegar un cambio que implica una única línea de código? ¿Lo hace de forma <?php hueco(136, 13); ?> y <?php hueco(137, 10); ?>?” Es difícil de medir porque abarca <?php hueco(138, 12); ?>, desarrollo y release, pero dice más del proceso que cualquier otra métrica.</li>
    <li>Muchos proyectos eligen como métrica principal el número de <?php hueco(139, 12); ?>, pero es una medida <?php hueco(140, 14); ?>: si se descubre un defecto y se tarda <?php hueco(141, 14); ?> en liberar el arreglo, saber que existe no sirve de mucho. Reducir el cycle time fomenta las prácticas que aumentan la <?php hueco(142, 11); ?>, como una suite de pruebas automatizadas <?php hueco(143, 12); ?> tras cada check-in.</li>
    <li>Un pipeline bien implementado facilita calcular la parte del cycle time del <?php hueco(144, 12); ?> al <?php hueco(145, 11); ?> y el <?php hueco(146, 13); ?> desde el check-in hasta cada etapa, para descubrir los <?php hueco(147, 22); ?>.</li>
  </ul>
  <h3>Teoría de las restricciones (Theory of Constraints)</h3>
  <ol>
    <li><b><?php hueco(148, 15); ?></b> la restricción limitante del sistema: la parte del build/test/deploy/release que es el cuello de botella (p. ej. las pruebas <?php hueco(149, 12); ?>).</li>
    <li><b><?php hueco(150, 12); ?></b> la restricción: maximizar su <?php hueco(151, 14); ?>; p. ej. asegurar siempre un <?php hueco(152, 10); ?> de historias esperando pruebas manuales y que esos recursos no se usen para <?php hueco(153, 13); ?>.</li>
    <li><b><?php hueco(154, 14); ?></b> todos los demás procesos a la restricción: otros recursos no trabajan al <?php hueco(155, 9); ?>; los devs trabajan lo justo para mantener el <?php hueco(156, 11); ?> constante y dedican el resto a escribir pruebas <?php hueco(157, 17); ?> que detecten bugs.</li>
    <li><b><?php hueco(158, 10); ?></b> la restricción: si el cycle time sigue siendo largo, aumentar los recursos (contratar más <?php hueco(159, 11); ?> o invertir en pruebas automatizadas).</li>
    <li><b><?php hueco(160, 11); ?></b>: encontrar la siguiente restricción y volver al paso <?php hueco(161, 6); ?>.</li>
  </ol>
    <?php mc('m19'); ?>
  <?php mc('m20'); ?>
  <?php mc('m21'); ?>
  <?php mc('m22'); ?>
  <?php mc('m23'); ?>
  <?php mc('m24'); ?>
    <?php enviar(); ?>
</div>

<div class="card">
  <h2>5. Otros diagnósticos, visualización y resumen</h2>
  <ul>
    <li>Además del cycle time hay otros diagnósticos que alertan de problemas: <?php hueco(162, 38); ?>; propiedades del código (duplicación, complejidad <?php hueco(163, 15); ?>, acoplamiento <?php hueco(164, 12); ?> y <?php hueco(165, 12); ?>, problemas de <?php hueco(166, 10); ?>); número de <?php hueco(167, 12); ?>; la <?php hueco(168, 12); ?> (ritmo al que el equipo entrega código funcionando, probado y listo para usarse); número de <?php hueco(169, 11); ?> al control de versiones por día; número de <?php hueco(170, 10); ?> por día; número de <?php hueco(171, 19); ?> por día; y <?php hueco(172, 22); ?> incluyendo las pruebas automatizadas.</li>
    <li>Los reportes producen mucha información y su interpretación es un arte. Los <i>program managers</i> esperan una única métrica de “salud” en forma de <?php hueco(173, 12); ?> (<?php hueco(174, 8); ?>, <?php hueco(175, 9); ?> o <?php hueco(176, 9); ?>). El líder técnico quiere más detalle pero no páginas y páginas de reportes.</li>
    <li>Julias Shaw creó <?php hueco(177, 15); ?>, que ejecuta reportes sobre código <?php hueco(178, 8); ?> y genera visualizaciones densas (p. ej. un <i>tree map</i> de complejidad ciclomática, Figura 5.8) que permiten ver de un vistazo si hay un problema y dónde. La clave: visualizaciones que agreguen los datos para que el cerebro use su capacidad de <?php hueco(179, 30); ?>.</li>
    <li>El servidor de CI de cada equipo genera estos reportes en cada <?php hueco(180, 12); ?> y los guarda en el <?php hueco(181, 29); ?>; se <?php hueco(182, 13); ?> en una <?php hueco(183, 17); ?>, se siguen en todos los equipos, se publican en un sitio web <?php hueco(184, 11); ?> (una página por <?php hueco(185, 12); ?>) y se agregan para monitorizarlos en todos los proyectos o toda la organización.</li>
  </ul>
  <h3>Resumen del capítulo</h3>
  <ul>
    <li>El propósito del pipeline es dar a todos los involucrados <?php hueco(186, 15); ?> del progreso de los builds del check-in al release: ver qué cambios <?php hueco(187, 13); ?> la aplicación y cuáles dieron candidatos aptos para pruebas manuales o release. Debe permitir despliegues de <?php hueco(188, 12); ?> a entornos de pruebas manuales y ver qué release candidates hay en ellos. Liberar una versión también debe ser una tarea de un botón, con pleno conocimiento de que el candidato pasó todo el pipeline, con una batería de pruebas automatizadas y manuales en un entorno <?php hueco(189, 19); ?>.</li>
    <li>Con un pipeline las <?php hueco(190, 17); ?> se hacen evidentes; se obtienen datos como cuánto tarda un candidato en pasar las etapas de pruebas manuales, el cycle time <?php hueco(191, 12); ?> del check-in al release y cuántos <?php hueco(192, 12); ?> se descubren en qué etapas.</li>
    <li>No hay una solución única. Lo crucial es crear un <?php hueco(193, 23); ?> que gestione cada cambio del check-in al release, con la información para descubrir problemas <?php hueco(194, 20); ?>. Puede usarse para acelerar el feedback: más pruebas de aceptación y más <?php hueco(195, 18); ?>, entornos más production-like o mejor gestión de <?php hueco(196, 17); ?>.</li>
    <li>Un pipeline depende de tres cimientos: buena gestión de <?php hueco(197, 17); ?>, scripts automatizados de <?php hueco(198, 22); ?> y pruebas <?php hueco(199, 17); ?> que demuestren que la aplicación aporta valor. También requiere <?php hueco(200, 14); ?>: que solo se liberen cambios que pasaron por el sistema automatizado. Se discute en el capítulo <?php hueco(201, 6); ?> (<i>Managing Continuous Delivery</i>), que incluye un <?php hueco(202, 21); ?>.</li>
  </ul>
    <?php mc('m25'); ?>
  <?php mc('m26'); ?>
  <?php mc('m27'); ?>
  <?php mc('m28'); ?>
  <?php mc('m29'); ?>
  <?php mc('m30'); ?>
  <?php mc('m31'); ?>
    <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('cuarto.php', '../Menu.php');
