<?php
/* ==========================================================================
   IngeSoft5 / DevOps2 / Jenkins — bloque 03: Gobernanza con Jenkins Shared Libraries.
   Fuente: sesion_17_jenkins_cicd_pipelines.pdf
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    4 => ['20'],
    5 => ['50'],
    6 => ['divergencia de codigo', 'divergencia'],
    7 => ['modifica'],
    8 => ['seguridad'],
    9 => ['credencial'],
    10 => ['50'],
    11 => ['estandares'],
    12 => ['sonarqube'],
    13 => ['integracion'],
    14 => ['saltan'],
    15 => ['mantenimiento'],
    16 => ['atomica'],
    17 => ['shared libraries'],
    18 => ['git'],
    19 => ['centralizado'],
    20 => ['versionado'],
    21 => ['devops'],
    28 => ['vars'],
    29 => ['pasos personalizados', 'steps personalizados', 'custom steps'],
    30 => ['jenkinsfile'],
    31 => ['funciones'],
    32 => ['groovy'],
    33 => ['def call(map config)'],
    34 => ['src'],
    35 => ['groovy'],
    36 => ['objetos'],
    37 => ['compleja'],
    38 => ['nexusclient'],
    39 => ['resources'],
    40 => ['no ejecutables'],
    41 => ['schemas'],
    42 => ['despliegue'],
    43 => ['certificados'],
    77 => ['6'],
    78 => ['experto'],
    79 => ['groovy'],
    80 => ['escaneos'],
    81 => ['inalterables'],
    82 => ['tags git', 'tags de git', 'tags'],
];

$TEXTO = [4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 77, 78, 79, 80, 81, 82];

$MULTIPLE = [
    'm1' => [
        'texto'    => '¿Qué problema resuelve una Shared Library en una organización con 20–50 microservicios?',
        'opciones' => [
            'a' => 'Que los pipelines sean muy lentos',
            'b' => 'La divergencia y duplicación de Jenkinsfiles copy-paste: seguridad, estándares y mantenimiento difíciles',
            'c' => 'La falta de agentes',
            'd' => 'La falta de código'
        ],
        'correcta' => 'b',
        'porque'   => 'Se extrae la lógica del pipeline a un repo Git centralizado, versionado y gobernado por DevOps.'
    ],
    'm2' => [
        'texto'    => '¿Por qué el copy-paste de Jenkinsfiles es un problema de <b>seguridad</b>?',
        'opciones' => [
            'a' => 'Porque los Jenkinsfile son secretos',
            'b' => 'Porque actualizar una versión de herramienta o credencial requiere cambiar 50 archivos',
            'c' => 'Porque Git no los guarda',
            'd' => 'Porque cifra los logs'
        ],
        'correcta' => 'b',
        'porque'   => 'Con una Shared Library se cambia en un solo lugar.'
    ],
    'm3' => [
        'texto'    => '¿Cuál <b>NO</b> es un problema del pipeline duplicado?',
        'opciones' => [
            'a' => 'Divergencia de código',
            'b' => 'Falta de estándares (unos corren SonarQube, otros se saltan pasos)',
            'c' => 'Imposible aplicar mejoras globales de forma atómica',
            'd' => 'Gobernanza garantizada e inalterable'
        ],
        'correcta' => 'd',
        'porque'   => 'La gobernanza garantizada es un beneficio de la Shared Library.'
    ],
    'm4' => [
        'texto'    => 'Solución propuesta:',
        'opciones' => [
            'a' => 'Copiar más Jenkinsfiles',
            'b' => 'Extraer la lógica del pipeline a un repositorio Git centralizado, versionado y gobernado por el equipo DevOps',
            'c' => 'Ejecutar todo a mano',
            'd' => 'Dar cada equipo su Jenkins'
        ],
        'correcta' => 'b',
        'porque'   => 'Esto se llama Jenkins Shared Library.'
    ],
    'm5' => [
        'texto'    => '¿Para qué sirve la carpeta <code>vars/</code>?',
        'opciones' => [
            'a' => 'Para clases OOP complejas',
            'b' => 'Para pasos personalizados (Steps DSL) ejecutables directamente en el Jenkinsfile como funciones',
            'c' => 'Para archivos no ejecutables',
            'd' => 'Para logs'
        ],
        'correcta' => 'b',
        'porque'   => 'Cada archivo nombrePaso.groovy expone un método def call(Map config).'
    ],
    'm6' => [
        'texto'    => '¿Para qué sirve la carpeta <code>src/</code>?',
        'opciones' => [
            'a' => 'Steps DSL',
            'b' => 'Plantillas',
            'c' => 'Código Groovy estructurado con paquetes orientados a objetos, para lógica compleja y utilidades (p. ej. org/icesi/devops/NexusClient.groovy)',
            'd' => 'Certificados'
        ],
        'correcta' => 'c',
        'porque'   => 'Es el lugar para clases OOP.'
    ],
    'm7' => [
        'texto'    => '¿Qué se guarda en <code>resources/</code>?',
        'opciones' => [
            'a' => 'Ficheros no ejecutables: JSON schemas, plantillas de despliegue, certificados',
            'b' => 'Steps',
            'c' => 'Clases Groovy',
            'd' => 'Tests'
        ],
        'correcta' => 'a',
        'porque'   => 'En el ejemplo, docker-compose.tmpl.yml es una plantilla.'
    ],
    'm8' => [
        'texto'    => '¿Qué método debe exponer cada archivo de <code>vars/</code>?',
        'opciones' => [
            'a' => 'def run()',
            'b' => 'def main(String[] args)',
            'c' => 'def execute()',
            'd' => 'def call(Map config)'
        ],
        'correcta' => 'd',
        'porque'   => 'Así se invoca como <code>nombrePaso(...)</code> desde el Jenkinsfile.'
    ],
    'm9' => [
        'texto'    => 'Relaciona: ¿qué comentario acompaña a cada carpeta en el árbol?',
        'opciones' => [
            'a' => 'vars → Steps DSL; src → Clases OOP; resources → Plantillas',
            'b' => 'vars → Plantillas; src → Steps DSL; resources → OOP',
            'c' => 'vars → OOP; src → Plantillas; resources → DSL',
            'd' => 'vars → Certificados; src → Tests; resources → Logs'
        ],
        'correcta' => 'a',
        'porque'   => 'Las tres carpetas de la estructura canónica.'
    ],
    'm10' => [
        'texto'    => 'En <code>config.appName ?: \'microservice\'</code>, ¿qué hace el operador <code>?:</code>?',
        'opciones' => [
            'a' => 'Compara igualdad',
            'b' => 'Devuelve el valor por defecto (\'microservice\') si config.appName no viene definido (operador Elvis)',
            'c' => 'Lanza un error',
            'd' => 'Concatena cadenas'
        ],
        'correcta' => 'b',
        'porque'   => 'Lo mismo para <code>BUILD_TOOL</code>, cuyo valor por defecto es maven.'
    ],
    'm11' => [
        'texto'    => '¿Para qué sirve el bloque <code>script { ... }</code> en un pipeline declarativo?',
        'opciones' => [
            'a' => 'Para declarar el agente',
            'b' => 'Para ejecutar lógica Groovy imperativa (como if/else) dentro del pipeline declarativo',
            'c' => 'Para definir credenciales',
            'd' => 'Para publicar en Nexus'
        ],
        'correcta' => 'b',
        'porque'   => 'En el ejemplo elige entre <code>mvn clean verify</code> y <code>npm test</code> según BUILD_TOOL.'
    ],
    'm12' => [
        'texto'    => '¿Qué hace la etapa <i>Publish to Nexus</i> de la librería?',
        'opciones' => [
            'a' => 'Ejecuta <code>mvn clean verify</code>',
            'b' => 'Invoca el step personalizado <code>publishToNexus(appName: env.APP_NAME)</code>',
            'c' => 'Hace checkout',
            'd' => 'Ejecuta npm test'
        ],
        'correcta' => 'b',
        'porque'   => 'Reutiliza el step definido en vars/publishToNexus.groovy.'
    ],
    'm13' => [
        'texto'    => '¿Cómo importa el repo de la app la librería compartida?',
        'opciones' => [
            'a' => 'import shared',
            'b' => '@Library(\'iaslab-shared-library@v1.2\') _',
            'c' => 'include library',
            'd' => 'require(\'shared\')'
        ],
        'correcta' => 'b',
        'porque'   => 'El sufijo @v1.2 es un tag de Git que fija la versión.'
    ],
    'm14' => [
        'texto'    => '¿Qué significa <code>@v1.2</code> en <code>@Library(\'iaslab-shared-library@v1.2\') _</code>?',
        'opciones' => [
            'a' => 'Un puerto',
            'b' => 'Un usuario',
            'c' => 'Un tag de Git que fija la versión de la librería usada',
            'd' => 'Un agente'
        ],
        'correcta' => 'c',
        'porque'   => 'Versionamiento de la librería mediante tags Git.'
    ],
    'm15' => [
        'texto'    => 'Beneficios inmediatos de usar la librería en el microservicio:',
        'opciones' => [
            'a' => 'Jenkinsfile de solo 6 líneas; no hace falta ser experto en Jenkins ni Groovy; seguridad y gobernanza garantizadas (escaneos y validaciones obligatorias inalterables); versionamiento por tags Git',
            'b' => 'Jenkinsfile de 600 líneas',
            'c' => 'Más agentes',
            'd' => 'Se elimina Nexus'
        ],
        'correcta' => 'a',
        'porque'   => 'Resumen de la lámina «Consumo del pipeline central».'
    ],
    'm16' => [
        'texto'    => 'En la invocación <code>standardPipeline(appName: ..., buildTool: ..., enableNexusPublish: true, deployEnv: \'staging\')</code>, ¿qué se pasa?',
        'opciones' => [
            'a' => 'Un mapa de configuración (Map config) al step estandarizado',
            'b' => 'Un array de agentes',
            'c' => 'Un string de comandos shell',
            'd' => 'Un archivo XML'
        ],
        'correcta' => 'a',
        'porque'   => 'Corresponde al parámetro Map config del método call.'
    ],
    'm17' => [
        'texto'    => 'Si la Shared Library central tiene un bug (pregunta de debate), ¿qué ocurre y cómo se mitiga?',
        'opciones' => [
            'a' => 'Nada, es local a un repo',
            'b' => 'Solo afecta a un microservicio',
            'c' => 'No se puede mitigar',
            'd' => 'Impacta a todos los microservicios que la usen; se mitiga versionando con tags (@v1.2), probando antes de liberar y permitiendo fijar o volver a una versión anterior'
        ],
        'correcta' => 'd',
        'porque'   => 'Es el riesgo del punto único de gobernanza: por eso se versiona la librería y cada app puede fijar su versión.'
    ],
];

iniciar($SOLUCIONES, [], $TEXTO);
cabecera('Jenkins · 3 — Shared Libraries', 'Sesión 17 (Jenkins CI/CD): antipatrón copy-paste, estructura vars/src/resources, standardPipeline y @Library');
?>


<div class="card">
  <style>
    .jenkins-copy-paste-title{margin-bottom:24px!important;text-align:center;color:#5e50ef!important;border:0!important}
    .jenkins-copy-paste-layout{display:grid;grid-template-columns:minmax(0,1.4fr) minmax(290px,.9fr);gap:30px;align-items:center;margin:20px 8px}
    .jenkins-copy-paste-content>p{margin:0 0 12px;font-size:18px;line-height:1.45}
    .jenkins-copy-paste-content ul{margin:0;padding-left:24px;color:#20252a;font-size:17px;line-height:1.4}
    .jenkins-copy-paste-content li{padding-left:2px;margin:0 0 12px}
    .jenkins-copy-paste-content li::marker{color:#5e50ef}
    .jenkins-copy-paste-solution{overflow:hidden;border:4px solid #8752e8;border-radius:14px;background:#f3edff}
    .jenkins-copy-paste-solution h3{margin:0;padding:8px 14px;background:#8752e8;color:#fff;text-align:center;font-size:21px;line-height:1.3}
    .jenkins-copy-paste-solution p{margin:0;padding:14px 18px;font-size:18px;line-height:1.45}
    @media(max-width:700px){.jenkins-copy-paste-layout{grid-template-columns:1fr;gap:24px;margin-right:0;margin-left:0}}
  </style>
  <h2 class="jenkins-copy-paste-title">El Antipatrón del Pipeline Duplicado (Copy-Paste)</h2>
  <div class="jenkins-copy-paste-layout">
    <section class="jenkins-copy-paste-content">
      <p>Cuando una organización tiene <?php hueco(4, 6); ?> o <?php hueco(5, 6); ?> microservicios:</p>
      <ul>
        <li><b><?php hueco(6, 25); ?>:</b> cada equipo copia el Jenkinsfile de otro y lo <?php hueco(7, 12); ?> a su criterio.</li>
        <li><b>Vulnerabilidades de <?php hueco(8, 13); ?>:</b> actualizar una versión de herramienta o <?php hueco(9, 14); ?> requiere cambiar <?php hueco(10, 6); ?> archivos.</li>
        <li><b>Falta de <?php hueco(11, 14); ?>:</b> unos proyectos ejecutan <?php hueco(12, 13); ?>, otros pruebas de <?php hueco(13, 15); ?> y otros se <?php hueco(14, 10); ?> pasos.</li>
        <li><b>Alto costo de <?php hueco(15, 17); ?>:</b> imposible aplicar mejoras globales de infraestructura de forma <?php hueco(16, 11); ?>.</li>
      </ul>
    </section>
    <aside class="jenkins-copy-paste-solution">
      <h3>La Solución</h3>
      <p><b>Jenkins <?php hueco(17, 20); ?>:</b> extraer la lógica completa del pipeline a un repositorio <?php hueco(18, 7); ?> <?php hueco(19, 16); ?>, <?php hueco(20, 14); ?> y gobernado por el equipo <?php hueco(21, 10); ?>.</p>
    </aside>
  </div>
    <?php enviar(); ?>
</div>

<div class="card">
  <style>
    .jenkins-library-structure-title{margin-bottom:24px!important;text-align:center;color:#5e50ef!important;border:0!important}
    .jenkins-library-structure{display:grid;grid-template-columns:minmax(0,1fr) minmax(0,1fr);gap:30px;align-items:center;margin:24px 8px}
    .jenkins-library-panel{overflow:hidden;border:3px solid #514be8;border-radius:12px;background:#f7f7fb}
    .jenkins-library-panel.purpose{border-color:#8752e8;background:#f3edff}
    .jenkins-library-panel h3{margin:0;padding:8px 14px;background:#514be8;color:#fff;text-align:center;font-size:18px;line-height:1.3}
    .jenkins-library-panel.purpose h3{background:#8752e8}
    .jenkins-library-tree{margin:0;padding:12px 16px;background:transparent;border:0;border-radius:0;color:#1f2733;font-size:14px;line-height:1.55;white-space:pre;overflow-x:auto}
    .jenkins-library-tree code{color:inherit}
    .jenkins-library-purpose-list{margin:0;padding:12px 18px 12px 38px;color:#20252a;font-size:16px;line-height:1.4}
    .jenkins-library-purpose-list li{padding-left:2px;margin:0 0 9px}
    .jenkins-library-purpose-list li:last-child{margin-bottom:0}
    .jenkins-library-purpose-list li::marker{color:#5e50ef}
    .jenkins-library-purpose-list .hueco{font:inherit;font-family:Consolas,Menlo,monospace;font-size:.9em}
    @media(max-width:760px){.jenkins-library-structure{grid-template-columns:1fr;gap:22px;margin-right:0;margin-left:0}}
  </style>
  <h2 class="jenkins-library-structure-title">Estructura Canónica de una Jenkins Shared Library</h2>
  <div class="jenkins-library-structure">
    <section class="jenkins-library-panel">
      <h3>Árbol de Directorios del Repo Central</h3>
      <pre class="jenkins-library-tree"><code>[repo-shared-library]/
+-- vars/                 % Steps DSL
|   +-- standardPipeline.groovy
|   +-- publishToNexus.groovy
|   +-- deployContainer.groovy
+-- src/                  % Clases OOP
|   +-- org/icesi/devops/NexusClient.groovy
+-- resources/            % Plantillas
    +-- docker-compose.tmpl.yml</code></pre>
    </section>
    <section class="jenkins-library-panel purpose">
      <h3>Propósito de cada Carpeta</h3>
      <ul class="jenkins-library-purpose-list">
        <li><code><?php hueco(28, 8); ?>/</code>: define <?php hueco(29, 24); ?> ejecutables directamente en el <code><?php hueco(30, 15); ?></code> como <?php hueco(31, 13); ?>.</li>
        <li>Cada archivo <code>nombrePaso.<?php hueco(32, 10); ?></code> expone un método <code><?php hueco(33, 24); ?></code>.</li>
        <li><code><?php hueco(34, 7); ?>/</code>: código <code><?php hueco(35, 10); ?></code> estructurado con paquetes orientados a <?php hueco(36, 11); ?> para lógica <?php hueco(37, 12); ?> y utilidades (p. ej., <code><?php hueco(38, 15); ?>.groovy</code>).</li>
        <li><code><?php hueco(39, 13); ?>/</code>: ficheros <?php hueco(40, 18); ?> (JSON <code><?php hueco(41, 11); ?></code>, plantillas de <?php hueco(42, 14); ?>, <?php hueco(43, 16); ?>).</li>
      </ul>
    </section>
  </div>
    <?php enviar(); ?>
</div>

<div class="card">
  <style>
    .jenkins-standard-pipeline-title{margin:0 0 24px!important;text-align:right;color:#5e50ef!important;border:0!important}
    .jenkins-standard-pipeline-code{margin:20px 0 0;background:#f7f7fb;border:1px solid #d8dbe0;border-radius:0;color:#1f2733;font-size:14px;line-height:1.45;white-space:pre;overflow-x:auto}
    .jenkins-standard-pipeline-code code{color:inherit}
  </style>
  <h2 class="jenkins-standard-pipeline-title">Implementación de la Librería Central<br><code>(vars/standardPipeline.groovy)</code></h2>
  <pre class="jenkins-standard-pipeline-code"><code>def call(Map config = [:]) {
  pipeline {
    agent any
    environment {
      APP_NAME   = config.appName ?: 'microservice'
      BUILD_TOOL = config.buildTool ?: 'maven'
    }
    stages {
      stage('Checkout') { steps { checkout scm } }
      stage('Build &amp; Test') {
        steps {
          script {
            if (env.BUILD_TOOL == 'maven') { sh 'mvn clean verify' }
            else { sh 'npm test' }
          }
        }
      }
      stage('Publish to Nexus') {
        steps { publishToNexus(appName: env.APP_NAME) }
      }
    }
  }
}</code></pre>
</div>

<div class="card">
  <style>
    .jenkins-consumo-title{margin:0 0 24px!important;text-align:right;color:#5e50ef!important;border:0!important}
    .jenkins-consumo-grid{display:grid;grid-template-columns:minmax(0,1.15fr) minmax(0,.9fr);gap:24px;align-items:center;margin:20px 8px}
    .jenkins-consumo-panel{overflow:hidden;border:3px solid #49b978;border-radius:12px;background:#f1f8f4}
    .jenkins-consumo-panel h3{margin:0;padding:8px 14px;background:#49b978;color:#fff;text-align:center;font-size:18px;line-height:1.3}
    .jenkins-consumo-code{margin:0;padding:14px 16px;background:#f7f7fb;border:1px solid #d8dbe0;border-radius:0;color:#1f2733;font-size:14px;line-height:1.5;white-space:pre;overflow-x:auto}
    .jenkins-consumo-code code{color:inherit}
    .jenkins-consumo-benefits{margin:0;padding:12px 16px 12px 38px;color:#20252a;font-size:16px;line-height:1.4}
    .jenkins-consumo-benefits li{padding-left:2px;margin:0 0 10px}
    .jenkins-consumo-benefits li:last-child{margin-bottom:0}
    .jenkins-consumo-benefits li::marker{color:#5e50ef}
    .jenkins-consumo-benefits .hueco{font:inherit;font-family:Consolas,Menlo,monospace;font-size:.9em}
    @media(max-width:760px){.jenkins-consumo-grid{grid-template-columns:1fr;gap:22px;margin-right:0;margin-left:0}}
  </style>
  <h2 class="jenkins-consumo-title">Consumo del Pipeline Central en el Repositorio<br>de la App</h2>
  <div class="jenkins-consumo-grid">
    <section class="jenkins-consumo-panel">
      <h3>Jenkinsfile en el Repo del Microservicio</h3>
      <pre class="jenkins-consumo-code"><code>// Importa la libreria central versionada
@Library('iaslab-shared-library@v1.2') _

// Invoca el pipeline estandarizado
standardPipeline(
    appName: 'catalogo-productos',
    buildTool: 'maven',
    enableNexusPublish: true,
    deployEnv: 'staging'
)</code></pre>
    </section>
    <section class="jenkins-consumo-panel">
      <h3>Beneficios Inmediatos</h3>
      <ul class="jenkins-consumo-benefits">
        <li>El Jenkinsfile del microservicio tiene solo <b><?php hueco(77, 6); ?> líneas</b>.</li>
        <li>El desarrollador no necesita ser <?php hueco(78, 11); ?> en Jenkins ni en scripts <?php hueco(79, 10); ?>.</li>
        <li><b>Seguridad y gobernanza garantizadas:</b> <?php hueco(80, 12); ?> y validaciones obligatorias <?php hueco(81, 16); ?>.</li>
        <li>Versionamiento de la librería mediante <?php hueco(82, 12); ?> (<code>@v1.2</code>).</li>
      </ul>
    </section>
  </div>
    <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('segundo.php', 'cuarto.php');
