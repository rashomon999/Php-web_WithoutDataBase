<?php
/* ============================================================
   PREGUNTAS DE CHEQUEO - CAPÍTULO 9 (Gestión de memoria)
   Enunciados y soluciones tomados del documento del profesor.
   Esquema: respuesta_N / verificar_N / mostrar_solucion
   ============================================================ */

for ($i = 1; $i <= 120; $i++) {
    ${"respuesta_" . $i} = '';
    ${"verificar_" . $i} = '';
}
for ($i = 1; $i <= 14; $i++) {
    ${"libre_" . $i} = '';
}

/* ---------- Respuestas aceptadas ---------- */
$claves = [
    // 1. Protección simple
    1  => ['base', 'registro base'],
    2  => ['limite', 'registro limite'],
    // 2. Los tres tiempos del binding
    3  => ['Tiempo de compilacion', 'compilacion', 'tiempo de compilacion', 'compile time'],
    4  => ['Tiempo de carga', 'carga', 'tiempo de carga', 'load time'],
    5  => ['Tiempo de ejecucion', 'ejecucion', 'tiempo de ejecucion', 'run time', 'execution time'],
    // 3. V/F dirección de la CPU
    6  => ['Falso'],
    7  => ['logicas', 'logica', 'logicas', 'virtuales', 'virtual'],
    // 4. MMU
    8  => ['MMU', 'mmu', 'memory management unit', 'unidad de gestion de memoria', 'unidad de administracion de memoria'],
    // 5. Estrategias de hueco libre
    9  => ['Primer ajuste', 'primer ajuste', 'first fit', 'primer ajuste(first fit)', 'primer', 'primero', 'firstfit'],
    10 => ['Mejor ajuste', 'mejor ajuste', 'best fit', 'mejor ajuste(best fit)', 'mejor', 'bestfit'],
    11 => ['Peor ajuste', 'peor ajuste', 'worst fit', 'peor ajuste(worst fit)', 'peor', 'worstfit'],
    // 6. Formas de fragmentación
    12 => ['Externa', 'externa', 'fragmentacion externa'],
    13 => ['Interna', 'interna', 'fragmentacion interna'],
    // 7. Partes de la dirección
    14 => ['Numero de pagina', 'numero de pagina', 'pagina', 'page number'],
    15 => ['Desplazamiento', 'desplazamiento', 'offset', 'desplazamiento(offset)'],
    // 8. Entrada de la tabla de páginas
    16 => ['marco', 'marco de pagina', 'frame', 'numero de marco', 'marco de pagina(frame)', 'numero de marco de pagina'],
    // 9. V/F fragmentación con paginación
    17 => ['Verdadero'],
    18 => ['interna', 'fragmentacion interna'],
    19 => ['externa', 'fragmentacion externa'],
    // 10. TLB
    20 => ['Fallo del TLB', 'fallo del tlb', 'tlb miss', 'fallo de tlb', 'fallo en el tlb', 'miss'],
    21 => ['tabla de paginas', 'la tabla de paginas', 'page table'],
    // 12. Swap
    22 => ['Backing store', 'backing store', 'particion de swap', 'archivo de swap', 'area de swap', 'espacio de swap', 'almacen de respaldo'],
    23 => ['swap out', 'swapout', 'intercambio hacia afuera'],
    24 => ['swap in', 'swapin', 'intercambio hacia adentro'],
    // 13. V/F móviles
    25 => ['Falso'],
    26 => ['paginas', 'paginas sueltas', 'paginas individuales', 'pages'],
];

/* ---------- Respuestas numéricas ---------- */
$numericas = [
    101 => 8192,   // 2^13 bytes
    102 => 8,      // KiB
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
        if (normalizar($valor) === normalizar($a)) { return true; }
    }
    return false;
}

function es_numero_correcto($valor, $esperado) {
    $v = str_replace([',', ' '], ['.', ''], trim((string)$valor));
    if (!is_numeric($v)) { return false; }
    $tol = max(0.001, abs($esperado) * 0.005);
    return abs((float)$v - $esperado) <= $tol;
}

function r($n) { return htmlspecialchars($GLOBALS["respuesta_" . $n], ENT_QUOTES, 'UTF-8'); }

function v($n) {
    $e = $GLOBALS["verificar_" . $n];
    if ($e === 'correcto')   { return '<span class="correcto">correcto</span> '; }
    if ($e === 'incorrecto') { return '<span class="incorrecto">incorrecto</span> '; }
    return '';
}

function chk($n, $valor) { return $GLOBALS["respuesta_" . $n] === $valor ? 'checked' : ''; }
function libre($n) { return htmlspecialchars($GLOBALS["libre_" . $n], ENT_QUOTES, 'UTF-8'); }

/* ---------- Procesamiento ---------- */
$mostrar_solucion = '';
if ($_POST) {
    $mostrar_solucion = isset($_POST['mostrar_solucion']) ? trim($_POST['mostrar_solucion']) : '';

    for ($i = 1; $i <= 14; $i++) {
        ${"libre_" . $i} = isset($_POST["libre_$i"]) ? $_POST["libre_$i"] : '';
    }

    if ($mostrar_solucion === 'mostrar_solucion') {
        foreach ($claves as $n => $a) { ${"respuesta_$n"} = $a[0]; ${"verificar_$n"} = "correcto"; }
        foreach ($numericas as $n => $val) { ${"respuesta_$n"} = (string)$val; ${"verificar_$n"} = "correcto"; }
    } else {
        foreach ($claves as $n => $a) {
            ${"respuesta_$n"} = isset($_POST["respuesta_$n"]) ? $_POST["respuesta_$n"] : '';
            if (trim(${"respuesta_$n"}) === '')            { ${"verificar_$n"} = ''; }
            elseif (es_correcta(${"respuesta_$n"}, $a))    { ${"verificar_$n"} = "correcto"; }
            else                                          { ${"verificar_$n"} = "incorrecto"; }
        }
        foreach ($numericas as $n => $val) {
            ${"respuesta_$n"} = isset($_POST["respuesta_$n"]) ? $_POST["respuesta_$n"] : '';
            if (trim(${"respuesta_$n"}) === '')                     { ${"verificar_$n"} = ''; }
            elseif (es_numero_correcto(${"respuesta_$n"}, $val))    { ${"verificar_$n"} = "correcto"; }
            else                                                    { ${"verificar_$n"} = "incorrecto"; }
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
    <title>Chequeo Capítulo 9</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../style_2_0.css">
<style>
    body { font-family: Arial, sans-serif; background: #f5f7fb; margin: 0; padding: 20px; color: #1a202c; }
    .form-container { display: flex; gap: 15px; align-items: flex-start; }
    .seccion {
        width: calc(50% - 7.5px); padding: 20px; box-sizing: border-box; background: white;
        border-radius: 10px; box-shadow: 0 6px 16px rgba(0,0,0,0.08);
    }
    @media (max-width: 1100px) { .form-container { flex-direction: column; } .seccion { width: 100%; } }
    .cabecera {
        padding: 18px 22px; background: white; border-radius: 10px;
        box-shadow: 0 6px 16px rgba(0,0,0,0.08); margin-bottom: 15px;
        border-left: 6px solid #2f855a;
    }
    h1 { font-size: 1.45rem; margin: 0 0 6px; }
    h3 { font-size: 1.1rem; margin-top: 16px; color: #22543d; }
    .enunciado { line-height: 1.6; font-weight: bold; margin: 4px 0 10px; }
    .opciones label { display: block; margin: 6px 0; cursor: pointer; }
    .correcto { color: #2f855a; font-weight: bold; }
    .incorrecto { color: #c53030; font-weight: bold; }
    input[type="text"], textarea { border: 1px solid #a0aec0; border-radius: 4px; padding: 3px 5px; font-size: 0.95rem; }
    code { font-family: Consolas, "Courier New", monospace; font-size: 0.93rem; background:#edf2f7; padding:1px 4px; border-radius:3px; }
    .solucion {
        background: #f0fff4; border-left: 4px solid #38a169;
        padding: 10px 14px; margin: 10px 0; font-size: 0.93rem; line-height: 1.6;
    }
    .solucion b.titulo { display:block; color:#22543d; margin-bottom:4px; }
    .solucion ul { margin: 6px 0 0 18px; padding: 0; }
    .solucion li { margin: 4px 0; }
    .solucion .formula { font-family: Consolas, monospace; background:#e6fffa; padding:4px 8px; border-radius:4px; display:inline-block; margin:4px 0; }
    .nota { background: #fffaf0; border-left: 4px solid #dd6b20; padding: 8px 12px; margin: 10px 0; font-size: 0.88rem; line-height: 1.55; }
    textarea.libre { width: 100%; font-family: Arial, sans-serif; margin-top: 4px; }
    .etq { font-size: 0.86rem; color: #4a5568; }
    button { margin-top: 8px; }
    hr { margin: 18px 0; border: 0; border-top: 1px solid #e2e8f0; }
    table.repaso { border-collapse: collapse; width: 100%; margin: 8px 0; font-size: 0.9rem; }
    table.repaso th, table.repaso td { border: 1px solid #cbd5e0; padding: 6px 8px; text-align: left; }
    table.repaso th { background: #edf2f7; }
    table.repaso td:first-child { font-weight: bold; width: 38%; }
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

<div class="cabecera">
<h1>Preguntas de chequeo &mdash; Capítulo 9: Gestión de memoria</h1>
<p style="margin:0; color:#4a5568; line-height:1.55">Las <b>13 preguntas de chequeo</b> tal como están en el documento,
con las respuestas del solucionario. Responda y presione <b>Enviar</b> en cada una; al final puede escribir
<code>mostrar_solucion</code> para ver todas las respuestas.</p>
</div>

<form action="./index.php" method="POST" onsubmit="handleSubmit(event)" autocomplete="off">
<div class="form-container">

<!-- ===================== IZQUIERDA ===================== -->
<div class="seccion izquierda">

<h3>Pregunta 1</h3>
<p class="enunciado">¿Cuál pareja de registros se puede emplear para proporcionar una forma simple de protección de memoria?</p>
<p>El registro <input type="text" name="respuesta_1" value="<?php echo r(1); ?>" size="12"> <?php echo v(1) ?>
y el registro <input type="text" name="respuesta_2" value="<?php echo r(2); ?>" size="12"> <?php echo v(2) ?></p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b class="titulo">El registro base y el registro límite.</b>
El <b>registro base</b> indica dónde comienza el proceso en memoria, mientras que el <b>registro límite</b> establece
el rango de memoria al que puede acceder. El sistema operativo verifica que el proceso no acceda a direcciones fuera
de su espacio permitido.
</div>
<?php endif; ?>
<hr>

<h3>Pregunta 2</h3>
<p class="enunciado">Mencione los tres tiempos en los que el <i>binding</i> de direcciones puede ocurrir.</p>
<p>
1. <input type="text" name="respuesta_3" value="<?php echo r(3); ?>" size="24"> <?php echo v(3) ?><br>
2. <input type="text" name="respuesta_4" value="<?php echo r(4); ?>" size="24"> <?php echo v(4) ?><br>
3. <input type="text" name="respuesta_5" value="<?php echo r(5); ?>" size="24"> <?php echo v(5) ?>
</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<ul>
<li><b>Tiempo de compilación:</b> las direcciones se definen al compilar el programa y son absolutas.</li>
<li><b>Tiempo de carga:</b> las direcciones se determinan cuando el sistema operativo carga el programa en memoria.</li>
<li><b>Tiempo de ejecución:</b> las direcciones pueden modificarse mientras el programa se está ejecutando.</li>
</ul>
</div>
<?php endif; ?>
<hr>

<h3>Pregunta 3</h3>
<p class="enunciado">(Verdadero/Falso) A una dirección de memoria generada por la CPU se la conoce como dirección física.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_6" value="Verdadero" <?php echo chk(6, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_6" value="Falso" <?php echo chk(6, 'Falso'); ?>> Falso</label>
</div>
<p class="etq">La CPU genera direcciones
<input type="text" name="respuesta_7" value="<?php echo r(7); ?>" size="12"> <?php echo v(7) ?>.</p>
<button type="submit">Enviar</button>
<?php echo v(6) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<b class="titulo">Falso.</b>
La CPU genera <b>direcciones lógicas</b>, que deben traducirse a direcciones físicas para acceder a la memoria principal.
</div>
<?php endif; ?>
<hr>

<h3>Pregunta 4</h3>
<p class="enunciado">¿Cuál es el dispositivo de hardware que mapea las direcciones lógicas a las físicas?</p>
<p><input type="text" name="respuesta_8" value="<?php echo r(8); ?>" size="30"> <?php echo v(8) ?></p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b class="titulo">La MMU (Memory Management Unit) o unidad de gestión de memoria.</b>
Un dispositivo de hardware integrado en el procesador que traduce las direcciones lógicas a direcciones físicas.
</div>
<?php endif; ?>
<hr>

<h3>Pregunta 5</h3>
<p class="enunciado">¿Cuáles son las estrategias para seleccionar un hueco de memoria libre?</p>
<p>
1. <input type="text" name="respuesta_9" value="<?php echo r(9); ?>" size="22"> <?php echo v(9) ?>
<span class="etq">&rarr; el primer hueco disponible con espacio suficiente.</span><br>
2. <input type="text" name="respuesta_10" value="<?php echo r(10); ?>" size="22"> <?php echo v(10) ?>
<span class="etq">&rarr; el hueco más pequeño en el que quepa el proceso.</span><br>
3. <input type="text" name="respuesta_11" value="<?php echo r(11); ?>" size="22"> <?php echo v(11) ?>
<span class="etq">&rarr; el hueco libre más grande disponible.</span>
</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b class="titulo">Las tres estrategias de asignación de memoria contigua son:</b>
<ul>
<li><b>Primer ajuste (First Fit):</b> selecciona el primer hueco disponible que tenga espacio suficiente.</li>
<li><b>Mejor ajuste (Best Fit):</b> selecciona el hueco más pequeño en el que quepa el proceso.</li>
<li><b>Peor ajuste (Worst Fit):</b> selecciona el hueco libre más grande disponible.</li>
</ul>
</div>
<?php endif; ?>
<hr>

<h3>Pregunta 6</h3>
<p class="enunciado">¿Cuáles son las dos formas de fragmentación? Explique brevemente.</p>
<p>
La memoria libre queda dividida en pequeños huecos dispersos: fragmentación
<input type="text" name="respuesta_12" value="<?php echo r(12); ?>" size="12"> <?php echo v(12) ?><br>
El proceso recibe un bloque mayor que lo que necesita: fragmentación
<input type="text" name="respuesta_13" value="<?php echo r(13); ?>" size="12"> <?php echo v(13) ?>
</p>
<p class="etq">Explíquelas con sus palabras:</p>
<textarea class="libre" name="libre_6" rows="3"><?php echo libre(6); ?></textarea>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<ul>
<li><b>Fragmentación externa:</b> ocurre cuando la memoria libre queda dividida en pequeños huecos dispersos.
Aunque la suma de esos espacios sea suficiente, puede no existir un hueco contiguo lo suficientemente grande
para un proceso.</li>
<li><b>Fragmentación interna:</b> ocurre cuando un proceso recibe un bloque de memoria mayor que el espacio que
realmente necesita, por lo que una parte de la memoria asignada queda sin utilizar.</li>
</ul>
</div>
<?php endif; ?>
<hr>

<h3>Pregunta 7</h3>
<p class="enunciado">¿Cuáles son las dos partes de una dirección generada por la CPU?</p>
<p>
1. <input type="text" name="respuesta_14" value="<?php echo r(14); ?>" size="22"> <?php echo v(14) ?>
<span class="etq">&rarr; identifica la página de memoria lógica.</span><br>
2. <input type="text" name="respuesta_15" value="<?php echo r(15); ?>" size="22"> <?php echo v(15) ?>
<span class="etq">&rarr; indica la posición específica dentro de esa página.</span>
</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b class="titulo">En un sistema de paginación, una dirección lógica se divide en:</b>
<ul>
<li><b>Número de página:</b> identifica la página de memoria lógica.</li>
<li><b>Desplazamiento (offset):</b> indica la posición específica dentro de esa página.</li>
</ul>
</div>
<?php endif; ?>

</div>

<!-- ===================== DERECHA ===================== -->
<div class="seccion derecha">

<h3>Pregunta 8</h3>
<p class="enunciado">¿Qué contiene cada entrada de la tabla de páginas?</p>
<p>El número de <input type="text" name="respuesta_16" value="<?php echo r(16); ?>" size="22"> <?php echo v(16) ?>
que le corresponde a esa página en la memoria física.</p>
<p class="etq">Explíquelo con sus palabras:</p>
<textarea class="libre" name="libre_8" rows="2"><?php echo libre(8); ?></textarea>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
Contiene la información que permite relacionar una página lógica con su correspondiente <b>marco de página
(frame)</b> en la memoria física. En el esquema explicado en el video, se busca el número de página en la tabla
para obtener el marco físico al que corresponde.
</div>
<?php endif; ?>
<hr>

<h3>Pregunta 9</h3>
<p class="enunciado">(Verdadero/Falso) Puede ocurrir fragmentación en un sistema que maneje paginación.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_17" value="Verdadero" <?php echo chk(17, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_17" value="Falso" <?php echo chk(17, 'Falso'); ?>> Falso</label>
</div>
<p class="etq">La paginación <b>elimina</b> la fragmentación
<input type="text" name="respuesta_19" value="<?php echo r(19); ?>" size="10"> <?php echo v(19) ?>,
pero puede producir fragmentación
<input type="text" name="respuesta_18" value="<?php echo r(18); ?>" size="10"> <?php echo v(18) ?>.</p>
<button type="submit">Enviar</button>
<?php echo v(17) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<b class="titulo">Verdadero.</b>
La paginación elimina el problema de la <b>fragmentación externa</b> asociado a la asignación de memoria contigua,
pero puede producir <b>fragmentación interna</b>, cuando queda espacio sin utilizar dentro de la última página
asignada a un proceso.
</div>
<?php endif; ?>
<hr>

<h3>Pregunta 10</h3>
<p class="enunciado">¿Cuál es el término que especifica que un número de página no está presente en el TLB?</p>
<p><input type="text" name="respuesta_20" value="<?php echo r(20); ?>" size="26"> <?php echo v(20) ?></p>
<p class="etq">Cuando eso ocurre, el sistema debe consultar la
<input type="text" name="respuesta_21" value="<?php echo r(21); ?>" size="20"> <?php echo v(21) ?> en memoria.</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b class="titulo">Se denomina fallo del TLB (TLB miss).</b>
Significa que la traducción de la página no se encuentra en el búfer de traducción rápida, por lo que el sistema debe
consultar la <b>tabla de páginas</b> en memoria.
</div>
<?php endif; ?>
<hr>

<h3>Pregunta 11</h3>
<p class="enunciado">Si un <i>offset</i> de página es de 13 bits, ¿qué tan grande es la página (en bytes)?</p>
<p>Tamaño de página = 2<sup>13</sup> =
<input type="text" name="respuesta_101" value="<?php echo r(101); ?>" size="10"> <?php echo v(101) ?> bytes,
equivalentes a <input type="text" name="respuesta_102" value="<?php echo r(102); ?>" size="5"> <?php echo v(102) ?> KiB.</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b class="titulo">8192 bytes, equivalentes a 8 KiB.</b>
El tamaño de la página se calcula elevando 2 al número de bits del desplazamiento:
<br><span class="formula">Tamaño de página = 2<sup>13</sup> = 8192 bytes</span>
</div>
<?php endif; ?>
<hr>

<h3>Pregunta 12</h3>
<p class="enunciado">¿En qué consiste la partición/archivo de <i>swap</i> (<i>backing store</i>)?</p>
<p>Nombre del espacio: <input type="text" name="respuesta_22" value="<?php echo r(22); ?>" size="24"> <?php echo v(22) ?></p>
<p class="etq">Mover información de la RAM al disco es la operación
<input type="text" name="respuesta_23" value="<?php echo r(23); ?>" size="12"> <?php echo v(23) ?>;
recuperarla es <input type="text" name="respuesta_24" value="<?php echo r(24); ?>" size="12"> <?php echo v(24) ?>.</p>
<p class="etq">Explíquelo con sus palabras:</p>
<textarea class="libre" name="libre_12" rows="3"><?php echo libre(12); ?></textarea>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
Es un espacio especial del disco que el sistema operativo utiliza para almacenar temporalmente páginas o información
de procesos que no necesitan permanecer en la memoria RAM.<br>
Cuando necesita liberar memoria física, puede trasladar información al disco mediante una operación llamada
<b>swap out</b>. Cuando vuelve a necesitarla, la recupera mediante <b>swap in</b>. Este proceso es mucho más lento
que acceder a la RAM.
</div>
<?php endif; ?>
<hr>

<h3>Pregunta 13</h3>
<p class="enunciado">(Verdadero/Falso) Los sistemas móviles generalmente emplean <i>swapping</i>.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_25" value="Verdadero" <?php echo chk(25, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_25" value="Falso" <?php echo chk(25, 'Falso'); ?>> Falso</label>
</div>
<p class="etq">Los SO modernos evitan intercambiar procesos completos y prefieren intercambiar
<input type="text" name="respuesta_26" value="<?php echo r(26); ?>" size="12"> <?php echo v(26) ?>.</p>
<button type="submit">Enviar</button>
<?php echo v(25) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<b class="titulo">Falso.</b>
Según el contexto del video, los sistemas operativos modernos generalmente evitan intercambiar procesos completos
porque es ineficiente y prefieren intercambiar <b>páginas</b> cuando utilizan paginación. Sin embargo, la afirmación
específica sobre los sistemas móviles no se explica directamente en la transcripción.
<div class="nota">
<b>Nota del solucionario para la pregunta 13:</b> la respuesta anterior es una inferencia a partir del video, no una
afirmación explícita sobre los sistemas móviles. En sistemas móviles como Android e iOS, la gestión de memoria
depende de la plataforma y no debe generalizarse sin más contexto.
</div>
</div>
<?php endif; ?>
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
    <a class="btn btn-secondary" href="../Capitulo_9/index.php" role="button">Cuestionario ampliado del cap. 9</a>
</div>
</body>
</html>
