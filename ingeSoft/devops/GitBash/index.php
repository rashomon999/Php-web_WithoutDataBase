<?php
/* ==========================================================================
   IngeSoft5 / DevOps / GitBash — parte 1: el lenguaje
   Fuente: Ejercicios_Bash.pdf y Dev-Ops – bash.pdf
   ========================================================================== */

$CSS = '../../../css/bootstrap.min.css';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- comandos comunes --- */
    1  => ['cd'],
    2  => ['ls'],
    3  => ['mkdir'],
    4  => ['touch'],
    5  => ['rm'],
    6  => ['cp'],
    7  => ['mv'],
    8  => ['cat'],
    9  => ['grep'],
    10 => ['chmod'],
    11 => ['df'],
    12 => ['ps'],
    13 => ['sudo'],
    14 => ['history'],

    /* --- operadores de archivo --- */
    15 => ['-f'],
    16 => ['-d'],
    17 => ['-e'],
    18 => ['-s'],
    19 => ['-r'],
    20 => ['-w'],
    21 => ['-x'],
    22 => ['-nt'],

    /* --- strings --- */
    23 => ['-z'],
    24 => ['-n'],
    25 => ['=='],
    26 => ['!='],

    /* --- numericos --- */
    27 => ['-eq'],
    28 => ['-ne'],
    29 => ['-gt'],
    30 => ['-ge'],
    31 => ['-lt'],
    32 => ['-le'],

    /* --- if --- */
    33 => ['if'],
    34 => ['then'],
    35 => ['elif'],
    36 => ['else'],
    37 => ['fi'],

    /* --- for --- */
    38 => ['for item in a b c; do', 'for item in a b c ; do'],
    39 => ['for i in {1..5}; do', 'for i in {1..5} ; do'],
    40 => ['for ((i=0; i<10; i++)); do', 'for ((i=0; i<10; i++)) ; do'],
    41 => ['for f in /var/log/*.log; do', 'for f in /var/log/*.log ; do'],
    42 => ['done'],

    /* --- while --- */
    43 => ['while read -r line; do', 'while read -r line ; do'],
    44 => ['while true; do', 'while true ; do'],
    45 => ['while (( count < 10 )); do', 'while ((count < 10)); do'],

    /* --- case --- */
    46 => ['case'],
    47 => ['in'],
    48 => [';;'],
    49 => ['*)'],
    50 => ['esac'],
    51 => ['|'],

    /* --- set --- */
    52 => ['set -e'],
    53 => ['set -u'],
    54 => ['set -o pipefail'],
    55 => ['0'],

    /* --- parametros y read --- */
    56 => ['$1'],
    57 => ['read -r -p "Type someting: " var', 'read -r -p "Type someting: " var'],

    /* --- red y procesos --- */
    58 => ['ss'],
    59 => ['-n'],
    60 => ['-a'],
    61 => ['-t'],
    62 => ['-u'],
    63 => ['ps -e'],
    64 => ['ps -f'],
    65 => ['ps -p'],
    66 => ['ps --forest'],
    67 => ['top'],

    /* --- crontab --- */
    68 => ['minuto'],
    69 => ['hora'],
    70 => ['dia del mes', 'dia'],
    71 => ['mes'],
    72 => ['dia de la semana', 'dia semana'],
    73 => ['@reboot'],
    74 => ['@daily'],
    75 => ['@hourly'],
    76 => ['crontab -l'],
    77 => ['crontab -e'],
    78 => ['crontab -r'],
    79 => ['ls -l'],
    80 => ['Otros usuarios'],
    81 => ['Grupo'],
    82 => ['Propietario'],
    83 => ['Tipo'],
    84 => ['archivo'],
    85 => ['directorio'],

];

/* solo las conceptuales van como texto; los comandos y flags respetan mayusculas */
$TEXTO = [68,69,70,71,72];

$MULTIPLE = [
    'm1' => [
        'texto'    => '&iquest;Cual es la diferencia entre <code>[[ -e $RUTA ]]</code> y <code>[[ -f $RUTA ]]</code>?',
        'opciones' => [
            'a' => 'Ninguna',
            'b' => '<code>-e</code> es verdadero si la ruta <b>existe</b>, sea lo que sea (archivo, carpeta, enlace); <code>-f</code> solo si es un <b>archivo regular</b>',
            'c' => '<code>-e</code> es para carpetas y <code>-f</code> para archivos',
            'd' => '<code>-f</code> comprueba ademas que no este vacio'
        ],
        'correcta' => 'b',
        'porque'   => 'El que comprueba que no este vacio es <code>-s</code>. Si un directorio pasa <code>-e</code> pero tu esperabas un archivo, el script se rompe mas adelante.'
    ],
    'm2' => [
        'texto'    => 'Quieres comparar dos numeros. &iquest;Cual usas?',
        'opciones' => [
            'a' => '<code>[[ $N1 == $N2 ]]</code>',
            'b' => '<code>[[ $N1 -eq $N2 ]]</code>',
            'c' => '<code>[[ $N1 = $N2 ]]</code>',
            'd' => '<code>[[ $N1 equals $N2 ]]</code>'
        ],
        'correcta' => 'b',
        'porque'   => 'Regla de oro: <b>simbolos para strings</b> (<code>==</code>, <code>!=</code>), <b>letras para numeros</b> (<code>-eq</code>, <code>-ne</code>, <code>-gt</code>...). Con <code>==</code>, <code>"08"</code> y <code>"8"</code> serian distintos.'
    ],
    'm3' => [
        'texto'    => 'Segun los apuntes, &iquest;cual es la forma <b>mas segura</b> de iterar sobre archivos?',
        'opciones' => [
            'a' => '<code>for file in $(ls *.log); do</code>',
            'b' => '<code>for f in /var/log/*.log; do</code> — globbing',
            'c' => '<code>for i in {1..100}; do</code>',
            'd' => '<code>for ((i=0; i&lt;n; i++)); do</code>'
        ],
        'correcta' => 'b',
        'porque'   => 'El globbing evita problemas con espacios en los nombres. Con <code>$(ls)</code> un archivo llamado <code>mi log.txt</code> se parte en dos iteraciones.'
    ],
    'm4' => [
        'texto'    => 'Se te olvida el <code>;;</code> al final de un bloque de <code>case</code>. &iquest;Que pasa?',
        'opciones' => [
            'a' => 'Se ejecuta el bloque siguiente tambien',
            'b' => 'Bash da error',
            'c' => 'No pasa nada, es opcional',
            'd' => 'Se ejecuta el caso <code>*)</code>'
        ],
        'correcta' => 'b',
        'porque'   => 'Es literal en tus apuntes: &laquo;es el equivalente al <code>break</code>; si lo olvidas, Bash dara error&raquo;.'
    ],
    'm5' => [
        'texto'    => 'Tu script tiene <code>set -e</code>. Corres un comando que devuelve status code 3. &iquest;Que ocurre?',
        'opciones' => [
            'a' => 'El script continua y guarda el codigo',
            'b' => 'El script <b>termina inmediatamente</b>, porque el status code es distinto de 0',
            'c' => 'El script reintenta el comando',
            'd' => 'Se imprime una advertencia y sigue'
        ],
        'correcta' => 'b',
        'porque'   => 'En Bash, <b>0 = exito</b> y cualquier otro numero = fallo. <code>set -e</code> convierte un fallo silencioso en una parada visible.'
    ],
    'm6' => [
        'texto'    => 'Escribes <code>echo "$NOMBRE"</code> pero nunca definiste <code>NOMBRE</code>. &iquest;Que hace <code>set -u</code>?',
        'opciones' => [
            'a' => 'La define como cadena vacia',
            'b' => 'Trata la variable no definida como un <b>error</b> y detiene el script',
            'c' => 'Pide el valor por teclado',
            'd' => 'No hace nada con las variables'
        ],
        'correcta' => 'b',
        'porque'   => 'Sin <code>set -u</code> una variable mal escrita se evalua como vacia y silenciosamente haces cosas como <code>rm -rf /$RUTA</code> con RUTA vacia.'
    ],
    'm7' => [
        'texto'    => '&iquest;Que problema resuelve <code>set -o pipefail</code>?',
        'opciones' => [
            'a' => 'Que los pipes sean mas rapidos',
            'b' => 'Que si <b>un comando dentro de un pipeline falla</b>, todo el pipe se considere fallido; por defecto solo cuenta el status del ultimo',
            'c' => 'Que se puedan encadenar mas de dos comandos',
            'd' => 'Que el pipe no se cierre'
        ],
        'correcta' => 'b',
        'porque'   => 'Sin el, <code>comando_que_falla | grep algo</code> devuelve 0 si el grep encontro algo, y tu <code>set -e</code> nunca se entera.'
    ],
    'm8' => [
        'texto'    => 'Los tres <code>set</code> juntos se ponen al principio del script. &iquest;Como se escribe normalmente?',
        'opciones' => [
            'a' => '<code>set -euo pipefail</code>',
            'b' => '<code>set --strict</code>',
            'c' => '<code>set -all</code>',
            'd' => '<code>set safe</code>'
        ],
        'correcta' => 'a',
        'porque'   => 'Las banderas de una letra se pueden agrupar: <code>-e</code> + <code>-u</code> + <code>-o pipefail</code> = <code>set -euo pipefail</code>. Es el arranque estandar de un script serio.'
    ],
    'm9' => [
        'texto'    => 'En <code>ss -n --all --tcp</code>, &iquest;que hace <code>-n</code>?',
        'opciones' => [
            'a' => 'Muestra solo los sockets nuevos',
            'b' => 'Muestra direcciones y puertos en formato <b>numerico</b>, sin resolver nombres',
            'c' => 'Numera las lineas de salida',
            'd' => 'Limita el numero de resultados'
        ],
        'correcta' => 'b',
        'porque'   => 'Sin <code>-n</code>, <code>ss</code> intenta resolver DNS y traducir puertos a nombres de servicio, lo que hace la salida mas lenta y mas dificil de filtrar con grep.'
    ],
    'm10' => [
        'texto'    => 'Un cron <code>*/5 * * * *</code> significa...',
        'opciones' => [
            'a' => 'A las 5 en punto de cada hora',
            'b' => 'Cada 5 minutos',
            'c' => 'Cada 5 horas',
            'd' => 'Los dias 5 de cada mes'
        ],
        'correcta' => 'b',
        'porque'   => 'El <code>*/N</code> en un campo significa &laquo;cada N unidades de ese campo&raquo;. Como esta en el primer campo (minutos), es cada 5 minutos.'
    ],
    'm11' => [
        'texto'    => '&iquest;Cual es el orden de los cinco campos del crontab?',
        'opciones' => [
            'a' => 'hora, minuto, dia, mes, dia de la semana',
            'b' => 'minuto, hora, dia del mes, mes, dia de la semana',
            'c' => 'dia, mes, año, hora, minuto',
            'd' => 'minuto, hora, dia de la semana, dia del mes, mes'
        ],
        'correcta' => 'b',
        'porque'   => 'De la unidad mas pequeña a la mas grande, y el dia de la semana al final. Truco: 0 2 * * * = &laquo;minuto 0, hora 2, todos los dias&raquo;.'
    ],
    'm12' => [
        'texto'    => '&iquest;Que hace <code>crontab -r</code>?',
        'opciones' => [
            'a' => 'Recarga los cron jobs',
            'b' => '<b>Elimina</b> todos los cron jobs del usuario actual, sin preguntar',
            'c' => 'Los lista en formato raw',
            'd' => 'Los reinicia'
        ],
        'correcta' => 'b',
        'porque'   => 'Es peligrosamente parecido a <code>-e</code> (editar) en el teclado. Borra todo el crontab del usuario de un golpe.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Bash · 1 — el lenguaje', 'Ejercicios_Bash.pdf y Dev-Ops – bash.pdf');
?>

<div class="card">
  <h2>Como se usa</h2>
  <p>Todo lo que cae del PDF de Bash, con las palabras clave en blanco. Aqui la mayoria de
     respuestas son <b>comandos y banderas</b>, asi que <b>si</b> importan las mayusculas y los
     guiones: <code>-eq</code> no es <code>-EQ</code>.</p>
  <div class="nota">
    Los espacios sobrantes y el tipo de comillas dan igual. Pulsa <b>Enter</b> dentro de un
    hueco para verificar. En la <b>parte 2</b> estan los 15 retos.
  </div>
</div>


<div class="card">
  <h2>1. Comandos comunes</h2>

  <table class="datos">
    <tr><th>Comando</th><th>Para que sirve</th></tr>
    <tr><td><?php hueco(1, 8); ?></td><td>cambiar de carpeta</td></tr>
    <tr><td><?php hueco(2, 8); ?></td><td>ver archivos y carpetas</td></tr>
    <tr><td><?php hueco(3, 8); ?></td><td>crear carpetas</td></tr>
    <tr><td><?php hueco(4, 8); ?></td><td>crear archivos vacios</td></tr>
    <tr><td><?php hueco(5, 8); ?></td><td>eliminar archivos o carpetas</td></tr>
    <tr><td><?php hueco(6, 8); ?></td><td>copiar</td></tr>
    <tr><td><?php hueco(7, 8); ?></td><td>mover o renombrar</td></tr>
    <tr><td><?php hueco(8, 8); ?></td><td>mostrar el contenido de un archivo</td></tr>
    <tr><td><?php hueco(9, 8); ?></td><td>buscar texto dentro de archivos o de una salida</td></tr>
    <tr><td><?php hueco(10, 8); ?></td><td>cambiar permisos (por ejemplo, hacer ejecutable un script)</td></tr>
    <tr><td><?php hueco(11, 8); ?></td><td>ver el uso de disco</td></tr>
    <tr><td><?php hueco(12, 8); ?></td><td>listar procesos</td></tr>
    <tr><td><?php hueco(13, 8); ?></td><td>ejecutar como superusuario</td></tr>
    <tr><td><?php hueco(14, 8); ?></td><td>ver los comandos que has escrito antes</td></tr>
  </table>

  <div class="nota"><b>Nombres de variables:</b> empiezan por letra o guion bajo, admiten letras,
    numeros y guiones bajos, <b>distinguen mayusculas</b>, no llevan espacios ni caracteres
    especiales, deben ser descriptivos y no pueden ser palabras reservadas.</div>
  <h3>Ver archivos y carpetas y permisos:</h3>
  <p><?php hueco(79, 8); ?> </p>
  <pre>
-   rw-   r--   r--
│    │     │     │
│    │     │     └── <?php hueco(80, 14); ?> 
│    │     └──────── <?php hueco(81, 8); ?> 
│    └────────────── <?php hueco(82, 11); ?> 
└──────────────────  <?php hueco(83, 8); ?> 
  </pre>
  <h3>¿Y el primer -?</h3>
  <p>Indica el tipo de elemento:</p>
  <pre>
-   <?php hueco(84, 8); ?>  
d   <?php hueco(85, 10); ?>  
  </pre>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Condicionales: operaciones sobre archivos</h2>

  <table class="datos">
    <tr><th>Operacion</th><th>Verdadero si...</th></tr>
    <tr><td>[[ <?php hueco(15, 6); ?> $FILE ]]</td><td>el archivo existe y es un archivo <b>regular</b></td></tr>
    <tr><td>[[ <?php hueco(16, 6); ?> $DIR ]]</td><td>el <b>directorio</b> existe</td></tr>
    <tr><td>[[ <?php hueco(17, 6); ?> $PATH ]]</td><td>la ruta <b>existe</b>, sea lo que sea</td></tr>
    <tr><td>[[ <?php hueco(18, 6); ?> $FILE ]]</td><td>el archivo existe y <b>no esta vacio</b></td></tr>
    <tr><td>[[ <?php hueco(19, 6); ?> $FILE ]]</td><td>tienes permiso de <b>lectura</b></td></tr>
    <tr><td>[[ <?php hueco(20, 6); ?> $FILE ]]</td><td>tienes permiso de <b>escritura</b></td></tr>
    <tr><td>[[ <?php hueco(21, 6); ?> $FILE ]]</td><td>el archivo es <b>ejecutable</b></td></tr>
    <tr><td>[[ $F1 <?php hueco(22, 6); ?> $F2 ]]</td><td>el archivo 1 es <b>mas reciente</b> que el 2</td></tr>
  </table>

  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Condicionales: strings y numeros</h2>

  <table class="datos">
    <tr><th>Strings</th><th>Verdadero si...</th></tr>
    <tr><td>[[ <?php hueco(23, 6); ?> $STR ]]</td><td>el string esta <b>vacio</b> (zero)</td></tr>
    <tr><td>[[ <?php hueco(24, 6); ?> $STR ]]</td><td>el string <b>no</b> esta vacio</td></tr>
    <tr><td>[[ $A <?php hueco(25, 6); ?> $B ]]</td><td>los strings son iguales</td></tr>
    <tr><td>[[ $A <?php hueco(26, 6); ?> $B ]]</td><td>los strings son diferentes</td></tr>
  </table>

  <table class="datos">
    <tr><th>Numeros</th><th>Significa</th></tr>
    <tr><td>[[ $N1 <?php hueco(27, 6); ?> $N2 ]]</td><td>igual a (<em>equal</em>)</td></tr>
    <tr><td>[[ $N1 <?php hueco(28, 6); ?> $N2 ]]</td><td>diferente de (<em>not equal</em>)</td></tr>
    <tr><td>[[ $N1 <?php hueco(29, 6); ?> $N2 ]]</td><td>mayor que (<em>greater than</em>)</td></tr>
    <tr><td>[[ $N1 <?php hueco(30, 6); ?> $N2 ]]</td><td>mayor o igual (<em>greater or equal</em>)</td></tr>
    <tr><td>[[ $N1 <?php hueco(31, 6); ?> $N2 ]]</td><td>menor que (<em>less than</em>)</td></tr>
    <tr><td>[[ $N1 <?php hueco(32, 6); ?> $N2 ]]</td><td>menor o igual (<em>less or equal</em>)</td></tr>
  </table>

  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. La estructura <code>if</code></h2>

  <pre><code><?php hueco(33, 6); ?> [[ condition ]];
<?php hueco(34, 6); ?>
      statement
<?php hueco(35, 7); ?> [[ condition ]];
then
      statement
<?php hueco(36, 7); ?>
      default
<?php hueco(37, 5); ?></code></pre>

  <div class="nota">Fijate en el cierre: <code>fi</code> es <code>if</code> al reves,
    igual que <code>esac</code> es <code>case</code> al reves.</div>

  <?php enviar(); ?>
</div>

 


<div class="card">
  <h2>5. <code>case</code></h2>

  <table class="datos">
    <tr><th>Componente</th><th>Funcion</th><th>Nota</th></tr>
    <tr><td><?php hueco(46, 8); ?> "$VAR" <?php hueco(47, 6); ?></td><td>inicio de la evaluacion</td><td>siempre entrecomilla <code>"$VAR"</code> por si esta vacia</td></tr>
    <tr><td><code>pattern)</code></td><td>el patron a buscar</td><td>admite texto plano o wildcards (<code>*.log</code>)</td></tr>
    <tr><td><?php hueco(51, 6); ?> , &amp;</td><td>operadores logicos OR y AND</td><td>para agrupar varios patrones</td></tr>
    <tr><td><?php hueco(48, 6); ?></td><td>terminador de bloque</td><td>equivale al <code>break</code>; si falta, Bash da error</td></tr>
    <tr><td><?php hueco(49, 6); ?></td><td>el comodin universal</td><td>siempre el ultimo, captura las excepciones</td></tr>
    <tr><td><?php hueco(50, 8); ?></td><td>cierre de la estructura</td><td>es <code>case</code> escrito al reves</td></tr>
  </table>

  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Los tres <code>set</code> del principio</h2>
  <p>Van arriba del todo en cualquier script que vaya a correr desatendido.</p>

  <table class="datos">
    <tr><th>Opcion</th><th>Que hace</th></tr>
    <tr><td><?php hueco(52, 12); ?></td><td><em>Exit immediately</em>: termina el script si un comando devuelve un status code distinto de <?php hueco(55, 4); ?></td></tr>
    <tr><td><?php hueco(53, 12); ?></td><td><em>Unbound variables</em>: si una variable no esta definida, lo trata como error</td></tr>
    <tr><td><?php hueco(54, 18); ?></td><td>si un comando dentro de un <b>pipeline</b> falla, todo el pipe se considera fallido</td></tr>
  </table>
 
    <p>
        Un <strong>pipeline</strong> en Bash es cuando conectas
        la salida de un comando con la entrada de otro usando
        <code>|</code>.
    </p>

    <h2>Ejemplo</h2>

    <pre><code>echo "Hola Luis" | grep "Luis"</code></pre>
    <p>significa que busque Luis en la salida</p>
    <p>Aquí tenemos dos comandos:</p>

    <pre>
echo "Hola Luis"
       │
       │ salida
       ↓
grep "Luis"
       │
       ↓
    salida
    </pre>

    <p>
        El símbolo <code>|</code> es el <strong>pipeline</strong>.
    </p>

    <h2>Otro ejemplo</h2>

    <pre><code>cat archivo.txt | grep "error"</code></pre>

    <ol>
        <li>
            <code>cat archivo.txt</code> → muestra el contenido del archivo.
        </li>
        <li>
            <code>|</code> → manda ese contenido al siguiente comando.
        </li>
        <li>
            <code>grep "error"</code> → busca las líneas que contienen
            <code>"error"</code>.
        </li>
    </ol>

  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php mc('m7'); ?>
  <?php mc('m8'); ?>
  <?php enviar(); ?>
</div>


<div class="card">


  <h2>7. Leer entradas</h2>

  <p>Los parametros que le pasas al script se leen con <?php hueco(56, 6); ?> ,
     <code>$2</code>, ... <code>$n</code>.</p>

  <p>Y de forma interactiva:</p>
  <?php linea(57, 'pide por teclado <code>Type someting: </code> y guarda la respuesta en <code>var</code>', 'escribe la linea completa...'); ?>
  <?php ayuda('<code>read</code>, la bandera <code>-r</code> (no interpretar backslashes) y <code>-p</code> (prompt), el texto entre comillas, y al final el nombre de la variable <b>sin</b> el <code>$</code>.'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>8. Diagnostico de red y procesos</h2>

  <p>Para validar conexiones se usa <?php hueco(58, 6); ?> (<em>Socket Statistics</em>),
     el sucesor de <code>netstat</code>. Sus banderas:</p>

  <table class="datos">
    <tr><th>Bandera</th><th>Significa</th></tr>
    <tr><td><?php hueco(59, 6); ?> / <code>--numeric</code></td><td>direcciones y puertos en numerico</td></tr>
    <tr><td><?php hueco(60, 6); ?> / <code>--all</code></td><td>todos los sockets</td></tr>
    <tr><td><?php hueco(61, 6); ?> / <code>--tcp</code></td><td>solo sockets TCP</td></tr>
    <tr><td><?php hueco(62, 6); ?> / <code>--udp</code></td><td>solo sockets UDP</td></tr>
  </table>

  <p>Y para procesos:</p>
  <table class="datos">
    <tr><th>Comando</th><th>Que muestra</th></tr>
    <tr><td><?php hueco(63, 12); ?></td><td>todos los procesos</td></tr>
    <tr><td><?php hueco(64, 12); ?></td><td><em>full format list</em></td></tr>
    <tr><td><code>ps -u</code></td><td>el usuario asociado al proceso</td></tr>
    <tr><td><?php hueco(65, 12); ?> PID</td><td>informacion del proceso con ese PID</td></tr>
    <tr><td><?php hueco(66, 14); ?></td><td>los procesos en arbol</td></tr>
    <tr><td><?php hueco(67, 10); ?></td><td>lo mismo pero <b>interactivo</b> y en vivo</td></tr>
  </table>

  <?php mc('m9'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>9. Crontab</h2>
  <p>
  crontab es una herramienta de Linux/Unix que sirve para programar scripts o comandos para que se ejecuten 
  automáticamente en determinados momentos.
  </p>
  <p>Los cinco campos, en orden:</p>
  <pre><code><?php hueco(68, 10); ?>  <?php hueco(69, 8); ?>  <?php hueco(70, 14); ?>  <?php hueco(71, 8); ?>  <?php hueco(72, 18); ?>

# ejemplo
* * * * * sh /path/to/script.sh</code></pre>

  <p>Los atajos con arroba:</p>
  <table class="datos">
    <tr><th>Atajo</th><th>Cuando se ejecuta</th></tr>
    <tr><td><?php hueco(73, 12); ?></td><td>una vez al inicio del sistema</td></tr>
    <tr><td><code>@yearly</code> / <code>@annually</code></td><td>una vez al año</td></tr>
    <tr><td><code>@monthly</code></td><td>una vez al mes</td></tr>
    <tr><td><code>@weekly</code></td><td>una vez a la semana</td></tr>
    <tr><td><?php hueco(74, 12); ?> / <code>@midnight</code></td><td>una vez al dia</td></tr>
    <tr><td><?php hueco(75, 12); ?></td><td>cada hora</td></tr>
  </table>

  <p>Y los tres comandos:</p>
  <table class="datos">
    <tr><th>Comando</th><th>Que hace</th></tr>
    <tr><td><?php hueco(76, 14); ?></td><td>lista los cron jobs del usuario actual</td></tr>
    <tr><td><?php hueco(77, 14); ?></td><td>edita el archivo de cron jobs</td></tr>
    <tr><td><?php hueco(78, 14); ?></td><td><b>elimina</b> los cron jobs del usuario</td></tr>
  </table>

  <?php mc('m10'); ?>
  <?php mc('m11'); ?>
  <?php mc('m12'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Menu.php', 'segundo.php');
