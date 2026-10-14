<?php
/* ==========================================================================
   IngeSoft5 / DevOps2 / Empaquetamiento — bloque 02: Dependencias, lockfiles,
   contenedores y multi-stage.
   Fuente: empaquetamiento_artefactos_inmutabilidad.pdf — Sección 01 (parte 2)
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- dependencias y dependency hell --- */
    1  => ['Dependencias directas'],
    2  => ['Dependencias transitivas'],
    3  => ['diamante', 'conflicto de diamante'],
    4  => ['1.2'],
    5  => ['2.0'],
    6  => ['flotantes', 'versiones flotantes'],
    7  => ['latest'],
    8  => ['distinto', 'diferente'],
    9  => ['80', '80%'],
    10 => ['90', '90%'],
    11 => ['terceros'],
    12 => ['Sin control determinista el sistema es inestable por diseño'],

    /* --- lockfiles --- */
    13 => ['manifiesto', 'archivo manifiesto'],
    14 => ['rangos'],
    15 => ['martes'],
    16 => ['package-lock.json'],
    17 => ['poetry.lock'],
    18 => ['gradle.lockfile'],
    19 => ['pinning', 'version exacta'],
    20 => ['hash', 'hash de integridad'],
    21 => ['git'],
    22 => ['npm ci'],
    23 => ['deterministas', 'deterministicos'],

    /* --- contenedor como artefacto --- */
    24 => ['sino tambien el runtime'],
    25 => ['jvm'],
    26 => ['aislamiento de entorno', 'aislamiento de entorno'],
    27 => ['linux'],
    28 => ['open container initiative', 'oci'],
    29 => ['podman'],
    30 => ['kubernetes'],
    31 => ['autosuficiente'],
    32 => ['host'],
    60 => ['Empaquetado integral'],
    61 => ['no solo empaqueta el binario'],
    62 => ['elimina diferencias entre máquinas de desarrollo'],
    63 => ['servidores de ejecucion'],

    /* --- multi-stage --- */
    33 => ['850'],
    34 => ['120'],
    35 => ['superficie de ataque', 'superficie'],
    36 => ['builder'],
    37 => ['jre'],
    38 => ['1001'],
    39 => ['root', 'no-root', 'no root'],
    40 => ['compiladores'],
    41 => ['from'],
    42 => ['as'],

    /* --- buenas practicas --- */
    43 => ['Builds hermeticos', 'builds hermeticos'],
    44 => ['lockfiles'],
    45 => ['cacheo de capas', 'cacheo'],
    46 => ['antes'],
    47 => ['multi-stage obligatorio', 'multi stage obligatorio', 'multistage obligatorio'],
    48 => ['pruebas unitarias', 'tests', 'pruebas'],
    49 => ['Compilar en produccion'],
    50 => ['secretos en capas', 'secretos'],
    51 => ['-dskiptests', 'dskiptests'],

    /* --- lineas --- */
    52 => 'FROM maven:3.9-eclipse-temurin-17 AS builder',
    53 => 'COPY --from=builder /build/target/*.jar app.jar',
    54 => 'USER 1001',
    55 => 'ENTRYPOINT ["java", "-jar", "app.jar"]',
    56 => 'RUN mvn dependency:go-offline',
    57 => 'npm ci',
    58 => ['librerías declaradas explícitamente en el archivo del proyecto', 'librerias declaradas explicitamente en el archivo del proyecto'],
    59 => ['librerías que nuestras dependencias necesitan para operar', 'librerias que nuestras dependencias necesitan para operar'],
];

$TEXTO = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,58,59,60,61,62,63];

$MULTIPLE = [
    'm1' => [
        'texto'    => '¿Qué diferencia hay entre dependencias <b>directas</b> y <b>transitivas</b>?',
        'opciones' => [
            'a' => 'Las directas son las de testing y las transitivas las de producción',
            'b' => 'Las directas las declara explícitamente el proyecto; las transitivas son las que <b>esas dependencias necesitan</b> para operar',
            'c' => 'Las transitivas son las que se descargan más rápido',
            'd' => 'No hay diferencia práctica'
        ],
        'correcta' => 'b',
        'porque'   => 'Directas = las escribes tú en el archivo del proyecto. Transitivas = las que traen las anteriores (y las de estas, etc.).'
    ],
    'm2' => [
        'texto'    => 'La librería A requiere C v1.2 y la librería B requiere C v2.0. ¿Cómo se llama este problema?',
        'opciones' => [
            'a' => 'Efecto avalancha',
            'b' => 'Git bloat',
            'c' => '<b>Conflicto de diamante</b> (dependency hell)',
            'd' => 'Configuration drift'
        ],
        'correcta' => 'c',
        'porque'   => 'Dos ramas del árbol piden versiones incompatibles de la misma librería: conflicto de diamante.'
    ],
    'm3' => [
        'texto'    => 'La sesión dice que entre el <b>80 % y el 90 %</b> del código de una aplicación moderna…',
        'opciones' => [
            'a' => 'Lo escribe el equipo de QA',
            'b' => 'Es código muerto',
            'c' => 'Proviene de <b>librerías de terceros</b>; sin control determinista el sistema es inestable por diseño',
            'd' => 'Son pruebas unitarias'
        ],
        'correcta' => 'c',
        'porque'   => 'Riesgo crítico: casi todo lo que corre no lo escribiste tú, y si no lo controlas de forma determinista, el sistema es inestable por diseño.'
    ],
    'm4' => [
        'texto'    => '¿Por qué son peligrosas las <b>versiones flotantes</b> (<code>^1.2.0</code>, <code>latest</code>)?',
        'opciones' => [
            'a' => 'Porque ocupan más disco',
            'b' => 'Porque dos builds del <b>mismo commit</b> pueden descargar código <b>distinto</b> en días diferentes',
            'c' => 'Porque no funcionan en Linux',
            'd' => 'Porque impiden usar Maven'
        ],
        'correcta' => 'b',
        'porque'   => 'Los rangos permiten que el gestor resuelva la versión más nueva del momento: el build del lunes funciona y el del martes falla sin cambios en Git.'
    ],
    'm5' => [
        'texto'    => 'El build del lunes funciona; el del martes falla “misteriosamente” <b>sin cambios en Git</b>. La causa más probable es…',
        'opciones' => [
            'a' => 'Un autor de una librería publicó un <b>parche defectuoso</b> y el archivo manifiesto admitía rangos abiertos',
            'b' => 'Que el runner se cansó',
            'c' => 'Que el compilador cambió el fin de semana',
            'd' => 'Que Git corrompió el commit'
        ],
        'correcta' => 'a',
        'porque'   => 'Es el escenario exacto del PDF sobre el archivo manifiesto (package.json, requirements.txt, build.gradle) con rangos.'
    ],
    'm6' => [
        'texto'    => '¿Qué registra un <b>lockfile</b> de cada librería?',
        'opciones' => [
            'a' => 'Su documentación y licencia',
            'b' => 'El autor y la fecha de publicación',
            'c' => 'La <b>versión exacta (pinning)</b> y el <b>hash de integridad criptográfico</b>',
            'd' => 'Solo el nombre'
        ],
        'correcta' => 'c',
        'porque'   => 'Ejemplos: package-lock.json, poetry.lock, gradle.lockfile. Pinning + hash criptográfico = determinismo.'
    ],
    'm7' => [
        'texto'    => '<b>Regla mandatoria</b> sobre el lockfile:',
        'opciones' => [
            'a' => 'Se agrega a .gitignore',
            'b' => 'Se genera solo en producción',
            'c' => 'Se regenera en cada build',
            'd' => '<b>DEBE estar en Git</b> y usarse en CI con comandos deterministas (<code>npm ci</code>)'
        ],
        'correcta' => 'd',
        'porque'   => 'Si el lockfile no está versionado, cada runner puede resolver cosas distintas. En Node el comando determinista es <code>npm ci</code> (no <code>npm install</code>).'
    ],
    'm8' => [
        'texto'    => 'En CI de un proyecto Node, ¿qué comando corresponde para instalar de forma <b>determinista</b> según el lockfile?',
        'opciones' => [
            'a' => '<code>npm install</code>',
            'b' => '<code>npm ci</code>',
            'c' => '<code>npm update</code>',
            'd' => '<code>npm audit</code>'
        ],
        'correcta' => 'b',
        'porque'   => '<code>npm ci</code> instala exactamente lo que dice el lockfile. <code>npm audit</code> es SCA (vulnerabilidades).'
    ],
    'm9' => [
        'texto'    => '¿Qué cubre el contenedor como artefacto que <b>no</b> cubre un JAR?',
        'opciones' => [
            'a' => 'Solo el código fuente',
            'b' => 'El runtime (JVM, Node), las librerías del SO y variables base: es <b>autosuficiente</b>',
            'c' => 'Solo las pruebas',
            'd' => 'Nada distinto'
        ],
        'correcta' => 'b',
        'porque'   => 'Un .jar requiere que el host tenga la versión exacta de Java; una imagen OCI trae todo lo necesario para ejecutarse.'
    ],
    'm10' => [
        'texto'    => 'La <b>estandarización OCI</b> (Open Container Initiative) permite que…',
        'opciones' => [
            'a' => 'Las imágenes solo corran en Docker',
            'b' => 'Solo Kubernetes pueda ejecutarlas',
            'c' => 'Un formato universal de imágenes y distribución sea compatible con <b>Docker, Podman y Kubernetes</b>',
            'd' => 'Las imágenes se compilen en el servidor de producción'
        ],
        'correcta' => 'c',
        'porque'   => 'OCI = formato universal para imágenes y su distribución.'
    ],
    'm11' => [
        'texto'    => 'El <b>aislamiento de entorno</b> de los contenedores elimina diferencias entre…',
        'opciones' => [
            'a' => 'Máquinas de desarrollo (macOS, Windows) y servidores de ejecución (Linux en la nube)',
            'b' => 'Ramas de Git',
            'c' => 'Versiones de SemVer',
            'd' => 'Pruebas unitarias e integración'
        ],
        'correcta' => 'a',
        'porque'   => 'Lo que corre en tu portátil (macOS/Windows) corre igual en el servidor Linux de la nube.'
    ],
    'm12' => [
        'texto'    => 'El Dockerfile <b>monolítico</b> (anti-patrón) del PDF produce…',
        'opciones' => [
            'a' => 'Una imagen de 120 MB con solo el JRE',
            'b' => 'Una imagen de <b>850 MB</b> con compiladores y fuentes en producción y enorme superficie de ataque',
            'c' => 'Un binario estático',
            'd' => 'Una imagen sin ENTRYPOINT'
        ],
        'correcta' => 'b',
        'porque'   => 'Parte de <code>maven:3.9-eclipse-temurin-17</code> y deja Maven, el JDK y el código fuente dentro de la imagen final.'
    ],
    'm13' => [
        'texto'    => 'El Dockerfile <b>multi-stage</b> del PDF logra…',
        'opciones' => [
            'a' => '120 MB, solo el <b>JRE mínimo</b> (<code>eclipse-temurin:17-jre-alpine</code>), usuario <b>no-root</b> (1001) y cero compiladores',
            'b' => '850 MB pero más rápido',
            'c' => 'Ejecutar Maven en producción',
            'd' => 'Eliminar la necesidad de un Dockerfile'
        ],
        'correcta' => 'a',
        'porque'   => 'Etapa 1 (builder) compila; etapa 2 (runtime) solo copia el JAR con <code>COPY --from=builder</code>, corre como <code>USER 1001</code> y usa <code>ENTRYPOINT</code>.'
    ],
    'm14' => [
        'texto'    => '¿Para qué sirve <code>RUN mvn dependency:go-offline</code> en la etapa builder?',
        'opciones' => [
            'a' => 'Para apagar la red del runner',
            'b' => 'Para publicar en Nexus',
            'c' => 'Para descargar las dependencias <b>antes de copiar el código</b> y aprovechar el <b>cacheo de capas</b>',
            'd' => 'Para compilar sin pruebas'
        ],
        'correcta' => 'c',
        'porque'   => 'Se copia primero <code>pom.xml</code> y se resuelven dependencias; solo cuando cambie el pom se invalida esa capa. El código (<code>COPY src</code>) cambia más y va después.'
    ],
    'm15' => [
        'texto'    => 'Buena práctica de <b>cacheo de capas</b> en el Dockerfile:',
        'opciones' => [
            'a' => 'Copiar todo el código y luego las dependencias',
            'b' => 'Copiar las dependencias <b>antes</b> que el código fuente',
            'c' => 'Ejecutar <code>RUN</code> muchas veces al final',
            'd' => 'Usar siempre <code>latest</code>'
        ],
        'correcta' => 'b',
        'porque'   => 'Lo que cambia poco (dependencias) va primero; lo que cambia mucho (código) va después.'
    ],
    'm16' => [
        'texto'    => 'De esta lista, ¿qué es algo que <b>NUNCA</b> debe hacerse en construcción y empaquetamiento?',
        'opciones' => [
            'a' => 'Builds herméticos',
            'b' => 'Multi-stage',
            'c' => 'Incrustar contraseñas o tokens en <b>argumentos de build</b> (secretos en capas)',
            'd' => 'Ejecutar pruebas unitarias en cada build'
        ],
        'correcta' => 'c',
        'porque'   => 'NUNCA: dependencias flotantes (latest), compilar en producción, secretos en capas y saltar pruebas (-DskipTests). SÍ: builds herméticos, cacheo de capas, multi-stage obligatorio, pruebas en cada build.'
    ],
    'm17' => [
        'texto'    => '“Compilar en producción” consiste en…',
        'opciones' => [
            'a' => 'Compilar en el runner de CI',
            'b' => 'Usar una imagen multi-stage',
            'c' => 'Compilar en el portátil del QA',
            'd' => 'Clonar Git y ejecutar compiladores en <b>servidores vivos</b>'
        ],
        'correcta' => 'd',
        'porque'   => 'Es un anti-patrón: los servidores de destino nunca compilan ni clonan Git; solo reciben el artefacto ya empaquetado.'
    ],
    'm18' => [
        'texto'    => 'Un colega propone usar <code>-DskipTests</code> para “acelerar el pipeline”. Según la sesión…',
        'opciones' => [
            'a' => 'Es aceptable en la rama main',
            'b' => 'Es una <b>mala práctica</b>: saltar pruebas está en la lista de lo que NUNCA debe hacerse',
            'c' => 'Es obligatorio en el runner',
            'd' => 'Es recomendable si hay lockfile'
        ],
        'correcta' => 'b',
        'porque'   => 'Las pruebas son parte del build (fail-fast). Quitarlas rompe el principio cardinal: no se empaqueta sin 100 % de pruebas pasando.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Empaquetamiento · 2 — Dependencias, contenedores y multi-stage', 'empaquetamiento_artefactos_inmutabilidad.pdf — Sección 01: dependency hell, lockfiles, OCI, multi-stage, buenas prácticas');
?>

<div class="card">
  <h2>1. Dependencias y el “Dependency Hell”</h2>
  <ul>
    <li><b>  <?php hueco(1, 23); ?>:</b> <?php hueco(58, 62); ?>.</li>
    <li><b>  <?php hueco(2, 23); ?>:</b> <?php hueco(59, 58); ?>.</li>
    <li><b>Conflicto de <?php hueco(3, 10); ?>:</b> la librería A requiere C (v<?php hueco(4, 4); ?>) y la B requiere C (v<?php hueco(5, 4); ?>).</li>
    <li><b>Versiones <?php hueco(6, 10); ?>:</b> rangos (<code>^1.2.0</code>) o <code><?php hueco(7, 8); ?></code> hacen que dos builds
        del mismo commit descarguen código <?php hueco(8, 10); ?> en días diferentes.</li>
  </ul>
  <div class="avisoflujo"><b>Riesgo crítico.</b> Del <?php hueco(9, 4); ?> % al <?php hueco(10, 4); ?> % del código de una app moderna proviene de
     librerías de <?php hueco(11, 10); ?>.   <?php hueco(12, 61); ?>  .</div>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>2. Determinismo: el rol de los lockfiles</h2>

  <div class="tabla-doble">
    <div class="tabla-col">
      <h3>El problema del archivo manifiesto</h3>
      <ul class="ecosistema-lista">
        <li>Archivos como <code>package.json</code>, <code>requirements.txt</code> o <code>build.gradle</code> suelen admitir
            <?php hueco(14, 8); ?> o versiones abiertas (el archivo <?php hueco(13, 12); ?>).</li>
        <li>Si el autor de una librería publica un parche defectuoso, el build del lunes funciona y el del
            <?php hueco(15, 8); ?> falla sin cambios en Git.</li>
      </ul>
    </div>

    <div class="tabla-col">
      <h3>La solución: el archivo lock</h3>
      <ul class="ecosistema-lista">
        <li><strong>Lockfiles:</strong> <code>package-lock.json</code>, <code>poetry.lock</code>, <code>gradle.lockfile</code>.</li>
        <li>Registran la versión exacta (<?php hueco(19, 10); ?>) y el <?php hueco(20, 8); ?> de integridad criptográfico de cada librería descargada.</li>
        <li><strong>Regla mandatoria:</strong> el lockfile DEBE estar en <?php hueco(21, 5); ?> y usarse en CI con comandos deterministas
            (<code><?php hueco(22, 8); ?></code>).</li>
      </ul>
    </div>
  </div>

  <table class="datos">
    <tr><th>Ecosistema</th><th>Lockfile</th></tr>
    <tr><td>Node (npm)</td><td><code><?php hueco(16, 18); ?></code></td></tr>
    <tr><td>Python (Poetry)</td><td><code><?php hueco(17, 14); ?></code></td></tr>
    <tr><td>Gradle</td><td><code><?php hueco(18, 16); ?></code></td></tr>
  </table>

  <?php linea(57, 'El comando de Node para instalar <b>exactamente</b> lo que dice el lockfile en CI (dos palabras).', 'npm ...'); ?>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>3. El contenedor como artefacto de empaquetado</h2>
  <ul>
    <li><b><?php hueco(60, 21); ?>:</b> <?php hueco(61, 28); ?> (JAR, Node app), 
      <?php hueco(24, 23); ?> (<?php hueco(25, 4); ?>, Node),
        las librerías del SO y variables base.</li>
    <li><b><?php hueco(26, 23); ?>  :</b> <?php hueco(62, 49); ?> (macOS, Windows) y 
    <?php hueco(63, 25); ?> ( <?php hueco(27, 8); ?> en la nube).</li>
    <li><b>Estandarización:</b> la <?php hueco(28, 24); ?> (<code>OCI</code>) define un formato universal, compatible con Docker,
        <?php hueco(29, 8); ?> y <?php hueco(30, 12); ?>.</li>
 
  </ul>
    <p>
       <b>Contenedor vs binario:</b> un .jar requiere que el <?php hueco(32, 5); ?> tenga la versión exacta de Java; una imagen OCI
        es <?php hueco(31, 16); ?>. 
    </p>
 
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>4. Optimización: Multi-Stage Builds</h2>

  <div class="docker-compare">
    <div class="docker-panel docker-monolitico">
      <div class="docker-head">Dockerfile Monolítico (Anti-patrón)</div>
      <div class="docker-body dark">
        <pre class="docker-code">FROM maven:3.9-eclipse-temurin-17
WORKDIR /app
COPY pom.xml .
COPY src ./src
RUN mvn clean package -DskipTests
# Compiladores y fuentes en disco!
ENTRYPOINT ["java", "-jar", "target/app.jar"]</pre>
      </div>
      <div class="docker-foot">Resultado: Imagen de 850 MB, compiladores en producción y enorme superficie de ataque.</div>
    </div>

    <div class="docker-panel docker-multistage">
      <div class="docker-head">Dockerfile Multi-Stage (Buena Práctica)</div>
      <div class="docker-body dark">
        <pre class="docker-code"># Etapa 1: Construccion (Builder)
FROM maven:3.9-eclipse-temurin-17 AS builder
WORKDIR /build
COPY pom.xml .
RUN mvn dependency:go-offline
COPY src ./src
RUN mvn clean package -DskipTests

# Etapa 2: Runtime limpio de produccion
FROM eclipse-temurin:17-jre-alpine
WORKDIR /app
COPY --from=builder /build/target/*.jar app.jar
USER 1001
ENTRYPOINT ["java", "-jar", "app.jar"]</pre>
      </div>
      <div class="docker-foot">Resultado: Imagen de 120 MB, solo el JRE mínimo, usuario no-root y cero compiladores.</div>
    </div>
  </div>

  <table class="datos docker-table">
    <tr><th></th><th>Monolítico (anti-patrón)</th><th>Multi-stage (buena práctica)</th></tr>
    <tr><td>Tamaño</td><td><?php hueco(33, 5); ?> MB</td><td><?php hueco(34, 5); ?> MB</td></tr>
    <tr><td>Riesgo / contenido</td>
        <td>Compiladores y fuentes en disco: enorme <?php hueco(35, 20); ?></td>
        <td>Solo el <?php hueco(37, 5); ?> mínimo, usuario no-<?php hueco(39, 6); ?> y cero <?php hueco(40, 12); ?></td></tr>
    <tr><td>Etapas</td><td>Una sola</td>
        <td>Etapa 1 = <code><?php hueco(41, 5); ?> … <?php hueco(42, 3); ?> <?php hueco(36, 8); ?></code>; Etapa 2 = runtime limpio con
            <code>USER <?php hueco(38, 5); ?></code></td></tr>
  </table>
 
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>5. Buenas prácticas de construcción y empaquetamiento</h2>
  <table class="datos">
    <tr><th>Lo que SÍ debe hacerse</th><th>Lo que NUNCA debe hacerse</th></tr>
    <tr><td>  <?php hueco(43, 17); ?>: dependencias fijadas con <?php hueco(44, 10); ?> exactos.</td>
        <td>Dependencias flotantes: usar <code>latest</code> o versiones comodín en las librerías.</td></tr>
    <tr><td><?php hueco(45, 16); ?>: copiar dependencias <?php hueco(46, 6); ?> del código fuente
    en el Dockerfile.</td>
        <td>  <?php hueco(49, 21); ?>: clonar Git y ejecutar compiladores en servidores vivos.</td></tr>
    <tr><td><?php hueco(47, 24); ?>  : separar compilador de runtime de produccion.</td>
        <td><?php hueco(50, 16); ?>: incrustar contraseñas o tokens en argumentos de build.</td></tr>
    <tr><td><?php hueco(48, 16); ?> Ejecutar test en cada build antes de empaquetar el binario.</td>
        <td>Saltar pruebas: desactivar tests (<code><?php hueco(51, 12); ?></code>) para acelerar el pipeline.</td></tr>
  </table>
  <?php enviar('Verificar todo el cuestionario'); ?>  
</div>

<?php
pie('index.php', 'tercero.php');
