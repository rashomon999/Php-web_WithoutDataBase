<?php
/* ==========================================================================
   IngeSoft5 / DevOps2 / Jenkins — bloque 02: Integración con Git, triggers y secretos.
   Fuente: sesion_17_jenkins_cicd_pipelines.pdf
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    3 => ['consulta', 'pregunta', 'revisa'],
    4 => ['5 minutos', '5 min', '5', 'cinco minutos', 'cinco min'],
    5 => ['sobrecarga inutil', 'sobrecarga'],
    6 => ['latencia'],
    7 => ['horas fijas', 'horarios fijos'],
    8 => ['nocturnos'],
    9 => ['de inmediato', 'inmediatamente'],
    10 => ['git push'],
    11 => ['pr', 'pull request'],
    12 => ['cero'],
    13 => ['segundos'],
    14 => ['publica'],
    15 => ['smee.io'],
    16 => ['sse'],
    17 => ['saliente', 'outbound'],
    18 => ['secreto compartido', 'shared secret'],
    19 => ['hmac'],
    20 => ['descubrir', 'detectar'],
    21 => ['ramas'],
    22 => ['activas'],
    23 => ['sub-pipeline', 'subpipeline', 'pipeline'],
    24 => ['efimeras'],
    25 => ['merge'],
    26 => ['main'],
    27 => ['aislamiento'],
    28 => ['fallido'],
    29 => ['feature'],
    30 => ['principal'],
    31 => ['borradas'],
    32 => ['memoria'],
    33 => ['disco'],
    34 => ['trunk-based development', 'trunk based development', 'tbd'],
    35 => ['git-flow', 'gitflow', 'git flow'],
    36 => ['inmediato'],
    37 => ['github'],
    38 => ['gitlab'],
    50 => ['hardcodear'],
    51 => ['jenkinsfile'],
    52 => ['git'],
    53 => ['cifra'],
    54 => ['credentials store', 'credential store', 'credentials'],
    55 => ['****'],
    56 => ['consola'],
    57 => ['withcredentials'],
];

$TEXTO = [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 50, 51, 52, 53, 54, 55, 56, 57];

$MULTIPLE = [
    'm1' => [
        'texto'    => '¿Cuál es la <b>desventaja</b> del Polling SCM?',
        'opciones' => [
            'a' => 'Es demasiado rápido',
            'b' => 'No funciona con Git',
            'c' => 'Sobrecarga inútil de peticiones y latencia en detectar cambios',
            'd' => 'Solo funciona de noche'
        ],
        'correcta' => 'c',
        'porque'   => 'Jenkins consulta periódicamente (p. ej. cada 5 min). Los webhooks lo evitan con notificación push.'
    ],
    'm2' => [
        'texto'    => '¿Cuál es la diferencia entre Polling SCM y Cron/Scheduled?',
        'opciones' => [
            'a' => 'Ninguna',
            'b' => 'Polling consulta periódicamente al repo por cambios; Cron ejecuta a horas fijas (p. ej. builds nocturnos), sin importar si hubo cambios',
            'c' => 'Cron es en tiempo real',
            'd' => 'Polling solo funciona con SVN'
        ],
        'correcta' => 'b',
        'porque'   => 'Ambos son mecanismos tradicionales; el recomendado es el webhook.'
    ],
    'm3' => [
        'texto'    => '¿Por qué son <b>recomendados</b> los webhooks?',
        'opciones' => [
            'a' => 'Porque son gratis',
            'b' => 'Porque evitan usar Git',
            'c' => 'Notificación push inmediata al hacer git push o PR; latencia cero: el pipeline arranca segundos después de subir código',
            'd' => 'Porque no requieren red'
        ],
        'correcta' => 'c',
        'porque'   => 'No hay peticiones inútiles de polling.'
    ],
    'm4' => [
        'texto'    => '¿Qué herramienta recomienda oficialmente GitHub para servidores Jenkins <b>sin IP pública</b> (intranets y redes privadas)?',
        'opciones' => [
            'a' => 'Ngrok de pago',
            'b' => 'Smee.io (relay SSE saliente)',
            'c' => 'FTP',
            'd' => 'Telnet'
        ],
        'correcta' => 'b',
        'porque'   => 'El relay es <i>outbound</i>: Jenkins abre la conexión saliente y recibe los eventos.'
    ],
    'm5' => [
        'texto'    => '¿Cómo se valida la seguridad de un webhook?',
        'opciones' => [
            'a' => 'Con un secreto compartido (HMAC secret token)',
            'b' => 'Con captcha',
            'c' => 'No se valida',
            'd' => 'Con la IP del navegador'
        ],
        'correcta' => 'a',
        'porque'   => 'El emisor firma el payload con HMAC y Jenkins verifica la firma.'
    ],
    'm6' => [
        'texto'    => '¿Qué hace el descubrimiento dinámico en <b>Multibranch Pipelines</b>?',
        'opciones' => [
            'a' => 'Elimina ramas',
            'b' => 'Detecta ramas activas del repositorio y crea un sub-pipeline por cada una',
            'c' => 'Solo construye main',
            'd' => 'Sube artefactos'
        ],
        'correcta' => 'b',
        'porque'   => 'Cada rama con Jenkinsfile obtiene su propio pipeline.'
    ],
    'm7' => [
        'texto'    => 'Sobre la validación de Pull Requests en Multibranch:',
        'opciones' => [
            'a' => 'Se hace después del merge',
            'b' => 'Se ejecuta solo a mano',
            'c' => 'Se ejecutan pruebas y compilación sobre ramas efímeras antes del merge a main',
            'd' => 'No es posible'
        ],
        'correcta' => 'c',
        'porque'   => 'El feedback aparece en la misma interfaz de GitHub/GitLab.'
    ],
    'm8' => [
        'texto'    => '¿Qué ventaja da el <b>aislamiento</b> en Multibranch?',
        'opciones' => [
            'a' => 'Reduce el número de tests',
            'b' => 'Que un build fallido en una rama de feature no interfiera con la rama principal',
            'c' => 'Que se ejecuten todas las ramas en un solo build',
            'd' => 'Que no se use Git'
        ],
        'correcta' => 'b',
        'porque'   => 'Cada rama tiene su propio pipeline y estado.'
    ],
    'm9' => [
        'texto'    => '¿Qué pasa con los pipelines de ramas borradas en Git?',
        'opciones' => [
            'a' => 'Quedan para siempre',
            'b' => 'Jenkins los elimina automáticamente (limpieza automática) para no saturar memoria ni disco',
            'c' => 'Se convierten en main',
            'd' => 'Se envían a Nexus'
        ],
        'correcta' => 'b',
        'porque'   => 'Multibranch también permite Trunk-Based Development o Git-Flow con feedback inmediato al desarrollador.'
    ],
    'm10' => [
        'texto'    => '¿Cuál es la regla básica de seguridad con credenciales en Jenkins?',
        'opciones' => [
            'a' => 'Ponerlas en el Jenkinsfile',
            'b' => 'Compartirlas por chat',
            'c' => 'Nunca hardcodear contraseñas en el Jenkinsfile ni en scripts de Git; guardarlas en el Credentials Store cifrado',
            'd' => 'Escribirlas en la wiki'
        ],
        'correcta' => 'c',
        'porque'   => 'Jenkins cifra las credenciales en su almacén seguro.'
    ],
    'm11' => [
        'texto'    => '¿Qué hace el <b>enmascaramiento en logs</b>?',
        'opciones' => [
            'a' => 'Oculta el Jenkinsfile',
            'b' => 'Reemplaza automáticamente cualquier coincidencia del valor de la variable por **** en la consola',
            'c' => 'Encripta el repositorio',
            'd' => 'Borra los logs'
        ],
        'correcta' => 'b',
        'porque'   => 'Así el secreto no aparece si algún comando lo imprime.'
    ],
    'm12' => [
        'texto'    => '¿Cuál es el <b>ámbito</b> de las variables de <code>withCredentials</code>?',
        'opciones' => [
            'a' => 'Todo el pipeline',
            'b' => 'Todos los jobs',
            'c' => 'Solo existen durante el bloque withCredentials',
            'd' => 'Todo Jenkins'
        ],
        'correcta' => 'c',
        'porque'   => 'Ámbito restringido para minimizar la exposición.'
    ],
    'm13' => [
        'texto'    => 'En el ejemplo, ¿qué significan <code>usernameVariable: \'NEXUS_USER\'</code> y <code>passwordVariable: \'NEXUS_PASS\'</code>?',
        'opciones' => [
            'a' => 'Que se usan credenciales fijas en texto',
            'b' => 'Que Jenkins expone usuario y contraseña de la credencial <code>nexus-admin-creds</code> en esas variables de entorno, solo dentro del bloque',
            'c' => 'Que se crea un usuario nuevo en Nexus',
            'd' => 'Que se cambia la contraseña'
        ],
        'correcta' => 'b',
        'porque'   => 'El script usa <code>${NEXUS_USER}:${NEXUS_PASS}</code> con curl -u.'
    ],
    'm14' => [
        'texto'    => 'En el ejemplo, ¿a qué puerto y repositorio se sube el artefacto?',
        'opciones' => [
            'a' => '9080 / docker-hosted',
            'b' => '8080 / npm',
            'c' => '9081 / maven-releases',
            'd' => '50000 / maven-snapshots'
        ],
        'correcta' => 'c',
        'porque'   => 'El puerto 9081 es el de Maven; el 9080 es el del registro Docker.'
    ],
];

iniciar($SOLUCIONES, [], $TEXTO);
cabecera('Jenkins · 2 — Git, triggers, multibranch y secretos', 'Sesión 17 (Jenkins CI/CD): polling vs webhooks, Smee.io, HMAC, Multibranch Pipelines y withCredentials');
?>


<div class="card">
  <style>
    .jenkins-disparadores-title{margin-bottom:24px!important;text-align:center;color:#5e50ef!important;border:0!important}
    .jenkins-disparadores-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:44px;margin:24px 8px 14px}
    .jenkins-disparadores-col h3{margin:0 0 20px;color:#5e50ef;font-size:23px;line-height:1.3}
    .jenkins-disparadores-col.webhooks h3{color:#8752e8}
    .jenkins-disparadores-col ul{margin:0;padding-left:24px;color:#20252a;font-size:18px;line-height:1.4}
    .jenkins-disparadores-col li{padding-left:2px;margin:0 0 12px}
    .jenkins-disparadores-col li::marker{color:#5e50ef}
    @media(max-width:700px){.jenkins-disparadores-grid{grid-template-columns:1fr;gap:26px;margin-right:0;margin-left:0}}
  </style>
  <h2 class="jenkins-disparadores-title">Mecanismos de Disparo del Pipeline</h2>
  <div class="jenkins-disparadores-grid">
    <section class="jenkins-disparadores-col">
      <h3>Polling SCM vs. Cron (Tradicional)</h3>
      <ul>
        <li><b>Polling SCM:</b> Jenkins <?php hueco(3, 12); ?> periódicamente al repo Git (ej. cada <?php hueco(4, 13); ?>).</li>
        <li><b>Desventaja:</b> <?php hueco(5, 21); ?> de peticiones y <?php hueco(6, 12); ?> en detectar cambios.</li>
        <li><b>Cron / Scheduled:</b> ejecución a <?php hueco(7, 15); ?> (ej. builds <?php hueco(8, 13); ?>).</li>
      </ul>
    </section>
    <section class="jenkins-disparadores-col webhooks">
      <h3>Webhooks en Tiempo Real (Recomendado)</h3>
      <ul>
        <li><b>Notificación push:</b> Git notifica a Jenkins <?php hueco(9, 16); ?> al ocurrir un <code><?php hueco(10, 12); ?></code> o un <?php hueco(11, 6); ?>.</li>
        <li><b>Latencia <?php hueco(12, 8); ?>:</b> el pipeline inicia <?php hueco(13, 12); ?> después de que el desarrollador sube código.</li>
        <li><b>Intranets y Redes Privadas:</b> para servidores sin IP <?php hueco(14, 11); ?>, GitHub recomienda oficialmente <b><?php hueco(15, 11); ?></b> (relay <?php hueco(16, 7); ?> <?php hueco(17, 12); ?>).</li>
        <li><b>Seguridad:</b> validado mediante <?php hueco(18, 22); ?> (<i><?php hueco(19, 8); ?> secret token</i>).</li>
      </ul>
    </section>
  </div>
    <?php enviar(); ?>
</div>

<div class="card">
  <style>
    .jenkins-multibranch-title{margin-bottom:24px!important;text-align:center;color:#5e50ef!important;border:0!important}
    .jenkins-multibranch-layout{display:grid;grid-template-columns:minmax(0,1.4fr) minmax(290px,.9fr);gap:30px;align-items:center;margin:20px 8px}
    .jenkins-multibranch-content>p{margin:0 0 12px;font-size:18px;line-height:1.45}
    .jenkins-multibranch-content ul{margin:0;padding-left:24px;color:#20252a;font-size:17px;line-height:1.4}
    .jenkins-multibranch-content li{padding-left:2px;margin:0 0 12px}
    .jenkins-multibranch-content li::marker{color:#5e50ef}
    .jenkins-multibranch-strategy{overflow:hidden;border:4px solid #8752e8;border-radius:14px;background:#f3edff}
    .jenkins-multibranch-strategy h3{margin:0;padding:8px 14px;background:#8752e8;color:#fff;text-align:center;font-size:21px;line-height:1.3}
    .jenkins-multibranch-strategy p{margin:0;padding:14px 18px;font-size:18px;line-height:1.45}
    @media(max-width:700px){.jenkins-multibranch-layout{grid-template-columns:1fr;gap:24px;margin-right:0;margin-left:0}}
  </style>
  <h2 class="jenkins-multibranch-title">Multibranch Pipelines: Integración Continua Real</h2>
  <div class="jenkins-multibranch-layout">
    <section class="jenkins-multibranch-content">
      <p>Capacidad de Jenkins para <?php hueco(20, 13); ?> y gestionar <?php hueco(21, 9); ?> automáticamente:</p>
      <ul>
        <li><b>Descubrimiento dinámico:</b> detecta ramas <?php hueco(22, 11); ?> en el repositorio y crea un <?php hueco(23, 16); ?> por cada una.</li>
        <li><b>Validación de Pull Requests:</b> ejecuta pruebas y compilación sobre ramas <?php hueco(24, 12); ?> antes del merge a <code><?php hueco(26, 8); ?></code>.</li>
        <li><b><?php hueco(27, 15); ?>:</b> evita que un build <?php hueco(28, 11); ?> en una rama de <?php hueco(29, 11); ?> interfiera con la rama <?php hueco(30, 13); ?>.</li>
        <li><b>Limpieza automática:</b> elimina pipelines de ramas <?php hueco(31, 12); ?> en Git para no saturar <?php hueco(32, 11); ?> ni <?php hueco(33, 9); ?>.</li>
      </ul>
    </section>
    <aside class="jenkins-multibranch-strategy">
      <h3>Estrategia de Ramas</h3>
      <p>Permite implementar <b><i><?php hueco(34, 27); ?></i></b> o <b><i><?php hueco(35, 12); ?></i></b> con feedback <?php hueco(36, 13); ?> al desarrollador en la misma interfaz de <?php hueco(37, 10); ?>/<?php hueco(38, 10); ?>.</p>
    </aside>
  </div>
    <?php enviar(); ?>
</div>

<div class="card">
  <style>
    .jenkins-secretos-title{margin-bottom:24px!important;text-align:center;color:#5e50ef!important;border:0!important}
    .jenkins-secretos-layout{display:grid;grid-template-columns:minmax(0,1.15fr) minmax(0,.95fr);gap:24px;align-items:center;margin:20px 8px}
    .jenkins-secretos-code{margin:0;background:#f7f7fb;border:1px solid #d8dbe0;border-radius:0;color:#1f2733;font-size:15px;line-height:1.55}
    .jenkins-secretos-code code{color:inherit}
    .jenkins-secretos-panel{overflow:hidden;border:3px solid #f45d12;border-radius:14px;background:#fff3eb}
    .jenkins-secretos-panel h3{margin:0;padding:8px 14px;background:#f45d12;color:#fff;text-align:center;font-size:19px;line-height:1.3}
    .jenkins-secretos-panel ul{margin:0;padding:12px 16px 12px 36px;color:#20252a;font-size:16px;line-height:1.4}
    .jenkins-secretos-panel li{padding-left:2px;margin:0 0 10px}
    .jenkins-secretos-panel li:last-child{margin-bottom:0}
    .jenkins-secretos-panel li::marker{color:#5e50ef}
    .jenkins-secretos-panel .hueco{font:inherit;font-family:Consolas,Menlo,monospace;font-size:.9em}
    @media(max-width:760px){.jenkins-secretos-layout{grid-template-columns:1fr;align-items:stretch;margin-right:0;margin-left:0}}
  </style>
  <h2 class="jenkins-secretos-title">Gestión Segura de Secretos (<code>withCredentials</code>)</h2>
  <div class="jenkins-secretos-layout">
    <pre class="jenkins-secretos-code"><code>stage('Publish Artifact') {
  steps {
    withCredentials([
      usernamePassword(
        credentialsId: 'nexus-admin-creds',
        usernameVariable: 'NEXUS_USER',
        passwordVariable: 'NEXUS_PASS'
      )
    ]) {
      sh '''
        curl -u "${NEXUS_USER}:${NEXUS_PASS}" \
          --upload-file target/app.jar \
          http://cicd:9081/repository/maven-releases/...
      '''
    }
  }
}</code></pre>
    <aside class="jenkins-secretos-panel">
      <h3>Seguridad de Credenciales</h3>
      <ul>
        <li><b>Nunca <?php hueco(50, 14); ?> contraseñas</b> en el <code><?php hueco(51, 15); ?></code> ni en scripts de <code><?php hueco(52, 7); ?></code>.</li>
        <li>Jenkins <?php hueco(53, 9); ?> las credenciales en su almacén seguro (<i><?php hueco(54, 21); ?></i>).</li>
        <li><b>Enmascaramiento en logs:</b> Jenkins reemplaza automáticamente cualquier coincidencia de la variable por <code><?php hueco(55, 8); ?></code> en la consola.</li>
        <li><b>Ámbito restringido:</b> las variables de entorno solo existen durante el bloque <code><?php hueco(57, 19); ?></code>.</li>
      </ul>
    </aside>
  </div>
    <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('index.php', 'tercero.php');
