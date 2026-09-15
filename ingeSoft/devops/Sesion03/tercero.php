<?php
/* ==========================================================================
   IngeSoft5 / DevOps / Sesion 3 — bloque 03: Practicas y Adopcion
   Fuente: sesion_03_fundamentos_devops.pdf
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- las 5 practicas --- */
    1  => ['logging'],
    2  => ['monitoreo'],
    3  => ['funcionales'],
    4  => ['incidentes'],
    5  => ['pipeline'],
    6  => ['infraestructura como codigo', 'iac'],
    7  => ['continuous deployment', 'despliegue continuo', 'cd'],

    /* --- los 4 principios --- */
    8  => ['shift-left', 'shift left'],
    9  => ['identicos', 'iguales'],
    10 => ['repetibles'],
    11 => ['pipelines'],
    12 => ['metricas'],
    13 => ['retroalimentacion', 'feedback'],
    14 => ['tempranas'],
    15 => ['integracion'],

    /* --- rutas de adopcion IBM --- */
    16 => ['steer'],
    17 => ['develop/test', 'develop', 'develop y test'],
    18 => ['deploy'],
    19 => ['operate'],
    20 => ['desperdicios'],
    21 => ['virtualizacion'],
    22 => ['monitoreo continuo', 'monitoreo'],

    /* --- estrategia de adopcion --- */
    23 => ['personas'],
    24 => ['procesos'],
    25 => ['herramientas'],
    26 => ['empresarial'],
    27 => ['stakeholders'],
    28 => ['qa'],
    29 => ['incompletas', 'incompleta'],

    /* --- cultura --- */
    30 => ['colaboracion'],
    31 => ['confianza'],
    32 => ['culpar'],
    33 => ['experimentacion'],
    34 => ['aprendizaje'],
    35 => ['compartidos'],
    36 => ['uptime'],
    37 => ['encuestas'],
    38 => ['voluntaria'],

    /* --- estructura del equipo --- */
    39 => ['noops'],
    40 => ['netflix'],
    41 => ['enlace', 'liaison'],
    42 => ['centro de excelencia', 'excelencia'],
    43 => ['burocracia'],

    /* --- objetivos y desperdicios --- */
    44 => ['medio'],
    45 => ['comunicacion'],
    46 => ['rework'],
    47 => ['over-production', 'overproduction', 'sobreproduccion'],

    48 => ['Requisitos de Ops'],
    49 => ['Soporte compartido'],
    50 => ['Proceso unico'],
];

$TEXTO = range(1, 47);

$MULTIPLE = [
    'm1' => [
        'texto'    => 'De las 5 practicas, &iquest;cual es la practica <b>core</b> segun la sesion?',
        'opciones' => [
            'a' => 'Infraestructura como Codigo',
            'b' => 'Continuous Deployment (CD): reducir el tiempo entre commit y produccion con pruebas y entregas totalmente automatizadas',
            'c' => 'El soporte compartido',
            'd' => 'El proceso unico'
        ],
        'correcta' => 'b',
        'porque'   => 'Y engancha directo con la definicion de Bass del bloque 1: el intervalo commit &rarr; produccion es lo que CD ataca.'
    ],
    'm2' => [
        'texto'    => 'La practica dice: integrar logging y monitoreo como <b>requisitos funcionales de diseño</b>. &iquest;Por que importa esa palabra?',
        'opciones' => [
            'a' => 'Porque suena mas profesional',
            'b' => 'Porque si son <b>requisitos</b>, se planifican, se estiman y se prueban como cualquier feature — en vez de quedar como &laquo;lo que Ops añada al final si le da tiempo&raquo;',
            'c' => 'Porque asi los paga el cliente',
            'd' => 'Porque los requisitos no funcionales no se documentan'
        ],
        'correcta' => 'b',
        'porque'   => 'Es la misma idea del shift-left: lo que no entra en el backlog, no existe.'
    ],
    'm3' => [
        'texto'    => 'Hacer a Dev responsable del <b>manejo inicial de incidentes en produccion</b>. &iquest;Que efecto busca?',
        'opciones' => [
            'a' => 'Ahorrar personal de soporte',
            'b' => 'Cerrar el bucle: quien escribe el codigo siente las consecuencias de desplegarlo mal, y eso cambia como lo escribe',
            'c' => 'Castigar a los desarrolladores',
            'd' => 'Eliminar el equipo de Ops'
        ],
        'correcta' => 'b',
        'porque'   => 'Es el antidoto directo al &laquo;ya termine, ahora te toca a ti&raquo;. Si te llaman a las 3 a.m. por tu propio deploy, el logging deja de parecerte opcional.'
    ],
    'm4' => [
        'texto'    => '&iquest;Que es el concepto <b>Shift-Left</b>?',
        'opciones' => [
            'a' => 'Desplazar el equipo a otra zona horaria',
            'b' => 'Mover las pruebas y las consideraciones operativas a <b>etapas tempranas</b> del ciclo, para evitar que los fallos de integracion escalen a produccion',
            'c' => 'Priorizar el frontend sobre el backend',
            'd' => 'Reducir el numero de entornos'
        ],
        'correcta' => 'b',
        'porque'   => '&laquo;Izquierda&raquo; en el diagrama del ciclo de vida = antes. Cuanto antes encuentras el fallo, mas barato es arreglarlo.'
    ],
    'm5' => [
        'texto'    => 'El principio de <b>entornos reales</b> dice: desarrollar y probar contra sistemas identicos a produccion. &iquest;Que problema del bloque 1 ataca?',
        'opciones' => [
            'a' => 'La falta de personal de Ops',
            'b' => 'La <b>inconsistencia</b> entre entornos, que el 49 % de XebiaLabs reportaba como el mayor reto de despliegue',
            'c' => 'El costo de las licencias',
            'd' => 'La lentitud de las pruebas'
        ],
        'correcta' => 'b',
        'porque'   => 'Todo el bloque 3 son las respuestas a los problemas del bloque 1. Poder trazar esa linea en el parcial vale mas que recitar las listas.'
    ],
    'm6' => [
        'texto'    => 'En las rutas de adopcion de IBM, &iquest;que cubre <b>Steer</b>?',
        'opciones' => [
            'a' => 'El pipeline de despliegue',
            'b' => 'Continuous business planning: adaptar las metas con el feedback y eliminar desperdicios',
            'c' => 'El monitoreo en produccion',
            'd' => 'Las pruebas automatizadas'
        ],
        'correcta' => 'b',
        'porque'   => 'Las cuatro rutas en orden son <b>Steer &rarr; Develop/Test &rarr; Deploy &rarr; Operate</b>, y Operate devuelve el feedback a Steer. Es un ciclo, no una linea.'
    ],
    'm7' => [
        'texto'    => '&iquest;Que es la <b>service virtualization</b> que aparece en Develop/Test?',
        'opciones' => [
            'a' => 'Correr los servicios en maquinas virtuales',
            'b' => 'Simular stubs o componentes externos que estan ausentes o son costosos, para poder hacer tests funcionales continuos',
            'c' => 'Virtualizar la red del entorno de pruebas',
            'd' => 'Desplegar en contenedores'
        ],
        'correcta' => 'b',
        'porque'   => 'Si tu prueba depende de la pasarela de pagos del banco, o la simulas o no puedes probar de forma continua. Vuelve a salir en el bloque 4.'
    ],
    'm8' => [
        'texto'    => 'Segun la sesion, &iquest;que pasa si dejas fuera a QA, seguridad, arquitectura o socios externos de la adopcion de DevOps?',
        'opciones' => [
            'a' => 'Nada, son areas de apoyo',
            'b' => 'Conduce a <b>fallos o adopciones incompletas</b>: DevOps es una capacidad empresarial que abarca a todos los stakeholders, no solo a Dev y Ops',
            'c' => 'Se acelera la adopcion',
            'd' => 'Solo afecta al presupuesto'
        ],
        'correcta' => 'b',
        'porque'   => 'A pesar del nombre, DevOps no son dos departamentos: es una forma de trabajar que redefine como colaboran todos los que tocan la entrega de valor.'
    ],
    'm9' => [
        'texto'    => '&iquest;Como se puede medir la cultura DevOps de forma <b>indirecta</b>?',
        'opciones' => [
            'a' => 'Contando los despliegues por semana',
            'b' => 'Por la frecuencia de <b>colaboracion voluntaria directa</b> entre Dev, QA y Ops para resolver incidentes de forma informal',
            'c' => 'Con encuestas de moral',
            'd' => 'Midiendo el uptime'
        ],
        'correcta' => 'b',
        'porque'   => 'La medida <em>directa</em> son las encuestas de moral y actitud — pero con alto margen de error en equipos pequeños. Por eso se busca una señal de comportamiento, no de opinion.'
    ],
    'm10' => [
        'texto'    => 'Si se crea un equipo DevOps independiente, &iquest;como debe funcionar?',
        'opciones' => [
            'a' => 'Como el dueño unico de todos los despliegues',
            'b' => 'Como un <b>Centro de Excelencia</b> que facilite la colaboracion y comparta buenas practicas, evitando añadir burocracia o ser el unico dueño de los problemas',
            'c' => 'Como un equipo de soporte de nivel 3',
            'd' => 'Como un area de auditoria'
        ],
        'correcta' => 'b',
        'porque'   => 'El riesgo es obvio: si creas un equipo DevOps que despliega por todos, acabas de inventar un silo nuevo — justo lo que querias eliminar.'
    ],
    'm11' => [
        'texto'    => 'El enfoque <b>NoOps</b> de Netflix consiste en...',
        'opciones' => [
            'a' => 'Eliminar las operaciones por completo',
            'b' => 'No tener separacion: un <b>unico equipo</b> es responsable de construir <em>y</em> operar la aplicacion',
            'c' => 'Externalizar Ops a la nube',
            'd' => 'Automatizar el 100 % del pipeline'
        ],
        'correcta' => 'b',
        'porque'   => 'El nombre confunde: no es que no haya operaciones, es que no hay un <em>equipo separado</em> de operaciones. La responsabilidad no desaparece, se integra.'
    ],
    'm12' => [
        'texto'    => 'La sesion insiste en que <b>DevOps es el medio, no la meta</b>. &iquest;Que implica?',
        'opciones' => [
            'a' => 'Que no hay que medir nada',
            'b' => 'Que existe para lograr los objetivos estrategicos de la empresa y alinear al equipo hacia el mismo hito de valor de negocio — no para tener el pipeline mas bonito',
            'c' => 'Que las herramientas no importan',
            'd' => 'Que la cultura es secundaria'
        ],
        'correcta' => 'b',
        'porque'   => 'Buen cierre de discusion: si automatizas todo y el negocio no entrega mas valor, has optimizado el medio y no la meta.'
    ],
    'm13' => [
        'texto'    => 'Escribir una funcionalidad que el negocio en realidad no necesita es...',
        'opciones' => [
            'a' => 'Overhead de comunicacion',
            'b' => 'Rework innecesario',
            'c' => 'Over-production',
            'd' => 'Deuda tecnica'
        ],
        'correcta' => 'c',
        'porque'   => 'Las tres categorias de ineficiencia son: <b>overhead de comunicacion</b> (repetir la misma informacion), <b>rework</b> (defectos detectados tarde) y <b>over-production</b> (codigo que sobra).'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Sesión 3 · 3 — Prácticas y adopción', 'sesion_03_fundamentos_devops.pdf — bloque 03');
?>

<div class="card">
  <h2>1. Las 5 practicas de DevOps</h2>

  <ol>
    <li><b><?php hueco(48, 10); ?> :</b> integrar <?php hueco(1, 10); ?> y
        <?php hueco(2, 12); ?> comprensibles como requisitos
        <?php hueco(3, 14); ?> de diseño.</li>
    <li><b><?php hueco(49, 18); ?> :</b> hacer a Dev responsable del manejo inicial de
        <?php hueco(4, 12); ?> en produccion.</li>
    <li><b><?php hueco(50, 14); ?> :</b> imponer el mismo <?php hueco(5, 12); ?>
        estandarizado a todo el personal, Dev y Ops.</li>
    <li><b><?php hueco(6, 26); ?>:</b> tratar los scripts de despliegue con
        versionamiento y calidad.</li>
 
  </ol>

  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php mc('m3'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>2. Los 4 principios de DevOps</h2>

  <table class="datos">
    <tr><th>Principio</th><th>En que consiste</th></tr>
    <tr><td>Entornos reales (<?php hueco(8, 14); ?>)</td>
        <td>desarrollar y probar contra sistemas <?php hueco(9, 12); ?> a produccion</td></tr>
    <tr><td>Procesos <?php hueco(10, 14); ?></td>
        <td>automatizar la entrega con <?php hueco(11, 12); ?> para mitigar fallos humanos</td></tr>
    <tr><td>Calidad operacional</td>
        <td>capturar <?php hueco(12, 12); ?> funcionales y no funcionales de forma continua</td></tr>
    <tr><td><?php hueco(13, 18); ?></td>
        <td>amplificar los bucles de comunicacion para responder rapido al feedback</td></tr>
  </table>

  <div class="avisoflujo">
    <b>Concepto Shift-Left.</b> Mover las pruebas y consideraciones operativas a etapas
    <?php hueco(14, 12); ?> del ciclo, para evitar que los fallos de
    <?php hueco(15, 14); ?> escalen a produccion.
  </div>

  <?php mc('m4'); ?>
  <?php mc('m5'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>3. Las cuatro rutas de adopcion (IBM)</h2>

  <table class="datos">
    <tr><th>Ruta</th><th>Que cubre</th></tr>
    <tr><td><?php hueco(16, 12); ?></td>
        <td><em>Continuous business planning</em>: adaptar metas con el feedback y eliminar
            <?php hueco(20, 14); ?></td></tr>
    <tr><td><?php hueco(17, 16); ?></td>
        <td>desarrollo colaborativo (CI/CD) y <em>continuous testing</em>: shift-left y
            <?php hueco(21, 16); ?> de servicios</td></tr>
    <tr><td><?php hueco(18, 12); ?></td>
        <td>pipeline de entrega continua que automatiza QA y despliegues rapidos a produccion</td></tr>
    <tr><td><?php hueco(19, 12); ?></td>
        <td><?php hueco(22, 18); ?> (metricas en todo el ciclo) y feedback optimizado del cliente</td></tr>
  </table>

  <?php mc('m6'); ?>
  <?php mc('m7'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>4. Estrategia de adopcion</h2>

  <p>La adopcion exitosa requiere una estrategia integrada que equilibre tres pilares:
     las <?php hueco(23, 12); ?>, los <?php hueco(24, 12); ?>
     y las <?php hueco(25, 14); ?>.</p>

  <div class="avisoflujo">
    <b>Estrategia enterprise.</b> DevOps no es solo un departamento: es una capacidad
    <?php hueco(26, 14); ?> global que requiere redefinir la forma en que los
    <?php hueco(27, 14); ?> colaboran para entregar valor.
  </div>

  <p>Excluir a areas como <?php hueco(28, 8); ?>, seguridad, arquitectura o socios
     externos conduce a fallos o adopciones <?php hueco(29, 14); ?>.</p>

  <?php mc('m8'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>5. Cultura DevOps</h2>

  <h3>Atributos</h3>
  <ul>
    <li><b><?php hueco(30, 14); ?> y <?php hueco(31, 12); ?>:</b>
        comunicacion fluida sin <?php hueco(32, 10); ?> a otros por los fallos.</li>
    <li><b><?php hueco(33, 16); ?> y <?php hueco(34, 14); ?>:</b>
        fomentar la innovacion y el aprendizaje continuo ante los errores.</li>
    <li><b>Incentivos <?php hueco(35, 14); ?>:</b> reemplazar mediciones contradictorias
        (Dev por cambios vs. Ops por <?php hueco(36, 10); ?>) por metas conjuntas.</li>
  </ul>

  <h3>Como se mide</h3>
  <table class="datos">
    <tr><th>Medida</th><th>En que consiste</th></tr>
    <tr><td>Directa</td><td><?php hueco(37, 12); ?> de moral y actitud, con alto margen
        de error por equipos pequeños</td></tr>
    <tr><td>Indirecta</td><td>frecuencia de colaboracion <?php hueco(38, 14); ?>
        directa entre Dev, QA y Ops para resolver incidentes de forma informal</td></tr>
  </table>

  <?php mc('m9'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>6. La estructura del equipo</h2>

  <p>Hay <b>debate estructural</b> sobre si crear un equipo DevOps independiente o fusionar roles.</p>

  <ul>
    <li><b>Enfoque <?php hueco(39, 10); ?> (<?php hueco(40, 10); ?>):</b>
        no hay separacion; un unico equipo es responsable de construir y operar la aplicacion.</li>
    <li><b>Equipo de <?php hueco(41, 12); ?>:</b> equipos dedicados a resolver conflictos
        y establecer pipelines comunes.</li>
  </ul>

  <div class="avisoflujo">
    Si se crea un equipo DevOps independiente, debe funcionar como un
    <b><?php hueco(42, 22); ?></b> que facilite la colaboracion y comparta buenas
    practicas, evitando añadir <?php hueco(43, 14); ?> o ser el unico dueño
    de los problemas.
  </div>

  <?php mc('m10'); ?>
  <?php mc('m11'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <h2>7. Objetivos y desperdicios</h2>

  <p><b>Objetivo final:</b> DevOps es el <?php hueco(44, 10); ?>, no la meta.
     Ayuda a lograr los objetivos estrategicos de la empresa y a que todo el equipo avance
     hacia el mismo hito de valor de negocio.</p>

  <h3>Las tres categorias de ineficiencia</h3>
  <table class="datos">
    <tr><th>#</th><th>Categoria</th><th>Que es</th></tr>
    <tr><td>1</td><td>Overhead de <?php hueco(45, 14); ?></td>
        <td>exceso de comunicacion repetitiva de la misma informacion</td></tr>
    <tr><td>2</td><td><?php hueco(46, 12); ?> innecesario</td>
        <td>defectos no detectados a tiempo que obligan a reescribir codigo</td></tr>
    <tr><td>3</td><td><?php hueco(47, 16); ?></td>
        <td>crear codigo o funcionalidad que el negocio realmente no necesita</td></tr>
  </table>

  <?php mc('m12'); ?>
  <?php mc('m13'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('segundo.php', 'cuarto.php');
