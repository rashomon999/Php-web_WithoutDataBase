<?php
/* ==========================================================================
   IngeSoft5 / DevOps / CI_CD — bloque 01: Scripts de automatizacion defensivos
   Fuente: CI_CD.pdf — Seccion 01 (Modulo 1)
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- las cuatro opciones defensivas --- */
    1  => ['-e', 'e'],
    2  => ['-u', 'u'],
    3  => ['pipefail'],
    4  => ['trap'],
    5  => ['on_exit', 'on exit'],

    /* --- parametros y variables --- */
    6  => ['posicionales'],
    7  => ['dev'],
    8  => ['env', '.env'],
    9  => ['defecto', 'por defecto'],

    /* --- verificaciones previas --- */
    10 => ['command -v', 'command v', 'v'],
    11 => ['puertos'],
    12 => ['permisos'],
    13 => ['espacio'],

    /* --- codigos de salida --- */
    14 => ['0'],
    15 => ['255'],
    16 => ['constantes'],
    17 => ['depuracion'],

    /* --- formato de mensajes --- */
    18 => ['stderr'],
    19 => ['informativos'],
    20 => ['tiempo', 'marcas de tiempo'],
    21 => ['warn'],
    22 => ['agregacion'],

    /* --- la frase de cierre --- */
    23 => ['humano', 'error humano'],
    24 => ['deterministicas', 'deterministas'],

    /* --- lineas completas --- */
    25 => "set -euo pipefail",
    26 => "trap 'rm -f \"\$TMPFILE\"' EXIT",
    27 => 'if [ -z "$1" ]; then echo "falta el parametro" >&2; exit 1; fi',
    28 => 'APP_ENV=${APP_ENV:-dev}',
    29 => 'command -v docker >/dev/null 2>&1 || { echo "docker no esta instalado" >&2; exit 1; }',
];

/* huecos que son texto normal (no importan mayusculas ni tildes) */
$TEXTO = [3,4,5,6,7,8,9,11,12,13,16,17,18,19,20,21,22,23,24];

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Tu script hace <code>cd /app/build</code> y la carpeta <b>no existe</b>. La linea siguiente es <code>rm -rf *</code>. &iquest;Que pasa si <b>no</b> tienes <code>set -e</code>?',
        'opciones' => [
            'a' => 'Nada, el script se detiene solo al fallar el <code>cd</code>',
            'b' => 'El <code>cd</code> falla pero el script <b>continua</b>, y el <code>rm -rf *</code> se ejecuta en el directorio donde estabas — borrando lo que no debias',
            'c' => 'Bash reintenta el <code>cd</code> tres veces',
            'd' => 'Se lanza una excepcion capturable'
        ],
        'correcta' => 'b',
        'porque'   => 'Este es <b>el</b> ejemplo clasico de por que existe <code>set -e</code>. Bash por defecto ignora el codigo de salida de cada comando y sigue con el siguiente. El PDF lo llama <b>fallo silencioso</b>: el script "termina bien" (exit 0) habiendo hecho un destrozo.'
    ],
    'm2' => [
        'texto'    => 'Tienes <code>rm -rf "$BUILD_DIR/"</code> y por un typo la variable se llama en realidad <code>BUILDDIR</code>. &iquest;Que opcion te salva?',
        'opciones' => [
            'a' => '<code>set -e</code>, porque <code>rm</code> devuelve error',
            'b' => '<code>set -u</code>: al expandir una variable <b>no inicializada</b> el script aborta, en vez de convertir <code>"$BUILD_DIR/"</code> en <code>"/"</code>',
            'c' => '<code>set -o pipefail</code>',
            'd' => 'Ninguna, es imposible de detectar'
        ],
        'correcta' => 'b',
        'porque'   => 'Sin <code>set -u</code> una variable vacia se expande a la cadena vacia y <code>"$BUILD_DIR/"</code> se convierte literalmente en <code>"/"</code>. <code>set -e</code> no te salva porque el <code>rm</code> <b>tiene exito</b> — borrar la raiz no es un error para el shell.'
    ],
    'm3' => [
        'texto'    => 'Ejecutas <code>cat informe.log | grep ERROR</code> y el archivo <b>no existe</b>. Sin <code>pipefail</code>, &iquest;cual es el codigo de salida de la tuberia?',
        'opciones' => [
            'a' => 'El del <code>cat</code> (fallo)',
            'b' => 'El del <b>ultimo</b> comando de la tuberia (<code>grep</code>), asi que el error del <code>cat</code> se pierde',
            'c' => 'Siempre 1',
            'd' => 'El mayor de los dos'
        ],
        'correcta' => 'b',
        'porque'   => 'Por defecto una tuberia devuelve el estado del <b>ultimo</b> comando. <code>set -o pipefail</code> cambia eso: devuelve el del primero que falle. Sin el, <code>set -e</code> tampoco te protege dentro de una tuberia — por eso el estandar es <b>los tres juntos</b>.'
    ],
    'm4' => [
        'texto'    => 'Tu script descomprime un artefacto en <code>/tmp/build.XXXX</code> y a mitad de camino falla una prueba. &iquest;Como garantizas que ese temporal se borra igual?',
        'opciones' => [
            'a' => 'Poniendo el <code>rm</code> en la ultima linea del script',
            'b' => 'Con <code>trap</code> sobre la señal <code>EXIT</code>: la limpieza se ejecuta <b>salga como salga</b> el script, incluso al abortar por <code>set -e</code>',
            'c' => 'Con <code>set -u</code>',
            'd' => 'Reiniciando el runner'
        ],
        'correcta' => 'b',
        'porque'   => 'El <code>rm</code> en la ultima linea <b>nunca se alcanza</b> si el script aborta antes. <code>trap ... EXIT</code> registra la limpieza como un manejador que bash ejecuta al terminar el proceso, exitoso o no. En un runner de CI que reutiliza disco (self-hosted), esto evita basura acumulada entre ejecuciones.'
    ],
    'm5' => [
        'texto'    => '&iquest;Que hace exactamente <code>${APP_ENV:-dev}</code>?',
        'opciones' => [
            'a' => 'Asigna permanentemente <code>dev</code> a <code>APP_ENV</code>',
            'b' => 'Usa el valor de <code>APP_ENV</code> si esta definida y no vacia; si no, <b>usa <code>dev</code> como valor por defecto</b> sin modificar la variable',
            'c' => 'Borra la variable <code>APP_ENV</code>',
            'd' => 'Compara <code>APP_ENV</code> con la cadena <code>dev</code>'
        ],
        'correcta' => 'b',
        'porque'   => 'Es el patron para que el mismo script funcione en local y en el pipeline: en tu maquina no defines nada y corre en <code>dev</code>; en Actions inyectas <code>APP_ENV=prod</code> y el script lo respeta. Ojo: <code>:-</code> <b>no</b> asigna; si quieres asignar de verdad es <code>${APP_ENV:=dev}</code>.'
    ],
    'm6' => [
        'texto'    => 'Antes de lanzar <code>docker compose up</code>, tu script comprueba <code>command -v docker</code>. &iquest;Por que eso es mejor que dejar que falle solo?',
        'opciones' => [
            'a' => 'Porque <code>command -v</code> instala docker si falta',
            'b' => 'Porque asi el script falla <b>temprano y con un mensaje claro</b> ("docker no esta instalado") en vez de reventar a mitad del despliegue con un error cripcico del sistema',
            'c' => 'Porque es mas rapido',
            'd' => 'Porque docker lo exige'
        ],
        'correcta' => 'b',
        'porque'   => 'Es el mismo principio de <b>shift-left</b> aplicado al script: validar las precondiciones (herramientas, puertos, permisos, espacio en disco) <b>antes</b> de empezar a modificar nada. Un fallo en la linea 3 es barato; uno en la linea 300, con medio despliegue hecho, no.'
    ],
    'm7' => [
        'texto'    => '&iquest;Por que los mensajes de error deben ir a <b>stderr</b> y no a stdout?',
        'opciones' => [
            'a' => 'Porque stderr es mas rapido',
            'b' => 'Porque asi la <b>salida util</b> del script (stdout) se puede canalizar o capturar limpia, mientras los errores siguen siendo visibles y separables por los agregadores de logs',
            'c' => 'Porque stdout no admite acentos',
            'd' => 'Es indiferente, es solo estilo'
        ],
        'correcta' => 'b',
        'porque'   => 'Si haces <code>VERSION=$(mi_script.sh)</code> y el script mezcla avisos en stdout, la variable se contamina. Ademas GitHub Actions y los agregadores (ELK, Loki) distinguen ambos flujos: mezclarlos te deja sin poder filtrar solo los errores.'
    ],
    'm8' => [
        'texto'    => 'El PDF insiste en usar <b>codigos de salida distintos</b> (1, 2, 3...) en vez de siempre <code>exit 1</code>. &iquest;Para que sirve eso en un pipeline?',
        'opciones' => [
            'a' => 'Para nada, GitHub Actions solo mira si es 0 o distinto de 0',
            'b' => 'Para <b>depurar</b>: el codigo identifica <i>que</i> fallo (2 = falta una herramienta, 3 = puerto ocupado, 4 = sin espacio) sin tener que leerse todo el log, y permite que el job que llama reaccione distinto segun el caso',
            'c' => 'Para cumplir con POSIX',
            'd' => 'Para que el script sea mas corto'
        ],
        'correcta' => 'b',
        'porque'   => 'Actions efectivamente solo distingue 0 / no-0 para marcar el job en rojo, pero <b>tu</b> si puedes leer el codigo en el log o en un paso posterior. Por eso el PDF pide <b>constantes con nombres descriptivos</b> (<code>readonly ERR_NO_DOCKER=2</code>) en vez de numeros magicos esparcidos por el script.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('CI/CD · 1 — Scripts de automatizacion defensivos', 'CI_CD.pdf — Modulo 1: ejecucion defensiva, validacion y trazabilidad');
?>

<div class="card">
  <h2>Como se usa</h2>
  <p>Cinco bloques, uno por modulo del PDF <b>CI_CD.pdf</b> (mas un quinto de runners y del taller
     evaluativo). Este es el <b>Modulo 1: Scripts de Automatizacion</b>.</p>
  <div class="nota">Respuestas en <b>texto</b>: no importan mayusculas ni tildes.
    Pulsa <b>Enter</b> dentro de un hueco para verificar. Las lineas de codigo si respetan
    la forma exacta (te avisa en naranja si solo fallaste mayusculas).
    Las preguntas de opcion multiple llevan explicacion — leelas aunque aciertes.</div>
</div>


<div class="card">
  <h2>1. Shell scripting defensivo: las cuatro opciones</h2>
  <p>Un script de despliegue no es un script de tu portatil. Corre <b>sin nadie mirando</b>,
     dentro de un runner, y lo que haga mal lo hara en produccion.</p>

  <table class="datos">
    <tr><th>Opcion</th><th>Que hace</th></tr>
    <tr><td><code>set <?php hueco(1, 6); ?></code></td>
        <td>detiene el script ante el <b>primer</b> comando con codigo de salida no cero</td></tr>
    <tr><td><code>set <?php hueco(2, 6); ?></code></td>
        <td>lanza error si se intenta expandir una <b>variable no inicializada</b></td></tr>
    <tr><td><code>set -o <?php hueco(3, 12); ?></code></td>
        <td>propaga codigos de error dentro de <b>tuberias</b> (<code>cmd1 | cmd2</code>)</td></tr>
    <tr><td><code><?php hueco(4, 8); ?>   <?php hueco(5, 8); ?></code></td>
        <td>limpieza automatica de archivos temporales al terminar, salga como salga</td></tr>
  </table>

  <div class="avisoflujo">
    <b>Principio de robustez.</b> En servidores y pipelines automatizados, un script
    <b>jamas</b> debe continuar ejecutandose ante fallos silenciosos.
  </div>

  <h3>Escribelo de memoria</h3>
  <?php linea(25, 'La linea que activa las <b>tres</b> opciones de golpe — el estandar de la industria, la primera linea util de cualquier script de pipeline.', 'set -...'); ?>
  <?php ayuda('Las tres banderas cortas se pegan detras de un solo guion, y <code>pipefail</code> necesita su <code>-o</code> delante.'); ?>

 
  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php mc('m3'); ?>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Validacion de argumentos y entorno</h2>

  <table class="datos">
    <tr><th>Parametros y variables</th><th>Verificaciones previas</th></tr>
    <tr>
      <td>Validacion de argumentos <?php hueco(6, 16); ?>
          obligatorios (<code>$1</code>, <code>$2</code>).</td>
      <td>Verificacion de <b>herramientas instaladas</b> con
          <code><?php hueco(10, 12); ?></code>.</td>
    </tr>
    <tr>
      <td>Asignacion de valores por <?php hueco(9, 12); ?>:
          <code>${APP_ENV:-<?php hueco(7, 8); ?>}</code>.</td>
      <td>Comprobacion de disponibilidad de <?php hueco(11, 12); ?>
          y bases de datos.</td>
    </tr>
    <tr>
      <td>Carga segura de variables de entorno desde archivos
          <code>.<?php hueco(8, 8); ?></code>.</td>
      <td>Validacion de <?php hueco(12, 12); ?> y
          <?php hueco(13, 12); ?> en disco disponible.</td>
    </tr>
  </table>

  <h3>Escribelo de memoria</h3>
  <?php linea(27, 'Si <b>no</b> te pasaron el primer argumento, avisa por <b>stderr</b> y sal con codigo 1. Todo en una linea, con <code>if ... ; then ... ; fi</code>.', 'if [ -z "$1" ]; then ... fi'); ?>
  <?php ayuda('<code>-z</code> comprueba "cadena vacia". Para mandar a stderr se añade <code>&gt;&amp;2</code> detras del <code>echo</code>. El mensaje: <code>"falta el parametro"</code>.'); ?>

  <?php linea(28, 'Asigna a <code>APP_ENV</code> su propio valor si existe, o <code>dev</code> si no.', 'APP_ENV=...'); ?>

  <?php linea(29, 'Aborta con codigo 1 si <code>docker</code> no esta instalado, usando <code>command -v</code> y silenciando su salida.', 'command -v docker ...'); ?>
  <?php ayuda('Patron: <code>command -v X &gt;/dev/null 2&gt;&amp;1 || { echo "..." &gt;&amp;2; exit 1; }</code>. El mensaje: <code>"docker no esta instalado"</code>.'); ?>

  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Trazabilidad y manejo de errores</h2>

  <h3>Codigos de salida</h3>
  <ul>
    <li><code>exit <?php hueco(14, 5); ?></code>: ejecucion exitosa y condiciones cumplidas.</li>
    <li><code>exit 1..<?php hueco(15, 6); ?></code>: codigos de error <b>especificos</b>
        para la <?php hueco(17, 14); ?>.</li>
    <li>Uso de <?php hueco(16, 14); ?> con nombres descriptivos de errores,
        en vez de numeros sueltos repartidos por el script.</li>
  </ul>

  <h3>Formato de mensajes</h3>
  <ul>
    <li>Diferenciacion entre mensajes <?php hueco(19, 16); ?> y de error
        (estos ultimos a <?php hueco(18, 10); ?>).</li>
    <li>Salidas con marcas de <?php hueco(20, 10); ?> y niveles
        (INFO, <?php hueco(21, 8); ?>, ERROR).</li>
    <li>Formato legible y compatible con sistemas de <?php hueco(22, 14); ?>
        de logs.</li>
  </ul>

  <div class="avisoflujo">
    <b>Estandar de la industria.</b> &laquo;La automatizacion defensiva previene el
    error <?php hueco(23, 12); ?> y garantiza ejecuciones
    <?php hueco(24, 18); ?> en cualquier infraestructura.&raquo;
  </div>

  <?php mc('m7'); ?>
  <?php mc('m8'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Menu.php', 'segundo.php');
