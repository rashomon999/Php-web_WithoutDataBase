<?php
/* ==========================================================================
   IngeSoft5 / DevOps2 / Empaquetamiento — bloque 01: La fase de construcción
   Fuente: empaquetamiento_artefactos_inmutabilidad.pdf — Sección 01 (parte 1)
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- la fase de construccion --- */
    1  => ['proceso automatizado que toma codigo fuente'],
    2  => ['resuelve dependencias'],
    3  => ['binario', 'ejecutable'],
    4  => ['Superacion del build manual'],
    5  => ['elimina la dependencia de configuraciones locales de ide', 'elimina la dependencia de configuraciones locales de ides'],
    6  => ['maquina', 'mi maquina'],
    7  => ['reproducibilidad'],
    8  => ['en cualquier runner de CI', 'runner de ci'],
    9  => ['Regla fail-fast', 'Regla fail fast', 'Regla failfast'],
    10 => ['prueba unitaria aborta el pipeline de inmediato', 'abortar', 'detiene'],
    11 => ['quality gate', 'puerta de calidad'],
    84 => ['cualquier error de compilacion'],
    85 => ['debe generar exactamente el mismo resultado'],
    86 => ['generacion del binario', 'generación del binario'],

    /* --- empaquetamiento --- */
    12 => ['atomica', 'unidad atomica'],
    13 => ['jar'],
    14 => ['whl', 'wheel'],
    15 => ['oci'],
    16 => ['main-class', 'main class', 'mainclass'],
    17 => ['entrypoint'],
    18 => ['firmar'],
    19 => ['dispersion'],
    20 => ['dependencias faltantes', 'faltantes'],
    21 => ['ambiguedad'],
    22 => ['inconsistencia'],
    23 => ['reemplaza pasos manuales por artefactos certificados'],
    80 => ['evita copiar ficheros sueltos a servidores'],
    81 => ['empaqueta o fija las librerias necesarias'],
    82 => ['estandariza que y como debe ejecutarse'],
    83 => ['el mismo commit'],

    /* --- ciclo de vida de construccion --- */
    24 => ['checkout'],
    25 => ['resolve'],
    26 => ['compile'],
    27 => ['test'],
    28 => ['package'],
    29 => ['Clonacion limpia del commit exacto'],
    30 => ['Resolucion de dependencias desde repositorio proxy local'],
    31 => ['lockfile', 'lock file', 'archivo lock'],
    32 => ['estatico'],
    33 => ['transpilacion'],
    34 => ['cobertura', 'coverage'],
    35 => ['abortar', 'aborta'],
    36 => ['sha-256', 'sha256'],
    37 => ['Inclusion de metadatos', 'metadatos de version'],
    38 => ['100', '100%'],

    /* --- herramientas por ecosistema --- */
    39 => ['Apache maven'],
    40 => ['gradle'],
    41 => ['go build'],
    42 => ['elf'],
    43 => ['cargo'],
    44 => ['crates.io', 'crates'],
    45 => ['vite'],
    46 => ['poetry'],
    47 => ['wheel', 'whl'],
    48 => ['xml'],
    49 => ['incremental'],

    /* --- maven: fases --- */
    50 => ['validate'],
    51 => ['compile'],
    52 => ['test'],
    53 => ['package'],
    54 => ['verify'],
    55 => ['install'],
    56 => ['deploy'],
    57 => ['target/classes', 'target/classes/'],
    58 => ['junit'],
    59 => ['.m2', '~/.m2'],
    87 => ['Copia el artefacto a la cache local', 'cache local', 'caché', 'cache'],
    88 => ['Ejecuta pruebas de integración y chequeos', 'integracion y chequeos'],
    60 => ['nexus'],
    61 => ['previas', 'anteriores'],

    /* --- pom.xml --- */
    62 => ['gav'],
    63 => ['groupid'],
    64 => ['artifactid'],
    65 => ['version'],
    66 => ['packaging'],
    67 => ['dominio invertido'],
    68 => ['semver', 'versionamiento semantico'],
    89 => ['coordenadas gav', 'coordenadas'],
    90 => ['groupId', 'groupid'],
    91 => ['artifactId', 'artifactid'],
    92 => ['version', 'versiones'],
    93 => ['packaging'],
    94 => ['Dependencies', 'dependencias'],
    69 => ['4.0.0'],
    70 => ['project object model', 'pom'],

    /* --- lineas completas --- */
    71 => 'mvn clean verify --batch-mode',
    72 => '<groupId>co.edu.icesi.ingesoft</groupId>',
    73 => 'mvn deploy',
    74 => ['construccion y empaquetamiento', 'construccion empaquetamiento'],
    75 => ['codigo fuente'],
    76 => ['ejecutable verificable'],
    78 => ['reproducible'],
    79 => ['optimizado'],
];

$TEXTO = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,74,75,76,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94];

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Según la sesión, ¿cuál es la <b>definición</b> de la fase de construcción (build phase)?',
        'opciones' => [
            'a' => 'Copiar a mano los ficheros compilados desde el IDE del desarrollador al servidor',
            'b' => 'Proceso automatizado que toma el código fuente, resuelve dependencias y produce un binario ejecutable',
            'c' => 'Escribir el código fuente y hacerle commit a Git',
            'd' => 'Desplegar la aplicación en producción'
        ],
        'correcta' => 'b',
        'porque'   => 'Las tres piezas de la definición: <b>automatizado</b>, <b>resuelve dependencias</b> y <b>produce un binario ejecutable</b>.'
    ],
    'm2' => [
        'texto'    => '¿Qué problema clásico elimina el build automatizado frente al build manual?',
        'opciones' => [
            'a' => 'La necesidad de escribir pruebas',
            'b' => 'La existencia de dependencias transitivas',
            'c' => 'La dependencia de las configuraciones locales de los IDEs: el famoso “en mi máquina compila”',
            'd' => 'El uso de control de versiones'
        ],
        'correcta' => 'c',
        'porque'   => 'Superar el build manual = quitar la dependencia de la configuración local de cada IDE. El build lo hace un motor desatendido y limpio.'
    ],
    'm3' => [
        'texto'    => 'La <b>reproducibilidad</b> del build exige que…',
        'opciones' => [
            'a' => 'El mismo commit, en cualquier runner de CI, genere exactamente el mismo resultado',
            'b' => 'El build tarde siempre lo mismo',
            'c' => 'Cada desarrollador compile en su portátil con la misma versión del IDE',
            'd' => 'Se guarde una copia del build en el correo'
        ],
        'correcta' => 'a',
        'porque'   => 'Reproducibilidad = mismo commit → mismo resultado, sin importar el runner. Es la base de todo lo demás (lockfiles, multi-stage, inmutabilidad).'
    ],
    'm4' => [
        'texto'    => 'La regla <b>Fail-Fast</b> del build dice que…',
        'opciones' => [
            'a' => 'Los errores de compilación se registran y se corrigen la semana siguiente',
            'b' => 'Solo los errores de compilación detienen el pipeline; los de linter se ignoran',
            'c' => 'Las pruebas unitarias se ejecutan solo en producción',
            'd' => 'Cualquier error de compilación, linter o prueba unitaria aborta el pipeline de inmediato'
        ],
        'correcta' => 'd',
        'porque'   => 'Los tres: compilación, linter y prueba unitaria. Aborta <b>de inmediato</b>, no al final.'
    ],
    'm5' => [
        'texto'    => '¿Por qué se dice que el build es la <b>primera puerta de calidad (Quality Gate)</b>?',
        'opciones' => [
            'a' => 'Porque si el código no construye de forma limpia y desatendida, no puede ingresar a la cadena de valor',
            'b' => 'Porque es lo único que se prueba antes de producción',
            'c' => 'Porque el build lo aprueba el gerente',
            'd' => 'Porque genera la documentación'
        ],
        'correcta' => 'a',
        'porque'   => 'Es la primera compuerta: código que no construye limpio y sin supervisión no avanza.'
    ],
    'm6' => [
        'texto'    => '¿Qué es el <b>empaquetamiento</b> según la sesión?',
        'opciones' => [
            'a' => 'Comprimir el repositorio Git en un zip',
            'b' => 'Consolidar el código compilado, recursos y dependencias en una unidad atómica distribuible (.jar, .whl, imagen OCI)',
            'c' => 'Escribir la documentación de despliegue',
            'd' => 'Instalar las herramientas en el servidor'
        ],
        'correcta' => 'b',
        'porque'   => 'Transforma archivos dispersos en un único entregable, con punto de entrada explícito y capaz de versionarse y firmarse.'
    ],
    'm7' => [
        'texto'    => '¿Cuál de estos es un <b>punto de entrada explícito</b>?',
        'opciones' => [
            'a' => '<code>pom.xml</code> y <code>package.json</code>',
            'b' => '<code>target/</code> y <code>~/.m2</code>',
            'c' => '<code>Main-Class</code> (JAR) y <code>ENTRYPOINT</code> (imagen de contenedor)',
            'd' => '<code>SHA-256</code> y <code>SemVer</code>'
        ],
        'correcta' => 'c',
        'porque'   => 'El empaquetado define <b>cómo</b> se arranca: Main-Class en el manifiesto de un JAR, ENTRYPOINT en un Dockerfile.'
    ],
    'm8' => [
        'texto'    => 'Empaquetar “reemplaza pasos manuales por artefactos certificados”. ¿Qué problema de los listados resuelve eso?',
        'opciones' => [
            'a' => 'Dispersión',
            'b' => 'Ambigüedad',
            'c' => 'Dependencias faltantes',
            'd' => 'Inconsistencia'
        ],
        'correcta' => 'd',
        'porque'   => 'Los cuatro: <b>dispersión</b> (ficheros sueltos a servidores), <b>dependencias faltantes</b> (empaqueta o fija librerías), <b>ambigüedad</b> (estandariza qué y cómo se ejecuta) e <b>inconsistencia</b> (pasos manuales → artefactos certificados).'
    ],
    'm9' => [
        'texto'    => 'Elige el <b>orden correcto</b> del ciclo de vida de construcción:',
        'opciones' => [
            'a' => 'Compile → Checkout → Resolve → Package → Test',
            'b' => 'Checkout → Resolve → Compile → Test → Package',
            'c' => 'Checkout → Compile → Resolve → Package → Test',
            'd' => 'Resolve → Checkout → Test → Compile → Package'
        ],
        'correcta' => 'b',
        'porque'   => '1 Checkout, 2 Resolve, 3 Compile, 4 Test, 5 Package. Las fases son estrictamente dependientes.'
    ],
    'm10' => [
        'texto'    => 'En la fase <b>Resolve</b>, ¿de dónde se descargan las dependencias y contra qué se coteja?',
        'opciones' => [
            'a' => 'De Internet directamente; se coteja con el README',
            'b' => 'Del disco del desarrollador; se coteja con el IDE',
            'c' => 'De un repositorio proxy local; se coteja con el lockfile',
            'd' => 'De Git; se coteja con el pom de producción'
        ],
        'correcta' => 'c',
        'porque'   => 'Descarga desde repositorio proxy local (tipo Nexus) y cotejo con el lockfile: así se garantiza determinismo.'
    ],
    'm11' => [
        'texto'    => 'Un test falla en la fase Test. ¿Qué debe pasar?',
        'opciones' => [
            'a' => 'Se empaqueta igualmente y se marca como “inestable”',
            'b' => 'Se aborta el build: no se empaqueta si las pruebas no pasan al 100 %',
            'c' => 'Se reintenta hasta que pase',
            'd' => 'Se salta la fase y se continúa con Package'
        ],
        'correcta' => 'b',
        'porque'   => 'Principio cardinal: fallo en test = abortar build. Las fases son dependientes.'
    ],
    'm12' => [
        'texto'    => '¿Qué se calcula durante la fase <b>Package</b>, además de generar el binario?',
        'opciones' => [
            'a' => 'La cobertura de pruebas',
            'b' => 'El hash SHA-256 y se incluyen metadatos de versión',
            'c' => 'El lockfile',
            'd' => 'La licencia de las dependencias'
        ],
        'correcta' => 'b',
        'porque'   => 'Package: genera el binario (JAR, OCI), incluye metadatos de versión y calcula el hash SHA-256 (base de la integridad).'
    ],
    'm13' => [
        'texto'    => '¿Cuál es la herramienta de build de <b>Go</b> y qué produce?',
        'opciones' => [
            'a' => 'Maven, un JAR',
            'b' => 'Cargo, un crate',
            'c' => 'npm, un tarball',
            'd' => '<code>go build</code> (toolchain nativo): binarios estáticos ELF autocontenidos sin runtime externo'
        ],
        'correcta' => 'd',
        'porque'   => 'Go compila a un ejecutable estático ELF sin necesitar runtime. Rust usa Cargo (crates.io). Java: Maven/Gradle.'
    ],
    'm14' => [
        'texto'    => 'Diferencia central entre <b>Maven</b> y <b>Gradle</b> según la sesión:',
        'opciones' => [
            'a' => 'Maven es declarativo (XML) con ciclo rígido; Gradle usa DSL Groovy/Kotlin y es incremental',
            'b' => 'Maven usa Groovy y Gradle usa XML',
            'c' => 'Maven es para Node y Gradle para Python',
            'd' => 'No hay diferencia, son el mismo programa'
        ],
        'correcta' => 'a',
        'porque'   => 'Maven: declarativo XML, ciclo rígido. Gradle: Groovy/Kotlin DSL, incremental. Ambos producen JARs/WARs.'
    ],
    'm15' => [
        'texto'    => '¿Qué empaqueta Python con <b>Poetry, pipenv o flit</b>?',
        'opciones' => [
            'a' => 'Binarios ELF',
            'b' => 'Distribuibles en formato Wheel (.whl) con resolución determinista de dependencias',
            'c' => 'Imágenes OCI',
            'd' => 'Charts de Helm'
        ],
        'correcta' => 'b',
        'porque'   => 'Poetry/pipenv/flit → Wheel (.whl). En Node: npm/pnpm/yarn con bundlers Vite, Webpack, esbuild.'
    ],
    'm16' => [
        'texto'    => '¿Cuál es la diferencia entre <code>install</code> y <code>deploy</code> en Maven?',
        'opciones' => [
            'a' => '<code>install</code> publica en Nexus y <code>deploy</code> copia a ~/.m2',
            'b' => '<code>install</code> copia el artefacto a la caché local (~/.m2); <code>deploy</code> lo publica en el repositorio remoto (Nexus)',
            'c' => 'Son sinónimos',
            'd' => '<code>install</code> ejecuta pruebas y <code>deploy</code> compila'
        ],
        'correcta' => 'b',
        'porque'   => 'package → JAR en target/; install → ~/.m2 (local); deploy → repositorio remoto.'
    ],
    'm17' => [
        'texto'    => 'Ejecutas <code>mvn deploy</code>. ¿Qué pasa con las fases anteriores?',
        'opciones' => [
            'a' => 'Se saltan; deploy va directo a Nexus',
            'b' => 'Hay que ejecutarlas a mano una por una',
            'c' => 'Solo se ejecuta validate',
            'd' => 'Se ejecutan automáticamente todas las fases previas (validate, compile, test, package, verify, install)'
        ],
        'correcta' => 'd',
        'porque'   => 'Regla secuencial de Maven: pedir una fase ejecuta todas las anteriores al 100 %.'
    ],
    'm18' => [
        'texto'    => '¿Qué fase de Maven corre las <b>pruebas unitarias (JUnit) sin empaquetar</b>?',
        'opciones' => [
            'a' => '<code>verify</code>',
            'b' => '<code>test</code>',
            'c' => '<code>package</code>',
            'd' => '<code>validate</code>'
        ],
        'correcta' => 'b',
        'porque'   => 'test = unitarias JUnit sin empaquetar. verify = pruebas de integración y chequeos. validate = estructura y metadatos del proyecto.'
    ],
    'm19' => [
        'texto'    => '¿Qué significan las coordenadas <b>GAV</b> del pom.xml?',
        'opciones' => [
            'a' => 'Group, Artifact, Version: <code>groupId</code> (dominio invertido), <code>artifactId</code> (nombre único del módulo), <code>version</code> (SemVer)',
            'b' => 'Git, Artifact, Verify',
            'c' => 'Gradle, Ant, Vite',
            'd' => 'Group, Alias, Variable'
        ],
        'correcta' => 'a',
        'porque'   => 'GAV = groupId + artifactId + version. Además: packaging (jar/war/pom) y dependencies.'
    ],
    'm20' => [
        'texto'    => '¿Cuál es el <b>comando CI recomendado</b> para Maven según la sesión?',
        'opciones' => [
            'a' => '<code>mvn install -DskipTests</code>',
            'b' => '<code>mvn package</code>',
            'c' => '<code>mvn clean verify --batch-mode</code>',
            'd' => '<code>mvn compile</code>'
        ],
        'correcta' => 'c',
        'porque'   => '<code>clean</code> parte de cero, <code>verify</code> incluye pruebas e integración, <code>--batch-mode</code> evita interactividad en el runner. Ojo: <b>-DskipTests</b> está en la lista de lo que NUNCA debe hacerse.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Empaquetamiento · 1 — La fase de construcción', 'empaquetamiento_artefactos_inmutabilidad.pdf — Sección 01: build, empaquetado, ciclo de vida, Maven');
?>

<div class="card">
  <h2>Cómo se usa</h2>
  <p>Cinco bloques que cubren <b>toda</b> la presentación “Empaquetamiento, Artefactos e Inmutabilidad”
    (Prof. Alejandro Muñoz Bravo). Este es el <b>bloque 1: <?php hueco(74, 30); ?></b>.
    Del <?php hueco(75, 14); ?> al <?php hueco(76, 25); ?>,
    <?php hueco(78, 14); ?> y <?php hueco(79, 14); ?>
    </p>
  <div class="nota">Respuestas en <b>texto</b>: no importan mayúsculas ni tildes. Pulsa <b>Enter</b> dentro de un hueco para verificar.
    Las líneas de código sí respetan la forma exacta (te avisa en naranja si solo fallaste mayúsculas).
    Lee la explicación de cada opción múltiple aunque aciertes.</div>
</div>

<div class="card">
  <h2>1. La fase de construcción (Build Phase)</h2>
  <ul>
    <li><b>Definición:</b>   <?php hueco(1, 43); ?>  ,   <?php hueco(2, 21); ?> y produce un <?php hueco(3, 10); ?> ejecutable.</li>
    <li><b> </b> <?php hueco(4, 26); ?>:   <?php hueco(5, 57); ?>
        (“en mi <?php hueco(6, 8); ?> compila”).</li>
    <li><b><?php hueco(7, 16); ?>:</b> <?php hueco(83, 18); ?>,   <?php hueco(8, 24); ?>  , <?php hueco(85, 45); ?>.</li>
    <li><b>  <?php hueco(9, 15); ?>:</b> <?php hueco(84, 30); ?>, linter o   <?php hueco(10, 47); ?>  .</li>
  </ul>
  <div class="avisoflujo"><b>Fundamento DevOps.</b> El build es la primera puerta de calidad
     (<?php hueco(11, 14); ?>). Si el código no construye de forma limpia y desatendida, no puede ingresar a la cadena de valor.</div>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>2. ¿Qué es el empaquetamiento y qué problema resuelve?</h2>
  <p>Consolidación del código compilado, recursos y dependencias en una unidad <?php hueco(12, 10); ?> distribuible.</p>
  <ul>
    <li>Transforma archivos dispersos en un único entregable: <code>.<?php hueco(13, 5); ?></code>,
        <code>.<?php hueco(14, 5); ?></code>, imagen <?php hueco(15, 5); ?>.</li>
    <li>Define un <b>punto de entrada explícito</b>: <code><?php hueco(16, 12); ?></code> (JAR) y <code><?php hueco(17, 12); ?></code> (contenedor).</li>
    <li>Permite versionar y <?php hueco(18, 8); ?> el producto completo.</li>
  </ul>

  <table class="datos">
    <tr><th>Problema</th><th>Cómo lo resuelve el empaquetamiento</th></tr>
    <tr><td><?php hueco(19, 12); ?></td><td><?php hueco(80, 48); ?>.</td></tr>
    <tr><td><?php hueco(20, 20); ?></td><td><?php hueco(81, 48); ?>.</td></tr>
    <tr><td><?php hueco(21, 12); ?></td><td><?php hueco(82, 44); ?>.</td></tr>
    <tr><td><?php hueco(22, 14); ?></td><td><?php hueco(23, 56); ?>.</td></tr>
  </table>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>3. Anatomía del ciclo de vida de construcción</h2>
  <p>Flujo secuencial estándar de los motores de automatización de build:</p>
  <table class="datos">
    <tr><th>#</th><th>Fase</th><th>Qué hace</th></tr>
    <tr><td class="idx">1</td><td><?php hueco(24, 10); ?></td>
        <td>  <?php hueco(29, 34); ?>. Descarga del repo Git sin residuos locales.</td></tr>
    <tr><td class="idx">2</td><td><?php hueco(25, 10); ?></td>
        <td>  <?php hueco(30, 56); ?>  . Cotejo con el <?php hueco(31, 10); ?>.</td></tr>
    <tr><td class="idx">3</td><td><?php hueco(26, 10); ?></td>
        <td>Compilación a bytecode o binario. Linters y análisis <?php hueco(32, 10); ?>. <?php hueco(33, 14); ?> de código.</td></tr>
    <tr><td class="idx">4</td><td><?php hueco(27, 10); ?></td>
        <td>Pruebas unitarias automatizadas. Cálculo de <?php hueco(34, 10); ?> (coverage). Fallo en test = <?php hueco(35, 8); ?> el build.</td></tr>
    <tr><td class="idx">5</td><td><?php hueco(28, 8); ?></td>
        <td><?php hueco(86, 22); ?> (JAR, OCI).   <?php hueco(37, 22); ?> de versión. Cálculo del hash <?php hueco(36, 10); ?>.</td></tr>
  </table>
  <div class="avisoflujo"><b>Principio cardinal.</b> Las fases son estrictamente dependientes: no se empaqueta si las pruebas
     no pasan al <?php hueco(38, 4); ?> %.</div>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>4. Herramientas de build por ecosistema</h2>
  <div class="tabla-doble">
    <div class="tabla-col">
      <h3>Ecosistema compilado / tipado</h3>
      <ul class="ecosistema-lista">
        <li><strong>Java / JVM:</strong> <?php hueco(39, 15); ?> (declarativo <?php hueco(48, 4); ?>, ciclo rígido) y <?php hueco(40, 8); ?> (Groovy/Kotlin DSL, <?php hueco(49, 12); ?>). Producen JARs/WARs.</li>
        <li><strong>Go:</strong> Toolchain nativo (<code><?php hueco(41, 10); ?></code>): binarios estáticos <?php hueco(42, 5); ?> autocontenidos, sin runtime externo.</li>
        <li><strong>Rust:</strong> <?php hueco(43, 8); ?> gestiona dependencias (<?php hueco(44, 10); ?>), compilación y tests con máximas garantías de memoria.</li>
      </ul>
    </div>
    <div class="tabla-col">
      <h3>Ecosistema scripting / web</h3>
      <ul class="ecosistema-lista">
        <li><strong>Node.js / TypeScript:</strong> npm, pnpm o yarn con bundlers (<?php hueco(45, 6); ?>, Webpack, esbuild). Resuelven dependencias y empaquetan bundles.</li>
        <li><strong>Python:</strong> <?php hueco(46, 8); ?>, pipenv y flit. Empaquetan distribuciones en formato <?php hueco(47, 8); ?> (<code>.whl</code>) con resolución determinista.</li>
      </ul>
    </div>
  </div>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>5. Fases del Build Lifecycle en Apache Maven</h2>
  <div class="tabla-doble">
    <div class="tabla-col">
      <h3>Fases de Desarrollo y Test</h3>
      <ul class="ecosistema-lista">
        <li><strong><?php hueco(50, 9); ?>:</strong> Verifica la estructura y metadatos del proyecto.</li>
        <li><strong><?php hueco(51, 9); ?>:</strong> Compila el código fuente a bytecode en <code><?php hueco(57, 14); ?></code>.</li>
        <li><strong><?php hueco(52, 9); ?>:</strong> Ejecuta pruebas unitarias (<?php hueco(58, 6); ?>) sin empaquetar.</li>
      </ul>
    </div>
    <div class="tabla-col">
      <h3>Empaquetado y Distribución</h3>
      <ul class="ecosistema-lista">
        <li><strong><?php hueco(53, 9); ?>:</strong> Empaqueta el bytecode en <code>.jar</code> o <code>.war</code>.</li>
        <li><strong><?php hueco(54, 9); ?>:</strong>   <?php hueco(88, 41); ?>.</li>
        <li><strong><?php hueco(55, 9); ?>:</strong> <?php hueco(87, 36); ?> (<code><?php hueco(59, 8); ?></code>).</li>
        <li><strong><?php hueco(56, 9); ?>:</strong> Publica el binario en el repositorio remoto (<?php hueco(60, 8); ?>).</li>
      </ul>
    </div>
  </div>
  <div class="avisoflujo"><b>Regla secuencial.</b> Ejecutar <code>mvn deploy</code> ejecuta automáticamente todas las fases
     <?php hueco(61, 8); ?> al 100 %.</div>

  <h3>Escríbelo de memoria</h3>
  <?php linea(71, 'El <b>comando CI recomendado</b>: limpia, verifica (incluye pruebas e integración) y sin interacción.', 'mvn ...'); ?>
  <?php ayuda('Tres partes: <code>clean</code>, <code>verify</code> y la bandera larga <code>--batch-mode</code>.'); ?>
  <?php linea(73, 'El comando que dispara <b>todas</b> las fases hasta publicar en el repositorio remoto.', 'mvn ...'); ?>

  <?php enviar(); ?>
</div>

<div class="card">
  <h2>6. Anatomía del descriptor: pom.xml</h2>
  <div class="pom-layout">
    <div>
      <p class="pom-intro">El <b>Project Object Model</b> define:</p>
      <ul class="pom-lista">
        <li><strong><?php hueco(89, 18); ?>:</strong>
          <ul class="pom-sublista">
            <li><strong><?php hueco(90, 8); ?>:</strong> <?php hueco(67, 16); ?> de la organización.</li>
            <li><strong><?php hueco(91, 10); ?>:</strong> nombre único del módulo.</li>
            <li><strong><?php hueco(92, 8); ?>:</strong> versión <?php hueco(68, 8); ?>.</li>
          </ul>
        </li>
        <li><strong><?php hueco(93, 10); ?>:</strong> formato del entregable (jar, war, pom).</li>
        <li><strong><?php hueco(94, 12); ?>:</strong> librerías externas para compilación y runtime.</li>
      </ul>
      <p class="pom-intro" style="margin-top:14px;">El <code>modelVersion</code> del ejemplo es <code><?php hueco(69, 6); ?></code>.</p>
    </div>

    <div class="pom-panel">
      <div class="pom-head">pom.xml (Estructura Estándar)</div>
      <div class="pom-body">
        <pre class="pom-code">&lt;project xmlns="http://maven.apache.org/POM/4.0.0"&gt;
  &lt;modelVersion&gt;4.0.0&lt;/modelVersion&gt;
  &lt;groupId&gt;co.edu.icesi.ingesoft&lt;/groupId&gt;
  &lt;artifactId&gt;servicio-pedidos&lt;/artifactId&gt;
  &lt;version&gt;1.4.0&lt;/version&gt;
  &lt;packaging&gt;jar&lt;/packaging&gt;

  &lt;dependencies&gt;
    &lt;dependency&gt;
      &lt;groupId&gt;org.springframework.boot&lt;/groupId&gt;
      &lt;artifactId&gt;spring-boot-starter-web&lt;/artifactId&gt;
      &lt;version&gt;3.2.3&lt;/version&gt;
    &lt;/dependency&gt;
  &lt;/dependencies&gt;
&lt;/project&gt;</pre>
      </div>
    </div>
  </div>

  <?php linea(72, 'Escribe la línea del <b>groupId</b> del ejemplo (dominio invertido de Icesi, sección ingesoft).', '<groupId>...</groupId>'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Menu.php', 'segundo.php');
