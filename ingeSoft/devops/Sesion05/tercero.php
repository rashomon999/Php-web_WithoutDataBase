<?php
/* ==========================================================================
   IngeSoft5 / DevOps / Sesion 05 — bloque 03: Flujos y manejo de errores
   Fuente: sesion_05_scripting_bash.pdf — modulo 4 + conclusiones y discusion
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- descriptores --- */
    1  => ['stdin'],
    2  => ['stdout'],
    3  => ['stderr'],
    4  => ['0'],
    5  => ['1'],
    6  => ['2'],

    /* --- redirecciones --- */
    7  => ['sobrescribe'],
    8  => ['>>'],
    9  => ['&>>', '&>'],
    10 => ['2>&1'],
    11 => ['/dev/null'],
    12 => ['descarta'],
    13 => ['|'],

    /* --- safe mode --- */
    14 => ['cero'],
    15 => ['definida', 'inicializada'],
    16 => ['pipefail'],
    17 => ['tuberias'],
    18 => ['borrados'],

    /* --- errores y depuracion --- */
    19 => ['0'],
    20 => ['255'],
    21 => ['preventiva'],
    22 => ['-x', 'x'],
    23 => ['depuracion'],

    /* --- conclusiones --- */
    24 => ['pegamento'],
    25 => ['bootstrapping', 'arranque'],
    26 => ['50'],
    27 => ['dos veces', 'dos'],

    /* --- lineas completas --- */
    28 => 'set -euo pipefail',
    29 => './setup.sh 1> deploy.log 2> errores.log',
    30 => './setup.sh &>> completo.log',
    31 => 'ping -c 1 localhost > /dev/null 2>&1',
    32 => 'systemctl status nginx | grep "Active:"',
    33 => '[[ -f config.env ]] || { echo "Falta config.env"; exit 1; }',
];

$TEXTO = [1,2,3,7,12,14,15,16,17,18,21,23,24,25,27];

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Corres <code>./setup.sh 1&gt; deploy.log 2&gt; errores.log</code>. &iquest;Que consigues?',
        'opciones' => [
            'a' => 'Que todo se escriba dos veces',
            'b' => '<b>Separar los flujos</b>: la salida normal (stdout, descriptor 1) va a <code>deploy.log</code> y los errores (stderr, descriptor 2) a <code>errores.log</code>',
            'c' => 'Que el script se ejecute dos veces',
            'd' => 'Que los errores se silencien'
        ],
        'correcta' => 'b',
        'porque'   => 'Los tres descriptores: <b>0</b> stdin (entrada), <b>1</b> stdout (salida), <b>2</b> stderr (errores). Separarlos es lo que te permite revisar un archivo corto de errores en vez de rastrearlos dentro de miles de lineas de log normal.'
    ],
    'm2' => [
        'texto'    => '&iquest;Cual es la diferencia entre <code>&gt;</code> y <code>&gt;&gt;</code>?',
        'opciones' => [
            'a' => 'Ninguna, son sinonimos',
            'b' => '<code>&gt;</code> <b>sobrescribe</b> el archivo destino (lo deja en cero y escribe); <code>&gt;&gt;</code> <b>añade</b> al final conservando lo anterior',
            'c' => '<code>&gt;</code> es para texto y <code>&gt;&gt;</code> para binarios',
            'd' => '<code>&gt;&gt;</code> escribe en stderr'
        ],
        'correcta' => 'b',
        'porque'   => 'Es una fuente real de perdida de datos: un <code>&gt;</code> donde querias <code>&gt;&gt;</code> borra el log del despliegue anterior <b>antes</b> de empezar a escribir — y si el script falla en la primera linea, te quedas sin registro viejo y sin registro nuevo.'
    ],
    'm3' => [
        'texto'    => '&iquest;Que hace exactamente <code>2&gt;&amp;1</code>?',
        'opciones' => [
            'a' => 'Convierte los errores en advertencias',
            'b' => 'Redirige <b>stderr hacia donde ya apunta stdout</b>, para que los errores tambien pasen por la tuberia o lleguen al mismo archivo',
            'c' => 'Ejecuta el comando dos veces',
            'd' => 'Redirige stdout hacia stderr'
        ],
        'correcta' => 'b',
        'porque'   => 'Sin el, una tuberia <b>solo</b> transporta stdout y los errores se escapan a la pantalla. Y ojo al <b>orden</b>: <code>cmd &gt; log 2&gt;&amp;1</code> manda todo al archivo, pero <code>cmd 2&gt;&amp;1 &gt; log</code> no — cuando se copia el descriptor, stdout aun apuntaba a la terminal.'
    ],
    'm4' => [
        'texto'    => 'La diapositiva pregunta: &iquest;cual es el <b>peligro</b> de silenciar permanentemente stderr mandandolo a <code>/dev/null</code>?',
        'opciones' => [
            'a' => 'Que <code>/dev/null</code> se llena de datos',
            'b' => 'Que <b>pierdes toda la evidencia</b>: el script sigue fallando pero en silencio, y una incidencia en produccion se vuelve imposible de diagnosticar porque no queda rastro de la causa',
            'c' => 'Que el script se vuelve mas lento',
            'd' => 'Ninguno, es una buena practica'
        ],
        'correcta' => 'b',
        'porque'   => 'Silenciar es legitimo cuando el error es <b>esperado y sin valor</b> (un <code>ping</code> de comprobacion que sabes que puede fallar). Es venenoso como habito general. La alternativa sana: mandarlo a un archivo de log, no a la nada. <code>/dev/null</code> es un dispositivo virtual que <b>descarta</b> todo lo que recibe.'
    ],
    'm5' => [
        'texto'    => 'Un script de instalacion hace <code>rm -rf "$INSTALL_DIR/bin"</code> y alguien escribio mal el nombre de la variable. &iquest;Que desastre evita <code>set -u</code>?',
        'opciones' => [
            'a' => 'Ninguno, <code>rm</code> fallaria igual',
            'b' => 'Que la variable indefinida se expanda a <b>vacio</b> y el comando se convierta en <code>rm -rf "/bin"</code>: con <code>set -u</code> el script <b>aborta</b> antes de ejecutar nada',
            'c' => 'Que se borre el archivo equivocado dentro del directorio correcto',
            'd' => 'Que el script pida confirmacion'
        ],
        'correcta' => 'b',
        'porque'   => 'Pregunta 2 de la discusion. Es literalmente el bug que en 2016 borro <code>/usr</code> a los usuarios del instalador de Steam. <code>set -e</code> <b>no</b> te salva aqui, porque borrar el directorio equivocado no es un error para el shell: el comando tiene exito.'
    ],
    'm6' => [
        'texto'    => 'Sin <code>set -e</code>, &iquest;que hace Bash cuando una linea intermedia de tu script falla catastroficamente?',
        'opciones' => [
            'a' => 'Aborta el script y devuelve el error',
            'b' => '<b>Sigue ejecutando</b> las lineas siguientes como si nada, y el script puede terminar con codigo 0 habiendo dejado el despliegue a medias',
            'c' => 'Reintenta la linea tres veces',
            'd' => 'Pide confirmacion al usuario'
        ],
        'correcta' => 'b',
        'porque'   => 'La diapositiva lo llama <b>el peligro por defecto</b>. Por eso la recomendacion es tan rotunda: <code>set -euo pipefail</code> en la primera linea util de <b>todo</b> script de DevOps e infraestructura. Los tres van juntos porque cada uno tapa un agujero distinto.'
    ],
    'm7' => [
        'texto'    => 'El patron <code>[[ -f config.env ]] || { echo "Falta config.env"; exit 1; }</code> es un ejemplo de...',
        'opciones' => [
            'a' => 'Modo depuracion',
            'b' => '<b>Validacion preventiva</b>: comprobar la existencia de archivos o la conectividad <b>antes</b> de proceder con el codigo de despliegue, fallando pronto y con un mensaje claro',
            'c' => 'Redireccion de flujos',
            'd' => 'Sustitucion de comandos'
        ],
        'correcta' => 'b',
        'porque'   => 'Lee el <code>||</code> como «o si no»: «existe el archivo, <b>o si no</b> avisa y sal». Las llaves agrupan los dos comandos en un solo bloque. Es el mismo <b>fail fast</b> del pipeline, pero dentro del script.'
    ],
    'm8' => [
        'texto'    => '&iquest;Cuando elegirias Bash en vez de Python o Node.js para una tarea de DevOps?',
        'opciones' => [
            'a' => 'Siempre: Bash es superior para cualquier automatizacion',
            'b' => 'Cuando la tarea es <b>pegar herramientas de consola</b> — arranque, comprobaciones de salud, despliegue rapido — y cabe en decenas de lineas sin dependencias. Si aparece logica compleja, estructuras de datos, parseo de JSON o pruebas, toca saltar a Python',
            'c' => 'Solo cuando no hay Python instalado',
            'd' => 'Nunca, Bash esta obsoleto'
        ],
        'correcta' => 'b',
        'porque'   => 'Pregunta 1 de la discusion. La ventaja de Bash es que <b>ya esta en todas partes</b>: no instalas nada, no gestionas un entorno virtual, y hablas directamente con los comandos del sistema. Su techo llega pronto — cuando te descubres parseando texto con <code>sed</code> y <code>awk</code> anidados, la respuesta ya era Python.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Sesión 5 · 3 — Flujos y manejo de errores', 'sesion_05_scripting_bash.pdf — módulo 4, conclusiones y discusión');
?>

<div class="card">
  <h2>1. Redireccion de salidas</h2>

  <table class="datos">
    <tr><th>Descriptor</th><th>Numero</th><th>Que es</th></tr>
    <tr><td><?php hueco(1, 10); ?></td><td><?php hueco(4, 5); ?></td><td>entrada</td></tr>
    <tr><td><?php hueco(2, 10); ?></td><td><?php hueco(5, 5); ?></td><td>salida</td></tr>
    <tr><td><?php hueco(3, 10); ?></td><td><?php hueco(6, 5); ?></td><td>errores</td></tr>
  </table>

  <ul>
    <li><b>Redireccion simple:</b> <code>&gt;</code> <?php hueco(7, 14); ?>
        el archivo destino; <code><?php hueco(8, 6); ?></code> añade contenido al final.</li>
    <li><b>Separacion de errores:</b> capturar los errores en un archivo <b>diferente</b>
        al log normal.</li>
    <li><b>Todo junto:</b> <code><?php hueco(9, 7); ?></code> redirecciona
        stdout <b>y</b> stderr a la vez.</li>
  </ul>

  <h3>Escribelo de memoria</h3>
  <?php linea(29, 'Ejecuta <code>./setup.sh</code> mandando la salida normal a <code>deploy.log</code> y los errores a <code>errores.log</code>, nombrando los descriptores <b>explicitamente</b>.', './setup.sh 1> ...'); ?>
  <?php linea(30, 'Ejecuta <code>./setup.sh</code> <b>añadiendo</b> stdout y stderr juntos a <code>completo.log</code>.', './setup.sh &>> ...'); ?>

  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Tuberias y /dev/null</h2>

  <ul>
    <li><b>Tuberias (<code><?php hueco(13, 5); ?></code>):</b> envian la salida
        estandar del comando de la izquierda a la <b>entrada estandar</b> del comando
        de la derecha.</li>
    <li><b>Redireccion de stderr a stdout (<code><?php hueco(10, 8); ?></code>):</b>
        permite filtrar tambien los errores a traves de tuberias.</li>
    <li><b>El dispositivo <code><?php hueco(11, 12); ?></code>:</b> dispositivo
        virtual especial del sistema que <?php hueco(12, 12); ?> toda la
        informacion que recibe (silenciar comandos).</li>
  </ul>

  <h3>Escribelo de memoria</h3>
  <?php linea(31, 'Un <code>ping</code> de <b>un solo</b> paquete a <code>localhost</code>, completamente silenciado (salida y errores).', 'ping -c 1 ...'); ?>
  <?php linea(32, 'Mira el estado de <code>nginx</code> con <code>systemctl</code> y filtra con <code>grep</code> la cadena <code>Active:</code> (entre comillas dobles).', 'systemctl status ...'); ?>

  <?php mc('m3'); ?>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Shell Safe Mode</h2>

  <div class="nota">
    <b>El peligro por defecto.</b> Bash continuara ejecutando las siguientes lineas de un
    script <b>incluso si una intermedia falla catastroficamente</b>.
  </div>

  <table class="datos">
    <tr><th>Opcion</th><th>Que hace</th></tr>
    <tr><td><code>set -e</code></td>
        <td>aborta de inmediato si algun comando retorna un codigo de salida distinto de
            <?php hueco(14, 8); ?></td></tr>
    <tr><td><code>set -u</code></td>
        <td>aborta si se intenta expandir una variable no
            <?php hueco(15, 14); ?> — previene
            <?php hueco(18, 12); ?> accidentales</td></tr>
    <tr><td><code>set -o <?php hueco(16, 12); ?></code></td>
        <td>propaga codigos de error a lo largo de las
            <?php hueco(17, 12); ?></td></tr>
  </table>

  <div class="avisoflujo">
    <b>Recomendacion.</b> Agrega <b>siempre</b> la linea de safe mode al inicio de todos
    tus scripts de DevOps e infraestructura, para garantizar robustez y seguridad.
  </div>

  <h3>Escribelo de memoria</h3>
  <?php linea(28, 'La linea completa del <b>safe mode</b>.', 'set -...'); ?>

  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Manejo de errores y depuracion</h2>

  <ul>
    <li><b>Codigos de salida (<code>exit N</code>):</b> retornar
        <?php hueco(19, 5); ?> para exito, y un numero entre 1 y
        <?php hueco(20, 6); ?> para representar errores especificos del negocio.</li>
    <li><b>Validacion <?php hueco(21, 14); ?>:</b> comprobar la existencia de
        archivos o la conectividad <b>antes</b> de proceder con el codigo de despliegue.</li>
    <li><b>Modo <?php hueco(23, 14); ?></b> (<code>set <?php hueco(22, 6); ?></code>
        o <code>bash -x</code>): muestra en consola, paso a paso, cada linea evaluada.</li>
  </ul>

  <h3>Escribelo de memoria</h3>
  <?php linea(33, 'El <b>patron de fallo</b> de la diapositiva: si <code>config.env</code> no es un archivo regular, imprime <code>Falta config.env</code> y sale con codigo 1. Una linea, con <code>[[ ]]</code>, <code>||</code> y llaves.', '[[ -f ... ]] || { ... }'); ?>
  <?php ayuda('Forma: <code>[[ -f ARCHIVO ]] || { echo "MENSAJE"; exit 1; }</code>. Ojo al punto y coma <b>dentro</b> de las llaves, antes del cierre.'); ?>

  <?php mc('m7'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Conclusiones: el rol de Bash en DevOps</h2>

  <ul>
    <li><b><?php hueco(24, 14); ?> tecnologico:</b> une herramientas complejas de
        IaC, contenedores y configuracion.</li>
    <li><b>Automatizacion liviana:</b> ideal para tareas de arranque
        (<?php hueco(25, 16); ?>), comprobacion de salud y despliegue rapido.</li>
    <li><b>Robustez operacional:</b> escribir scripts con manejo de errores y
        redirecciones adecuadas reduce incidentes en un
        <?php hueco(26, 5); ?> %.</li>
  </ul>

  <div class="avisoflujo">
    <b>Mantra DevOps.</b> Si vas a ejecutar un comando de consola mas de
    <?php hueco(27, 12); ?> en produccion, automatizalo en un script de Bash
    <b>versionado en tu repositorio</b>.
  </div>

  <?php mc('m8'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('segundo.php', '../Menu.php');
