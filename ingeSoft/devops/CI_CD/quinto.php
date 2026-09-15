<?php
/* ==========================================================================
   IngeSoft5 / DevOps / CI_CD — bloque 05: Runners y el pipeline de 4 jobs
   Fuente: Presentacion_GitHub_Actions_CICD.pdf (4-5) + Taller_Evaluativo_CI_CD.pdf
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- que es un self-hosted runner --- */
    1  => ['actions-runner', 'actions runner'],
    2  => ['efimera'],
    3  => ['persistente'],
    4  => ['administrador'],
    5  => ['7'],
    6  => ['minutos'],
    7  => ['long-polling', 'long polling', 'sondeo'],
    8  => ['etiquetas', 'labels'],
    9  => ['huerfano'],

    /* --- seguridad --- */
    10 => ['forks', 'fork'],
    11 => ['privados'],
    12 => ['manual'],
    13 => ['arc', 'actions runner controller'],
    14 => ['kubernetes', 'k8s'],

    /* --- los 4 jobs --- */
    15 => ['test-backend', 'test backend'],
    16 => ['test-frontend', 'test frontend'],
    17 => ['build-docker', 'build docker'],
    18 => ['smoke-test', 'smoke test'],
    19 => ['docker/setup-buildx-action@v3'],
    20 => ['docker/build-push-action@v5'],
    21 => ['product-api:latest'],
    22 => ['product-frontend:latest'],
    23 => ['false'],
    24 => ['always()', 'always'],
    25 => ['200'],
    26 => ['jar', 'backend-jar'],

    /* --- lineas completas --- */
    27 => 'runs-on: [self-hosted, linux, x64, grid102]',
    28 => 'STATUS=$(curl -s -o /dev/null -w "%{http_code}" http://localhost:8080/api/products)',
    29 => 'if [ "$STATUS" -ne 200 ]; then exit 1; fi',
    30 => 'docker compose up -d --build',
];

$TEXTO = [1,2,3,4,6,7,8,9,10,11,12,13,14,15,16,17,18,26];

$MULTIPLE = [
    'm1' => [
        'texto'    => 'La diferencia mas importante entre un runner <b>GitHub-hosted</b> y uno <b>self-hosted</b> a la hora de escribir el workflow es...',
        'opciones' => [
            'a' => 'La sintaxis del YAML, que cambia por completo',
            'b' => 'Que el GitHub-hosted nace con el <b>disco 100% limpio</b> en cada job, mientras el self-hosted es un <b>host persistente</b> donde quedan el workspace y los temporales de la ejecucion anterior',
            'c' => 'Que el self-hosted no soporta <code>uses:</code>',
            'd' => 'Que el self-hosted no puede usar Docker'
        ],
        'correcta' => 'b',
        'porque'   => 'Por eso la diapositiva pone <code>actions/checkout@v4</code> con <code>clean: true</code> en el ejemplo de <code>grid102</code>: hay que <b>limpiar el workspace a mano</b> porque nadie te lo va a destruir. Es la fuente numero uno de bugs de tipo «en el runner funciona pero es porque quedo un archivo de ayer».'
    ],
    'm2' => [
        'texto'    => 'Necesitas desplegar sobre una base de datos que solo es accesible desde la red interna de la universidad. &iquest;Que runner usas y por que?',
        'opciones' => [
            'a' => '<code>ubuntu-latest</code>, abriendo el puerto de la BD a internet',
            'b' => 'Un <b>self-hosted</b> en <code>grid102</code>: tiene acceso nativo a la LAN, a la VPN (ZeroTier) y al socket local de Docker, sin exponer ningun puerto de entrada hacia internet',
            'c' => 'Da igual, ambos ven la red interna',
            'd' => '<code>windows-latest</code>'
        ],
        'correcta' => 'b',
        'porque'   => 'Y el detalle tecnico que lo hace seguro: el agente se conecta <b>hacia afuera</b> por sondeo (long-polling) y pregunta «&iquest;hay trabajo para mi?». Nunca hay que abrir un puerto entrante en el firewall de la universidad. El otro caso tipico es hardware: GPUs, 40 vCPUs, caches masivas en disco local.'
    ],
    'm3' => [
        'texto'    => 'Tienes un repositorio <b>publico</b> con un self-hosted runner en la red de la universidad. &iquest;Cual es el riesgo?',
        'opciones' => [
            'a' => 'Que se consuman los minutos del plan',
            'b' => 'Que cualquiera pueda abrir un PR desde un <b>fork</b> modificando el workflow: ese codigo malicioso se ejecutaria <b>dentro de la red interna</b>, con acceso a las BD y al socket de Docker',
            'c' => 'Que el repositorio se vuelva lento',
            'd' => 'Ninguno, GitHub aisla los forks'
        ],
        'correcta' => 'b',
        'porque'   => 'Es el riesgo mas serio de todo el tema. Mitigaciones: self-hosted <b>solo</b> en repos privados o de confianza, exigir <b>aprobacion manual</b> para ejecuciones de colaboradores externos, y usar runners <b>efimeros contenerizados</b> (ARC sobre Kubernetes) para que cada job nazca y muera en un contenedor limpio.'
    ],
    'm4' => [
        'texto'    => '&iquest;Cual es la diferencia fundamental entre una <b>prueba unitaria</b> del job de build y una <b>prueba de humo</b> tras levantar los contenedores?',
        'opciones' => [
            'a' => 'La unitaria es mas lenta que la de humo',
            'b' => 'La unitaria valida <b>una clase o funcion aislada</b>, con las dependencias simuladas, sobre el codigo fuente; la de humo valida el <b>sistema completo ya desplegado</b> — imagen, red, puertos, configuracion y arranque real — pidiendole una respuesta por HTTP',
            'c' => 'La de humo se ejecuta antes que la unitaria',
            'd' => 'Son lo mismo con distinto nombre'
        ],
        'correcta' => 'b',
        'porque'   => 'Pregunta literal del taller. La clave: las unitarias pueden estar <b>todas en verde</b> y el despliegue estar roto — un <code>nginx.conf</code> mal copiado, un puerto mal mapeado, una variable de entorno ausente, un healthcheck que nunca pasa. Nada de eso lo ve una prueba unitaria, porque nada de eso es codigo Java.'
    ],
    'm5' => [
        'texto'    => 'La prueba de humo valida un <b>codigo HTTP 200</b> con <code>curl</code>. &iquest;Por que eso da mas certeza que comprobar que el contenedor esta corriendo?',
        'opciones' => [
            'a' => 'Porque <code>docker ps</code> no es fiable',
            'b' => 'Porque «contenedor corriendo» solo dice que el <b>proceso no ha muerto</b>: puede estar arrancando, en bucle de reintentos o devolviendo 500. Un 200 demuestra que la cadena <b>completa</b> (puerto, red, aplicacion, ruta del API) responde de verdad',
            'c' => 'Porque curl es mas rapido',
            'd' => 'Porque el 200 verifica tambien la base de datos'
        ],
        'correcta' => 'b',
        'porque'   => 'Spring Boot puede tardar 20 segundos en estar listo con el contenedor "up" desde el segundo uno — por eso el paso <code>sleep 20</code> o, mejor, un healthcheck con reintentos. Validar la <b>respuesta</b> y no el <b>proceso</b> es la diferencia entre un smoke test util y uno decorativo.'
    ],
    'm6' => [
        'texto'    => 'El ultimo step del job <code>smoke-test</code> es <code>docker compose down</code> con <code>if: always()</code>. &iquest;Por que ese <code>if</code>?',
        'opciones' => [
            'a' => 'Para que se ejecute solo si el smoke test paso',
            'b' => 'Para que la limpieza se ejecute <b>tambien cuando el smoke test falla</b>: sin el, un step anterior en rojo aborta el job y los contenedores quedan vivos ocupando puertos y memoria',
            'c' => 'Para repetir el job indefinidamente',
            'd' => 'Es decorativo, no cambia nada'
        ],
        'correcta' => 'b',
        'porque'   => 'Por defecto, en cuanto un step falla GitHub Actions <b>salta el resto</b> de steps del job. <code>if: always()</code> es el equivalente en YAML del <code>trap ... EXIT</code> del Modulo 1: garantizar la limpieza pase lo que pase. En un runner self-hosted, olvidarlo significa contenedores huerfanos que rompen el siguiente build.'
    ],
    'm7' => [
        'texto'    => 'En el job <code>build-docker</code>, <code>docker/build-push-action</code> lleva <code>push: false</code>. &iquest;Que significa?',
        'opciones' => [
            'a' => 'Que no se construye la imagen',
            'b' => 'Que la imagen se <b>construye y se valida localmente</b> en el runner pero <b>no se publica</b> en ningun registro: en el taller solo interesa comprobar que los Dockerfile compilan',
            'c' => 'Que se borra la imagen al terminar',
            'd' => 'Que se usa cache remota'
        ],
        'correcta' => 'b',
        'porque'   => 'En un pipeline real ese seria justo el punto donde pasas a <code>push: true</code> con credenciales de registro (GHCR, Docker Hub) y tags versionados con SemVer. Ojo: por el aislamiento entre jobs, una imagen construida con <code>push: false</code> <b>no existe</b> en el job siguiente — por eso <code>smoke-test</code> vuelve a construir con <code>--build</code>.'
    ],
    'm8' => [
        'texto'    => 'Mirando el pipeline completo del taller, &iquest;cual es el orden y la dependencia correcta de los 4 jobs?',
        'opciones' => [
            'a' => 'Los cuatro en paralelo, sin <code>needs:</code>',
            'b' => '<code>test-backend</code> y <code>test-frontend</code> <b>en paralelo</b>; <code>build-docker</code> con <code>needs:</code> a los dos; <code>smoke-test</code> con <code>needs: [build-docker]</code>',
            'c' => 'Los cuatro en secuencia estricta, uno detras de otro',
            'd' => '<code>smoke-test</code> primero, para descartar problemas de entorno'
        ],
        'correcta' => 'b',
        'porque'   => 'Es el diagrama de la presentacion. Fijate en la forma: <b>abanico que se abre y se cierra</b>. Se paraleliza lo que es independiente (ganas tiempo) y se serializa lo que tiene dependencia real de datos o de orden logico. La rubrica penaliza explicitamente «jobs secuenciales innecesarios».'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('CI/CD · 5 — Runners y el pipeline de 4 jobs', 'Presentacion GitHub Actions (4-5) + Taller Evaluativo CI/CD');
?>

<div class="card">
  <h2>1. Que es un self-hosted runner</h2>

  <ul>
    <li><b>Agente dedicado:</b> el software de GitHub (<code><?php hueco(1, 18); ?></code>)
        instalado en un servidor propio, p. ej. el cluster IasLab <code>grid102</code>.</li>
    <li><b>Acceso a red privada:</b> se conecta directamente a bases de datos internas, LAN
        o VPN ZeroTier <b>sin abrir puertos de entrada</b> a internet.</li>
    <li><b>Seguridad de red:</b> conexion por sondeo seguro
        (<?php hueco(7, 16); ?>) hacia afuera.</li>
    <li><b>Cero costo de minutos:</b> ejecuciones ilimitadas sin consumir el plan de GitHub.</li>
  </ul>

  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Matriz comparativa</h2>

  <table class="datos">
    <tr><th>Dimension</th><th>GitHub-Hosted</th><th>Self-Hosted</th></tr>
    <tr><td><b>Entorno y ciclo</b></td>
        <td>VM <?php hueco(2, 12); ?> (se destruye tras cada job). Disco 100% limpio.</td>
        <td>Host <?php hueco(3, 14); ?>. El workspace y los temporales permanecen.</td></tr>
    <tr><td><b>Acceso a red / LAN</b></td>
        <td>solo acceso publico en internet; requiere VPN o tuneles</td>
        <td>acceso nativo a LAN, VPN y servicios internos (grid100, BDs)</td></tr>
    <tr><td><b>Mantenimiento</b></td>
        <td>GitHub actualiza SO, parches y herramientas</td>
        <td>el <?php hueco(4, 16); ?> mantiene SO, daemon de Docker y parches</td></tr>
    <tr><td><b>Computo</b></td>
        <td>estandar: 2 vCPU, <?php hueco(5, 5); ?> GB RAM</td>
        <td>personalizado (40 vCPUs, 64 GB RAM, GPUs NVIDIA)</td></tr>
    <tr><td><b>Costos</b></td>
        <td>facturacion por <?php hueco(6, 12); ?> consumidos segun el plan</td>
        <td>gratuito en minutos (solo cuesta el hardware propio)</td></tr>
  </table>

  <h3>Escribelo de memoria</h3>
  <?php linea(27, 'La linea <code>runs-on</code> que enruta el job al servidor propio <code>grid102</code>, usando las cuatro etiquetas del ejemplo.', 'runs-on: [...]'); ?>
  <?php ayuda('En orden: <code>self-hosted</code>, <code>linux</code>, <code>x64</code>, <code>grid102</code>.'); ?>

  <p>Para enrutar un job a un servidor propio se modifica <code>runs-on</code> usando
     <?php hueco(8, 14); ?>. Y por la persistencia del disco conviene añadir
     <code>clean: true</code> al <code>checkout</code>, para que no sobreviva un proceso
     zombie o un contenedor <?php hueco(9, 14); ?> de la ejecucion anterior.</p>

  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Seguridad en self-hosted</h2>

  <table class="datos">
    <tr><th>Riesgo en repositorios publicos</th><th>Mejores practicas</th></tr>
    <tr>
      <td>Un tercero podria enviar un PR desde un <?php hueco(10, 10); ?>
          con un script malicioso en el workflow, que se ejecutaria en el servidor
          interno con acceso a la red de la organizacion.</td>
      <td>Usar self-hosted <b>unicamente</b> en repositorios
          <?php hueco(11, 12); ?> o de confianza interna.</td>
    </tr>
    <tr>
      <td>Persistencia de procesos: un proceso zombie o un contenedor huerfano puede
          interferir con jobs futuros.</td>
      <td>Requerir aprobacion <?php hueco(12, 10); ?> para ejecuciones de
          colaboradores externos, y usar runners efimeros contenerizados
          (<?php hueco(13, 8); ?>, Actions Runner Controller, sobre
          <?php hueco(14, 14); ?>).</td>
    </tr>
  </table>

  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Los 4 jobs del taller evaluativo</h2>

  <table class="datos">
    <tr><th>#</th><th>Job</th><th>Que hace</th></tr>
    <tr><td class="idx">1</td><td><?php hueco(15, 16); ?></td>
        <td>Setup JDK 17 Temurin, <code>mvn test</code> y subida del artefacto
            <?php hueco(26, 12); ?> con <code>upload-artifact</code></td></tr>
    <tr><td class="idx">2</td><td><?php hueco(16, 16); ?></td>
        <td>Setup Node 20, <code>npm run lint</code> y compilacion del bundle con Vite</td></tr>
    <tr><td class="idx">3</td><td><?php hueco(17, 16); ?></td>
        <td>Construccion de las imagenes con Buildx y tags versionados</td></tr>
    <tr><td class="idx">4</td><td><?php hueco(18, 16); ?></td>
        <td>Despliegue con <code>docker compose up -d</code> y validacion con
            <code>curl</code></td></tr>
  </table>

  <div class="avisoflujo">
    <b>La forma del pipeline.</b> Jobs 1 y 2 <b>en paralelo</b> &rarr; job 3 con
    <code>needs: [test-backend, test-frontend]</code> &rarr; job 4 con
    <code>needs: [build-docker]</code>. Abanico que se abre y se cierra.
  </div>

  <h3>Las acciones de Docker</h3>
  <table class="datos">
    <tr><th>Para que</th><th>Accion</th></tr>
    <tr><td>Preparar el motor de construccion</td><td><?php hueco(19, 32); ?></td></tr>
    <tr><td>Construir la imagen</td><td><?php hueco(20, 32); ?></td></tr>
  </table>

  <table class="datos">
    <tr><th>Parametro</th><th>Valor en el taller</th></tr>
    <tr><td><code>tags</code> del backend</td><td><?php hueco(21, 24); ?></td></tr>
    <tr><td><code>tags</code> del frontend</td><td><?php hueco(22, 26); ?></td></tr>
    <tr><td><code>push</code></td><td><?php hueco(23, 10); ?></td></tr>
  </table>

  <?php mc('m7'); ?>
  <?php mc('m8'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. El job de smoke test, linea a linea</h2>

  <?php linea(30, 'Primero: levantar todo el stack en segundo plano <b>reconstruyendo</b> las imagenes.', 'docker compose ...'); ?>

  <?php linea(28, 'Guarda en la variable <code>STATUS</code> <b>solo el codigo HTTP</b> que devuelve <code>http://localhost:8080/api/products</code>: silencioso, tirando el cuerpo a <code>/dev/null</code>.', 'STATUS=$(curl ...)'); ?>
  <?php ayuda('<code>-s</code> silencioso, <code>-o /dev/null</code> descarta el cuerpo, <code>-w "%{http_code}"</code> imprime solo el codigo. Todo dentro de <code>$( )</code>.'); ?>

  <?php linea(29, 'Si el codigo <b>no</b> es 200, aborta el job. Una sola linea con <code>if ... ; then ... ; fi</code> y el comparador numerico.', 'if [ ... ]; then exit 1; fi'); ?>
  <?php ayuda('El comparador «distinto de» para numeros en bash es <code>-ne</code>. La variable hay que entrecomillarla: <code>"$STATUS"</code>.'); ?>

  <p>Y el ultimo step, <code>docker compose down</code>, lleva la condicion
     <code>if: <?php hueco(24, 12); ?></code> para que la limpieza ocurra
     aunque el smoke test haya fallado. El codigo que se considera exito es el
     <?php hueco(25, 6); ?>.</p>

  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('cuarto.php', '../Menu.php');
