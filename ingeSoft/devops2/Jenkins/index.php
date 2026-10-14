<?php
/* ==========================================================================
   IngeSoft5 / DevOps2 / Jenkins — bloque 01: Arquitectura de Jenkins y pipelines declarativos.
   Fuente: sesion_17_jenkins_cicd_pipelines.pdf (Prof. Alejandro Muñoz Bravo)
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    9 => ['automatizacion'],
    10 => ['desatendida'],
    11 => ['desacoplamiento', 'desacople'],
    12 => ['desarrollador'],
    13 => ['trazabilidad'],
    14 => ['historial de cambios', 'historial'],
    15 => ['quality gates'],
    16 => ['anomalia'],
    17 => ['compila'],
    18 => ['prueba', 'testea'],
    19 => ['orquesta', 'orquesta herramientas especializadas'],
    20 => ['maven'],
    21 => ['docker'],
    22 => ['repetibilidad'],
    23 => ['master'],
    24 => ['web'],
    25 => ['rest'],
    26 => ['programa', 'programa y despacha', 'planifica'],
    27 => ['credenciales'],
    28 => ['rbac'],
    29 => ['historial de ejecuciones', 'historial'],
    30 => ['nunca'],
    31 => ['compilacion'],
    32 => ['contenedores'],
    33 => ['nodes', 'nodos'],
    34 => ['dedicados'],
    35 => ['efimeros'],
    36 => ['ssh'],
    37 => ['inbound tcp', 'tcp inbound', 'tcp entrante'],
    38 => ['50000'],
    39 => ['jdk'],
    40 => ['node.js', 'node'],
    41 => ['docker cli'],
    42 => ['aislan', 'aislan dependencias'],
    43 => ['colisiones'],
    44 => ['manual'],
    45 => ['ui', 'interfaz', 'ui web', 'interfaz web'],
    46 => ['versiones'],
    47 => ['auditar'],
    48 => ['replicar'],
    49 => ['jenkinsfile'],
    50 => ['versiona'],
    51 => ['git'],
    52 => ['pull requests'],
    53 => ['pares'],
    54 => ['recrear'],
    55 => ['desastre'],
    56 => ['identica', 'la misma', 'igual'],
    57 => ['produccion'],
    58 => ['pipeline'],
    59 => ['agent'],
    60 => ['stages'],
    61 => ['steps'],
    62 => ['post'],
];

$TEXTO = [9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62];

$MULTIPLE = [
    'm1' => [
        'texto'    => '¿Cuál es el <b>principio clave</b> de Jenkins según la sesión?',
        'opciones' => [
            'a' => 'Jenkins compila y prueba todo por sí mismo',
            'b' => 'Jenkins no compila ni prueba directamente: orquesta herramientas especializadas (Git, Maven, Docker, Nexus), garantizando repetibilidad y orden',
            'c' => 'Jenkins solo sirve para desplegar',
            'd' => 'Jenkins reemplaza a Git'
        ],
        'correcta' => 'b',
        'porque'   => 'Es un motor de automatización que coordina de forma desatendida cada etapa del ciclo de vida.'
    ],
    'm2' => [
        'texto'    => '¿Qué son los <b>Quality Gates</b> automatizados?',
        'opciones' => [
            'a' => 'Puertas físicas del datacenter',
            'b' => 'Controles que detienen el avance del pipeline ante cualquier anomalía (calidad continua)',
            'c' => 'Plugins de notificación',
            'd' => 'Un tipo de agente'
        ],
        'correcta' => 'b',
        'porque'   => 'Aportan calidad continua al pipeline.'
    ],
    'm3' => [
        'texto'    => 'Ventajas de Jenkins en la cadena de valor (elige la lista completa y correcta):',
        'opciones' => [
            'a' => 'Motor de automatización desatendida, desacoplamiento de entornos, visibilidad y trazabilidad (logs, métricas, estados e historial) y calidad continua con Quality Gates',
            'b' => 'Solo edición de código',
            'c' => 'Solo despliegue manual',
            'd' => 'Solo gestión de bases de datos'
        ],
        'correcta' => 'a',
        'porque'   => 'Cuatro ideas: motor, desacoplamiento, visibilidad/trazabilidad y calidad continua.'
    ],
    'm4' => [
        'texto'    => 'Responsabilidades del <b>Controller</b>:',
        'opciones' => [
            'a' => 'Compilar código y correr contenedores',
            'b' => 'Servir la UI web y APIs REST, programar y despachar jobs, gestionar credenciales y seguridad RBAC y almacenar el historial de ejecuciones',
            'c' => 'Solo almacenar artefactos',
            'd' => 'Solo ejecutar tests'
        ],
        'correcta' => 'b',
        'porque'   => 'Regla de oro: el Controller nunca debe ejecutar tareas pesadas de compilación ni ejecución de contenedores.'
    ],
    'm5' => [
        'texto'    => '¿Cómo se comunican los <b>Agents</b> con el Controller?',
        'opciones' => [
            'a' => 'Por FTP',
            'b' => 'Solo por HTTP',
            'c' => 'Por SSH o inbound TCP (50000)',
            'd' => 'Por correo'
        ],
        'correcta' => 'c',
        'porque'   => 'Reciben instrucciones del Controller por SSH o inbound TCP en el puerto 50000.'
    ],
    'm6' => [
        'texto'    => '¿Qué pueden ser los Agents (workers/nodes)?',
        'opciones' => [
            'a' => 'Solo servidores físicos',
            'b' => 'Solo el Controller',
            'c' => 'Solo navegadores',
            'd' => 'Máquinas virtuales, hosts dedicados o contenedores Docker efímeros'
        ],
        'correcta' => 'd',
        'porque'   => 'Aportan JDK, Node.js y Docker CLI, y aíslan dependencias entre proyectos sin colisiones.'
    ],
    'm7' => [
        'texto'    => '¿Qué principio se viola si el Controller compila proyectos pesados?',
        'opciones' => [
            'a' => 'Regla de oro: el Controller nunca debe ejecutar tareas pesadas de compilación o ejecución de contenedores',
            'b' => 'Build Once',
            'c' => 'SemVer',
            'd' => 'Ninguno'
        ],
        'correcta' => 'a',
        'porque'   => 'Esas tareas pertenecen a los agentes.'
    ],
    'm8' => [
        'texto'    => '¿Cuál <b>NO</b> es un problema de los Freestyle Jobs?',
        'opciones' => [
            'a' => 'Configuración manual dispersa en la UI',
            'b' => 'Sin control de versiones de los cambios',
            'c' => 'Ejecución idéntica en todas las ramas mediante el Jenkinsfile',
            'd' => 'Difícil replicar entre proyectos'
        ],
        'correcta' => 'c',
        'porque'   => 'La ejecución idéntica es una ventaja de Pipeline as Code.'
    ],
    'm9' => [
        'texto'    => '¿Qué aporta <b>Pipeline as Code</b> (Jenkinsfile)?',
        'opciones' => [
            'a' => 'Configuración por UI',
            'b' => 'Flujo de entrega versionado en el repo Git junto al código; evoluciona por Pull Requests y revisión de pares; permite recrear la automatización ante un desastre; ejecución idéntica en ramas de desarrollo y producción',
            'c' => 'Solo mayor velocidad',
            'd' => 'Menos seguridad'
        ],
        'correcta' => 'b',
        'porque'   => 'Versionamiento, auditoría, reproducibilidad y revisión.'
    ],
    'm10' => [
        'texto'    => '¿Por qué es <b>imposible auditar</b> un Freestyle Job?',
        'opciones' => [
            'a' => 'Porque no existe log',
            'b' => 'Porque no hay control de versiones de los cambios: no se sabe quién modificó un paso o comando',
            'c' => 'Porque no corre en agentes',
            'd' => 'Porque no soporta plugins'
        ],
        'correcta' => 'b',
        'porque'   => 'Con Jenkinsfile en Git hay historial, PR y autoría de cada cambio.'
    ],
    'm11' => [
        'texto'    => 'En un Declarative Pipeline, ¿cuál es el bloque raíz <b>obligatorio</b>?',
        'opciones' => [
            'a' => 'stages',
            'b' => 'steps',
            'c' => 'pipeline { ... }',
            'd' => 'post'
        ],
        'correcta' => 'c',
        'porque'   => 'El resto de bloques (agent, stages, steps, post) van dentro.'
    ],
    'm12' => [
        'texto'    => '¿Qué define la directiva <code>agent</code>?',
        'opciones' => [
            'a' => 'El usuario que ejecuta',
            'b' => 'Dónde corre el pipeline (agente Docker, label o nodo)',
            'c' => 'La lista de etapas',
            'd' => 'Las notificaciones'
        ],
        'correcta' => 'b',
        'porque'   => '<code>agent any</code> usa cualquier agente disponible.'
    ],
    'm13' => [
        'texto'    => '¿Qué contiene <code>stages</code> y qué contiene <code>steps</code>?',
        'opciones' => [
            'a' => 'stages: comandos atómicos; steps: etapas',
            'b' => 'Ambos son lo mismo',
            'c' => 'stages: secuencia ordenada de etapas del ciclo de vida; steps: comandos atómicos ejecutados en cada etapa (sh, echo)',
            'd' => 'stages: credenciales; steps: agentes'
        ],
        'correcta' => 'c',
        'porque'   => 'Cada <code>stage</code> tiene su bloque <code>steps</code>.'
    ],
    'm14' => [
        'texto'    => '¿Para qué sirve el bloque <code>post</code>?',
        'opciones' => [
            'a' => 'Para declarar el agente',
            'b' => 'Para definir las etapas',
            'c' => 'Para descargar el código',
            'd' => 'Acciones condicionales ejecutadas tras finalizar (always, success, failure)'
        ],
        'correcta' => 'd',
        'porque'   => 'En el ejemplo: success → echo “Build exitoso!”; failure → “Alerta: Build fallido”.'
    ],
    'm15' => [
        'texto'    => 'En el ejemplo de la lámina, ¿qué hace <code>sh \'mvn clean verify\'</code> en la etapa <i>Test &amp; Build</i>?',
        'opciones' => [
            'a' => 'Despliega la app',
            'b' => 'Ejecuta Maven: limpia, compila y verifica (incluye pruebas)',
            'c' => 'Publica en Nexus',
            'd' => 'Descarga el código'
        ],
        'correcta' => 'b',
        'porque'   => '<code>checkout scm</code> es el que descarga el código en la etapa Checkout.'
    ],
];

$MULTIPLE = [];
iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Jenkins · 1 — Arquitectura y pipelines declarativos', 'Sesión 17 (Jenkins CI/CD): orquestador, Controller/Agents, Freestyle vs Pipeline as Code y anatomía de un Declarative Pipeline');
?>


<div class="card">
    <h2>1. El Orquestador en la Cadena de Valor DevOps</h2>
    <div class="jenkins-orquestador-layout">
        <section class="jenkins-orquestador-content">
            <p>En la entrega continua de software moderno:</p>
            <ul>
                <li><b>Motor de <?php hueco(9, 18); ?>:</b> Coordina la ejecución <?php hueco(10, 15); ?> de cada etapa del ciclo de vida del software.</li>
                <li><b><?php hueco(11, 19); ?> de entornos:</b> Separa las fases de construcción, prueba, publicación y despliegue del entorno del <?php hueco(12, 17); ?>.</li>
                <li><b>Visibilidad y <?php hueco(13, 16); ?>:</b> Centraliza logs, métricas de ejecución, estados de build e <?php hueco(14, 24); ?>.</li>
                <li><b>Calidad continua:</b> Implementa <i><?php hueco(15, 17); ?></i> automatizados que detienen el avance ante cualquier <?php hueco(16, 12); ?>.</li>
            </ul>
        </section>
        <aside class="jenkins-principio">
            <h3>Principio Clave</h3>
            <p>Jenkins no <?php hueco(17, 11); ?> ni <?php hueco(18, 10); ?> directamente: <b><?php hueco(19, 12); ?></b> herramientas especializadas (Git, <?php hueco(20, 9); ?>, <?php hueco(21, 10); ?>, Nexus), garantizando <?php hueco(22, 17); ?> y orden.</p>
        </aside>
    </div>
    <?php enviar(); ?>
</div>

<style>
.jenkins-arquitectura-title{margin-bottom:24px!important;text-align:center;color:#5e50ef!important;border:0!important}
.jenkins-arquitectura-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:44px;margin:20px 8px}
.jenkins-arquitectura-col h3{margin:0 0 8px;color:#5e50ef;font-size:23px;line-height:1.35}
.jenkins-arquitectura-col h4{margin:0 0 12px;color:#17191d;font-size:18px;line-height:1.4}
.jenkins-arquitectura-col ul{margin:0;padding-left:24px;color:#20252a;font-size:17px;line-height:1.4}
.jenkins-arquitectura-col li{padding-left:2px;margin:0 0 10px}
.jenkins-arquitectura-col li::marker{color:#5e50ef}
.jenkins-arquitectura-regla{margin:18px 0 0;font-size:17px;line-height:1.5}
.jenkins-evolucion-col h3{margin:0 0 16px;color:#5e50ef;font-size:23px;line-height:1.35}
.jenkins-evolucion-col ul{margin:0;padding-left:24px;color:#20252a;font-size:18px;line-height:1.4}
.jenkins-evolucion-col li{padding-left:2px;margin:0 0 12px}
.jenkins-evolucion-col li::marker{color:#5e50ef}
.jenkins-evolucion-col code{white-space:nowrap}
.jenkins-pipeline-layout{display:grid;grid-template-columns:minmax(0,1.08fr) minmax(0,1fr);gap:20px;align-items:center;margin:20px 0}
.jenkins-pipeline-code{margin:0;background:#f7f7fb;border:1px solid #d8dbe0;border-radius:0;color:#1f2733;font-size:15px;line-height:1.55}
.jenkins-pipeline-code code{color:inherit}
.jenkins-pipeline-structure{overflow:hidden;border:3px solid #5e50ef;border-radius:12px;background:#f0efff}
.jenkins-pipeline-structure h3{margin:0;padding:9px 14px;background:#5e50ef;color:#fff;text-align:center;font-size:18px;line-height:1.3}
.jenkins-pipeline-structure ul{margin:0;padding:12px 18px 12px 38px;color:#20252a;font-size:16px;line-height:1.35}
.jenkins-pipeline-structure li{padding-left:2px;margin:0 0 9px}
.jenkins-pipeline-structure li:last-child{margin-bottom:0}
.jenkins-pipeline-structure li::marker{color:#5e50ef}
.jenkins-pipeline-structure .hueco{font:inherit;font-family:Consolas,Menlo,monospace;font-size:.9em}
@media(max-width:700px){.jenkins-arquitectura-grid{grid-template-columns:1fr;gap:28px;margin-right:0;margin-left:0}}
@media(max-width:700px){.jenkins-evolucion-grid{gap:28px}}
@media(max-width:760px){.jenkins-pipeline-layout{grid-template-columns:1fr;align-items:stretch}}
</style>
<div class="card">
  <h2 class="jenkins-arquitectura-title">Arquitectura Distribuida: Controller y Agents</h2>
  <div class="jenkins-arquitectura-grid">
    <section class="jenkins-arquitectura-col">
      <h3>Jenkins Controller (<?php hueco(23, 10); ?>)</h3>
      <h4>Responsabilidades principales:</h4>
      <ul>
        <li>Servir la interfaz <?php hueco(24, 7); ?> y APIs <?php hueco(25, 8); ?>.</li>
        <li><?php hueco(26, 12); ?> y despachar tareas (<i>jobs</i>).</li>
        <li>Gestionar <?php hueco(27, 16); ?> y seguridad <?php hueco(28, 8); ?>.</li>
        <li>Almacenar el <?php hueco(29, 28); ?>.</li>
      </ul>
      <p class="jenkins-arquitectura-regla"><b>Regla de oro:</b> el Controller <?php hueco(30, 9); ?> debe ejecutar tareas pesadas de <?php hueco(31, 15); ?> o ejecución de <?php hueco(32, 16); ?>.</p>
    </section>
    <section class="jenkins-arquitectura-col">
      <h3>Jenkins Agents (Workers / <?php hueco(33, 9); ?>)</h3>
      <h4>Ejecución de carga de trabajo:</h4>
      <ul>
        <li>Máquinas virtuales, hosts <?php hueco(34, 13); ?> o contenedores Docker <?php hueco(35, 12); ?>.</li>
        <li>Reciben instrucciones del Controller por <?php hueco(36, 7); ?> o <?php hueco(37, 15); ?> (<?php hueco(38, 9); ?>).</li>
        <li>Proporcionan las herramientas de build (<?php hueco(39, 7); ?>, <?php hueco(40, 11); ?>, <?php hueco(41, 14); ?>).</li>
        <li><?php hueco(42, 10); ?> dependencias entre proyectos sin <?php hueco(43, 14); ?>.</li>
      </ul>
    </section>
  </div>
    <?php enviar(); ?>
</div>

<div class="card">
  <h2 class="jenkins-arquitectura-title">Evolución: De Freestyle Jobs a Pipeline as Code</h2>
  <div class="jenkins-arquitectura-grid jenkins-evolucion-grid">
    <section class="jenkins-evolucion-col">
      <h3>El Problema de los Freestyle Jobs</h3>
      <ul>
        <li>Configuración <?php hueco(44, 10); ?> dispersa en la <?php hueco(45, 6); ?> web.</li>
        <li>Sin control de <?php hueco(46, 13); ?> de los cambios en el pipeline.</li>
        <li>Imposible <?php hueco(47, 11); ?> quién modificó un paso o comando.</li>
        <li>Difícil <?php hueco(48, 12); ?> pipelines entre múltiples proyectos.</li>
      </ul>
    </section>
    <section class="jenkins-evolucion-col">
      <h3>Pipeline as Code (<code><?php hueco(49, 15); ?></code>)</h3>
      <ul>
        <li>El flujo de entrega se <?php hueco(50, 12); ?> en el repositorio <?php hueco(51, 7); ?> junto al código.</li>
        <li>Evoluciona mediante <?php hueco(52, 17); ?> y revisiones de <?php hueco(53, 9); ?>.</li>
        <li>Permite <?php hueco(54, 11); ?> toda la automatización ante un <?php hueco(55, 12); ?>.</li>
        <li>Ejecución <?php hueco(56, 12); ?> en ramas de desarrollo y <?php hueco(57, 14); ?>.</li>
      </ul>
    </section>
  </div>
    <?php enviar(); ?>
</div>

<div class="card">
  <h2>4. Anatomía de un Declarative Pipeline (Jenkinsfile)</h2>
  <p>Ejemplo de referencia: el Jenkinsfile está completo y es solo demostrativo.</p>
  <div class="jenkins-pipeline-layout">
    <pre class="jenkins-pipeline-code"><code>pipeline {
  agent any
  tools { maven 'Maven-3.9' }
  stages {
    stage('Checkout') {
      steps { checkout scm }
    }
    stage('Test &amp; Build') {
      steps {
        sh 'mvn clean verify'
      }
    }
  }
  post {
    success { echo 'Build exitoso!' }
    failure { echo 'Alerta: Build fallido' }
  }
}</code></pre>
    <aside class="jenkins-pipeline-structure">
      <h3>Estructura Declarativa</h3>
      <ul>
        <li><code><?php hueco(58, 10); ?> {...}</code>: bloque raíz obligatorio.</li>
        <li><code><?php hueco(59, 8); ?></code>: define dónde corre el pipeline (agente Docker, label o nodo).</li>
        <li><code><?php hueco(60, 9); ?></code>: secuencia ordenada de etapas del ciclo de vida.</li>
        <li><code><?php hueco(61, 8); ?></code>: comandos ejecutados en cada etapa (<code>sh</code>, <code>echo</code>).</li>
        <li><code><?php hueco(62, 8); ?></code>: acciones condicionales al finalizar (<code>always</code>, <code>success</code>, <code>failure</code>).</li>
      </ul>
    </aside>
  </div>
</div>

<?php
pie('../Menu.php', 'segundo.php');
