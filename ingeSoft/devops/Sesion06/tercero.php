<?php
/* ==========================================================================
   IngeSoft5 / DevOps / Sesion 06 — bloque 03: Redes, volumenes y Compose
   Fuente: sesion_06_introduccion_docker.pdf — modulos 3 y 4 + discusion
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- redireccion de puertos --- */
    1  => ['accesibles'],
    2  => ['-p', 'p'],
    3  => ['host', 'anfitrion'],
    4  => ['contenedor'],
    5  => ['8080'],
    6  => ['3000'],
    7  => ['nat'],
    8  => ['kernel'],

    /* --- drivers de red --- */
    9  => ['bridge'],
    10 => ['subred'],
    11 => ['host'],
    12 => ['aislamiento'],
    13 => ['none'],

    /* --- dns --- */
    14 => ['nombre'],
    15 => ['personalizada', 'propia'],
    16 => ['dns'],
    17 => ['hostname'],
    18 => ['27017'],

    /* --- volumenes --- */
    19 => ['/var/lib/docker/volumes'],
    20 => ['accidentales'],
    21 => ['persistentes'],
    22 => ['bind mounts', 'bind mount'],
    23 => ['arbitrario'],
    24 => ['desarrollo'],
    25 => ['portabilidad'],

    /* --- compose --- */
    26 => ['yaml'],
    27 => ['docker-compose.yml'],
    28 => ['services'],
    29 => ['5000'],
    30 => ['depends_on', 'depends on'],
    31 => ['volumes'],
    32 => ['networks'],
    33 => ['orden'],

    /* --- conclusiones --- */
    34 => ['consistencia'],
    35 => ['git'],
    36 => ['efimeros'],
    37 => ['codigo'],

    /* --- lineas completas --- */
    38 => 'docker run -d -p 8080:3000 mi-app-web',
    39 => 'docker network create mi-red-devops',
    40 => 'docker run -d --name db --network mi-red-devops mongo',
    41 => 'docker compose up -d',
];

$TEXTO = [1,3,4,7,8,9,10,11,12,13,14,15,16,17,20,21,22,23,24,25,26,28,30,31,32,33,34,35,36,37];

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Corres <code>docker run -d -p 8080:3000 mi-app-web</code>. &iquest;Que significan esos numeros?',
        'opciones' => [
            'a' => '8080 es el puerto del contenedor y 3000 el del host',
            'b' => '<b>8080 es el puerto del host y 3000 el del contenedor</b> (<code>-p host:contenedor</code>): entras por <code>http://localhost:8080</code> y Docker enruta al proceso que escucha en 3000 dentro',
            'c' => 'Que la app usa un rango de puertos entre 3000 y 8080',
            'd' => 'Que el contenedor se reinicia cada 8080 segundos'
        ],
        'correcta' => 'b',
        'porque'   => 'Regla mnemotecnica: <b>de fuera hacia dentro</b>. El primero es el que tu tecleas en el navegador. Invertirlos es el error mas comun de la primera semana con Docker: el contenedor arranca sin quejarse y la pagina simplemente no carga.'
    ],
    'm2' => [
        'texto'    => 'Tu contenedor expone el puerto 3000 y arranca bien, pero <code>http://localhost:3000</code> no responde desde el host. &iquest;Por que?',
        'opciones' => [
            'a' => 'Porque la app no arranco',
            'b' => 'Por el <b>aislamiento de red</b>: por defecto los puertos expuestos dentro del contenedor <b>no son accesibles</b> desde el host ni desde la red externa hasta que los mapeas con <code>-p</code>',
            'c' => 'Porque falta instalar un servidor web',
            'd' => 'Porque hay que reiniciar Docker'
        ],
        'correcta' => 'b',
        'porque'   => 'Y ojo con el matiz: <code>EXPOSE</code> en el Dockerfile <b>no publica nada</b> — es solo documentacion de que puerto usa la imagen. Quien realmente abre la puerta es <code>-p</code> al lanzar. Por debajo Docker escribe reglas de <b>NAT</b> en el kernel para enrutar el trafico entrante.'
    ],
    'm3' => [
        'texto'    => 'Levantas dos contenedores en la red <b>bridge por defecto</b> y uno intenta llamar al otro por su nombre. Falla. &iquest;Por que?',
        'opciones' => [
            'a' => 'Porque hace falta abrir un puerto con <code>-p</code>',
            'b' => 'Porque la red bridge <b>por defecto no tiene resolucion DNS por nombre</b>: hay que crear una <b>red bridge personalizada</b>, que si trae DNS embebido',
            'c' => 'Porque los contenedores no pueden comunicarse entre si nunca',
            'd' => 'Porque falta instalar un servidor DNS en el contenedor'
        ],
        'correcta' => 'b',
        'porque'   => 'La solucion de la diapositiva son tres comandos: <code>docker network create mi-red-devops</code> y luego cada <code>docker run</code> con <code>--name</code> y <code>--network</code>. A partir de ahi <code>http://db-service:27017</code> funciona <b>sin importar como cambien las IPs</b> al reiniciar los contenedores.'
    ],
    'm4' => [
        'texto'    => '&iquest;Que hace el driver de red <code>host</code>, y cual es su contrapartida?',
        'opciones' => [
            'a' => 'Aisla completamente el contenedor de la red',
            'b' => '<b>Elimina el aislamiento de red</b>: el contenedor usa directamente la red y los puertos del host. Es <b>mas rapido</b> (sin capa de NAT) pero <b>menos seguro</b>, y ya no puedes mapear puertos ni correr dos instancias en el mismo puerto',
            'c' => 'Crea una subred privada para el contenedor',
            'd' => 'Conecta el contenedor a internet unicamente'
        ],
        'correcta' => 'b',
        'porque'   => 'Los tres drivers de la diapositiva: <b>bridge</b> (por defecto, red virtual privada con IP en la subred interna), <b>host</b> (sin aislamiento de red) y <b>none</b> (aislamiento completo, sin interfaz externa — ideal para tareas de calculo aisladas).'
    ],
    'm5' => [
        'texto'    => 'Borras un contenedor de base de datos que <b>no</b> tenia volumenes asociados. &iquest;Que pasa con los datos que genero?',
        'opciones' => [
            'a' => 'Quedan guardados en la imagen para el proximo contenedor',
            'b' => 'Se <b>pierden por completo</b>: vivian en la capa de escritura del contenedor, que es temporal y se destruye con el. Por eso los datos que deben sobrevivir van en un <b>volumen</b>',
            'c' => 'Docker los mueve automaticamente a <code>/var/lib/docker/volumes</code>',
            'd' => 'Se conservan mientras la imagen exista'
        ],
        'correcta' => 'b',
        'porque'   => 'Pregunta 3 de la discusion, y es la razon de ser de todo el modulo 4. Enlaza directo con el Copy-on-Write: la capa de escritura es <b>parte del contenedor</b>, no de la imagen. Contenedor efimero = datos efimeros, salvo que los saques fuera.'
    ],
    'm6' => [
        'texto'    => '&iquest;Cuando usas un <b>volumen de Docker</b> y cuando un <b>bind mount</b>?',
        'opciones' => [
            'a' => 'Son lo mismo con distinto nombre',
            'b' => '<b>Volumen</b> para datos que deben persistir (bases de datos): lo gestiona Docker en <code>/var/lib/docker/volumes</code>, aislado de modificaciones accidentales del host y con mejor rendimiento. <b>Bind mount</b> para desarrollo: mapea una carpeta tuya y los cambios en el codigo se reflejan al instante',
            'c' => 'El volumen es para desarrollo y el bind mount para produccion',
            'd' => 'El bind mount solo funciona en Linux'
        ],
        'correcta' => 'b',
        'porque'   => 'La contrapartida del bind mount es la <b>portabilidad</b>: depende de la estructura de archivos del host, asi que una ruta que existe en tu portatil puede no existir en el servidor. Por eso es comodisimo en <code>docker-compose.override.yml</code> de desarrollo y raro en produccion.'
    ],
    'm7' => [
        'texto'    => '&iquest;Que problema concreto resuelve Docker Compose?',
        'opciones' => [
            'a' => 'Construye imagenes mas pequeñas',
            'b' => 'El <b>reto multi-contenedor</b>: levantar Frontend + Backend + BD exige teclear comandos <code>docker run</code> larguisimos y coordinar el orden de arranque a mano. Compose lo declara todo — servicios, redes y volumenes — en un <b>YAML versionado</b>, y lo levanta con <code>docker compose up -d</code>',
            'c' => 'Sustituye al Dockerfile',
            'd' => 'Permite correr contenedores sin instalar Docker'
        ],
        'correcta' => 'b',
        'porque'   => 'La frase clave de la diapositiva: el archivo <b>codifica la topologia de red y el enrutamiento</b> de la solucion, <b>reemplazando la documentacion y los scripts manuales</b>. Deja de haber un README que dice «primero levanta la BD, espera, luego...».'
    ],
    'm8' => [
        'texto'    => '&iquest;Como facilita Compose la filosofia de <b>equipos pequeños e independientes</b> en microservicios?',
        'opciones' => [
            'a' => 'Obligando a todos los equipos a usar el mismo lenguaje',
            'b' => 'Porque cada equipo publica su servicio como una <b>imagen con una interfaz estandar</b> (un puerto, unas variables) y cualquiera levanta la arquitectura completa en su maquina con un comando, <b>sin saber</b> como esta construido por dentro cada servicio ajeno',
            'c' => 'Porque reduce el numero de repositorios a uno',
            'd' => 'Porque asigna tareas automaticamente'
        ],
        'correcta' => 'b',
        'porque'   => 'Pregunta 5 de la discusion. Es la analogia del contenedor de carga otra vez, aplicada a la organizacion: el <b>contrato</b> entre equipos deja de ser «instala Java 17 y Mongo 6 asi» y pasa a ser «levanta esta imagen». Y un nuevo integrante pasa de dos dias de setup a un <code>docker compose up</code>.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Sesión 6 · 3 — Redes, volúmenes y Compose', 'sesion_06_introduccion_docker.pdf — módulos 3 y 4, conclusiones y discusión');
?>

<div class="card">
  <h2>1. Redireccion de puertos</h2>

  <ul>
    <li><b>Aislamiento de red:</b> por defecto, los puertos expuestos dentro de un
        contenedor <b>no son <?php hueco(1, 14); ?></b> desde el host ni desde
        la red externa.</li>
    <li><b>La bandera <code><?php hueco(2, 6); ?></code>:</b> mapea un puerto del
        <?php hueco(3, 10); ?> anfitrion a un puerto interno del
        <?php hueco(4, 14); ?> — <code>-p puerto_host:puerto_contenedor</code>.</li>
    <li><b>Traduccion de red (<?php hueco(7, 8); ?>):</b> Docker gestiona reglas
        internas a nivel del <?php hueco(8, 10); ?> para enrutar el trafico
        entrante.</li>
  </ul>

  <div class="avisoflujo">
    <b>La consola de la diapositiva.</b> <code>docker run -d -p 8080:3000 mi-app-web</code>
    &rarr; acceso desde el host en <code>http://localhost:<?php hueco(5, 8); ?></code>
    hacia el contenedor en el puerto <?php hueco(6, 8); ?>.
  </div>

  <h3>Escribelo de memoria</h3>
  <?php linea(38, 'Lanza <code>mi-app-web</code> en segundo plano publicando el puerto <b>3000</b> del contenedor en el <b>8080</b> del host.', 'docker run ...'); ?>

  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Controladores de red en Docker</h2>

  <table class="datos">
    <tr><th>Driver</th><th>Que hace</th></tr>
    <tr><td><b><?php hueco(9, 10); ?></b> (por defecto)</td>
        <td>crea una red virtual privada local en el host; los contenedores obtienen una IP
            en la <?php hueco(10, 10); ?> interna de Docker. Aislamiento estandar
            y redireccion a traves de puertos.</td></tr>
    <tr><td><b><?php hueco(11, 10); ?></b></td>
        <td>elimina el <?php hueco(12, 14); ?> de red: el contenedor usa la red y
            los puertos del host directamente — <b>mas rapido, menos seguro</b>.</td></tr>
    <tr><td><b><?php hueco(13, 10); ?></b></td>
        <td>aislamiento completo, sin interfaz de red externa; ideal para tareas de calculo
            aisladas.</td></tr>
  </table>

  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Redes personalizadas y DNS</h2>

  <ul>
    <li><b>El problema de la red por defecto:</b> en la red bridge por defecto, los
        contenedores <b>no pueden resolverse entre si</b> por su
        <?php hueco(14, 10); ?>.</li>
    <li><b>Red bridge <?php hueco(15, 16); ?>:</b> crear una red propia permite
        la resolucion automatica de nombres <?php hueco(16, 8); ?> embebida.</li>
    <li><b>Conexion por nombre:</b> un contenedor llamado <code>db-service</code> es
        accesible por otro de la misma red usando el
        <?php hueco(17, 12); ?> <code>http://db-service:<?php hueco(18, 8); ?></code>,
        <b>sin importar el cambio de IPs</b>.</li>
  </ul>

  <h3>Escribelo de memoria</h3>
  <?php linea(39, 'Crea la red del ejemplo, llamada <code>mi-red-devops</code>.', 'docker network ...'); ?>
  <?php linea(40, 'Lanza <code>mongo</code> en segundo plano con el nombre <code>db</code>, dentro de la red <code>mi-red-devops</code>.', 'docker run -d --name ...'); ?>

  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Persistencia de datos</h2>

  <table class="datos">
    <tr><th>Volumenes de Docker</th><th><?php hueco(22, 14); ?></th></tr>
    <tr>
      <td>Directorios <b>gestionados por Docker</b> en una zona reservada del host
          (<code><?php hueco(19, 26); ?></code>).</td>
      <td>Mapeo directo de un directorio <?php hueco(23, 14); ?> del host
          al contenedor.</td>
    </tr>
    <tr>
      <td><b>Seguro:</b> aislado de modificaciones <?php hueco(20, 14); ?>
          del host.</td>
      <td><b>Ideal para <?php hueco(24, 14); ?>:</b> los cambios en el codigo
          del host se reflejan <b>al instante</b> en el contenedor.</td>
    </tr>
    <tr>
      <td><b>Rendimiento:</b> optimo para bases de datos
          <?php hueco(21, 14); ?>.</td>
      <td><b><?php hueco(25, 14); ?>:</b> depende de la estructura de archivos
          del host.</td>
    </tr>
  </table>

  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Docker Compose</h2>

  <ul>
    <li><b>El reto multi-contenedor:</b> levantar una arquitectura (Frontend, Backend, DB)
        requiere teclear comandos largos y coordinar el
        <?php hueco(33, 8); ?> de arranque manualmente.</li>
    <li><b>Docker Compose:</b> herramienta para definir y correr aplicaciones
        multi-contenedor mediante un archivo <?php hueco(26, 8); ?> declarativo
        (<code><?php hueco(27, 22); ?></code>).</li>
    <li><b>Unificacion:</b> define servicios, volumenes y redes en un <b>unico archivo
        versionado</b>.</li>
  </ul>

  <h3>La estructura del YAML (taller de la calculadora distribuida)</h3>
  <table class="datos">
    <tr><th>Clave</th><th>Que declara</th></tr>
    <tr><td><code><?php hueco(28, 12); ?>:</code></td>
        <td>los contenedores a crear</td></tr>
    <tr><td><code>backend:</code></td>
        <td>servicio de calculo en el puerto interno <?php hueco(29, 8); ?></td></tr>
    <tr><td><code>frontend:</code></td>
        <td>servicio cliente que mapea <code>8080:8080</code> al host y depende del backend
            (<code><?php hueco(30, 14); ?></code>)</td></tr>
    <tr><td><code>database:</code></td>
        <td>servicio de base de datos que usa un <b>volumen</b> para persistencia</td></tr>
    <tr><td><code><?php hueco(31, 12); ?>:</code> y
            <code><?php hueco(32, 12); ?>:</code></td>
        <td>declaran los recursos compartidos automaticamente</td></tr>
  </table>

  <h3>Escribelo de memoria</h3>
  <?php linea(41, 'El <b>comando unico</b> que levanta toda la red, los volumenes y los contenedores en el orden correcto, en segundo plano.', 'docker compose ...'); ?>

  <?php mc('m7'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Conclusiones: contenedores en DevOps</h2>

  <ul>
    <li><b><?php hueco(34, 14); ?> absoluta:</b> garantiza que el software se
        comporte exactamente igual desde la maquina de desarrollo hasta produccion.</li>
    <li><b>Inmutable y versionado:</b> la infraestructura de ejecucion se define en codigo
        (Dockerfile y Compose) dentro del repositorio <?php hueco(35, 8); ?>.</li>
    <li><b>Habilitador de CI/CD:</b> permite levantar entornos de prueba
        <?php hueco(36, 12); ?> en segundos para validar Pull Requests.</li>
  </ul>

  <div class="avisoflujo">
    <b>Mantra.</b> La infraestructura de despliegue ya no es tarea oculta de Ops; ahora se
    define en <?php hueco(37, 10); ?> compartido y versionado junto a la aplicacion.
  </div>

  <?php mc('m8'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('segundo.php', '../Menu.php');
