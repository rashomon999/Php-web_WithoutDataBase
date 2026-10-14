<?php
/* ============================================================
   PREGUNTAS DE CHEQUEO - CAPÍTULO 10 (Memoria virtual)
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
    // 1
    1  => ['Verdadero'],
    2  => ['Memoria virtual', 'memoria virtual', 'virtual memory'],
    3  => ['Paginacion por demanda', 'paginacion por demanda', 'demand paging'],
    // 2
    4  => ['Falso'],
    5  => ['virtuales', 'virtual', 'logicas', 'logico', 'de direcciones virtuales'],
    // 3
    6  => ['cargada', 'cargada en memoria', 'presente', 'no esta cargada', 'en memoria'],
    7  => ['marco', 'marco de pagina', 'frame', 'un marco de pagina'],
    8  => ['tabla de paginas', 'la tabla de paginas', 'page table'],
    // 4
    9  => ['Verdadero'],
    // 5
    10 => ['FIFO', 'fifo', 'first in first out', 'primero en entrar primero en salir'],
    // 6
    11 => ['Optimo', 'optimo', 'OPT', 'opt', 'algoritmo optimo', 'optimo(opt)'],
    // 7
    12 => ['LRU', 'lru', 'least recently used', 'menos recientemente usado'],
    // 8
    13 => ['Verdadero'],
    // 9
    14 => ['Local', 'local', 'reemplazo local'],
    15 => ['Global', 'global', 'reemplazo global'],
    // 10
    16 => ['Sobrepaginacion', 'sobrepaginacion', 'thrashing', 'hiperpaginacion', 'sobrepaginacion(thrashing)'],
    // 11
    17 => ['Conjunto de trabajo', 'conjunto de trabajo', 'working set', 'conjunto de trabajo(working set)'],
    // 12
    18 => ['Verdadero'],
    // Repaso rápido (tabla final)
    20 => ['FIFO', 'fifo'],
    21 => ['Optimo', 'optimo', 'OPT', 'opt', 'optimo(opt)'],
    22 => ['LRU', 'lru'],
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
    } else {
        foreach ($claves as $n => $a) {
            ${"respuesta_$n"} = isset($_POST["respuesta_$n"]) ? $_POST["respuesta_$n"] : '';
            if (trim(${"respuesta_$n"}) === '')          { ${"verificar_$n"} = ''; }
            elseif (es_correcta(${"respuesta_$n"}, $a))  { ${"verificar_$n"} = "correcto"; }
            else                                        { ${"verificar_$n"} = "incorrecto"; }
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
    <title>Chequeo Capítulo 10</title>
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
    .cabecera, .ancho {
        padding: 18px 22px; background: white; border-radius: 10px;
        box-shadow: 0 6px 16px rgba(0,0,0,0.08); margin-bottom: 15px;
    }
    .cabecera { border-left: 6px solid #2b6cb0; }
    .ancho { margin-top: 15px; }
    h1 { font-size: 1.45rem; margin: 0 0 6px; }
    h2 { font-size: 1.2rem; margin-top: 0; }
    h3 { font-size: 1.1rem; margin-top: 16px; color: #1a365d; }
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
    .aviso {
        background: #fff5f5; border-left: 5px solid #c53030;
        padding: 10px 14px; margin: 10px 0; font-size: 0.95rem; line-height: 1.6;
    }
    textarea.libre { width: 100%; font-family: Arial, sans-serif; margin-top: 4px; }
    .etq { font-size: 0.86rem; color: #4a5568; }
    button { margin-top: 8px; }
    hr { margin: 18px 0; border: 0; border-top: 1px solid #e2e8f0; }
    table.repaso { border-collapse: collapse; width: 100%; margin: 8px 0; font-size: 0.92rem; }
    table.repaso th, table.repaso td { border: 1px solid #cbd5e0; padding: 7px 9px; text-align: left; vertical-align: middle; }
    table.repaso th { background: #edf2f7; }
    table.repaso td:first-child { width: 36%; }
    table.repaso input[type="text"] { width: 92%; }
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
<h1>Preguntas de chequeo &mdash; Capítulo 10: Memoria virtual</h1>
<p style="margin:0; color:#4a5568; line-height:1.55">Las <b>12 preguntas de chequeo</b> tal como están en el documento,
con las respuestas del solucionario. Responda y presione <b>Enviar</b> en cada una; al final puede escribir
<code>mostrar_solucion</code> para ver todas las respuestas.</p>
</div>

<form action="./index.php" method="POST" onsubmit="handleSubmit(event)" autocomplete="off">
<div class="form-container">

<!-- ===================== IZQUIERDA ===================== -->
<div class="seccion izquierda">

<h3>Pregunta 1</h3>
<p class="enunciado">(Verdadero/Falso) Un programa no requiere estar completo en memoria para poderse ejecutar.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_1" value="Verdadero" <?php echo chk(1, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_1" value="Falso" <?php echo chk(1, 'Falso'); ?>> Falso</label>
</div>
<p class="etq">Gracias a la <input type="text" name="respuesta_2" value="<?php echo r(2); ?>" size="16"> <?php echo v(2) ?>
y a la <input type="text" name="respuesta_3" value="<?php echo r(3); ?>" size="22"> <?php echo v(3) ?>.</p>
<button type="submit">Enviar</button>
<?php echo v(1) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<b class="titulo">Verdadero.</b>
Gracias a la <b>memoria virtual</b> y a la <b>paginación por demanda</b>, un programa puede ejecutarse aunque solo una
parte de sus páginas esté cargada en la memoria física. Las demás se cargan cuando se necesitan.
</div>
<?php endif; ?>
<hr>

<h3>Pregunta 2</h3>
<p class="enunciado">(Verdadero/Falso) El espacio de direcciones físicas es cuando menos tan grande como el espacio de
direcciones virtuales.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_4" value="Verdadero" <?php echo chk(4, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_4" value="Falso" <?php echo chk(4, 'Falso'); ?>> Falso</label>
</div>
<p class="etq">Es al revés: el espacio de direcciones
<input type="text" name="respuesta_5" value="<?php echo r(5); ?>" size="12"> <?php echo v(5) ?>
puede ser mayor que la memoria física disponible.</p>
<button type="submit">Enviar</button>
<?php echo v(4) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<b class="titulo">Falso.</b>
El espacio de direcciones <b>virtuales</b> puede ser mayor que la memoria física disponible. Esto permite ejecutar
programas que no cabrían completamente en la RAM.
</div>
<?php endif; ?>
<hr>

<h3>Pregunta 3</h3>
<p class="enunciado">¿Cuándo ocurre un fallo de página?</p>
<p>Ocurre cuando un proceso intenta acceder a una página que no está
<input type="text" name="respuesta_6" value="<?php echo r(6); ?>" size="14"> <?php echo v(6) ?>
en la memoria física.</p>
<p class="etq">El sistema operativo debe entonces localizarla, cargarla en un
<input type="text" name="respuesta_7" value="<?php echo r(7); ?>" size="16"> <?php echo v(7) ?> disponible
y actualizar la <input type="text" name="respuesta_8" value="<?php echo r(8); ?>" size="18"> <?php echo v(8) ?>.</p>
<p class="etq">Respóndalo completo con sus palabras:</p>
<textarea class="libre" name="libre_3" rows="3"><?php echo libre(3); ?></textarea>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
Ocurre cuando un proceso intenta acceder a una página que <b>no está cargada en la memoria física</b>. El sistema
operativo debe localizarla, cargarla en un <b>marco de página</b> disponible y actualizar la <b>tabla de páginas</b>.
</div>
<?php endif; ?>
<hr>

<h3>Pregunta 4</h3>
<p class="enunciado">(Verdadero/Falso) En un sistema de paginación pura por demanda, una página no se sube a memoria
sino hasta que se la necesita.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_9" value="Verdadero" <?php echo chk(9, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_9" value="Falso" <?php echo chk(9, 'Falso'); ?>> Falso</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(9) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<b class="titulo">Verdadero.</b>
Las páginas se cargan en la memoria física únicamente cuando el proceso intenta acceder a ellas.
</div>
<?php endif; ?>
<hr>

<h3>Pregunta 5</h3>
<p class="enunciado">¿Cuál es el algoritmo más sencillo de reemplazo de páginas?</p>
<p><input type="text" name="respuesta_10" value="<?php echo r(10); ?>" size="26"> <?php echo v(10) ?></p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b class="titulo">El algoritmo FIFO (First In, First Out).</b>
Reemplaza la página que lleva más tiempo en memoria, es decir, la que entró primero.
</div>
<?php endif; ?>
<hr>

<h3>Pregunta 6</h3>
<p class="enunciado">¿Cuál es el nombre del algoritmo de reemplazo de páginas que reemplaza la página que no será
usada por el período más largo de tiempo?</p>
<p><input type="text" name="respuesta_11" value="<?php echo r(11); ?>" size="26"> <?php echo v(11) ?></p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b class="titulo">El algoritmo óptimo (OPT).</b>
Reemplaza la página cuyo próximo uso está más lejano en el futuro, o que no volverá a utilizarse. Es principalmente
teórico porque requiere conocer las referencias futuras.
</div>
<?php endif; ?>

</div>

<!-- ===================== DERECHA ===================== -->
<div class="seccion derecha">

<h3>Pregunta 7</h3>
<p class="enunciado">¿Cuál algoritmo de reemplazo de páginas se puede implementar empleando una pila, o contadores?</p>
<p><input type="text" name="respuesta_12" value="<?php echo r(12); ?>" size="26"> <?php echo v(12) ?></p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b class="titulo">El algoritmo LRU (Least Recently Used).</b>
Reemplaza la página que lleva más tiempo sin utilizarse.
</div>
<?php endif; ?>
<hr>

<h3>Pregunta 8</h3>
<p class="enunciado">(Verdadero/Falso) Cuando se implementa LRU, casi siempre se emplean algoritmos de aproximación.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_13" value="Verdadero" <?php echo chk(13, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_13" value="Falso" <?php echo chk(13, 'Falso'); ?>> Falso</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(13) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<b class="titulo">Verdadero.</b>
Como implementar LRU exacto puede resultar costoso, habitualmente se utilizan algoritmos que aproximan su
comportamiento.
</div>
<?php endif; ?>
<hr>

<h3>Pregunta 9</h3>
<p class="enunciado">¿Cuál es la diferencia fundamental entre reemplazo local y global de páginas?</p>
<p>
Reemplaza usando <b>únicamente sus propios marcos</b> asignados: reemplazo
<input type="text" name="respuesta_14" value="<?php echo r(14); ?>" size="12"> <?php echo v(14) ?><br>
Puede reemplazar una página <b>perteneciente a otro proceso</b>: reemplazo
<input type="text" name="respuesta_15" value="<?php echo r(15); ?>" size="12"> <?php echo v(15) ?>
</p>
<p class="etq">Explique la diferencia con sus palabras:</p>
<textarea class="libre" name="libre_9" rows="3"><?php echo libre(9); ?></textarea>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<ul>
<li><b>Reemplazo local:</b> el proceso reemplaza una página utilizando únicamente sus propios marcos de memoria
asignados.</li>
<li><b>Reemplazo global:</b> el proceso puede reemplazar una página perteneciente a otro proceso, utilizando cualquier
marco de página elegible de la memoria física.</li>
</ul>
</div>
<?php endif; ?>
<hr>

<h3>Pregunta 10</h3>
<p class="enunciado">¿Cuál término se emplea para describir la situación en la que un proceso pasa más tiempo
paginando que ejecutándose?</p>
<p><input type="text" name="respuesta_16" value="<?php echo r(16); ?>" size="26"> <?php echo v(16) ?></p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b class="titulo">Sobrepaginación (thrashing).</b>
Ocurre cuando el sistema dedica demasiado tiempo a intercambiar páginas entre la memoria física y el disco, en lugar
de ejecutar instrucciones útiles.
</div>
<?php endif; ?>
<hr>

<h3>Pregunta 11</h3>
<p class="enunciado">¿Cuál término se emplea para describir el conjunto de páginas que está referenciando un proceso
actualmente?</p>
<p><input type="text" name="respuesta_17" value="<?php echo r(17); ?>" size="26"> <?php echo v(17) ?></p>
<p class="etq">Explique para qué sirve:</p>
<textarea class="libre" name="libre_11" rows="3"><?php echo libre(11); ?></textarea>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b class="titulo">Conjunto de trabajo (working set).</b>
Es el conjunto de páginas que un proceso ha referenciado durante una ventana de tiempo determinada. Permite
identificar las páginas que necesita mantener disponibles para reducir los fallos de página y evitar la sobrepaginación.
</div>
<?php endif; ?>
<hr>

<h3>Pregunta 12</h3>
<p class="enunciado">(Verdadero/Falso) En la paginación pura por demanda, la tasa inicial de fallos de página es muy alta.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_18" value="Verdadero" <?php echo chk(18, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_18" value="Falso" <?php echo chk(18, 'Falso'); ?>> Falso</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(18) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<b class="titulo">Verdadero.</b>
Al comenzar la ejecución, las páginas todavía no están cargadas en memoria. Por ello, las primeras referencias a
páginas que no están presentes producen fallos de página.
</div>
<?php endif; ?>
<hr>

<strong>si desea ver las soluciones escribir: mostrar_solucion</strong>
<br>
<input type="text" id="mostrar_solucion" name="mostrar_solucion" value="<?php echo htmlspecialchars($mostrar_solucion, ENT_QUOTES, 'UTF-8'); ?>">
<button type="submit">Mostrar Solución</button>

</div>
</div>

<!-- ===================== REPASO RÁPIDO ===================== -->
<div class="ancho">
<h2>Repaso rápido para el examen</h2>
<table class="repaso">
<tr><th>Concepto</th><th>Idea clave</th></tr>
<tr><td>Memoria virtual</td><td>Permite ejecutar programas sin cargarlos completamente en RAM.</td></tr>
<tr><td>Paginación por demanda</td><td>Carga las páginas cuando se necesitan.</td></tr>
<tr><td>Fallo de página</td><td>Se intenta acceder a una página que no está en RAM.</td></tr>
<tr>
  <td><input type="text" name="respuesta_20" value="<?php echo r(20); ?>"><?php echo v(20) ?></td>
  <td>Sale primero la página que entró primero.</td>
</tr>
<tr>
  <td><input type="text" name="respuesta_21" value="<?php echo r(21); ?>"><?php echo v(21) ?></td>
  <td>Sale la página cuyo próximo uso está más lejano.</td>
</tr>
<tr>
  <td><input type="text" name="respuesta_22" value="<?php echo r(22); ?>"><?php echo v(22) ?></td>
  <td>Sale la página que lleva más tiempo sin utilizarse.</td>
</tr>
<tr><td>Reemplazo local</td><td>Solo reemplaza páginas del propio proceso.</td></tr>
<tr><td>Reemplazo global</td><td>Puede reemplazar páginas de otros procesos.</td></tr>
<tr><td>Sobrepaginación</td><td>Se dedica más tiempo a paginar que a ejecutar.</td></tr>
<tr><td>Conjunto de trabajo</td><td>Páginas utilizadas recientemente dentro de una ventana de tiempo.</td></tr>
</table>

<div class="aviso">
<b>Importante:</b> no confundas <b>FIFO</b> con <b>LRU</b>. FIFO considera <b>cuándo entró</b> la página a memoria;
LRU considera <b>cuándo se utilizó por última vez</b>.
</div>
</div>

</form>

<div class="centered-container" style="text-align:center; margin-top:20px">
    <a class="btn btn-primary" href="../Menu.php" role="button">Volver al menú</a>
    <a class="btn btn-secondary" href="../Capitulo_10/index.php" role="button">Cuestionario ampliado del cap. 10</a>
</div>
</body>
</html>
