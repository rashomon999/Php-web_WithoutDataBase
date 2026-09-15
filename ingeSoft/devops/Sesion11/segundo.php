<?php
/* ==========================================================================
   IngeSoft5 / DevOps / Sesion 11 — bloque 02: Alternativas de despliegue
   Fuente: sesion_11_computacion_nube_patrones.pdf
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- el espectro --- */
    1  => ['iaas'],
    2  => ['caas'],
    3  => ['paas'],
    4  => ['faas'],
    5  => ['abstraccion'],
    6  => ['control'],
    7  => ['mantenimiento'],
    8  => ['bare metal', 'on-premise'],
    9  => ['ec2'],
    10 => ['kubernetes', 'k8s'],
    11 => ['lambda'],

    /* --- IaaS --- */
    12 => ['una maquina virtual limpia', 'vm'],
    13 => ['instalar y parchar el SO', 'parchear'],
    14 => ['lift-and-shift', 'lift and shift'],
    15 => ['kernel'],

    /* --- PaaS --- */
    16 => ['un runtime'],
    17 => ['codigo'],
    18 => ['sysadmins', 'sysadmin'],

    /* --- CaaS --- */
    19 => ['imagen docker', 'imagen'],
    20 => ['long-running', 'continuos'],
    21 => ['portabilidad'],

    /* --- FaaS --- */
    22 => ['funcion'],
    23 => ['eventos'],
    24 => ['efimero'],
    25 => ['cero'],
    26 => ['cold starts', 'cold start', 'arranques en frio'],

    /* --- responsabilidad compartida --- */
    27 => ['cliente'],
    28 => ['cliente'],
    29 => ['proveedor'],
    30 => ['cliente'],
    31 => ['proveedor'],
    32 => ['cliente'],
    33 => ['proveedor'],
    34 => ['proveedor'],
    35 => ['proveedor'],
    36 => ['de la nube'],
    37 => ['en la nube'],

    /* --- la regla --- */
    38 => ['mayor'],
    39 => ['latencia'],
    40 => ['costo'],

    41 => ['App Service'],
    42 => ['IaaS'],
    43 => ['PaaS'],

    ];

$TEXTO = range(1, 40);

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Ordena de <b>mas control</b> a <b>mas abstraccion</b>:',
        'opciones' => [
            'a' => 'FaaS &rarr; PaaS &rarr; CaaS &rarr; IaaS &rarr; On-Premise',
            'b' => 'On-Premise &rarr; IaaS &rarr; CaaS &rarr; PaaS &rarr; FaaS',
            'c' => 'IaaS &rarr; On-Premise &rarr; PaaS &rarr; CaaS &rarr; FaaS',
            'd' => 'On-Premise &rarr; CaaS &rarr; IaaS &rarr; FaaS &rarr; PaaS'
        ],
        'correcta' => 'b',
        'porque'   => 'Es un <b>continuo</b>, no cinco cajas sueltas. A la izquierda tienes el kernel en las manos y todo el mantenimiento encima; a la derecha solo escribes una funcion, pero ya no decides casi nada.'
    ],
    /* m2 quedo sin mostrarse en la pagina (su idea esta ahora en el texto del bloque 1).
       Se deja comentada para que no cuente como pregunta en blanco en el marcador.
       Si quieres volver a usarla: descomenta y añade <?php mc('m2'); ?> donde toque.
           'm2' => [
               'texto'    => '&iquest;Cual es el <b>dilema central</b> del espectro?',
               'opciones' => [
                   'a' => 'A mayor abstraccion, mayor costo',
                   'b' => 'A mayor abstraccion, mayor <b>velocidad de desarrollo</b> y menor mantenimiento — a cambio de <b>ceder control fino</b> de configuracion',
                   'c' => 'A mayor control, mayor velocidad',
                   'd' => 'A mayor abstraccion, menor seguridad'
               ],
               'correcta' => 'b',
               'porque'   => 'No hay opcion &laquo;mejor&raquo;: hay un intercambio. Lo que ganas en velocidad lo pagas en control, y al reves.'
           ],
    */
    'm3' => [
        'texto'    => 'La <b>regla de arquitectura</b> de la sesion dice:',
        'opciones' => [
            'a' => 'Elija siempre serverless, es lo mas moderno',
            'b' => 'Elija el <b>mayor nivel de abstraccion</b> que cumpla sus requisitos de latencia y costo',
            'c' => 'Elija siempre IaaS para tener control',
            'd' => 'Elija segun el proveedor mas barato'
        ],
        'correcta' => 'b',
        'porque'   => 'Dicho al reves: no bajes de nivel <em>salvo que tengas una razon concreta</em>. Cada escalon que bajas es trabajo de mantenimiento que alguien de tu equipo tendra que hacer para siempre.'
    ],
    'm4' => [
        'texto'    => 'Vas a migrar un sistema legado tal cual esta, con una configuracion rara de kernel. &iquest;Que eliges?',
        'opciones' => [
            'a' => 'FaaS',
            'b' => 'PaaS',
            'c' => 'IaaS — es el caso de uso de lift-and-shift y de configuraciones especiales de kernel',
            'd' => 'SaaS'
        ],
        'correcta' => 'c',
        'porque'   => 'Es justamente cuando <em>si</em> vale la pena bajar de nivel: si necesitas tocar el SO, ningun PaaS te va a dejar.'
    ],
    'm5' => [
        'texto'    => 'En <b>PaaS</b>, &iquest;de que eres responsable exactamente?',
        'opciones' => [
            'a' => 'Del SO, las librerias y el codigo',
            'b' => 'Exclusivamente del <b>codigo</b> y las <b>variables de configuracion</b>',
            'c' => 'De la virtualizacion y el hardware',
            'd' => 'De nada, el proveedor lo hace todo'
        ],
        'correcta' => 'b',
        'porque'   => 'El proveedor te entrega un <b>runtime listo</b> (Node, Python, Java Spring) y se encarga de parchar el SO y el middleware. Tu subes codigo.'
    ],
    'm6' => [
        'texto'    => 'Tu servicio necesita <b>WebSockets persistentes</b> y esta siempre activo. &iquest;CaaS o FaaS?',
        'opciones' => [
            'a' => 'FaaS, escala a cero',
            'b' => '<b>CaaS</b>: los contenedores sirven para servicios continuos (long-running), APIs con estado o WebSockets. FaaS es efimero, de milisegundos a minutos',
            'c' => 'Da igual, los dos sirven',
            'd' => 'Ninguno, hace falta IaaS'
        ],
        'correcta' => 'b',
        'porque'   => 'Una funcion que vive segundos no puede sostener una conexion abierta durante horas. El ciclo de vida es lo que decide, no la moda.'
    ],
    'm7' => [
        'texto'    => 'Que FaaS <b>escale a CERO</b> en inactividad significa que...',
        'opciones' => [
            'a' => 'El servicio se borra',
            'b' => 'Cuando nadie lo usa no hay instancias corriendo y <b>no pagas nada</b> — pero la siguiente peticion paga el precio del arranque en frio',
            'c' => 'Que tiene cero latencia',
            'd' => 'Que no admite mas de cero conexiones simultaneas'
        ],
        'correcta' => 'b',
        'porque'   => 'Es la ventaja y el desafio a la vez. Escalar a cero es imbatible en costo para cargas esporadicas; el <b>cold start</b> es el precio, y por eso no sirve para todo.'
    ],
    'm8' => [
        'texto'    => '&iquest;Cual es la <b>ventaja principal</b> de CaaS segun la sesion?',
        'opciones' => [
            'a' => 'Que es lo mas barato',
            'b' => 'Maxima <b>portabilidad multi-cloud</b> sin alterar el codigo de la aplicacion',
            'c' => 'Que no requiere mantenimiento',
            'd' => 'Que escala a cero'
        ],
        'correcta' => 'b',
        'porque'   => 'La imagen Docker es la misma en AWS, Azure o en tu portatil. Eso ataca directamente el <em>bloqueo de proveedor</em>, que aparece como criterio de decision al final de la sesion.'
    ],
    'm9' => [
        'texto'    => 'En el modelo de responsabilidad compartida, &iquest;quien es responsable de los <b>datos y accesos</b>?',
        'opciones' => [
            'a' => 'El proveedor, siempre',
            'b' => 'El <b>cliente</b>, en los cuatro modelos — incluso en SaaS/FaaS',
            'c' => 'El cliente solo en on-premise',
            'd' => 'Se reparte al 50 %'
        ],
        'correcta' => 'b',
        'porque'   => 'Es la fila que <b>nunca</b> cambia de dueño. Por muy gestionado que sea el servicio, si dejas un bucket publico o repartes credenciales de admin, eso es tuyo.'
    ],
    'm10' => [
        'texto'    => 'Seguridad <b>de</b> la nube vs. seguridad <b>en</b> la nube:',
        'opciones' => [
            'a' => 'Son la misma cosa',
            'b' => 'Seguridad <b>de</b> la nube = el proveedor protege hardware y red; seguridad <b>en</b> la nube = el cliente protege sus accesos y sus datos',
            'c' => 'Seguridad de la nube la hace el cliente',
            'd' => 'Depende del modelo contratado'
        ],
        'correcta' => 'b',
        'porque'   => 'Una preposicion que cambia todo. La mayoria de brechas reales no son fallos del proveedor: son configuraciones del cliente.'
    ],
    'm11' => [
        'texto'    => 'Procesas <b>50 millones de eventos al dia de forma continua</b>. &iquest;Lambda o Kubernetes? (pregunta 1 de la discusion)',
        'opciones' => [
            'a' => 'Lambda, porque escala solo',
            'b' => '<b>CaaS (K8s) con instancias reservadas es drasticamente mas economico</b>: FaaS cobra por millon de invocaciones y GB-s, y es optimo para cargas <em>esporadicas</em>, no continuas',
            'c' => 'Da igual, cuestan lo mismo',
            'd' => 'IaaS con maquinas grandes'
        ],
        'correcta' => 'b',
        'porque'   => 'La regla practica: serverless gana cuando la carga es <b>irregular y baja en promedio</b>. Con carga constante y alta, pagar por invocacion sale carisimo frente a reservar capacidad.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Sesión 11 · 2 — Alternativas de infraestructura', 'sesion_11_computacion_nube_patrones.pdf — bloque 02');
?>

<div class="card">
  <h2>1. El espectro de opciones de despliegue</h2>
  <p>No son cuatro cosas distintas: son un <b>continuo</b> entre control total y abstraccion.</p>

  <style>
  .espectro{margin:20px 0 6px}
  .espectro .eje{display:flex;align-items:center;gap:10px;font-size:14.5px;font-weight:600}
  .espectro .eje .linea{flex:1;height:5px;border-radius:3px;min-width:20px}
  .espectro .eje .pta{font-size:19px;line-height:1}
  .espectro .eje-arriba{color:#12703a}
  .espectro .eje-arriba .linea{background:linear-gradient(90deg,#b7e3c8,#1a7f37)}
  .espectro .eje-abajo{color:#3f34b8;margin-top:16px}
  .espectro .eje-abajo .linea{background:linear-gradient(90deg,#3f34b8,#c4bff5)}
  .espectro .niveles{display:flex;align-items:stretch;justify-content:center;
                     gap:6px;margin:16px 0 0;flex-wrap:wrap}
  .espectro .nivel{flex:1 1 160px;min-width:150px;border:2px solid;border-radius:11px;
                   padding:12px 8px;text-align:center;display:flex;flex-direction:column;
                   justify-content:center;gap:6px}
  .espectro .nivel .nom{font-size:15px;font-weight:700;color:#2f3a48;line-height:1.35}
  .espectro .nivel .ej{font-family:Consolas,Menlo,monospace;font-size:12.5px;color:#5a6472}
  .espectro .nivel .nom .hueco{width:120px;text-align:center;font-size:14px;font-weight:700}
  .espectro .nivel .ej .hueco{width:96px;text-align:center;font-size:12.5px}
  .espectro .fl{align-self:center;color:#9aa3ad;font-size:20px;font-weight:700}
  .n-onprem{border-color:#2f3a48;background:#f4f5f7}
  .n-iaas  {border-color:#8b93e8;background:#eef0fd}
  .n-caas  {border-color:#b07fd8;background:#f7eefc}
  .n-paas  {border-color:#5bbd85;background:#eaf7ef}
  .n-faas  {border-color:#e8a25c;background:#fdf2e6}
  @media(max-width:780px){
    .espectro .niveles{flex-direction:column;align-items:stretch}
    .espectro .fl{transform:rotate(90deg);margin:1px 0}
    .espectro .eje{font-size:13.5px}
  }
  </style>

  <div class="espectro">

    <div class="eje eje-arriba">
      <span class="pta">&#10230;</span>
      <span>Mayor <?php hueco(5, 14); ?>, velocidad y foco en negocio</span>
      <span class="linea"></span>
      <span class="pta">&#10230;</span>
    </div>

    <div class="niveles">

      <div class="nivel n-onprem">
        <div class="nom">On-Premise<br><?php hueco(8, 14); ?></div>
      </div>

      <span class="fl">&rarr;</span>

      <div class="nivel n-iaas">
        <div class="nom"><?php hueco(1, 8); ?></div>
        <div class="ej">(<?php hueco(9, 8); ?> / VMs)</div>
      </div>

      <span class="fl">&rarr;</span>

      <div class="nivel n-caas">
        <div class="nom"><?php hueco(2, 8); ?></div>
        <div class="ej">(<?php hueco(10, 12); ?> / ECS)</div>
      </div>

      <span class="fl">&rarr;</span>

      <div class="nivel n-paas">
        <div class="nom"><?php hueco(3, 8); ?></div>
        <div class="ej">(<?php hueco(41, 8); ?>)</div>
      </div>

      <span class="fl">&rarr;</span>

      <div class="nivel n-faas">
        <div class="nom"><?php hueco(4, 8); ?></div>
        <div class="ej">(<?php hueco(11, 10); ?>)</div>
      </div>

    </div>

    <div class="eje eje-abajo">
      <span class="pta">&#10229;</span>
      <span class="linea"></span>
      <span>Mayor <?php hueco(6, 12); ?> de kernel y carga de <?php hueco(7, 16); ?></span>
      <span class="pta">&#10229;</span>
    </div>

  </div>

  <div class="avisoflujo">
    <b>Regla de arquitectura.</b> Elija el <?php hueco(38, 8); ?> nivel de
    abstraccion que cumpla sus requisitos de <?php hueco(39, 12); ?> y
    <?php hueco(40, 10); ?>.
  </div>

  <p> A mayor abstraccion, mayor velocidad de desarrollo y menor mantenimiento — a cambio de ceder control fino de configuracion</p>
  <?php mc('m1'); ?>
 
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. IaaS vs. PaaS: cuando elegir cada uno</h2>

  <table class="datos">
    <tr><th></th><th><?php hueco(42, 5); ?></th><th><?php hueco(43, 5); ?></th></tr>
    <tr><td><b>Entregable</b></td>
        <td>  <?php hueco(12, 26); ?>  , con vCPU y RAM</td>
        <td>  <?php hueco(16, 13); ?> listo para ejecutar codigo (Node.js, Python, Java Spring)</td></tr>
    <tr><td><b>Responsabilidad</b></td>
        <td><?php hueco(13, 24); ?>  , librerias, servidores web y agentes de seguridad</td>
        <td>exclusivamente el <?php hueco(17, 10); ?> y las variables de configuracion</td></tr>
    <tr><td><b>Casos de uso</b></td>
        <td>migraciones legadas (<?php hueco(14, 16); ?>) o configuraciones especiales de <?php hueco(15, 10); ?></td>
        <td>APIs estandar, portales web y despliegues rapidos sin <?php hueco(18, 14); ?></td></tr>
  </table>

  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. CaaS vs. FaaS (serverless)</h2>

  <table class="datos">
    <tr><th></th><th>CaaS — contenedores (ECS / Kubernetes)</th><th>FaaS — serverless (AWS Lambda)</th></tr>
    <tr><td><b>Unidad</b></td>
        <td>una <?php hueco(19, 16); ?> inmutable</td>
        <td>una <?php hueco(22, 12); ?> ejecutada por <?php hueco(23, 12); ?>
            (HTTP, cola SQS, carga en S3)</td></tr>
    <tr><td><b>Ciclo de vida</b></td>
        <td>servicios <?php hueco(20, 14); ?>, APIs con estado o WebSockets</td>
        <td><?php hueco(24, 12); ?>: de milisegundos a minutos. Escala a
            <?php hueco(25, 8); ?> en inactividad</td></tr>
    <tr><td><b>Ventaja / desafio</b></td>
        <td>maxima <?php hueco(21, 14); ?> multi-cloud sin alterar el codigo</td>
        <td>los <?php hueco(26, 16); ?> y los limites de tiempo de procesamiento</td></tr>
  </table>

  <?php mc('m6'); ?>
  <?php mc('m7'); ?>
  <?php mc('m8'); ?>
  <?php mc('m11'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Modelo de responsabilidad compartida</h2>
  <p>Rellena quien responde por cada capa. Fijate en <b>donde cae la frontera</b> en cada columna:
     es lo unico que hay que memorizar.</p>

  <table class="datos">
    <tr><th>Capa del stack</th><th>On-Premise</th><th>IaaS</th><th>PaaS</th><th>SaaS / FaaS</th></tr>
    <tr><td>Datos y accesos</td><td>CLIENTE</td><td>CLIENTE</td><td>CLIENTE</td>
        <td><?php hueco(27, 12); ?></td></tr>
    <tr><td>Aplicacion / codigo</td><td>CLIENTE</td><td>CLIENTE</td><td><?php hueco(28, 12); ?></td>
        <td><?php hueco(29, 12); ?></td></tr>
    <tr><td>Runtime &amp; middleware</td><td>CLIENTE</td><td><?php hueco(30, 12); ?></td>
        <td><?php hueco(31, 12); ?></td><td>PROVEEDOR</td></tr>
    <tr><td>Sistema operativo</td><td>CLIENTE</td><td><?php hueco(32, 12); ?></td>
        <td>PROVEEDOR</td><td>PROVEEDOR</td></tr>
    <tr><td>Virtualizacion</td><td>CLIENTE</td><td><?php hueco(33, 12); ?></td>
        <td>PROVEEDOR</td><td>PROVEEDOR</td></tr>
    <tr><td>Servidores / HW</td><td>CLIENTE</td><td><?php hueco(34, 12); ?></td>
        <td>PROVEEDOR</td><td>PROVEEDOR</td></tr>
    <tr><td>Red y datacenter</td><td>CLIENTE</td><td><?php hueco(35, 12); ?></td>
        <td>PROVEEDOR</td><td>PROVEEDOR</td></tr>
  </table>

  <div class="avisoflujo">
    Seguridad <b><?php hueco(36, 12); ?></b> (proveedor: hardware y red)
    vs. seguridad <b><?php hueco(37, 12); ?></b> (cliente: accesos y datos).
  </div>

  <?php mc('m9'); ?>
  <?php mc('m10'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('index.php', 'tercero.php');
