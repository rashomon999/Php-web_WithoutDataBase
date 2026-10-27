<?php
/* ==========================================================================
   Parcial 2 — MS Project · Planeacion del cronograma
   Fuentes: Presentacion de Planeacion en MS Project.pdf y las transcripciones
            de los videos 1, 2, 3, 5, 6 y 7.
   El concepto de ruta critica esta en RutaCritica.php; aqui solo como se ve.
   ========================================================================== */

$MENU = 'index.php';
require_once __DIR__ . '/../motor.php';

$MULTIPLE = [];

$EMPAREJAR = [
    'comp' => [
        'texto'    => 'Los tres componentes de un cronograma: ¿a cuál corresponde cada pregunta?',
        'opciones' => ['Tareas', 'Recursos', 'Costos'],
        'items'    => [
            '¿Qué tenemos que hacer? ¿Cómo lo tenemos que hacer?' => 'Tareas',
            '¿Quién lo hace?'                                     => 'Recursos',
            '¿Qué material necesitamos?'                          => 'Recursos',
            '¿Cuál es el presupuesto?'                            => 'Costos',
        ],
    ],
    'tipos' => [
        'texto'    => 'Tipos de tareas en MS Project',
        'opciones' => ['Resumen del proyecto (tarea 0)', 'Tarea resumen', 'Tarea común (subtarea)', 'Hito', 'Tarea periódica', 'Tarea dividida'],
        'items'    => [
            'Es la tarea 0: resume todo el cronograma'                                    => 'Resumen del proyecto (tarea 0)',
            'Va en negrita, agrupa otras tareas y consolida su duración y su costo'        => 'Tarea resumen',
            'Es la de nivel más bajo: ahí se registra la duración'                          => 'Tarea común (subtarea)',
            'Dura 0 días y en el Gantt se dibuja como un rombo'                             => 'Hito',
            'Se repite, como el comité de diseño todos los jueves durante 7 repeticiones'  => 'Tarea periódica',
            'Su trabajo queda partido en tramos separados en el tiempo'                     => 'Tarea dividida',
        ],
    ],
    'rel' => [
        'texto'    => 'Relaciones de precedencia, adelantos y atrasos',
        'opciones' => ['FC', 'CC', 'FF', 'CF', 'Adelanto (lead)', 'Atraso (lag)'],
        'items'    => [
            'El inicio de la sucesora depende de la finalización de la predecesora'       => 'FC',
            'El inicio de la sucesora depende del inicio de la predecesora'               => 'CC',
            'La finalización de la sucesora depende de la finalización de la predecesora' => 'FF',
            'La llaman la relación huérfana; es poco utilizada'                           => 'CF',
            'La que Project aplica por defecto'                                           => 'FC',
            '32FC-5 días'                                                                 => 'Adelanto (lead)',
            '33FC+10 días'                                                                => 'Atraso (lag)',
        ],
        'porque'   => 'Project escribe adelantos y atrasos como un desfase: con <b>menos</b> para adelantos (acelera la sucesora) y con <b>más</b> para atrasos (la demora).'
    ],
    'rec' => [
        'texto'    => 'Tipos de recursos: ¿a cuál corresponde cada cosa?',
        'opciones' => ['Trabajo', 'Material', 'Costo'],
        'items'    => [
            'Mano de obra: desarrolladores, constructores, sociólogo'                => 'Trabajo',
            'Alquiler de equipos'                                                    => 'Trabajo',
            'Papel, ladrillos, cemento'                                              => 'Material',
            'Licencias y kits'                                                       => 'Material',
            'Pasaje de avión, alojamiento'                                           => 'Costo',
            'Tiene tasa estándar por unidad de tiempo y calendario'                  => 'Trabajo',
            'Se le define la unidad de medida en la columna Etiqueta de material'    => 'Material',
            'No tiene tasa estándar: su valor se pone al asignarlo a cada tarea'     => 'Costo',
            'Es el único que puede quedar sobreasignado'                             => 'Trabajo',
        ],
        'porque'   => 'Material y Costo no tienen calendario y no se sobreasignan. Al material se le da la cantidad al asignarlo (Cemento[10 Saco]); al costo, el valor ($16 de pasaje en una tarea, $3 en otra).'
    ],
];

$SOLUCIONES = [
/* ---- 1. Para que sirve ---- */
 101 => ['cronogramas', 'cronograma'],
 102 => ['recursos'],
 103 => ['presupuesto'],
 104 => ['cargas', 'cargas de trabajo'],
 105 => ['seguimiento'],

/* ---- 2. Interfaz ---- */
 201 => ['comandos'],
 202 => ['Vista'],
 203 => ['Gantt', 'gant'],
 204 => ['vistas'],

/* ---- 3. Tareas ---- */
 501 => ['duración', 'duracion'],
 502 => ['trabajo'],
 503 => ['unidades'],
 504 => ['manual'],
 505 => ['signo de interrogación', '?', 'interrogacion', 'signo de pregunta'],
 506 => ['bajo'],
 507 => ['consolida', 'suma'],

/* ---- 4. Relaciones ---- */
 601 => ['relaciones', 'dependencias'],
 602 => ['primera', 'primero'],
 603 => ['última', 'ultima', 'ultimo'],

/* ---- 5. Recursos ---- */
 701 => ['Hoja de recursos'],
 702 => ['capacidad'],
 703 => ['Costo', 'costos'],
 704 => ['fecha', 'fechas'],

/* ---- 6. Linea base ---- */
 801 => ['aprobada'],
 802 => ['referencia'],
 803 => ['contractual'],
 804 => ['solicitud de cambio', 'cambio'],
 805 => ['11', 'once'],
 806 => ['Establecer línea base', 'establecer linea base'],

/* ---- 7. Ruta critica en Project ---- */
 901 => ['Formato'],
 902 => ['Tareas críticas', 'tareas criticas'],
 903 => ['rojo'],
 904 => ['Proyecto completo'],

];

iniciar($MULTIPLE, $EMPAREJAR, $SOLUCIONES);
cabecera('Parcial 2 · MS Project — Planeación', 'Interfaz, tareas, relaciones, recursos, línea base y ruta crítica');
?>
<link rel="stylesheet" href="p2.css?v=<?= filemtime(__DIR__ . "/p2.css") ?>">

<div class="card">
  <h2>MS Project · Planeación del cronograma</h2>
  <p>Lo propio de la herramienta. El cálculo de la ruta crítica está en su cuestionario; aquí
     solo dónde se activa en Project.</p>
  <div class="indice">
    <a href="#c1">Para qué sirve</a><a href="#c2">Interfaz</a>
    <a href="#c3">Tareas</a><a href="#c4">Relaciones</a><a href="#c5">Recursos</a>
    <a href="#c6">Línea base</a><a href="#c7">Ruta crítica</a>
  </div>
</div>

<!-- ============================================================ 1 -->
<div class="card" id="c1">
  <h2>1. Para qué sirve</h2>
  <div class="modelo-huecos">
    <div class="mh-tit">MS Project asiste al gerente de proyectos en</div>
    <p>El desarrollo de <?php hueco(101, 12); ?>, la asignación de <?php hueco(102, 10); ?>,
       administrar el <?php hueco(103, 12); ?>, analizar <?php hueco(104, 8); ?> de trabajo y hacer
       <?php hueco(105, 12); ?> al progreso.</p>
  </div>
  <?php empareja('comp'); ?>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 2 -->
<div class="card" id="c2">
  <h2>2. La interfaz</h2>
  <div class="modelo-huecos">
    <div class="mh-tit">Lo que hay en la pantalla</div>
    <p>Arriba están las pestañas (de Archivo en adelante), y dentro de cada una opciones llamadas
       <?php hueco(201, 10); ?>.</p>
    <p>Debajo va la escala de tiempo; si no aparece, se activa en la pestaña
       <?php hueco(202, 7); ?>.</p>
    <p>A la izquierda, la tabla (nombre, duración, comienzo, fin, predecesoras, recursos…); a la
       derecha, el avance en el tiempo en un diagrama de <?php hueco(203, 7); ?>.</p>
    <p>Abajo a la izquierda están las <?php hueco(204, 7); ?>: tareas, organización del equipo
       (cargas y sobrecargas) y recursos.</p>
  </div>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 3 -->
<div class="card" id="c3">
  <h2>3. Tareas</h2>
  <?php empareja('tipos'); ?>
  <div class="modelo-huecos">
    <div class="mh-tit">Lo que hay que recordar</div>
    <p>Según su comportamiento con los recursos asignados, una tarea puede ser de
       <?php hueco(501, 9); ?> fija, <?php hueco(502, 8); ?> fijo o <?php hueco(503, 9); ?> fijas.</p>
    <p>Con programación automática, al poner la duración Project calcula comienzo y fin; la
       programación <?php hueco(504, 7); ?> se reconoce porque el ícono es un chinche.</p>
    <p>Un <?php hueco(505, 20); ?> junto a la duración avisa que todavía no se le ha asignado
       (es estimada).</p>
    <p>La duración se registra en la tarea de nivel más <?php hueco(506, 6); ?>; la tarea resumen
       <?php hueco(507, 9); ?> la de sus subtareas.</p>
  </div>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 4 -->
<div class="card" id="c4">
  <h2>4. Secuenciar: relaciones, adelantos y atrasos</h2>
  <div class="modelo-huecos">
    <div class="mh-tit">La finalidad</div>
    <p>Identificar y documentar las <?php hueco(601, 11); ?> lógicas entre las actividades. Cada
       actividad e hito se conecta con al menos un predecesor y un sucesor, excepto la
       <?php hueco(602, 8); ?> y la <?php hueco(603, 7); ?>.</p>
  </div>
  <?php empareja('rel'); ?>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 5 -->
<div class="card" id="c5">
  <h2>5. Recursos</h2>
  <?php empareja('rec'); ?>
  <div class="modelo-huecos">
    <div class="mh-tit">Dónde y cómo</div>
    <p>Se crean en Vista &rarr; <?php hueco(701, 16); ?> (o desde la barra de vistas de abajo a la
       izquierda), con su tasa estándar.</p>
    <p>La <?php hueco(702, 10); ?> es el porcentaje del tiempo que el recurso de trabajo dedica al
       proyecto (en el curso, 100 %) antes de quedar sobreasignado.</p>
    <p>Para ver cuánto cuesta cada tarea se inserta la columna <?php hueco(703, 7); ?>.</p>
    <p>En Información del recurso &rarr; Costos hay tablas de tasas (A a E) para cambiar la tarifa
       según la <?php hueco(704, 7); ?>.</p>
  </div>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 6 -->
<div class="card" id="c6">
  <h2>6. Línea base</h2>
  <div class="modelo-huecos">
    <div class="mh-tit">La foto del plan</div>
    <p>La línea base del cronograma es la versión <?php hueco(801, 9); ?> del modelo de cronograma,
       el punto de <?php hueco(802, 11); ?> oficial para comparar, medir y controlar el avance real
       frente al plan original.</p>
    <p>Puede llegar a tener carácter <?php hueco(803, 11); ?>, y solo se modifica previa aprobación
       de una <?php hueco(804, 18); ?> (que incluso puede implicar un otrosí al contrato).</p>
    <p>Project permite guardar <?php hueco(805, 3); ?> líneas base (LB y LB1 a LB10). Se crea en
       Proyecto &rarr; <?php hueco(806, 20); ?>.</p>
  </div>
  <?php enviar('Verificar este bloque'); ?>
</div>

<!-- ============================================================ 7 -->
<div class="card" id="c7">
  <h2>7. La ruta crítica en Project</h2>
  <div class="modelo-huecos">
    <div class="mh-tit">Necesita duraciones y secuencias cargadas</div>
    <p>En el diagrama de Gantt: pestaña <?php hueco(901, 8); ?> &rarr; casilla
       <?php hueco(902, 14); ?>. Las tareas críticas se pintan de <?php hueco(903, 6); ?>.</p>
    <p>Para verla de un vistazo: clic derecho en la escala de tiempo &rarr; Zoom &rarr;
       <?php hueco(904, 16); ?>.</p>
  </div>
  <?php enviar('Verificar este bloque'); ?>
</div>

<?php
pie('ValorGanado.php', 'ProjectControl.php');
