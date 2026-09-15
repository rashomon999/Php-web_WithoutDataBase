<?php
/* ==========================================================================
   IngeSoft5 / DevOps / Linux — bloque 01: Consola y sistema de archivos
   Fuente: introduccion_linux.pdf — modulo 1
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- filesystem --- */
    1  => ['jerarquico'],
    2  => ['/'],
    3  => ['/etc', 'etc'],
    4  => ['/var/log', 'var/log'],
    5  => ['/home', 'home'],
    6  => ['/root', 'root'],
    7  => ['archivo'],
    8  => ['texto plano', 'texto'],

    /* --- navegacion --- */
    9  => ['pwd'],
    10 => ['cd'],
    11 => ['ls -la', 'ls -al'],
    12 => ['ocultos'],

    /* --- manejo de archivos --- */
    13 => ['touch'],
    14 => ['mkdir'],
    15 => ['nano'],
    16 => ['vim'],
    17 => ['cp'],
    18 => ['mv'],
    19 => ['rm -rf', 'rm'],
    20 => ['recursiva'],
    21 => ['cat'],
    22 => ['less'],
    23 => ['tail -f', 'tail'],
    24 => ['syslog', '/var/log/syslog'],

    /* --- lineas completas --- */
    25 => 'ls -la',
    26 => 'tail -f /var/log/syslog',
    27 => 'touch archivo.txt',
    28 => 'rm -rf carpeta/',
];

$TEXTO = [1,7,8,12,20];

$MULTIPLE = [
    'm1' => [
        'texto'    => 'La <b>filosofia Unix</b> dice que «todo se trata como un archivo». &iquest;Que consecuencia practica tiene eso en DevOps?',
        'opciones' => [
            'a' => 'Que solo se pueden guardar archivos de texto',
            'b' => 'Que directorios, hardware y procesos se manipulan con las <b>mismas herramientas de texto plano</b> (<code>cat</code>, <code>grep</code>, <code>sed</code>) — por eso automatizar el sistema operativo con un script de Bash es posible',
            'c' => 'Que no existen las bases de datos',
            'd' => 'Que todos los archivos son ejecutables'
        ],
        'correcta' => 'b',
        'porque'   => 'Es lo que hace que configurar un servidor sea <b>editar archivos</b> y no hacer clic en ventanas. Y eso, a su vez, es lo que permite versionar la configuracion en Git y aplicarla con un script: la base de Infraestructura como Codigo.'
    ],
    'm2' => [
        'texto'    => 'Entras a un servidor a investigar por que falla una app. &iquest;En que dos directorios miras primero?',
        'opciones' => [
            'a' => '<code>/home</code> y <code>/root</code>',
            'b' => '<code>/etc</code> (archivos de configuracion del sistema y los servicios) y <code>/var/log</code> (logs del SO y de las aplicaciones)',
            'c' => '<code>/bin</code> y <code>/tmp</code>',
            'd' => '<code>/usr</code> y <code>/opt</code>'
        ],
        'correcta' => 'b',
        'porque'   => 'Regla mental: <b><code>/etc</code> = como <i>deberia</i> comportarse</b> el sistema, <b><code>/var/log</code> = como se esta comportando <i>de verdad</i></b>. Casi toda depuracion en un servidor es comparar esas dos cosas.'
    ],
    'm3' => [
        'texto'    => '&iquest;Que añade la bandera <code>-a</code> en <code>ls -la</code> que no tiene un <code>ls</code> normal?',
        'opciones' => [
            'a' => 'Ordena alfabeticamente',
            'b' => 'Muestra los archivos <b>ocultos</b>: los que empiezan por punto (<code>.env</code>, <code>.git</code>, <code>.ssh</code>, <code>.bashrc</code>)',
            'c' => 'Muestra el tamaño en formato legible',
            'd' => 'Lista recursivamente los subdirectorios'
        ],
        'correcta' => 'b',
        'porque'   => 'Y en DevOps eso importa mucho, porque <b>casi todo lo interesante esta oculto</b>: variables de entorno en <code>.env</code>, llaves en <code>.ssh</code>, el workflow en <code>.github</code>. La <code>l</code> es la otra mitad: formato largo con permisos, dueño, tamaño y fecha.'
    ],
    'm4' => [
        'texto'    => '&iquest;Cual es la diferencia entre <code>cat</code>, <code>less</code> y <code>tail -f</code>?',
        'opciones' => [
            'a' => 'Ninguna, los tres muestran el archivo',
            'b' => '<code>cat</code> vuelca <b>todo</b> de golpe; <code>less</code> permite <b>navegar</b> de forma interactiva; <code>tail -f</code> se queda <b>enganchado al final</b> mostrando las lineas nuevas segun se escriben',
            'c' => '<code>cat</code> es para texto y <code>less</code> para binarios',
            'd' => '<code>tail -f</code> borra el archivo despues de leerlo'
        ],
        'correcta' => 'b',
        'porque'   => 'Con un log de 2 GB, <code>cat</code> te inunda la terminal y <code>less</code> no te muestra lo que esta pasando <b>ahora</b>. Por eso el PDF marca <code>tail -f</code> como vital en DevOps: dejas la ventana abierta, reproduces el error, y ves el stacktrace aparecer en vivo.'
    ],
    'm5' => [
        'texto'    => '&iquest;Por que <code>rm -rf</code> tiene fama de peligroso?',
        'opciones' => [
            'a' => 'Porque es lento',
            'b' => 'Porque borra de forma <b>recursiva y forzada</b>: no pregunta, no avisa y <b>no hay papelera</b>. Combinado con una variable vacia o una ruta mal escrita, se lleva por delante lo que no debia',
            'c' => 'Porque requiere ser root siempre',
            'd' => 'Porque solo funciona en directorios vacios'
        ],
        'correcta' => 'b',
        'porque'   => 'Engancha con el <code>set -u</code> del scripting: <code>rm -rf "$DIR/"</code> con <code>$DIR</code> sin definir se convierte en <code>rm -rf "/"</code>. Costumbre sana: <code>ls</code> primero la ruta que vas a borrar, y en scripts nunca borres una ruta construida sin validarla.'
    ],
    'm6' => [
        'texto'    => '&iquest;Cual es la diferencia entre <code>cp</code> y <code>mv</code>?',
        'opciones' => [
            'a' => 'Son sinonimos',
            'b' => '<code>cp</code> <b>duplica</b> (quedan dos copias); <code>mv</code> <b>mueve</b> — y como efecto secundario es tambien la forma de <b>renombrar</b> un archivo en su mismo directorio',
            'c' => '<code>cp</code> solo funciona con directorios',
            'd' => '<code>mv</code> deja una copia de seguridad automatica'
        ],
        'correcta' => 'b',
        'porque'   => 'No existe un comando <code>rename</code> basico en Unix porque no hace falta: renombrar <b>es</b> mover dentro de la misma carpeta. Y ojo con ambos: por defecto <b>sobrescriben sin preguntar</b> si el destino ya existe (por eso <code>-i</code> en interactivo).'
    ],
    'm7' => [
        'texto'    => 'Vas a crear la ruta <code>proyecto/logs/2026/</code> de una vez con <code>mkdir</code>. &iquest;Que necesitas?',
        'opciones' => [
            'a' => 'Nada, <code>mkdir</code> crea rutas completas por defecto',
            'b' => 'La bandera <code>-p</code>, que crea los directorios <b>padre</b> que falten (y ademas no falla si ya existen — por eso es la forma segura dentro de un script)',
            'c' => 'Ejecutarlo tres veces',
            'd' => 'Permisos de root'
        ],
        'correcta' => 'b',
        'porque'   => 'Sin <code>-p</code>, <code>mkdir</code> falla si el padre no existe <b>y tambien</b> si el directorio ya existe — lo que con <code>set -e</code> aborta tu script en la segunda ejecucion. <code>mkdir -p</code> es idempotente: puedes correrlo mil veces con el mismo resultado.'
    ],
    'm8' => [
        'texto'    => 'En una ruta, &iquest;que diferencia hay entre empezar con <code>/</code> o no?',
        'opciones' => [
            'a' => 'Ninguna, es estilo',
            'b' => 'Con <code>/</code> delante es una ruta <b>absoluta</b>: parte del directorio raiz y significa lo mismo la ejecutes donde la ejecutes. Sin el, es <b>relativa</b> al directorio actual (<code>pwd</code>)',
            'c' => 'Con <code>/</code> la ruta es de solo lectura',
            'd' => 'Sin <code>/</code> la ruta apunta a <code>/home</code>'
        ],
        'correcta' => 'b',
        'porque'   => 'Es una fuente clasica de scripts rotos: funcionan cuando los lanzas a mano desde tu carpeta y fallan en el runner de CI, que arranca en otro directorio. En automatizacion, <b>rutas absolutas</b> o construidas explicitamente desde una variable.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Linux · 1 — Consola y sistema de archivos', 'introduccion_linux.pdf — módulo 1');
?>

<div class="card">
  <h2>Como se usa</h2>
  <p>Las diapositivas de <b>Introduccion a Linux para DevOps</b>, en tres paginas
     siguiendo los cuatro modulos del PDF.</p>
  <div class="nota">Los <b>comandos</b> se escriben tal cual (respetan minusculas y
    banderas); las palabras en castellano no distinguen mayusculas ni tildes.
    Pulsa <b>Enter</b> dentro de un hueco para verificar.</div>
</div>


<div class="card">
  <h2>1. El sistema de archivos</h2>
  <p>En Linux el sistema de archivos es <?php hueco(1, 14); ?> y parte del
     directorio raiz <code><?php hueco(2, 5); ?></code>.</p>

  <table class="datos">
    <tr><th>Directorio</th><th>Que contiene</th></tr>
    <tr><td><code><?php hueco(3, 12); ?></code></td>
        <td>archivos de <b>configuracion</b> del sistema y de los servicios</td></tr>
    <tr><td><code><?php hueco(4, 14); ?></code></td>
        <td><b>logs</b> del sistema operativo y de las aplicaciones</td></tr>
    <tr><td><code><?php hueco(5, 12); ?></code> y
            <code><?php hueco(6, 12); ?></code></td>
        <td>directorios personales de los usuarios y del administrador</td></tr>
  </table>

  <div class="avisoflujo">
    <b>Filosofia Unix.</b> En Linux <b>todo se trata como un
    <?php hueco(7, 12); ?></b> (directorios, hardware, procesos). Esto permite
    manipular configuraciones del sistema operativo con herramientas de
    <?php hueco(8, 14); ?> estandar.
  </div>

  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Navegacion basica</h2>

  <table class="datos">
    <tr><th>Comando</th><th>Que hace</th></tr>
    <tr><td><code><?php hueco(9, 8); ?></code></td><td>muestra la ruta actual</td></tr>
    <tr><td><code><?php hueco(10, 8); ?> [ruta]</code></td><td>cambiar de directorio</td></tr>
    <tr><td><code><?php hueco(11, 10); ?></code></td>
        <td>listar archivos detallados y <?php hueco(12, 10); ?></td></tr>
  </table>

  <h3>Escribelo de memoria</h3>
  <?php linea(25, 'Listar el contenido del directorio actual en formato <b>largo</b> e incluyendo los archivos <b>ocultos</b>.', 'ls ...'); ?>

  <?php mc('m3'); ?>
  <?php mc('m8'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Manejo de archivos</h2>

  <h3>Crear y editar</h3>
  <ul>
    <li><code><?php hueco(13, 10); ?> archivo.txt</code> — crear un archivo vacio.</li>
    <li><code><?php hueco(14, 10); ?> carpetas/</code> — crear directorios.</li>
    <li>Editores en consola: <code><?php hueco(15, 8); ?></code> y
        <code><?php hueco(16, 8); ?></code>.</li>
  </ul>

  <h3>Mover y borrar</h3>
  <ul>
    <li><code><?php hueco(17, 6); ?></code> — copiar.</li>
    <li><code><?php hueco(18, 6); ?></code> — mover o renombrar.</li>
    <li><code><?php hueco(19, 10); ?></code> — eliminar de forma
        <?php hueco(20, 14); ?> y forzada.</li>
  </ul>

  <h3>Visualizacion</h3>
  <ul>
    <li><code><?php hueco(21, 8); ?></code> — mostrar todo el contenido.</li>
    <li><code><?php hueco(22, 8); ?></code> — navegacion interactiva.</li>
    <li><code><?php hueco(23, 10); ?> /var/log/<?php hueco(24, 12); ?></code>
        — monitoreo de logs <b>en tiempo real</b>.</li>
  </ul>

  <div class="nota">
    <b>Depuracion.</b> El comando <code>tail -f</code> es vital en DevOps para observar
    las salidas de error <b>en vivo</b> de tus servidores web o pipelines de despliegue.
  </div>

  <h3>Escribelo de memoria</h3>
  <?php linea(27, 'Crear un archivo vacio llamado <code>archivo.txt</code>.', 'touch ...'); ?>
  <?php linea(26, 'Quedarte enganchado al final del log del sistema, viendo las lineas nuevas en vivo.', 'tail ...'); ?>
  <?php linea(28, 'Borrar el directorio <code>carpeta/</code> completo, de forma recursiva y forzada.', 'rm ...'); ?>

  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php mc('m7'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Menu.php', 'segundo.php');
