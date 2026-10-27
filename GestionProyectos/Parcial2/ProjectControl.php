<?php
/* ==========================================================================
   Parcial 2 — MS Project · Control y seguimiento
   Fuentes: Control y seguimiento - MS Project.pdf (ejercicio dirigido con
            "Explicacion - Tipos de campos.mpp") y videos 8 y 9.
   Las formulas del valor ganado y su lectura estan en ValorGanado.php;
   aqui solo lo propio de la herramienta.
   ========================================================================== */

$MENU = 'index.php';
require_once __DIR__ . '/../motor.php';

$MULTIPLE = [];

$EMPAREJAR = [
    'grupos' => [
        'texto'    => 'Los tres grupos de datos que maneja Project durante el ciclo de vida: ¿a cuál pertenece cada campo?',
        'opciones' => ['Programados (actuales)', 'Previstos (línea base)', 'Reales (ejecutados)'],
        'items'    => [
            'Comienzo'         => 'Programados (actuales)',
            'Fin previsto'     => 'Previstos (línea base)',
            'Duración real'    => 'Reales (ejecutados)',
            'Trabajo'          => 'Programados (actuales)',
            'Costo previsto'   => 'Previstos (línea base)',
            'Comienzo real'    => 'Reales (ejecutados)',
            'Duración prevista'=> 'Previstos (línea base)',
            'Costo real'       => 'Reales (ejecutados)',
        ],
        'porque'   => 'Cada grupo tiene los mismos cinco campos: comienzo, fin, duración, trabajo y costo. Sin apellido = programado; «previsto» = línea base; «real» = ejecutado.'
    ],
    'campos' => [
        'texto'    => 'Ejercicio dirigido con «Explicación – Tipos de campos.mpp» (ya con la línea base establecida y sin fecha de estado): ¿qué pasa en cada caso?',
        'opciones' => [
            'Aparece el Comienzo real y se actualizan el trabajo real y el restante',
            'Aparece el Fin real',
            'Se ajusta el Comienzo real y se recalculan el % completado y el trabajo restante',
            'La tarea se corre: cambian Comienzo y Fin, el Comienzo previsto no; aparece la variación de fin',
            'Cambia la duración, la duración de línea base se conserva y se mueven las tareas aguas abajo',
        ],
        'items'    => [
            'Tarea A: % completado = 50 %'                                  => 'Aparece el Comienzo real y se actualizan el trabajo real y el restante',
            'Tarea A: % completado = 100 %'                                 => 'Aparece el Fin real',
            'Tarea B: Trabajo real = 8 horas'                               => 'Se ajusta el Comienzo real y se recalculan el % completado y el trabajo restante',
            'Tarea B: Comienzo real = una fecha posterior a la planeada'    => 'La tarea se corre: cambian Comienzo y Fin, el Comienzo previsto no; aparece la variación de fin',
            'Tarea B: Trabajo restante = 16 horas'                          => 'Cambia la duración, la duración de línea base se conserva y se mueven las tareas aguas abajo',
        ],
        'porque'   => 'En todos los casos algo parecido pasa con la duración real y la duración restante. Al correr el comienzo real, las tareas «aguas abajo» también se desplazan.'
    ],
];

$SOLUCIONES = [
/* ---- 1. Controlar el cronograma ---- */
 101 => ['progreso', 'avance'],
 102 => ['diferencias', 'variaciones', 'desviaciones'],
 103 => ['preventivas'],
 104 => ['correctivas'],
 105 => ['reportar', 'informar'],
 106 => ['línea base', 'linea base'],
 107 => ['progreso', 'avance'],
 108 => ['divergencia', 'desviacion', 'diferencia'],
 109 => ['detalle'],
 110 => ['tiempo'],
 111 => ['exactitud', 'precision'],

/* ---- 2. Seis tecnicas ---- */
 201 => ['% completado', 'porcentaje completado', 'porcentaje de avance', '%completado'],
 202 => ['duración', 'duracion'],
 203 => ['fechas'],
 204 => ['trabajo'],
 205 => ['costo'],
 206 => ['valor ganado'],

/* ---- 4. % completado ---- */
 401 => '6',
 402 => '40',
 403 => ['duración', 'duracion'],
 404 => ['línea base', 'linea base'],

/* ---- 5. Fecha de estado ---- */
 501 => ['corte'],
 502 => ['cada vez', 'siempre'],
 503 => ['Proyecto'],
 504 => ['Gantt', 'gant'],

/* ---- 6. Valor ganado en Project ---- */
 601 => ['línea base', 'linea base'],
 602 => ['Valor acumulado'],
 603 => ['% completado', 'porcentaje completado', 'porcentaje de avance', '%completado'],
 604 => '625.920',
 605 => ['Costo real'],

/* ---- 7. Indicadores ---- */
 701 => ['Campos personalizados'],
 702 => ['Texto'],
 703 => ['Fórmula', 'formula'],
 704 => ['Indicadores gráficos', 'indicadores graficos', 'indicador grafico'],
 705 => ['verde'],
 706 => ['rojo'],
];

iniciar($MULTIPLE, $EMPAREJAR, $SOLUCIONES);
cabecera('Parcial 2 · MS Project — Control y seguimiento', 'Línea base vs. avance real, campos, fecha de estado e indicadores');
?>
<link rel="stylesheet" href="p2.css?v=<?= filemtime(__DIR__ . "/p2.css") ?>">

<div class="card">
  <h2>MS Project · Control y seguimiento</h2>
  <p>La planeación ya terminó (calendario, tareas, secuencia, recursos, duraciones, presupuesto,
     nivelación y línea base). Ahora se ejecuta y se controla. Las fórmulas de valor ganado no se
     repiten aquí: están en <a href="ValorGanado.php">Valor ganado</a>.</p>
  <div class="indice">
    <a href="#c1">Controlar</a><a href="#c2">Técnicas</a><a href="#c3">Grupos de datos</a>
    <a href="#c4">% completado</a><a href="#c5">Fecha de estado</a><a href="#c6">Valor acumulado</a>
    <a href="#c7">Indicadores</a>
  </div>
</div>

<!-- ============================================================ 1 -->
<div class="card" id="c1">
  <h2>1. Controlar el cronograma</h2>
  <div class="modelo-huecos">
    <div class="mh-tit">Las cuatro actividades de la ejecución y el control</div>
    <p>Seguimiento al <?php hueco(101, 9); ?> de las actividades &rarr; analizar
       <?php hueco(102, 11); ?> entre lo planeado y lo ejecutado &rarr; controlar mediante acciones
       <?php hueco(103, 11); ?> y <?php hueco(104, 11); ?> &rarr; <?php hueco(105, 9); ?> a los
       interesados.</p>
    <p class="sub">Qué se necesita</p>
    <p>Contar con la <?php hueco(106, 11); ?> del cronograma y diligenciar el
       <?php hueco(107, 9); ?> de las actividades. Al principio los dos tienen la misma información;
       a medida que se diligencia el avance aparece una <?php hueco(108, 11); ?>, y esa desviación
       es la que se monitorea y controla.</p>
    <p class="sub">Cómo escoger el método de seguimiento</p>
    <p>Se considera el nivel de <?php hueco(109, 8); ?> requerido, cómo está elaborado el cronograma,
       el <?php hueco(110, 7); ?> disponible para alimentarlo y la <?php hueco(111, 10); ?> e
       integridad de su información.</p>
  </div>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 2 -->
<div class="card" id="c2">
  <h2>2. Las seis técnicas de seguimiento</h2>
  <div class="modelo-huecos">
    <div class="mh-tit">De la más simple a la más completa</div>
    <p>1. <?php hueco(201, 14); ?></p>
    <p>2. <?php hueco(202, 9); ?> real y restante</p>
    <p>3. <?php hueco(203, 7); ?> reales de comienzo y fin</p>
    <p>4. <?php hueco(204, 8); ?> real y restante</p>
    <p>5. <?php hueco(205, 7); ?> real y restante</p>
    <p>6. Técnica de <?php hueco(206, 12); ?></p>
  </div>
  <p class="nota">Con estos valores se calculan las variaciones y los índices que muestran la salud
     del proyecto y sirven para tomar decisiones.</p>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 3 -->
<div class="card" id="c3">
  <h2>3. Grupos de datos y el ejercicio de los campos</h2>
  <?php empareja('grupos'); ?>
  <?php empareja('campos'); ?>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 4 -->
<div class="card" id="c4">
  <h2>4. Duración y % completado</h2>
  <div class="modelo-huecos">
    <div class="mh-tit">Una tarea de 10 días laborales con 4 días de duración real</div>
    <p>Duración restante: <?php hueco(401, 3); ?> días. % completado: <?php hueco(402, 3); ?> %.</p>
    <p>El % completado se calcula con base en la <?php hueco(403, 9); ?>, no con la duración de
       <?php hueco(404, 11); ?> de la tarea.</p>
  </div>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 5 -->
<div class="card" id="c5">
  <h2>5. Fecha de estado</h2>
  <div class="modelo-huecos">
    <div class="mh-tit">La fecha a la que se mide</div>
    <p>Es la fecha de <?php hueco(501, 7); ?> a la cual se hace el seguimiento del proyecto, y hay
       que definirla <?php hueco(502, 8); ?> que se vaya a hacer seguimiento.</p>
    <p>Se define en la pestaña <?php hueco(503, 9); ?> &rarr; Fecha de estado, y es recomendable
       visualizarla en el diagrama de <?php hueco(504, 7); ?>.</p>
  </div>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 6 -->
<div class="card" id="c6">
  <h2>6. El valor ganado dentro de Project</h2>
  <div class="modelo-huecos">
    <div class="mh-tit">Lo que hace la herramienta</div>
    <p>Antes de empezar el análisis tiene que estar definida la <?php hueco(601, 11); ?> (y la fecha
       de estado).</p>
    <p>La tabla se busca con clic derecho en la esquina de la tabla (o Vista &rarr; Tablas) &rarr;
       Más tablas &rarr; <?php hueco(602, 14); ?>; conviene marcarla como visible en el menú.</p>
    <p>Project calcula solo el valor ganado de cada tarea como CPF × <?php hueco(603, 13); ?>: una
       tarea con CPF de 1.043.200 al 60 % tiene un valor ganado de <?php hueco(604, 9); ?>.</p>
    <p>Para que cambie el AC (CRTR) se inserta la columna <?php hueco(605, 10); ?> y se escribe lo
       que realmente se gastó.</p>
  </div>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 7 -->
<div class="card" id="c7">
  <h2>7. Indicadores personalizados</h2>
  <div class="modelo-huecos">
    <div class="mh-tit">Un semáforo en una columna</div>
    <p>Proyecto &rarr; <?php hueco(701, 20); ?>; se escoge un campo de tipo
       <?php hueco(702, 6); ?>, se le cambia el nombre (p. ej. «Seguimiento duración») y en
       <?php hueco(703, 8); ?> se arma la condición: si la duración real es mayor que la duración de
       línea base, «mal»; si no, «bien».</p>
    <p>Con <?php hueco(704, 18); ?> se le pone un semáforo a un índice como el IRC: mayor que 1 en
       <?php hueco(705, 6); ?> (ahorro) y menor que 1 en <?php hueco(706, 6); ?> (sobrecosto).</p>
  </div>
</div>

<?php
pie('ProjectPlaneacion.php', '');
