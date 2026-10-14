<?php
/* ==========================================================================
   IngeSoft5 / DevOps2 / Farley cap. 5 — bloque 01: Qué es un deployment
   pipeline, value stream map y pipeline básico.
   Fuente: Continuous Delivery (Humble & Farley) — Chapter 5: Anatomy of the
   Deployment Pipeline — Introduction, What Is a Deployment Pipeline?, A Basic
   Deployment Pipeline
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- introduccion: CI no es suficiente --- */
    1  => ['desarrollo', 'equipos de desarrollo', 'equipos de desarrollo.'],
    2  => ['pruebas manuales', 'proceso de pruebas manuales', 'testing manual'],
    3  => ['pruebas y operaciones', 'testing y operaciones', 'operaciones y pruebas'],
    4  => ['documentacion', 'documentacion o correcciones'],
    5  => ['builds buenos', 'buenos builds', 'builds "buenos"', 'buenas versiones', 'build bueno'],
    6  => ['semanas', 'semanas despues'],
    7  => ['no funcionales', 'requisitos no funcionales', 'requerimientos no funcionales'],
    8  => ['production-ready', 'listo para produccion', 'listo para produccion.'],
    9  => ['integracion continua', 'ci', 'ci en sistemas tipo produccion'],
    10 => ['multifuncionales', 'cross-functional', 'transversales', 'multidisciplinarios'],
    11 => ['cuellos de botella', 'bottlenecks', 'cuello de botella'],
    12 => ['holistico', 'integral', 'holistica', 'de extremo a extremo', 'end-to-end'],
    13 => ['un clic', 'clic', 'click', 'boton', 'un boton', 'un click'],
    14 => ['retroalimentacion', 'feedback'],
    15 => ['pull', 'sistema pull', 'de tipo pull'],
    16 => ['lean', 'lean software development'],
    17 => ['tiempo de ciclo', 'cycle time'],
    18 => ['throughput', 'rendimiento', 'capacidad de procesamiento'],
    19 => ['calidad del codigo', 'calidad de codigo', 'code quality'],
    20 => ['visibilidad'],
    21 => ['mas segura', 'segura', 'mas seguro'],
    22 => ['patrones', 'abstracciones'],

    /* --- que es un pipeline --- */
    23 => ['manifestacion automatizada', 'automatizada', 'automatizado', 'manifestacion'],
    24 => ['control de versiones', 'version control'],
    25 => ['usuarios', 'manos de los usuarios'],
    26 => ['construir', 'compilar', 'construir el software'],
    27 => ['etapas', 'pruebas y despliegues', 'pruebas'],
    28 => ['colaboracion', 'colaboracion entre muchas personas'],
    29 => ['concepto a efectivo', 'concept to cash', 'concepto a dinero', 'concepto a caja'],
    30 => ['value stream map', 'mapa de flujo de valor', 'mapa de la cadena de valor', 'vsm', 'mapa del flujo de valor'],
    31 => ['tres meses y medio', '3.5 meses', 'tres meses y medio.', '3 meses y medio', 'mes y medio'],
    32 => ['dos meses y medio', '2.5 meses', '2 meses y medio'],
    33 => ['cinco dias', '5 dias', '5', 'cinco'],
    34 => ['papel', 'libreta', 'papel y libreta', 'cuaderno'],
    35 => ['esperas', 'tiempos de espera', 'espera'],
    36 => ['agrega valor', 'valor agregado', 'agregan valor', 'agrega', 'valor'],
    37 => ['lapiz', 'un lapiz'],
    38 => ['poppendieck', 'mary y tom poppendieck'],
    39 => ['revision', 'una revision', 'revision en control de versiones', 'revision del control de versiones'],
    40 => ['diagrama de secuencia', 'diagrama secuencia', 'sequence diagram'],
    41 => ['cada commit', 'cada cambio', 'cada check-in', 'cada commit.'],
    42 => ['confianza', 'aumenta la confianza'],
    43 => ['recursos', 'los recursos'],
    44 => ['parecidos a produccion', 'similares a produccion', 'production-like', 'mas parecidos a produccion', 'mas similares a produccion'],
    45 => ['temprano', 'lo antes posible', 'tan pronto como sea posible', 'temprano en el proceso'],
    46 => ['causa raiz', 'causa raiz del fallo', 'la causa raiz'],
    47 => ['promovido', 'promovida', 'promueve', 'no se promueve'],

    /* --- consecuencias --- */
    48 => ['regresion', 'regresiones', 'bugs de regresion'],
    49 => ['urgentes', 'correcciones urgentes', 'arreglos urgentes'],
    50 => ['red', 'topologia de red', 'nueva topologia de red'],
    51 => ['rapidos', 'rapidos, repetibles y confiables', 'rapido'],
    52 => ['repetibles', 'repetibles y confiables'],
    53 => ['confiables', 'fiables'],
    54 => ['normales', 'eventos normales', 'normal'],
    55 => ['sin riesgo', 'esencialmente sin riesgo', 'ningun riesgo'],
    56 => ['revertir', 'volver atras', 'retroceder', 'reversion'],
    57 => ['offline', 'fuera de linea', 'sin conexion'],

    /* --- las 4 etapas --- */
    58 => ['commit', 'etapa de commit', 'commit stage'],
    59 => ['nivel tecnico', 'tecnico', 'a nivel tecnico'],
    60 => ['unitarias', 'unit-level', 'pruebas unitarias', 'unit'],
    61 => ['analisis de codigo', 'analisis estatico', 'analisis'],
    62 => ['aceptacion', 'pruebas de aceptacion automatizadas', 'aceptacion automatizadas'],
    63 => ['funcional y no funcional', 'funcional', 'nivel funcional y no funcional'],
    64 => ['manuales', 'pruebas manuales', 'manual'],
    65 => ['exploratorio', 'exploratorias', 'exploratory'],
    66 => ['uat', 'user acceptance testing', 'pruebas de aceptacion de usuario'],
    67 => ['release', 'liberacion', 'etapa de release', 'entrega', 'release stage'],
    68 => ['staging', 'preproduccion'],
    69 => ['identico', 'identico a produccion', 'igual', 'igual a produccion'],
    70 => ['pipeline', 'ci pipeline', 'continuous integration pipeline'],
    94 => ['release', 'liberacion', 'entrega'],
    95 => ['build', 'build pipeline'],
    71 => ['aumenta', 'se incrementa', 'incrementa', 'aumenta la interaccion humana'],
    72 => ['boton', 'un boton', 'pulsar un boton', 'presionar un boton'],

    /* --- pipeline basico --- */
    73 => ['commit', 'commit stage', 'primera'],
    74 => ['compila', 'compilar'],
    75 => ['analisis de codigo', 'analisis'],
    76 => ['instaladores', 'creates installers'],
    77 => ['repositorio de artefactos', 'artifact repository', 'repositorio'],
    78 => ['nexus', 'artifactory'],
    79 => ['grilla de build', 'build grid', 'grid de build', 'malla de build', 'grid'],
    80 => ['base de datos de pruebas', 'base de datos de prueba', 'test database', 'bd de pruebas'],
    81 => ['aceptacion', 'pruebas de aceptacion'],
    82 => ['una o dos horas', 'una hora o dos', '1-2 horas', 'hora o dos', 'dos horas'],
    83 => ['paralelo', 'en paralelo', 'paralelamente'],
    84 => ['uat', 'pruebas de aceptacion de usuario'],
    85 => ['capacidad', 'pruebas de capacidad', 'capacity testing'],
    86 => ['produccion', 'production'],
    87 => ['autoservicio', 'self-service', 'self service'],
    88 => ['operaciones', 'el equipo de operaciones'],
    89 => ['aprobar', 'aprobar despliegues', 'aprobar los despliegues'],
    90 => ['go', 'thoughtworks go'],
    91 => ['cada check-in', 'cada commit', 'cada cambio'],
    92 => ['correlacionar', 'correlacion', 'relacionar'],
    93 => ['tan rapido como sea posible', 'lo mas rapido posible', 'rapido', 'lo antes posible'],
];

$TEXTO = [];
for ($i = 1; $i <= 95; $i++) $TEXTO[] = $i;

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Según el capítulo 5, ¿por qué “<b>CI no es suficiente</b>”?',
        'opciones' => [
            'a' => 'Porque CI no compila',
            'b' => 'Porque CI se centra en los equipos de <b>desarrollo</b> (compila y pasa pruebas unitarias/aceptación); su salida es la entrada al proceso manual de pruebas y al resto del release, donde está buena parte del <b>desperdicio</b>',
            'c' => 'Porque CI es lento',
            'd' => 'Porque CI reemplaza a QA'
        ],
        'correcta' => 'b',
        'porque'   => 'CI es un gran avance, pero no ataca lo que pasa con el software después: pruebas y operaciones.'
    ],
    'm2' => [
        'texto'    => 'Ejemplos de <b>desperdicio</b> (waste) al liberar software, según el capítulo:',
        'opciones' => [
            'a' => 'Equipos de build y operaciones esperando documentación o correcciones; testers esperando builds “buenos”; devs recibiendo reportes de bugs semanas después; y descubrir tarde que la arquitectura no soporta los requisitos no funcionales',
            'b' => 'Demasiadas pruebas unitarias',
            'c' => 'Demasiado código',
            'd' => 'Demasiada documentación'
        ],
        'correcta' => 'a',
        'porque'   => 'Resultado: software que no se puede desplegar (tarda mucho en llegar a un entorno tipo producción) y con bugs (ciclo de feedback largo).'
    ],
    'm3' => [
        'texto'    => 'Mejoras incrementales que ayudan pero <b>no dan visibilidad</b> de dónde están los cuellos de botella:',
        'opciones' => [
            'a' => 'Contratar más testers',
            'b' => 'Enseñar a los devs a escribir software <i>production-ready</i>, ejecutar CI en sistemas tipo producción e instituir equipos multifuncionales (cross-functional)',
            'c' => 'Comprar más servidores',
            'd' => 'Eliminar QA'
        ],
        'correcta' => 'b',
        'porque'   => 'La solución es un enfoque más holístico, de extremo a extremo, para entregar software.'
    ],
    'm4' => [
        'texto'    => 'Cuando el despliegue se hace con un clic, se crea un poderoso <b>ciclo de retroalimentación</b> porque…',
        'opciones' => [
            'a' => 'Es tan fácil desplegar en entornos de prueba que el equipo recibe feedback rápido tanto sobre el código como sobre el <b>proceso de despliegue</b>; al ejecutarse seguido, el despliegue queda probado, se reduce el riesgo del release y el conocimiento pasa al equipo de desarrollo',
            'b' => 'Nadie lo usa',
            'c' => 'Solo lo usan operaciones',
            'd' => 'Se hace una vez al año'
        ],
        'correcta' => 'a',
        'porque'   => 'Resultado en términos lean: un <b>sistema pull</b> (testers despliegan en sus entornos con un botón; operaciones en staging y producción).'
    ],
    'm5' => [
        'texto'    => '¿Qué obtienen todos en el proceso de entrega con un <b>sistema pull</b>?',
        'opciones' => [
            'a' => 'Acceso a lo que necesitan cuando lo necesitan y visibilidad del proceso de release (managers ven métricas como cycle time, throughput y calidad de código)',
            'b' => 'Menos trabajo para nadie',
            'c' => 'Un jefe nuevo',
            'd' => 'Más reuniones'
        ],
        'correcta' => 'a',
        'porque'   => 'Devs ven qué builds pasaron por qué etapas y qué problemas se encontraron. El proceso resultante es más rápido <b>y</b> más seguro.'
    ],
    'm6' => [
        'texto'    => '¿Qué es un <b>deployment pipeline</b>?',
        'opciones' => [
            'a' => 'Una tubería de red',
            'b' => 'Un script de Bash',
            'c' => 'La <b>manifestación automatizada</b> del proceso para llevar el software desde control de versiones hasta las manos de los usuarios; modela cómo pasa cada cambio por construcción, múltiples etapas de prueba y despliegue',
            'd' => 'Un tipo de Jenkinsfile'
        ],
        'correcta' => 'c',
        'porque'   => 'Su encarnación en una herramienta de CI y gestión de release permite ver y controlar el progreso de cada cambio.'
    ],
    'm7' => [
        'texto'    => 'Un <b>value stream map</b> modela…',
        'opciones' => [
            'a' => 'El proceso completo <b>desde el concepto hasta el efectivo</b> (concept to cash): pasos, tiempo en cada paso y esperas entre etapas',
            'b' => 'Solo el código',
            'c' => 'La red de la oficina',
            'd' => 'El organigrama'
        ],
        'correcta' => 'a',
        'porque'   => 'Ejemplo del libro (fig. 5.1): ~3 meses y medio en total, ~2 meses y medio de trabajo real; hay esperas entre etapas, p. ej. <b>5 días</b> entre el fin del desarrollo del primer release y el inicio de pruebas (por ejemplo, por el tiempo de desplegar a un entorno tipo producción).'
    ],
    'm8' => [
        'texto'    => 'Según Poppendieck, ¿cómo se crea un value stream map de forma <b>low-tech</b>?',
        'opciones' => [
            'a' => 'Con un software especializado',
            'b' => 'Con lápiz y libreta, vas al lugar donde entra la petición del cliente, dibujas el gráfico de la petición promedio de principio a fin con la gente involucrada, anotas cada paso y el tiempo promedio, y dibujas abajo una línea de tiempo que separa el tiempo en actividades que agregan valor del tiempo en esperas',
            'c' => 'Con una encuesta',
            'd' => 'Con Excel obligatoriamente'
        ],
        'correcta' => 'b',
        'porque'   => 'Para una transformación organizacional habría que ir a más detalle (responsables, aprobaciones, recursos, estructuras). Para lo que discute el libro no hace falta.'
    ],
    'm9' => [
        'texto'    => 'La parte del value stream que cubre el libro va de…',
        'opciones' => [
            'a' => 'La idea al análisis',
            'b' => 'Desarrollo a <b>release</b>; una diferencia clave es que los builds pasan por ella <b>muchas veces</b> en su camino al release',
            'c' => 'Producción a soporte',
            'd' => 'Ventas a facturación'
        ],
        'correcta' => 'b',
        'porque'   => 'Una forma de entender el pipeline es visualizarlo como un diagrama de secuencia (fig. 5.2).'
    ],
    'm10' => [
        'texto'    => '¿Cuál es la <b>entrada</b> del pipeline y cuándo se dispara?',
        'opciones' => [
            'a' => 'Un correo del cliente',
            'b' => 'Una nightly build',
            'c' => 'Una <b>revisión concreta</b> en control de versiones; cada cambio crea un build que pasa por una secuencia de pruebas; se inicia con <b>cada commit</b>, igual que un proceso de CI',
            'd' => 'Un ticket'
        ],
        'correcta' => 'c',
        'porque'   => 'Como un héroe mítico, cada build pasa por una serie de pruebas y desafíos de su viabilidad como release de producción.'
    ],
    'm11' => [
        'texto'    => 'A medida que un build supera cada prueba…',
        'opciones' => [
            'a' => 'La confianza en él aumenta, por lo que se justifica gastar más recursos: los entornos por los que pasa son <b>progresivamente más parecidos a producción</b>',
            'b' => 'La confianza baja',
            'c' => 'Se gasta menos',
            'd' => 'Se salta el resto'
        ],
        'correcta' => 'a',
        'porque'   => 'Trade-offs de la fig. 5.3. El objetivo: eliminar candidatos no aptos lo antes posible y dar feedback de la causa raíz al equipo cuanto antes.'
    ],
    'm12' => [
        'texto'    => 'Si un build <b>falla</b> una etapa del pipeline…',
        'opciones' => [
            'a' => 'Se promueve de todos modos',
            'b' => 'Se promueve solo a QA',
            'c' => 'Se marca como advertencia',
            'd' => '<b>No se promueve</b> a la siguiente etapa'
        ],
        'correcta' => 'd',
        'porque'   => 'Por eso no se pueden liberar builds no probados a fondo.'
    ],
    'm13' => [
        'texto'    => 'Consecuencias de aplicar el patrón pipeline (elige la <b>correcta</b>):',
        'opciones' => [
            'a' => 'Se puede liberar cualquier build',
            'b' => 'Se evitan regresiones, incluso con arreglos urgentes (pasan por el mismo proceso); y se mitigan las roturas por interacciones imprevistas con el entorno (nueva topología de red, configuración distinta de un servidor de producción)',
            'c' => 'Se eliminan las pruebas manuales',
            'd' => 'Se elimina la gestión de configuración'
        ],
        'correcta' => 'b',
        'porque'   => 'Un pipeline te impide liberar a producción builds que no fueron probados a fondo.'
    ],
    'm14' => [
        'texto'    => 'Cuando el despliegue y el release están automatizados…',
        'opciones' => [
            'a' => 'Son rápidos, repetibles y confiables; se vuelven eventos “normales”, sobre todo si además se puede <b>volver a una versión anterior</b>: entonces los releases son esencialmente sin riesgo (se revierte y se arregla offline)',
            'b' => 'Son más lentos',
            'c' => 'Son más raros',
            'd' => 'Son más manuales'
        ],
        'correcta' => 'a',
        'porque'   => 'El peor caso: introduces un bug crítico → revertes a una versión anterior mientras arreglas el nuevo release fuera de línea (cap. 10).'
    ],
    'm15' => [
        'texto'    => 'Las <b>cuatro etapas comunes</b> a todo pipeline:',
        'opciones' => [
            'a' => 'Commit, pruebas de aceptación automatizadas, pruebas manuales y release',
            'b' => 'Build, deploy, run y monitor',
            'c' => 'Plan, code, test y ship',
            'd' => 'Alpha, beta, gamma y delta'
        ],
        'correcta' => 'a',
        'porque'   => 'Commit: funciona a nivel técnico (compila, pruebas unitarias, análisis de código). Aceptación: funcional y no funcional. Manuales: usabilidad, defectos no detectados, valor (exploratorio, integración, UAT). Release: entrega a usuarios (paquete) o despliegue en producción/staging.'
    ],
    'm16' => [
        'texto'    => '¿Qué comprueba la <b>etapa de commit</b>?',
        'opciones' => [
            'a' => 'Que el sistema funciona <b>a nivel técnico</b>: compila, pasa una suite de pruebas (principalmente unitarias) y se le hace análisis de código',
            'b' => 'Que el usuario esté contento',
            'c' => 'Que hay capacidad para 1 millón de usuarios',
            'd' => 'Que la documentación esté completa'
        ],
        'correcta' => 'a',
        'porque'   => 'Es la primera etapa; se dispara con cada commit.'
    ],
    'm17' => [
        'texto'    => '¿Qué afirman las etapas de <b>pruebas de aceptación automatizadas</b>?',
        'opciones' => [
            'a' => 'Que el código compila',
            'b' => 'Que el sistema funciona a nivel <b>funcional y no funcional</b>: cumple las necesidades de los usuarios y las especificaciones del cliente',
            'c' => 'Que el equipo está feliz',
            'd' => 'Que no hay deuda técnica'
        ],
        'correcta' => 'b',
        'porque'   => 'Las pruebas manuales validan usabilidad y encuentran defectos que las automáticas no vieron.'
    ],
    'm18' => [
        'texto'    => '¿Qué es un entorno de <b>staging</b>?',
        'opciones' => [
            'a' => 'El portátil del dev',
            'b' => 'Un entorno de pruebas <b>idéntico al entorno de producción</b>',
            'c' => 'Un entorno para juegos',
            'd' => 'Un repositorio'
        ],
        'correcta' => 'b',
        'porque'   => 'El libro lo define así al describir la etapa de release.'
    ],
    'm19' => [
        'texto'    => 'Otros nombres del deployment pipeline:',
        'opciones' => [
            'a' => 'CI pipeline, build pipeline, deployment production line y <i>living build</i>',
            'b' => 'Waterfall',
            'c' => 'Kanban board',
            'd' => 'Scrum'
        ],
        'correcta' => 'a',
        'porque'   => 'Es fundamentalmente un proceso de entrega de software automatizado.'
    ],
    'm20' => [
        'texto'    => '¿Implica el pipeline que no haya <b>interacción humana</b>?',
        'opciones' => [
            'a' => 'Sí, elimina toda interacción',
            'b' => 'No: automatiza los pasos complejos y propensos a error, y de hecho la interacción humana <b>aumenta</b> porque desplegar con un botón fomenta su uso frecuente por testers, analistas, devs y usuarios',
            'c' => 'Solo en producción',
            'd' => 'Solo en QA'
        ],
        'correcta' => 'b',
        'porque'   => 'Es el ejemplo de “democratización” del delivery.'
    ],
    'm21' => [
        'texto'    => 'Qué hace la <b>primera etapa (commit)</b> de un pipeline típico cuando todo pasa:',
        'opciones' => [
            'a' => 'Compila, corre pruebas unitarias, hace análisis de código y crea instaladores; si todo está bien, ensambla los binarios y los <b>guarda en un repositorio de artefactos</b> (Nexus, Artifactory o el del servidor de CI); puede preparar también una BD de pruebas; los trabajos corren en paralelo en un build grid',
            'b' => 'Despliega a producción',
            'c' => 'Corre pruebas de capacidad',
            'd' => 'Aprueba el release'
        ],
        'correcta' => 'a',
        'porque'   => 'El CI moderno permite ejecutar tareas en paralelo en una build grid.'
    ],
    'm22' => [
        'texto'    => 'La <b>segunda etapa</b> típica:',
        'opciones' => [
            'a' => 'Pruebas unitarias',
            'b' => 'Pruebas de aceptación automatizadas de larga duración, divididas en suites ejecutadas <b>en paralelo</b> (feedback típico en 1–2 horas); se dispara <b>automáticamente</b> al completar con éxito la primera',
            'c' => 'El release',
            'd' => 'La revisión de código'
        ],
        'correcta' => 'b',
        'porque'   => 'Después el pipeline se ramifica: UAT, capacity testing y producción.'
    ],
    'm23' => [
        'texto'    => 'Después de la etapa de aceptación, ¿las etapas de UAT, capacidad y producción se disparan automáticamente?',
        'opciones' => [
            'a' => 'Sí, siempre',
            'b' => 'Normalmente <b>no</b>: se quiere que testers u operaciones puedan hacer <b>autoservicio</b> (self-service) de builds a sus entornos manualmente, con un botón que ejecuta el script de despliegue; ven qué candidatos hay, qué etapas pasó cada uno, los comentarios de check-in, etc.',
            'c' => 'Solo las de capacidad',
            'd' => 'Solo la de producción'
        ],
        'correcta' => 'b',
        'porque'   => 'Los entornos tienen distintos grupos de usuarios “dueños”; p. ej. solo operaciones puede aprobar despliegues a producción.'
    ],
    'm24' => [
        'texto'    => '¿Para qué sirve ver qué build está en qué entorno y qué etapas pasó cada check-in (p. ej. en <b>Go</b>)?',
        'opciones' => [
            'a' => 'Para lucirse',
            'b' => 'Para poder correlacionar un check-in (y por tanto un build) con las etapas por las que pasó: si falla la aceptación puedes saber de inmediato qué cambios entraron; el propósito es obtener <b>feedback lo más rápido posible</b>',
            'c' => 'Para auditoría solamente',
            'd' => 'Para asignar culpas'
        ],
        'correcta' => 'b',
        'porque'   => 'Es el caso de la captura de Go (fig. 5.5): cada check-in al costado, cada etapa y su resultado.'
    ],
];

$MULTIPLE = [];
iniciar($SOLUCIONES, [], $TEXTO);
cabecera('Farley cap. 5 · 1 — Qué es el deployment pipeline', 'Continuous Delivery, cap. 5: introducción, value stream map, patrón pipeline y pipeline básico');
?>

<div class="card">
  <h2>Cómo se usa</h2>
  <p>Cinco bloques que cubren <b>todo el capítulo 5</b> de <i>Continuous Delivery</i> (Humble &amp; Farley): “Anatomy of the Deployment Pipeline”.
     Este es el <b>bloque 1</b>: introducción, value stream map y pipeline básico.</p>
  <div class="nota">Respuestas en <b>texto</b>: no importan mayúsculas ni tildes. Pulsa <b>Enter</b> dentro de un hueco para verificar.</div>
</div>

<div class="card">
  <h2>1. Introducción: por qué la integración continua no basta</h2>
  <ul>
    <li>CI se centra sobre todo en los equipos de <?php hueco(1, 12); ?>. Su salida normalmente alimenta el proceso de <?php hueco(2, 18); ?> y de ahí el resto del release.</li>
    <li>Gran parte del desperdicio está en el paso por <?php hueco(3, 20); ?>: equipos esperando <?php hueco(4, 14); ?> o correcciones, testers esperando
        <?php hueco(5, 14); ?>, devs recibiendo reportes de bugs <?php hueco(6, 8); ?> después, y descubrir tarde que la arquitectura no soporta los requisitos
        <?php hueco(7, 14); ?>.</li>
    <li>Mejoras incrementales: enseñar a escribir software <?php hueco(8, 16); ?>, correr <?php hueco(9, 18); ?> en sistemas tipo producción e instituir equipos
        <?php hueco(10, 14); ?>. No muestran dónde están los <?php hueco(11, 16); ?>.</li>
    <li>La solución: un enfoque <?php hueco(12, 10); ?> de extremo a extremo; desplegar, incluso a producción, con <?php hueco(13, 8); ?> para elegir el build.</li>
    <li>Da un poderoso ciclo de <?php hueco(14, 18); ?>. Resulta un sistema <?php hueco(15, 5); ?> (en la jerga <?php hueco(16, 5); ?>): testers despliegan a sus entornos con un botón, operaciones a staging y producción.</li>
    <li>Los managers observan métricas clave: <?php hueco(17, 16); ?> (cycle time), <?php hueco(18, 12); ?> y <?php hueco(19, 20); ?>. Todos obtienen acceso a lo que necesitan y
        <?php hueco(20, 12); ?> del proceso; el proceso es más rápido y más <?php hueco(21, 8); ?>.</li>
    <li>Con los años se identificaron <?php hueco(22, 10); ?> comunes entre los pipelines construidos: eso permite montar rápido sistemas sofisticados.</li>
  </ul>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>2. ¿Qué es un deployment pipeline?</h2>
  <ul>
    <li>A nivel abstracto es la <?php hueco(23, 22); ?> de tu proceso para llevar el software desde el <?php hueco(24, 20); ?> hasta las manos de los <?php hueco(25, 8); ?>.</li>
    <li>Cada cambio pasa por un proceso complejo: <?php hueco(26, 10); ?> el software y hacerlo avanzar por múltiples <?php hueco(27, 8); ?> de prueba y despliegue; requiere
        <?php hueco(28, 12); ?> entre muchas personas.</li>
    <li>Ese proceso es solo una parte del camino “<?php hueco(29, 22); ?>” (concept to cash), que se modela con un <?php hueco(30, 20); ?>.</li>
    <li>El ejemplo de la fig. 5.1 dura unos <?php hueco(31, 22); ?>, de los cuales unos <?php hueco(32, 22); ?> son trabajo real; hay <?php hueco(35, 8); ?> entre etapas,
        p. ej. <?php hueco(33, 8); ?> entre el fin del desarrollo del primer release y el inicio de las pruebas.</li>
    <li>Crearlo puede ser low-tech: basta un <?php hueco(37, 8); ?> y <?php hueco(34, 10); ?>. Se anota cada paso y el tiempo promedio, y se separa el tiempo que <?php hueco(36, 14); ?> del de las esperas.
        Referencia: Mary y Tom <?php hueco(38, 14); ?> (<i>Lean Software Development</i>).</li>
    <li>La parte del valor que cubre el libro va del desarrollo al <?php hueco(94, 10); ?>. Los builds pasan por ella muchas veces; se visualiza como un
        <?php hueco(40, 22); ?>. La entrada es una <?php hueco(39, 12); ?> de control de versiones y se inicia con <?php hueco(41, 12); ?>.</li>
    <li>Al pasar cada prueba aumenta la <?php hueco(42, 10); ?> en el build, por lo que se justifica gastar más <?php hueco(43, 10); ?>: los entornos son cada vez más
        <?php hueco(44, 30); ?>. Se busca eliminar candidatos no aptos lo más <?php hueco(45, 12); ?> y dar feedback de la <?php hueco(46, 12); ?> del fallo.
        Un build que falla una etapa no es <?php hueco(47, 10); ?> a la siguiente.</li>
  </ul>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>3. Consecuencias y las cuatro etapas comunes</h2>
  <ul>
    <li>Consecuencia 1: se evitan bugs de <?php hueco(48, 10); ?>, incluso con arreglos <?php hueco(49, 10); ?>, que pasan por el mismo proceso; se mitigan las roturas por
        interacciones imprevistas con el entorno (p. ej. nueva topología de <?php hueco(50, 4); ?>).</li>
    <li>Consecuencia 2: despliegue y release automatizados son <?php hueco(51, 8); ?>, <?php hueco(52, 10); ?> y <?php hueco(53, 10); ?>; se vuelven eventos
        <?php hueco(54, 8); ?>. Si además se puede <?php hueco(56, 10); ?> a una versión anterior, los releases son esencialmente <?php hueco(55, 10); ?>: se arregla el
        bug nuevo <?php hueco(57, 8); ?>.</li>
  </ul>
  <table class="datos">
    <tr><th>Etapa</th><th>Qué asegura</th></tr>
    <tr><td><?php hueco(58, 8); ?></td><td>Que el sistema funciona a <?php hueco(59, 12); ?>: compila, pasa una suite de pruebas (primordialmente
        <?php hueco(60, 10); ?>) y se le hace <?php hueco(61, 16); ?>.</td></tr>
    <tr><td>Pruebas de <?php hueco(62, 10); ?> automatizadas</td><td>Que funciona a nivel <?php hueco(63, 20); ?>: cumple lo que necesitan los usuarios y las especificaciones del cliente.</td></tr>
    <tr><td>Etapas <?php hueco(64, 10); ?></td><td>Usabilidad y valor, y detectar defectos que las automáticas no encontraron: testing <?php hueco(65, 12); ?>, integración y
        <?php hueco(66, 5); ?> (user acceptance testing).</td></tr>
    <tr><td>Etapa de <?php hueco(67, 10); ?></td><td>Entrega el sistema a los usuarios (como paquete) o lo despliega en producción o en
        <?php hueco(68, 8); ?> (un entorno de pruebas <?php hueco(69, 10); ?> a producción).</td></tr>
  </table>
  <p>También se le llama “CI <?php hueco(70, 10); ?>”, “<?php hueco(95, 6); ?> pipeline”, “deployment production line” o “living build”. La interacción humana en realidad
     <?php hueco(71, 10); ?> porque desplegar con solo <?php hueco(72, 12); ?> fomenta su uso.</p>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>4. Un deployment pipeline básico</h2>
  <ul>
    <li>Todo empieza cuando los devs hacen commit; el sistema de CI responde disparando una nueva instancia del pipeline. La primera etapa (<?php hueco(73, 8); ?>)
        <?php hueco(74, 8); ?> el código, corre pruebas unitarias, hace <?php hueco(75, 16); ?> y crea <?php hueco(76, 12); ?>.</li>
    <li>Si todo pasa, se ensamblan los binarios y se guardan en un <?php hueco(77, 24); ?>; herramientas como <?php hueco(78, 8); ?> o Artifactory ayudan. Los trabajos
        se ejecutan en paralelo en una <?php hueco(79, 12); ?>; también se puede preparar una <?php hueco(80, 26); ?> para las pruebas de aceptación.</li>
    <li>La segunda etapa tiene pruebas de <?php hueco(81, 10); ?> más largas, divididas en suites en <?php hueco(83, 10); ?>: feedback típico en <?php hueco(82, 20); ?>;
        se dispara automáticamente al terminar bien la primera.</li>
    <li>Luego el pipeline se ramifica para desplegar de forma independiente a <?php hueco(84, 5); ?> (user acceptance), pruebas de <?php hueco(85, 10); ?> y
        <?php hueco(86, 12); ?>. Normalmente no se disparan solas: se prefiere el <?php hueco(87, 14); ?> (self-service) con un script automatizado de despliegue.</li>
    <li>Cada grupo “dueño” de un entorno puede desplegar en él; por ejemplo el equipo de <?php hueco(88, 12); ?> quiere ser el único que pueda <?php hueco(89, 10); ?> despliegues a producción.</li>
    <li>La captura de la herramienta <?php hueco(90, 4); ?> muestra <?php hueco(91, 12); ?> a un lado con las etapas que pasó: permite <?php hueco(92, 16); ?> un check-in con las etapas y
        encontrar qué cambio rompió la aceptación. El propósito de todo es obtener feedback <?php hueco(93, 30); ?>.</li>
  </ul>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Menu.php', 'segundo.php');
