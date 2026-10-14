<?php
/* ============================================================
   CAPÍTULO 10 - VIRTUAL MEMORY (Silberschatz 10e)
   Mismo esquema que Parcial_1: respuesta_N / verificar_N / mostrar_solucion
   ============================================================ */

for ($i = 1; $i <= 500; $i++) {
    ${"respuesta_" . $i} = '';
    ${"verificar_" . $i} = '';
}
for ($i = 1; $i <= 12; $i++) {
    ${"libre_" . $i} = '';
}

/* ---------- Respuestas de texto / opción ---------- */
$claves = [
    // 10.1 Background -------------------------------------------------
    1  => ['Verdadero'],                   // no requiere estar completo en memoria
    2  => ['Falso'],                       // físico >= virtual  -> FALSO
    3  => ['Memoria virtual', 'memoria virtual', 'virtual memory'],
    4  => ['text', 'texto', 'codigo', 'seccion de texto'],
    5  => ['data', 'datos', 'seccion de datos'],
    6  => ['heap', 'monticulo'],
    7  => ['stack', 'pila'],
    8  => ['dispersos', 'disperso', 'sparse', 'espacios dispersos', 'sparse address space'],
    // 10.2 Demand paging ---------------------------------------------
    9  => ['Verdadero'],                   // paginación pura por demanda
    10 => ['Verdadero'],                   // tasa inicial de fallos muy alta (chequeo 12)
    11 => ['valido-invalido', 'valido invalido', 'valido/invalido', 'valid-invalid', 'invalido'],
    12 => ['Paginacion por demanda', 'paginacion por demanda', 'demand paging'],
    13 => ['Free-frame list', 'free frame list', 'lista de marcos libres', 'lista de marcos disponibles'],
    14 => ['zero-fill-on-demand', 'zero fill on demand', 'llenado con ceros', 'relleno con ceros bajo demanda'],
    15 => ['localidad de referencia', 'localidad', 'locality of reference', 'locality'],
    16 => ['swap space', 'espacio de intercambio', 'espacio de swap', 'swap'],
    17 => ['memoria anonima', 'anonima', 'anonymous memory', 'memoria anonymous'],
    // mayores y menores
    18 => ['mayor', 'major', 'hard', 'duro'],
    19 => ['menor', 'minor', 'soft', 'suave'],
    // 10.3 Copy-on-write
    20 => ['Copy-on-write', 'copy on write', 'copia al escribir', 'copia en escritura', 'cow'],
    21 => ['vfork', 'vfork()'],
    // 10.4 Page replacement -------------------------------------------
    22 => ['modificado', 'modify', 'dirty', 'bit de modificado', 'sucio'],
    23 => ['FIFO', 'fifo', 'primero en entrar primero en salir', 'first-in first-out'],
    24 => ['Optimo', 'optimo', 'OPT', 'opt', 'MIN', 'min', 'optimal'],
    25 => ['LRU', 'lru', 'least recently used', 'menos recientemente usado'],
    26 => ['Verdadero'],                   // LRU: casi siempre aproximaciones
    27 => ['Anomalia de Belady', 'anomalia de belady', 'belady', 'anomalia de belady'],
    28 => ['referencia', 'bit de referencia', 'reference', 'reference bit'],
    29 => ['Segunda oportunidad', 'segunda oportunidad', 'second chance', 'reloj', 'clock'],
    30 => ['Falso'],                       // stack algorithms: OPT y LRU NO sufren Belady
    31 => ['cadena de referencias', 'reference string', 'cadena de referencia'],
    // clases del segunda-oportunidad mejorada
    32 => ['(0,0)', '0,0', '00', '0 0'],
    33 => ['(1,1)', '1,1', '11', '1 1'],
    34 => ['LFU', 'lfu', 'least frequently used', 'menos frecuentemente usada'],
    35 => ['MFU', 'mfu', 'most frequently used', 'mas frecuentemente usada'],
    // 10.5 Allocation of frames
    36 => ['equitativa', 'igual', 'equal', 'asignacion equitativa', 'equal allocation'],
    37 => ['proporcional', 'asignacion proporcional', 'proportional'],
    38 => ['Global', 'global', 'reemplazo global'],
    39 => ['Local', 'local', 'reemplazo local'],
    40 => ['arquitectura', 'la arquitectura', 'arquitectura del computador', 'conjunto de instrucciones'],
    41 => ['reapers', 'reaper', 'segadores', 'recolectores'],
    42 => ['OOM killer', 'oom killer', 'oom-killer', 'out-of-memory killer'],
    43 => ['NUMA', 'numa', 'acceso no uniforme a memoria'],
    // 10.6 Thrashing
    44 => ['Thrashing', 'thrashing', 'hiperpaginacion', 'sobrepaginacion'],
    45 => ['Conjunto de trabajo', 'conjunto de trabajo', 'working set'],
    46 => ['localidad', 'una localidad', 'locality'],
    47 => ['PFF', 'pff', 'frecuencia de fallos de pagina', 'page-fault frequency', 'page fault frequency'],
    48 => ['Verdadero'],                   // D > m  => thrashing
    // 10.7 / 10.9
    49 => ['Compresion de memoria', 'compresion de memoria', 'memory compression', 'compresion'],
    50 => ['Prepaginacion', 'prepaginacion', 'prepaging', 'prepaginado'],
    51 => ['TLB reach', 'tlb reach', 'alcance del tlb', 'alcance de tlb'],
    52 => ['lock', 'bit de bloqueo', 'lock bit', 'bloqueo', 'pinning'],
    // Conexión entre capítulos
    53 => ['Interna', 'interna', 'fragmentacion interna'],
    54 => ['Fallo de pagina', 'fallo de pagina', 'page fault', 'falla de pagina'],
    55 => ['40', '41', '40 veces', '41 veces'],   // factor de ralentización
];

/* ---------- Tablas de simulación de reemplazo ----------
   Cadena: 7 0 1 2 0 3 0 4 2 3 0 3 2 1 2 0 1 7 0 1   (3 marcos)        */
$cadena = [7,0,1,2,0,3,0,4,2,3,0,3,2,1,2,0,1,7,0,1];

$fifo = [
    [7,7,7,2,2,2,2,4,4,4,0,0,0,0,0,0,0,7,7,7],
    [null,0,0,0,0,3,3,3,2,2,2,2,2,1,1,1,1,1,0,0],
    [null,null,1,1,1,1,0,0,0,3,3,3,3,3,2,2,2,2,2,1],
];
$lru = [
    [7,7,7,2,2,2,2,4,4,4,0,0,0,1,1,1,1,1,1,1],
    [null,0,0,0,0,0,0,0,0,3,3,3,3,3,3,0,0,0,0,0],
    [null,null,1,1,1,3,3,3,2,2,2,2,2,2,2,2,2,7,7,7],
];
$opt = [
    [7,7,7,2,2,2,2,2,2,2,2,2,2,2,2,2,2,7,7,7],
    [null,0,0,0,0,0,0,4,4,4,0,0,0,0,0,0,0,0,0,0],
    [null,null,1,1,1,3,3,3,3,3,3,3,3,1,1,1,1,1,1,1],
];
/* bases de numeración: FIFO 200, LRU 300, OPT 400 */
$tablas = [
    ['nombre' => 'FIFO',   'base' => 200, 'datos' => $fifo],
    ['nombre' => 'LRU',    'base' => 300, 'datos' => $lru],
    ['nombre' => 'Óptimo', 'base' => 400, 'datos' => $opt],
];

/* ---------- Respuestas numéricas ---------- */
$numericas = [
    // Tiempo de acceso efectivo con fallos (ma = 200 ns, fallo = 8 ms)
    101 => 8000000,     // 8 ms en nanosegundos
    102 => 8200,        // TAE en ns con p = 1/1000 (8199.8 exacto)
    // Fallos totales de cada algoritmo (3 marcos, cadena de 20 referencias)
    104 => 15,          // FIFO
    105 => 12,          // LRU
    106 => 9,           // Óptimo
    // Anomalía de Belady: 1,2,3,4,1,2,5,1,2,3,4,5
    107 => 9,           // FIFO con 3 marcos
    108 => 10,          // FIFO con 4 marcos
    // Asignación equitativa y proporcional
    109 => 18,          // 93 marcos / 5 procesos
    110 => 4,           // 10/137 x 62
    111 => 57,          // 127/137 x 62
    // Working set
    112 => 10,          // tamaño de delta en el ejemplo
    // Reemplazo con marco sucio: transferencias necesarias
    113 => 2,           // page-out + page-in
    // TLB reach: 128 entradas x 4 KB
    114 => 512,         // KB de alcance
    115 => 2048,        // KB si la página pasa a 16 KB
];

/* --- celdas de las tres tablas de simulación --- */
foreach ($tablas as $t) {
    foreach ($t['datos'] as $f => $fila) {
        foreach ($fila as $c => $val) {
            if ($val !== null) {
                $numericas[$t['base'] + $f * 20 + $c] = $val;
            }
        }
    }
}

/* ---------- Funciones auxiliares ---------- */
function normalizar($t) {
    $t = trim((string)$t);
    $t = strtr($t, [
        'á'=>'a','é'=>'e','í'=>'i','ó'=>'o','ú'=>'u','ü'=>'u','ñ'=>'n',
        'Á'=>'a','É'=>'e','Í'=>'i','Ó'=>'o','Ú'=>'u','Ü'=>'u','Ñ'=>'n'
    ]);
    $t = strtolower($t);
    $t = trim($t, " \t\n\r\"'`.");
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
    /* tolerancia: 0.001 absoluta, o 0.5 % relativa para los valores grandes
       (así 8199.8 vale tanto como 8200) */
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

function marca($n) {   // versión compacta para las tablas grandes
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

/* dibuja una tabla de simulación de reemplazo */
function tabla_reemplazo($nombre, $base, $datos, $cadena) {
    $out  = '<table class="sim"><tr><th class="lbl">referencia</th>';
    foreach ($cadena as $ref) {
        $out .= '<th>' . $ref . '</th>';
    }
    $out .= '</tr>';
    foreach ($datos as $f => $fila) {
        $out .= '<tr><th class="lbl">marco ' . $f . '</th>';
        foreach ($fila as $c => $val) {
            if ($val === null) {
                $out .= '<td class="vacia">&nbsp;</td>';
            } else {
                $n = $base + $f * 20 + $c;
                $out .= '<td><input type="text" name="respuesta_' . $n . '" value="' . r($n) . '" maxlength="2">' . marca($n) . '</td>';
            }
        }
        $out .= '</tr>';
    }
    return $out . '</table>';
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
    <title>Capítulo 10 - Memoria Virtual</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../style_2_0.css">

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f5f7fb;
        margin: 0;
        padding: 20px;
        color: #1a202c;
    }

    .form-container { display: flex; gap: 15px; align-items: flex-start; }

    .seccion {
        width: calc(50% - 7.5px);
        padding: 20px;
        box-sizing: border-box;
        background: white;
        border-radius: 10px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    }

    @media (max-width: 1100px) {
        .form-container { flex-direction: column; }
        .seccion { width: 100%; }
    }

    .ancho {
        padding: 20px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
        margin-bottom: 15px;
    }

    h2 { font-size: 1.5rem; }
    h3 { font-size: 1.12rem; margin-top: 14px; }
    .enunciado { line-height: 1.6; }
    .opciones label { display: block; margin: 6px 0; cursor: pointer; }
    .correcto { color: #2f855a; font-weight: bold; }
    .incorrecto { color: #c53030; font-weight: bold; }
    .ok  { color: #2f855a; font-weight: bold; font-size: 0.75rem; display: block; line-height: 1; }
    .bad { color: #c53030; font-weight: bold; font-size: 0.75rem; display: block; line-height: 1; }

    input[type="text"], select, textarea {
        border: 1px solid #a0aec0;
        border-radius: 4px;
        padding: 2px 4px;
        font-size: 0.95rem;
    }

    code, .comando { font-family: Consolas, "Courier New", monospace; font-size: 0.93rem; }

    .comando {
        background: #1e1e2e;
        color: #e2e8f0;
        padding: 10px;
        border-radius: 6px;
        line-height: 2.1;
        overflow-x: auto;
    }

    .comando input[type="text"] {
        background: #2d3748;
        color: #fefcbf;
        border: 1px solid #718096;
        font-family: Consolas, "Courier New", monospace;
    }

    table.plan { border-collapse: collapse; margin: 8px 0; width: 100%; }
    table.plan th, table.plan td { border: 1px solid #cbd5e0; padding: 4px 6px; text-align: center; font-size: 0.9rem; }
    table.plan th { background: #edf2f7; }
    table.plan input { width: 72px; text-align: center; }

    table.sim { border-collapse: collapse; margin: 6px 0 2px; }
    table.sim th, table.sim td { border: 1px solid #cbd5e0; padding: 1px 2px; text-align: center; }
    table.sim th { background: #edf2f7; font-size: 0.82rem; font-weight: bold; width: 30px; }
    table.sim th.lbl { background: #e2e8f0; font-size: 0.78rem; width: 70px; text-align: right; padding-right: 5px; }
    table.sim input { width: 26px; text-align: center; padding: 1px; font-size: 0.85rem; }
    table.sim td.vacia { background: #f7fafc; }
    .scroll { overflow-x: auto; }

    .solucion {
        background: #f0fff4;
        border-left: 4px solid #38a169;
        padding: 8px 12px;
        margin: 10px 0;
        font-size: 0.92rem;
        line-height: 1.55;
    }
    .solucion pre { white-space: pre; margin: 4px 0; overflow-x: auto; font-size: 0.82rem; }
    .nota {
        background: #ebf8ff;
        border-left: 4px solid #3182ce;
        padding: 8px 12px; margin: 10px 0; font-size: 0.9rem; line-height: 1.55;
    }
    .idea {
        background: #fffaf0;
        border-left: 4px solid #dd6b20;
        padding: 8px 12px; margin: 10px 0; font-size: 0.9rem; line-height: 1.55;
    }
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

    fetch(event.target.action, {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(html => {
        const doc = new DOMParser().parseFromString(html, 'text/html');
        document.body.innerHTML = doc.body.innerHTML;
        window.scrollTo(0, scroll);
    })
    .catch(error => {
        console.error('Error al enviar el formulario:', error);
    });
}
</script>

</head>
<body>

<form action="./index.php" method="POST" onsubmit="handleSubmit(event)" autocomplete="off">

<div class="form-container">

<!-- =====================================================  IZQUIERDA  ===================================================== -->
<div class="seccion izquierda">

<h2>Capítulo 10 &mdash; Memoria Virtual</h2>
<p>Cuestionario de estudio sobre <b>Virtual Memory</b> (Silberschatz, 10.ª ed.). Cubre las 12 preguntas de chequeo
y añade los cálculos, flujos y simulaciones del capítulo. Llene y presione <b>Enviar</b>.</p>

<div class="idea">
<b>La idea que cambia todo.</b> El capítulo 9 terminó con una exigencia: el proceso debe estar <i>completo</i> en memoria.
El capítulo 10 la rompe. Si un proceso puede ejecutarse estando solo <b>parcialmente</b> en memoria, entonces
(1) los programas pueden ser más grandes que la RAM, (2) caben más procesos a la vez, (3) hay menos E/S al cargar.
Todo el resto del capítulo es el <b>precio</b> de esa libertad: ¿qué pasa cuando se referencia una página ausente
(<b>fallo de página</b>), a quién se expulsa cuando no hay sitio (<b>reemplazo</b>), cuántos marcos le toca a cada
proceso (<b>asignación</b>) y qué ocurre si no alcanzan (<b>thrashing</b>).
</div>
<hr>

<!-- ---------------- Pregunta 1 ---------------- -->
<h3>Pregunta 1 &mdash; la premisa (chequeos 1 y 2)</h3>
<p class="enunciado">(Verdadero/Falso) Un programa <b>no</b> requiere estar completo en memoria para poderse ejecutar.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_1" value="Verdadero" <?php echo chk(1, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_1" value="Falso" <?php echo chk(1, 'Falso'); ?>> Falso</label>
</div>
<p class="enunciado">(Verdadero/Falso) El espacio de direcciones <b>físicas</b> es cuando menos tan grande como el espacio
de direcciones <b>virtuales</b>.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_2" value="Verdadero" <?php echo chk(2, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_2" value="Falso" <?php echo chk(2, 'Falso'); ?>> Falso</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(1) ?><?php echo v(2) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
Primera: <b>Verdadero</b> &mdash; es la definición misma de memoria virtual.<br>
Segunda: <b>Falso</b>, y es justo al contrario: <b>el espacio virtual es (mucho) más grande que el físico</b>.
Ese es el punto. Si fuera al revés no habría nada que resolver.<br>
<b>Por qué sobra tanto programa:</b> el libro lo justifica con tres observaciones &mdash; el código de errores raros casi
nunca se ejecuta, los arreglos y tablas se declaran más grandes de lo que se usan, y hay opciones del programa que
casi nadie usa. Y aun cuando todo el programa se necesite, <i>no se necesita todo al mismo tiempo</i>.
</div>
<?php endif; ?>

<p class="enunciado">La técnica que separa la memoria lógica que percibe el programador de la memoria física se llama
<input type="text" name="respuesta_3" value="<?php echo r(3); ?>" size="18"> <?php echo v(3) ?>.</p>
<button type="submit">Enviar</button>
<hr>

<!-- ---------------- Pregunta 2 ---------------- -->
<h3>Pregunta 2 &mdash; el espacio de direcciones virtual</h3>
<p class="enunciado">Etiquete las cuatro regiones del espacio virtual de un proceso, de abajo (dirección 0) hacia arriba (max):</p>
<div class="svgbox">
<svg viewBox="0 0 560 300" xmlns="http://www.w3.org/2000/svg">
  <rect x="1" y="1" width="558" height="298" fill="#ffffff" stroke="#cbd5e0"/>
  <defs>
    <marker id="a10" viewBox="0 0 10 10" refX="9" refY="5" markerWidth="7" markerHeight="7" orient="auto">
      <path d="M0 1L10 5L0 9Z" fill="#2d3748"/>
    </marker>
  </defs>

  <text x="118" y="28" font-size="11" text-anchor="middle" fill="#4a5568" font-family="Arial">max</text>

  <rect x="60" y="34" width="150" height="40" fill="#e9d8fd" stroke="#6b46c1"/>
  <foreignObject x="64" y="44" width="142" height="22">
    <input xmlns="http://www.w3.org/1999/xhtml" type="text" name="respuesta_7" value="<?php echo r(7); ?>" placeholder="región 4"
           style="width:100%;border:1px solid #a0aec0;border-radius:3px;background:#fff;font-size:12px;font-family:Arial;text-align:center;"/>
  </foreignObject>
  <line x1="235" y1="44" x2="235" y2="86" stroke="#6b46c1" stroke-width="1.4" marker-end="url(#a10)"/>
  <text x="300" y="68" font-size="10.5" fill="#6b46c1" font-family="Arial">crece hacia ABAJO (llamadas a función)</text>

  <rect x="60" y="74" width="150" height="86" fill="#f7fafc" stroke="#a0aec0" stroke-dasharray="5 4"/>
  <text x="135" y="112" font-size="11.5" text-anchor="middle" fill="#4a5568" font-family="Arial">hueco</text>
  <text x="135" y="128" font-size="9.5" text-anchor="middle" fill="#4a5568" font-family="Arial">(sin marcos físicos asignados)</text>

  <rect x="60" y="160" width="150" height="40" fill="#bee3f8" stroke="#2b6cb0"/>
  <foreignObject x="64" y="170" width="142" height="22">
    <input xmlns="http://www.w3.org/1999/xhtml" type="text" name="respuesta_6" value="<?php echo r(6); ?>" placeholder="región 3"
           style="width:100%;border:1px solid #a0aec0;border-radius:3px;background:#fff;font-size:12px;font-family:Arial;text-align:center;"/>
  </foreignObject>
  <line x1="235" y1="190" x2="235" y2="148" stroke="#2b6cb0" stroke-width="1.4" marker-end="url(#a10)"/>
  <text x="300" y="172" font-size="10.5" fill="#2b6cb0" font-family="Arial">crece hacia ARRIBA (malloc / new)</text>

  <rect x="60" y="200" width="150" height="38" fill="#c6f6d5" stroke="#2f855a"/>
  <foreignObject x="64" y="209" width="142" height="22">
    <input xmlns="http://www.w3.org/1999/xhtml" type="text" name="respuesta_5" value="<?php echo r(5); ?>" placeholder="región 2"
           style="width:100%;border:1px solid #a0aec0;border-radius:3px;background:#fff;font-size:12px;font-family:Arial;text-align:center;"/>
  </foreignObject>

  <rect x="60" y="238" width="150" height="38" fill="#fed7aa" stroke="#dd6b20"/>
  <foreignObject x="64" y="247" width="142" height="22">
    <input xmlns="http://www.w3.org/1999/xhtml" type="text" name="respuesta_4" value="<?php echo r(4); ?>" placeholder="región 1"
           style="width:100%;border:1px solid #a0aec0;border-radius:3px;background:#fff;font-size:12px;font-family:Arial;text-align:center;"/>
  </foreignObject>
  <text x="118" y="290" font-size="11" text-anchor="middle" fill="#4a5568" font-family="Arial">0</text>

  <text x="390" y="215" font-size="10.5" text-anchor="middle" fill="#4a5568" font-family="Arial">solo lectura · se puede</text>
  <text x="390" y="229" font-size="10.5" text-anchor="middle" fill="#4a5568" font-family="Arial">compartir entre procesos</text>
  <line x1="300" y1="222" x2="215" y2="235" stroke="#a0aec0" stroke-width="1" marker-end="url(#a10)"/>
</svg>
</div>
<p class="enunciado">Un espacio virtual que contiene huecos como el de la figura se llama espacio de direcciones
<input type="text" name="respuesta_8" value="<?php echo r(8); ?>" size="14"> <?php echo v(8) ?>.</p>
<button type="submit">Enviar</button>
<?php echo v(4) ?><?php echo v(5) ?><?php echo v(6) ?><?php echo v(7) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
De abajo hacia arriba: <b>text &rarr; data &rarr; heap &rarr; stack</b>; y se llama espacio de direcciones
<b>disperso</b> (<i>sparse address space</i>).<br>
<b>Por qué importa el hueco:</b> es espacio virtual que <i>no consume marcos físicos</i> hasta que crezca el heap o la
pila. El hueco también es donde se enlazan dinámicamente las bibliotecas. Un espacio contiguo y completo no permitiría
esto.<br>
<b>Tres cosas que habilita la memoria virtual, además de ejecutar programas grandes:</b> compartir bibliotecas de sistema
(mapeadas de solo lectura en cada espacio), compartir memoria entre procesos, y <b>acelerar <code>fork()</code></b>
compartiendo páginas.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 3 ---------------- -->
<h3>Pregunta 3 &mdash; paginación por demanda (chequeos 3, 4 y 12)</h3>
<p class="enunciado">¿Cuándo ocurre un fallo de página? Complete: cuando se accede a una página cuyo bit
<input type="text" name="respuesta_11" value="<?php echo r(11); ?>" size="16"> <?php echo v(11) ?>
está marcado como <b>inválido</b>, el hardware de paginación lo detecta y hace un <b>trap</b> al sistema operativo.</p>
<p class="enunciado">El nombre de la técnica de cargar páginas solo cuando se necesitan es
<input type="text" name="respuesta_12" value="<?php echo r(12); ?>" size="24"> <?php echo v(12) ?>.</p>
<p class="enunciado">(Verdadero/Falso) En un sistema de paginación <b>pura</b> por demanda, una página no se sube a
memoria sino hasta que se la necesita.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_9" value="Verdadero" <?php echo chk(9, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_9" value="Falso" <?php echo chk(9, 'Falso'); ?>> Falso</label>
</div>
<p class="enunciado">(Verdadero/Falso) En la paginación pura por demanda, la tasa <b>inicial</b> de fallos de página es muy alta.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_10" value="Verdadero" <?php echo chk(10, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_10" value="Falso" <?php echo chk(10, 'Falso'); ?>> Falso</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(9) ?><?php echo v(10) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
Bit <b>válido&ndash;invalido</b>. Ambas afirmaciones son <b>Verdaderas</b>.<br>
<b>Aquí está la bisagra con el capítulo 9:</b> el bit válido&ndash;inválido ya existía, pero significaba otra cosa.
En el cap. 9, &laquo;inválido&raquo; = <i>dirección ilegal</i> (error fatal). En el cap. 10, &laquo;inválido&raquo; puede
significar <i>legal, pero está en disco</i>. El mismo bit, dos significados: por eso el SO primero debe
<b>consultar una tabla interna del PCB</b> para distinguir un caso del otro.<br>
En paginación pura se puede arrancar un proceso con <b>cero</b> páginas en memoria: falla en la primera instrucción
y va cargando a medida que falla. De ahí la tasa inicial alta; luego la <b>localidad de referencia</b> la baja.
</div>
<?php endif; ?>

<p class="enunciado">Ordene los <b>6 pasos</b> del manejo de un fallo de página escribiendo el número (1 a 6) de cada uno
en el diagrama, y revise el flujo:</p>
<div class="svgbox">
<svg viewBox="0 0 560 340" xmlns="http://www.w3.org/2000/svg">
  <rect x="1" y="1" width="558" height="338" fill="#ffffff" stroke="#cbd5e0"/>
  <defs>
    <marker id="b10" viewBox="0 0 10 10" refX="9" refY="5" markerWidth="7" markerHeight="7" orient="auto">
      <path d="M0 1L10 5L0 9Z" fill="#2d3748"/>
    </marker>
  </defs>

  <rect x="20" y="130" width="78" height="40" rx="5" fill="#ebf8ff" stroke="#2b6cb0"/>
  <text x="59" y="155" font-size="13" text-anchor="middle" fill="#1a365d" font-family="Arial">CPU</text>

  <circle cx="125" cy="118" r="11" fill="#fefcbf" stroke="#b7791f"/>
  <text x="125" y="123" font-size="11" text-anchor="middle" fill="#744210" font-family="Arial" font-weight="bold">1</text>
  <text x="150" y="105" font-size="10.5" fill="#4a5568" font-family="Arial">referencia a una página</text>
  <line x1="98" y1="140" x2="185" y2="140" stroke="#2d3748" stroke-width="1.3" marker-end="url(#b10)"/>

  <rect x="185" y="118" width="110" height="44" rx="4" fill="#faf5ff" stroke="#6b46c1"/>
  <text x="240" y="137" font-size="11" text-anchor="middle" fill="#44337a" font-family="Arial">tabla de páginas</text>
  <text x="240" y="153" font-size="12" text-anchor="middle" fill="#c53030" font-family="Arial" font-weight="bold">bit = i</text>

  <circle cx="320" cy="100" r="11" fill="#fefcbf" stroke="#b7791f"/>
  <text x="320" y="105" font-size="11" text-anchor="middle" fill="#744210" font-family="Arial" font-weight="bold">2</text>
  <line x1="240" y1="118" x2="240" y2="70" stroke="#c53030" stroke-width="1.3"/>
  <line x1="240" y1="70" x2="330" y2="70" stroke="#c53030" stroke-width="1.3" marker-end="url(#b10)"/>
  <text x="285" y="63" font-size="10.5" text-anchor="middle" fill="#c53030" font-family="Arial">trap</text>

  <rect x="332" y="48" width="118" height="44" rx="5" fill="#edf2f7" stroke="#4a5568"/>
  <text x="391" y="68" font-size="11" text-anchor="middle" fill="#2d3748" font-family="Arial">sistema</text>
  <text x="391" y="83" font-size="11" text-anchor="middle" fill="#2d3748" font-family="Arial">operativo</text>

  <circle cx="490" cy="70" r="11" fill="#fefcbf" stroke="#b7791f"/>
  <text x="490" y="75" font-size="11" text-anchor="middle" fill="#744210" font-family="Arial" font-weight="bold">3</text>
  <line x1="450" y1="70" x2="478" y2="70" stroke="#2d3748" stroke-width="1.3" marker-end="url(#b10)"/>
  <text x="505" y="100" font-size="10" text-anchor="middle" fill="#4a5568" font-family="Arial">la página</text>
  <text x="505" y="112" font-size="10" text-anchor="middle" fill="#4a5568" font-family="Arial">está en el</text>
  <text x="505" y="124" font-size="10" text-anchor="middle" fill="#4a5568" font-family="Arial">backing store</text>

  <rect x="430" y="195" width="110" height="80" rx="4" fill="#fff5f5" stroke="#c53030"/>
  <text x="485" y="232" font-size="11" text-anchor="middle" fill="#742a2a" font-family="Arial">backing</text>
  <text x="485" y="247" font-size="11" text-anchor="middle" fill="#742a2a" font-family="Arial">store</text>
  <line x1="505" y1="130" x2="505" y2="192" stroke="#c53030" stroke-width="1" stroke-dasharray="3 3"/>

  <circle cx="365" cy="235" r="11" fill="#fefcbf" stroke="#b7791f"/>
  <text x="365" y="240" font-size="11" text-anchor="middle" fill="#744210" font-family="Arial" font-weight="bold">4</text>
  <line x1="428" y1="235" x2="345" y2="235" stroke="#2f855a" stroke-width="1.5" marker-end="url(#b10)"/>
  <text x="386" y="258" font-size="10" text-anchor="middle" fill="#2f855a" font-family="Arial">traer la página</text>

  <rect x="215" y="200" width="120" height="70" rx="4" fill="#f0fff4" stroke="#2f855a"/>
  <text x="275" y="230" font-size="11" text-anchor="middle" fill="#22543d" font-family="Arial">marco libre</text>
  <text x="275" y="246" font-size="9.5" text-anchor="middle" fill="#22543d" font-family="Arial">(de la free-frame list)</text>

  <circle cx="190" cy="200" r="11" fill="#fefcbf" stroke="#b7791f"/>
  <text x="190" y="205" font-size="11" text-anchor="middle" fill="#744210" font-family="Arial" font-weight="bold">5</text>
  <line x1="215" y1="215" x2="250" y2="175" stroke="#6b46c1" stroke-width="1.3" marker-end="url(#b10)"/>
  <text x="150" y="228" font-size="10" fill="#6b46c1" font-family="Arial">actualizar</text>
  <text x="150" y="240" font-size="10" fill="#6b46c1" font-family="Arial">tabla de páginas</text>

  <circle cx="60" cy="200" r="11" fill="#fefcbf" stroke="#b7791f"/>
  <text x="60" y="205" font-size="11" text-anchor="middle" fill="#744210" font-family="Arial" font-weight="bold">6</text>
  <line x1="130" y1="215" x2="70" y2="180" stroke="#2b6cb0" stroke-width="1.3" marker-end="url(#b10)"/>
  <text x="95" y="252" font-size="10.5" text-anchor="middle" fill="#2b6cb0" font-family="Arial">reiniciar la instrucción</text>

  <rect x="20" y="288" width="520" height="42" rx="4" fill="#fffaf0" stroke="#dd6b20"/>
  <text x="280" y="305" font-size="10.5" text-anchor="middle" fill="#7b341e" font-family="Arial">Requisito crítico: hay que poder REINICIAR cualquier instrucción tras el fallo.</text>
  <text x="280" y="320" font-size="10.5" text-anchor="middle" fill="#7b341e" font-family="Arial">Si la instrucción ya modificó memoria (ej. MVC del 360/370 con bloques solapados), reiniciarla no basta.</text>
</svg>
</div>
<p class="cap">Figura 10.5 &mdash; pasos en el manejo de un fallo de página.</p>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Los 6 pasos, en palabras:</b>
<pre>1. Consultar la tabla interna del proceso (en el PCB): ¿la referencia era válida?
2. Si era inválida -> terminar el proceso. Si era válida pero la página no está -> paginarla.
3. Buscar un marco libre (de la free-frame list).
4. Programar la lectura del almacenamiento secundario hacia ese marco.
5. Al terminar la lectura, actualizar la tabla interna y la tabla de páginas (bit -> válido).
6. REINICIAR la instrucción interrumpida por el trap.</pre>
<b>Dos soluciones del libro al problema del reinicio:</b> (a) el microcódigo toca <i>los dos extremos de los dos bloques</i>
antes de mover nada, así el fallo ocurre antes de modificar algo; (b) usar registros temporales que guarden los valores
sobrescritos para poder restaurarlos.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 4 ---------------- -->
<h3>Pregunta 4 &mdash; ¿cuánto cuesta un fallo? (el cálculo clave)</h3>
<p class="enunciado">Con acceso a memoria <code>ma = 200 ns</code> y tiempo de servicio de un fallo de
<code>8 ms</code>, siendo <code>p</code> la probabilidad de fallo:</p>
<div class="comando">
TAE = (1 &minus; p) &times; 200 + p &times; <input type="text" name="respuesta_101" value="<?php echo r(101); ?>" size="11"> ns<br>
&nbsp;&nbsp;&nbsp;&nbsp;= 200 + 7 999 800 &times; p<br>
<br>
Si 1 de cada 1000 accesos falla (p = 0.001): TAE = <input type="text" name="respuesta_102" value="<?php echo r(102); ?>" size="9"> ns<br>
El computador se ralentiza por un factor de <input type="text" name="respuesta_55" value="<?php echo r(55); ?>" size="6"> veces
</div>
<button type="submit">Enviar</button>
<?php echo v(101) ?><?php echo v(102) ?><?php echo v(55) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<code>8 ms = 8 000 000 ns</code>; con <code>p = 0.001</code> &rarr; <code>TAE &asymp; 8200 ns = 8.2 &micro;s</code>,
es decir <b>40 veces más lento</b>.<br>
<b>Y el remate del libro:</b> para que la degradación sea menor al 10 % hay que exigir
<code>220 &gt; 200 + 7 999 800 p</code> &rarr; <code>p &lt; 0.0000025</code>, o sea <b>menos de un fallo cada 400 000 accesos</b>.<br>
<b>Compare con el cap. 9:</b> un <i>TLB miss</i> costaba un acceso extra a memoria (nanosegundos); un <i>fallo de página</i>
cuesta una operación de E/S (milisegundos). Son seis órdenes de magnitud. Por eso toda la ingeniería del capítulo
apunta a <b>mantener p bajísima</b>.
</div>
<?php endif; ?>

<p class="enunciado">Los pares de términos sobre el almacén: la E/S al
<input type="text" name="respuesta_16" value="<?php echo r(16); ?>" size="18"> <?php echo v(16) ?>
es más rápida que al sistema de archivos (bloques más grandes, sin búsquedas de directorio);
y las páginas que no corresponden a ningún archivo (pila y heap) se llaman
<input type="text" name="respuesta_17" value="<?php echo r(17); ?>" size="18"> <?php echo v(17) ?>.</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion"><b>swap space</b> y <b>memoria anónima</b>. Linux y BSD paginan los ejecutables <i>directamente desde el sistema de archivos</i>
(el archivo hace de backing store, porque esas páginas nunca se modifican) y reservan el swap solo para la memoria anónima.</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 5 ---------------- -->
<h3>Pregunta 5 &mdash; fallos mayores y menores</h3>
<p class="enunciado">Clasifique: un fallo en el que hay que <b>leer la página del backing store</b> es un fallo
<input type="text" name="respuesta_18" value="<?php echo r(18); ?>" size="10"> <?php echo v(18) ?>;
un fallo en el que <b>la página ya está en memoria</b> y solo falta el mapeo en la tabla del proceso es un fallo
<input type="text" name="respuesta_19" value="<?php echo r(19); ?>" size="10"> <?php echo v(19) ?>.</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Mayor</b> (Windows: <i>hard</i>) y <b>menor</b> (Windows: <i>soft</i>). Resolver uno menor es <b>mucho</b> más rápido.<br>
Dos causas de fallo menor: el proceso referencia una biblioteca compartida que ya está en memoria pero sin mapeo propio;
o la página fue reclamada a la free-frame list pero todavía no se limpió ni reasignó.<br>
En Linux: <code>ps -eo min_flt,maj_flt,cmd</code>. Verá que los <i>minor</i> son muchísimos más &mdash; evidencia de cuánto
se aprovechan las bibliotecas compartidas.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 6 ---------------- -->
<h3>Pregunta 6 &mdash; la lista de marcos libres</h3>
<p class="enunciado">La reserva de marcos que el SO mantiene para atender fallos se llama
<input type="text" name="respuesta_13" value="<?php echo r(13); ?>" size="22"> <?php echo v(13) ?>,
y la técnica de dejarlos en ceros antes de asignarlos es
<input type="text" name="respuesta_14" value="<?php echo r(14); ?>" size="22"> <?php echo v(14) ?>.</p>
<p class="enunciado">La propiedad de los programas que hace que la paginación por demanda tenga un rendimiento
razonable, en lugar de fallar en cada instrucción, es la
<input type="text" name="respuesta_15" value="<?php echo r(15); ?>" size="24"> <?php echo v(15) ?>.</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Free-frame list</b>, <b>zero-fill-on-demand</b> y <b>localidad de referencia</b>.<br>
El llenado con ceros no es cosmético: es <b>seguridad</b>. Sin él, un proceso recibiría un marco con los datos del
proceso anterior.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 7 ---------------- -->
<h3>Pregunta 7 &mdash; copy-on-write</h3>
<p class="enunciado">La técnica que permite que padre e hijo de un <code>fork()</code> compartan las mismas páginas, y
solo copiarlas si alguno <b>escribe</b>, se llama
<input type="text" name="respuesta_20" value="<?php echo r(20); ?>" size="20"> <?php echo v(20) ?>.</p>
<p class="enunciado">La variante de <code>fork()</code> que <b>no</b> usa esa técnica, suspende al padre y deja que el
hijo use su mismo espacio de direcciones (pensada para llamar a <code>exec()</code> de inmediato) es
<input type="text" name="respuesta_21" value="<?php echo r(21); ?>" size="14"> <?php echo v(21) ?>.</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Copy-on-write</b> y <b>vfork()</b>.<br>
Lógica: muchos hijos llaman a <code>exec()</code> inmediatamente, así que copiar todo el espacio del padre sería trabajo
tirado. Solo se marcan COW las páginas <b>modificables</b>; las de código, que no cambian, se comparten siempre.
Al escribir, el SO toma un marco de la free-frame list y copia <i>esa</i> página.<br>
<b>Peligro de vfork():</b> como no hay copia, cualquier cambio del hijo <b>sí</b> lo ve el padre al reanudarse.
Es muy eficiente (se usa para shells) pero hay que usarlo con cuidado.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 8 ---------------- -->
<h3>Pregunta 8 &mdash; el bit que ahorra la mitad de la E/S</h3>
<p class="enunciado">Cuando no hay marcos libres, el reemplazo exige
<input type="text" name="respuesta_113" value="<?php echo r(113); ?>" size="4"> <?php echo v(113) ?>
transferencias de página (un <i>page-out</i> y un <i>page-in</i>), lo que <b>duplica</b> el tiempo de servicio del fallo.
El bit que permite evitar el <i>page-out</i> cuando la página víctima no fue alterada es el bit de
<input type="text" name="respuesta_22" value="<?php echo r(22); ?>" size="16"> <?php echo v(22) ?>.</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>2</b> transferencias, y el bit de <b>modificado</b> (<i>modify</i> / <i>dirty</i>). Lo pone el hardware al escribir
cualquier byte de la página. Si está en 0, la copia del disco sigue siendo válida: se <b>descarta</b> la página sin escribirla,
y el servicio del fallo se reduce a la mitad. Las páginas de solo lectura (código binario) <i>siempre</i> se pueden descartar.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 9 ---------------- -->
<h3>Pregunta 9 &mdash; prepaginación, compresión y TLB reach (10.7 y 10.9)</h3>
<p class="enunciado">La alternativa al swapping que <b>comprime varios marcos en uno</b> en lugar de escribirlos al
disco (usada en sistemas móviles) es la
<input type="text" name="respuesta_49" value="<?php echo r(49); ?>" size="22"> <?php echo v(49) ?>.</p>
<p class="enunciado">La técnica que trae de antemano un conjunto de páginas para evitar la ráfaga inicial de fallos es la
<input type="text" name="respuesta_50" value="<?php echo r(50); ?>" size="18"> <?php echo v(50) ?>.</p>
<p class="enunciado">La cantidad de memoria direccionable desde el TLB (nº de entradas &times; tamaño de página) es el
<input type="text" name="respuesta_51" value="<?php echo r(51); ?>" size="14"> <?php echo v(51) ?>.</p>
<div class="comando">
128 entradas &times; 4 KB = <input type="text" name="respuesta_114" value="<?php echo r(114); ?>" size="7"> KB de alcance<br>
128 entradas &times; 16 KB = <input type="text" name="respuesta_115" value="<?php echo r(115); ?>" size="7"> KB de alcance
</div>
<p class="enunciado">El bit que impide que un marco sea elegido como víctima (por ejemplo, mientras es el buffer de una
operación de E/S) es el bit de <input type="text" name="respuesta_52" value="<?php echo r(52); ?>" size="14"> <?php echo v(52) ?>.</p>
<button type="submit">Enviar</button>
<?php echo v(114) ?><?php echo v(115) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Compresión de memoria</b>, <b>prepaginación</b>, <b>TLB reach</b> (512 KB y 2048 KB = 2 MB) y bit de <b>lock</b> (<i>pinning</i>).<br>
<b>Cuándo gana la prepaginación:</b> si se traen <code>s</code> páginas y se usa una fracción <code>&alpha;</code>,
gana si <code>&alpha;</code> está cerca de 1 y pierde si está cerca de 0. Prepaginar un <i>archivo</i> es más predecible
que prepaginar un ejecutable, porque los archivos se leen secuencialmente (<code>readahead()</code> en Linux).<br>
<b>Sobre el TLB reach:</b> subir el tamaño de página lo multiplica sin pagar más memoria asociativa, pero
aumenta la fragmentación interna. Linux resuelve el conflicto con <b>huge pages</b>: páginas grandes solo en una
región designada.<br>
<b>Por qué el lock bit es necesario:</b> sin él, un proceso podría pedir E/S hacia un buffer, y mientras espera otro
proceso (con reemplazo <i>global</i>) le quita ese marco &mdash; la E/S escribiría encima de la página de un tercero.
Peligro: si el bit se queda encendido por un bug, el marco queda inutilizable para siempre.
</div>
<?php endif; ?>

</div>

<!-- =====================================================  DERECHA  ===================================================== -->
<div class="seccion derecha">

<h2>Reemplazo, asignación y thrashing</h2>
<div class="idea">
<b>El criterio para comparar algoritmos.</b> Se ejecuta el algoritmo sobre una <b>cadena de referencias</b>
y se cuentan los fallos; gana el de menor tasa. Dos simplificaciones lo hacen práctico: solo importa el
<i>número de página</i> (no la dirección completa), y referencias repetidas <i>consecutivas</i> a la misma página
nunca fallan.
</div>
<hr>

<!-- ---------------- Pregunta 10 ---------------- -->
<h3>Pregunta 10 &mdash; los tres algoritmos (chequeos 5, 6 y 7)</h3>
<p class="enunciado">Identifique cada algoritmo:</p>
<p>
El <b>más sencillo</b> de todos: <input type="text" name="respuesta_23" value="<?php echo r(23); ?>" size="10"> <?php echo v(23) ?><br>
El que reemplaza la página que <b>no será usada por el período más largo</b>:
<input type="text" name="respuesta_24" value="<?php echo r(24); ?>" size="12"> <?php echo v(24) ?><br>
El que se puede implementar con una <b>pila</b> o con <b>contadores</b>:
<input type="text" name="respuesta_25" value="<?php echo r(25); ?>" size="10"> <?php echo v(25) ?>
</p>
<p class="enunciado">El nombre de la cadena de números de página con que se evalúan es
<input type="text" name="respuesta_31" value="<?php echo r(31); ?>" size="20"> <?php echo v(31) ?>.</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>FIFO</b>, <b>Óptimo</b> (OPT o MIN) y <b>LRU</b>; la <b>cadena de referencias</b> (<i>reference string</i>).<br>
<b>La relación entre los tres, que es lo que hay que entender:</b> FIFO usa el momento en que la página <i>entró</i>;
OPT usa el momento en que la página <i>se usará</i>; LRU usa el momento en que la página <i>se usó</i>.
LRU es, literalmente, <b>OPT mirando hacia atrás en el tiempo</b>, apostando a que el pasado reciente predice el
futuro cercano (que es exactamente la hipótesis de localidad).<br>
OPT es <b>irrealizable</b> (requiere conocer el futuro) y sirve solo como <b>cota inferior</b> para medir a los demás.
</div>
<?php endif; ?>

<p class="enunciado">(Verdadero/Falso) Cuando se implementa LRU, casi siempre se emplean algoritmos de <b>aproximación</b>.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_26" value="Verdadero" <?php echo chk(26, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_26" value="Falso" <?php echo chk(26, 'Falso'); ?>> Falso</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(26) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Verdadero.</b> LRU exacto exige actualizar un contador o mover un nodo de pila <b>en cada referencia a memoria</b>.
Sin ayuda de hardware habría que interrumpir a software en cada acceso: ralentizaría todo por un factor de diez o más.
Casi ninguna CPU da ese soporte, así que se aproxima con el <b>bit de referencia</b>.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 11 ---------------- -->
<h3>Pregunta 11 &mdash; la simulación (el ejercicio central)</h3>
<p class="enunciado">Cadena de referencias y <b>3 marcos</b>, inicialmente vacíos. Llene el contenido de los marcos
<b>después</b> de cada referencia. (Las celdas grises son los marcos aún sin usar.)</p>

<?php foreach ($tablas as $t): ?>
<h4 style="margin-bottom:2px"><?php echo $t['nombre']; ?></h4>
<div class="scroll"><?php echo tabla_reemplazo($t['nombre'], $t['base'], $t['datos'], $cadena); ?></div>
<?php endforeach; ?>

<button type="submit">Enviar</button>
<p class="enunciado">Total de fallos de página de cada algoritmo:
FIFO = <input type="text" name="respuesta_104" value="<?php echo r(104); ?>" size="4"> <?php echo v(104) ?>
&nbsp;·&nbsp; LRU = <input type="text" name="respuesta_105" value="<?php echo r(105); ?>" size="4"> <?php echo v(105) ?>
&nbsp;·&nbsp; Óptimo = <input type="text" name="respuesta_106" value="<?php echo r(106); ?>" size="4"> <?php echo v(106) ?></p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>FIFO = 15, LRU = 12, Óptimo = 9.</b>
<pre>cadena:  7  0  1  2  0  3  0  4  2  3  0  3  2  1  2  0  1  7  0  1

FIFO     7  7  7  2  2  2  2  4  4  4  0  0  0  0  0  0  0  7  7  7
            0  0  0  0  3  3  3  2  2  2  2  2  1  1  1  1  1  0  0
               1  1  1  1  0  0  0  3  3  3  3  3  2  2  2  2  2  1
fallo:   *  *  *  *     *  *  *  *  *  *        *  *        *  *  *   = 15

LRU      7  7  7  2  2  2  2  4  4  4  0  0  0  1  1  1  1  1  1  1
            0  0  0  0  0  0  0  0  3  3  3  3  3  3  0  0  0  0  0
               1  1  1  3  3  3  2  2  2  2  2  2  2  2  2  7  7  7
fallo:   *  *  *  *     *     *  *  *  *        *     *     *         = 12

ÓPTIMO   7  7  7  2  2  2  2  2  2  2  2  2  2  2  2  2  2  7  7  7
            0  0  0  0  0  0  4  4  4  0  0  0  0  0  0  0  0  0  0
               1  1  1  3  3  3  3  3  3  3  3  1  1  1  1  1  1  1
fallo:   *  *  *  *     *     *        *        *           *         = 9</pre>
<b>Cómo decidir la víctima en cada caso:</b><br>
&bull; <b>FIFO</b>: la más antigua en entrar, sin importar el uso. Se implementa con una cola: se expulsa la cabeza, se inserta por la cola.<br>
&bull; <b>LRU</b>: mire hacia <i>atrás</i> en la cadena; la víctima es la que lleva más tiempo sin aparecer.<br>
&bull; <b>ÓPTIMO</b>: mire hacia <i>adelante</i>; la víctima es la que reaparece más tarde (y si alguna no reaparece nunca, es esa).<br>
<b>Detalle instructivo:</b> en la referencia 8 (a la página 4), LRU expulsa la página 2 sin saber que se usará en el
paso siguiente. Esa es exactamente la ceguera que paga por no conocer el futuro.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 12 ---------------- -->
<h3>Pregunta 12 &mdash; la anomalía de Belady</h3>
<p class="enunciado">Con la cadena <code>1, 2, 3, 4, 1, 2, 5, 1, 2, 3, 4, 5</code> y <b>FIFO</b>, cuente los fallos:</p>
<div class="comando">
con 3 marcos: <input type="text" name="respuesta_107" value="<?php echo r(107); ?>" size="5"> fallos<br>
con 4 marcos: <input type="text" name="respuesta_108" value="<?php echo r(108); ?>" size="5"> fallos
</div>
<p class="enunciado">Ese resultado inesperado &mdash; que <b>más marcos produzcan más fallos</b> &mdash; se llama
<input type="text" name="respuesta_27" value="<?php echo r(27); ?>" size="20"> <?php echo v(27) ?>.</p>
<p class="enunciado">(Verdadero/Falso) Los algoritmos Óptimo y LRU <b>también</b> pueden sufrir esa anomalía.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_30" value="Verdadero" <?php echo chk(30, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_30" value="Falso" <?php echo chk(30, 'Falso'); ?>> Falso</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(107) ?><?php echo v(108) ?><?php echo v(30) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>9 fallos con 3 marcos y 10 con 4</b>: la <b>anomalía de Belady</b>. Y es <b>Falso</b> que OPT y LRU la sufran.<br>
<b>La razón, que es lo que suelen preguntar:</b> OPT y LRU son <b>algoritmos de pila</b> (<i>stack algorithms</i>).
Un algoritmo de pila cumple que el conjunto de páginas en memoria con <code>n</code> marcos es siempre un
<b>subconjunto</b> del que habría con <code>n+1</code> marcos. Si eso se cumple, añadir memoria nunca puede empeorar:
toda página que estaría presente con n marcos, lo está también con n+1. FIFO no cumple esa propiedad, porque
la antigüedad de entrada no respeta esa inclusión.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 13 ---------------- -->
<h3>Pregunta 13 &mdash; aproximaciones a LRU</h3>
<p class="enunciado">El bit que el hardware pone en 1 cuando se referencia una página (y que el SO limpia
periódicamente) es el bit de <input type="text" name="respuesta_28" value="<?php echo r(28); ?>" size="14"> <?php echo v(28) ?>.</p>
<p class="enunciado">El algoritmo que es FIFO pero perdona a la página cuyo bit de referencia está en 1 (limpiándoselo
y pasando a la siguiente) se llama algoritmo de
<input type="text" name="respuesta_29" value="<?php echo r(29); ?>" size="22"> <?php echo v(29) ?>.</p>
<p class="enunciado">En la versión <b>mejorada</b>, se usan los pares (referencia, modificado). ¿Cuál clase es la
<b>mejor</b> candidata a ser reemplazada, y cuál la <b>peor</b>?</p>
<p>
Mejor candidata: <input type="text" name="respuesta_32" value="<?php echo r(32); ?>" size="8"> <?php echo v(32) ?>
&nbsp;&nbsp; Peor candidata: <input type="text" name="respuesta_33" value="<?php echo r(33); ?>" size="8"> <?php echo v(33) ?>
</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
Bit de <b>referencia</b>; algoritmo de <b>segunda oportunidad</b> (también llamado <b>del reloj</b>);
mejor candidata <b>(0,0)</b>, peor <b>(1,1)</b>.<br>
<b>Las cuatro clases en orden:</b>
<pre>(0,0) ni usada ni modificada  -> la mejor para reemplazar
(0,1) no usada pero modificada -> hay que escribirla primero
(1,0) usada pero limpia        -> probablemente se use de nuevo
(1,1) usada y modificada       -> la peor: se usará y hay que escribirla</pre>
Se reemplaza la <i>primera página de la clase no vacía más baja</i>, lo que puede exigir varias vueltas al reloj.
<b>Diferencia con el reloj simple:</b> este da preferencia a no reemplazar páginas sucias, para <b>reducir la E/S</b>.<br>
<b>Dos casos límite del reloj:</b> si todos los bits están en 1, el puntero da la vuelta completa limpiándolos todos
y el algoritmo <b>degenera en FIFO puro</b>. Si se registran los bits de referencia cada cierto intervalo en un byte
de historia (<i>additional-reference-bits</i>), <code>11000100</code> se usó más recientemente que <code>01110111</code>,
y <code>00000000</code> no se ha usado en ocho períodos.
</div>
<?php endif; ?>

<p class="enunciado">Los dos algoritmos basados en <b>contar</b> referencias: reemplazar la de cuenta más pequeña es
<input type="text" name="respuesta_34" value="<?php echo r(34); ?>" size="8"> <?php echo v(34) ?>
y reemplazar la de cuenta más grande es
<input type="text" name="respuesta_35" value="<?php echo r(35); ?>" size="8"> <?php echo v(35) ?>.</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>LFU</b> (<i>least frequently used</i>) y <b>MFU</b> (<i>most frequently used</i>). Ninguno es común: son caros de
implementar y aproximan mal a OPT. Problema de LFU: una página muy usada al arrancar queda con una cuenta enorme y
no se va nunca (solución: desplazar las cuentas a la derecha periódicamente, un promedio que decae). Argumento de MFU:
la de cuenta pequeña probablemente acaba de llegar y aún no se ha usado.<br>
<b>Dato contraintuitivo útil:</b> en un <i>data warehouse</i> que hace lecturas secuenciales masivas y vuelve a empezar,
<b>MFU puede ser más eficiente que LRU</b>, porque LRU descarta justamente las páginas viejas que la aplicación
volverá a leer. De ahí que algunas bases de datos pidan <b>raw I/O</b>: saltarse el sistema de archivos y administrar
su propio buffer.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 14 ---------------- -->
<h3>Pregunta 14 &mdash; asignación de marcos</h3>
<p class="enunciado">El número <b>mínimo</b> de marcos por proceso lo define
<input type="text" name="respuesta_40" value="<?php echo r(40); ?>" size="20"> <?php echo v(40) ?>
(porque una instrucción debe poder completarse tras reiniciarse); el máximo lo define la memoria física disponible.</p>
<p class="enunciado">Las dos políticas de reparto: dar <code>m/n</code> marcos a cada proceso es asignación
<input type="text" name="respuesta_36" value="<?php echo r(36); ?>" size="14"> <?php echo v(36) ?>;
repartir según el tamaño de cada proceso es asignación
<input type="text" name="respuesta_37" value="<?php echo r(37); ?>" size="14"> <?php echo v(37) ?>.</p>
<div class="comando">
<b>Equitativa:</b> 93 marcos entre 5 procesos &rarr; <input type="text" name="respuesta_109" value="<?php echo r(109); ?>" size="5"> marcos cada uno<br>
<b>Proporcional:</b> 62 marcos; proceso A de 10 páginas, proceso B de 127 páginas<br>
&nbsp;&nbsp; a<sub>A</sub> = 10/137 &times; 62 &asymp; <input type="text" name="respuesta_110" value="<?php echo r(110); ?>" size="5">
&nbsp;&nbsp; a<sub>B</sub> = 127/137 &times; 62 &asymp; <input type="text" name="respuesta_111" value="<?php echo r(111); ?>" size="5">
</div>
<button type="submit">Enviar</button>
<?php echo v(109) ?><?php echo v(110) ?><?php echo v(111) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>La arquitectura</b> (el conjunto de instrucciones); asignación <b>equitativa</b> y <b>proporcional</b>;
<b>18</b> marcos cada uno (y 3 sobrantes al pool); <b>4</b> y <b>57</b> marcos.<br>
<b>Por qué la arquitectura fija el mínimo:</b> si una instrucción puede referenciar memoria con un nivel de indirección
(marco de la instrucción + marco del operando + marco del dato apuntado), hacen falta <b>al menos 3 marcos</b>.
Si además la instrucción cruza dos marcos y sus dos operandos son indirectos, se llega a <b>6</b>. Con menos marcos
que eso la instrucción <i>nunca</i> podría terminar: fallaría, se reiniciaría y volvería a fallar para siempre.<br>
<b>Observación del libro:</b> ni la equitativa ni la proporcional miran la <b>prioridad</b>. Una variante reparte según
prioridad, o según prioridad y tamaño combinados.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 15 ---------------- -->
<h3>Pregunta 15 &mdash; local vs. global (chequeo 9)</h3>
<p class="enunciado">¿Cuál es la diferencia fundamental entre reemplazo local y global de páginas? Complete:</p>
<p>
El reemplazo <input type="text" name="respuesta_38" value="<?php echo r(38); ?>" size="10"> <?php echo v(38) ?>
permite tomar un marco <b>de cualquier proceso</b>, incluso si está asignado a otro.<br>
El reemplazo <input type="text" name="respuesta_39" value="<?php echo r(39); ?>" size="10"> <?php echo v(39) ?>
obliga a cada proceso a elegir <b>solo entre sus propios</b> marcos.
</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Global</b> y <b>local</b>.<br>
<b>El intercambio, que es lo que se evalúa:</b> con reemplazo <b>global</b> el número de marcos de un proceso
<i>cambia</i> con el tiempo, y su rendimiento depende del comportamiento de <b>los demás</b> procesos: la misma
ejecución puede tardar 0.5 s una vez y 4.3 s la siguiente, por causas totalmente externas. Con reemplazo
<b>local</b> el rendimiento es reproducible, pero un proceso no puede aprovechar páginas poco usadas de otros.<br>
<b>En la práctica se usa global</b>, porque da mayor <i>throughput</i> del sistema. Y hoy no se espera a que la lista
llegue a cero: cuando el número de marcos libres baja de un <b>umbral mínimo</b>, se despierta una rutina del kernel
(un <b>reaper</b>) que recupera páginas hasta alcanzar el <b>umbral máximo</b>, y luego se suspende.
</div>
<?php endif; ?>

<p class="enunciado">Las rutinas del kernel que recuperan páginas cuando la memoria libre baja del umbral mínimo se
llaman <input type="text" name="respuesta_41" value="<?php echo r(41); ?>" size="12"> <?php echo v(41) ?>;
y la rutina de Linux que, en el extremo, <b>mata un proceso</b> para liberar su memoria es el
<input type="text" name="respuesta_42" value="<?php echo r(42); ?>" size="14"> <?php echo v(42) ?>.</p>
<p class="enunciado">En los sistemas donde una CPU accede más rápido a cierta parte de la memoria que a otra
(<input type="text" name="respuesta_43" value="<?php echo r(43); ?>" size="8"> <?php echo v(43) ?>),
el SO procura asignar los marcos lo más &laquo;cerca&raquo; posible de la CPU donde corre el proceso.</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Reapers</b>, <b>OOM killer</b> y <b>NUMA</b>.<br>
El <i>OOM score</i> se calcula según el <b>porcentaje de memoria</b> que usa el proceso: más porcentaje, más
probabilidad de ser elegido (visible en <code>/proc/&lt;pid&gt;/oom_score</code>).<br>
En NUMA, Linux mantiene una <b>free-frame list por nodo</b> y no deja que los hilos migren entre dominios de
planificación; Solaris agrupa CPUs y memoria en <b>lgroups</b>. En ambos casos el objetivo es que el planificador y
el gestor de memoria <b>cooperen</b>: colocar el hilo y sus marcos en el mismo lugar.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 16 ---------------- -->
<h3>Pregunta 16 &mdash; thrashing (chequeo 10)</h3>
<p class="enunciado">¿Cuál término describe la situación en la que un proceso pasa <b>más tiempo paginando que ejecutándose</b>?</p>
<p><input type="text" name="respuesta_44" value="<?php echo r(44); ?>" size="22"> <?php echo v(44) ?></p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Thrashing</b> (hiperpaginación).<br>
<b>El círculo vicioso, que es lo que hay que poder narrar:</b>
<pre>1. El SO ve baja utilización de CPU.
2. Sube el grado de multiprogramación (mete otro proceso).
3. Un proceso entra en una fase nueva y necesita más marcos: empieza a fallar.
4. Con reemplazo GLOBAL, les roba marcos a otros procesos.
5. Esos procesos también empiezan a fallar y a robar marcos.
6. Todos se encolan en el dispositivo de paginación; la ready queue se vacía.
7. La utilización de CPU BAJA aún más.
8. El planificador ve la baja utilización y... vuelve al paso 2.</pre>
El sistema entra en barrena: el <i>throughput</i> se desploma y <b>nadie hace trabajo útil</b>.
<b>La ironía</b> es que el mecanismo de corrección (subir la multiprogramación) es la causa del problema.
</div>
<?php endif; ?>

<div class="svgbox">
<svg viewBox="0 0 560 250" xmlns="http://www.w3.org/2000/svg">
  <rect x="1" y="1" width="558" height="248" fill="#ffffff" stroke="#cbd5e0"/>
  <defs>
    <marker id="c10" viewBox="0 0 10 10" refX="9" refY="5" markerWidth="7" markerHeight="7" orient="auto">
      <path d="M0 1L10 5L0 9Z" fill="#2d3748"/>
    </marker>
  </defs>

  <line x1="60" y1="210" x2="520" y2="210" stroke="#2d3748" stroke-width="1.4" marker-end="url(#c10)"/>
  <line x1="60" y1="210" x2="60" y2="25" stroke="#2d3748" stroke-width="1.4" marker-end="url(#c10)"/>
  <text x="290" y="235" font-size="11.5" text-anchor="middle" fill="#2d3748" font-family="Arial">grado de multiprogramación</text>
  <text x="22" y="120" font-size="11.5" text-anchor="middle" fill="#2d3748" font-family="Arial" transform="rotate(-90 22 120)">utilización de CPU</text>

  <path d="M60 195 C 140 150, 200 85, 275 62" fill="none" stroke="#2f855a" stroke-width="2.6"/>
  <path d="M275 62 C 300 58, 315 60, 325 68" fill="none" stroke="#b7791f" stroke-width="2.6"/>
  <path d="M325 68 C 360 105, 420 170, 495 198" fill="none" stroke="#c53030" stroke-width="2.6"/>

  <line x1="300" y1="40" x2="300" y2="205" stroke="#718096" stroke-width="1" stroke-dasharray="5 4"/>
  <text x="300" y="33" font-size="10.5" text-anchor="middle" fill="#4a5568" font-family="Arial">máximo</text>

  <text x="150" y="120" font-size="11" fill="#2f855a" font-family="Arial">sube, cada vez</text>
  <text x="150" y="134" font-size="11" fill="#2f855a" font-family="Arial">más despacio</text>

  <text x="415" y="110" font-size="12.5" fill="#c53030" font-family="Arial" font-weight="bold">THRASHING</text>
  <text x="415" y="126" font-size="10.5" fill="#c53030" font-family="Arial">la CPU se desploma</text>

  <rect x="330" y="150" width="200" height="40" rx="4" fill="#fff5f5" stroke="#c53030" stroke-dasharray="4 3"/>
  <text x="430" y="166" font-size="10" text-anchor="middle" fill="#742a2a" font-family="Arial">para salir hay que BAJAR el grado</text>
  <text x="430" y="180" font-size="10" text-anchor="middle" fill="#742a2a" font-family="Arial">de multiprogramación (contraintuitivo)</text>
</svg>
</div>
<p class="cap">Figura 10.20 &mdash; utilización de CPU frente al grado de multiprogramación.</p>
<hr>

<!-- ---------------- Pregunta 17 ---------------- -->
<h3>Pregunta 17 &mdash; conjunto de trabajo (chequeo 11)</h3>
<p class="enunciado">¿Cuál término se emplea para describir el conjunto de páginas que está referenciando un proceso
actualmente? <input type="text" name="respuesta_45" value="<?php echo r(45); ?>" size="22"> <?php echo v(45) ?></p>
<p class="enunciado">Y el conjunto de páginas que se usan <b>activamente juntas</b> en una fase del programa (la base
teórica del anterior) es una <input type="text" name="respuesta_46" value="<?php echo r(46); ?>" size="14"> <?php echo v(46) ?>.</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Conjunto de trabajo</b> (<i>working set</i>) y <b>localidad</b>.<br>
Un programa se mueve <b>de localidad en localidad</b>: cuando se llama a una función se define una nueva localidad
(sus instrucciones, sus variables locales, parte de las globales); al salir, se abandona. Las localidades se
<b>solapan</b> parcialmente.<br>
<b>El modelo del conjunto de trabajo es la aproximación práctica de la localidad:</b> en vez de adivinar las fases del
programa, se mira una ventana de las últimas <code>&Delta;</code> referencias.
</div>
<?php endif; ?>

<p class="enunciado">Con la tabla de referencias del libro y <code>&Delta; =
<input type="text" name="respuesta_112" value="<?php echo r(112); ?>" size="4"> <?php echo v(112) ?></code> referencias:</p>
<div class="comando">
...2 6 1 5 7 7 7 7 5 1 6 2 3 4 1 2 3 4 4 4 3 4 3 4 4 4 1 3 2 3 4 4 4 3 4 4 4 ...<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#8593; t1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#8593; t2<br>
WS(t1) = {1, 2, 5, 6, 7} &nbsp;&nbsp;&nbsp; WS(t2) = {3, 4}
</div>
<p class="enunciado">(Verdadero/Falso) Si <code>D = &Sigma; WSS<sub>i</sub></code> (la demanda total de marcos) excede
el número total de marcos disponibles <code>m</code>, habrá thrashing.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_48" value="Verdadero" <?php echo chk(48, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_48" value="Falso" <?php echo chk(48, 'Falso'); ?>> Falso</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(48) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>&Delta; = 10</b> referencias, y la afirmación es <b>Verdadera</b>: si <code>D &gt; m</code>, algunos procesos
se quedan sin marcos suficientes y empieza el thrashing.<br>
<b>Cómo lo usa el SO:</b> vigila el conjunto de trabajo de cada proceso y le asigna <code>WSS<sub>i</sub></code> marcos.
Si sobran marcos, puede iniciar otro proceso; si <code>&Sigma;WSS</code> supera a <code>m</code>, <b>suspende</b> un proceso
y reparte sus marcos. Así <b>previene el thrashing manteniendo la multiprogramación lo más alta posible</b>.<br>
<b>La elección de &Delta; importa:</b> muy pequeño no cubre la localidad completa; muy grande abarca varias localidades;
infinito da todas las páginas tocadas en la vida del proceso.<br>
<b>Y la relación con los fallos:</b> la tasa de fallos tiene <b>picos y valles</b> &mdash; un pico cada vez que el proceso
entra en una localidad nueva, y un valle cuando el nuevo conjunto de trabajo ya está cargado.
</div>
<?php endif; ?>

<p class="enunciado">La estrategia que ataca el thrashing <b>más directamente</b>, midiendo y controlando la tasa de
fallos con una cota superior (dar más marcos) y una inferior (quitar marcos), es la
<input type="text" name="respuesta_47" value="<?php echo r(47); ?>" size="10"> <?php echo v(47) ?>.</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>PFF</b> (<i>page-fault frequency</i>, frecuencia de fallos de página). El conjunto de trabajo es útil también para
prepaginar, pero llevar la cuenta de la ventana móvil es engorroso; el PFF mide directamente lo que importa.<br>
<b>La conclusión práctica del libro (10.6.4):</b> el thrashing es tan dañino que la mejor ingeniería es
<b>poner suficiente memoria física</b> para que todos los conjuntos de trabajo quepan a la vez, desde teléfonos hasta
servidores grandes.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 18 ---------------- -->
<h3>Pregunta 18 &mdash; cerrando el círculo con el capítulo 9</h3>
<p class="enunciado">La paginación por demanda <b>hereda</b> la fragmentación del capítulo 9: sigue habiendo
fragmentación <input type="text" name="respuesta_53" value="<?php echo r(53); ?>" size="12"> <?php echo v(53) ?>
(el último marco de un proceso), porque el tamaño de marco sigue siendo fijo.</p>
<p class="enunciado">Y el <b>trap</b> que en el capítulo 9 era un error fatal de direccionamiento, en el capítulo 10 se
convierte en un <input type="text" name="respuesta_54" value="<?php echo r(54); ?>" size="18"> <?php echo v(54) ?>
que el sistema operativo <b>atiende y resuelve</b>.</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
Fragmentación <b>interna</b>; y el trap se convierte en un <b>fallo de página</b>.
<b>Ese cambio de significado es la esencia de la conexión entre los dos capítulos:</b> no se añadió hardware nuevo,
se reinterpretó el que ya existía.
</div>
<?php endif; ?>

<p>Escriba de memoria el círculo vicioso del thrashing (práctica libre):</p>
<textarea class="libre" name="libre_1" rows="5"><?php echo libre(1); ?></textarea>

<hr>
<strong>si desea ver las soluciones escribir: mostrar_solucion</strong>
<br>
<input type="text" id="mostrar_solucion" name="mostrar_solucion" value="<?php echo htmlspecialchars($mostrar_solucion, ENT_QUOTES, 'UTF-8'); ?>">
<button type="submit">Mostrar Solución</button>

</div>
</div>

<!-- =====================================================  MAPA FINAL (ancho completo)  ===================================================== -->
<div class="ancho">
<h2>Mapa de los dos capítulos</h2>
<p>Si puede recorrer este diagrama explicando cada flecha, tiene los capítulos 9 y 10 conectados.</p>
<div class="svgbox">
<svg viewBox="0 0 1120 420" xmlns="http://www.w3.org/2000/svg">
  <rect x="1" y="1" width="1118" height="418" fill="#fdfdff" stroke="#cbd5e0"/>
  <defs>
    <marker id="m10" viewBox="0 0 10 10" refX="9" refY="5" markerWidth="7" markerHeight="7" orient="auto">
      <path d="M0 1L10 5L0 9Z" fill="#4a5568"/>
    </marker>
  </defs>

  <!-- franja capítulo 9 -->
  <rect x="15" y="15" width="1090" height="118" rx="7" fill="#f7fafc" stroke="#a0aec0" stroke-dasharray="6 4"/>
  <text x="62" y="36" font-size="13" fill="#2d3748" font-family="Arial" font-weight="bold">CAPÍTULO 9</text>

  <rect x="160" y="48" width="135" height="46" rx="5" fill="#ebf8ff" stroke="#2b6cb0"/>
  <text x="227" y="67" font-size="10.5" text-anchor="middle" fill="#1a365d" font-family="Arial">base + límite</text>
  <text x="227" y="82" font-size="9" text-anchor="middle" fill="#4a5568" font-family="Arial">protección por hardware</text>

  <line x1="295" y1="71" x2="330" y2="71" stroke="#4a5568" stroke-width="1.4" marker-end="url(#m10)"/>

  <rect x="332" y="48" width="150" height="46" rx="5" fill="#fff5f5" stroke="#c53030"/>
  <text x="407" y="64" font-size="10.5" text-anchor="middle" fill="#742a2a" font-family="Arial">asignación contigua</text>
  <text x="407" y="78" font-size="9" text-anchor="middle" fill="#742a2a" font-family="Arial">first / best / worst fit</text>
  <text x="407" y="89" font-size="9" text-anchor="middle" fill="#c53030" font-family="Arial">frag. EXTERNA · compactar es caro</text>

  <line x1="482" y1="71" x2="517" y2="71" stroke="#4a5568" stroke-width="1.4" marker-end="url(#m10)"/>

  <rect x="519" y="48" width="150" height="46" rx="5" fill="#f0fff4" stroke="#2f855a"/>
  <text x="594" y="66" font-size="11" text-anchor="middle" fill="#22543d" font-family="Arial" font-weight="bold">PAGINACIÓN</text>
  <text x="594" y="80" font-size="9" text-anchor="middle" fill="#22543d" font-family="Arial">páginas · marcos · tabla de páginas</text>
  <text x="594" y="91" font-size="9" text-anchor="middle" fill="#dd6b20" font-family="Arial">frag. INTERNA</text>

  <line x1="669" y1="71" x2="704" y2="71" stroke="#4a5568" stroke-width="1.4" marker-end="url(#m10)"/>

  <rect x="706" y="48" width="118" height="46" rx="5" fill="#fefcbf" stroke="#b7791f"/>
  <text x="765" y="68" font-size="11" text-anchor="middle" fill="#744210" font-family="Arial" font-weight="bold">TLB</text>
  <text x="765" y="82" font-size="9" text-anchor="middle" fill="#744210" font-family="Arial">miss = 1 acceso extra</text>

  <line x1="824" y1="71" x2="859" y2="71" stroke="#4a5568" stroke-width="1.4" marker-end="url(#m10)"/>

  <rect x="861" y="48" width="175" height="46" rx="5" fill="#faf5ff" stroke="#6b46c1"/>
  <text x="948" y="65" font-size="10" text-anchor="middle" fill="#44337a" font-family="Arial">tabla demasiado grande &rarr;</text>
  <text x="948" y="79" font-size="9.5" text-anchor="middle" fill="#44337a" font-family="Arial">jerárquica · hash · invertida</text>
  <text x="948" y="90" font-size="9" text-anchor="middle" fill="#44337a" font-family="Arial">+ swapping con paginación</text>

  <text x="594" y="118" font-size="10" text-anchor="middle" fill="#4a5568" font-family="Arial">En todo el capítulo 9 el proceso DEBE estar completo en memoria</text>

  <!-- bisagra -->
  <line x1="560" y1="133" x2="560" y2="160" stroke="#2f855a" stroke-width="2.4" marker-end="url(#m10)"/>
  <rect x="300" y="160" width="520" height="40" rx="6" fill="#f0fff4" stroke="#2f855a" stroke-width="2"/>
  <text x="560" y="177" font-size="11.5" text-anchor="middle" fill="#22543d" font-family="Arial" font-weight="bold">LA BISAGRA: se reinterpreta el bit válido&ndash;inválido</text>
  <text x="560" y="192" font-size="10" text-anchor="middle" fill="#22543d" font-family="Arial">cap. 9: inválido = dirección ILEGAL (error fatal) &nbsp;&rarr;&nbsp; cap. 10: inválido = LEGAL, pero está en disco</text>

  <!-- franja capítulo 10 -->
  <rect x="15" y="215" width="1090" height="195" rx="7" fill="#f7fafc" stroke="#a0aec0" stroke-dasharray="6 4"/>
  <text x="62" y="236" font-size="13" fill="#2d3748" font-family="Arial" font-weight="bold">CAPÍTULO 10</text>

  <line x1="560" y1="200" x2="560" y2="245" stroke="#2f855a" stroke-width="2.4" marker-end="url(#m10)"/>
  <rect x="440" y="245" width="240" height="42" rx="5" fill="#f0fff4" stroke="#2f855a" stroke-width="1.8"/>
  <text x="560" y="262" font-size="11.5" text-anchor="middle" fill="#22543d" font-family="Arial" font-weight="bold">PAGINACIÓN POR DEMANDA</text>
  <text x="560" y="277" font-size="9.5" text-anchor="middle" fill="#22543d" font-family="Arial">solo se carga la página cuando se la necesita</text>

  <!-- consecuencias -->
  <line x1="470" y1="287" x2="300" y2="315" stroke="#4a5568" stroke-width="1.4" marker-end="url(#m10)"/>
  <line x1="560" y1="287" x2="560" y2="315" stroke="#4a5568" stroke-width="1.4" marker-end="url(#m10)"/>
  <line x1="650" y1="287" x2="820" y2="315" stroke="#4a5568" stroke-width="1.4" marker-end="url(#m10)"/>

  <rect x="120" y="317" width="195" height="78" rx="5" fill="#ebf8ff" stroke="#2b6cb0"/>
  <text x="217" y="334" font-size="10.5" text-anchor="middle" fill="#1a365d" font-family="Arial" font-weight="bold">FALLO DE PÁGINA</text>
  <text x="217" y="349" font-size="9" text-anchor="middle" fill="#1a365d" font-family="Arial">6 pasos · hay que reiniciar</text>
  <text x="217" y="361" font-size="9" text-anchor="middle" fill="#1a365d" font-family="Arial">la instrucción</text>
  <text x="217" y="376" font-size="9" text-anchor="middle" fill="#c53030" font-family="Arial">cuesta ms, no ns</text>
  <text x="217" y="388" font-size="9" text-anchor="middle" fill="#c53030" font-family="Arial">TAE = (1&minus;p)ma + p&middot;t_fallo</text>

  <rect x="455" y="317" width="210" height="78" rx="5" fill="#faf5ff" stroke="#6b46c1"/>
  <text x="560" y="334" font-size="10.5" text-anchor="middle" fill="#44337a" font-family="Arial" font-weight="bold">REEMPLAZO DE PÁGINAS</text>
  <text x="560" y="349" font-size="9" text-anchor="middle" fill="#44337a" font-family="Arial">FIFO (anomalía de Belady)</text>
  <text x="560" y="361" font-size="9" text-anchor="middle" fill="#44337a" font-family="Arial">ÓPTIMO (cota inferior, irrealizable)</text>
  <text x="560" y="373" font-size="9" text-anchor="middle" fill="#44337a" font-family="Arial">LRU &asymp; reloj / segunda oportunidad</text>
  <text x="560" y="388" font-size="9" text-anchor="middle" fill="#2f855a" font-family="Arial">bit de modificado: ahorra la mitad de E/S</text>

  <rect x="820" y="317" width="215" height="78" rx="5" fill="#fff5f5" stroke="#c53030"/>
  <text x="927" y="334" font-size="10.5" text-anchor="middle" fill="#742a2a" font-family="Arial" font-weight="bold">ASIGNACIÓN DE MARCOS</text>
  <text x="927" y="349" font-size="9" text-anchor="middle" fill="#742a2a" font-family="Arial">equitativa / proporcional · local / global</text>
  <text x="927" y="364" font-size="10" text-anchor="middle" fill="#c53030" font-family="Arial" font-weight="bold">si no alcanzan &rarr; THRASHING</text>
  <text x="927" y="377" font-size="9" text-anchor="middle" fill="#742a2a" font-family="Arial">se controla con conjunto de trabajo</text>
  <text x="927" y="388" font-size="9" text-anchor="middle" fill="#742a2a" font-family="Arial">o con PFF &mdash; ambos miden la localidad</text>

  <line x1="315" y1="356" x2="452" y2="356" stroke="#4a5568" stroke-width="1.2" stroke-dasharray="4 3" marker-end="url(#m10)"/>
  <line x1="665" y1="356" x2="817" y2="356" stroke="#4a5568" stroke-width="1.2" stroke-dasharray="4 3" marker-end="url(#m10)"/>
</svg>
</div>
</div>

</form>

<div class="centered-container" style="text-align:center; margin-top:20px">
    <a class="btn btn-primary" href="../Menu.php" role="button">Volver al menú</a>
    <a class="btn btn-secondary" href="../Capitulo_9/index.php" role="button">Ir al capítulo 9</a>
</div>
</body>
</html>
