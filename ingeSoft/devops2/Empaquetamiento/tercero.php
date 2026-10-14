<?php
/* ==========================================================================
   IngeSoft5 / DevOps2 / Empaquetamiento — bloque 03: Artefactos, SemVer,
   integridad, SBOM y escaneo.
   Fuente: empaquetamiento_artefactos_inmutabilidad.pdf — Sección 02
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- codigo fuente vs artefacto --- */
    1  => ['Texto plano legible por humanos', 'texto plano'],
    2  => ['transitorio'],
    3  => ['maleable'],
    4  => ['git'],
    5  => ['Producto binario'],
    6  => ['inmutable'],
    7  => ['autocontenido'],
    8  => ['nunca', 'nunca se altera'],
    9  => ['nexus'],
    10 => ['oci'],
    11 => ['github', 'gitlab'],

    /* --- por que repositorio --- */
    13 => ['v2-final-definitivo'],
    14 => ['trazabilidad'],
    15 => ['versionamiento formal', 'versionamiento'],
    16 => ['no probados', 'sin probar'],
    17 => ['fuente unica de la verdad', 'single source of truth'],
    18 => ['100% reproducibles', 'reproducibles'],

    /* --- taxonomia --- */
    19 => ['jar', 'jars'],
    20 => ['tgz'],
    21 => ['whl', 'wheel', 'wheels'],
    22 => ['nupkg'],
    23 => ['nuget'],
    24 => ['oci'],
    25 => ['deb'],
    26 => ['rpm'],
    27 => ['ami', 'amis'],
    28 => ['helm', 'charts de helm'],
    29 => ['terraform'],
    30 => ['opentofu'],
    31 => ['opa', 'rego'],
    32 => ['reutilizacion', 'reutilizacion de codigo'],
    33 => ['unidad atomica', 'atomica'],
    34 => ['estandarizacion'],

    /* --- semver --- */
    35 => ['major'],
    36 => ['minor'],
    37 => ['patch'],
    38 => ['ruptura', 'incompatibles'],
    39 => ['funcionalidad', 'nuevas caracteristicas'],
    40 => ['correccion', 'bugs', 'correccion de errores'],
    41 => ['2.0.0', '2.0.0.'],
    42 => ['rc.2', 'rc2'],
    43 => ['build.89'],
    44 => ['puntero mutable', 'puntero'],
    45 => ['latest'],
    46 => ['rollback', 'rollback deterministico'],
    47 => ['forenses'],

    /* --- integridad criptografica --- */
    48 => ['Digest Criptográfico'],
    49 => ['256'],
    50 => ['64'],
    51 => ['Efecto avalancha', 'efecto avalancha'],
    52 => ['bit'],
    53 => ['kubernetes'],
    54 => ['@'],
    55 => ['etiquetas', 'tags'],
    56 => ['digests', 'hashes', 'hashes criptograficos'],
    57 => ['qa'],

    /* --- cadena de suministro --- */
    58 => ['typosquatting'],
    59 => ['sbom', 'software bill of materials'],
    60 => ['transitivas'],
    61 => ['licencias'],
    62 => ['cyclonedx'],
    63 => ['spdx'],
    64 => ['5962', 'iso/iec 5962'],
    65 => ['cosign', 'sigstore'],
    66 => ['keyless'],
    67 => ['log4j'],
    68 => ['200'],

    /* --- escaneo --- */
    69 => ['sca', 'analisis de composicion'],
    70 => ['nvd', 'cve'],
    71 => ['owasp dependency-check', 'dependency-check', 'dependency check'],
    72 => ['snyk'],
    73 => ['npm audit'],
    74 => ['trivy'],
    75 => ['grype'],
    76 => ['clair'],
    77 => ['critical', 'critica'],
    78 => ['parche'],
    79 => ['quality gate'],
    80 => ['openssl'],

    /* --- lineas --- */
    81 => 'mi-registro.com/mi-app@sha256:7f83b1657ff1fc53',
    82 => '2.1.0-rc.2+build.89',

    /* --- nuevo input de entorno --- */
    83 => ['Requiere un entorno de compilación'],
    84 => ['Listo para ser distribuido'],
    85 => ['contratos de API'],
    86 => ['Verificación Inmutable'],
    87 => ['Detecta librerías con fallos conocidos antes'],
];

  $TEXTO = [1,2,3,4,5,6,7,8,9,10,11,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,83,84,85,86,87];

iniciar($SOLUCIONES, [], $TEXTO);
cabecera('Empaquetamiento · 3 — Artefactos, versionamiento e integridad', 'empaquetamiento_artefactos_inmutabilidad.pdf — Sección 02: artefactos, SemVer, SHA-256, SBOM, escaneo');
?>

<div class="card">
  <h2>1. Código fuente vs. artefacto de software</h2>
  <table class="datos">
    <tr><th></th><th>Código fuente</th><th>Artefacto</th></tr>
    <tr><td>Naturaleza</td>
        <td>  <?php hueco(1, 30); ?>   (Java, Python, TS, Go).</td>
        <td>  <?php hueco(5, 16); ?> empaquetado, verificado y testeado.</td></tr>
    <tr><td>Estado</td>
        <td>Estado <?php hueco(2, 12); ?> y <?php hueco(3, 10); ?>: cambia con cada commit o rama.</td>
        <td><?php hueco(6, 10); ?> y <?php hueco(7, 14); ?>: una vez generado para una versión, <?php hueco(8, 8); ?> se altera.</td></tr>
    <tr><td>Entorno</td>
        <td><?php hueco(83, 33); ?>, herramientas de desarrollo y dependencias externas para operar.</td>
        <td><?php hueco(84, 25); ?>, auditado y ejecutado directamente en un entorno.</td></tr>
    <tr><td>Almacenamiento</td>
        <td>Repositorios <?php hueco(4, 5); ?> (<?php hueco(11, 8); ?>,  GitLab).</td>
        <td>Gestores de artefactos (<?php hueco(9, 8); ?>, <?php hueco(10, 5); ?> ).</td></tr>
  </table>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>2. ¿Por qué es vital un repositorio de artefactos?</h2>

  <div class="flujo-compare">
    <div class="flujo-panel flujo-caos">
      <div class="flujo-head">El Caos Artesanal (Sin Repositorio)</div>
      <div class="flujo-body">
        <div class="flujo-step">Developer (Build local en laptop)</div>
        <div class="flujo-arrow">↓</div>
        <div class="flujo-step">“¿Me pasas el JAR actualizado?”</div>
        <div class="flujo-arrow">↓</div>
        <div class="flujo-step">Envío por Correo / Drive / Carpeta compartida</div>
        <div class="flujo-arrow">↓</div>
        <div class="flujo-step">“¿Cuál era el correcto? ¿<?php hueco(13, 20); ?>?”</div>
      </div>
      <div class="flujo-footer">
        <ul>
          <li>Sin <?php hueco(14, 14); ?>, sin <?php hueco(15, 18); ?> y alto riesgo de desplegar binarios <?php hueco(16, 12); ?> en producción.</li>
        </ul>
      </div>
    </div>

    <div class="flujo-panel flujo-estandar">
      <div class="flujo-head">Flujo Estandarizado (Con Repositorio)</div>
      <div class="flujo-body">
        <div class="flujo-row">
          <div class="flujo-box small">Developer</div>
          <div class="flujo-arrow-lg">→</div>
          <div class="flujo-box repo"><span>REPOSITORIO</span><small>(Nexus / OCI)</small></div>
        </div>
        <div class="flujo-row">
          <div class="flujo-box small">CI / CD</div>
          <div class="flujo-arrow-lg">→</div>
          <div class="flujo-box repo"><span>REPOSITORIO</span><small>(Nexus / OCI)</small></div>
        </div>
        <div class="flujo-deploy-flow">
          <div class="flujo-arrow-final">↓</div>
          <div class="flujo-final">Testing / Staging / Prod</div>
        </div>
      </div>
      <div class="flujo-footer">
        <ul>
          <li><?php hueco(17, 26); ?> (Single Source of Truth), inmutabilidad y despliegues <?php hueco(18, 19); ?>.</li>
        </ul>
      </div>
    </div>
  </div>

  <?php enviar(); ?>
</div>

<div class="card">
  <h2>3. Taxonomía de artefactos en DevOps moderno</h2>
  <div class="taxonomia-grid">
    <section class="taxonomia-card taxonomia-libreria">
      <h3 class="taxonomia-head">1. Nivel Librería / Módulo</h3>
      <div class="taxonomia-body">
        <ul>
          <li><b>Java:</b> <?php hueco(19, 6); ?>, WARs, AARs.</li>
          <li><b>Node.js:</b> Tarballs .<?php hueco(20, 4); ?> de npm.</li>
          <li><b>Python:</b> Wheels .<?php hueco(21, 5); ?>, sdist.</li>
          <li><b>.NET:</b> Paquetes <?php hueco(23, 8); ?> .<?php hueco(22, 6); ?>.</li>
        </ul>
        <p class="taxonomia-purpose"><b>Propósito:</b> <?php hueco(32, 16); ?> de código compartido entre aplicaciones y equipos.</p>
      </div>
    </section>

    <section class="taxonomia-card taxonomia-sistema">
      <h3 class="taxonomia-head">2. Nivel Sistema / Contenedor</h3>
      <div class="taxonomia-body">
        <ul>
          <li><b>Imágenes <?php hueco(24, 5); ?>:</b> Capas comprimidas tar.gz con metadata.</li>
          <li><b>Linux OS:</b> Paquetes .<?php hueco(25, 4); ?> o .<?php hueco(26, 4); ?>.</li>
          <li><b>Cloud Images:</b> <?php hueco(27, 5); ?> de AWS, Golden VMs.</li>
        </ul>
        <p class="taxonomia-purpose"><b>Propósito:</b> <?php hueco(33, 14); ?> e inmutable de ejecución en producción.</p>
      </div>
    </section>

    <section class="taxonomia-card taxonomia-infraestructura">
      <h3 class="taxonomia-head">3. Nivel Infraestructura</h3>
      <div class="taxonomia-body">
        <ul>
          <li><b>Kubernetes:</b> Charts de <?php hueco(28, 6); ?> (<code>.tgz</code>).</li>
          <li><b>IaC Modules:</b> Módulos versionados de <?php hueco(29, 10); ?> o <?php hueco(30, 10); ?>.</li>
          <li><b>Políticas:</b> Bundles <?php hueco(31, 5); ?> (Rego).</li>
        </ul>
        <p class="taxonomia-purpose"><b>Propósito:</b> <?php hueco(34, 16); ?> de patrones de infraestructura como código.</p>
      </div>
    </section>
  </div>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>4. Versionamiento Semántico: SemVer 2.0.0</h2>
  <div class="semver-layout">
    <div class="semver-content">
      <p class="semver-intro">Estándar universal de nomenclatura para artefactos:<br><code>MAJOR.MINOR.PATCH</code></p>
      <ul class="semver-lista">
        <li><b><code><?php hueco(35, 7); ?></code> (<?php hueco(38, 8); ?>):</b> Cambios incompatibles con la API anterior. Los clientes deben adaptar su código para actualizar.</li>
        <li><b><code><?php hueco(36, 7); ?></code> (<?php hueco(39, 16); ?>):</b> Nuevas características añadidas de forma compatible hacia atrás.</li>
        <li><b><code><?php hueco(37, 7); ?></code> (<?php hueco(40, 10); ?>):</b> Corrección de errores y parches de bugs compatibles hacia atrás.</li>
        <li><b>Extensiones:</b> Prereleases y metadatos: <code>2.1.0-<?php hueco(42, 6); ?>+<?php hueco(43, 9); ?></code>.</li>
      </ul>
      <p class="semver-version">Un cambio incompatible desde 1.9.4 lleva a la versión <code><?php hueco(41, 6); ?></code>.</p>
    </div>
    <aside class="semver-confidence">
      <h3>Semántica y Confianza</h3>
      <p>SemVer permite a desarrolladores y pipelines automatizar parches de seguridad de forma segura sin temor a romper <?php hueco(85, 18); ?> en producción.</p>
    </aside>
  </div>

  <div class="tag-alerta">
    <div class="tag-impacto">100%</div>
    <div class="tag-subtitulo">de incertidumbre e indeterminismo al desplegar con el tag <code>:latest</code></div>
    <blockquote>“:<?php hueco(45, 8); ?> no es una versión; es solo un <?php hueco(44, 16); ?> que se mueve al último push. Desplegar :latest en producción rompe la reproducibilidad, imposibilita el <?php hueco(46, 10); ?> determinista y transforma los incidentes en pesadillas <?php hueco(47, 10); ?>.”</blockquote>
  </div>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>5. Integridad criptográfica: hashes SHA-256</h2>
  <div class="integridad-layout">
    <div class="integridad-content">
      <h3>¿Cómo garantizar que un binario no fue alterado ni corrompido?</h3>
      <ul class="integridad-lista">
        <li><b><?php hueco(48, 23); ?>  :</b> Transforma los bytes del artefacto en una cadena hexadecimal fija de <?php hueco(49, 4); ?> bits (<?php hueco(50, 4); ?> caracteres).</li>
        <li><b><?php hueco(51, 17); ?>:</b> Si un solo <?php hueco(52, 4); ?> del código compilado cambia, el hash resultante cambia drásticamente.</li>
        <li><b>Despliegue por Digest en Contenedores:</b> <?php hueco(53, 12); ?> permite referenciar el digest exacto:</li>
      </ul>
      <code class="integridad-ejemplo">mi-registro.com/mi-app<?php hueco(54, 2); ?>sha256:7f83b1657ff1fc53...</code>
      <ul class="integridad-lista">
        <li><b><?php hueco(86, 23); ?>:</b> Se garantiza matemáticamente que lo probado en <?php hueco(57, 4); ?> es exactamente lo que corre en producción.</li>
      </ul>
    </div>
    <aside class="integridad-inmutable">
      <h3>Inmutabilidad Real</h3>
      <p>Las <?php hueco(55, 10); ?> son conveniencias para humanos; los <b>hashes criptográficos (<?php hueco(56, 18); ?>)</b> son la verdadera identidad matemática e inmutable del artefacto.</p>
    </aside>
  </div>
  <?php linea(81, 'Referencia una imagen <b>por digest</b> (registro <code>mi-registro.com</code>, imagen <code>mi-app</code>, digest <code>7f83b1657ff1fc53</code>).', 'mi-registro.com/...'); ?>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>6. Cadena de suministro de software y SBOM</h2>
  <div class="sbom-layout">
    <div class="sbom-content">
      <p class="sbom-intro">En un entorno empresarial moderno:</p>
      <ul class="sbom-lista">
        <li><b>Ataques a la cadena de suministro:</b> Inyecciones maliciosas en repos públicos (<?php hueco(58, 14); ?>, robo de credenciales, incidentes en npm).</li>
        <li><b><?php hueco(59, 6); ?> (Software Bill of Materials):</b> Inventario formal de todos los ingredientes: dependencias directas, <?php hueco(60, 12); ?>, versiones, hashes y <?php hueco(61, 10); ?>.</li>
        <li><b>Estándares de la Industria:</b> <i><?php hueco(62, 10); ?></i> (enfoque de seguridad) y <i><?php hueco(63, 6); ?></i> (estándar ISO/IEC <?php hueco(64, 5); ?>).</li>
        <li><b>Firmado Digital (<?php hueco(65, 8); ?> / Sigstore):</b> Firmar el artefacto y su SBOM en CI con clave privada o arquitectura <i><?php hueco(66, 8); ?></i>.</li>
      </ul>
    </div>
    <aside class="sbom-transparencia">
      <h3>Transparencia de Soft-<br>ware</h3>
      <p>Un SBOM permite responder en segundos: “¿En cuáles de nuestros <?php hueco(68, 4); ?> microservicios en producción está instalada la librería vulnerable de <?php hueco(67, 8); ?>?”</p>
    </aside>
  </div>
  <?php enviar(); ?>
</div>

<div class="card">
  <h2>7. Escaneo automático de vulnerabilidades</h2>
  <div class="escaneo-grid">
    <section class="escaneo-col escaneo-sca">
      <h3>Análisis de Composición (<?php hueco(69, 4); ?>)</h3>
      <ul>
        <li>Analiza dependencias declaradas contra bases de datos públicas de vulnerabilidades (<?php hueco(70, 4); ?> / CVE).</li>
        <li>Herramientas: <i><?php hueco(71, 22); ?></i>, <i><?php hueco(72, 6); ?></i>, SonarQube, <i><?php hueco(73, 10); ?></i>.</li>
        <li><?php hueco(87, 44); ?> de empaquetar el binario.</li>
      </ul>
    </section>
    <section class="escaneo-col escaneo-oci">
      <h3>Escaneo de Imágenes OCI</h3>
      <ul>
        <li>Inspecciona cada capa del contenedor buscando paquetes del SO base vulnerables (<?php hueco(80, 8); ?>, curl, etc.).</li>
        <li>Herramientas: <i><?php hueco(74, 6); ?></i>, <i><?php hueco(75, 6); ?></i>, <i><?php hueco(76, 6); ?></i>, AWS ECR Scanning.</li>
        <li><b><?php hueco(79, 14); ?> en CI/CD:</b> Bloquea el build si se detecta una vulnerabilidad <?php hueco(77, 8); ?> con <?php hueco(78, 8); ?> disponible.</li>
      </ul>
    </section>
  </div>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('segundo.php', 'cuarto.php');
