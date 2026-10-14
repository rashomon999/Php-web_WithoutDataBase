<?php
/* ==========================================================================
   IngeSoft5 / DevOps2 / Farley cap. 5 — bloque 04: Etapas de prueba posteriores, preparación del release,
   automatización, back-out y building on success.
   Fuente: Continuous Delivery (Humble & Farley) — Chapter 5
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    1 => ['equipo de desarrollo', 'equipo de dev', 'los desarrolladores'],
    2 => ['release a usuarios', 'liberarse a usuarios', 'ser liberado a los usuarios', 'liberacion a usuarios'],
    3 => ['ser liberado', 'liberarse', 'release', 'su liberacion'],
    4 => ['automatica'],
    5 => ['promueven automaticamente', 'promocionan automaticamente', 'promueven'],
    6 => ['continuous deployment', 'despliegue continuo'],
    7 => ['fitz'],
    8 => ['manuales'],
    9 => ['capacidad'],
    10 => ['exploratorias'],
    11 => ['staging'],
    12 => ['produccion'],
    13 => ['production-like', 'similar a produccion', 'parecido a produccion'],
    14 => ['configuracion'],
    15 => ['anthill pro', 'anthill'],
    16 => ['go'],
    17 => ['un boton', 'pushbutton', 'un solo clic', 'boton'],
    18 => ['scripts de despliegue', 'scripts de deployment'],
    19 => ['hudson'],
    20 => ['cruisecontrol'],
    21 => ['aceptacion', 'pruebas de aceptacion'],
    22 => ['version de tu eleccion', 'version que elijas', 'version elegida', 'version deseada'],
    23 => ['entorno de tu eleccion', 'entorno que elijas', 'entorno elegido', 'entorno deseado'],
    24 => ['version del control de versiones', 'revision del control de versiones', 'version en el control de versiones'],
    25 => ['secuencia', 'serie', 'cadena'],
    26 => ['paralelo'],
    27 => ['opcionales', 'opcionales seleccionadas manualmente'],
    28 => ['nightly build', 'build nocturno', 'build de la noche'],
    29 => ['arbitraria'],
    30 => ['cambios'],
    31 => ['eligen', 'escogen'],
    32 => ['redespliegan otro', 'redesplegar otro', 'despliegan otro', 'redesplegar cualquier otro'],
    33 => ['exploratorias', 'exploratory testing'],
    34 => ['usabilidad', 'usability testing'],
    35 => ['showcases', 'demos', 'demostraciones'],
    36 => ['automatizadas', 'automaticas'],
    37 => ['regresion', 'regression'],
    38 => ['validan genuinamente el comportamiento', 'validan realmente el comportamiento', 'validan de verdad el comportamiento', 'validan el comportamiento del sistema'],
    39 => ['criterios de aceptacion'],
    40 => ['usabilidad'],
    41 => ['look and feel', 'aspecto y comportamiento', 'aspecto visual'],
    42 => ['patologicas de peor caso', 'patologicas', 'de peor caso', 'patologicas del peor caso'],
    43 => ['maquinas humanas de ejecucion de scripts de prueba', 'maquinas humanas de ejecucion de scripts', 'ejecutores humanos de scripts de prueba', 'maquinas de ejecucion de scripts de prueba'],
    44 => ['capacidad'],
    45 => ['seguridad'],
    46 => ['sla', 'acuerdos de nivel de servicio', 'service-level agreements'],
    47 => ['9'],
    48 => ['etapa', 'stage'],
    49 => ['compuerta', 'gate', 'puerta'],
    50 => ['informe la decision humana', 'informe la decision de un humano', 'informe la decision', 'informe una decision humana', 'sirva de informacion'],
    51 => ['no se considera desplegable', 'no es desplegable', 'no se despliega'],
    52 => ['subjetivo'],
    53 => ['humano', 'ser humano', 'persona'],
    54 => ['riesgo de negocio', 'riesgo para el negocio', 'riesgo'],
    55 => ['nuevas capacidades valiosas', 'capacidades valiosas', 'nuevas capacidades'],
    56 => ['back-out', 'retroceso', 'marcha atras', 'rollback'],
    57 => ['recursos criticos', 'recursos criticos para la mision', 'recursos vitales'],
    58 => ['dar de baja', 'desmantelar', 'desactivar', 'retirar'],
    59 => ['todos los involucrados', 'todos los que participan', 'todos'],
    60 => ['automatizando', 'automatizar'],
    61 => ['propensas a errores', 'propensas a error', 'proclives a errores', 'con mas errores'],
    62 => ['ensayar', 'ensayar el procedimiento', 'rehearse'],
    63 => ['production-like', 'similares a produccion', 'parecidos a produccion'],
    64 => ['deshacer', 'hacer back-out', 'retroceder', 'revertir'],
    65 => ['configuracion y datos de produccion', 'la configuracion y los datos de produccion', 'configuracion y datos'],
    66 => ['rollback', 'retroceso'],
    67 => ['version', 'version de la aplicacion'],
    68 => ['pulsar un boton', 'presionar un boton', 'apretar un boton', 'un boton'],
    69 => ['igual de simple', 'igual de facil', 'tan simple'],
    70 => ['10'],
    71 => ['comportamientos inesperados', 'comportamiento inesperado', 'sorpresas'],
    72 => ['cada bit', 'cada uno de los bits', 'todo lo que se despliega'],
    73 => ['muestra representativa', 'muestra'],
    74 => ['paralelo'],
    75 => ['minando', 'analizando', 'explotando'],
    76 => ['contrario', 'opuesto', 'inverso'],
    77 => ['control insuficiente', 'falta de control', 'insuficiente control'],
    78 => ['completamente bloqueados', 'totalmente bloqueados', 'bloqueados'],
    79 => ['procesos automatizados', 'procesos automaticos', 'automatizacion'],
    80 => ['configuracion'],
    81 => ['software'],
    82 => ['topologia de red', 'topologia de la red', 'red'],
    83 => ['estado'],
    84 => ['auditar'],
    85 => ['diagnosticar'],
    86 => ['repararlos en un tiempo predecible', 'reparar en un tiempo predecible', 'reparar en tiempo predecible', 'reparar'],
    87 => ['11'],
    88 => ['feedback', 'resultado', 'resultados'],
    89 => ['capacidad'],
    90 => ['middleware'],
    91 => ['linea base de configuracion', 'linea base', 'baseline de configuracion', 'baseline'],
    92 => ['aprovisionamiento automatizado', 'provisionamiento automatizado', 'aprovisionamiento automatico'],
    93 => ['gestion de configuracion'],
    94 => ['virtualizacion'],
    95 => ['6'],
    96 => ['tickets'],
    97 => ['email', 'correo', 'correos'],
    98 => ['expertos tecnicos', 'expertos'],
    99 => ['comparar', 'comparar comportamientos', 'comparar su comportamiento'],
    100 => ['vendedores', 'comerciales', 'equipo de ventas', 'gente de ventas'],
    101 => ['relajarse', 'relajarse un poco'],
    102 => ['menos riesgoso', 'menos arriesgado', 'de menor riesgo'],
    103 => ['lo es', 'es menos riesgoso', 'realmente lo es'],
    104 => ['mismo proceso', 'mismo'],
    105 => ['muchas veces al dia', 'varias veces al dia', 'muy frecuentemente'],
    106 => ['100', 'cien', 'centesima'],
    107 => ['gran evento', 'evento', 'acontecimiento'],
    108 => ['tiempo'],
    109 => ['ceremonia'],
    110 => ['lo mas cerca posible de donde se introdujeron', 'lo mas cerca posible del punto donde se introdujeron', 'cerca de su origen', 'tan cerca como sea posible de su origen'],
    111 => ['varias veces al dia', 'varias veces por dia'],
    112 => ['defectos criticos', 'defectos criticos o agujeros de seguridad', 'vulnerabilidades'],
    113 => ['desarrollo de producto', 'producto'],
    114 => ['rapida y fiablemente', 'rapido y de forma fiable', 'rapida y confiablemente', 'rapido y confiable', 'de forma rapida y fiable'],
    115 => ['error dificil de detectar', 'error'],
    116 => ['manuales'],
    117 => ['instrucciones'],
    118 => ['comprometido', 'atrapado', 'sin salida'],
    119 => ['ingenioso', 'listo', 'habil', 'inteligente'],
    120 => ['ensayando el release muchas veces al dia', 'ensayando el release', 'ensayando'],
    121 => ['back-out', 'retroceso', 'marcha atras', 'rollback'],
    122 => ['version anterior', 'version previa'],
    123 => ['directorio', 'directorio propio', 'carpeta'],
    124 => ['symlink', 'enlace simbolico', 'enlace'],
    125 => ['datos de produccion', 'datos'],
    126 => ['12'],
    127 => ['redesplegar desde cero', 'redesplegar desde cero la version anterior', 'volver a desplegar desde cero'],
    128 => ['ideal', 'objetivo'],
    129 => ['proceso distinto', 'proceso diferente'],
    130 => ['incrementales'],
    131 => ['rara vez', 'poco', 'casi nunca'],
    132 => ['conocida como buena', 'buena conocida', 'conocida buena', 'known-good'],
    133 => ['fragiles', 'quebradizos', 'fragil'],
    134 => ['manteniendo una version antigua desplegada', 'manteniendo la version antigua desplegada', 'manteniendo una version anterior desplegada'],
    135 => ['redesplegando por completo', 'redesplegando completamente', 'redesplegar por completo', 'redesplegando totalmente'],
    136 => ['compila', 'puede compilarse', 'se compila'],
    137 => ['unitarias', 'unitarias (unit tests)'],
    138 => ['aceptacion'],
    139 => ['analogo de produccion', 'entorno analogo a produccion', 'entorno similar a produccion'],
    140 => ['desplegable'],
    141 => ['desarrollo'],
    142 => ['aceptacion'],
    143 => ['pruebas', 'testing', 'prueba'],
    144 => ['intervencion manual'],
    145 => ['lo antes posible', 'lo mas rapido posible', 'tan pronto como sea posible', 'lo mas pronto posible'],
];

$TEXTO = [];
for ($i = 1; $i <= 145; $i++) $TEXTO[] = $i;

$MULTIPLE = [
    'm1' => [
        'texto'    => 'La etapa de aceptación es un hito significativo porque…',
        'opciones' => [
            'a' => 'Es la última etapa del pipeline y termina el proceso',
            'b' => 'Tras ella el candidato deja de ser dominio casi exclusivo del equipo de desarrollo y pasa a ser de interés y uso más amplio',
            'c' => 'Solo la usan los testers',
            'd' => 'Reemplaza a la etapa de commit'
        ],
        'correcta' => 'b',
        'porque'   => 'Además, en los pipelines más simples un build que la pasa está listo para liberarse (en lo automatizado); si falla, por definición no es apto para release.'
    ],
    'm2' => [
        'texto'    => '¿Qué es el <i>Continuous Deployment</i> citado en el capítulo (Timothy Fitz)?',
        'opciones' => [
            'a' => 'Un despliegue manual mensual',
            'b' => 'Una herramienta de CruiseControl',
            'c' => 'Que los candidatos exitosos se promuevan automáticamente hasta un despliegue automático en producción',
            'd' => 'Un entorno de pruebas exploratorias'
        ],
        'correcta' => 'c',
        'porque'   => 'Es posible si se entrega de forma incremental; pero para muchos sistemas sigue siendo deseable alguna forma de prueba manual antes del release.'
    ],
    'm3' => [
        'texto'    => '¿Cuáles son los <b>requisitos clave</b> de un sistema propio de despliegue sobre el pipeline?',
        'opciones' => [
            'a' => 'Solo un servidor de correo',
            'b' => 'Ver los candidatos que pasaron aceptación, un botón para desplegar la versión elegida en el entorno elegido, y ver qué candidato hay en cada entorno y de qué versión del control de versiones vino',
            'c' => 'Un formulario de tickets',
            'd' => 'Un repositorio de binarios sin más'
        ],
        'correcta' => 'b',
        'porque'   => 'La Figura 5.7 muestra un sistema casero que cumple estas tres funciones.'
    ],
    'm4' => [
        'texto'    => 'Los despliegues a distintos entornos (UAT, staging, producción) pueden ser…',
        'opciones' => [
            'a' => 'Únicamente en secuencia',
            'b' => 'Únicamente en paralelo',
            'c' => 'Solo manuales, nunca automáticos',
            'd' => 'En secuencia (cada uno depende del éxito del anterior), en paralelo, o etapas opcionales que se seleccionan a mano'
        ],
        'correcta' => 'd',
        'porque'   => 'Ejemplo de secuencia: solo se puede desplegar a producción una vez desplegado en UAT y staging.'
    ],
    'm5' => [
        'texto'    => '¿Qué concepto reemplaza el pipeline al permitir que los testers desplieguen cualquier build a demanda?',
        'opciones' => [
            'a' => 'El release candidate',
            'b' => 'El <i>nightly build</i> (build de una revisión arbitraria: el último commit antes de irse a casa)',
            'c' => 'El commit stage',
            'd' => 'El acceptance test gate'
        ],
        'correcta' => 'b',
        'porque'   => 'Ahora los testers ven qué builds pasaron las pruebas automáticas, qué cambios se hicieron, eligen uno y, si no sirve, redespliegan otro.'
    ],
    'm6' => [
        'texto'    => '¿Cuál debe ser el rol principal del tester tras la aceptación automatizada?',
        'opciones' => [
            'a' => 'Repetir toda la regresión a mano',
            'b' => 'Ejecutar scripts de prueba manuales',
            'c' => 'Asegurar que las pruebas de aceptación validan genuinamente el comportamiento (probando a mano los criterios de aceptación) y luego hacer exploratorias, usabilidad y look and feel',
            'd' => 'Aprobar los despliegues sin probar'
        ],
        'correcta' => 'c',
        'porque'   => 'La automatización libera a los testers de ser “máquinas humanas de ejecución de scripts” para centrarse en actividades de alto valor.'
    ],
    'm7' => [
        'texto'    => '¿Cuál de estas <b>NO</b> es una actividad típica de la fase de pruebas manuales?',
        'opciones' => [
            'a' => 'Pruebas exploratorias',
            'b' => 'Pruebas de usabilidad',
            'c' => 'Regresión completa ejecutada a mano por testers',
            'd' => 'Pruebas patológicas de peor caso'
        ],
        'correcta' => 'c',
        'porque'   => 'Los testers no deben hacer regresión: eso ya lo cubren las pruebas automáticas.'
    ],
    'm8' => [
        'texto'    => 'Los sistemas de gestión de releases (AntHill Pro, Go) o los caseros basados en Hudson/CruiseControl, en el fondo…',
        'opciones' => [
            'a' => 'Sustituyen a los scripts de despliegue',
            'b' => 'Solo sirven para compilar',
            'c' => 'Ejecutan por detrás los scripts de despliegue que ya se escribieron, ofreciendo visibilidad de qué hay en cada entorno y despliegue con un botón',
            'd' => 'Solo sirven para gestionar tickets'
        ],
        'correcta' => 'c',
        'porque'   => 'Las herramientas comerciales aportan además visualizaciones, reportes y autorización granular de despliegues.'
    ],
    'm9' => [
        'texto'    => 'Sobre las pruebas de <b>requisitos no funcionales</b> en el pipeline:',
        'opciones' => [
            'a' => 'Nunca se automatizan',
            'b' => 'Se hacen siempre antes del commit',
            'c' => 'Se ven en el capítulo 9; no siempre hace falta hacerlas continuamente, pero cuando se requieren vale la pena crear una etapa del pipeline para ellas',
            'd' => 'Son solo funcionales'
        ],
        'correcta' => 'c',
        'porque'   => 'Ejemplos: capacidad, seguridad, SLAs.'
    ],
    'm10' => [
        'texto'    => '¿Cuándo tiene sentido que la prueba de capacidad sea una <b>compuerta</b> totalmente automática?',
        'opciones' => [
            'a' => 'En cualquier aplicación',
            'b' => 'En aplicaciones de muy alto rendimiento: si el candidato falla, normalmente no se considera desplegable',
            'c' => 'Nunca',
            'd' => 'Solo en aplicaciones de escritorio'
        ],
        'correcta' => 'b',
        'porque'   => 'Para muchas aplicaciones el criterio es más subjetivo: se presentan los resultados y un humano decide si promueve.'
    ],
    'm11' => [
        'texto'    => 'Para muchas aplicaciones, el resultado de la etapa de capacidad…',
        'opciones' => [
            'a' => 'Se ignora',
            'b' => 'Bloquea siempre el release',
            'c' => 'Lo decide un script',
            'd' => 'Se presenta al final de la etapa y una persona decide si promover el candidato'
        ],
        'correcta' => 'd',
        'porque'   => 'El juicio de lo “aceptable” es más subjetivo que un umbral automático.'
    ],
    'm12' => [
        'texto'    => '¿Cuál es el <b>peor</b> escenario de un release sin plan de back-out?',
        'opciones' => [
            'a' => 'Que se retrase una demo',
            'b' => 'Dejar al negocio sin recursos críticos porque hubo que darlos de baja para lanzar el nuevo sistema',
            'c' => 'Que aumente el tamaño del repositorio',
            'd' => 'Que cambien los colores de la UI'
        ],
        'correcta' => 'b',
        'porque'   => 'En el mejor caso, un problema serio solo retrasa nuevas capacidades valiosas.'
    ],
    'm13' => [
        'texto'    => '¿Cuál <b>NO</b> es uno de los objetivos que se buscan al preparar el release?',
        'opciones' => [
            'a' => 'Plan de release creado por todos los involucrados (incluye operaciones y soporte)',
            'b' => 'Automatizar, empezando por las etapas más propensas a errores',
            'c' => 'Ensayar el procedimiento a menudo en entornos production-like',
            'd' => 'Evitar tener capacidad de back-out para no aumentar el coste'
        ],
        'correcta' => 'd',
        'porque'   => 'Sí se quiere poder hacer back-out, y una estrategia para migrar configuración y datos de producción en actualización y rollback.'
    ],
    'm14' => [
        'texto'    => 'La meta del proceso de release es que…',
        'opciones' => [
            'a' => 'Sea tan simple como elegir una versión de la aplicación y pulsar un botón; el back-out debe ser igual de simple',
            'b' => 'Lo haga un solo experto',
            'c' => 'Se documente en un wiki',
            'd' => 'Se haga una vez al año'
        ],
        'correcta' => 'a',
        'porque'   => 'Más detalle en el capítulo 10 (Deploying and Releasing Applications).'
    ],
    'm15' => [
        'texto'    => '¿Cómo se mitiga que <b>no</b> se controle el entorno operativo (juegos, ofimática instalada por usuarios)?',
        'opciones' => [
            'a' => 'Ignorándolo',
            'b' => 'Bloqueando el entorno de los usuarios',
            'c' => 'Eligiendo una muestra representativa de entornos destino, corriendo en paralelo la suite de aceptación en cada uno y minando los datos para saber qué falla en qué plataforma',
            'd' => 'Liberando solo en un entorno'
        ],
        'correcta' => 'c',
        'porque'   => 'Es el primero de los dos factores que van contra el ideal de controlar cada bit.'
    ],
    'm16' => [
        'texto'    => 'El segundo factor en contra del control del entorno es el costo. ¿Qué dice el libro?',
        'opciones' => [
            'a' => 'Que es caro y no compensa',
            'b' => 'Que suele ocurrir lo contrario: la mayoría de los problemas en producción se deben a un control insuficiente',
            'c' => 'Que solo importa en empresas grandes',
            'd' => 'Que depende del lenguaje'
        ],
        'correcta' => 'b',
        'porque'   => 'Por eso los entornos de producción deben estar completamente bloqueados: cambios solo mediante procesos automatizados.'
    ],
    'm17' => [
        'texto'    => '¿Qué incluyen los cambios que solo deben hacerse por procesos automatizados en producción?',
        'opciones' => [
            'a' => 'Solo el despliegue de la aplicación',
            'b' => 'Despliegue, configuración, stack de software, topología de red y estado',
            'c' => 'Solo la configuración',
            'd' => 'Solo el código fuente'
        ],
        'correcta' => 'b',
        'porque'   => 'Solo así se puede auditar, diagnosticar y reparar en un tiempo predecible (capítulo 11).'
    ],
    'm18' => [
        'texto'    => 'El proceso de gestión del entorno de producción…',
        'opciones' => [
            'a' => 'Es distinto del de staging',
            'b' => 'Solo aplica a producción',
            'c' => 'Se usa también para los demás entornos (staging, integración…); se afina una configuración (p. ej. con feedback de capacity testing) y se replica a todos los servidores, incluido producción',
            'd' => 'No incluye el middleware'
        ],
        'correcta' => 'c',
        'porque'   => 'Todo el entorno se gestiona igual, incluidos bases de datos, servidores web, brokers de mensajes y servidores de aplicaciones; los ajustes óptimos van a la línea base.'
    ],
    'm19' => [
        'texto'    => '¿Qué reduce el costo de automatizar el aprovisionamiento y mantenimiento de entornos?',
        'opciones' => [
            'a' => 'Comprar más servidores',
            'b' => 'Aprovisionamiento y gestión automatizados, buenas prácticas de gestión de configuración y (si procede) virtualización',
            'c' => 'Trabajar de noche',
            'd' => 'Escribir menos pruebas'
        ],
        'correcta' => 'b',
        'porque'   => 'Con el entorno controlado, el despliegue sigue pasos muy parecidos (capítulo 6).'
    ],
    'm20' => [
        'texto'    => '¿Qué significa que la entrega se <b>democratiza</b>?',
        'opciones' => [
            'a' => 'Que se vota qué versión liberar',
            'b' => 'Que devs, testers y operaciones ya no dependen de tickets y correos para obtener builds desplegados; los testers eligen la versión sin ser expertos técnicos',
            'c' => 'Que cualquier persona puede cambiar el código fuente',
            'd' => 'Que se elimina el pipeline'
        ],
        'correcta' => 'b',
        'porque'   => 'Incluso el personal de ventas puede acceder a la última versión con la killer feature.'
    ],
    'm21' => [
        'texto'    => '¿Por qué el proyecto se percibe (y es) menos riesgoso con despliegue automatizado?',
        'opciones' => [
            'a' => 'Porque se libera menos',
            'b' => 'Porque el proceso de release se ensaya, prueba y perfecciona (se usa el mismo para todos los entornos, muchas veces al día); tras 50 o 100 despliegues sin problema deja de ser un gran evento',
            'c' => 'Porque se contratan más testers',
            'd' => 'Porque se elimina la documentación'
        ],
        'correcta' => 'b',
        'porque'   => 'Debe ser posible desplegar un solo cambio con el mínimo de tiempo y ceremonia.'
    ],
    'm22' => [
        'texto'    => '¿Por qué se temen tradicionalmente los días de release? (dos razones)',
        'opciones' => [
            'a' => 'Por el calor y el estrés',
            'b' => 'Por el coste de las licencias y por la burocracia',
            'c' => 'Por el tamaño de los binarios y por la latencia',
            'd' => 'Miedo a introducir un problema (error en los pasos manuales o en las instrucciones) y miedo a quedar comprometido si el release falla'
        ],
        'correcta' => 'd',
        'porque'   => 'Lo primero se mitiga ensayando el release muchas veces al día; lo segundo con una estrategia de back-out.'
    ],
    'm23' => [
        'texto'    => '¿Cuál es la <b>mejor</b> estrategia de back-out?',
        'opciones' => [
            'a' => 'Reescribir el código',
            'b' => 'Mantener disponible la versión anterior mientras se libera la nueva y durante un tiempo después (p. ej. un directorio por release y un symlink a la versión actual)',
            'c' => 'Restaurar copias de seguridad a mano',
            'd' => 'Parchear en caliente'
        ],
        'correcta' => 'b',
        'porque'   => 'La siguiente mejor es redesplegar desde cero la última versión buena mediante el mismo mecanismo de botón.'
    ],
    'm24' => [
        'texto'    => '¿Qué debe evitarse <b>en cualquier caso</b> al hacer rollback?',
        'opciones' => [
            'a' => 'Tener un proceso distinto del de despliegue, o hacer despliegues/rollbacks incrementales',
            'b' => 'Redesplegar la versión anterior',
            'c' => 'Mantener la versión antigua desplegada',
            'd' => 'Ensayarlo'
        ],
        'correcta' => 'a',
        'porque'   => 'Esos procesos se prueban poco, son poco fiables y no parten de una línea base conocida buena; son frágiles.'
    ],
    'm25' => [
        'texto'    => '¿Qué es lo más complejo al desplegar y hacer rollback, según el libro?',
        'opciones' => [
            'a' => 'Compilar el código',
            'b' => 'Elegir el nombre de la versión',
            'c' => 'Migrar los datos de producción (tema del capítulo 12)',
            'd' => 'Copiar los binarios'
        ],
        'correcta' => 'c',
        'porque'   => 'Un back-out completamente neutro respecto a la versión puede ser demasiado costoso, pero el ideal sirve como objetivo.'
    ],
    'm26' => [
        'texto'    => '¿Cuál de estas afirmaciones sobre un candidato listo para producción es <b>falsa</b>?',
        'opciones' => [
            'a' => 'El código compila y pasó las pruebas unitarias',
            'b' => 'Pasó las pruebas de aceptación y se probó en un análogo de producción',
            'c' => 'Es desplegable y el sistema de despliegue se usó al menos en desarrollo, aceptación y pruebas',
            'd' => 'Se necesita intervención manual para desplegarlo porque el control de versiones no tiene todo'
        ],
        'correcta' => 'd',
        'porque'   => 'El control de versiones contiene todo lo necesario para desplegar sin intervención manual porque ya se desplegó varias veces.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Farley cap. 5 · 4 — Etapas posteriores, release y back-out', 'Continuous Delivery, cap. 5: pruebas manuales y no funcionales, preparación del release, automatización del despliegue, back-out y building on success');
?>


<div class="card">
  <h2>1. Etapas de prueba posteriores</h2>
  <ul>
    <li>La etapa de aceptación es un hito significativo: tras ella, el candidato pasa de ser dominio del <?php hueco(1, 24); ?> a algo de interés y uso más amplio.</li>
    <li>En los pipelines más simples, un build que pasó aceptación está listo para <?php hueco(2, 22); ?>, al menos en cuanto a pruebas automatizadas. Si falla esta etapa, por definición no es apto para <?php hueco(3, 16); ?>.</li>
    <li>La progresión hasta este punto es <?php hueco(4, 14); ?>: los candidatos exitosos se <?php hueco(5, 29); ?> a la siguiente etapa. La entrega incremental puede llegar a un despliegue automático a producción: <i><?php hueco(6, 25); ?></i> (blog de Timothy <?php hueco(7, 8); ?>).</li>
    <li>Aun con una suite de pruebas completa, muchos sistemas desean pruebas <?php hueco(8, 12); ?> antes del release.</li>
    <li>Entornos habituales: integración con otros sistemas, pruebas de <?php hueco(9, 13); ?>, pruebas <?php hueco(10, 17); ?>, <?php hueco(11, 11); ?> y <?php hueco(12, 14); ?>. Cada uno es más o menos <?php hueco(13, 19); ?> y tiene su propia <?php hueco(14, 17); ?>.</li>
    <li>El pipeline también se ocupa de los despliegues a entornos de prueba. Sistemas de gestión de releases citados: <?php hueco(15, 15); ?> y <?php hueco(16, 6); ?>, que muestran qué está desplegado en cada entorno y permiten un despliegue con <?php hueco(17, 12); ?>; por detrás ejecutan los <?php hueco(18, 25); ?> ya escritos. Con herramientas open source se puede construir uno propio: <?php hueco(19, 10); ?> o la familia <?php hueco(20, 17); ?>.</li>
    <li>Un sistema propio debe: listar los candidatos que pasaron la etapa de <?php hueco(21, 14); ?>; tener un botón para desplegar la <?php hueco(22, 26); ?> en el <?php hueco(23, 26); ?>; y mostrar qué candidato está desplegado en cada entorno y de qué <?php hueco(24, 36); ?> salió.</li>
    <li>Los despliegues pueden ejecutarse en <?php hueco(25, 13); ?> (solo se despliega a producción tras UAT y staging), en <?php hueco(26, 12); ?> o como etapas <?php hueco(27, 14); ?> elegidas a mano.</li>
    <li>Los testers despliegan cualquier build <b>a demanda</b>: esto reemplaza el concepto de <i><?php hueco(28, 17); ?></i>, que era un build de una revisión <?php hueco(29, 14); ?> (el último cambio antes de que todos se fueran a casa). Ahora ven qué builds pasaron las pruebas automáticas, qué <?php hueco(30, 11); ?> se hicieron y <?php hueco(31, 10); ?> el que quieren; si no sirve, <?php hueco(32, 21); ?>.</li>
  </ul>
    <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php mc('m3'); ?>
  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
    <?php enviar(); ?>
</div>

<div class="card">
  <h2>2. Pruebas manuales y no funcionales</h2>
  <h3>Pruebas manuales</h3>
  <ul>
    <li>En procesos iterativos, la aceptación va seguida de pruebas manuales: pruebas <?php hueco(33, 17); ?>, pruebas de <?php hueco(34, 14); ?> y <?php hueco(35, 13); ?>.</li>
    <li>Analistas y testers no pierden tiempo con un build que no se sabe que pasó las pruebas de aceptación <?php hueco(36, 17); ?>.</li>
    <li>El rol del tester <b>no</b> es hacer pruebas de <?php hueco(37, 13); ?>; primero debe asegurar que las pruebas de aceptación <?php hueco(38, 40); ?>, probando manualmente que se cumplen los <?php hueco(39, 27); ?>.</li>
    <li>Después se centra en lo que los humanos hacen bien y los tests automáticos mal: pruebas exploratorias, de <?php hueco(40, 14); ?>, revisar el <?php hueco(41, 17); ?> en varias plataformas y pruebas <?php hueco(42, 28); ?>.</li>
    <li>La automatización de aceptación libera a los testers para que no sean <?php hueco(43, 40); ?>.</li>
  </ul>
  <h3>Pruebas no funcionales</h3>
  <ul>
    <li>Todo sistema tiene requisitos no funcionales: de <?php hueco(44, 13); ?>, de <?php hueco(45, 13); ?> y <?php hueco(46, 7); ?>. Se detallan en el capítulo <?php hueco(47, 6); ?> (<i>Testing Nonfunctional Requirements</i>).</li>
    <li>En algunos sistemas no hace falta probarlos de forma continua, pero cuando se requieren conviene crear una <?php hueco(48, 9); ?> del pipeline que corra esas pruebas automatizadas.</li>
    <li>Que el resultado de la etapa de capacidad sea una <?php hueco(49, 13); ?> o solo <?php hueco(50, 30); ?> es uno de los criterios que determinan la organización del pipeline.</li>
    <li>En aplicaciones de muy alto rendimiento, la prueba de capacidad se ejecuta de forma automática tras aceptación; si falla, normalmente <?php hueco(51, 31); ?>.</li>
    <li>En muchas aplicaciones el juicio de qué es aceptable es más <?php hueco(52, 13); ?>: se presentan los resultados al final de la etapa y un <?php hueco(53, 10); ?> decide si el candidato se promueve.</li>
  </ul>
    <?php mc('m6'); ?>
  <?php mc('m7'); ?>
  <?php mc('m8'); ?>
  <?php mc('m9'); ?>
  <?php mc('m10'); ?>
  <?php mc('m11'); ?>
    <?php enviar(); ?>
</div>

<div class="card">
  <h2>3. Prepararse para el release</h2>
  <ul>
    <li>Todo release de un sistema en producción conlleva un <?php hueco(54, 21); ?>. En el mejor caso, un problema serio puede retrasar la introducción de <?php hueco(55, 31); ?>; en el peor, si no hay un plan de <?php hueco(56, 12); ?>, puede dejar al negocio sin <?php hueco(57, 21); ?> porque hubo que <?php hueco(58, 15); ?> para lanzar el sistema nuevo.</li>
    <li>Fundamentalmente queremos:
      <ul>
        <li>un plan de release creado y mantenido por <?php hueco(59, 26); ?> (devs, testers, operaciones, infraestructura y soporte);</li>
        <li>minimizar el efecto de los errores humanos <?php hueco(60, 17); ?> todo lo posible, empezando por las etapas más <?php hueco(61, 23); ?>;</li>
        <li><?php hueco(62, 11); ?> el procedimiento a menudo en entornos <?php hueco(63, 19); ?>, para depurar el proceso y la tecnología que lo soporta;</li>
        <li>poder <?php hueco(64, 12); ?> un release si las cosas no van según lo previsto;</li>
        <li>una estrategia para migrar <?php hueco(65, 39); ?> tanto en la actualización como en el <i><?php hueco(66, 12); ?></i>.</li>
      </ul>
    </li>
    <li>Meta: un proceso de release <b>completamente automatizado</b>: liberar es elegir una <?php hueco(67, 11); ?> y <?php hueco(68, 19); ?>; deshacer debe ser <?php hueco(69, 19); ?>. Más información en el capítulo <?php hueco(70, 6); ?> (<i>Deploying and Releasing Applications</i>).</li>
  </ul>
    <?php mc('m12'); ?>
  <?php mc('m13'); ?>
  <?php mc('m14'); ?>
    <?php enviar(); ?>
</div>

<div class="card">
  <h2>4. Automatizar el despliegue y el release</h2>
  <ul>
    <li>Cuanto menos control tenemos del entorno donde corre el código, más posibilidad de <?php hueco(71, 31); ?>. Al liberar queremos controlar <?php hueco(72, 12); ?>.</li>
    <li>Dos factores lo dificultan. <b>Primero</b>, en muchas aplicaciones (juegos, ofimática instalada por usuarios) no se controla el entorno operativo; se mitiga eligiendo una <?php hueco(73, 26); ?> de entornos destino, ejecutando la suite de aceptación en cada uno en <?php hueco(74, 12); ?> y <?php hueco(75, 11); ?> los datos para saber qué pruebas fallan en qué plataformas.</li>
    <li><b>Segundo</b>, se asume que el costo de tener ese control supera sus beneficios, pero suele ocurrir lo <?php hueco(76, 13); ?>: la mayoría de los problemas de producción se deben a <?php hueco(77, 24); ?>.</li>
    <li>Los entornos de producción deben estar <?php hueco(78, 28); ?>: los cambios solo se hacen mediante <?php hueco(79, 26); ?>, incluyendo despliegue de la aplicación, <?php hueco(80, 17); ?>, stack de <?php hueco(81, 12); ?>, <?php hueco(82, 20); ?> y <?php hueco(83, 10); ?>. Solo así se puede <?php hueco(84, 11); ?> de forma fiable, <?php hueco(85, 16); ?> problemas y <?php hueco(86, 38); ?>. (Capítulo <?php hueco(87, 6); ?>.)</li>
    <li>El proceso para gestionar producción se usa también para staging, integración, etc.; así se puede crear una configuración afinada, quizá con el <?php hueco(88, 12); ?> de las pruebas de <?php hueco(89, 13); ?>, y luego replicarla en todos los servidores, incluido producción. Todo el entorno se gestiona así, incluido el <?php hueco(90, 14); ?> (bases de datos, servidores web, brokers de mensajes y servidores de aplicaciones), añadiendo los ajustes óptimos a la <?php hueco(91, 31); ?>.</li>
    <li>Se abaratan los costos con <?php hueco(92, 34); ?> de entornos, buenas prácticas de <?php hueco(93, 28); ?> y (si procede) <?php hueco(94, 18); ?>.</li>
    <li>Con el entorno bien gestionado se despliega la aplicación: los pasos son siempre muy similares, y eso se aprovecha en los scripts del capítulo <?php hueco(95, 6); ?> (<i>Build and Deployment Scripting</i>).</li>
    <li>Con el despliegue y release automatizados, la entrega se <b>democratiza</b>: devs, testers y operaciones ya no dependen de sistemas de <?php hueco(96, 11); ?> ni de cadenas de <?php hueco(97, 9); ?>. Los testers eligen la versión sin ser <?php hueco(98, 21); ?> y pueden volver a una versión anterior para <?php hueco(99, 12); ?> un bug interesante. Los <?php hueco(100, 14); ?> acceden a la última versión con la <i>killer feature</i>.</li>
    <li>La gente empieza a <?php hueco(101, 13); ?> y percibe el proyecto como <?php hueco(102, 18); ?> — sobre todo porque <?php hueco(103, 9); ?>.</li>
    <li>La razón principal es el grado de <b>ensayo</b> del release: se usa el <?php hueco(104, 17); ?> para desplegar en cada entorno y para liberar, por lo que se prueba <?php hueco(105, 23); ?>. Tras desplegar un sistema complejo la <?php hueco(106, 7); ?> vez sin problemas, ya no es un <?php hueco(107, 15); ?>.</li>
    <li>Debería poder desplegarse un único cambio a producción por el pipeline con el mínimo <?php hueco(108, 10); ?> y <?php hueco(109, 13); ?>; el proceso de release se evalúa y mejora continuamente, identificando los problemas <?php hueco(110, 40); ?>.</li>
    <li>Muchos negocios necesitan liberar <?php hueco(111, 23); ?>; incluso las empresas de producto, por si aparecen <?php hueco(112, 21); ?> o agujeros de seguridad. Pero no siempre tiene sentido liberar tan a menudo (sobre todo en <?php hueco(113, 26); ?>: a veces se necesita un conjunto coherente de features); aun así, implementar un pipeline mejora enormemente la capacidad de entregar <?php hueco(114, 24); ?>.</li>
  </ul>
    <?php mc('m15'); ?>
  <?php mc('m16'); ?>
  <?php mc('m17'); ?>
  <?php mc('m18'); ?>
  <?php mc('m19'); ?>
  <?php mc('m20'); ?>
    <?php enviar(); ?>
</div>

<div class="card">
  <h2>5. Deshacer cambios (back-out) y construir sobre el éxito</h2>
  <h3>Por qué se temen los días de release</h3>
  <ul>
    <li><b>Miedo 1:</b> introducir un problema porque alguien cometa un <?php hueco(115, 29); ?> en los pasos <?php hueco(116, 12); ?> del release, o porque hay un error en las <?php hueco(117, 17); ?>.</li>
    <li><b>Miedo 2:</b> si el release falla (por el proceso o por un defecto de la nueva versión) uno queda <?php hueco(118, 16); ?> y solo queda la esperanza de ser lo bastante <?php hueco(119, 13); ?> para resolverlo muy rápido.</li>
    <li>El primero se mitiga <?php hueco(120, 40); ?>, demostrando que el sistema de despliegue automatizado funciona. El segundo con una estrategia de <?php hueco(121, 12); ?>: en el peor caso volvemos a donde estábamos y tenemos tiempo para evaluar el problema.</li>
  </ul>
  <h3>Estrategias</h3>
  <ul>
    <li>La mejor: mantener la <?php hueco(122, 20); ?> disponible mientras se libera la nueva y por un tiempo después. En una app muy simple: cada release en un <?php hueco(123, 14); ?> y un <?php hueco(124, 11); ?> que apunta a la versión actual.</li>
    <li>Lo más complejo al desplegar y hacer rollback es migrar los <?php hueco(125, 23); ?> (capítulo <?php hueco(126, 6); ?>, <i>Managing Data</i>).</li>
    <li>La siguiente mejor: <?php hueco(127, 26); ?> la última versión buena, con un botón para liberar <b>cualquier</b> versión que haya pasado todas las etapas.</li>
    <li>Un back-out totalmente independiente de la versión puede ser demasiado costoso en tiempo, pero el <?php hueco(128, 9); ?> es útil porque fija una meta a la que acercarse.</li>
    <li><b>Nunca</b> tener un <?php hueco(129, 20); ?> para retroceder que para desplegar, ni hacer despliegues o rollbacks <?php hueco(130, 17); ?>: se prueban <?php hueco(131, 12); ?>, son poco fiables y no parten de una línea base <?php hueco(132, 23); ?>, así que son <?php hueco(133, 12); ?>.</li>
    <li>Siempre se retrocede o <?php hueco(134, 40); ?> o <?php hueco(135, 30); ?> una versión anterior conocida como buena.</li>
  </ul>
  <h3>Building on success</h3>
  <ul>
    <li>Cuando un release candidate llega a producción sabemos con certeza que: el código <?php hueco(136, 11); ?>; hace lo que los desarrolladores creen porque pasó las pruebas <?php hueco(137, 13); ?>; hace lo que analistas o usuarios creen porque pasó todas las pruebas de <?php hueco(138, 14); ?>; la configuración de infraestructura y entornos base está gestionada correctamente porque se probó en un <?php hueco(139, 25); ?>; tiene todos los componentes porque fue <?php hueco(140, 15); ?>; y el sistema de despliegue funciona porque se usó como mínimo una vez en un entorno de <?php hueco(141, 14); ?>, una en la etapa de <?php hueco(142, 14); ?> y una en un entorno de <?php hueco(143, 11); ?>.</li>
    <li>El control de versiones guarda todo lo necesario para desplegar sin <?php hueco(144, 23); ?>, porque ya se desplegó varias veces.</li>
    <li>Este enfoque de “construir sobre el éxito”, junto al mantra de <b>fallar</b> el proceso o cualquier parte <?php hueco(145, 20); ?>, funciona a todos los niveles.</li>
  </ul>
    <?php mc('m21'); ?>
  <?php mc('m22'); ?>
  <?php mc('m23'); ?>
  <?php mc('m24'); ?>
  <?php mc('m25'); ?>
  <?php mc('m26'); ?>
    <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('tercero.php', 'quinto.php');
