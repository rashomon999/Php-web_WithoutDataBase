<?php
/* ==========================================================================
   IngeSoft5 / DevOps2 / Farley cap. 6 — bloque 01: Panorama de herramientas
   de build (Make, Ant, NAnt/MSBuild, Maven, Rake, Buildr, Psake).
   Fuente: Continuous Delivery (Humble & Farley) — Chapter 6: Build and
   Deployment Scripting — Introduction y "An Overview of Build Tools"
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- introduccion --- */
    1  => ['ide'],
    2  => ['triviales', 'trivial', 'triviales tareas'],
    3  => ['dias', 'dias en poner a andar', 'dias en ponerse en marcha'],
    4  => ['linea de comandos', 'command line', 'consola'],
    5  => ['rake'],
    6  => ['msbuild'],
    7  => ['ant', 'maven', 'buildr', 'gradle'],
    8  => ['scons'],
    9  => ['integracion continua', 'ci'],
    10 => ['configurar', 'configurar la aplicacion'],
    11 => ['inicializar datos', 'datos'],
    12 => ['mock', 'sistemas externos simulados', 'simulados'],
    13 => ['propósito general', 'proposito general', 'general'],
    14 => ['desarrolladores y operaciones', 'desarrolladores y personal de operaciones', 'operaciones'],
    15 => ['codigo fuente', 'codigo'],

    /* --- nucleo comun --- */
    16 => ['dependencias', 'red de dependencias'],
    17 => ['exactamente una vez', 'una vez'],
    18 => ['init'],
    19 => ['ambas', 'las dos', 'las dos cosas'],
    20 => ['dos'],
    21 => ['lo que hace', 'accion'],
    22 => ['de que depende', 'dependencias', 'de lo que depende'],
    23 => ['tareas', 'task-oriented', 'orientadas a tareas'],
    24 => ['productos', 'product-oriented', 'orientadas a productos'],
    25 => ['ant', 'nant', 'msbuild'],
    26 => ['make'],
    27 => ['duplicarse', 'mas de una vez', 'mas de una'],
    28 => ['omitirse', 'omitir', 'saltarse', 'faltar'],
    29 => ['timestamps', 'marcas de tiempo'],
    30 => ['md5'],
    31 => ['incremental', 'build incremental'],
    32 => ['no guardan estado', 'ninguno', 'no mantienen estado', 'sin estado'],
    33 => ['c++', 'cpp'],
    34 => ['rake'],
    35 => ['jit', 'just-in-time'],
    36 => ['bytecode', 'byte code'],

    /* --- make --- */
    37 => ['product-oriented', 'orientada a productos', 'productos'],
    38 => ['makefile por directorio', 'makefile'],
    39 => ['tab', 'tabulador', 'tabulacion'],
    40 => ['espacios'],
    41 => ['shell'],
    42 => ['sistema operativo', 'so'],
    43 => ['dsl externo', 'externo', 'external dsl'],
    44 => ['declarativo'],
    45 => ['scons'],
    46 => ['python'],
    47 => ['windows'],

    /* --- ant --- */
    48 => ['make'],
    49 => ['xml'],
    50 => ['java'],
    51 => ['task-oriented', 'orientada a tareas', 'tareas'],
    52 => ['anemico', 'anémico', 'anemico'],
    53 => ['boilerplate', 'codigo repetitivo'],
    54 => ['antcall'],
    55 => ['miles', 'miles de lineas'],
    56 => ['macrodef', 'import'],
    57 => ['pobremente factorizados', 'mal factorizados', 'largos'],

    /* --- nant y msbuild --- */
    58 => ['nant'],
    59 => ['msbuild'],
    60 => ['visual studio'],
    61 => ['ant'],
    62 => ['nunit', 'nmock'],

    /* --- maven --- */
    63 => ['convencion sobre configuracion', 'convention over configuration'],
    64 => ['javadoc'],
    65 => ['dependencias', 'gestion de dependencias', 'librerias'],
    66 => ['snapshots', 'snapshot'],
    67 => ['se auto-actualiza', 'auto-actualiza', 'autoactualiza', 'self-updating', 'se actualiza solo', 'se actualiza a si mismo'],
    68 => ['plugins'],
    69 => ['reproducir'],
    70 => ['ivy'],
    71 => ['flexible', 'mas flexible'],
    72 => ['mojos', 'mojo'],
    73 => ['diamante', 'de diamante'],
    74 => ['internet', 'mitad de internet'],

    /* --- rake, buildr, psake --- */
    75 => ['ruby'],
    76 => ['dsl interno', 'interno', 'internal dsl'],
    77 => ['stack trace', 'traza', 'traza de pila'],
    78 => ['jruby'],
    79 => ['rubygems'],
    80 => ['albacore'],
    81 => ['buildr'],
    82 => ['maven'],
    83 => ['gradle'],
    84 => ['gantt'],
    85 => ['ant'],
    86 => ['powershell'],
    87 => ['psake'],
    88 => ['sake', 'sake'],
    89 => ['task-oriented', 'tareas'],
];

$TEXTO = [];
for ($i = 1; $i <= 89; $i++) $TEXTO[] = $i;

$MULTIPLE = [
    'm1' => [
        'texto'    => '¿Cuándo basta con el IDE para construir y probar el software?',
        'opciones' => [
            'a' => 'Cuando el proyecto lo desarrolla un equipo grande',
            'b' => 'Cuando produce más de un ejecutable',
            'c' => 'Solo en tareas <b>triviales</b> (una persona, pocos días, un único ejecutable)',
            'd' => 'Siempre'
        ],
        'correcta' => 'c',
        'porque'   => 'En cuanto el proyecto pasa de una persona, dura más de unos días o produce más de un ejecutable, necesita más control. Además, en equipos distribuidos (incluido open source) sin scripts pueden pasar <b>días</b> hasta que un nuevo miembro esté operativo.'
    ],
    'm2' => [
        'texto'    => '¿Cuál es el <b>primer paso</b> (muy simple) para automatizar el build?',
        'opciones' => [
            'a' => 'Comprar un servidor de CI',
            'b' => 'Correr el build desde la <b>línea de comandos</b>: casi toda plataforma moderna lo permite',
            'c' => 'Reescribir todo en Ruby',
            'd' => 'Eliminar las pruebas'
        ],
        'correcta' => 'b',
        'porque'   => 'Rails: la tarea Rake por defecto; .NET: MsBuild; Java: Ant, Maven, Buildr o Gradle; C/C++ simple: SCons. Con eso, el CI solo tiene que ejecutar ese comando.'
    ],
    'm3' => [
        'texto'    => '¿Por qué desplegar es más complejo que “soltar un binario”?',
        'opciones' => [
            'a' => 'No lo es',
            'b' => 'Porque requiere pasos como configurar la aplicación, <b>inicializar datos</b>, configurar infraestructura/SO/middleware y montar sistemas externos simulados (mocks)',
            'c' => 'Porque Windows lo impide',
            'd' => 'Porque el binario es muy grande'
        ],
        'correcta' => 'b',
        'porque'   => 'Y, a mayor complejidad, más pasos, más largos y (si no se automatizan) más propensos a errores.'
    ],
    'm4' => [
        'texto'    => '¿Por qué el capítulo desaconseja usar herramientas de build de <b>propósito general</b> para desplegar?',
        'opciones' => [
            'a' => 'Son gratuitas',
            'b' => 'No existen',
            'c' => 'Los mecanismos de despliegue disponibles se limitan a los que soporta la herramienta y el entorno; además la decisión debe tomarse <b>entre desarrolladores y operaciones</b>',
            'd' => 'Son más rápidas'
        ],
        'correcta' => 'c',
        'porque'   => '“Using general-purpose build tools for performing deployments is asking for trouble in all but the simplest of cases.”'
    ],
    'm5' => [
        'texto'    => 'Los sistemas de build y despliegue deben tratarse como…',
        'opciones' => [
            'a' => 'Scripts desechables',
            'b' => 'Una tarea de becarios',
            'c' => 'Documentación',
            'd' => 'Seres vivos: diseñados y mantenidos con el mismo cuidado que el <b>código fuente</b> y ejercitados con regularidad'
        ],
        'correcta' => 'd',
        'porque'   => 'Deben durar toda la vida del sistema en producción, no solo el proyecto inicial.'
    ],
    'm6' => [
        'texto'    => 'El núcleo común de toda herramienta de build es…',
        'opciones' => [
            'a' => 'Compilar Java',
            'b' => 'Modelar una <b>red de dependencias</b>: calcula cómo alcanzar el objetivo ejecutando las tareas en el orden correcto, <b>cada una exactamente una vez</b>',
            'c' => 'Guardar el historial de Git',
            'd' => 'Publicar en Nexus'
        ],
        'correcta' => 'b',
        'porque'   => 'Ejemplo del libro: ejecutar tests requiere compilar código y tests y preparar datos de prueba; compilar requiere init. <i>init</i> se ejecuta una sola vez aunque varios objetivos dependan de él.'
    ],
    'm7' => [
        'texto'    => 'Una tarea en toda herramienta de build tiene dos características esenciales:',
        'opciones' => [
            'a' => 'El nombre y la fecha',
            'b' => 'El autor y la licencia',
            'c' => 'Lo que <b>hace</b> y aquello de lo que <b>depende</b>',
            'd' => 'El tamaño y el hash'
        ],
        'correcta' => 'c',
        'porque'   => 'Esas dos propiedades (acción + dependencias) están modeladas en todas las herramientas.'
    ],
    'm8' => [
        'texto'    => '<b>Task-oriented</b> vs. <b>product-oriented</b>:',
        'opciones' => [
            'a' => 'Task-oriented (Ant, NAnt, MsBuild) describe la red en términos de <b>tareas</b>; product-oriented (Make) en términos de los <b>productos</b> que genera (p. ej. un ejecutable)',
            'b' => 'Task-oriented es Make; product-oriented es Ant',
            'c' => 'Son idénticos',
            'd' => 'Task-oriented es solo para Java'
        ],
        'correcta' => 'a',
        'porque'   => 'Rake puede funcionar como ambos.'
    ],
    'm9' => [
        'texto'    => '¿Qué pasa si un prerrequisito se ejecuta <b>más de una vez</b> o se <b>omite</b>?',
        'opciones' => [
            'a' => 'Nada',
            'b' => 'Si se omite, el resultado es malo; si se ejecuta varias veces, en el mejor caso tarda más (si es idempotente) y en el peor el resultado también es malo',
            'c' => 'Si se omite, el build es más rápido y correcto',
            'd' => 'Si se repite, se mejora la calidad'
        ],
        'correcta' => 'b',
        'porque'   => 'Por eso la herramienta debe garantizar que cada prerrequisito se ejecute exactamente una vez.'
    ],
    'm10' => [
        'texto'    => '“Invocar” vs. “ejecutar” una tarea en una herramienta task-oriented: la tarea <i>Init</i> aparece dos veces en el recorrido. ¿Qué ocurre?',
        'opciones' => [
            'a' => 'Se ejecuta dos veces',
            'b' => 'Falla',
            'c' => 'Se invoca dos veces pero <b>se ejecuta solo una</b>, porque cada tarea sabe si ya se ejecutó en este build',
            'd' => 'Se ejecuta cero veces'
        ],
        'correcta' => 'c',
        'porque'   => 'La herramienta recorre toda la red invocando (no necesariamente ejecutando) cada tarea.'
    ],
    'm11' => [
        'texto'    => 'Una herramienta <b>product-oriented</b> decide si ejecutar el objetivo <i>Run tests</i> comparando…',
        'opciones' => [
            'a' => 'El número de commit',
            'b' => 'Los <b>timestamps</b> de los archivos generados (p. ej. source.so y tests.so contra testreports.zip); SCons usa firmas MD5',
            'c' => 'El tamaño de los archivos',
            'd' => 'El nombre del autor'
        ],
        'correcta' => 'b',
        'porque'   => 'El estado se guarda en los archivos generados. Eso habilita los builds <b>incrementales</b> (compilar solo lo que cambió), ahorrando horas en proyectos grandes.'
    ],
    'm12' => [
        'texto'    => '¿Por qué las herramientas task-oriented “no guardan estado” y aun así funcionan con C#?',
        'opciones' => [
            'a' => 'Porque C# no se compila',
            'b' => 'Porque usan timestamps',
            'c' => 'Porque los compiladores de esos lenguajes ya tienen <b>lógica incremental propia</b>; pero son inadecuadas para compilar C++',
            'd' => 'Porque C# es interpretado'
        ],
        'correcta' => 'c',
        'porque'   => 'En C/C++ la compilación es lenta (los compiladores optimizan mucho); en lenguajes de VM el compilador genera bytecode y el JIT optimiza en runtime.'
    ],
    'm13' => [
        'texto'    => 'Un <b>build incremental</b> es…',
        'opciones' => [
            'a' => 'Compilar solo los fuentes que han cambiado desde el último build (característica de las herramientas product-oriented como Make)',
            'b' => 'Un build que incrementa la versión',
            'c' => 'Un build que corre pruebas por partes',
            'd' => 'Un build sin dependencias'
        ],
        'correcta' => 'a',
        'porque'   => 'Lo contrario es el <i>clean build</i>.'
    ],
    'm14' => [
        'texto'    => '¿Cuál NO es una crítica que el capítulo hace a <b>Make</b>?',
        'opciones' => [
            'a' => 'Es difícil de depurar cuando crece la complejidad',
            'b' => 'Los Makefiles distribuidos por directorio dispersan la información',
            'c' => 'Es específico del sistema operativo (depende del shell)',
            'd' => 'No puede hacer builds incrementales'
        ],
        'correcta' => 'd',
        'porque'   => 'Make <b>sí</b> hace builds incrementales (es su gran fortaleza). Críticas: complejidad, Makefile por directorio, la tabulación significativa, dependencia del shell/SO, DSL externo declarativo poco familiar.'
    ],
    'm15' => [
        'texto'    => '“Whitespace can be significant” en Make. Concretamente…',
        'opciones' => [
            'a' => 'Los comandos a pasar al shell deben ir precedidos de un <b>tabulador</b>; si se usan espacios, el script no funciona',
            'b' => 'Los espacios se ignoran siempre',
            'c' => 'Hay que usar 4 espacios',
            'd' => 'Los comentarios necesitan un tab'
        ],
        'correcta' => 'a',
        'porque'   => 'Es una clase de bugs muy difícil de encontrar.'
    ],
    'm16' => [
        'texto'    => '¿Qué alternativa a Make prefieren muchos desarrolladores C/C++ y por qué?',
        'opciones' => [
            'a' => 'Ant, porque usa XML',
            'b' => '<b>SCons</b>: sus archivos están escritos en Python, es más potente y portable, soporta Windows de serie y builds paralelos',
            'c' => 'Maven, porque descarga dependencias',
            'd' => 'Rake, porque es de Ruby'
        ],
        'correcta' => 'b',
        'porque'   => 'SCons usa firmas MD5 en lugar de timestamps.'
    ],
    'm17' => [
        'texto'    => '¿Cómo nació <b>Ant</b>?',
        'opciones' => [
            'a' => 'Como evolución de Maven',
            'b' => 'Como un IDE de Java',
            'c' => 'De la convergencia entre portar Make a Java y el auge de <b>XML</b> como forma de describir documentos estructurados',
            'd' => 'De una idea de Microsoft'
        ],
        'correcta' => 'c',
        'porque'   => 'Ant es totalmente multiplataforma, con tareas escritas en Java (compilación, sistema de archivos), extensible en Java y muy soportado por IDEs.'
    ],
    'm18' => [
        'texto'    => 'Ant es una herramienta…',
        'opciones' => [
            'a' => 'Product-oriented con scripts en Python',
            'b' => 'Task-oriented; su runtime es Java y sus scripts un <b>DSL externo en XML</b>',
            'c' => 'Product-oriented con scripts en Ruby',
            'd' => 'Task-oriented con scripts en Groovy'
        ],
        'correcta' => 'b',
        'porque'   => 'Esa combinación le da poderosas capacidades multiplataforma.'
    ],
    'm19' => [
        'texto'    => 'Limitaciones de Ant que cita el libro (elige la que <b>sí</b> aparece):',
        'opciones' => [
            'a' => 'No es multiplataforma',
            'b' => 'No se puede extender',
            'c' => 'No tiene soporte en IDEs',
            'd' => 'XML poco legible, <b>modelo de dominio anémico</b> (mucho boilerplate), mezcla declarativo/imperativo (<code>&lt;antcall&gt;</code>), difícil de consultar (“¿cuántos tests corrieron?”) y reutilización (import/macrodef) mal entendida'
        ],
        'correcta' => 'd',
        'porque'   => 'Resultado: archivos largos y mal factorizados; no es raro que tengan miles de líneas.'
    ],
    'm20' => [
        'texto'    => 'Relación entre <b>NAnt</b> y <b>MSBuild</b>:',
        'opciones' => [
            'a' => 'NAnt es un port de Ant a .NET; MSBuild es la variante de Microsoft, descendiente directa de Ant/NAnt, integrada en Visual Studio y distribuida con el .NET framework',
            'b' => 'MSBuild es anterior a Ant',
            'c' => 'NAnt es de Microsoft',
            'd' => 'No tienen relación con Ant'
        ],
        'correcta' => 'a',
        'porque'   => 'NAnt suele llamar a MSBuild para compilar. NAnt es hoy un jugador de nicho. Ambos sufren las limitaciones de Ant. Como JUnit/JMock → NUnit/NMock.'
    ],
    'm21' => [
        'texto'    => 'El principio de <b>Maven</b> “convención sobre configuración” significa que…',
        'opciones' => [
            'a' => 'Cada proyecto define su propia estructura',
            'b' => 'Todo debe configurarse en XML extenso',
            'c' => 'Si el proyecto sigue la <b>estructura que dicta Maven</b>, casi cualquier tarea de build/test/deploy/release se hace con un solo comando y pocas líneas de XML',
            'd' => 'No hay ciclo de vida'
        ],
        'correcta' => 'c',
        'porque'   => 'Incluso genera un sitio con el Javadoc por defecto. Además gestiona dependencias entre proyectos y ofrece particionado rígido en componentes.'
    ],
    'm22' => [
        'texto'    => 'Los <b>tres problemas de Maven</b> según el libro:',
        'opciones' => [
            'a' => 'Es lento, feo y caro',
            'b' => 'Rígido si te sales de sus asunciones, DSL XML difícil de extender (hay que escribir plugins/Mojos) y por defecto se <b>auto-actualiza</b> (plugins descargados de Internet) y admite <b>snapshots</b>, lo que impide reproducir builds',
            'c' => 'No gestiona dependencias',
            'd' => 'No genera JARs'
        ],
        'correcta' => 'b',
        'porque'   => 'Relevante hoy: builds reproducibles = lockfiles y versiones fijas.'
    ],
    'm23' => [
        'texto'    => '¿Qué es <b>Ivy</b>?',
        'opciones' => [
            'a' => 'Una herramienta que gestiona librerías y dependencias entre componentes <b>sin usar Maven</b> (para quien sigue con Ant)',
            'b' => 'Un plugin de Maven',
            'c' => 'Un servidor de CI',
            'd' => 'Un framework de pruebas'
        ],
        'correcta' => 'a',
        'porque'   => 'Da parte de los beneficios de Maven a quien está atado a Ant.'
    ],
    'm24' => [
        'texto'    => '¿Por qué descargar dependencias externas desde Internet (repositorio público) no siempre es la mejor opción?',
        'opciones' => [
            'a' => 'Es ilegal',
            'b' => 'No funciona con Java',
            'c' => 'Es más lento siempre',
            'd' => 'La primera ejecución implica esperar a que Maven descargue “media Internet” y, sin disciplina de versiones, aparecen problemas de <b>dependencias en diamante</b> y roturas por cambios de versión sin darte cuenta'
        ],
        'correcta' => 'd',
        'porque'   => 'Conecta con Nexus como proxy y con los lockfiles de la sesión de empaquetamiento.'
    ],
    'm25' => [
        'texto'    => '¿Qué distingue a <b>Rake</b>?',
        'opciones' => [
            'a' => 'Es un <b>DSL interno</b> en Ruby: los scripts son Ruby puro, con todo el poder de un lenguaje de propósito general (refactorizar, depurar con el debugger, stack traces)',
            'b' => 'Es un DSL externo en XML',
            'c' => 'Es una herramienta de Microsoft',
            'd' => 'Es una versión de Make'
        ],
        'correcta' => 'a',
        'porque'   => 'Nació como experimento para reproducir Make con un DSL interno en Ruby. Es un build tool general (Albacore da tareas Rake para .NET).'
    ],
    'm26' => [
        'texto'    => 'Desventajas generales de Rake:',
        'opciones' => [
            'a' => 'No se puede depurar',
            'b' => 'Necesita un runtime decente en la plataforma (JRuby es el más portable) y hay que interactuar con <b>RubyGems</b>; además el equipo necesita conocer algo de Ruby',
            'c' => 'Solo funciona en Ruby on Rails',
            'd' => 'No admite dependencias'
        ],
        'correcta' => 'b',
        'porque'   => 'Igual que Ant o NAnt exigen conocer su propio lenguaje.'
    ],
    'm27' => [
        'texto'    => 'Buildr, Gradle y Gantt comparten la idea de…',
        'opciones' => [
            'a' => 'Ser DSLs externos en XML',
            'b' => 'Ser exclusivos de Windows',
            'c' => 'No gestionar dependencias',
            'd' => 'Escribir los scripts de build en un <b>lenguaje de programación real</b> mediante DSLs internos, sin renunciar a la gestión de dependencias y multiproyecto'
        ],
        'correcta' => 'd',
        'porque'   => 'Buildr está construido sobre Rake, es reemplazo directo de Maven (mismas convenciones: layout, artefactos, repositorios) y ejecuta tareas Ant con cero configuración; usa Rake para builds incrementales y es más rápido que Maven. Gradle: DSL en Groovy.'
    ],
    'm28' => [
        'texto'    => '<b>Psake</b> es…',
        'opciones' => [
            'a' => 'Un DSL interno en <b>PowerShell</b> (task-oriented) para usuarios de Windows',
            'b' => 'Un DSL de Ruby',
            'c' => 'Una versión de Make',
            'd' => 'Un plugin de Maven'
        ],
        'correcta' => 'a',
        'porque'   => 'Se pronuncia “saké”. Permite a Windows disfrutar de la nueva ola de herramientas con DSL interno.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Farley cap. 6 · 1 — Herramientas de build', 'Continuous Delivery, cap. 6 (Build and Deployment Scripting): introducción y panorama de herramientas');
?>

<div class="card">
  <h2>Cómo se usa</h2>
  <p>Tres bloques que cubren <b>todo el capítulo 6</b> de <i>Continuous Delivery</i> (Humble &amp; Farley):
     herramientas de build, principios y prácticas de scripting, y layout / despliegue / tips.
     Este es el <b>bloque 1</b>. El texto original está en inglés, así que los conceptos clave se preguntan en español pero con el vocabulario del libro.</p>
  <div class="nota">Respuestas en <b>texto</b>: no importan mayúsculas ni tildes. Pulsa <b>Enter</b> dentro de un hueco para verificar.
    Lee la explicación de cada opción múltiple aunque aciertes.</div>
</div>

<div class="card">
  <h2>1. Introducción: por qué hay que scriptear</h2>
  <ul>
    <li>En proyectos muy simples basta con las capacidades del <?php hueco(1, 5); ?>, pero eso solo sirve para tareas <?php hueco(2, 10); ?>.</li>
    <li>Sin scripts en equipos grandes o distribuidos (incluido open source), poner a andar a un nuevo miembro puede tardar
        <?php hueco(3, 6); ?>.</li>
    <li>Casi toda plataforma moderna puede correr el build desde la <?php hueco(4, 16); ?>: en Rails, la tarea por defecto de
        <?php hueco(5, 6); ?>; en .NET, <?php hueco(6, 10); ?>; en Java, <?php hueco(7, 8); ?> (Maven, Gradle…); en C/C++ simple, <?php hueco(8, 8); ?>.
        Con eso ya se puede empezar la <?php hueco(9, 20); ?>.</li>
    <li>Desplegar implica <?php hueco(10, 10); ?> la aplicación, <?php hueco(11, 16); ?>, configurar infraestructura y middleware y
        montar sistemas externos <?php hueco(12, 10); ?>.</li>
    <li>Las herramientas de <?php hueco(13, 12); ?> para desplegar dan problemas; la decisión debe tomarse entre
        <?php hueco(14, 26); ?>. Y los sistemas de build se tratan como el <?php hueco(15, 12); ?>.</li>
  </ul>
  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php mc('m3'); ?>
  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>2. Núcleo común: la red de dependencias</h2>
  <p>Todas las herramientas modelan una red de <?php hueco(16, 12); ?>. Al ejecutar, calculan cómo alcanzar el objetivo ejecutando cada tarea
     <?php hueco(17, 20); ?>. Ejemplo: aunque varios objetivos dependan de <code><?php hueco(18, 5); ?></code>, solo se hace una vez, y para
     correr los tests hay que compilar el código <?php hueco(19, 6); ?> (fuentes y tests) y preparar los datos de prueba.</p>
  <p>Una tarea tiene <?php hueco(20, 4); ?> características esenciales: <b><?php hueco(21, 10); ?></b> y <b><?php hueco(22, 12); ?></b>.</p>
  <table class="datos">
    <tr><th>Tipo</th><th>Describe la red en términos de…</th><th>Ejemplos</th><th>Estado entre builds</th></tr>
    <tr><td>Task-oriented</td><td><?php hueco(23, 8); ?></td><td><?php hueco(25, 6); ?>, NAnt, MSBuild</td><td><?php hueco(32, 18); ?></td></tr>
    <tr><td>Product-oriented</td><td><?php hueco(24, 10); ?></td><td><?php hueco(26, 6); ?> (y SCons)</td><td>Timestamps (<?php hueco(29, 10); ?>) o firmas <?php hueco(30, 4); ?> en SCons</td></tr>
  </table>
  <ul>
    <li>Si un prerrequisito se ejecuta <?php hueco(27, 16); ?>, en el mejor caso el build tarda más (si es idempotente) y en el peor el resultado es malo;
        si <?php hueco(28, 10); ?>, el resultado es malo.</li>
    <li>Las herramientas product-oriented permiten el build <?php hueco(31, 12); ?>: solo se compila lo que cambió. Es ideal para
        <?php hueco(33, 6); ?>, donde compilar es lento.</li>
    <li>En lenguajes de VM el compilador solo crea <?php hueco(36, 10); ?> y el compilador <?php hueco(35, 4); ?> optimiza en runtime.</li>
    <li><?php hueco(34, 6); ?> puede funcionar como product-oriented o task-oriented.</li>
  </ul>
  <?php mc('m6'); ?>
  <?php mc('m7'); ?>
  <?php mc('m8'); ?>
  <?php mc('m9'); ?>
  <?php mc('m10'); ?>
  <?php mc('m11'); ?>
  <?php mc('m12'); ?>
  <?php mc('m13'); ?>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>3. Make y SCons</h2>
  <ul>
    <li>Make es una herramienta <?php hueco(37, 18); ?> potente que reconstruye solo lo afectado por un cambio.</li>
    <li>En bases de código grandes se usa un <?php hueco(38, 18); ?> en cada directorio y uno de nivel superior que los ejecuta recursivamente: la información queda dispersa.</li>
    <li>El espacio en blanco importa: los comandos del shell deben ir precedidos de un <?php hueco(39, 8); ?>; si se usan <?php hueco(40, 10); ?>, no funciona.</li>
    <li>Depende del <?php hueco(41, 6); ?> y por tanto del <?php hueco(42, 16); ?>; además es un <?php hueco(43, 8); ?> (DSL) <?php hueco(44, 12); ?> poco familiar.</li>
    <li><?php hueco(45, 8); ?> (escrito en <?php hueco(46, 8); ?>) soporta <?php hueco(47, 10); ?> de serie y builds paralelos.</li>
  </ul>
  <?php mc('m14'); ?>
  <?php mc('m15'); ?>
  <?php mc('m16'); ?>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>4. Ant, NAnt y MSBuild</h2>
  <ul>
    <li>Apache Ant nació de portar <?php hueco(48, 5); ?> a Java y del auge de <?php hueco(49, 5); ?>. Sus tareas están escritas en <?php hueco(50, 5); ?>; es
        <?php hueco(51, 14); ?> y multiplataforma.</li>
    <li>Limitaciones: modelo de dominio <?php hueco(52, 8); ?> (mucho <?php hueco(53, 12); ?>), tags imperativos como <code>&lt;<?php hueco(54, 8); ?>&gt;</code>,
        difícil de consultar; reutilización con <code>import</code> y <code><?php hueco(56, 8); ?></code> poco entendida. Los archivos acaban con
        <?php hueco(55, 6); ?> de líneas y <?php hueco(57, 22); ?>.</li>
    <li><?php hueco(58, 6); ?> usa casi la misma sintaxis que Ant (como <?php hueco(62, 6); ?> respecto a JUnit). <?php hueco(59, 8); ?> es la variante de
        Microsoft, integrada en <?php hueco(60, 14); ?> y distribuida con el .NET framework; desciende directamente de <?php hueco(61, 4); ?>.</li>
  </ul>
  <?php mc('m17'); ?>
  <?php mc('m18'); ?>
  <?php mc('m19'); ?>
  <?php mc('m20'); ?>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>5. Maven e Ivy</h2>
  <ul>
    <li>Filosofía: <?php hueco(63, 30); ?>. Incluso genera un sitio con el <?php hueco(64, 8); ?> por defecto.</li>
    <li>También gestiona automáticamente las librerías y las <?php hueco(65, 12); ?> entre proyectos.</li>
    <li>Problema 1: si el proyecto no encaja con sus asunciones es difícil (o imposible) hacerlo; Ant es más <?php hueco(71, 10); ?>.</li>
    <li>Problema 2: DSL externo en XML → para extenderlo hay que escribir plugins con <?php hueco(72, 8); ?>.</li>
    <li>Problema 3: <?php hueco(67, 24); ?> (descarga sus <?php hueco(68, 8); ?> de Internet) y admite <?php hueco(66, 10); ?>, lo que impide
        <?php hueco(69, 10); ?> un build concreto.</li>
    <li>Con Ant se puede usar <?php hueco(70, 4); ?> para gestionar dependencias sin Maven. La primera ejecución obliga a descargar “<?php hueco(74, 20); ?>”, y sin disciplina se caen en
        conflictos de <?php hueco(73, 10); ?>.</li>
  </ul>
  <?php mc('m21'); ?>
  <?php mc('m22'); ?>
  <?php mc('m23'); ?>
  <?php mc('m24'); ?>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>6. Rake, Buildr, Gradle y Psake</h2>
  <ul>
    <li>Rake es un <?php hueco(76, 12); ?> escrito en <?php hueco(75, 5); ?>. Al fallar da un <?php hueco(77, 12); ?> que ayuda a entender el error.</li>
    <li>Runtime más portable: <?php hueco(78, 6); ?>. Hay que interactuar con <?php hueco(79, 10); ?>. El proyecto <?php hueco(80, 10); ?> aporta tareas Rake para .NET.</li>
    <li><?php hueco(81, 8); ?> está construido sobre Rake y es un reemplazo directo de <?php hueco(82, 8); ?>, con las mismas convenciones; ejecuta tareas <?php hueco(85, 4); ?> con cero configuración.
        Otras del mismo estilo: <?php hueco(83, 8); ?> (DSL Groovy) y <?php hueco(84, 8); ?>.</li>
    <li><?php hueco(87, 8); ?> (se pronuncia “<?php hueco(88, 6); ?>”) es un DSL interno en <?php hueco(86, 12); ?> y es <?php hueco(89, 14); ?>.</li>
  </ul>
  <?php mc('m25'); ?>
  <?php mc('m26'); ?>
  <?php mc('m27'); ?>
  <?php mc('m28'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Menu.php', 'segundo.php');
