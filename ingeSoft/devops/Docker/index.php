<?php
/* ==========================================================================
   IngeSoft5 / DevOps / Docker — parte 1: contenedores
   Fuente: DevOps-Containers.pdf y Dev-Ops – cloud ed.pdf
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- despliegue tradicional --- */
    1  => ['sistema operativo', 'so', 'os'],
    2  => ['hardware'],
    3  => ['red'],
    4  => ['tiempo'],

    /* --- los cuatro problemas --- */
    5  => ['portability', 'portabilidad'],
    6  => ['scalability', 'escalabilidad'],
    7  => ['consistency', 'consistencia'],
    8  => ['fast deployment', 'despliegue rapido', 'velocidad de despliegue'],

    /* --- contenerizacion --- */
    9  => ['estandar', 'estandares'],
    10 => ['dependencias'],
    11 => ['igual', 'de la misma forma', 'de la misma manera'],
    12 => ['entorno', 'ambiente'],
    13 => ['imagen', 'imagenes'],
    14 => ['inmutable'],
    15 => ['recreacion', 'recrear', 'volver a crear'],
    16 => ['runtime', 'runtimes', 'container runtime'],

    /* --- docker --- */
    17 => ['engine', 'docker engine'],
    18 => ['kernel'],
    19 => ['ligero', 'lightweight'],
    20 => ['aislamiento', 'isolation'],
    21 => ['podman'],
    22 => ['containerd'],

    /* --- docker vs hypervisor --- */
    23 => ['completo'],
    24 => ['aplicaciones'],
    25 => ['estatica', 'estaticamente'],
    26 => ['dinamica', 'dinamicamente'],
    27 => ['minuto'],
    28 => ['segundos'],
    29 => ['agnostico', 'agnosticos'],
    30 => ['linux'],

    /* --- docker y devops --- */
    31 => ['velocidad', 'speed'],
    32 => ['agilidad', 'agility'],
    33 => ['recursos'],
    34 => ['errores'],
    35 => ['estandarizacion', 'standardization'],

    /* --- cloud --- */
    36 => ['on demand self-service', 'autoservicio bajo demanda', 'on-demand self-service'],
    37 => ['broad network access', 'acceso amplio a la red'],
    38 => ['resource pooling', 'agrupacion de recursos'],
    39 => ['rapid elasticity', 'elasticidad rapida'],
    40 => ['measured service', 'servicio medido'],
    41 => ['iaas'],
    42 => ['paas'],
    43 => ['saas'],
];

$TEXTO = range(1, 43);

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Segun las diapositivas, &iquest;cual es el problema del despliegue tradicional?',
        'opciones' => [
            'a' => 'Que es imposible de controlar',
            'b' => 'Que se construye y despliega para un <b>sistema operativo, hardware y red concretos</b>, lo que lo hace familiar y controlable pero mucho mas lento que los contenedores',
            'c' => 'Que no permite usar bases de datos',
            'd' => 'Que solo funciona en Linux'
        ],
        'correcta' => 'b',
        'porque'   => 'Fijate que las diapositivas <b>no</b> dicen que el despliegue tradicional sea malo: dicen que es familiar, personalizable y controlable. Lo que pesa es el tiempo.'
    ],
    'm2' => [
        'texto'    => '&iquest;Que significa que un contenedor sea <b>inmutable</b>?',
        'opciones' => [
            'a' => 'Que no se puede borrar',
            'b' => 'Que para cambiar algo hay que <b>recrear</b> el contenedor, no modificarlo por dentro',
            'c' => 'Que la imagen no se puede descargar dos veces',
            'd' => 'Que no admite variables de entorno'
        ],
        'correcta' => 'b',
        'porque'   => 'Es la misma idea que viste en los smart contracts: si el artefacto no cambia, el comportamiento es reproducible. Por eso se arregla el Dockerfile y se reconstruye, no se entra al contenedor a parchear.'
    ],
    'm3' => [
        'texto'    => '&iquest;Cual es la diferencia entre una <b>imagen</b> y un <b>contenedor</b>?',
        'opciones' => [
            'a' => 'Son sinonimos',
            'b' => 'La imagen es el <b>paquete</b> (codigo, valores por defecto, runtimes, librerias del sistema); el contenedor es una <b>instancia en ejecucion</b> de esa imagen',
            'c' => 'La imagen corre y el contenedor se guarda',
            'd' => 'La imagen es para Linux y el contenedor para Windows'
        ],
        'correcta' => 'b',
        'porque'   => 'La analogia habitual: la imagen es la <b>clase</b> y el contenedor es el <b>objeto</b>. De una imagen puedes levantar veinte contenedores.'
    ],
    'm4' => [
        'texto'    => 'Docker es &laquo;ligero&raquo; comparado con una maquina virtual. &iquest;Por que exactamente?',
        'opciones' => [
            'a' => 'Porque los contenedores estan comprimidos',
            'b' => 'Porque <b>comparten el kernel del sistema operativo anfitrion</b>: no necesitan un SO completo dentro, lo que reduce servidores y costos de licencias',
            'c' => 'Porque no guardan datos',
            'd' => 'Porque usan menos disco al descargarse'
        ],
        'correcta' => 'b',
        'porque'   => 'Ese es el corazon de la comparacion contra el hypervisor: la VM lleva un SO entero dentro; el contenedor solo lleva la app y sus dependencias.'
    ],
    'm5' => [
        'texto'    => 'Hypervisor vs Docker, en cuanto a <b>memoria</b>:',
        'opciones' => [
            'a' => 'Los dos la asignan dinamicamente',
            'b' => 'El hypervisor asigna memoria de forma <b>estatica</b> a cada SO; Docker la asigna de forma <b>dinamica</b> a cada aplicacion',
            'c' => 'Docker la asigna estaticamente',
            'd' => 'Ninguno de los dos gestiona memoria'
        ],
        'correcta' => 'b',
        'porque'   => 'Es la razon practica de que quepan muchos mas contenedores que VMs en la misma maquina: nadie reserva RAM que no esta usando.'
    ],
    'm6' => [
        'texto'    => 'Hypervisor vs Docker, en <b>tiempo de arranque</b>:',
        'opciones' => [
            'a' => 'Los dos tardan lo mismo',
            'b' => 'El hypervisor puede tardar hasta un <b>minuto</b> en cargar el SO; un contenedor se crea en <b>segundos</b>, casi instantaneo',
            'c' => 'Docker tarda mas porque descarga la imagen',
            'd' => 'Depende solo del disco'
        ],
        'correcta' => 'b',
        'porque'   => 'Y de ahi sale el beneficio DevOps: si levantar el entorno cuesta segundos, puedes recrearlo en cada build en vez de mantenerlo a mano.'
    ],
    'm7' => [
        'texto'    => 'Hypervisor vs Docker, en <b>soporte de sistemas operativos</b>:',
        'opciones' => [
            'a' => 'Docker soporta mas sistemas que el hypervisor',
            'b' => 'Los hypervisors son <b>agnosticos</b> del SO (Windows, Mac, Linux); Docker es <b>Linux</b> (con soporte de Windows como caso aparte)',
            'c' => 'Los dos son solo para Linux',
            'd' => 'Los dos son agnosticos'
        ],
        'correcta' => 'b',
        'porque'   => 'Por eso Docker Desktop en Windows y Mac corre una VM Linux por debajo. Es la limitacion que la diapositiva marca con un asterisco.'
    ],
    'm8' => [
        'texto'    => '&iquest;Docker es la unica forma de usar contenedores?',
        'opciones' => [
            'a' => 'Si, es la unica tecnologia',
            'b' => 'No: hay alternativas como Podman, LXD, containerd, Buildah, BuildKit, Kaniko y runC. Docker es el <b>estandar de la industria</b>, no el unico',
            'c' => 'No, pero las alternativas no son compatibles',
            'd' => 'Si, las demas son para maquinas virtuales'
        ],
        'correcta' => 'b',
        'porque'   => 'Detalle util: Docker por dentro usa <b>containerd</b> como runtime, y containerd usa <b>runC</b>. Son capas, no competidores directos.'
    ],
    'm9' => [
        'texto'    => 'De las cinco caracteristicas de la nube, &iquest;cual describe que puedas pedir recursos sin hablar con nadie?',
        'opciones' => [
            'a' => 'Broad network access',
            'b' => 'On demand self-service',
            'c' => 'Resource pooling',
            'd' => 'Measured service'
        ],
        'correcta' => 'b',
        'porque'   => '<em>Self-service</em>: tu levantas la maquina desde un panel o una API, sin abrir un ticket ni esperar a que alguien te la aprovisione.'
    ],
    'm10' => [
        'texto'    => 'Alquilas maquinas virtuales y gestionas tu mismo el SO y todo lo que va encima. &iquest;Que modelo de servicio es?',
        'opciones' => [
            'a' => 'SaaS',
            'b' => 'PaaS',
            'c' => 'IaaS',
            'd' => 'Ninguno'
        ],
        'correcta' => 'c',
        'porque'   => '<b>IaaS</b> = te dan la infraestructura (computo, red, almacenamiento). <b>PaaS</b> = te dan la plataforma y tu solo subes codigo. <b>SaaS</b> = te dan el software terminado (Gmail, Moodle).'
    ],
    'm11' => [
        'texto'    => '&iquest;Por que se dice que &laquo;la nube acelera DevOps&raquo;?',
        'opciones' => [
            'a' => 'Porque el internet es mas rapido',
            'b' => 'Porque la elasticidad y el autoservicio permiten crear y destruir entornos identicos en minutos, que es justo lo que necesitan la integracion y el despliegue continuos',
            'c' => 'Porque los servidores en la nube tienen mejor CPU',
            'd' => 'Porque elimina la necesidad de pruebas'
        ],
        'correcta' => 'b',
        'porque'   => 'Sin infraestructura bajo demanda, cada entorno de pruebas es un servidor que alguien tiene que montar a mano. Ese es el cuello de botella que la nube quita.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Docker · 1 — contenedores', 'DevOps-Containers.pdf y Dev-Ops – cloud ed.pdf');
?>

<div class="card">
  <h2>Como se usa</h2>
  <p>La teoria de las diapositivas de contenedores y de nube. En esta pagina las respuestas
     son <b>texto</b>: no importan mayusculas ni tildes, y varias se aceptan en español o en ingles.</p>
  <div class="nota">En la <b>parte 2</b> esta lo practico: el Dockerfile linea por linea y los
    comandos del taller.</div>
</div>


<div class="card">
  <h2>1. El despliegue tradicional</h2>

  <p>Una aplicacion tradicional se construye y despliega para un
     <?php hueco(1, 18); ?>, un <?php hueco(2, 12); ?> y una
     configuracion de <?php hueco(3, 8); ?> concretos.</p>

  <p>Las diapositivas reconocen que eso es <b>familiar, personalizable y controlable</b> —
     pero consume mucho mas <?php hueco(4, 10); ?> que los contenedores.</p>

  <h3>Los cuatro problemas</h3>
  <table class="datos">
    <tr><th>Problema</th><th>En una linea</th></tr>
    <tr><td><?php hueco(5, 16); ?></td><td>lo que corre en tu maquina no corre igual en la del servidor</td></tr>
    <tr><td><?php hueco(6, 16); ?></td><td>añadir instancias es lento y manual</td></tr>
    <tr><td><?php hueco(7, 16); ?></td><td>desarrollo, pruebas y produccion acaban siendo distintos</td></tr>
    <tr><td><?php hueco(8, 20); ?></td><td>cada despliegue cuesta horas en vez de minutos</td></tr>
  </table>

  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Contenerizacion</h2>

  <p>Empaqueta el software en unidades <?php hueco(9, 12); ?> para desarrollo,
     construccion y despliegue. Empaqueta el codigo <b>junto con todas sus</b>
     <?php hueco(10, 14); ?>, de modo que el software siempre corra
     <?php hueco(11, 12); ?>, sin importar el <?php hueco(12, 12); ?>.</p>

  <p>Una <b><?php hueco(13, 12); ?> de contenedor</b> incluye el codigo, los valores
     por defecto, los runtimes, las aplicaciones y las librerias del sistema.</p>

  <p>El contenedor es <?php hueco(14, 12); ?>: cambiar algo exige la
     <?php hueco(15, 14); ?> del contenedor, no modificarlo por dentro.</p>

  <p>Y el software que ejecuta los contenedores se llama
     <b>container <?php hueco(16, 12); ?></b>.</p>

  <?php mc('m2'); ?>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Docker</h2>

  <p>Los contenedores de Docker usan un <b>Docker <?php hueco(17, 10); ?></b>.
     Sus tres caracteristicas segun la diapositiva:</p>

  <table class="datos">
    <tr><th>Caracteristica</th><th>Que significa</th></tr>
    <tr><td>Standard</td><td>es el estandar de la industria para contenedores</td></tr>
    <tr><td><?php hueco(19, 14); ?></td><td>comparten el <?php hueco(18, 10); ?> del sistema operativo: no necesitan un SO completo, lo que reduce servidores y licencias</td></tr>
    <tr><td>Secure</td><td>aplicaciones mas seguras, mejor <?php hueco(20, 14); ?></td></tr>
  </table>

  <p>Docker soporta la construccion, ejecucion e inspeccion de codigo, y gestiona las
     imagenes. Pero no es el unico: entre las alternativas estan
     <?php hueco(21, 12); ?>, LXD, <?php hueco(22, 14); ?>,
     Buildah, BuildKit, Kaniko y runC.</p>

  <?php mc('m4'); ?>
  <?php mc('m8'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Docker vs Hypervisor</h2>
  <p>Los cuatro ejes de comparacion de la diapositiva. Esta tabla cae en el parcial.</p>

  <table class="datos">
    <tr><th>Eje</th><th>Hypervisor</th><th>Docker</th></tr>
    <tr><td>Instancias soportadas</td>
        <td>multiples instancias de un SO <?php hueco(23, 12); ?></td>
        <td>multiples instancias de las mismas o distintas <?php hueco(24, 14); ?> sobre el mismo SO</td></tr>
    <tr><td>Memoria</td>
        <td>asignada de forma <?php hueco(25, 12); ?> a cada SO</td>
        <td>asignada de forma <?php hueco(26, 12); ?> a cada aplicacion</td></tr>
    <tr><td>Arranque</td>
        <td>hasta un <?php hueco(27, 10); ?> en cargar el SO</td>
        <td>creado en <?php hueco(28, 12); ?>, casi instantaneo</td></tr>
    <tr><td>Soporte de SO</td>
        <td><?php hueco(29, 12); ?>: Windows, Mac y Linux</td>
        <td>solo <?php hueco(30, 10); ?> (Windows con asterisco)</td></tr>
  </table>

  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php mc('m7'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Docker y DevOps</h2>
  <p>Los siete beneficios de la diapositiva:</p>

  <ul>
    <li><?php hueco(31, 12); ?></li>
    <li><?php hueco(32, 12); ?></li>
    <li>Eficiencia de <?php hueco(33, 12); ?></li>
    <li>Reduccion de <?php hueco(34, 12); ?></li>
    <li>Control de versiones integrado</li>
    <li><?php hueco(35, 18); ?></li>
    <li>Multiplataforma</li>
  </ul>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. La nube (Dev-Ops – cloud ed)</h2>
  <p>Las <b>cinco caracteristicas</b> que definen a la nube:</p>

  <table class="datos">
    <tr><th>Caracteristica</th><th>En una linea</th></tr>
    <tr><td><?php hueco(36, 26); ?></td><td>pides recursos tu mismo, sin intervencion humana</td></tr>
    <tr><td><?php hueco(37, 26); ?></td><td>accesible por red desde cualquier dispositivo</td></tr>
    <tr><td><?php hueco(38, 24); ?></td><td>los recursos fisicos se comparten entre muchos clientes</td></tr>
    <tr><td><?php hueco(39, 24); ?></td><td>crece y decrece rapido segun la demanda</td></tr>
    <tr><td><?php hueco(40, 24); ?></td><td>se mide el consumo y se paga por lo usado</td></tr>
  </table>

  <p>Y los tres <b>modelos de servicio</b>:</p>
  <table class="datos">
    <tr><th>Sigla</th><th>Que te dan</th><th>Ejemplo</th></tr>
    <tr><td><?php hueco(41, 10); ?></td><td>Infrastructure as a Service: computo, red y almacenamiento</td><td>una VM en AWS EC2</td></tr>
    <tr><td><?php hueco(42, 10); ?></td><td>Platform as a Service: la plataforma, tu solo subes codigo</td><td>Heroku, App Engine</td></tr>
    <tr><td><?php hueco(43, 10); ?></td><td>Software as a Service: el software terminado</td><td>Gmail, Moodle</td></tr>
  </table>

  <div class="nota"><b>Otras features de la nube</b> que lista la diapositiva:
    virtualizacion (crear y cargar), IP y DNS, entorno distribuido, tiempo y fallos,
    y consistencia.</div>

  <?php mc('m9'); ?>
  <?php mc('m10'); ?>
  <?php mc('m11'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../GitBash/segundo.php', 'segundo.php');
