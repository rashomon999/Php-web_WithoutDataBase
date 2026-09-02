<?php
/* ==========================================================================
   IngeSoft5 / DevOps / GitBash — parte 2: los retos
   Fuente: Ejercicios_Bash.pdf (retos 1-10 y crontab 1-5) + tus soluciones
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- reto 1: nginx --- */
    1  => ['if [[ -f "$FILE" ]]; then', 'if [[ -f $FILE ]]; then'],
    2  => ['exit 1'],

    /* --- reto 2: root --- */
    3  => ['if [[ "$USER" == "root" ]]; then', 'if [[ $USER == "root" ]]; then'],
    4  => ['if [[ "$EUID" -eq 0 ]]; then', 'if [[ $EUID -eq 0 ]]; then'],

    /* --- reto 3: variable de entorno --- */
    5  => ['if [[ -n "$MI_VARIABLE" ]]; then', 'if [[ -n $MI_VARIABLE ]]; then'],

    /* --- reto 4: df -h en varios servidores --- */
    6  => ['SERVIDORES=("192.168.1.10" "192.168.1.20" "192.168.1.30")'],
    7  => ['for SERVER in "${SERVIDORES[@]}"; do'],
    8  => ['ssh "$SERVER" "df -h"'],

    /* --- reto 5: ping desde archivo --- */
    9  => ['while read -r IP; do'],
    10 => ['done < ips.txt'],
    11 => ['ping -c 1 "$IP"'],

    /* --- reto 6: contenedores exited --- */
    12 => ['docker ps -aq -f status=exited | xargs -r docker rm'],
    13 => ['-aq'],
    14 => ['xargs -r'],

    /* --- reto 7 y 8: HTTP --- */
    15 => ['STATUS=$(curl -s -o /dev/null -w "%{http_code}" https://httpbin.org/status/200)'],
    16 => ['if [[ "$STATUS" -eq 200 ]]; then', 'if [[ $STATUS -eq 200 ]]; then'],
    17 => ['-o /dev/null'],
    18 => ['-w "%{http_code}"'],
    19 => ['-s'],

    /* --- reto 9: puerto escuchando --- */
    20 => ['PORT="$1"'],
    21 => ['if ss -lnt | grep -q ":$PORT "; then'],
    22 => ['-l'],
    23 => ['-q'],

    /* --- reto 10: menu --- */
    24 => ['while true; do', 'while true ; do'],
    25 => ['read -r -p "Seleccione una opción: " OPCION', 'read -r -p "Seleccione una opcion: " OPCION'],
    26 => ['case "$OPCION" in'],
    27 => ['df -h'],
    28 => ['top -bn1 | head -n 5'],
    29 => ['sudo systemctl restart "$SERVICIO"'],
    30 => ['exit 0'],
    31 => ['*)'],
    32 => ['esac'],

    /* --- crontab --- */
    33 => ['0 2 * * *'],
    34 => ['*/5 * * * *'],
    35 => ['0 0 * * 6,0'],
    36 => ['0 * * * *'],
    37 => ['0 4 * * 0'],
    38 => ['FECHA=$(date \'+%Y-%m-%d_%H-%M-%S\')', 'FECHA=$(date "+%Y-%m-%d_%H-%M-%S")'],
    39 => ['who > "/tmp/usuarios_$FECHA.log"'],
    40 => ['free -h'],
    41 => ['docker image prune -a -f'],
    42 => ['>>'],
    43 => ['#!/bin/bash'],
];

$TEXTO = [];

$MULTIPLE = [
    'm1' => [
        'texto'    => 'En el reto 1, &iquest;por que se termina con <code>exit 1</code> y no con <code>exit 0</code>?',
        'opciones' => [
            'a' => 'Da igual, los dos terminan el script',
            'b' => 'Porque <b>0 significa exito</b>: si el archivo no existe hay que devolver un codigo distinto de 0 para que quien llame al script sepa que fallo',
            'c' => 'Porque 1 es mas rapido',
            'd' => 'Porque 0 esta reservado para el sistema'
        ],
        'correcta' => 'b',
        'porque'   => 'Es lo que permite encadenar: <code>./check.sh &amp;&amp; ./deploy.sh</code> solo despliega si el check devolvio 0.'
    ],
    'm2' => [
        'texto'    => 'Reto 2: &iquest;cual es mas fiable, <code>[[ "$USER" == "root" ]]</code> o <code>[[ "$EUID" -eq 0 ]]</code>?',
        'opciones' => [
            'a' => 'La de <code>$USER</code>, porque es mas legible',
            'b' => 'La de <code>$EUID</code>: comprueba el <b>ID efectivo</b> del usuario, que es 0 para root. <code>$USER</code> es una variable de entorno que puede no reflejar el usuario efectivo (por ejemplo bajo <code>sudo</code>)',
            'c' => 'Son exactamente equivalentes',
            'd' => 'Ninguna funciona en Bash'
        ],
        'correcta' => 'b',
        'porque'   => 'Por eso tus apuntes la traen como &laquo;alternativa&raquo;. En scripts que corren bajo sudo o cron, <code>$USER</code> puede mentir; el UID 0 no.'
    ],
    'm3' => [
        'texto'    => 'Reto 5: &iquest;que hace <code>done &lt; ips.txt</code> al final del <code>while</code>?',
        'opciones' => [
            'a' => 'Guarda la salida del bucle en el archivo',
            'b' => '<b>Redirige el archivo como entrada</b> del bucle: cada vuelta, <code>read</code> toma una linea de <code>ips.txt</code>',
            'c' => 'Borra el archivo al terminar',
            'd' => 'Compara el resultado con el archivo'
        ],
        'correcta' => 'b',
        'porque'   => 'Ojo con la direccion de la flecha: <code>&lt;</code> es entrada (leer de), <code>&gt;</code> es salida (escribir en), <code>&gt;&gt;</code> es añadir al final.'
    ],
    'm4' => [
        'texto'    => 'Reto 6: &iquest;que aporta el <code>-r</code> de <code>xargs -r docker rm</code>?',
        'opciones' => [
            'a' => 'Elimina recursivamente',
            'b' => 'Que <b>no ejecute nada si la entrada esta vacia</b>: si no hay contenedores exited, evita llamar a <code>docker rm</code> sin argumentos (que daria error)',
            'c' => 'Ejecuta en modo remoto',
            'd' => 'Reintenta si falla'
        ],
        'correcta' => 'b',
        'porque'   => 'Detalle de guion defensivo: sin <code>-r</code>, un dia sin contenedores parados tu cron job escupe un error en el log todos los dias.'
    ],
    'm5' => [
        'texto'    => 'Reto 7: en <code>curl -s -o /dev/null -w "%{http_code}"</code>, &iquest;que hace <code>-o /dev/null</code>?',
        'opciones' => [
            'a' => 'Silencia los errores',
            'b' => '<b>Tira el cuerpo de la respuesta</b> a la papelera del sistema, porque solo te interesa el codigo de estado, no el HTML',
            'c' => 'Guarda la respuesta en un archivo temporal',
            'd' => 'Limita el tamaño de la descarga'
        ],
        'correcta' => 'b',
        'porque'   => '<code>-s</code> silencia la barra de progreso, <code>-o /dev/null</code> descarta el cuerpo y <code>-w "%{http_code}"</code> imprime solo el codigo. Los tres juntos dejan la salida limpia para meterla en una variable.'
    ],
    'm6' => [
        'texto'    => 'Reto 9: &iquest;por que <code>grep -q ":$PORT "</code> lleva un <b>espacio</b> despues del puerto?',
        'opciones' => [
            'a' => 'Por legibilidad',
            'b' => 'Para no confundir puertos: sin el espacio, buscar <code>:80</code> tambien encontraria <code>:8080</code> y <code>:8000</code>',
            'c' => 'Porque grep lo exige',
            'd' => 'Para separar la salida en columnas'
        ],
        'correcta' => 'b',
        'porque'   => 'Es un bug clasico de scripts de monitoreo: el puerto 80 &laquo;aparece escuchando&raquo; solo porque hay un 8080 abierto.'
    ],
    'm7' => [
        'texto'    => 'Reto 10: el menu combina tres estructuras. &iquest;Cuales?',
        'opciones' => [
            'a' => '<code>for</code>, <code>if</code> y <code>exit</code>',
            'b' => '<code>while true</code> (repetir el menu), <code>read</code> (leer la opcion) y <code>case</code> (decidir que hacer)',
            'c' => '<code>until</code>, <code>select</code> y <code>trap</code>',
            'd' => '<code>if</code>, <code>elif</code> y <code>else</code>'
        ],
        'correcta' => 'b',
        'porque'   => 'Y el <code>exit 0</code> de la opcion 4 es lo unico que rompe el <code>while true</code>. Sin el, el menu no tendria salida.'
    ],
    'm8' => [
        'texto'    => 'Crontab: <code>0 0 * * 6,0</code> se ejecuta...',
        'opciones' => [
            'a' => 'Todos los dias a medianoche',
            'b' => 'Sabados y domingos a las 00:00 (6 = sabado, 0 = domingo)',
            'c' => 'El dia 6 y el dia 0 de cada mes',
            'd' => 'Cada 6 horas'
        ],
        'correcta' => 'b',
        'porque'   => 'El quinto campo es el dia de la semana, con domingo = 0. La coma permite listar varios valores.'
    ],
    'm9' => [
        'texto'    => 'En el reto 12 el script usa <code>&gt;&gt;</code> y no <code>&gt;</code> para escribir el log. &iquest;Por que importa?',
        'opciones' => [
            'a' => 'Porque <code>&gt;</code> no funciona con rutas absolutas',
            'b' => 'Porque <code>&gt;</code> <b>sobrescribe</b> el archivo y <code>&gt;&gt;</code> <b>añade al final</b>: con <code>&gt;</code> cada ejecucion borraria el historial anterior',
            'c' => 'Porque <code>&gt;&gt;</code> es mas rapido',
            'd' => 'Porque <code>&gt;</code> necesita permisos de root'
        ],
        'correcta' => 'b',
        'porque'   => 'En un script que corre cada 5 minutos por cron, esa diferencia es entre tener un historial y tener siempre la ultima medicion nada mas.'
    ],
    'm10' => [
        'texto'    => 'En el proyecto <code>simulacion-despliegue-devops</code> los scripts son <code>.ps1</code> (PowerShell), no Bash. Si la guia pide Bash, &iquest;que hay que hacer?',
        'opciones' => [
            'a' => 'Nada, es lo mismo',
            'b' => 'Aclararlo en el reporte y decir que se pueden adaptar a Bash en Linux/macOS — es lo que dice tu propio README',
            'c' => 'Borrar los scripts',
            'd' => 'Ejecutarlos con <code>bash script.ps1</code>'
        ],
        'correcta' => 'b',
        'porque'   => 'Las tres primeras lineas del <code>.ps1</code> (politica de ejecucion, ubicar el directorio del script, moverse ahi) tienen equivalente casi directo en Bash: <code>chmod +x</code>, <code>cd "$(dirname "$0")"</code>.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Bash · 2 — los 15 retos', 'Ejercicios_Bash.pdf — escribe la linea clave de cada script');
?>

<div class="card">
  <h2>Como se usa</h2>
  <p>Aqui no se pide el script entero: se pide <b>la linea que lo resuelve</b>, que es lo que
     de verdad hay que tener en los dedos. El resto del script esta escrito alrededor.</p>
  <div class="nota">Estas son tus propias soluciones. Los espacios sobrantes y las comillas
    simples/dobles dan igual, pero los guiones y las mayusculas <b>si</b> cuentan.</div>
</div>


<div class="card">
  <h2>Reto 1 — &iquest;Existe el archivo de configuracion de nginx?</h2>
  <p>Si no existe, hay que retornar un status code de 1.</p>

  <pre><code><?php hueco(43, 11); ?>

FILE="/etc/nginx/nginx.conf"

<?php linea(1, 'la condicion: verdadero si es un <b>archivo regular</b> y existe', 'if [[ ... ]]; then'); ?>
    echo "El archivo existe"
else
    echo "El archivo NO existe"
    <?php linea(2, 'termina el script indicando <b>fallo</b>', 'exit ...'); ?>
fi</code></pre>

  <?php mc('m1'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>Reto 2 — &iquest;El usuario actual es root?</h2>

  <?php linea(3, 'version con el <b>nombre</b> del usuario (comparacion de strings)', 'if [[ ... ]]; then'); ?>
  <?php linea(4, 'version con el <b>ID efectivo</b> (comparacion numerica)', 'if [[ ... ]]; then'); ?>

  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>Reto 3 — &iquest;Esta definida una variable de entorno?</h2>

  <?php linea(5, 'verdadero si <code>MI_VARIABLE</code> <b>no</b> esta vacia', 'if [[ ... ]]; then'); ?>
  <?php ayuda('El operador de string que comprueba &laquo;no vacio&raquo; es <code>-n</code>. El contrario, &laquo;vacio&raquo;, es <code>-z</code>.'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>Reto 4 — <code>df -h</code> sobre varios servidores</h2>

  <pre><code>#!/bin/bash

<?php linea(6, 'declara un <b>array</b> con las tres IPs 192.168.1.10, .20 y .30', 'SERVIDORES=(...)'); ?>
<?php linea(7, 'itera sobre <b>todos los elementos</b> del array', 'for ... ; do'); ?>
    echo "Servidor: $SERVER"
    <?php linea(8, 'ejecuta <code>df -h</code> en la maquina remota', 'ssh ...'); ?>
done</code></pre>

  <?php ayuda('La forma segura de recorrer un array es <code>"${ARRAY[@]}"</code>, entre comillas, para que los elementos con espacios no se partan.'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>Reto 5 — Ping a las IPs de un archivo</h2>
  <p>El archivo <code>ips.txt</code> tiene una IP por linea.</p>

  <pre><code>#!/bin/bash

<?php linea(9, 'lee el archivo <b>linea a linea</b> guardando cada una en <code>IP</code>', 'while ... ; do'); ?>
    <?php linea(11, 'lanza <b>un solo</b> paquete de ping a esa IP', 'ping ...'); ?>
    if [[ $? -eq 0 ]]; then
        echo "$IP responde"
    else
        echo "$IP no responde"
    fi
<?php linea(10, 'cierra el bucle <b>alimentandolo</b> con el archivo', 'done ...'); ?></code></pre>

  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>Reto 6 — Eliminar los contenedores en estado <code>exited</code></h2>

  <?php linea(12, 'la linea completa: lista los contenedores parados y se los pasa a <code>docker rm</code>', 'docker ps ... | xargs ...'); ?>

  <p>Por partes:</p>
  <table class="datos">
    <tr><th>Trozo</th><th>Que hace</th></tr>
    <tr><td><code>docker ps <?php hueco(13, 7); ?> -f status=exited</code></td><td><code>-a</code> incluye los parados, <code>-q</code> devuelve <b>solo los IDs</b></td></tr>
    <tr><td><code><?php hueco(14, 10); ?> docker rm</code></td><td>convierte esa lista de IDs en argumentos, y no ejecuta nada si la lista viene vacia</td></tr>
  </table>

  <div class="nota"><b>Precaucion:</b> es una operacion destructiva. Elimina contenedores detenidos.</div>

  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>Retos 7 y 8 — El status code de un servicio HTTP</h2>

  <pre><code>#!/bin/bash

<?php linea(15, 'guarda en <code>STATUS</code> <b>solo</b> el codigo HTTP de <code>https://httpbin.org/status/200</code>', 'STATUS=$(curl ...)'); ?>
<?php linea(16, 'comprueba si ese codigo es <b>igual a 200</b> (comparacion numerica)', 'if [[ ... ]]; then'); ?>
    echo "Servicio arriba"
else
    echo "Servicio abajo. Status code: $STATUS"
fi</code></pre>

  <p>Las tres banderas de <code>curl</code> que hacen el truco:</p>
  <table class="datos">
    <tr><th>Bandera</th><th>Que hace</th></tr>
    <tr><td><?php hueco(19, 6); ?></td><td>modo silencioso: quita la barra de progreso</td></tr>
    <tr><td><?php hueco(17, 14); ?></td><td>descarta el cuerpo de la respuesta</td></tr>
    <tr><td><?php hueco(18, 20); ?></td><td>imprime unicamente el codigo de estado</td></tr>
  </table>

  <?php mc('m5'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>Reto 9 — &iquest;Esta escuchando un puerto?</h2>
  <p>El puerto llega como parametro.</p>

  <pre><code>#!/bin/bash

<?php linea(20, 'recoge el <b>primer parametro</b> del script en <code>PORT</code>', 'PORT=...'); ?>

<?php linea(21, 'busca ese puerto entre los sockets TCP que estan <b>escuchando</b>', 'if ss ... | grep ...; then'); ?>
    echo "El puerto $PORT está escuchando."
else
    echo "El puerto $PORT NO está escuchando."
fi</code></pre>

  <table class="datos">
    <tr><th>Trozo</th><th>Que hace</th></tr>
    <tr><td><code>ss <?php hueco(22, 5); ?>nt</code></td><td>la bandera que filtra solo los sockets en estado <em>listening</em></td></tr>
    <tr><td><code>grep <?php hueco(23, 5); ?></code></td><td>busca sin imprimir nada: solo devuelve el status code</td></tr>
  </table>

  <?php mc('m6'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>Reto 10 — El menu</h2>
  <p>El reto que junta <code>while</code>, <code>read</code> y <code>case</code>.</p>

  <pre><code>#!/bin/bash

<?php linea(24, 'repetir el menu para siempre', 'while ... ; do'); ?>
    echo "1. Ver uso de disco"
    echo "2. Ver uso de CPU"
    echo "3. Reiniciar servicio"
    echo "4. Salir"

    <?php linea(25, 'pide la opcion y la guarda en <code>OPCION</code>', 'read ...'); ?>

    <?php linea(26, 'abre la evaluacion de esa variable', 'case ... in'); ?>
        1)
            <?php linea(27, 'uso de disco, legible para humanos', 'comando...'); ?>
            ;;
        2)
            <?php linea(28, 'uso de CPU: una sola pasada de <code>top</code>, primeras 5 lineas', 'comando...'); ?>
            ;;
        3)
            read -r -p "Ingrese el nombre del servicio: " SERVICIO
            <?php linea(29, 'reinicia ese servicio con systemd', 'comando...'); ?>
            ;;
        4)
            echo "Saliendo..."
            <?php linea(30, 'sale del script indicando <b>exito</b>', 'exit ...'); ?>
            ;;
        <?php hueco(31, 6); ?>
            echo "Opción inválida."
            ;;
    <?php hueco(32, 8); ?>
done</code></pre>

  <?php ayuda('<code>top -bn1</code>: <code>-b</code> modo batch (no interactivo) y <code>-n1</code> una sola iteracion, para poder pasarlo por un pipe.'); ?>

  <?php mc('m7'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>Retos de crontab</h2>

  <table class="datos">
    <tr><th>Lo que se pide</th><th>La linea de cron</th></tr>
    <tr><td>Todos los dias a las <b>2 AM</b></td><td><?php hueco(33, 16); ?></td></tr>
    <tr><td>Cada <b>5 minutos</b></td><td><?php hueco(34, 16); ?></td></tr>
    <tr><td><b>Sabados y domingos</b> a medianoche</td><td><?php hueco(35, 16); ?></td></tr>
    <tr><td>Cada hora, en el <b>minuto 0</b></td><td><?php hueco(36, 16); ?></td></tr>
    <tr><td><b>Domingos a las 4 AM</b></td><td><?php hueco(37, 16); ?></td></tr>
  </table>

  <h3>Reto 12 — CPU y RAM a un log</h3>
  <pre><code>#!/bin/bash

FECHA=$(date '+%Y-%m-%d %H:%M:%S')
echo "===== $FECHA =====" <?php hueco(42, 5); ?> /var/log/system_health.log
top -bn1 | grep "Cpu(s)" &gt;&gt; /var/log/system_health.log
<?php linea(40, 'memoria RAM, legible para humanos', 'comando...'); ?> &gt;&gt; /var/log/system_health.log</code></pre>

  <?php mc('m9'); ?>

  <h3>Reto 14 — Usuarios conectados, con la fecha en el nombre</h3>
  <pre><code>#!/bin/bash

<?php linea(38, 'guarda la fecha y hora en un formato valido para un <b>nombre de archivo</b> (sin espacios ni dos puntos)', 'FECHA=$(date ...)'); ?>
<?php linea(39, 'escribe los usuarios conectados en <code>/tmp/usuarios_FECHA.log</code>', 'who ...'); ?></code></pre>

  <h3>Reto 15 — Limpiar imagenes de Docker sin usar</h3>
  <?php linea(41, 'el comando, <b>sin pedir confirmacion</b> (porque en cron no hay nadie para responder)', 'docker image ...'); ?>

  <?php mc('m8'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>Extra — Los scripts de despliegue del proyecto</h2>
  <p>En <code>simulacion-despliegue-devops-main</code> los scripts son <b>PowerShell</b>,
     no Bash. Sus tres primeras lineas hacen lo mismo en los dos:</p>

  <table class="datos">
    <tr><th>PowerShell</th><th>Que hace</th><th>Equivalente en Bash</th></tr>
    <tr><td><code>Set-ExecutionPolicy Bypass -Scope Process</code></td><td>permitir ejecutar scripts, solo en este proceso</td><td><code>chmod +x script.sh</code></td></tr>
    <tr><td><code>$scriptDir = Split-Path -Parent $MyInvocation...</code></td><td>averiguar en que carpeta esta el propio script</td><td><code>dirname "$0"</code></td></tr>
    <tr><td><code>Set-Location $scriptDir</code></td><td>moverse a esa carpeta</td><td><code>cd "$(dirname "$0")"</code></td></tr>
  </table>

  <div class="avisoflujo">
    <b>Por que importa.</b> Sin esas tres lineas, el script solo funciona si lo lanzas desde
    la carpeta correcta. Con ellas, funciona lo llames desde donde lo llames — que es
    justo el punto de automatizar el despliegue.
  </div>

  <p>El resto del <code>deploy-backend.ps1</code>: abre el puerto <b>8080</b> en el firewall
     (regla <code>CalculatorBackend8080</code>), compila con <code>mvn clean package
     -DskipTests</code> y arranca el JAR. El <code>deploy-frontend.ps1</code> escribe
     <code>VITE_API_BASE_URL</code> en <code>.env.local</code>, instala dependencias si no
     existen y levanta Vite con <code>npm run dev -- --host</code> en el puerto <b>5173</b>.</p>

  <?php mc('m10'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('index.php', '../Docker/index.php');
