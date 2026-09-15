<?php
/* ==========================================================================
   IngeSoft5 / DevOps / Linux — bloque 03: Background, servicios, SSH y SCP
   Fuente: introduccion_linux.pdf — modulos 3 (segunda parte) y 4
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- background --- */
    1  => ['&'],
    2  => ['ctrl + z', 'ctrl+z'],
    3  => ['bg'],
    4  => ['fg'],
    5  => ['hijos'],
    6  => ['nohup'],
    7  => ['desconexion'],
    8  => ['tmux'],
    9  => ['screen'],

    /* --- systemd --- */
    10 => ['systemd'],
    11 => ['systemctl'],
    12 => ['sudo'],
    13 => ['start'],
    14 => ['stop'],
    15 => ['restart'],
    16 => ['status'],
    17 => ['enable'],
    18 => ['dependencias'],

    /* --- ssh --- */
    19 => ['ssh'],
    20 => ['encripta', 'cifra'],
    21 => ['-i'],
    22 => ['.pem', 'pem'],
    23 => ['22'],
    24 => ['fuerza bruta'],
    25 => ['400'],

    /* --- scp --- */
    26 => ['scp'],
    27 => ['-r'],
    28 => ['rsync'],
    29 => ['modificados'],
    30 => ['90'],

    /* --- lineas completas --- */
    31 => 'node server.js &',
    32 => 'nohup python3 app.py &',
    33 => 'sudo systemctl status apache2',
    34 => 'sudo systemctl enable apache2',
    35 => 'ssh -i ~/.ssh/key.pem usuario@ip_del_servidor',
    36 => 'scp archivo.zip usuario@ip:/ruta/remota/',
    37 => 'scp usuario@ip:/ruta/remota/archivo.zip /ruta/local/',
];

$TEXTO = [2,5,7,18,20,24,29];

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Lanzas <code>node server.js &amp;</code> por SSH, cierras la terminal y el servidor se cae. &iquest;Por que?',
        'opciones' => [
            'a' => 'Porque el <code>&amp;</code> solo funciona en local',
            'b' => 'Porque al cerrar la sesion de terminal <b>se cierran todos sus procesos hijos</b>: el <code>&amp;</code> te libera la consola, pero no desliga el proceso de la sesion',
            'c' => 'Porque Node no soporta segundo plano',
            'd' => 'Porque falta ejecutarlo como root'
        ],
        'correcta' => 'b',
        'porque'   => 'El <code>&amp;</code> resuelve <b>un</b> problema (no bloquear tu terminal) y no el otro (sobrevivir a la desconexion). Para eso estan <code>nohup</code>, que lo hace inmune a la desconexion fisica, o un multiplexor como <code>tmux</code>.'
    ],
    'm2' => [
        'texto'    => 'Lanzaste un proceso en primer plano y te bloquea la terminal. &iquest;Que secuencia lo manda al segundo plano sin matarlo?',
        'opciones' => [
            'a' => '<code>Ctrl + C</code> y volver a lanzarlo',
            'b' => '<code>Ctrl + Z</code> para <b>pausarlo</b> y luego <code>bg</code> para <b>reanudarlo en segundo plano</b>; con <code>fg</code> lo traes de vuelta al frente',
            'c' => '<code>kill -9</code> y relanzarlo con <code>&amp;</code>',
            'd' => '<code>Ctrl + D</code>'
        ],
        'correcta' => 'b',
        'porque'   => 'Ojo con la diferencia: <code>Ctrl + Z</code> <b>pausa</b> (el proceso queda detenido, sin consumir CPU) y <code>bg</code> es el que lo pone a correr otra vez, ya liberado. Si solo haces <code>Ctrl + Z</code> y te olvidas, tu proceso se queda congelado.'
    ],
    'm3' => [
        'texto'    => '&iquest;Que aporta <code>tmux</code> o <code>screen</code> frente a <code>nohup</code>?',
        'opciones' => [
            'a' => 'Nada, son equivalentes',
            'b' => 'Mantienen <b>sesiones de terminal completas</b> vivas en el servidor: puedes reconectarte dias despues y <b>volver a ver</b> la sesion tal como la dejaste, con su salida y varias ventanas',
            'c' => 'Consumen menos memoria',
            'd' => 'Solo funcionan con procesos de Python'
        ],
        'correcta' => 'b',
        'porque'   => 'Con <code>nohup</code> el proceso sobrevive pero <b>pierdes la ventana</b>: la salida se va a <code>nohup.out</code> y ya no interactuas con el. Con tmux te reenganchas y sigues como si nunca te hubieras ido. Aun asi, para algo que debe correr <b>siempre</b>, la respuesta correcta en produccion no es ninguno de los dos: es un servicio de systemd.'
    ],
    'm4' => [
        'texto'    => '&iquest;Cual es la diferencia entre <code>systemctl start apache2</code> y <code>systemctl enable apache2</code>?',
        'opciones' => [
            'a' => 'Ninguna, son sinonimos',
            'b' => '<code>start</code> lo arranca <b>ahora</b> (y se pierde al reiniciar la maquina); <code>enable</code> lo marca para que <b>arranque automaticamente al encender</b> el servidor',
            'c' => '<code>enable</code> arranca el servicio y <code>start</code> solo lo habilita',
            'd' => '<code>enable</code> es para servicios de usuario y <code>start</code> para los del sistema'
        ],
        'correcta' => 'b',
        'porque'   => 'El error clasico: haces <code>start</code>, todo funciona, reinicias el servidor meses despues y el servicio no vuelve. Los dos son independientes, por eso normalmente se hacen ambos: <code>sudo systemctl enable --now apache2</code>.'
    ],
    'm5' => [
        'texto'    => 'El PDF dice que systemd es «resiliencia». &iquest;Que hace por ti que un <code>nohup</code> no?',
        'opciones' => [
            'a' => 'Cifra el trafico del servicio',
            'b' => 'Gestiona las <b>dependencias del arranque</b> (levanta la BD antes que la app) y es capaz de <b>reiniciar la aplicacion automaticamente</b> si detecta que el servicio fallo',
            'c' => 'Hace copias de seguridad de los logs',
            'd' => 'Balancea la carga entre varias instancias'
        ],
        'correcta' => 'b',
        'porque'   => 'Ese reinicio automatico es la diferencia entre «se cayo a las 3 a.m. y nadie se entero hasta las 9» y «se cayo, volvio en dos segundos y quedo en el log». Es el mismo principio que los <b>healthchecks</b> de Docker Compose y Kubernetes, un nivel mas abajo.'
    ],
    'm6' => [
        'texto'    => '&iquest;Por que se recomienda <b>deshabilitar la autenticacion por contraseña</b> en un servidor expuesto a internet?',
        'opciones' => [
            'a' => 'Porque las contraseñas son incomodas de escribir',
            'b' => 'Porque una contraseña se puede <b>adivinar por fuerza bruta</b> — y un servidor publico recibe miles de intentos al dia. Una llave criptografica no es adivinable en la practica',
            'c' => 'Porque SSH no soporta contraseñas largas',
            'd' => 'Porque el cifrado solo funciona con llaves'
        ],
        'correcta' => 'b',
        'porque'   => 'La otra recomendacion del PDF va en la misma linea: <b>cambiar el puerto por defecto (22)</b>. No es seguridad real — un escaneo lo encuentra igual — pero elimina el ruido de los bots automaticos que solo prueban el 22, y con ello tus logs vuelven a ser legibles.'
    ],
    'm7' => [
        'texto'    => 'Quieres traer un archivo <b>desde</b> el servidor a tu maquina con <code>scp</code>. &iquest;Como se escribe?',
        'opciones' => [
            'a' => '<code>scp /ruta/local/ usuario@ip:/ruta/remota/archivo.zip</code>',
            'b' => '<code>scp usuario@ip:/ruta/remota/archivo.zip /ruta/local/</code> — el orden es siempre <b>origen destino</b>, y el lado remoto lleva <code>usuario@ip:</code>',
            'c' => '<code>scp -r usuario@ip</code>',
            'd' => '<code>scp download usuario@ip:/ruta/remota/archivo.zip</code>'
        ],
        'correcta' => 'b',
        'porque'   => '<code>scp</code> se lee igual que <code>cp</code>: <b>de donde</b> y luego <b>a donde</b>. Lo unico que cambia es que cualquiera de los dos lados puede ser remoto anteponiendole <code>usuario@ip:</code>. Para carpetas completas, la bandera <code>-r</code>; con llave, <code>-i key.pem</code>, igual que en SSH.'
    ],
    'm8' => [
        'texto'    => '&iquest;Cuando conviene <code>rsync</code> en lugar de <code>scp</code>?',
        'opciones' => [
            'a' => 'Cuando el archivo es muy pequeño',
            'b' => 'En transferencias <b>recursivas masivas</b> o sincronizaciones <b>periodicas</b>: <code>rsync</code> solo transmite los <b>bloques modificados</b>, en vez de volver a copiar todo desde cero',
            'c' => 'Cuando no hay SSH disponible',
            'd' => 'Cuando se necesita cifrado'
        ],
        'correcta' => 'b',
        'porque'   => 'Piensa en desplegar una carpeta de 2 GB en la que cambiaron tres archivos: <code>scp</code> manda los 2 GB otra vez, <code>rsync</code> manda unos KB. Y ademas es <b>reanudable</b>, asi que una caida de red no te obliga a empezar de nuevo. Los dos viajan cifrados sobre el mismo canal SSH.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Linux · 3 — Background, servicios, SSH y SCP', 'introduccion_linux.pdf — módulos 3 y 4');
?>

<div class="card">
  <h2>1. Segundo plano (background)</h2>

  <table class="datos">
    <tr><th>Operadores y control</th><th>Que hace</th></tr>
    <tr><td><code>comando <?php hueco(1, 4); ?></code></td>
        <td>lanza el comando <b>liberando la consola</b> de inmediato
            (p. ej. <code>node server.js &amp;</code>)</td></tr>
    <tr><td><code><?php hueco(2, 10); ?></code></td>
        <td>pausa la ejecucion actual</td></tr>
    <tr><td><code><?php hueco(3, 5); ?></code></td>
        <td>envia el proceso pausado al segundo plano</td></tr>
    <tr><td><code><?php hueco(4, 5); ?></code></td>
        <td>trae el proceso en segundo plano al frente</td></tr>
  </table>

  <div class="avisoflujo">
    <b>Procesos persistentes.</b> Al cerrar la sesion de terminal, todos sus procesos
    <?php hueco(5, 10); ?> se cierran. Soluciones:
    <ul style="margin:8px 0 0">
      <li><code><?php hueco(6, 10); ?></code>: hace al proceso <b>inmune a la
          <?php hueco(7, 14); ?> fisica</b>
          (p. ej. <code>nohup python3 app.py &amp;</code>).</li>
      <li><b>Terminales virtuales:</b> herramientas como
          <code><?php hueco(8, 8); ?></code> o <code><?php hueco(9, 8); ?></code>
          mantienen sesiones de terminal activas en el servidor.</li>
    </ul>
  </div>

  <h3>Escribelo de memoria</h3>
  <?php linea(31, 'Lanzar <code>node server.js</code> liberando la consola.', 'node ...'); ?>
  <?php linea(32, 'Lanzar <code>python3 app.py</code> en segundo plano <b>e inmune</b> a que cierres la sesion.', 'nohup ...'); ?>

  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Servicios del sistema</h2>
  <p>En servidores de produccion los procesos se ejecutan como <b>servicios</b>
     administrados por <?php hueco(10, 12); ?>.</p>

  <ul>
    <li><b>Comando base:</b> <code><?php hueco(11, 12); ?></code>, que requiere
        permisos de superusuario mediante <code><?php hueco(12, 8); ?></code>.</li>
  </ul>

  <table class="datos">
    <tr><th>Subcomando</th><th>Que hace</th></tr>
    <tr><td><code>sudo systemctl <?php hueco(13, 10); ?> apache2</code></td><td>iniciar</td></tr>
    <tr><td><code>sudo systemctl <?php hueco(14, 10); ?> apache2</code></td><td>detener</td></tr>
    <tr><td><code>sudo systemctl <?php hueco(15, 10); ?> apache2</code></td><td>reiniciar</td></tr>
    <tr><td><code>sudo systemctl <?php hueco(16, 10); ?> apache2</code></td><td>estado de salud</td></tr>
    <tr><td><code>sudo systemctl <?php hueco(17, 10); ?> apache2</code></td>
        <td><b>arranque automatico</b> al encender el servidor</td></tr>
  </table>

  <div class="nota">
    <b>Resiliencia.</b> systemd gestiona las <?php hueco(18, 16); ?> del arranque
    y es capaz de <b>reiniciar aplicaciones automaticamente</b> si detecta un fallo en el
    servicio.
  </div>

  <h3>Escribelo de memoria</h3>
  <?php linea(33, 'Consultar el estado de salud del servicio <code>apache2</code> (con permisos de superusuario).', 'sudo systemctl ...'); ?>
  <?php linea(34, 'Dejar <code>apache2</code> marcado para que arranque solo al encender la maquina.', 'sudo systemctl ...'); ?>

  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Acceso seguro por SSH</h2>
  <p><b>Secure Shell</b> (<code><?php hueco(19, 6); ?></code>)
     <?php hueco(20, 12); ?> la comunicacion para administrar servidores de forma
     remota.</p>

  <ul>
    <li><b>Por contraseña:</b> <code>ssh usuario@ip_del_servidor</code>.</li>
    <li><b>Por llave criptografica:</b>
        <code>ssh <?php hueco(21, 5); ?> ~/.ssh/key<?php hueco(22, 8); ?>
        usuario@ip_del_servidor</code>.</li>
    <li><b>Seguridad de llaves:</b> las llaves privadas nunca deben ser accesibles para
        otros usuarios del sistema — permisos restringidos con
        <code>chmod <?php hueco(25, 6); ?></code>.</li>
  </ul>

  <div class="avisoflujo">
    <b>Mejores practicas.</b> Para servidores expuestos a internet se recomienda
    <b>deshabilitar la autenticacion por contraseña</b> y cambiar el puerto por defecto
    (<?php hueco(23, 6); ?>) para reducir los ataques de
    <?php hueco(24, 16); ?>.
  </div>

  <h3>Escribelo de memoria</h3>
  <?php linea(35, 'Conectarte por SSH usando la llave <code>~/.ssh/key.pem</code> al host <code>usuario@ip_del_servidor</code>.', 'ssh -i ...'); ?>

  <?php mc('m6'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Transferencia con SCP</h2>
  <p><b>Secure Copy Protocol</b> (<code><?php hueco(26, 6); ?></code>) permite copiar
     archivos y directorios <b>cifrados sobre el canal SSH</b>.</p>

  <table class="datos">
    <tr><th>Caso</th><th>Forma</th></tr>
    <tr><td>De local a servidor remoto</td>
        <td><code>scp archivo.zip usuario@ip:/ruta/remota/</code></td></tr>
    <tr><td>Usando llave privada</td>
        <td><code>scp -i key.pem archivo.zip usuario@ip:/ruta/remota/</code></td></tr>
    <tr><td>De servidor a local</td>
        <td><code>scp usuario@ip:/ruta/remota/archivo.zip /ruta/local/</code></td></tr>
    <tr><td>Directorios completos</td>
        <td>con la bandera <code><?php hueco(27, 5); ?></code> (copia recursiva)</td></tr>
  </table>

  <div class="nota">
    <b>Herramienta avanzada.</b> Para transferencia recursiva masiva o sincronizaciones
    periodicas eficientes se prefiere <code><?php hueco(28, 10); ?></code>, que solo
    transmite los bloques de datos <?php hueco(29, 14); ?>.
  </div>

  <h3>Escribelo de memoria</h3>
  <?php linea(36, 'Subir <code>archivo.zip</code> a <code>/ruta/remota/</code> del host <code>usuario@ip</code>.', 'scp ...'); ?>
  <?php linea(37, 'Bajar <code>/ruta/remota/archivo.zip</code> del host <code>usuario@ip</code> hacia <code>/ruta/local/</code>.', 'scp ...'); ?>

  <?php mc('m7'); ?>
  <?php mc('m8'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Linux en la practica DevOps</h2>

  <div class="avisoflujo">
    <b><?php hueco(30, 5); ?> %</b> de la infraestructura moderna en la nube corre
    sobre <b>Linux</b>.
  </div>

  <p>La terminal de comandos no es solo una herramienta: es la <b>interfaz principal</b>
     del ingeniero de DevOps. Dominar la administracion de procesos, permisos y el
     scripting es esencial para automatizar despliegues de contenedores y orquestar
     servidores remotos.</p>

  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('segundo.php', '../Menu.php');
