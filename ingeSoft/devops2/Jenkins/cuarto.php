<?php
/* ==========================================================================
   IngeSoft5 / DevOps2 / Jenkins — bloque 04: Empaquetamiento, publicación en Nexus y despliegue.
   Fuente: sesion_17_jenkins_cicd_pipelines.pdf
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    1 => ['determinista', 'deterministico'],
    2 => ['inmutable'],
    3 => ['compila', 'compilar'],
    4 => ['promueve', 'promover'],
    5 => ['inalterable', 'inmutable'],
    6 => ['recompila'],
    7 => ['invalidan'],
    8 => ['ci'],
    9 => ['produccion'],
    10 => ['9081'],
    12 => ['maven-releases'],
    13 => ['cerrados'],
    14 => ['inmutables'],
    15 => ['1.0.0'],
    16 => ['maven-snapshots'],
    17 => ['desarrollo'],
    18 => ['feature'],
    19 => ['mvn deploy'],
    20 => ['credenciales'],
    21 => ['settings.xml'],
    22 => ['9080'],
    23 => ['privado'],
    24 => ['docker build'],
    25 => ['dual'],
    26 => ['semantica'],
    27 => ['commit hash', 'hash del commit'],
    28 => ['docker login'],
    29 => ['docker push'],
    30 => ['nexus'],
    31 => ['docker pull'],
    32 => ['git'],
    33 => ['compilador'],
    34 => ['maven'],
    35 => ['docker runtime', 'docker'],
    36 => ['atomico'],
    37 => ['previo', 'anterior'],
    38 => ['nuevo'],
    39 => ['staging'],
    40 => ['puertos'],
    41 => ['http'],
    42 => ['/actuator/health'],
    43 => ['operatividad'],
    44 => ['healthcheck'],
    45 => ['post'],
    46 => ['failure'],
    47 => ['rollback()'],
    48 => ['previa', 'anterior'],
    49 => ['segundos'],
    50 => ['git repo', 'repositorio git', 'git'],
    51 => ['webhook'],
    52 => ['shared library'],
    53 => ['pipeline central', 'pipeline'],
    54 => ['agent'],
    55 => ['build'],
    56 => ['test'],
    57 => ['nexus'],
    58 => ['9081'],
    59 => ['9080'],
    60 => ['upload', 'artefacto', 'upload de artefacto'],
    61 => ['staging'],
    62 => ['docker pull'],
    63 => ['docker run'],
    64 => ['smoke test'],
    65 => ['200'],
    66 => ['healthcheck ok', 'healthcheck'],
    67 => ['trazabilidad'],
    68 => ['hash'],
    69 => ['nexus'],
    70 => ['logs'],
];

$TEXTO = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70];

$MULTIPLE = [
    'm1' => [
        'texto'    => '¿Por qué <b>recompilar</b> el artefacto en cada ambiente rompe DevOps?',
        'opciones' => [
            'a' => 'Porque consume disco',
            'b' => 'Porque invalida todas las pruebas ejecutadas en etapas anteriores: lo probado en CI debe ser exactamente lo que corre en producción',
            'c' => 'Porque Nexus no lo permite',
            'd' => 'Porque Jenkins se cae'
        ],
        'correcta' => 'b',
        'porque'   => 'Es el principio cardinal: Build Once, promover el mismo artefacto inalterable.'
    ],
    'm2' => [
        'texto'    => 'El principio <b>Build Once</b> dice:',
        'opciones' => [
            'a' => 'Compilar en cada ambiente con su configuración',
            'b' => 'Compilar solo en producción',
            'c' => 'Compilar una única vez y promover el mismo artefacto inalterable entre ambientes',
            'd' => 'Compilar cada hora'
        ],
        'correcta' => 'c',
        'porque'   => 'Aplica a binarios e imágenes Docker.'
    ],
    'm3' => [
        'texto'    => '¿Qué puerto usa Nexus para artefactos Java/Maven y cuál para imágenes Docker?',
        'opciones' => [
            'a' => '9081 Maven; 9080 Docker',
            'b' => '9080 Maven; 9081 Docker',
            'c' => '8080 Maven; 5000 Docker',
            'd' => '50000 ambos'
        ],
        'correcta' => 'a',
        'porque'   => 'Maven :9081, imágenes OCI/Docker :9080.'
    ],
    'm4' => [
        'texto'    => '¿Qué contiene <code>maven-releases</code> frente a <code>maven-snapshots</code>?',
        'opciones' => [
            'a' => 'releases: desarrollo dinámico; snapshots: cerrados',
            'b' => 'Ambos son idénticos',
            'c' => 'releases: artefactos cerrados e inmutables (versiones fijas como 1.0.0); snapshots: artefactos de desarrollo dinámicos en ramas feature',
            'd' => 'Solo releases existe'
        ],
        'correcta' => 'c',
        'porque'   => 'Ambos son repositorios Hosted en Nexus.'
    ],
    'm5' => [
        'texto'    => '¿Cómo se publica un artefacto Maven a Nexus desde el pipeline?',
        'opciones' => [
            'a' => 'Con <code>mvn deploy</code>, con las credenciales de Nexus inyectadas en <code>settings.xml</code>',
            'b' => 'Copiando por FTP',
            'c' => 'Con <code>mvn clean</code>',
            'd' => 'Con <code>npm publish</code>'
        ],
        'correcta' => 'a',
        'porque'   => 'Las credenciales vienen de Jenkins (withCredentials) y no se hardcodean.'
    ],
    'm6' => [
        'texto'    => '¿Cómo se construye y etiqueta una imagen para el registro de Nexus?',
        'opciones' => [
            'a' => '<code>docker run</code> sin tag',
            'b' => '<code>docker build -t cicd:9080/app:1.0.0-$BUILD_NUMBER</code> y etiquetado dual: versión semántica + commit hash exacto de Git',
            'c' => '<code>docker pull</code> con latest',
            'd' => 'Solo con latest'
        ],
        'correcta' => 'b',
        'porque'   => 'Así cada imagen es trazable al commit exacto.'
    ],
    'm7' => [
        'texto'    => 'Orden correcto del flujo de publicación de imágenes:',
        'opciones' => [
            'a' => 'docker push → docker build → docker login',
            'b' => 'docker build → docker login cicd:9080 → docker push',
            'c' => 'docker login → docker pull → docker rm',
            'd' => 'docker run → docker push'
        ],
        'correcta' => 'b',
        'porque'   => 'Autenticación con docker login cicd:9080 y después docker push al registro central.'
    ],
    'm8' => [
        'texto'    => '¿Por qué el etiquetado <b>dual</b> (semver + commit hash)?',
        'opciones' => [
            'a' => 'Por estética',
            'b' => 'Da una versión legible y a la vez trazabilidad exacta hasta el commit de Git',
            'c' => 'Porque Docker lo obliga',
            'd' => 'Para ahorrar espacio'
        ],
        'correcta' => 'b',
        'porque'   => 'Es la base de la trazabilidad total del flujo.'
    ],
    'm9' => [
        'texto'    => 'En el CD, ¿cómo obtiene el servidor objetivo la aplicación?',
        'opciones' => [
            'a' => 'Compila desde Git',
            'b' => 'Hace pull de la imagen publicada en Nexus (<code>docker pull cicd:9080/app:1.0.0</code>)',
            'c' => 'Recibe un .zip por correo',
            'd' => 'Ejecuta Maven'
        ],
        'correcta' => 'b',
        'porque'   => 'Cero compilación en runtime.'
    ],
    'm10' => [
        'texto'    => '¿Qué <b>NO</b> debe haber en el servidor de despliegue?',
        'opciones' => [
            'a' => 'Docker runtime',
            'b' => 'Git, compilador ni Maven (solo el motor de ejecución)',
            'c' => 'Red',
            'd' => 'Variables de entorno'
        ],
        'correcta' => 'b',
        'porque'   => 'Solo el Docker runtime: se ejecuta el artefacto ya construido.'
    ],
    'm11' => [
        'texto'    => 'Describe el <b>reemplazo atómico</b> del contenedor:',
        'opciones' => [
            'a' => 'Detiene el contenedor previo, levanta el nuevo con variables de entorno de staging y mapea puertos',
            'b' => 'Actualiza el código dentro del contenedor',
            'c' => 'Solo reinicia el servidor',
            'd' => 'Recompila la imagen'
        ],
        'correcta' => 'a',
        'porque'   => 'Cada despliegue reemplaza el contenedor completo.'
    ],
    'm12' => [
        'texto'    => '¿Para qué sirve el <b>smoke test</b> post-despliegue?',
        'opciones' => [
            'a' => 'Para compilar',
            'b' => 'Para ejecutar peticiones HTTP inmediatas (/actuator/health) que certifiquen la operatividad',
            'c' => 'Para medir cobertura',
            'd' => 'Para borrar imágenes'
        ],
        'correcta' => 'b',
        'porque'   => 'Si falla el healthcheck se activa el rollback.'
    ],
    'm13' => [
        'texto'    => 'Si el healthcheck falla tras el despliegue, ¿qué hace el pipeline?',
        'opciones' => [
            'a' => 'Nada',
            'b' => 'Detiene Jenkins',
            'c' => 'Borra Nexus',
            'd' => 'Ejecuta automáticamente <code>post { failure { rollback() } }</code>, reactivando la versión previa de Nexus en segundos'
        ],
        'correcta' => 'd',
        'porque'   => 'El rollback usa la imagen anterior ya publicada (inmutable) en Nexus.'
    ],
    'm14' => [
        'texto'    => 'El flujo integral en IasLab (en orden) es:',
        'opciones' => [
            'a' => 'Servidor Staging → Nexus → Jenkins Agent → Git',
            'b' => 'Git Repo (webhook) → Shared Library orquesta → Jenkins Agent (Build & Test) → Nexus (upload) → Servidor Staging (docker pull/run) → Smoke Test HTTP 200',
            'c' => 'Nexus → Git → Jenkins → Servidor',
            'd' => 'Jenkins → Git → Smoke test → Nexus'
        ],
        'correcta' => 'b',
        'porque'   => 'Seis pasos: 1 Git/Webhook, 2 Shared Library, 3 Agent, 4 Nexus (:9081/:9080), 5 Staging, 6 Smoke test.'
    ],
    'm15' => [
        'texto'    => '¿Qué garantiza la <b>trazabilidad total</b>?',
        'opciones' => [
            'a' => 'El hash del commit Git se propaga a la versión de la imagen en Nexus y a los logs del contenedor en ejecución',
            'b' => 'Un Excel manual',
            'c' => 'El nombre del desarrollador',
            'd' => 'La fecha del build'
        ],
        'correcta' => 'a',
        'porque'   => 'Así se sabe exactamente qué commit está corriendo.'
    ],
    'm16' => [
        'texto'    => '¿Cuál es el primer paso del flujo integral?',
        'opciones' => [
            'a' => 'Smoke Test',
            'b' => 'Nexus upload',
            'c' => 'Repositorio Git (commit/PR) que dispara el webhook',
            'd' => 'docker pull'
        ],
        'correcta' => 'c',
        'porque'   => 'Luego la Shared Library orquesta el pipeline central.'
    ],
    'm17' => [
        'texto'    => 'Debate 1: ¿cuándo migrar de pipelines individuales a una Shared Library central?',
        'opciones' => [
            'a' => 'Nunca',
            'b' => 'Al tener un solo proyecto',
            'c' => 'Solo si hay un único equipo',
            'd' => 'Cuando aparecen varios microservicios con Jenkinsfiles copiados: divergencia, cambios de seguridad en muchos archivos, falta de estándares y coste de mantenimiento'
        ],
        'correcta' => 'd',
        'porque'   => 'Con 20–50 microservicios el copy-paste se vuelve insostenible.'
    ],
    'm18' => [
        'texto'    => 'Debate 2: si la Shared Library tiene un bug…',
        'opciones' => [
            'a' => 'No pasa nada',
            'b' => 'Afecta a todos los microservicios que la consumen; se mitiga con versionado por tags (@v1.2), pruebas de la librería y fijar/revertir versión',
            'c' => 'Solo afecta a Nexus',
            'd' => 'Se corrige solo'
        ],
        'correcta' => 'b',
        'porque'   => 'Riesgo del punto central de gobernanza.'
    ],
    'm19' => [
        'texto'    => 'Debate 3: ¿por qué Nexus como <b>proxy</b> de dependencias externas mejora la resiliencia?',
        'opciones' => [
            'a' => 'Porque es más bonito',
            'b' => 'Porque cachea las dependencias: los builds siguen funcionando aunque el repositorio público caiga o elimine un paquete (evita casos como left-pad)',
            'c' => 'Porque elimina Maven',
            'd' => 'Porque sube las dependencias a producción'
        ],
        'correcta' => 'b',
        'porque'   => 'Además da control y auditoría de lo que consume la organización.'
    ],
    'm20' => [
        'texto'    => 'Debate 4: riesgos de guardar credenciales SSH con acceso root en el almacén de Jenkins:',
        'opciones' => [
            'a' => 'Ninguno',
            'b' => 'Si Jenkins es comprometido, el atacante obtiene acceso root a los servidores; conviene mínimo privilegio, usuarios de despliegue sin root y rotación',
            'c' => 'Solo el rendimiento',
            'd' => 'Solo el costo'
        ],
        'correcta' => 'b',
        'porque'   => 'Principio de mínimo privilegio y alcance restringido de credenciales.'
    ],
    'm21' => [
        'texto'    => 'Debate 5: si un contenedor falla su healthcheck tras un despliegue CD, el mecanismo más limpio de recuperación es…',
        'opciones' => [
            'a' => 'Depurar en producción',
            'b' => 'Rollback automático: reactivar la versión previa e inmutable publicada en Nexus (post { failure { rollback() } })',
            'c' => 'Recompilar en el servidor',
            'd' => 'Apagar el servicio'
        ],
        'correcta' => 'b',
        'porque'   => 'Con Build Once y artefactos inmutables el rollback es un simple redespliegue de la imagen anterior.'
    ],
];

iniciar($SOLUCIONES, [], $TEXTO);
cabecera('Jenkins · 4 — Nexus y despliegue continuo', 'Sesión 17 (Jenkins CI/CD): Build Once, publicación en Nexus (:9081/:9080), CD, rollback, flujo integral y preguntas de debate');
?>


<div class="card">
  <style>
    .jenkins-build-once-title{margin:0 0 26px!important;text-align:right;color:#5e50ef!important;border:0!important}
    .jenkins-build-once{text-align:center;padding:14px 8px 20px}
    .jenkins-build-once-word{margin:0;color:#f45d12;font-size:clamp(64px,12vw,112px);font-weight:700;line-height:1}
    .jenkins-build-once-subtitle{margin:0 0 16px;color:#5e50ef;font-size:clamp(18px,3vw,25px);font-weight:700;line-height:1.35}
    .jenkins-build-once-quote{max-width:800px;margin:0 auto;color:#17191d;font-size:clamp(18px,2.6vw,23px);font-style:italic;line-height:1.4}
  </style>
  <h2 class="jenkins-build-once-title">El Principio Cardinal de DevOps</h2>
  <section class="jenkins-build-once">
    <h3 class="jenkins-build-once-word">BUILD ONCE</h3>
    <p class="jenkins-build-once-subtitle"><?php hueco(3, 11); ?> una única vez, <?php hueco(4, 12); ?> el mismo artefacto <?php hueco(5, 15); ?></p>
    <blockquote class="jenkins-build-once-quote">“Si un binario o imagen Docker se <?php hueco(6, 13); ?> en cada ambiente, se <?php hueco(7, 13); ?> todas las pruebas ejecutadas en etapas anteriores. Lo que se probó en <?php hueco(8, 6); ?> debe ser exactamente lo que corre en <?php hueco(9, 14); ?>.”</blockquote>
  </section>
    <?php enviar(); ?>
</div>

<div class="card">
  <style>
    .jenkins-nexus-title{margin:0 0 26px!important;text-align:right;color:#5e50ef!important;border:0!important}
    .jenkins-nexus-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:38px;align-items:start;margin:24px 8px}
    .jenkins-nexus-column h3{margin:0 0 18px;color:#5e50ef;font-size:23px;line-height:1.3}
    .jenkins-nexus-column.docker h3{color:#8752e8}
    .jenkins-nexus-column h4{margin:0 0 12px;color:#17191d;font-size:18px;line-height:1.35}
    .jenkins-nexus-column ul{margin:0;padding-left:24px;color:#20252a;font-size:17px;line-height:1.4}
    .jenkins-nexus-column li{padding-left:2px;margin:0 0 12px}
    .jenkins-nexus-column li::marker{color:#5e50ef}
    @media(max-width:700px){.jenkins-nexus-grid{grid-template-columns:1fr;gap:28px;margin-right:0;margin-left:0}}
  </style>
  <h2 class="jenkins-nexus-title">Publicación en Sonatype Nexus desde el Pipeline</h2>
  <div class="jenkins-nexus-grid">
    <section class="jenkins-nexus-column">
      <h3>Artefactos Java / Maven (puerto <?php hueco(10, 8); ?>)</h3>
      <h4>Repositorios Hosted en Nexus:</h4>
      <ul>
        <li><code><?php hueco(12, 18); ?></code>: artefactos <?php hueco(13, 12); ?> e <?php hueco(14, 14); ?> (versiones semánticas fijas como <code><?php hueco(15, 9); ?></code>).</li>
        <li><code><?php hueco(16, 19); ?></code>: artefactos de <?php hueco(17, 14); ?> dinámicos en ramas <?php hueco(18, 11); ?>.</li>
        <li>Publicación mediante <code><?php hueco(19, 14); ?></code> con <?php hueco(20, 16); ?> seguras de Nexus inyectadas en <code><?php hueco(21, 16); ?></code>.</li>
      </ul>
    </section>
    <section class="jenkins-nexus-column docker">
      <h3>Imágenes OCI / Docker (puerto <?php hueco(22, 8); ?>)</h3>
      <h4>Docker Registry Privado:</h4>
      <ul>
        <li>Construcción con <code><?php hueco(24, 16); ?> -t cicd:9080/app:1.0.0-$BUILD_NUMBER</code>.</li>
        <li>Etiquetado <b><?php hueco(25, 8); ?></b>: versión <?php hueco(26, 13); ?> + <code><?php hueco(27, 15); ?></code> exacto de Git.</li>
        <li>Autenticación mediante <code><?php hueco(28, 16); ?> cicd:9080</code>.</li>
        <li><code><?php hueco(29, 15); ?></code> al registro central de artefactos.</li>
      </ul>
    </section>
  </div>
    <?php enviar(); ?>
</div>

<div class="card">
  <style>
    .jenkins-cd-title{margin:0 0 26px!important;text-align:right;color:#5e50ef!important;border:0!important}
    .jenkins-cd-grid{display:grid;grid-template-columns:minmax(0,1.35fr) minmax(260px,.9fr);gap:38px;align-items:start;margin:20px 8px 8px}
    .jenkins-cd-intro{margin:0 0 12px;color:#20252a;font-size:17px;line-height:1.45}
    .jenkins-cd-points{margin:0;padding-left:25px;color:#20252a;font-size:17px;line-height:1.45}
    .jenkins-cd-points li{padding-left:2px;margin:0 0 11px}
    .jenkins-cd-points li::marker{color:#5e50ef}
    .jenkins-cd-rollback{overflow:hidden;border:3px solid #8752e8;border-radius:14px;background:#f5efff}
    .jenkins-cd-rollback h3{margin:0;padding:7px 14px;background:#8752e8;color:#fff;text-align:center;font-size:21px;line-height:1.3}
    .jenkins-cd-rollback ul{margin:0;padding:12px 16px 14px 34px;color:#20252a;font-size:17px;line-height:1.45}
    .jenkins-cd-rollback li::marker{color:#8752e8}
    @media(max-width:760px){.jenkins-cd-title{text-align:left!important}.jenkins-cd-grid{grid-template-columns:1fr;gap:24px;margin-right:0;margin-left:0}}
  </style>
  <h2 class="jenkins-cd-title">Despliegue Continuo (CD): De Nexus al Servidor</h2>
  <div class="jenkins-cd-grid">
    <section>
      <p class="jenkins-cd-intro">El pipeline ejecuta el paso de entrega sobre el servidor de despliegue:</p>
      <ul class="jenkins-cd-points">
        <li><b>Pull del artefacto publicado:</b> el servidor objetivo descarga la imagen directamente de <?php hueco(30, 9); ?> (<code><?php hueco(31, 15); ?> cicd:9080/app:1.0.0</code>).</li>
        <li><b>Cero compilación en runtime:</b> en el servidor no hay <?php hueco(32, 7); ?>, ni <?php hueco(33, 14); ?>, ni <?php hueco(34, 9); ?>; solo el motor de ejecución (<i><?php hueco(35, 18); ?></i>).</li>
        <li><b>Reemplazo <?php hueco(36, 11); ?>:</b> detiene el contenedor <?php hueco(37, 10); ?>, levanta el <?php hueco(38, 9); ?> con las variables de entorno de <?php hueco(39, 11); ?> y mapea <?php hueco(40, 11); ?>.</li>
        <li><b>Smoke test post-despliegue:</b> ejecuta peticiones <?php hueco(41, 8); ?> inmediatas (<code><?php hueco(42, 20); ?></code>) para certificar <?php hueco(43, 16); ?>.</li>
      </ul>
    </section>
    <aside class="jenkins-cd-rollback">
      <h3>Estrategia de Rollback</h3>
      <ul>
        <li>Si el <?php hueco(44, 15); ?> falla tras el despliegue, el pipeline ejecuta automáticamente <code><?php hueco(45, 8); ?> { <?php hueco(46, 11); ?> { <?php hueco(47, 14); ?> } }</code>, reactivando la versión <?php hueco(48, 10); ?> de Nexus en <?php hueco(49, 12); ?>.</li>
      </ul>
    </aside>
  </div>
    <?php enviar(); ?>
</div>

<div class="card">
  <style>
    .jenkins-flow-title{margin:0 0 30px!important;text-align:right;color:#5e50ef!important;border:0!important}
    .jenkins-flow-diagram{display:grid;width:100%;grid-template-columns:minmax(0,1fr) 78px minmax(0,1fr) 78px minmax(0,1fr);grid-template-rows:auto 38px auto;align-items:center;gap:0 7px;max-width:780px;margin:0 auto 30px}
    .jenkins-flow-node{display:flex;min-height:100px;flex-direction:column;align-items:center;justify-content:center;padding:8px 7px;border:1.5px solid #6254ff;border-radius:9px;background:#f5f3ff;color:#17191d;text-align:center;font-size:14px;font-weight:700;line-height:1.35}
    .jenkins-flow-node .hbox{display:inline-flex;max-width:100%;vertical-align:middle}
    .jenkins-flow-node .hueco{box-sizing:border-box;max-width:100%;padding:1px 3px;font-size:11px}
    .jenkins-flow-node #respuesta_50{width:82px}
    .jenkins-flow-node #respuesta_52{width:88px}
    .jenkins-flow-node #respuesta_53{width:100px}
    .jenkins-flow-node #respuesta_54{width:60px}
    .jenkins-flow-node #respuesta_55,.jenkins-flow-node #respuesta_56{width:58px}
    .jenkins-flow-node #respuesta_57{width:60px}
    .jenkins-flow-node #respuesta_58,.jenkins-flow-node #respuesta_59{width:40px}
    .jenkins-flow-node #respuesta_61{width:76px}
    .jenkins-flow-node #respuesta_63{width:82px}
    .jenkins-flow-node #respuesta_64{width:82px}
    .jenkins-flow-node #respuesta_66{width:96px}
    .jenkins-flow-node.nexus{border-color:#f45d12;background:#fff4ed}
    .jenkins-flow-node.staging{border-color:#36b779;background:#edf9f2}
    .jenkins-flow-node.smoke{border-color:#a7a834;background:#fbfbe9}
    .jenkins-flow-arrow{display:flex;flex-direction:column;align-items:center;justify-content:center;gap:2px;color:#6254ff;text-align:center;font-size:11px;line-height:1.2}
    .jenkins-flow-arrow span{font-size:25px;font-weight:700;line-height:1}
    .jenkins-flow-arrow .hbox{display:inline-flex;max-width:100%}
    .jenkins-flow-arrow .hueco{box-sizing:border-box;width:68px;max-width:100%;padding:1px 2px;font:10px Arial,sans-serif}
    .jenkins-flow-arrow.orchestrate{color:#8752e8}
    .jenkins-flow-arrow.pull{color:#36b779}
    .jenkins-flow-arrow.smoke-link{color:#969a32}
    .jenkins-flow-upload{grid-column:5;grid-row:2;display:flex;flex-direction:column;align-items:center;justify-content:center;color:#f45d12;font-size:12px;line-height:1.15}
    .jenkins-flow-upload span{font-size:25px;font-weight:700;line-height:1}
    .jenkins-flow-upload .hbox{display:inline-flex;max-width:100%}
    .jenkins-flow-upload .hueco{box-sizing:border-box;width:68px;max-width:100%;padding:1px 2px;font:10px Arial,sans-serif}
    .jenkins-flow-top-left{grid-column:1;grid-row:1}
    .jenkins-flow-top-arrow1{grid-column:2;grid-row:1}
    .jenkins-flow-top-mid{grid-column:3;grid-row:1}
    .jenkins-flow-top-arrow2{grid-column:4;grid-row:1}
    .jenkins-flow-top-right{grid-column:5;grid-row:1}
    .jenkins-flow-bottom-left{grid-column:1;grid-row:3}
    .jenkins-flow-bottom-arrow1{grid-column:2;grid-row:3}
    .jenkins-flow-bottom-mid{grid-column:3;grid-row:3}
    .jenkins-flow-bottom-arrow2{grid-column:4;grid-row:3}
    .jenkins-flow-bottom-right{grid-column:5;grid-row:3}
    .jenkins-flow-trace{margin:0 8px;color:#20252a;text-align:center;font-size:16px;line-height:1.7}
    .jenkins-flow-trace b{font-weight:700}
    @media(max-width:760px){
      .jenkins-flow-title{text-align:left!important}
      .jenkins-flow-diagram{grid-template-columns:minmax(0,1fr);grid-template-rows:repeat(11,auto);gap:5px;margin-bottom:24px}
      .jenkins-flow-node,.jenkins-flow-arrow,.jenkins-flow-upload{grid-column:1!important;grid-row:auto!important}
      .jenkins-flow-node{width:100%;min-height:74px}
      .jenkins-flow-arrow{min-height:30px}
      .jenkins-flow-top-left{order:1}.jenkins-flow-top-arrow1{order:2}.jenkins-flow-top-mid{order:3}.jenkins-flow-top-arrow2{order:4}.jenkins-flow-top-right{order:5}
      .jenkins-flow-upload{order:6}
      .jenkins-flow-bottom-right{order:7}.jenkins-flow-bottom-arrow2{order:8}.jenkins-flow-bottom-mid{order:9}.jenkins-flow-bottom-arrow1{order:10}.jenkins-flow-bottom-left{order:11}
      .jenkins-flow-top-arrow1 span,.jenkins-flow-top-arrow2 span{transform:rotate(90deg)}
      .jenkins-flow-bottom-arrow1 span,.jenkins-flow-bottom-arrow2 span{transform:rotate(-90deg)}
      .jenkins-flow-upload{min-height:36px}
      .jenkins-flow-trace{text-align:left}
    }
  </style>
  <h2 class="jenkins-flow-title">Flujo Integral de Trazabilidad CI/CD en IasLab</h2>
  <div class="jenkins-flow-diagram" role="group" aria-label="Completa los conceptos en cada etapa del flujo CI/CD">
    <div class="jenkins-flow-node jenkins-flow-top-left">1. <?php hueco(50, 12); ?><br>(Commit / PR)</div>
    <div class="jenkins-flow-arrow jenkins-flow-top-arrow1"><?php hueco(51, 11); ?><span>→</span></div>
    <div class="jenkins-flow-node jenkins-flow-top-mid">2. <?php hueco(52, 18); ?><br>(<?php hueco(53, 20); ?>)</div>
    <div class="jenkins-flow-arrow orchestrate jenkins-flow-top-arrow2"><small>Orquesta</small><span>→</span></div>
    <div class="jenkins-flow-node jenkins-flow-top-right">3. Jenkins <?php hueco(54, 9); ?><br><?php hueco(55, 9); ?> &amp; <?php hueco(56, 8); ?></div>
    <div class="jenkins-flow-upload"><?php hueco(60, 10); ?> Artefacto<span>↓</span></div>
    <div class="jenkins-flow-node smoke jenkins-flow-bottom-left">6. <?php hueco(64, 14); ?><br>(<?php hueco(66, 18); ?>)</div>
    <div class="jenkins-flow-arrow smoke-link jenkins-flow-bottom-arrow1"><small>HTTP <?php hueco(65, 7); ?></small><span>←</span></div>
    <div class="jenkins-flow-node staging jenkins-flow-bottom-mid">5. Servidor <?php hueco(61, 11); ?><br>(<?php hueco(63, 14); ?>)</div>
    <div class="jenkins-flow-arrow pull jenkins-flow-bottom-arrow2"><?php hueco(62, 15); ?><span>←</span></div>
    <div class="jenkins-flow-node nexus jenkins-flow-bottom-right">4. <?php hueco(57, 9); ?><br>Repo :<?php hueco(58, 8); ?> / :<?php hueco(59, 8); ?></div>
  </div>
  <p class="jenkins-flow-trace"><b><?php hueco(67, 16); ?> total:</b> el <?php hueco(68, 8); ?> del commit Git se propaga a la versión de la imagen en <?php hueco(69, 9); ?> y a los <?php hueco(70, 8); ?> del contenedor en ejecución.</p>
    <?php enviar(); ?>
</div>

<div class="card">
  <style>
    .jenkins-debate-title{margin:0 0 34px!important;text-align:right;color:#5e50ef!important;border:0!important}
    .jenkins-debate-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:48px;margin:0 12px 12px}
    .jenkins-debate-column h3{margin:0 0 18px;color:#5e50ef;font-size:23px;line-height:1.3}
    .jenkins-debate-column.security h3{color:#8752e8}
    .jenkins-debate-column ol{margin:0;padding-left:36px;color:#20252a;font-size:18px;line-height:1.45}
    .jenkins-debate-column li{padding-left:7px;margin:0 0 11px}
    .jenkins-debate-column li::marker{color:#6254ff}
    @media(max-width:700px){
      .jenkins-debate-title{text-align:left!important}
      .jenkins-debate-grid{grid-template-columns:1fr;gap:25px;margin-right:0;margin-left:0}
      .jenkins-debate-column h3{font-size:21px}
      .jenkins-debate-column ol{font-size:17px}
    }
  </style>
  <h2 class="jenkins-debate-title">Preguntas de Reflexión y Debate para la Sesión</h2>
  <div class="jenkins-debate-grid">
    <section class="jenkins-debate-column">
      <h3>Gobernanza y Arquitectura</h3>
      <ol>
        <li>¿En qué momento una organización debe migrar de pipelines individuales a una Shared Library central?</li>
        <li>Si la Shared Library central tiene un bug, ¿qué impacto tiene sobre los microservicios y cómo se mitiga?</li>
        <li>¿Por qué usar Nexus como proxy intermedio de dependencias externas mejora la resiliencia corporativa?</li>
      </ol>
    </section>
    <section class="jenkins-debate-column security">
      <h3>Operaciones y Seguridad</h3>
      <ol start="4">
        <li>¿Cuáles son los riesgos de almacenar credenciales SSH con acceso root en el almacén de Jenkins?</li>
        <li>Si un contenedor falla su healthcheck tras un despliegue CD, ¿cuál es el mecanismo más limpio de recuperación?</li>
      </ol>
    </section>
  </div>
</div>

<?php
pie('tercero.php', '../Menu.php');
