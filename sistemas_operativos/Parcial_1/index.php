<?php
/* ============================================================
   PARCIAL 1 - SISTEMAS OPERATIVOS (práctica)
   Mismo esquema que Lectura_1: respuesta_N / verificar_N / mostrar_solucion
   ============================================================ */

for ($i = 1; $i <= 120; $i++) {
    ${"respuesta_" . $i} = '';
}

for ($i = 1; $i <= 120; $i++) {
    ${"verificar_" . $i} = '';
}

for ($i = 12; $i <= 16; $i++) {
    ${"libre_" . $i} = '';
}

/* ---------- Respuestas aceptadas (la primera es la que se muestra en la solución) ---------- */
$claves = [
    // Pregunta 1 - SMP
    1 => ['c'],
    // Pregunta 2 - Caché
    2 => ['c'],
    // Pregunta 3 - Kernel V/F
    3 => ['Falso'],
    // Pregunta 4 - Microkernel
    4 => ['d'],
    // Pregunta 5 - Capas
    5 => ['d'],
    // Pregunta 6 - System calls
    6  => ['Control de procesos'],
    7  => ['Mantenimiento de información'],
    8  => ['Protección'],
    9  => ['Gestión de dispositivos'],
    10 => ['Gestión de archivos'],
    11 => ['Comunicaciones'],
    // Pregunta 7 - Socket
    12 => ['Falso'],
    // Pregunta 8 - Proceso y memoria
    13 => ['proceso'],
    14 => ['texto', 'text', 'codigo'],
    15 => ['datos', 'data'],
    16 => ['pila (stack)', 'pila', 'stack', 'pila(stack)'],
    17 => ['montículo (heap)', 'monticulo', 'heap', 'montículo', 'monticulo(heap)'],
    // Pregunta 9 - Hilo
    18 => ['a'],
    // Pregunta 10 - Pool de hilos
    19 => ['Pool de hilos', 'pool de hilos', 'thread pool', 'pool de threads', 'conjunto de hilos'],
    // Pregunta 12 - ConvertTo-Html
    66 => ['Where-Object', 'where', '?'],
    67 => ['-like', '-clike', '-ilike'],
    68 => ['-or'],
    69 => ['ConvertTo-Html'],
    70 => ['-Title'],
    71 => ['-PreContent', '-Body'],
    72 => ['Out-File'],
    // Pregunta 13 - Export-Csv
    73 => ['Status'],
    74 => ['Running'],
    75 => ['StartType'],
    76 => ['CanStop'],
    77 => ['CanShutdown'],
    78 => ['Export-Csv'],
    79 => ['-Delimiter'],
    80 => ['-NoClobber'],
    // Pregunta 14 - Alias desde CSV
    81 => ['Name'],
    82 => ['Value'],
    83 => ['Notepad', 'notepad.exe'],
    84 => ['Clear-Host'],
    85 => ['Get-Process'],
    86 => ['Import-Csv'],
    87 => ['New-Alias', 'Set-Alias'],
    // Pregunta 15 - Get-ChildItem
    88 => ['-Force'],
    89 => ['Mode'],
    90 => ['Length'],
    91 => ['Name'],
    92 => ['IsReadOnly'],
    // Pregunta 16 - Stop-Process -WhatIf
    93 => ['Sort-Object', 'sort'],
    94 => ['-Descending', '-desc'],
    95 => ['-First'],
    96 => ['Stop-Process', 'kill', 'spps'],
    97 => ['-WhatIf'],
];

/* Pregunta 11 - Tabla de planificación (P1..P5 x [FCFS W, FCFS TA, SJF W, SJF TA, PRI W, PRI TA, RR W, RR TA]) */
$tabla = [
    [0, 7, 9, 16, 19, 26, 21, 28],   // P1
    [7, 17, 25, 35, 0, 10, 25, 35],  // P2
    [17, 22, 4, 9, 26, 31, 18, 23],  // P3
    [22, 26, 0, 4, 31, 35, 20, 24],  // P4
    [26, 35, 16, 25, 10, 19, 25, 34] // P5
];
$numericas = [];
for ($f = 0; $f < 5; $f++) {
    for ($c = 0; $c < 8; $c++) {
        $numericas[20 + $f * 8 + $c] = $tabla[$f][$c];
    }
}
$numericas[60] = 14.4;  // Promedio W FCFS
$numericas[61] = 10.8;  // Promedio W SJF
$numericas[62] = 17.2;  // Promedio W Prioridad
$numericas[63] = 21.8;  // Promedio W RR
$claves[64] = ['SJF'];
$claves[65] = ['RR', 'Round Robin'];

/* ---------- Funciones auxiliares ---------- */
function normalizar($t) {
    $t = trim((string)$t);
    $t = strtr($t, [
        'á'=>'a','é'=>'e','í'=>'i','ó'=>'o','ú'=>'u','ü'=>'u','ñ'=>'n',
        'Á'=>'a','É'=>'e','Í'=>'i','Ó'=>'o','Ú'=>'u','Ü'=>'u','Ñ'=>'n'
    ]);
    $t = strtolower($t);
    $t = trim($t, " \t\n\r\"'`");
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
    $v = str_replace(',', '.', trim((string)$valor));
    return is_numeric($v) && abs((float)$v - $esperado) < 0.001;
}

function r($n) {                 // valor para value="..."
    return htmlspecialchars($GLOBALS["respuesta_" . $n], ENT_QUOTES, 'UTF-8');
}

function v($n) {                 // resultado de la verificación
    $estado = $GLOBALS["verificar_" . $n];
    if ($estado === 'correcto') {
        return '<span class="correcto">correcto</span> ';
    }
    if ($estado === 'incorrecto') {
        return '<span class="incorrecto">incorrecto</span> ';
    }
    return '';
}

function chk($n, $valor) {       // radio marcado
    return $GLOBALS["respuesta_" . $n] === $valor ? 'checked' : '';
}

function sel($n, $valor) {       // opción seleccionada
    return $GLOBALS["respuesta_" . $n] === $valor ? 'selected' : '';
}

function libre($n) {
    return htmlspecialchars($GLOBALS["libre_" . $n], ENT_QUOTES, 'UTF-8');
}

/* ---------- Procesamiento ---------- */
$mostrar_solucion = '';
if ($_POST) {
    $mostrar_solucion = isset($_POST['mostrar_solucion']) ? trim($_POST['mostrar_solucion']) : '';

    for ($i = 12; $i <= 16; $i++) {
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
            if (${"respuesta_$n"} === '') {
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
    <title>Parcial 1 - Sistemas Operativos (práctica)</title>
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

    h3 { font-size: 1.15rem; margin-top: 10px; }
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

    table.plan { border-collapse: collapse; margin: 8px 0; }
    table.plan th, table.plan td { border: 1px solid #cbd5e0; padding: 4px 6px; text-align: center; }
    table.plan th { background: #edf2f7; }
    table.plan input { width: 42px; text-align: center; }
    table.plan td .correcto, table.plan td .incorrecto { display: block; font-size: 0.7rem; }

    .solucion {
        background: #f0fff4;
        border-left: 4px solid #38a169;
        padding: 8px 12px;
        margin: 10px 0;
        font-size: 0.92rem;
    }

    .solucion pre { white-space: pre-wrap; margin: 4px 0; }
    textarea.libre { width: 100%; font-family: Consolas, "Courier New", monospace; }
    button { margin-top: 6px; }
    hr { margin: 18px 0; }
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

<h2>Parcial 1 - Sistemas Operativos</h2>
<p>Práctica con las preguntas del parcial. Llene y presione <b>Enviar</b>.</p>
<hr>

<!-- ---------------- Pregunta 1 ---------------- -->
<h3>Pregunta 1</h3>
<p class="enunciado">¿Cuál de las siguientes afirmaciones le llevaría a concluir que un sistema operativo dado emplea multiprocesamiento simétrico (SMP)?</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_1" value="a" <?php echo chk(1, 'a'); ?>> a. Ninguna de las anteriores</label>
    <label><input type="radio" name="respuesta_1" value="b" <?php echo chk(1, 'b'); ?>> b. A cada procesador se le asigna una tarea específica</label>
    <label><input type="radio" name="respuesta_1" value="c" <?php echo chk(1, 'c'); ?>> c. Cada procesador ejecuta todas las tareas en el sistema operativo</label>
    <label><input type="radio" name="respuesta_1" value="d" <?php echo chk(1, 'd'); ?>> d. Hay una relación jefe-trabajador entre los procesadores</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(1) ?>
<?php if ($ver_sol): ?>
<div class="solucion">En SMP todos los procesadores son pares: <b>cada uno ejecuta todas las tareas</b>. La relación jefe-trabajador y la tarea específica por CPU corresponden al multiprocesamiento <b>asimétrico</b>.</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 2 ---------------- -->
<h3>Pregunta 2</h3>
<p class="enunciado">Dos parámetros importantes de diseño para la memoria caché son:</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_2" value="a" <?php echo chk(2, 'a'); ?>> a. Consumo de energía y reusabilidad</label>
    <label><input type="radio" name="respuesta_2" value="b" <?php echo chk(2, 'b'); ?>> b. Tamaño y privilegios de acceso</label>
    <label><input type="radio" name="respuesta_2" value="c" <?php echo chk(2, 'c'); ?>> c. Tamaño y política de reemplazo de contenido</label>
    <label><input type="radio" name="respuesta_2" value="d" <?php echo chk(2, 'd'); ?>> d. Velocidad y volatilidad</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(2) ?>
<hr>

<!-- ---------------- Pregunta 3 ---------------- -->
<h3>Pregunta 3</h3>
<p class="enunciado">El kernel del sistema operativo está conformado por todos los programas de sistema y de aplicaciones de un computador.</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_3" value="Verdadero" <?php echo chk(3, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_3" value="Falso" <?php echo chk(3, 'Falso'); ?>> Falso</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(3) ?>
<?php if ($ver_sol): ?>
<div class="solucion">El kernel es solo el programa que corre todo el tiempo; los programas de sistema y las aplicaciones están <b>fuera</b> del kernel.</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 4 ---------------- -->
<h3>Pregunta 4</h3>
<p class="enunciado">De un microkernel, es correcto afirmar:</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_4" value="a" <?php echo chk(4, 'a'); ?>> a. Que ha sido compilado para producir el archivo más pequeño posible en disco</label>
    <label><input type="radio" name="respuesta_4" value="b" <?php echo chk(4, 'b'); ?>> b. Que contiene muchos componentes que han sido optimizados para reducir el tamaño del kernel en memoria</label>
    <label><input type="radio" name="respuesta_4" value="c" <?php echo chk(4, 'c'); ?>> c. Que ha sido comprimido antes de cargarse, para reducir su tamaño en memoria</label>
    <label><input type="radio" name="respuesta_4" value="d" <?php echo chk(4, 'd'); ?>> d. Es una forma de estructurar un Sistema Operativo al que se le han retirado todos los componentes no esenciales.</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(4) ?>
<hr>

<!-- ---------------- Pregunta 5 ---------------- -->
<h3>Pregunta 5</h3>
<p class="enunciado">La mayor dificultad de diseñar un sistema operativo por capas es:</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_5" value="a" <?php echo chk(5, 'a'); ?>> a. Asegurarse de que cada capa se puede convertir fácilmente en módulos</label>
    <label><input type="radio" name="respuesta_5" value="b" <?php echo chk(5, 'b'); ?>> b. Asegurarse de que cada capa oculta ciertas estructuras de datos, hardware y operaciones de las capas más altas</label>
    <label><input type="radio" name="respuesta_5" value="c" <?php echo chk(5, 'c'); ?>> c. La depuración (debugging) de una capa en particular</label>
    <label><input type="radio" name="respuesta_5" value="d" <?php echo chk(5, 'd'); ?>> d. Definir en forma apropiada las diferentes capas</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(5) ?>
<hr>

<!-- ---------------- Pregunta 6 ---------------- -->
<h3>Pregunta 6</h3>
<p class="enunciado">Asocie cada system call con su tipo.</p>
<?php
$tipos_sc = ['Control de procesos', 'Mantenimiento de información', 'Protección', 'Gestión de dispositivos', 'Gestión de archivos', 'Comunicaciones'];
$llamadas = [
    6  => 'Asignar y liberar memoria',
    7  => 'Obtener o establecer la fecha/hora del sistema',
    8  => 'Fijar permisos de archivo',
    9  => 'Leer, escribir, reposicionar',
    10 => 'Crear, borrar',
    11 => 'Enviar y recibir mensajes',
];
?>
<table class="plan" style="text-align:left">
<?php foreach ($llamadas as $n => $texto): ?>
    <tr>
        <td style="text-align:left"><?php echo $texto; ?></td>
        <td>
            <select name="respuesta_<?php echo $n; ?>">
                <option value="">Elegir...</option>
                <?php foreach ($tipos_sc as $t): ?>
                <option value="<?php echo $t; ?>" <?php echo sel($n, $t); ?>><?php echo $t; ?></option>
                <?php endforeach; ?>
            </select>
        </td>
        <td><?php echo v($n) ?></td>
    </tr>
<?php endforeach; ?>
</table>
<button type="submit">Enviar</button>
<?php if ($ver_sol): ?>
<div class="solucion">Ojo: "Leer, escribir, reposicionar" aparece aquí como <b>gestión de dispositivos</b> y "Crear, borrar" como <b>gestión de archivos</b> (en el parcial fue así).</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 7 ---------------- -->
<h3>Pregunta 7</h3>
<p class="enunciado">Un socket se identifica por una dupla (dirección IP : número de puerto)</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_12" value="Verdadero" <?php echo chk(12, 'Verdadero'); ?>> Verdadero</label>
    <label><input type="radio" name="respuesta_12" value="Falso" <?php echo chk(12, 'Falso'); ?>> Falso</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(12) ?>
<?php if ($ver_sol): ?>
<div class="solucion">Un socket es <b>un extremo</b> de la comunicación (IP:puerto); una conexión se identifica por el <b>par</b> de sockets. La respuesta calificada como correcta fue <b>Falso</b>.</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 8 ---------------- -->
<h3>Pregunta 8</h3>
<p class="enunciado">
Un
<input type="text" name="respuesta_13" value="<?php echo r(13); ?>" size="10">
es un programa en ejecución. Reserva las siguientes áreas de memoria:
</p>
<ul class="enunciado">
    <li>La sección de
        <input type="text" name="respuesta_14" value="<?php echo r(14); ?>" size="10">
        contiene el código ejecutable del programa.</li>
    <li>La sección de
        <input type="text" name="respuesta_15" value="<?php echo r(15); ?>" size="10">
        contiene las variables y constantes del programa.</li>
    <li>La sección de
        <input type="text" name="respuesta_16" value="<?php echo r(16); ?>" size="14">
        se emplea como almacenamiento temporal para paso de parámetros a funciones. También almacena el valor del contador de programa cuando el programa llama a una función.</li>
    <li>La sección de
        <input type="text" name="respuesta_17" value="<?php echo r(17); ?>" size="16">
        almacena estructuras dinámicas, tales como objetos.</li>
</ul>
<button type="submit">Enviar</button>
<?php echo v(13) ?>
<?php echo v(14) ?>
<?php echo v(15) ?>
<?php echo v(16) ?>
<?php echo v(17) ?>
<hr>

<!-- ---------------- Pregunta 9 ---------------- -->
<h3>Pregunta 9</h3>
<p class="enunciado">¿Qué es un hilo en un sistema operativo?</p>
<div class="opciones">
    <label><input type="radio" name="respuesta_18" value="a" <?php echo chk(18, 'a'); ?>> a. Una unidad de ejecución dentro de un proceso.</label>
    <label><input type="radio" name="respuesta_18" value="b" <?php echo chk(18, 'b'); ?>> b. Un dispositivo de entrada.</label>
    <label><input type="radio" name="respuesta_18" value="c" <?php echo chk(18, 'c'); ?>> c. Un proceso independiente.</label>
    <label><input type="radio" name="respuesta_18" value="d" <?php echo chk(18, 'd'); ?>> d. Un tipo de archivo.</label>
</div>
<button type="submit">Enviar</button>
<?php echo v(18) ?>
<hr>

<!-- ---------------- Pregunta 10 ---------------- -->
<h3>Pregunta 10</h3>
<p class="enunciado">
Un
<input type="text" name="respuesta_19" value="<?php echo r(19); ?>" size="14">
emplea un hilo existente (en lugar de crear uno nuevo) para completar una tarea.
</p>
<button type="submit">Enviar</button>
<?php echo v(19) ?>

</div>

<!-- =====================================================  DERECHA  ===================================================== -->
<div class="seccion derecha">

<!-- ---------------- Pregunta 11 ---------------- -->
<h3>Pregunta 11 (10 puntos)</h3>
<p class="enunciado">Considere el siguiente conjunto de procesos. La longitud de ráfaga de CPU está dada en milisegundos.</p>

<table class="plan">
    <tr><th>Proceso</th><th>Ráfaga de CPU</th><th>Prioridad</th></tr>
    <tr><td>P1</td><td>7</td><td>3</td></tr>
    <tr><td>P2</td><td>10</td><td>1</td></tr>
    <tr><td>P3</td><td>5</td><td>3</td></tr>
    <tr><td>P4</td><td>4</td><td>4</td></tr>
    <tr><td>P5</td><td>9</td><td>2</td></tr>
</table>

<p class="enunciado">Asuma que los procesos llegaron en el orden P1-P2-P3-P4-P5, todos en el tiempo 0.
Empleando los algoritmos de planificación: FCFS, SJF, prioridad no preferente, y RR con quantum 3, llene la siguiente tabla.
Asuma que a menor número de prioridad, la prioridad es mayor. W = tiempo de espera, TA = tiempo de turnaround. Para los decimales emplee punto (.)</p>

<div style="overflow-x:auto">
<table class="plan">
    <tr>
        <th>Proceso</th>
        <th>FCFS<br>W</th><th>FCFS<br>TA</th>
        <th>SJF<br>W</th><th>SJF<br>TA</th>
        <th>PRI<br>W</th><th>PRI<br>TA</th>
        <th>RR<br>W</th><th>RR<br>TA</th>
    </tr>
    <?php for ($f = 0; $f < 5; $f++): ?>
    <tr>
        <th>P<?php echo $f + 1; ?></th>
        <?php for ($c = 0; $c < 8; $c++): $n = 20 + $f * 8 + $c; ?>
        <td>
            <input type="text" name="respuesta_<?php echo $n; ?>" value="<?php echo r($n); ?>">
            <?php echo v($n) ?>
        </td>
        <?php endfor; ?>
    </tr>
    <?php endfor; ?>
    <tr>
        <th>Promedio</th>
        <?php $prom = [60, 61, 62, 63]; foreach ($prom as $n): ?>
        <td>
            <input type="text" name="respuesta_<?php echo $n; ?>" value="<?php echo r($n); ?>">
            <?php echo v($n) ?>
        </td>
        <td></td>
        <?php endforeach; ?>
    </tr>
</table>
</div>

<p class="enunciado">
¿Cuál algoritmo produce el menor tiempo promedio de espera?
<input type="text" name="respuesta_64" value="<?php echo r(64); ?>" size="6">
<?php echo v(64) ?>
<br>
¿Y cuál produce el mayor tiempo promedio de espera?
<input type="text" name="respuesta_65" value="<?php echo r(65); ?>" size="6">
<?php echo v(65) ?>
</p>
<button type="submit">Enviar</button>

<?php if ($ver_sol): ?>
<div class="solucion">
<b>Diagramas de Gantt</b>
<pre>FCFS : | P1 0-7 | P2 7-17 | P3 17-22 | P4 22-26 | P5 26-35 |
SJF  : | P4 0-4 | P3 4-9 | P1 9-16 | P5 16-25 | P2 25-35 |
PRI  : | P2 0-10 | P5 10-19 | P1 19-26 | P3 26-31 | P4 31-35 |   (empate P1/P3 → FCFS)
RR q3: | P1 0-3 | P2 3-6 | P3 6-9 | P4 9-12 | P5 12-15 | P1 15-18 | P2 18-21 |
       | P3 21-23 | P4 23-24 | P5 24-27 | P1 27-28 | P2 28-31 | P5 31-34 | P2 34-35 |</pre>
<b>Fórmulas:</b> TA = tiempo en que termina − llegada (aquí llegada = 0) &nbsp;·&nbsp; W = TA − ráfaga &nbsp;·&nbsp; Promedio = suma / 5
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 12 ---------------- -->
<h3>Pregunta 12 (PowerShell)</h3>
<p class="enunciado">Empleando PowerShell, genere una tabla en HTML que contenga los alias cuyos valores comiencen por G o por H. Antes de la tabla, debe desplegarse el texto "Alias por G y H"; el título de la página (que aparece en la pestaña del navegador) debe ser "Me gusta Powershell". Grabe el archivo con el nombre alias-log.html. El comando debe ser único (una sola línea, sin símbolos ; separando comandos).</p>
<div class="comando">
Get-Alias |
<input type="text" name="respuesta_66" value="<?php echo r(66); ?>" size="12">
{$_.Name
<input type="text" name="respuesta_67" value="<?php echo r(67); ?>" size="6">
"g*"
<input type="text" name="respuesta_68" value="<?php echo r(68); ?>" size="4">
$_.Name -like "h*"} |
<input type="text" name="respuesta_69" value="<?php echo r(69); ?>" size="14">
-Property Name,Definition
<input type="text" name="respuesta_70" value="<?php echo r(70); ?>" size="7">
"Me gusta Powershell"
<input type="text" name="respuesta_71" value="<?php echo r(71); ?>" size="11">
"Alias por G y H" |
<input type="text" name="respuesta_72" value="<?php echo r(72); ?>" size="9">
alias-log.html
</div>
<button type="submit">Enviar</button>
<?php echo v(66) ?><?php echo v(67) ?><?php echo v(68) ?><?php echo v(69) ?><?php echo v(70) ?><?php echo v(71) ?><?php echo v(72) ?>
<p>Escríbalo completo (práctica libre):</p>
<textarea class="libre" name="libre_12" rows="2"><?php echo libre(12); ?></textarea>
<?php if ($ver_sol): ?>
<div class="solucion">
<pre>Get-Alias | Where-Object {$_.Name -like "g*" -or $_.Name -like "h*"} | ConvertTo-Html -Property Name,Definition -Title "Me gusta Powershell" -PreContent "Alias por G y H" | Out-File alias-log.html</pre>
<b>Por qué en el parcial se perdieron 2 puntos:</b> se usó <code>-Title</code> junto con <code>-Head</code>. Si se pone <code>-Head</code>, PowerShell <b>ignora</b> <code>-Title</code>. El texto antes de la tabla va con <code>-PreContent</code> (o <code>-Body</code>); el título de la pestaña con <code>-Title</code>.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 13 ---------------- -->
<h3>Pregunta 13 (PowerShell)</h3>
<p class="enunciado">Empleando PowerShell, genere un archivo de texto CSV que contenga los servicios cuyo estado sea en ejecución. El archivo debe contener los campos nombre, estado, tipo de inicio, si el servicio se puede detener, y si el servicio se puede apagar. Emplee el punto y coma (;) como delimitador de columnas. Grabe el archivo con el nombre servicios.csv. Si el archivo ya existe, su comando no debe sobreescribirlo. El comando debe constar de una sola línea.</p>
<div class="comando">
Get-Service | Where-Object
<input type="text" name="respuesta_73" value="<?php echo r(73); ?>" size="7">
-eq "<input type="text" name="respuesta_74" value="<?php echo r(74); ?>" size="8">" |
Select-Object Name,Status,
<input type="text" name="respuesta_75" value="<?php echo r(75); ?>" size="9">,
<input type="text" name="respuesta_76" value="<?php echo r(76); ?>" size="8">,
<input type="text" name="respuesta_77" value="<?php echo r(77); ?>" size="11"> |
<input type="text" name="respuesta_78" value="<?php echo r(78); ?>" size="10">
-Path "servicios.csv"
<input type="text" name="respuesta_79" value="<?php echo r(79); ?>" size="10">
";" -NoTypeInformation
<input type="text" name="respuesta_80" value="<?php echo r(80); ?>" size="10">
</div>
<button type="submit">Enviar</button>
<?php echo v(73) ?><?php echo v(74) ?><?php echo v(75) ?><?php echo v(76) ?><?php echo v(77) ?><?php echo v(78) ?><?php echo v(79) ?><?php echo v(80) ?>
<p>Escríbalo completo (práctica libre):</p>
<textarea class="libre" name="libre_13" rows="2"><?php echo libre(13); ?></textarea>
<?php if ($ver_sol): ?>
<div class="solucion">
<pre>Get-Service | Where-Object Status -eq "Running" | Select-Object Name,Status,StartType,CanStop,CanShutdown | Export-Csv -Path "servicios.csv" -Delimiter ";" -NoTypeInformation -NoClobber</pre>
<code>-NoClobber</code> = no sobreescribir · <code>-Delimiter ";"</code> = separador · <code>-NoTypeInformation</code> quita la línea #TYPE (en PS 7 ya no aparece).
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 14 ---------------- -->
<h3>Pregunta 14 (PowerShell)</h3>
<p class="enunciado">El administrador de un servidor Windows necesita crear tres alias: <b>np</b> para llamar a Notepad, <b>bo</b> para llamar a Clear-Host, y <b>proc</b> para llamar a Get-Process. Los tres alias deben crearse <i>al tiempo</i>, con <i>un único comando de una sola línea (sin emplear ;)</i>. Incluya la línea de comando y el contenido del archivo auxiliar.</p>
<p><b>Contenido de aliases.csv</b></p>
<div class="comando">
<input type="text" name="respuesta_81" value="<?php echo r(81); ?>" size="6">,<input type="text" name="respuesta_82" value="<?php echo r(82); ?>" size="6"><br>
np,<input type="text" name="respuesta_83" value="<?php echo r(83); ?>" size="10"><br>
bo,<input type="text" name="respuesta_84" value="<?php echo r(84); ?>" size="10"><br>
proc,<input type="text" name="respuesta_85" value="<?php echo r(85); ?>" size="11">
</div>
<p><b>Comando</b></p>
<div class="comando">
<input type="text" name="respuesta_86" value="<?php echo r(86); ?>" size="10">
.\aliases.csv |
<input type="text" name="respuesta_87" value="<?php echo r(87); ?>" size="10">
</div>
<button type="submit">Enviar</button>
<?php echo v(81) ?><?php echo v(82) ?><?php echo v(83) ?><?php echo v(84) ?><?php echo v(85) ?><?php echo v(86) ?><?php echo v(87) ?>
<p>Escríbalo completo (práctica libre):</p>
<textarea class="libre" name="libre_14" rows="2"><?php echo libre(14); ?></textarea>
<?php if ($ver_sol): ?>
<div class="solucion">
<pre>Import-Csv .\aliases.csv | New-Alias</pre>
Funciona por <b>ByPropertyName</b>: las columnas <code>Name</code> y <code>Value</code> del CSV coinciden con los parámetros <code>-Name</code> y <code>-Value</code> de <code>New-Alias</code>.<br>
Versión alternativa (la del parcial, también válida):
<pre>Import-Csv .\aliases.csv | ForEach-Object { Set-Alias -Name $_.Name -Value $_.Value }</pre>
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 15 ---------------- -->
<h3>Pregunta 15 (PowerShell)</h3>
<p class="enunciado">Empleando PowerShell, despliegue una lista de los archivos del directorio C:\. Incluya las columnas modo, tamaño, nombre y la indicación de si el archivo es de sólo lectura. En el listado deben incluirse los archivos que tengan activo el atributo de "escondido". El comando debe ser único (una sola línea).</p>
<div class="comando">
Get-ChildItem C:\
<input type="text" name="respuesta_88" value="<?php echo r(88); ?>" size="7">
| Select-Object
<input type="text" name="respuesta_89" value="<?php echo r(89); ?>" size="5">,
@{n="Tamaño";e={$_.<input type="text" name="respuesta_90" value="<?php echo r(90); ?>" size="7">}},
<input type="text" name="respuesta_91" value="<?php echo r(91); ?>" size="5">,
@{n="SoloLectura";e={$_.<input type="text" name="respuesta_92" value="<?php echo r(92); ?>" size="10">}}
</div>
<button type="submit">Enviar</button>
<?php echo v(88) ?><?php echo v(89) ?><?php echo v(90) ?><?php echo v(91) ?><?php echo v(92) ?>
<p>Escríbalo completo (práctica libre):</p>
<textarea class="libre" name="libre_15" rows="2"><?php echo libre(15); ?></textarea>
<?php if ($ver_sol): ?>
<div class="solucion">
<pre>Get-ChildItem C:\ -Force | Select-Object Mode,@{n="Tamaño";e={$_.Length}},Name,@{n="SoloLectura";e={$_.IsReadOnly}}</pre>
<code>-Force</code> muestra ocultos y de sistema. Con <code>-File</code> se listan solo archivos (sin carpetas). Para tabla: cambiar <code>Select-Object</code> por <code>Format-Table</code>.
</div>
<?php endif; ?>
<hr>

<!-- ---------------- Pregunta 16 ---------------- -->
<h3>Pregunta 16 (PowerShell)</h3>
<p class="enunciado">Empleando PowerShell, simule la detención del proceso que más CPU esté consumiendo. El comando debe ser único (una sola línea).</p>
<div class="comando">
Get-Process |
<input type="text" name="respuesta_93" value="<?php echo r(93); ?>" size="10">
CPU
<input type="text" name="respuesta_94" value="<?php echo r(94); ?>" size="11">
| Select-Object
<input type="text" name="respuesta_95" value="<?php echo r(95); ?>" size="6">
1 |
<input type="text" name="respuesta_96" value="<?php echo r(96); ?>" size="11">
<input type="text" name="respuesta_97" value="<?php echo r(97); ?>" size="7">
</div>
<button type="submit">Enviar</button>
<?php echo v(93) ?><?php echo v(94) ?><?php echo v(95) ?><?php echo v(96) ?><?php echo v(97) ?>
<p>Escríbalo completo (práctica libre):</p>
<textarea class="libre" name="libre_16" rows="2"><?php echo libre(16); ?></textarea>
<?php if ($ver_sol): ?>
<div class="solucion">
<pre>Get-Process | Sort-Object CPU -Descending | Select-Object -First 1 | Stop-Process -WhatIf</pre>
"Simule" = <code>-WhatIf</code>. "Pregunte antes" sería <code>-Confirm</code>.
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
</div>
</body>
</html>
