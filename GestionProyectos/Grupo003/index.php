<?php
/* ==========================================================================
   Gerencia de Proyectos de T.I.  —  Examen 1  Grupo003
   Unidad 1 – Formulacion de Proyectos
   Transcripcion literal del intento del 11 de marzo de 2026 (26,00 puntos)
   ========================================================================== */

require_once __DIR__ . '/../motor.php';

$IMG_A = '<img src="../img/enfoque-a.png" alt="Diagrama de enfoque (opcion 1)">';
$IMG_B = '<img src="../img/enfoque-b.png" alt="Diagrama de enfoque (opcion 2)">';

$MULTIPLE = [

/* ---------------------------------------------------------------- P1 */
'p1' => [
    'minutos'  => '2 minutos · 1,00 punto',
    'texto'    => 'Un caso de negocio describe detalles de un proyecto, de manera que pueda ser evaluado por equipos tomadores de decisi&oacute;n con el &aacute;nimo de aprobar o no su ejecuci&oacute;n. &iquest;En ese orden de ideas, qu&eacute; secciones debe incluir un caso de negocio?',
    'opciones' => [
        'a' => 'Objetivos que persigue el negocio (concretamente objetivos financieros)<br>An&aacute;lisis DOFA y de valores<br>Alcance del proyecto<br>An&aacute;lisis de enfoque del proyecto',
        'b' => 'Objetivos estrat&eacute;gicos organizacionales con los que se asocia el proyecto<br>Alcance del proyecto<br>An&aacute;lisis financiero<br>Riesgos y Mitigaci&oacute;n<br>Conclusi&oacute;n y Recomendaciones'
    ],
    'correcta' => 'b',
    'porque'   => 'La respuesta correcta es: Objetivos estrat&eacute;gicos organizacionales con los que se asocia el proyecto, Alcance del proyecto, An&aacute;lisis financiero, Riesgos y Mitigaci&oacute;n, Conclusi&oacute;n y Recomendaciones.'
              . '<br>Son exactamente las secciones 2.2 a 2.6 del documento del curso: Resumen Ejecutivo, <b>Objetivos Estrat&eacute;gicos</b>, <b>Alcance del Proyecto</b>, <b>An&aacute;lisis Financiero</b>, <b>Riesgos y Mitigaci&oacute;n</b> y <b>Conclusi&oacute;n y Recomendaciones</b>. El DOFA no es una secci&oacute;n del caso de negocio: pertenece a la planeaci&oacute;n estrat&eacute;gica, que es el paso anterior.'
              . '<div class="fuente"><b>Material:</b> &laquo;Casos de negocio en GDP de TI&raquo; (estructura de un caso de negocio) y &laquo;Plantilla de caso de negocio&raquo;.</div>'
],

/* ---------------------------------------------------------------- P3 */
'p3' => [
    'minutos'  => '8 minutos · 3,00 puntos',
    'texto'    => 'Usted, como director de proyecto, tiene la responsabilidad de liderar el desarrollo del dise&ntilde;o para la construcci&oacute;n de un edificio vacacional. Para el proyecto ya se han definido requisitos detallados y se cuenta con un dise&ntilde;o de alto nivel.<br>El cliente le ha solicitado analizar esta informaci&oacute;n con el fin de proponer c&oacute;mo deber&iacute;a estructurarse la planeaci&oacute;n del proyecto. Adem&aacute;s, ha establecido que desea recibir entregables o incrementos del dise&ntilde;o en fechas espec&iacute;ficas previamente definidas.',
    'opciones' => [
        'a' => 'Ninguno de los anteriores',
        'b' => $IMG_A,
        'c' => $IMG_B
    ],
    'correcta' => 'c',
    'porque'   => 'La respuesta es <b>Predictivo incremental</b>: los requisitos ya est&aacute;n detallados y hay un dise&ntilde;o de alto nivel (predictivo), y el cliente pide entregas en fechas exactas previamente definidas (incremental).'
],

/* ---------------------------------------------------------------- P5 */
'p5' => [
    'minutos'  => '8 minutos · 3,00 puntos',
    'texto'    => 'Usted, como director de proyecto, tiene la responsabilidad de liderar el desarrollo de una plataforma tecnol&oacute;gica para agricultura de precisi&oacute;n. Inicialmente, el proyecto cuenta con requisitos detallados que permitir&aacute;n realizar el desarrollo durante los primeros 6 meses. Posteriormente, durante 8 meses adicionales, se llevar&aacute; a cabo un proceso de descubrimiento y ajuste de requerimientos, mientras el producto contin&uacute;a desarroll&aacute;ndose.<br>En esta segunda etapa, el cliente participar&aacute; activamente y se entregar&aacute;n versiones funcionales del producto cada dos meses para validar si el resultado est&aacute; alineado con las necesidades del mercado.<br>De acuerdo con esta situaci&oacute;n, &iquest;qu&eacute; enfoque de desarrollo describe mejor la gesti&oacute;n del proyecto?',
    'opciones' => [
        'a' => 'Ninguno de los anteriores',
        'b' => $IMG_A,
        'c' => $IMG_B
    ],
    'correcta' => 'a',
    'porque'   => 'La respuesta correcta es: <b>Ninguno de los anteriores</b>. Ninguno de los dos diagramas representa el caso: es un h&iacute;brido (6 meses predictivos y luego 8 meses adaptativos con entregas cada dos meses).'
],

/* ---------------------------------------------------------------- P6 */
'p6' => [
    'minutos'  => '2 minutos · 1,00 punto',
    'texto'    => 'Durante un sprint en Scrum se debe entregar un incremento del producto, entendido como una versi&oacute;n funcional y potencialmente utilizable. En este contexto, &iquest;ser&iacute;a correcto planificar un sprint dedicado exclusivamente a realizar pruebas funcionales y de integraci&oacute;n, sin desarrollar nuevas funcionalidades del producto?',
    'opciones' => [
        'a' => 'Algunas Veces.',
        'b' => 'Falso',
        'c' => 'Verdadero'
    ],
    'correcta' => 'b',
    'porque'   => 'En Scrum, cada sprint debe producir un incremento del producto que cumpla con la <i>Definition of Done</i>, lo que implica que el incremento ya incluye todas las actividades necesarias: desarrollo, pruebas, integraci&oacute;n y validaci&oacute;n. Por esta raz&oacute;n, las pruebas no deber&iacute;an realizarse en un sprint separado, sino que deben formar parte del trabajo del mismo sprint en el que se desarrollan las funcionalidades.'
],

/* ---------------------------------------------------------------- P8 */
'p8' => [
    'minutos'  => '2 minutos · 1,00 punto',
    'texto'    => '&iquest;En qu&eacute; evento se muestra un incremento al cliente?',
    'opciones' => [
        'a' => 'Backlog refinement.',
        'b' => 'Sprint Retrospective.',
        'c' => 'Daily Scrum.',
        'd' => 'Sprint Review.'
    ],
    'correcta' => 'd',
    'porque'   => 'La respuesta correcta es: Sprint Review.'
],

/* ---------------------------------------------------------------- P9 */
'p9' => [
    'minutos'  => '2 minutos · 1,00 punto',
    'texto'    => '&iquest;Scrum es?',
    'opciones' => [
        'a' => 'Adaptativo',
        'b' => 'Predictivo, iterativo e incremental'
    ],
    'correcta' => 'a',
    'porque'   => 'La respuesta correcta es: Adaptativo.'
],

/* ---------------------------------------------------------------- P10 */
'p10' => [
    'minutos'  => '2 minutos · 1,00 punto',
    'texto'    => '&iquest;Cu&aacute;ndo comienza el segundo Sprint?',
    'opciones' => [
        'a' => 'Antes de que el primer Sprint termine.',
        'b' => 'Cuando termina el primer sprint y se entrega un incremento se pasa a realizar el an&aacute;lisis de los requerimientos que podr&aacute;n entrar en el 2do sprint. Una vez terminado dicho an&aacute;lisis, puede empezar el 2do sprint.',
        'c' => 'Inmediatamente despu&eacute;s del primer Sprint.',
        'd' => 'Cuando el Development Team decide.'
    ],
    'correcta' => 'c',
    'porque'   => 'La respuesta correcta es: Inmediatamente despu&eacute;s del primer Sprint. En Scrum un sprint empieza justo cuando termina el anterior; el an&aacute;lisis y el refinamiento ocurren <i>dentro</i> del sprint, no en una pausa entre sprints.'
],

/* ---------------------------------------------------------------- P12 */
'p12' => [
    'minutos'  => '2 minutos · 1,00 punto',
    'texto'    => 'El proyecto se divide en dos Sprints, cada Sprint es de dos semanas de duraci&oacute;n, entonces...',
    'opciones' => [
        'a' => 'Se debe programar al menos dos reuniones para refinamiento en cada sprint.',
        'b' => 'No tiene sentido cualquier reuni&oacute;n de refinamiento ya que los requerimientos est&aacute;n bien definidos desde el inicio.',
        'c' => 'Para cada sprint se debe programar el refinamiento seg&uacute;n sea necesario para garantizar que un conjunto de historias de usuario cumplan con el DOR (Definition of Ready), antes de iniciar el siguiente sprint.',
        'd' => 'Se debe programar una sola reuni&oacute;n de refinamiento para los dos sprints.'
    ],
    'correcta' => 'c',
    'porque'   => 'El refinamiento se hace en cualquier momento que sea necesario, tantas veces como haga falta para que las historias cumplan el DOR antes del siguiente sprint.'
],

];


$EMPAREJAR = [

/* ---------------------------------------------------------------- P2 */
'e2' => [
    'minutos'  => '5 minutos · 1,00 punto',
    'texto'    => 'Para el proyecto: "Automatizaci&oacute;n de procesos de atenci&oacute;n al cliente en banca: Desarrollo de un sistema basado en chatbots y RPA (Automatizaci&oacute;n Rob&oacute;tica de Procesos) para agilizar la atenci&oacute;n al cliente en entidades bancarias."<br>Se ha planteado un flujo de caja que tiene los siguientes ingresos y egresos. Clasifique cada uno con su respectiva clase: Ingreso o Egreso.',
    'opciones' => ['Ingresos', 'Egresos'],
    'items'    => [
        'Pago de imprevistos --&gt; $150'                                    => 'Egresos',
        'Ventas de licencias (A&ntilde;o 2, 10 bancos) --&gt; $5,000'        => 'Ingresos',
        'Capacitaci&oacute;n del equipo --&gt; $100'                         => 'Egresos',
        'Ventas de licencias (A&ntilde;o 3, 20 bancos) --&gt; 10,000'        => 'Ingresos',
        'Ventas de licencias (A&ntilde;o 1, 5 bancos) --&gt; $2,500'         => 'Ingresos',
        'Consultores, Gerente de proyecto y Equipo de desarrollo --&gt; $900' => 'Egresos',
        'Licencias y Servidores en la nube --&gt; $250'                      => 'Egresos',
        'Costos de comercializaci&oacute;n (anuales, por 3 a&ntilde;os) --&gt; $900' => 'Egresos',
    ],
    'porque'   => 'La regla es simple: <b>egreso</b> es todo lo que sale de caja para construir y sostener el producto (equipo de trabajo, infraestructura, capacitaci&oacute;n, comercializaci&oacute;n, imprevistos); <b>ingreso</b> es lo que entra por vender o licenciar el producto. En el ejemplo de la cafeter&iacute;a del curso, la inversi&oacute;n inicial de $182.000.000 (jefe de proyecto, analista, dise&ntilde;ador, desarrolladores, infraestructura) son egresos, y el ahorro/beneficio de $240.000.000 en 6 meses es lo que entra. Con esos dos lados se calculan ROI y B/C.'
              . '<div class="fuente"><b>Material:</b> &laquo;Planeaci&oacute;n estrat&eacute;gica - Caso de negocio - Flujo de caja&raquo; y el ejemplo &laquo;Plataforma de Reservas de Cafeter&iacute;a&raquo; (tabla de costos + an&aacute;lisis de flujo de caja, ROI 31,86%, B/C 1,30).</div>'
],

/* ---------------------------------------------------------------- P4 */
'e4' => [
    'minutos'  => '8 minutos · 1,00 punto',
    'texto'    => 'A continuaci&oacute;n se presentan algunos proyectos que la junta directiva de la empresa AutoData Solutions desea que usted clasifique seg&uacute;n los objetivos estrat&eacute;gicos, para tomar una decisi&oacute;n acerca de qu&eacute; proyecto priorizar para este a&ntilde;o.',
    'opciones' => [
        'OE1 - Impulsar la transformacion digital mediante soluciones de analisis de datos y automatizacion.',
        'OE2 - Fortalecer la experiencia del cliente y el soporte postventa.',
        'OE3 - Ampliar la presencia de marca y generar oportunidades de negocio.',
        'OE4 - Expandir la cartera de clientes y diversificar mercados.'
    ],
    'items'    => [
        '<b>Software de gesti&oacute;n automatizada de facturas para servicios p&uacute;blicos:</b> Creaci&oacute;n de una plataforma que automatice la emisi&oacute;n, seguimiento y cobro de facturas en empresas de servicios p&uacute;blicos.'
            => 'OE1 - Impulsar la transformacion digital mediante soluciones de analisis de datos y automatizacion.',
        '<b>Plataforma de an&aacute;lisis predictivo para banca:</b> Desarrollo de una herramienta que permita a los bancos prever tendencias de mercado y comportamientos de clientes mediante inteligencia artificial.'
            => 'OE1 - Impulsar la transformacion digital mediante soluciones de analisis de datos y automatizacion.',
        '<b>Expansi&oacute;n internacional mediante alianzas estrat&eacute;gicas:</b> Desarrollo de una estrategia para ingresar a nuevos mercados internacionales (Europa y Asia) mediante alianzas con distribuidores, integradores y socios locales.'
            => 'OE4 - Expandir la cartera de clientes y diversificar mercados.',
        '<b>Sistema de automatizaci&oacute;n de reportes regulatorios para banca:</b> Implementaci&oacute;n de una soluci&oacute;n que genere autom&aacute;ticamente reportes regulatorios, reduciendo tiempos y errores en procesos de cumplimiento normativo.'
            => 'OE1 - Impulsar la transformacion digital mediante soluciones de analisis de datos y automatizacion.',
        '<b>Academia de capacitaci&oacute;n en an&aacute;lisis de datos y automatizaci&oacute;n:</b> Creaci&oacute;n de una plataforma gratuita en l&iacute;nea con cursos, talleres y certificaciones en an&aacute;lisis de datos y automatizaci&oacute;n de procesos, dirigida a clientes.'
            => 'OE2 - Fortalecer la experiencia del cliente y el soporte postventa.',
        '<b>Automatizaci&oacute;n de procesos de atenci&oacute;n al cliente en banca:</b> Desarrollo de un sistema basado en chatbots y RPA (Automatizaci&oacute;n Rob&oacute;tica de Procesos) para agilizar la atenci&oacute;n al cliente en entidades bancarias.'
            => 'OE1 - Impulsar la transformacion digital mediante soluciones de analisis de datos y automatizacion.',
        '<b>Campa&ntilde;a de marketing digital "Data-Driven Success":</b> Implementaci&oacute;n de una campa&ntilde;a integral de marketing digital que incluye SEO, contenido de valor, email marketing y webinars para atraer leads calificados.'
            => 'OE3 - Ampliar la presencia de marca y generar oportunidades de negocio.',
        '<b>Herramienta de miner&iacute;a de datos para detecci&oacute;n de fraudes:</b> Implementaci&oacute;n de una soluci&oacute;n que analice grandes vol&uacute;menes de datos para identificar patrones de fraude en transacciones bancarias.'
            => 'OE1 - Impulsar la transformacion digital mediante soluciones de analisis de datos y automatizacion.',
        '<b>Sistema de visualizaci&oacute;n de datos para servicios p&uacute;blicos:</b> Creaci&oacute;n de un software que transforme datos complejos en dashboards interactivos para mejorar la toma de decisiones en empresas de servicios p&uacute;blicos.'
            => 'OE1 - Impulsar la transformacion digital mediante soluciones de analisis de datos y automatizacion.',
    ],
    'porque'   => 'Esto es <b>direcci&oacute;n de portafolio</b>: una colecci&oacute;n de programas, proyectos y operaciones cuyo fin es demostrar el cumplimiento de la estrategia. Se clasifica por el <b>fin</b> del proyecto, no por la tecnolog&iacute;a que usa: si el producto automatiza o analiza datos <i>para un cliente externo</i> &rarr; OE1; si lo que mejora es la relaci&oacute;n y el soporte con los clientes actuales (la academia gratuita dirigida a clientes) &rarr; OE2; si busca visibilidad y leads &rarr; OE3; si busca clientes y mercados nuevos (la expansi&oacute;n a Europa y Asia) &rarr; OE4. Los dos que m&aacute;s se fallan son la Academia (parece OE1 por el tema, pero su fin es postventa) y la Expansi&oacute;n internacional.'
              . '<div class="fuente"><b>Material:</b> &laquo;Def Proyecto - OKRs&raquo;, secci&oacute;n de portafolios y programas: los componentes del portafolio son cuantificables, se miden, clasifican y priorizan por periodo.</div>'
],

];

/* ---- huecos de las tres preguntas abiertas ---- */
$SOLUCIONES = [
    /* P7 · enfoque del proyecto de dashboards */
     1 => ['hibrido'],
     2 => ['bien definidos', 'definidos', 'claros'],
     3 => ['alcance'],
     4 => ['predictivo'],
     5 => ['incremento', 'entregable'],
     6 => ['diseno'],
     7 => ['retroalimenta', 'revisa', 'retroalimentar'],
     8 => ['funcionales'],
     9 => ['adaptativo', 'agil'],
    10 => ['iterativo'],
    11 => ['incremental'],

    /* P11 · resultados clave */
    12 => ['infinitivo'],
    13 => ['indicador', 'metrica'],
    14 => ['meta'],
    15 => ['plazo', 'periodo', 'tiempo'],
    16 => ['iniciativa', 'proyecto'],
    17 => ['medir'],
    18 => ['impacto'],
    19 => ['satisfaccion', 'csat'],
    20 => ['quejas', 'reclamos'],
    21 => ['trimestre'],

    /* P13 · relacion entre las caracteristicas */
    22 => ['La mision y la vision declaran el proposito'],
    23 => ['camino'],
    24 => ['logro'],
    25 => ['cuantifican'],
    26 => ['temporalizan'],
    27 => ['iniciativa'],
    28 => ['habilitadores'],
    29 => ['restricciones'],
    30 => ['conformacion'],
    31 => ['equipos'],
];

iniciar($MULTIPLE, $EMPAREJAR, $SOLUCIONES);
cabecera('Examen 1 Grupo003', 'Unidad 1 - Formulacion de Proyectos · 26,00 puntos · 13 preguntas');
?>

<div class="card">
  <h2>Examen 1 Grupo003</h2>
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
  <?php empareja('e2'); enviar(); ?>
</div>

<div class="card">
  <h2>Pregunta 3</h2>
  <?php mc('p3'); ?>
</div>

<div class="card">
  <h2>Pregunta 4</h2>
  <?php empareja('e4'); enviar(); ?>
</div>

<div class="card">
  <h2>Pregunta 5</h2>
  <?php mc('p5'); ?>
</div>

<div class="card">
  <h2>Pregunta 6</h2>
  <?php mc('p6'); enviar(); ?>
</div>

<div class="card">
  <h2>Pregunta 7</h2>
  <?php
  enunciado('',
    '<div class="minutos">(20 minutos · 5,00 puntos)</div>'
    . 'Se requiere desarrollar un software que transforme datos complejos de servicios p&uacute;blicos (energ&iacute;a, agua, gas) en dashboards interactivos para mejorar la toma de decisiones.<br>'
    . 'Los requerimientos funcionales del software est&aacute;n bien definidos para un primer periodo de desarrollo de 4 meses, incluyendo la integraci&oacute;n con sistemas de gesti&oacute;n y la generaci&oacute;n de visualizaciones en tiempo real. Sin embargo, el dise&ntilde;o de la interfaz gr&aacute;fica a&uacute;n no existe. El cliente ha solicitado revisar y retroalimentar el dise&ntilde;o una vez est&eacute; listo el primer incremento. Durante estos 4 meses NO se realizar&aacute;n reuniones para definir nuevos requerimientos.<br>'
    . 'Al finalizar el mes 4, se entregar&aacute; el incremento al cliente y, con base en su retroalimentaci&oacute;n, se definir&aacute;n nuevos requerimientos para una segunda etapa de 5 meses, en la cual el cliente solicita entregas funcionales al final de cada mes, realizando retroalimentaciones que podr&iacute;an generar ajustes a los requerimientos.<br>'
    . 'Suponga que usted es el gerente del proyecto y debe proponer el enfoque de gesti&oacute;n m&aacute;s adecuado. En su respuesta:'
    . '<ul><li>Elabore un diagrama que represente el enfoque a lo largo del tiempo (meses).</li>'
    . '<li>Indique qu&eacute; enfoque utilizar&iacute;a (predictivo, adaptativo, iterativo o h&iacute;brido).</li>'
    . '<li>Si propone un enfoque h&iacute;brido, especifique qu&eacute; enfoque se aplica en cada periodo del proyecto.</li>'
    . '<li>Debe cargar un archivo con la imagen que describe el proceso y la l&iacute;nea de tiempo.</li></ul>');

  respuestaIni('Completa la respuesta &mdash; cada hueco suma en el marcador');
  ?>
  <p>Se declara un enfoque <?php hueco(1, 10); ?>, porque el proyecto tiene dos periodos
     con niveles de certidumbre distintos.</p>

  <p class="sub">Meses 1 a 4</p>
  <p>Los requerimientos funcionales est&aacute;n <?php hueco(2, 14); ?> desde el principio y
     durante estos meses NO se hacen reuniones para definir requerimientos nuevos, as&iacute; que
     el <?php hueco(3, 11); ?> est&aacute; congelado. Por eso el enfoque de este periodo es
     <?php hueco(4, 12); ?>, y se entrega un solo <?php hueco(5, 12); ?> al final del mes 4.
     La &uacute;nica incertidumbre es el <?php hueco(6, 10); ?> de la interfaz gr&aacute;fica.</p>

  <p class="sub">Meses 5 a 9</p>
  <p>El cliente <?php hueco(7, 14); ?> el incremento recibido, se definen requerimientos nuevos
     y pide entregas <?php hueco(8, 12); ?> al final de cada uno de <b>esos cinco meses</b>
     &mdash;la primera en el mes 5, porque la del mes 4 fue el cierre de la etapa anterior&mdash;.
     El enfoque de este periodo es
     <?php hueco(9, 12); ?>: se vuelve sobre lo entregado para ajustarlo, que es
     <?php hueco(10, 11); ?>, y se van agregando partes funcionales nuevas, que es
     <?php hueco(11, 12); ?>.</p>

  <p class="avisoflujo"><b>Las entregas del proyecto, en orden:</b> mes 4 &rarr; el &uacute;nico incremento de la
     etapa predictiva; meses 5, 6, 7, 8 y 9 &rarr; una entrega funcional cada mes.
     Seis incrementos en total. Lo de &laquo;al final de cada mes&raquo; solo aplica a la segunda etapa.</p>

  <details class="desp modelo">
    <summary>Ver el diagrama que hay que cargar (vale aparte en la r&uacute;brica)</summary>
    <div class="cont">
      <img src="../img/diagrama-dashboards.png" alt="Diagrama del enfoque hibrido a lo largo de 9 meses"
           style="width:100%;height:auto;border:1px solid #d8dbe0;border-radius:8px">
      <p style="margin-top:10px;font-size:13.5px">Lo que el evaluador busca en el dibujo: <b>eje de tiempo en meses</b>,
         un corte visible en el <b>mes 4</b>, <b>un solo incremento</b> en la primera etapa y
         <b>una entrega por mes</b> en la segunda, con las flechas de <b>retroalimentaci&oacute;n</b> del cliente.</p>
    </div>
  </details>
  <?php
  respuestaFin();

  escribir('a7', [
      ['t'      => 'Enfoque general del proyecto',
       'ayuda'  => 'Predictivo, adaptativo, iterativo o h&iacute;brido. Una palabra basta.',
       'filas'  => 2,
       'modelo' => 'Híbrido.'],

      ['t'      => 'Meses 1 a 4: qué enfoque aplica y por qué',
       'ayuda'  => '&iquest;Qu&eacute; informaci&oacute;n est&aacute; congelada en ese periodo?',
       'filas'  => 4,
       'modelo' => "Predictivo.\nLos requerimientos funcionales están claros y bien definidos para los 4 meses, y durante ese periodo NO hay reuniones para definir nuevos requerimientos: el alcance está congelado. Se planifica completo y se entrega el incremento al final del mes 4. La única incertidumbre es el diseño de la interfaz gráfica, que se validará después con el cliente."],

      ['t'      => 'Meses 5 a 9: qué enfoque aplica y por qué',
       'ayuda'  => '&iquest;Qu&eacute; cambia despu&eacute;s de la primera entrega?',
       'filas'  => 4,
       'modelo' => "Adaptativo / ágil (iterativo-incremental).\nDespués de la entrega del mes 4 el cliente retroalimenta, se definen requerimientos nuevos y pide entregas funcionales al final de cada mes, con ajustes que pueden modificar los requerimientos. Son ciclos cortos que entregan valor continuo."],

      ['t'      => 'Descripción del diagrama que entregarías',
       'ayuda'  => 'Tiene que verse el tiempo en meses: eso se califica aparte.',
       'filas'  => 6,
       'modelo' => "Una línea de tiempo de 9 meses, con el eje del tiempo abajo.\nMeses 1 a 4: un solo bloque en cascada (Análisis -> Diseño -> Desarrollo -> Pruebas) con una única flecha de Incremento al final del mes 4.\nMeses 5 a 9: cinco iteraciones cortas, una por mes, cada una con su flecha de Incremento, y una flecha de retroalimentación del cliente que vuelve de cada incremento a la planeación de la siguiente iteración.\nUna línea vertical punteada en el mes 4 separando los dos periodos, y cada mitad rotulada con su enfoque."],
  ]);

  apoyo(
    '<p><b>Se declara un enfoque h&iacute;brido.</b></p>'
    . '<p class="nota">C&oacute;mo se lee el enunciado, frase por frase:<br>'
    . '&laquo;Los requerimientos funcionales del software est&aacute;n bien definidos...&raquo; &rarr; predictivo.<br>'
    . '&laquo;...el dise&ntilde;o de la interfaz gr&aacute;fica a&uacute;n no existe&raquo; &rarr; si a&uacute;n no hay nada, adaptativo.<br>'
    . '&laquo;...retroalimentar el dise&ntilde;o una vez est&eacute; listo el primer incremento&raquo; &rarr; incremental.<br>'
    . '&laquo;...con base en su retroalimentaci&oacute;n se definir&aacute;n nuevos requerimientos&raquo; &rarr; iterativo.</p>'

    . '<p><b>Por qu&eacute; el corte cae justo en el mes 4, seg&uacute;n el material:</b> en un ciclo de vida <b>predictivo</b> la l&iacute;nea base del alcance es la versi&oacute;n aprobada del enunciado del alcance y <i>solo puede cambiarse mediante un procedimiento formal de control de cambios</i>; validar el alcance ocurre con cada entregable o revisi&oacute;n de fase. Eso encaja exactamente con los meses 1&ndash;4, donde el enunciado dice que NO hay reuniones para definir nuevos requerimientos: el alcance est&aacute; congelado.</p>'
    . '<p>En un ciclo de vida <b>adaptativo o &aacute;gil</b>, en cambio, por cada iteraci&oacute;n se repiten recopilar requisitos, definir el alcance y crear la EDT, el patrocinador y los representantes del cliente est&aacute;n continuamente involucrados dando retroalimentaci&oacute;n sobre los entregables, y se usan <i>backlogs</i> para reflejar las necesidades actuales. Eso es literalmente lo que pide el cliente a partir del mes 5.</p>'
    . '<p>Y ojo con la mentalidad del est&aacute;ndar: las organizaciones esperan que los proyectos entreguen <b>valor</b> m&aacute;s all&aacute; de salidas y artefactos. El argumento de por qu&eacute; partir el proyecto en dos no es &laquo;porque as&iacute; se ve mejor&raquo;, es que cada periodo entrega valor de la forma que el nivel de incertidumbre permite.</p>'
    . '<div class="fuente"><b>Material:</b> &laquo;Procesos requisitos-Alcance-EDT&raquo;, l&aacute;mina <i>Ciclo de vida de Proyecto PREDICTIVO vs ADAPTATIVO o &Aacute;GIL</i>; &laquo;Mentalidad - Principios - Dominios - Procesos&raquo;, ciclo de vida del proyecto (enfoques predictivo, adaptativo, h&iacute;brido y cadencia).</div>',

    '<ul><li>La definici&oacute;n general del proyecto se maneja con un enfoque h&iacute;brido.</li>'
    . '<li>Meses 1&ndash;4 con enfoque predictivo, correctamente justificado.</li>'
    . '<li>El diagrama refleja lo indicado en los meses 1&ndash;4.</li>'
    . '<li>Meses 5&ndash;9 con enfoque adaptativo / &aacute;gil (iterativo-incremental).</li>'
    . '<li>El diagrama refleja lo indicado en los meses 5&ndash;9.</li></ul>'
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
  <?php
  enunciado('',
    '<div class="minutos">(3,00 puntos)</div>'
    . 'La empresa AutoData Solutions ha definido su misi&oacute;n y visi&oacute;n; sin embargo, requiere apoyo para establecer dos resultados clave asociados al objetivo estrat&eacute;gico de &ldquo;fortalecer la experiencia del cliente y el soporte postventa&rdquo;.<br>'
    . 'Para cada uno de ellos, proponga el t&iacute;tulo de un proyecto que contribuya directamente al logro del resultado planteado.<br>'
    . 'Tenga en cuenta que actualmente la empresa cuenta con 10 clientes activos, con quienes ha desarrollado proyectos relacionados con nuevos productos, actualizaciones y servicios de soporte.');

  respuestaIni('Completa la respuesta &mdash; cada hueco suma en el marcador');
  ?>
  <p class="sub">La f&oacute;rmula de un resultado clave</p>
  <p>Verbo en <?php hueco(12, 12); ?> + <?php hueco(13, 12); ?> + ahora /
     <?php hueco(14, 9); ?>, y siempre con un <?php hueco(15, 9); ?> para alcanzarlo.</p>
  <p>El objetivo dice a d&oacute;nde voy y el resultado clave dice c&oacute;mo s&eacute; que
     llegu&eacute;; la <?php hueco(16, 12); ?>, que es el proyecto, dice c&oacute;mo llego.</p>
  <p>Un KR nunca empieza por <?php hueco(17, 10); ?>: eso es una tarea, no un resultado.
     Y debe medir el <?php hueco(18, 10); ?> en el negocio a mediano plazo, no la duraci&oacute;n
     de la tarea operativa.</p>

  <p class="sub">Los dos resultados clave del objetivo &laquo;fortalecer la experiencia del cliente y el soporte postventa&raquo;</p>
  <p><b>KR 1:</b> aumentar la <?php hueco(19, 14); ?> postventa de los 10 clientes activos
     del 70% al 90% en los pr&oacute;ximos 6 meses.<br>
     <i>Proyecto:</i> programa de mensajer&iacute;a personalizada postventa.</p>
  <p><b>KR 2:</b> reducir las <?php hueco(20, 11); ?> de soporte de 25 a 20 al mes
     al cierre del pr&oacute;ximo <?php hueco(21, 11); ?>.<br>
     <i>Proyecto:</i> chat din&aacute;mico con atenci&oacute;n prioritaria.</p>
  <?php
  respuestaFin();

  escribir('a11', [
      ['t'      => 'Resultado clave #1',
       'ayuda'  => 'Verbo en infinitivo + indicador + ahora/meta + plazo.',
       'filas'  => 3,
       'modelo' => 'Aumentar la satisfacción postventa (CSAT) de los 10 clientes activos del 70% al 90% en los próximos 6 meses.'],

      ['t'      => 'Proyecto que apunta al resultado clave #1',
       'ayuda'  => 'Solo el t&iacute;tulo, m&aacute;s una l&iacute;nea de qu&eacute; hace.',
       'filas'  => 3,
       'modelo' => "Programa de mensajería personalizada postventa.\nSegmenta a los 10 clientes por tipo de proyecto contratado y les envía seguimiento personalizado después de cada entrega, actualización o ticket de soporte."],

      ['t'      => 'Resultado clave #2',
       'ayuda'  => 'Misma f&oacute;rmula. Que no mida lo mismo que el #1.',
       'filas'  => 3,
       'modelo' => 'Reducir las quejas de soporte de 25 a 20 al mes (-20%) al cierre del próximo trimestre.'],

      ['t'      => 'Proyecto que apunta al resultado clave #2',
       'ayuda'  => 'Solo el t&iacute;tulo, m&aacute;s una l&iacute;nea de qu&eacute; hace.',
       'filas'  => 3,
       'modelo' => "Chat dinámico con atención prioritaria.\nCanal de atención en vivo con cola prioritaria para clientes con compra o entrega reciente, para resolver antes de que el problema se convierta en queja formal."],
  ]);

  apoyo(
    '<p><b>La f&oacute;rmula del curso para un Key Result:</b> <code>Verbo en infinitivo + Indicador + Ahora / Meta</code>, con un plazo. El objetivo dice <i>a d&oacute;nde voy</i>; el resultado clave dice <i>c&oacute;mo s&eacute; que lo alcanc&eacute;</i>; la iniciativa (el proyecto) dice <i>c&oacute;mo llego</i>. Por eso un KR nunca empieza por &laquo;medir&raquo;, &laquo;hacer&raquo; o &laquo;activar&raquo;: eso es una <b>iniciativa</b>, no un resultado.</p>'
    . '<p>La trampa cl&aacute;sica del material: <i>&laquo;Llamar a 10 clientes&raquo;</i> no es un KR. La pregunta que lo desarma es <b>&iquest;qu&eacute; aumenta o disminuye con llamar a 10 clientes?</b> Lo que aumenta &mdash; por ejemplo &laquo;incrementar las ventas en un 50% en el primer semestre&raquo; &mdash; <i>ese</i> es el KR; llamar a los clientes es la tarea.</p>'
    . '<p>Y el KR debe medir <b>impacto de negocio a mediano plazo</b>, no la duraci&oacute;n de la tarea operativa. &laquo;Activar el chat durante 2 d&iacute;as&raquo; es duraci&oacute;n de la tarea; el periodo del OKR es el plazo que me doy para alcanzar la meta (un trimestre, seis meses).</p>'
    . '<p>Fij&aacute;te en que los dos KR de arriba tienen las tres piezas: verbo en infinitivo (aumentar, reducir), indicador con punto de partida y meta (70%&rarr;90%, 25&rarr;20 quejas) y plazo (6 meses, un trimestre). Es la misma forma de los KR que t&uacute; mismo escribiste en tu planeaci&oacute;n personal: <i>&laquo;incrementar los cuestionarios de mi aplicaci&oacute;n b&iacute;blica y pasar de 6 a 12 por idioma antes de diciembre de 2026&raquo;</i>, con el proyecto <i>Bible Quiz Expansion</i> asociado.</p>'
    . '<div class="fuente"><b>Material:</b> &laquo;Def Proyecto - OKRs&raquo; &mdash; estructura de los OKR, <i>Caracter&iacute;sticas clave de los Key Results: verbo infinitivo &ndash; indicador &ndash; ahora/meta</i>, iniciativas como proyectos derivados de los OKR, y el ejemplo &laquo;Alcanzar un record de ventas&raquo;. Tambi&eacute;n tu propio <i>Persona.pdf</i>.</div>'
    . '<p class="nota"><b>Retroalimentaci&oacute;n del profesor en este intento (1,80/3,00):</b><br>'
    . '&middot; <b>Temporalizaci&oacute;n y cuantificaci&oacute;n:</b> el Resultado 2 es correcto: tiene un porcentaje (20%) y una acci&oacute;n definida, aunque no se especifica en cu&aacute;nto tiempo se va a conseguir ese 20%. El Resultado 1 es confuso: aunque menciona un 65%, no queda claro qu&eacute; se est&aacute; midiendo (&iquest;satisfacci&oacute;n?, &iquest;velocidad?, &iquest;recompras?). Adem&aacute;s confunde el periodo de evaluaci&oacute;n del OKR (cu&aacute;nto tiempo tengo para lograr la meta, ej. 3 meses) con la duraci&oacute;n de la tarea operativa (&laquo;durante 2 d&iacute;as&raquo;). Un resultado clave debe medir el impacto a mediano plazo en el negocio.<br>'
    . '&middot; <b>Relaci&oacute;n con el objetivo estrat&eacute;gico:</b> buena. Tanto la mensajer&iacute;a personalizada como el chat din&aacute;mico con prioridad son estrategias v&aacute;lidas para fortalecer la experiencia del cliente y mejorar el soporte postventa.<br>'
    . '&middot; <b>Proyectos que apuntan al logro:</b> les falta detalle o explicaci&oacute;n de lo que se pretende realizar con esos dos proyectos.</p>',

    '<ul><li>Los 2 resultados clave est&aacute;n temporalizados y cuantificados.</li>'
    . '<li>Los 2 resultados clave tienen relaci&oacute;n expl&iacute;cita y de f&aacute;cil entendimiento con el objetivo estrat&eacute;gico.</li>'
    . '<li>Los 2 proyectos apuntan al logro de los resultados clave.</li>'
    . '<li>1 punto por cada criterio.</li></ul>'
  );
  enviar('Guardar lo escrito');
  ?>
</div>

<div class="card">
  <h2>Pregunta 12</h2>
  <?php mc('p12'); enviar(); ?>
</div>

<div class="card">
  <h2>Pregunta 13</h2>
  <?php
  enunciado('',
    '<div class="minutos">(10 minutos · 4,00 puntos)</div>'
    . 'Antes de decidir emprender un proyecto es importante estudiar diferentes caracter&iacute;sticas en su contexto. Si el proyecto debe realizarse en equipos, las caracter&iacute;sticas aumentan. Entre dichas caracter&iacute;sticas est&aacute;n los valores que profesamos (&eacute;tica y moral), an&aacute;lisis DOFA, prop&oacute;sito en la vida (misi&oacute;n y visi&oacute;n), objetivos estrat&eacute;gicos personales u organizacionales y resultados clave.<br>'
    . 'Escriba un p&aacute;rrafo donde explique la relaci&oacute;n entre estas caracter&iacute;sticas y la decisi&oacute;n de emprender un proyecto. Sea expl&iacute;cito en las relaciones entre las caracter&iacute;sticas.');

  respuestaIni('Las cuatro relaciones que valen 1 punto cada una');
  ?>
  <p>  <?php hueco(22, 44); ?> de la organizaci&oacute;n.</p>
  <p>Los objetivos estrat&eacute;gicos son el <?php hueco(23, 10); ?> declarado para alcanzar
     ese prop&oacute;sito.</p>
  <p>Los resultados clave son la medida de <?php hueco(24, 9); ?> de los objetivos
     estrat&eacute;gicos: los <?php hueco(25, 13); ?> y los <?php hueco(26, 14); ?>.</p>
  <p>Cada proyecto es la <?php hueco(27, 12); ?> con la que se alcanza un resultado clave.</p>
  <p>El an&aacute;lisis DOFA presenta los <?php hueco(28, 14); ?> y las
     <?php hueco(29, 14); ?> para lograr exitosamente lo planeado.</p>
  <p>Los valores (&eacute;tica y moral) son la caracter&iacute;stica con la que se eval&uacute;a
     la <?php hueco(30, 14); ?> de los <?php hueco(31, 10); ?> de proyecto.</p>
  <?php
  respuestaFin();

  escribir('a13', [
      ['t'      => 'Relación 1 — Propósito (misión y visión) con los objetivos estratégicos',
       'ayuda'  => 'Vale 1 punto. Di qu&eacute; papel cumplen los objetivos frente al prop&oacute;sito.',
       'filas'  => 3,
       'modelo' => 'La misión y la visión declaran el propósito: quiénes somos hoy y a dónde queremos llegar. Los objetivos estratégicos son el camino declarado para alcanzar ese propósito, es decir, lo que la organización se compromete a lograr para acercarse a su visión.'],

      ['t'      => 'Relación 2 — Objetivos estratégicos con los resultados clave',
       'ayuda'  => 'Vale 1 punto. &iquest;Para qu&eacute; sirven los Key Results?',
       'filas'  => 3,
       'modelo' => 'Los resultados clave son la medida de logro de los objetivos estratégicos: los cuantifican y los temporalizan, de modo que se puede saber si el objetivo se está cumpliendo o no. Sin resultados clave el objetivo queda como una intención que nadie puede evaluar.'],

      ['t'      => 'Relación 3 — Análisis DOFA con los objetivos, resultados y proyectos',
       'ayuda'  => 'Vale 1 punto. La palabra que buscan es habilitadores y restricciones.',
       'filas'  => 3,
       'modelo' => 'El análisis DOFA presenta los habilitadores (fortalezas y oportunidades) y las restricciones (debilidades y amenazas) para lograr exitosamente lo planeado. Por eso condiciona qué objetivos son realistas, qué resultados clave se pueden comprometer y qué proyecto conviene emprender.'],

      ['t'      => 'Relación 4 — Los valores (ética y moral) y el equipo',
       'ayuda'  => 'Vale 1 punto. No basta con decir que los valores &laquo;son importantes&raquo;.',
       'filas'  => 3,
       'modelo' => 'Los valores son la característica con la que se evalúa la conformación de los equipos de proyecto: con quién se puede trabajar y bajo qué reglas. En clase el equipo se arma buscando pares que coincidan en misión, visión, objetivos estratégicos y valores, con coherencia entre las fortalezas de cada uno.'],

      ['t'      => 'El párrafo final: une las cuatro relaciones',
       'ayuda'  => 'Esto es lo que realmente se entrega. Debe leerse como un texto, no como una lista.',
       'filas'  => 7,
       'modelo' => 'Antes de emprender un proyecto conviene revisar toda la cadena de la planeación estratégica. La misión y la visión declaran el propósito, y los objetivos estratégicos son el camino declarado para alcanzarlo; los resultados clave miden y temporalizan el logro de esos objetivos, y cada proyecto es la iniciativa con la que se llega a un resultado clave concreto. Sobre esa cadena actúa el análisis DOFA, que muestra los habilitadores y las restricciones para lograr lo planeado y, por lo tanto, permite decidir si el proyecto es viable o no. Y cuando el proyecto se ejecuta en equipo aparece una característica más: los valores, la ética y la moral que profesamos, que son el criterio para evaluar la conformación del equipo y con quién se puede trabajar. Se decide emprender un proyecto cuando aporta a un resultado clave que mide un objetivo estratégico derivado del propósito, el DOFA muestra condiciones favorables para lograrlo y el equipo comparte los valores necesarios para ejecutarlo.'],
  ]);

  apoyo(
    '<p><b>La cadena completa, tal como se ve en el curso:</b> <code>Misi&oacute;n y Visi&oacute;n &rarr; Objetivos Estrat&eacute;gicos &rarr; Resultados Clave &rarr; Proyectos (iniciativas)</code>, con el <b>DOFA</b> alimentando cada eslab&oacute;n y los <b>valores</b> decidiendo con qui&eacute;n se ejecuta. Es exactamente la asignaci&oacute;n de la semana 1: escribir misi&oacute;n y visi&oacute;n, documentar el DOFA, derivar dos objetivos, para cada uno al menos dos resultados clave, y para cada resultado clave proponer el t&iacute;tulo de un proyecto.</p>'
    . '<p><b>Qu&eacute; pasa si falta cada pieza</b> (el material lo enumera y sirve para argumentar el p&aacute;rrafo): sin objetivos claros hay falta de direcci&oacute;n, esfuerzos dispersos, baja productividad, desmotivaci&oacute;n y toma de decisiones ineficaz. Y los objetivos fallan sobre todo por ser ambiguos, por <b>no estar alineados con la misi&oacute;n, la visi&oacute;n y la estrategia</b>, por ser poco realistas y por falta de recursos &mdash; que es justo lo que el DOFA deber&iacute;a haber anticipado.</p>'
    . '<p><b>Los valores y el equipo:</b> en el material la selecci&oacute;n de equipo se hace buscando <i>&laquo;pares en relaci&oacute;n con planeaci&oacute;n estrat&eacute;gica: misi&oacute;n, visi&oacute;n, objetivos estrat&eacute;gicos y valores&raquo;</i>, con alineaci&oacute;n a la planeaci&oacute;n estrat&eacute;gica personal y coherencia con las fortalezas de cada uno (modelo Tuckman). Por eso los valores no son decoraci&oacute;n: son el criterio con el que se conforma el equipo, y por eso el enunciado dice que &laquo;si el proyecto debe realizarse en equipos, las caracter&iacute;sticas aumentan&raquo;.</p>'
    . '<p><b>Y el cierre del argumento:</b> todo esto se formaliza en el <b>caso de negocio</b>, cuyo &iacute;ndice arranca con misi&oacute;n, visi&oacute;n, valores y objetivos estrat&eacute;gicos con los que se alinea el problema, antes de hablar de alcance, costos y an&aacute;lisis financiero. Decidir emprender un proyecto es, literalmente, poder llenar ese documento con coherencia.</p>'
    . '<div class="fuente"><b>Material:</b> &laquo;Def Proyecto - OKRs&raquo; (qu&eacute; pasa sin objetivos claros, por qu&eacute; fallan, jerarqu&iacute;a de OKR, asignaci&oacute;n de misi&oacute;n/visi&oacute;n/DOFA); &laquo;Planeaci&oacute;n estrat&eacute;gica - Caso de negocio - Flujo de caja&raquo; (tabla de contenido del caso de negocio, selecci&oacute;n de equipos, modelo Tuckman).</div>'
    . '<p class="nota"><b>Retroalimentaci&oacute;n del profesor en este intento (1,00/4,00):</b> el p&aacute;rrafo habla de &laquo;definir&raquo; y del &laquo;orden&raquo;, pero no menciona la misi&oacute;n, la visi&oacute;n ni los objetivos estrat&eacute;gicos; no menciona los resultados clave; solo dice de forma general que ayudan a saber &laquo;con qu&eacute; nos estamos enfrentando&raquo; sin aclarar que el DOFA presenta habilitadores y restricciones; y menciona que las caracter&iacute;sticas importan &laquo;en grupos&raquo; sin describir los valores como la caracter&iacute;stica para evaluar la conformaci&oacute;n de los equipos.</p>',

    '<ul><li>Relaciona el prop&oacute;sito (misi&oacute;n y visi&oacute;n) con los objetivos estrat&eacute;gicos, indicando que los &uacute;ltimos son el camino declarado para alcanzar el prop&oacute;sito.</li>'
    . '<li>Relaciona los objetivos estrat&eacute;gicos con los resultados clave (Key Results) indicando que los &uacute;ltimos son una medida de logro de los primeros.</li>'
    . '<li>Relaciona el an&aacute;lisis DOFA con los objetivos, resultados y/o proyectos, aclarando que dicho an&aacute;lisis presenta habilitadores y/o restricciones para lograr exitosamente lo planeado.</li>'
    . '<li>Describe los valores como caracter&iacute;sticas para evaluar la conformaci&oacute;n de equipos de proyectos.</li>'
    . '<li>1 punto por cada buena relaci&oacute;n documentada.</li></ul>'
  );
  ?>
</div>

<?php
pie('../Grupo001/index.php', '');
