<?php
/* ==========================================================================
   IngeSoft5 / DevOps / Sesion 11 — bloque 01: Fundamentos y ventajas de la nube
   Fuente: sesion_11_computacion_nube_patrones.pdf
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- NIST --- */
    1  => ['nist', 'nist sp 800-145'],
    2  => ['800-145'],
    3  => ['Modelo para habilitar acceso ubicuo'],
    4  => ['demanda', 'bajo demanda'],
    5  => ['pool compartido de recursos computacionales', 'pool', 'compartido'],

    /* --- las 5 caracteristicas --- */
    6  => ['autoservicio bajo demanda', 'autoservicio'],
    7  => ['humana'],
    8  => ['acceso amplio a la red', 'acceso amplio', 'broad network access'],
    9  => ['estandar', 'estandares'],
    10 => ['agrupacion de recursos (pooling)', 'pooling', 'agrupacion'],
    11 => ['multi-tenancy', 'multitenancy'],
    12 => ['aislamiento'],
    13 => ['rapida elasticidad', 'elasticidad'],
    14 => ['automaticamente'],
    15 => ['servicio medido', 'medido'],
    16 => ['consumo real', 'consumo'],

    /* --- modelos de despliegue --- */
    17 => ['publica'],
    18 => ['hiperescaladores'],
    19 => ['privada'],
    20 => ['openstack'],
    21 => ['hibrida'],
    22 => ['on-premise', 'on premise'],
    23 => ['multi-cloud', 'multicloud'],
    24 => ['dependencia'],

    /* --- CapEx / OpEx --- */
    25 => ['capex'],
    26 => ['opex'],
    27 => ['pay-as-you-go', 'pay as you go'],
    28 => ['economias de escala', 'economias'],

    /* --- escalabilidad vs elasticidad --- */
    29 => ['vertical', 'scale-up'],
    30 => ['horizontal', 'scale-out'],
    31 => ['balanceador'],
    32 => ['limites fisicos', 'limites'],
    33 => ['auto-scaling', 'autoscaling', 'auto scaling'],
    34 => ['scale-in'],
    35 => ['ociosas'],

    /* --- alta disponibilidad --- */
    36 => ['regiones'],
    37 => ['zonas de disponibilidad', 'azs', 'az'],
    38 => ['redundantes'],
    39 => ['multi-az', 'multi az'],
    40 => ['ganado'],
    41 => ['mascotas'],

    /* --- principio de la grafica --- */
    42 => ['demanda'],
    43 => ['ocioso'],

    44 => ['La virtualizacion avanzada garantiza'],
    45 => ['diferentes organizaciones coexistan'],
    46 => ['forma segura sobre los mismos centros de datos'],
    47 => ['la nube transforma servidores fisicos en servicios logicos programables'],

    48 => ['Permite a startups y equipos agiles competir'],
    49 => ['areas geograficas independientes en el mundo'],
    50 => ['ocioso'],

    ];

$TEXTO = range(1, 43);

$MULTIPLE = [
    'm1' => [
        'texto'    => 'De las caracteristicas esenciales del NIST, &iquest;cual es la que hace que <b>no tengas que abrir un ticket</b> ni hablar con nadie para levantar un servidor?',
        'opciones' => [
            'a' => 'Acceso amplio a la red',
            'b' => 'Autoservicio bajo demanda',
            'c' => 'Agrupacion de recursos',
            'd' => 'Servicio medido'
        ],
        'correcta' => 'b',
        'porque'   => 'La definicion dice literalmente &laquo;<b>sin interaccion humana</b> con el proveedor&raquo;. Es lo que permite que un pipeline de CI/CD cree infraestructura por si solo: no hay una persona en el medio aprobando.'
    ],
 
    'm3' => [
        'texto'    => 'Tu empresa quiere conectar su datacenter propio con AWS por VPN. &iquest;Que modelo de despliegue es?',
        'opciones' => [
            'a' => 'Nube publica',
            'b' => 'Nube privada',
            'c' => 'Nube hibrida',
            'd' => 'Multi-cloud'
        ],
        'correcta' => 'c',
        'porque'   => 'Ojo con no confundir <b>hibrida</b> (on-premise + nube publica, federados) con <b>multi-cloud</b> (varios proveedores de nube, para no depender de uno solo).'
    ],
    'm4' => [
        'texto'    => 'Una startup no compra servidores y paga solo por lo que consume. &iquest;Que transformacion economica describe eso?',
        'opciones' => [
            'a' => 'De OpEx a CapEx',
            'b' => 'De <b>CapEx</b> (inversion de capital inicial) a <b>OpEx</b> (gasto operativo variable, proporcional al uso)',
            'c' => 'De costo fijo a costo hundido',
            'd' => 'De licencia perpetua a suscripcion'
        ],
        'correcta' => 'b',
        'porque'   => 'Y la consecuencia estrategica es la frase de la diapositiva: permite que una startup compita con una corporacion usando infraestructura de nivel mundial <b>desde el dia 1</b>, sin capital.'
    ],
    'm5' => [
        'texto'    => 'Tu servidor va lento y le añades mas CPU y RAM a la misma maquina. &iquest;Que hiciste?',
        'opciones' => [
            'a' => 'Escalamiento horizontal (scale-out)',
            'b' => 'Escalamiento vertical (scale-up): tiene limites fisicos y normalmente exige una parada',
            'c' => 'Elasticidad',
            'd' => 'Auto-scaling'
        ],
        'correcta' => 'b',
        'porque'   => 'Truco visual: <b>vertical</b> = la maquina crece hacia arriba (mas grande). <b>Horizontal</b> = pones mas maquinas al lado (mas replicas). La vertical siempre choca contra un techo fisico; la horizontal es practicamente ilimitada.'
    ],
    'm6' => [
        'texto'    => '&iquest;Cual es la diferencia entre <b>escalabilidad</b> y <b>elasticidad</b>?',
        'opciones' => [
            'a' => 'Son sinonimos',
            'b' => 'Escalabilidad es la <b>capacidad maxima</b> que puedes alcanzar; elasticidad es la <b>adaptacion dinamica</b>: subir y bajar replicas solo, en tiempo real, segun la carga',
            'c' => 'Escalabilidad es para CPU y elasticidad para almacenamiento',
            'd' => 'La elasticidad solo baja recursos, nunca los sube'
        ],
        'correcta' => 'b',
        'porque'   => 'Un sistema puede ser escalable pero nada elastico: aguanta 100 servidores, pero alguien tiene que encenderlos a mano. La elasticidad es que se enciendan y se apaguen solos.'
    ],
    'm7' => [
        'texto'    => 'De noche baja el trafico y se apagan instancias automaticamente. &iquest;Como se llama eso?',
        'opciones' => [
            'a' => 'Scale-up',
            'b' => 'Scale-in: apagado automatico de instancias ociosas para recortar costos',
            'c' => 'Bulkhead',
            'd' => 'Fail-fast'
        ],
        'correcta' => 'b',
        'porque'   => 'Es la mitad que la gente olvida. Escalar hacia arriba lo hace todo el mundo; el ahorro real esta en <b>escalar hacia abajo</b> cuando nadie esta usando el sistema.'
    ],
    'm8' => [
        'texto'    => 'Mirando la grafica de capacidad vs. demanda, &iquest;cual es el problema del on-premise sobredimensionado?',
        'opciones' => [
            'a' => 'Que se queda corto en los picos',
            'b' => 'Que la capacidad es <b>fija</b>: toda la franja entre esa linea plana y la demanda real es <b>desperdicio financiero</b> — servidores encendidos que nadie usa',
            'c' => 'Que consume mucha red',
            'd' => 'Que no permite backups'
        ],
        'correcta' => 'b',
        'porque'   => 'El principio cloud de la diapositiva: <b>la capacidad persigue a la demanda</b>. En vez de comprar para el pico del año, pagas por la curva real.'
    ],
    'm9' => [
        'texto'    => '&iquest;Cual es la diferencia entre una <b>Region</b> y una <b>Zona de Disponibilidad</b>?',
        'opciones' => [
            'a' => 'Ninguna, son sinonimos',
            'b' => 'La Region es un area geografica del mundo, aislada de las demas; una AZ es un <b>datacenter fisico independiente</b> dentro de esa region, con energia y red redundantes',
            'c' => 'La AZ es mas grande que la Region',
            'd' => 'La Region es logica y la AZ es virtual'
        ],
        'correcta' => 'b',
        'porque'   => 'Jerarquia: Region &gt; varias AZs &gt; datacenters. Desplegar <b>Multi-AZ</b> te da tolerancia automatica a que se caiga un datacenter entero — un incendio, un corte de energia.'
    ],
    'm10' => [
        'texto'    => 'La analogia de <b>mascotas vs. ganado</b> dice que en la nube las instancias son...',
        'opciones' => [
            'a' => 'Mascotas: cada una tiene nombre y se cura cuando se enferma',
            'b' => 'Ganado: <b>descartables y recreables por codigo</b>. Si una falla, no la reparas: la matas y creas otra',
            'c' => 'Mascotas, porque hay que cuidarlas',
            'd' => 'Depende del proveedor'
        ],
        'correcta' => 'b',
        'porque'   => 'Es un cambio de mentalidad, no una tecnica. Si entras por SSH a arreglar un servidor a mano, lo estas tratando como mascota — y ese servidor se vuelve irreproducible. Engancha directo con Infraestructura como Codigo.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Sesión 11 · 1 — Fundamentos y ventajas de la nube', 'sesion_11_computacion_nube_patrones.pdf — bloque 01');
?>

<div class="card">
  <h2>Como se usa</h2>
  <p>Los cuatro bloques de la sesion, uno por pagina, en el orden del PDF. Las definiciones
     estan escritas <b>completas</b>, con las palabras clave en blanco.</p>
  <div class="nota">Respuestas en <b>texto</b>: no importan mayusculas ni tildes.
    Pulsa <b>Enter</b> dentro de un hueco para verificar. Las preguntas de opcion multiple
    llevan explicacion — leelas aunque aciertes.</div>
</div>


<div class="card">
  <h2>1. Que es la computacion en la nube</h2>
  <p>Segun el estandar formal <?php hueco(1, 10); ?> SP <?php hueco(2, 10); ?>:</p>

  <div class="avisoflujo">
    <b>Definicion esencial.</b>   <?php hueco(3, 36); ?>
    y bajo <?php hueco(4, 10); ?> a un <?php hueco(5, 44); ?>
     .
  </div>

  <ul>
    <li><b><?php hueco(6, 25); ?>:</b> provision autonoma de computo y
        almacenamiento <b>sin interaccion <?php hueco(7, 10); ?></b> con el
        proveedor.</li>
    <li><b><?php hueco(8, 22); ?>:</b> capacidades disponibles en la red mediante
        mecanismos <?php hueco(9, 12); ?> (APIs REST, HTTPS).</li>
  </ul>

  <p>Paradigma Cloud: 
  <?php hueco(47, 70); ?>  
   , automatizables mediante codigo y pipelines de CI/CD.</p>

  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Caracteristicas operativas esenciales</h2>

  <table class="datos">
    <tr><th>Caracteristica</th><th>Que significa</th></tr>
    <tr><td><?php hueco(10, 31); ?></td>
        <td><?php hueco(11, 16); ?> dinamico: varios clientes comparten hardware
            con estricto <?php hueco(12, 14); ?></td></tr>
    <tr><td><?php hueco(13, 20); ?></td>
        <td>aprovisionar y liberar recursos <?php hueco(14, 16); ?>
            segun las fluctuaciones de carga</td></tr>
    <tr><td><?php hueco(15, 18); ?></td>
        <td>monitoreo transparente con cobro por segundo o minuto segun el
            <?php hueco(16, 14); ?> (CPU, RAM, GB transferidos)</td></tr>
  </table>

  <?php mc('m2'); ?>

      <h3>Multi-Tenancy</h3>
<p>
<?php hueco(44, 36); ?>    
  que 
  <?php hueco(45, 36); ?>  
    de
  <?php hueco(46, 47); ?>  
 .</p>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Modelos de despliegue</h2>

  <table class="datos">
    <tr><th>Modelo</th><th>Que es</th></tr>
    <tr><td>Nube <?php hueco(17, 12); ?></td>
        <td>infraestructura compartida operada por <?php hueco(18, 18); ?>
            (AWS, Azure, GCP)</td></tr>
    <tr><td>Nube <?php hueco(19, 12); ?></td>
        <td>infraestructura dedicada exclusivamente a una sola empresa
            (<?php hueco(20, 14); ?>)</td></tr>
    <tr><td>Nube <?php hueco(21, 12); ?></td>
        <td>conexion federada entre centros de datos <?php hueco(22, 14); ?>
            y nube publica, via VPN o Direct Connect</td></tr>
    <tr><td><?php hueco(23, 14); ?></td>
        <td>distribucion de cargas entre <b>varios proveedores</b> para mitigar la
            <?php hueco(24, 14); ?> y las caidas globales</td></tr>
  </table>
 
  <?php mc('m3'); ?>
 

 
  <?php enviar(); ?>
</div>


<div class="card">
    <h4>Transformacion del modelo economico del
software:
</h4>
  <h6>4. La ventaja financiera: de CapEx a OpEx</h6>

  <ul>
    <li><b>Eliminacion de <?php hueco(25, 10); ?>:</b> cero inversion de capital
        inicial en servidores fisicos, racks ni licencias perpetuas.</li>
    <li><b>Transicion a <?php hueco(26, 10); ?>:</b> gasto operativo variable
        proporcional al uso real del negocio (<?php hueco(27, 18); ?>).</li>
    <li><b><?php hueco(28, 22); ?>:</b> los proveedores compran millones de
        componentes y trasladan precios bajos al usuario.</li>
  </ul>

  <div class="nota"><b>Eficiencia financiera.</b> 
  <?php hueco(48, 44); ?>
   
    con corporaciones usando infraestructura de nivel mundial desde el dia 1.</div>

  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Escalabilidad vs. elasticidad</h2>
  <p>No son lo mismo, y es una pregunta clasica de parcial.</p>

  <table class="datos">
    <tr><th>Escalabilidad — capacidad maxima</th><th>Elasticidad — adaptacion dinamica</th></tr>
    <tr>
      <td><b>Escalamiento <?php hueco(29, 12); ?> (scale-up):</b> añadir mas CPU y
          RAM a la misma maquina. Tiene <?php hueco(32, 16); ?> y causa paradas.</td>
      <td><b><?php hueco(33, 14); ?> automatico:</b> variacion de replicas en
          tiempo real ante metricas de trafico o latencia.</td>
    </tr>
    <tr>
      <td><b>Escalamiento <?php hueco(30, 14); ?> (scale-out):</b> sumar replicas
          identicas detras de un <?php hueco(31, 14); ?>. Practicamente ilimitado.</td>
      <td><b><?php hueco(34, 12); ?>:</b> apagado automatico de instancias
          <?php hueco(35, 12); ?> para recortar costos de noche o en baja demanda.</td>
    </tr>
  </table>

  <div class="avisoflujo">
    <b>El principio cloud.</b> La capacidad <b>persigue a la
    <?php hueco(42, 12); ?></b>, eliminando el coste del hardware
    <?php hueco(43, 10); ?>.
  </div>

  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php mc('m7'); ?>
  <?php mc('m8'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Alta disponibilidad y resiliencia global</h2>
  <p>La infraestructura fisica de los proveedores es jerarquica:</p>

  <table class="datos">
    <tr><th>Nivel</th><th>Que es</th></tr>
    <tr><td><?php hueco(36, 14); ?></td>
        <td><?php hueco(49, 44); ?> , aisladas para evitar fallos simultaneos</td></tr>
    <tr><td><?php hueco(37, 22); ?></td>
        <td>centros de datos fisicos independientes, con energia y red
            <?php hueco(38, 14); ?></td></tr>
    <tr><td>Despliegue <?php hueco(39, 12); ?></td>
        <td>tolerancia a fallos automatica ante la caida completa de un datacenter fisico</td></tr>
  </table>

  <div class="avisoflujo">
    <b>Mascotas vs. ganado.</b> En la nube tratamos a las instancias como
    <?php hueco(40, 12); ?> — descartables y recreables por codigo — nunca como
    <?php hueco(41, 12); ?> artesanales.
  </div>

  <?php mc('m9'); ?>
  <?php mc('m10'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Menu.php', 'segundo.php');
