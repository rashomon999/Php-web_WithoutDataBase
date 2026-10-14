<?php
/* ============================================================
   PREGUNTAS DE CHEQUEO - CAPÍTULO 8 (Abrazos mortales)
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
    // 1. Modelo del sistema
    1  => ['finito', 'finito', 'limitado'],
    2  => ['tipos', 'tipos de recursos', 'tipos de recurso'],
    3  => ['instancias', 'instancia', 'una o varias instancias'],
    4  => ['solicitan', 'solicitar', 'piden', 'solicita'],
    5  => ['utilizan', 'utilizar', 'usan', 'usar', 'utiliza'],
    6  => ['liberan', 'liberar', 'libera', 'devuelven'],
    // 2. Las cuatro condiciones
    7  => ['Exclusion mutua', 'exclusion mutua', 'mutual exclusion'],
    8  => ['Retencion y espera', 'retencion y espera', 'retener y esperar', 'hold and wait'],
    9  => ['No expropiacion', 'no expropiacion', 'no preempcion', 'sin expropiacion', 'no preemption'],
    10 => ['Espera circular', 'espera circular', 'circular wait'],
    11 => ['Verdadero'],
    // 3. Las tres estrategias
    12 => ['Ignorar el problema', 'ignorar el problema', 'ignorar', 'ignorarlo'],
    13 => ['Prevenir o evitar', 'prevenir o evitar', 'prevenir', 'evitar', 'prevencion y evitacion', 'prevenir o evitar los abrazos mortales'],
    14 => ['Detectar y recuperar', 'detectar y recuperar', 'deteccion y recuperacion', 'detectar'],
    // 4. La condición razonable
    15 => ['Espera circular', 'espera circular', 'la espera circular', 'circular wait'],
    16 => ['ciclo', 'un ciclo', 'cadena circular', 'ciclo de procesos'],
    // 5. Estado seguro
    17 => ['Estado seguro', 'estado seguro', 'seguro'],
    18 => ['Secuencia segura', 'secuencia segura', 'una secuencia segura'],
    // 6. Banquero
    19 => ['maximo', 'numero maximo', 'maximo de recursos', 'el maximo'],
    20 => ['seguro', 'estado seguro', 'un estado seguro'],
    21 => ['a'],   // mantiene estado seguro -> conceder
    22 => ['b'],   // estado inseguro -> esperar
    23 => ['banco', 'un banco', 'banquero', 'banco que presta dinero'],
    // 7. Recuperación
    24 => ['Abortar todos los procesos', 'abortar todos los procesos', 'abortar todos', 'cancelar todos los procesos', 'abortar todos los procesos involucrados'],
    25 => ['Abortar los procesos uno por uno', 'abortar uno por uno', 'abortar los procesos uno por uno', 'abortar de a uno', 'uno por uno'],
    26 => ['Expropiar recursos', 'expropiar recursos', 'expropiacion de recursos', 'expropiar', 'preempcion de recursos'],
    27 => ['manual', 'recuperacion manual', 'la manual'],
    // Cuidados de la expropiación
    28 => ['victima', 'proceso victima', 'seleccion del proceso victima', 'seleccion de la victima'],
    29 => ['rollback', 'deshacer operaciones', 'retroceso', 'reversion'],
    30 => ['inanicion', 'inanicion', 'starvation', 'hambruna'],
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
    <title>Chequeo Capítulo 8</title>
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
        border-left: 6px solid #c53030;
    }
    h1 { font-size: 1.45rem; margin: 0 0 6px; }
    h3 { font-size: 1.1rem; margin-top: 16px; color: #742a2a; }
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
    .solucion ol, .solucion ul { margin: 6px 0 0 20px; padding: 0; }
    .solucion li { margin: 5px 0; }
    textarea.libre { width: 100%; font-family: Arial, sans-serif; margin-top: 4px; }
    .etq { font-size: 0.86rem; color: #4a5568; }
    button { margin-top: 8px; }
    hr { margin: 18px 0; border: 0; border-top: 1px solid #e2e8f0; }
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
<h1>Preguntas de chequeo &mdash; Capítulo 8: Abrazos mortales</h1>
<p style="margin:0; color:#4a5568; line-height:1.55">Las <b>7 preguntas de chequeo</b> tal como están en el documento,
con las respuestas del solucionario. Responda y presione <b>Enviar</b> en cada una; al final puede escribir
<code>mostrar_solucion</code> para ver todas las respuestas.</p>
</div>

<form action="./index.php" method="POST" onsubmit="handleSubmit(event)" autocomplete="off">
<div class="form-container">

<!-- ===================== IZQUIERDA ===================== -->
<div class="seccion izquierda">

<h3>Pregunta 1</h3>
<p class="enunciado">¿En qué consiste el modelo de sistema para un abrazo mortal?</p>
<p>Existe un número <input type="text" name="respuesta_1" value="<?php echo r(1); ?>" size="10"> <?php echo v(1) ?>
de recursos de diferentes <input type="text" name="respuesta_2" value="<?php echo r(2); ?>" size="12"> <?php echo v(2) ?>,
y cada uno puede tener una o varias <input type="text" name="respuesta_3" value="<?php echo r(3); ?>" size="14"> <?php echo v(3) ?>.</p>
<p>Los procesos <input type="text" name="respuesta_4" value="<?php echo r(4); ?>" size="12"> <?php echo v(4) ?>
los recursos que necesitan, los <input type="text" name="respuesta_5" value="<?php echo r(5); ?>" size="12"> <?php echo v(5) ?>
y finalmente los <input type="text" name="respuesta_6" value="<?php echo r(6); ?>" size="12"> <?php echo v(6) ?>.</p>
<p class="etq">Defina cuándo ocurre un abrazo mortal:</p>
<textarea class="libre" name="libre_1" rows="3"><?php echo libre(1); ?></textarea>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
El modelo de sistema consiste en que existe un número <b>finito</b> de recursos de diferentes <b>tipos</b>, y cada tipo
puede tener una o varias <b>instancias</b>. Los procesos <b>solicitan</b> los recursos que necesitan, los
<b>utilizan</b> y finalmente los <b>liberan</b>.<br><br>
Un abrazo mortal ocurre cuando varios procesos quedan esperando recursos que están siendo retenidos por otros
procesos del mismo conjunto, de modo que ninguno puede continuar su ejecución.
</div>
<?php endif; ?>
<hr>

<h3>Pregunta 2</h3>
<p class="enunciado">¿Cuáles son las cuatro condiciones necesarias para caracterizar un abrazo mortal?
Descríbalas brevemente.</p>
<p>
1. <input type="text" name="respuesta_7" value="<?php echo r(7); ?>" size="22"> <?php echo v(7) ?><br>
<span class="etq">&nbsp;&nbsp;&nbsp;al menos un recurso solo puede ser utilizado por un proceso a la vez.</span><br>
2. <input type="text" name="respuesta_8" value="<?php echo r(8); ?>" size="22"> <?php echo v(8) ?><br>
<span class="etq">&nbsp;&nbsp;&nbsp;conserva los recursos que ya tiene mientras espera que se le asignen otros.</span><br>
3. <input type="text" name="respuesta_9" value="<?php echo r(9); ?>" size="22"> <?php echo v(9) ?><br>
<span class="etq">&nbsp;&nbsp;&nbsp;no se puede obligar a un proceso a liberar los recursos que posee.</span><br>
4. <input type="text" name="respuesta_10" value="<?php echo r(10); ?>" size="22"> <?php echo v(10) ?><br>
<span class="etq">&nbsp;&nbsp;&nbsp;cadena circular en la que cada proceso espera un recurso del siguiente.</span>
</p>
<p class="enunciado" style="margin-top:12px">(Verdadero/Falso) Las cuatro condiciones deben cumplirse
<b>simultáneamente</b> para que pueda producirse un abrazo mortal.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_11" value="Verdadero" <?php echo chk(11, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_11" value="Falso" <?php echo chk(11, 'Falso'); ?>> Falso</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(11) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
<ol>
<li><b>Exclusión mutua:</b> al menos un recurso solo puede ser utilizado por un proceso a la vez.</li>
<li><b>Retención y espera:</b> un proceso conserva los recursos que ya tiene mientras espera que se le asignen otros
recursos.</li>
<li><b>No expropiación:</b> no se puede obligar a un proceso a liberar los recursos que posee; debe liberarlos
voluntariamente.</li>
<li><b>Espera circular:</b> existe una cadena circular de procesos en la que cada proceso espera un recurso retenido
por el siguiente proceso de la cadena.</li>
</ol>
<br>Las cuatro condiciones deben cumplirse <b>simultáneamente</b> para que pueda producirse un abrazo mortal
(<b>Verdadero</b>).
</div>
<?php endif; ?>
<hr>

<h3>Pregunta 3</h3>
<p class="enunciado">¿Cuáles son las tres estrategias para manejar un abrazo mortal?</p>
<p>
1. <input type="text" name="respuesta_12" value="<?php echo r(12); ?>" size="26"> <?php echo v(12) ?><br>
<span class="etq">&nbsp;&nbsp;&nbsp;asumir que no ocurrirán, o que las aplicaciones se encarguen.</span><br>
2. <input type="text" name="respuesta_13" value="<?php echo r(13); ?>" size="26"> <?php echo v(13) ?><br>
<span class="etq">&nbsp;&nbsp;&nbsp;impedir que ocurran mediante restricciones o verificando el estado seguro.</span><br>
3. <input type="text" name="respuesta_14" value="<?php echo r(14); ?>" size="26"> <?php echo v(14) ?><br>
<span class="etq">&nbsp;&nbsp;&nbsp;permitir que ocurran, detectarlos y aplicar mecanismos de recuperación.</span>
</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<ol>
<li><b>Ignorar el problema:</b> asumir que los abrazos mortales no ocurrirán o que las aplicaciones deben encargarse
de ellos.</li>
<li><b>Prevenir o evitar los abrazos mortales:</b> impedir que ocurran mediante restricciones en la asignación de
recursos o verificando que el sistema permanezca en un estado seguro.</li>
<li><b>Detectar y recuperar:</b> permitir que ocurran los abrazos mortales, detectarlos cuando se presentan y aplicar
mecanismos para recuperar el sistema.</li>
</ol>
</div>
<?php endif; ?>
<hr>

<h3>Pregunta 4</h3>
<p class="enunciado">¿Cuál es la única condición razonable que se puede emplear para evitar que ocurran abrazos mortales?</p>
<p><input type="text" name="respuesta_15" value="<?php echo r(15); ?>" size="26"> <?php echo v(15) ?></p>
<p class="etq">Se busca impedir que se forme un
<input type="text" name="respuesta_16" value="<?php echo r(16); ?>" size="16"> <?php echo v(16) ?>
de procesos esperando recursos entre sí.</p>
<p class="etq">¿Por qué las otras tres son difíciles de eliminar?</p>
<textarea class="libre" name="libre_4" rows="3"><?php echo libre(4); ?></textarea>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b class="titulo">La espera circular.</b>
Se busca impedir que se forme un <b>ciclo</b> de procesos esperando recursos entre sí.<br><br>
Las otras condiciones son difíciles de eliminar porque algunos recursos requieren exclusión mutua, los procesos
pueden necesitar conservar recursos mientras esperan y ciertos recursos no pueden retirarse forzosamente sin
afectar la ejecución.
</div>
<?php endif; ?>

</div>

<!-- ===================== DERECHA ===================== -->
<div class="seccion derecha">

<h3>Pregunta 5</h3>
<p class="enunciado">¿Cuál es el estado del sistema en el que los recursos se pueden asignar a todos los procesos en
cierto orden, y aún así evitar los abrazos mortales?</p>
<p><input type="text" name="respuesta_17" value="<?php echo r(17); ?>" size="24"> <?php echo v(17) ?></p>
<p class="etq">Ese estado existe cuando hay una
<input type="text" name="respuesta_18" value="<?php echo r(18); ?>" size="22"> <?php echo v(18) ?> de ejecución.</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b class="titulo">Es el estado seguro.</b>
Un sistema se encuentra en estado seguro cuando existe una <b>secuencia segura</b> de ejecución en la que todos los
procesos pueden obtener los recursos que necesitan, terminar sus tareas y liberar los recursos para los demás
procesos, evitando así un abrazo mortal.
</div>
<?php endif; ?>
<hr>

<h3>Pregunta 6</h3>
<p class="enunciado">Describa brevemente el propósito y la filosofía del algoritmo del banquero.</p>
<p class="etq"><b>Propósito:</b> evitar los abrazos mortales mediante la asignación controlada de recursos,
manteniendo el sistema en un estado seguro.</p>
<p class="etq"><b>Filosofía:</b> cada proceso debe declarar previamente el número
<input type="text" name="respuesta_19" value="<?php echo r(19); ?>" size="12"> <?php echo v(19) ?>
de recursos de cada tipo que podría necesitar. Cuando un proceso solicita recursos, el sistema verifica si concederlos
permitiría conservar un estado <input type="text" name="respuesta_20" value="<?php echo r(20); ?>" size="12"> <?php echo v(20) ?>.</p>

<p style="margin-top:12px"><b>Si la asignación mantiene el sistema en un estado seguro:</b></p>
<div class="opciones">
    <label><input type="radio" name="respuesta_21" value="a" <?php echo chk(21, 'a'); ?>> a. Se conceden los recursos</label>
    <label><input type="radio" name="respuesta_21" value="b" <?php echo chk(21, 'b'); ?>> b. La solicitud debe esperar</label>
</div>
<p><b>Si la asignación deja al sistema en un estado inseguro:</b></p>
<div class="opciones">
    <label><input type="radio" name="respuesta_22" value="a" <?php echo chk(22, 'a'); ?>> a. Se conceden los recursos</label>
    <label><input type="radio" name="respuesta_22" value="b" <?php echo chk(22, 'b'); ?>> b. La solicitud debe esperar hasta que se liberen más recursos</label>
</div>
<p class="etq">Se llama &laquo;del banquero&raquo; porque funciona como un
<input type="text" name="respuesta_23" value="<?php echo r(23); ?>" size="14"> <?php echo v(23) ?>.</p>
<button type="submit">Enviar</button>
<?php echo v(21) ?><?php echo v(22) ?>
<?php if ($ver_sol): ?>
<div class="solucion">
El algoritmo del banquero tiene como <b>propósito</b> evitar los abrazos mortales mediante la asignación controlada
de recursos, manteniendo el sistema en un estado seguro.<br><br>
Su <b>filosofía</b> consiste en que cada proceso declare previamente el número <b>máximo</b> de recursos de cada tipo
que podría necesitar. Cuando un proceso solicita recursos, el sistema verifica si concederlos permitiría conservar un
estado <b>seguro</b>.
<ul>
<li>Si la asignación mantiene el sistema en un estado seguro, <b>se conceden los recursos</b>.</li>
<li>Si la asignación deja al sistema en un estado inseguro, <b>la solicitud debe esperar</b> hasta que se liberen más
recursos.</li>
</ul>
<br>Se llama algoritmo del banquero porque funciona de manera similar a un <b>banco</b> que presta dinero a sus
clientes sin comprometer su capacidad de atender las necesidades futuras.
</div>
<?php endif; ?>
<hr>

<h3>Pregunta 7</h3>
<p class="enunciado">¿Cuáles son las estrategias para recuperar el sistema de un abrazo mortal?</p>
<p><b>Tres estrategias de recuperación automática:</b></p>
<p>
1. <input type="text" name="respuesta_24" value="<?php echo r(24); ?>" size="30"> <?php echo v(24) ?><br>
<span class="etq">&nbsp;&nbsp;&nbsp;rápida, pero con grandes pérdidas de trabajo y recursos.</span><br>
2. <input type="text" name="respuesta_25" value="<?php echo r(25); ?>" size="30"> <?php echo v(25) ?><br>
<span class="etq">&nbsp;&nbsp;&nbsp;hasta romper el ciclo; hay que ejecutar de nuevo el algoritmo de detección.</span><br>
3. <input type="text" name="respuesta_26" value="<?php echo r(26); ?>" size="30"> <?php echo v(26) ?><br>
<span class="etq">&nbsp;&nbsp;&nbsp;obligar a liberar recursos para que otros procesos puedan continuar.</span>
</p>
<p class="etq">Además existe la recuperación
<input type="text" name="respuesta_27" value="<?php echo r(27); ?>" size="12"> <?php echo v(27) ?>,
en la que se informa al operador del sistema.</p>

<p style="margin-top:12px"><b>Los tres cuidados al expropiar recursos:</b></p>
<p>
Elegir cuidadosamente el proceso <input type="text" name="respuesta_28" value="<?php echo r(28); ?>" size="14"> <?php echo v(28) ?><br>
Considerar si es necesario deshacer operaciones (<input type="text" name="respuesta_29" value="<?php echo r(29); ?>" size="12"> <?php echo v(29) ?>)<br>
Evitar elegir siempre al mismo proceso, pues sufriría <input type="text" name="respuesta_30" value="<?php echo r(30); ?>" size="14"> <?php echo v(30) ?>
</p>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">
<b class="titulo">Existen tres estrategias principales de recuperación automática:</b>
<ol>
<li><b>Abortar todos los procesos involucrados:</b> se cancelan todos los procesos que participan en el abrazo mortal.
Es una solución rápida, pero puede generar grandes pérdidas de trabajo y recursos.</li>
<li><b>Abortar los procesos uno por uno:</b> se cancela un proceso a la vez hasta romper el ciclo. Se busca elegir los
procesos cuya cancelación genere el menor costo posible, aunque es necesario ejecutar nuevamente el algoritmo de
detección.</li>
<li><b>Expropiar recursos:</b> se obliga a uno o varios procesos a liberar recursos para que otros puedan continuar.
Se debe elegir cuidadosamente el proceso <b>víctima</b>, considerar si es necesario deshacer operaciones
(<b>rollback</b>) y evitar seleccionar siempre al mismo proceso, pues podría sufrir <b>inanición</b>.</li>
</ol>
<br>También existe la <b>recuperación manual</b>, en la que se informa al operador del sistema para que tome las
medidas necesarias, como cancelar alguno de los procesos involucrados.
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
    <a class="btn btn-secondary" href="../Capitulo_8/index.php" role="button">Cuestionario ampliado del cap. 8</a>
</div>
</body>
</html>
