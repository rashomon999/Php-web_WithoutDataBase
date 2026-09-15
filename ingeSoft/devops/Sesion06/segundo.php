<?php
/* ==========================================================================
   IngeSoft5 / DevOps / Sesion 06 — bloque 02: Imagenes y Dockerfiles
   Fuente: sesion_06_introduccion_docker.pdf — modulo 2
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- que es una imagen --- */
    1  => ['inmutable'],
    2  => ['runtime'],
    3  => ['configuraciones'],
    4  => ['unionfs', 'union fs'],
    5  => ['capa'],
    6  => ['escritura'],
    7  => ['temporal', 'delgada'],
    8  => ['copy-on-write', 'cow', 'copy on write'],
    9  => ['inmutables'],
    10 => ['insignificante'],

    /* --- sintaxis del dockerfile --- */
    11 => ['from'],
    12 => ['workdir'],
    13 => ['copy'],
    14 => ['run'],
    15 => ['cmd'],
    16 => ['compilacion'],
    17 => ['inicial'],
    18 => ['cache'],
    19 => ['estables'],
    20 => ['cambiante'],

    /* --- multi-stage --- */
    21 => ['jar'],
    22 => ['from'],
    23 => ['temporales'],
    24 => ['compilacion'],
    25 => ['distroless'],
    26 => ['90'],
    27 => ['vulnerabilidad'],

    /* --- lineas y bloques --- */
    28 => 'FROM node:18-alpine',
    29 => "COPY package*.json ./\nRUN npm install\nCOPY . .\nCMD [\"node\", \"app.js\"]",
];

$TEXTO = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,27];

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Tienes 20 contenedores corriendo a partir de la <b>misma</b> imagen de 400 MB. &iquest;Cuanto disco ocupan aproximadamente?',
        'opciones' => [
            'a' => '8 GB: 400 MB por cada contenedor',
            'b' => 'Poco mas de 400 MB: las <b>capas base son inmutables y se comparten</b>; cada contenedor solo añade su delgada capa de escritura encima',
            'c' => '400 MB exactos, los contenedores no ocupan disco',
            'd' => 'Depende del sistema de archivos del host'
        ],
        'correcta' => 'b',
        'porque'   => 'Es la consecuencia practica del <b>UnionFS</b>: la imagen es una pila de capas de solo lectura y todos los contenedores apuntan a las mismas. Solo lo que cada uno <b>escribe</b> ocupa espacio propio. Por eso arrancar el contenedor numero 20 es casi gratis.'
    ],
    'm2' => [
        'texto'    => 'Un proceso dentro del contenedor modifica un archivo que venia en la imagen base. &iquest;Que ocurre?',
        'opciones' => [
            'a' => 'Se modifica la imagen, y todos los contenedores ven el cambio',
            'b' => '<b>Copy-on-Write</b>: el archivo se copia a la capa de escritura del contenedor y se modifica ahi. La capa base queda intacta y el cambio <b>no</b> lo ven los demas contenedores',
            'c' => 'Docker lanza un error de solo lectura',
            'd' => 'El cambio se guarda en un volumen automatico'
        ],
        'correcta' => 'b',
        'porque'   => 'De ahi el nombre: copiar <b>en el momento de escribir</b>, no antes. Y de ahi tambien dos consecuencias: (1) escribir muchisimo dentro del contenedor es lento y engorda su capa; (2) esa capa <b>muere con el contenedor</b> — motivo por el que existen los volumenes.'
    ],
    'm3' => [
        'texto'    => '&iquest;Cual es la diferencia entre <code>RUN</code> y <code>CMD</code>?',
        'opciones' => [
            'a' => 'Son sinonimos, <code>CMD</code> es la forma moderna',
            'b' => '<code>RUN</code> ejecuta instrucciones <b>durante la compilacion</b> de la imagen y <b>crea una capa</b>; <code>CMD</code> no ejecuta nada al construir: define el <b>proceso inicial</b> que arrancara al iniciar el contenedor',
            'c' => '<code>RUN</code> arranca el contenedor y <code>CMD</code> lo construye',
            'd' => '<code>RUN</code> solo sirve para instalar paquetes'
        ],
        'correcta' => 'b',
        'porque'   => 'Regla mental: <b><code>RUN</code> = build time, <code>CMD</code> = run time</b>. Por eso puedes tener muchos <code>RUN</code> (cada uno una capa) pero solo <b>un</b> <code>CMD</code> efectivo — si escribes varios, gana el ultimo. Y <code>CMD</code> se puede sobreescribir al lanzar: <code>docker run mi-img otra-cosa</code>.'
    ],
    'm4' => [
        'texto'    => 'Tu Dockerfile hace <code>COPY . .</code> y despues <code>RUN npm install</code>. Cambias <b>una linea</b> de tu codigo y reconstruyes. &iquest;Que pasa?',
        'opciones' => [
            'a' => 'Nada, Docker reutiliza todas las capas',
            'b' => 'Se <b>invalida la cache</b> desde el <code>COPY</code> en adelante, asi que <code>npm install</code> vuelve a descargar <b>todas</b> las dependencias — aunque el <code>package.json</code> no haya cambiado',
            'c' => 'Docker detecta que solo cambio el codigo y salta el install',
            'd' => 'Falla la compilacion'
        ],
        'correcta' => 'b',
        'porque'   => 'El orden correcto es el contrario: primero <code>COPY package*.json ./</code>, luego <code>RUN npm install</code>, y <b>al final</b> <code>COPY . .</code>. La diapositiva lo dice asi: colocar las directivas <b>estables</b> antes de copiar el codigo <b>cambiante</b>. En un pipeline, esto es la diferencia entre un build de 20 segundos y uno de 4 minutos.'
    ],
    'm5' => [
        'texto'    => '&iquest;Como funciona exactamente la cache de capas de Docker?',
        'opciones' => [
            'a' => 'Guarda el resultado de la ultima compilacion completa',
            'b' => 'Va capa por capa: si una instruccion y <b>sus archivos asociados</b> no cambiaron, reutiliza la capa guardada. En cuanto una cambia, <b>todas las siguientes</b> se reconstruyen',
            'c' => 'Cachea solo las instrucciones <code>RUN</code>',
            'd' => 'Cachea segun la fecha de modificacion del Dockerfile'
        ],
        'correcta' => 'b',
        'porque'   => 'La parte que se olvida es la <b>cascada</b>: la cache no es por instruccion suelta, es acumulativa. Por eso el diseño de un Dockerfile se ordena de lo que <b>menos</b> cambia (imagen base, paquetes del sistema, dependencias) a lo que <b>mas</b> cambia (tu codigo).'
    ],
    'm6' => [
        'texto'    => '&iquest;Cual es la idea central de un build <b>multi-stage</b>?',
        'opciones' => [
            'a' => 'Construir varias imagenes distintas a la vez',
            'b' => 'Usar <b>varias instrucciones <code>FROM</code></b> en el mismo Dockerfile para crear etapas temporales: una pesada que compila y una final limpia y liviana a la que solo se copia el <b>binario ya compilado</b>',
            'c' => 'Dividir el Dockerfile en varios archivos',
            'd' => 'Compilar en paralelo para ir mas rapido'
        ],
        'correcta' => 'b',
        'porque'   => 'La cifra de la diapositiva: reduce el peso de las imagenes de produccion <b>hasta en un 90%</b>, disminuyendo la superficie de vulnerabilidad. El compilador (JDK, Maven, Node) es imprescindible para <b>construir</b> y completamente inutil para <b>ejecutar</b>.'
    ],
    'm7' => [
        'texto'    => 'La etapa final del multi-stage usa <code>alpine</code> o <code>distroless</code>. &iquest;Que es una imagen <b>distroless</b>?',
        'opciones' => [
            'a' => 'Una imagen sin sistema de archivos',
            'b' => 'Una imagen que contiene <b>solo</b> la aplicacion y su runtime: sin gestor de paquetes, sin shell, sin utilidades del sistema — si un atacante entra, no tiene ni <code>sh</code> con que trabajar',
            'c' => 'Una imagen basada en Windows',
            'd' => 'Una imagen que se descarga sin registro'
        ],
        'correcta' => 'b',
        'porque'   => 'Es un paso mas alla de Alpine (que si trae shell y <code>apk</code>). La contrapartida honesta: <b>depurar es mas dificil</b> — no puedes hacer <code>docker exec -it ... sh</code> porque no hay shell. Se compensa con buenos logs y con imagenes <code>:debug</code> aparte.'
    ],
    'm8' => [
        'texto'    => '&iquest;Por que es un <b>antipatron</b> poner la contraseña de la base de datos en una directiva <code>ENV</code> del Dockerfile?',
        'opciones' => [
            'a' => 'Porque <code>ENV</code> no admite caracteres especiales',
            'b' => 'Porque queda <b>escrita en una capa de la imagen y en su historial</b> (<code>docker history</code> la muestra): viaja a cualquiera que descargue la imagen, se sube al registro y queda versionada en Git con el Dockerfile',
            'c' => 'Porque las variables <code>ENV</code> no llegan a la aplicacion',
            'd' => 'Porque hay que usar <code>ARG</code> en su lugar, que si es seguro'
        ],
        'correcta' => 'b',
        'porque'   => 'Pregunta 4 de la discusion. Y ojo: <b><code>ARG</code> tampoco salva</b> — tambien queda en el historial de build. Los secretos se <b>inyectan en tiempo de ejecucion</b> (variables del entorno del runner, Docker/Kubernetes secrets, un gestor tipo Vault), nunca se hornean en la imagen. Y borrar la linea despues no sirve: la capa vieja sigue ahi.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Sesión 6 · 2 — Imágenes y Dockerfiles', 'sesion_06_introduccion_docker.pdf — módulo 2: capas, caché y multi-stage');
?>

<div class="card">
  <h2>1. &iquest;Que es una imagen de Docker?</h2>

  <ul>
    <li><b>Plantilla de lectura:</b> paquete <?php hueco(1, 12); ?> que contiene
        el codigo, el <?php hueco(2, 10); ?>, las librerias y las
        <?php hueco(3, 16); ?>.</li>
    <li><b>Sistema de archivos en capas (<?php hueco(4, 10); ?>):</b> cada
        instruccion del archivo de receta crea una nueva <?php hueco(5, 8); ?>
        de lectura.</li>
    <li><b>Capa de escritura (<i>container layer</i>):</b> al ejecutar una imagen, Docker
        añade una delgada capa <?php hueco(7, 12); ?> de
        <?php hueco(6, 12); ?> en la parte superior.</li>
    <li><b><?php hueco(8, 16); ?> (CoW):</b> optimiza el almacenamiento
        compartiendo las capas base <?php hueco(9, 14); ?> entre multiples
        contenedores.</li>
  </ul>

  <div class="avisoflujo">
    <b>Almacenamiento.</b> Las capas inmutables permiten que multiples contenedores
    compartan casi todo su sistema de archivos base, ocupando espacio en disco
    <?php hueco(10, 16); ?>.
  </div>

  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Sintaxis de un Dockerfile</h2>

  <table class="datos">
    <tr><th>Instruccion</th><th>Que hace</th></tr>
    <tr><td><code><?php hueco(11, 10); ?></code></td>
        <td><b>imagen base:</b> define el punto de partida
            (p. ej. <code>FROM node:18-alpine</code>)</td></tr>
    <tr><td><code><?php hueco(12, 12); ?></code></td>
        <td>configura el <b>directorio interno</b> de ejecucion</td></tr>
    <tr><td><code><?php hueco(13, 10); ?></code></td>
        <td>copia los archivos del proyecto hacia la imagen</td></tr>
    <tr><td><code><?php hueco(14, 10); ?></code></td>
        <td>ejecuta instrucciones durante la <?php hueco(16, 14); ?>
            — <b>crea capa</b></td></tr>
    <tr><td><code><?php hueco(15, 10); ?></code></td>
        <td>define el proceso <?php hueco(17, 10); ?> al iniciar el contenedor</td></tr>
  </table>

  <div class="nota">
    <b>Optimizacion.</b> Si una linea y sus archivos asociados no cambian, Docker reutiliza
    la capa guardada en <?php hueco(18, 10); ?>, acelerando drasticamente las
    compilaciones del pipeline.
  </div>

  <p><b>Cache de capas:</b> colocar las directivas <?php hueco(19, 12); ?>
     (como instalar dependencias) <b>antes</b> de copiar el codigo
     <?php hueco(20, 14); ?> optimiza los tiempos de compilacion.</p>

  <h3>Escribelo de memoria</h3>
  <?php linea(28, 'La imagen base del ejemplo de la diapositiva: Node 18 sobre Alpine.', 'FROM ...'); ?>

  <?php bloque(29, 'Las <b>cuatro</b> lineas siguientes, en el orden que <b>aprovecha la cache</b>: copiar los <code>package*.json</code> a <code>./</code>, instalar con npm, copiar el resto del codigo, y definir el arranque con <code>node app.js</code> (en forma de lista JSON).', 5); ?>
  <?php ayuda('Orden: <code>COPY package*.json ./</code> &rarr; <code>RUN npm install</code> &rarr; <code>COPY . .</code> &rarr; <code>CMD ["node", "app.js"]</code>'); ?>

  <?php mc('m3'); ?>
  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
  <?php mc('m8'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Construcciones multi-stage (multietapa)</h2>

  <ul>
    <li><b>El problema:</b> el compilador (JDK, Maven) es pesado y <b>no se necesita en
        produccion</b>; solo se requiere el ejecutable final (p. ej. el archivo
        <?php hueco(21, 8); ?>).</li>
    <li><b>Multi-stage:</b> permite usar multiples instrucciones
        <code><?php hueco(22, 10); ?></code> en el mismo Dockerfile para crear
        etapas <?php hueco(23, 14); ?>.</li>
    <li><b>Etapa de <?php hueco(24, 14); ?>:</b> usa una imagen pesada con
        compiladores y dependencias para generar el binario.</li>
    <li><b>Etapa final de ejecucion:</b> copia <b>unicamente</b> el binario compilado hacia
        una imagen limpia y liviana (p. ej. <code>alpine</code> o
        <code><?php hueco(25, 14); ?></code>).</li>
  </ul>

  <div class="avisoflujo">
    <b>Optimizacion.</b> Las etapas multiples permiten reducir el peso de las imagenes
    finales de produccion hasta en un <?php hueco(26, 5); ?> %, disminuyendo la
    superficie de <?php hueco(27, 16); ?>.
  </div>

  <?php mc('m6'); ?>
  <?php mc('m7'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('index.php', 'tercero.php');
