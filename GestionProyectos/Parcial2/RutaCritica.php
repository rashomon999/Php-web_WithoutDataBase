<?php
/* ==========================================================================
   Parcial 2 — Ruta critica
   Fuentes: Conceptos de ruta critica.pdf, Ruta critica y Valor ganado.pdf
            (parte de cronogramas), Taller de ruta critica.pdf y la diapositiva
            de ruta critica de la presentacion de MS Project.
   Lo de "como se ve en Project" esta en ProjectPlaneacion.php.
   ========================================================================== */

$MENU = 'index.php';
require_once __DIR__ . '/../motor.php';
require_once __DIR__ . '/red.php';

$MULTIPLE = [
    'hneg' => [
        'texto'    => 'Si la holgura de una ruta sale <b>negativa</b>, eso significa que…',
        'opciones' => [
            'a' => 'las actividades de esa ruta se pueden demorar ese tiempo sin afectar la fecha de terminación',
            'b' => 'hay una carencia de holgura en todo el proyecto: es el tiempo que se tienen que apresurar las actividades de esa ruta para cumplir la fecha requerida',
            'c' => 'esa ruta no es crítica y se puede ignorar',
            'd' => 'hubo un error: la holgura nunca puede ser negativa',
        ],
        'correcta' => 'b',
        'porque'   => 'Positiva = cantidad máxima que se pueden demorar sin poner en peligro la fecha. Negativa = cuánto hay que <b>apresurar</b> esa ruta para alcanzar la fecha de terminación requerida.'
    ],
    'cp_ej' => [
        'texto'    => '¿Cuál es la ruta crítica del ejemplo de clase?',
        'opciones' => [
            'a' => 'Inicio – D – E – G – H – C – Fin',
            'b' => 'Inicio – A – F – G – H – C – Fin',
            'c' => 'Inicio – A – F – B – Fin',
            'd' => 'Inicio – D – E – G – H – C – B – Fin',
        ],
        'correcta' => 'b',
        'porque'   => 'Son las actividades con holgura 0: A, F, G, H y C. 6 + 7 + 5 + 7 + 8 = 33 semanas. El camino D–E llega a G en 12 y por eso D y E tienen 1 semana de holgura.'
    ],
    't1_cp' => [
        'texto'    => 'Ejercicio 1 · ¿Cuál es la ruta crítica?',
        'opciones' => [
            'a' => 'Inicio – C – A – R – Fin',
            'b' => 'Inicio – C – A – T – Fin',
            'c' => 'Inicio – P – U – N – Fin',
            'd' => 'Inicio – B – A – R – Fin',
        ],
        'correcta' => 'a',
        'porque'   => 'C (6) + A (7) + R (3) = 16 semanas, el camino más largo de los siete.'
    ],
    't1_imp' => [
        'texto'    => 'Ejercicio 1 · ¿Cuál es el impacto si la actividad B tarda <b>tres semanas más</b> de lo planeado?',
        'opciones' => [
            'a' => 'Ninguno: B no está en la ruta crítica',
            'b' => 'La ruta crítica cambia a Inicio – B – A – R – Fin y el proyecto se retrasa 1 semana',
            'c' => 'El proyecto se retrasa 3 semanas',
            'd' => 'La ruta crítica sigue siendo C – A – R y el proyecto se retrasa 1 semana',
        ],
        'correcta' => 'b',
        'porque'   => 'B tiene 2 semanas de holgura (llega a A en 4 y A arranca en 6). Con 3 semanas más se come la holgura y sobra 1: B pasa a 7, B – A – R suma 17 y se vuelve la nueva ruta crítica.'
    ],
    't2_cp' => [
        'texto'    => 'Ejercicio 2 · ¿Cuál es la ruta crítica?',
        'opciones' => [
            'a' => 'Inicio – A – B – D – E – Fin',
            'b' => 'Inicio – A – C – E – Fin',
            'c' => 'Inicio – A – C – D – E – Fin',
            'd' => 'Inicio – A – B – C – E – Fin',
        ],
        'correcta' => 'b',
        'porque'   => 'A – C – E = 3 + 15 + 4 = 22 semanas, frente a A – B – D – E = 3 + 3 + 8 + 4 = 18.'
    ],
    't2_imp' => [
        'texto'    => 'Ejercicio 2 · Si la actividad C se termina <b>5 semanas antes</b> de lo estimado, ¿cuál es el impacto?',
        'opciones' => [
            'a' => 'El proyecto termina 5 semanas antes (17 semanas)',
            'b' => 'El proyecto termina solo 4 semanas antes (18 semanas): la ruta crítica pasa a ser A – B – D – E',
            'c' => 'Ninguno, porque C no está en la ruta crítica',
            'd' => 'El proyecto termina 1 semana antes',
        ],
        'correcta' => 'b',
        'porque'   => 'A – C – E baja a 17, pero A – B – D – E sigue en 18. El proyecto no puede durar menos que su camino más largo, así que la ganancia es de 4 semanas, no de 5.'
    ],
];

$EMPAREJAR = [
    'comp' => [
        'texto'    => 'Las dos técnicas de compresión del cronograma: clasifica cada descripción.',
        'opciones' => ['Crashing', 'Fast tracking'],
        'items'    => [
            'Se analiza el compromiso entre costo y cronograma para comprimir con el menor incremento del costo' => 'Crashing',
            'Fases o actividades que normalmente son secuenciales se realizan en paralelo'                         => 'Fast tracking',
            'Aprobar horas extra, recursos adicionales o un pago extra para acelerar actividades de la ruta crítica' => 'Crashing',
            'Construir los cimientos de un edificio antes de terminar todos los planos arquitectónicos'            => 'Fast tracking',
            'Su efecto colateral principal: costo elevado'                                                           => 'Crashing',
            'Su efecto colateral principal: riesgo elevado'                                                          => 'Fast tracking',
        ],
        'porque'   => 'La compresión no siempre es una alternativa viable: puede incrementar el riesgo y/o el costo.'
    ],
];

$SOLUCIONES = [
/* ---- 1. Los cuatro tiempos y los dos recorridos ---- */
 101 => ['inicio temprano', 'early start', 'comienzo temprano'],
 102 => ['finalización temprana', 'early finish', 'final temprano', 'fin temprano', 'terminacion temprana'],
 103 => ['inicio tardío', 'late start', 'comienzo tardio', 'inicio mas tarde', 'inicio mas tardio'],
 104 => ['finalización tardía', 'late finish', 'final tardio', 'fin tardio', 'fin mas tardio', 'terminacion tardia'],
 105 => ['adelante', 'hacia adelante'],
 106 => ['atrás', 'hacia atras'],
 107 => ['0', 'cero'],
 108 => ['constante', 'consistente'],
 109 => ['sumando', 'sumar', 'suma'],
 110 => ['mayor', 'mas alto', 'mas tardio', 'mayor valor'],
 111 => ['restando', 'restar', 'resta'],
 112 => ['menor', 'mas bajo', 'mas temprano', 'menor valor'],
 121 => ['ES'],
 122 => ['EF'],
 123 => ['LS'],
 124 => ['LF'],
 125 => ['duración', 'duracion'],
 126 => ['nombre de actividad', 'nombre de la actividad', 'actividad', 'nombre'],
 127 => ['cantidad de holgura', 'holgura'],
 128 => ['EF = ES + duración', 'EF = ES + duracion'],
 129 => ['LS = LF − duración', 'LS = LF - duración', 'LS = LF − duracion', 'LS = LF - duracion'],
 113 => ['ruta crítica', 'duracion de la ruta critica', 'duracion del proyecto'],

/* ---- 4. Compresion: etiquetas del diagrama ---- */
 151 => ['flujo normal', 'normal workflow', 'flujo de trabajo normal', 'normal', 'secuencial', 'flujo secuencial'],
 152 => ['fast tracking', 'fast-tracking', 'fasttracking', 'ejecucion rapida', 'paralelo'],
 153 => ['aumenta el riesgo', 'increases risks', 'aumenta los riesgos', 'riesgo elevado', 'mas riesgo', 'riesgo', 'riesgos'],
 154 => ['crashing', 'intensificacion'],
 155 => ['aumenta el costo', 'increases costs', 'aumenta los costos', 'costo elevado', 'mas costo', 'costo', 'costos'],

/* ---- 2. Holgura ---- */
 201 => ['LS'],
 202 => ['LF'],
 203 => ['misma', 'igual'],
 204 => ['flexibilidad'],
 205 => ['máxima', 'maxima'],
 206 => ['cero', '0'],

/* ---- 3. Que es la ruta critica ---- */
 301 => ['mayor', 'mas larga'],
 302 => ['proyecto'],
 303 => ['menor'],
 304 => ['atrasa', 'retrasa'],

/* ---- 4. Ejemplo de clase: ES, EF, LS, LF, H ---- */
 401 => '0',  402 => '6',  403 => '0',  404 => '6',  405 => '0',    // A
 411 => '0',  412 => '4',  413 => '1',  414 => '5',  415 => '1',    // D
 421 => '4',  422 => '12', 423 => '5',  424 => '13', 425 => '1',    // E
 431 => '6',  432 => '13', 433 => '6',  434 => '13', 435 => '0',    // F
 441 => '13', 442 => '18', 443 => '13', 444 => '18', 445 => '0',    // G
 451 => '18', 452 => '25', 453 => '18', 454 => '25', 455 => '0',    // H
 461 => '25', 462 => '33', 463 => '25', 464 => '33', 465 => '0',    // C
 471 => '13', 472 => '18', 473 => '28', 474 => '33', 475 => '15',   // B
 480 => '33',
 481 => '13',
 482 => '13',

/* ---- 5. Taller · ejercicio 1 ---- */
 501 => ['7', 'siete'],
 502 => '16',
 503 => '3',
 504 => '2',
 505 => '17',

/* ---- 6. Taller · ejercicio 2 ---- */
 601 => '22',
 602 => '4',
 603 => '18',
];

iniciar($MULTIPLE, $EMPAREJAR, $SOLUCIONES);
cabecera('Parcial 2 · Ruta crítica', 'Método de la ruta crítica, holguras y compresión del cronograma');

$tabla = function ($filas) {
    echo '<div class="tp-wrap"><table class="tp"><tr><th>Actividad</th><th>Duración</th>'
       . '<th>ES</th><th>EF</th><th>LS</th><th>LF</th><th>Holgura</th></tr>';
    foreach ($filas as $f) {
        echo '<tr><td><b>' . $f[0] . '</b></td><td>' . $f[1] . '</td>';
        for ($k = 1; $k <= 5; $k++) { echo '<td>'; hueco($f[2] + $k - 1, 3); echo '</td>'; }
        echo '</tr>';
    }
    echo '</table></div>';
};
?>
<link rel="stylesheet" href="p2.css?v=<?= filemtime(__DIR__ . "/p2.css") ?>">

<div class="card">
  <h2>Ruta crítica</h2>
  <p>Primero los conceptos (cada uno una sola vez) y después tres redes para practicar el
     recorrido hacia adelante y hacia atrás. Pulsa <b>Enter</b> en un hueco o el botón del
     bloque para corregir.</p>
  <div class="indice">
    <a href="#c1">Tiempos y recorridos</a><a href="#c2">Holgura</a><a href="#c3">Ruta crítica</a>
    <a href="#c4">Compresión</a><a href="#c5">Ejemplo de clase</a><a href="#c6">Taller 1</a><a href="#c7">Taller 2</a>
  </div>
</div>

<div class="parte-tit">Conceptos</div>

<!-- ============================================================ 1 -->
<div class="card" id="c1">
  <h2>1. Los cuatro tiempos y los dos recorridos</h2>
  <div class="modelo-huecos">
    <div class="mh-tit">Qué significa cada sigla</div>
    <p>Así se dibuja cada actividad en el diagrama de red. En cada esquina escribe la sigla que
       va ahí y su nombre completo; arriba, lo que se anota encima del nodo; en el centro, las dos
       cosas que van adentro.</p>
    <div class="nodo-wrap">
      <div class="nodo-dur"><span class="chip">Encima del nodo</span><?php hueco(125, 14); ?></div>
      <div class="nodo">
        <div class="esq tl"><span class="sigw"><?php hueco(121, 4); ?></span><?php hueco(101, 18); ?>
          <div class="desc">El día más temprano que la actividad puede empezar.</div></div>
        <div class="vacio"></div>
        <div class="esq tr"><span class="sigw"><?php hueco(122, 4); ?></span><?php hueco(102, 18); ?>
          <div class="desc">El día más temprano que puede finalizar.</div></div>
        <div class="centro">
          <p><?php hueco(126, 24); ?></p>
          <p><?php hueco(127, 24); ?></p>
        </div>
        <div class="esq bl"><span class="sigw"><?php hueco(123, 4); ?></span><?php hueco(103, 18); ?>
          <div class="desc">Lo más tarde que la actividad puede empezar.</div></div>
        <div class="vacio"></div>
        <div class="esq br"><span class="sigw"><?php hueco(124, 4); ?></span><?php hueco(104, 18); ?>
          <div class="desc">El día más tarde que puede finalizar.</div></div>
      </div>
    </div>

    <p class="sub">Cómo se calculan</p>
    <p>Las cifras <i>tempranas</i> salen de un recorrido hacia <?php hueco(105, 9); ?>, del inicio al
       final siguiendo las dependencias; las <i>tardías</i>, de un recorrido hacia
       <?php hueco(106, 7); ?>, desde el final hacia el inicio.</p>
    <p>La primera actividad normalmente tiene un ES de <?php hueco(107, 3); ?> (algunos usan 1):
       cualquiera da la respuesta correcta si se usa de manera <?php hueco(108, 11); ?>.</p>
    <p>Hacia adelante se va <?php hueco(109, 9); ?> (<?php hueco(128, 24); ?>). Donde convergen
       rutas se toma el EF <?php hueco(110, 7); ?> de las predecesoras como ES, porque la actividad
       no puede empezar hasta que todas terminen.</p>
    <p>Hacia atrás se va <?php hueco(111, 9); ?> (<?php hueco(129, 24); ?>). Donde convergen rutas se
       toma el LS <?php hueco(112, 7); ?> de las sucesoras como LF, porque la actividad debe estar
       terminada antes de que cualquiera de ellas inicie.</p>
    <p>El recorrido hacia atrás arranca usando la duración de la <?php hueco(113, 14); ?> como
       finalización de la última actividad.</p>
  </div>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 2 -->
<div class="card" id="c2">
  <h2>2. Holgura</h2>
  <div class="modelo-huecos">
    <div class="mh-tit">La diferencia entre lo tardío y lo temprano</div>
    <p>Holgura = <?php hueco(201, 4); ?> − ES &nbsp;&nbsp;o&nbsp;&nbsp; Holgura =
       <?php hueco(202, 4); ?> − EF. Cualquier fórmula presenta la <?php hueco(203, 7); ?> respuesta.</p>
    <p>Le indica al equipo cuánta <?php hueco(204, 12); ?> de tiempo tiene cada actividad (aunque
       cualquier retraso del plan necesita la aprobación del gerente del proyecto).</p>
    <p>Si es <b>positiva</b>, es la cantidad <?php hueco(205, 8); ?> de tiempo que se pueden demorar
       las actividades de esa ruta sin poner en peligro la fecha de terminación requerida.</p>
    <p>Las actividades con holgura <?php hueco(206, 5); ?> están en la ruta crítica.</p>
  </div>
  <?php mc('hneg'); ?>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 3 -->
<div class="card" id="c3">
  <h2>3. Qué es la ruta crítica</h2>
  <div class="modelo-huecos">
    <div class="mh-tit">Tres formas de decir lo mismo</div>
    <p>Es la ruta de <?php hueco(301, 7); ?> duración, y esa duración es la duración del
       <?php hueco(302, 9); ?>.</p>
    <p>Es la ruta que tiene la <?php hueco(303, 7); ?> holgura.</p>
    <p>Un atraso en una actividad de la ruta crítica <?php hueco(304, 8); ?> el proyecto.</p>
  </div>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 4 -->
<div class="card" id="c4">
  <h2>4. Técnicas de compresión</h2>
  <p>Escribe a la izquierda qué es cada cronograma y qué aumenta.</p>
  <div class="comp-fig">
    <div class="etqs">
      <div class="etq" style="top:6%"><span class="chip">Las actividades una tras otra</span><?php hueco(151, 20); ?></div>
      <div class="etq" style="top:35%"><span class="chip">Técnica</span><?php hueco(152, 20); ?>
        <span class="chip" style="margin-top:6px">Qué aumenta</span><?php hueco(153, 20); ?></div>
      <div class="etq" style="top:67%"><span class="chip">Técnica</span><?php hueco(154, 20); ?>
        <span class="chip" style="margin-top:6px">Qué aumenta</span><?php hueco(155, 20); ?></div>
    </div>
    <?php include __DIR__ . '/compresion.svg.php'; ?>
  </div>
  <?php empareja('comp'); ?>
  <?php enviar('Verificar este bloque'); ?>
</div>

<div class="parte-tit">Ejercicios</div>

<!-- ============================================================ 5 -->
<div class="card" id="c5">
  <h2>5. Ejemplo de clase · recorrido completo</h2>
  <p>Duraciones en semanas, con ES de la primera actividad = 0. Llena la tabla con el recorrido
     hacia adelante (ES, EF) y luego hacia atrás (LS, LF); al final la holgura.</p>
  <?php
  echo red_svg('ej', [
      'Inicio' => ['x' => 45,  'y' => 125, 'ext' => 1],
      'D'      => ['x' => 165, 'y' => 45,  'd' => 4],
      'A'      => ['x' => 165, 'y' => 125, 'd' => 6],
      'E'      => ['x' => 295, 'y' => 45,  'd' => 8],
      'F'      => ['x' => 295, 'y' => 125, 'd' => 7],
      'G'      => ['x' => 425, 'y' => 125, 'd' => 5],
      'H'      => ['x' => 545, 'y' => 125, 'd' => 7],
      'B'      => ['x' => 545, 'y' => 210, 'd' => 5],
      'C'      => ['x' => 665, 'y' => 125, 'd' => 8],
      'Fin'    => ['x' => 780, 'y' => 125, 'ext' => 1],
  ], [
      ['Inicio','D'], ['Inicio','A'], ['D','E'], ['A','F'], ['E','G'], ['F','G'],
      ['G','H'], ['H','C'], ['C','Fin'], ['F','B'], ['B','Fin'],
  ], 830, 245);

  $tabla([
      ['A', 6, 401], ['D', 4, 411], ['E', 8, 421], ['F', 7, 431],
      ['G', 5, 441], ['H', 7, 451], ['C', 8, 461], ['B', 5, 471],
  ]);
  ?>
  <div class="modelo-huecos">
    <div class="mh-tit">Los dos puntos de convergencia</div>
    <p>A <b>G</b> llegan E y F: su ES es el mayor de los EF, <?php hueco(481, 3); ?>.</p>
    <p>De <b>F</b> salen G y B: su LF es el menor de los LS, <?php hueco(482, 3); ?>.</p>
    <p>Duración del proyecto: <?php hueco(480, 3); ?> semanas.</p>
  </div>
  <?php mc('cp_ej'); ?>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 6 -->
<div class="card" id="c6">
  <h2>6. Taller · ejercicio 1</h2>
  <p>Dibuja el diagrama de red con la tabla y contesta.</p>
  <div class="tp-wrap"><table class="tp" style="max-width:480px">
    <tr><th>Actividad</th><th>Predecesora</th><th>Semanas</th></tr>
    <tr><td>Inicio</td><td>—</td><td>0</td></tr>
    <tr><td>C</td><td>Inicio</td><td>6</td></tr>
    <tr><td>B</td><td>Inicio</td><td>4</td></tr>
    <tr><td>P</td><td>Inicio</td><td>3</td></tr>
    <tr><td>A</td><td>C, B, P</td><td>7</td></tr>
    <tr><td>U</td><td>P</td><td>4</td></tr>
    <tr><td>T</td><td>A</td><td>2</td></tr>
    <tr><td>R</td><td>A</td><td>3</td></tr>
    <tr><td>N</td><td>U</td><td>6</td></tr>
    <tr><td>Fin</td><td>T, R, N</td><td>0</td></tr>
  </table></div>

  <details class="desp"><summary>Ver el diagrama de red (después de dibujarlo)</summary><div class="cont">
  <?php
  echo red_svg('t1', [
      'Inicio' => ['x' => 45,  'y' => 130, 'ext' => 1],
      'C'      => ['x' => 165, 'y' => 45,  'd' => 6],
      'B'      => ['x' => 165, 'y' => 130, 'd' => 4],
      'P'      => ['x' => 165, 'y' => 215, 'd' => 3],
      'A'      => ['x' => 305, 'y' => 110, 'd' => 7],
      'U'      => ['x' => 305, 'y' => 215, 'd' => 4],
      'T'      => ['x' => 445, 'y' => 55,  'd' => 2],
      'R'      => ['x' => 445, 'y' => 135, 'd' => 3],
      'N'      => ['x' => 445, 'y' => 215, 'd' => 6],
      'Fin'    => ['x' => 575, 'y' => 135, 'ext' => 1],
  ], [
      ['Inicio','C'], ['Inicio','B'], ['Inicio','P'], ['C','A'], ['B','A'], ['P','A'],
      ['P','U'], ['A','T'], ['A','R'], ['U','N'], ['T','Fin'], ['R','Fin'], ['N','Fin'],
  ], 625, 250);
  ?>
  </div></details>

  <div class="modelo-huecos">
    <div class="mh-tit">Preguntas del taller</div>
    <p>1. ¿Cuántos caminos hay en la red? <?php hueco(501, 4); ?></p>
    <p>2. Duración de la ruta crítica: <?php hueco(502, 4); ?> semanas.</p>
    <p>3. Holgura de la actividad U: <?php hueco(503, 4); ?> semanas.</p>
    <p>4. Holgura de la actividad B: <?php hueco(504, 4); ?> semanas. Si B tarda tres semanas
       más, el proyecto pasa a durar <?php hueco(505, 4); ?> semanas.</p>
  </div>
  <?php mc('t1_cp'); ?>
  <?php mc('t1_imp'); ?>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 7 -->
<div class="card" id="c7">
  <h2>7. Taller · ejercicio 2</h2>
  <div class="tp-wrap"><table class="tp" style="max-width:480px">
    <tr><th>Actividad</th><th>Predecesora</th><th>Semanas</th></tr>
    <tr><td>A</td><td>Inicio</td><td>3</td></tr>
    <tr><td>B</td><td>A</td><td>3</td></tr>
    <tr><td>C</td><td>A</td><td>15</td></tr>
    <tr><td>D</td><td>B</td><td>8</td></tr>
    <tr><td>E</td><td>C, D</td><td>4</td></tr>
    <tr><td>Fin</td><td>E</td><td>0</td></tr>
  </table></div>

  <details class="desp"><summary>Ver el diagrama de red (después de dibujarlo)</summary><div class="cont">
  <?php
  echo red_svg('t2', [
      'Inicio' => ['x' => 45,  'y' => 105, 'ext' => 1],
      'A'      => ['x' => 165, 'y' => 105, 'd' => 3],
      'B'      => ['x' => 290, 'y' => 45,  'd' => 3],
      'D'      => ['x' => 415, 'y' => 45,  'd' => 8],
      'C'      => ['x' => 350, 'y' => 165, 'd' => 15],
      'E'      => ['x' => 535, 'y' => 105, 'd' => 4],
      'Fin'    => ['x' => 650, 'y' => 105, 'ext' => 1],
  ], [
      ['Inicio','A'], ['A','B'], ['B','D'], ['D','E'], ['A','C'], ['C','E'], ['E','Fin'],
  ], 700, 205);
  ?>
  </div></details>

  <div class="modelo-huecos">
    <div class="mh-tit">Preguntas del taller</div>
    <p>1. Duración del proyecto: <?php hueco(601, 4); ?> semanas.</p>
    <p>2. Holgura del nodo D: <?php hueco(602, 4); ?> semanas.</p>
    <p>4. Si C se termina 5 semanas antes, el proyecto dura <?php hueco(603, 4); ?> semanas.</p>
  </div>
  <?php mc('t2_cp'); ?>
  <?php mc('t2_imp'); ?>
</div>

<?php
pie('index.php', 'ValorGanado.php');
