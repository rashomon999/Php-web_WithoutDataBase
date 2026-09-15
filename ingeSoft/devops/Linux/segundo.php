<?php
/* ==========================================================================
   IngeSoft5 / DevOps / Linux — bloque 02: Permisos, propiedad y procesos
   Fuente: introduccion_linux.pdf — modulos 2 y 3 (primera parte)
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- entidades y permisos --- */
    1  => ['u'],
    2  => ['g'],
    3  => ['o'],
    4  => ['4'],
    5  => ['2'],
    6  => ['1'],
    7  => ['chmod'],
    8  => ['chown'],

    /* --- ejemplos --- */
    9  => ['755'],
    10 => ['400'],
    11 => ['privadas', 'privada'],
    12 => ['-R', 'R'],
    13 => ['www-data'],

    /* --- procesos --- */
    14 => ['pid'],
    15 => ['top'],
    16 => ['htop'],
    17 => ['ps aux'],
    18 => ['grep'],
    19 => ['tuberias', 'pipes'],

    /* --- señales --- */
    20 => ['sigterm'],
    21 => ['kill'],
    22 => ['ordenado'],
    23 => ['sigkill'],
    24 => ['kill -9'],
    25 => ['kernel'],
    26 => ['pkill -f', 'pkill'],
    27 => ['killall'],
    28 => ['corromper'],

    /* --- lineas completas --- */
    29 => 'chmod 755 script.sh',
    30 => 'chmod 400 key.pem',
    31 => 'chown -R www-data:www-data /var/www',
    32 => 'ps aux | grep nginx',
    33 => 'kill -9 [PID]',
    34 => 'pkill -f node',
];

$TEXTO = [11,19,20,22,23,25,28];

$MULTIPLE = [
    'm1' => [
        'texto'    => 'En <code>chmod 755</code>, &iquest;de donde sale el <b>7</b> y de donde el <b>5</b>?',
        'opciones' => [
            'a' => 'Son numeros arbitrarios que hay que memorizar',
            'b' => 'De sumar <b>r=4, w=2, x=1</b>: 7 = 4+2+1 (leer, escribir y ejecutar) para el dueño; 5 = 4+1 (leer y ejecutar, <b>sin</b> escribir) para grupo y otros',
            'c' => 'De la cantidad de usuarios permitidos',
            'd' => 'Del nivel de seguridad del 1 al 9'
        ],
        'correcta' => 'b',
        'porque'   => 'Cada digito es un nivel: <b>dueño · grupo · otros</b>. Sabiendo que r=4, w=2, x=1 puedes construir cualquier permiso de memoria: 644 (archivo normal), 755 (script o carpeta), 400 (llave privada), 600 (archivo secreto que si editas).'
    ],
    'm2' => [
        'texto'    => 'Intentas conectarte con <code>ssh -i key.pem</code> y SSH rechaza la llave diciendo que los permisos son «too open». &iquest;Que hace falta?',
        'opciones' => [
            'a' => '<code>chmod 777 key.pem</code>, para que todos puedan leerla',
            'b' => '<code>chmod 400 key.pem</code>: <b>solo el dueño lee</b> el archivo. SSH se niega a usar una llave privada que otros usuarios del sistema puedan leer',
            'c' => '<code>chmod +x key.pem</code>, para que sea ejecutable',
            'd' => 'Cambiar el dueño a root'
        ],
        'correcta' => 'b',
        'porque'   => 'Es la comprobacion que mas frena a la gente la primera vez que entra a una EC2. Y la negativa de SSH es correcta: una llave privada legible por cualquiera del servidor <b>ya no es privada</b>. Nota: 400 es solo lectura, ni siquiera tu puedes escribirla sin cambiar el permiso.'
    ],
    'm3' => [
        'texto'    => '&iquest;Que diferencia hay entre <code>chmod</code> y <code>chown</code>?',
        'opciones' => [
            'a' => 'Son sinonimos',
            'b' => '<code>chmod</code> cambia <b>que se puede hacer</b> con el archivo (permisos de acceso); <code>chown</code> cambia <b>de quien es</b> (propietario y grupo)',
            'c' => '<code>chmod</code> es para archivos y <code>chown</code> para directorios',
            'd' => '<code>chown</code> borra los permisos existentes'
        ],
        'correcta' => 'b',
        'porque'   => 'Se usan juntos porque los permisos <b>dependen</b> del dueño: de nada sirve poner 640 si el dueño no es el usuario que corre el proceso. De ahi el ejemplo de la diapositiva: <code>chown -R www-data:www-data /var/www</code> para que el usuario del servidor web pueda leer su propio directorio.'
    ],
    'm4' => [
        'texto'    => 'En <code>chown -R www-data:www-data /var/www</code>, &iquest;que hace la <code>-R</code>?',
        'opciones' => [
            'a' => 'Reinicia el servicio despues de cambiar el dueño',
            'b' => 'Aplica el cambio de forma <b>recursiva</b>: al directorio y a <b>todo</b> su contenido, incluidos los subdirectorios',
            'c' => 'Restaura los permisos anteriores',
            'd' => 'Hace el cambio en modo solo lectura'
        ],
        'correcta' => 'b',
        'porque'   => 'Sin <code>-R</code> cambias el dueño de la <b>carpeta</b> pero no de los archivos de dentro, y el servidor web sigue sin poder leerlos — un fallo silencioso tipico. El formato <code>usuario:grupo</code> fija los dos de una vez.'
    ],
    'm5' => [
        'texto'    => '&iquest;Que es exactamente un <b>PID</b>?',
        'opciones' => [
            'a' => 'El nombre del programa',
            'b' => 'El identificador numerico de una <b>instancia</b> de un programa en ejecucion: si abres tres veces la misma app, hay tres PID distintos',
            'c' => 'El puerto que usa el proceso',
            'd' => 'El identificador del usuario dueño'
        ],
        'correcta' => 'b',
        'porque'   => 'Por eso los comandos de señales trabajan con PID y no con nombres: necesitas apuntar a <b>una</b> instancia concreta. Y por eso existe <code>pkill -f</code>, que hace el paso intermedio por ti: busca por nombre y manda la señal a todas las que encuentre.'
    ],
    'm6' => [
        'texto'    => '&iquest;Para que sirve <code>ps aux | grep nginx</code>?',
        'opciones' => [
            'a' => 'Para iniciar nginx',
            'b' => 'Para <b>filtrar</b> la instantanea completa de procesos del sistema (<code>ps aux</code>) y quedarte solo con las lineas que mencionan nginx — su PID, su usuario y su consumo',
            'c' => 'Para ver los logs de nginx',
            'd' => 'Para reiniciar nginx si esta caido'
        ],
        'correcta' => 'b',
        'porque'   => 'La diapositiva lo marca como <b>la base del scripting</b>: <code>ps aux | grep -c mi-app</code> dentro de un script te dice cuantas instancias hay corriendo, y con eso puedes validar automaticamente la salud de un despliegue. Curiosidad: el propio <code>grep</code> suele aparecer en su resultado.'
    ],
    'm7' => [
        'texto'    => '&iquest;Cual es la diferencia entre <code>kill [PID]</code> y <code>kill -9 [PID]</code>?',
        'opciones' => [
            'a' => 'El <code>-9</code> es mas rapido de escribir',
            'b' => '<code>kill</code> envia <b>SIGTERM</b>: una solicitud de cierre <b>ordenado</b> que el proceso puede atender para liberar recursos. <code>kill -9</code> envia <b>SIGKILL</b>: lo termina de inmediato a nivel del kernel, sin darle oportunidad de limpiar',
            'c' => 'Uno mata el proceso y el otro solo lo pausa',
            'd' => 'El <code>-9</code> indica que hay que reintentar 9 veces'
        ],
        'correcta' => 'b',
        'porque'   => 'La advertencia del PDF: <code>kill -9</code> debe ser el <b>ultimo recurso</b>, porque puede corromper datos abiertos o dejar archivos temporales colgados. Con SIGTERM el proceso alcanza a cerrar su conexion a la BD y volcar su buffer; con SIGKILL, no se entera de nada.'
    ],
    'm8' => [
        'texto'    => 'Dejaste veinte procesos de Node colgados tras una prueba. &iquest;Que usas?',
        'opciones' => [
            'a' => '<code>kill</code> veinte veces, uno por PID',
            'b' => '<code>pkill -f node</code> o <code>killall node</code>: finalizan <b>instancias masivas</b> por nombre, sin tener que buscar cada PID',
            'c' => 'Reiniciar el servidor',
            'd' => '<code>ps aux</code>'
        ],
        'correcta' => 'b',
        'porque'   => 'Cuidado con la puntería: <code>pkill -f</code> busca en la <b>linea de comando completa</b>, asi que <code>pkill -f node</code> tambien se lleva por delante cualquier otro proceso que mencione «node». En un servidor compartido, primero <code>pgrep -af node</code> para ver a quien vas a matar.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Linux · 2 — Permisos, propiedad y procesos', 'introduccion_linux.pdf — módulos 2 y 3');
?>

<div class="card">
  <h2>1. Esquema de permisos</h2>
  <p>Tres tipos de acceso para tres niveles de usuario.</p>

  <table class="datos">
    <tr><th>Entidad</th><th>Letra</th><th>Tipo de permiso</th><th>Valor</th></tr>
    <tr><td>Usuario / Dueño</td><td><code><?php hueco(1, 4); ?></code></td>
        <td>Lectura (r)</td><td><?php hueco(4, 4); ?></td></tr>
    <tr><td>Grupo</td><td><code><?php hueco(2, 4); ?></code></td>
        <td>Escritura (w)</td><td><?php hueco(5, 4); ?></td></tr>
    <tr><td>Otros</td><td><code><?php hueco(3, 4); ?></code></td>
        <td>Ejecucion (x)</td><td><?php hueco(6, 4); ?></td></tr>
  </table>

  <ul>
    <li><code><?php hueco(7, 10); ?></code>: modificar permisos de acceso.</li>
    <li><code><?php hueco(8, 10); ?></code>: modificar propietario y grupo.</li>
  </ul>

  <?php mc('m1'); ?>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Ejemplos de configuracion</h2>

  <table class="datos">
    <tr><th>Comando</th><th>Que consigue</th></tr>
    <tr><td><code>chmod <?php hueco(9, 6); ?> script.sh</code></td>
        <td>el dueño lee, escribe y ejecuta (7); grupo y otros leen y ejecutan (5)</td></tr>
    <tr><td><code>chmod <?php hueco(10, 6); ?> key.pem</code></td>
        <td><b>solo el dueño lee</b> el archivo — obligatorio para llaves
            <?php hueco(11, 12); ?> SSH</td></tr>
    <tr><td><code>chown <?php hueco(12, 5); ?>
            <?php hueco(13, 12); ?>:www-data /var/www</code></td>
        <td>cambia la propiedad del directorio web de forma recursiva</td></tr>
  </table>

  <h3>Escribelo de memoria</h3>
  <?php linea(29, 'Dar permisos <b>755</b> a <code>script.sh</code>.', 'chmod ...'); ?>
  <?php linea(30, 'Dejar <code>key.pem</code> legible <b>solo por su dueño</b>.', 'chmod ...'); ?>
  <?php linea(31, 'Cambiar recursivamente el dueño y el grupo de <code>/var/www</code> a <code>www-data</code>.', 'chown ...'); ?>

  <?php mc('m2'); ?>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Manejo de procesos</h2>
  <p>Un proceso es una <b>instancia</b> de un programa en ejecucion, identificado por un
     <?php hueco(14, 6); ?>.</p>

  <table class="datos">
    <tr><th>Comando</th><th>Para que</th></tr>
    <tr><td><code><?php hueco(15, 6); ?></code> o
            <code><?php hueco(16, 6); ?></code></td>
        <td>monitoreo <b>en tiempo real</b>: uso de CPU, memoria y procesos activos</td></tr>
    <tr><td><code><?php hueco(17, 10); ?></code></td>
        <td>instantanea <b>completa</b> de los procesos del sistema</td></tr>
    <tr><td><code>ps aux | <?php hueco(18, 8); ?> nginx</code></td>
        <td>filtrado con <?php hueco(19, 12); ?> para buscar procesos
            especificos</td></tr>
  </table>

  <div class="nota">
    <b>Scripting.</b> El filtrado mediante tuberias con <code>grep</code> es la base para
    escribir scripts en Bash que validen de forma automatizada la salud de tus aplicaciones.
  </div>

  <h3>Escribelo de memoria</h3>
  <?php linea(32, 'Ver todos los procesos del sistema y quedarte solo con los de <code>nginx</code>.', 'ps aux | ...'); ?>

  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Detener procesos: las señales</h2>
  <p>Linux se comunica con los procesos a traves de <b>señales</b> del sistema.</p>

  <table class="datos">
    <tr><th>Señal</th><th>Comando</th><th>Que hace</th></tr>
    <tr><td>Terminacion (<?php hueco(20, 10); ?>)</td>
        <td><code><?php hueco(21, 8); ?> [PID]</code></td>
        <td>solicitud de cierre <?php hueco(22, 12); ?>; permite limpiar
            recursos antes de cerrar</td></tr>
    <tr><td>Apagado forzado (<?php hueco(23, 10); ?>)</td>
        <td><code><?php hueco(24, 10); ?> [PID]</code></td>
        <td>termina el proceso <b>inmediatamente</b> a nivel del
            <?php hueco(25, 10); ?></td></tr>
    <tr><td>Por nombre</td>
        <td><code><?php hueco(26, 10); ?> node</code> o
            <code><?php hueco(27, 10); ?> python</code></td>
        <td>finalizar instancias <b>masivas</b> de aplicaciones</td></tr>
  </table>

  <div class="avisoflujo">
    <b>Advertencia.</b> El uso de la señal forzada (<code>kill -9</code>) debe ser el
    <b>ultimo recurso</b>, ya que puede <?php hueco(28, 14); ?> datos abiertos
    o dejar archivos temporales colgados.
  </div>

  <h3>Escribelo de memoria</h3>
  <?php linea(33, 'Matar <b>a la fuerza</b> el proceso con identificador <code>[PID]</code> (escribe literalmente <code>[PID]</code>).', 'kill ...'); ?>
  <?php linea(34, 'Finalizar por nombre todas las instancias de <code>node</code>, buscando en la linea de comando completa.', 'pkill ...'); ?>

  <?php mc('m7'); ?>
  <?php mc('m8'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('index.php', 'tercero.php');
