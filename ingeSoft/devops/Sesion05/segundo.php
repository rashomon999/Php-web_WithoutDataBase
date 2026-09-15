<?php
/* ==========================================================================
   IngeSoft5 / DevOps / Sesion 05 — bloque 02: Control de flujo y listas
   Fuente: sesion_05_scripting_bash.pdf — modulo 3
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- parametros --- */
    1  => ['$0'],
    2  => ['$1'],
    3  => ['$#'],
    4  => ['$@'],
    5  => ['$?'],
    6  => ['backend'],
    7  => ['production'],

    /* --- arrays --- */
    8  => ['parentesis'],
    9  => ['espacios'],
    10 => ['llaves'],
    11 => ['0'],
    12 => ['@'],
    13 => ['#'],
    14 => ['+='],

    /* --- condicionales --- */
    15 => ['posix'],
    16 => ['espacios'],
    17 => ['bash'],
    18 => ['logicos'],
    19 => ['regulares'],
    20 => ['vacias'],
    21 => ['-z'],
    22 => ['-eq'],
    23 => ['-ne'],
    24 => ['-gt'],
    25 => ['!='],

    /* --- bucles --- */
    26 => ['for'],
    27 => ['while'],
    28 => ['aritmeticas'],

    /* --- lineas y bloques --- */
    29 => 'SERVIDORES=(prod1 prod2 prod3)',
    30 => 'SERVIDORES+=("backup1")',
    31 => 'echo "${SERVIDORES[@]}"',
    32 => 'echo ${#SERVIDORES[@]}',
    33 => "if [[ \$PORT -eq 8080 ]]; then\necho \"Puerto por defecto\"\nfi",
    34 => 'for sv in "${SERVIDORES[@]}"; do ssh "$sv" uptime; done',
    35 => 'while read -r linea; do echo "Procesando $linea"; done < logs.txt',
];

$TEXTO = [6,7,8,9,10,15,16,17,18,19,20,26,27,28];

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Ejecutas <code>./deploy.sh backend production</code>. &iquest;Que valen <code>$0</code>, <code>$1</code> y <code>$#</code>?',
        'opciones' => [
            'a' => '<code>$0</code>=backend, <code>$1</code>=production, <code>$#</code>=2',
            'b' => '<code>$0</code>=<code>./deploy.sh</code> (el nombre del script), <code>$1</code>=backend, <code>$#</code>=2 (la cantidad de argumentos)',
            'c' => '<code>$0</code>=deploy, <code>$1</code>=backend, <code>$#</code>=3',
            'd' => '<code>$0</code>=production, <code>$1</code>=backend, <code>$#</code>=1'
        ],
        'correcta' => 'b',
        'porque'   => 'El detalle que se olvida: <b><code>$0</code> no cuenta</b> en <code>$#</code>. Por eso la validacion de un script que espera dos parametros se escribe <code>[[ $# -ne 2 ]] && { echo "uso: ..."; exit 1; }</code>.'
    ],
    'm2' => [
        'texto'    => 'Corres un comando y <code>echo $?</code> imprime <b>127</b>. &iquest;Que significa?',
        'opciones' => [
            'a' => 'Que el comando termino correctamente',
            'b' => 'Que el <b>comando no se encontro</b> (command not found): 127 es el codigo reservado para eso. <code>$?</code> guarda el codigo de salida del <b>ultimo</b> comando',
            'c' => 'Que hubo un error de permisos',
            'd' => 'Que el comando devolvio 127 lineas'
        ],
        'correcta' => 'b',
        'porque'   => 'Pregunta 3 de la discusion de la diapositiva. Los codigos que conviene reconocer: <b>0</b> exito, <b>1</b> error generico, <b>2</b> mal uso, <b>126</b> encontrado pero no ejecutable (falta <code>chmod +x</code>), <b>127</b> no encontrado (typo o falta en el <code>PATH</code>), <b>130</b> cortado con Ctrl-C.'
    ],
    'm3' => [
        'texto'    => 'En un pipeline de CI/CD, &iquest;como usarias <code>$?</code> para validar que las pruebas pasaron?',
        'opciones' => [
            'a' => 'Leyendo el texto de la salida con <code>grep "OK"</code>',
            'b' => 'Ejecutando las pruebas y comprobando inmediatamente <code>if [[ $? -ne 0 ]]; then exit 1; fi</code>: el codigo de salida es el <b>contrato maquina a maquina</b>, no el texto del log',
            'c' => 'Contando las lineas del log',
            'd' => 'Mirando el color de la salida'
        ],
        'correcta' => 'b',
        'porque'   => 'Es la pregunta 5 de la diapositiva. Dos avisos: (1) <code>$?</code> se <b>sobreescribe con cada comando</b>, incluido el <code>echo</code> que pusiste en medio — captura el valor <b>inmediatamente</b> en una variable; (2) con <code>set -e</code> casi nunca hace falta, porque el script ya aborta solo.'
    ],
    'm4' => [
        'texto'    => 'Declaras <code>SERVIDORES=(prod1 prod2 prod3)</code>. &iquest;Que devuelve <code>${#SERVIDORES[@]}</code>?',
        'opciones' => [
            'a' => 'El primer elemento, <code>prod1</code>',
            'b' => '<b>3</b>: el <code>#</code> antepuesto devuelve el <b>tamaño</b> del vector',
            'c' => 'Todos los elementos separados por espacios',
            'd' => 'El indice del ultimo elemento'
        ],
        'correcta' => 'b',
        'porque'   => 'Ojo a la diferencia de un caracter: <code>${#SERVIDORES[@]}</code> es la <b>cantidad de elementos</b>, pero <code>${#SERVIDORES}</code> (sin <code>[@]</code>) es la <b>longitud en caracteres del primer elemento</b>. Y los indices empiezan en <b>0</b>, asi que el ultimo es <code>${SERVIDORES[-1]}</code>.'
    ],
    'm5' => [
        'texto'    => '&iquest;Por que <code>"${SERVIDORES[@]}"</code> va entre comillas dobles al recorrerlo en un <code>for</code>?',
        'opciones' => [
            'a' => 'Por estilo, no cambia nada',
            'b' => 'Porque asi cada elemento se pasa <b>entero</b> como un solo argumento: sin comillas, un elemento con espacios (p. ej. <code>"mi servidor"</code>) se partiria en dos iteraciones',
            'c' => 'Porque si no, el array se convierte en texto',
            'd' => 'Porque lo exige POSIX'
        ],
        'correcta' => 'b',
        'porque'   => 'La forma correcta es siempre <code>"${ARR[@]}"</code> entrecomillada. Con <code>[*]</code> en cambio todo el array se une en <b>una sola cadena</b> — util para imprimir, desastroso para iterar.'
    ],
    'm6' => [
        'texto'    => 'La diapositiva recomienda <code>[[ ]]</code> sobre <code>[ ]</code>. &iquest;Cual es la ventaja concreta?',
        'opciones' => [
            'a' => 'Que <code>[[ ]]</code> es POSIX y funciona en cualquier shell',
            'b' => 'Que <code>[[ ]]</code> es <b>nativo de Bash</b>: admite <code>&amp;&amp;</code> y <code>||</code> dentro, compara con expresiones regulares y <b>no falla si una variable esta vacia</b> o sin comillas',
            'c' => 'Que <code>[[ ]]</code> es mas rapido de escribir',
            'd' => 'Que <code>[ ]</code> no permite comparar numeros'
        ],
        'correcta' => 'b',
        'porque'   => 'El fallo clasico de <code>[ ]</code>: si <code>$VAR</code> esta vacia, <code>[ $VAR = "x" ]</code> se expande a <code>[ = "x" ]</code> y revienta con «unary operator expected». Con <code>[[ ]]</code> no pasa. La contrapartida: <code>[[ ]]</code> <b>no existe</b> en <code>/bin/sh</code>, asi que exige shebang de Bash.'
    ],
    'm7' => [
        'texto'    => 'Quieres comprobar si <code>$PORT</code> es igual a 8080. &iquest;Cual es correcto?',
        'opciones' => [
            'a' => '<code>[[ $PORT == 8080 ]]</code> siempre, porque <code>==</code> sirve para todo',
            'b' => '<code>[[ $PORT -eq 8080 ]]</code>: <code>-eq</code> es el comparador <b>numerico</b>. <code>==</code> compara <b>cadenas</b>, asi que <code>"08080"</code> y <code>"8080"</code> no serian iguales',
            'c' => '<code>[[ $PORT = 8080 ]]</code> es la unica forma valida',
            'd' => '<code>[[ $PORT -gt 8080 ]]</code>'
        ],
        'correcta' => 'b',
        'porque'   => 'Memoriza las dos familias: <b>cadenas</b> &rarr; <code>==</code>, <code>!=</code>, <code>-z</code> (vacia), <code>-n</code> (no vacia). <b>Numeros</b> &rarr; <code>-eq</code>, <code>-ne</code>, <code>-gt</code>, <code>-lt</code>, <code>-ge</code>, <code>-le</code>. Mezclarlas es el error mas comun de los parciales.'
    ],
    'm8' => [
        'texto'    => 'Para leer un archivo <b>linea por linea</b>, la diapositiva usa <code>while read -r linea; do ... done &lt; logs.txt</code>. &iquest;Por que un <code>while</code> y no un <code>for</code>?',
        'opciones' => [
            'a' => 'Porque el <code>for</code> no puede leer archivos',
            'b' => 'Porque el <code>while</code> consume el <b>flujo</b> linea a linea sin cargar el archivo entero en memoria, y respeta las lineas con espacios; un <code>for</code> sobre <code>$(cat archivo)</code> partiria por <b>cada palabra</b>',
            'c' => 'Porque el <code>while</code> es mas rapido',
            'd' => 'Porque <code>read</code> solo funciona dentro de <code>while</code>'
        ],
        'correcta' => 'b',
        'porque'   => 'Y el <code>-r</code> no es decorativo: sin el, <code>read</code> interpreta las <b>barras invertidas</b> como escapes y te destroza rutas de Windows o contraseñas. La forma canonica es <code>while IFS= read -r linea</code>, que ademas conserva los espacios del principio y el final.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Sesión 5 · 2 — Control de flujo y listas', 'sesion_05_scripting_bash.pdf — módulo 3: parámetros, vectores y estructuras de control');
?>

<div class="card">
  <h2>1. Paso de parametros</h2>
  <p>El script lee los parametros enviados desde consola usando variables numeradas.</p>

  <table class="datos">
    <tr><th>Variable</th><th>Que contiene</th></tr>
    <tr><td><code><?php hueco(1, 6); ?></code></td><td>nombre del script ejecutado</td></tr>
    <tr><td><code><?php hueco(2, 6); ?></code> a <code>$N</code></td>
        <td>parametros de entrada 1 al N</td></tr>
    <tr><td><code><?php hueco(3, 6); ?></code></td>
        <td>cantidad total de argumentos provistos</td></tr>
    <tr><td><code><?php hueco(4, 6); ?></code></td>
        <td>lista de todos los argumentos como elementos separados</td></tr>
    <tr><td><code><?php hueco(5, 6); ?></code></td>
        <td>codigo de salida del ultimo comando ejecutado</td></tr>
  </table>

  <div class="avisoflujo">
    <b>El ejemplo de la diapositiva.</b> <code>$ ./deploy.sh backend production</code> &rarr;
    dentro del script <code>$1</code> es <?php hueco(6, 12); ?> y
    <code>$2</code> es <?php hueco(7, 14); ?>.
  </div>

  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Listas y vectores (arrays)</h2>

  <ul>
    <li><b>Declaracion:</b> los elementos se separan por <?php hueco(9, 12); ?>
        dentro de <?php hueco(8, 14); ?>:
        <code>SERVIDORES=(prod1 prod2 prod3)</code>.</li>
    <li><b>Acceso a elementos:</b> requiere <?php hueco(10, 10); ?> —
        <code>${SERVIDORES[<?php hueco(11, 5); ?>]}</code> accede al primer elemento.</li>
    <li><b>Obtener todo el vector:</b> se usa el indice
        <code><?php hueco(12, 5); ?></code>, como en <code>${SERVIDORES[@]}</code>.</li>
    <li><b>Tamaño del vector:</b> anteponiendo el simbolo
        <code><?php hueco(13, 5); ?></code>, como en <code>${#SERVIDORES[@]}</code>.</li>
    <li><b>Añadir un elemento:</b> con el operador
        <code><?php hueco(14, 6); ?></code>, como en <code>SERVIDORES+=("backup1")</code>.</li>
  </ul>

  <h3>Escribelo de memoria</h3>
  <?php linea(29, 'Declara el array <code>SERVIDORES</code> con <code>prod1</code>, <code>prod2</code> y <code>prod3</code>.', 'SERVIDORES=...'); ?>
  <?php linea(30, 'Añade <code>backup1</code> al final del array (el valor entre comillas dobles).', 'SERVIDORES+=...'); ?>
  <?php linea(31, 'Imprime <b>todos</b> los elementos del array, bien entrecomillado.', 'echo ...'); ?>
  <?php linea(32, 'Imprime el <b>numero</b> de elementos del array.', 'echo ...'); ?>

  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Estructuras condicionales</h2>

  <table class="datos">
    <tr><th>Forma</th><th>Caracteristicas</th></tr>
    <tr><td><b>El test clasico</b> <code>[ ]</code></td>
        <td>sintaxis <?php hueco(15, 10); ?>. Requiere
            <?php hueco(16, 12); ?> estrictos antes y despues de los corchetes.</td></tr>
    <tr><td><b>El test moderno</b> <code>[[ ]]</code></td>
        <td>nativo de <?php hueco(17, 10); ?>. Permite operadores
            <?php hueco(18, 12); ?> (<code>&amp;&amp;</code>, <code>||</code>) y
            comparacion de expresiones <?php hueco(19, 14); ?> sin fallar por
            variables <?php hueco(20, 10); ?>.</td></tr>
  </table>

  <h3>Comparacion numerica vs. cadenas</h3>
  <table class="datos">
    <tr><th>Cadenas</th><th>Numeros</th></tr>
    <tr>
      <td><code>==</code> (igual), <code><?php hueco(25, 6); ?></code> (diferente),
          <code><?php hueco(21, 6); ?></code> (vacio)</td>
      <td><code><?php hueco(22, 6); ?></code> (igual),
          <code><?php hueco(23, 6); ?></code> (diferente),
          <code><?php hueco(24, 6); ?></code> (mayor)</td>
    </tr>
  </table>

  <h3>Escribelo de memoria</h3>
  <?php bloque(33, 'El <code>if</code> completo de la diapositiva: si <code>$PORT</code> es igual a <code>8080</code>, imprime <code>Puerto por defecto</code>. Tres lineas, con <code>[[ ]]</code>.', 4); ?>
  <?php ayuda('Linea 1: <code>if [[ $PORT -eq 8080 ]]; then</code>. Linea 2: el <code>echo</code>. Linea 3: <code>fi</code>.'); ?>

  <?php mc('m6'); ?>
  <?php mc('m7'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Bucles e iteradores</h2>

  <ul>
    <li><b>Bucle <?php hueco(26, 8); ?> (iteracion de listas):</b> ideal para
        recorrer arrays de servidores o archivos.</li>
    <li><b>Bucle <code>for</code> estilo C:</b> para iteraciones
        <?php hueco(28, 14); ?> con rangos numericos definidos.</li>
    <li><b>Bucle <?php hueco(27, 8); ?> (lectura de flujos):</b> excelente para
        leer la salida de archivos linea por linea.</li>
  </ul>

  <h3>Escribelo de memoria</h3>
  <?php linea(34, 'Recorre el array <code>SERVIDORES</code> y por cada uno ejecuta <code>ssh "$sv" uptime</code>. Todo en una linea, con la variable de bucle llamada <code>sv</code>.', 'for sv in ...'); ?>
  <?php ayuda('Estructura: <code>for VAR in "${ARR[@]}"; do COMANDO; done</code>.'); ?>

  <?php linea(35, 'Lee <code>logs.txt</code> linea por linea en la variable <code>linea</code> e imprime <code>Procesando $linea</code>. Una sola linea, redirigiendo el archivo al final.', 'while read -r ...'); ?>
  <?php ayuda('Estructura: <code>while read -r VAR; do COMANDO; done &lt; archivo</code>.'); ?>

  <?php mc('m8'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('index.php', 'tercero.php');
