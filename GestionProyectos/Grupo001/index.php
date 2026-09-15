<?php
/* ==========================================================================
   Gerencia de Proyectos de T.I.  —  Examen 1  Grupo001
   Transcripcion literal del intento del 3 de septiembre de 2025 (26,00 puntos)
   ========================================================================== */

require_once __DIR__ . '/../motor.php';

$IMG_A = '<img src="../img/enfoque-a.png" alt="Diagrama de enfoque (opcion 1)">';
$IMG_B = '<img src="../img/enfoque-b.png" alt="Diagrama de enfoque (opcion 2)">';

$OE1 = 'OE1 - Impulsar la transformacion digital mediante soluciones de analisis de datos y automatizacion.';
$OE2 = 'OE2 - Fortalecer la experiencia del cliente y el soporte postventa.';
$OE3 = 'OE3 - Ampliar la presencia de marca y generar oportunidades de negocio.';
$OE4 = 'OE4 - Expandir la cartera de clientes y diversificar mercados.';

$MULTIPLE = [

/* ---------------------------------------------------------------- P1 */
'p1' => [
    'minutos'  => '2 minutos · 1,00 punto',
    'texto'    => 'El proyecto se divide en dos Sprints, cada Sprint es de dos semanas de duraci&oacute;n, entonces...',
    'opciones' => [
        'a' => 'Para cada sprint se debe programar el refinamiento seg&uacute;n sea necesario para garantizar que un conjunto de historias de usuario cumplan con el DOR (Definition of Ready), antes de iniciar el siguiente sprint.',
        'b' => 'Se debe programar una sola reuni&oacute;n de refinamiento para los dos sprints.',
        'c' => 'No tiene sentido cualquier reuni&oacute;n de refinamiento ya que los requerimientos est&aacute;n bien definidos desde el inicio.',
        'd' => 'Se debe programar al menos dos reuniones para refinamiento en cada sprint.'
    ],
    'correcta' => 'a',
    'porque'   => 'El refinamiento se hace en cualquier momento que sea necesario, tantas veces como haga falta para que las historias cumplan el DOR antes del siguiente sprint.'
],

/* ---------------------------------------------------------------- P4 */
'p4' => [
    'minutos'  => '2 minutos · 1,00 punto',
    'texto'    => '&iquest;Scrum es?',
    'opciones' => [
        'a' => 'Predictivo, iterativo e incremental',
        'b' => 'Adaptativo'
    ],
    'correcta' => 'b',
    'porque'   => 'La respuesta correcta es: Adaptativo.'
],

/* ---------------------------------------------------------------- P6 */
'p6' => [
    'minutos'  => '2 minutos · 1,00 punto',
    'texto'    => '&iquest;En qu&eacute; evento se muestra un incremento al cliente?',
    'opciones' => [
        'a' => 'Daily Scrum.',
        'b' => 'Sprint Review.',
        'c' => 'Backlog refinement.',
        'd' => 'Sprint Retrospective.'
    ],
    'correcta' => 'b',
    'porque'   => 'La respuesta correcta es: Sprint Review. La Retrospectiva es del equipo y mira el proceso, no el producto.'
],

/* ---------------------------------------------------------------- P8 */
'p8' => [
    'minutos'  => '2 minutos · 1,00 punto',
    'texto'    => 'Durante un sprint de Scrum se entrega un incremento, entendido &eacute;ste como un entregable funcional. En tal sentido, &iquest;estar&iacute;a bien desarrollar un sprint que se encargue espec&iacute;ficamente de la etapa de pruebas funcionales y de integraci&oacute;n?',
    'opciones' => [
        'a' => 'Verdadero',
        'b' => 'Algunas Veces.',
        'c' => 'Falso'
    ],
    'correcta' => 'c',
    'porque'   => 'Falso. Cada sprint debe producir un incremento que cumpla la <i>Definition of Done</i>, y eso ya incluye desarrollo, pruebas, integraci&oacute;n y validaci&oacute;n. Las pruebas van dentro del mismo sprint en que se desarrolla, no en un sprint aparte.'
],

/* ---------------------------------------------------------------- P9 */
'p9' => [
    'minutos'  => '2 minutos · 1,00 punto',
    'texto'    => 'Un caso de negocio describe detalles de un proyecto, de manera que pueda ser evaluado por equipos tomadores de decisi&oacute;n con el &aacute;nimo de aprobar o no su ejecuci&oacute;n. &iquest;En ese orden de ideas, qu&eacute; secciones debe incluir un caso de negocio?',
    'opciones' => [
        'a' => 'Objetivos estrat&eacute;gicos organizacionales o personales con los que se asocia el proyecto<br>Alcance del proyecto<br>An&aacute;lisis financiero',
        'b' => 'Objetivos que persigue el negocio (concretamente objetivos financieros)<br>An&aacute;lisis DOFA y de valores<br>Alcance del proyecto<br>An&aacute;lisis de enfoque del proyecto'
    ],
    'correcta' => 'a',
    'porque'   => 'La respuesta correcta es: Objetivos estrat&eacute;gicos organizacionales o personales con los que se asocia el proyecto, Alcance del proyecto, An&aacute;lisis financiero.'
              . '<br>Coinciden con las secciones del caso de negocio del curso: objetivos estrat&eacute;gicos con los que se alinea el problema, alcance de la soluci&oacute;n propuesta (con lo que <i>no</i> hace parte), y an&aacute;lisis financiero con TIR, periodo de retorno y ROI. El DOFA no va en el caso de negocio: es el insumo previo de la planeaci&oacute;n estrat&eacute;gica.'
              . '<div class="fuente"><b>Material:</b> &laquo;Plantilla de caso de negocio&raquo; y &laquo;Casos de negocio en GDP de TI&raquo;.</div>'
],

/* ---------------------------------------------------------------- P10 */
'p10' => [
    'minutos'  => '2 minutos · 1,00 punto',
    'texto'    => '&iquest;Cu&aacute;ndo comienza el segundo Sprint?',
    'opciones' => [
        'a' => 'Cuando el Development Team decide.',
        'b' => 'Antes de que el primer Sprint termine.',
        'c' => 'Cuando termina el primer sprint y se entrega un incremento se pasa a realizar el an&aacute;lisis de los requerimientos que podr&aacute;n entrar en el 2do sprint. Una vez terminado dicho an&aacute;lisis, puede empezar el 2do sprint.',
        'd' => 'Inmediatamente despu&eacute;s del primer Sprint.'
    ],
    'correcta' => 'd',
    'porque'   => 'La respuesta correcta es: Inmediatamente despu&eacute;s del primer Sprint.'
],

/* ---------------------------------------------------------------- P11 */
'p11' => [
    'minutos'  => '8 minutos · 3,00 puntos',
    'texto'    => 'Usted, como director de proyecto, tiene la tarea de desarrollar una plataforma tecnol&oacute;gica para la agricultura de precisi&oacute;n. Se han identificado requisitos detallados para avanzar en el desarrollo durante los pr&oacute;ximos 6 meses, luego de los cuales se iniciar&aacute; un proceso de descubrimiento de requerimientos al tiempo que se desarrolla el producto, esto &uacute;ltimo se har&aacute; durante 8 meses. Durante esos 8 meses el cliente participar&aacute; activamente, y se ir&aacute;n generando versiones funcionales del producto cada dos meses para evaluar si el resultado est&aacute; alineado con los requerimientos del mercado.',
    'opciones' => [
        'a' => $IMG_B,
        'b' => 'Ninguno de los anteriores',
        'c' => $IMG_A
    ],
    'correcta' => 'b',
    'porque'   => 'La respuesta correcta es: <b>Ninguno de los anteriores</b>. El caso es h&iacute;brido (6 meses predictivos y despu&eacute;s 8 meses adaptativos con entregas cada dos meses) y ninguno de los dos diagramas lo representa.'
],

/* ---------------------------------------------------------------- P13 */
'p13' => [
    'minutos'  => '8 minutos · 3,00 puntos',
    'texto'    => 'Usted, como director de proyecto, tiene la tarea de desarrollar un dise&ntilde;o para la construcci&oacute;n de un edificio vacacional. Se han identificado requisitos detallados y se ha construido un dise&ntilde;o de alto nivel. El cliente desea que usted estudie los requerimientos y el dise&ntilde;o de alto nivel para que entregue su punto de vista de lo que ser&iacute;a una adecuada planeaci&oacute;n del proyecto. El cliente quiere tener incrementos peri&oacute;dicos en fechas exactas que le ha establecido.',
    'opciones' => [
        'a' => $IMG_A,
        'b' => $IMG_B,
        'c' => 'Ninguno de los anteriores'
    ],
    'correcta' => 'b',
    'porque'   => 'La respuesta es <b>Predictivo incremental</b>: requisitos detallados y dise&ntilde;o de alto nivel ya construidos (predictivo), con incrementos en fechas exactas fijadas por el cliente (incremental).'
],

];


$EMPAREJAR = [

/* ---------------------------------------------------------------- P3 */
'e3' => [
    'minutos'  => '8 minutos · 1,00 punto',
    'texto'    => 'A continuaci&oacute;n se presentan algunos proyectos que la junta directiva de la empresa AutoData Solutions desea que usted clasifique seg&uacute;n los objetivos estrat&eacute;gicos, para tomar una decisi&oacute;n acerca de qu&eacute; proyecto priorizar para este a&ntilde;o.',
    'opciones' => [$OE1, $OE2, $OE3, $OE4],
    'items'    => [
        '<b>Herramienta de miner&iacute;a de datos para detecci&oacute;n de fraudes:</b> Implementaci&oacute;n de una soluci&oacute;n que analice grandes vol&uacute;menes de datos para identificar patrones de fraude en transacciones bancarias.' => $OE1,
        '<b>Sistema de visualizaci&oacute;n de datos para servicios p&uacute;blicos:</b> Creaci&oacute;n de un software que transforme datos complejos en dashboards interactivos para mejorar la toma de decisiones en empresas de servicios p&uacute;blicos.' => $OE1,
        '<b>Plataforma de an&aacute;lisis predictivo para banca:</b> Desarrollo de una herramienta que permita a los bancos prever tendencias de mercado y comportamientos de clientes mediante inteligencia artificial.' => $OE1,
        '<b>Academia de capacitaci&oacute;n en an&aacute;lisis de datos y automatizaci&oacute;n:</b> Creaci&oacute;n de una plataforma gratuita en l&iacute;nea con cursos, talleres y certificaciones en an&aacute;lisis de datos y automatizaci&oacute;n de procesos, dirigida a clientes.' => $OE2,
        '<b>Campa&ntilde;a de marketing digital "Data-Driven Success":</b> Implementaci&oacute;n de una campa&ntilde;a integral de marketing digital que incluye SEO, contenido de valor, email marketing y webinars para atraer leads calificados.' => $OE3,
        '<b>Automatizaci&oacute;n de procesos de atenci&oacute;n al cliente en banca:</b> Desarrollo de un sistema basado en chatbots y RPA (Automatizaci&oacute;n Rob&oacute;tica de Procesos) para agilizar la atenci&oacute;n al cliente en entidades bancarias.' => $OE1,
        '<b>Sistema de automatizaci&oacute;n de reportes regulatorios para banca:</b> Implementaci&oacute;n de una soluci&oacute;n que genere autom&aacute;ticamente reportes regulatorios, reduciendo tiempos y errores en procesos de cumplimiento normativo.' => $OE1,
        '<b>Software de gesti&oacute;n automatizada de facturas para servicios p&uacute;blicos:</b> Creaci&oacute;n de una plataforma que automatice la emisi&oacute;n, seguimiento y cobro de facturas en empresas de servicios p&uacute;blicos.' => $OE1,
        '<b>Expansi&oacute;n internacional mediante alianzas estrat&eacute;gicas:</b> Desarrollo de una estrategia para ingresar a nuevos mercados internacionales (Europa y Asia) mediante alianzas con distribuidores, integradores y socios locales.' => $OE4,
    ],
    'porque'   => 'Esto es <b>direcci&oacute;n de portafolio</b>: una colecci&oacute;n de programas, proyectos y operaciones cuyo fin es demostrar el cumplimiento de la estrategia, y cuyos componentes se miden, clasifican y priorizan. Se clasifica por el <b>fin</b> del proyecto, no por la tecnolog&iacute;a: producto de datos o automatizaci&oacute;n para un cliente externo &rarr; OE1; relaci&oacute;n y soporte con los clientes actuales (la academia gratuita dirigida a clientes) &rarr; OE2; visibilidad de marca y generaci&oacute;n de leads &rarr; OE3; clientes y mercados nuevos (la expansi&oacute;n a Europa y Asia) &rarr; OE4.'
              . '<div class="fuente"><b>Material:</b> &laquo;Def Proyecto - OKRs&raquo;, portafolios y programas.</div>'
],

/* ---------------------------------------------------------------- P12 */
'e12' => [
    'minutos'  => '5 minutos · 1,00 punto',
    'texto'    => 'Para el proyecto: "Automatizaci&oacute;n de procesos de atenci&oacute;n al cliente en banca: Desarrollo de un sistema basado en chatbots y RPA (Automatizaci&oacute;n Rob&oacute;tica de Procesos) para agilizar la atenci&oacute;n al cliente en entidades bancarias."<br>Se ha planteado un flujo de caja que tiene los siguientes ingresos y egresos. Clasifique cada uno con su respectiva clase: Ingreso o Egreso.',
    'opciones' => ['Ingresos', 'Egresos'],
    'items'    => [
        'Capacitaci&oacute;n del equipo --&gt; $100'                          => 'Egresos',
        'Ventas de licencias (A&ntilde;o 2, 10 bancos) --&gt; $5,000'         => 'Ingresos',
        'Licencias y Servidores en la nube --&gt; $250'                       => 'Egresos',
        'Ventas de licencias (A&ntilde;o 3, 20 bancos) --&gt; 10,000'         => 'Ingresos',
        'Consultores, Gerente de proyecto y Equipo de desarrollo --&gt; $900' => 'Egresos',
        'Costos de comercializaci&oacute;n (anuales, por 3 a&ntilde;os) --&gt; $900' => 'Egresos',
        'Pago de imprevistos por cambios en los requerimientos --&gt; $150'   => 'Egresos',
        'Ventas de licencias (A&ntilde;o 1, 5 bancos) --&gt; $2,500'          => 'Ingresos',
    ],
    'porque'   => '<b>Egreso</b> es todo lo que sale de caja para construir y sostener el producto (equipo, infraestructura en la nube, capacitaci&oacute;n, comercializaci&oacute;n, imprevistos por cambios en los requerimientos); <b>ingreso</b> es lo que entra por vender o licenciar. Con las dos columnas se arma el flujo de caja del caso de negocio y se calculan TIR, periodo de retorno y ROI &mdash; como en el ejemplo de la cafeter&iacute;a: $182.000.000 de inversi&oacute;n inicial contra $240.000.000 de beneficio en 6 meses, ROI 31,86% y B/C 1,30.'
              . '<div class="fuente"><b>Material:</b> &laquo;Planeaci&oacute;n estrat&eacute;gica - Caso de negocio - Flujo de caja&raquo; y el ejemplo &laquo;Plataforma de Reservas de Cafeter&iacute;a&raquo;.</div>'
],

];

/* ---- huecos de las tres preguntas abiertas ---- */
$SOLUCIONES = [
    /* P2 · resultados clave */
     1 => ['infinitivo'],
     2 => ['indicador', 'metrica'],
     3 => ['meta'],
     4 => ['plazo', 'periodo', 'tiempo'],
     5 => ['medir'],
     6 => ['alcanzar', 'lograr'],
     7 => ['iniciativa', 'tarea', 'proyecto'],
     8 => ['satisfaccion', 'csat'],
     9 => ['cobertura'],
    10 => ['proactivo'],

    /* P5 · enfoque del proyecto de dashboards */
    11 => ['hibrido'],
    12 => ['alcance'],
    13 => ['predictivo'],
    14 => ['diseno'],
    15 => ['iterativo'],
    16 => ['especificados', 'definidos'],
    17 => ['predictivo'],
    18 => ['funcional'],
    19 => ['incremental'],
    20 => ['iterativo'],

    /* P7 · relacion entre las caracteristicas */
    21 => ['proposito'],
    22 => ['camino'],
    23 => ['logro'],
    24 => ['cuantifican'],
    25 => ['temporalizan'],
    26 => ['iniciativa'],
    27 => ['habilitadores'],
    28 => ['restricciones'],
    29 => ['conformacion'],
    30 => ['equipos'],
];

iniciar($MULTIPLE, $EMPAREJAR, $SOLUCIONES);
cabecera('Examen 1 Grupo001', 'Unidad 1 - Formulacion de Proyectos · 26,00 puntos · 13 preguntas');
?>

<div class="card">
  <h2>Examen 1 Grupo001</h2>
  <p>Las 13 preguntas del examen, en el mismo orden y con el mismo texto.
     Las de opci&oacute;n m&uacute;ltiple y las de emparejar se corrigen solas; las tres
     preguntas abiertas guardan lo que escribas y traen la r&uacute;brica y la
     retroalimentaci&oacute;n del profesor para que compares.</p>
</div>

<div class="card">
  <h2>Pregunta 1</h2>
  <?php mc('p1'); ?>
</div>

<div class="card">
  <h2>Pregunta 2</h2>
  <?php
  enunciado('',
    '<div class="minutos">(15 minutos · 3,00 puntos)</div>'
    . 'La empresa AutoData Solutions ha definido su misi&oacute;n y visi&oacute;n pero requiere que le ayude a definir 2 Resultados clave asociados al objetivo estrat&eacute;gico de "fortalecer la experiencia del cliente y el soporte postventa". Para cada resultado clave, presente el t&iacute;tulo de un proyecto que apunte a lograr el resultado definido.<br>'
    . 'Tenga en cuenta que la empresa cuenta con un grupo de 10 clientes en la actualidad y con ellos ha realizado proyectos de nuevos productos, actualizaci&oacute;n y soporte.');

  respuestaIni('Completa la respuesta &mdash; cada hueco suma en el marcador');
  ?>
  <p class="sub">La f&oacute;rmula de un resultado clave</p>
  <p>Verbo en <?php hueco(1, 12); ?> + <?php hueco(2, 12); ?> + ahora /
     <?php hueco(3, 9); ?>, con un <?php hueco(4, 9); ?> para lograrlo.</p>
  <p>Por eso el KR no puede ser <?php hueco(5, 9); ?>, debe ser <?php hueco(6, 11); ?> algo.
     La encuesta no es el resultado: es la <?php hueco(7, 12); ?> que lleva al resultado.</p>

  <p class="sub">Los dos resultados clave, cada uno con su proyecto</p>
  <p><b>KR 1:</b> aumentar la <?php hueco(8, 14); ?> de los 10 clientes activos del 70% al 90%
     en los pr&oacute;ximos 12 meses.<br>
     <i>Proyecto:</i> sistema de encuestas y seguimiento de satisfacci&oacute;n postventa.</p>
  <p><b>KR 2:</b> aumentar la <?php hueco(9, 12); ?> del soporte postventa del 60% al 90% de
     los clientes con acompa&ntilde;amiento <?php hueco(10, 11); ?> en 8 meses.<br>
     <i>Proyecto:</i> programa de consultas proactivas de acompa&ntilde;amiento postventa.</p>
  <?php
  respuestaFin();

  escribir('a2', [
      ['t'      => 'Resultado clave #1',
       'ayuda'  => 'Verbo en infinitivo + indicador + ahora/meta + plazo. No empieza por &laquo;medir&raquo;.',
       'filas'  => 3,
       'modelo' => 'Aumentar la satisfacción (CSAT) de los 10 clientes activos del 70% al 90% en los próximos 12 meses.'],

      ['t'      => 'Proyecto que apunta al resultado clave #1',
       'ayuda'  => 'El t&iacute;tulo del proyecto, m&aacute;s una l&iacute;nea de qu&eacute; hace.',
       'filas'  => 3,
       'modelo' => "Sistema de encuestas y seguimiento de satisfacción postventa.\nAplica una encuesta después de cada entrega, actualización o soporte a los 10 clientes y hace seguimiento de los casos con calificación baja."],

      ['t'      => 'Resultado clave #2',
       'ayuda'  => 'Que no mida lo mismo que el #1. Este es el que faltaba en tu intento.',
       'filas'  => 3,
       'modelo' => 'Aumentar la cobertura del soporte postventa del 60% al 90% de los clientes con acompañamiento proactivo en 8 meses.'],

      ['t'      => 'Proyecto que apunta al resultado clave #2',
       'ayuda'  => 'El t&iacute;tulo del proyecto, m&aacute;s una l&iacute;nea de qu&eacute; hace.',
       'filas'  => 3,
       'modelo' => "Programa de consultas proactivas de acompañamiento postventa.\nCalendariza consultas periódicas con cada cliente después de la venta, sin esperar a que el cliente reporte el problema."],
  ]);

  apoyo(
    '<p>Se piden <b>2 resultados clave</b> y, asociado a cada uno, <b>un proyecto</b>. La f&oacute;rmula del curso: <code>Verbo en infinitivo + Indicador + Ahora / Meta</code>, con plazo. El objetivo dice <i>a d&oacute;nde voy</i>, el KR dice <i>c&oacute;mo s&eacute; que lleg&eacute;</i>, y la iniciativa (el proyecto) es <i>c&oacute;mo llego</i>.</p>'
    . '<p>Por eso &laquo;<b>medir</b> la experiencia del cliente con una encuesta&raquo; no es un KR: medir es la tarea. Lo que hay que escribir es el nivel que se quiere <b>alcanzar</b>. La pregunta que lo desarma, tal como en el ejemplo del material (&laquo;llamar a 10 clientes&raquo;): <b>&iquest;qu&eacute; aumenta o disminuye con hacer esa encuesta?</b> La satisfacci&oacute;n. Entonces el KR es la satisfacci&oacute;n, y la encuesta es la iniciativa.</p>'
    . '<p>Los dos KR de arriba traen verbo en infinitivo, indicador con punto de partida y meta, y plazo. Es la forma de los KR de tu propia planeaci&oacute;n personal: <i>&laquo;incrementar mi pr&aacute;ctica individual de piano de 2 a 5 horas semanales antes de diciembre de 2026&raquo;</i>, con su proyecto asociado.</p>'
    . '<div class="fuente"><b>Material:</b> &laquo;Def Proyecto - OKRs&raquo; &mdash; <i>Caracter&iacute;sticas clave de los Key Results: verbo infinitivo &ndash; indicador &ndash; ahora/meta</i>, iniciativas como proyectos derivados de los OKR, ejemplo &laquo;Alcanzar un record de ventas&raquo;. Tambi&eacute;n tu propio <i>Persona.pdf</i>.</div>'
    . '<p class="nota"><b>Retroalimentaci&oacute;n del profesor en este intento (1,00/3,00):</b> se solicitaron 2 resultados claves y, asociado a cada uno, un proyecto. Solo se presenta un KR y un proyecto. Debes mejorar la descripci&oacute;n. El KR no puede ser <b>medir</b>, debe ser <b>alcanzar</b> algo.</p>',

    '<ul><li>Los 2 resultados clave est&aacute;n temporalizados y cuantificados.</li>'
    . '<li>Los 2 resultados clave se relacionan de forma expl&iacute;cita con el objetivo estrat&eacute;gico.</li>'
    . '<li>Los 2 proyectos apuntan al logro de los resultados clave.</li></ul>'
  );
  enviar('Guardar lo escrito');
  ?>
</div>

<div class="card">
  <h2>Pregunta 3</h2>
  <?php empareja('e3'); enviar(); ?>
</div>

<div class="card">
  <h2>Pregunta 4</h2>
  <?php mc('p4'); ?>
</div>

<div class="card">
  <h2>Pregunta 5</h2>
  <?php
  enunciado('',
    '<div class="minutos">(20 minutos · 5,00 puntos)</div>'
    . 'Se requiere desarrollar un software que transforme datos complejos de servicios p&uacute;blicos (energ&iacute;a, agua, gas) en dashboards interactivos para mejorar la toma de decisiones.<br>'
    . 'Los requerimientos funcionales del software est&aacute;n bien definidos para un cronograma de 4 meses de desarrollo, incluyendo la integraci&oacute;n con sistemas de gesti&oacute;n y la generaci&oacute;n de visualizaciones en tiempo real. El dise&ntilde;o de la interfaz gr&aacute;fica no existe y el cliente ha pedido intervenir luego de que est&eacute; listo el dise&ntilde;o para retroalimentar el mismo. Durante el desarrollo del incremento NO se realizar&aacute;n reuniones de trabajo relacionadas con el alcance/requerimientos de futuros desarrollos.<br>'
    . 'Luego de que el cliente reciba el incremento al final del mes 4, se ha propuesto realizar retroalimentaci&oacute;n con base en dicho incremento, con el fin de especificar nuevos requerimientos para 5 meses m&aacute;s de desarrollo, pero solicitando tener entregas funcionales una vez cada final de mes.<br>'
    . 'Suponga que usted es el gerente de este proyecto y debe proponer un enfoque. Defina qu&eacute; enfoque utilizar&iacute;a, plantee un diagrama gr&aacute;fico como los elaborados en clase. Recuerde incluir representaci&oacute;n del tiempo para que sea posible evaluar su soluci&oacute;n en los diferentes meses del proyecto, y describir el/los enfoques que aplican en cada periodo de tiempo. Por ejemplo, "para el mes 1-4 el enfoque es adaptativo, a partir de ah&iacute; el enfoque es predictivo-iterativo".<br>'
    . 'Debe cargar un archivo con la imagen que describe el proceso y en la l&iacute;nea de respuesta debe escribir el enfoque seleccionado; en caso de que sea h&iacute;brido, deber&aacute; especificar en qu&eacute; meses es de una forma y en qu&eacute; meses es de otra forma.');

  respuestaIni('Completa la respuesta &mdash; cada hueco suma en el marcador');
  ?>
  <p>Se declara un enfoque <?php hueco(11, 10); ?>.</p>

  <p class="sub">Meses 1 a 4</p>
  <p>Los requerimientos funcionales est&aacute;n bien definidos para todo el cronograma y durante
     el desarrollo NO hay reuniones sobre el <?php hueco(12, 11); ?> ni sobre requerimientos
     futuros, as&iacute; que el enfoque es <?php hueco(13, 12); ?>. Adem&aacute;s, el
     <?php hueco(14, 10); ?> de la interfaz gr&aacute;fica se le presenta al cliente para que lo
     retroalimente y se vuelve sobre &eacute;l, lo que hace que este periodo tambi&eacute;n sea
     <?php hueco(15, 11); ?>.</p>

  <p class="sub">Meses 5 a 9</p>
  <p>Los requerimientos de la segunda etapa quedan <?php hueco(16, 14); ?> a partir de la
     retroalimentaci&oacute;n del mes 4, o sea que el alcance vuelve a estar definido de antemano
     y el enfoque sigue siendo <?php hueco(17, 12); ?>. Lo que se agrega es una entrega
     <?php hueco(18, 11); ?> al final de cada mes, es decir, <?php hueco(19, 12); ?>.</p>

  <p>La diferencia que hay que tener clara: <?php hueco(20, 11); ?> es volver sobre lo mismo
     para mejorarlo; incremental es ir a&ntilde;adiendo partes funcionales nuevas.</p>
  <?php
  respuestaFin();

  escribir('a5', [
      ['t'      => 'Enfoque general del proyecto',
       'ayuda'  => 'Predictivo, adaptativo, iterativo o h&iacute;brido. Una palabra basta.',
       'filas'  => 2,
       'modelo' => 'Híbrido.'],

      ['t'      => 'Meses 1 a 4: qué enfoque aplica y por qué',
       'ayuda'  => 'Son dos etiquetas, no una. &iquest;Sobre qu&eacute; se vuelve en ese periodo?',
       'filas'  => 4,
       'modelo' => "Predictivo e iterativo.\nLos requerimientos funcionales están bien definidos para todo el cronograma de 4 meses y durante el desarrollo NO hay reuniones sobre alcance ni sobre requerimientos futuros: el alcance está congelado, eso es predictivo. Y el diseño de la interfaz gráfica, que no existe, se le presenta al cliente para que lo retroalimente y se vuelve sobre él: eso es iterativo."],

      ['t'      => 'Meses 5 a 9: qué enfoque aplica y por qué',
       'ayuda'  => 'Cuidado: aqu&iacute; no es adaptativo. &iquest;Se sigue descubriendo alcance o solo se entrega por partes?',
       'filas'  => 4,
       'modelo' => "Predictivo e incremental.\nLos requerimientos de esta segunda etapa quedan especificados a partir de la retroalimentación del mes 4, así que el alcance vuelve a estar definido de antemano. Lo que se agrega es la entrega de una versión funcional al final de cada mes: son incrementos sobre requerimientos ya definidos, no descubrimiento continuo de alcance."],

      ['t'      => 'Descripción del diagrama que entregarías',
       'ayuda'  => 'Tiene que verse el tiempo en meses: eso se califica aparte.',
       'filas'  => 6,
       'modelo' => "Una línea de tiempo de 9 meses, con el eje del tiempo abajo.\nMeses 1 a 4: bloque de Análisis -> Diseño -> Desarrollo, con una flecha de retorno sobre el diseño de la interfaz (la iteración con el cliente) y una única flecha de Incremento al final del mes 4.\nMeses 5 a 9: a partir de la retroalimentación del mes 4, una planeación de los nuevos requerimientos y luego cinco bloques de desarrollo, uno por mes, cada uno con su flecha de Incremento.\nUna línea vertical punteada en el mes 4 separando los dos periodos, rotulados 'predictivo-iterativo' y 'predictivo-incremental'."],
  ]);

  apoyo(
    '<p class="nota"><b>Respuesta del profesor, literal:</b> &laquo;Se declara un enfoque <b>h&iacute;brido</b>, <b>predictivo, iterativo</b> los primeros 4 meses y <b>predictivo, incremental</b> los &uacute;ltimos 5 meses.&raquo;</p>'
    . '<p>Ojo con la diferencia: <b>iterativo</b> es volver sobre lo mismo para mejorarlo; <b>incremental</b> es ir a&ntilde;adiendo partes funcionales nuevas.</p>'

    . '<p><b>C&oacute;mo se justifica con el material.</b> En el ciclo de vida <b>predictivo</b>, la l&iacute;nea base del alcance es la versi&oacute;n aprobada del enunciado del alcance y <i>solo puede cambiarse mediante un procedimiento formal de control de cambios</i>; validar el alcance ocurre con cada entregable o revisi&oacute;n de fase. Por eso la frase &laquo;durante el desarrollo del incremento NO se realizar&aacute;n reuniones de trabajo relacionadas con el alcance&raquo; es la se&ntilde;al de que los meses 1&ndash;4 son predictivos: el alcance est&aacute; congelado.</p>'
    . '<p>En el ciclo de vida <b>adaptativo o &aacute;gil</b>, por cada iteraci&oacute;n se repiten recopilar requisitos, definir el alcance y crear la EDT; el patrocinador y los representantes del cliente est&aacute;n continuamente involucrados dando retroalimentaci&oacute;n sobre los entregables, y se usan <i>backlogs</i> para reflejar las necesidades actuales. Esa es la segunda mitad del proyecto.</p>'
    . '<p>Que el profesor califique los &uacute;ltimos 5 meses como <b>predictivo-incremental</b> y no como adaptativo tiene su l&oacute;gica: los requerimientos de esa segunda etapa quedan <i>especificados</i> en la retroalimentaci&oacute;n del mes 4, y a partir de ah&iacute; lo que ocurre es entregar por partes en fechas fijas &mdash; no hay descubrimiento continuo de alcance. La pista para distinguirlos es si el alcance se sigue descubriendo (adaptativo) o solo se entrega por trozos (incremental).</p>'
    . '<div class="fuente"><b>Material:</b> &laquo;Procesos requisitos-Alcance-EDT&raquo;, l&aacute;mina <i>Ciclo de vida de Proyecto PREDICTIVO vs ADAPTATIVO o &Aacute;GIL</i>; &laquo;Mentalidad - Principios - Dominios - Procesos&raquo;, ciclo de vida del proyecto (enfoques predictivo, adaptativo, h&iacute;brido y cadencia).</div>',

    '<ul><li>Declara el enfoque general (h&iacute;brido).</li>'
    . '<li>Indica el enfoque de los meses 1&ndash;4 y lo justifica.</li>'
    . '<li>Indica el enfoque de los meses 5&ndash;9 y lo justifica.</li>'
    . '<li>El diagrama representa el tiempo en meses.</li>'
    . '<li>El diagrama refleja lo indicado en cada periodo.</li></ul>'
  );
  enviar('Guardar lo escrito');
  ?>
</div>

<div class="card">
  <h2>Pregunta 6</h2>
  <?php mc('p6'); ?>
</div>

<div class="card">
  <h2>Pregunta 7</h2>
  <?php
  enunciado('',
    '<div class="minutos">(10 minutos · 4,00 puntos)</div>'
    . 'Antes de decidir emprender un proyecto es importante estudiar diferentes caracter&iacute;sticas en su contexto. Si el proyecto debe realizarse en equipos, las caracter&iacute;sticas aumentan. Entre dichas caracter&iacute;sticas est&aacute;n los valores que profesamos (&eacute;tica y moral), an&aacute;lisis DOFA, prop&oacute;sito en la vida (misi&oacute;n y visi&oacute;n), objetivos estrat&eacute;gicos personales u organizacionales y resultados clave.<br>'
    . 'Escriba un p&aacute;rrafo donde explique la relaci&oacute;n entre estas caracter&iacute;sticas y la decisi&oacute;n de emprender un proyecto. Sea expl&iacute;cito en las relaciones entre las caracter&iacute;sticas.');

  respuestaIni('Las cuatro relaciones que valen 1 punto cada una');
  ?>
  <p>La misi&oacute;n y la visi&oacute;n declaran el <?php hueco(21, 12); ?> de la organizaci&oacute;n.</p>
  <p>Los objetivos estrat&eacute;gicos son el <?php hueco(22, 10); ?> declarado para alcanzar
     ese prop&oacute;sito.</p>
  <p>Los resultados clave son la medida de <?php hueco(23, 9); ?> de los objetivos
     estrat&eacute;gicos: los <?php hueco(24, 13); ?> y los <?php hueco(25, 14); ?>.</p>
  <p>Cada proyecto es la <?php hueco(26, 12); ?> con la que se alcanza un resultado clave.</p>
  <p>El an&aacute;lisis DOFA presenta los <?php hueco(27, 14); ?> y las
     <?php hueco(28, 14); ?> para lograr exitosamente lo planeado.</p>
  <p>Los valores (&eacute;tica y moral) son la caracter&iacute;stica con la que se eval&uacute;a
     la <?php hueco(29, 14); ?> de los <?php hueco(30, 10); ?> de proyecto.</p>
  <?php
  respuestaFin();

  escribir('a7', [
      ['t'      => 'Relación 1 — Propósito (misión y visión) con los objetivos estratégicos',
       'ayuda'  => 'Vale 1 punto.',
       'filas'  => 3,
       'modelo' => 'La misión y la visión declaran el propósito: quiénes somos hoy y a dónde queremos llegar. Los objetivos estratégicos son el camino declarado para alcanzar ese propósito.'],

      ['t'      => 'Relación 2 — Objetivos estratégicos con los resultados clave',
       'ayuda'  => 'Vale 1 punto. &iquest;Para qu&eacute; sirven los Key Results?',
       'filas'  => 3,
       'modelo' => 'Los resultados clave miden el logro de los objetivos estratégicos: los cuantifican y los temporalizan, así que permiten saber si el objetivo se está cumpliendo.'],

      ['t'      => 'Relación 3 — Análisis DOFA con los objetivos, resultados y proyectos',
       'ayuda'  => 'Vale 1 punto. La palabra que buscan es habilitadores y restricciones.',
       'filas'  => 3,
       'modelo' => 'El DOFA analiza lo interno y lo externo y presenta los habilitadores (fortalezas y oportunidades) y las restricciones (debilidades y amenazas) para lograr lo planeado. Por eso condiciona qué objetivos son realistas y qué proyecto conviene emprender.'],

      ['t'      => 'Relación 4 — Los valores (ética y moral) y el equipo',
       'ayuda'  => 'Vale 1 punto. No basta con decir que importan &laquo;en grupos&raquo;.',
       'filas'  => 3,
       'modelo' => 'Los valores son la característica con la que se evalúa la conformación de los equipos de proyecto: con quién se puede trabajar y bajo qué reglas. El equipo se arma buscando pares que coincidan en misión, visión, objetivos estratégicos y valores.'],

      ['t'      => 'El párrafo final: une las cuatro relaciones',
       'ayuda'  => 'Esto es lo que se entrega. Debe leerse como un texto corrido.',
       'filas'  => 7,
       'modelo' => 'Todo lo nombrado son pilares para decidir si se emprende un proyecto. La misión y la visión declaran el propósito y permiten ver más allá del presente, y los objetivos estratégicos son el camino declarado para alcanzarlo. Los resultados clave miden concretamente, en tiempo y en porcentaje, si esos objetivos se están logrando, y cada proyecto es la iniciativa con la que se alcanza un resultado clave. El análisis DOFA, interno y externo, presenta los habilitadores y las restricciones para lograr lo planeado, de modo que permite crear objetivos coherentes con la misión y la visión y decidir qué tan viable resulta emprender el proyecto. Y cuando el trabajo se hace en equipo se suman los valores, la ética y la moral, que son el criterio para evaluar la conformación del equipo y con quién se puede trabajar.'],
  ]);

  apoyo(
    '<p class="nota"><b>Esta pregunta obtuvo 4,00/4,00 en este intento.</b> El p&aacute;rrafo que lo consigui&oacute;:</p>'
    . '<p><i>&laquo;Principalmente todo lo nombrado son pilares necesarios para poder que una empresa u organizaci&oacute;n emprendan, entonces su misi&oacute;n y visi&oacute;n hacen que se pueda ver m&aacute;s all&aacute; de una empresa, si no que quieren a futuro c&oacute;mo se ven en el mercado y tambi&eacute;n c&oacute;mo compiten en el mercado. El an&aacute;lisis DOFA se centra en un an&aacute;lisis tanto interno como externo para una mejora e impulso de la empresa, donde con ayuda de su caracterizaci&oacute;n en el mercado crean objetivos asociados a su misi&oacute;n y visi&oacute;n que ayudan a cumplir las estrategias para mejorar debilidades y tomar oportunidades gracias a los resultados clave ya que miden concretamente en cuanto a tiempo y porcentajes qu&eacute; tan viable o no terminar&iacute;a siendo el emprender un proyecto.&raquo;</i></p>'
    . '<p>Lo que hay que dejar expl&iacute;cito: el prop&oacute;sito (misi&oacute;n y visi&oacute;n) se persigue mediante los <b>objetivos estrat&eacute;gicos</b>; los <b>resultados clave</b> miden el logro de esos objetivos; el <b>DOFA</b> aporta los habilitadores y las restricciones; y los <b>valores</b> sirven para evaluar con qui&eacute;n se conforman los equipos.</p>'

    . '<p><b>La cadena del curso:</b> <code>Misi&oacute;n y Visi&oacute;n &rarr; Objetivos Estrat&eacute;gicos &rarr; Resultados Clave &rarr; Proyectos (iniciativas)</code>. El p&aacute;rrafo que sac&oacute; 4/4 recorre esa cadena entera; si se salta un eslab&oacute;n &mdash; t&iacute;picamente los resultados clave &mdash; se pierde ese punto.</p>'
    . '<p>Argumentos extra que est&aacute;n en el material por si quieres reforzar el p&aacute;rrafo: sin objetivos claros aparecen falta de direcci&oacute;n, esfuerzos dispersos, baja productividad y decisiones inconsistentes; y los objetivos fallan sobre todo por ser ambiguos, por <b>no estar alineados con la misi&oacute;n, la visi&oacute;n y la estrategia</b>, por ser poco realistas o por falta de recursos &mdash; justo lo que el DOFA deber&iacute;a anticipar como restricci&oacute;n.</p>'
    . '<p>Sobre los <b>valores</b>: en clase el equipo se arma buscando <i>&laquo;pares en relaci&oacute;n con planeaci&oacute;n estrat&eacute;gica: misi&oacute;n, visi&oacute;n, objetivos estrat&eacute;gicos y valores&raquo;</i>, con alineaci&oacute;n a la planeaci&oacute;n estrat&eacute;gica personal y coherencia con las fortalezas de cada quien (modelo Tuckman). Ese es el rol de los valores en la decisi&oacute;n: con qui&eacute;n se puede emprender.</p>'
    . '<div class="fuente"><b>Material:</b> &laquo;Def Proyecto - OKRs&raquo; (qu&eacute; pasa sin objetivos claros, por qu&eacute; fallan los objetivos, jerarqu&iacute;a de OKR); &laquo;Planeaci&oacute;n estrat&eacute;gica - Caso de negocio - Flujo de caja&raquo; (conformaci&oacute;n de equipos, modelo Tuckman, tabla de contenido del caso de negocio).</div>',

    '<ul><li>Relaciona el prop&oacute;sito (misi&oacute;n y visi&oacute;n) con los objetivos estrat&eacute;gicos.</li>'
    . '<li>Relaciona los objetivos estrat&eacute;gicos con los resultados clave como medida de logro.</li>'
    . '<li>Relaciona el an&aacute;lisis DOFA con objetivos, resultados y/o proyectos (habilitadores y restricciones).</li>'
    . '<li>Describe los valores como caracter&iacute;stica para evaluar la conformaci&oacute;n de equipos.</li>'
    . '<li>1 punto por cada buena relaci&oacute;n documentada.</li></ul>'
  );
  enviar('Guardar lo escrito');
  ?>
</div>

<div class="card">
  <h2>Pregunta 8</h2>
  <?php mc('p8'); ?>
</div>

<div class="card">
  <h2>Pregunta 9</h2>
  <?php mc('p9'); ?>
</div>

<div class="card">
  <h2>Pregunta 10</h2>
  <?php mc('p10'); enviar(); ?>
</div>

<div class="card">
  <h2>Pregunta 11</h2>
  <?php mc('p11'); ?>
</div>

<div class="card">
  <h2>Pregunta 12</h2>
  <?php empareja('e12'); enviar(); ?>
</div>

<div class="card">
  <h2>Pregunta 13</h2>
  <?php mc('p13'); ?>
</div>

<?php
pie('', '../Grupo003/index.php');
