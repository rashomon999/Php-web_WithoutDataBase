<?php
/* ============================================================
   CAPÍTULO 8 - DEADLOCKS / ABRAZOS MORTALES (Silberschatz 10e)
   Mismo esquema que Parcial_1: respuesta_N / verificar_N / mostrar_solucion
   ============================================================ */

for ($i = 1; $i <= 300; $i++) {
    ${"respuesta_" . $i} = '';
    ${"verificar_" . $i} = '';
}
for ($i = 1; $i <= 12; $i++) {
    ${"libre_" . $i} = '';
}

/* ---------- Respuestas de texto / opción ---------- */
$claves = [
    // 8.1 System model ------------------------------------------------
    1  => ['Solicitar', 'solicitar', 'request', 'pedir', 'solicitud'],
    2  => ['Usar', 'usar', 'use', 'utilizar'],
    3  => ['Liberar', 'liberar', 'release', 'devolver'],
    4  => ['tipos', 'tipos de recurso', 'tipos de recursos', 'clases', 'types'],
    5  => ['instancias', 'instancias identicas', 'instances'],
    // 8.3.1 Las cuatro condiciones ------------------------------------
    6  => ['Exclusion mutua', 'exclusion mutua', 'mutual exclusion'],
    7  => ['Retener y esperar', 'retener y esperar', 'hold and wait', 'retencion y espera', 'mantener y esperar'],
    8  => ['No preempcion', 'no preempcion', 'sin preempcion', 'no preemption', 'no expropiacion', 'sin expropiacion'],
    9  => ['Espera circular', 'espera circular', 'circular wait'],
    10 => ['Verdadero'],       // las 4 deben cumplirse simultáneamente
    11 => ['Verdadero'],       // la espera circular implica retener y esperar
    // 8.3.2 Grafo de asignación de recursos
    12 => ['solicitud', 'arista de solicitud', 'peticion', 'request edge'],
    13 => ['asignacion', 'arista de asignacion', 'assignment edge'],
    14 => ['Falso'],           // ciclo NO siempre implica deadlock (varias instancias)
    15 => ['Verdadero'],       // con una sola instancia por tipo, ciclo <=> deadlock
    16 => ['necesaria', 'condicion necesaria', 'necesario'],
    // Livelock
    17 => ['Livelock', 'livelock', 'bloqueo activo', 'vivacidad'],
    // 8.4 Métodos ------------------------------------------------------
    18 => ['Ignorarlo', 'ignorar', 'ignorarlo', 'ignorar el problema', 'no hacer nada'],
    19 => ['Prevenir o evitar', 'prevenir', 'prevencion', 'prevenir o evitar', 'prevencion y evitacion', 'evitar'],
    20 => ['Detectar y recuperar', 'detectar y recuperar', 'deteccion y recuperacion', 'detectar'],
    21 => ['b'],               // qué hacen Linux y Windows
    // 8.5 Prevención ---------------------------------------------------
    22 => ['Espera circular', 'espera circular', 'circular wait', 'la espera circular'],
    23 => ['orden total', 'ordenamiento total', 'orden', 'jerarquia', 'orden total de los recursos', 'ordenamiento'],
    24 => ['creciente', 'orden creciente', 'ascendente', 'orden ascendente'],
    25 => ['compartibles', 'compartible', 'compartidos', 'sharable', 'de solo lectura'],
    26 => ['inanicion', 'inanicion', 'starvation', 'hambruna'],
    27 => ['Falso'],           // imponer un orden NO garantiza por sí solo la prevención
    // 8.6 Evitación ----------------------------------------------------
    28 => ['Estado seguro', 'estado seguro', 'safe state', 'seguro'],
    29 => ['Secuencia segura', 'secuencia segura', 'safe sequence'],
    // Secuencia segura del ejemplo de 12 recursos
    30 => ['T1'], 31 => ['T0'], 32 => ['T2'],
    // Secuencia segura del banquero (estado inicial)
    33 => ['T1'], 34 => ['T3'], 35 => ['T4'], 36 => ['T2'], 37 => ['T0'],
    // Secuencia segura tras conceder Request1
    38 => ['T1'], 39 => ['T3'], 40 => ['T4'], 41 => ['T0'], 42 => ['T2'],
    43 => ['Verdadero'],       // un estado con deadlock es inseguro
    44 => ['Falso'],           // NO todo estado inseguro es deadlock
    45 => ['claim', 'arista de reclamo', 'claim edge', 'reclamo', 'de reclamacion'],
    46 => ['Need', 'need', 'necesidad', 'matriz need'],
    47 => ['Available', 'available', 'disponible', 'vector available'],
    48 => ['Max', 'max', 'maximo', 'matriz max'],
    49 => ['Allocation', 'allocation', 'asignacion', 'matriz allocation'],
    // Decisiones sobre peticiones en el estado final
    50 => ['b'],   // T4 pide (3,3,0)
    51 => ['c'],   // T0 pide (0,2,0)
    // 8.7 Detección ----------------------------------------------------
    52 => ['wait-for', 'wait for', 'de espera', 'grafo de espera', 'wait-for graph'],
    53 => ['Request', 'request', 'solicitud', 'matriz request'],
    54 => ['Falso'],           // sí está en deadlock tras la petición de T2
    // 8.8 Recuperación -------------------------------------------------
    55 => ['Terminar procesos', 'terminar procesos', 'abortar procesos', 'terminacion de procesos', 'matar procesos'],
    56 => ['Preempcion de recursos', 'preempcion de recursos', 'expropiar recursos', 'preempcion', 'quitar recursos'],
    57 => ['seleccion de la victima', 'seleccion de victima', 'seleccion de la victima', 'victima'],
    58 => ['rollback', 'retroceso', 'rollback(retroceso)', 'reversion'],
    59 => ['inanicion', 'inanicion', 'starvation', 'hambruna'],
    // Puente al capítulo 9
    60 => ['Verdadero'],
];

/* ---------- Respuestas numéricas ---------- */
$numericas = [
    // Ejemplo de 12 recursos (8.6.1): Max 10/4/9, Allocation 5/2/2
    101 => 5,   // Need T0
    102 => 2,   // Need T1
    103 => 7,   // Need T2
    104 => 3,   // Available
    // Banquero: matriz Need = Max - Allocation  (filas T0..T4, columnas A B C)
    110 => 7, 111 => 4, 112 => 3,     // T0: 753 - 010
    113 => 1, 114 => 2, 115 => 2,     // T1: 322 - 200
    116 => 6, 117 => 0, 118 => 0,     // T2: 902 - 302
    119 => 0, 120 => 1, 121 => 1,     // T3: 222 - 211
    122 => 4, 123 => 3, 124 => 1,     // T4: 433 - 002
    // Estado tras conceder Request1 = (1,0,2)
    130 => 2, 131 => 3, 132 => 0,     // Available nuevo
    133 => 3, 134 => 0, 135 => 2,     // Allocation de T1
    136 => 0, 137 => 2, 138 => 0,     // Need de T1
    // Detección: recursos totales 7 2 6 menos lo asignado
    141 => 0,   // Available de A en el ejemplo de detección
];

/* ---------- Funciones auxiliares ---------- */
function normalizar($t) {
    $t = trim((string)$t);
    $t = strtr($t, [
        'á'=>'a','é'=>'e','í'=>'i','ó'=>'o','ú'=>'u','ü'=>'u','ñ'=>'n',
        'Á'=>'a','É'=>'e','Í'=>'i','Ó'=>'o','Ú'=>'u','Ü'=>'u','Ñ'=>'n'
    ]);
    $t = strtolower($t);
    $t = trim($t, " \t\n\r\"'`.<>");
    $t = preg_replace('/\s+/', ' ', $t);
    $t = str_replace(' (', '(', $t);
    return $t;
}

function es_correcta($valor, $aceptadas) {
    foreach ($aceptadas as $a) {
        if (normalizar($valor) === normalizar($a)) {
            return true;
        }
    }
    return false;
}

function es_numero_correcto($valor, $esperado) {
    $v = str_replace([',', ' '], ['.', ''], trim((string)$valor));
    if (!is_numeric($v)) { return false; }
    $tol = max(0.001, abs($esperado) * 0.005);
    return abs((float)$v - $esperado) <= $tol;
}

function r($n) {
    return htmlspecialchars($GLOBALS["respuesta_" . $n], ENT_QUOTES, 'UTF-8');
}

function v($n) {
    $estado = $GLOBALS["verificar_" . $n];
    if ($estado === 'correcto')   { return '<span class="correcto">correcto</span> '; }
    if ($estado === 'incorrecto') { return '<span class="incorrecto">incorrecto</span> '; }
    return '';
}

function marca($n) {
    $estado = $GLOBALS["verificar_" . $n];
    if ($estado === 'correcto')   { return '<span class="ok">&#10003;</span>'; }
    if ($estado === 'incorrecto') { return '<span class="bad">&#10007;</span>'; }
    return '';
}

function chk($n, $valor) {
    return $GLOBALS["respuesta_" . $n] === $valor ? 'checked' : '';
}

function sel($n, $valor) {
    return $GLOBALS["respuesta_" . $n] === $valor ? 'selected' : '';
}

function libre($n) {
    return htmlspecialchars($GLOBALS["libre_" . $n], ENT_QUOTES, 'UTF-8');
}

/* celda numérica compacta para las matrices */
function celda($n) {
    return '<input type="text" name="respuesta_' . $n . '" value="' . r($n) . '" maxlength="2">' . marca($n);
}

/* select de hilo para las secuencias seguras */
function select_hilo($n) {
    $out = '<select name="respuesta_' . $n . '">';
    foreach (['', 'T0', 'T1', 'T2', 'T3', 'T4'] as $o) {
        $out .= '<option value="' . $o . '" ' . sel($n, $o) . '>' . ($o === '' ? '--' : $o) . '</option>';
    }
    return $out . '</select>';
}

/* ---------- Procesamiento ---------- */
$mostrar_solucion = '';
if ($_POST) {
    $mostrar_solucion = isset($_POST['mostrar_solucion']) ? trim($_POST['mostrar_solucion']) : '';

    for ($i = 1; $i <= 12; $i++) {
        ${"libre_" . $i} = isset($_POST["libre_$i"]) ? $_POST["libre_$i"] : '';
    }

    if ($mostrar_solucion === 'mostrar_solucion') {
        foreach ($claves as $n => $aceptadas) {
            ${"respuesta_$n"} = $aceptadas[0];
            ${"verificar_$n"} = "correcto";
        }
        foreach ($numericas as $n => $valor) {
            ${"respuesta_$n"} = (string)$valor;
            ${"verificar_$n"} = "correcto";
        }
    } else {
        foreach ($claves as $n => $aceptadas) {
            ${"respuesta_$n"} = isset($_POST["respuesta_$n"]) ? $_POST["respuesta_$n"] : '';
            if (trim(${"respuesta_$n"}) === '') {
                ${"verificar_$n"} = '';
            } elseif (es_correcta(${"respuesta_$n"}, $aceptadas)) {
                ${"verificar_$n"} = "correcto";
            } else {
                ${"verificar_$n"} = "incorrecto";
            }
        }
        foreach ($numericas as $n => $valor) {
            ${"respuesta_$n"} = isset($_POST["respuesta_$n"]) ? $_POST["respuesta_$n"] : '';
            if (trim(${"respuesta_$n"}) === '') {
                ${"verificar_$n"} = '';
            } elseif (es_numero_correcto(${"respuesta_$n"}, $valor)) {
                ${"verificar_$n"} = "correcto";
            } else {
                ${"verificar_$n"} = "incorrecto";
            }
        }
    }
}
$ver_sol = ($mostrar_solucion === 'mostrar_solucion');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capítulo 8 - Abrazos Mortales</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../style_2_0.css">

<style>
    body { font-family: Arial, sans-serif; background: #f5f7fb; margin: 0; padding: 20px; color: #1a202c; }
    .form-container { display: flex; gap: 15px; align-items: flex-start; }
    .seccion {
        width: calc(50% - 7.5px);
        padding: 20px; box-sizing: border-box; background: white;
        border-radius: 10px; box-shadow: 0 6px 16px rgba(0,0,0,0.08);
    }
    @media (max-width: 1100px) {
        .form-container { flex-direction: column; }
        .seccion { width: 100%; }
    }
    .ancho { padding: 20px; background: white; border-radius: 10px; box-shadow: 0 6px 16px rgba(0,0,0,0.08); margin-bottom: 15px; }

    h2 { font-size: 1.5rem; }
    h3 { font-size: 1.12rem; margin-top: 14px; }
    .enunciado { line-height: 1.6; }
    .opciones label { display: block; margin: 6px 0; cursor: pointer; }
    .correcto { color: #2f855a; font-weight: bold; }
    .incorrecto { color: #c53030; font-weight: bold; }
    .ok  { color: #2f855a; font-weight: bold; font-size: 0.75rem; display: block; line-height: 1; }
    .bad { color: #c53030; font-weight: bold; font-size: 0.75rem; display: block; line-height: 1; }

    input[type="text"], select, textarea { border: 1px solid #a0aec0; border-radius: 4px; padding: 2px 4px; font-size: 0.95rem; }
    code, .comando { font-family: Consolas, "Courier New", monospace; font-size: 0.93rem; }
    .comando {
        background: #1e1e2e; color: #e2e8f0; padding: 10px; border-radius: 6px;
        line-height: 2.1; overflow-x: auto;
    }
    .comando input[type="text"] {
        background: #2d3748; color: #fefcbf; border: 1px solid #718096;
        font-family: Consolas, "Courier New", monospace;
    }

    table.mat { border-collapse: collapse; margin: 8px 0; }
    table.mat th, table.mat td { border: 1px solid #cbd5e0; padding: 2px 4px; text-align: center; font-size: 0.88rem; }
    table.mat th { background: #edf2f7; }
    table.mat th.lbl { background: #e2e8f0; text-align: right; padding-right: 6px; }
    table.mat input { width: 30px; text-align: center; padding: 1px; }
    table.mat td.dato { background: #f7fafc; font-family: Consolas, monospace; }
    .matrices { display: flex; gap: 14px; flex-wrap: wrap; align-items: flex-start; }
    .matrices h5 { margin: 4px 0 0; font-size: 0.9rem; }

    .solucion {
        background: #f0fff4; border-left: 4px solid #38a169;
        padding: 8px 12px; margin: 10px 0; font-size: 0.92rem; line-height: 1.55;
    }
    .solucion pre { white-space: pre; margin: 4px 0; overflow-x: auto; font-size: 0.82rem; }
    .nota { background: #ebf8ff; border-left: 4px solid #3182ce; padding: 8px 12px; margin: 10px 0; font-size: 0.9rem; line-height: 1.55; }
    .idea { background: #fffaf0; border-left: 4px solid #dd6b20; padding: 8px 12px; margin: 10px 0; font-size: 0.9rem; line-height: 1.55; }
    textarea.libre { width: 100%; font-family: Consolas, "Courier New", monospace; }
    button { margin-top: 6px; }
    hr { margin: 18px 0; }
    .svgbox { background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; margin: 10px 0; padding: 4px; }
    .svgbox svg { width: 100%; height: auto; display: block; }
    .cap { font-size: 0.82rem; color: #4a5568; text-align: center; margin: 2px 0 6px; }
</style>

<script>
function handleSubmit(event) {
    event.preventDefault();
    const scroll = window.scrollY;
    const formData = new FormData(event.target);

    fetch(event.target.action, { method: 'POST', body: formData })
    .then(response => response.text())
    .then(html => {
        const doc = new DOMParser().parseFromString(html, 'text/html');
        document.body.innerHTML = doc.body.innerHTML;
        window.scrollTo(0, scroll);
    })
    .catch(error => { console.error('Error al enviar el formulario:', error); });
}
</script>

</head>
<body>

<form action="./index.php" method="POST" onsubmit="handleSubmit(event)" autocomplete="off">
<div class="form-container">

<!-- =====================================================  IZQUIERDA  ===================================================== -->
<div class="seccion izquierda">

<h2>Capítulo 8 &mdash; Abrazos Mortales (<i>Deadlocks</i>)</h2>
<p>Cuestionario de estudio sobre <b>Deadlocks</b> (Silberschatz, 10.ª ed.). Cubre las 7 preguntas de chequeo del
capítulo y añade el grafo de asignación, el algoritmo del banquero paso a paso y el de detección.</p>

<div class="idea">
<b>Cómo está armado el capítulo.</b> Primero se <i>caracteriza</i> el problema: cuatro condiciones que deben darse
<b>todas a la vez</b>. Luego aparecen tres estrategias, y la clave para no confundirlas es <b>cuánta información
exigen y cuándo actúan</b>:
<pre>PREVENCIÓN  -> ataca una de las 4 condiciones. No necesita saber nada del futuro. Rígida.
EVITACIÓN   -> deja las 4 condiciones en pie, pero exige declarar el MÁXIMO por adelantado
               y decide petición por petición. (Algoritmo del banquero.)
DETECCIÓN   -> no exige nada, deja que ocurra, lo descubre después y recupera.</pre>
Y hay una cuarta que es la que usan Linux y Windows: <b>ignorarlo</b>.
</div>
<hr>

<!-- ---------------- Pregunta 1 ---------------- -->
<h3>Pregunta 1 &mdash; el modelo del sistema (chequeo 1)</h3>
<p class="enunciado">¿En qué consiste el modelo de sistema para un abrazo mortal? Complete:</p>
<p>El sistema tiene recursos divididos en <input type="text" name="respuesta_4" value="<?php echo r(4); ?>" size="14"> <?php echo v(4) ?>
(o clases), cada uno con varias <input type="text" name="respuesta_5" value="<?php echo r(5); ?>" size="14"> <?php echo v(5) ?> idénticas
e intercambiables entre sí.</p>
<p class="enunciado">Y todo hilo usa un recurso en esta secuencia de tres pasos:</p>
<p>
1. <input type="text" name="respuesta_1" value="<?php echo r(1); ?>" size="14"> <?php echo v(1) ?> &rarr;
2. <input type="text" name="respuesta_2" value="<?php echo r(2); ?>" size="14"> <?php echo v(2) ?> &rarr;
3. <input type="text" name="respuesta_3" value="<?php echo r(3); ?>" size="14"> <?php echo v(3) ?>
</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
Recursos agrupados en <b>tipos</b>, cada tipo con varias <b>instancias</b> idénticas (ciclos de CPU, archivos,
dispositivos de E/S...). Secuencia: <b>solicitar &rarr; usar &rarr; liberar</b>.<br>
<b>Lo que hace que las instancias importen:</b> si un hilo pide una instancia de un tipo, <i>cualquiera</i> de ellas
debe satisfacerlo. Si no, están mal clasificadas en el mismo tipo. Esta sutileza es la que decide, más adelante, si
basta el grafo de asignación o hace falta el banquero.<br>
<b>Definición formal del estado:</b> un conjunto de hilos está en deadlock cuando <b>cada</b> hilo del conjunto espera
un evento que solo puede causar <b>otro hilo del mismo conjunto</b>.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 2 ---------------- -->
<h3>Pregunta 2 &mdash; las cuatro condiciones necesarias (chequeo 2)</h3>
<p class="enunciado">Nombre las cuatro condiciones a partir de su descripción:</p>
<p>
Al menos un recurso en modo <b>no compartible</b>: <input type="text" name="respuesta_6" value="<?php echo r(6); ?>" size="20"> <?php echo v(6) ?><br>
El hilo <b>retiene</b> al menos un recurso y <b>espera</b> otros: <input type="text" name="respuesta_7" value="<?php echo r(7); ?>" size="20"> <?php echo v(7) ?><br>
El recurso solo se libera <b>voluntariamente</b>, no se le puede quitar: <input type="text" name="respuesta_8" value="<?php echo r(8); ?>" size="20"> <?php echo v(8) ?><br>
Existe una cadena <code>T0&rarr;T1&rarr;...&rarr;Tn&rarr;T0</code> de esperas: <input type="text" name="respuesta_9" value="<?php echo r(9); ?>" size="20"> <?php echo v(9) ?>
</p>
<p class="enunciado">(Verdadero/Falso) Las cuatro condiciones deben cumplirse <b>simultáneamente</b> para que ocurra un abrazo mortal.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_10" value="Verdadero" <?php echo chk(10, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_10" value="Falso" <?php echo chk(10, 'Falso'); ?>> Falso</label>
</div>
<p class="enunciado">(Verdadero/Falso) Las cuatro condiciones <b>no</b> son del todo independientes: la espera circular
<i>implica</i> retener y esperar.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_11" value="Verdadero" <?php echo chk(11, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_11" value="Falso" <?php echo chk(11, 'Falso'); ?>> Falso</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(10) ?><?php echo v(11) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Exclusión mutua, retener y esperar, no preempción, espera circular.</b> Ambas afirmaciones son <b>Verdaderas</b>.<br>
<b>Por qué &laquo;simultáneamente&raquo; es la palabra clave:</b> si las cuatro son necesarias y deben darse a la vez,
entonces <b>romper una sola basta</b> para prevenir el deadlock. Toda la sección 8.5 es exactamente eso: cuatro intentos,
uno por condición.<br>
Aunque la espera circular implica retener y esperar, el libro las considera por separado porque <b>atacar cada una
da un protocolo distinto</b>, con costos distintos.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 3 ---------------- -->
<h3>Pregunta 3 &mdash; el grafo de asignación de recursos</h3>
<p class="enunciado">En el grafo, los hilos son <b>círculos</b>, los tipos de recurso son <b>rectángulos</b> y cada
instancia es un <b>punto</b> dentro del rectángulo. Nombre las dos clases de arista:</p>
<p>
<code>Ti &rarr; Rj</code> (el hilo pidió y espera): arista de <input type="text" name="respuesta_12" value="<?php echo r(12); ?>" size="14"> <?php echo v(12) ?><br>
<code>Rj &rarr; Ti</code> (la instancia ya se le dio): arista de <input type="text" name="respuesta_13" value="<?php echo r(13); ?>" size="14"> <?php echo v(13) ?>
</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
Arista de <b>solicitud</b> (<i>request</i>) y arista de <b>asignación</b> (<i>assignment</i>).<br>
<b>Detalle que suele preguntarse:</b> la arista de solicitud apunta al <i>rectángulo</i> completo (pide cualquier
instancia); la de asignación sale de un <i>punto concreto</i>. Cuando la solicitud se satisface, la arista de solicitud
se transforma <b>instantáneamente</b> en arista de asignación.
</div>
<?php endif; ?>

<div class="svgbox">
<svg viewBox="0 0 560 250" xmlns="http://www.w3.org/2000/svg">
  <rect x="1" y="1" width="558" height="248" fill="#ffffff" stroke="#cbd5e0"/>
  <defs>
    <marker id="a8" viewBox="0 0 10 10" refX="9" refY="5" markerWidth="8" markerHeight="8" orient="auto">
      <path d="M0 1L10 5L0 9Z" fill="#2d3748"/>
    </marker>
  </defs>
  <text x="140" y="22" font-size="12" text-anchor="middle" fill="#2f855a" font-family="Arial" font-weight="bold">SIN ciclo &rarr; sin deadlock</text>
  <text x="420" y="22" font-size="12" text-anchor="middle" fill="#c53030" font-family="Arial" font-weight="bold">CON ciclo &rarr; deadlock</text>
  <line x1="280" y1="35" x2="280" y2="240" stroke="#cbd5e0" stroke-dasharray="4 4"/>

  <!-- izquierda: sin ciclo -->
  <rect x="105" y="42" width="70" height="34" fill="#edf2f7" stroke="#4a5568"/>
  <text x="140" y="56" font-size="11" text-anchor="middle" fill="#2d3748" font-family="Arial">R1</text>
  <circle cx="140" cy="68" r="3.5" fill="#2d3748"/>

  <circle cx="75" cy="140" r="24" fill="#ebf8ff" stroke="#2b6cb0"/>
  <text x="75" y="145" font-size="12" text-anchor="middle" fill="#1a365d" font-family="Arial">T1</text>
  <circle cx="205" cy="140" r="24" fill="#ebf8ff" stroke="#2b6cb0"/>
  <text x="205" y="145" font-size="12" text-anchor="middle" fill="#1a365d" font-family="Arial">T2</text>

  <line x1="134" y1="72" x2="90" y2="118" stroke="#2f855a" stroke-width="1.6" marker-end="url(#a8)"/>
  <text x="90" y="100" font-size="9" fill="#2f855a" font-family="Arial">asigna</text>

  <rect x="105" y="196" width="70" height="34" fill="#edf2f7" stroke="#4a5568"/>
  <text x="140" y="210" font-size="11" text-anchor="middle" fill="#2d3748" font-family="Arial">R2</text>
  <circle cx="140" cy="222" r="3.5" fill="#718096"/>
  <line x1="196" y1="160" x2="160" y2="194" stroke="#2b6cb0" stroke-width="1.6" marker-end="url(#a8)"/>
  <text x="200" y="183" font-size="9" fill="#2b6cb0" font-family="Arial">pide</text>
  <text x="140" y="245" font-size="9.5" text-anchor="middle" fill="#4a5568" font-family="Arial">R2 está libre: se le puede dar a T2</text>

  <!-- derecha: con ciclo -->
  <rect x="385" y="42" width="70" height="34" fill="#edf2f7" stroke="#4a5568"/>
  <text x="420" y="56" font-size="11" text-anchor="middle" fill="#2d3748" font-family="Arial">R1</text>
  <circle cx="420" cy="68" r="3.5" fill="#2d3748"/>

  <circle cx="355" cy="140" r="24" fill="#fff5f5" stroke="#c53030"/>
  <text x="355" y="145" font-size="12" text-anchor="middle" fill="#742a2a" font-family="Arial">T1</text>
  <circle cx="485" cy="140" r="24" fill="#fff5f5" stroke="#c53030"/>
  <text x="485" y="145" font-size="12" text-anchor="middle" fill="#742a2a" font-family="Arial">T2</text>

  <line x1="414" y1="72" x2="370" y2="118" stroke="#c53030" stroke-width="1.8" marker-end="url(#a8)"/>
  <line x1="470" y1="124" x2="430" y2="76" stroke="#c53030" stroke-width="1.8" marker-end="url(#a8)"/>

  <rect x="385" y="196" width="70" height="34" fill="#edf2f7" stroke="#4a5568"/>
  <text x="420" y="210" font-size="11" text-anchor="middle" fill="#2d3748" font-family="Arial">R2</text>
  <circle cx="420" cy="222" r="3.5" fill="#2d3748"/>
  <line x1="370" y1="160" x2="408" y2="196" stroke="#c53030" stroke-width="1.8" marker-end="url(#a8)"/>
  <line x1="438" y1="208" x2="474" y2="162" stroke="#c53030" stroke-width="1.8" marker-end="url(#a8)"/>
  <text x="420" y="245" font-size="9.5" text-anchor="middle" fill="#c53030" font-family="Arial">T1&rarr;R2&rarr;T2&rarr;R1&rarr;T1 : espera circular</text>
</svg>
</div>
<p class="cap">Grafo de asignación de recursos. Con <b>una instancia por tipo</b>, el ciclo basta para diagnosticar.</p>

<p class="enunciado">(Verdadero/Falso) Si el grafo contiene un ciclo, <b>siempre</b> hay un abrazo mortal.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_14" value="Verdadero" <?php echo chk(14, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_14" value="Falso" <?php echo chk(14, 'Falso'); ?>> Falso</label>
</div>
<p class="enunciado">(Verdadero/Falso) Si cada tipo de recurso tiene <b>una sola instancia</b>, entonces un ciclo
equivale a un abrazo mortal.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_15" value="Verdadero" <?php echo chk(15, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_15" value="Falso" <?php echo chk(15, 'Falso'); ?>> Falso</label>
</div>
<p class="enunciado">Dicho de otro modo: la existencia de un ciclo es condición
<input type="text" name="respuesta_16" value="<?php echo r(16); ?>" size="12"> <?php echo v(16) ?>
pero no suficiente cuando hay varias instancias por tipo.</p>
<button type="submit">Enviar</button>
<?php echo v(14) ?><?php echo v(15) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
Primera: <b>Falso</b>. Segunda: <b>Verdadero</b>. El ciclo es condición <b>necesaria</b>, no suficiente.<br>
<b>La intuición:</b> con varias instancias, un hilo del ciclo puede ser rescatado por una instancia que libere un hilo
<i>fuera</i> del ciclo, y la cadena se rompe. Con una sola instancia por tipo no hay rescate posible.<br>
<b>Consecuencia práctica (y es la razón de ser del banquero):</b> el algoritmo del grafo solo vale para una instancia
por tipo. Para varias instancias hay que contar recursos, no buscar ciclos.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 4 ---------------- -->
<h3>Pregunta 4 &mdash; el primo del deadlock</h3>
<p class="enunciado">El fallo de vivacidad en el que los hilos <b>sí están ejecutando</b> instrucciones (con
<code>trylock</code>, reintentando) pero nunca progresan porque se estorban indefinidamente se llama
<input type="text" name="respuesta_17" value="<?php echo r(17); ?>" size="14"> <?php echo v(17) ?>.</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Livelock.</b> Diferencia con deadlock: en un <b>deadlock</b> los hilos están <i>bloqueados</i> (estado de espera, sin
consumir CPU); en un <b>livelock</b> están <i>corriendo</i> y quemando CPU, pero sin avanzar. Analogía del libro: dos
personas que se cruzan en un pasillo y se apartan al mismo lado una y otra vez.<br>
Suele aparecer al usar <code>pthread_mutex_trylock()</code> con reintento inmediato; <b>se mitiga con esperas
aleatorias</b> antes de reintentar.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 5 ---------------- -->
<h3>Pregunta 5 &mdash; las tres estrategias (chequeo 3)</h3>
<p class="enunciado">¿Cuáles son las tres estrategias para manejar un abrazo mortal?</p>
<p>
1. <input type="text" name="respuesta_18" value="<?php echo r(18); ?>" size="24"> <?php echo v(18) ?> &rarr; fingir que nunca ocurren.<br>
2. <input type="text" name="respuesta_19" value="<?php echo r(19); ?>" size="24"> <?php echo v(19) ?> &rarr; garantizar que el sistema nunca entre en ese estado.<br>
3. <input type="text" name="respuesta_20" value="<?php echo r(20); ?>" size="24"> <?php echo v(20) ?> &rarr; dejar que ocurra, detectarlo y salir de él.
</p>
<p class="enunciado">¿Cuál emplean la mayoría de los sistemas operativos, incluidos Linux y Windows?</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_21" value="a" <?php echo chk(21, 'a'); ?>> a. Detección y recuperación automática</label>
    <label><input type="radio" name="respuesta_21" value="b" <?php echo chk(21, 'b'); ?>> b. Ignorar el problema y dejarlo a los desarrolladores</label>
    <label><input type="radio" name="respuesta_21" value="c" <?php echo chk(21, 'c'); ?>> c. El algoritmo del banquero en el kernel</label>
    <label><input type="radio" name="respuesta_21" value="d" <?php echo chk(21, 'd'); ?>> d. Orden total obligatorio de todos los cerrojos</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(21) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Ignorarlo</b>, <b>prevenir o evitar</b>, <b>detectar y recuperar</b>; y la respuesta es <b>b</b>.<br>
<b>Por qué ignorarlo es defendible:</b> es más <i>barato</i> que las alternativas, y en muchos sistemas los deadlocks
ocurren raramente (del orden de una vez al mes). El costo de las otras técnicas no se justifica. Queda en manos de los
desarrolladores de kernel y de aplicaciones escribir código que los evite (normalmente con orden de cerrojos).<br>
<b>Quién sí usa la tercera:</b> las <b>bases de datos</b>. Buscan ciclos en el grafo de espera periódicamente, eligen una
transacción víctima, la abortan y hacen <i>rollback</i>, liberando sus cerrojos, y luego la reintentan. MySQL procura
elegir la transacción que afecta menos filas.<br>
<b>El peligro de ignorarlo sin herramientas:</b> el sistema queda en deadlock sin poder reconocerlo, el rendimiento se
degrada mientras más hilos se van sumando al bloqueo, y al final hay que <b>reiniciar a mano</b>.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 6 ---------------- -->
<h3>Pregunta 6 &mdash; la única prevención práctica (chequeo 4)</h3>
<p class="enunciado">¿Cuál es la <b>única</b> condición razonable que se puede emplear para evitar que ocurran abrazos mortales?</p>
<p><input type="text" name="respuesta_22" value="<?php echo r(22); ?>" size="22"> <?php echo v(22) ?></p>
<p class="enunciado">El protocolo consiste en imponer un <input type="text" name="respuesta_23" value="<?php echo r(23); ?>" size="16"> <?php echo v(23) ?>
de todos los tipos de recurso mediante una función <code>F: R &rarr; N</code>, y exigir que cada hilo los solicite en
orden <input type="text" name="respuesta_24" value="<?php echo r(24); ?>" size="14"> <?php echo v(24) ?> de enumeración.</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
La <b>espera circular</b>: se rompe imponiendo un <b>orden total</b> de los recursos y pidiéndolos siempre en orden
<b>creciente</b>.<br>
<b>La demostración (por contradicción), que es lo elegante del capítulo:</b> si existiera una espera circular
<code>{T0,...,Tn}</code> donde <code>Ti</code> espera <code>Ri</code> que tiene <code>Ti+1</code>, como cada hilo
retiene <code>Ri</code> mientras pide <code>Ri+1</code>, tendría que valer <code>F(Ri) &lt; F(Ri+1)</code> para todo
<code>i</code>. Encadenando: <code>F(R0) &lt; F(R1) &lt; ... &lt; F(Rn) &lt; F(R0)</code>, o sea
<b><code>F(R0) &lt; F(R0)</code></b>, que es imposible. Por tanto no puede haber espera circular.<br>
<b>Caso práctico del libro:</b> con <code>F(first_mutex)=1</code> y <code>F(second_mutex)=5</code>, todo hilo que
necesite ambos debe pedir primero <code>first_mutex</code>. Muchos desarrolladores de Java usan
<code>System.identityHashCode(Object)</code> como función de orden.
</div>
<?php endif; ?>

<p class="enunciado">(Verdadero/Falso) Imponer un orden de cerrojos <b>garantiza por sí solo</b> la prevención del deadlock.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_27" value="Verdadero" <?php echo chk(27, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_27" value="Falso" <?php echo chk(27, 'Falso'); ?>> Falso</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(27) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Falso</b>, y es un punto fino que el libro subraya dos veces. Primero, <b>el orden no se impone solo</b>: depende de
que los programadores lo respeten, y con cientos o miles de cerrojos es difícil. Segundo, y más grave:
<b>si los cerrojos se adquieren dinámicamente el orden no garantiza nada</b>. El ejemplo del libro es una función de
transferencia entre dos cuentas: dos hilos que la invocan con los argumentos <i>invertidos</i> bloquean en orden
contrario, aunque el código &laquo;respete el orden&raquo;.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 7 ---------------- -->
<h3>Pregunta 7 &mdash; por qué fallan las otras tres</h3>
<p class="enunciado">La <b>exclusión mutua</b> no se puede negar en general porque algunos recursos son
intrínsecamente no compartibles (un mutex). Solo los recursos
<input type="text" name="respuesta_25" value="<?php echo r(25); ?>" size="16"> <?php echo v(25) ?>
(como un archivo de solo lectura) quedan fuera del problema.</p>
<p class="enunciado">Negar <b>retener y esperar</b> (pedir todo de una vez al inicio) baja la utilización de recursos y
además abre la puerta a la <input type="text" name="respuesta_26" value="<?php echo r(26); ?>" size="14"> <?php echo v(26) ?>.</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
Recursos <b>compartibles</b>; e <b>inanición</b> (<i>starvation</i>).<br>
<b>Resumen de los cuatro intentos de prevención:</b>
<pre>1. Exclusión mutua -> IMPOSIBLE de negar: un mutex no se comparte, por definición.
2. Retener y esperar -> se puede, con dos protocolos (pedir todo al inicio; o liberar
   todo antes de pedir más), pero: baja utilización + INANICIÓN.
3. No preempción -> se puede quitar recursos al que espera. Sirve para registros de CPU
   y transacciones de BD (estado fácil de guardar y restaurar), pero NO para mutex ni
   semáforos, que es justo donde más ocurren los deadlocks.
4. Espera circular -> orden total. LA ÚNICA PRÁCTICA.</pre>
Fíjese en la <b>ironía de la tercera</b>: la preempción funciona exactamente donde el problema no aparece, y falla
donde sí aparece.
</div>
<?php endif; ?>
<p>Explique con sus palabras por qué la espera circular es la única atacable (práctica libre):</p>
<textarea class="libre" name="libre_1" rows="3"><?php echo libre(1); ?></textarea>

</div>

<!-- =====================================================  DERECHA  ===================================================== -->
<div class="seccion derecha">

<h2>Evitación, banquero, detección y recuperación</h2>
<div class="idea">
<b>El salto conceptual de la evitación.</b> La prevención es rígida porque no sabe nada del futuro. La evitación pide
una sola pieza de información &mdash; el <b>máximo</b> que cada hilo podría llegar a necesitar &mdash; y con eso puede
dejar las cuatro condiciones en pie y decidir, <b>petición por petición</b>, si conceder o hacer esperar.
El criterio de decisión es uno solo: <b>¿el estado resultante sigue siendo seguro?</b>
</div>
<hr>

<!-- ---------------- Pregunta 8 ---------------- -->
<h3>Pregunta 8 &mdash; estado seguro (chequeo 5)</h3>
<p class="enunciado">¿Cuál es el estado del sistema en el que los recursos se pueden asignar a todos los procesos en
cierto orden, y aún así evitar los abrazos mortales?</p>
<p><input type="text" name="respuesta_28" value="<?php echo r(28); ?>" size="20"> <?php echo v(28) ?></p>
<p class="enunciado">Y el orden que lo demuestra se llama
<input type="text" name="respuesta_29" value="<?php echo r(29); ?>" size="20"> <?php echo v(29) ?>.</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Estado seguro</b>, y el orden es una <b>secuencia segura</b>.<br>
<b>Definición formal:</b> <code>&lt;T1, T2, ..., Tn&gt;</code> es segura si, para cada <code>Ti</code>, lo que
<code>Ti</code> todavía puede pedir se satisface con los recursos <b>disponibles ahora</b> más los que retienen
<b>todos los Tj con j &lt; i</b>. Es decir: cada hilo puede esperar a que terminen los anteriores, y entonces
completarse y devolver todo.
</div>
<?php endif; ?>

<p class="enunciado">(Verdadero/Falso) Un estado con abrazo mortal es un estado <b>inseguro</b>.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_43" value="Verdadero" <?php echo chk(43, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_43" value="Falso" <?php echo chk(43, 'Falso'); ?>> Falso</label>
</div>
<p class="enunciado">(Verdadero/Falso) <b>Todo</b> estado inseguro es un abrazo mortal.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_44" value="Verdadero" <?php echo chk(44, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_44" value="Falso" <?php echo chk(44, 'Falso'); ?>> Falso</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(43) ?><?php echo v(44) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Verdadero</b> y <b>Falso</b>, respectivamente. La relación es de <b>inclusión estricta</b>:
<code>deadlock &sub; inseguro</code>. Un estado inseguro <i>puede</i> llevar a deadlock, pero no necesariamente;
<b>depende del comportamiento de los hilos</b>, y eso es justo lo que el SO no controla. Por eso la evitación se
conforma con <b>mantenerse siempre dentro de lo seguro</b>: es una condición más fuerte de lo estrictamente
necesario, y el precio que paga es <b>menor utilización de recursos</b> (a veces hace esperar a un hilo aunque
el recurso esté libre).
</div>
<?php endif; ?>

<div class="svgbox">
<svg viewBox="0 0 560 200" xmlns="http://www.w3.org/2000/svg">
  <rect x="1" y="1" width="558" height="198" fill="#ffffff" stroke="#cbd5e0"/>
  <ellipse cx="280" cy="105" rx="235" ry="80" fill="#fffaf0" stroke="#dd6b20" stroke-width="1.6"/>
  <text x="440" y="60" font-size="13" fill="#7b341e" font-family="Arial" font-weight="bold">inseguro</text>
  <ellipse cx="175" cy="110" rx="105" ry="55" fill="#fff5f5" stroke="#c53030" stroke-width="1.6"/>
  <text x="175" y="115" font-size="13" text-anchor="middle" fill="#742a2a" font-family="Arial" font-weight="bold">deadlock</text>
  <ellipse cx="400" cy="120" rx="95" ry="48" fill="#f0fff4" stroke="#2f855a" stroke-width="1.6"/>
  <text x="400" y="125" font-size="13" text-anchor="middle" fill="#22543d" font-family="Arial" font-weight="bold">seguro</text>
  <text x="280" y="193" font-size="10" text-anchor="middle" fill="#4a5568" font-family="Arial">La evitación mantiene al sistema dentro de la elipse verde: nunca sale de &laquo;seguro&raquo;</text>
</svg>
</div>
<p class="cap">Figura 8.8 &mdash; espacios de estados seguro, inseguro y con deadlock.</p>

<p class="enunciado">Ejemplo del libro: <b>12 recursos</b> y tres hilos. Complete la necesidad restante
(<code>Max &minus; Asignado</code>) y los recursos libres:</p>
<table class="mat">
<tr><th class="lbl"></th><th>Max</th><th>Asignado</th><th>Necesita aún</th></tr>
<tr><th class="lbl">T0</th><td class="dato">10</td><td class="dato">5</td><td><?php echo celda(101); ?></td></tr>
<tr><th class="lbl">T1</th><td class="dato">4</td><td class="dato">2</td><td><?php echo celda(102); ?></td></tr>
<tr><th class="lbl">T2</th><td class="dato">9</td><td class="dato">2</td><td><?php echo celda(103); ?></td></tr>
<tr><th class="lbl">libres</th><td colspan="2" class="dato">12 &minus; 9 =</td><td><?php echo celda(104); ?></td></tr>
</table>
<p class="enunciado">Secuencia segura:
&lt; <?php echo select_hilo(30); ?><?php echo v(30) ?>,
<?php echo select_hilo(31); ?><?php echo v(31) ?>,
<?php echo select_hilo(32); ?><?php echo v(32) ?> &gt;</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
Necesidades <b>5, 2, 7</b> y <b>3</b> libres. Secuencia segura: <b>&lt;T1, T0, T2&gt;</b>.
<pre>libres=3  -> T1 necesita 2 <= 3 : corre y devuelve sus 2 + los 3  -> libres = 5
libres=5  -> T0 necesita 5 <= 5 : corre y devuelve sus 5 + los 5  -> libres = 10
libres=10 -> T2 necesita 7 <= 10: corre y devuelve todo           -> libres = 12  OK</pre>
<b>Y aquí está la lección del ejemplo:</b> si en ese punto <b>T2 pide un recurso más</b> y se le concede, el estado deja
de ser seguro. Solo T1 podría completarse, dejando 4 libres; T0 necesitaría 5 y T2 necesitaría 6, y ambos quedarían
esperando: <b>deadlock</b>. El error fue <i>conceder</i> esa petición, aunque el recurso estuviera disponible.
</div>
<?php endif; ?>

<p class="enunciado">Para el caso de <b>una sola instancia</b> por tipo, el grafo de asignación se extiende con una
arista nueva, dibujada con línea punteada, que indica que un hilo <i>podría</i> pedir ese recurso en el futuro:
la arista de <input type="text" name="respuesta_45" value="<?php echo r(45); ?>" size="14"> <?php echo v(45) ?>.</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
Arista de <b>claim</b> (reclamo). Los reclamos deben declararse <b>a priori</b>, antes de que el hilo arranque.
La petición se concede solo si convertir la arista de solicitud en arista de asignación <b>no crea un ciclo</b>
(detección de ciclos, del orden de <code>n&sup2;</code>). Ejemplo del libro: aunque R2 esté libre, no se le da a T2
porque crearía un ciclo &rarr; estado inseguro.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 9 ---------------- -->
<h3>Pregunta 9 &mdash; el algoritmo del banquero (chequeo 6)</h3>
<p class="enunciado">Describa su propósito y filosofía. Primero, las cuatro estructuras de datos:</p>
<p>
Vector de longitud <code>m</code> con lo disponible de cada tipo: <input type="text" name="respuesta_47" value="<?php echo r(47); ?>" size="14"> <?php echo v(47) ?><br>
Matriz <code>n&times;m</code> con la demanda máxima declarada: <input type="text" name="respuesta_48" value="<?php echo r(48); ?>" size="14"> <?php echo v(48) ?><br>
Matriz <code>n&times;m</code> con lo que cada hilo tiene ahora: <input type="text" name="respuesta_49" value="<?php echo r(49); ?>" size="14"> <?php echo v(49) ?><br>
Matriz <code>n&times;m</code> con lo que le falta a cada hilo: <input type="text" name="respuesta_46" value="<?php echo r(46); ?>" size="14"> <?php echo v(46) ?>
</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Available, Max, Allocation, Need</b>, con <code><b>Need = Max &minus; Allocation</b></code>.<br>
<b>La filosofía y el nombre:</b> un banco no debe comprometer su efectivo de modo que ya no pueda satisfacer las
necesidades de <i>todos</i> sus clientes. Igual el SO: cuando un hilo entra, <b>declara su máximo</b> (que no puede
exceder el total del sistema); cuando pide recursos, el sistema <b>simula</b> la concesión y solo la hace efectiva si
el estado resultante es seguro.<br>
<b>Dos algoritmos, no uno</b> &mdash; y confundirlos es el error típico:<br>
&bull; <b>Algoritmo de seguridad</b>: responde &laquo;¿este estado es seguro?&raquo;. Usa <code>Work</code> (inicializado
a <code>Available</code>) y <code>Finish</code>; busca un <code>i</code> con <code>Need_i &le; Work</code>, hace
<code>Work += Allocation_i</code>, marca <code>Finish[i]=true</code> y repite. Es <code>O(m&times;n&sup2;)</code>.<br>
&bull; <b>Algoritmo de petición de recursos</b>: responde &laquo;¿concedo esta petición?&raquo;. Verifica
<code>Request_i &le; Need_i</code> (si no, <b>error</b>: excedió su máximo declarado) y
<code>Request_i &le; Available</code> (si no, <b>espera</b>); luego <i>finge</i> la asignación y llama al algoritmo de
seguridad. Si el resultado es inseguro, <b>restaura el estado anterior</b> y el hilo espera.
</div>
<?php endif; ?>

<p class="enunciado"><b>Ejemplo completo.</b> Cinco hilos (T0&ndash;T4) y tres tipos: <code>A</code> (10 instancias),
<code>B</code> (5), <code>C</code> (7). Calcule <code>Need = Max &minus; Allocation</code>:</p>
<div class="matrices">
<div>
<h5>Allocation</h5>
<table class="mat">
<tr><th class="lbl"></th><th>A</th><th>B</th><th>C</th></tr>
<tr><th class="lbl">T0</th><td class="dato">0</td><td class="dato">1</td><td class="dato">0</td></tr>
<tr><th class="lbl">T1</th><td class="dato">2</td><td class="dato">0</td><td class="dato">0</td></tr>
<tr><th class="lbl">T2</th><td class="dato">3</td><td class="dato">0</td><td class="dato">2</td></tr>
<tr><th class="lbl">T3</th><td class="dato">2</td><td class="dato">1</td><td class="dato">1</td></tr>
<tr><th class="lbl">T4</th><td class="dato">0</td><td class="dato">0</td><td class="dato">2</td></tr>
</table>
</div>
<div>
<h5>Max</h5>
<table class="mat">
<tr><th class="lbl"></th><th>A</th><th>B</th><th>C</th></tr>
<tr><th class="lbl">T0</th><td class="dato">7</td><td class="dato">5</td><td class="dato">3</td></tr>
<tr><th class="lbl">T1</th><td class="dato">3</td><td class="dato">2</td><td class="dato">2</td></tr>
<tr><th class="lbl">T2</th><td class="dato">9</td><td class="dato">0</td><td class="dato">2</td></tr>
<tr><th class="lbl">T3</th><td class="dato">2</td><td class="dato">2</td><td class="dato">2</td></tr>
<tr><th class="lbl">T4</th><td class="dato">4</td><td class="dato">3</td><td class="dato">3</td></tr>
</table>
</div>
<div>
<h5>Need (complete)</h5>
<table class="mat">
<tr><th class="lbl"></th><th>A</th><th>B</th><th>C</th></tr>
<tr><th class="lbl">T0</th><td><?php echo celda(110); ?></td><td><?php echo celda(111); ?></td><td><?php echo celda(112); ?></td></tr>
<tr><th class="lbl">T1</th><td><?php echo celda(113); ?></td><td><?php echo celda(114); ?></td><td><?php echo celda(115); ?></td></tr>
<tr><th class="lbl">T2</th><td><?php echo celda(116); ?></td><td><?php echo celda(117); ?></td><td><?php echo celda(118); ?></td></tr>
<tr><th class="lbl">T3</th><td><?php echo celda(119); ?></td><td><?php echo celda(120); ?></td><td><?php echo celda(121); ?></td></tr>
<tr><th class="lbl">T4</th><td><?php echo celda(122); ?></td><td><?php echo celda(123); ?></td><td><?php echo celda(124); ?></td></tr>
</table>
</div>
<div>
<h5>Available</h5>
<table class="mat">
<tr><th>A</th><th>B</th><th>C</th></tr>
<tr><td class="dato">3</td><td class="dato">3</td><td class="dato">2</td></tr>
</table>
</div>
</div>
<button type="submit">Enviar</button>

<p class="enunciado">Ejecute el <b>algoritmo de seguridad</b> y escriba la secuencia segura:</p>
<p>&lt; <?php echo select_hilo(33); ?><?php echo v(33) ?>,
<?php echo select_hilo(34); ?><?php echo v(34) ?>,
<?php echo select_hilo(35); ?><?php echo v(35) ?>,
<?php echo select_hilo(36); ?><?php echo v(36) ?>,
<?php echo select_hilo(37); ?><?php echo v(37) ?> &gt;</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Need</b> = <code>T0:743 · T1:122 · T2:600 · T3:011 · T4:431</code>.
Secuencia segura: <b>&lt;T1, T3, T4, T2, T0&gt;</b>.
<pre>Work = Available = (3,3,2)
T1: Need(1,2,2) <= (3,3,2)  OK -> Work += Alloc(2,0,0) = (5,3,2)
T3: Need(0,1,1) <= (5,3,2)  OK -> Work += Alloc(2,1,1) = (7,4,3)
T4: Need(4,3,1) <= (7,4,3)  OK -> Work += Alloc(0,0,2) = (7,4,5)
T2: Need(6,0,0) <= (7,4,5)  OK -> Work += Alloc(3,0,2) = (10,4,7)
T0: Need(7,4,3) <= (10,4,7) OK -> Work += Alloc(0,1,0) = (10,5,7)
Finish[i] == true para todo i  =>  ESTADO SEGURO</pre>
<b>Nota:</b> la secuencia segura <b>no es única</b>; basta <i>una</i> para declarar el estado seguro.
Observe también cómo el total vuelve a <code>(10,5,7)</code>: eso confirma que no se perdió nada en el camino.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 10 ---------------- -->
<h3>Pregunta 10 &mdash; conceder o no conceder</h3>
<p class="enunciado">Desde ese estado, <b>T1 pide</b> <code>Request1 = (1, 0, 2)</code>. Verifique
<code>Request1 &le; Need1</code> &rarr; <code>(1,0,2) &le; (1,2,2)</code> &#10003; y
<code>Request1 &le; Available</code> &rarr; <code>(1,0,2) &le; (3,3,2)</code> &#10003;.
Ahora <b>finja</b> la asignación y complete el nuevo estado:</p>
<div class="matrices">
<div>
<h5>Available nuevo</h5>
<table class="mat">
<tr><th>A</th><th>B</th><th>C</th></tr>
<tr><td><?php echo celda(130); ?></td><td><?php echo celda(131); ?></td><td><?php echo celda(132); ?></td></tr>
</table>
</div>
<div>
<h5>Allocation de T1</h5>
<table class="mat">
<tr><th>A</th><th>B</th><th>C</th></tr>
<tr><td><?php echo celda(133); ?></td><td><?php echo celda(134); ?></td><td><?php echo celda(135); ?></td></tr>
</table>
</div>
<div>
<h5>Need de T1</h5>
<table class="mat">
<tr><th>A</th><th>B</th><th>C</th></tr>
<tr><td><?php echo celda(136); ?></td><td><?php echo celda(137); ?></td><td><?php echo celda(138); ?></td></tr>
</table>
</div>
</div>
<p class="enunciado">Y la nueva secuencia segura:
&lt; <?php echo select_hilo(38); ?><?php echo v(38) ?>,
<?php echo select_hilo(39); ?><?php echo v(39) ?>,
<?php echo select_hilo(40); ?><?php echo v(40) ?>,
<?php echo select_hilo(41); ?><?php echo v(41) ?>,
<?php echo select_hilo(42); ?><?php echo v(42) ?> &gt;</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<pre>Available = (3,3,2) - (1,0,2) = (2,3,0)
Allocation_1 = (2,0,0) + (1,0,2) = (3,0,2)
Need_1       = (1,2,2) - (1,0,2) = (0,2,0)</pre>
Nueva secuencia segura: <b>&lt;T1, T3, T4, T0, T2&gt;</b> &rarr; el estado es seguro, así que la petición
<b>se concede de inmediato</b>.
<pre>Work = (2,3,0)
T1: Need(0,2,0) <= (2,3,0)  OK -> Work = (2,3,0)+(3,0,2) = (5,3,2)
T3: Need(0,1,1) <= (5,3,2)  OK -> Work = (5,3,2)+(2,1,1) = (7,4,3)
T4: Need(4,3,1) <= (7,4,3)  OK -> Work = (7,4,3)+(0,0,2) = (7,4,5)
T0: Need(7,4,3) <= (7,4,5)  OK -> Work = (7,4,5)+(0,1,0) = (7,5,5)
T2: Need(6,0,0) <= (7,5,5)  OK -> Work = (7,5,5)+(3,0,2) = (10,5,7)</pre>
<b>Compare con la secuencia anterior:</b> cambió el orden del final (T0 antes de T2). Conceder recursos
<i>reordena</i> qué hilos pueden completarse primero.
</div>
<?php endif; ?>

<p class="enunciado">Desde ese <b>nuevo</b> estado, decida qué pasa con cada petición:</p>
<p><b>T4 pide (3,3,0):</b></p>
<div class="opciones">
    <label><input type="radio" name="respuesta_50" value="a" <?php echo chk(50, 'a'); ?>> a. Se concede: el estado resultante es seguro</label>
    <label><input type="radio" name="respuesta_50" value="b" <?php echo chk(50, 'b'); ?>> b. Debe esperar: los recursos no están disponibles</label>
    <label><input type="radio" name="respuesta_50" value="c" <?php echo chk(50, 'c'); ?>> c. Debe esperar: hay recursos, pero el estado resultante sería inseguro</label>
    <label><input type="radio" name="respuesta_50" value="d" <?php echo chk(50, 'd'); ?>> d. Error: excede su máximo declarado</label>
</div>
<p><b>T0 pide (0,2,0):</b></p>
<div class="opciones">
    <label><input type="radio" name="respuesta_51" value="a" <?php echo chk(51, 'a'); ?>> a. Se concede: el estado resultante es seguro</label>
    <label><input type="radio" name="respuesta_51" value="b" <?php echo chk(51, 'b'); ?>> b. Debe esperar: los recursos no están disponibles</label>
    <label><input type="radio" name="respuesta_51" value="c" <?php echo chk(51, 'c'); ?>> c. Debe esperar: hay recursos, pero el estado resultante sería inseguro</label>
    <label><input type="radio" name="respuesta_51" value="d" <?php echo chk(51, 'd'); ?>> d. Error: excede su máximo declarado</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(50) ?><?php echo v(51) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>T4 pide (3,3,0) &rarr; b.</b> <code>Available = (2,3,0)</code> y <code>3 &gt; 2</code> en el recurso A:
falla en el <b>paso 2</b> del algoritmo de petición. No hay con qué, punto.<br>
<b>T0 pide (0,2,0) &rarr; c.</b> Aquí está la pregunta interesante: <code>(0,2,0) &le; (2,3,0)</code>, los recursos
<b>sí están disponibles</b>, y <code>(0,2,0) &le; Need0 = (7,4,3)</code>. Pero si se concede,
<code>Available</code> quedaría en <code>(2,1,0)</code> y <b>ningún</b> hilo podría completarse: estado inseguro.
<b>El hilo espera aunque el recurso esté libre.</b><br>
<b>Esa es la diferencia esencial entre b y c, y es lo que distingue la evitación de la simple contabilidad:</b>
tener el recurso no es razón suficiente para darlo.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 11 ---------------- -->
<h3>Pregunta 11 &mdash; detección</h3>
<p class="enunciado">Si cada tipo tiene <b>una sola instancia</b>, se usa una versión colapsada del grafo (solo hilos,
con <code>Ti &rarr; Tj</code> si <code>Ti</code> espera algo que tiene <code>Tj</code>): el grafo
<input type="text" name="respuesta_52" value="<?php echo r(52); ?>" size="14"> <?php echo v(52) ?>,
y se busca un ciclo en él.</p>
<p class="enunciado">Con <b>varias instancias</b>, el algoritmo es casi el del banquero, pero cambiando la matriz
<code>Need</code> por la matriz <input type="text" name="respuesta_53" value="<?php echo r(53); ?>" size="14"> <?php echo v(53) ?>.</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
Grafo de <b>wait-for</b> (de espera) y matriz <b>Request</b>.<br>
<b>La diferencia conceptual con el banquero, que es lo que hay que entender:</b> el banquero usa <code>Need</code>
(lo que el hilo <i>podría llegar</i> a pedir) y es <b>pesimista</b>: se protege del peor caso futuro. La detección usa
<code>Request</code> (lo que el hilo <i>está pidiendo ahora</i>) y es <b>optimista</b>: asume que un hilo que puede
avanzar no pedirá más y devolverá todo. Si esa suposición falla, el deadlock se detectará en la próxima pasada.<br>
<b>Otra diferencia:</b> en la inicialización, <code>Finish[i] = true</code> si <code>Allocation_i = 0</code>
(un hilo sin recursos no puede ser parte de un deadlock).
</div>
<?php endif; ?>

<p class="enunciado">Ejemplo: cinco hilos, <code>A</code>=7, <code>B</code>=2, <code>C</code>=6 instancias.</p>
<div class="matrices">
<div>
<h5>Allocation</h5>
<table class="mat">
<tr><th class="lbl"></th><th>A</th><th>B</th><th>C</th></tr>
<tr><th class="lbl">T0</th><td class="dato">0</td><td class="dato">1</td><td class="dato">0</td></tr>
<tr><th class="lbl">T1</th><td class="dato">2</td><td class="dato">0</td><td class="dato">0</td></tr>
<tr><th class="lbl">T2</th><td class="dato">3</td><td class="dato">0</td><td class="dato">3</td></tr>
<tr><th class="lbl">T3</th><td class="dato">2</td><td class="dato">1</td><td class="dato">1</td></tr>
<tr><th class="lbl">T4</th><td class="dato">0</td><td class="dato">0</td><td class="dato">2</td></tr>
</table>
</div>
<div>
<h5>Request</h5>
<table class="mat">
<tr><th class="lbl"></th><th>A</th><th>B</th><th>C</th></tr>
<tr><th class="lbl">T0</th><td class="dato">0</td><td class="dato">0</td><td class="dato">0</td></tr>
<tr><th class="lbl">T1</th><td class="dato">2</td><td class="dato">0</td><td class="dato">2</td></tr>
<tr><th class="lbl">T2</th><td class="dato">0</td><td class="dato">0</td><td class="dato">0</td></tr>
<tr><th class="lbl">T3</th><td class="dato">1</td><td class="dato">0</td><td class="dato">0</td></tr>
<tr><th class="lbl">T4</th><td class="dato">0</td><td class="dato">0</td><td class="dato">2</td></tr>
</table>
</div>
<div>
<h5>Available</h5>
<table class="mat">
<tr><th>A</th><th>B</th><th>C</th></tr>
<tr><td><?php echo celda(141); ?></td><td class="dato">0</td><td class="dato">0</td></tr>
</table>
</div>
</div>
<p class="enunciado">(Verdadero/Falso) Si ahora <b>T2 pide una instancia más de C</b> (su <code>Request</code> pasa a
<code>(0,0,1)</code>), el sistema <b>sigue sin</b> estar en abrazo mortal.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_54" value="Verdadero" <?php echo chk(54, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_54" value="Falso" <?php echo chk(54, 'Falso'); ?>> Falso</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(54) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<code>Available = (0, 0, 0)</code>; y la afirmación es <b>Falsa</b>: <b>sí queda en deadlock</b>.<br>
<b>Antes de la petición</b> (<code>Request2 = 000</code>) el sistema está bien: la secuencia
<b>&lt;T0, T2, T3, T1, T4&gt;</b> termina con <code>Finish[i]=true</code> para todos.
<pre>Work=(0,0,0): T0 pide (0,0,0) <= Work  OK -> Work = (0,1,0)
              T2 pide (0,0,0) <= Work  OK -> Work = (3,1,3)
              T3 pide (1,0,0) <= Work  OK -> Work = (5,2,4)
              T1 pide (2,0,2) <= Work  OK -> Work = (7,2,4)
              T4 pide (0,0,2) <= Work  OK -> Work = (7,2,6)</pre>
<b>Después de la petición</b> (<code>Request2 = 001</code>) solo se puede reclamar lo de T0
(<code>Work = (0,1,0)</code>) y ahí se detiene: T1 pide (2,0,2), T2 pide (0,0,1), T3 pide (1,0,0) y T4 pide (0,0,2);
<b>ninguno</b> cabe en <code>(0,1,0)</code>. <b>Deadlock de T1, T2, T3 y T4.</b><br>
<b>Lo instructivo:</b> una única instancia de diferencia convierte un estado sano en un deadlock de cuatro hilos.
</div>
<?php endif; ?>

<div class="nota">
<b>¿Cada cuánto ejecutar la detección?</b> Depende de dos cosas: con qué frecuencia ocurren los deadlocks y a cuántos
hilos afectan. En el extremo, se puede invocar <b>en cada petición que no se pueda conceder de inmediato</b>: así se
identifica no solo el conjunto bloqueado, sino el hilo que lo &laquo;causó&raquo;. Pero el costo en cómputo es
considerable. La alternativa barata es invocarla <b>a intervalos fijos</b> &mdash; por ejemplo una vez por hora, o
cuando la utilización de CPU baje del 40 % (un deadlock acaba hundiendo el <i>throughput</i>, y con él la utilización).
El precio de invocarla tarde es que el grafo puede tener <b>muchos ciclos</b> y ya no se sabe quién lo causó.
</div>
<hr>

<!-- ---------------- Pregunta 12 ---------------- -->
<h3>Pregunta 12 &mdash; recuperación (chequeo 7)</h3>
<p class="enunciado">¿Cuáles son las estrategias para recuperar el sistema de un abrazo mortal?</p>
<p>
1. <input type="text" name="respuesta_55" value="<?php echo r(55); ?>" size="26"> <?php echo v(55) ?> &rarr; rompe la espera circular.<br>
2. <input type="text" name="respuesta_56" value="<?php echo r(56); ?>" size="26"> <?php echo v(56) ?> &rarr; quitarle recursos a los hilos bloqueados.
</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Terminar procesos</b> y <b>preempción de recursos</b>. (Y antes de automatizar, siempre queda avisar al operador
para que lo resuelva a mano.)<br>
<b>Terminación, con dos variantes y su costo:</b><br>
&bull; <b>Abortar todos</b> los procesos en deadlock: rompe el ciclo con seguridad, pero a un costo altísimo &mdash;
se descarta todo el cómputo parcial, que habrá que repetir.<br>
&bull; <b>Abortar uno a la vez</b> hasta que el ciclo desaparezca: menos destructivo, pero hay que <b>reinvocar el
algoritmo de detección después de cada aborto</b> para ver si todavía hay bloqueados. Mucho overhead.<br>
Abortar tampoco es sencillo: si el proceso estaba actualizando un archivo o un dispositivo, lo deja en estado
inconsistente.
</div>
<?php endif; ?>

<p class="enunciado">Si se opta por la <b>preempción</b>, hay tres cuestiones que resolver. Nómbrelas:</p>
<p>
¿A quién y qué recursos quitarle, minimizando el costo? La <input type="text" name="respuesta_57" value="<?php echo r(57); ?>" size="22"> <?php echo v(57) ?><br>
¿A qué estado anterior retroceder al hilo despojado? El <input type="text" name="respuesta_58" value="<?php echo r(58); ?>" size="18"> <?php echo v(58) ?><br>
¿Cómo evitar que siempre se escoja a la misma víctima? La <input type="text" name="respuesta_59" value="<?php echo r(59); ?>" size="16"> <?php echo v(59) ?>
</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Selección de la víctima</b>, <b>rollback</b> (retroceso) e <b>inanición</b>.<br>
&bull; <b>Selección de la víctima:</b> se minimiza el costo &mdash; cuántos recursos retiene, cuánto tiempo lleva
ejecutando, cuánto le falta, su prioridad.<br>
&bull; <b>Rollback:</b> lo más limpio es retroceder al inicio y reiniciar (<i>total rollback</i>), porque determinar el
estado seguro mínimo al que volver es muy difícil.<br>
&bull; <b>Inanición:</b> si el criterio de costo favorece siempre al mismo proceso, ese proceso nunca termina. Solución
habitual: <b>incluir el número de veces que ya fue elegido víctima</b> dentro del factor de costo.<br>
<b>Fíjese en la simetría del capítulo:</b> la <i>inanición</i> apareció también al intentar prevenir &laquo;retener y
esperar&raquo; (Pregunta 7). Es el fantasma recurrente de todo el capítulo: resolver el bloqueo de un grupo suele
crear el riesgo de castigar siempre al mismo individuo.
</div>
<?php endif; ?>

<p>Escriba las 4 condiciones y, para cada una, cómo se atacaría (práctica libre):</p>
<textarea class="libre" name="libre_2" rows="5"><?php echo libre(2); ?></textarea>
<hr>

<strong>si desea ver las soluciones escribir: mostrar_solucion</strong>
<br>
<input type="text" id="mostrar_solucion" name="mostrar_solucion" value="<?php echo htmlspecialchars($mostrar_solucion, ENT_QUOTES, 'UTF-8'); ?>">
<button type="submit">Mostrar Solución</button>

</div>
</div>

<!-- =====================================================  MAPA (ancho completo)  ===================================================== -->
<div class="ancho">
<h2>Mapa del capítulo 8 y su conexión con 9 y 10</h2>
<div class="svgbox">
<svg viewBox="0 0 1120 400" xmlns="http://www.w3.org/2000/svg">
  <rect x="1" y="1" width="1118" height="398" fill="#fdfdff" stroke="#cbd5e0"/>
  <defs>
    <marker id="m8" viewBox="0 0 10 10" refX="9" refY="5" markerWidth="7" markerHeight="7" orient="auto">
      <path d="M0 1L10 5L0 9Z" fill="#4a5568"/>
    </marker>
  </defs>

  <rect x="420" y="18" width="280" height="44" rx="6" fill="#fff5f5" stroke="#c53030" stroke-width="1.8"/>
  <text x="560" y="36" font-size="12" text-anchor="middle" fill="#742a2a" font-family="Arial" font-weight="bold">LAS 4 CONDICIONES NECESARIAS</text>
  <text x="560" y="52" font-size="9.5" text-anchor="middle" fill="#742a2a" font-family="Arial">excl. mutua · retener y esperar · no preempción · espera circular</text>

  <text x="560" y="78" font-size="10" text-anchor="middle" fill="#4a5568" font-family="Arial">deben darse TODAS a la vez &rarr; romper una sola basta</text>

  <line x1="480" y1="62" x2="200" y2="110" stroke="#4a5568" stroke-width="1.4" marker-end="url(#m8)"/>
  <line x1="560" y1="88" x2="560" y2="110" stroke="#4a5568" stroke-width="1.4" marker-end="url(#m8)"/>
  <line x1="640" y1="62" x2="920" y2="110" stroke="#4a5568" stroke-width="1.4" marker-end="url(#m8)"/>

  <!-- prevención -->
  <rect x="40" y="112" width="320" height="110" rx="6" fill="#ebf8ff" stroke="#2b6cb0"/>
  <text x="200" y="131" font-size="12" text-anchor="middle" fill="#1a365d" font-family="Arial" font-weight="bold">PREVENCIÓN (8.5)</text>
  <text x="200" y="147" font-size="9.5" text-anchor="middle" fill="#1a365d" font-family="Arial">no necesita información del futuro</text>
  <text x="200" y="165" font-size="9.5" text-anchor="middle" fill="#c53030" font-family="Arial">excl. mutua: imposible de negar</text>
  <text x="200" y="178" font-size="9.5" text-anchor="middle" fill="#dd6b20" font-family="Arial">retener y esperar: baja utilización + inanición</text>
  <text x="200" y="191" font-size="9.5" text-anchor="middle" fill="#dd6b20" font-family="Arial">no preempción: no sirve para mutex</text>
  <text x="200" y="207" font-size="10.5" text-anchor="middle" fill="#2f855a" font-family="Arial" font-weight="bold">espera circular: ORDEN TOTAL &#10003; la única práctica</text>

  <!-- evitación -->
  <rect x="400" y="112" width="320" height="110" rx="6" fill="#f0fff4" stroke="#2f855a"/>
  <text x="560" y="131" font-size="12" text-anchor="middle" fill="#22543d" font-family="Arial" font-weight="bold">EVITACIÓN (8.6)</text>
  <text x="560" y="147" font-size="9.5" text-anchor="middle" fill="#22543d" font-family="Arial">exige declarar el MÁXIMO por adelantado</text>
  <text x="560" y="165" font-size="9.5" text-anchor="middle" fill="#22543d" font-family="Arial">1 instancia por tipo &rarr; grafo + arista de claim</text>
  <text x="560" y="180" font-size="10.5" text-anchor="middle" fill="#22543d" font-family="Arial" font-weight="bold">varias instancias &rarr; ALGORITMO DEL BANQUERO</text>
  <text x="560" y="195" font-size="9.5" text-anchor="middle" fill="#22543d" font-family="Arial">usa Need (pesimista): ¿el estado seguirá siendo SEGURO?</text>
  <text x="560" y="210" font-size="9.5" text-anchor="middle" fill="#dd6b20" font-family="Arial">precio: puede hacer esperar con el recurso libre</text>

  <!-- detección -->
  <rect x="760" y="112" width="320" height="110" rx="6" fill="#faf5ff" stroke="#6b46c1"/>
  <text x="920" y="131" font-size="12" text-anchor="middle" fill="#44337a" font-family="Arial" font-weight="bold">DETECCIÓN + RECUPERACIÓN (8.7&ndash;8.8)</text>
  <text x="920" y="147" font-size="9.5" text-anchor="middle" fill="#44337a" font-family="Arial">no exige nada: deja que ocurra</text>
  <text x="920" y="165" font-size="9.5" text-anchor="middle" fill="#44337a" font-family="Arial">1 instancia &rarr; ciclo en el grafo wait-for</text>
  <text x="920" y="180" font-size="9.5" text-anchor="middle" fill="#44337a" font-family="Arial">varias &rarr; mismo algoritmo con Request (optimista)</text>
  <text x="920" y="195" font-size="9.5" text-anchor="middle" fill="#44337a" font-family="Arial">recuperar: terminar procesos o expropiar recursos</text>
  <text x="920" y="210" font-size="9.5" text-anchor="middle" fill="#dd6b20" font-family="Arial">cuidado: víctima, rollback, inanición</text>

  <!-- la que se usa de verdad -->
  <line x1="200" y1="222" x2="430" y2="252" stroke="#4a5568" stroke-width="1.2" stroke-dasharray="4 3"/>
  <line x1="920" y1="222" x2="690" y2="252" stroke="#4a5568" stroke-width="1.2" stroke-dasharray="4 3"/>
  <rect x="380" y="252" width="360" height="44" rx="6" fill="#fffaf0" stroke="#dd6b20" stroke-width="1.8"/>
  <text x="560" y="270" font-size="11.5" text-anchor="middle" fill="#7b341e" font-family="Arial" font-weight="bold">LO QUE HACEN LINUX Y WINDOWS: IGNORARLO</text>
  <text x="560" y="286" font-size="9.5" text-anchor="middle" fill="#7b341e" font-family="Arial">es más barato · ocurren raramente · queda en manos del programador (orden de cerrojos)</text>
  <text x="865" y="276" font-size="9.5" fill="#44337a" font-family="Arial">las bases de datos SÍ detectan y recuperan</text>

  <!-- puente a 9 y 10 -->
  <line x1="560" y1="296" x2="560" y2="322" stroke="#2f855a" stroke-width="2" marker-end="url(#m8)"/>
  <rect x="150" y="324" width="820" height="60" rx="6" fill="#f0fff4" stroke="#2f855a" stroke-width="1.6"/>
  <text x="560" y="342" font-size="11.5" text-anchor="middle" fill="#22543d" font-family="Arial" font-weight="bold">EL PUENTE HACIA LOS CAPÍTULOS 9 Y 10</text>
  <text x="560" y="358" font-size="9.5" text-anchor="middle" fill="#22543d" font-family="Arial">La MEMORIA es el recurso del capítulo 8: tipo único, muchas instancias (los marcos), y los procesos la solicitan, usan y liberan.</text>
  <text x="560" y="372" font-size="9.5" text-anchor="middle" fill="#22543d" font-family="Arial">Pero el SO elige IGNORAR el deadlock de memoria y usar PREEMPCIÓN: le quita marcos al proceso (reemplazo de páginas, cap. 10).</text>
</svg>
</div>

<p class="enunciado">(Verdadero/Falso) Los marcos de memoria del capítulo 10 encajan en el modelo del capítulo 8
(un tipo de recurso con muchas instancias), y el reemplazo de páginas es, en esos términos, una forma de
<b>preempción de recursos</b>.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_60" value="Verdadero" <?php echo chk(60, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_60" value="Falso" <?php echo chk(60, 'Falso'); ?>> Falso</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(60) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Verdadero</b>, y es una buena manera de amarrar los tres capítulos.<br>
Un marco de memoria es un recurso con muchas instancias intercambiables, y el proceso lo solicita (fallo de página),
lo usa y lo libera (al terminar). La diferencia es que la memoria es un recurso <b>expropiable</b>: su estado se puede
guardar y restaurar (escribirlo al <i>backing store</i> y traerlo de vuelta). Por eso el SO puede permitirse
<b>quitarle el marco</b> a un proceso &mdash; exactamente la estrategia de la sección 8.5.3 que <i>no</i> funcionaba
para los mutex.<br>
<b>Y el eco del thrashing:</b> cuando la expropiación de marcos se vuelve excesiva, el resultado no es un deadlock pero
sí un fallo de vivacidad &mdash; todos los procesos &laquo;ejecutando&raquo; sin progresar. Compárelo con el
<b>livelock</b> de la Pregunta 4: la forma es parecida.
</div>
<?php endif; ?>
</div>

</form>

<div class="centered-container" style="text-align:center; margin-top:20px">
    <a class="btn btn-primary" href="../Menu.php" role="button">Volver al menú</a>
    <a class="btn btn-secondary" href="../Capitulo_9/index.php" role="button">Capítulo 9</a>
    <a class="btn btn-secondary" href="../Capitulo_10/index.php" role="button">Capítulo 10</a>
</div>
</body>
</html>
