<?php
/* ==========================================================================
   IngeSoft5 / DevOps / Docker — parte 2: Dockerfile y comandos
   Fuente: TallerDocker.pdf + tus Dockerfile reales
           (animal-farm-nodejs, ArquitecturaSFV-P1)
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- instrucciones del Dockerfile --- */
    1  => ['FROM'],
    2  => ['WORKDIR'],
    3  => ['COPY'],
    4  => ['RUN'],
    5  => ['ENV'],
    6  => ['ARG'],
    7  => ['EXPOSE'],
    8  => ['CMD'],
    9  => ['USER'],

    /* --- animal-farm Dockerfile --- */
    10 => ['FROM node:14'],
    11 => ['WORKDIR /usr/src/app'],
    12 => ['COPY package.json yarn.lock ./'],
    13 => ['RUN yarn install'],
    14 => ['COPY . .'],
    15 => ['EXPOSE 8080'],
    16 => ['CMD [ "node", "app.js" ]', 'CMD ["node", "app.js"]'],
    17 => ['node_modules'],

    /* --- ArquitecturaSFV Dockerfile --- */
    18 => ['FROM node:18-alpine'],
    19 => ['COPY package*.json ./'],
    20 => ['RUN chown -R node:node /usr/src/app'],
    21 => ['ENV PORT=8080 NODE_ENV=production'],
    22 => ['USER node'],

    /* --- Dockerfile del taller: base de datos --- */
    23 => ['FROM mysql:5.7'],
    24 => ['ENV MYSQL_ROOT_PASSWORD=123'],
    25 => ['ENV MYSQL_DATABASE=supermarket_db'],
    26 => ['EXPOSE 3306'],

    /* --- Dockerfile del taller: microservicio --- */
    27 => ['FROM python:3'],
    28 => ['WORKDIR /code'],
    29 => ['COPY requirements.txt /code/'],
    30 => ['RUN pip install -r requirements.txt'],
    31 => ['ARG URL=0.0.0.0:4000'],

    /* --- comandos docker --- */
    32 => ['docker build -t supermarket_db .'],
    33 => ['docker run -d -t -i -p 3306:3306 --name supermarket_db supermarket_db'],
    34 => ['docker ps'],
    35 => ['docker inspect'],
    36 => ['docker image prune -a'],
    37 => ['-d'],
    38 => ['-p'],
    39 => ['--name'],
    40 => ['-t'],
    41 => ['-e'],
    42 => ['--link'],

    /* --- puertos del taller --- */
    43 => ['3306'],
    44 => ['4000'],
    45 => ['8081'],
    46 => ['host.docker.internal'],
];

/* solo los conceptuales; los comandos e instrucciones respetan mayusculas */
$TEXTO = [];

$MULTIPLE = [
    'm1' => [
        'texto'    => '&iquest;Cual es la diferencia entre <code>RUN</code> y <code>CMD</code>?',
        'opciones' => [
            'a' => 'Ninguna, son sinonimos',
            'b' => '<code>RUN</code> ejecuta algo <b>al construir la imagen</b> y el resultado queda grabado en una capa; <code>CMD</code> define <b>que se ejecuta al arrancar el contenedor</b>',
            'c' => '<code>RUN</code> es para Linux y <code>CMD</code> para Windows',
            'd' => '<code>CMD</code> se ejecuta antes que <code>RUN</code>'
        ],
        'correcta' => 'b',
        'porque'   => 'Por eso <code>RUN yarn install</code> va en el build (las dependencias quedan dentro de la imagen) y <code>CMD ["node","app.js"]</code> se ejecuta cada vez que levantas un contenedor.'
    ],
    'm2' => [
        'texto'    => 'En el Dockerfile de <code>animal-farm</code>, &iquest;por que se copia primero <code>package.json</code> y solo despues <code>COPY . .</code>?',
        'opciones' => [
            'a' => 'Por orden alfabetico',
            'b' => 'Por la <b>cache de capas</b>: si el codigo cambia pero las dependencias no, Docker reutiliza la capa del <code>yarn install</code> y el build es mucho mas rapido',
            'c' => 'Porque <code>COPY . .</code> no copiaria el package.json',
            'd' => 'Porque yarn lo exige'
        ],
        'correcta' => 'b',
        'porque'   => 'Cada instruccion es una capa cacheada. Si copiaras todo de golpe, cualquier cambio en una linea de tu app invalidaria la capa de dependencias y reinstalarias todo desde cero.'
    ],
    'm3' => [
        'texto'    => '&iquest;Para que sirve el archivo <code>.dockerignore</code> con <code>node_modules</code> dentro?',
        'opciones' => [
            'a' => 'Para que no se instalen dependencias',
            'b' => 'Para que <code>COPY . .</code> <b>no copie</b> el <code>node_modules</code> de tu maquina dentro de la imagen: pesa muchisimo y puede tener binarios compilados para otro SO',
            'c' => 'Para ignorar errores del build',
            'd' => 'Para excluir el Dockerfile de la imagen'
        ],
        'correcta' => 'b',
        'porque'   => 'Doble beneficio: build mas rapido, y evitas el clasico &laquo;funciona en mi maquina&raquo; por copiar binarios nativos de Windows a una imagen Linux.'
    ],
    'm4' => [
        'texto'    => '&iquest;Que hace realmente <code>EXPOSE 8080</code>?',
        'opciones' => [
            'a' => 'Abre el puerto 8080 en tu maquina',
            'b' => 'Es <b>documentacion</b>: declara que el contenedor escucha en ese puerto. Para que sea accesible desde fuera hace falta <code>-p</code> en el <code>docker run</code>',
            'c' => 'Redirige el trafico del host al contenedor',
            'd' => 'Configura el firewall'
        ],
        'correcta' => 'b',
        'porque'   => 'Confusion muy comun. <code>EXPOSE</code> no publica nada; el que publica es <code>-p 8080:8080</code>.'
    ],
    'm5' => [
        'texto'    => 'En <code>-p 3306:3306</code>, &iquest;cual numero es cual?',
        'opciones' => [
            'a' => 'El primero es el del contenedor y el segundo el del host',
            'b' => 'El <b>primero es el del host</b> (tu maquina) y el segundo el del <b>contenedor</b>',
            'c' => 'Los dos son del contenedor',
            'd' => 'Es indiferente'
        ],
        'correcta' => 'b',
        'porque'   => 'Se lee de fuera hacia dentro: <code>host:contenedor</code>. Por eso el cliente web se publica con <code>-p 8081:80</code>: el contenedor escucha en 80, tu entras por 8081.'
    ],
    'm6' => [
        'texto'    => 'En el taller, phpMyAdmin se levanta con <code>-p 8081:80</code>. &iquest;Por que no <code>-p 80:80</code>?',
        'opciones' => [
            'a' => 'Porque phpMyAdmin no soporta el puerto 80',
            'b' => 'Porque el puerto 80 del host suele estar ocupado (por ejemplo por Apache/XAMPP); 8081 evita el choque',
            'c' => 'Porque Docker prohibe el puerto 80',
            'd' => 'Porque 8081 es mas seguro'
        ],
        'correcta' => 'b',
        'porque'   => 'Es exactamente tu caso: tienes XAMPP sirviendo <code>php_web</code> en el 80. Dos procesos no pueden escuchar el mismo puerto del host.'
    ],
    'm7' => [
        'texto'    => '&iquest;Que diferencia hay entre <code>ENV</code> y <code>ARG</code>?',
        'opciones' => [
            'a' => 'Ninguna',
            'b' => '<code>ARG</code> existe <b>solo durante el build</b> y se pasa con <code>--build-arg</code>; <code>ENV</code> queda como variable de entorno <b>dentro del contenedor en ejecucion</b>',
            'c' => '<code>ARG</code> es para numeros y <code>ENV</code> para texto',
            'd' => '<code>ENV</code> solo funciona en imagenes de Linux'
        ],
        'correcta' => 'b',
        'porque'   => 'En el Dockerfile del microservicio conviven los dos: <code>ARG URL=0.0.0.0:4000</code> como valor por defecto, y luego <code>-e URL=...</code> en el <code>docker run</code> para el contenedor.'
    ],
    'm8' => [
        'texto'    => 'El Dockerfile de <code>ArquitecturaSFV-P1</code> termina con <code>USER node</code> antes del <code>CMD</code>. &iquest;Por que?',
        'opciones' => [
            'a' => 'Para que el contenedor arranque mas rapido',
            'b' => 'Para que la aplicacion <b>no corra como root</b> dentro del contenedor: si alguien la compromete, tiene menos privilegios',
            'c' => 'Porque Node.js lo exige',
            'd' => 'Para poder instalar paquetes'
        ],
        'correcta' => 'b',
        'porque'   => 'Y por eso la linea anterior es <code>RUN chown -R node:node /usr/src/app</code>: primero le das los archivos a ese usuario, y despues cambias a el. El orden importa.'
    ],
    'm9' => [
        'texto'    => 'El microservicio necesita conectarse a la base de datos. En <code>-e DB_HOST=X</code>, una alternativa para X es <code>host.docker.internal</code>. &iquest;Que es?',
        'opciones' => [
            'a' => 'El nombre del contenedor de la base de datos',
            'b' => 'Un nombre especial que, desde dentro del contenedor, apunta a <b>la maquina anfitriona</b>',
            'c' => 'La IP publica del servidor',
            'd' => 'El nombre de la red de Docker'
        ],
        'correcta' => 'b',
        'porque'   => 'Dentro del contenedor, <code>localhost</code> es el propio contenedor, no tu PC. La otra alternativa del taller es usar la IP del contenedor de la BD, que sacas con <code>docker inspect</code>.'
    ],
    'm10' => [
        'texto'    => '&iquest;Que hace el punto final de <code>docker build -t supermarket_db .</code>?',
        'opciones' => [
            'a' => 'Indica que el build es silencioso',
            'b' => 'Es el <b>contexto de build</b>: la carpeta que se le envia al daemon de Docker y donde busca el <code>Dockerfile</code>',
            'c' => 'Marca el final del comando',
            'd' => 'Indica la version de la imagen'
        ],
        'correcta' => 'b',
        'porque'   => 'Y por eso el <code>.dockerignore</code> importa: todo lo que este en ese contexto se envia al daemon, aunque despues no se copie.'
    ],
    'm11' => [
        'texto'    => 'Terminas la practica del taller. &iquest;Con que comando compruebas que los contenedores estan corriendo?',
        'opciones' => [
            'a' => '<code>docker images</code>',
            'b' => '<code>docker ps</code>',
            'c' => '<code>docker build</code>',
            'd' => '<code>docker logs</code>'
        ],
        'correcta' => 'b',
        'porque'   => '<code>docker ps</code> lista los contenedores <b>en ejecucion</b>; con <code>-a</code> incluye tambien los parados — que es justo lo que usaba el reto 6 de Bash para borrar los <code>exited</code>.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Docker · 2 — Dockerfile y comandos', 'TallerDocker.pdf + tus Dockerfile de clase');
?>

<div class="card">
  <h2>1. Las instrucciones del Dockerfile</h2>
  <p>Nueve, y con estas se escribe practicamente cualquier Dockerfile del curso.</p>

  <table class="datos">
    <tr><th>Instruccion</th><th>Que hace</th></tr>
    <tr><td><?php hueco(1, 10); ?></td><td>la imagen base de la que se parte</td></tr>
    <tr><td><?php hueco(2, 10); ?></td><td>fija el directorio de trabajo dentro de la imagen</td></tr>
    <tr><td><?php hueco(3, 10); ?></td><td>copia archivos de tu maquina a la imagen</td></tr>
    <tr><td><?php hueco(4, 10); ?></td><td>ejecuta un comando <b>durante el build</b> y graba el resultado en una capa</td></tr>
    <tr><td><?php hueco(5, 10); ?></td><td>define una variable de entorno que existe <b>en el contenedor</b></td></tr>
    <tr><td><?php hueco(6, 10); ?></td><td>define una variable que existe <b>solo durante el build</b></td></tr>
    <tr><td><?php hueco(7, 10); ?></td><td>documenta el puerto en el que escucha el contenedor</td></tr>
    <tr><td><?php hueco(8, 10); ?></td><td>el comando que se ejecuta <b>al arrancar</b> el contenedor</td></tr>
    <tr><td><?php hueco(9, 10); ?></td><td>cambia el usuario con el que corre lo que viene despues</td></tr>
  </table>

  <?php mc('m1'); ?>
  <?php mc('m7'); ?>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Tu Dockerfile de <code>animal-farm-nodejs</code></h2>
  <p>Reconstruyelo entero. Es el mas sencillo de los tres que tienes.</p>

  <?php linea(10, 'imagen base: Node.js version 14', 'FROM ...'); ?>
  <?php linea(11, 'directorio de trabajo <code>/usr/src/app</code>', 'WORKDIR ...'); ?>
  <?php linea(12, 'copia <b>solo</b> <code>package.json</code> y <code>yarn.lock</code> al directorio actual', 'COPY ...'); ?>
  <?php linea(13, 'instala las dependencias con yarn', 'RUN ...'); ?>
  <?php linea(14, 'ahora si, copia <b>todo</b> el codigo fuente', 'COPY ...'); ?>
  <?php linea(15, 'declara el puerto 8080', 'EXPOSE ...'); ?>
  <?php linea(16, 'al arrancar, ejecuta <code>node app.js</code> (formato exec, con corchetes)', 'CMD ...'); ?>

  <p>Y al lado, el archivo <code>.dockerignore</code> con una sola linea:
     <?php hueco(17, 16); ?>.</p>

  <?php mc('m2'); ?>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Tu Dockerfile de <code>ArquitecturaSFV-P1</code></h2>
  <p>El mismo esquema, pero con tres mejoras que conviene poder explicar.</p>

  <?php linea(18, 'imagen base: Node 18, variante <b>alpine</b> (mucho mas ligera)', 'FROM ...'); ?>
  <?php linea(19, 'copia <code>package.json</code> <b>y</b> <code>package-lock.json</code> con un comodin', 'COPY ...'); ?>
  <?php linea(20, 'da la propiedad de <code>/usr/src/app</code> al usuario <code>node</code>, recursivamente', 'RUN ...'); ?>
  <?php linea(21, 'define <b>dos</b> variables de entorno en una linea: puerto 8080 y entorno de produccion', 'ENV ...'); ?>
  <?php linea(22, 'cambia al usuario sin privilegios', 'USER ...'); ?>

  <div class="nota">La linea del <code>RUN</code> de instalacion usa
    <code>npm ci --only=production</code> si existe el lockfile, y si no
    <code>npm install --omit=dev</code>. <b>npm ci</b> instala exactamente lo que dice el
    lockfile: es lo que hace el build <em>determinista</em>.</div>

  <?php mc('m8'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. El taller: Dockerfile de la base de datos</h2>
  <p>Puerto TCP a usar: <?php hueco(43, 8); ?>.</p>

  <?php linea(23, 'imagen base MySQL 5.7', 'FROM ...'); ?>
  <?php linea(24, 'contraseña de root: <code>123</code>', 'ENV ...'); ?>
  <?php linea(25, 'nombre de la base de datos: <code>supermarket_db</code>', 'ENV ...'); ?>
  <p>Y las otras dos: <code>ENV MYSQL_USER=supermarket</code> y
     <code>ENV MYSQL_PASSWORD=2021</code>.</p>
  <?php linea(26, 'declara el puerto de MySQL', 'EXPOSE ...'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. El taller: Dockerfile del microservicio</h2>
  <p>Puerto TCP a usar: <?php hueco(44, 8); ?>.</p>

  <?php linea(27, 'imagen base de Python 3', 'FROM ...'); ?>
  <p><code>ENV PYTHONUNBUFFERED 1</code> y <code>RUN mkdir /code</code> ya estan.</p>
  <?php linea(28, 'directorio de trabajo <code>/code</code>', 'WORKDIR ...'); ?>
  <?php linea(29, 'copia el archivo de dependencias a <code>/code/</code>', 'COPY ...'); ?>
  <?php linea(30, 'instala las dependencias de Python desde ese archivo', 'RUN ...'); ?>
  <?php linea(31, 'variable de <b>build</b> con la URL por defecto <code>0.0.0.0:4000</code>', 'ARG ...'); ?>

  <div class="nota">El <code>CMD</code> encadena tres cosas con <code>&amp;&amp;</code>:
    <code>makemigrations</code>, <code>migrate</code> y <code>runserver $URL</code>.
    Va envuelto en <code>sh -c</code> justamente para que el shell expanda <code>$URL</code>.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Los comandos del taller</h2>

  <?php linea(32, 'construye la imagen de la base de datos con el nombre <code>supermarket_db</code>, desde la carpeta actual', 'docker build ...'); ?>
  <?php linea(33, 'levanta la base de datos en segundo plano, publicando 3306 y con nombre <code>supermarket_db</code>', 'docker run ...'); ?>
  <?php linea(34, 'comprueba que los contenedores estan corriendo', 'docker ...'); ?>
  <?php linea(35, 'inspecciona un contenedor (de ahi sacas su IP en <code>Networks &gt; bridge &gt; IPAddress</code>)', 'docker ...'); ?>
  <?php linea(36, 'elimina las imagenes que no estan en uso (el del reto 15 de Bash)', 'docker image ...'); ?>

  <h3>Las banderas de <code>docker run</code></h3>
  <table class="datos">
    <tr><th>Bandera</th><th>Que hace</th></tr>
    <tr><td><?php hueco(37, 6); ?></td><td><em>detached</em>: en segundo plano, te devuelve la terminal</td></tr>
    <tr><td><?php hueco(38, 6); ?> host:contenedor</td><td>publica un puerto del contenedor en tu maquina</td></tr>
    <tr><td><?php hueco(39, 10); ?></td><td>le pone nombre al contenedor</td></tr>
    <tr><td><?php hueco(40, 6); ?> y <code>-i</code></td><td>asigna una TTY y deja la entrada interactiva abierta</td></tr>
    <tr><td><?php hueco(41, 6); ?> VAR=valor</td><td>pasa una variable de entorno al contenedor</td></tr>
    <tr><td><?php hueco(42, 10); ?> db</td><td>enlaza con otro contenedor (asi arranca phpMyAdmin en el taller)</td></tr>
  </table>

  <p>El cliente phpMyAdmin se publica en el puerto <?php hueco(45, 8); ?> del host,
     y se accede por <code>http://localhost:8081</code>.</p>

  <p>Para que el microservicio encuentre la base de datos, <code>DB_HOST</code> puede ser
     <?php hueco(46, 22); ?> o directamente la IP del contenedor.</p>

  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php mc('m9'); ?>
  <?php mc('m10'); ?>
  <?php mc('m11'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('index.php', '');
