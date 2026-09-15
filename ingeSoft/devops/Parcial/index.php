<?php
/* ==========================================================================
   IngeSoft5 / DevOps / Parcial — bloque 01: preguntas 1 a 9
   Fuente: parcial-devops-simulador.html
           P1 y P4 con la redaccion afinada por el estudiante.
   ========================================================================== */

$CSS  = '../../../css/bootstrap.min.css';
$MENU = '../Menu.php';
require_once __DIR__ . '/../motor.php';

$SOLUCIONES = [
    /* --- P1: no new silos --- */
    1  => ['dev', 'desarrollo'],
    2  => ['ops', 'operaciones'],
    3  => ['barrera'],
    4  => ['separado'],
    5  => ['intermediario'],
    6  => ['traslada', 'trasladar'],
    7  => ['resolverlo', 'resolver'],
    8  => ['unificar'],
    9  => ['herramientas'],
    10 => ['responsabilidades'],
    11 => ['mismo equipo', 'un mismo equipo'],
    12 => ['frontera'],
    13 => ['nombre'],
    14 => ['ingeniero de devops', 'ingeniero devops', 'devops engineer'],
    15 => ['colaboracion'],
    16 => ['tercer silo', 'tercer'],
    17 => ['disolver'],

    /* --- P3: customer-centric + end in mind --- */
    18 => ['valor'],
    19 => ['resultado final', 'resultado'],
    20 => ['objetivo'],
    21 => ['necesidades reales', 'necesidades'],
    22 => ['supuestos'],

    /* --- P4 · practica 2: Dev responsable de incidentes --- */
    23 => ['hacer que desarrollo sea responsable', 'hacer que dev sea responsable',
           'desarrollo sea responsable'],
    24 => ['incidentes relevantes', 'incidentes'],
    25 => ['entrega codigo', 'entrega el codigo'],
    26 => ['mantiene sistema', 'mantiene el sistema'],
    27 => ['desarrolla'],
    28 => ['operar'],
    29 => ['problemas'],
    30 => ['tiempo'],
    31 => ['detectar'],
    32 => ['error'],
    33 => ['solucionarlo', 'solucionar'],

    /* --- P4 · practica 3: proceso de despliegue comun --- */
    34 => ['aplicar un proceso', 'aplicar proceso'],
    35 => ['despliegue comun', 'despliegue'],
    36 => ['todos deben seguir el mismo proceso'],
    37 => ['desarrollo'],
    38 => ['operaciones'],
    39 => ['equipos relacionados', 'equipos'],
    40 => ['errores manuales', 'errores'],
    41 => ['configuraciones incorrectas', 'configuraciones'],
    42 => ['facilidad'],
    43 => ['rastrear cambios', 'rastrear'],

    /* --- P5: que es la nube (identico al bloque de Sesion 11) --- */
    44 => ['nist', 'nist sp 800-145'],
    45 => ['800-145'],
    46 => ['Modelo para habilitar acceso ubicuo'],
    47 => ['demanda', 'bajo demanda'],
    48 => ['pool compartido de recursos computacionales', 'pool', 'compartido'],
    49 => ['autoservicio bajo demanda', 'autoservicio'],
    50 => ['humana'],
    51 => ['acceso amplio a la red', 'acceso amplio', 'broad network access'],
    52 => ['estandar', 'estandares'],
    53 => ['la nube transforma servidores fisicos en servicios logicos programables'],
    54 => ['costos de capital', 'capital'],
    55 => ['escalar recursos rapidamente', 'escalar recursos', 'escalar'],
    56 => ['el tiempo de salida al mercado', 'tiempo de salida al mercado',
           'salida al mercado'],
    57 => ['microservicios y despliegue continuo', 'microservicios'],

    /* --- P6: port already allocated --- */
    58 => ['host'],
    59 => ['enlazar', 'bind'],
    60 => ['detener'],
    61 => 'docker run -p 8080:80 nginx',

    /* --- P7: coordinacion directa e indirecta (definiciones del libro) --- */
    62 => ['Los individuos que se coordinan se conocen entre si', 'conocen'],
    63 => ['miembros del equipo', 'miembros', 'equipo'],
    64 => ['El mecanismo de coordinacion esta dirigido a una audiencia conocida solo por'],
    65 => ['caracterizacion'],
    66 => ['administradores de sistemas', 'administradores de sistema', 'administradores'],
    67 => ['identidad'],
    68 => ['rol', 'su rol'],
    69 => ['logs', 'mensajes de log', 'log'],
    70 => ['documentacion'],
    71 => ['operador'],

    /* --- P8: match de acronimos --- */
    72 => ['paas'],
    73 => ['on premises', 'on-premises', 'on premise'],
    74 => ['saas'],
    75 => ['iaas'],

    76 => ['Modelo tradicional'],

    77 => ['The user can deploy applications'],
    78 => ['The user purchases and configures the physical'],
    79 => ['The user has the ability to use applications'],
    80 => ['The user configures his own network'],

    ];

$TEXTO = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,
          18,19,20,21,22,
          23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,
          44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,
          62,63,64,65,66,67,68,69,70,71,72,73,74,75];

$MULTIPLE = [
    'p1' => [
        'texto'    => '<b>P1 &mdash; control.</b> Una empresa quiere «hacer DevOps» y contrata a un <b>ingeniero de DevOps</b> que recibe las peticiones de Dev y las coordina con Ops. &iquest;Que paso ahi?',
        'opciones' => [
            'a' => 'Adopto DevOps correctamente: ya hay alguien responsable de la colaboracion',
            'b' => '<b>Creo un tercer silo</b> entre Dev y Ops en lugar de disolver la barrera: el intermediario traslada el problema en vez de resolverlo',
            'c' => 'No cambio nada, es neutral',
            'd' => 'Elimino la necesidad de que Dev conozca operaciones'
        ],
        'correcta' => 'b',
        'porque'   => 'Este es <b>el</b> ejemplo que hay que citar en el parcial, porque es el error mas comun del mundo real. La prueba de que no funciona: sigue habiendo un <b>traspaso</b> entre equipos, y el traspaso es justo lo que DevOps busca eliminar. Un rol de DevOps tiene sentido como <b>habilitador</b> (construye plataforma y herramientas para que Dev opere), no como <b>intermediario</b> por el que pasa todo.'
    ],
    'p2' => [
        'texto'    => '<b>P2 (1 pt).</b> What is the purpose and/or function of the reserved word <code>ENV</code> in a Dockerfile?',
        'opciones' => [
            'a' => 'To expose a network port',
            'b' => 'To specify a network',
            'c' => 'To mount a volume',
            'd' => 'To define environment variables'
        ],
        'correcta' => 'd',
        'porque'   => '<code>ENV</code> define <b>variables de entorno</b> que quedan disponibles durante el build <b>y</b> en el contenedor en ejecucion. Ojo con las otras tres, que son los distractores clasicos: exponer un puerto es <code>EXPOSE</code>, montar un volumen es <code>VOLUME</code>, y la red se define al ejecutar (<code>--network</code>) o en el Compose. <b>Recuerda tambien el antipatron:</b> nunca pongas contraseñas en un <code>ENV</code>, porque quedan grabadas en una capa de la imagen y las revela <code>docker history</code>.'
    ],
    'p4a' => [
        'texto'    => '<b>P4 &mdash; control.</b> &iquest;Cual de las dos practicas que estudiaste busca <b>acortar el tiempo entre la observacion de un error y su reparacion</b>?',
        'opciones' => [
            'a' => '<b>Make Dev more responsible for relevant incident handling</b>',
            'b' => 'Enforce the deployment process used by all, including Dev and Ops personnel',
            'c' => 'Las dos por igual',
            'd' => 'Ninguna de las dos'
        ],
        'correcta' => 'a',
        'porque'   => 'Es la razon de ser de esa practica: si quien escribio el codigo es quien atiende el incidente, no hay traspaso Dev &rarr; Ops de por medio. <b>Cuidado con el distractor b:</b> la del proceso de despliegue <i>tambien</i> menciona el tiempo de diagnostico y reparacion, pero por otra via — poder <b>rastrear</b> que hay dentro de cada artefacto desplegado. Si en el parcial te preguntan cual lo busca <b>directamente</b>, es la de los incidentes.'
    ],
    'p4b' => [
        'texto'    => '<b>P4 &mdash; control.</b> &iquest;Que errores evita concretamente el <b>proceso de despliegue comun</b>?',
        'opciones' => [
            'a' => 'Los errores de logica en el codigo de la aplicacion',
            'b' => 'Los causados por despliegues <b>ad hoc</b> y la <b>mala configuracion</b> que resulta de ellos',
            'c' => 'Los fallos de hardware del servidor',
            'd' => 'Los errores de los usuarios finales'
        ],
        'correcta' => 'b',
        'porque'   => 'La practica apunta a la <b>calidad del despliegue</b>, no a la del codigo: cada quien desplegando a su manera produce entornos distintos y configuraciones incorrectas. El segundo beneficio, que se olvida, es la <b>trazabilidad</b>: con un proceso unico puedes reconstruir la historia de un artefacto y saber que componentes iban dentro.'
    ],
    'p7' => [
        'texto'    => '<b>P7 &mdash; control.</b> Escribes un mensaje de log que leera <b>quien este de turno</b> cuando el servicio falle, tal vez dentro de dos años. &iquest;Es coordinacion directa o indirecta?',
        'opciones' => [
            'a' => 'Directa, porque el mensaje es explicito y esta escrito por una persona concreta',
            'b' => '<b>Indirecta</b>: no sabes quien lo va a leer, solo <b>como se caracteriza</b> esa audiencia (&laquo;el operador de turno&raquo;)',
            'c' => 'Ninguna de las dos, un log no es coordinacion',
            'd' => 'Depende de si el log se escribe en ingles o en español'
        ],
        'correcta' => 'b',
        'porque'   => 'Es el mejor ejemplo para esta pregunta porque conecta con la practica del referente de <b>tratar a Ops como ciudadanos de primera clase</b>: los mensajes de log deben ser entendibles y usables por <i>un operador</i> &mdash; no por Juan. Y fijate en lo que <b>no</b> define la diferencia: no es el medio (escrito vs. hablado) ni la distancia; es si conoces la <b>identidad</b> de quien recibe la coordinacion o solo su <b>rol</b>.'
    ],
    'p9' => [
        'texto'    => '<b>P9 (1 pt).</b> The <b>rapid elasticity</b> of the cloud is better supported by:',
        'opciones' => [
            'a' => 'A broad network access allows access from any browser',
            'b' => 'A measured service guarantees only pay for what you need.',
            'c' => 'None of the others',
            'd' => 'The capabilities can be appropriated in any quantity at any time'
        ],
        'correcta' => 'd',
        'porque'   => 'La <b>elasticidad rapida</b> del NIST es poder aprovisionar y liberar capacidades <b>en cualquier cantidad y en cualquier momento</b>, de forma automatica segun la carga. Las otras opciones son caracteristicas <b>distintas</b> del NIST: «broad network access» es el acceso por la red, y «measured service» es el cobro por consumo — que es <b>consecuencia</b> de la elasticidad, no lo que la sostiene.'
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $TEXTO);
cabecera('Parcial DevOps · 1 — preguntas 1 a 9', 'parcial-devops-simulador.html — respuestas modelo');
?>

<style>
details.modelo{margin:14px 0 4px;background:#eef4ff;border-left:4px solid #2c5aa0;
               border-radius:0 8px 8px 0;padding:10px 14px;font-size:14.5px}
details.modelo summary{cursor:pointer;font-weight:700;color:#2c5aa0;list-style:none}
details.modelo summary::-webkit-details-marker{display:none}
details.modelo summary:before{content:'\25B8 ';font-size:13px}
details.modelo[open] summary:before{content:'\25BE '}
details.modelo p{margin:10px 0 2px;color:#22262b;line-height:1.7}
.pregunta-parcial{font-size:13px;color:#7a8494;font-weight:700;letter-spacing:.5px;
                  text-transform:uppercase;margin:0 0 2px}

/* --- tarjeta de idea, estilo "frase por frase" --- */
.prac{border:1px solid var(--borde);border-radius:10px;padding:16px 18px;margin:16px 0;
      background:#fcfcfd;line-height:2.2}
.prac.no{border-left:4px solid #c0392b;border-radius:0 10px 10px 0;background:#fdfbfb}
.prac.si{border-left:4px solid #1a7f37;border-radius:0 10px 10px 0;background:#fbfdfb}
.prac.ej{border-left:4px solid #b5730a;border-radius:0 10px 10px 0;background:#fffdf8}
.prac .tag{display:inline-block;font-size:11px;font-weight:700;letter-spacing:.6px;
           text-transform:uppercase;border-radius:4px;padding:2px 8px;margin-bottom:8px;
           line-height:1.6}
.prac.no .tag{background:#fdecea;color:#c0392b}
.prac.si .tag{background:#e6f4ea;color:#1a7f37}
.prac.ej .tag{background:#fff4e0;color:#b5730a}
.prac .tit{font-size:16px;font-weight:700;color:#1f2733;display:flex;flex-wrap:wrap;
           align-items:center;gap:7px;line-height:2.1}
.prac .tit .num{color:var(--azul);font-size:18px}
.prac .tit .hueco{font-size:15px;font-weight:600;padding:3px 8px}
.prac .en{margin:6px 0 14px;font-size:12.5px;color:#7a8494;font-style:italic;line-height:1.5}
.prac h5{margin:16px 0 6px;font-size:14px;color:#3c4654;font-weight:700;line-height:1.5}
.prac .fila{font-family:Consolas,Menlo,monospace;font-size:13.5px;color:#5a6472;
            margin:6px 0;display:flex;flex-wrap:wrap;align-items:center;gap:6px;line-height:2}
.prac .fila b{color:#2f3a48;font-family:-apple-system,Segoe UI,Arial,sans-serif}
.prac ul{margin:6px 0 0;line-height:2.2}
.prac ul li{margin:5px 0}
.prac .obj{margin-top:16px;padding-top:12px;border-top:1px dashed var(--borde);
           font-size:14.5px}
</style>

<div class="card">
  <h2>Como se usa</h2>
  <p>Las <b>18 preguntas</b> del simulador, en dos paginas. Las de <b>opcion unica</b> y las de
     <b>emparejar</b> van tal cual salen en el parcial; las <b>abiertas</b> estan convertidas en
     huecos con las <b>palabras clave</b> de la respuesta modelo — rellenalas y despues despliega
     <i>Ver la respuesta modelo completa</i> para comparar como la redactarias tu.</p>
  <div class="nota">No importan mayusculas ni tildes. Pulsa <b>Enter</b> dentro de un hueco
    para verificar. El boton <b>Mostrar solucion</b> de abajo rellena todo de golpe.</div>
</div>


<div class="card">
  <p class="pregunta-parcial">Pregunta 1 &middot; 2 puntos &middot; abierta</p>
  <h2>What does &laquo;no new silos to break down silos&raquo; mean?</h2>

  <div class="prac no">
    <span class="tag">Lo que NO se debe hacer</span>
    <p>Al eliminar la separacion entre <?php hueco(1, 10); ?> y
       <?php hueco(2, 10); ?> <b>no se debe crear una
       <?php hueco(3, 12); ?> nueva en su lugar</b> &mdash; como un equipo o rol de
       &laquo;DevOps&raquo; <?php hueco(4, 12); ?> que actue de
       <?php hueco(5, 16); ?> &mdash;, porque eso solo
       <?php hueco(6, 12); ?> el problema en vez de
       <?php hueco(7, 14); ?>.</p>
  </div>

  <div class="prac si">
    <span class="tag">Lo que SI</span>
    <p>La idea es <?php hueco(8, 12); ?> flujos de trabajo,
       <?php hueco(9, 16); ?> y <?php hueco(10, 20); ?>
       dentro de un <?php hueco(11, 16); ?>, no reemplazar una
       <?php hueco(12, 14); ?> por otra con distinto
       <?php hueco(13, 12); ?>.</p>
  </div>

  <div class="prac ej">
    <span class="tag">El error clasico (el ejemplo que hay que dar)</span>
    <p>Contratar a un <?php hueco(14, 24); ?> pensando que eso ya resuelve la
       <?php hueco(15, 14); ?>: se crea un <?php hueco(16, 14); ?>
       entre Dev y Ops en lugar de <?php hueco(17, 12); ?> la barrera entre ambos.</p>
  </div>

  <?php mc('p1'); ?>

  <details class="modelo">
    <summary>Ver la respuesta modelo completa</summary>
    <p>&laquo;No new silos to break down silos&raquo; significa que al eliminar la separacion
       entre Dev y Ops <b>no se debe crear una barrera nueva en su lugar</b> &mdash;como un equipo
       o rol de &laquo;DevOps&raquo; separado que actue de intermediario&mdash;, porque eso solo
       traslada el problema en vez de resolverlo.</p>
    <p>La idea es <b>unificar flujos de trabajo, herramientas y responsabilidades dentro de un
       mismo equipo</b>, no reemplazar una frontera por otra con distinto nombre.</p>
    <p>Contratar a un &laquo;ingeniero de DevOps&raquo; pensando que eso ya resuelve la
       colaboracion es justamente el error clasico: se crea un <b>tercer silo</b> entre Dev y Ops
       en lugar de disolver la barrera entre ambos.</p>
  </details>

  <?php enviar(); ?>
</div>


<div class="card">
  <p class="pregunta-parcial">Pregunta 2 &middot; 1 punto &middot; opcion unica</p>
  <?php mc('p2'); ?>
  <?php enviar(); ?>
</div>


<div class="card">
  <p class="pregunta-parcial">Pregunta 3 &middot; 2 puntos &middot; abierta</p>
  <h2>How can you relate &laquo;customer-centric action&raquo; with &laquo;create with the end in mind&raquo;?</h2>

  <ul>
    <li>Ambos principios parten de definir el <?php hueco(18, 10); ?> desde la
        perspectiva del <?php hueco(19, 16); ?> que necesita el cliente.</li>
    <li><b>Create with the end in mind</b> exige tener claro el
        <?php hueco(20, 12); ?> final <b>antes</b> de construir.</li>
    <li><b>Customer-centric action</b> exige que ese objetivo final este definido por las
        <?php hueco(21, 18); ?> del usuario, no por
        <?php hueco(22, 12); ?> internos del equipo.</li>
  </ul>

  <details class="modelo">
    <summary>Ver la respuesta modelo completa</summary>
    <p>Ambos principios parten de definir el valor desde la perspectiva del resultado final que
       necesita el cliente. &laquo;Create with the end in mind&raquo; exige tener claro el
       objetivo final antes de construir; &laquo;customer-centric action&raquo; exige que ese
       objetivo final este definido por las necesidades reales del usuario, no por supuestos
       internos del equipo. Juntos aseguran que cada decision tecnica se tome pensando en el
       valor que el cliente recibira al final del proceso.</p>
  </details>

  <?php enviar(); ?>
</div>


<div class="card">
  <p class="pregunta-parcial">Pregunta 4 &middot; 2 puntos &middot; abierta</p>
  <h2>Explain the relevance of <b>two DevOps practices</b> from one of the referents proposed.</h2>

  <div class="nota">
    El referente (<i>Bass, Weber &amp; Zhu &mdash; DevOps: A Software Architect's Perspective</i>)
    lista cinco categorias, pero <b>solo te piden dos</b>. Estas son las dos mas faciles de
    defender y de recordar. Citalas <b>por su nombre</b>: eso es lo que demuestra que leiste
    el referente.
  </div>

  <div class="prac">
    <div class="tit">
      <span class="num">2.</span>
      <?php hueco(23, 36); ?> de <?php hueco(24, 22); ?>
    </div>
    <p class="en">Make Dev more responsible for relevant incident handling</p>

    <h5><?php hueco(76, 18); ?> </h5>
    <div class="fila"><b>Dev</b> &rarr; <?php hueco(25, 18); ?></div>
    <div class="fila"><b>Ops</b> &rarr; <?php hueco(26, 18); ?></div>

    <h5>Modelo DevOps</h5>
    <div class="fila"><b>Dev</b> &rarr; <?php hueco(27, 14); ?>
      + ayuda a <?php hueco(28, 12); ?>
      + responde <?php hueco(29, 14); ?></div>

    <div class="obj"><b>Objetivo:</b> reducir el <?php hueco(30, 12); ?> entre
      <?php hueco(31, 12); ?> un <?php hueco(32, 12); ?> y
      <?php hueco(33, 14); ?>.</div>
  </div>

  <div class="prac">
    <div class="tit">
      <span class="num">3.</span>
      <?php hueco(34, 22); ?> de <?php hueco(35, 20); ?>
    </div>
    <p class="en">Enforce the deployment process used by all, including Dev and Ops personnel</p>

    <p><?php hueco(36, 37); ?>  :</p>
    <ul>
      <li><?php hueco(37, 16); ?>.</li>
      <li><?php hueco(38, 16); ?>.</li>
      <li><?php hueco(39, 22); ?>.</li>
    </ul>

    <h5>Beneficios</h5>
    <ul>
      <li>Menos <?php hueco(40, 20); ?>.</li>
      <li>Menos <?php hueco(41, 26); ?>.</li>
      <li>Mayor <?php hueco(42, 14); ?> para <?php hueco(43, 20); ?>.</li>
    </ul>
  </div>

  <?php mc('p4a'); ?>
  <?php mc('p4b'); ?>

  <details class="modelo">
    <summary>Ver la respuesta modelo completa</summary>
    <p><b>1. Make Dev more responsible for relevant incident handling.</b> En el modelo
       tradicional Dev entrega el codigo y Ops mantiene el sistema: cuando algo falla en
       produccion, quien lo diagnostica no es quien lo escribio. Esta practica hace que
       Desarrollo desarrolle, ayude a operar y responda por los problemas de lo que despliega,
       normalmente teniendo la responsabilidad primaria durante un periodo tras cada nuevo
       despliegue. Su relevancia esta en <b>reducir el tiempo entre detectar un error y
       solucionarlo</b>: se elimina el traspaso entre equipos, quien conoce el cambio diagnostica
       mas rapido, y Dev recibe retroalimentacion directa de como se comporta su codigo en
       produccion, lo que mejora las siguientes entregas.</p>
    <p><b>2. Enforce the deployment process used by all.</b> Todos &mdash; Desarrollo,
       Operaciones y los equipos relacionados &mdash; deben seguir el <b>mismo</b> proceso de
       despliegue, sin excepciones ni atajos. Su relevancia esta en la calidad del despliegue:
       se evitan los errores causados por despliegues <i>ad hoc</i> y las configuraciones
       incorrectas que resultan de que cada quien despliegue a su manera. Ademas, al ser un
       proceso unico y repetible, es facil <b>rastrear la historia de un artefacto</b> y saber
       que componentes iban incluidos en el, lo que acorta el tiempo de diagnosticar y reparar
       cuando algo sale mal.</p>
    <p style="font-size:13.5px;color:#5a6472"><b>Las otras tres del referente</b>, por si te las
       mencionan: tratar a Ops como ciudadanos de primera clase desde los requisitos, usar
       despliegue continuo, y desarrollar el codigo de infraestructura con las mismas practicas
       que el codigo de aplicacion.</p>
  </details>

  <?php enviar(); ?>
</div>


<div class="card">
  <p class="pregunta-parcial">Pregunta 5 &middot; 2 puntos &middot; abierta</p>
  <h2>Explain in your own words what <b>the cloud</b> is and why it's useful for businesses.</h2>

  <h3>Que es la computacion en la nube</h3>
  <p>Segun el estandar formal <?php hueco(44, 10); ?> SP <?php hueco(45, 10); ?>:</p>

  <div class="avisoflujo">
    <b>Definicion esencial.</b>   <?php hueco(46, 36); ?>
    y bajo <?php hueco(47, 10); ?> a un <?php hueco(48, 44); ?>
     .
  </div>

  <ul>
    <li><b><?php hueco(49, 25); ?>:</b> provision autonoma de computo y
        almacenamiento <b>sin interaccion <?php hueco(50, 10); ?></b> con el
        proveedor.</li>
    <li><b><?php hueco(51, 22); ?>:</b> capacidades disponibles en la red mediante
        mecanismos <?php hueco(52, 12); ?> (APIs REST, HTTPS).</li>
  </ul>

  <p>Paradigma Cloud: 
  <?php hueco(53, 70); ?>  
   , automatizables mediante codigo y pipelines de CI/CD.</p>

  <h3>Por que le sirve a una empresa</h3>
  <ul>
    <li>Reduce <?php hueco(54, 22); ?> &mdash; se paga por uso.</li>
    <li>Permite <?php hueco(55, 32); ?> segun la demanda.</li>
    <li>Acelera <?php hueco(56, 34); ?>.</li>
    <li>Facilita practicas modernas como <?php hueco(57, 38); ?>.</li>
  </ul>

  <details class="modelo">
    <summary>Ver la respuesta modelo completa</summary>
    <p>La nube es un modelo de entrega de recursos de computo (servidores, almacenamiento, redes,
       plataformas y software) bajo demanda a traves de internet, sin que el usuario tenga que
       poseer o administrar la infraestructura fisica. Es util para las empresas porque reduce
       costos de capital (se paga por uso), permite escalar recursos rapidamente segun la demanda,
       acelera el tiempo de salida al mercado y facilita la adopcion de practicas modernas como
       microservicios y despliegue continuo.</p>
    <p style="font-size:13.5px;color:#5a6472"><b>Si quieres sumar puntos:</b> abre con la
       definicion del NIST SP 800-145 &mdash; &laquo;modelo para habilitar acceso ubicuo y bajo
       demanda a un pool compartido de recursos computacionales&raquo; &mdash; y despues explicala
       con tus palabras. Demuestra que conoces el estandar <b>y</b> que lo entendiste.</p>
  </details>

  <?php enviar(); ?>
</div>


<div class="card">
  <p class="pregunta-parcial">Pregunta 6 &middot; 1 punto &middot; abierta (codigo)</p>
  <h2>&iquest;Cual es la causa de este error?</h2>
  <p>Ejecutas <code>docker run -p 80:80 nginx</code> por <b>segunda vez</b> (el contenedor de la
     primera sigue arriba) y obtienes:</p>
  <pre><code>Error response from daemon: driver failed programming external
connectivity: Bind for 0.0.0.0:80 failed: port is already allocated</code></pre>

  <ul>
    <li>El puerto 80 <b>del <?php hueco(58, 10); ?></b> ya esta siendo usado por el
        primer contenedor, que sigue corriendo.</li>
    <li>Docker no puede <?php hueco(59, 10); ?> el mismo puerto del host a
        <b>dos</b> contenedores distintos al mismo tiempo.</li>
    <li>La solucion es <?php hueco(60, 10); ?> el contenedor anterior, o mapear el
        segundo a un puerto distinto del host.</li>
  </ul>

  <h3>Escribe el comando de la solucion</h3>
  <?php linea(61, 'Lanzar nginx mapeando el puerto <b>8080</b> del host al <b>80</b> del contenedor.', ' '); ?>

  <details class="modelo">
    <summary>Ver la respuesta modelo completa</summary>
    <p>El error ocurre porque el puerto 80 del host ya esta siendo usado por el primer contenedor
       que sigue corriendo. Docker no puede enlazar (bind) el mismo puerto del host a dos
       contenedores distintos al mismo tiempo. La solucion es detener el contenedor anterior o
       mapear el segundo a un puerto distinto del host, por ejemplo <code>-p 8080:80</code>.</p>
  </details>

  <?php enviar(); ?>
</div>


<div class="card">
  <p class="pregunta-parcial">Pregunta 7 &middot; 2 puntos &middot; abierta</p>
  <h2>What is the difference between <b>direct</b> and <b>indirect</b> coordination?</h2>

  <p>Las definiciones <b>textuales</b> del libro:</p>

  <div class="prac si">
    <span class="tag">Direct</span>
    <p>  <b><?php hueco(62, 53); ?>  </b>
       &mdash; por ejemplo, <?php hueco(63, 22); ?>.</p>
  </div>

  <div class="prac ej">
    <span class="tag">Indirect</span>
    <p> 
       <?php hueco(64, 76); ?>   su
       <?php hueco(65, 18); ?>  &mdash; por ejemplo,
       <?php hueco(66, 26); ?>.</p>
  </div>

  <div class="avisoflujo">
    <b>La clave.</b> La diferencia <b>no</b> esta en el medio (hablado o escrito) ni en la
    distancia: esta en si conoces la <?php hueco(67, 14); ?> de quien recibe la
    coordinacion, o solamente su <?php hueco(68, 10); ?>.
  </div>

  <h3>Ejemplos</h3>
  <table class="datos">
    <tr><th>Directa &mdash; se quien esta del otro lado</th>
        <th>Indirecta &mdash; se <i>que tipo</i> de persona esta del otro lado</th></tr>
    <tr>
      <td>Una reunion de planeacion con tu equipo; un code review a un compañero; un mensaje en
          el chat del equipo pidiendo ayuda con un despliegue.</td>
      <td>Los mensajes de <?php hueco(69, 16); ?> que escribes hoy y leera el
          operador de turno; la <?php hueco(70, 16); ?>; un estandar de
          codificacion; el contrato de un API publico.</td>
    </tr>
  </table>

  <?php mc('p7'); ?>

  <details class="modelo">
    <summary>Ver la respuesta modelo completa</summary>
    <p>En la coordinacion <b>directa</b>, los individuos que se coordinan <b>se conocen entre
       si</b> &mdash; por ejemplo, los miembros de un mismo equipo. La comunicacion es explicita
       y dirigida a personas concretas: reuniones, revisiones de codigo, mensajes en el chat del
       equipo.</p>
    <p>En la coordinacion <b>indirecta</b>, el mecanismo de coordinacion esta dirigido a una
       <b>audiencia conocida solo por su caracterizacion</b> &mdash; por ejemplo, los
       administradores de sistemas. No sabes <i>quien</i> recibira la informacion, solo que rol
       cumple: por eso se coordina mediante estandares, documentacion, convenciones de codigo,
       contratos de API o mensajes de log, que deben ser entendibles para cualquiera que ocupe
       ese rol.</p>
    <p style="font-size:13.5px;color:#5a6472"><b>El matiz que vale puntos:</b> lo que distingue
       a una de otra no es el medio ni la distancia, sino si se conoce la <b>identidad</b> de la
       contraparte o unicamente su <b>caracterizacion</b>. Un mensaje de log escrito para
       &laquo;<?php hueco(71, 12); ?>&raquo;, sea quien sea, es coordinacion indirecta
       aunque lo escriba una persona concreta.</p>
  </details>

  <?php enviar(); ?>
</div>


<div class="card">
  <p class="pregunta-parcial">Pregunta 8 &middot; 1 punto &middot; emparejar</p>
  <h2>Match the acronyms with its description</h2>
  <p>Escribe el acronimo que corresponde a cada descripcion:
     <b>PaaS</b>, <b>IaaS</b>, <b>SaaS</b> u <b>On premises</b>.</p>

  <table class="datos">
    <tr><th>Descripcion</th><th>Acronimo</th></tr>
    <tr><td>
    <?php hueco(77, 31); ?>  
      developed or acquired on the provider's cloud
            infrastructure</td>
        <td><?php hueco(72, 14); ?></td></tr>
    <tr><td>
    <?php hueco(78, 45); ?>    
      servers and network, obtaining
            their own infrastructure</td>
        <td><?php hueco(73, 16); ?></td></tr>
    <tr><td>
    <?php hueco(79, 45); ?>  
      offered by the cloud provider</td>
        <td><?php hueco(74, 14); ?></td></tr>
    <tr><td>
    <?php hueco(80, 35); ?>   
     , storage, processes and other resources on
            top of the resources offered by the cloud provider</td>
        <td><?php hueco(75, 14); ?></td></tr>
  </table>

  <div class="nota"><b>Truco para no confundirlas.</b> Ordenalas por <b>que te entregan</b>:
    On premises = nada (compras el fierro) &rarr; IaaS = recursos crudos que tu configuras &rarr;
    PaaS = una plataforma donde <b>despliegas tu app</b> &rarr; SaaS = la aplicacion ya hecha,
    solo la <b>usas</b>. El verbo de cada descripcion te delata: <i>purchase</i>,
    <i>configure</i>, <i>deploy</i>, <i>use</i>.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <p class="pregunta-parcial">Pregunta 9 &middot; 1 punto &middot; opcion unica</p>
  <?php mc('p9'); ?>
  <?php enviar('Verificar todo el cuestionario'); ?>
</div>

<?php
pie('../Menu.php', 'segundo.php');
