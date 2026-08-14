<?php
/* ==========================================================================
   IngeSoft5 / DevOps / Sesion 3 — bloque 02: Silos y Sistemas
   Fuente: sesion_03_fundamentos_devops.pdf
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- la desconexion --- */
    1  => ['velocidad'],
    2  => ['estabilidad'],
    3  => ['pared de la confusion', 'pared'],
    4  => ['contexto'],
    5  => ['ciegas'],
    6  => ['fricciones', 'friccion'],

    /* --- SoR --- */
    7  => ['record', 'systems of record', 'sor'],
    8  => ['transaccionales'],
    9  => ['estabilidad'],
    10 => ['seguridad'],
    11 => ['consistencia'],
    12 => ['lentos'],

    /* --- SoE --- */
    13 => ['engagement', 'systems of engagement', 'soe'],
    14 => ['cliente final', 'cliente'],
    15 => ['velocidad'],
    16 => ['ux', 'experiencia de usuario'],
    17 => ['adaptabilidad'],
    18 => ['constantes'],

    /* --- la conexion --- */
    19 => ['dependen'],
    20 => ['api'],
    21 => ['cuellos de botella', 'cuello de botella'],
    22 => ['modernizacion'],
    23 => ['alinear'],

    /* --- DAD --- */
    24 => ['incepcion'],
    25 => ['construccion'],
    26 => ['transicion'],
    27 => ['logging'],
    28 => ['ramas'],
    29 => ['pruebas'],
    30 => ['despliegue'],
    31 => ['rollback'],
    32 => ['operativo'],
];

$TEXTO = range(1, 32);

$MULTIPLE = [
    'm1' => [
        'texto'    => '&iquest;Por que existe la desconexion entre Dev y Ops, segun la sesion?',
        'opciones' => [
            'a' => 'Porque usan lenguajes de programacion distintos',
            'b' => 'Por <b>incentivos cruzados</b>: Dev es medido por la velocidad y Ops por la estabilidad. Cada uno hace bien su trabajo y aun asi chocan',
            'c' => 'Porque Ops no sabe programar',
            'd' => 'Porque estan en edificios distintos'
        ],
        'correcta' => 'b',
        'porque'   => 'Es la clave del diagnostico: no es un problema de malas personas, es un problema de <b>metricas contradictorias</b>. Por eso la solucion cultural pasa por incentivos compartidos.'
    ],
    'm2' => [
        'texto'    => '&iquest;Que es la &laquo;pared de la confusion&raquo;?',
        'opciones' => [
            'a' => 'Un firewall mal configurado',
            'b' => 'La metafora de que Dev <b>arroja el codigo por encima</b> y Ops lucha por correrlo sin entender el contexto',
            'c' => 'La documentacion incompleta',
            'd' => 'El limite entre staging y produccion'
        ],
        'correcta' => 'b',
        'porque'   => 'Sus consecuencias: transferencias ciegas, tiempos de entrega extremadamente largos y fricciones organizacionales constantes.'
    ],
    'm3' => [
        'texto'    => 'Una base de datos central y el ERP de la empresa son...',
        'opciones' => [
            'a' => 'Systems of Engagement',
            'b' => 'Systems of Record: sistemas transaccionales centrales, que priorizan estabilidad, seguridad y consistencia',
            'c' => 'Microservicios',
            'd' => 'Systems of Delivery'
        ],
        'correcta' => 'b',
        'porque'   => 'Regla mnemotecnica: <b>Record</b> = donde queda el <em>registro</em> oficial de la empresa. Cambian poco: una o dos releases grandes al año.'
    ],
    'm4' => [
        'texto'    => 'La app movil con la que el cliente consulta su saldo es...',
        'opciones' => [
            'a' => 'Un System of Record',
            'b' => 'Un System of Engagement: interactua con el cliente final y prioriza velocidad, UX y adaptabilidad',
            'c' => 'Un sistema legado',
            'd' => 'Un gatekeeper'
        ],
        'correcta' => 'b',
        'porque'   => '<b>Engagement</b> = donde la empresa <em>se relaciona</em> con el cliente. Cambia a diario o cada semana.'
    ],
    'm5' => [
        'texto'    => 'La app (SoE) necesita una funcion nueva, y eso obliga a cambiar la API del core bancario (SoR). &iquest;Que ilustra ese caso?',
        'opciones' => [
            'a' => 'Que hay que congelar el SoE',
            'b' => 'Que <b>no son aislados</b>: el SoE depende del SoR, asi que la agilidad del SoE debe empujar la modernizacion del SoR o aparece un cuello de botella',
            'c' => 'Que el SoR debe reescribirse desde cero',
            'd' => 'Que el SoE deberia tener su propia base de datos'
        ],
        'correcta' => 'b',
        'porque'   => 'La frase de la diapositiva: toda innovacion de negocio digital requiere <b>alinear la velocidad de ambos sistemas</b> mediante practicas DevOps coherentes.'
    ],
    'm6' => [
        'texto'    => 'Si el SoR cambia 2 veces al año y el SoE cambia cada semana, &iquest;cual es el riesgo?',
        'opciones' => [
            'a' => 'Que el SoE tenga bugs',
            'b' => 'Que el SoR se convierta en el <b>freno</b> de todo lo que el negocio quiere lanzar: por rapido que vaya la app, tiene que esperar al core',
            'c' => 'Que el SoR se sature de trafico',
            'd' => 'Ninguno, son independientes'
        ],
        'correcta' => 'b',
        'porque'   => 'Y es exactamente lo que la sesion llama <em>cuello de botella</em>. La velocidad real de la organizacion es la del eslabon mas lento.'
    ],
    'm7' => [
        'texto'    => 'En la fase de <b>Incepcion</b> de DAD, &iquest;que aporta DevOps?',
        'opciones' => [
            'a' => 'El despliegue automatizado',
            'b' => 'Que los <b>requisitos de Ops</b> entren desde el diseño: logging, switchable features, backward compatibility y planes de release',
            'c' => 'El monitoreo de metricas',
            'd' => 'La gestion de ramas'
        ],
        'correcta' => 'b',
        'porque'   => 'Es shift-left aplicado a la operacion: si el logging se piensa al final, ya es tarde. Se decide cuando se diseña.'
    ],
    'm8' => [
        'texto'    => 'En la fase de <b>Transicion</b> de DAD, &iquest;quien asume el despliegue?',
        'opciones' => [
            'a' => 'Un equipo de operaciones aparte',
            'b' => 'El propio <b>equipo de desarrollo</b>, que asume tambien el monitoreo de metricas y el rollback',
            'c' => 'El gatekeeper de seguridad',
            'd' => 'El proveedor de nube'
        ],
        'correcta' => 'b',
        'porque'   => 'El objetivo de las tres fases es el mismo: que el <b>conocimiento operativo resida en el equipo</b> desde el diseño hasta la ejecucion.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Sesión 3 · 2 — Silos y sistemas', 'sesion_03_fundamentos_devops.pdf — bloque 02');
?>

<div class="card">
  <h2>1. La desconexion y los silos</h2>

  <ul>
    <li><b>Incentivos cruzados:</b> Dev es medido por la <?php hueco(1, 12); ?>;
        Ops es medido por la <?php hueco(2, 14); ?>.</li>
    <li><b>La <?php hueco(3, 22); ?>:</b> Dev arroja el codigo por encima y Ops
        lucha por correrlo sin entender el <?php hueco(4, 12); ?>.</li>
    <li><b>Actitud comun:</b> el desarrollador asume &laquo;ya termine de programar,
        ahora te toca correrlo a ti&raquo;.</li>
  </ul>

  <div class="avisoflujo">
    <b>Consecuencias.</b> Esta falta de comunicacion genera transferencias
    <?php hueco(5, 10); ?>, tiempos de entrega extremadamente largos y
    <?php hueco(6, 14); ?> organizacionales constantes.
  </div>

  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Systems of Record vs. Systems of Engagement</h2>

  <table class="datos">
    <tr><th></th><th>Systems of <?php hueco(7, 14); ?> (SoR)</th><th>Systems of <?php hueco(13, 14); ?> (SoE)</th></tr>
    <tr><td><b>Que son</b></td>
        <td>sistemas <?php hueco(8, 16); ?> centrales de la empresa (bases de datos, ERPs)</td>
        <td>aplicaciones moviles y web que interactuan con el <?php hueco(14, 14); ?></td></tr>
    <tr><td><b>Prioridad</b></td>
        <td><?php hueco(9, 14); ?>, <?php hueco(10, 12); ?> y <?php hueco(11, 14); ?></td>
        <td><?php hueco(15, 12); ?>, <?php hueco(16, 10); ?> y <?php hueco(17, 14); ?></td></tr>
    <tr><td><b>Frecuencia</b></td>
        <td>cambios <?php hueco(12, 10); ?>: 1-2 grandes releases al año</td>
        <td>cambios <?php hueco(18, 12); ?>: diarios o semanales</td></tr>
  </table>

  <?php mc('m3'); ?>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. La conexion SoR / SoE</h2>

  <ul>
    <li><b>No son aislados:</b> los Systems of Engagement <?php hueco(19, 12); ?>
        directamente de los Systems of Record para las transacciones.</li>
    <li><b>Propagacion del cambio:</b> actualizar un SoE (una funcion nueva de la app)
        exige cambios rapidos en la <?php hueco(20, 8); ?> del SoR.</li>
    <li><b>Necesidad de DevOps:</b> para evitar <?php hueco(21, 20); ?>,
        la agilidad del SoE debe empujar la <?php hueco(22, 16); ?> del SoR.</li>
  </ul>

  <div class="avisoflujo">
    <b>El eslabon.</b> Toda innovacion de negocio digital requiere
    <?php hueco(23, 10); ?> la velocidad de ambos sistemas mediante practicas
    DevOps coherentes.
  </div>

  <?php mc('m5'); ?>
  <?php mc('m6'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. DevOps y el ciclo Agile (DAD)</h2>
  <p><em>Disciplined Agile Delivery</em>. DevOps impacta las <b>tres fases</b> para asegurar
     que el conocimiento <?php hueco(32, 12); ?> resida en el equipo desde el
     diseño hasta la ejecucion.</p>

  <table class="datos">
    <tr><th>Fase</th><th>Que aporta DevOps</th></tr>
    <tr><td><?php hueco(24, 14); ?></td>
        <td>se suman los requisitos de Ops (<?php hueco(27, 12); ?>, switchable
            features, backward compatibility) y los planes de release</td></tr>
    <tr><td><?php hueco(25, 14); ?></td>
        <td>gestion de <?php hueco(28, 10); ?>, CI/CD, automatizacion de
            <?php hueco(29, 10); ?> y enlace integrado con la transicion</td></tr>
    <tr><td><?php hueco(26, 14); ?></td>
        <td>el equipo de desarrollo asume la responsabilidad del
            <?php hueco(30, 12); ?>, el monitoreo de metricas y el
            <?php hueco(31, 10); ?></td></tr>
  </table>

  <?php mc('m7'); ?>
  <?php mc('m8'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('index.php', 'tercero.php');
