<?php
/* ==========================================================================
   IngeSoft5 / DevOps / Sesion 06 — bloque 01: Introduccion y contenedores
   Fuente: sesion_06_introduccion_docker.pdf — modulo 1
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- la matriz del dolor --- */
    1  => ['dependencias'],
    2  => ['brecha'],
    3  => ['transporte'],
    4  => ['empaquetado'],

    /* --- VM vs contenedores --- */
    5  => ['hipervisor'],
    6  => ['hardware'],
    7  => ['huesped'],
    8  => ['completo'],
    9  => ['giga-bytes', 'gigabytes'],
    10 => ['minutos'],
    11 => ['motor de docker', 'docker engine', 'motor'],
    12 => ['so', 'sistema operativo'],
    13 => ['kernel'],
    14 => ['mega-bytes', 'megabytes'],
    15 => ['milisegundos'],
    16 => ['densidad'],

    /* --- kernel de linux --- */
    17 => ['namespaces'],
    18 => ['pid'],
    19 => ['net'],
    20 => ['mnt'],
    21 => ['user'],
    22 => ['cgroups', 'control groups'],
    23 => ['recursos'],
    24 => ['chroot'],
    25 => ['raiz'],
    26 => ['aislado'],
];

$TEXTO = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26];

$MULTIPLE = [
    'm1' => [
        'texto'    => 'La analogia de la diapositiva compara Docker con los <b>contenedores de carga</b>. &iquest;En que consiste la comparacion?',
        'opciones' => [
            'a' => 'En que ambos son de metal y se apilan',
            'b' => 'En la <b>estandarizacion de la interfaz</b>: igual que un contenedor de carga viaja en barco, tren o camion sin importar si lleva cafe o electronica, una imagen Docker se ejecuta en cualquier host sin importar que lleve dentro',
            'c' => 'En que ambos se abren solo en el destino',
            'd' => 'En que ambos se pueden apilar en la nube'
        ],
        'correcta' => 'b',
        'porque'   => 'Lo potente de la analogia es que el valor no esta en la caja, sino en que <b>todo el mundo acordo la misma caja</b>. La grua no necesita saber que transporta; el host no necesita saber si dentro hay Java, Python o Node.'
    ],
    'm2' => [
        'texto'    => 'La diferencia tecnica de fondo entre una VM y un contenedor es que...',
        'opciones' => [
            'a' => 'El contenedor no tiene sistema de archivos',
            'b' => 'La VM virtualiza el <b>hardware completo</b> mediante un hipervisor y corre un SO huesped entero; el contenedor virtualiza a nivel de <b>sistema operativo</b> y <b>comparte el kernel del host</b>, empaquetando solo la app y sus binarios de usuario',
            'c' => 'La VM es mas rapida de arrancar',
            'd' => 'El contenedor necesita mas RAM que la VM'
        ],
        'correcta' => 'b',
        'porque'   => 'De ahi salen todas las demas diferencias, que la diapositiva cuantifica: <b>gigabytes y minutos</b> para arrancar una VM, frente a <b>megabytes y milisegundos</b> para un contenedor. Y por eso el contenedor permite alta <b>densidad</b> de servicios en la misma maquina fisica.'
    ],
    'm3' => [
        'texto'    => 'Si los contenedores <b>comparten el kernel del host</b>, &iquest;puedes correr un contenedor nativo de Windows dentro de un host Linux?',
        'opciones' => [
            'a' => 'Si, Docker lo traduce automaticamente',
            'b' => '<b>No.</b> El contenedor no lleva kernel propio: un binario de Windows necesita las llamadas al sistema del kernel de Windows, que un kernel Linux no ofrece. Para lograrlo hace falta una <b>VM</b> con ese SO en medio',
            'c' => 'Si, pero solo con la bandera <code>--platform</code>',
            'd' => 'Si, siempre que la imagen sea Alpine'
        ],
        'correcta' => 'b',
        'porque'   => 'Pregunta 1 de la discusion. Es tambien la explicacion de <b>Docker Desktop</b> en Windows y macOS: no hay magia, hay una maquina virtual Linux ligera corriendo por debajo. Lo que si puede variar es la <b>arquitectura</b> (ARM/x86) via emulacion, pero el <b>SO del kernel</b> no.'
    ],
    'm4' => [
        'texto'    => 'El contenedor «cree» que sus procesos empiezan en el PID 1 y que su red es solo suya. &iquest;Que caracteristica del kernel lo consigue?',
        'opciones' => [
            'a' => 'Los cgroups',
            'b' => 'Los <b>namespaces</b>: aislan <i>lo que el contenedor ve</i> — procesos (PID), red (NET), sistemas de archivos (MNT) y usuarios (USER)',
            'c' => '<code>chroot</code>',
            'd' => 'El hipervisor'
        ],
        'correcta' => 'b',
        'porque'   => 'Truco para no confundirlas: <b>namespaces = lo que VES</b> (visibilidad), <b>cgroups = lo que PUEDES CONSUMIR</b> (limites). Los procesos del contenedor si existen en el host — un <code>ps</code> del host los ve, con otros PIDs — pero desde dentro el namespace le muestra solo los suyos.'
    ],
    'm5' => [
        'texto'    => 'Quieres que un contenedor no pueda consumir mas de <b>1 GB de RAM y 0.5 CPU</b>. &iquest;Que mecanismo del kernel lo impone?',
        'opciones' => [
            'a' => 'Los namespaces',
            'b' => 'Los <b>Control Groups (cgroups)</b>: limitan los recursos fisicos que un contenedor puede consumir',
            'c' => '<code>chroot</code>',
            'd' => 'El UnionFS'
        ],
        'correcta' => 'b',
        'porque'   => 'Sin cgroups, un contenedor con una fuga de memoria se come la RAM del host y tumba a <b>todos</b> los demas contenedores de esa maquina — el llamado «vecino ruidoso». Es lo que hace viable la alta densidad de servicios.'
    ],
    'm6' => [
        'texto'    => '&iquest;Cual es el peligro de correr todos los procesos de tu aplicacion como <b>root</b> dentro del contenedor?',
        'opciones' => [
            'a' => 'Ninguno, el contenedor aisla completamente',
            'b' => 'Que root dentro del contenedor es, por defecto, el <b>mismo UID 0 del host</b>: si alguien compromete el proceso y encuentra un fallo de escape o un volumen mal montado, ya tiene privilegios maximos sobre la maquina',
            'c' => 'Que consume mas memoria',
            'd' => 'Que Docker no permite arrancar como root'
        ],
        'correcta' => 'b',
        'porque'   => 'Pregunta 2 de la discusion. A diferencia de una VM, aqui <b>no hay hipervisor</b> entre el proceso y el kernel del host: el aislamiento es una funcionalidad del kernel, y las funcionalidades tienen bugs. De ahi la regla del <code>USER appuser</code> que ya viste en el Dockerfile multi-stage.'
    ],
    'm7' => [
        'texto'    => '&iquest;Que hace <code>chroot</code> en este contexto?',
        'opciones' => [
            'a' => 'Da permisos de root al contenedor',
            'b' => '<b>Cambia la raiz</b> del sistema de archivos del proceso hacia el contenedor: lo que el proceso ve como <code>/</code> es en realidad el sistema de archivos de la imagen',
            'c' => 'Limita el uso de CPU',
            'd' => 'Crea la red virtual del contenedor'
        ],
        'correcta' => 'b',
        'porque'   => 'Es el mas antiguo de los tres mecanismos (existe en Unix desde los años 70) y el mas facil de visualizar: el proceso queda «encerrado» en un subarbol del disco y no puede nombrar nada por encima de el. Docker lo combina con namespaces y cgroups; ninguno de los tres por si solo seria suficiente.'
    ],
    'm8' => [
        'texto'    => 'La diapositiva plantea el problema asi: «&iquest;como garantizar que un software se ejecute de forma identica en cualquier entorno?». &iquest;Que responde Docker exactamente?',
        'opciones' => [
            'a' => 'Que instala las mismas versiones en todos los servidores',
            'b' => 'Que empaqueta la aplicacion <b>junto con todas sus dependencias y su entorno de ejecucion</b> en una unidad estandar, de modo que el host solo tiene que aportar el kernel',
            'c' => 'Que obliga a usar el mismo sistema operativo en Dev y Prod',
            'd' => 'Que hace copias de seguridad del servidor'
        ],
        'correcta' => 'b',
        'porque'   => 'Ese es el fin de la <b>matriz del dolor</b>: varias apps con versiones distintas de las mismas librerias peleandose por un servidor, y la brecha del «en mi maquina funciona». No se arregla documentando mejor el entorno: se arregla <b>llevandoselo dentro</b>.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Sesión 6 · 1 — Introducción y contenedores', 'sesion_06_introduccion_docker.pdf — módulo 1: virtualización a nivel de SO');
?>

<div class="card">
  <h2>Como se usa</h2>
  <p>Las diapositivas de la <b>Sesion 6: Introduccion a Docker</b>, en tres paginas
     siguiendo los cuatro modulos del PDF. Complementa a los cuestionarios de Docker
     que ya tienes: aqui va lo que <b>solo</b> esta en estas diapositivas — kernel,
     capas, redes, volumenes y Compose.</p>
  <div class="nota">Respuestas en <b>texto</b>: no importan mayusculas ni tildes.
    Pulsa <b>Enter</b> dentro de un hueco para verificar. Las preguntas de opcion
    multiple llevan explicacion — leelas aunque aciertes.</div>
</div>


<div class="card">
  <h2>1. La matriz del dolor</h2>

  <ul>
    <li><b>El caos clasico:</b> correr multiples aplicaciones con distintas versiones de
        librerias y <?php hueco(1, 14); ?> sobre el mismo servidor fisico.</li>
    <li><b>La <?php hueco(2, 10); ?> «en mi maquina funciona»:</b> diferencias de
        sistemas operativos, variables y dependencias entre Dev, Test y Produccion.</li>
    <li><b>La analogia del contenedor:</b> igual que los contenedores de carga
        estandarizaron el <?php hueco(3, 12); ?> de mercancias (sin importar si es
        cafe o electronica), Docker estandariza el <?php hueco(4, 14); ?> de
        software.</li>
  </ul>

  <div class="avisoflujo">
    <b>El problema.</b> &iquest;Como garantizar que un software se ejecute de forma
    <b>identica</b> en cualquier entorno fisico o en la nube sin importar sus dependencias?
  </div>

  <?php mc('m1'); ?>
  <?php mc('m8'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Maquinas virtuales vs. contenedores</h2>

  <table class="datos">
    <tr><th>Maquinas virtuales (VM)</th><th>Contenedores (Docker)</th></tr>
    <tr>
      <td><b><?php hueco(5, 12); ?>:</b> virtualiza el
          <?php hueco(6, 12); ?> completo.</td>
      <td><b><?php hueco(11, 18); ?>:</b> virtualiza a nivel de
          <?php hueco(12, 8); ?> — comparte el <?php hueco(13, 10); ?>
          del host.</td>
    </tr>
    <tr>
      <td><b>SO <?php hueco(7, 10); ?>:</b> cada VM corre un SO
          <?php hueco(8, 12); ?> — <?php hueco(9, 14); ?> de espacio,
          <?php hueco(10, 10); ?> en arrancar.</td>
      <td><b>Ligero:</b> solo empaqueta la app y sus binarios de usuario —
          <?php hueco(14, 14); ?>, <?php hueco(15, 14); ?> en arrancar.</td>
    </tr>
    <tr>
      <td><b>Aislamiento:</b> fuerte aislamiento de hardware, pero <b>alto consumo</b>
          de recursos.</td>
      <td><b>Eficiencia:</b> alta <?php hueco(16, 12); ?> de servicios en la
          misma maquina fisica.</td>
    </tr>
  </table>

  <?php mc('m2'); ?>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. &iquest;Como funciona? El kernel de Linux</h2>
  <p>Docker no es magia; aprovecha caracteristicas <b>nativas</b> del kernel de Linux.</p>

  <table class="datos">
    <tr><th>Mecanismo</th><th>Que hace</th></tr>
    <tr><td><b><?php hueco(17, 14); ?></b> (aislamiento)</td>
        <td>aislan <b>lo que ve</b> el contenedor: procesos
            (<?php hueco(18, 7); ?>), red (<?php hueco(19, 7); ?>),
            sistemas de archivos (<?php hueco(20, 7); ?>) y usuarios
            (<?php hueco(21, 7); ?>)</td></tr>
    <tr><td><b><?php hueco(22, 14); ?></b> (limites)</td>
        <td>limitan los <?php hueco(23, 12); ?> fisicos que puede consumir un
            contenedor (p. ej. maximo 1 GB de RAM y 0.5 CPU)</td></tr>
    <tr><td><b><?php hueco(24, 12); ?></b></td>
        <td>cambia la <?php hueco(25, 8); ?> del sistema de archivos del proceso
            al contenedor</td></tr>
  </table>

  <div class="avisoflujo">
    <b>Aislamiento.</b> Los namespaces y cgroups permiten que un contenedor actue como un
    entorno <?php hueco(26, 10); ?> e independiente, <b>compartiendo la velocidad
    del kernel anfitrion</b>.
  </div>

  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
  <?php mc('m7'); ?>
  <?php mc('m6'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Menu.php', 'segundo.php');
