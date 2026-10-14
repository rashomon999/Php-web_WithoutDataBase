<?php
/* ============================================================
   CAPÍTULO 9 - MAIN MEMORY (Silberschatz 10e)
   Mismo esquema que Parcial_1: respuesta_N / verificar_N / mostrar_solucion
   ============================================================ */

for ($i = 1; $i <= 140; $i++) {
    ${"respuesta_" . $i} = '';
    ${"verificar_" . $i} = '';
}
for ($i = 1; $i <= 12; $i++) {
    ${"libre_" . $i} = '';
}

/* ---------- Respuestas de texto / opción (la primera es la que se muestra) ---------- */
$claves = [
    // 9.1 Background --------------------------------------------------
    1  => ['c'],                                             // base y límite
    2  => ['Tiempo de compilación', 'tiempo de compilacion', 'compilacion', 'compile time'],
    3  => ['Tiempo de carga', 'tiempo de carga', 'carga', 'load time'],
    4  => ['Tiempo de ejecución', 'tiempo de ejecucion', 'ejecucion', 'execution time', 'run time'],
    5  => ['Falso'],                                         // dir. de la CPU = física
    6  => ['MMU', 'unidad de gestion de memoria', 'memory management unit', 'unidad de administracion de memoria'],
    // Figura 9.3 - procesamiento multipaso
    7  => ['compilador', 'compiler'],
    8  => ['enlazador', 'linker', 'ligador'],
    9  => ['cargador', 'loader'],
    10 => ['relocalizable', 'reubicable', 'relocalizables', 'reubicables'],
    11 => ['absoluta', 'absolutas', 'absoluto'],
    12 => ['simbolica', 'simbolicas', 'simbolico'],
    13 => ['logica', 'logicas', 'virtual'],
    14 => ['fisica', 'fisicas'],
    // 9.1.4 / 9.1.5
    15 => ['Carga dinamica', 'carga dinamica', 'dynamic loading'],
    16 => ['Enlace dinamico', 'enlace dinamico', 'vinculacion dinamica', 'dynamic linking'],
    17 => ['Verdadero'],                                     // DLL compartida: 1 copia en memoria
    // 9.2 Asignación contigua -----------------------------------------
    18 => ['First fit', 'first fit', 'primer ajuste', 'primer hueco'],
    19 => ['Best fit', 'best fit', 'mejor ajuste'],
    20 => ['Worst fit', 'worst fit', 'peor ajuste'],
    // tabla de huecos (selects)
    21 => ['H2'], 22 => ['H5'], 23 => ['H2'], 24 => ['No cabe'],          // first fit
    25 => ['H4'], 26 => ['H2'], 27 => ['H3'], 28 => ['H5'],              // best fit
    29 => ['H5'], 30 => ['H2'], 31 => ['H5'], 32 => ['No cabe'],         // worst fit
    33 => ['Externa', 'externa', 'fragmentacion externa'],
    34 => ['Interna', 'interna', 'fragmentacion interna'],
    35 => ['Compactacion', 'compactacion', 'compaction'],
    36 => ['Falso'],                       // compactación con reubicación estática
    // 9.3 Paginación ---------------------------------------------------
    37 => ['Numero de pagina', 'numero de pagina', 'pagina', 'p', 'page number'],
    38 => ['Desplazamiento', 'desplazamiento', 'offset', 'd', 'page offset', 'desplazamiento de pagina'],
    39 => ['Marcos', 'marcos', 'frames', 'marco', 'frame'],
    40 => ['Paginas', 'paginas', 'pages', 'pagina'],
    41 => ['Tabla de paginas', 'tabla de paginas', 'page table'],
    42 => ['Tabla de marcos', 'tabla de marcos', 'frame table'],
    // bits de la entrada de la tabla de páginas
    43 => ['Numero de marco', 'numero de marco', 'marco', 'frame number', 'numero del marco'],
    44 => ['valido-invalido', 'valido invalido', 'valido/invalido', 'valid-invalid', 'validez'],
    45 => ['proteccion', 'proteccion', 'lectura/escritura', 'permisos'],
    46 => ['Verdadero'],                   // sí hay fragmentación (interna) con paginación
    47 => ['PTBR', 'page table base register', 'registro base de la tabla de paginas'],
    48 => ['PTLR', 'page table length register', 'registro de longitud de la tabla de paginas'],
    // TLB
    49 => ['TLB miss', 'tlb miss', 'fallo de tlb', 'fallo en el tlb', 'ausencia en tlb', 'miss'],
    50 => ['Tasa de aciertos', 'tasa de aciertos', 'hit ratio', 'razon de aciertos'],
    51 => ['TLB hit', 'tlb hit', 'acierto de tlb', 'acierto en el tlb', 'hit'],
    52 => ['ASID', 'asid', 'address space identifier', 'identificador de espacio de direcciones'],
    53 => ['flush', 'vaciar', 'vaciado', 'limpiar', 'borrar', 'flushear'],
    54 => ['wired down', 'wired-down', 'fijadas', 'ancladas', 'fijada'],
    // 9.4 Estructura de la tabla de páginas
    55 => ['Jerarquica', 'jerarquica', 'paginacion jerarquica', 'multinivel', 'hierarchical'],
    56 => ['Hash', 'hash', 'hashed', 'tabla hash', 'paginacion hash'],
    57 => ['Invertida', 'invertida', 'tabla de paginas invertida', 'inverted'],
    58 => ['forward-mapped', 'forward mapped', 'mapeo hacia adelante', 'mapeada hacia adelante'],
    59 => ['agrupadas', 'clustered', 'clusterizadas', 'tablas agrupadas'],
    60 => ['Falso'],                      // invertida NO permite varias vistas virtuales de un marco
    // 9.5 Swapping
    61 => ['Backing store', 'backing store', 'almacen de respaldo', 'area de intercambio', 'almacenamiento de respaldo'],
    62 => ['Falso'],                      // móviles no usan swapping
    63 => ['page out', 'pageout', 'paginar hacia afuera', 'sacar pagina'],
    64 => ['page in', 'pagein', 'paginar hacia adentro', 'traer pagina'],
    65 => ['Verdadero'],                  // swapping permite sobre-suscribir memoria
    // Conexión con el capítulo 10
    66 => ['Memoria virtual', 'memoria virtual', 'virtual memory'],
    67 => ['valido-invalido', 'valido invalido', 'valido/invalido', 'valid-invalid'],
    68 => ['Reentrante', 'reentrante', 'reentrant', 'codigo reentrante'],
];

/* ---------- Respuestas numéricas ---------- */
$numericas = [
    // Protección base/límite: base=300040, límite=120900
    101 => 300040,       // dirección legal más baja
    102 => 420939,       // dirección legal más alta
    // Relocación dinámica: registro de reubicación = 14000
    103 => 14000,        // lógica 0 -> física
    104 => 14346,        // lógica 346 -> física
    // Regla del 50 por ciento
    105 => 0.5,
    // Traducción Figura 9.10: página 4 bytes; tabla 0->5, 1->6, 2->1, 3->2
    106 => 20,           // lógica 0
    107 => 23,           // lógica 3
    108 => 24,           // lógica 4
    109 => 9,            // lógica 13
    110 => 7,            // lógica 11
    // Offset de 13 bits
    111 => 8192,         // tamaño de página en bytes
    112 => 19,           // bits de número de página en un espacio de 32 bits
    // Fragmentación interna: proceso 72766 B, página 2048 B
    113 => 35,           // páginas completas
    114 => 1086,         // bytes del resto
    115 => 36,           // marcos asignados
    116 => 962,          // fragmentación interna
    // Tiempo de acceso efectivo del TLB (acceso a memoria = 10 ns)
    117 => 12,           // 80 % de aciertos
    118 => 10.1,         // 99 % de aciertos
    // Tabla de páginas plana: 32 bits, página de 4 KB, entrada de 4 bytes
    119 => 20,           // bits de p
    120 => 12,           // bits de d
    121 => 1048576,      // número de entradas
    122 => 4,            // MB que ocupa la tabla
    // Dos niveles 10/10/12
    123 => 10,           // p1
    124 => 10,           // p2
    125 => 12,           // d
    // libc compartida: 40 procesos, 2 MB
    126 => 80,           // MB sin compartir
    127 => 2,            // MB compartiendo
];

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
    /* tolerancia: 0.001 absoluta, o 0.5 % relativa para los valores grandes */
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

function chk($n, $valor) {
    return $GLOBALS["respuesta_" . $n] === $valor ? 'checked' : '';
}

function sel($n, $valor) {
    return $GLOBALS["respuesta_" . $n] === $valor ? 'selected' : '';
}

function libre($n) {
    return htmlspecialchars($GLOBALS["libre_" . $n], ENT_QUOTES, 'UTF-8');
}

/* select reutilizable para la tabla de huecos */
function select_hueco($n) {
    $ops = ['', 'H1', 'H2', 'H3', 'H4', 'H5', 'No cabe'];
    $out = '<select name="respuesta_' . $n . '">';
    foreach ($ops as $o) {
        $txt = $o === '' ? '--' : $o;
        $out .= '<option value="' . htmlspecialchars($o, ENT_QUOTES, 'UTF-8') . '" ' . sel($n, $o) . '>' . $txt . '</option>';
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
    <title>Capítulo 9 - Memoria Principal</title>
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

    .form-container {
        display: flex;
        gap: 15px;
        align-items: flex-start;
    }

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

    h2 { font-size: 1.5rem; }
    h3 { font-size: 1.12rem; margin-top: 14px; }
    .enunciado { line-height: 1.6; }
    .opciones label { display: block; margin: 6px 0; cursor: pointer; }
    .correcto { color: #2f855a; font-weight: bold; }
    .incorrecto { color: #c53030; font-weight: bold; }

    input[type="text"], select, textarea {
        border: 1px solid #a0aec0;
        border-radius: 4px;
        padding: 2px 4px;
        font-size: 0.95rem;
    }

    code, .comando {
        font-family: Consolas, "Courier New", monospace;
        font-size: 0.93rem;
    }

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
    table.plan td .correcto, table.plan td .incorrecto { display: block; font-size: 0.7rem; }

    .solucion {
        background: #f0fff4;
        border-left: 4px solid #38a169;
        padding: 8px 12px;
        margin: 10px 0;
        font-size: 0.92rem;
        line-height: 1.55;
    }

    .solucion pre { white-space: pre-wrap; margin: 4px 0; }
    .nota {
        background: #ebf8ff;
        border-left: 4px solid #3182ce;
        padding: 8px 12px;
        margin: 10px 0;
        font-size: 0.9rem;
        line-height: 1.55;
    }
    .idea {
        background: #fffaf0;
        border-left: 4px solid #dd6b20;
        padding: 8px 12px;
        margin: 10px 0;
        font-size: 0.9rem;
        line-height: 1.55;
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

<h2>Capítulo 9 &mdash; Memoria Principal</h2>
<p>Cuestionario de estudio sobre <b>Main Memory</b> (Silberschatz, 10.ª ed.). Cubre las preguntas de chequeo del capítulo
y añade los flujos, cálculos y diagramas que las sostienen. Llene y presione <b>Enviar</b> en cada pregunta.</p>

<div class="idea">
<b>El hilo del capítulo.</b> La CPU solo sabe leer registros y memoria. Todo lo demás del capítulo responde dos preguntas:
<b>¿cómo protejo</b> la memoria de un proceso de los demás, y <b>¿cómo traduzco</b> la dirección que genera la CPU
(lógica) a la dirección que ve la memoria (física). La respuesta evoluciona así:
<br><code>base+límite &rarr; registro de reubicación &rarr; asignación contigua (first/best/worst fit) &rarr; paginación &rarr; TLB &rarr; estructuras de tabla de páginas &rarr; swapping</code>
<br>Cada paso resuelve el defecto del anterior. Esa cadena es lo que hay que poder contar de memoria.
</div>
<hr>

<!-- ---------------- Pregunta 1 ---------------- -->
<h3>Pregunta 1 &mdash; protección simple (chequeo 1)</h3>
<p class="enunciado">¿Cuál pareja de registros se puede emplear para proporcionar una forma simple de protección de memoria?</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_1" value="a" <?php echo chk(1, 'a'); ?>> a. El contador de programa y el puntero de pila</label>
    <label><input type="radio" name="respuesta_1" value="b" <?php echo chk(1, 'b'); ?>> b. El registro de instrucción y el acumulador</label>
    <label><input type="radio" name="respuesta_1" value="c" <?php echo chk(1, 'c'); ?>> c. El registro base y el registro límite</label>
    <label><input type="radio" name="respuesta_1" value="d" <?php echo chk(1, 'd'); ?>> d. El PTBR y el TLB</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(1) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>base</b> = dirección física legal más pequeña; <b>límite</b> = <i>tamaño del rango</i> (no la dirección final).
Solo el SO los carga, con una instrucción privilegiada en modo kernel. El <i>hardware</i> compara cada dirección
generada en modo usuario; si falla, <b>trap</b> al SO (error de direccionamiento fatal).
</div>
<?php endif; ?>

<p class="enunciado">Si <code>base = 300040</code> y <code>límite = 120900</code>, el proceso puede acceder legalmente desde
la dirección <input type="text" name="respuesta_101" value="<?php echo r(101); ?>" size="8"> <?php echo v(101) ?>
hasta la dirección <input type="text" name="respuesta_102" value="<?php echo r(102); ?>" size="8"> <?php echo v(102) ?> (inclusive).</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">De <b>300040</b> a <b>300040 + 120900 &minus; 1 = 420939</b>. El límite es un <i>tamaño</i>; el &minus;1 es la trampa clásica del ejercicio.</div>
<?php endif; ?>

<div class="svgbox">
<svg viewBox="0 0 560 260" xmlns="http://www.w3.org/2000/svg">
  <defs>
    <marker id="a9" viewBox="0 0 10 10" refX="9" refY="5" markerWidth="7" markerHeight="7" orient="auto">
      <path d="M0 1L10 5L0 9Z" fill="#2d3748"/>
    </marker>
  </defs>
  <rect x="1" y="1" width="558" height="258" fill="#ffffff" stroke="#cbd5e0"/>

  <rect x="20" y="105" width="70" height="40" rx="5" fill="#ebf8ff" stroke="#2b6cb0"/>
  <text x="55" y="130" font-size="15" text-anchor="middle" fill="#1a365d" font-family="Arial">CPU</text>

  <line x1="90" y1="125" x2="160" y2="125" stroke="#2d3748" stroke-width="1.5" marker-end="url(#a9)"/>
  <text x="125" y="117" font-size="10" text-anchor="middle" fill="#4a5568" font-family="Arial">dirección</text>

  <rect x="150" y="20" width="110" height="30" rx="4" fill="#faf5ff" stroke="#6b46c1"/>
  <text x="205" y="40" font-size="12" text-anchor="middle" fill="#44337a" font-family="Arial">registro base</text>
  <rect x="300" y="20" width="140" height="30" rx="4" fill="#faf5ff" stroke="#6b46c1"/>
  <text x="370" y="40" font-size="12" text-anchor="middle" fill="#44337a" font-family="Arial">base + límite</text>

  <polygon points="205,100 240,125 205,150 170,125" fill="#fefcbf" stroke="#b7791f"/>
  <text x="205" y="130" font-size="15" text-anchor="middle" fill="#744210" font-family="Arial">&#8805;</text>
  <line x1="205" y1="50" x2="205" y2="100" stroke="#6b46c1" stroke-width="1.2" stroke-dasharray="3 3"/>

  <polygon points="370,100 405,125 370,150 335,125" fill="#fefcbf" stroke="#b7791f"/>
  <text x="370" y="130" font-size="15" text-anchor="middle" fill="#744210" font-family="Arial">&lt;</text>
  <line x1="370" y1="50" x2="370" y2="100" stroke="#6b46c1" stroke-width="1.2" stroke-dasharray="3 3"/>

  <line x1="240" y1="125" x2="335" y2="125" stroke="#2d3748" stroke-width="1.5" marker-end="url(#a9)"/>
  <text x="287" y="117" font-size="10" text-anchor="middle" fill="#2f855a" font-family="Arial">sí</text>

  <line x1="405" y1="125" x2="470" y2="125" stroke="#2d3748" stroke-width="1.5" marker-end="url(#a9)"/>
  <text x="437" y="117" font-size="10" text-anchor="middle" fill="#2f855a" font-family="Arial">sí</text>
  <rect x="468" y="105" width="80" height="40" rx="5" fill="#f0fff4" stroke="#2f855a"/>
  <text x="508" y="130" font-size="12" text-anchor="middle" fill="#22543d" font-family="Arial">memoria</text>

  <line x1="205" y1="150" x2="205" y2="205" stroke="#c53030" stroke-width="1.5" marker-end="url(#a9)"/>
  <text x="215" y="172" font-size="10" fill="#c53030" font-family="Arial">no</text>
  <line x1="370" y1="150" x2="370" y2="190" stroke="#c53030" stroke-width="1.5"/>
  <line x1="370" y1="190" x2="320" y2="190" stroke="#c53030" stroke-width="1.5"/>
  <line x1="320" y1="190" x2="320" y2="205" stroke="#c53030" stroke-width="1.5" marker-end="url(#a9)"/>
  <text x="380" y="172" font-size="10" fill="#c53030" font-family="Arial">no</text>

  <rect x="130" y="205" width="270" height="40" rx="5" fill="#fff5f5" stroke="#c53030"/>
  <text x="265" y="222" font-size="12" text-anchor="middle" fill="#742a2a" font-family="Arial">trap al sistema operativo</text>
  <text x="265" y="237" font-size="11" text-anchor="middle" fill="#742a2a" font-family="Arial">error de direccionamiento ilegal</text>
</svg>
</div>
<p class="cap">Figura 9.2 &mdash; protección por hardware con registros base y límite. <b>Las dos comparaciones las hace el hardware, no el SO.</b></p>
<hr>

<!-- ---------------- Pregunta 2 ---------------- -->
<h3>Pregunta 2 &mdash; los tres tiempos del binding (chequeo 2)</h3>
<p class="enunciado">Mencione los tres tiempos en los que el <i>binding</i> (ligadura) de direcciones puede ocurrir:</p>
<p>
1. <input type="text" name="respuesta_2" value="<?php echo r(2); ?>" size="24"> <?php echo v(2) ?><br>
2. <input type="text" name="respuesta_3" value="<?php echo r(3); ?>" size="24"> <?php echo v(3) ?><br>
3. <input type="text" name="respuesta_4" value="<?php echo r(4); ?>" size="24"> <?php echo v(4) ?>
</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Compilación</b>: se sabe desde ya dónde residirá &rarr; se genera <i>código absoluto</i>; si cambia la posición hay que recompilar.<br>
<b>Carga</b>: no se sabe al compilar &rarr; el compilador genera <i>código relocalizable</i>; si cambia la posición basta recargar.<br>
<b>Ejecución</b>: el proceso puede <i>moverse</i> mientras corre &rarr; requiere hardware especial (MMU). <b>Es el que usan casi todos los SO modernos.</b>
</div>
<?php endif; ?>

<p class="enunciado">Complete la cadena de nombres que recibe una dirección en cada etapa:</p>
<p>En el programa fuente la dirección es <input type="text" name="respuesta_12" value="<?php echo r(12); ?>" size="12"> <?php echo v(12) ?>
(ej. <code>count</code>); el compilador la liga a una dirección <input type="text" name="respuesta_10" value="<?php echo r(10); ?>" size="14"> <?php echo v(10) ?>
(ej. &laquo;14 bytes desde el inicio del módulo&raquo;); el enlazador o cargador la liga a una dirección
<input type="text" name="respuesta_11" value="<?php echo r(11); ?>" size="12"> <?php echo v(11) ?> (ej. <code>74014</code>).</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion"><b>simbólica &rarr; relocalizable &rarr; absoluta</b>. Cada binding es un mapeo de un espacio de direcciones a otro.</div>
<?php endif; ?>

<p class="enunciado">Etiquete las tres herramientas del flujo (Figura 9.3):</p>
<div class="svgbox">
<svg viewBox="0 0 560 420" xmlns="http://www.w3.org/2000/svg">
  <rect x="1" y="1" width="558" height="418" fill="#ffffff" stroke="#cbd5e0"/>
  <defs>
    <marker id="b9" viewBox="0 0 10 10" refX="9" refY="5" markerWidth="7" markerHeight="7" orient="auto">
      <path d="M0 1L10 5L0 9Z" fill="#2d3748"/>
    </marker>
  </defs>

  <rect x="180" y="15" width="150" height="34" rx="4" fill="#edf2f7" stroke="#4a5568"/>
  <text x="255" y="37" font-size="13" text-anchor="middle" fill="#2d3748" font-family="Arial">programa fuente</text>
  <line x1="255" y1="49" x2="255" y2="70" stroke="#2d3748" stroke-width="1.4" marker-end="url(#b9)"/>

  <rect x="180" y="70" width="150" height="34" rx="4" fill="#ebf8ff" stroke="#2b6cb0"/>
  <foreignObject x="184" y="77" width="142" height="22">
    <input xmlns="http://www.w3.org/1999/xhtml" type="text" name="respuesta_7"
           value="<?php echo r(7); ?>" placeholder="herramienta 1"
           style="width:100%;border:none;background:transparent;font-size:13px;font-family:Arial;text-align:center;outline:none;"/>
  </foreignObject>
  <line x1="255" y1="104" x2="255" y2="128" stroke="#2d3748" stroke-width="1.4" marker-end="url(#b9)"/>
  <text x="400" y="92" font-size="12" fill="#2b6cb0" font-family="Arial">tiempo de compilación</text>
  <line x1="340" y1="87" x2="395" y2="87" stroke="#2b6cb0" stroke-width="1" stroke-dasharray="3 3"/>

  <rect x="180" y="128" width="150" height="34" rx="4" fill="#edf2f7" stroke="#4a5568"/>
  <text x="255" y="150" font-size="13" text-anchor="middle" fill="#2d3748" font-family="Arial">archivo objeto</text>
  <rect x="20" y="128" width="120" height="34" rx="4" fill="#f7fafc" stroke="#a0aec0"/>
  <text x="80" y="144" font-size="11" text-anchor="middle" fill="#4a5568" font-family="Arial">otros archivos</text>
  <text x="80" y="156" font-size="11" text-anchor="middle" fill="#4a5568" font-family="Arial">objeto</text>
  <line x1="140" y1="180" x2="178" y2="193" stroke="#2d3748" stroke-width="1.2" marker-end="url(#b9)"/>
  <line x1="255" y1="162" x2="255" y2="186" stroke="#2d3748" stroke-width="1.4" marker-end="url(#b9)"/>

  <rect x="180" y="186" width="150" height="34" rx="4" fill="#ebf8ff" stroke="#2b6cb0"/>
  <foreignObject x="184" y="193" width="142" height="22">
    <input xmlns="http://www.w3.org/1999/xhtml" type="text" name="respuesta_8"
           value="<?php echo r(8); ?>" placeholder="herramienta 2"
           style="width:100%;border:none;background:transparent;font-size:13px;font-family:Arial;text-align:center;outline:none;"/>
  </foreignObject>
  <line x1="255" y1="220" x2="255" y2="244" stroke="#2d3748" stroke-width="1.4" marker-end="url(#b9)"/>

  <rect x="180" y="244" width="150" height="34" rx="4" fill="#edf2f7" stroke="#4a5568"/>
  <text x="255" y="266" font-size="13" text-anchor="middle" fill="#2d3748" font-family="Arial">archivo ejecutable</text>
  <text x="400" y="266" font-size="12" fill="#2b6cb0" font-family="Arial">tiempo de carga</text>
  <line x1="340" y1="261" x2="395" y2="261" stroke="#2b6cb0" stroke-width="1" stroke-dasharray="3 3"/>
  <line x1="255" y1="278" x2="255" y2="302" stroke="#2d3748" stroke-width="1.4" marker-end="url(#b9)"/>

  <rect x="180" y="302" width="150" height="34" rx="4" fill="#ebf8ff" stroke="#2b6cb0"/>
  <foreignObject x="184" y="309" width="142" height="22">
    <input xmlns="http://www.w3.org/1999/xhtml" type="text" name="respuesta_9"
           value="<?php echo r(9); ?>" placeholder="herramienta 3"
           style="width:100%;border:none;background:transparent;font-size:13px;font-family:Arial;text-align:center;outline:none;"/>
  </foreignObject>
  <rect x="15" y="302" width="130" height="34" rx="4" fill="#fffaf0" stroke="#dd6b20"/>
  <text x="80" y="318" font-size="10.5" text-anchor="middle" fill="#7b341e" font-family="Arial">bibliotecas enlazadas</text>
  <text x="80" y="330" font-size="10.5" text-anchor="middle" fill="#7b341e" font-family="Arial">dinámicamente (DLL)</text>
  <line x1="145" y1="330" x2="178" y2="345" stroke="#dd6b20" stroke-width="1.2" marker-end="url(#b9)"/>
  <line x1="255" y1="336" x2="255" y2="360" stroke="#2d3748" stroke-width="1.4" marker-end="url(#b9)"/>

  <rect x="180" y="360" width="150" height="46" rx="4" fill="#f0fff4" stroke="#2f855a"/>
  <text x="255" y="380" font-size="13" text-anchor="middle" fill="#22543d" font-family="Arial">programa</text>
  <text x="255" y="396" font-size="13" text-anchor="middle" fill="#22543d" font-family="Arial">en memoria</text>
  <text x="400" y="378" font-size="12" fill="#2f855a" font-family="Arial">tiempo de ejecución</text>
  <text x="400" y="392" font-size="11" fill="#2f855a" font-family="Arial">(run time)</text>
  <line x1="340" y1="383" x2="395" y2="383" stroke="#2f855a" stroke-width="1" stroke-dasharray="3 3"/>
</svg>
</div>
<button type="submit">Enviar</button>
<?php echo v(7) ?><?php echo v(8) ?><?php echo v(9) ?>
<?php if ($ver_sol): ?>
<div class="solucion"><b>compilador &rarr; enlazador (linker) &rarr; cargador (loader)</b>. Fíjese que el <i>momento</i> en que se fija la dirección se decide por dónde se corta este flujo.</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 3 ---------------- -->
<h3>Pregunta 3 &mdash; lógica vs. física (chequeo 3)</h3>
<p class="enunciado">(Verdadero/Falso) A una dirección de memoria generada por la CPU se la conoce como dirección física.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_5" value="Verdadero" <?php echo chk(5, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_5" value="Falso" <?php echo chk(5, 'Falso'); ?>> Falso</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(5) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Falso.</b> La que genera la CPU es la dirección <b>lógica</b> (o <b>virtual</b>). La <b>física</b> es la que llega
al registro de dirección de la unidad de memoria. Con binding en compilación o carga ambas coinciden; con binding en
<i>ejecución</i> difieren, y ahí nace el concepto de espacio de direcciones virtual.
</div>
<?php endif; ?>

<p class="enunciado">Para distinguirlas, complete: la dirección que genera la CPU es
<input type="text" name="respuesta_13" value="<?php echo r(13); ?>" size="10"> <?php echo v(13) ?>
y la que ve la unidad de memoria es <input type="text" name="respuesta_14" value="<?php echo r(14); ?>" size="10"> <?php echo v(14) ?>.</p>
<button type="submit">Enviar</button>
<hr>

<!-- ---------------- Pregunta 4 ---------------- -->
<h3>Pregunta 4 &mdash; quién traduce (chequeo 4)</h3>
<p class="enunciado">¿Cuál es el dispositivo de <b>hardware</b> que mapea las direcciones lógicas a las físicas?</p>
<p><input type="text" name="respuesta_6" value="<?php echo r(6); ?>" size="30"> <?php echo v(6) ?></p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
La <b>MMU</b> (<i>memory-management unit</i>). En el esquema más simple el registro base pasa a llamarse
<b>registro de reubicación</b> y su valor se <i>suma</i> a cada dirección que el proceso envía a memoria.
El programa de usuario <b>nunca</b> ve direcciones físicas reales.
</div>
<?php endif; ?>

<p class="enunciado">Con un registro de reubicación en <code>14000</code>: la dirección lógica <code>0</code> se traduce a
<input type="text" name="respuesta_103" value="<?php echo r(103); ?>" size="8"> <?php echo v(103) ?>
y la dirección lógica <code>346</code> se traduce a
<input type="text" name="respuesta_104" value="<?php echo r(104); ?>" size="8"> <?php echo v(104) ?>.</p>

<div class="svgbox">
<svg viewBox="0 0 560 190" xmlns="http://www.w3.org/2000/svg">
  <rect x="1" y="1" width="558" height="188" fill="#ffffff" stroke="#cbd5e0"/>
  <defs>
    <marker id="c9" viewBox="0 0 10 10" refX="9" refY="5" markerWidth="7" markerHeight="7" orient="auto">
      <path d="M0 1L10 5L0 9Z" fill="#2d3748"/>
    </marker>
  </defs>
  <rect x="155" y="95" width="250" height="80" rx="6" fill="#f7fafc" stroke="#718096" stroke-dasharray="5 4"/>
  <text x="280" y="168" font-size="12" text-anchor="middle" fill="#4a5568" font-family="Arial">MMU</text>

  <rect x="200" y="20" width="120" height="34" rx="4" fill="#faf5ff" stroke="#6b46c1"/>
  <text x="260" y="34" font-size="10.5" text-anchor="middle" fill="#44337a" font-family="Arial">registro de reubicación</text>
  <text x="260" y="48" font-size="13" text-anchor="middle" fill="#44337a" font-family="Arial" font-weight="bold">14000</text>
  <line x1="260" y1="54" x2="260" y2="105" stroke="#6b46c1" stroke-width="1.3" marker-end="url(#c9)"/>

  <rect x="25" y="105" width="70" height="40" rx="5" fill="#ebf8ff" stroke="#2b6cb0"/>
  <text x="60" y="130" font-size="15" text-anchor="middle" fill="#1a365d" font-family="Arial">CPU</text>
  <line x1="95" y1="125" x2="238" y2="125" stroke="#2d3748" stroke-width="1.5" marker-end="url(#c9)"/>
  <text x="160" y="117" font-size="10" text-anchor="middle" fill="#4a5568" font-family="Arial">dirección lógica</text>
  <text x="160" y="140" font-size="13" text-anchor="middle" fill="#2b6cb0" font-family="Arial" font-weight="bold">346</text>

  <circle cx="260" cy="125" r="18" fill="#fefcbf" stroke="#b7791f"/>
  <text x="260" y="131" font-size="17" text-anchor="middle" fill="#744210" font-family="Arial">+</text>

  <line x1="278" y1="125" x2="455" y2="125" stroke="#2d3748" stroke-width="1.5" marker-end="url(#c9)"/>
  <text x="365" y="117" font-size="10" text-anchor="middle" fill="#4a5568" font-family="Arial">dirección física</text>
  <text x="365" y="140" font-size="13" text-anchor="middle" fill="#2f855a" font-family="Arial" font-weight="bold">14346</text>
  <rect x="455" y="105" width="85" height="40" rx="5" fill="#f0fff4" stroke="#2f855a"/>
  <text x="497" y="130" font-size="12" text-anchor="middle" fill="#22543d" font-family="Arial">memoria</text>
</svg>
</div>
<p class="cap">Figura 9.5 &mdash; reubicación dinámica. La traducción es <b>una suma</b>, y ocurre en cada referencia.</p>
<button type="submit">Enviar</button>
<hr>

<!-- ---------------- Pregunta 5 ---------------- -->
<h3>Pregunta 5 &mdash; carga y enlace dinámicos</h3>
<p class="enunciado">Nombre la técnica en la que <b>una rutina no se carga hasta que se la llama</b>, y la técnica
en la que <b>el enlazado (no la carga) se posterga hasta el tiempo de ejecución</b>:</p>
<p>
No se carga hasta llamarla: <input type="text" name="respuesta_15" value="<?php echo r(15); ?>" size="20"> <?php echo v(15) ?><br>
Enlazado postergado a ejecución: <input type="text" name="respuesta_16" value="<?php echo r(16); ?>" size="20"> <?php echo v(16) ?>
</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Carga dinámica</b> (<i>dynamic loading</i>) y <b>enlace dinámico</b> (<i>dynamic linking</i>, las DLL o bibliotecas compartidas).<br>
Diferencia de examen: la <b>carga dinámica no necesita ayuda del SO</b> (es responsabilidad del programador);
el <b>enlace dinámico sí la necesita</b>, porque hay que verificar/compartir memoria entre procesos protegidos.
</div>
<?php endif; ?>

<p class="enunciado">(Verdadero/Falso) Gracias a las DLL basta con <b>una sola instancia</b> de la biblioteca en memoria principal, aunque la usen muchos procesos.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_17" value="Verdadero" <?php echo chk(17, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_17" value="Falso" <?php echo chk(17, 'Falso'); ?>> Falso</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(17) ?>
<?php if ($ver_sol): ?>
<div class="solucion"><b>Verdadero.</b> Por eso también se llaman <i>bibliotecas compartidas</i>. Se implementan con <b>páginas compartidas</b> (9.3.4), y la información de versión evita que un programa ejecute una versión incompatible.</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 6 ---------------- -->
<h3>Pregunta 6 &mdash; estrategias de hueco (chequeo 5)</h3>
<p class="enunciado">¿Cuáles son las tres estrategias para seleccionar un hueco de memoria libre? Descríbalas en una línea.</p>
<p>
1. <input type="text" name="respuesta_18" value="<?php echo r(18); ?>" size="18"> <?php echo v(18) ?> &rarr; el primer hueco suficientemente grande.<br>
2. <input type="text" name="respuesta_19" value="<?php echo r(19); ?>" size="18"> <?php echo v(19) ?> &rarr; el hueco <i>más pequeño</i> que alcance.<br>
3. <input type="text" name="respuesta_20" value="<?php echo r(20); ?>" size="18"> <?php echo v(20) ?> &rarr; el hueco <i>más grande</i>.
</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>First fit, best fit, worst fit.</b> First fit y best fit son mejores que worst fit en tiempo y utilización;
entre esos dos ninguno gana claramente en utilización, pero <b>first fit es generalmente más rápido</b>
(best fit obliga a recorrer toda la lista si no está ordenada).
</div>
<?php endif; ?>

<p class="enunciado">Huecos libres, <b>en este orden de memoria</b>:
<code>H1=100K, H2=500K, H3=200K, H4=300K, H5=600K</code>.
Llegan en secuencia los procesos de <code>212K, 417K, 112K, 426K</code>.
Indique en cuál hueco queda cada proceso (o <code>No cabe</code>). Un hueco se puede reutilizar si quedó espacio sobrante.</p>
<table class="plan">
<tr><th>Estrategia</th><th>212K</th><th>417K</th><th>112K</th><th>426K</th></tr>
<tr>
  <td><b>First fit</b></td>
  <td><?php echo select_hueco(21); ?><?php echo v(21) ?></td>
  <td><?php echo select_hueco(22); ?><?php echo v(22) ?></td>
  <td><?php echo select_hueco(23); ?><?php echo v(23) ?></td>
  <td><?php echo select_hueco(24); ?><?php echo v(24) ?></td>
</tr>
<tr>
  <td><b>Best fit</b></td>
  <td><?php echo select_hueco(25); ?><?php echo v(25) ?></td>
  <td><?php echo select_hueco(26); ?><?php echo v(26) ?></td>
  <td><?php echo select_hueco(27); ?><?php echo v(27) ?></td>
  <td><?php echo select_hueco(28); ?><?php echo v(28) ?></td>
</tr>
<tr>
  <td><b>Worst fit</b></td>
  <td><?php echo select_hueco(29); ?><?php echo v(29) ?></td>
  <td><?php echo select_hueco(30); ?><?php echo v(30) ?></td>
  <td><?php echo select_hueco(31); ?><?php echo v(31) ?></td>
  <td><?php echo select_hueco(32); ?><?php echo v(32) ?></td>
</tr>
</table>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<pre>First fit: 212K&rarr;H2 (quedan 288K) · 417K&rarr;H5 (quedan 183K) · 112K&rarr;H2 resto (quedan 176K) · 426K&rarr;NO CABE
Best  fit: 212K&rarr;H4 (quedan  88K) · 417K&rarr;H2 (quedan  83K) · 112K&rarr;H3     (quedan  88K) · 426K&rarr;H5 (quedan 174K)
Worst fit: 212K&rarr;H5 (quedan 388K) · 417K&rarr;H2 (quedan  83K) · 112K&rarr;H5 resto (quedan 276K) · 426K&rarr;NO CABE</pre>
<b>Best fit es la única que acomoda los cuatro procesos</b> en este ejercicio clásico. Eso no la hace mejor en general:
deja huecos minúsculos que alimentan la fragmentación externa.
</div>
<?php endif; ?>
<p>Escriba su razonamiento (práctica libre):</p>
<textarea class="libre" name="libre_1" rows="3"><?php echo libre(1); ?></textarea>
<hr>

<!-- ---------------- Pregunta 7 ---------------- -->
<h3>Pregunta 7 &mdash; las dos fragmentaciones (chequeo 6)</h3>
<p class="enunciado">¿Cuáles son las dos formas de fragmentación? Nómbrelas según su definición:</p>
<p>
Hay memoria libre total suficiente, pero <b>no contigua</b>: fragmentación
<input type="text" name="respuesta_33" value="<?php echo r(33); ?>" size="12"> <?php echo v(33) ?><br>
Se asigna un bloque de tamaño fijo <b>mayor</b> al pedido y sobra espacio <b>dentro</b> de la partición: fragmentación
<input type="text" name="respuesta_34" value="<?php echo r(34); ?>" size="12"> <?php echo v(34) ?>
</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Externa</b>: el espacio libre está roto en muchos huecos pequeños. Es el mal de la asignación <i>contigua</i>.<br>
<b>Interna</b>: espacio desperdiciado <i>dentro</i> del bloque asignado. Es el mal de la asignación por <i>bloques de tamaño fijo</i> (paginación).<br>
Regla mnemotécnica: <b>externa = entre</b> procesos, <b>interna = dentro</b> del bloque.
</div>
<?php endif; ?>

<div class="svgbox">
<svg viewBox="0 0 560 215" xmlns="http://www.w3.org/2000/svg">
  <rect x="1" y="1" width="558" height="213" fill="#ffffff" stroke="#cbd5e0"/>
  <text x="140" y="22" font-size="13" text-anchor="middle" fill="#742a2a" font-family="Arial" font-weight="bold">Fragmentación EXTERNA</text>
  <text x="140" y="37" font-size="10.5" text-anchor="middle" fill="#4a5568" font-family="Arial">libre total = 90K, pero el proceso de 80K no entra</text>

  <rect x="40" y="48" width="200" height="30" fill="#bee3f8" stroke="#2b6cb0"/>
  <text x="140" y="68" font-size="11" text-anchor="middle" fill="#1a365d" font-family="Arial">proceso A</text>
  <rect x="40" y="78" width="200" height="22" fill="#fed7d7" stroke="#c53030"/>
  <text x="140" y="93" font-size="10" text-anchor="middle" fill="#742a2a" font-family="Arial">hueco 30K</text>
  <rect x="40" y="100" width="200" height="30" fill="#bee3f8" stroke="#2b6cb0"/>
  <text x="140" y="120" font-size="11" text-anchor="middle" fill="#1a365d" font-family="Arial">proceso B</text>
  <rect x="40" y="130" width="200" height="22" fill="#fed7d7" stroke="#c53030"/>
  <text x="140" y="145" font-size="10" text-anchor="middle" fill="#742a2a" font-family="Arial">hueco 25K</text>
  <rect x="40" y="152" width="200" height="26" fill="#bee3f8" stroke="#2b6cb0"/>
  <text x="140" y="169" font-size="11" text-anchor="middle" fill="#1a365d" font-family="Arial">proceso C</text>
  <rect x="40" y="178" width="200" height="22" fill="#fed7d7" stroke="#c53030"/>
  <text x="140" y="193" font-size="10" text-anchor="middle" fill="#742a2a" font-family="Arial">hueco 35K</text>

  <line x1="285" y1="40" x2="285" y2="200" stroke="#cbd5e0" stroke-width="1" stroke-dasharray="4 4"/>

  <text x="425" y="22" font-size="13" text-anchor="middle" fill="#7b341e" font-family="Arial" font-weight="bold">Fragmentación INTERNA</text>
  <text x="425" y="37" font-size="10.5" text-anchor="middle" fill="#4a5568" font-family="Arial">marcos de 2048 B; el último queda a medias</text>

  <rect x="330" y="48" width="190" height="26" fill="#c6f6d5" stroke="#2f855a"/>
  <text x="425" y="65" font-size="11" text-anchor="middle" fill="#22543d" font-family="Arial">marco lleno (2048 B)</text>
  <rect x="330" y="76" width="190" height="26" fill="#c6f6d5" stroke="#2f855a"/>
  <text x="425" y="93" font-size="11" text-anchor="middle" fill="#22543d" font-family="Arial">marco lleno (2048 B)</text>
  <text x="425" y="116" font-size="14" text-anchor="middle" fill="#4a5568" font-family="Arial">&#8942;</text>
  <rect x="330" y="128" width="190" height="26" fill="#c6f6d5" stroke="#2f855a"/>
  <text x="425" y="145" font-size="11" text-anchor="middle" fill="#22543d" font-family="Arial">marco lleno (2048 B)</text>

  <rect x="330" y="160" width="100" height="40" fill="#c6f6d5" stroke="#2f855a"/>
  <text x="380" y="184" font-size="10.5" text-anchor="middle" fill="#22543d" font-family="Arial">1086 B usados</text>
  <rect x="430" y="160" width="90" height="40" fill="#feebc8" stroke="#dd6b20"/>
  <text x="475" y="178" font-size="10" text-anchor="middle" fill="#7b341e" font-family="Arial">962 B</text>
  <text x="475" y="191" font-size="10" text-anchor="middle" fill="#7b341e" font-family="Arial">perdidos</text>
</svg>
</div>
<p class="cap">Externa: huecos <i>entre</i> procesos. Interna: sobra <i>dentro</i> del último marco.</p>

<p class="enunciado">La solución a la fragmentación externa que consiste en <b>mover</b> los procesos para juntar
todo el espacio libre en un solo bloque grande se llama
<input type="text" name="respuesta_35" value="<?php echo r(35); ?>" size="16"> <?php echo v(35) ?>.</p>
<p class="enunciado">(Verdadero/Falso) Esa técnica <b>sí</b> es posible cuando la reubicación es estática (hecha en ensamblado o carga).</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_36" value="Verdadero" <?php echo chk(36, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_36" value="Falso" <?php echo chk(36, 'Falso'); ?>> Falso</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(35) ?><?php echo v(36) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Compactación</b>, y es <b>Falso</b>: solo es posible si la reubicación es <b>dinámica</b> (en tiempo de ejecución), porque mover
el proceso exige cambiar el registro base y que nadie tenga direcciones físicas &laquo;grabadas&raquo;.
<b>Aquí se cierra el argumento del capítulo</b>: compactar es caro, así que la salida real es permitir que el espacio
lógico sea <b>no contiguo</b> &rarr; <b>paginación</b>.
</div>
<?php endif; ?>

<p class="enunciado">Según la <b>regla del 50 por ciento</b>, dados <code>N</code> bloques asignados, se perderán
<input type="text" name="respuesta_105" value="<?php echo r(105); ?>" size="6"> <?php echo v(105) ?> <code>&times; N</code>
bloques por fragmentación (es decir, un tercio de la memoria puede quedar inutilizable).</p>
<button type="submit">Enviar</button>

</div>

<!-- =====================================================  DERECHA  ===================================================== -->
<div class="seccion derecha">

<h2>Paginación, TLB y swapping</h2>
<div class="idea">
<b>Por qué aparece la paginación.</b> La asignación contigua obliga a compactar y la compactación es costosa.
La paginación rompe esa exigencia: la memoria física se parte en <b>marcos</b> de tamaño fijo y la lógica en
<b>páginas</b> del mismo tamaño, y cualquier página puede ir a cualquier marco. Resultado: <b>desaparece la
fragmentación externa</b>, y aparece algo de <b>fragmentación interna</b> (el último marco). Ese intercambio es el
corazón del capítulo.
</div>
<hr>

<!-- ---------------- Pregunta 8 ---------------- -->
<h3>Pregunta 8 &mdash; las dos partes de la dirección (chequeo 7)</h3>
<p class="enunciado">¿Cuáles son las dos partes en que se divide una dirección generada por la CPU en un sistema paginado?</p>
<p>
<code>p</code> = <input type="text" name="respuesta_37" value="<?php echo r(37); ?>" size="22"> <?php echo v(37) ?><br>
<code>d</code> = <input type="text" name="respuesta_38" value="<?php echo r(38); ?>" size="22"> <?php echo v(38) ?>
</p>
<p class="enunciado">Y los nombres de los bloques: la memoria <b>física</b> se divide en
<input type="text" name="respuesta_39" value="<?php echo r(39); ?>" size="12"> <?php echo v(39) ?>
y la memoria <b>lógica</b> en <input type="text" name="respuesta_40" value="<?php echo r(40); ?>" size="12"> <?php echo v(40) ?>,
ambos del <b>mismo tamaño</b>.</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>p = número de página</b> (índice en la tabla de páginas) y <b>d = desplazamiento (offset)</b> dentro de la página.
Física &rarr; <b>marcos</b> (<i>frames</i>); lógica &rarr; <b>páginas</b>.<br>
Si el espacio lógico es de <code>2<sup>m</sup></code> y la página de <code>2<sup>n</sup></code> bytes, entonces
<b>p ocupa los m&minus;n bits altos</b> y <b>d los n bits bajos</b>. Por eso el tamaño de página <i>siempre</i> es potencia de 2:
hace que partir la dirección sea un corte de bits, sin dividir.
</div>
<?php endif; ?>

<p class="enunciado">Los tres pasos que ejecuta la MMU: extraer <code>p</code> e indexar la
<input type="text" name="respuesta_41" value="<?php echo r(41); ?>" size="18"> <?php echo v(41) ?>;
sacar de ahí el número de marco <code>f</code>; y <b>reemplazar</b> <code>p</code> por <code>f</code>
dejando <code>d</code> intacto. Por su parte, el SO lleva una estructura global que dice qué marcos están libres u ocupados:
la <input type="text" name="respuesta_42" value="<?php echo r(42); ?>" size="18"> <?php echo v(42) ?>.</p>
<button type="submit">Enviar</button>

<p class="enunciado">Siga el camino de la traducción (Figura 9.8). Fíjese en <b>qué parte de la dirección cambia y qué parte no</b>:</p>
<div class="svgbox">
<svg viewBox="0 0 560 290" xmlns="http://www.w3.org/2000/svg">
  <rect x="1" y="1" width="558" height="288" fill="#ffffff" stroke="#cbd5e0"/>
  <defs>
    <marker id="d9" viewBox="0 0 10 10" refX="9" refY="5" markerWidth="7" markerHeight="7" orient="auto">
      <path d="M0 1L10 5L0 9Z" fill="#2d3748"/>
    </marker>
  </defs>

  <rect x="20" y="40" width="64" height="38" rx="5" fill="#ebf8ff" stroke="#2b6cb0"/>
  <text x="52" y="64" font-size="14" text-anchor="middle" fill="#1a365d" font-family="Arial">CPU</text>
  <text x="130" y="30" font-size="10.5" text-anchor="middle" fill="#4a5568" font-family="Arial">dirección lógica</text>
  <rect x="95" y="43" width="35" height="32" fill="#fff" stroke="#4a5568"/>
  <text x="112" y="64" font-size="13" text-anchor="middle" fill="#2d3748" font-family="Arial">p</text>
  <rect x="130" y="43" width="35" height="32" fill="#fff" stroke="#4a5568"/>
  <text x="147" y="64" font-size="13" text-anchor="middle" fill="#2d3748" font-family="Arial">d</text>
  <line x1="84" y1="59" x2="94" y2="59" stroke="#2d3748" stroke-width="1.3"/>

  <line x1="112" y1="75" x2="112" y2="140" stroke="#2d3748" stroke-width="1.4" marker-end="url(#d9)"/>
  <text x="70" y="112" font-size="10" fill="#4a5568" font-family="Arial">índice</text>

  <rect x="60" y="140" width="110" height="110" rx="4" fill="#faf5ff" stroke="#6b46c1"/>
  <text x="115" y="200" font-size="11.5" text-anchor="middle" fill="#44337a" font-family="Arial">tabla de páginas</text>
  <line x1="60" y1="170" x2="170" y2="170" stroke="#6b46c1" stroke-width="0.8"/>
  <line x1="60" y1="220" x2="170" y2="220" stroke="#6b46c1" stroke-width="0.8"/>

  <line x1="170" y1="195" x2="250" y2="195" stroke="#2d3748" stroke-width="1.4" marker-end="url(#d9)"/>
  <text x="210" y="188" font-size="11" text-anchor="middle" fill="#6b46c1" font-family="Arial" font-weight="bold">f</text>

  <text x="340" y="30" font-size="10.5" text-anchor="middle" fill="#4a5568" font-family="Arial">dirección física</text>
  <rect x="305" y="43" width="35" height="32" fill="#f0fff4" stroke="#2f855a"/>
  <text x="322" y="64" font-size="13" text-anchor="middle" fill="#22543d" font-family="Arial">f</text>
  <rect x="340" y="43" width="35" height="32" fill="#f0fff4" stroke="#2f855a"/>
  <text x="357" y="64" font-size="13" text-anchor="middle" fill="#22543d" font-family="Arial">d</text>

  <line x1="250" y1="195" x2="322" y2="195" stroke="#2d3748" stroke-width="1.2"/>
  <line x1="322" y1="195" x2="322" y2="77" stroke="#2f855a" stroke-width="1.4" marker-end="url(#d9)"/>
  <line x1="147" y1="75" x2="147" y2="100" stroke="#2d3748" stroke-width="1.2"/>
  <line x1="147" y1="100" x2="357" y2="100" stroke="#2d3748" stroke-width="1.2" stroke-dasharray="4 3"/>
  <line x1="357" y1="100" x2="357" y2="78" stroke="#2d3748" stroke-width="1.4" marker-end="url(#d9)"/>
  <text x="250" y="95" font-size="9.5" text-anchor="middle" fill="#4a5568" font-family="Arial">d NO cambia</text>

  <line x1="375" y1="59" x2="440" y2="59" stroke="#2d3748" stroke-width="1.4" marker-end="url(#d9)"/>
  <rect x="440" y="40" width="100" height="210" rx="4" fill="#f0fff4" stroke="#2f855a"/>
  <text x="490" y="140" font-size="12" text-anchor="middle" fill="#22543d" font-family="Arial">memoria</text>
  <text x="490" y="156" font-size="12" text-anchor="middle" fill="#22543d" font-family="Arial">física</text>

  <text x="112" y="275" font-size="10.5" text-anchor="middle" fill="#4a5568" font-family="Arial">una tabla POR PROCESO</text>
  <text x="330" y="275" font-size="10.5" text-anchor="middle" fill="#4a5568" font-family="Arial">puntero a la tabla: en el PCB (registro PTBR)</text>
</svg>
</div>

<p class="enunciado">Dos registros de hardware asociados a la tabla de páginas: el que <b>apunta</b> a la tabla en memoria
es el <input type="text" name="respuesta_47" value="<?php echo r(47); ?>" size="8"> <?php echo v(47) ?>,
y el que indica el <b>tamaño</b> de la tabla (para validar direcciones) es el
<input type="text" name="respuesta_48" value="<?php echo r(48); ?>" size="8"> <?php echo v(48) ?>.</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion"><b>PTBR</b> (<i>page-table base register</i>) y <b>PTLR</b> (<i>page-table length register</i>). Guardar la tabla en memoria y apuntarla con el PTBR hace el cambio de contexto barato, pero <b>duplica los accesos a memoria</b>: ese es el problema que resuelve el TLB.</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 9 ---------------- -->
<h3>Pregunta 9 &mdash; traducción a mano (Figura 9.10)</h3>
<p class="enunciado">Memoria física de 32 bytes, páginas de <b>4 bytes</b>. La tabla de páginas es:
<code>pág 0 &rarr; marco 5</code>, <code>pág 1 &rarr; marco 6</code>, <code>pág 2 &rarr; marco 1</code>, <code>pág 3 &rarr; marco 2</code>.
Traduzca estas direcciones lógicas a físicas:</p>
<table class="plan">
<tr><th>Dirección lógica</th><th>0</th><th>3</th><th>4</th><th>11</th><th>13</th></tr>
<tr><th>Dirección física</th>
<td><input type="text" name="respuesta_106" value="<?php echo r(106); ?>"><?php echo v(106) ?></td>
<td><input type="text" name="respuesta_107" value="<?php echo r(107); ?>"><?php echo v(107) ?></td>
<td><input type="text" name="respuesta_108" value="<?php echo r(108); ?>"><?php echo v(108) ?></td>
<td><input type="text" name="respuesta_110" value="<?php echo r(110); ?>"><?php echo v(110) ?></td>
<td><input type="text" name="respuesta_109" value="<?php echo r(109); ?>"><?php echo v(109) ?></td>
</tr>
</table>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Receta:</b> <code>p = lógica DIV tamaño_página</code>, <code>d = lógica MOD tamaño_página</code>, <code>física = f &times; tamaño_página + d</code>.
<pre>  0 &rarr; p=0 d=0 &rarr; f=5 &rarr;  5&times;4+0  = 20
  3 &rarr; p=0 d=3 &rarr; f=5 &rarr;  5&times;4+3  = 23
  4 &rarr; p=1 d=0 &rarr; f=6 &rarr;  6&times;4+0  = 24
 11 &rarr; p=2 d=3 &rarr; f=1 &rarr;  1&times;4+3  =  7
 13 &rarr; p=3 d=1 &rarr; f=2 &rarr;  2&times;4+1  =  9</pre>
</div>
<?php endif; ?>
<p>Practique con otra dirección (escriba el procedimiento):</p>
<textarea class="libre" name="libre_2" rows="2"><?php echo libre(2); ?></textarea>
<hr>

<!-- ---------------- Pregunta 10 ---------------- -->
<h3>Pregunta 10 &mdash; tamaño de página desde el offset (chequeo 11)</h3>
<p class="enunciado">Si un <i>offset</i> de página es de <b>13 bits</b>, ¿qué tan grande es la página, en bytes?</p>
<p><input type="text" name="respuesta_111" value="<?php echo r(111); ?>" size="10"> <?php echo v(111) ?> bytes</p>
<p class="enunciado">Y en un espacio de direcciones lógicas de <b>32 bits</b> con ese mismo tamaño de página,
¿cuántos bits quedan para el número de página?
<input type="text" name="respuesta_112" value="<?php echo r(112); ?>" size="6"> <?php echo v(112) ?> bits</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<code>2<sup>13</sup> = 8192 bytes = 8 KB</code>; y <code>32 &minus; 13 = 19</code> bits para <code>p</code>
(es decir <code>2<sup>19</sup> = 524 288</code> páginas posibles).<br>
<b>Lo que debe quedar automático:</b> los bits del offset <i>son</i> el log<sub>2</sub> del tamaño de página, en ambas direcciones.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 11 ---------------- -->
<h3>Pregunta 11 &mdash; la entrada de la tabla de páginas (chequeo 8)</h3>
<p class="enunciado">¿Qué contiene cada entrada de la tabla de páginas?</p>
<p>
Lo esencial: el <input type="text" name="respuesta_43" value="<?php echo r(43); ?>" size="20"> <?php echo v(43) ?><br>
Bit que dice si la página está en el espacio de direcciones del proceso: bit
<input type="text" name="respuesta_44" value="<?php echo r(44); ?>" size="16"> <?php echo v(44) ?><br>
Bits que dicen si se puede escribir o solo leer: bits de
<input type="text" name="respuesta_45" value="<?php echo r(45); ?>" size="16"> <?php echo v(45) ?>
</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Número de marco</b> + <b>bit válido&ndash;inválido</b> + <b>bits de protección</b> (lectura&ndash;escritura / solo lectura / solo ejecución).
Escribir en una página de solo lectura causa un <b>trap</b> (violación de protección de memoria).<br>
<b>Puente con el capítulo 10:</b> allí a esta misma entrada se le suman el <i>bit de modificado</i> (<i>dirty</i>) y el
<i>bit de referencia</i>, que son los que hacen posibles los algoritmos de reemplazo.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 12 ---------------- -->
<h3>Pregunta 12 &mdash; ¿fragmenta la paginación? (chequeo 9)</h3>
<p class="enunciado">(Verdadero/Falso) Puede ocurrir fragmentación en un sistema que maneje paginación.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_46" value="Verdadero" <?php echo chk(46, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_46" value="Falso" <?php echo chk(46, 'Falso'); ?>> Falso</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(46) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Verdadero, pero sea preciso:</b> con paginación <b>no hay fragmentación externa</b> (cualquier marco libre sirve),
<b>sí hay interna</b>: el último marco de un proceso casi nunca queda lleno. En promedio se pierde
<b>media página por proceso</b>.
</div>
<?php endif; ?>

<p class="enunciado">Caso del libro: páginas de <b>2048 bytes</b>, proceso de <b>72 766 bytes</b>. Complete:</p>
<p>
Páginas completas: <input type="text" name="respuesta_113" value="<?php echo r(113); ?>" size="6"> <?php echo v(113) ?>
&nbsp;+ un resto de <input type="text" name="respuesta_114" value="<?php echo r(114); ?>" size="6"> <?php echo v(114) ?> bytes<br>
Marcos realmente asignados: <input type="text" name="respuesta_115" value="<?php echo r(115); ?>" size="6"> <?php echo v(115) ?><br>
Fragmentación interna: <input type="text" name="respuesta_116" value="<?php echo r(116); ?>" size="6"> <?php echo v(116) ?> bytes
</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<pre>72 766 / 2048 = 35 páginas, resto 1086 bytes
se asignan 36 marcos
fragmentación interna = 2048 &minus; 1086 = 962 bytes</pre>
En el peor caso un proceso necesita <code>n</code> páginas + 1 byte y pierde casi un marco entero.
<b>Tensión de diseño:</b> páginas pequeñas &rarr; menos fragmentación interna pero <i>tabla de páginas enorme</i>;
páginas grandes &rarr; tabla pequeña y E/S más eficiente, pero más desperdicio.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 13 ---------------- -->
<h3>Pregunta 13 &mdash; TLB (chequeo 10)</h3>
<p class="enunciado">¿Cuál es el término que especifica que un número de página <b>no</b> está presente en el TLB?</p>
<p><input type="text" name="respuesta_49" value="<?php echo r(49); ?>" size="24"> <?php echo v(49) ?></p>
<p class="enunciado">Y si <b>sí</b> está: <input type="text" name="respuesta_51" value="<?php echo r(51); ?>" size="24"> <?php echo v(51) ?>.
El porcentaje de veces que se encuentra se llama <input type="text" name="respuesta_50" value="<?php echo r(50); ?>" size="22"> <?php echo v(50) ?>.</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>TLB miss</b> (fallo de TLB) y <b>TLB hit</b> (acierto); el porcentaje es la <b>tasa de aciertos</b> (<i>hit ratio</i>).<br>
El TLB es una caché <b>asociativa</b> pequeña (32&ndash;1024 entradas) que compara con <b>todas</b> las claves a la vez.
En un <i>hit</i> la traducción no cuesta nada extra (va dentro del pipeline); en un <i>miss</i> hay que ir a la tabla de páginas en memoria.
</div>
<?php endif; ?>

<div class="svgbox">
<svg viewBox="0 0 560 290" xmlns="http://www.w3.org/2000/svg">
  <rect x="1" y="1" width="558" height="288" fill="#ffffff" stroke="#cbd5e0"/>
  <defs>
    <marker id="e9" viewBox="0 0 10 10" refX="9" refY="5" markerWidth="7" markerHeight="7" orient="auto">
      <path d="M0 1L10 5L0 9Z" fill="#2d3748"/>
    </marker>
  </defs>

  <rect x="15" y="40" width="60" height="36" rx="5" fill="#ebf8ff" stroke="#2b6cb0"/>
  <text x="45" y="63" font-size="13" text-anchor="middle" fill="#1a365d" font-family="Arial">CPU</text>
  <rect x="85" y="42" width="32" height="32" fill="#fff" stroke="#4a5568"/>
  <text x="101" y="63" font-size="12" text-anchor="middle" fill="#2d3748" font-family="Arial">p</text>
  <rect x="117" y="42" width="32" height="32" fill="#fff" stroke="#4a5568"/>
  <text x="133" y="63" font-size="12" text-anchor="middle" fill="#2d3748" font-family="Arial">d</text>
  <text x="117" y="32" font-size="10" text-anchor="middle" fill="#4a5568" font-family="Arial">dirección lógica</text>

  <line x1="101" y1="74" x2="101" y2="100" stroke="#2d3748" stroke-width="1.3" marker-end="url(#e9)"/>

  <rect x="55" y="100" width="150" height="62" rx="4" fill="#fefcbf" stroke="#b7791f"/>
  <text x="130" y="118" font-size="12" text-anchor="middle" fill="#744210" font-family="Arial" font-weight="bold">TLB</text>
  <text x="95" y="135" font-size="9.5" text-anchor="middle" fill="#744210" font-family="Arial">nº página</text>
  <text x="165" y="135" font-size="9.5" text-anchor="middle" fill="#744210" font-family="Arial">nº marco</text>
  <line x1="130" y1="128" x2="130" y2="158" stroke="#b7791f" stroke-width="0.8"/>
  <line x1="55" y1="140" x2="205" y2="140" stroke="#b7791f" stroke-width="0.8"/>
  <line x1="55" y1="151" x2="205" y2="151" stroke="#b7791f" stroke-width="0.8"/>

  <line x1="205" y1="118" x2="295" y2="118" stroke="#2f855a" stroke-width="1.5" marker-end="url(#e9)"/>
  <text x="250" y="111" font-size="11" text-anchor="middle" fill="#2f855a" font-family="Arial" font-weight="bold">TLB hit</text>

  <line x1="101" y1="162" x2="101" y2="200" stroke="#c53030" stroke-width="1.5" marker-end="url(#e9)"/>
  <text x="108" y="184" font-size="11" fill="#c53030" font-family="Arial" font-weight="bold">TLB miss</text>

  <rect x="45" y="200" width="150" height="70" rx="4" fill="#faf5ff" stroke="#6b46c1"/>
  <text x="120" y="240" font-size="11.5" text-anchor="middle" fill="#44337a" font-family="Arial">tabla de páginas</text>
  <text x="120" y="256" font-size="9.5" text-anchor="middle" fill="#44337a" font-family="Arial">(en memoria principal)</text>

  <line x1="195" y1="225" x2="300" y2="225" stroke="#6b46c1" stroke-width="1.4" marker-end="url(#e9)"/>
  <text x="247" y="218" font-size="11" text-anchor="middle" fill="#6b46c1" font-family="Arial" font-weight="bold">f</text>

  <rect x="300" y="42" width="32" height="32" fill="#f0fff4" stroke="#2f855a"/>
  <text x="316" y="63" font-size="12" text-anchor="middle" fill="#22543d" font-family="Arial">f</text>
  <rect x="332" y="42" width="32" height="32" fill="#f0fff4" stroke="#2f855a"/>
  <text x="348" y="63" font-size="12" text-anchor="middle" fill="#22543d" font-family="Arial">d</text>
  <text x="332" y="32" font-size="10" text-anchor="middle" fill="#4a5568" font-family="Arial">dirección física</text>

  <line x1="295" y1="118" x2="316" y2="118" stroke="#2f855a" stroke-width="1.2"/>
  <line x1="316" y1="118" x2="316" y2="76" stroke="#2f855a" stroke-width="1.4" marker-end="url(#e9)"/>
  <line x1="300" y1="225" x2="316" y2="225" stroke="#6b46c1" stroke-width="1.2"/>
  <line x1="316" y1="225" x2="316" y2="120" stroke="#6b46c1" stroke-width="1.2" stroke-dasharray="4 3"/>

  <line x1="364" y1="58" x2="430" y2="58" stroke="#2d3748" stroke-width="1.4" marker-end="url(#e9)"/>
  <rect x="430" y="42" width="110" height="228" rx="4" fill="#f0fff4" stroke="#2f855a"/>
  <text x="485" y="150" font-size="12" text-anchor="middle" fill="#22543d" font-family="Arial">memoria física</text>

  <text x="250" y="283" font-size="10" text-anchor="middle" fill="#4a5568" font-family="Arial">tras un miss, el par (p, f) se AÑADE al TLB para la próxima vez</text>
</svg>
</div>
<p class="cap">Figura 9.12 &mdash; paginación con TLB. El camino rojo (miss) cuesta <b>un acceso extra a memoria</b>.</p>

<p class="enunciado">Con un acceso a memoria de <b>10 ns</b> (un miss cuesta 2 accesos = 20 ns), calcule el
<b>tiempo de acceso efectivo</b>:</p>
<div class="comando">
TAE(80 % aciertos) = 0.80 &times; 10 + 0.20 &times; 20 =
<input type="text" name="respuesta_117" value="<?php echo r(117); ?>" size="7"> ns<br>
TAE(99 % aciertos) = 0.99 &times; 10 + 0.01 &times; 20 =
<input type="text" name="respuesta_118" value="<?php echo r(118); ?>" size="7"> ns
</div>
<button type="submit">Enviar</button>
<?php echo v(117) ?><?php echo v(118) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>12 ns</b> (20 % de degradación) y <b>10.1 ns</b> (apenas 1 %). <b>La moraleja del ejercicio:</b> la tasa de aciertos
no entra linealmente en la percepción de rendimiento &mdash; subir de 80 % a 99 % convierte una penalización
inaceptable en una irrelevante. En CPUs reales hay varios niveles de TLB (el Core i7 tiene L1 de instrucciones,
L1 de datos y un L2 de 512 entradas), y un miss de L2 puede costar cientos de ciclos.
</div>
<?php endif; ?>

<p class="enunciado">Dos detalles de TLB que suelen preguntarse: el identificador que permite que el TLB guarde
entradas de <b>varios procesos a la vez</b> es el <input type="text" name="respuesta_52" value="<?php echo r(52); ?>" size="8"> <?php echo v(52) ?>;
si el TLB no lo soporta, en cada cambio de contexto hay que hacerle un
<input type="text" name="respuesta_53" value="<?php echo r(53); ?>" size="10"> <?php echo v(53) ?>.
Las entradas que <b>no pueden</b> ser expulsadas (típicamente código clave del kernel) se llaman
<input type="text" name="respuesta_54" value="<?php echo r(54); ?>" size="12"> <?php echo v(54) ?>.</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion"><b>ASID</b> (<i>address-space identifier</i>), <b>flush</b> (vaciado) y entradas <b>wired down</b> (fijadas).
Sin ASID, el proceso entrante podría usar traducciones del saliente: direcciones virtuales válidas apuntando a marcos ajenos.</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 14 ---------------- -->
<h3>Pregunta 14 &mdash; estructuras de tabla de páginas</h3>
<p class="enunciado">Primero, el problema. Espacio lógico de <b>32 bits</b>, página de <b>4 KB</b>, cada entrada de <b>4 bytes</b>:</p>
<div class="comando">
bits de p = <input type="text" name="respuesta_119" value="<?php echo r(119); ?>" size="5">
&nbsp;·&nbsp; bits de d = <input type="text" name="respuesta_120" value="<?php echo r(120); ?>" size="5"><br>
entradas de la tabla = <input type="text" name="respuesta_121" value="<?php echo r(121); ?>" size="10"><br>
tamaño de la tabla = <input type="text" name="respuesta_122" value="<?php echo r(122); ?>" size="5"> MB &nbsp;<b>por proceso</b>
</div>
<button type="submit">Enviar</button>
<?php echo v(119) ?><?php echo v(120) ?><?php echo v(121) ?><?php echo v(122) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<code>4 KB = 2<sup>12</sup></code> &rarr; d = <b>12</b> bits, p = <b>20</b> bits &rarr;
<code>2<sup>20</sup> = 1 048 576</code> entradas &times; 4 bytes = <b>4 MB</b> por proceso, y <i>contiguos</i>.
<b>Inaceptable</b>: de ahí nacen las tres estructuras alternativas.
</div>
<?php endif; ?>

<p class="enunciado">Nombre las tres técnicas para estructurar la tabla de páginas:</p>
<p>
1. Se pagina la propia tabla de páginas: paginación <input type="text" name="respuesta_55" value="<?php echo r(55); ?>" size="16"> <?php echo v(55) ?><br>
2. El número de página virtual se usa como clave de una función: tabla de páginas
<input type="text" name="respuesta_56" value="<?php echo r(56); ?>" size="16"> <?php echo v(56) ?><br>
3. Una entrada por cada <b>marco real</b> de memoria: tabla de páginas
<input type="text" name="respuesta_57" value="<?php echo r(57); ?>" size="16"> <?php echo v(57) ?>
</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion"><b>jerárquica</b> (multinivel), <b>hash</b> (<i>hashed</i>) e <b>invertida</b>.</div>
<?php endif; ?>

<p class="enunciado">En el esquema de <b>dos niveles</b> de 32 bits, la dirección se parte así. Complete los bits:</p>
<div class="svgbox">
<svg viewBox="0 0 560 230" xmlns="http://www.w3.org/2000/svg">
  <rect x="1" y="1" width="558" height="228" fill="#ffffff" stroke="#cbd5e0"/>
  <defs>
    <marker id="f9" viewBox="0 0 10 10" refX="9" refY="5" markerWidth="7" markerHeight="7" orient="auto">
      <path d="M0 1L10 5L0 9Z" fill="#2d3748"/>
    </marker>
  </defs>
  <text x="280" y="20" font-size="11.5" text-anchor="middle" fill="#4a5568" font-family="Arial">dirección lógica de 32 bits</text>

  <rect x="90" y="28" width="120" height="30" fill="#e9d8fd" stroke="#6b46c1"/>
  <text x="150" y="48" font-size="12" text-anchor="middle" fill="#44337a" font-family="Arial">p1</text>
  <rect x="210" y="28" width="120" height="30" fill="#d6bcfa" stroke="#6b46c1"/>
  <text x="270" y="48" font-size="12" text-anchor="middle" fill="#44337a" font-family="Arial">p2</text>
  <rect x="330" y="28" width="140" height="30" fill="#bee3f8" stroke="#2b6cb0"/>
  <text x="400" y="48" font-size="12" text-anchor="middle" fill="#1a365d" font-family="Arial">d</text>

  <foreignObject x="110" y="60" width="80" height="24">
    <input xmlns="http://www.w3.org/1999/xhtml" type="text" name="respuesta_123" value="<?php echo r(123); ?>" placeholder="bits"
           style="width:100%;border:1px solid #a0aec0;border-radius:3px;background:#fff;font-size:12px;font-family:Arial;text-align:center;"/>
  </foreignObject>
  <foreignObject x="230" y="60" width="80" height="24">
    <input xmlns="http://www.w3.org/1999/xhtml" type="text" name="respuesta_124" value="<?php echo r(124); ?>" placeholder="bits"
           style="width:100%;border:1px solid #a0aec0;border-radius:3px;background:#fff;font-size:12px;font-family:Arial;text-align:center;"/>
  </foreignObject>
  <foreignObject x="360" y="60" width="80" height="24">
    <input xmlns="http://www.w3.org/1999/xhtml" type="text" name="respuesta_125" value="<?php echo r(125); ?>" placeholder="bits"
           style="width:100%;border:1px solid #a0aec0;border-radius:3px;background:#fff;font-size:12px;font-family:Arial;text-align:center;"/>
  </foreignObject>

  <rect x="60" y="115" width="110" height="80" rx="4" fill="#faf5ff" stroke="#6b46c1"/>
  <text x="115" y="150" font-size="11" text-anchor="middle" fill="#44337a" font-family="Arial">tabla de páginas</text>
  <text x="115" y="165" font-size="11" text-anchor="middle" fill="#44337a" font-family="Arial">EXTERNA</text>
  <line x1="150" y1="84" x2="115" y2="112" stroke="#6b46c1" stroke-width="1.3" marker-end="url(#f9)"/>

  <rect x="215" y="115" width="110" height="80" rx="4" fill="#faf5ff" stroke="#6b46c1"/>
  <text x="270" y="150" font-size="11" text-anchor="middle" fill="#44337a" font-family="Arial">página DE la</text>
  <text x="270" y="165" font-size="11" text-anchor="middle" fill="#44337a" font-family="Arial">tabla de páginas</text>
  <line x1="170" y1="155" x2="212" y2="155" stroke="#6b46c1" stroke-width="1.3" marker-end="url(#f9)"/>
  <line x1="270" y1="84" x2="270" y2="112" stroke="#6b46c1" stroke-width="1.3" marker-end="url(#f9)"/>

  <rect x="400" y="115" width="130" height="80" rx="4" fill="#f0fff4" stroke="#2f855a"/>
  <text x="465" y="158" font-size="11.5" text-anchor="middle" fill="#22543d" font-family="Arial">memoria física</text>
  <line x1="325" y1="155" x2="397" y2="155" stroke="#2f855a" stroke-width="1.3" marker-end="url(#f9)"/>
  <line x1="400" y1="84" x2="465" y2="112" stroke="#2b6cb0" stroke-width="1.2" stroke-dasharray="4 3" marker-end="url(#f9)"/>

  <text x="280" y="216" font-size="10" text-anchor="middle" fill="#4a5568" font-family="Arial">también llamada tabla &laquo;forward-mapped&raquo;: se traduce de la tabla externa hacia dentro</text>
</svg>
</div>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>p1 = 10, p2 = 10, d = 12.</b> <code>p1</code> indexa la tabla externa, <code>p2</code> es el desplazamiento dentro de
la página de la tabla interna. Por eso se llama <b>forward-mapped</b>.<br>
<b>Y por qué esto no escala a 64 bits:</b> con páginas de 4 KB habría <code>2<sup>52</sup></code> entradas; con dos niveles
la tabla externa sola ocuparía <code>2<sup>44</sup></code> bytes. Hacen falta 3, 4... (el UltraSPARC de 64 bits necesitaría
<b>siete</b> niveles, o sea siete accesos a memoria por traducción). <b>Conclusión del libro: la paginación jerárquica
no sirve para 64 bits</b> &mdash; de ahí hash e invertida.
</div>
<?php endif; ?>

<p class="enunciado">El esquema jerárquico también se llama
<input type="text" name="respuesta_58" value="<?php echo r(58); ?>" size="16"> <?php echo v(58) ?>;
y la variante de la tabla hash en la que cada entrada mapea <b>varias</b> páginas (útil en espacios dispersos) son las tablas
<input type="text" name="respuesta_59" value="<?php echo r(59); ?>" size="14"> <?php echo v(59) ?>.</p>
<p class="enunciado">(Verdadero/Falso) Con tablas de páginas <b>invertidas</b>, un mismo marco físico puede estar mapeado
simultáneamente por dos direcciones virtuales distintas (memoria compartida).</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_60" value="Verdadero" <?php echo chk(60, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_60" value="Falso" <?php echo chk(60, 'Falso'); ?>> Falso</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(58) ?><?php echo v(59) ?><?php echo v(60) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>forward-mapped</b>, tablas <b>agrupadas</b> (<i>clustered</i>), y <b>Falso</b>.<br>
La invertida tiene <b>una sola entrada por marco físico</b>, así que no puede registrar dos vistas virtuales del mismo
marco: una referencia del otro proceso provoca un fallo de página y <i>reemplaza</i> el mapeo.
Ahorra memoria, pero la búsqueda es por dirección física mientras las consultas llegan por dirección virtual &rarr;
hay que apoyarla con una <b>tabla hash</b>, lo que suma accesos a memoria.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 15 ---------------- -->
<h3>Pregunta 15 &mdash; páginas compartidas</h3>
<p class="enunciado">Para que varios procesos puedan compartir las páginas de una biblioteca, el código debe ser
<input type="text" name="respuesta_68" value="<?php echo r(68); ?>" size="14"> <?php echo v(68) ?>
(no se modifica a sí mismo durante la ejecución).</p>
<p class="enunciado">Con <b>40 procesos</b> y <code>libc</code> de <b>2 MB</b>: si cada uno carga su copia se usan
<input type="text" name="respuesta_126" value="<?php echo r(126); ?>" size="6"> <?php echo v(126) ?> MB;
compartiendo las páginas se usan solo <input type="text" name="respuesta_127" value="<?php echo r(127); ?>" size="6"> <?php echo v(127) ?> MB.</p>
<button type="submit">Enviar</button>
<?php echo v(68) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Reentrante</b>; <b>80 MB</b> vs. <b>2 MB</b>. Cada proceso tiene sus propios registros y datos, pero su tabla de páginas
apunta a la <i>misma</i> copia física del código. El SO debe <b>forzar</b> el carácter de solo lectura; no basta con
confiar en que el código esté bien escrito.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 16 ---------------- -->
<h3>Pregunta 16 &mdash; swapping (chequeos 12 y 13)</h3>
<p class="enunciado">¿En qué consiste la partición o archivo de swap? Nómbrelo:
<input type="text" name="respuesta_61" value="<?php echo r(61); ?>" size="22"> <?php echo v(61) ?></p>
<p class="enunciado">La operación que mueve una página de memoria al almacén de respaldo es
<input type="text" name="respuesta_63" value="<?php echo r(63); ?>" size="14"> <?php echo v(63) ?>;
la inversa es <input type="text" name="respuesta_64" value="<?php echo r(64); ?>" size="14"> <?php echo v(64) ?>.</p>
<p class="enunciado">(Verdadero/Falso) El swapping permite que el espacio de direcciones físicas de <b>todos</b> los
procesos juntos <b>exceda</b> la memoria física real del sistema.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_65" value="Verdadero" <?php echo chk(65, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_65" value="Falso" <?php echo chk(65, 'Falso'); ?>> Falso</label>
</div>
<p class="enunciado">(Verdadero/Falso) Los sistemas móviles generalmente emplean swapping.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_62" value="Verdadero" <?php echo chk(62, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_62" value="Falso" <?php echo chk(62, 'Falso'); ?>> Falso</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(61) ?><?php echo v(63) ?><?php echo v(64) ?><?php echo v(65) ?><?php echo v(62) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Backing store</b> (almacén de respaldo): almacenamiento secundario rápido, con <i>acceso directo</i> y suficiente
espacio para las imágenes de memoria. Operaciones: <b>page out</b> / <b>page in</b>. Sobre-suscribir memoria: <b>Verdadero</b>.<br>
Móviles: <b>Falso</b>. Usan memoria flash (poco espacio, número limitado de escrituras, poca velocidad).
En su lugar: <b>iOS pide a las apps que liberen memoria</b> voluntariamente (los datos de solo lectura se descartan
y se recargan; los modificados <i>nunca</i> se quitan) y puede <b>terminar</b> la app que no coopere.
<b>Android</b> también termina procesos, pero antes <b>guarda su estado en flash</b> para reiniciarlos rápido.<br>
<b>Y el punto fino del capítulo:</b> el <i>swapping estándar</i> (procesos enteros) ya casi no se usa por costoso;
hoy se hace <b>swapping con paginación</b> (páginas sueltas). Tanto, que &laquo;<i>paging</i>&raquo; pasó a significar
justamente eso.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 17 ---------------- -->
<h3>Pregunta 17 &mdash; el puente hacia el capítulo 10</h3>
<p class="enunciado">Todas las técnicas del capítulo 9 exigen que <b>el proceso completo esté en memoria</b> para
ejecutarse. La técnica que rompe ese requisito, y que es el tema del capítulo 10, se llama
<input type="text" name="respuesta_66" value="<?php echo r(66); ?>" size="20"> <?php echo v(66) ?>.</p>
<p class="enunciado">El bit de la tabla de páginas que el capítulo 10 <b>reutiliza</b> para indicar que una página
válida <i>no está en memoria</i> (y así disparar un fallo de página) es el bit
<input type="text" name="respuesta_67" value="<?php echo r(67); ?>" size="16"> <?php echo v(67) ?>.</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b>Memoria virtual</b>, y el bit <b>válido&ndash;inválido</b>. Esa reutilización es la bisagra exacta entre los dos capítulos:
en el cap. 9 &laquo;inválido&raquo; significa <i>dirección ilegal</i>; en el cap. 10 significa <i>legal pero está en disco</i>,
y el trap deja de ser un error fatal para convertirse en un <b>fallo de página</b> que el SO atiende.
</div>
<?php endif; ?>

<div class="svgbox">
<svg viewBox="0 0 560 250" xmlns="http://www.w3.org/2000/svg">
  <rect x="1" y="1" width="558" height="248" fill="#fdfdff" stroke="#cbd5e0"/>
  <defs>
    <marker id="g9" viewBox="0 0 10 10" refX="9" refY="5" markerWidth="7" markerHeight="7" orient="auto">
      <path d="M0 1L10 5L0 9Z" fill="#4a5568"/>
    </marker>
  </defs>
  <text x="280" y="20" font-size="12.5" text-anchor="middle" fill="#2d3748" font-family="Arial" font-weight="bold">Cómo encadena el capítulo 9 (cada paso arregla el defecto del anterior)</text>

  <rect x="18" y="40" width="112" height="46" rx="5" fill="#ebf8ff" stroke="#2b6cb0"/>
  <text x="74" y="59" font-size="10.5" text-anchor="middle" fill="#1a365d" font-family="Arial">base + límite</text>
  <text x="74" y="74" font-size="9" text-anchor="middle" fill="#4a5568" font-family="Arial">protege, no reubica</text>

  <line x1="130" y1="63" x2="162" y2="63" stroke="#4a5568" stroke-width="1.3" marker-end="url(#g9)"/>

  <rect x="165" y="40" width="112" height="46" rx="5" fill="#ebf8ff" stroke="#2b6cb0"/>
  <text x="221" y="59" font-size="10.5" text-anchor="middle" fill="#1a365d" font-family="Arial">reg. reubicación</text>
  <text x="221" y="74" font-size="9" text-anchor="middle" fill="#4a5568" font-family="Arial">binding en ejecución</text>

  <line x1="277" y1="63" x2="309" y2="63" stroke="#4a5568" stroke-width="1.3" marker-end="url(#g9)"/>

  <rect x="312" y="40" width="112" height="46" rx="5" fill="#fff5f5" stroke="#c53030"/>
  <text x="368" y="56" font-size="10.5" text-anchor="middle" fill="#742a2a" font-family="Arial">asignación contigua</text>
  <text x="368" y="70" font-size="9" text-anchor="middle" fill="#742a2a" font-family="Arial">first/best/worst fit</text>
  <text x="368" y="81" font-size="9" text-anchor="middle" fill="#c53030" font-family="Arial">&#9888; frag. EXTERNA</text>

  <line x1="424" y1="63" x2="456" y2="63" stroke="#4a5568" stroke-width="1.3" marker-end="url(#g9)"/>
  <rect x="456" y="40" width="88" height="46" rx="5" fill="#fffaf0" stroke="#dd6b20"/>
  <text x="500" y="59" font-size="10.5" text-anchor="middle" fill="#7b341e" font-family="Arial">compactación</text>
  <text x="500" y="73" font-size="9" text-anchor="middle" fill="#7b341e" font-family="Arial">demasiado caro</text>

  <line x1="500" y1="86" x2="500" y2="105" stroke="#4a5568" stroke-width="1.3"/>
  <line x1="500" y1="105" x2="150" y2="105" stroke="#4a5568" stroke-width="1.3"/>
  <line x1="150" y1="105" x2="150" y2="122" stroke="#4a5568" stroke-width="1.3" marker-end="url(#g9)"/>

  <rect x="60" y="124" width="180" height="50" rx="5" fill="#f0fff4" stroke="#2f855a"/>
  <text x="150" y="142" font-size="11.5" text-anchor="middle" fill="#22543d" font-family="Arial" font-weight="bold">PAGINACIÓN</text>
  <text x="150" y="156" font-size="9" text-anchor="middle" fill="#22543d" font-family="Arial">espacio lógico NO contiguo</text>
  <text x="150" y="168" font-size="9" text-anchor="middle" fill="#dd6b20" font-family="Arial">&#9888; frag. INTERNA + 2 accesos a memoria</text>

  <line x1="240" y1="149" x2="275" y2="149" stroke="#4a5568" stroke-width="1.3" marker-end="url(#g9)"/>
  <rect x="278" y="124" width="90" height="50" rx="5" fill="#fefcbf" stroke="#b7791f"/>
  <text x="323" y="145" font-size="11" text-anchor="middle" fill="#744210" font-family="Arial" font-weight="bold">TLB</text>
  <text x="323" y="159" font-size="9" text-anchor="middle" fill="#744210" font-family="Arial">caché de traducción</text>

  <line x1="368" y1="149" x2="400" y2="149" stroke="#4a5568" stroke-width="1.3" marker-end="url(#g9)"/>
  <rect x="402" y="124" width="142" height="50" rx="5" fill="#faf5ff" stroke="#6b46c1"/>
  <text x="473" y="141" font-size="10" text-anchor="middle" fill="#44337a" font-family="Arial">tabla muy grande &rarr;</text>
  <text x="473" y="154" font-size="9.5" text-anchor="middle" fill="#44337a" font-family="Arial">jerárquica · hash · invertida</text>
  <text x="473" y="167" font-size="9" text-anchor="middle" fill="#44337a" font-family="Arial">(9.4)</text>

  <line x1="150" y1="174" x2="150" y2="196" stroke="#4a5568" stroke-width="1.3" marker-end="url(#g9)"/>
  <rect x="55" y="198" width="190" height="42" rx="5" fill="#edf2f7" stroke="#4a5568"/>
  <text x="150" y="215" font-size="10.5" text-anchor="middle" fill="#2d3748" font-family="Arial">SWAPPING (con paginación)</text>
  <text x="150" y="229" font-size="9" text-anchor="middle" fill="#4a5568" font-family="Arial">sobre-suscribe la memoria física</text>

  <line x1="245" y1="219" x2="300" y2="219" stroke="#2f855a" stroke-width="1.8" marker-end="url(#g9)"/>
  <rect x="303" y="196" width="241" height="44" rx="5" fill="#f0fff4" stroke="#2f855a" stroke-width="1.8"/>
  <text x="423" y="213" font-size="11.5" text-anchor="middle" fill="#22543d" font-family="Arial" font-weight="bold">CAPÍTULO 10: MEMORIA VIRTUAL</text>
  <text x="423" y="229" font-size="9" text-anchor="middle" fill="#22543d" font-family="Arial">el proceso ya NO necesita estar completo en memoria</text>
</svg>
</div>
<p class="cap">Mapa del capítulo. Si puede recorrer esta cadena explicando cada flecha, tiene el capítulo 9.</p>

<p>Escriba de memoria la cadena completa, sin mirar (práctica libre):</p>
<textarea class="libre" name="libre_3" rows="4"><?php echo libre(3); ?></textarea>
<hr>

<strong>si desea ver las soluciones escribir: mostrar_solucion</strong>
<br>
<input type="text" id="mostrar_solucion" name="mostrar_solucion" value="<?php echo htmlspecialchars($mostrar_solucion, ENT_QUOTES, 'UTF-8'); ?>">
<button type="submit">Mostrar Solución</button>

</div>
</div>
</form>

<div class="centered-container" style="text-align:center; margin-top:20px">
    <a class="btn btn-primary" href="../Menu.php" role="button">Volver al menú</a>
    <a class="btn btn-secondary" href="../Capitulo_10/index.php" role="button">Ir al capítulo 10</a>
</div>
</body>
</html>
