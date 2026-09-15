<?php
/* ==========================================================================
   IngeSoft5 / DevOps / Sesion 05 — bloque 01: Interpretes, permisos,
   sintaxis y variables
   Fuente: sesion_05_scripting_bash.pdf — modulos 1 y 2
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- shebang --- */
    1  => ['shebang'],
    2  => ['interprete'],
    3  => ['posix'],
    4  => ['bourne again shell', 'bourne again'],
    5  => ['arrays', 'vectores'],
    6  => ['path'],

    /* --- permisos --- */
    7  => ['-rw-r--r--', 'rw-r--r--'],
    8  => ['+x', 'x'],
    9  => ['rwx'],
    10 => ['r-x'],
    11 => ['755'],
    12 => ['./setup.sh', './'],

    /* --- sintaxis --- */
    13 => ['espacios'],
    14 => ['#'],
    15 => ['literal'],
    16 => ['dobles'],
    17 => ['comillas', 'comillas dobles'],

    /* --- variables --- */
    18 => ['globales'],
    19 => ['local'],
    20 => ['export'],
    21 => ['subprocesos', 'hijos'],
    22 => ['sustitucion de comandos', 'sustitucion'],

    /* --- interaccion --- */
    23 => ['echo'],
    24 => ['-e', 'e'],
    25 => ['printf'],
    26 => ['read'],
    27 => ['-p', 'p'],
    28 => ['-s', 's'],

    /* --- lineas completas --- */
    29 => '#!/usr/bin/env bash',
    30 => 'chmod 755 setup.sh',
    31 => 'FECHA=$(date +%Y-%m-%d)',
    32 => 'export PORT=5000',
    33 => 'read -p "Ingrese su usuario: " USERNAME',
    34 => 'local temp_dir="/tmp/app"',
];

$TEXTO = [1,2,3,4,5,6,13,15,16,17,18,19,20,21,22,23,25,26];

$MULTIPLE = [
    'm1' => [
        'texto'    => '&iquest;Por que la diapositiva recomienda <code>#!/usr/bin/env bash</code> antes que <code>#!/bin/bash</code>?',
        'opciones' => [
            'a' => 'Porque <code>env</code> ejecuta el script mas rapido',
            'b' => 'Por <b>portabilidad</b>: <code>env</code> busca el binario de Bash en el <code>PATH</code> actual, asi el script funciona aunque en esa distribucion Bash no este exactamente en <code>/bin/bash</code>',
            'c' => 'Porque <code>/bin/bash</code> no existe en Linux',
            'd' => 'Porque permite usar variables de entorno en el shebang'
        ],
        'correcta' => 'b',
        'porque'   => 'El caso tipico es macOS y los BSD, donde el Bash util suele estar en <code>/usr/local/bin/bash</code> o <code>/opt/homebrew/bin/bash</code>. Con la ruta fija el script muere con «bad interpreter»; con <code>env</code> se resuelve solo.'
    ],
    'm2' => [
        'texto'    => '&iquest;Cual es la diferencia practica entre <code>/bin/sh</code> y <code>/bin/bash</code>?',
        'opciones' => [
            'a' => 'Ninguna, <code>sh</code> es un enlace simbolico a <code>bash</code> siempre',
            'b' => '<code>/bin/sh</code> es el estandar <b>POSIX</b> — mas rapido y con menos funciones; <code>/bin/bash</code> es el Bourne Again Shell e incluye <b>arrays</b>, aritmetica avanzada y <code>[[ ]]</code>',
            'c' => '<code>/bin/sh</code> solo sirve para scripts interactivos',
            'd' => '<code>/bin/bash</code> no soporta tuberias'
        ],
        'correcta' => 'b',
        'porque'   => 'Esto explica un error clasico: escribes <code>#!/bin/sh</code> pero usas <code>[[ ]]</code> o arrays, y en Ubuntu <code>/bin/sh</code> es <b>dash</b>, no bash. El script revienta con «Syntax error: unexpected». Si usas features de Bash, declara Bash.'
    ],
    'm3' => [
        'texto'    => 'Creas <code>setup.sh</code> con <code>touch</code> y lo intentas correr con <code>./setup.sh</code>. Sale «Permission denied». &iquest;Por que?',
        'opciones' => [
            'a' => 'Porque falta el shebang',
            'b' => 'Porque en Linux un archivo recien creado nace <b>sin permiso de ejecucion</b> (<code>-rw-r--r--</code>): es seguridad por defecto, y hay que darselo con <code>chmod</code>',
            'c' => 'Porque no eres root',
            'd' => 'Porque el archivo esta vacio'
        ],
        'correcta' => 'b',
        'porque'   => 'Seguridad por defecto: si cualquier archivo descargado fuera ejecutable de entrada, bastaria con un clic para correr codigo ajeno. Por eso el permiso de ejecucion es un acto <b>explicito</b> del dueño del archivo.'
    ],
    'm4' => [
        'texto'    => 'En <code>chmod 755</code>, &iquest;que significa cada digito?',
        'opciones' => [
            'a' => 'Propietario, grupo y otros con control total',
            'b' => '<b>7 (rwx)</b> el propietario tiene control total; <b>5 (r-x)</b> grupo y otros pueden <b>leer y ejecutar pero no modificar</b>',
            'c' => '7 son los dias de retencion y 55 el tamaño maximo',
            'd' => '7 para lectura, 5 para escritura'
        ],
        'correcta' => 'b',
        'porque'   => 'Cada digito es la suma de <b>r=4, w=2, x=1</b>. Asi 7=4+2+1 (rwx) y 5=4+1 (r-x). Para un script de despliegue en un servidor compartido, 755 es lo correcto: que otros lo ejecuten, pero que solo tu puedas cambiar lo que hace.'
    ],
    'm5' => [
        'texto'    => 'Escribes <code>VAR = "valor"</code> y Bash responde con un error. &iquest;Por que?',
        'opciones' => [
            'a' => 'Porque falta el <code>$</code> delante de <code>VAR</code>',
            'b' => 'Porque en una asignacion <b>no puede haber espacios</b> alrededor del <code>=</code>: con espacios, Bash interpreta <code>VAR</code> como un <b>comando</b> y <code>=</code> y <code>"valor"</code> como sus argumentos',
            'c' => 'Porque hay que declarar la variable antes',
            'd' => 'Porque el valor debe ir en comillas simples'
        ],
        'correcta' => 'b',
        'porque'   => 'Y el reves tambien confunde: dentro de <code>[ ]</code> los espacios son <b>obligatorios</b> (<code>[ "$a" = "$b" ]</code>), porque ahi <code>[</code> si es un comando. Regla corta: <b>asignar sin espacios, comparar con espacios</b>.'
    ],
    'm6' => [
        'texto'    => 'Tienes <code>NOMBRE="Luis"</code>. &iquest;Que imprime <code>echo \'$NOMBRE\'</code> (comillas simples)?',
        'opciones' => [
            'a' => '<code>Luis</code>',
            'b' => 'Literalmente <code>$NOMBRE</code>: las comillas <b>simples</b> preservan el valor literal y no expanden nada',
            'c' => 'Una linea vacia',
            'd' => 'Un error de sintaxis'
        ],
        'correcta' => 'b',
        'porque'   => 'Regla: <b>simples = literal</b>, <b>dobles = interpolan</b> variables y sustitucion de comandos. Y la diapositiva lo marca como fuente principal de fallos en produccion: olvidar las <b>dobles</b> al expandir (<code>rm $ARCHIVO</code> en vez de <code>rm "$ARCHIVO"</code>) rompe con cualquier ruta que tenga espacios.'
    ],
    'm7' => [
        'texto'    => 'Declaras una variable con <code>export</code> en vez de dejarla global normal. &iquest;Que cambia?',
        'opciones' => [
            'a' => 'Que ya no se puede modificar',
            'b' => 'Que pasa al <b>entorno de los subprocesos</b>: los programas e hijos que lance el script la ven (p. ej. <code>export PORT=5000</code> y la app que arrancas lee ese puerto). Sin <code>export</code> solo existe dentro del script',
            'c' => 'Que se guarda en disco permanentemente',
            'd' => 'Que se convierte en solo lectura para el usuario'
        ],
        'correcta' => 'b',
        'porque'   => 'Los tres ambitos de la diapositiva, de menor a mayor alcance: <code>local</code> (solo dentro de la funcion), global (todo el script), <code>export</code> (el script <b>y</b> sus hijos). Y ninguno sube hacia el shell padre — por eso un script no puede cambiar el directorio de tu terminal.'
    ],
    'm8' => [
        'texto'    => 'Vas a pedir una contraseña por teclado. &iquest;Que opcion de <code>read</code> usas y por que?',
        'opciones' => [
            'a' => '<code>-p</code>, para que se vea lo que escribe',
            'b' => '<code>-s</code> (modo silencioso): no hace eco de las pulsaciones en pantalla, asi la contraseña no queda visible ni en la sesion ni en una grabacion de terminal',
            'c' => '<code>-e</code>, para interpretar escapes',
            'd' => '<code>-r</code>, para evitar barras invertidas'
        ],
        'correcta' => 'b',
        'porque'   => 'Se combinan: <code>read -sp "Clave: " PASS</code> muestra el prompt (<code>-p</code>) pero oculta lo tecleado (<code>-s</code>). Y en un pipeline, mejor aun: no pidas secretos por teclado, inyectalos como <b>variables de entorno</b> o secretos del runner.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Sesión 5 · 1 — Intérpretes, permisos, sintaxis y variables', 'sesion_05_scripting_bash.pdf — módulos 1 y 2');
?>

<div class="card">
  <h2>Como se usa</h2>
  <p>Las diapositivas de la <b>Sesion 5: Scripting en Bash</b>, repartidas en tres paginas
     siguiendo los cuatro modulos del PDF.</p>
  <div class="nota">Respuestas en <b>texto</b>: no importan mayusculas ni tildes.
    Pulsa <b>Enter</b> dentro de un hueco para verificar. Las lineas de codigo respetan
    la forma exacta. Las preguntas de opcion multiple llevan explicacion — leelas aunque aciertes.</div>
</div>


<div class="card">
  <h2>1. El interprete y la linea shebang</h2>

  <ul>
    <li><b><?php hueco(1, 12); ?> (<code>#!/bin/bash</code>):</b> indica al sistema
        que <?php hueco(2, 14); ?> debe usar para ejecutar el script.</li>
    <li><b>Bash vs. sh:</b> <code>/bin/sh</code> es el estandar
        <?php hueco(3, 10); ?> (mas rapido, menos funciones);
        <code>/bin/bash</code> es el <?php hueco(4, 22); ?>, e incluye
        <?php hueco(5, 12); ?>, aritmetica avanzada y mas.</li>
    <li><b>Portabilidad:</b> <code>#!/usr/bin/env bash</code> busca el binario de Bash
        en el <?php hueco(6, 8); ?> actual, mejorando la compatibilidad entre
        distribuciones.</li>
  </ul>

  <h3>Escribelo de memoria</h3>
  <?php linea(29, 'La cabecera <b>portable</b> del ejemplo de la diapositiva.', '#!...'); ?>

  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Permisos de ejecucion</h2>

  <ul>
    <li><b>Seguridad por defecto:</b> un archivo de texto recien creado carece de permisos
        de ejecucion (<?php hueco(7, 14); ?>).</li>
    <li><b>El comando chmod:</b> <code>chmod <?php hueco(8, 6); ?> script.sh</code>
        añade permisos de ejecucion para todos los usuarios.</li>
    <li><b>Notacion octal</b> (<code>chmod <?php hueco(11, 6); ?></code>):
      <ul>
        <li><b>7 (<?php hueco(9, 8); ?>):</b> el propietario tiene control total.</li>
        <li><b>5 (<?php hueco(10, 8); ?>):</b> grupo y otros pueden leer y ejecutar,
            pero no modificar.</li>
      </ul>
    </li>
  </ul>

  <div class="avisoflujo">
    <b>La consola de la diapositiva.</b>
    <code>$ touch setup.sh</code> &rarr; <code>$ chmod 755 setup.sh</code> &rarr;
    <code>$ <?php hueco(12, 14); ?></code>
  </div>

  <h3>Escribelo de memoria</h3>
  <?php linea(30, 'Darle permisos <b>755</b> al archivo <code>setup.sh</code>.', 'chmod ...'); ?>

  <?php mc('m3'); ?>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Sintaxis de asignacion y comentarios</h2>

  <ul>
    <li><b>Sin <?php hueco(13, 12); ?> en las asignaciones:</b>
        <code>VAR = "valor"</code> arroja error; la sintaxis correcta es estrictamente
        <code>VAR="valor"</code>.</li>
    <li><b>Comentarios (<code><?php hueco(14, 5); ?></code>):</b> cualquier texto
        despues del simbolo es ignorado.</li>
    <li><b>Comillas simples (<code>'</code>):</b> preservan el valor
        <?php hueco(15, 10); ?> — <code>'$VAR'</code> muestra textualmente
        <code>$VAR</code>.</li>
    <li><b>Comillas <?php hueco(16, 10); ?> (<code>"</code>):</b> evaluan variables
        y comandos — <code>"$VAR"</code> interpola su valor.</li>
  </ul>

  <div class="nota">
    <b>Evitar errores.</b> El uso incorrecto de espacios en asignaciones y la falta de
    <?php hueco(17, 16); ?> dobles al expandir variables son las principales
    fuentes de fallos en produccion.
  </div>

  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Tipos y ambitos de variables</h2>

  <table class="datos">
    <tr><th>Tipo</th><th>Alcance</th></tr>
    <tr><td>Variables <?php hueco(18, 12); ?> (por defecto)</td>
        <td>visibles en todo el script tras su declaracion</td></tr>
    <tr><td>Variables locales (<code><?php hueco(19, 10); ?></code>)</td>
        <td>restringidas al contexto de una <b>funcion</b> — evita colisiones de estado</td></tr>
    <tr><td>Variables de entorno (<code><?php hueco(20, 10); ?></code>)</td>
        <td>compartidas con los <?php hueco(21, 14); ?> e hijos del shell
            (p. ej. <code>export PORT=5000</code>)</td></tr>
    <tr><td><?php hueco(22, 24); ?></td>
        <td>almacenar la salida de un comando con <code>VAR=$(comando)</code></td></tr>
  </table>

  <h3>Escribelo de memoria</h3>
  <?php linea(31, 'Guarda en <code>FECHA</code> la salida de <code>date</code> con el formato <code>+%Y-%m-%d</code>, usando sustitucion de comandos.', 'FECHA=...'); ?>
  <?php linea(32, 'Exporta el puerto <code>5000</code> en la variable <code>PORT</code>.', 'export ...'); ?>
  <?php linea(34, 'Declara dentro de una funcion la variable <code>temp_dir</code> con el valor <code>/tmp/app</code> entre comillas dobles.', 'local ...'); ?>

  <?php mc('m7'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Interaccion con el usuario</h2>

  <table class="datos">
    <tr><th>Comando</th><th>Para que</th></tr>
    <tr><td><code><?php hueco(23, 10); ?></code></td>
        <td>salida estandar simple; soporta <code><?php hueco(24, 6); ?></code>
            para interpretar secuencias de escape</td></tr>
    <tr><td><code><?php hueco(25, 10); ?></code></td>
        <td>salida formateada, similar a C: robusto para columnas y numeros</td></tr>
    <tr><td><code><?php hueco(26, 10); ?></code></td>
        <td>captura lo que el usuario ingresa por teclado</td></tr>
    <tr><td><code><?php hueco(27, 6); ?></code></td>
        <td>opcion de <code>read</code>: define un mensaje/prompt en la misma linea</td></tr>
    <tr><td><code><?php hueco(28, 6); ?></code></td>
        <td>opcion de <code>read</code>: modo silencioso, ideal para contraseñas</td></tr>
  </table>

  <h3>Escribelo de memoria</h3>
  <?php linea(33, 'Pide el usuario por teclado con el prompt <code>Ingrese su usuario: </code> (con el espacio final) y guardalo en <code>USERNAME</code>.', 'read ...'); ?>

  <?php mc('m8'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Menu.php', 'segundo.php');
