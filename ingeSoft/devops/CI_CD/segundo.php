<?php
/* ==========================================================================
   IngeSoft5 / DevOps / CI_CD — bloque 02: Contenerizacion con Docker
   Fuente: CI_CD.pdf — Seccion 02 (Modulo 2) + Taller_Evaluativo_CI_CD.pdf
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- multi-stage backend --- */
    1  => ['jar'],
    2  => ['jre'],
    3  => ['alpine'],
    4  => ['privilegiado'],
    5  => ['appuser'],
    6  => ['codigo fuente', 'codigo'],
    7  => ['150'],

    /* --- multi-stage frontend --- */
    8  => ['node', 'node.js', 'nodejs'],
    9  => ['ci'],
    10 => ['vite'],
    11 => ['nginx'],
    12 => ['/index.html', 'index.html'],
    13 => ['gzip'],
    14 => ['node_modules', 'node modules'],
    15 => ['ataque', 'superficie de ataque'],

    /* --- docker compose --- */
    16 => ['nombrados'],
    17 => ['env', '.env'],
    18 => ['bridge', 'puente'],
    19 => ['dns'],
    20 => ['5432'],
    21 => ['puertos'],
    22 => ['healthcheck', 'healthchecks'],
    23 => ['service_healthy', 'service healthy'],
    24 => ['product-network'],

    /* --- nginx reverse proxy --- */
    25 => ['ssl', 'tls', 'ssl/tls'],
    26 => ['80'],
    27 => ['8080'],
    28 => ['x-forwarded-for'],
    29 => ['ruta', 'subdominio'],

    /* --- imagenes exactas del taller --- */
    30 => ['maven:3.9.6-alpine'],
    31 => ['eclipse-temurin:17-jre-alpine'],
    32 => ['node:20-alpine'],
    33 => ['nginx:alpine'],

    /* --- lineas completas --- */
    34 => 'FROM maven:3.9.6-alpine AS builder',
    35 => 'COPY --from=builder /app/target/*.jar app.jar',
    36 => 'try_files $uri /index.html;',
    37 => 'docker compose up -d --build',
    38 => ['curl -i http://localhost:8080/api/products'],
];

$TEXTO = [1,2,3,4,5,6,8,9,10,11,13,14,15,16,17,18,19,21,22,23,24,25,28,29];

$MULTIPLE = [
    'm1' => [
        'texto'    => '&iquest;Por que un Dockerfile <b>multi-stage</b> produce una imagen mas pequeña que uno de una sola etapa?',
        'opciones' => [
            'a' => 'Porque Docker comprime mejor cuando hay varias etapas',
            'b' => 'Porque solo las capas de la <b>ultima</b> etapa llegan a la imagen final: el JDK, Maven, el codigo fuente y las dependencias de compilacion se quedan en la etapa builder y se descartan',
            'c' => 'Porque cada etapa usa una imagen base distinta',
            'd' => 'Porque se eliminan los logs de compilacion'
        ],
        'correcta' => 'b',
        'porque'   => 'La clave es que <code>COPY --from=builder</code> te deja sacar <b>solo el artefacto</b> (el <code>.jar</code>, la carpeta <code>dist/</code>) de la etapa anterior. Todo lo demas de esa etapa nunca entra en la imagen publicada. El PDF lo llama <b>aislamiento de construccion</b>.'
    ],
    'm2' => [
        'texto'    => 'Un compañero dice: «da igual dejar el JDK en la imagen final, total el <code>.jar</code> igual corre». &iquest;Cual es la objecion <b>de seguridad</b>?',
        'opciones' => [
            'a' => 'Que el JDK consume RAM aunque no se use',
            'b' => 'Que aumenta la <b>superficie de ataque</b>: cada binario extra (compilador, shell, herramientas) es codigo con CVEs potenciales que un atacante puede usar para compilar o ejecutar algo dentro del contenedor',
            'c' => 'Que el JDK no es compatible con Alpine',
            'd' => 'Ninguna, solo es cuestion de tamaño'
        ],
        'correcta' => 'b',
        'porque'   => 'Es una de las preguntas de analisis del taller evaluativo. Hay dos efectos y conviene nombrar los dos: <b>tamaño</b> (menos MB = pull mas rapido, despliegues mas agiles, menos coste de registro) y <b>seguridad</b> (menos paquetes = menos CVEs que parchear y menos herramientas disponibles para un atacante que logre entrar).'
    ],
    'm3' => [
        'texto'    => '&iquest;Por que el PDF insiste en crear un <code>USER appuser</code> en vez de correr como root dentro del contenedor?',
        'opciones' => [
            'a' => 'Porque root no puede abrir el puerto 8080',
            'b' => 'Porque si alguien compromete el proceso, ser root <b>dentro</b> del contenedor facilita escalar hacia el host; con un usuario sin privilegios el daño queda acotado',
            'c' => 'Porque Docker lo exige desde la version 20',
            'd' => 'Porque mejora el rendimiento de la JVM'
        ],
        'correcta' => 'b',
        'porque'   => 'El contenedor <b>no es</b> una frontera de seguridad perfecta: root en el contenedor es, por defecto, root en el namespace del host. Principio de minimo privilegio. Nota practica: un usuario no-root no puede abrir puertos &lt; 1024, por eso las imagenes suelen exponer 8080 y no 80.'
    ],
    'm4' => [
        'texto'    => 'En el frontend, &iquest;cual es la diferencia entre <code>npm install</code> y <code>npm ci</code> y por que <code>ci</code> es el adecuado dentro de un Dockerfile o un pipeline?',
        'opciones' => [
            'a' => 'Son identicos, <code>ci</code> es solo un alias mas corto',
            'b' => '<code>npm ci</code> instala <b>exactamente</b> lo que dice <code>package-lock.json</code> (borrando <code>node_modules</code> antes): es <b>determinista y reproducible</b>. <code>npm install</code> puede resolver versiones nuevas y modificar el lock',
            'c' => '<code>npm ci</code> solo instala dependencias de produccion',
            'd' => '<code>npm ci</code> requiere conexion a un registro privado'
        ],
        'correcta' => 'b',
        'porque'   => 'Reproducibilidad: quieres que el build de hoy y el de dentro de seis meses den el <b>mismo</b> artefacto. Con <code>npm install</code> una dependencia transitiva puede subir de version sola y romperte el build sin que hayas cambiado una linea. (El enunciado del taller usa <code>npm install</code>, pero la buena practica del PDF es <code>npm ci</code>.)'
    ],
    'm5' => [
        'texto'    => 'Tu SPA de React funciona en <code>/</code>, pero al recargar en <code>/productos/42</code> Nginx devuelve <b>404</b>. &iquest;Por que?',
        'opciones' => [
            'a' => 'Porque falta un certificado SSL',
            'b' => 'Porque Nginx busca un <b>archivo fisico</b> llamado <code>/productos/42</code> que no existe: el enrutamiento de una SPA vive en JavaScript, asi que hay que redirigir todo a <code>/index.html</code> con <code>try_files</code>',
            'c' => 'Porque el backend no responde',
            'd' => 'Porque falta habilitar gzip'
        ],
        'correcta' => 'b',
        'porque'   => 'Es el <b>fallback SPA</b>. El build de Vite genera un unico <code>index.html</code>; las rutas las pinta React Router en el navegador. Sin <code>try_files $uri /index.html</code>, la navegacion interna funciona pero <b>recargar o compartir un enlace profundo</b> revienta. La rubrica del taller lo penaliza explicitamente ("404 en rutas").'
    ],
    'm6' => [
        'texto'    => 'En el <code>docker-compose.yml</code>, el backend se conecta a la base de datos con la URL <code>jdbc:postgresql://postgres-db:5432/app</code>. &iquest;De donde sale el nombre <code>postgres-db</code>?',
        'opciones' => [
            'a' => 'Es una entrada que hay que añadir a mano en <code>/etc/hosts</code>',
            'b' => 'Es el <b>nombre del servicio</b> en el Compose: dentro de la red bridge definida, Docker resuelve por <b>DNS interno</b> cada nombre de servicio a la IP del contenedor',
            'c' => 'Es la IP fija del contenedor',
            'd' => 'Es el nombre de la imagen de PostgreSQL'
        ],
        'correcta' => 'b',
        'porque'   => 'Por eso <b>no</b> se usa <code>localhost</code> entre contenedores: cada uno tiene su propio namespace de red. Y por eso no hace falta publicar el puerto 5432 al host — los servicios se hablan por la red interna, y al exterior solo expones lo imprescindible.'
    ],
    'm7' => [
        'texto'    => 'El taller pide <code>depends_on</code> con <code>condition: service_healthy</code>. &iquest;Que problema resuelve, que <code>depends_on</code> a secas <b>no</b> resuelve?',
        'opciones' => [
            'a' => 'Ninguno, es equivalente',
            'b' => '<code>depends_on</code> a secas solo espera a que el contenedor <b>arranque</b>; con <code>service_healthy</code> espera a que el <b>healthcheck pase</b>, es decir a que la aplicacion este realmente lista para responder',
            'c' => 'Resuelve conflictos de puertos',
            'd' => 'Ordena alfabeticamente los servicios'
        ],
        'correcta' => 'b',
        'porque'   => 'Clasico: Postgres "arranca" en 1 segundo pero tarda 10 en aceptar conexiones; Spring Boot arranca contra una BD que aun no escucha y muere. El <b>healthcheck</b> es la sonda real (un <code>curl</code> o un <code>pg_isready</code>) y <code>service_healthy</code> es lo que hace que el resto espere a esa sonda, no al proceso.'
    ],
    'm8' => [
        'texto'    => '&iquest;Por que el reverse proxy inyecta cabeceras <code>X-Real-IP</code> y <code>X-Forwarded-For</code>?',
        'opciones' => [
            'a' => 'Para cifrar el trafico interno',
            'b' => 'Porque el backend solo ve la IP del <b>proxy</b>: sin esas cabeceras pierde la IP real del cliente, y con ella los logs, el rate-limiting y la geolocalizacion',
            'c' => 'Para balancear la carga entre replicas',
            'd' => 'Para comprimir la respuesta'
        ],
        'correcta' => 'b',
        'porque'   => 'Tambien se reenvia <code>Host</code>, porque si no la aplicacion genera URLs absolutas con el nombre interno del contenedor en vez del dominio publico. Y ojo con la seguridad: esas cabeceras solo son de fiar si <b>tu</b> proxy las sobrescribe; si las dejas pasar desde fuera, cualquiera falsea su IP.'
    ],
    'm9' => [
        'texto'    => 'Un reverse proxy unico delante de front y back permite «terminacion SSL/TLS». &iquest;Que significa eso?',
        'opciones' => [
            'a' => 'Que el proxy cierra la conexion cuando expira el certificado',
            'b' => 'Que el <b>cifrado HTTPS termina en el proxy</b>: el certificado se gestiona en un solo punto y hacia adentro el trafico viaja por la red privada de contenedores, sin que cada servicio tenga que manejar certificados',
            'c' => 'Que se desactiva TLS por rendimiento',
            'd' => 'Que se usa TLS tambien entre contenedores'
        ],
        'correcta' => 'b',
        'porque'   => 'La ventaja operativa es enorme: <b>un</b> certificado que renovar (Let\'s Encrypt en el proxy) en vez de uno por servicio. Y encaja con el mapeo de rutas: <code>/</code> al frontend y <code>/api/</code> al backend, todo bajo el mismo origen — con lo que de paso desaparecen los problemas de CORS.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('CI/CD · 2 — Contenerizacion con Docker', 'CI_CD.pdf Modulo 2 + Taller evaluativo: multi-stage, Compose y reverse proxy');
?>

<div class="card">
  <h2>Lo que se cubre aqui</h2>
  <p>Esto <b>no</b> es el cuestionario de Docker basico (imagenes, capas, <code>docker run</code>).
     Aqui va lo que pide el PDF de CI/CD: <b>multi-stage builds</b>, orquestacion con
     <b>Compose</b> y <b>Nginx como reverse proxy</b>, con los nombres exactos de imagen
     que exige el taller evaluativo.</p>
</div>


<div class="card">
  <h2>1. Multi-stage build: backend Spring Boot</h2>

  <table class="datos">
    <tr><th>Etapa</th><th>Que hace</th></tr>
    <tr><td><b>1 — Build</b></td>
        <td>imagen <b>JDK completa</b> con Gradle o Maven para compilar el archivo
            <?php hueco(1, 8); ?></td></tr>
    <tr><td><b>2 — Runtime</b></td>
        <td>imagen <?php hueco(2, 8); ?> minima de ejecucion
            (Eclipse Temurin <?php hueco(3, 10); ?>)</td></tr>
    <tr><td><b>Seguridad</b></td>
        <td>creacion y uso de un usuario <b>no <?php hueco(4, 14); ?></b>
            (<code>USER <?php hueco(5, 12); ?></code>)</td></tr>
    <tr><td><b>Resultado</b></td>
        <td>imagen final ligera (&lt; <?php hueco(7, 6); ?> MB) sin compiladores
            ni <?php hueco(6, 16); ?></td></tr>
  </table>

  <div class="avisoflujo">
    <b>Aislamiento de construccion.</b> El codigo fuente y las herramientas de compilacion
    quedan aislados de la imagen final desplegada en produccion.
  </div>

  <h3>Las imagenes exactas del taller</h3>
  <table class="datos">
    <tr><th>Etapa</th><th>Imagen base</th></tr>
    <tr><td>Backend — builder</td><td><?php hueco(30, 24); ?></td></tr>
    <tr><td>Backend — runtime</td><td><?php hueco(31, 30); ?></td></tr>
  </table>
  <?php ayuda('Builder: <code>maven</code> version <code>3.9.6</code> sobre <code>alpine</code>. Runtime: <code>eclipse-temurin</code> version <code>17</code>, variante <code>jre</code>, sobre <code>alpine</code>.'); ?>

 
  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Multi-stage build: frontend React SPA</h2>

  <ul>
    <li><b>Etapa 1 (Build):</b> contenedor <?php hueco(8, 10); ?> para instalar
        dependencias (<code>npm <?php hueco(9, 5); ?></code>) y empaquetar con
        <?php hueco(10, 8); ?>.</li>
    <li><b>Etapa 2 (Runtime):</b> servidor web <?php hueco(11, 10); ?> Alpine
        ultraligero (&lt; 25MB).</li>
    <li><b>Configuracion SPA:</b> redireccion de rutas HTML5 con
        <code>try_files $uri <?php hueco(12, 14); ?></code>.</li>
    <li><b>Rendimiento:</b> servido de estaticos optimizado con compresion
        <?php hueco(13, 8); ?> habilitada.</li>
  </ul>

  <div class="avisoflujo">
    <b>Eficiencia de despliegue.</b> La imagen final no incluye Node.js ni la carpeta
    <code><?php hueco(14, 16); ?></code>, reduciendo drasticamente la
    superficie de <?php hueco(15, 12); ?>.
  </div>

  <table class="datos">
    <tr><th>Etapa</th><th>Imagen base</th></tr>
    <tr><td>Frontend — builder</td><td><?php hueco(32, 20); ?></td></tr>
    <tr><td>Frontend — runtime</td><td><?php hueco(33, 20); ?></td></tr>
  </table>

  <h3>Escribelo de memoria</h3>
  <?php linea(36, 'La directiva de <code>nginx.conf</code> que hace el fallback de la SPA (con el punto y coma final).', 'try_files ...'); ?>

  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Orquestacion con Docker Compose</h2>

  <table class="datos">
    <tr><th>Definicion de la arquitectura</th><th>Aislamiento de redes</th></tr>
    <tr>
      <td><b>Servicio DB:</b> PostgreSQL con volumenes persistentes
          <?php hueco(16, 14); ?>.</td>
      <td>Creacion de una red <?php hueco(18, 10); ?> interna para la
          comunicacion inter-servicios.</td>
    </tr>
    <tr>
      <td><b>Servicio API:</b> Spring Boot conectado a la BD mediante variables
          <code>.<?php hueco(17, 8); ?></code>.</td>
      <td>Resolucion <?php hueco(19, 8); ?> interna por nombre de servicio
          (p. ej. <code>postgres-db:<?php hueco(20, 8); ?></code>).</td>
    </tr>
    <tr>
      <td><b>Servicio Web:</b> frontend React sirviendo la interfaz.</td>
      <td>Mapeo <b>exclusivo</b> de los <?php hueco(21, 12); ?> publicos
          necesarios hacia el exterior.</td>
    </tr>
  </table>

  <h3>Lo que exige el taller evaluativo</h3>
  <ul>
    <li>Red compartida tipo puente llamada <code><?php hueco(24, 20); ?></code>.</li>
    <li>Un <?php hueco(22, 16); ?> en el backend que valide la respuesta HTTP
        en <code>http://localhost:8080/api/products</code>.</li>
    <li><code>depends_on</code> con <code>condition: <?php hueco(23, 20); ?></code>
        en el contenedor del frontend.</li>
  </ul>

  <h3>Escribelo de memoria</h3>
  <?php linea(37, 'El comando que levanta todo el stack en segundo plano <b>reconstruyendo</b> las imagenes.', 'docker compose ...'); ?>
  <?php linea(38, 'El <code>curl</code> del taller que comprueba el API mostrando las <b>cabeceras</b> de la respuesta.', 'curl ...'); ?>
  <?php ayuda('La bandera para ver cabeceras + cuerpo es <code>-i</code>. La URL: <code>http://localhost:8080/api/products</code>.'); ?>

  <?php mc('m6'); ?>
  <?php mc('m7'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Enrutamiento con Nginx Reverse Proxy</h2>

  <table class="datos">
    <tr><th>Punto de entrada unificado</th><th>Mapeo de rutas</th></tr>
    <tr>
      <td>Recepcion centralizada del trafico HTTP/HTTPS en el host.</td>
      <td><code>/</code> &rarr; contenedor del <b>frontend</b> React
          (puerto <?php hueco(26, 8); ?>).</td>
    </tr>
    <tr>
      <td>Terminacion <?php hueco(25, 10); ?>/TLS segura y gestion de
          certificados.</td>
      <td><code>/api/</code> &rarr; contenedor de la <b>API</b> Spring Boot
          (puerto <?php hueco(27, 8); ?>).</td>
    </tr>
    <tr>
      <td>Enrutamiento por prefijo de <?php hueco(29, 12); ?> o subdominio.</td>
      <td>Inyeccion de cabeceras <code>Host</code>, <code>X-Real-IP</code> y
          <code><?php hueco(28, 20); ?></code>.</td>
    </tr>
  </table>

  <div class="avisoflujo">
    <b>Arquitectura en contenedores.</b> &laquo;Contenerizar cada capa de la aplicacion
    desacopla el desarrollo de la infraestructura y simplifica la escalabilidad.&raquo;
  </div>

  <?php mc('m8'); ?>
  <?php mc('m9'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('index.php', 'tercero.php');
