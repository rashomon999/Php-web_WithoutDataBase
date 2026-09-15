<?php
/* ==========================================================================
   IngeSoft5 / DevOps / Parcial — bloque 02: preguntas 10 a 18
   Fuente: parcial-devops-simulador.html
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- P10: shift-left en el pipeline --- */
    1  => ['unitarias'],
    2  => ['estatico'],
    3  => ['seguridad'],
    4  => ['commit'],
    5  => ['pull request', 'pull'],
    6  => ['baratos'],
    7  => ['produccion'],

    /* --- P13: resiliencia --- */
    8  => ['inevitables'],
    9  => ['los fallos en sistemas distribuidos son inevitables'],
    10 => ['degradarse', 'degradar'],
    11 => ['experiencia'],
    12 => ['mttr'],
    13 => ['frecuencia'],

    /* --- P15: comando docker --- */
    14 => 'docker run -p 80:80 nginx',

    /* --- P16: MTTR --- */
    15 => ['mean time to recovery', 'tiempo medio de recuperacion'],
    16 => ['recuperarse'],
    17 => ['deteccion'],
    18 => ['rollback'],
    19 => ['bajo'],
    20 => ['aprender'],

    /* --- P17: describir el comando --- */
    21 => ['-it', 'it'],
    22 => ['-p', 'p'],
    23 => ['-v', 'v'],
    24 => ['monta el volumen data en la ruta /media dentro del contenedor'],
    25 => ['/media', 'media'],
    26 => ['--rm', 'rm'],
    27 => ['debian'],


    28 => ['las preocupaciones de operaciones se mueven mas temprano en el ciclo de vida de entrega de software'],
    29 => ['hacia el desarrollo'],
    30 => ['En un pipeline de CI/CD'],
    31 => ['esto se traduce en mover las validaciones de calidad'],
    32 => ['mapea el puerto 80 del host al puerto 80 del contenedor'],
    33 => ['elimina automaticamente el contenedor una vez finalice su ejecucion'],
    34 => ['lo ejecuta de forma interactiva'],

];

$TEXTO = [1,2,3,4,5,6,7,8,9,10,11,12,13,15,16,17,18,19,20,24,27];

$MULTIPLE = [
    'p11' => [
        'texto'    => '<b>P11 (1 pt).</b> About a <b>monolith</b> architecture, it is valid to say:',
        'opciones' => [
            'a' => 'They are easy to execute/deploy compared with microservices',
            'b' => 'They are easy to scale compared with microservices',
            'c' => 'They can be decoupled when deployed',
            'd' => 'They are easy to maintain compared with microservices'
        ],
        'correcta' => 'a',
        'porque'   => 'Es la unica ventaja real que le queda al monolito: <b>un solo artefacto, un solo despliegue</b> — nada de orquestar diez servicios, redes y contratos entre ellos. Las otras tres son justamente sus <b>debilidades</b>: escala mal (hay que replicar <i>todo</i> aunque el cuello de botella sea un modulo), es dificil de mantener cuando crece, y por definicion <b>no</b> se puede desacoplar al desplegarlo: es una sola unidad.'
    ],
    'p12' => [
        'texto'    => '<b>P12 (1 pt).</b> When is it better to use <b>Containers</b> instead of VMs to deploy applications?',
        'opciones' => [
            'a' => 'Multiple Operative Systems are needed',
            'b' => 'Strong isolation required',
            'c' => 'Legacy apps are running',
            'd' => 'Efficient sharing is needed'
        ],
        'correcta' => 'd',
        'porque'   => 'El contenedor gana cuando quieres <b>compartir eficientemente</b> el mismo kernel y las mismas capas base entre muchos servicios: alta densidad, arranque en milisegundos, megabytes en vez de gigabytes. Las otras tres son exactamente los casos donde <b>gana la VM</b>: varios sistemas operativos distintos (el contenedor comparte el kernel del host), aislamiento fuerte (la VM tiene hipervisor de por medio) y apps legadas (<i>lift-and-shift</i>).'
    ],
    'p14' => [
        'texto'    => '<b>P14 (1 pt).</b> Which is a responsibility of a <b>Reliability engineer</b> in a DevOps team?',
        'opciones' => [
            'a' => 'Ensure people are trained on DevOps practices and tools',
            'b' => 'Integrate security checks into pipelines',
            'c' => 'Work with DevOps to gate deployments on quality',
            'd' => 'Coordinate releases with dev and ops',
            'e' => 'Performance tuning in production'
        ],
        'correcta' => 'e',
        'porque'   => 'La palabra clave es <b>production</b>: el ingeniero de fiabilidad responde por como se comporta el sistema <b>ya corriendo</b> — rendimiento, disponibilidad, MTTR. Cada distractor es el rol de <b>otra</b> persona del equipo: formacion &rarr; el evangelista/coach, seguridad en el pipeline &rarr; el ingeniero de seguridad (DevSecOps), poner puertas de calidad &rarr; QA, coordinar releases &rarr; el release manager.'
    ],
    'p18' => [
        'texto'    => '<b>P18 (1 pt).</b> In bash, the conditional expression <code>[[ -f $PARAM ]]</code> is used to:',
        'opciones' => [
            'a' => 'Validate if <code>$PARAM</code> exists',
            'b' => 'Validate if <code>$PARAM</code> is an integer value',
            'c' => 'Validate if <code>$PARAM</code> is a directory that exists',
            'd' => '<b>Validate if <code>$PARAM</code> is a file that exists</b>'
        ],
        'correcta' => 'd',
        'porque'   => '<code>-f</code> comprueba <b>archivo regular que existe</b> — las dos cosas a la vez. Memoriza la familia entera, porque los distractores son literalmente los otros operadores: <code>-e</code> = existe (sea lo que sea), <code>-d</code> = es un <b>d</b>irectorio que existe, <code>-z</code> = la cadena esta vacia, <code>-n</code> = no esta vacia. Es el mismo <code>[[ -f config.env ]] || { echo "falta"; exit 1; }</code> de la validacion preventiva.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Parcial DevOps · 2 — preguntas 10 a 18', 'parcial-devops-simulador.html — respuestas modelo');
?>

<style>
details.modelo{margin:14px 0 4px;background:#eef4ff;border-left:4px solid #2c5aa0;
               border-radius:0 8px 8px 0;padding:10px 14px;font-size:14.5px}
details.modelo summary{cursor:pointer;font-weight:700;color:#2c5aa0;list-style:none}
details.modelo summary::-webkit-details-marker{display:none}
details.modelo summary:before{content:'\25B8 ';font-size:13px}
details.modelo[open] summary:before{content:'\25BE '}
details.modelo p{margin:10px 0 2px;color:#22262b;line-height:1.7}
.pregunta-parcial{font-size:13px;color:#7a8494;font-weight:700;letter-spacing:.5px;
                  text-transform:uppercase;margin:0 0 2px}
</style>

<div class="card">
  <p class="pregunta-parcial">Pregunta 10 &middot; 2 puntos &middot; abierta</p>
  <h2>How can <b>Shift-left</b> be implemented in a CI/CD pipeline?</h2>

  <p>
  Shift-left consiste en que "
  <?php hueco(28, 101); ?>
   , 
  <?php hueco(29, 21); ?>
   ." <?php hueco(30, 26); ?> , 
   
   <?php hueco(31, 52); ?>
     a las primeras etapas del proceso, mediante continuous testing: realizar 
  pruebas desde etapas más tempranas y de forma continua a lo largo de todo el ciclo de vida.
  </p>
  <p>Concretamente, esto implica:</p>
  <ul>
    <li>Pruebas <?php hueco(1, 12); ?>, analisis
        <?php hueco(2, 12); ?> de codigo, escaneo de
        <?php hueco(3, 12); ?> y pruebas de integracion.</li>
    <li>Ejecutandolas <b>automaticamente</b> en cada <?php hueco(4, 10); ?> o
        <?php hueco(5, 14); ?>, <b>antes</b> de que el codigo avance hacia build o
        despliegue.</li>
    <li>Asi los errores se detectan y corrigen cuando son mas
        <?php hueco(6, 10); ?> de resolver, en lugar de descubrirlos en
        <?php hueco(7, 12); ?>.</li>
  </ul>

  <details class="modelo">
    <summary>Ver la respuesta modelo completa</summary>
    <p>Shift-left se implementa moviendo las validaciones de calidad (pruebas unitarias, analisis
       estatico, escaneo de seguridad, pruebas de integracion) a las primeras etapas del pipeline,
       ejecutandolas automaticamente en cada commit o pull request, antes de que el codigo avance
       hacia build o despliegue. Asi los errores se detectan y corrigen cuando son mas baratos de
       resolver, en lugar de descubrirlos en produccion.</p>
  </details>

  <?php enviar(); ?>
</div>


<div class="card">
  <p class="pregunta-parcial">Pregunta 11 &middot; 1 punto &middot; opcion unica</p>
  <?php mc('p11'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <p class="pregunta-parcial">Pregunta 12 &middot; 1 punto &middot; opcion unica</p>
  <?php mc('p12'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <p class="pregunta-parcial">Pregunta 13 &middot; 2 puntos &middot; abierta</p>
  <h2>Why is it important for an application to be <b>resilient</b> or fault-resistant?</h2>

  <ul>
    <li>Porque   <?php hueco(9, 53); ?>  
        : caida de un servicio, latencia de red, error de un
        tercero.</li>
    <li>Una aplicacion resiliente puede <b>seguir operando</b> o
        <?php hueco(10, 14); ?> de forma <b>controlada</b> ante esos fallos, en lugar
        de caer por completo.</li>
    <li>Eso protege la <?php hueco(11, 14); ?> del usuario, reduce el tiempo de
        inactividad (<?php hueco(12, 8); ?>) y da confianza para desplegar cambios con
        mayor <?php hueco(13, 12); ?>.</li>
  </ul>

  <details class="modelo">
    <summary>Ver la respuesta modelo completa</summary>
    <p>Porque los fallos en sistemas distribuidos son inevitables (caida de un servicio, latencia
       de red, error de un tercero). Una aplicacion resiliente puede seguir operando o degradarse
       de forma controlada ante esos fallos, en lugar de caer por completo, lo cual protege la
       experiencia del usuario, reduce el tiempo de inactividad (MTTR) y da confianza para
       desplegar cambios con mayor frecuencia.</p>
  </details>

  <?php enviar(); ?>
</div>


<div class="card">
  <p class="pregunta-parcial">Pregunta 14 &middot; 1 punto &middot; opcion unica</p>
  <?php mc('p14'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <p class="pregunta-parcial">Pregunta 15 &middot; 1 punto &middot; abierta (codigo)</p>
  <h2>Type the docker command to run an <b>nginx</b> container mapping port 80 of the
     container to port 80 of the host machine.</h2>

  <?php linea(14, 'El comando completo, tal cual lo escribirias en la consola.', ' '); ?>

  <div class="nota"><b>No lo compliques.</b> Es exactamente <code>docker run -p 80:80 nginx</code>
    — y recuerda el orden: <code>-p <b>puerto_host</b>:<b>puerto_contenedor</b></code>, de fuera
    hacia dentro. Aqui coinciden, pero en la pregunta 6 no.</div>

  <details class="modelo">
    <summary>Ver la respuesta modelo completa</summary>
    <p><code>docker run -p 80:80 nginx</code></p>
  </details>

  <?php enviar(); ?>
</div>


<div class="card">
  <p class="pregunta-parcial">Pregunta 16 &middot; 2 puntos &middot; abierta</p>
  <h2>How can you use the <b>MTTR</b> to improve a system in operation?</h2>

  <ul>
    <li>El MTTR (<?php hueco(15, 26); ?>) mide cuanto tarda un sistema en
        <?php hueco(16, 14); ?> tras una falla.</li>
    <li>Monitoreandolo se identifican <b>cuellos de botella</b> en la
        <?php hueco(17, 12); ?> y en la respuesta a incidentes.</li>
    <li>Permite priorizar la automatizacion de <?php hueco(18, 12); ?> y alertas.</li>
    <li>Y valida si las mejoras de resiliencia <b>reducen de verdad</b> el tiempo de
        recuperacion.</li>
    <li>Un MTTR <?php hueco(19, 8); ?> indica que el equipo puede
        <?php hueco(20, 12); ?> del fallo, aplicar una solucion y evitar que el mismo
        error vuelva a ocurrir.</li>
  </ul>

  <details class="modelo">
    <summary>Ver la respuesta modelo completa</summary>
    <p>El MTTR (Mean Time To Recovery) mide cuanto tarda un sistema en recuperarse tras una falla.
       Monitoreandolo constantemente se pueden identificar cuellos de botella en la deteccion y
       respuesta a incidentes, priorizar automatizacion de rollback/alertas, y validar si las
       mejoras de resiliencia reducen realmente el tiempo de recuperacion. Un MTTR bajo indica que
       el equipo puede aprender del fallo, aplicar una solucion y evitar que el mismo error vuelva
       a ocurrir.</p>
  </details>

  <?php enviar(); ?>
</div>


<div class="card">
  <p class="pregunta-parcial">Pregunta 17 &middot; 1 punto &middot; abierta (codigo)</p>
  <h2>Describe what the following docker command does</h2>
  <pre><code>docker run -p 80:80 -v data:/media --rm -it debian</code></pre>

  <p>Ejecuta un contenedor a partir de la imagen <?php hueco(27, 10); ?>, y cada
     bandera hace lo suyo:</p>

  <table class="datos">
    <tr><th>Bandera</th><th>Que hace</th></tr>
    <tr><td><code><?php hueco(21, 6); ?></code></td>
        <td><?php hueco(34, 32); ?> , con terminal adjunta. conectando directamente 
        la terminal de tu computadora con la terminal interna del contenedor.</td></tr>
    <tr><td><code><?php hueco(22, 6); ?> 80:80</code></td>
        <td><?php hueco(32, 55); ?> </td></tr>
    <tr><td><code><?php hueco(23, 6); ?> data:/media</code></td>
        <td>  <code><?php hueco(24, 61); ?></code>  
             </td></tr>
    <tr><td><code><?php hueco(26, 8); ?></code></td>
        <td>
        <?php hueco(33, 66); ?>  
         </td></tr>
  </table>

  <details class="modelo">
    <summary>Ver la respuesta modelo completa</summary>
    <p>Ejecuta un contenedor a partir de la imagen <code>debian</code> de forma interactiva
       (<code>-it</code>), mapeando el puerto 80 del host al puerto 80 del contenedor
       (<code>-p 80:80</code>), montando el volumen <code>data</code> en la ruta
       <code>/media</code> dentro del contenedor (<code>-v data:/media</code>), y eliminando
       automaticamente el contenedor una vez finalice su ejecucion (<code>--rm</code>).</p>
  </details>

  <?php enviar(); ?>
</div>


<div class="card">
  <p class="pregunta-parcial">Pregunta 18 &middot; 1 punto &middot; opcion unica</p>
  <?php mc('p18'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('index.php', '../Menu.php');
