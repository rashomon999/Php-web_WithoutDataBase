<?php
/* ==========================================================================
   IngeSoft5 / DevOps / Sesion 3 — bloque 01: Definiciones y Necesidad
   Fuente: sesion_03_fundamentos_devops.pdf
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- definicion Bass, Weber & Zhu --- */
    1  => ['practicas'],
    2  => ['tiempo'],
    3  => ['commit'],
    4  => ['produccion'],
    5  => ['calidad'],

    /* --- lectura ingenieril --- */
    6  => ['metas', 'resultado'],
    7  => ['herramientas'],
    8  => ['disponibilidad'],
    9  => ['seguridad'],
    10 => ['fiabilidad'],

    /* --- definicion IBM / For Dummies --- */
    11 => ['agiles', 'agil'],
    12 => ['lean'],
    13 => ['cadena de suministro', 'cadena'],
    14 => ['velocidad'],
    15 => ['idea'],

    /* --- mapeo --- */
    16 => ['time-to-market', 'time to market'],
    17 => ['estabilidad'],
    18 => ['cultural'],
    19 => ['bass'],
    20 => ['ibm'],

    /* --- friccion del release --- */
    21 => ['retorno', 'roi'],
    22 => ['coordinacion'],
    23 => ['manuales'],
    24 => ['consistencia'],
    25 => ['acuerdo'],

    /* --- 4 pasos del proceso de release --- */
    26 => ['planificacion', 'planificacion y alineacion'],
    27 => ['compatibilidad'],
    28 => ['integridad', 'integridad y registro'],
    29 => ['trazabilidad', 'trazabilidad y rollback'],
    30 => ['obsoletos'],
    31 => ['revertido', 'revertir'],

    /* --- Knight Capital --- */
    32 => ['440'],
    33 => ['45'],
    34 => ['2012'],
    35 => ['knight capital', 'knight'],

    /* --- capacidad de Ops --- */
    36 => ['rutinarias', 'repetitivas'],
    37 => ['compartidas'],
    38 => ['desarrollo', 'dev'],

    /* --- estadisticas --- */
    39 => ['49'],
    40 => ['32.5'],
    41 => ['65'],
    42 => ['25'],
    43 => ['53'],
    44 => ['42'],

    /* --- virtudes de la automatizacion --- */
    45 => ['politicas'],
    46 => ['auditable'],
    47 => ['repetibles'],
    48 => ['infraestructura como codigo', 'iac'],
    49 => ['versiones'],
];

$TEXTO = range(1, 49);

$MULTIPLE = [
    'm1' => [
        'texto'    => 'La definicion de <b>Bass, Weber &amp; Zhu</b> mide un intervalo concreto. &iquest;Entre que dos hitos?',
        'opciones' => [
            'a' => 'Entre la idea de negocio y la venta',
            'b' => 'Entre el <b>commit</b> de un cambio y su <b>colocacion en produccion normal</b>',
            'c' => 'Entre el inicio del sprint y la demo',
            'd' => 'Entre el reporte del bug y su cierre'
        ],
        'correcta' => 'b',
        'porque'   => 'Por eso se le llama la perspectiva <em>commit-to-production</em>: es la mas tecnica y acotada de las dos.'
    ],
    'm2' => [
        'texto'    => '&iquest;En que se diferencian la definicion de Bass y la de IBM?',
        'opciones' => [
            'a' => 'IBM habla de herramientas y Bass de personas',
            'b' => 'Bass es <b>tecnica e ingenieril</b>, acotada al ciclo commit-to-production; IBM es <b>mas amplia</b>, orientada al negocio, desde la idea hasta el feedback del cliente',
            'c' => 'Son contradictorias',
            'd' => 'Bass incluye el feedback del cliente e IBM no'
        ],
        'correcta' => 'b',
        'porque'   => 'Y coinciden en lo importante: reducir el time-to-market, no sacrificar calidad, y apostar por automatizacion + cambio cultural.'
    ],
    'm3' => [
        'texto'    => 'Segun la sesion, &iquest;el despliegue rapido justifica bajar la calidad?',
        'opciones' => [
            'a' => 'Si, la velocidad es la prioridad',
            'b' => 'No: el despliegue rapido <b>no debe comprometer</b> la disponibilidad, la seguridad ni la fiabilidad',
            'c' => 'Solo en Systems of Engagement',
            'd' => 'Solo si el cliente lo acepta'
        ],
        'correcta' => 'b',
        'porque'   => 'Es el matiz que separa DevOps de &laquo;desplegar rapido y rezar&raquo;. Las dos definiciones lo dicen: rapidez <b>asegurando</b> alta calidad.'
    ],
    'm4' => [
        'texto'    => '&iquest;Que idea captura la frase &laquo;yo programe, ahora correlo tu&raquo;?',
        'opciones' => [
            'a' => 'La division de responsabilidades bien hecha',
            'b' => 'La falta de coordinacion: una transferencia ciega de codigo entre Dev y Ops',
            'c' => 'El principio de shift-left',
            'd' => 'La regla de las dos pizzas'
        ],
        'correcta' => 'b',
        'porque'   => 'Es el sintoma de la <b>pared de la confusion</b>, que se desarrolla en el bloque 2 de la sesion.'
    ],
    'm5' => [
        'texto'    => 'La sesion dice que toda automatizacion implementada <b>codifica el acuerdo del proceso</b>. &iquest;Que significa?',
        'opciones' => [
            'a' => 'Que el proceso se cifra por seguridad',
            'b' => 'Que el acuerdo sobre como se hacen las cosas deja de vivir en la cabeza de la gente y queda escrito en el script, ganando <b>persistencia a largo plazo</b>',
            'c' => 'Que el proceso se documenta en un PDF',
            'd' => 'Que solo el autor del script puede desplegar'
        ],
        'correcta' => 'b',
        'porque'   => 'Idea potente para el parcial: el script no es solo una herramienta, es <b>la version ejecutable de la politica</b>. Cuando la persona se va, el acuerdo se queda.'
    ],
    'm6' => [
        'texto'    => 'Caso Knight Capital (2012): &iquest;cual fue la causa segun la sesion?',
        'opciones' => [
            'a' => 'Un ataque informatico externo',
            'b' => 'Un despliegue <b>manual e inconsistente</b>; las actualizaciones manuales en produccion son la mayor fuente de riesgo del negocio de software',
            'c' => 'Una caida del proveedor de nube',
            'd' => 'Un error de diseño de la arquitectura'
        ],
        'correcta' => 'b',
        'porque'   => '440 millones de dolares en 45 minutos. Es la diapositiva que justifica todo lo demas de la sesion.'
    ],
    'm7' => [
        'texto'    => '&iquest;Cual es el enfoque DevOps ante la <b>capacidad limitada de Ops</b>?',
        'opciones' => [
            'a' => 'Contratar mas personal de operaciones',
            'b' => 'Reducir la necesidad de personal dedicado a tareas rutinarias <b>automatizando</b> infraestructura y despliegues, y transferir responsabilidades compartidas a Dev',
            'c' => 'Externalizar Ops a un proveedor',
            'd' => 'Reducir la frecuencia de despliegues'
        ],
        'correcta' => 'b',
        'porque'   => 'El problema no es que Ops trabaje poco: es que tiene backups, parches, auditorias, redes, soporte y logs encima, y encontrar gente capacitada es un reto constante.'
    ],
    'm8' => [
        'texto'    => 'De las estadisticas de XebiaLabs, &iquest;cual es el <b>mayor</b> reto de despliegue reportado?',
        'opciones' => [
            'a' => 'Demasiados errores de despliegue (32.5 %)',
            'b' => 'Las diferencias entre entornos y aplicaciones — inconsistencia (49 %)',
            'c' => 'El costo de las herramientas',
            'd' => 'La falta de personal'
        ],
        'correcta' => 'b',
        'porque'   => 'Y encaja con el 65 % que sigue usando scripts propios o procesos manuales: si cada entorno se monta a mano, es imposible que salgan iguales.'
    ],
    'm9' => [
        'texto'    => 'Segun CA e IBM, adoptar DevOps mejora...',
        'opciones' => [
            'a' => 'un 53 % la frecuencia de despliegues y un 42 % la calidad',
            'b' => 'un 42 % la frecuencia y un 53 % la calidad',
            'c' => 'un 25 % ambas',
            'd' => 'un 65 % la velocidad'
        ],
        'correcta' => 'a',
        'porque'   => 'Truco para no cambiarlos: la <b>frecuencia</b> (53) sube mas que la <b>calidad</b> (42). Y el dato incomodo: solo el 25 % de las empresas cree que sus equipos son eficientes.'
    ],
    'm10' => [
        'texto'    => 'La sesion dice que las herramientas de configuracion (Chef, CloudFormation) deben tratarse con las mismas practicas que el codigo normal. &iquest;Como se llama esa idea?',
        'opciones' => [
            'a' => 'Shift-left',
            'b' => 'Infraestructura como Codigo (IaC)',
            'c' => 'Continuous Delivery',
            'd' => 'Service Virtualization'
        ],
        'correcta' => 'b',
        'porque'   => 'Control de versiones, revision y calidad aplicados a los scripts de infraestructura. Vuelve a salir en los bloques 3 y 4 de la sesion.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Sesión 3 · 1 — Definiciones y necesidad', 'sesion_03_fundamentos_devops.pdf — bloque 01');
?>

<div class="card">
  <h2>Como se usa</h2>
  <p>Los cuatro bloques de la sesion, uno por pagina, en el mismo orden del PDF.
     Las definiciones estan escritas <b>completas</b>, con las palabras clave en blanco.</p>
  <div class="nota">Respuestas en <b>texto</b>: no importan mayusculas ni tildes.
    Pulsa <b>Enter</b> dentro de un hueco para verificar.</div>
</div>


<div class="card">
  <h2>1. Definicion de ingenieria — Bass, Weber &amp; Zhu</h2>

  <p>DevOps es un conjunto de <?php hueco(1, 12); ?> destinadas a reducir el
     <?php hueco(2, 10); ?> transcurrido entre el <?php hueco(3, 10); ?>
     de un cambio en un sistema y la colocacion del cambio en
     <?php hueco(4, 12); ?> normal, asegurando al mismo tiempo una alta
     <?php hueco(5, 10); ?>.</p>

  <p>Lo que se lee de esa definicion:</p>
  <ul>
    <li><b>Enfoque en <?php hueco(6, 10); ?>:</b> se centra en el resultado del negocio
        (rapidez y calidad), no en <?php hueco(7, 14); ?> especificas.</li>
    <li><b>Calidad integral:</b> el despliegue rapido no debe comprometer la
        <?php hueco(8, 16); ?>, la <?php hueco(9, 12); ?>
        ni la <?php hueco(10, 12); ?>.</li>
    <li><b>Hitos temporales:</b> mide desde el commit del codigo hasta su colocacion
        en produccion normal.</li>
  </ul>

  <?php mc('m1'); ?>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Definicion de negocio — IBM / For Dummies</h2>

  <p>DevOps aplica principios <?php hueco(11, 10); ?> y
     <?php hueco(12, 8); ?> a lo largo de toda la
     <?php hueco(13, 22); ?> de software, permitiendo maximizar la
     <?php hueco(14, 12); ?> de entrega de un producto o servicio, desde la
     <?php hueco(15, 8); ?> inicial hasta la produccion.</p>

  <ul>
    <li><b>Ciclo de valor:</b> abarca desde la concepcion de la idea hasta la
        retroalimentacion del cliente final.</li>
    <li><b>Capacidad estrategica:</b> no es solo un rol de TI, sino un <b>proceso de negocio</b>
        para acelerar la entrega de valor.</li>
  </ul>

  <h3>Mapeo de los dos enfoques</h3>
  <table class="datos">
    <tr><th>Coinciden en</th><th>Se diferencian en</th></tr>
    <tr>
      <td>Reducir el <?php hueco(16, 18); ?> drasticamente</td>
      <td>La perspectiva de <?php hueco(19, 10); ?> es mas tecnica e ingenieril, acotada al ciclo commit-to-production</td>
    </tr>
    <tr>
      <td>La rapidez no sacrifica la <?php hueco(17, 14); ?> ni la experiencia del usuario</td>
      <td>La perspectiva de <?php hueco(20, 10); ?> es mas amplia, orientada al negocio, al flujo de ideas y al feedback del cliente</td>
    </tr>
    <tr>
      <td>Ambos promueven la automatizacion y el cambio <?php hueco(18, 12); ?></td>
      <td></td>
    </tr>
  </table>

  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. La friccion del release tradicional</h2>

  <ul>
    <li><b>Problema de lentitud:</b> a mayor demora en un release, menor es el
        <?php hueco(21, 12); ?> de inversion y el valor de las nuevas caracteristicas.</li>
    <li><b>Falta de <?php hueco(22, 14); ?>:</b> brechas de comunicacion al transferir
        el codigo (&laquo;yo programe, ahora correlo tu&raquo;).</li>
    <li><b>Proceso heredado:</b> historicamente dominado por pasos
        <?php hueco(23, 12); ?>, lentos y propensos a la inconsistencia.</li>
  </ul>

  <div class="avisoflujo">
    <b>La necesidad.</b> La velocidad y la <?php hueco(24, 14); ?> son criticas.
    Cualquier automatizacion implementada <b>codifica el <?php hueco(25, 10); ?>
    del proceso</b>, dandole persistencia a largo plazo.
  </div>

  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Los cuatro pasos del proceso de release</h2>

  <table class="datos">
    <tr><th>#</th><th>Paso</th><th>En que consiste</th></tr>
    <tr><td>1</td><td><?php hueco(26, 16); ?> y alineacion</td>
        <td>acordar planes con clientes y preparar al soporte sobre recursos y entrenamientos</td></tr>
    <tr><td>2</td><td><?php hueco(27, 16); ?> del paquete</td>
        <td>verificar la compatibilidad mutua de librerias, plataformas y servicios dependientes</td></tr>
    <tr><td>3</td><td><?php hueco(28, 16); ?> y registro</td>
        <td>evitar incluir componentes <?php hueco(30, 12); ?> y registrar todo con precision en la gestion de configuracion</td></tr>
    <tr><td>4</td><td><?php hueco(29, 16); ?> y rollback</td>
        <td>asegurar que el despliegue pueda ser rastreado, instalado, verificado y <?php hueco(31, 12); ?> ante fallas</td></tr>
  </table>

  <div class="nota"><b>Foco en automatizacion.</b> Cuando estos pasos dependen exclusivamente
    del esfuerzo y la coordinacion humana manual, se vuelven costosos y altamente vulnerables
    a fallas catastroficas.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. El costo de un release deficiente</h2>

  <p>En <?php hueco(34, 8); ?>, un despliegue manual e inconsistente llevo a una falla
     informatica catastrofica en <?php hueco(35, 18); ?>:
     <b><?php hueco(32, 8); ?> millones de dolares</b> en perdidas en tan solo
     <b><?php hueco(33, 6); ?> minutos</b>.</p>

  <div class="avisoflujo">Las actualizaciones <b>manuales en produccion</b> son la mayor
    fuente de riesgo en el negocio de software.</div>

  <?php mc('m6'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. Capacidad limitada de Ops</h2>

  <ul>
    <li><b>Sobrecarga de tareas:</b> backups, parches, auditorias, redes, soporte, logs.</li>
    <li><b>Limite de personal:</b> encontrar y retener gente capacitada para tareas complejas
        es un reto constante.</li>
    <li><b>Solucion DevOps:</b> automatizar las tareas <?php hueco(36, 14); ?>
        y transferir responsabilidades <?php hueco(37, 14); ?> al equipo de
        <?php hueco(38, 14); ?>.</li>
  </ul>

  <?php mc('m7'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>7. Estadisticas y brecha de ejecucion</h2>

 
  <?php mc('m8'); ?>
  <?php mc('m9'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>8. Virtudes de la automatizacion</h2>

  <ul>
    <li><b>Cumplimiento de <?php hueco(45, 12); ?>:</b> los scripts y herramientas
        <em>obligan</em> a cumplirlas — por ejemplo, exigir una justificacion o razon para cada commit.</li>
    <li><b>Trazabilidad e historial:</b> mantiene un registro <?php hueco(46, 12); ?>
        de acciones, para control de calidad y auditoria de seguridad.</li>
    <li><b>Estandarizacion de consola:</b> evita comandos complejos y propensos a errores
        mediante scripts <?php hueco(47, 12); ?>.</li>
  </ul>

  <div class="avisoflujo">
    <b><?php hueco(48, 26); ?>.</b> El uso de herramientas de configuracion
    (Chef, Amazon CloudFormation) debe tratarse con las mismas practicas de control de
    <?php hueco(49, 12); ?> y calidad que el codigo normal.
  </div>

  <?php mc('m10'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Menu.php', 'segundo.php');
